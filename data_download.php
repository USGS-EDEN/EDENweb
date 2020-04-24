<?php
session_start();
$fields_all = htmlentities(trim($_GET['fields_all']), ENT_QUOTES);
$fields_clear = htmlentities(trim($_GET['fields_clear']), ENT_QUOTES);
$stations_all = htmlentities(trim($_GET['stations_all']), ENT_QUOTES);
$stations_clear = htmlentities(trim($_GET['stations_clear']), ENT_QUOTES);
$submit = htmlentities(trim($_POST['submit']), ENT_QUOTES);
foreach ((array) $_POST['field'] as $c) {
	$c = htmlentities(trim($c), ENT_QUOTES);
	$_SESSION['field'][$c] = $c;
}
foreach ((array) $_POST['vegetation'] as $d) {
	$d = htmlentities(trim($d), ENT_QUOTES);
	$_SESSION['vegetation'][$d] = $d;
}
foreach ((array) $_POST['station'] as $e) {
	$e = htmlentities(trim($e), ENT_QUOTES);
	$_SESSION['station'][$e] = $e;
}
foreach ((array) $_SESSION['field'] as $f) {
	if (!in_array($f, $_POST['field']) && !($stations_all || $stations_clear))
		unset($_SESSION['field'][$f]);
}
foreach ((array) $_SESSION['vegetation'] as $g) {
	if (!in_array($g, $_POST['vegetation']) && !($stations_all || $stations_clear))
		unset($_SESSION['vegetation'][$g]);
}
foreach ((array) $_SESSION['station'] as $h) {
	if (!in_array($h, $_POST['station']) && !($fields_all || $fields_clear))
		unset($_SESSION['station'][$h]);
}
if (empty($_SESSION['field'])) $_SESSION['field']['station_name_web'] = 'station_name_web';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>EDEN Station Information Data Download - Everglades Depth Estimation Network (EDEN)</title>
  <link rel="stylesheet" href="/eden/css/eden-dbweb-html5.css">
  <script src="https://www.usgs.gov/scripts/analytics/usgs-analytics.js"></script>
  <style>
    table { border-collapse: collapse }
    table, td, th { border: 1px solid #477489 }
    td, th { padding: 2px }
  </style>
</head>
<body>
<?php require ($_SERVER['DOCUMENT_ROOT'] . '/eden/ssi/eden-head.txt'); ?>
<?php require ($_SERVER['DOCUMENT_ROOT'] . '/eden/ssi/nav.php'); ?>
<?php require_once ($_SERVER['DOCUMENT_ROOT'] . '/eden/pclzip.lib.php'); ?>
<div style="overflow:hidden;padding-right:8px;background-color:white;text-align:center"><!--Begin body of page -->
  <h2>EDEN Station Information Data Download</h2>
  <p>This form will allow you to download station information (found on each <a href="stationlist.php#stationlisting">water level gage page</a>) for EDEN gages in tab-delineated text format, which may then be imported into Excel or any other program. Select any data fields below and stations for which you would like station and/or vegetation data, and then press the &quot;Download data&quot; button. This will then produce a .zip file containing text files with the data you have requested along with a &quot;readme&quot; explaining some of the terms used in data fields.</p>
  <p><strong>Please note: Some gages may not have data for all fields (such as location description or vegetation information).</strong></p>
<?php
require ($_SERVER['DOCUMENT_ROOT'] . '/eden/ssi/login.php');
mysql_select_db("eden_new");

if ($submit) {
	if ($_SESSION['station'] && ($_SESSION['field'] || $_SESSION['vegetation'])) {
		$dir = 'eden_gages';
		if ($handle = opendir($dir)) {
			while (false !== ($file = readdir($handle)))
			if ($file != "." && $file != ".." && !strstr($file, 'EDEN_Gage_Data_Download_Readme.txt'))
				unlink($dir . '/' . $file);
			closedir($handle);
		}
		$time = time();
		@ $fp = fopen($dir . '/' . $time . 'station_data.txt', 'w');
		@ $fp2 = fopen($dir . '/' . $time . 'vegetation_data.txt', 'w');
		if (!$fp || !$fp2)
			exit('Could not process your request. Please try again later.</body></html>');
		$filename = "/export1/htdocs/eden/$dir/$time.zip";
		$archive = new PclZip($filename);

		if ($_SESSION['field']) {
			$query = 'select *, agency.agency_acronym as operating_agency from station, station_data, station_datum, station_information, location, agency, vertical_datum, station_type, water_type where station.station_id = station_data.station_id and station.station_id = station_datum.station_id and station.station_id = station_information.station_id and station.location_id = location.location_id and station.operating_agency_id = agency.agency_id and station.vertical_datum_id = vertical_datum.vertical_datum_id and station_information.station_type_id = station_type.station_type_id and station_information.water_type_id = water_type.water_type_id';
			$result = mysql_query($query);
			$num_results = mysql_num_rows($result);
			foreach ((array) $_SESSION['field'] as $a) {
				if ($a == 'station_name_web')
					$field_list .= "EDEN Station Name\t";
				else if ($a == 'operating_agency')
					$field_list .= "Operating Agency\t";
				else if ($a == 'latitude')
					$field_list .= "Latitude (NAD83)\t";
				else if ($a == 'longitude')
					$field_list .= "Longitude (NAD83)\t";
				else if ($a == 'utm_easting')
					$field_list .= "UTM E Zone 17N (m NAD83)\t";
				else if ($a == 'utm_northing')
					$field_list .= "UTM N Zone 17N (m NAD83)\t";
				else if ($a == 'location')
					$field_list .= "Location Area\t";
				else if ($a == 'location_description')
					$field_list .= "Location Description\t";
				else if ($a == 'recent_hourly_data')
					$field_list .= "Real-Time Daily Data Available\t";
				else if ($a == 'vertical_datum')
					$field_list .= "Vertical Datum for Water Level Data\t";
				else if ($a == 'vertical_conversion')
					$field_list .= "Vertical Conversion at Gage (ft) (NGVD29 to NAVD88)\t";
				else if ($a == 'station_type')
					$field_list .= "Type of Station (Physical Location)\t";
				else if ($a == 'water_type')
					$field_list .= "Type of Station (Freshwater/Tidal)\t";
				else if ($a == 'edenmaster_new')
					$field_list .= "Station Used in Surfacing Program?\t";
			}
			fwrite($fp, substr($field_list, 0, -1) . "\n");
			for ($i=0; $i<$num_results; $i++) {
				$row = mysql_fetch_array($result);
				if (in_array($row['station_id'], $_SESSION['station'])) {
					$row['latitude'] = substr($row['latitude'], 0, 2) . '?' . substr($row['latitude'], 3, 2) . "'" . substr($row['latitude'], 6) . '"';
					$row['longitude'] = -substr($row['longitude'], 0, 2) . '?' . substr($row['longitude'], 3, 2) . "'" . substr($row['longitude'], 6) . '"';
					if (array_key_exists('recent_hourly_data', $row))
						$row['recent_hourly_data'] = $row['recent_hourly_data'] ? 'Yes' : 'No';
					if (array_key_exists('edenmaster_new', $row))
						$row['edenmaster_new'] = $row['edenmaster_new'] ? 'Yes' : 'No';
					unset($station_data);
					foreach ((array) $_SESSION['field'] as $g)
						$station_data .= $row[$g] . "\t";
					fwrite($fp, substr($station_data, 0, -1) . "\n");
				}
			}
			fclose($fp);
			$zipfile1 = $dir . '/' . $time . 'station_data.txt';
		}

		if ($_SESSION['vegetation']) {
			$query2 = 'select * from station, station_vegetation, vegetation_community_level, vegetation_community where station.station_id = station_vegetation.station_id and station_vegetation.community_level_id = vegetation_community_level.vegetation_community_level_id and station_vegetation.vegetation_community_id = vegetation_community.vegetation_community_id order by station_name_web, community_level_id';
			$result2 = mysql_query($query2);
			$num_results2 = mysql_num_rows($result2);
			foreach ((array) $_SESSION['vegetation'] as $f) {
				if ($f == 'station_name_web')
					$vegetation_list .= "EDEN Station Name\t";
				else if ($f == 'community_level')
					$vegetation_list .= "Vegetation Community (Major/Secondary)\t";
				else if ($f == 'vegetation_community')
					$vegetation_list .= "Vegetation Community\t";
				else if ($f == 'average_elevation')
					$vegetation_list .= "Average Ground Elevation (ft NAVD88)\t";
				else if ($f == 'maximum_elevation')
					$vegetation_list .= "Maximum Ground Elevation (ft NAVD88)\t";
				else if ($f == 'minimum_elevation')
					$vegetation_list .= "Minimum Ground Elevation (ft NAVD88)\t";
				else if ($f == 'measurements')
					$vegetation_list .= "Number of Measurements\t";
				else if ($f == 'agency_date')
					$vegetation_list .= "Collecting Agency and Date\t";
			}
			fwrite($fp2, substr($vegetation_list, 0, -1) . "\n");
			for ($i=0; $i<$num_results2; $i++) {
				$row2 = mysql_fetch_array($result2);
				if (in_array($row2['station_id'], $_SESSION['station'])) {
					$row2['agency_date'] = strip_tags($row2['agency_date']);
					unset($station_data);
					foreach ((array) $_SESSION['vegetation'] as $h)
						$station_data .= $row2[$h] . "\t";
					fwrite($fp2, substr($station_data, 0, -1) . "\n");
				}
			}
			fclose($fp2);
			$zipfile2 = $dir . '/' . $time . 'vegetation_data.txt';
		}
		$zipfile3 = "$dir/EDEN_Gage_Data_Download_Readme.txt";
		$ziplist = array($zipfile1, $zipfile2, $zipfile3);
		$v_list = $archive -> create($ziplist);
		if ($v_list == 0) die('Error : ' . $archive -> errorInfo(true));
		echo "<table style='width:400px;margin:20px auto'><tr class='grtablehead'><td>You may download the selected data <a href='$dir/$time.zip'>here</a>.</td></tr></table>\n<p>Or redefine your selection criteria:</p>\n";
	}
	else
		echo "<p><strong>You have not selected any fields and/or stations.</strong></p>\n";
}

$query = 'select station_id, station_name_web, operating_agency_id from station where display = 1 ORDER BY station_name_web';
$result = mysql_query($query);
$num_results = mysql_num_rows($result);

if ($fields_all == 1) {
	$_SESSION['field']['station_name_web'] = 'station_name_web';
	$_SESSION['field']['operating_agency'] = 'operating_agency';
	$_SESSION['field']['latitude'] = 'latitude';
	$_SESSION['field']['longitude'] = 'longitude';
	$_SESSION['field']['utm_easting'] = 'utm_easting';
	$_SESSION['field']['utm_northing'] = 'utm_northing';
	$_SESSION['field']['location'] = 'location';
	$_SESSION['field']['location_description'] = 'location_description';
	$_SESSION['field']['recent_hourly_data'] = 'recent_hourly_data';
	$_SESSION['field']['vertical_datum'] = 'vertical_datum';
	$_SESSION['field']['vertical_conversion'] = 'vertical_conversion';
	$_SESSION['field']['station_type'] = 'station_type';
	$_SESSION['field']['water_type'] = 'water_type';
	$_SESSION['field']['edenmaster_new'] = 'edenmaster_new';
	$_SESSION['vegetation']['station_name_web'] = 'station_name_web';
	$_SESSION['vegetation']['community_level'] = 'community_level';
	$_SESSION['vegetation']['vegetation_community'] = 'vegetation_community';
	$_SESSION['vegetation']['average_elevation'] = 'average_elevation';
	$_SESSION['vegetation']['maximum_elevation'] = 'maximum_elevation';
	$_SESSION['vegetation']['minimum_elevation'] = 'minimum_elevation';
	$_SESSION['vegetation']['measurements'] = 'measurements';
	$_SESSION['vegetation']['agency_date'] = 'agency_date';
}
elseif ($fields_clear == 1) {
	$_SESSION['field'] = array();
	$_SESSION['vegetation'] = array();
}
?>
  <form action='data_download.php' method='post'>
    <p><strong><a href='http://sofia.usgs.gov/eden/data_download.php?fields_all=1&stations_all=1'>Select All Data/Ground Elevation & Vegetation Fields & All Stations</a></strong></p>
    <p><a href='http://sofia.usgs.gov/eden/data_download.php?fields_clear=1&stations_clear=1'>Clear All Selections</a></p>
    <table style="width:400px;margin:20px auto">
      <tr class="gtablehead">
        <th colspan='2'>Data fields</th>
      </tr>
      <tr class="gvegtablehead">
        <td colspan='2'><a href='http://sofia.usgs.gov/eden/data_download.php?fields_all=1'>Select All Data/Ground Elevation & Vegetation</a> | <a href='http://sofia.usgs.gov/eden/data_download.php?fields_clear=1'>Clear Selected Data/Ground Elevation & Vegetation</a></td>
      </tr>
      <tr class="gtablecell">
        <td><input type='checkbox' name='field[]' value='station_name_web'<?php echo $_SESSION['field']['station_name_web'] ? ' checked' : ''; ?>></td>
        <td>EDEN Station Name</td>
      </tr>
      <tr class="gtablecell2">
        <td><input type='checkbox' name='field[]' value='operating_agency'<?php echo $_SESSION['field']['operating_agency'] ? ' checked' : ''; ?>></td>
        <td>Operating Agency</td>
      </tr>
      <tr class="gtablecell">
        <td><input type='checkbox' name='field[]' value='latitude'<?php echo $_SESSION['field']['latitude'] ? ' checked' : ''; ?>></td>
        <td>Latitude (NAD83)</td>
      </tr>
      <tr class="gtablecell2">
        <td><input type='checkbox' name='field[]' value='longitude'<?php echo $_SESSION['field']['longitude'] ? ' checked' : ''; ?>></td>
        <td>Longitude (NAD83)</td>
      </tr>
      <tr class="gtablecell">
        <td><input type='checkbox' name='field[]' value='utm_easting'<?php echo $_SESSION['field']['utm_easting'] ? ' checked' : ''; ?>></td>
        <td>UTM Easting Zone 17N (meters NAD83)</td>
      </tr>
      <tr class="gtablecell2">
        <td><input type='checkbox' name='field[]' value='utm_northing'<?php echo $_SESSION['field']['utm_northing'] ? ' checked' : ''; ?>></td>
        <td>UTM Northing Zone 17N (meters NAD83)</td>
      </tr>
      <tr class="gtablecell">
        <td><input type='checkbox' name='field[]' value='location'<?php echo $_SESSION['field']['location'] ? ' checked' : ''; ?>></td>
        <td>Location Area</td>
      </tr>
      <tr class="gtablecell2">
        <td><input type='checkbox' name='field[]' value='location_description'<?php echo $_SESSION['field']['location_description'] ? ' checked' : ''; ?>></td>
        <td>Location Description</td>
      </tr>
      <tr class="gtablecell">
        <td><input type='checkbox' name='field[]' value='recent_hourly_data'<?php echo $_SESSION['field']['recent_hourly_data'] ? ' checked' : ''; ?>></td>
        <td>Real-Time Daily Data Available (Yes/No)</td>
      </tr>
      <tr class="gtablecell2">
        <td><input type='checkbox' name='field[]' value='vertical_datum'<?php echo $_SESSION['field']['vertical_datum'] ? ' checked' : ''; ?>></td>
        <td>Vertical Datum for Water Level Data</td>
      </tr>
      <tr class="gtablecell">
        <td><input type='checkbox' name='field[]' value='vertical_conversion'<?php echo $_SESSION['field']['vertical_conversion'] ? ' checked' : ''; ?>></td>
        <td>Vertical Conversion at Gage (ft) (NGVD29 to NAVD88)</td>
      </tr>
      <tr class="gtablecell2">
        <td><input type='checkbox' name='field[]' value='station_type'<?php echo $_SESSION['field']['station_type'] ? ' checked' : ''; ?>></td>
        <td>Type of Station (Physical Location)</td>
      </tr>
      <tr class="gtablecell">
        <td><input type='checkbox' name='field[]' value='water_type'<?php echo $_SESSION['field']['water_type'] ? ' checked' : ''; ?>></td>
        <td>Type of Station (Freshwater/Tidal)</td>
      </tr>
      <tr class="gtablecell2">
        <td><input type='checkbox' name='field[]' value='edenmaster_new'<?php echo $_SESSION['field']['edenmaster_new'] ? ' checked' : ''; ?>></td>
        <td>Station Used in Surfacing Program?</td>
      </tr>
    </table>
    <table style="width:400px;margin:20px auto">
      <tr class="gtablehead">
        <th colspan='2'>Ground Elevation & Vegetation fields</th>
      </tr>
      <tr class="gtablecell">
        <td><input type='checkbox' name='vegetation[]' value='station_name_web'<?php echo $_SESSION['vegetation']['station_name_web'] ? ' checked' : ''; ?>></td>
        <td>EDEN Station Name</td>
      </tr>
      <tr class="gtablecell2">
        <td><input type='checkbox' name='vegetation[]' value='community_level'<?php echo $_SESSION['vegetation']['community_level'] ? ' checked' : ''; ?>></td>
        <td>Vegetation Community (Major/Secondary)</td>
      </tr>
      <tr class="gtablecell">
        <td><input type='checkbox' name='vegetation[]' value='vegetation_community'<?php echo $_SESSION['vegetation']['vegetation_community'] ? ' checked' : ''; ?>></td>
        <td>Vegetation Community</td>
      </tr>
      <tr class="gtablecell2">
        <td><input type='checkbox' name='vegetation[]' value='average_elevation'<?php echo $_SESSION['vegetation']['average_elevation'] ? ' checked' : ''; ?>></td>
        <td>Average Ground Elevation (ft NAVD88)</td>
      </tr>
      <tr class="gtablecell">
        <td><input type='checkbox' name='vegetation[]' value='maximum_elevation'<?php echo $_SESSION['vegetation']['maximum_elevation'] ? ' checked' : ''; ?>></td>
        <td>Maximum Ground Elevation (ft NAVD88)</td>
      </tr>
      <tr class="gtablecell2">
        <td><input type='checkbox' name='vegetation[]' value='minimum_elevation'<?php echo $_SESSION['vegetation']['minimum_elevation'] ? ' checked' : ''; ?>></td>
        <td>Minimum Ground Elevation (ft NAVD88)</td>
      </tr>
      <tr class="gtablecell">
        <td><input type='checkbox' name='vegetation[]' value='measurements'<?php echo $_SESSION['vegetation']['measurements'] ? ' checked' : ''; ?>></td>
        <td>Number of Measurements</td>
      </tr>
      <tr class="gtablecell2">
        <td><input type='checkbox' name='vegetation[]' value='agency_date'<?php echo $_SESSION['vegetation']['agency_date'] ? ' checked' : ''; ?>></td>
        <td>Collecting Agency and Date</td>
      </tr>
    </table>
    <table style="width:600px;margin:20px auto">
      <tr class="gtablehead">
        <th colspan='6'>Station Listing</th>
      </tr>
      <tr class="gvegtablehead">
        <td colspan='6'><a href='http://sofia.usgs.gov/eden/data_download.php?stations_all=1'>Select All Stations</a> | <a href='http://sofia.usgs.gov/eden/data_download.php?stations_clear=1'>Clear Selected Stations</a></td>
      </tr>
<?php
$query2 = 'select max(station_id) as max from station';
$result2 = mysql_query($query2);
$row2 = mysql_fetch_array($result2);
if ($stations_all == 1)
	$_SESSION['station'] = range(0, $row2['max']);
elseif ($stations_clear == 1)
	$_SESSION['station'] = array();
for ($i = 0; $i < $num_results; $i++) {
	$row = mysql_fetch_array($result);
	
	if (!($i % 3) && !($i % 2))
		echo "<tr class='gtablecell'>";
	if (!($i % 3) && ($i % 2))
		echo "<tr class='gtablecell2'>";

	echo "<td><input type='checkbox' name='station[]' value= '{$row['station_id']}'";
	if ($_SESSION['station'][$row['station_id']])
		echo ' checked';
	echo "></td>\n<td>{$row['station_name_web']}</td>\n";
	if ($i % 3 == 2)
		echo "</tr>\n";
}
?>
    </table>
    <p><input type='submit' value='Download data' name='submit'></p>
  </form>
</div><!--End body of page -->
</div><!--End content and nav -->
<div style="clear:both;width:100%;background-color:#4d7c86">
  <span class="footer">Technical support for this Web site is provided by the <a href="http://www.usgs.gov/" class="footer">U.S. Geological Survey</a><br>This page is:
<?php
$filename = htmlentities($_SERVER['SCRIPT_NAME'], ENT_QUOTES); 
echo "http://sofia.usgs.gov$filename";
?>
  <br>Comments and suggestions? Contact: <a href="https://archive.usgs.gov/archive/sites/sofia.usgs.gov/comments.html" class="footer">Heather Henkel - Webmaster</a><br>Last updated:
<?php echo date ("F d, Y h:i A", getlastmod()); ?> (BJM)</span>
</div>
</body>
</html>