<?php
require ($_SERVER['DOCUMENT_ROOT'] . '/../eden/ssi/login.php');

$submit = htmlentities(trim($_GET['hydrograph_query']), ENT_QUOTES);
$gapfill = htmlentities(trim($_GET['gapfill']), ENT_QUOTES);

foreach ((array) $_GET['site_list'] as $a => $c)
	$site_list[$a] = htmlentities(trim($c), ENT_QUOTES);

foreach ((array) $site_list as $a => $c) {
	$gage_chk_result = mysqli_query($db, "SELECT station_name_web, vertical_datum_id FROM station WHERE station_name_web = '$c' LIMIT 1");
	$gage_chk_row = mysqli_fetch_array($gage_chk_result);
	if (!$gage_chk_row) {
		$gage_chk_warning .= "<h3 style='color:red'>***$c is not a recognized gage. Please select gages from the Site List table.***</h3>\n";
		unset($site_list[$a]);
	}
	if ($gage_chk_row['vertical_datum_id'] == 1 && count($site_list) > 1) {
		$gage_chk_warning .= "<h3 style='color:red'>***$c is surveyed to an arbitrary datum and cannot be displayed along with other gages. Please choose it singly to view.***</h3>\n";
		unset($site_list[$a]);
	}
	if ($gapfill && count($site_list) > 1) {
		$gage_chk_warning .= "<h3 style='color:red'>***Please choose only single gages to view with gapfill predictors.***</h3>\n";
		unset($site_list[$a]);
	}
}
$site_list = array_values((array) $site_list);
if (!$site_list) $site_list = array('3ANE_GW');

$timeseries_start = htmlentities(trim($_GET['timeseries_start']), ENT_QUOTES);
if (!$timeseries_start || !checkdate((int) substr($timeseries_start, 5, 2), (int) substr($timeseries_start, 8, 2), (int) substr($timeseries_start, 0, 4))) $timeseries_start = date('Y-m-d', time() - 365 * 24 * 60 * 60 * 2);
$timeseries_end = htmlentities(trim($_GET['timeseries_end']), ENT_QUOTES);
if (!$timeseries_end || !checkdate((int) substr($timeseries_end,5,2),(int) substr($timeseries_end, 8, 2), (int) substr($timeseries_end, 0, 4))) $timeseries_end = date('Y-m-d');

$water_level = htmlentities(trim($_GET['water_level']), ENT_QUOTES);
$rainfall = htmlentities(trim($_GET['rainfall']), ENT_QUOTES);
$et = htmlentities(trim($_GET['et']), ENT_QUOTES);
if (!$water_level && !$rainfall && !$et) $water_level = 'stage';
$day_hour = htmlentities(trim($_GET['day_hour']), ENT_QUOTES);
if (!$day_hour && $water_level) $day_hour = 'daily'; elseif (!$water_level) unset($day_hour);
$hd = $day_hour == 'daily' ? 'Daily Median Water Level' : 'Hourly Water Levels';

$graph = htmlentities(trim($_GET['graph']), ENT_QUOTES);
$table = htmlentities(trim($_GET['table']), ENT_QUOTES);
if (!$graph && !$table) $graph = 'graph';

$max = htmlentities(trim($_GET['max']), ENT_QUOTES);
if (!$max) $max = 5;
$dry = htmlentities(trim($_GET['dry']), ENT_QUOTES);
if (!$dry) $dry = 'dry';

if ($water_level) {
	$init_query = $data_query = $day_hour == 'daily' ? 'SELECT date' : 'SELECT datetime AS date';
	$tab = $day_hour == 'daily' ? 'stage_daily' : 'stage';
	foreach ((array) $site_list as $c) {
		$conv_result = mysqli_query($db, "SELECT convert_to_navd88_feet AS conv, vertical_conversion, dry_elevation FROM station, station_datum WHERE station.station_id = station_datum.station_id AND station_name_web = '$c'");
		$conv_row = mysqli_fetch_array($conv_result);
		if (!$conv_row['dry_elevation']) $conv_row['dry_elevation'] = -9999;
		$hindcast_check_result = mysqli_query($db, "SELECT MIN(datetime) AS hdate FROM stage WHERE `stage_$c` IS NOT NULL AND `flag_$c` IS NULL");
		$hindcast_check_row = mysqli_fetch_array($hindcast_check_result);
		$data_query .= ", `stage_$c` + {$conv_row['conv']} AS `$c`, ";
		if ($dry == 'dry') $data_query .= $day_hour == 'daily' ? "`flag_$c`" : "CASE WHEN `stage_$c`+{$conv_row['conv']} < {$conv_row['dry_elevation']} THEN 'D' WHEN datetime < '{$hindcast_check_row['hdate']}' THEN 'H' WHEN `flag_$c` IN ('G', 'H', 'L', 'I', 'E') THEN 'E' WHEN `flag_$c` IN ('M', 'S') THEN 'M' ELSE 'O' END AS `flag_$c`";
		else $data_query .= $day_hour == 'daily' ? "`flag_$c`" : "CASE WHEN datetime < '{$hindcast_check_row['hdate']}' THEN 'H' WHEN `flag_$c` IN ('G', 'H', 'L', 'I', 'E') THEN 'E' WHEN `flag_$c` IN ('M', 'S') THEN 'M' ELSE 'O' END AS `flag_$c`";
		if ($gapfill) {
			$gap_result = mysqli_query($db, "SELECT MAX(predictor_rank) AS max FROM station_gapfill, station WHERE station.station_id = station_gapfill.station_id AND station_name_web = '$c'");
			$gap_row = mysqli_fetch_array($gap_result);
			for ($i = 1; $i <= $gap_row['max']; $i++) {
				${"gap_result$i"} = mysqli_query($db, "SELECT b.station_name_web AS predictor, pearson, slope, intercept FROM station AS a, station AS b, station_gapfill WHERE a.station_id = station_gapfill.station_id AND b.station_id = station_gapfill.predictor_station_id AND a.station_name_web = '$c' AND predictor_rank = $i");
				${"gap_row$i"} = mysqli_fetch_array(${"gap_result$i"});
				${"gap_pred_result$i"} = mysqli_query($db, $init_query . ', `stage_' . ${"gap_row$i"}['predictor'] . '` * ' . ${"gap_row$i"}['slope'] . ' + ' . ${"gap_row$i"}['intercept'] . " + {$conv_row['conv']} AS `" . ${"gap_row$i"}['predictor'] . "` FROM $tab HAVING date >= '$timeseries_start' AND date <= '$timeseries_end' ORDER BY date");
				${"gap_pred_num_results$i"} = mysqli_num_rows(${"gap_pred_result$i"});
			}
		}
	}
	$data_result = mysqli_query($db, $data_query . " FROM $tab HAVING date >= '$timeseries_start' AND date <= '$timeseries_end' ORDER BY date");
	$data_num_results = mysqli_num_rows($data_result);
	$prov_file = glob('../data/netcdf/v2/20*prov.zip');
	switch (substr($prov_file[0], 24, 1)) {
		case 1: $mo = '01'; break;
		case 2: $mo = '04'; break;
		case 3: $mo = '07'; break;
		case 4: $mo = '10';
	}
	$prov_start = date(substr($prov_file[0], 18, 4) . '-' . $mo . '-01');
	$rt_file = glob('../data/realtime2/202*_median_flag_v3rt.txt');
	$rt_start = date((substr($rt_file[0], 18, 4)) . '-' . (substr($rt_file[0], 22, 2)) . '-01');
}
if ($rainfall) {
	$rain_query = 'SELECT date';
	foreach ((array) $site_list as $c)
		$rain_query .= ", `rainfall_$c` AS `$c`";
	$rain_result = mysqli_query($db, $rain_query . " FROM rainfall WHERE date >= '$timeseries_start' AND date <= '$timeseries_end' ORDER BY date");
	$rain_num_results = mysqli_num_rows($rain_result);
}
if ($et) {
	$et_query = 'SELECT date';
	foreach ((array) $site_list as $c)
		$et_query .= ", `et_$c` AS `$c`";
	$et_result = mysqli_query($db, $et_query . " FROM et WHERE date >= '$timeseries_start' AND date <= '$timeseries_end' ORDER BY date");
	$et_num_results = mysqli_num_rows($et_result);
}
$arb_datum = array('New_River_at_Sunday_Bay', 'Turner_River_nr_Chokoloskee_Island');
$title = "<title>Explore and View EDEN (EVE) - Everglades Depth Estimation Network (EDEN)</title>\n";
$script = "<script src='../ssi/dygraph-combined.js'></script>\n";
$style = "#graph, #rain_graph, #et_graph, .dygraph-label { font-family: Arial, Helvetica, sans-serif }
    .content {
      float: left;
      clear: both;
      border: 3px solid #4b7e83;
      border-radius: 5px;
      border-top-left-radius: 0px;
      background: #ffffcc;
      padding: 0px 10px 10px;
      width: 420px
    }
    .content table, td, th, .hydrograph_legend table, td, th { border: 0px }
    .menu {
      padding: 0px
    }
    .menu li {
      display: inline
    }
    .menu li a {
      background: #a0c1e7;
      padding: 10px;
      float:left;
      border: 1px solid #4b7e83;
      border-bottom: none;
      border-top-right-radius: 10px 12px;
      border-top-left-radius: 10px 12px;
      margin-bottom: 0px;
      text-decoration: none;
      color: #000;
      font-weight: bold;
      font-family: Arial, Helvetica, sans-serif
    }
    .menu li.active a {
      background: #C4D58D
    }\n";
foreach ((array) $site_list as $a => $c)
	if ($a < $max)
		$style .= "#a$c.content,";
$style = substr($style, 0, -1) . "{
      font-family: Arial, Helvetica, sans-serif;
      font-size: 12px
    }\n";
require ($_SERVER['DOCUMENT_ROOT'] . '/../eden/ssi/eden-head.php');
require_once('../pclzip.lib.php');
echo "<div id='plot_data' style='display:none'>\n";
for ($i = 0; $i < $data_num_results; $i++) {
	$data_row = mysqli_fetch_array($data_result);
	echo $data_row['date'];
	foreach ((array) $site_list as $a => $c)
		if ($a < $max)
			if ($data_row["flag_$c"] == 'O')
				echo ',' . $data_row[$c] . ',,,';
			elseif ($data_row["flag_$c"] == 'E')
				echo ',,' . $data_row[$c] . ',,';
			elseif ($data_row["flag_$c"] == 'H')
				echo ',,,' . $data_row[$c] . ',';
			else
				echo ',,,,' . $data_row[$c];
	if (!$gapfill && count($site_list) == 1 && $data_row[1] && !in_array($site_list[0], $arb_datum))
		if ($data_row[2] == 'O')
			echo ',' . ($data_row[1] - $conv_row['vertical_conversion']) . ',,,';
		elseif ($data_row[2] == 'E')
			echo ',,' . ($data_row[1] - $conv_row['vertical_conversion']) . ',,';
		elseif ($data_row[2] == 'H')
			echo ',,,' . ($data_row[1] - $conv_row['vertical_conversion']) . ',';
		else
			echo ',,,,' . ($data_row[1] - $conv_row['vertical_conversion']);
	if ($gapfill)
		for ($j = 1; $j <= $gap_row['max']; $j++) {
			${"gap_pred_row$j"} = mysqli_fetch_array(${"gap_pred_result$j"});
			echo ',' . ${"gap_pred_row$j"}[${"gap_row$j"}['predictor']];
		}
	echo "\n";
}
echo "</div>
<div id='plot_rain' style='display:none'>\n";
for ($i = 0; $i < $rain_num_results; $i++) {
	$rain_row = mysqli_fetch_array($rain_result);
	echo $rain_row['date'];
	foreach ((array) $site_list as $a => $c)
		if ($a < $max)
			echo ',' . $rain_row[$c];
	if (!$gapfill && count($site_list) == 1 && $data_row[1] && !in_array($site_list[0], $arb_datum))
		echo ',' . ($rain_row[1] * 2.54);
	echo "\n";
}
echo "</div>
<div id='plot_et' style='display:none'>\n";
for ($i = 0; $i < $et_num_results; $i++) {
	$et_row = mysqli_fetch_array($et_result);
	echo $et_row['date'];
	foreach ((array) $site_list as $a => $c)
		if ($a < $max)
			echo ',' . $et_row[$c];
	if(!$gapfill && count($site_list) == 1 && $data_row[1] && !in_array($site_list[0], $arb_datum))
		echo ',' . ($et_row[1] / 10);
	echo "\n";
}
echo "</div>\n$gage_chk_warning";
?>
<h2>Explore and View EDEN (EVE)</h2>
<div style="white-space:nowrap">
  <div class="form_input_field" style="vertical-align:top;display:inline-block">
    <form method="GET" action="index.php">
      <table style="width:150px">
        <tr class="grtablehead">
          <th>Timeseries</th>
        </tr>
        <tr>
          <td class="gtablecell">
            <strong>Start:</strong> <input type="text" name="timeseries_start" value="<?php echo $timeseries_start; ?>" size="10"><br><strong>End:</strong> &nbsp;<input type="text" name="timeseries_end" value="<?php echo $timeseries_end; ?>" size="10">
          </td>
        </tr>
        <tr class="grtablehead">
          <th>Site List</th>
        </tr>
        <tr class="gtablecell2">
          <td style="font-size:75%">Select multiple gages by<br>holding the control (PC)<br>or command (Mac) key.</td>
        </tr>
        <tr>
          <td class="gtablecell">
            <select multiple="multiple" name="site_list[]" size="20">
<?php
$gages = mysqli_query($db, "SELECT station_id, short_name, station_name_web FROM station WHERE display = 1 AND station_name_web != 'Alligator_Creek' AND station_name_web != 'East_Side_Creek' AND station_name_web != 'G-3777' AND station_name_web != 'Manatee_Bay_Creek' AND station_name_web != 'Raulerson_Brothers_Canal' AND station_name_web != 'Barron_River' AND station_name_web != 'TS2' ORDER BY station_name_web");
$num_gages = mysqli_num_rows($gages);
for ($i = 0; $i < $num_gages; $i++) {
	$row = mysqli_fetch_array($gages);
	echo "              <option value='{$row['station_name_web']}'";
	if (in_array($row['station_name_web'], $site_list))
		echo ' selected';
	echo ">{$row['short_name']}</option>\n";
}
?>
            </select></td>
        </tr>
        <tr class="grtablehead">
          <th>Parameters</th>
        </tr>
        <tr>
          <td class="gtablecell">
            <input type="checkbox" name="water_level" value="stage"<?php if ($water_level) echo ' checked'; ?>>Water level<br>&nbsp;&nbsp;<input type="radio" name="day_hour" value="daily"<?php if ($day_hour == 'daily') echo ' checked'; ?>><span style="font-size:75%">Daily median</span><br>&nbsp;&nbsp;<input type="radio" name="day_hour" value="hourly"<?php if ($day_hour == 'hourly') echo ' checked'; ?>><span style="font-size:75%">Hourly</span><br><input type="checkbox" name="rainfall" value="rainfall" <?php if ($rainfall) echo ' checked'; ?>>Rainfall<br><input type="checkbox" name="et" value="et" <?php if ($et) echo ' checked'; ?>>Evapotranspiration</td>
        </tr>
        <tr class="grtablehead">
          <th>Views</th>
        </tr>
        <tr>
          <td class="gtablecell">
            <input type="checkbox" name="graph" value="graph" <?php if ($graph) echo ' checked'; ?>>Graph<br><input type="checkbox" name="table" value="table" <?php if ($table) echo ' checked'; ?>>Table<br>
<?php
if($max) echo "<input type='hidden' name='max' value='$max'>\n";
if($dry) echo "<input type='hidden' name='dry' value='$dry'>\n";
if($gapfill) echo "<input type='hidden' name='gapfill' value='$gapfill'>\n";
?>
          </td>
        </tr>
        <tr>
          <td class="gtablecell2"><input name="hydrograph_query" type="submit" value="Update Selection" style="font-size:18px;font-family:arial,helvetica,sans-serif"></td>
        </tr>
      </table>
    </form>
    <div style='width:140px;margin-top:10px;text-align:center;font-family:Arial,Helvetica,sans-serif;background:#ffffcc;padding:10px;border:solid #4b7e83;border-radius:5px'><strong><a href='mailto:bmccloskey@usgs.gov'>Send feedback<br>about EVE</a></strong></div>
  </div>
  <div style='display:inline-block;width:80%;margin-left:10px'>
<?php
$dir = 'eve_data';
if ($handle = opendir($dir)) {
	while (false !== ($file = readdir($handle)))
	if ($file != '.' && $file != '..' && !strstr($file, 'Data_Download_Readme.txt'))
		unlink($dir . '/' . $file);
	closedir($handle);
}
$time = time();
$archive = new PclZip("eve_data/$time.zip");
$ziplist = array('eve_data/Data_Download_Readme.txt');
$header = 'Date of data download: ' . date('Y-m-d') . "\n\nThese data have been downloaded from the Everglades Depth Estimation Network (EDEN) database through the Explore and View EDEN (EVE) web application. The attached README file provides a brief description of the data. For additional info about EDEN: http://sofia.usgs.gov/eden\n\n";
if ($water_level) {
	$file = $day_hour == 'daily' ? 'Date' : 'Hour';
	foreach ((array) $site_list as $c) {
		$file .= $day_hour == 'daily' ? ",$c Daily median water Level" : ",$c Hourly water Level";
		$file .= in_array($c, $arb_datum) ? '(feet, arbitrary datum)' : '(feet NAVD88)';
		$file .= ",$c Water level data type (O=observed; E=estimated; H=hindcasted; D=dry; M=missing)";
	}
	$file .= ",Water level quality flag (F=final; P=provisional; R=real-time)\n";
	if ($data_num_results >= 1) mysqli_data_seek($data_result, 0);
	for ($i = 0; $i < $data_num_results; $i++) {
		$data_row = mysqli_fetch_assoc($data_result);
		if(date($data_row['date']) >= $rt_start)
			$rpf = 'R';
		elseif(date($data_row['date']) >= $prov_start)
			$rpf = 'P';
		else
			$rpf = 'F';
		$file .= $data_row['date'];
		foreach ($site_list as $c)
			$file .= !is_null($data_row[$c]) ? ',' . round($data_row[$c], 2) . ',' . $data_row["flag_$c"] : ',,' . $data_row["flag_$c"];
		$file .= ",$rpf\n";
	}
	$fp = fopen("eve_data/{$time}_water_level.csv", 'w');
	fwrite($fp, $header.$file);
	fclose($fp);
	$ziplist[] .= "eve_data/{$time}_water_level.csv";
}
if ($rainfall) {
	$file = 'Date';
	foreach ((array) $site_list as $c)
		$file .= ",$c Rainfall (inches)";
	$file .= "\n";
	if ($rain_num_results >= 1) mysqli_data_seek($rain_result, 0);
	for ($i = 0; $i < $rain_num_results; $i++) {
		$rain_row = mysqli_fetch_assoc($rain_result);
		$file .= $rain_row['date'];
		foreach ($site_list as $c)
			$file .= ",$rain_row[$c]";
		$file .= "\n";
	}
	$fp = fopen("eve_data/{$time}_rainfall.csv", 'w');
	fwrite($fp, $header . $file);
	fclose($fp);
	$ziplist[] .= "eve_data/{$time}_rainfall.csv";
}
if ($et) {
	$file = 'Date';
	foreach ((array) $site_list as $c)
		$file .= ",$c Potential evapotranspiration (millimeters)";
	$file .= "\n";
	if ($et_num_results >= 1) mysqli_data_seek($et_result, 0);
	for ($i = 0; $i < $et_num_results; $i++) {
		$et_row = mysqli_fetch_assoc($et_result);
		$file .= $et_row['date'];
		foreach ($site_list as $c)
			$file .= ',' . round($et_row[$c], 2);
		$file .= "\n";
	}
	$fp = fopen("eve_data/{$time}_et.csv", 'w');
	fwrite($fp, $header . $file);
	fclose($fp);
	$ziplist[] .= "eve_data/{$time}_et.csv";
}
$v_list = $archive -> create($ziplist, PCLZIP_OPT_REMOVE_PATH, '/export1/htdocs');
if ($v_list == 0)
	die('Error : ' . $archive -> errorInfo(true));
echo "<div style='float:right;background:#ffffcc;padding:10px;border:solid #4b7e83;border-radius:5px'><h2><a href='eve_data/$time.zip'>Download selected data</a></h2></div>\n";
if(count($site_list) > $max)
	echo "<p style='color:red'>***Only the first $max selected gages plotted; all selected gages included for tables and downloading.***</p>";
echo "<div style='clear:both'><ul id='menu' class='menu'>\n";
foreach ((array) $site_list as $a => $c)
	if ($a == 0)
		echo "<li class='active'><a href='#a$c'>" . substr($c, 0, 15) . "</a></li>\n";
	elseif ($a < $max)
		echo "<li><a href='#a$c'>" . substr($c, 0, 15) . "</a></li>\n";
echo "</ul>\n";
foreach ((array) $site_list as $a => $c) {
	if ($a < $max) {
		$stn_result = mysqli_query($db, "SELECT *, agency.agency_acronym AS operating_agency FROM station, station_data, station_datum, agency, vertical_datum WHERE station.station_id = station_data.station_id AND station.station_id = station_datum.station_id AND station.operating_agency_id = agency.agency_id AND station.vertical_datum_id = vertical_datum.vertical_datum_id AND station_name_web = '$c'");
		$stn_row = mysqli_fetch_array($stn_result);
		$wl_range_result = mysqli_query($db, "SELECT DATE(MIN(datetime)) AS min, DATE(MAX(datetime)) AS max FROM stage WHERE `stage_$c` IS NOT NULL AND `flag_$c` IS NULL");
		$wl_range_row = mysqli_fetch_array($wl_range_result);
		$rf_range_result = mysqli_query($db, "SELECT MIN(date) AS min, MAX(date) AS max FROM rainfall WHERE `rainfall_$c` IS NOT NULL");
		$rf_range_row = mysqli_fetch_array($rf_range_result);
		$et_range_result = mysqli_query($db, "SELECT MIN(date) AS min, MAX(date) AS max FROM et WHERE `et_$c` IS NOT NULL");
		$et_range_row = mysqli_fetch_array($et_range_result);
		echo "<div id='a$c' class='content'>
  <p>Go to <abbr title='Everglades Depth Estimation Network'>EDEN</abbr> station page for <a href='../station.php?stn_name=$c'>{$stn_row['station_name_web']}</a></p>
  <p><strong><a href='../explanation.php#opagency'>Operating Agency</a>:</strong> <abbr title='{$stn_row['agency_name']}'>{$stn_row['operating_agency']}</abbr> (<a href='javascript:Popup(\"popup.php?popup={$stn_row['operating_agency']}\")'>Agency <abbr title='point of contact'>POC</abbr></a>)</p>\n";
		echo $stn_row['vertical_conversion'] ? "<p><strong><a href='../explanation.php#gagedataref'>Vertical Conversion at Gage (feet) used by <abbr title='Everglades Depth Estimation Network'>EDEN</abbr><br />(<abbr title='National Geodetic Vertical Datum of 1929'>NGVD29</abbr> to <abbr title='North American Vertical Datum of 1988'>NAVD88</abbr>)</a>:</strong> {$stn_row['vertical_conversion']} ft.</p>\n"
		: "<p><strong>Gage surveyed to arbitrary datum.</strong></p>\n";
		echo "<table style='border:0px'>
  <tr><th class='gtablehead'>Available <abbr title='Everglades Depth Estimation Network'>EDEN</abbr> data</th><th class='gtablehead'>Period of record</th></tr>
  <tr><td class='gtablecell2'>Water Level (measured)</td><td class='gtablecell2'>{$wl_range_row['min']} &mdash; {$wl_range_row['max']}</td></tr>
  <tr><td class='gtablecell2'>Rainfall</td><td class='gtablecell2'>{$rf_range_row['min']} &mdash; {$rf_range_row['max']}</td></tr>
  <tr><td class='gtablecell2'>Evapotranspiration</td><td class='gtablecell2'>{$et_range_row['min']} &mdash; {$et_range_row['max']}</td></tr>
</table>\n";
		if ($stn_row['station_name_web'] == 'TSB')
			echo "<p>Go to <a href='javascript:Popup(\"popup.php?popup={$stn_row['operating_agency']}\")'><abbr title='{$stn_row['agency_name']}'>{$stn_row['operating_agency']}</abbr></a> for complete datasets for this gage<br /><strong>Note:</strong> Nearby gage <a href='/../eden/station.php?stn_name=TS2'>TS2</a> was used before being discontinued in<br>2005; the merged TS2/TSB record is presented here</p></div>\n";
		else if ($stn_row['operating_agency'] == 'ENP')
			echo "<p>Go to <a href='javascript:Popup(\"popup.php?popup={$stn_row['operating_agency']}\")'><abbr title='{$stn_row['agency_name']}'>{$stn_row['operating_agency']}</abbr></a> for complete datasets for this gage</p></div>\n";
		else if (!$stn_row['other_databases'])
			echo "<p>Go to <a href='javascript:Popup(\"popup.php?popup=Anderson\")'><abbr title='{$stn_row['agency_name']}'>{$stn_row['operating_agency']}</abbr> (<abbr title='Florida'>FL</abbr> <abbr title='Southeast Ecological Science Center'>SESC</abbr>)</a> for complete datasets for this gage</p></div>\n";
		else if ($stn_row['station_name_web'] == 'MO-214' || $stn_row['station_name_web'] == 'MO-215' || $stn_row['station_name_web'] == 'MO-216')
			echo "<p>For complete datasets for this gage, go to:<br /><a href='{$stn_row['other_databases']}'><abbr title='{$stn_row['agency_name']}'>{$stn_row['operating_agency']}</abbr> (<abbr title='Florida'>FL</abbr> <abbr title='Water Science Center'>WSC</abbr>)</a> (<abbr title='November'>Nov.</abbr> 2012&mdash;present)<br /><a href='javascript:Popup(\"popup.php?popup=Anderson\")'><abbr title='{$stn_row['agency_name']}'>{$stn_row['operating_agency']}</abbr> (<abbr title='Florida'>FL</abbr> <abbr title='Southeast Ecological Science Center'>SESC</abbr>)</a> (1996&mdash;<abbr title='October'>Oct.</abbr> 2012)</p></div>\n";
		else if ($stn_row['station_name_web'] == 'S150_T')
			echo "<p>For complete datasets for this gage, go to:<br /><a href='{$stn_row['other_databases']}'><abbr title='{$stn_row['agency_name']}'>{$stn_row['operating_agency']}</abbr></a> (<abbr title='October'>Oct.</abbr> 2004&mdash;present)<br /><a href='http://waterdata.usgs.gov/fl/nwis/nwisman/?site_no=262007080321500&agency_cd=USGS'><abbr title='US Geological Survey'>USGS</abbr></a> (1990&mdash;<abbr title='September'>Sep.</abbr> 2004)</p></div>\n";
		else
			echo "<p>Go to <a href='{$stn_row['other_databases']}'><abbr title='{$stn_row['agency_name']}'>{$stn_row['operating_agency']}</abbr></a> for complete datasets for this gage</p></div>\n";
	}
}
if ($graph) {
	echo "<div id='hydrograph_legend' style='border:solid #4b7e83;border-radius:5px;width:240px;padding:3px;float:right;margin-bottom:25px;clear:both'>
<table style='width:100%;border:0px'>
  <tr><th class='gtablehead' style='background:#ccd' colspan='2'>Legend</th></tr>\n";
	$colors = array("#000080", "#FFA500", "#800000", "#008000", "#000000", "#00FFA5", "#A500FF", "#FF00A5", "#00A5FF", "#A5FF00");
	foreach ((array) $site_list as $a => $c)
		if($a < $max && count($site_list) != 1)
			echo "<tr><td class='gtablecell'><hr style='margin-left:0px;color:{$colors[$a % count($colors)]};background-color:{$colors[$a % count($colors)]};height:3px;width:50px'></td><td class='gtablecell' style='padding-left:5px'>" . substr($c, 0, 15) . "</td></tr>\n";
	if ($water_level) echo "<tr><td class='gtablecell'><img src='images/image01.png' alt='solid line'></td><td class='gtablecell' style='padding-left:5px'>Observed data</td></tr>
  <tr><td class='gtablecell'><img src='images/image05.png' alt='dashed line'></td><td class='gtablecell' style='padding-left:5px'>Estimated data</td></tr>
  <tr><td class='gtablecell'><img src='images/image06.png' alt='dot-dash line'></td><td class='gtablecell' style='padding-left:5px'>Hindcasted data</td></tr>
  <tr><td class='gtablecell'><img src='images/image04.png' alt='dotted line'></td><td class='gtablecell' style='padding-left:5px'>Dry conditions</td></tr>\n";
	if ($water_level && $conv_row['dry_elevation'] != -9999 && count($site_list) == 1) echo "<tr><td class='gtablecell'><hr style='margin-left:0px;color:gray;background-color:gray;height:3px;width:50px'></td><td class='gtablecell' style='padding-left:5px'><a href='../station.php?stn_name={$site_list[0]}#vegetation'><abbr title='minimum'>Min.</abbr> ground <abbr title='elevation'>ele.</abbr></a><br>({$conv_row['dry_elevation']} <abbr title='feet North American Vertical Datum of 1988'>ft. NAVD88</abbr>)</td></tr>\n";
	if ($water_level && $gapfill)
		for ($i = 1; $i <= $gap_row['max']; $i++)
			echo "<tr><td class='gtablecell'><hr style='margin-left:0px;color:$colors[$i];background-color:$colors[$i];height:3px;width:50px'></td><td class='gtablecell' style='padding-left:5px'>" . ${"gap_row$i"}['predictor'] . " (pred $i)</td></tr>\n";
	if ($water_level) echo "<tr><td colspan='2' class='gtablecell' style='font-size:75%'><hr>Recent water levels subject to<br>revision. Non-final data are either<br><span style='background:#ffffa5'>real-time</span> or <span style='background:#cecee5'>provisional</span>.</td></tr>\n";
	echo "</table>
</div></div>
<div id='graph' style='border:2px solid;height:500px;width:100%;clear:right";
	if (!$water_level) echo ';display:none';
	echo "'></div>
            <div id='rain_graph' style='border:2px solid;height:100px;width:100%;margin-top:5px;clear:right";
	if (!$rainfall) echo ';display:none';
	echo "'></div>
            <div id='et_graph' style='border:2px solid;height:100px;width:100%;margin-top:5px;clear:right";
	if (!$et) echo ';display:none';
	echo "'></div>
            <p style='font-size:75%'>Tips: Mouse over plot for interactive data point values. Click and drag in the plot to zoom either dimension. Double-click to reset<br />zoom to full selected period; shift-click and drag to pan in the zoomed-in view.</p>\n";
}
if ($table && (count($site_list) == 1)) {
	$colspan = 1;
	if ($water_level) $colspan += 2;	
	if ($rainfall) $colspan += 1;	
	if ($et) $colspan += 1;	
	if ($gapfill) $colspan += $gap_row['max'];	
	echo "<div style='text-align:center;margin-top:20px;float:left'>
<table>
  <tr>
    <th colspan='$colspan' class='tablehead' style='background-color:#976e5c;color:white'>Table of Selected $site_list[0] Parameters for $timeseries_start&mdash;$timeseries_end</th>
  </tr>\n";
	if ($water_level) echo "<tr><td colspan='$colspan'><p>Recent water levels subject to revision. Non-final data are either <span style='background:#ffffa5'>real-time</span> or <span style='background:#cecee5'>provisional</span>.<br>Daily water levels are medians computed from hourly water levels.</p><p>Data type flags: O = \"Observed\", E = \"Estimated\", H = \"Hindcasted\", D = \"Dry\", M = \"Missing\"</p></td></tr>\n";
	echo "<tr><td class='tablehead'>Date</td>\n";
	if ($water_level) {
		echo "<td class='tablehead'>Water Level<br>";
		echo in_array($site_list[0], $arb_datum) ? '(feet, arbitrary datum)' : '(feet NAVD88)';
		echo "</td>\n<td class='tablehead'>Water Level<br>Data Type Flag</td>\n";
		if($gapfill)
			for ($j = 1; $j <= $gap_row['max']; $j++)
				echo "<td class='tablehead'>" . ${"gap_row$j"}['predictor'] . "</td>\n";
	}
	if ($rainfall) echo "<td class='tablehead'>Rainfall (in.)</td>\n";
	if ($et) echo "<td class='tablehead'>Evapotranspiration<br>(mm)</td>\n";
	echo "</tr>\n";
	if ($data_num_results >= 1) mysqli_data_seek($data_result, 0);
	if ($rain_num_results >= 1) mysqli_data_seek($rain_result, 0);
	if ($et_num_results >= 1) mysqli_data_seek($et_result, 0);
	if ($gapfill)
		for ($j = 1; $j <= $gap_row['max']; $j++)
			if(mysqli_num_rows(${"gap_pred_result$j"}) >= 1) mysqli_data_seek(${"gap_pred_result$j"}, 0);
	for ($i = 0; $i < max($data_num_results, $rain_num_results, $et_num_results); $i++) {
		$data_row = mysqli_fetch_array($data_result);
		if (!$water_level || $day_hour == 'daily' || ($day_hour == 'hourly' && $i % 24 == 0))
			$rain_row = $rain_num_results > $i % 24 ? mysqli_fetch_array($rain_result) : NULL;
		else $rain_row[$site_list[0]] = NULL;
		if (!$water_level || $day_hour == 'daily' || ($day_hour == 'hourly' && $i % 24 == 0))
			$et_row = $et_num_results > $i % 24 ? mysqli_fetch_array($et_result) : NULL;
		else $et_row[$site_list[0]] = NULL;
		if ($gapfill)
			for ($j = 1; $j <= $gap_row['max']; $j++)
				${"gap_pred_row$j"} = mysqli_fetch_array(${"gap_pred_result$j"});
		if ($data_row['date'] && date($data_row['date']) >= $rt_start)
			$col = '#ffffa5';
		elseif ($data_row['date'] && date($data_row['date']) >= $prov_start)
			$col = '#cecee5';
		else
			$col = 'white';
		echo "<tr><td style='background-color:$col' class='tablehead'>";
		if ($water_level) echo $data_row['date'];
		elseif ($rainfall) echo $rain_row['date'];
		elseif ($et) echo $et_row['date'];
		echo "</td>\n";
		if ($water_level) {
			echo "<td style='background-color:$col' class='tablecell'>";
			echo !is_null($data_row[$site_list[0]]) ? round($data_row[$site_list[0]], 2) . "</td>\n" : "&nbsp;</td>\n";
			echo "<td style='background-color:$col' class='tablecell'>{$data_row["flag_$site_list[0]"]}</td>";
			if ($gapfill)
				for ($j = 1; $j <= $gap_row['max']; $j++) {
					echo "<td style='background-color:$col' class='tablecell'>";
					echo !is_null(${"gap_pred_row$j"}[${"gap_row$j"}['predictor']]) ? round(${"gap_pred_row$j"}[${"gap_row$j"}['predictor']], 2) . "</td>\n" : "&nbsp;</td>\n";
				}
		}
		if ($rainfall) {
			echo "<td class='tablecell'>";
			echo !is_null($rain_row[$site_list[0]]) ? round($rain_row[$site_list[0]], 2) . "</td>\n" : "&nbsp;</td>\n";
		}
		if ($et) {
			echo "<td class='tablecell'>";
			echo !is_null($et_row[$site_list[0]]) ? round($et_row[$site_list[0]], 2) . "</td>\n" : "&nbsp;</td>\n";
		}
		echo "</tr>\n";
	}
	echo"</table>\n";
}
if ($table && (count($site_list) != 1)) {
	echo "<div style='text-align:center;margin-top:20px;float:left'>
<table style='margin-bottom:20px";
	if (!$water_level) echo ";display:none";
	echo "'>
  <tr>
    <th colspan='" . (count($site_list) * 2 + 1) . "' class='tablehead' style='background-color:#976e5c;color:white'>Table of $hd (ft. NAVD88) for $timeseries_start&mdash;$timeseries_end</th>
  </tr>
  <tr>
    <td colspan='" . (count($site_list) * 2 + 1) . "'>
      <p>Recent water levels subject to revision. Non-final data are either <span style='background: #ffffa5'>real-time</span> or <span style='background: #cecee5'>provisional</span>.</p>
        <p>Data type (DT) flags: O = \"Observed\", E = \"Estimated\", H = \"Hindcasted\", D = \"Dry\", M = \"Missing\"</p></td></tr>
  <tr>
    <td class='tablehead'>Date</td>\n";
	foreach ((array) $site_list as $a => $c)
		echo "<td class='tablehead'>$c</td><td class='tablehead'><abbr title='Data Type'>DT</abbr></td>\n";
	echo "</tr>\n";
	if ($data_num_results >= 1) mysqli_data_seek($data_result, 0);
	for ($i = 0; $i < $data_num_results; $i++) {
		$data_row = mysqli_fetch_array($data_result);
		if(date($data_row['date']) >= $rt_start)
			$col = '#ffffa5';
		elseif(date($data_row['date']) >= $prov_start)
			$col = '#cecee5';
		else
			$col = 'white';
		echo "<tr>
    <td style='background-color:$col' class='tablehead'>{$data_row['date']}</td>\n";
		foreach ((array) $site_list as $a => $c) {
			echo "<td style='background-color:$col' class='tablecell'>";
			echo !is_null($data_row[$c]) ? round($data_row[$c], 2) . "</td>\n" : "&nbsp;</td>\n";
			echo "<td style='background-color:$col' class='tablecell'>{$data_row["flag_$site_list[$a]"]}</td>";
		}
		echo "</tr>\n";
	}
	echo"</table>
<table style='margin-bottom:20px";
	if (!$rainfall) echo ";display:none";
	echo "'>
  <tr>
    <th colspan='" . (count($site_list) + 1) . "' class='tablehead' style='background-color:#976e5c;color:white'>Table of Total Daily Rainfall (in.) for $timeseries_start&mdash;$timeseries_end</th>
  </tr>
  <tr>
    <td class='tablehead'>Date</td>\n";
	foreach ((array) $site_list as $a => $c)
		echo "<td class='tablehead'>$c</td>\n";
	echo "</tr>\n";
	if ($rain_num_results >= 1) mysqli_data_seek($rain_result, 0);
	for ($i = 0; $i < $rain_num_results; $i++) {
		$rain_row = mysqli_fetch_array($rain_result);
		echo "<tr>
  <td class='tablehead'>{$rain_row['date']}</td>\n";
		foreach ((array) $site_list as $c) {
			echo "<td class='tablecell'>";
			echo !is_null($rain_row[$c]) ? round($rain_row[$c], 2) . "</td>\n" : "&nbsp;</td>\n";
		}
		echo "</tr>\n";
	}
	echo "</table>
<table style='margin-bottom:20px";
	if (!$et) echo ";display:none";
	echo "'>
  <tr>
    <th colspan='" . (count($site_list) + 1) . "' class='tablehead' style='background-color:#976e5c;color:white'>Table of Total Daily Potential Evapotranspiration (mm) for $timeseries_start&mdash;$timeseries_end</th>
  </tr>
  <tr>
    <td class='tablehead'>Date</td>\n";
	foreach ((array) $site_list as $a => $c)
		echo "<td class='tablehead'>$c</td>\n";
	echo "</tr>\n";
	if ($et_num_results >= 1) mysqli_data_seek($et_result, 0);
	for ($i = 0; $i < $et_num_results; $i++) {
		$et_row = mysqli_fetch_array($et_result);
		echo "<tr>
    <td class='tablehead'>{$et_row['date']}</td>\n";
		foreach ((array) $site_list as $c) {
			echo "<td class='tablecell'>";
			echo !is_null($et_row[$c]) ? round($et_row[$c], 2) . "</td>\n" : "&nbsp;</td>\n";
		}
		echo "</tr>\n";
	}
	echo"</table>
</div>\n";
}
?>
    <script>
var stile = 'width=350, height=100, status=no, menubar=no, toolbar=no scrollbars=1';
function Popup(apri) {
  New = window.open(apri, '', stile);
  New.moveTo(300,300);
}

var color_base = [<?php foreach ((array) $site_list as $a => $c) echo (count($site_list) == 1 || $a == 0) ? "'$colors[0]'," : "'{$colors[$a % count($colors)]}',"; ?>];

function hex2rgb(hx) {
  var re = /^#(\w{2})(\w{2})(\w{2})$/;
  var bits = re.exec(hx);
  if (bits) {
    var r = parseInt(bits[1], 16);
    var g = parseInt(bits[2], 16);
    var b = parseInt(bits[3], 16);

    return {"r":r, "g":g, "b":b};
  } else {
    return null;
  }
}
    
function soften(hx, alpha) {
  var rgb = hex2rgb(hx);

  return "rgba("+rgb.r+","+ rgb.g+","+ rgb.b+","+ alpha+")";
}

var colors3 = []; // used to differentiate dry, estimated, etc. -- BJM
var i;
for (i = 0; i < color_base.length; i++) {
  // copy in triplicate to account for 3 lines per gage
  colors3.push(color_base[i]);
  // Soften color for next two entries to distinguish from observed data
  colors3.push(soften(color_base[i], 0.33));  
  colors3.push(soften(color_base[i], 0.33));  
  colors3.push(soften(color_base[i], 0.5));
}
<?php
if ($gapfill)
	for ($j = 1; $j <= $gap_row['max']; $j++)
		echo "colors3.push('$colors[$j]');\n";
?>

var seriesOptions = { <?php
if (!$gapfill && count($site_list) == 1 && !in_array($site_list[0], $arb_datum))
	echo "'$site_list[0] est ft. NAVD88':{ strokePattern: Dygraph.DASHED_LINE },'$site_list[0] hnd ft. NAVD88':{ strokePattern: Dygraph.DOT_DASH_LINE },'$site_list[0] dry ft. NAVD88':{ strokePattern: Dygraph.DOTTED_LINE },'ft. NGVD29': { axis: 'y2', strokeWidth: 0, pointSize: 0, highlightCircleSize: 0 }, 'est ft. NGVD29': { axis: 'y2', strokeWidth: 0, pointSize: 0, highlightCircleSize: 0 }, 'hnd ft. NGVD29': { axis: 'y2', strokeWidth: 0, pointSize: 0, highlightCircleSize: 0 }, 'dry ft. NGVD29': { axis: 'y2', strokeWidth: 0, pointSize: 0, highlightCircleSize: 0 }, ";
else foreach ((array) $site_list as $a => $c) echo "'{$c} est':{ strokePattern: Dygraph.DASHED_LINE },'{$c} hnd':{ strokePattern: Dygraph.DOT_DASH_LINE },'{$c} dry':{ strokePattern: Dygraph.DOTTED_LINE }, ";
?> 'datetime': {} }
;
var seriesOptions2 = { <?php
if (!$gapfill && count($site_list) == 1 && !in_array($site_list[0], $arb_datum))
	echo "'cm': { axis: 'y2', strokeWidth: 0, pointSize: 0, highlightCircleSize: 0, fillGraph: false }, ";
foreach ((array) $site_list as $a => $c) echo "'{$c}':{ fillGraph: true }, ";
?> 'datetime': {} }
;
var dryElevation = <?php echo ($water_level && $conv_row['dry_elevation'] != -9999 && count($site_list) == 1) ? $conv_row['dry_elevation'] : 'null'; ?>;

var plot_data = document.getElementById("plot_data").textContent;
var plot_rain = document.getElementById("plot_rain").textContent;
var plot_et = document.getElementById("plot_et").textContent;

var labs = ['date'<?php
if (!$gapfill && count($site_list) == 1 && !in_array($site_list[0], $arb_datum))
	echo ",'$site_list[0] ft. NAVD88','$site_list[0] est ft. NAVD88','$site_list[0] hnd ft. NAVD88','$site_list[0] dry ft. NAVD88','ft. NGVD29','est ft. NGVD29','hnd ft. NGVD29','dry ft. NGVD29'";
else
	foreach ((array) $site_list as $c)
		echo ",'" . substr($c, 0, 15) . "','" . substr($c, 0, 15) . " est','" . substr($c, 0, 15) . " hnd','" . substr($c, 0, 15) . " dry'";
if ($gapfill) for ($j = 1; $j <= $gap_row['max']; $j++) echo ",'" . ${"gap_row$j"}['predictor'] . " pred$j'";
echo "];
var labs2 = ['date'\n";
if (!$gapfill && count($site_list) == 1 && !in_array($site_list[0], $arb_datum))
	echo ",'$site_list[0]','cm'";
else
	foreach ((array) $site_list as $c)
		echo ",'" . substr($c, 0, 15) . "'";
echo "];\n";
if ($water_level) {
	echo "var g2 = new Dygraph(
           document.getElementById('graph'),
           plot_data,
           {
            labels: labs,
            colors: colors3,
            series: seriesOptions,\n";
	echo in_array($site_list[0], $arb_datum) ? "ylabel: 'Feet (arbitrary datum)',\n" : "ylabel: 'Feet (NAVD88)',\n";
	echo (!$gapfill && count($site_list) == 1 && !in_array($site_list[0], $arb_datum)) ? "y2label: 'Feet (NGVD29)',
			labelsDivWidth: 581,\n" : "labelsDivWidth: 637,\n";
	echo "labelsDivStyles: {
              'font-family': 'arial,helvetica,sans-serif'
            },
			underlayCallback: function(canvas, area, g2) {
              var bottom_left = g2.toDomCoords(Date.parse( '$rt_start' ), -20);
              var top_right = g2.toDomCoords(Date.parse( '" . date('Y/m/d') . "' ), +20);
              var left = bottom_left[0];
              var right = top_right[0];

              canvas.fillStyle = 'rgba(255, 255, 166, 1.0)';
              canvas.fillRect(left, area.y, right - left, area.h);

              var bottom_left2 = g2.toDomCoords(Date.parse( '$prov_start' ), -20);
              var top_right2 = g2.toDomCoords(Date.parse( '$rt_start' ), +20);
              var left2 = bottom_left2[0];
              var right2 = top_right2[0];

              canvas.fillStyle = 'rgba(207, 207, 230, 1.0)';
              canvas.fillRect(left2, area.y, right2 - left2, area.h);
              if (dryElevation != null) {
                var top_right = g2.toDomCoords(0, dryElevation);

                var top = top_right[1];

                canvas.fillStyle = 'rgba(128, 128, 128, 0.5)';
                canvas.fillRect(area.x, top, area.w, 4);
              }
            },
            strokeWidth: 2.0,
            pointSize: 2,
            highlightCircleSize: 4,
            yRangePad: 10,
            dateWindow: [ Date.parse( '" . substr($timeseries_start, 0, 4) . '/' . substr($timeseries_start, 5, 2) . '/' . substr($timeseries_start, 8, 2) . "' ),
                          Date.parse( '" . substr($timeseries_end, 0, 4) . '/' . substr($timeseries_end, 5, 2) . '/' . substr($timeseries_end, 8, 2) . "' )
                         ],
            
            showRangeSelector: true,
            rangeSelectorPlotFillColor: '#D7E1F4',
            interactionModel: Dygraph.defaultInteractionModel,
            animatedZooms: true,
            title: '$hd',
            drawPoints: true   // Look, no trailing comma; make IE happy.
           }          // options
         );
         annotations = [];
         annotations.push( {
          series: labs[1],
          x: '" . date('Y/m/d', strtotime($prov_start . '+ 135 days')) . "',
          shortText: 'Provisional',
          text: 'Provisional',
          width: 70,
          tickHeight: 0,
          attachAtBottom: true
        } );
         annotations.push( {
          series: labs[1],
          x: '" . date('Y/m/d', strtotime($rt_start . '+ 35 days')) . "',
          shortText: 'Real-Time',
          text: 'Real-Time',
          width: 80,
          tickHeight: 0,
          attachAtBottom: true
        } );
         g2.setAnnotations(annotations);\n";
}
if ($rainfall) {
	echo "var g3 = new Dygraph(
           document.getElementById('rain_graph'),
           plot_rain,
           {
            ylabel: 'in.',\n";
	if(!$gapfill && count($site_list)==1 && !in_array($site_list[0], $arb_datum))
		echo "y2label: 'cm',\n";
	echo "labels: labs2,
            labelsDivStyles: {
              'font-family': 'arial,helvetica,sans-serif'
            },
            strokeWidth: 1.0,
            colors: color_base,
            series: seriesOptions2,
            dateWindow: [ Date.parse( '" . substr($timeseries_start, 0, 4) . '/' . substr($timeseries_start, 5, 2) . '/' . substr($timeseries_start, 8, 2) . "' ),
                          Date.parse( '" . substr($timeseries_end, 0, 4) . '/' . substr($timeseries_end, 5, 2) . '/' . substr($timeseries_end, 8, 2) . "' )
                         ],
            labelsDivWidth: 637,
            title: 'Total Daily Rainfall',
            stepPlot: true,
            drawXAxis: false,
            drawPoints: false   // Look, no trailing comma; make IE happy.
           }          // options
         );\n";
}
if ($et) {
	echo "var g4 = new Dygraph(
           document.getElementById('et_graph'),
           plot_et,
           {
            ylabel: 'mm',\n";
	if (!$gapfill && count($site_list) == 1 && !in_array($site_list[0], $arb_datum))
		echo "y2label: 'cm',\n";
	echo "labels: labs2,
            labelsDivStyles: {
              'font-family': 'arial,helvetica,sans-serif'
            },
            strokeWidth: 1.0,
            colors: color_base,
            series: seriesOptions2,
            dateWindow: [ Date.parse( '" . substr($timeseries_start, 0, 4) . '/' . substr($timeseries_start, 5, 2) . '/' . substr($timeseries_start, 8, 2) . "' ),
                          Date.parse( '" . substr($timeseries_end, 0, 4) . '/' . substr($timeseries_end, 5, 2) . '/' . substr($timeseries_end, 8, 2) . "' )
                         ],
            labelsDivWidth: 637,
            title: 'Total Daily Potential Evapotranspiration',
            drawXAxis: false,
            drawPoints: false   // Look, no trailing comma; make IE happy.
           }          // options
         );\n";
}
?>
    </script>
  </div>
</div>
<script src="../ssi/jquery.js"></script>
<script src="../ssi/jquery.tabify.js"></script>
<script>
// <![CDATA[
$(document).ready(function () {$('#menu').tabify();});
// ]]>
</script>
<?php require ($_SERVER['DOCUMENT_ROOT'] . '/../eden/ssi/eden-foot.php'); ?>