<?php
session_start();
$submit = htmlentities(trim($_POST['submit']), ENT_QUOTES);
$field = htmlentities(trim($_POST['field']), ENT_QUOTES);
$stat = htmlentities(trim($_POST['stat']), ENT_QUOTES);
$_SESSION['field'] = $field ? $field : 'Stage';
if ($_SESSION['field'] == 'Salinity') {
  $lab = array('Salinity', "<abbr title='parts per thousand'>PPT</abbr>");
  $range = array(0.5, 3, 7, 12, 18, 30);
}
elseif ($_SESSION['field'] == 'Temperature') {
  $lab = array('Water Temperature', "<abbr title='degrees Celsius'>&deg;C</abbr>");
  $range = array(10, 14, 18, 22, 26, 30);
}
else {
  $lab = array('Water Level', "<abbr title='feet North American Vertical Datum of 1988'>ft. NAVD88</abbr>");
  $range = array(-2, -1, 0, 1, 2, 3);
}
$_SESSION['stat'] = $stat ? $stat : '7dayavg';
if ($_SESSION['stat'] == 'current')
  $lab[2] = 'Current Conditions';
else if ($_SESSION['stat'] == '7dayavg')
  $lab[2] = '7-Day Average';
else {
  $lab[2] = '7-Day Change';
  $range = array(-2, -1, 0, 1, 2, 3);
}

require ($_SERVER['DOCUMENT_ROOT'] . '/../eden/ssi/login.php');

$title = "<title>Coastal EDEN - Everglades Depth Estimation Network (EDEN)</title>\n";
$link = "<link rel='stylesheet' href='./css/leaflet.css'>
    <link rel='stylesheet' href='./css/leaflet.label.css'>\n";
$style = "#map {
  width: 85%;
  height: 715px;
  border: 0px;
  background: #F6F6F6;
  float: right
}\n";
require ($_SERVER['DOCUMENT_ROOT'] . '/../eden/ssi/eden-head.php');
?>
<form action="coastal.php" method='post'>
<h1>Coastal <abbr title='Everglades Depth Estimation Network'>EDEN</abbr></h1>
<div style="width:220px;float:right;background-color:#e5f4cc">
  <img src="images/screenshots/coastal_eden_bubble_screenshot.jpg" alt="Image of data obtained when clicking on markers on map" height="330" width="216"><p style="font-size:small;margin:10px 3px">To view information and data for a specific gage, click on the colored markers on the map below.</p></div>
<p>Coastal <abbr title='Everglades Depth Estimation Network'>EDEN</abbr> presents real-time data for the oligihaline/mesohaline zone in the Southern Everglades. These coastal areas, or specifically the Coastal Oligohaline Wetlands Zone (sometimes referred to as "the coastal fringe" or the "zone of change"), are critical in evaluating the hydrologic and ecological responses to modifications of the water delivery system from restoration and future climate change. Hydrologic changes, either from flow alterations or climate change, will first be manifested along the coastal fringe. These areas experience tidal backwater conditions, and increases in flow and (or) sea-level rise may move this seaward or landward. Coastal areas will probably exhibit larger relative changes in hydroperiods as compared to inland areas.</p>
<p>This page allows you to display current hydrologic data for <abbr title='US Geological Survey'>USGS</abbr>-operated coastal stations in south Florida. These data are stored in the <abbr title='US Geological Survey'>USGS</abbr> National Water Information System (NWIS) database. To download current and historical data and data for other discontinued and non-real-time gages, go to <a href="https://archive.usgs.gov/archive/sites/sofia.usgs.gov/exchange/zucker_woods_patino/index.php">South Florida Hydrology Data Download</a>.</p>
<p>The <a href="https://www2.usgs.gov/water/southatlantic/projects/coastalsalinity/home.php">Coastal Salinity Index (CSI)</a> utilizes salinity data to characterize saline (drought) and freshwater (wet) conditions in coastal areas. The CSI is site-specific and can be computed for multiple time intervals from 1- to 24-months, to help users evaluate response to monthly (and longer) precipitation and streamflow conditions. The Coastal Salinity Index (CSI) was developed to characterize coastal drought, monitor changing salinity conditions, and improve understanding of the effects of changing salinities on fresh and saltwater ecosystems, fish habitat, and freshwater availability for municipal and industrial use.</p>
<div style="width:400px;background-color:#fffccc;margin:20px auto;border:1px solid black;padding:10px;text-align:center">
	<p>Download the <a href="https://archive.usgs.gov/archive/sites/sofia.usgs.gov/metadata/sflwww/CoastalEDEN.html">Coastal EDEN metadata record</a>.</p>
</div>
<p style="font-size:small">The Leaflet Map on this page requires enabled JavaScript to view; if you cannot fully access the information on this page, please contact <a href="mailto:hhenkel@usgs.gov">Heather Henkel</a></p>
<p>Download the <a href="coastal/csi_values.zip"><abbr title="Coastal Salinity Index">CSI</abbr> data</a> for the Coastal EDEN gages. Or view the <a href="coastal/CSI_User_Guide.pdf">User Guide to Coastal EDEN</a>.</p>
<table>
  <tr class='gtablehead'>
    <th style="width:50%">Data Parameters</th>
    <th style="width:50%">Statistics</th>
  </tr>
  <tr class='gvegtablehead'>
    <td style="font-size:small">Select the parameter you would like to display. (Click on individual statistics for more information.) Not all parameters are available for all stations. See <a href="#stations">Stations list below</a> for available parameters by station.</td>
    <td style="font-size:small">Select the statistic you would like to view. (Click on individual statistics for more information.)</td>
  </tr>
  <tr class='gtablecell'>
    <td><input type='radio' name='field' value='Stage' <?php if ($_SESSION['field'] == 'Stage') echo 'checked';?>> <a href='javascript:Popup("coastal_popup.php?popup=stage")'>Water Level</a> <span style="font-size:x-small">(<abbr title='feet'>ft.</abbr> <abbr title='North American Vertical Datum of 1988'>NAVD88</abbr>)</span></td>
    <td><input type='radio' name='stat' value='current' <?php if ($_SESSION['stat'] == 'current') echo 'checked';?>> <a href='javascript:Popup("coastal_popup.php?popup=current")'>Current conditions</a> <span style="font-size:x-small">(<?php echo date('m/d/Y');?>)</span></td>
  </tr>
  <tr class='gtablecell2'>
    <td><input type='radio' name='field' value='Temperature' <?php if ($_SESSION['field'] == 'Temperature') echo 'checked';?>><a href='javascript:Popup("coastal_popup.php?popup=temp")'>Water Temperature</a> <span style="font-size:x-small">(<abbr title='degrees celsius'>&deg;C</abbr>)</span></td>
    <td><input type='radio' name='stat' value='7dayavg' <?php if ($_SESSION['stat'] == '7dayavg') echo 'checked';?>><a href='javascript:Popup("coastal_popup.php?popup=7dayavg")'>Seven-day average</a> <span style="font-size:x-small">(<?php echo date('m/d/Y', time() - 518400) . '&ndash;' . date('m/d/Y'); ?>)</span></td>
  </tr>
  <tr class='gtablecell'>
    <td><input type='radio' name='field' value='Salinity' <?php if ($_SESSION['field'] == 'Salinity') echo 'checked';?>><a href='javascript:Popup("coastal_popup.php?popup=sal")'>Salinity</a> <span style="font-size:x-small">(<abbr title='parts per thousand'>PPT</abbr>)</span></td>
    <td><input type='radio' name='stat' value='7daydif' <?php if ($_SESSION['stat'] == '7daydif') echo 'checked';?>><a href='javascript:Popup("coastal_popup.php?popup=7daydif")'>Seven-day change</a> <span style="font-size:x-small">(<?php echo date('m/d/Y', time() - 518400) . '&ndash;' . date('m/d/Y') . ' minus ' . date('m/d/Y', time() - 1123200) . '&ndash;' . date('m/d/Y', time() - 604800); ?>)</span></td>
  </tr>
</table>
<p style="text-align:center"><input type='submit' value='Show Selected Parameter and Statistic' name='submit'></p>
<?php
if ($_SESSION['stat'] != '7daydif') { $col = 'images/mm_20_'; $col2 = ''; $col3 = ''; } else { $col = 'images/'; $col2 = '_dn'; $col3 = '_up'; }
echo "<table style='width:160px;float:left'>
  <tr class='gtablehead'><th colspan='2'>$lab[2]<br>Coastal EDEN<br>$lab[0] Data</th></tr>
  <tr><td><img src='{$col}purple{$col2}.png' alt='Purple Icon'></td>
    <td class='tablecell'>&lt;= $range[0] $lab[1]</td></tr>
  <tr><td><img src='{$col}blue{$col2}.png' alt='Blue Icon'></td>
    <td class='tablecell'>$range[0] &ndash; $range[1] $lab[1]</td></tr>
  <tr><td><img src='{$col}green{$col2}.png' alt='Green Icon'></td>
    <td class='tablecell'>$range[1] &ndash; $range[2] $lab[1]</td></tr>
  <tr><td><img src='{$col}yellow{$col3}.png' alt='Yellow Icon'></td>
    <td class='tablecell'>$range[2] &ndash; $range[3] $lab[1]</td></tr>
  <tr><td><img src='{$col}orange{$col3}.png' alt='Orange Icon'></td>
    <td class='tablecell'>$range[3] &ndash; $range[4] $lab[1]</td></tr>
  <tr><td><img src='{$col}red{$col3}.png' alt='Red Icon'></td>
    <td class='tablecell'>$range[4] &ndash; $range[5] $lab[1]</td></tr>
  <tr><td><img src='{$col}white{$col3}.png' alt='White Icon'></td>
    <td class='tablecell'>&gt; $range[5] $lab[1]</td></tr>
  <tr><td><img src='images/mm_20_black.png' alt='Black Icon'></td>
    <td class='tablecell'>Not available</td></tr>
</table>\n";
?>
<div id="map"></div>
<script src="./js/leaflet.js"></script>
<script src="./js/leaflet.label-src.js"></script>
<script>
var stile = 'width = 350, height = 300 status = no, menubar = no, toolbar = no, scrollbar = no';
function Popup(apri) {
	New = window.open(apri, '', stile);
	New.moveTo(300, 300);
}

var map = L.map('map').setView([25.5, -80.825], 10);

L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
	attribution: 'Tiles &copy; Esri &mdash; Source: Esri, i-cubed, USDA, USGS, AEX, GeoEye, Getmapping, Aerogrid, IGN, IGP, UPR-EGP, and the GIS User Community'
}).addTo(map);

var purpleIcon = L.icon({
    iconUrl: './images/mm_20_purple.png',
    iconSize: [13, 21],
    labelAnchor: [7, 21]
});
var purpleDn = L.icon({
    iconUrl: './images/purple_dn.png',
    iconSize: [13, 21],
    labelAnchor: [7, 21]
});
var purpleUp = L.icon({
    iconUrl: './images/purple_up.png',
    iconSize: [13, 21],
    labelAnchor: [7, 21]
});
var blueIcon = L.icon({
    iconUrl: './images/mm_20_blue.png',
    iconSize: [13, 21],
    labelAnchor: [7, 21]
});
var blueDn = L.icon({
    iconUrl: './images/blue_dn.png',
    iconSize: [13, 21],
    labelAnchor: [7, 21]
});
var blueUp = L.icon({
    iconUrl: './images/blue_up.png',
    iconSize: [13, 21],
    labelAnchor: [7, 21]
});
var greenIcon = L.icon({
    iconUrl: './images/mm_20_green.png',
    iconSize: [13, 21],
    labelAnchor: [7, 21]
});
var greenDn = L.icon({
    iconUrl: './images/green_dn.png',
    iconSize: [13, 21],
    labelAnchor: [7, 21]
});
var greenUp = L.icon({
    iconUrl: './images/green_up.png',
    iconSize: [13, 21],
    labelAnchor: [7, 21]
});
var yellowIcon = L.icon({
    iconUrl: './images/mm_20_yellow.png',
    iconSize: [13, 21],
    labelAnchor: [7, 21]
});
var yellowDn = L.icon({
    iconUrl: './images/yellow_dn.png',
    iconSize: [13, 21],
    labelAnchor: [7, 21]
});
var yellowUp = L.icon({
    iconUrl: './images/yellow_up.png',
    iconSize: [13, 21],
    labelAnchor: [7, 21]
});
var orangeIcon = L.icon({
    iconUrl: './images/mm_20_orange.png',
    iconSize: [13, 21],
    labelAnchor: [7, 21]
});
var orangeDn = L.icon({
    iconUrl: './images/orange_dn.png',
    iconSize: [13, 21],
    labelAnchor: [7, 21]
});
var orangeUp = L.icon({
    iconUrl: './images/orange_up.png',
    iconSize: [13, 21],
    labelAnchor: [7, 21]
});
var redIcon = L.icon({
    iconUrl: './images/mm_20_red.png',
    iconSize: [13, 21],
    labelAnchor: [7, 21]
});
var redDn = L.icon({
    iconUrl: './images/red_dn.png',
    iconSize: [13, 21],
    labelAnchor: [7, 21]
});
var redUp = L.icon({
    iconUrl: './images/red_up.png',
    iconSize: [13, 21],
    labelAnchor: [7, 21]
});
var whiteIcon = L.icon({
    iconUrl: './images/mm_20_white.png',
    iconSize: [13, 21],
    labelAnchor: [7, 21]
});
var whiteDn = L.icon({
    iconUrl: './images/white_dn.png',
    iconSize: [13, 21],
    labelAnchor: [7, 21]
});
var whiteUp = L.icon({
    iconUrl: './images/white_up.png',
    iconSize: [13, 21],
    labelAnchor: [7, 21]
});
var blackIcon = L.icon({
    iconUrl: './images/mm_20_black.png',
    iconSize: [13, 21],
    labelAnchor: [7, 21]
});
var blackDn = L.icon({
    iconUrl: './images/black_dn.png',
    iconSize: [13, 21],
    labelAnchor: [7, 21]
});
var blackUp = L.icon({
    iconUrl: './images/black_up.png',
    iconSize: [13, 21],
    labelAnchor: [7, 21]
});
<?php
$stations_result = mysql_query("SELECT * FROM station WHERE coastal LIKE '%" . substr($_SESSION['field'], 0, 2) . "%' ORDER BY station_name_web");
$stations_num_results = mysql_num_rows($stations_result);
for ($i = 0; $i < $stations_num_results; $i++) {
	$stations_row = mysql_fetch_array($stations_result);
	$dec_lat = round(substr($stations_row['latitude'], 0, 2) + substr($stations_row['latitude'], 3, 2) / 60 + substr($stations_row['latitude'], 6) / 3600, 2);
	$dec_long = -round(substr($stations_row['longitude'], 0, 2) + substr($stations_row['longitude'], 3, 2) / 60 + substr($stations_row['longitude'], 6) / 3600, 2);
	if ($_SESSION['stat'] == '7dayavg')
		$sal_query = "SELECT AVG(`{$stations_row['station_name_web']}_{$_SESSION['field']}`) AS {$_SESSION['field']} FROM coastal WHERE datetime BETWEEN '" . date('Ymd', time() - 518400) . "000000' AND '" . date('Ymd') . "234500'";
	else if ($_SESSION['stat'] == 'current')
		$sal_query = "SELECT AVG(`{$stations_row['station_name_web']}_{$_SESSION['field']}`) AS {$_SESSION['field']} FROM coastal WHERE datetime BETWEEN '" . date('Ymd', time() - 86400) . "000000' AND '" . date('Ymd') . "234500'";
	else
		$sal_query = "SELECT (SELECT AVG(`{$stations_row['station_name_web']}_{$_SESSION['field']}`) FROM coastal WHERE datetime BETWEEN '" . date('Ymd', time() - 518400) . "000000' AND '" . date('Ymd') . "234500') - (SELECT AVG(`{$stations_row['station_name_web']}_{$_SESSION['field']}`) FROM coastal WHERE datetime BETWEEN '" . date('Ymd', time() - 1123200) . "000000' AND '" . date('Ymd', time() - 604800) . "234500') as {$_SESSION['field']}";
	$sal_result = mysql_query($sal_query);
	$sal_row = mysql_fetch_array($sal_result);
	$sal = $sal_row[$_SESSION['field']];
	if (is_null($sal)) {
		$icon = 'blackIcon';
		$sal = 'NA';
	}
	else {
		$sal = round($sal,2);
		if ($_SESSION['stat'] != '7daydif' && $sal <= $range[0]) 
			$icon = 'purpleIcon';
		elseif ($_SESSION['stat'] != '7daydif' && $sal > $range[0] && $sal <= $range[1])
			$icon = 'blueIcon';
		elseif ($_SESSION['stat'] != '7daydif' && $sal > $range[1] && $sal <= $range[2])
			$icon = 'greenIcon';
		elseif ($_SESSION['stat'] != '7daydif' && $sal > $range[2] && $sal <= $range[3])
			$icon = 'yellowIcon';
		elseif ($_SESSION['stat'] != '7daydif' && $sal > $range[3] && $sal <= $range[4])
			$icon = 'orangeIcon';
		elseif ($_SESSION['stat'] != '7daydif' && $sal > $range[4] && $sal <= $range[5])
			$icon = 'redIcon';
		elseif ($_SESSION['stat'] != '7daydif' && $sal > $range[5])
			$icon = 'whiteIcon';
		elseif ($_SESSION['stat'] == '7daydif' && $sal <= $range[0]) 
			$icon = 'purpleDn';
		elseif ($_SESSION['stat'] == '7daydif' && $sal > $range[0] && $sal <= $range[1])
			$icon = 'blueDn';
		elseif ($_SESSION['stat'] == '7daydif' && $sal > $range[1] && $sal <= $range[2])
			$icon = 'greenDn';
		elseif ($_SESSION['stat'] == '7daydif' && $sal > $range[2] && $sal <= $range[3])
			$icon = 'yellowUp';
		elseif ($_SESSION['stat'] == '7daydif' && $sal > $range[3] && $sal <= $range[4])
			$icon = 'orangeUp';
		elseif ($_SESSION['stat'] == '7daydif' && $sal > $range[4] && $sal <= $range[5])
			$icon = 'redUp';
		elseif ($_SESSION['stat'] == '7daydif' && $sal > $range[5])
			$icon = 'whiteUp';
		else
			$icon = 'blackIcon';
	}
	$stn = str_replace('-', '_', $stations_row['station_name_web']);
	echo "var $stn = new L.marker([$dec_lat, $dec_long], {icon: $icon}).bindPopup(\"<table style='border:0px'><tr><td style='border:0px'><p><strong><a href='station.php?stn_name={$stations_row['station_name_web']}'>" . str_replace('_', ' ', $stations_row['station_name_web']) . "</a></strong> {$stations_row['usgs_nwis_id']}<br><strong>Latitude:</strong> $dec_lat&deg;&nbsp;&nbsp;<strong>Longitude:</strong> $dec_long&deg;<br><strong>Parameters:</strong><br>";
	$params = preg_replace('/;sa,[0-9]+/', ', Salinity', preg_replace('/;te,[0-9]+/', ', Water Temperature', preg_replace('/st,[0-9]+/', 'Water Level', $stations_row['coastal'])));
	echo $params . "<br><br><strong>$lab[0] $lab[2]:</strong> $sal $lab[1]<br><br><a href='http://waterdata.usgs.gov/fl/nwis/uv?site_no={$stations_row['usgs_nwis_id']}' target='_blank'><abbr title='National Water Information System'>NWIS</abbr> Real-time Data</a><br><a href='http://waterdata.usgs.gov/fl/nwis/dv?site_no={$stations_row['usgs_nwis_id']}' target='_blank'><abbr title='National Water Information System'>NWIS</abbr> Daily Data</a><table style='border:0px'><tr><td style='border:0px;width:30px'><hr style='height:3px;border-width:0;background-color:black;color:black'></td><td style='border:0px' class='tablecell'>Current conditions year-to-date</td></tr><tr><td style='border:0px;width:30px'><hr style='height:3px;border-width:0;background-color:#00ff00;color:#00ff00'></td><td style='border:0px' class='tablecell'>Rolling seven-day average</td></tr></table><a href='./coastal/full/{$stations_row['station_name_web']}_" . strtolower($_SESSION['field']) . "_full.jpg' target='_blank'>[larger graph with axes]<br><img src='coastal/thumbnails/{$stations_row['station_name_web']}_" . strtolower($_SESSION['field']) . "_thumb.jpg' height='160'></a>";
	if (file_exists("coastal/csi_stacked/{$stations_row['station_name_web']}_stacked_thumb.png"))
		echo "</td><td style='border:0px'><div style='float:right'><strong>Coastal Salinity Index</strong><br><a href='./coastal/csi_stacked/{$stations_row['station_name_web']}_stacked.png' target='_blank'><img src='./coastal/csi_stacked/{$stations_row['station_name_web']}_stacked_thumb.png' height='150'></a><hr><strong>Salinity Duration Hydrograph</strong><br><a href='./coastal/salinity_duration_hydrographs/{$stations_row['station_name_web']}_salinity.jpg' target='_blank'><img src='./coastal/salinity_duration_hydrographs/{$stations_row['station_name_web']}_salinity_thumb.jpg' height='150'></a>";
	echo "</td></tr></table>\", {maxWidth: 'auto'}).bindLabel('{$stations_row['station_name_web']}').addTo(map);\n";
}
?>
</script>
<table style="margin:20px auto;float:left">
  <tr class='gtablehead'><th colspan='5'><a id='stations'>Stations</a></th></tr>
  <tr class='gvegtablehead'><td colspan='5' style="font-size:small">Coastal <abbr title='Everglades Depth Estimation Network'>EDEN</abbr> stations and measured parameters are listed below. Click the station name to go to the <abbr title='Everglades Depth Estimation Network'>EDEN</abbr> Station Information page.</td></tr>
<?php
$result = mysql_query('SELECT station_name_web, coastal FROM station WHERE coastal IS NOT NULL ORDER BY station_name_web');
$num_results = mysql_num_rows($result);
for ($i = 1; $i <= $num_results; $i++) {
	$row = mysql_fetch_array($result);
	$name = str_replace('_', ' ', $row['station_name_web']);
	if ($i % 5 == 1)
		echo "<tr class='gtablecell'>";
	echo "<td style='border:0px'><span style='font-size:small'><strong><a href='station.php?stn_name=" . $row['station_name_web'] . "'>$name</a></strong></span><br><span style='font-size:x-small'>" . preg_replace('/;sa,[0-9]+/', ', Salinity', preg_replace('/;te,[0-9]+/', ', Water Temperature', preg_replace('/^st,[0-9]+/', 'Water Level', $row['coastal']))) . "</span></td>\n";
	if (!($i % 5))
		echo "</tr>\n";
}
for ($i = 1; $i <= 5 - $num_results % 5; $i++)
  echo "<td style='border:0px'></td>\n";
?>
  </tr>
</table>
</form>
<?php require ($_SERVER['DOCUMENT_ROOT'] . '/../eden/ssi/eden-foot.php'); ?>