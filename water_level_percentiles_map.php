<?php
require ($_SERVER['DOCUMENT_ROOT'] . '/../eden/ssi/login.php');
mysql_select_db('eden_new');

$gage_result = mysql_query('SELECT station_name_web AS name, SUBSTRING(latitude, 1, 2) + SUBSTRING(latitude, 4, 2) / 60 + SUBSTRING(latitude, 7) / 3600 AS latitude, SUBSTRING(longitude, 1, 2) + SUBSTRING(longitude, 4, 2) / 60 + SUBSTRING(longitude, 7) / 3600 AS longitude FROM station WHERE ertp_ge_flag IS NOT NULL AND edenmaster_end = "curren" ORDER BY name');
$ti_result = mysql_query('SELECT island AS name, latitude, longitude FROM tree_islands ORDER BY `order`');
$gage_num_results = mysql_num_rows($gage_result);
$ti_num_results = mysql_num_rows($ti_result);
$title = "<title>Daily Water Level Percentiles by Month for Gages and Tree Islands - Everglades Depth Estimation Network (EDEN)</title>\n";
$link = "<link rel='stylesheet' href='./css/leaflet.css'>
  <link rel='stylesheet' href='./css/leaflet.label.css'>\n";
require ($_SERVER['DOCUMENT_ROOT'] . '/../eden/ssi/eden-head.php');
?>
<h3>Monitoring Water Levels Under the Everglades Restoration Transition Plan (ERTP) Using <abbr title='Everglades Depth Estimation Network'>EDEN</abbr></h3>
<p>On October 19, 2012, the <a href="http://www.evergladesplan.org/pm/program_docs/ertp.aspx">Everglades Restoration Transition Plan (ERTP)</a>, a new water control plan for the Central and South Florida project, replaced the <a href="http://www.saj.usace.army.mil/Portals/44/docs/Planning/EnvironmentalBranch/EnvironmentalDocs/IOP_02_SEIS_37.pdf">Interim Operational Plan (IOP)</a>, the previous water control plan.</p>
<p><abbr title='Everglades Depth Estimation Network'>EDEN</abbr> data is used to monitor water levels during the <abbr title="Everglades Restoration Transition Plan">ERTP</abbr> period and to compare current water levels during the <abbr title="Everglades Restoration Transition Plan">ERTP</abbr> period with the water levels that occurred during the <abbr title="Interim Operational Plan">IOP</abbr> (July 2002 through initiation of <abbr title="Everglades Restoration Transition Plan">ERTP</abbr> in 2012) period. </p>
<p>Two approaches are used to compare water levels in the Everglades during the <abbr title="Everglades Restoration Transition Plan">ERTP</abbr> period with water levels during the <abbr title="Interim Operational Plan">IOP</abbr> period. Both approaches plot daily median water levels during the <abbr title="Everglades Restoration Transition Plan">ERTP</abbr> period on plots showing daily water-level percentiles that are computed for each month (values of daily water levels that were not exceeded a given percentage of the time during a given month) using water-level data from the <abbr title="Interim Operational Plan">IOP</abbr> period in Water Conservation Areas 3A and 3B and Everglades National Park. The first approach generates these plots using <a href="#gages_treeislands">marsh water-level gages</a> and the second approach generates these plots at <a href="#gages_treeislands">tree islands</a>.</p>
<p>An <a href='water_level_percentiles_alert.php'>email notification informs stakeholders when current water levels reach specified elevations</a> at one or more gages or tree islands. An alert is triggered for a gage when the water-level elevation equals or exceeds the 90th percentile water level for the IOP period. An additional alert is triggered for tree islands when the water level equals or exceeds the maximum tree island ground elevation or when the water level equals or exceeds the 90th percentile for the month for the IOP period. <strong>To sign up for this email alert system</strong>, please <a href="mailto:bmccloskey@usgs.gov">contact us</a>.</p>
<p>To view information for a gage or tree island, click on the gage or tree island icon on the map. <strong>Please note: Not all gages and tree islands may be viewable from the current zoom level.</strong> Use the zoom tool, located in the upper-left corner of the map to zoom in or out.</p>
<div style="width:825px;margin:20px auto">
  <table style="width:315px;float:left;margin-bottom:20px">
    <tr class="grtablehead">
      <td colspan="2">
        <ul>
          <li>A <a href="#gages_treeislands">list of gages and tree islands</a> is available below.</li>
          <li><a href="/../eden/WCA3-ENP_treeislands-gages.kml">Download a Google Earth (KML)</a> file</li>
        </ul>
      </td>
    </tr>
    <tr class="gtablehead" style="font-size:small">
      <th colspan="2"><a id="gages_treeislands"></a>EDEN-domain <abbr title='Water Conservation Area 3 A'>WCA3A</abbr>, <abbr title='Water Conservation Area 3 B'>WCA3B,</abbr> and <abbr title='Everglades National Park'>ENP</abbr> Tree Island and Gage Listing</th>
    </tr>
    <tr>
      <td class="gtablecell" style="background-color:#f8f1bc;font-size:small" colspan='2'>Click on radio button to locate on map.<br>(Gages and tree islands with current water levels above 90th percentile for the month in <strong>bold</strong>.)</td>
    </tr>
    <tr class='gvegtablehead'>
      <td style='width:50%'><img src='images/cir_yel.png' alt='tree island marker'> Tree Island</td>
      <td><img src='images/tr_yel.png' alt='gage marker'> Gage</td>
    </tr>
<?php
$type = array('ti' => array('cir_', 'treeisland', 'Tree Island'), 'gage' => array('tr_', 'gage', 'Gage'));
$j = 0;
$pins = '';
foreach($type as $a => $b) {
	$num_results = $a . '_num_results';
	$result = $a . '_result';
	$names = $a . '_names'; //variable of names to construct table
  $r = $a . '_table';
	for ($i = 0; $i < $$num_results; $i++) {
		$row = mysql_fetch_array($$result);
		$filename = '/var/www/eden/table/' . $row['name'] . '.txt';
		$contents = trim(file_get_contents($filename));
		$rowcontents = explode("\n", $contents);
		$cur = explode("\t", array_shift($rowcontents));
		$mon = date('n', strtotime($cur[0])); //month of current day's data
		$cellcontents = explode("\t", $rowcontents[$mon - 1]); //0 indexed
		if ($cur[1] <= $cellcontents[5]) {
			$col = 'yel';
			${$names}[$i] = $row['name'];
		}
		else {
			$col = 'dkbl_alt';
			${$names}[$i] = '<strong>' . $row['name'] . '</strong>'; //highlight alerted gages & TIs in table
		}
		$pins .= "	var stn_$j = L.marker([{$row['latitude']}, -{$row['longitude']}], { icon: {$b[0]}$col }).bindPopup(\"$b[2]: <strong><a href='/../eden/water_level_percentiles.php?name={$row['name']}&amp;type=$b[1]' target='_blank'>{$row['name']}</a></strong><br>" . round($row['latitude'], 2) . "&deg;<abbr title='north'>N</abbr>, -" . round($row['longitude'], 2) . "&deg;<abbr title='west'>W</abbr><br>$cur[0] Water Level: <strong>" . round($cur[1], 2) . " ft.</strong><br><a href='/../eden/water_level_percentiles.php?name={$row['name']}&amp;type=$b[1]' target='_blank'><img src='thumbnails/{$row['name']}_monthly_thumb.jpg' alt='{$row['name']} hydrograph thumbnail' height='160' width='240'><br><span style='font-size:x-smaill'>[larger graph with axes]</span></a>\").bindLabel('{$row['name']}').addTo(map);
		document.getElementById('info$j').addEventListener('change', function () { stn_$j.openPopup(); });\n";
		${$r}[] = "<td><input type='radio' id='info$j' value='$j'> <a href='water_level_percentiles.php?name=" . strip_tags(${$names}[$i]) . "&amp;type=$b[1]'>" . ${$names}[$i] . "</a></td>\n";
		$j++;
	}
}
foreach($ti_table as $a => $b) {
  echo "<tr class='gtablecell";
  echo ($a % 2) ? '2' : '';
  echo "'>$b";
  echo ($gage_table[$a]) ? $gage_table[$a] : "<td></td>\n";
  echo "</tr>\n";
}
echo "</table>\n";
?>
  <table style="width:490px;float:right">
    <tr>
      <th class="grtablehead" colspan="2">Water-Level Alert Map</th>
    </tr>
    <tr>
      <td class="gtablecell" style="width:50%"><img src="images/tr_yel.png" alt="gage pin"> Gage</td>
      <td class="gtablecell" style="width:50%"><img src="images/cir_yel.png" alt="tree island pin"> Tree Island</td>
    </tr>
    <tr>
      <td class="gtablecell" style="font-size:x-small"><img src="images/tr_dkbl_alt.png" alt="gage alert pin"> Current water level equal or exceeds 90th percentile for month</td>
      <td class="gtablecell" style="font-size:x-small"><img src="images/cir_dkbl_alt.png" alt="tree island alert pin"> Current water level equal or exceeds 90th percentile for month</td>
    </tr>
    <tr>
      <td colspan="2">
        <div id="map" style="width:490px;height:1000px"></div>
<script src="./js/leaflet.js"></script>
<script src="./js/leaflet.label-src.js"></script>
<script>
var map = L.map('map').setView([25.85, -80.65], 10);

L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
	attribution: 'Tiles &copy; Esri &mdash; Source: Esri, i-cubed, USDA, USGS, AEX, GeoEye, Getmapping, Aerogrid, IGN, IGP, UPR-EGP, and the GIS User Community'
}).addTo(map);

var tr_dkbl_alt = L.icon({
    iconUrl: './images/tr_dkbl_alt.png',
    iconSize: [13, 13],
    labelAnchor: [7, 13]
});
var tr_yel = L.icon({
    iconUrl: './images/tr_yel.png',
    iconSize: [13, 13],
    labelAnchor: [7, 13]
});
var cir_dkbl_alt = L.icon({
    iconUrl: './images/cir_dkbl_alt.png',
    iconSize: [13, 13],
    labelAnchor: [7, 13]
});
var cir_yel = L.icon({
    iconUrl: './images/cir_yel.png',
    iconSize: [13, 13],
    labelAnchor: [7, 13]
});

var polygon_iop = L.polygon([[25.76111026489822, -80.48151849708536], [25.89189993819533, -80.48552843197187], [25.9421378668248, -80.43996792404526], [26.14597510559145, -80.44191340745854], [26.2368865910268, -80.46164102666626], [26.33501897048408, -80.53777204407092], [26.33138342533433, -80.83237221557458], [26.13710060053652, -80.82812493042769], [26.09397150097984, -80.84350382036278], [26.13992654674981, -80.87688396880287], [25.99979824686151, -80.87277326444112], [25.99057610639509, -80.84006376221569], [25.97655979314293, -80.83476452538056], [25.9480696064755, -80.83484414524538], [25.93555932085986, -80.83251004318484], [25.91131678363014, -80.83849947379758], [25.8852931853284, -80.83915954047271], [25.87902319863185, -80.84188291044808], [25.84894805019286, -80.84735207330878], [25.83445197659836, -80.84773895133314], [25.79020347505294, -80.85652223666484], [25.76173843478653, -80.82712001231835], [25.76236083765563, -80.87167721888675], [25.62037209001023, -80.8726064690574], [25.62048802877527, -81.03840522442265], [25.51104284239565, -80.93687167823133], [25.46769663968268, -80.84012145401937], [25.46339299777855, -80.88543574113648], [25.21429788339372, -80.75507698985456], [25.24566229166643, -80.58515466299652], [25.25456965761399, -80.43748171777648], [25.36049759739297, -80.46060089064095], [25.36029725247786, -80.57289961730866], [25.48249803363288, -80.5740371871359], [25.48257339292565, -80.55959187929558], [25.55055987855863, -80.56020749011667], [25.578557898524, -80.52815630603449], [25.59460588325699, -80.52808726940432], [25.6236050303049, -80.49637338035457], [25.68335898238649, -80.49841848479447], [25.68903948444039, -80.49506686866114], [25.76142206616078, -80.49625079412192], [25.76111026489822, -80.48151849708536]], { weight: 3, color: '#00f33f' }).addTo(map);
<?php echo $pins; ?>
map.setView(polygon_iop.getCenter());
map.fitBounds(polygon_iop.getBounds());
</script>
      </td>
    </tr>
    <tr>
      <td colspan="2" style="background-color:#f8f1bc">
        <p>Leaflet Map showing <abbr title="Everglades Depth Estimation Network">EDEN</abbr>-domain <abbr title="Water Conservation Area 3 A">WCA3A</abbr>, <abbr title="Water Conservation Area 3 B">WCA3B,</abbr> and <abbr title="Everglades National Park">ENP</abbr> gages and tree islands. This map requires enabled JavaScript to view; if you cannot fully access the information on this page, please contact <a href="mailto:hhenkel@usgs.gov">Heather Henkel</a>.</p>
        <p style="font-size:x-small">References to non-<abbr title="United States">U.S.</abbr> Department of the Interior (<abbr title="Department of the Interior">DOI</abbr>) products do not constitute an endorsement by the <abbr title="Department of the Interior">DOI</abbr>.</p>
      </td>
    </tr>
  </table>
</div>
<?php require ($_SERVER['DOCUMENT_ROOT'] . '/../eden/ssi/eden-foot.php'); ?>