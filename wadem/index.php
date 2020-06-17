<?php
require ($_SERVER['DOCUMENT_ROOT'] . '/../eden/ssi/login.php');
mysql_select_db('eden_new');

$result = mysql_query("SELECT REPLACE(short_name, '-', '_') AS sname, station_name_web, SUBSTR(latitude, 1, 2) + SUBSTR(latitude, 4, 2) / 60 + SUBSTR(latitude, 7) / 3600 AS lat, -(SUBSTR(longitude, 1, 2) + SUBSTR(longitude, 4, 2) / 60 + SUBSTR(longitude, 7) / 3600) AS `long`, convert_to_navd88_feet AS conv 
FROM station JOIN station_datum ON station.station_id = station_datum.station_id 
WHERE (display = 1 AND utm_northing < 2861000 AND utm_easting > 501900 AND ertp_ge_flag IS NOT NULL) 
OR station_name_web = 'EPSW' OR station_name_web = 'NCL' OR station_name_web = 'NMP' OR station_name_web = 'SPARO' OR station_name_web LIKE 'S12%' 
OR station_name_web = 'G-1502' OR station_name_web LIKE 'S332%' OR station_name_web LIKE 'S175%' OR station_name_web = 'S18C_T' OR station_name_web = 'BCA20' 
OR station_name_web = 'BCA9' OR station_name_web = 'BCA5' OR station_name_web LIKE 'LOOP%' OR station_name_web = 'EDEN_1' 
OR station_name_web = 'Tamiami_Canal_40-Mile_Bend_to_Monroe' OR station_name_web = 'S344_T' OR station_name_web LIKE 'S343%' OR station_name_web LIKE 'S333%' 
OR station_name_web LIKE 'S334%' GROUP BY station_name_web");
$num_results = mysql_num_rows($result);

$title = "<title>Wading Bird Depth Viewer -- Everglades Depth Estimation Network (EDEN)</title>\n";
$link = "<link rel='stylesheet' href='../css/leaflet.css'>\n";
$script = "<script src='../js/leaflet.js'></script>
  <script src='../js/jquery-3.1.1.min.js'></script>
  <script src='../js/jquery.tabify.min.js'></script>
  <script>
var imageBuf = [], imageBuf2 = [];
var loadCount = 0;
// determine number of surfaces to load
var file_count = {\n";
$dirs = array_filter(glob('wading_bird_depths/*'), 'is_dir');
foreach ($dirs as $dir) {
	$i = 0;
	$dir = substr($dir, 19);
	if ($handle = opendir('wading_bird_depths/' . $dir))
		while (($file = readdir($handle)) !== false)
			if (!in_array($file, array('.', '..', '.DS_Store')) && !is_dir('wading_bird_depths/' . $dir . $file)) 
				$i++;
	$script .= "$dir: $i, ";
}
$script .= " dummy: 0 };
var cnt = file_count['depth_2020'];

function incrementallyProcess(workerCallback, data, data2, chunkSize, timeout, completionCallback) {
  var itemIndex = 0;
  (function() {
    var remainingDataLength = (data.length - itemIndex);
    var currentChunkSize = (remainingDataLength >= chunkSize) ? chunkSize : remainingDataLength;
    if(itemIndex < data.length) {
      while(currentChunkSize--) {
      	itemIndex++;
        workerCallback(data[itemIndex], data2[itemIndex]);
      }
      setTimeout(arguments.callee, timeout);
    } else if(completionCallback) completionCallback();
  })();
}

// here we are using the above function to take 
// a short break every time we load an image
function initimg(imgList, imgList2) {
  incrementallyProcess(function(element, element2) {
    imageBuf[element] = new Image();
    imageBuf[element].onload = function(){ count() };
    imageBuf[element].src = element;
    imageBuf2[element2] = new Image();
    imageBuf2[element2].src = element2;
  }, imgList, imgList2, 1, 250, function() {
    document.getElementById('imgStatus').innerHTML = 'Loaded';
  });
}

function count() {
  loadCount++;
  document.getElementById('imgStatus').innerHTML = 'Loading image ' + loadCount + ' of ' + cnt;
}

function rangelngth() {
  document.getElementById('timerange').max = cnt - 1;
}

function preloadimgs() {
  loadCount=0;
  var dtrange=document.getElementById('dtSelect');
  if (dtrange == null)
    var selval = 'depth_2020';
  else
    var selval = dtrange.options[dtrange.selectedIndex].value;
  var selval2 = selval.replace('depth', 'rr');
  cnt = file_count[selval];
  document.getElementById('imgStatus').innerHTML = 'Loading images...'
  var imgList = [], imgList2 = [];
  for (var i = 0; i < cnt; i++){
    var timeval = '';
    if(i.toString().length < 2) timeval = '00' + i;
    else if(i.toString().length < 3) timeval = '0' + i;
    else timeval = i;
    imgList.push('wading_bird_depths/' + selval + '/trans0' + timeval + '.png');
    imgList2.push('wading_bird_depths/' + selval2 + '/trans0' + timeval + '.png');
  }
  initimg(imgList, imgList2);
};

function playpause() {
  if (document.getElementById('pp').value == 0) {
    //user hit play
    document.getElementById('pp').innerHTML = '&#9724';
    document.getElementById('pp').value = 1;
    var i = document.getElementById('timerange').value;
    timerId = setInterval(function() {
      if (document.getElementById('pp').value == 1 && i < cnt) {
        document.getElementById('timerange').value = i;
        imgtime(i);
        showdt(i);
      }
      else { //ran out of images, return to pause mode
      	document.getElementById('pp').innerHTML = '&#9658;';
      	document.getElementById('pp').value = 0;
      	clearInterval(timerId);
      }
      i++;
    }, 300);
  }
  else if (document.getElementById('pp').value == 1) {
    //user hit pause
    document.getElementById('pp').innerHTML = '&#9658;';
    document.getElementById('pp').value = 0;
    clearInterval(timerId);
  }
}

function step(i) {
  var j = document.getElementById('timerange').value;
      if ((i == -1 && j != 0) || (i == 1 && j != (cnt - 1))) {
        document.getElementById('timerange').value = parseInt(j) + i;
        imgtime(parseInt(j) + i);
        showdt(parseInt(j) + i);
      }
      return false;
}

function showPos(event, text) {
  var el, x, y;
  el = document.getElementById('PopUp');
  if (window.event) {
    x = window.event.clientX + document.documentElement.scrollLeft + document.body.scrollLeft;
    y = window.event.clientY + document.documentElement.scrollTop + document.body.scrollTop;
  }
  else {
    x = event.clientX + window.scrollX;
    y = event.clientY + window.scrollY;
  }
  x -= 2; y -= 150;
  y = y + 15;
  el.style.left = x + 'px';
  el.style.top = y + 'px';
  el.style.display = 'block';
  document.getElementById('PopUpText').innerHTML = text;
}

window.onload = setTimeout(function() { preloadimgs(); rangelngth(); }, 1000);
</script>\n";
$style = ".tabs {
	height: 39px
  }
  .no-js .tabs {
	display: none
  }
  .tab {
	float: left;
	line-height: 30px;
	background: #a0c1e7;
	padding: 10px;
	border: 1px solid #4b7e83;
	border-bottom: none;
	border-top-right-radius: 10px 12px;
	border-top-left-radius: 10px 12px
  }
  .tabs a {
	text-decoration: none; 
	color: #000; 
	font-weight: bold;
	font-family: Arial, Helvetica, sans-serif
  }
  .tab-active {
	background: #C4D58D
  }
  .tabcontentdiv {
	display:none;
	padding:0px;
	font-family: Arial, Helvetica, sans-serif;
  font-size: 14px;
  overflow-y: auto;
  position: relative;
  width: 1100px;
  height: 1225px;
  background: #fff8ca;
  margin-bottom: 0px;
  margin-right: 0px;
  border-left: 1px solid black;
  border-bottom: 1px solid black
  }
  .tabcontentdiv-active, .no-js .tabcontentdiv {
	display:block
  }\n";
require ($_SERVER['DOCUMENT_ROOT'] . '/../eden/ssi/eden-head.php');
?>
<p style="color:#009999"><strong><em>WADEM Wading Bird Viewer</em></strong></p>
<!--MAP STUFF-->
<div id="tabset">
<div class="tabs">
  <a href='#intro' class='tab'>Introduction</a>
  <a href='#inst' class='tab'>Instructions</a>
  <a href='#mapobjs' class='tab tab-active'>Water-Depth Map</a>
</div>
<div id="intro" class="tabcontentdiv">
  <h2><img src="../csss/CSSS1.jpg" alt="Photo of a sparrow" style="float:right;margin-left:5px">WADEM Wading Bird Viewer</h2>
  <h3>Monitoring water depths in wading bird habitats</h3>
  <p>Loren ipsum.</p>
  <p>Please send any questions or comments to the <a href="mailto:bmccloskey@usgs.gov">EDEN team</a>.</p>
</div>
<div id="inst" class="tabcontentdiv">
  <h2>Using the Cape Sable Seaside Sparrow (CSSS) Viewer</h2>
  <p>The WADEM Water-Depth Maps contain daily water depth based on the daily <abbr title='Everglades Depth Estimation Network'>EDEN</abbr> water-level surfaces, which are generated each day using water-level gage data, and ground elevation data. Water-depth values are displayed in both centimeters and inches (relative to North American Vertical Datum of 1988 (NAVD 88)). The data is served using the same 400 meters by 400 meters grid as other <abbr title='Everglades Depth Estimation Network'>EDEN</abbr> data. See details below ("Quality water-level data used to generate the daily water-level surfaces") about the daily water-level surfaces based on the quality of the water-level gage data.</p>
  <p>From the Water-Depth Map tab:</p>
  <ol>
    <li>Water-depth data
      <ol type="A">
        <li>Water-depth value ranges have been pre-selected for this version.</li>
        <li>To set the water-depth transparency level, move the slider from left (full transparency) to right (no transparency).</li>
      </ol>
    </li>
    <li>Setting data range
      <ol type="A">
        <li>Time periods have been pre-selected based on anticipated user needs for this version.</li>
        <li>To change dates, select the data range from the top drop down box.</li>
        <li>Once the time period is selected, the maps begin to load into the viewer. The status of the loading process is displayed in the bottom left of the viewing window ("Loading image..."). All of the daily maps are viewable when the status is 'Loaded'.</li>
      </ol>
    </li>
    <li>Animation of daily maps
      <ol type="A">
        <li>The map view can be animated using the arrow button which toggles the animation on and off.</li>
        <li>The Time range slider allows users to move quickly between maps without using the animation button.</li>
      </ol>
    </li>
    <li>Ground elevation data
      <ol type="A">
        <li>The ground elevation allows users to see the topography of dry areas.</li>
        <li>To set the ground elevation transparency level, move the slider from left (full transparency) to right (no transparency).</li>
      </ol>
    </li>
    <li>Locations of nearby water-level gages
      <ol type="A">
        <li>Gages will display on the viewer by checking the box next to "show gages." Deselecting the box will remove the gage markers.</li>
        <li>Current hydrographs at each gage can be viewed by clicking the gage pin on the map.
          <ul>
            <li>The hydrographs are those used for the <abbr title='Everglades Restoration Transition Plan'>ERTP</abbr> monitoring application for this beta version</li>
          </ul>
        </li>
      </ol>
    </li>
    <li>Zooming and Panning
      <ol type="A">
        <li>The map view can be zoomed in and out as well as panned using several methods
          <ul>
            <li>clicking on the "+" and "-" buttons in the upper-right of the map will zoom in or zoom out</li>
            <li>double-clicking the map will zoom in to that location</li>
            <li>clicking and holding the left mouse button allows you to move the map</li>
            <li>the arrow keys on the keyboard allows you to move around the map</li>
            <li>computer mice equipped with mouse wheels can use the wheels to zoom in and out</li>
          </ul>
        </li>
      </ol>
    </li>
    <li>Display date &mdash; the date of the map displayed is shown in the bottom right of the display window</li>
  </ol>
  <h3>Quality water-level data used to generate the daily water-level surfaces:</h3>
  <ul>
    <li>Water-level surfaces for the most recent quarter are based on real-time gage data. Real-time water-level data for the gages are transmitted daily by satellite or other telemetry and have received little or no review from the operating agency. The <abbr title='Everglades Depth Estimation Network'>EDEN</abbr> team uses the <abbr title='Automated Data Assurance and Management'>ADAM</abbr> software to quality-assure the data and estimate missing data. Subsequent reviews and edits of the data may result in significant revisions to the data.</li>
    <li>Water-level surfaces for all previous quarters in the current water year (<abbr title='October'>Oct</abbr> 1 to <abbr title='September'>Sept</abbr> 30) are based on provisional gage data. Provisional water-level data for the gages are provided on a quarterly basis from the operating agencies and have received some review and edits by them. For some agencies, the review is near final while for others, the review is preliminary. Then, the <abbr title='Everglades Depth Estimation Network'>EDEN</abbr> team uses the <abbr title='Automated Data Assurance and Management'>ADAM</abbr> software to further quality-assure the data and estimate missing data.</li>
    <li>Water-level surfaces for the water years prior to the current one are based on final gage data. Final water-level data for the gages are provided on an annual basis from the operating agencies. The <abbr title='Everglades Depth Estimation Network'>EDEN</abbr> team uses the <abbr title='Automated Data Assurance and Management'>ADAM</abbr> software to estimate missing data, if necessary.</li>
  </ul>
</div><!--End inst-->
<div id="mapobjs" class="tabcontentdiv tabcontentdiv-active" style="font-size:12px">
  <div id="map" style="float:left;width:1000px;height:1000px"></div>
  <div style="position:absolute;top:40px;left:1032px"><img src="wadem_legend.png" alt="water depth/recession rate legend">
    <div style="position:absolute;top:0px;left:35px">(<abbr title="centimeters">cm</abbr>)</div>
    <div style="position:absolute;top:300px;left:-28px;text-align:right;width:22px">(<abbr title="centimeters">cm/<br>day</abbr>)</div>
    <div style="position:absolute;top:28px;left:35px">43.53</div>
    <div style="position:absolute;top:37px;left:-28px;text-align:right;width:22px">1.02</div>
    <div style="position:absolute;top:76px;left:35px">31.36</div>
    <div style="position:absolute;top:85px;left:-28px;text-align:right;width:22px">0.78</div>
    <div style="position:absolute;top:124px;left:35px">19.88</div>
    <div style="position:absolute;top:133px;left:-28px;text-align:right;width:22px">0.51</div>
    <div style="position:absolute;top:172px;left:35px">13.29</div>
    <div style="position:absolute;top:181px;left:-28px;text-align:right;width:22px">0.2</div>
    <div style="position:absolute;top:220px;left:35px">2.63</div>
    <div style="position:absolute;top:229px;left:-28px;text-align:right;width:22px">0</div>
    <div style="position:absolute;top:268px;left:35px">-8.93</div>
    <div style="position:absolute;top:277px;left:-28px;text-align:right;width:22px">-0.41</div>
    <div style="position:absolute;top:-35px;left:30px">Water depth</div>
    <div style="position:absolute;top:330px;left:-30px">Recession rate</div>
  </div>
  <div style="position:absolute;top:555px;left:1035px"><img src="demLegend.PNG" alt="dem legend">
    <div style="position:absolute;top:-2px;left:35px">(<abbr title="centimeters">cm</abbr>)</div>
    <div style="position:absolute;top:15px;left:35px">400</div>
    <div style="position:absolute;top:130px;left:35px">0</div>
    <div style="position:absolute;top:-45px;left:-10px">Ground elevation (<abbr title="North American Vertical Datum of 1988">NAVD88</abbr>)</div>
  </div>
  <div style="position:absolute;top:905px;left:1015px"><img src="marker-icon-black-lrg-cr.png" alt="surface water gage marker">
    <div style="position:absolute;top:-43px;left:-5px">Surface water gage</div>
  </div>
  <div style="position:absolute;top:905px;left:1060px"><img src="marker-icon-grey-lrg-sq.png" alt="ground water gage marker">
    <div style="position:absolute;top:-43px;left:-5px">Ground water gage</div>
  </div>
  <div id="controls" style="position:relative;top:1025px;height:36px">
    <div id="dateList" style="position:absolute;left:10px">Select water depth/recession rate date range:
      <select id="dtSelect" onchange="imgtime('0'); showdt('0'); document.getElementById('timerange').value = 0; preloadimgs(); rangelngth()">
<?php
$yr = date('Y');
for ($i = 1991; $i <= $yr; $i++) {
  echo "        <option value='depth_$i'";
  if ($i == $yr) echo " selected='selected'";
  echo ">1/1/$i - 12/31/$i</option>\n";
}
?>
      </select>
      <div style="position:absolute;text-align:left;width:150px;top:35px;white-space:nowrap">
        Date range<br>
        <!-- need both onchange and oninput for IE to work, and for other browsers to update "live" -->
        <input id="timerange" type="range" min="0" max="1" value="0" style="width:150px" onchange="imgtime(value); showdt(value)" oninput="imgtime(value); showdt(value)">
      </div>
      <div style="position:absolute;left:175px;top:35px">
        <button id="pp" class="pure-button" value="0" onclick="playpause();">&#9658;</button>
      </div>
      <div id="imgStatus" style="position:absolute;top:80px;text-align:left;width:150px;font-size:12px"></div>
      <div style="position:absolute;top:35px;left:245px;width:120px;font-size:14px">Displayed date:<br><a href="" style="text-decoration:none" onclick="return step(-1);">&larr;</a>&nbsp;&nbsp;<span id="theDt" style="font-weight:bold">0/0/0000</span>&nbsp;&nbsp;<a href="" style="text-decoration:none" onclick="return step(1);">&rarr;</a></div>
    </div>
    <div style="text-align:left;position:absolute;left:500px;top:-7px;width:135px;background:white;padding:3px;border:2px solid black">
      <input type="checkbox" id="gages" name="gages" value="show" onclick="show_gages();">show gages<br><br>
    </div>
    <div id="WLsliders" style="position:absolute;left:765px">
      <div style="position:absolute;text-align:left;width:150px;white-space:nowrap">
        Water depth transparency<br>
        <input type="range" min="0" max="10" value="10" style="width:150px" onchange="imgtrans(value)" oninput="imgtrans(value)">
      </div>
      <div style="position:absolute;text-align:left;width:150px;top:45px;white-space:nowrap">
        Recession rate transparency<br>
        <input type="range" min="0" max="10" value="0" style="width:150px" onchange="rrtrans(value)" oninput="rrtrans(value)">
      </div>
      <div style="position:absolute;text-align:left;width:150px;top:110px;white-space:nowrap">
        Ground elevation transparency<br>
        <input type="range" min="0" max="10" value="0" style="width:150px" onchange="DEMtrans(value)" oninput="DEMtrans(value)">
      </div>
    </div>
  </div><!--End controls-->
</div><!--End mapobjs-->
</div> <!-- end tabset -->
<div id='PopUp' style='display:none;position:absolute;z-index:1000;border:solid black 1px;padding:10px;background-color:rgb(200,200,225);font-size:12px;width:380px;font-family:Arial;text-align:left' onclick="document.getElementById('PopUp').style.display = 'none';">
  <span id='PopUpText'>TEXT</span>
</div>
<script>
var map = L.map('map').setView([25.84, -80.88], 10);

L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
	maxZoom: 18,
	attribution: 'Map data <a href="http://openstreetmap.org">OpenStreetMap</a> contributors'
}).addTo(map);

var demUrl = 'dem.png',
	demimageBounds = [[25.168, -81.948], [26.654, -79.657]],
	demlayerOptions= { opacity: 0.0 };
var dem=L.imageOverlay(demUrl, demimageBounds,demlayerOptions).addTo(map);

var imageUrl = 'wading_bird_depths/depth_2020/trans0000.png',
	imageBounds = [[25.222, -81.363], [26.688, -80.222]],
	layerOptions= { opacity: 1.0 };
var eden=L.imageOverlay(imageUrl, imageBounds,layerOptions).addTo(map);

var rrimageUrl = 'wading_bird_depths/rr_2020/trans0000.png',
	rrimageBounds = [[25.222, -81.363], [26.688, -80.222]],
	rrlayerOptions= { opacity: 0.0 };
var rreden=L.imageOverlay(rrimageUrl, rrimageBounds,rrlayerOptions).addTo(map);

//Test positioning markers for x[c(1,287)], y[c(1,405)] image corners
//L.marker([25.227605198813173, -81.36337117642991]).addTo(map);
//L.marker([26.68680901635891, -81.36787994641337]).addTo(map);
//L.marker([25.226033500163712, -80.2276096550509]).addTo(map);
//L.marker([26.68513266924855, -80.21802662821094]).addTo(map);

var myIcon2 = L.icon({
    iconUrl: 'marker-icon-grey-lrg-sq.png',
    iconSize: [13, 21],
    labelAnchor: [7, 21]
});
var myIcon3 = L.icon({
    iconUrl: 'marker-icon-black-lrg-cr.png',
    iconSize: [13, 21],
    labelAnchor: [7, 21]
});

<?php
for ($i = 0; $i < $num_results; $i++) {
	$row = mysql_fetch_array($result);
	$wl_result = mysql_query("SELECT date, `stage_{$row['station_name_web']}` + {$row['conv']} AS stage FROM stage_daily WHERE `stage_{$row['station_name_web']}` IS NOT NULL ORDER BY date DESC LIMIT 1");
	$wl_row = mysql_fetch_array($wl_result);
	echo "var gage{$row['sname']} = L.marker([{$row['lat']}, {$row['long']}], { icon: myIcon";
	echo (substr($row['sname'], 0, 1) == 'G') ? 2 : 3;
	echo ", title: '{$row['sname']}'}).bindPopup('Gage: <strong><a href=\"../station.php?stn_name={$row['station_name_web']}\" target=\"_blank\">{$row['sname']}</a></strong> (<a href=\"../eve/index.php?site_list%5B%5D={$row['station_name_web']}\" target=\"_blank\"><abbr title=\"Explore and View EDEN\">EVE</abbr></a>)<br>" . round($row['lat'], 2) . "&deg;<abbr title=\"north\">N</abbr> " . round($row['long'], 2) . "&deg;<abbr title=\"west\">W</abbr><br><strong>{$wl_row['date']}</strong> Water Level: <strong>" . round($wl_row['stage'], 2) . " ft.</strong> <abbr title=\"North American Vertical Datum of 1988\">NAVD88</abbr><br><a href=\"/../eden/water_level_percentiles.php?name={$row['station_name_web']}&amp;type=gage\" target=\"_blank\"><img src=\"../thumbnails/{$row['station_name_web']}_monthly_thumb.jpg\" alt=\"{$row['sname']} hydrograph thumbnail\" height=\"160\" width=\"240\"><br><font size=\"1\">[larger graph with axes]</font></a>').addTo(map);
gage{$row['sname']}.setOpacity(0);\n";
}
?>

function imgtrans(transval) {
	eden.setOpacity(transval / 10);
}
function rrtrans(transval) {
	rreden.setOpacity(transval / 10);
}
function DEMtrans(transval) {
	dem.setOpacity(transval / 10);
}
function imgtime(timeval) {
	timeval = timeval.toString();
	var dtrange = document.getElementById("dtSelect");
	var selval = dtrange.options[dtrange.selectedIndex].value;
    var selval2 = selval.replace("depth", "rr");
	if (timeval.length < 2) timeval = '00' + timeval;
	if (timeval.length < 3) timeval = '0' + timeval;
	eden.setUrl("wading_bird_depths/" + selval + "/trans0" + timeval + ".png");
	rreden.setUrl("wading_bird_depths/" + selval2 + "/trans0" + timeval + ".png");
}
showdt(0);

function showdt(dy) {
	var dtrange = document.getElementById("dtSelect");
	var selval = new Date(dtrange.options[dtrange.selectedIndex].text.split('-')[0]);

	var strtdate = new Date(selval);

	var dt = new Date(strtdate);
	dt.setDate(strtdate.getDate() + parseInt(dy));
	var dd = ('0' + dt.getDate()).slice(-2);
	var mm = ('0' + (dt.getMonth() + 1)).slice(-2);
	var y = dt.getFullYear();
	fulldt = y + '-' + mm + '-' + dd;
	fulldt2 = 'a' + y + mm + dd;
	document.getElementById("theDt").innerHTML = fulldt;
}

function show_gages() {
	if(document.getElementById('gages').checked) {
<?php
mysql_data_seek($result, 0);
for ($i = 0; $i < $num_results; $i++) {
	$row = mysql_fetch_array($result);
	echo "gage{$row['sname']}.setOpacity(1);\n";
}
?>
	}
	else {
<?php
mysql_data_seek($result, 0);
for ($i = 0; $i < $num_results; $i++) {
	$row = mysql_fetch_array($result);
	echo "gage{$row['sname']}.setOpacity(0);\n";
}
?>
	}
}

var popup = L.popup();

$('#tabset').tabify({
  selector_tab: '.tab',
  selector_content: '.tabcontentdiv',
  tab_activeClass: 'tab-active',
  content_activeClass: 'tabcontentdiv-active'
});
</script>
<?php require ($_SERVER['DOCUMENT_ROOT'] . '/../eden/ssi/eden-foot.php'); ?>