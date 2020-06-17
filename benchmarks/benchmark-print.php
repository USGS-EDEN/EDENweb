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
$style = ".pagetopheaderprint { font-family: arial, helvetica, sans-serif; color: #000000; font-weight: bold; font-size: 1.25em }\n";
?>
<!DOCTYPE html>
<html lang='en'>
<head>
  <meta charset='utf-8'>
  <?php echo $title; ?>
  <link rel='stylesheet' href='/../eden/css/eden-dbweb-html5.css'>
  <?php echo $link; ?>
  <script src='https://www2.usgs.gov/scripts/analytics/usgs-analytics.js'></script>
  <?php echo $script; ?>
  <style>
    table { border-collapse: collapse }
    table, td, th { border: 1px solid #477489 }
    td, th { padding: 2px }
    .sectionheader {
      text-align: left;
      background-color: #e5f4cc
    }
    .desc {
      text-transform: none;
      font-size: 85%;
      font-style: italic;
      color:blue;
    }
    <?php echo $style; ?>
  </style>
</head>
<body>
<div style="width:100%;height:90px;background-color:#c5c5c5;padding:2px">
  <div style='float:left'>
    <a href='http://141.232.10.32/pm/recover/recover.aspx'><img src='/../eden/images/logos/recoverbl.gif' width='94' height='89' alt="The Journey to Restore America's Everglades - Recover Home Page"></a>
  </div>
  <div style='float:right'>
    <a href='http://www.nps.gov/'><img src='/../eden/images/logos/NPSlogosm-grbkgd.gif' alt='National Park Service Home Page' height='48' width='41'></a>
    <a href='http://www.sfwmd.gov/'><img src='/../eden/images/logos/sfwmd-logosm-grnbkgd.gif' alt='South Florida Water Management District Home Page' height='48' width='48'></a>
    <a href='http://www.usace.army.mil/'><img src='/../eden/images/logos/usace-logosm.gif' alt='U.S. Army Corps of Engineers Home Page' width='57' height='44'></a>
    <a href='http://www.usgs.gov'><img src='/../eden/images/logos/usgslogosm-black.gif' alt='U.S. Geological Survey Home Page' height='42' width='115'></a>
  </div>
  <div class='pagetopheader' style='color:black'>Everglades Depth Estimation Network (EDEN) for Support of Biological and Ecological Assessments</div>
</div>
<div style='clear:both'>
<div><!--Begin body of page -->
<h4>Network of Benchmarks Used to Evaluate and Verify the EDEN Surface-Water Model <?php echo " - Benchmark: $abbr"; ?></h4>
<?php
echo "<table style='width:100%'>
  <tr class='grytablehead'>
    <th colspan='2'>Benchmark Information for $abbr</th>
  </tr>
  <tr class='gtablecell' style='text-align:center'>
    <td colspan='2'>Data for benchmark provided by Originating Agency</td>
  </tr>
  <tr class='gtablecell'>
    <td style='vertical-align:top'><strong>Benchmark Designation:</strong> $abbr";
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
    <td style='width:280px'>";
echo file_exists("Benchmark_Sheets/images/medium/{$row['benchmark']}_closem.jpg") ? "<a href='Benchmark_Sheets/images/{$row['benchmark']}_closex.jpg'><img src='Benchmark_Sheets/images/medium/{$row['benchmark']}_closem.jpg' alt='close-up photo of {$row['benchmark']}' height='233' width='380'></a><br><strong>Close-up View</strong> [<a href='Benchmark_Sheets/images/{$row['benchmark']}_closex.jpg'>larger version</a>]<br><br>" : '';
echo file_exists("Benchmark_Sheets/images/medium/{$row['benchmark']}_horizonm.jpg") ? "<a href='Benchmark_Sheets/images/{$row['benchmark']}_horizonx.jpg'><img src='Benchmark_Sheets/images/medium/{$row['benchmark']}_horizonm.jpg' alt='horizon photo of {$row['benchmark']}' height='233' width='380'></a><br><strong>Horizon View</strong> [<a href='Benchmark_Sheets/images/{$row['benchmark']}_horizonx.jpg'>larger version</a>]<br><br>" : '';
echo !file_exists("Benchmark_Sheets/images/medium/{$row['benchmark']}_closem.jpg") && !file_exists("Benchmark_Sheets/images/medium/{$row['benchmark']}_horizonm.jpg") ? "<br> (no images are available for this benchmark)" : '';
?>
      <div id='map' style='width:380px;height:300px'></div>
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
      <p style='font-size:x-small'>Leaflet Map (showing location of benchmark <strong><?php echo $abbr; ?></strong>). This map requires JavaScript to be enabled in order to view map; if you cannot fully access the information on this page, please contact <a href='mailto:hhenkel@usgs.gov'>Heather Henkel</a></p>
      <p style='font-size:x-small'>References to non-<abbr title='United States'>U.S.</abbr> Department of the Interior (<abbr title='Department of the Interior'>DOI</abbr>) products do not constitute an endorsement by the <abbr title='Department of the Interior'>DOI</abbr>.</p>
    </td>
  </tr>
<?
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
<?php require ($_SERVER['DOCUMENT_ROOT'] . '/../eden/ssi/eden-foot.php'); ?>