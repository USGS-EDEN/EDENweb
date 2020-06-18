<?php
require ($_SERVER['DOCUMENT_ROOT'] . '/../eden/ssi/login.php');

$stn_name = htmlentities(trim($_GET['stn_name']), ENT_QUOTES);
$op_agency = isset($_GET['op_agency']) ? htmlentities(trim($_GET['op_agency']), ENT_QUOTES) : '';

if (preg_match('/^[a-zA-Z0-9_-]*[a-zA-Z0-9]$/i', $stn_name))
	$val = $stn_name;
else
	exit('That is not a valid station name. Please choose another station.');

$query = "SELECT *, agency.agency_acronym AS operating_agency, usgs_nwis_agency.agency_acronym AS usgs_nwis_agency FROM station, station_data, station_datum, station_information, location, agency, usgs_nwis_agency, vertical_datum, conversion, station_type, water_type WHERE station_name_web = '$val' AND station.station_id = station_data.station_id AND station.station_id = station_datum.station_id AND station.station_id = station_information.station_id AND station.location_id = location.location_id AND station.operating_agency_id = agency.agency_id AND station.usgs_nwis_agency_id = usgs_nwis_agency.usgs_nwis_agency_id AND station.vertical_datum_id = vertical_datum.vertical_datum_id AND station_datum.conversion_id = conversion.conversion_id AND station_information.station_type_id = station_type.station_type_id AND station_information.water_type_id = water_type.water_type_id";
if ($op_agency == 'USGS')
	$query .= ' AND operating_agency_id = 4';
else if ($op_agency == 'SFWMD')
	$query .= ' AND operating_agency_id = 3';
$result = mysqli_query($db, $query);
$row = mysqli_fetch_array($result);
if ($row['location_id'] == 28 || strpos($row['location_description'], 'Water Conservation Area 1') !== false || strpos($row['location_description'], 'WCA1') !== false)
	$area = 'WCA1';
elseif ($row['location_id'] == 29 || $row['location_id'] == 30 || strpos($row['location_description'], 'Water Conservation Area 2') !== false || strpos($row['location_description'], 'WCA2') !== false)
	$area = 'WCA2';
elseif ($row['location_id'] == 31 || $row['location_id'] == 32 || strpos($row['location_description'], 'Water Conservation Area 3') !== false || strpos($row['location_description'], 'WCA3') !== false)
	$area = 'WCA3';
elseif ($row['location_id'] == 26 || strpos($row['location_description'], 'Pennsuco') !== false)
	$area = 'Pennsuco';
elseif ($row['location_id'] == 3 || strpos($row['location_description'], 'Everglades National Park') !== false || strpos($row['location_description'], 'ENP') !== false)
	$area = 'ENP';
elseif ($row['location_id'] == 4)
	$area = 'FLBay';
elseif ($row['location_id'] == 1 || strpos($row['location_description'], 'Big Cypress') !== false)
	$area = 'BCNP';
elseif ($row['location_id'] ==5 )
	$area = 'GOM';
$dec_lat = substr(substr($row['latitude'], 0, 2) + (substr($row['latitude'], 3, 2) / 60) + (substr($row['latitude'], 6) / 3600), 0, 8);
$dec_long = -substr(substr($row['longitude'], 0, 2) + (substr($row['longitude'], 3, 2) / 60) + (substr($row['longitude'], 6) / 3600), 0, 8);

$check_result = mysqli_query($db, "SELECT * FROM station WHERE station_name_web = '$val'");
$check_num_results = mysqli_num_rows($check_result);

if ($check_num_results != '0')
	$in_database = 'yes';

$title = '<title>';
if ($val && $in_database)
	$title .= "EDEN Station: $val - ";
$title .= "Everglades Depth Estimation Network (EDEN)</title>\n";
$link = "<link rel='stylesheet' href='./css/leaflet.css'>\n";
require ($_SERVER['DOCUMENT_ROOT'] . '/../eden/ssi/eden-head.php');

if ($val && $in_database) {
	echo "<h3>EDEN station name: {$row['station_name_web']}<br>Location Area: <a href='stationlist-area.php?area=$area'>{$row['location']}</a></h3>
<p><a href='station-print.php?stn_name={$row['station_name_web']}'><img src='images/printer.gif' alt='print page' height='18' width='19'>Print page</a></p>\n";
	if ($row['comments'])
		echo "<p>{$row['comments']}</p>\n";
}
echo "<p style='text-align:center'>[ <a href='#stationinfo'>Station Information</a> | <a href='#datalinks'>Data Links</a> | <a href='#datuminfo'>Datum Information</a> | <a href='#vegetation'>Ground Elevation/Vegetation</a> | <a href='#otherinfo'>Other Information</a> ]</p>\n";
if ($val && $in_database) {
	echo "<a id='stationinfo'></a>
<table style='width:500px;margin:20px auto'>
  <tr class='gtablehead'>
    <th colspan='2'>Station Information</th>
  </tr>
  <tr class='gtablecell'>
    <td style='width:65%'><a href='explanation.php#stationname'>EDEN Station Name</a>:</td>
    <td><strong>{$row['station_name_web']}</strong></td>
  </tr>
  <tr class='gtablecell'>
    <td><a href='explanation.php#opagency'>Operating Agency</a>:</td>
    <td><abbr title='{$row['agency_name']}'>{$row['operating_agency']}</abbr></td>
  </tr>
  <tr class='gtablecell'>
    <td>Latitude (<abbr title='degrees minutes seconds'>DMS</abbr>) <abbr title='North American Datum of 1983'>NAD83</abbr>:</td>
    <td>" . substr($row['latitude'], 0, 2) . '&deg;' . substr($row['latitude'], 3, 2) . "'" . substr($row['latitude'], 6) . "\"</td>
  </tr>
  <tr class='gtablecell'>
    <td>Longitude (<abbr title='degrees minutes seconds'>DMS</abbr>) <abbr title='North American Datum of 1983'>NAD83</abbr>:</td>
    <td>-" . substr($row['longitude'], 0, 2) . '&deg;' . substr($row['longitude'], 3, 2) . "'" . substr($row['longitude'], 6) . "\"</td>
  </tr>
  <tr class='gtablecell'>
    <td><abbr title='Universal Transverse Mercator'>UTM</abbr> Easting Zone 17<abbr title='North'>N</abbr> (meters <abbr title='North American Datum of 1983'>NAD83</abbr>):</td>
    <td>" . round($row['utm_easting'], 1) . "</td>
  </tr>
  <tr class='gtablecell'>
    <td><abbr title='Universal Transverse Mercator'>UTM</abbr> Northing Zone 17<abbr title='North'>N</abbr> (meters <abbr title='North American Datum of 1983'>NAD83</abbr>):</td>
    <td>" . round($row['utm_northing'], 1) . "</td>
  </tr>
  <tr class='gtablecell'>
    <td><a href='explanation.php#locationarea'>Location Area</a>:</td>
    <td><a href='stationlist-area.php?area=$area'>{$row['location']}</a></td>
  </tr>\n" . ($row['location_description'] != '' ? "<tr class='gtablecell'>
    <td>Location Description:</td>
    <td>{$row['location_description']}</td>
  </tr>\n" : '') . "<tr class='gtablecell'>
    <td>Real-time data (daily):</td>
    <td>";
	if ($row['realtime'] == 1)
		echo 'Yes';
	else if ($row['realtime'] == 2)
		echo 'No';
	else
		echo 'Discontinued';
	echo "</td>
  </tr>
</table>";

	$wl_check_result = mysqli_query($db, "SELECT table_name FROM information_schema.columns WHERE column_name LIKE 'stage_$val'");
	$wl_check_num_results = mysqli_num_rows($wl_check_result);

// Data Links
	echo "<a id='datalinks'></a>
<table style='width:550px;margin:20px auto'>
  <tr class='gtablehead'>
    <th>Data Links</th>
  </tr>
  <tr class='gtablecell2'>
    <td><img src='images/leavingwebsitesm.gif' alt='' height='16' width='36' style='float:right'>(Note: the links below with this icon will take you off of <abbr title='Everglades Depth Estimation Network'>EDEN</abbr>web.)<br>[<strong><a href='explanation.php#datalinks'>Information about these links</a></strong>]</td>
  </tr>
  <tr class='gtablecell'>
    <td>
      <div style='margin-left:100px;text-align:center;background:#ffffcc;padding:10px;border:solid #4b7e83;border-radius:5px;float:right;margin:10px'><strong><a href='eve/index.php?site_list%5B%5D={$row['station_name_web']}" . ($wl_check_num_results ? '&water_level=stage' : '') . "&rainfall=rainfall&et=et'>EVE: Explore<br>and View EDEN</a></strong></div>
      Available parameters: (from <strong>EVE</strong> website)<a href='eve/index.php?site_list%5B%5D={$row['station_name_web']}" . ($wl_check_num_results ? '&water_level=stage' : '') . "&rainfall=rainfall&et=et'>
      <ul>" . ($wl_check_num_results ? '<li>Water level</li>' : '') . "\n        <li>Evapotranspiration</li>
        <li>Rainfall</li>
        <li>Ground elevation</li>
      </ul></a>
    </td>
  </tr>\n";
	if ($row['duration_elevation'] != '' && $row['edenmaster_end'] == 'curren')
		echo "  <tr class='gtablecell'>
    <td align='left'><p><a href='water_level_percentiles.php?name={$row['station_name_web']}&type=gage'>Daily Water Level Percentiles</a> (by Month)</p></td>
  </tr>\n";
	if ($row['other_databases'] != '')
		echo "  <tr class='gtablecell'>
    <td><a href='{$row['other_databases']}'>Other Database Links</a>" . ($row['database_agency_id'] == '3' ? "(Data on <abbr title='South Florida Water Management District'>SFWMD</abbr> <abbr title='D B Hydro'>DBHYDRO</abbr> is in <abbr title='National Geodetic Vertical Datum of 1929'>NGVD29</abbr>)" : '') . "<img src='images/leavingwebsitesm.gif' alt='' height='16' width='36'></td>
  </tr>";
	echo "</table>\n";

// Datum Information
	echo "<a id='datuminfo'></a>
<table style='width:500px;margin:20px auto'>
  <tr class='gtablehead'>
    <th colspan='2'>Datum Information</th>
  </tr>\n";
	if ($row['vertical_datum_id'] == 2 || $row['vertical_datum_id'] == 3)
		echo "  <tr class='gtablecell'>
    <td style='width:60%'>Vertical Datum for Water Level Data:</td>
    <td><abbr title='North American Vertical Datum of 1988'>NAVD88</abbr></td>
  </tr>\n";
	elseif ($row['vertical_datum_id'] == 1)
		echo "  <tr class='gtablecell'>
    <td>Vertical Datum for Water Level Data: </td>
    <td><abbr title='{$row['definition']}'>{$row['vertical_datum']}</abbr></td>
  </tr>\n";
	if ($row['vertical_conversion'] != '')
		echo "  <tr class='gtablecell'>
    <td>Vertical Conversion at Gage (<abbr title='feet'>ft</abbr>) used by <abbr title='Everglades Depth Estimation Network'>EDEN</abbr> (<abbr title='National Geodetic Vertical Datum of 1929'>NGVD29</abbr> to <abbr title='North American Vertical Dataum of 1988'>NAVD88</abbr>):</td>
    <td>{$row['vertical_conversion']}</td>
  </tr>\n";
	echo "  <tr class='gtablecell2'>
    <th colspan='2'>Help</th>
  </tr>
  <tr class='gtablecell'>
    <td colspan='2'><a href='explanation.php#gagedataref'>Why are all gage data not referenced to the same datum?</a></td>
  </tr>
  <tr class='gtablecell'>
    <td colspan='2'><a href='explanation.php#convertgage'>How do I convert data at a gage from one datum to another?</a></td>
  </tr>
  <tr class='gtablecell'>
    <td colspan='2'><a href='explanation.php#conversiondeterm'>How were the vertical conversions at gages determined by EDEN?</a></td>
  </tr>
</table>\n";

// Vegetation Information
	$veg_table_result = mysqli_query($db, "SELECT * FROM station_vegetation, vegetation_community_level, vegetation_community WHERE station_vegetation.vegetation_community_id = vegetation_community.vegetation_community_id AND station_vegetation.community_level_id = vegetation_community_level.vegetation_community_level_id AND station_id = {$row['station_id']}");

	echo "<a id='vegetation'></a>\n";
	if ($veg_num_results = mysqli_num_rows($veg_table_result)) {
		echo "<table style='width:500px;margin:20px auto'>
  <tr class='gtablehead'>
    <th colspan='2'>Ground Elevation and Vegetation Information for $val</th>
  </tr>
  <tr class='gtablecell2'>
    <td colspan='2' style='text-align:center'>[<a href='explanation.php#groundelev'>How was this collected?</a>]</td>
  </tr>\n";
		for ($i = 0; $i < $veg_num_results; $i++) {
			$veg_row = mysqli_fetch_array($veg_table_result);
			echo "  <tr class='gvegtablehead'>
    <th colspan='2'>{$veg_row['community_level']} Vegetation Community</th>
  </tr>
  <tr class='gtablecell'>
    <td style='width:60%'><a href='explanation.php#vegecomm'>Vegetation Community</a>:</td>
    <td>{$veg_row['vegetation_community']}</td>
  </tr>
  <tr class='gtablecell'>
    <td>Average Ground Elevation (<abbr title='feet'>ft</abbr>) <abbr title='North American Vertical Dataum of 1988'>NAVD88</abbr>:</td>
    <td>" . ($veg_row['average_elevation'] ? $veg_row['average_elevation'] : 'N/A') . "</td>
  </tr>
  <tr class='gtablecell'>
    <td>Maximum Ground Elevation (<abbr title='feet'>ft</abbr>) <abbr title='North American Vertical Dataum of 1988'>NAVD88</abbr>:</td>
    <td>" . ($veg_row['maximum_elevation'] ? $veg_row['maximum_elevation'] : 'N/A') . "</td>
  </tr>
  <tr class='gtablecell'>
    <td>Minimum Ground Elevation (<abbr title='feet'>ft</abbr>) <abbr title='North American Vertical Dataum of 1988'>NAVD88</abbr>:</td>
    <td>" . ($veg_row['minimum_elevation'] ? $veg_row['minimum_elevation'] : 'N/A') . "</td>
  </tr>
  <tr class='gtablecell'>
    <td>Number of Measurements:</td>
    <td>" . ($veg_row['measurements'] ? $veg_row['measurements'] : 'N/A') . "</td>
  </tr>
  <tr class='gtablecell'>
    <td>Collecting Agency and Date:</td>
    <td>{$veg_row['agency_date']}</td>
  </tr>\n";
		}
		echo "</table>\n";
	}
	else
		echo "<table style='width:500px;margin:20px auto'>
  <tr class='gtablehead'>
    <th colspan='2'>Ground Elevation and Vegetation Information for {$row['station_name_web']}</th>
  </tr>
  <tr class='gtablecell'>
    <td width='60%' colspan='2'>(There is no ground elevation or vegetation information for this location)</td>
  </tr>
</table>\n";

// Other Information
	echo "<a id='otherinfo'></a>
<table style='width:500px;margin:20px auto'>
  <tr class='gtablehead'>
    <th colspan='2'>Other Information</th>
  </tr>
  <tr class='gtablecell'>
    <td style='width:70%'><a href='explanation.php#typeofstation'>Type of Station</a> (Physical Location):</td>
    <td>{$row['station_type']}</td>
  </tr>
  <tr class='gtablecell'>
    <td><a href='explanation.php#typeofstation'>Type of Station</a> (Freshwater/Tidal):</td>
    <td>{$row['water_type']}</td>
  </tr>\n";
	$result = mysqli_query($db, "SELECT point_id FROM gage_site_survey WHERE EDEN_name = '{$row['station_name_web']}'");
	$num_results = mysqli_num_rows($result);
	for ($i = 0; $i < $num_results; $i++) {
		$row2 = mysqli_fetch_array($result);
		echo "  <tr class='gtablecell'>
    <td colspan='2'><a href='https://archive.usgs.gov/archive/sites/sofia.usgs.gov/exchange/gazetteer/gagesite.php-point_id={$row2['point_id']}.html'>USGS Everglades Gage Gazetteer (Geodetic Point ID: {$row2['point_id']})</a> <img src='images/leavingwebsitesm.gif' alt='' height='16' width='36'></td>
  </tr>\n";
	}
	echo "  <tr class='gvegtablehead'>
    <th colspan='2'>Leaflet Map</th>
  </tr>
  <tr class='gtablecell'>
    <td colspan='2'>
      <div id='map' style='width:500px;height:300px'></div>
      <p>Leaflet Map (showing location of gage <strong>{$row['station_name_web']}</strong>). This map requires enabled JavaScript to view; if you cannot fully access the information on this page, please contact <a href='mailto:hhenkel@usgs.gov'>Heather Henkel</a></p>
      <p style='font-size:x-small'>References to non-<abbr title='United States'>U.S.</abbr> Department of the Interior (<abbr title='Department of the Interior'>DOI</abbr>) products do not constitute an endorsement by the <abbr title='Department of the Interior'>DOI</abbr>.</p>
    </td>
  </tr>
</table>\n";
}
else
	echo 'Please select a station from the list.';
?>
<script src="./js/leaflet.js"></script>
<script>
var map = L.map('map').setView([<?php echo $dec_lat; ?>, <?php echo $dec_long; ?>], 10);

L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
	attribution: 'Tiles &copy; Esri &mdash; Source: Esri, i-cubed, USDA, USGS, AEX, GeoEye, Getmapping, Aerogrid, IGN, IGP, UPR-EGP, and the GIS User Community' }).addTo(map);

var myIcon = L.icon({
    iconUrl: './images/mm_20_red.png',
    iconSize: [13, 21],
    labelAnchor: [7, 21]
});

var mkr = L.marker([<?php echo $dec_lat; ?>, <?php echo $dec_long; ?>], { icon: myIcon }).bindPopup('Station <strong><?php echo $row['station_name_web']; ?></strong><br>Latitude: <?php echo round($dec_lat, 2); ?>&deg;<br>Longitude: <?php echo round($dec_long, 2); ?>&deg;').addTo(map);
</script>
<?php require ($_SERVER['DOCUMENT_ROOT'] . '/../eden/ssi/eden-foot.php'); ?>