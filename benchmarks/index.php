<?php
$title = "<title>Benchmarks Network - Everglades Depth Estimation Network (EDEN)</title>\n";
$link = "<link rel='stylesheet' href='/eden/css/leaflet.css'>
  <link rel='stylesheet' href='/eden/css/leaflet.label.css'>\n";
$script = "<script src='/eden/js/leaflet.js'></script>
  <script src='/eden/js/leaflet.label-src.js'></script>\n";
require ($_SERVER['DOCUMENT_ROOT'] . '/eden/ssi/eden-head.php');
?>
<h2>Network of Benchmarks Used to Evaluate and Verify the EDEN Surface-Water Model</h2>
<table style="width:700px;border:3px solid #4b7e83;margin:10px auto">
  <tr>
    <td colspan="2" class="gtablecell2">An alphabetical <a href="#benchmarks">listing of benchmarks is available below</a>. Instructions for <a href="#howto">using the map are below</a>.</td>
  </tr>
  <tr>
    <td class="gtablecell">A network of benchmarks was established in the marshes of the greater Everglades and surveyed to North American Vertical Datum of 1988 in 2009-2010 to test, validate, and improve the Everglades Depth Estimation Network (EDEN) surface-water interpolation model that creates daily water-level surfaces for the Everglades. Thirty-four benchmarks were installed and surveyed in 2009 and 7 additional benchmarks were installed and surveyed in 2010. When these benchmarks are combined with the 31 benchmarks established by the Florida Department of Environmental Protection in 2006, the network of 72 benchmarks (2nd order or better) provide a geographically broad distribution of points of known elevation and measured water levels independent of the existing water-level gage network.<br><br><img src="../images/mm_20_blue.png" alt="Blue Icon" height="20" width="12"> <abbr title="South Florida Water Management District">SFWMD</abbr> Benchmarks<br><img src="../images/mm_20_green.png" alt="Green Icon" height="20" width="12" /> <abbr title="U.S. Army Corps of Engineers">USACE</abbr> Benchmarks</td>
    <td class="gtablecell">
      <div id="map" style="width:400px;height:440px"></div>
      <script>
var map = L.map('map').setView([25.9, -80.7], 8);

L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', { attribution: 'Tiles &copy; Esri &mdash; Source: Esri, i-cubed, USDA, USGS, AEX, GeoEye, Getmapping, Aerogrid, IGN, IGP, UPR-EGP, and the GIS User Community'}).addTo(map);

var blueIcon = L.icon({
    iconUrl: '../images/mm_20_blue.png',
    iconSize: [13, 21],
    labelAnchor: [7, 21]
});
var greenIcon = L.icon({
    iconUrl: '../images/mm_20_green.png',
    iconSize: [13, 21],
    labelAnchor: [7, 21]
});
<?php
require ($_SERVER['DOCUMENT_ROOT'] . '/eden/ssi/login.php');
mysql_select_db('benchmark');
$stations_query = 'select * from benchmark2 where kind = 1';
$stations_result = mysql_query($stations_query);
$stations_num_results = mysql_num_rows($stations_result);
for ($i = 0; $i < $stations_num_results; $i++) {
	$stations_row = mysql_fetch_array($stations_result);
	$abbr = str_replace('WCA', "<abbr title='Water Conservation Area'>WCA</abbr>", str_replace('ENP', "<abbr title='Everglades National Park'>ENP</abbr>", str_replace('BCNP', "<abbr title='Big Cypress National Preserve'>BCNP</abbr>", str_replace('BM', "<abbr title='benchmark'>BM</abbr>", $stations_row['benchmark']))));
	$benchmark[$i] = $stations_row['benchmark']; // Populate array to human-readable alphabatize benchmark list
	$stn = str_replace(' ', '_', str_replace('-', '_', $stations_row['benchmark']));
	$dec_lat = substr($stations_row['latitude'], 0, 2) + substr($stations_row['latitude'], 2, 2) / 60 + substr($stations_row['latitude'], 4) / 3600;
	$dec_long = substr($stations_row['longitude'], 0, 2) + substr($stations_row['longitude'], 2, 2) / 60 + substr($stations_row['longitude'], 4) / 3600;
	echo "\t\tvar $stn = L.marker([$dec_lat, -$dec_long], {icon: ";
	if($stations_row['utm_northing'])
		echo 'blueIcon';
	else
		echo 'greenIcon';
	echo "}).bindPopup(\"Benchmark <strong><a href='benchmark.php?benchmark={$stations_row['benchmark']}'>$abbr</a></strong><br />Latitude: " . round($dec_lat, 2) . '&deg;<br />Longitude: ' . round($dec_long, 2) . "&deg;\").bindLabel('{$stations_row['benchmark']}').addTo(map);\n";
}
?>
      </script>
    </td>
  </tr>
  <tr>
    <td colspan="2" class="gtablecell2"><a id="howto"></a>This map requires enabled JavaScript to view; if you cannot fully access the information on this map, please view the <a href="#benchmarks">benchmark listing below</a> or contact <a href="mailto:hhenkel@usgs.gov">Heather Henkel</a>.
      <p><strong>To use map:</strong> Click markers to view benchmark information. Use the + and - buttons in the upper-right corner to zoom in or out. You can double-click on the map to zoom in. Clicking and holding the mouse button, and then dragging, will allow you to pan in any direction.</p>
      <p style="font-size:x-small;">References to non-<abbr title='United States'>U.S.</abbr> Department of the Interior (<abbr title='Department of the Interior'>DOI</abbr>) products do not constitute an endorsement by the <abbr title='Department of the Interior'>DOI</abbr>.</p>
    </td>
  </tr>
</table>
<a id="benchmarks"></a>
<table style='width:400px;border:3px solid #4b7e83;margin:10px auto'>
  <tr><th class='gtablehead'>Benchmark Listing</th></tr>
<?php
// Generate array of BMs
natcasesort($benchmark);
$row_color = 0;
foreach ($benchmark as $a) {
	$query = "select benchmark from benchmark2 where benchmark = '$a'";
	$result = mysql_query($query);
	$row = mysql_fetch_array($result);
	echo "    <tr class='gtablecell";
	if ($row_color % 2)
		echo '2';
	$abbr = str_replace('WCA', "<abbr title='Water Conservation Area'>WCA</abbr>", str_replace('ENP', "<abbr title='Everglades National Park'>ENP</abbr>", str_replace('BCNP', "<abbr title='Big Cypress National Preserve'>BCNP</abbr>", str_replace('BM', "<abbr title='benchmark'>BM</abbr>", $row['benchmark']))));
	echo "'><td style='text-align:center'><a href='benchmark.php?benchmark={$row['benchmark']}'>$abbr</a></td></tr>\n";
	$row_color++;
}
?>
</table>
<?php require ($_SERVER['DOCUMENT_ROOT'] . '/eden/ssi/eden-foot.php'); ?>