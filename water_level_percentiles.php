<?php
require ($_SERVER['DOCUMENT_ROOT'] . '/eden/ssi/login.php');
mysql_select_db('eden_new');

$type = htmlentities(trim($_GET['type']), ENT_QUOTES);
$name = htmlentities(trim($_GET['name']), ENT_QUOTES);

if ($type == 'gage') {
	$type_long = "<abbr title='Everglades Depth Estimation Network'>EDEN</abbr> Station Name";
	$result = mysql_query("SELECT station_name_web AS name, latitude, longitude, average_elevation AS elevation, location_shortname AS basin, vertical_conversion AS conversion FROM station, location, station_vegetation, station_datum WHERE station.station_id = station_vegetation.station_id AND station_vegetation.community_level_id = 1 AND station.location_id = location.location_id AND station.station_id = station_datum.station_id AND ertp_ge_flag IS NOT NULL AND station_name_web = '$name'");
	$row = mysql_fetch_array($result);
	if (!$row) { //graphs for non-ERTP gages on CSSS app -- no elevation
		$result = mysql_query("SELECT station_name_web AS name, latitude, longitude, location_shortname AS basin, vertical_conversion AS conversion FROM station, location, station_datum WHERE station.location_id = location.location_id AND station.station_id = station_datum.station_id AND station_name_web = '$name'");
		$row = mysql_fetch_array($result);
		$row['elevation'] = 'NA';
	}
}
else {
	$type_long = "Tree Island <abbr title='identification'>ID</abbr>";
	$result = mysql_query("SELECT island AS name, latitude AS dec_latitude, longitude AS dec_longitude, basin, elevation, conversion FROM tree_islands WHERE island = '$name'");
	$row = mysql_fetch_array($result);
}
if ($type == 'treeisland') {
	$row['latitude'] = substr($row['dec_latitude'], 0, 2) . ',' . substr(substr($row['dec_latitude'], 2) * 60, 0, 2) . ',' . substr(substr($row['dec_latitude'], 2) * 60, 2) * 60;
	$row['longitude'] = substr($row['dec_longitude'], 0, 2) . ',' . substr(substr($row['dec_longitude'], 2) * 60, 0, 2) . ',' . substr(substr($row['dec_longitude'], 2) * 60, 2) * 60;
}
$filename = "/export1/htdocs/eden/table/$name.txt";
$contents = trim(file_get_contents($filename));
$rowcontents = explode("\n", $contents);
$cur = explode("\t", array_shift($rowcontents));
$title = "<title>Everglades Depth Estimation Network (EDEN) Daily Water Level Percentiles by Month for $name</title>\n";
require ($_SERVER['DOCUMENT_ROOT'] . '/eden/ssi/eden-head.php');
?>
<h3>Daily Water Level Percentiles by Month</h3>
<h4>For monitoring water levels during the <a href="http://www.evergladesplan.org/pm/program_docs/ertp.aspx">Everglades Restoration Transition Plan (ERTP)</a> in <abbr title="Water Conservation Area 3 A">WCA3A</abbr>, <abbr title="Water Conservation Area 3 B">WCA3B</abbr>, and Everglades National Park</h4>
<p><?php echo "$type_long: "; echo $type == 'gage' ? "<a href='station.php?stn_name=$name'>$name</a>" : $name;?><br>
Location: Latitude <?php echo substr($row['latitude'], 0, 2) . '&deg;' . substr($row['latitude'], 3, 2) . "'" . round(substr($row['latitude'], 6), 2) . '"'; ?>, Longitude -<?php echo substr($row['longitude'], 0, 2) . '&deg;' . substr($row['longitude'], 3, 2) . "'" . round(substr($row['longitude'], 6), 2) . '"'; ?><br>Subbasin Location: <?php echo $row['basin']; ?><br><?php echo $type == 'gage' ? 'Average' : 'Maximum'; ?> ground elevation (<abbr title='feet'>ft.</abbr> <abbr title='North American Vertical Datum of 1988'>NAVD88</abbr>): <?php echo is_float($row['elevation']) ? round($row['elevation'], 2) : $row['elevation']; if ($type=='treeisland') { echo ' (as reported by '; echo $row['basin'] == 'ENP' ? "Mike Ross, <abbr title='Florida International University'>FIU</abbr>)" : "Carlos Coronado, <abbr title='South Florida Water Management District'>SFWMD</abbr>)";} ?><br>Vertical conversion at <?php echo $type == 'gage' ? 'gage' : 'tree island'; ?> (<abbr title='feet'>ft.</abbr>) used by <abbr title='Everglades Depth Estimation Network'>EDEN</abbr> (<abbr title='National Geodetic Vertical Datum of 1929'>NGVD29</abbr> to <abbr title='North American Vertical Datum of 1988'>NAVD88</abbr>): <?php echo round($row['conversion'], 2); ?></p>
<table style="width:810px;margin:20px auto;text-align:center">
  <tr>
    <th colspan='3' style='background-color:#976e5c;color:white' class='tablehead'>Daily Water Level Percentiles by Month for <?php echo $name; ?><br>(percentiles based on 7/1/2002&ndash;10/18/2012)</th>
  </tr>
  <tr>
    <td colspan='3'>
      <p><strong>The recent daily water level for <?php echo $name.' on <br> ' . $cur[0] . ' is ' . round($cur[1], 2); ?> feet <abbr title='North American Vertical Datum of 1988'>NAVD88</abbr></strong><br><strong>Note: percentile plots are updated every day about 3:30pm (Eastern)</strong></p>
      <p><a href="hydrographs/<?php echo $name; ?>_monthly.jpg"><img width='800' height='533' src="hydrographs/<?php echo $name; ?>_monthly_med.jpg" alt='daily water level percentiles by month for <?php echo $name; ?>'></a><br>[ <a href='hydrographs/<?php echo $name; ?>_monthly.jpg'>larger version</a> ]</p>
      <p>--Recent daily water levels subject to revision--</p>
    </td>
  </tr>
  <tr>
    <th colspan='2' class='tablehead'>EXPLANATION</th>
    <th class='tablehead'>For more information:</th>
  </tr>
  <tr>
    <td style="background-color:#6CA6CD;width:210px"></td><td class='tablecell'>90th Percentile to Maximum</td>
    <td rowspan='9' class="gtablecell">
      <ul>
        <li><a href="water_level_percentiles_about.php">About Water-level Data</a></li>
        <li><a href="water_level_percentiles_methods.php">Methods</a></li>
        <li><a href="water_level_percentiles_alert.php">Email Alert System</a></li>
      </ul>
    </td>
  </tr>
  <tr>
    <td style="background-color:#ADD8E6;width:210px"></td>
    <td class='tablecell'>75th to 90th Percentile</td>
  </tr>
  <tr>
    <td style="background-color:#6E8B3D;width:210px"></td>
    <td class='tablecell'>25th to 75th Percentile</td>
  </tr>
  <tr>
    <td style="background-color:#EE9A49;width:210px"></td>
    <td class='tablecell'>10th to 25th Percentile</td>
  </tr>
  <tr>
    <td style="background-color:#8B5A2B;width:210px"></td>
    <td class='tablecell'>Minimum to 10th Percentile</td>
  </tr>
  <tr>
    <td colspan='2'></td>
  </tr>
  <tr>
    <td style="background-color:#6E8B3D;width:210px"><hr style="border:1px solid #ffff00"></td>
    <td class='tablecell'>Median water level</td>
  </tr>
  <tr>
    <td style="width:210px"><hr style="border:1px solid black"></td>
    <td class='tablecell'>Recent daily water level</td>
  </tr>
  <tr>
    <td style="width:210px;background-image:url('images/green_dash_white_bkgrd.gif')"></td>
    <td class='tablecell'><?php if ($type == 'gage') echo 'Average'; else echo 'Maximum';?> ground elevation at <?php echo substr($type, 0, 4) . ' ' . substr($type, 4); ?></td>
  </tr>
</table>
<table style="width:540px;margin:20px auto">
  <tr>
    <th colspan="8" class="tablehead" style='background-color:#976e5c;color:white'>Table of Daily Water Level Percentiles by Month for <?php echo $name; ?><br>(percentiles based on 7/1/2002&ndash;10/18/2012)</th>
  </tr>
  <tr>
    <td colspan="8">
      <p><strong>The recent daily water level for <?php echo $name . " on <br> {$cur[0]} is <span style='background-color:#f4e1b4'>" . round($cur[1], 2) . '</span>'; ?> feet <abbr title='North American Vertical Datum of 1988'>NAVD88</abbr></strong></p>
    </td>
  </tr>
  <tr>
  	<td style="background-color:#477489"></td>
    <td class="tablehead" colspan="7">Minimum</td>
  </tr>
  <tr>
    <td colspan="2" style="background-color:#477489"></td>
    <td class="tablehead" colspan="6">10th percentile</td>
  </tr>
  <tr>
    <td colspan="3" style="background-color:#477489"></td>
    <td class="tablehead" colspan="5">25th percentile</td>
  </tr>
  <tr>
    <td colspan="4" style="background-color:#477489"></td>
    <td class="tablehead" colspan="4">Median</td>
  </tr>
  <tr>
    <td colspan="5" style="background-color:#477489"></td>
    <td class="tablehead" colspan="3">75th percentile</td>
  </tr>
  <tr>
    <td colspan="6" style="background-color:#477489"></td>
    <td class="tablehead" colspan="2">90th percentile</td>
  </tr>
  <tr>
    <td colspan="7" style="background-color:#477489"></td>
    <td class="tablehead">Maximum</td>
  </tr>
<?php
$months=array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
foreach($rowcontents as $i => $a) {
	echo "  <tr>
    <td class='tablehead'>{$months[$i]}</td>";
	$cellcontents = explode("\t", $a);
	foreach($cellcontents as $j => $b) {
		if (date('n', time() - 345600) == $i + 1)
			$col = ($b <= $cur[1] && $cur[1] < $cellcontents[$j + 1]) || ($b > $cur[1] && $cur[1] >= $cellcontents[$j - 1]) ? '#f4e1b4' : '#e5f4cc';
		else
			$col = 'white';
		echo "    <td style='background-color:$col' class='tablecell'>" . round($b, 2) . '</td>';
	}
	echo "  </tr>";
}
?>
  <tr>
    <td colspan="8">
      <p>--Recent daily water levels subject to revision--</p>
    </td>
  </tr>
</table>
<?php require ($_SERVER['DOCUMENT_ROOT'] . '/eden/ssi/eden-foot.php'); ?>