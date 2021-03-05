<?php
require ($_SERVER['DOCUMENT_ROOT'] . '/../eden/ssi/login.php');

$area = htmlspecialchars($_GET['area']);
$area_long = $area;

$query = 'SELECT MAX(longitude) AS maxlong, MIN(longitude) AS minlong, MAX(latitude) AS maxlat, MIN(latitude) AS minlat FROM station, location WHERE display = 1 AND station.location_id = location.location_id AND (';

if ($area == 'WCA1')
	$query_sup = "station.location_id = 28 OR location_description LIKE '%Water Conservation Area 1%' OR location_description LIKE '%WCA1%')";
elseif ($area == 'WCA2')
	$query_sup = "station.location_id = 29 OR station.location_id = 30 OR location_description LIKE '%Water Conservation Area 2%' OR location_description LIKE '%WCA2%')";
elseif ($area == 'WCA3')
	$query_sup = "station.location_id = 31 OR station.location_id = 32 OR location_description LIKE '%Water Conservation Area 3%' OR location_description LIKE '%WCA3%')";
elseif ($area == 'Pennsuco') {
	$query_sup = "station.location_id = 26 OR location_description LIKE '%Pennsuco%')";
	$area_long = 'Pennsuco Wetlands';
}
elseif ($area == 'ENP') {
	$query_sup = "station.location_id = 3 OR location_description LIKE '%Everglades National Park%' OR location_description LIKE '%ENP%')";
	$area_long = 'Everglades National Park';
}
elseif ($area == 'FLBay') {
	$query_sup = "station.location_id = 4)";
	$area_long = 'Coast of Florida Bay';
}
elseif ($area == 'BCNP') {
	$query_sup = "station.location_id = 1 OR location_description LIKE '%Big Cypress%')";
	$area_long = 'Big Cypress National Preserve';
}
else {
	$query_sup = 'station.location_id = 5)';
	$area = 'GOM';
	$area_long = 'Coast of Gulf of Mexico';
}
$result = mysqli_query($db, $query.$query_sup);
$row1 = mysqli_fetch_array($result);
$result = mysqli_query($db, "SELECT * FROM station WHERE display = 1");
$num_results = mysqli_num_rows($result);

$title = "<title>$area_long - Everglades Depth Estimation Network (EDEN)</title>\n";
$link = "<link rel='stylesheet' href='./css/leaflet.css'>
  <link rel='stylesheet' href='./css/leaflet.label.css'>\n";
require ($_SERVER['DOCUMENT_ROOT'] . '/../eden/ssi/eden-head.php');
?>
<p style="text-align:center"><a href="stationlist-area.php?area=WCA1">WCA1</a> | <a href="stationlist-area.php?area=WCA2">WCA2</a> | <a href="stationlist-area.php?area=WCA3">WCA3</a> | <a href="stationlist-area.php?area=BCNP">Big Cypress National Preserve</a> | <a href="stationlist-area.php?area=ENP">Everglades National Park</a> | <a href="stationlist-area.php?area=Pennsuco">Pennsuco Wetlands</a> | 
<a href="stationlist-area.php?area=FLBay">Coast of Florida Bay</a> | <a href="stationlist-area.php?area=GOM">Coast of Gulf of Mexico</a></p>
<h4><?php echo $area_long ;?></h4>
<table style="width:500px;margin:20px auto">
  <tr>
    <th class="gtablehead"><?php echo $area_long; ?> Sub-Area Map</th>
  </tr>
  <tr>
    <td><div id='map' style='width:500px;height:700px'></div>
<script src="./js/leaflet.js"></script>
<script src="./js/leaflet.label-src.js"></script>
<script>
var map = L.map('map').setView([26, -81], 10);

L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
	attribution: 'Tiles &copy; Esri &mdash; Source: Esri, i-cubed, USDA, USGS, AEX, GeoEye, Getmapping, Aerogrid, IGN, IGP, UPR-EGP, and the GIS User Community'}).addTo(map);

var redIcon = L.icon({
    iconUrl: './images/mm_20_red.png',
    iconSize: [13, 21],
    labelAnchor: [7, 21]
});
var blueIcon = L.icon({
    iconUrl: './images/mm_20_blue.png',
    iconSize: [13, 21],
    labelAnchor: [7, 21]
});
var yellowIcon = L.icon({
    iconUrl: './images/mm_20_yellow.png',
    iconSize: [13, 21],
    labelAnchor: [7, 21]
});

var bcnp = L.polygon([[26.29243948727898, -80.88055324323044], [26.28391281170459, -81.34133363326492], [25.90601096187147, -81.34866064001515], [25.72337157151539, -81.15927159628075], [25.72401777863712, -81.11495050007326], [25.62041719906929, -81.03836555241259], [25.6203956152425, -80.87261155375845], [25.76235704442161, -80.87168136589031], [25.76243136639695, -80.82780880610119], [25.79026365469013, -80.85659134294818], [25.83430213668368, -80.8477243489933], [25.84930584246372, -80.84732362685787], [25.87902301052436, -80.84188392240438], [25.88539612288432, -80.83911292520121], [25.91142735654932, -80.83850252115873], [25.93544038129794, -80.83253586565731], [25.94903022004495, -80.83498508566122], [25.96108221655026, -80.83479372299981], [25.97671469516369, -80.83485991269026], [25.99068175361553, -80.84011393957709], [25.99949022153458, -80.87270390672339]], { weight: 3, color: '#3f00f3' }).bindLabel('BCNP', { direction: 'left' }).addTo(map);
var wca3 = L.polygon([[26.13992654674981, -80.87688396880287], [25.99979824686151, -80.87277326444112], [25.99057610639509, -80.84006376221569], [25.97655979314293, -80.83476452538056], [25.9480696064755, -80.83484414524538], [25.93555932085986, -80.83251004318484], [25.91131678363014, -80.83849947379758], [25.8852931853284, -80.83915954047271], [25.87902319863185, -80.84188291044808], [25.84894805019286, -80.84735207330878], [25.83445197659836, -80.84773895133314], [25.79020347505294, -80.85652223666484], [25.76173843478653, -80.82712001231835], [25.76205319879091, -80.67453384395219], [25.76090981965892, -80.67125765337775], [25.76111026489822, -80.48151849708536], [25.89189993819533, -80.48552843197187], [25.9421378668248, -80.43996792404526], [26.14597510559145, -80.44191340745854], [26.2368865910268, -80.46164102666626], [26.33501897048408, -80.53777204407092], [26.33138342533433, -80.83237221557458], [26.13710060053652, -80.82812493042769], [26.09397150097984, -80.84350382036278]], { weight: 3, color: '#00f33f' }).bindLabel('WCA3').addTo(map);
var wca2 = L.polygon([[26.33520936264871, -80.53765750235931], [26.23725206822644, -80.46185747610896], [26.14604776888217, -80.44189790834578], [26.12791385555449, -80.36697426033921], [26.18942561952843, -80.29779954094408], [26.35551268457727, -80.29744733519014], [26.37711212136802, -80.37315941790652], [26.47285672227085, -80.44686352550342]], { weight: 3, color: '#f33f00' }).bindLabel('WCA2').addTo(map);
var wca1 = L.polygon([[26.47714933446345, -80.4454521917575], [26.46929016521052, -80.44414177319362], [26.37711067987951, -80.37315900806919], [26.35560518922446, -80.29777030622476], [26.35649687679615, -80.29747489385406], [26.36463595176903, -80.28400503184803], [26.36450746588206, -80.25332964635082], [26.38547876235495, -80.23677948614628], [26.40909678084071, -80.23706693889331], [26.46855591385368, -80.22138898443175], [26.51273128210235, -80.22223981057091], [26.54202054248168, -80.23327076777944], [26.56264902088538, -80.24800514986566], [26.60180781621177, -80.27950467541099], [26.63367395654934, -80.33355622116454], [26.64762093365027, -80.34753533789133], [26.67990329116656, -80.36412033696672], [26.68479673043042, -80.36399939477867], [26.68501355535463, -80.37323843941753], [26.59203725702501, -80.44501995221012]], { weight: 3, color: '#3f00f3' }).bindLabel('WCA1').addTo(map);
var pennsuco = L.polygon([[25.926668, -80.453716], [25.89186158768311, -80.48547779965998], [25.76094362285704, -80.48143629072834], [25.76103502493015, -80.447964]], { weight: 3, color: '#3f00f3' }).bindLabel('Pennsuco').addTo(map);
var enp = L.polygon([[25.62037209001023, -80.8726064690574], [25.62048802877527, -81.03840522442265], [25.51104284239565, -80.93687167823133], [25.46769663968268, -80.84012145401937], [25.46339299777855, -80.88543574113648], [25.21429788339372, -80.75507698985456], [25.24566229166643, -80.58515466299652], [25.25456965761399, -80.43748171777648], [25.36049759739297, -80.46060089064095], [25.36029725247786, -80.57289961730866], [25.48249803363288, -80.5740371871359], [25.48257339292565, -80.55959187929558], [25.55055987855863, -80.56020749011667], [25.578557898524, -80.52815630603449], [25.59460588325699, -80.52808726940432], [25.6236050303049, -80.49637338035457], [25.68335898238649, -80.49841848479447], [25.68903948444039, -80.49506686866114], [25.76142206616078, -80.49625079412192], [25.76139976966777, -80.67176982622415], [25.76267354106274, -80.67489010253166], [25.76236083765563, -80.87167721888675]], { weight: 3, color: '#f33f00' }).bindLabel('ENP').addTo(map);
var gom = L.polygon([[25.88053760711531, -81.32261925226069], [25.8817589869959, -81.75602685978775], [25.47815573848232, -81.33254920231578], [25.2403986359386, -81.24666519671307], [25.23816045463755, -80.76756389728128], [25.46342286730155, -80.88535172870229], [25.46767481356929, -80.84007215981252], [25.51113288298663, -80.93695498025818], [25.62040500816077, -81.03836821646686], [25.72399169315638, -81.11496988424139], [25.72337539717205, -81.15935328911165]], { weight: 3, color: '#00f33f' }).bindLabel('Gulf of Mexico').addTo(map);
var flbay = L.polygon([[25.20300329988366, -80.8147456805238], [25.03435229917259, -80.81268387229878], [25.1069197500362, -80.40179957627855], [25.2546710296135, -80.43751136273966], [25.24572491482209, -80.58487672127104]], { weight: 3, color: '#00f33f' }).bindLabel('Florida Bay').addTo(map);
<?php
for ($i = 0; $i < $num_results; $i++) {
	$row = mysqli_fetch_array($result);
	$dec_lat = substr(substr($row['latitude'], 0, 2) + (substr($row['latitude'], 3, 2) / 60) + (substr($row['latitude'], 6) / 3600), 0, 8);
	$dec_long = -substr(substr($row['longitude'], 0, 2) + (substr($row['longitude'], 3, 2) / 60) + (substr($row['longitude'], 6) / 3600), 0, 8);
	echo "var mkr_$i = L.marker([$dec_lat, $dec_long], { icon: ";
	if ($row['realtime'] == 1)
		echo 'redIcon';
	else if ($row['realtime'] == 2)
		echo 'blueIcon';
	else if ($row['realtime'] == 0)
		echo 'yellowIcon';
	echo " }).bindPopup(\"EDEN Station <strong><a href='station.php?stn_name={$row['station_name_web']}";
	echo $row['station_name_web'] == 'S150_T' ? '&op_agency=SFWMD' : '';
	echo "'>{$row['station_name_web']}</a></strong><br>Latitude: " . round($dec_lat, 2) . "&deg;<br>Longitude: " . round($dec_long, 2) . "&deg;\").bindLabel('{$row['station_name_web']}').addTo(map);\n";
}
echo 'map.setView(' . strtolower($area) . '.getCenter());';
echo 'map.fitBounds(' . strtolower($area) . '.getBounds());';
?>
</script>
    </td>
  </tr>
  <tr>
    <td class="tablecell" style="text-align:center">
      <img src="images/mm_20_red.png" alt="Red Pin"> Real time <img src="images/mm_20_blue.png" alt="Blue Pin"> Non-real time <img src="images/mm_20_yellow.png" alt="Yellow Pin"> Discontinued
    </td>
  </tr>
  <tr>
    <td class="gtablecell2">
      <p>Leaflet Map showing EDEN sub-areas. This map requires enabled JavaScript to view; if you cannot fully access the information on this page, please contact <a href='mailto:bmccloskey@usgs.gov'>Bryan McCloskey</a>.</p>
      <p style="font-size:x-small">References to non-<abbr title='United States'>U.S.</abbr> Department of the Interior (<abbr title='Department of the Interior'>DOI</abbr>) products do not constitute an endorsement by the <abbr title='Department of the Interior'>DOI</abbr>.</p>
    </td>
  </tr>
</table>
<p>To view a station, click on the icon above. <strong>Please note: Not all stations may be viewable from this zoom level.</strong> Use the zoom tool, located in the upper-left corner of the map to zoom in or out.</p>
<table style="width:400px;margin:20px auto">
  <tr class="gtablehead">
    <th>
<?php
echo "$area_long EDEN Station Listing</th></tr>\n";
$result = mysqli_query($db, "SELECT station.* FROM station, location WHERE display = 1 AND station.location_id = location.location_id AND ($query_sup ORDER BY station_name_web");
$num_results = mysqli_num_rows($result);
for ($i = 0; $i < $num_results; $i++) {
	$row = mysqli_fetch_array($result);
	
	echo "<tr class='gtablecell";
	echo $i % 2 ? '2' : '';
	echo "' style='text-align:center'>";

	echo "<td><a href='station.php?stn_name={$row['station_name_web']}";
	echo $row['station_name_web'] == 'S150_T' ? '&op_agency=SFWMD' : '';
	echo "'>{$row['station_name_web']}</a></td></tr>\n";
}
?>
</table>
<?php require ($_SERVER['DOCUMENT_ROOT'] . '/../eden/ssi/eden-foot.php'); ?>