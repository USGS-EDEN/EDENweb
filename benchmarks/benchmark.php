<?php
require ($_SERVER['DOCUMENT_ROOT'] . '/../eden/ssi/login.php');

$benchmark = htmlentities(trim($_GET['benchmark']), ENT_QUOTES);
$result = mysql_query("SELECT * FROM benchmark2 WHERE benchmark = '$benchmark' LIMIT 1");
$row = mysql_fetch_array($result);
$abbr = str_replace('WCA', "<abbr title='Water Conservation Area'>WCA</abbr>", str_replace('ENP', "<abbr title='Everglades National Park'>ENP</abbr>", str_replace('BCNP', "<abbr title='Big Cypress National Preserve'>BCNP</abbr>", str_replace('BM', "<abbr title='benchmark'>BM</abbr>", $row['benchmark']))));

$dec_lat = substr(substr($row['latitude'], 0, 2) + (substr($row['latitude'], 2, 2) / 60) + (substr($row['latitude'], 4) / 3600), 0, 8);
$dec_long = -substr(substr($row['longitude'], 0, 2) + (substr($row['longitude'], 2, 2) / 60) + (substr($row['longitude'], 4) / 3600), 0, 8);

if ($row['benchmark'])
	$check = $row['benchmark'];
if (!$check)
	exit('Please select a <a href="index.php#benchmarks">valid benchmark</a> from the list.');
$title = "<title>Benchmark: {$row['benchmark']} - Benchmark Data - Everglades Depth Estimation Network (EDEN)</title>\n";
$link = "<link rel='stylesheet' href='../css/leaflet.css'>\n";
require ($_SERVER['DOCUMENT_ROOT'] . '/../eden/ssi/eden-head.php');
?>
<h5><a href="index.php">Benchmarks Network</a><?php echo " > Benchmark: $abbr"; ?></h5>
<p class="caption" style="float:right"><?php echo "[ <a href='benchmark-print.php?benchmark={$row['benchmark']}'><img src='../images/printer.gif' alt='print page' height='18' width='19'></a> <a href='benchmark-print.php?benchmark={$row['benchmark']}'>Printer-friendly version</a> ]"; ?></p>
<?php
echo "<table style='width:750px'>
  <tr class='gtablehead'>
    <th colspan='2'>Benchmark Information for $abbr</th>
  </tr>
  <tr class='gvegtablehead'>
    <td colspan='2'>Data for benchmark provided by Originating Agency</td>
  </tr>
  <tr class='gtablecell'>
    <td><strong>Benchmark Designation:</strong> $abbr";
echo $row['pid'] ? " (PID: <a href='http://www.ngs.noaa.gov/cgi-bin/ds_pid.prl?PidsSelected={$row['pid']}' target='_blank'>{$row['pid']}</a>)" : '';
echo "<br><strong>Stamping:</strong> {$row['stamping']}<br><strong>Marker Type:</strong> {$row['marker_type']}<br><strong>Magnetic:</strong> {$row['magnetic']}<br><strong>Stability:</strong> {$row['stability']}<br><strong>Location:</strong> {$row['location']}<br><strong>Originating Agency:</strong> ";
echo $row['pid'] ? 'South Florida Water Management District (SFWMD)' : 'U.S. Army Corps of Engineers (USACE), Jacksonville';
echo "<br><strong><abbr title='Global Positioning System'>GPS</abbr> Observation Date:</strong> {$row['gps_obs_date']}<br>";
if (!$row['pid'])
	$row['elevation'] = round($row['elevation'], 2);
echo "<strong>Benchmark Elevation:</strong> {$row['elevation']} <abbr title='feet'>ft.</abbr> {$row['vert_datum']}<br><strong>Horizontal Datum:</strong> {$row['horiz_datum']}<br><strong>Horizontal Order:</strong> {$row['horiz_order']}<br><strong>Vertical Order:</strong> {$row['vert_order']}<br><strong>Zone:</strong> {$row['zone']}<br><strong>Vertical Datum:</strong> {$row['vert_datum']}<br>";
echo $row['utm_northing'] ? "<strong><abbr title='Universal Transverse Mercator'>UTM</abbr> Northing:</strong> {$row['utm_northing']} <strong><abbr title='Universal Transverse Mercator'>UTM</abbr> Easting:</strong> {$row['utm_easting']}<br>" : '';
echo "<strong>State Plane North:</strong> {$row['sp_north']} <strong>State Plane East:</strong> {$row['sp_east']}<br><strong>Latitude:</strong> " . substr($row['latitude'], 0, 2) . '&deg;' . substr($row['latitude'], 2, 2) . "'" . substr($row['latitude'], 4) . '&quot; <strong>Longitude:</strong> -' . substr($row['longitude'], 0, 2) . '&deg;' . substr($row['longitude'], 2, 2) . "'" . substr($row['longitude'], 4) . "&quot;<br><br><strong>Description:</strong> {$row['description']}<br>";
echo $row['pid'] ? "<br><strong>Point of Contact:</strong> Mike Horan (<a href='mailto:mhoran@sfwmd.gov'>mhoran@sfwmd.gov</a>)" : "<br><strong>Point of Contact:</strong> Robert Swilley (<a href='mailto:Robert.W.Swilley@usace.army.mil'>Robert.W.Swilley@usace.army.mil</a>)</td>
    <td style='width:280px'><a href='#googlemap'><img src='images/googlemapth.jpg' alt='google map thumbnail' width='72' height='51'></a> <a href='#googlemap'>Location map is below</a><br><br>";
echo file_exists("Benchmark_Sheets/images/small-resized/{$row['benchmark']}_closesm.jpg") ? "<a href='Benchmark_Sheets/images/{$row['benchmark']}_closex.jpg'><img src='Benchmark_Sheets/images/small-resized/{$row['benchmark']}_closesm.jpg' alt='close-up photo of {$row['benchmark']}' height='153' width='250'></a><br><strong>Close-up View</strong> [<a href='Benchmark_Sheets/images/{$row['benchmark']}_closex.jpg'>larger version</a>]<br><br>" : '';
echo file_exists("Benchmark_Sheets/images/small-resized/{$row['benchmark']}_horizonsm.jpg") ? "<a href='Benchmark_Sheets/images/{$row['benchmark']}_horizonx.jpg'><img src='Benchmark_Sheets/images/small-resized/{$row['benchmark']}_horizonsm.jpg' alt='horizon photo of {$row['benchmark']}' height='153' width='250'></a><br><strong>Horizon View</strong> [<a href='Benchmark_Sheets/images/{$row['benchmark']}_horizonx.jpg'>larger version</a>]<br><br>" : '';
echo !file_exists("Benchmark_Sheets/images/small-resized/{$row['benchmark']}_closesm.jpg") && !file_exists("Benchmark_Sheets/images/small-resized/{$row['benchmark']}_horizonsm.jpg") ? "<br> (no images are available for this benchmark)" : '';
echo "</td>
  </tr>\n";

$result = mysql_query("SELECT * FROM rm WHERE benchmark = '$benchmark'");
$row2 = mysql_fetch_array($result);
if($row2['elevation']) {
	echo "  <tr class='gtablecell'>
    <td colspan='2'><strong>Reference Mark 1</strong><br><strong>Marker Type:</strong> <abbr title='stainless steel'>S.S.</abbr> ROD DRIVEN TO REFUSAL<br><strong>Magnetic Bearing:</strong> {$row2['bearing']}<br><strong>Reference Distance:</strong> {$row2['distance']} <abbr title='feet'>ft.</abbr><br><strong>Reference Elevation:</strong> {$row2['elevation']} <abbr title='feet'>ft.</abbr> {$row['vert_datum']}<br></td>
  </tr>\n";
	$row2 = mysql_fetch_array($result2);
	echo "  <tr class='gtablecell'>
    <td colspan='2'><strong>Reference Mark 2</strong><br><strong>Marker Type:</strong> <abbr title='stainless steel'>S.S.</abbr> ROD DRIVEN TO REFUSAL<br><strong>Magnetic Bearing:</strong> {$row2['bearing']}<br><strong>Reference Distance:</strong> {$row2['distance']} <abbr title='feet'>ft.</abbr><br><strong>Reference Elevation:</strong> {$row2['elevation']} <abbr title='feet'>ft.</abbr> {$row['vert_datum']}<br></td>
  </tr>\n";
}
?>
</table>
<a id='googlemap'></a>
<table style='width:500px;margin:20px 0px'>
  <tr class='gvegtablehead'>
    <th>Leaflet Map</th>
  </tr>
  <tr class='gtablecell'>
    <td class='caption'><div id='map' style='width:500px;height:300px'></div>
      <script src="../js/leaflet.js"></script>
      <script>
var map = L.map('map').setView([<?php echo $dec_lat; ?>, <?php echo $dec_long; ?>], 10);

L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
	attribution: 'Tiles &copy; Esri &mdash; Source: Esri, i-cubed, USDA, USGS, AEX, GeoEye, Getmapping, Aerogrid, IGN, IGP, UPR-EGP, and the GIS User Community'
}).addTo(map);

var myIcon = L.icon({
    iconUrl: '../images/mm_20_red.png',
    iconSize: [13, 21],
    labelAnchor: [7, 21]
});

var mkr = L.marker([<?php echo $dec_lat; ?>, <?php echo $dec_long; ?>], {icon: myIcon}).bindPopup('Benchmark <strong><?php echo $benchmark; ?></strong><br>Latitude: <?php echo round($dec_lat, 2); ?>&deg;<br>Longitude: <?php echo round($dec_long, 2); ?>&deg;').addTo(map);
      </script>
      <p>Leaflet Map (showing location of benchmark <strong>$abbr</strong>). This map requires JavaScript to be enabled in order to view map; if you cannot fully access the information on this page, please contact <a href='mailto:hhenkel@usgs.gov'>Heather Henkel</a></p>
      <p style='font-size:x-small'>References to non-<abbr title='United States'>U.S.</abbr> Department of the Interior (<abbr title='Department of the Interior'>DOI</abbr>) products do not constitute an endorsement by the <abbr title='Department of the Interior'>DOI</abbr>.</p>
    </td>
  </tr>
</table>
<?php require ($_SERVER['DOCUMENT_ROOT'] . '/../eden/ssi/eden-foot.php'); ?>