<?php
require ($_SERVER['DOCUMENT_ROOT'] . '/../eden/ssi/login.php');

if ($_POST['lat_from'] && $_POST['lat_to'] && $_POST['long_from'] && $_POST['long_to']) {
	$lat_from = (float) mysqli_real_escape_string(htmlspecialchars($_POST['lat_from']));
	$lat_to = (float) mysqli_real_escape_string(htmlspecialchars($_POST['lat_to']));
	$long_from = (float) mysqli_real_escape_string(htmlspecialchars($_POST['long_from']));
	$long_to = (float) mysqli_real_escape_string(htmlspecialchars($_POST['long_to']));
}
else {
	$lat_from = 25;
	$lat_to = 27;
	$long_from = 80;
	$long_to = 82;
}
if ($lat_from < 25) $lat_from = 25;
if ($lat_to > 27) $lat_to = 27;
if ($long_from < 80) $long_from = 80;
if ($long_to > 82) $long_to = 82;
$err = '';
if ($lat_from > $lat_to) {
	$lat_from = 25;
	$err = "<p><strong>Please select a 'From' latitude smaller (further south) than the 'To' latitude.</strong></p>";
}
elseif ($long_from > $long_to) {
	$long_from = 80;
	$err = "<p><strong>Please select a 'From' longitude smaller (further east) than the 'To' longitude.</strong></p>";
}
$lat_cent = ($lat_to + $lat_from) / 2;
$long_cent = ($long_to + $long_from) / 2;
$title = "<title>Everglades Depth Estimation Network (EDEN) - Latitude/Longitude Query</title>\n";
$link = "<link rel='stylesheet' href='/../eden/css/leaflet.css'>
  <link rel='stylesheet' href='/../eden/css/leaflet.label.css'>\n";
$script = "<script src='/../eden/js/leaflet.js'></script>
  <script src='/../eden/js/leaflet.label-src.js'></script>\n";
require ($_SERVER['DOCUMENT_ROOT'] . '/../eden/ssi/eden-head.php');
?>
<h3>Bounding Coordinates Search</h3>
<div style="width:350px;background-color:#ffffcc;border:1px solid black;padding-left:5px">
  <p><strong>New Search:</strong></p>
  <form action="latlongsearch.php" method="post">
  <p><strong>Latitude</strong></p>
  <p>From: <input type='text' size='10' name="lat_from" value='<?php echo $lat_from; ?>'>
  <br>To: &nbsp;&nbsp;&nbsp;&nbsp;<input type='text' size='10' name="lat_to" value='<?php echo $lat_to; ?>'></p>
  <p class="desc">Enter a latitude range from 25 to 27 degrees north.</p>
  <p><strong>Longitude:</strong></p>
  <p>From: <input type='text' size='10' name="long_from" value='<?php echo $long_from; ?>'>
  <br>To: &nbsp;&nbsp;&nbsp;&nbsp;<input type='text' size='10' name="long_to" value='<?php echo $long_to; ?>'></p>
  <p class="desc">Enter a longitude range from 80 to 82 degrees west.</p>
  <p><input type="submit"></p>
  </form>
</div>
<?php
echo "{$err}<p>You have selected stations located from " . round($lat_from, 2) . '&#176; to ' . round($lat_to, 2) . '&#176; N.<br> and from ' . round($long_from, 2) . '&#176; to ' . round($long_to, 2) . '&#176; W.</p>';

$query = "select station_name_web, substring(latitude,1,2) + substring(latitude,4,2) / 60 + substring(latitude,7) / 3600 as lat, substring(longitude,1,2) + substring(longitude,4,2) / 60 + substring(longitude,7) / 3600 as lon from station where display = 1 having lat > $lat_from and lat < $lat_to and lon > $long_from and lon < $long_to ORDER BY lat, lon";
$result = mysqli_query($db, $query);
$num_results = mysqli_num_rows($result);
echo "<p>$num_results stations fall within those bounding coordinates.</p>
<table style='width: 800px'>
  <tr>
    <th class='gtablehead'>Result Set Map</th>
  </tr>
  <tr>
    <td><div id='map' style='height:600px'></div>
      <script>
var map = L.map('map').setView([$lat_cent, -$long_cent], 10);

L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
	attribution: 'Tiles &copy; Esri &mdash; Source: Esri, i-cubed, USDA, USGS, AEX, GeoEye, Getmapping, Aerogrid, IGN, IGP, UPR-EGP, and the GIS User Community'
}).addTo(map);

var myIcon = L.icon({
    iconUrl: './images/mm_20_red.png',
    iconSize: [13, 21],
    labelAnchor: [7, 21]
});\n";
for ($i = 0; $i < $num_results; $i++) {
	$row = mysqli_fetch_array($result);
	$dec_lat = $row['lat'];
	$dec_long = $row['lon'];
	echo "var stn_$i = L.marker([$dec_lat, -$dec_long], {icon: myIcon}).bindPopup(\"Station <strong><a href='./station.php?stn_name={$row['station_name_web']}";
	if ($row['station_name_web'] == 'S150_T')
		echo '&op_agency=SFWMD';
	echo "'>{$row['station_name_web']}</a></strong><br>Latitude: " . round($dec_lat, 2) . "&deg; N<br>Longitude: " . round($dec_long, 2) . "&deg; W\").bindLabel('{$row['station_name_web']}').addTo(map);\n";
}
echo "map.fitBounds([[$lat_from, -$long_to], [$lat_to, -$long_from]]);</script>
    </td>
  </tr>
  <tr>
    <td style='background-color:#f8f1bc'><p style='font-size:small'>Leaflet Map (showing location of <strong>$num_results</strong> gages). To use the map, zoom in or out using the buttons on the left. To view information for a gage, click on the orange pin<img src='images/icons/google-orange-bubble.gif' height='13' width='10' alt='orange pin'>. This map requires enabled JavaScript to view; if you cannot fully access the information on this page, please contact <a href='mailto:hhenkel@usgs.gov'>Heather Henkel</a>.</p>
      <p style='font-size:x-small'>References to non-<abbr title='United States'>U.S.</abbr> Department of the Interior (<abbr title='Department of the Interior'>DOI</abbr>) products do not constitute an endorsement by the <abbr title='Department of the Interior'>DOI</abbr>.</p></td>
  </tr>
</table><br><br>\n";
if ($num_results != 0) {
	mysqli_data_seek($result, 0);
	echo "<table style='border: 0px; margin-bottom: 20px'><tr class='gtablehead' style='background-color:white'><th style='border:0px'>Station name</th><th style='border:0px'>Latitude</th><th style='border:0px'>Longitude</th></tr>\n";
	for ($i=0; $i<$num_results; $i++) {
		$row = mysqli_fetch_array($result);
		echo "<tr class='gtablecell' style='background-color:white'><td style='border:0px'><a href='/../eden/station.php?stn_name={$row['station_name_web']}";
		if ($row['station_name_web'] == 'S150_T')
			echo "&op_agency=SFWMD";
		echo "'>{$row['station_name_web']}</a></td><td style='border:0px'>" . round($row['lat'], 2) . "&deg; N</td><td style='border:0px'>" . round($row['lon'], 2) . "&deg; W</td></tr>\n";
	}
	echo "</table>\n";
}
?>
<?php require ($_SERVER['DOCUMENT_ROOT'] . '/../eden/ssi/eden-foot.php'); ?>