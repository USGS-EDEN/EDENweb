<?php
require ($_SERVER['DOCUMENT_ROOT'] . '/../eden/ssi/login.php');

$int = $_GET['int'];
$result = mysqli_query($db, "SELECT REPLACE(short_name, '-', '_') AS sname, station_name_web, SUBSTR(latitude, 1, 2) + SUBSTR(latitude, 4, 2) / 60 + SUBSTR(latitude, 7) / 3600 AS lat, -(SUBSTR(longitude, 1, 2) + SUBSTR(longitude, 4, 2) / 60 + SUBSTR(longitude, 7) / 3600) AS `long`, convert_to_navd88_feet AS conv 
FROM station JOIN station_datum ON station.station_id = station_datum.station_id 
WHERE (display = 1 AND utm_northing < 2861000 AND utm_easting > 501900 AND ertp_ge_flag IS NOT NULL) 
OR station_name_web = 'EPSW' OR station_name_web = 'NCL' OR station_name_web = 'NMP' OR station_name_web = 'SPARO' OR station_name_web LIKE 'S12%' OR station_name_web = 'G-1502' OR station_name_web LIKE 'S332%' OR station_name_web LIKE 'S175%' OR station_name_web = 'S18C_T' OR station_name_web = 'BCA20' OR station_name_web = 'BCA9' OR station_name_web = 'BCA5' OR station_name_web LIKE 'LOOP%' OR station_name_web = 'EDEN_1' OR station_name_web = 'Tamiami_Canal_40-Mile_Bend_to_Monroe' OR station_name_web = 'S344_T' OR station_name_web LIKE 'S343%' OR station_name_web LIKE 'S333%' OR station_name_web LIKE 'S334%' GROUP BY station_name_web");
$num_results = mysqli_num_rows($result);

$title = "<title>CSSS Viewer - Everglades Depth Estimation Network (EDEN)</title>\n";
$link = "<link rel='stylesheet' href='../css/leaflet.css'>
  <link href='../css/jBox.css' rel='stylesheet'>\n";
$script = "<script src='../js/leaflet.js'></script>
  <script src='csss_extended_bounds.geojson'></script>
  <script src='por_stats.js'></script>
  <script src='../js/jquery-3.1.1.min.js'></script>
  <script src='../js/jquery.tabify.min.js'></script>
  <script src='../js/jBox.min.js'></script>
  <script>
var imageBuf = [];
var loadCount = 0;
// determine number of surfaces to load
var file_count = {\n";
$dirs = array_filter(glob('images/*'), 'is_dir');
foreach($dirs as $dir) {
  $i = 0;
  $dir = substr($dir, 7);
  if ($handle = opendir('images/' . $dir))
    while (($file = readdir($handle)) !== false)
      if (!in_array($file, array('.', '..', '.DS_Store')) && !is_dir('images/' . $dir . $file)) 
        $i++;
  $script .= "a$dir: $i, ";
}
$script .= " dummy: 0 };
var cnt = file_count['a2020'];

function incrementallyProcess(workerCallback, data, chunkSize, timeout, completionCallback) {
  var itemIndex = 0;
  (function() {
    var remainingDataLength = (data.length - itemIndex);
    var currentChunkSize = (remainingDataLength >= chunkSize) ? chunkSize : remainingDataLength;
    if (itemIndex < data.length) {
      while (currentChunkSize--)
        workerCallback(data[itemIndex++]);
      setTimeout(arguments.callee, timeout);
    } else if (completionCallback) completionCallback();
  })();
}

// here we are using the above function to take 
// a short break every time we load an image
function initimg(imgList) {
  incrementallyProcess(function(element) {
    imageBuf[element] = new Image();
    imageBuf[element].onload = function(){ count() };
    imageBuf[element].src = element;
  }, imgList, 1, 250, function() {
    document.getElementById('imgStatus').innerHTML='Loaded';
  });
}

function count() {
  loadCount++;
  document.getElementById('imgStatus').innerHTML='Loading image '+loadCount+' of '+cnt;
}

function rangelngth() {
  document.getElementById('timerange').max=cnt - 1;
}

function preloadimgs() {
  loadCount = 0;
  var dtrange=document.getElementById('dtSelect');
  if (dtrange == null)
    var selval = '2020';
  else
    var selval = dtrange.options[dtrange.selectedIndex].value;
  cnt = file_count['a' + selval];
  document.getElementById('imgStatus').innerHTML = 'Loading images...'
  var imgList = [];
  for (var i = 0; i < cnt; i++) {
    var timeval = '';
    if (i.toString().length < 2) timeval = '00' + i;
    else if (i.toString().length < 3) timeval = '0' + i;
    else timeval = i;
    imgList.push('../csss/images/' + selval + '/trans0' + timeval + '.png');
  }
  initimg(imgList);
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
  else if (document.getElementById('pp').value == 1){
    //user hit pause
    document.getElementById('pp').innerHTML = '&#9658;';
    document.getElementById('pp').value = 0;
    clearInterval(timerId);
  }
}

function step(i){
  var j = document.getElementById('timerange').value;
  if ((i == -1 && j != 0) || (i == 1 && j != (cnt - 1))) {
    document.getElementById('timerange').value=parseInt(j) + i;
    imgtime(parseInt(j) + i);
    showdt(parseInt(j) + i);
  }
  return false;
}

function step_year(i) {
  var j = document.getElementById('hydroSelect').value;
  if ((i == -1 && parseInt(j) != 1995) || (i == 1 && parseInt(j) != 2020)) {
    if (j.includes('_sd')) {
      var nw = (parseInt(j) + i) + '_sd';
      document.getElementById('hydroSelect').value = nw;
      hydrop.setUrl('hydrop4/four_year_hydroperiod_' + nw + '_altRange2.png');
      document.getElementById('theDt2').innerHTML = parseInt(nw);
    }
    else if(document.getElementById('mask_chk').checked) {
      var nw = (parseInt(j) + i) + '_mask65';
      document.getElementById('hydroSelect').value = nw;
      hydrop.setUrl('hydrop4/four_year_hydroperiod_' + nw + '_altRange2.png');
      document.getElementById('theDt2').innerHTML=parseInt(nw);
    }
    else {
      var nw = parseInt(j) + i;
      document.getElementById('hydroSelect').value = nw + '_mask65';
      hydrop.setUrl('hydrop4/four_year_hydroperiod_' + nw + '_altRange2.png');
      document.getElementById('theDt2').innerHTML = parseInt(nw);
    }
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
  background: #fff8ca
  }
  .tabcontentdiv {
  display: none;
  padding: 0px;
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
  display: block
  }
  .AXLabelborder, .ALabelborder, .A1Labelborder, .A2Labelborder, .BLabelborder, .CLabelborder, .DLabelborder, .ELabelborder, .FLabelborder {
  border-width: 3px;
  font-weight: bold
  }
  .AXLabelborder {
  border-color: #fc0;
  border-color: rgba(0,255,0,0.75)
  }
  .ALabelborder {
  border-color: #fc0;
  border-color: rgba(0,0,0,0.75)
  }
  .A1Labelborder {
  border-color: #000;
  border-color: rgba(255,204,0,0.75)
  }
  .A2Labelborder {
  border-color: #f0f;
  border-color: rgba(255,0,255,0.75)
  }
  .BLabelborder {
  border-color: #0ff;
  border-color: rgba(0,255,255,0.75)
  }
  .CLabelborder {
  border-color: #f00;
  border-color: rgba(255,0,0,0.75)
  }
  .DLabelborder {
  border-color: #0f0;
  border-color: rgba(128,255,128,0.75)
  }
  .ELabelborder {
  border-color: #00f;
  border-color: rgba(0,0,255,0.75)
  }
  .FLabelborder {
  border-color: #0fc;
  border-color: rgba(0,255,204,0.75)
  }
  .dyn {
  padding: 0px
  }
  .mod {
  color: #5c4d29;
  text-decoration: underline;
  }
  .jBox-Modal .jBox-title {
  background: #a0c1e7;
  }
  .jbox {
  font-weight: bold;
  font-family: Arial, Helvetica, sans-serif
  }\n";
require ($_SERVER['DOCUMENT_ROOT'] . '/../eden/ssi/eden-head.php');
?>
<p style="color:#009999"><strong><em>Cape Sable Seaside Sparrow (CSSS) Viewer</em></strong></p>
<!--MAP STUFF-->
<div id="tabset">
<div class="tabs">
  <a href='#intro' class='tab'>Introduction</a>
  <a href='#inst' class='tab'>Instructions</a>
  <a href='#mapobjs' class='tab tab-active'>Water-Depth Map</a>
  <a href='#sum' class='tab'>Summary Statistics</a>
</div>
<div id="intro" class="tabcontentdiv">
  <h2><img src="CSSS1.jpg" alt="Photo of a sparrow" style="float:right;margin-left:5px">Cape Sable Seaside Sparrow (CSSS) Viewer</h2>
  <h3>Monitoring water depths in <abbr title="Cape Sable seaside sparrow">CSSS</abbr> habitats A through F</h3>
  <p>The endangered Cape Sable seaside sparrow (CSSS) (<em>Ammodramus maritima mirabilis</em>) is one of eight remaining subspecies of seaside sparrow. The <abbr title="Cape Sable seaside sparrow">CSSS</abbr> once ranged throughout freshwater and brackish marsh habitats in southern Florida; the current known distribution is restricted to six separate subpopulation areas (A through F) in Everglades National Park. Changes in habitat and hydrology threaten the <abbr title="Cape Sable seaside sparrow">CSSS</abbr> with extinction, and efforts by regulatory and water-management agencies to protect and increase populations have been of limited success. The sparrows build their nests on the ground and up to six inches (about 17 centimeters) above the ground in mixed marl prairies. To increase nesting success, these short-hydroperiod prairies must remain mostly dry during the nesting season (March through July). Previously, a single water-level gage was used to estimate water depths in one or more subpopulation areas. Recently, several water-level gages used to estimate water depths in CSSS habitats were discontinued following a reduction in funding. An alternative and improved method for estimating and evaluating water depths was needed.</p>
  <p>The Everglades Depth Estimation Network (EDEN) provides daily water-level and water-depth surfaces for the freshwater Everglades for the period 1991 to current. The <abbr title="Cape Sable seaside sparrow">CSSS</abbr> Viewer was developed to use these surfaces to estimate and evaluate water levels and water depths in <abbr title="Cape Sable seaside sparrow">CSSS</abbr> habitat on a real-time basis. An animated viewer shows flooded areas and calculates 1) the percent area that is dry, 2) the percent area having water depth less than or equal to six inches of water, and 3) the percent area that has been dry for 90 days for more (baby birds are fledged from the nest in about 90 days), each day by subpopulation areas. Wildlife-resource scientists and managers can use the <abbr title="Cape Sable seaside sparrow">CSSS</abbr> Viewer to assess impacts on nesting success and develop management strategies for the future. Water-control managers can use these results to manage movement of water through water-control structures and, when possible, reduce flooding in these areas during the nesting season. This application of the <abbr title="Everglades Depth Estimation Network">EDEN</abbr> water-level and water-depth data demonstrates how scientists and resource managers can use <abbr title="Everglades Depth Estimation Network">EDEN</abbr> to analyze the effects of water management practices on vulnerable species in the Everglades.</p>
  <p>Please send any questions or comments to the <a href="mailto:bmccloskey@usgs.gov">EDEN team</a>.</p>
</div>
<div id="inst" class="tabcontentdiv">
  <h2>Using the Cape Sable Seaside Sparrow (CSSS) Viewer</h2>
  <p>The <abbr title="Cape Sable seaside sparrow">CSSS</abbr> Water-Depth Maps contain daily water depth based on the daily <abbr title='Everglades Depth Estimation Network'>EDEN</abbr> water-level surfaces, which are generated each day using water-level gage data, and ground elevation data. Water-depth values are displayed in both centimeters and inches (relative to North American Vertical Datum of 1988 (NAVD 88)). The data is served using the same 400 meters by 400 meters grid as other <abbr title='Everglades Depth Estimation Network'>EDEN</abbr> data. See details below ("Quality water-level data used to generate the daily water-level surfaces") about the daily water-level surfaces based on the quality of the water-level gage data.</p>
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
    <li>Four-year hydroperiod mean and standard deviation
      <ol type="A">
        <li>The four-year hydroperiod allows users to see the mean and standard deviation of annual hydroperiods. Mean four-year hydroperiod for a named year is the average yearly days where the water level is >0 for the previous four years (e.g., 2017 mean four-year hydroperiod is the mean of 2013-2016). Standard deviation is of the mean of those four years.</li>
        <li>To set the hydroperiod transparency level, move the slider for water depths from right (no transparency) to left (full transparency) and the slider for the hydroperiods from left (full transparency) to right (no transparency).</li>
        <li>You may step through the annual hydroperiod means or standard deviations using the left and right arrows.</li>
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
    <li>Subpopulation area daily statistics
      <ol type="A">
        <li>Several computations by subpopulation area are computed and displayed by clicking the boxes next to the items listed below. More information about these computations can be found by clicking on the linked text for each item. NOTE: Portions of subpopulation areas <a href="javascript:void(null)" onclick="showPos(event,'<img src=\'subpopulationB.png\' width=\'380\' height=\'290\'><br><br><span style=\'font-size:10px\'>Click to dismiss.</span>');">B</a>, <a href="javascript:void(null)" onclick="showPos(event,'<img src=\'subpopulationC.png\' width=\'380\' height=\'290\'><br><br><span style=\'font-size:10px\'>Click to dismiss.</span>');">C</a>, and <a href="javascript:void(null)" onclick="showPos(event,'<img src=\'subpopulationD.png\' width=\'380\' height=\'290\'><br><br><span style=\'font-size:10px\'>Click to dismiss.</span>');">D</a> are outside the EDEN model domain. The percentage of area computations includes only the subpopulation areas within the EDEN model domain. A <abbr title="comma-separated values">CSV</abbr> file of the subpopulation area statistics used in this application can be downloaded <a href="CSSS_subarea_stats.csv.zip">here</a>. Or download the latest year-by-year dry conditions <abbr title="portable document format">PDF</abbr> report <a href="csss_yr_cmp_report.pdf">here</a>.
          <ul>
            <li><u>% dry area</u> is the percent of the subpopulation area where water levels are below ground for the selected day</li>
            <li><u>% WD &#8804; 17 cm</u> is the percent of the subpopulation area where water depths are less than or equal to 17 centimeters for the selected day</li>
            <li><u>% dry &#8805; 40 days</u> is the percent of the subpopulation area where water levels have been below land surface for the last 40 consecutive days</li>
            <li><u>% dry &#8805; 90 days</u> is the percent of the subpopulation area where water levels have been below land surface for the last 90 consecutive days</li>
            <li><u>mean water depth</u> is the average <abbr title='centimeter'>cm</abbr> water depth of the pixels of the subpopulation area. Graphs of the subpopulation mean water depths are available for the previous <a href="recent_year_subpop_mean_water_depth.png">year</a>, <a href="recent_wet_seas_subpop_mean_water_depth.png">wet season</a>, <a href="recent_dry_seas_subpop_mean_water_depth.png">dry season</a>, <a href="recent_month_subpop_mean_water_depth.png">month</a>, and <a href="recent_week_subpop_mean_water_depth.png">week</a>.</li>
            <li><u>water depth sd</u> is the standard deviation of the <abbr title='centimeter'>cm</abbr> water depth of the pixels of the subpopulation area</li>
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
  <div style="position:absolute;top:40px;left:1032px"><img src="legend_bin.PNG" alt="water level legend">
    <div style="position:absolute;top:0px;left:35px">(<abbr title="centimeters">cm</abbr>)</div>
    <div style="position:absolute;top:0px;left:-25px;text-align:right;width:22px">(<abbr title="inches">in.</abbr>)</div>
    <div style="position:absolute;top:30px;left:35px">46</div>
    <div style="position:absolute;top:30px;left:-25px;text-align:right;width:22px">18.1</div>
    <div style="position:absolute;top:70px;left:35px">30</div>
    <div style="position:absolute;top:70px;left:-25px;text-align:right;width:22px">11.8</div>
    <div style="position:absolute;top:110px;left:35px">17</div>
    <div style="position:absolute;top:110px;left:-25px;text-align:right;width:22px">6.7</div>
    <div style="position:absolute;top:150px;left:35px">0</div>
    <div style="position:absolute;top:150px;left:-25px;text-align:right;width:22px">0</div>
    <div style="position:absolute;top:-35px;left:0px">Water depth</div>
  </div>
  <div style="position:absolute;top:275px;left:1032px"><img src="demLegend.PNG" alt="dem legend">
    <div style="position:absolute;top:-2px;left:35px">(<abbr title="centimeters">cm</abbr>)</div>
    <div style="position:absolute;top:-2px;left:-25px;text-align:right;width:22px">(<abbr title="inches">in.</abbr>)</div>
    <div style="position:absolute;top:15px;left:35px">400</div>
    <div style="position:absolute;top:15px;left:-25px;text-align:right;width:22px">157</div>
    <div style="position:absolute;top:130px;left:35px">0</div>
    <div style="position:absolute;top:130px;left:-25px;text-align:right;width:22px">0</div>
    <div style="position:absolute;top:-45px;left:-10px">Ground elevation (<abbr title="North American Vertical Datum of 1988">NAVD88</abbr>)</div>
  </div>
  <div style="position:absolute;top:500px;left:1032px"><img src="legend_4yhp2.png" alt="four-year hydroperiod legend">
    <div style="position:absolute;top:0px;left:34px">(days)</div>
    <div style="position:absolute;top:145px;left:-33px;text-align:right;width:30px">(<abbr title="centimeters">cm</abbr>)</div>
    <div style="position:absolute;top:24px;left:35px">220.3</div>
    <div style="position:absolute;top:26px;left:-33px;text-align:right;width:30px">-3.9</div>
    <div style="position:absolute;top:58px;left:35px">200.3</div>
    <div style="position:absolute;top:60px;left:-33px;text-align:right;width:30px">-13.9</div>
    <div style="position:absolute;top:92px;left:35px">163</div>
    <div style="position:absolute;top:94px;left:-33px;text-align:right;width:30px">-43.2</div>
    <div style="position:absolute;top:126px;left:35px">138.2</div>
    <div style="position:absolute;top:128px;left:-33px;text-align:right;width:30px">-58.4</div>
    <div style="position:absolute;top:-35px;left:-5px;text-align:right">Four-year hydroperiod</div>
    <div style="position:absolute;top:160px;left:-32px;text-align:left">Mean water depth</div>
  </div>
  <div style="position:absolute;top:760px;left:1032px"><img src="legend_4yhpsd2.png" alt="four-year hydroperiod standard deviation legend">
    <div style="position:absolute;top:0px;left:34px">(days)</div>
    <div style="position:absolute;top:145px;left:-33px;text-align:right;width:30px">(<abbr title="centimeters">cm</abbr>)</div>
    <div style="position:absolute;top:24px;left:35px">56.8</div>
    <div style="position:absolute;top:26px;left:-33px;text-align:right;width:30px">21.7</div>
    <div style="position:absolute;top:58px;left:35px">46.7</div>
    <div style="position:absolute;top:60px;left:-33px;text-align:right;width:30px">19.1</div>
    <div style="position:absolute;top:92px;left:35px">33.7</div>
    <div style="position:absolute;top:94px;left:-33px;text-align:right;width:30px">14.2</div>
    <div style="position:absolute;top:126px;left:35px">26.7</div>
    <div style="position:absolute;top:128px;left:-33px;text-align:right;width:30px">11.1</div>
    <div style="position:absolute;top:-45px;left:-15px;text-align:right">Four-year hydroperiod <abbr title="standard deviation">SD</abbr></div>
    <div style="position:absolute;top:160px;left:-32px;text-align:left">Mean water depth SD</div>
  </div>
  <div style="position:absolute;top:1050px;left:1000px"><img src="marker-icon-black-lrg-cr.png" alt="surface water gage marker">
    <div style="position:absolute;top:-43px;left:-5px">Surface water gage</div>
  </div>
  <div style="position:absolute;top:1050px;left:1060px"><img src="marker-icon-grey-lrg-sq.png" alt="ground water gage marker">
    <div style="position:absolute;top:-43px;left:-5px">Ground water gage</div>
  </div>
  <div id="controls" style="position:relative;top:1025px;height:36px">
    <div id="dateList" style="position:absolute;left:10px">Select water depth date range:
      <select id="dtSelect" onchange="imgtime('0'); showdt('0'); document.getElementById('timerange').value = 0; preloadimgs(); rangelngth();">
        <option disabled="disabled">Nesting season</option>
<?php
$yr = date('Y');
for ($i = 1992; $i <= $yr; $i++) echo "        <option value='{$i}_nest'>3/1/$i - 7/15/$i</option>\n";
echo "        <option disabled='disabled'>Calendar year</option>\n";
for ($i = 1992; $i <= $yr; $i++) {
  echo "        <option value='$i'";
  if ($i == $yr) echo " selected='selected'";
  echo ">1/1/$i - 12/31/$i</option>\n";
}
?>
      </select>
      <div style="position:absolute;text-align:left;width:150px;top:35px;white-space:nowrap">
        Date range<br>
        <!-- need both onchange and oninput for IE to work, and for other browsers to update "live" -->
        <input id="timerange" type="range" min="0" max="1" value="0" style="width:150px" onchange="imgtime(value); showdt(value);" oninput="imgtime(value); showdt(value);">
      </div>
      <div style="position:absolute;left:175px;top:35px">
        <button id="pp" class="pure-button" value="0" onclick="playpause();">&#9658;</button>
      </div>
      <div id="imgStatus" style="position:absolute;top:80px;text-align:left;width:150px;font-size:12px"></div>
      <div style="position:absolute;top:35px;left:245px;width:120px;font-size:14px">Displayed water depth date:<br><a href="" style="text-decoration:none" onclick="return step(-1);">&larr;</a>&nbsp;&nbsp;<span id="theDt" style="font-weight:bold">0/0/0000</span>&nbsp;&nbsp;<a href="" style="text-decoration:none" onclick="return step(1);">&rarr;</a></div>
    </div>
    <div id="hydroList" style="position:absolute;left:10px;top:100px">Select 4yr hydroperiod year:
      <select id="hydroSelect" onchange="if(document.getElementById('mask_chk').checked || document.getElementById('hydroSelect').value.indexOf('_sd')) hydrop.setUrl('hydrop4/four_year_hydroperiod_' + value + '_altRange2.png'); else hydrop.setUrl('hydrop4/four_year_hydroperiod_' + parseInt(value) + '_altRange2.png'); document.getElementById('theDt2').innerHTML = parseInt(value);">
        <option disabled="disabled">Four-year hydroperiod and stnd dev</option>
<?php
for ($i = 1995; $i <= $yr; $i++) {
  echo "        <option value='{$i}_mask65'";
  if ($i == $yr) echo " selected='selected'";
  echo ">$i mean hydroperiod</option>
        <option value='{$i}_sd'>$i hydro stnd dev</option>\n";
}
?>
      </select>
      <div style="position:absolute;top:35px;left:245px;width:120px;font-size:14px">Displayed hydroperiod year:<br><a href="" style="text-decoration:none" onclick="return step_year(-1);">&larr;</a>&nbsp;&nbsp;<span id="theDt2" style="font-weight:bold">2020</span>&nbsp;&nbsp;<a href="" style="text-decoration:none" onclick="return step_year(1);">&rarr;</a></div>
    </div>
    <div id="perdry" style="text-align:left;position:absolute;left:500px;top:-7px;width:135px;background:white;padding:3px;border:2px solid black">
      <input type="checkbox" id="gages" name="gages" value="show" onclick="show_gages();" checked>show gages<br>
      <strong>Sub-area statistics:</strong><br>
      <input type="checkbox" id="depth_mean" name="stat5" value="depth_mean" onclick="depth_mean();"><a href="javascript:void(null)" onclick="showPos(event,'Mean cm water depth of <abbr title=\'Cape Sable seaside sparrow\'>CSSS</abbr> subpopulation area based on the <abbr title=\'Everglades Depth Estimation Network\'>EDEN</abbr> daily water-level surface for a given day.<br><br><span style=\'font-size:10px\'>Click to dismiss.</span>');">mean water depth</a><br>
      <input type="checkbox" id="depth_sd" name="stat6" value="depth_sd" onclick="depth_sd();"><a href="javascript:void(null)" onclick="showPos(event,'Standard deviation cm of <abbr title=\'Cape Sable seaside sparrow\'>CSSS</abbr> subpopulation area based on the <abbr title=\'Everglades Depth Estimation Network\'>EDEN</abbr> daily water-level surface for a given day.<br><br><span style=\'font-size:10px\'>Click to dismiss.</span>');">water depth sd</a><br>
      <input type="checkbox" id="per_dry" name="stat" value="per_dry" onclick="per_dry();"><a href="javascript:void(null)" onclick="showPos(event,'Percent of <abbr title=\'Cape Sable seaside sparrow\'>CSSS</abbr> subpopulation area that is dry (water-level surface is below land surface) based on the <abbr title=\'Everglades Depth Estimation Network\'>EDEN</abbr> daily water-level surface for a given day.<br><br><span style=\'font-size:10px\'>Click to dismiss.</span>');">% dry area</a><br>
      <input type="checkbox" id="per_dry17cm" name="stat2" value="per_dry17cm" onclick="per_dry17cm();"><a href="javascript:void(null)" onclick="showPos(event,'Percent of <abbr title=\'Cape Sable seaside sparrow\'>CSSS</abbr> subpopulation area that has a water depth less than or equal to 17 centimeters (about six inches) based on the <abbr title=\'Everglades Depth Estimation Network\'>EDEN</abbr> daily water-level surface for a given day.<br><br><span style=\'font-size:10px\'>Click to dismiss.</span>');">% WD &#8804; 17cm</a><br>
      <input type="checkbox" id="per_dry40d" name="stat3" value="per_dry40d" onclick="per_dry40d();"><a href="javascript:void(null)" onclick="showPos(event,'Percent of <abbr title=\'Cape Sable seaside sparrow\'>CSSS</abbr> subpopulation area that has been dry for the previous 40 or more consecutive days based on the <abbr title=\'Everglades Depth Estimation Network\'>EDEN</abbr> daily water-level surface for a given day.<br><br><span style=\'font-size:10px\'>Click to dismiss.</span>');">% dry &#8805; 40 days</a><br>
      <input type="checkbox" id="per_dry90d" name="stat4" value="per_dry90d" onclick="per_dry90d();"><a href="javascript:void(null)" onclick="showPos(event,'Percent of <abbr title=\'Cape Sable seaside sparrow\'>CSSS</abbr> subpopulation area that has been dry for the previous 90 or more consecutive days based on the <abbr title=\'Everglades Depth Estimation Network\'>EDEN</abbr> daily water-level surface for a given day.<br><br><span style=\'font-size:10px\'>Click to dismiss.</span>');">% dry &#8805; 90 days</a>
    </div>
    <div id="WLsliders" style="position:absolute;left:765px">
      <div style="position:absolute;text-align:left;width:150px;white-space:nowrap">Water depth transparency<br>
        <input type="range" min="0" max="10" value="10" style="width:150px" onchange="imgtrans(value)" oninput="imgtrans(value)">
      </div>
      <div style="position:absolute;text-align:left;width:150px;top:45px;white-space:nowrap">
        Ground elevation transparency<br>
        <input type="range" min="0" max="10" value="0" style="width:150px" onchange="DEMtrans(value)" oninput="DEMtrans(value)">
      </div>
      <div style="position:absolute;text-align:left;width:150px;top:90px;white-space:nowrap">
        Four-year hydroperiod transparency<br>
        <input type="range" min="0" max="10" value="0" style="width:150px" onchange="hydrotrans(value)" oninput="hydrotrans(value)">
      </div>
      <div style="position:absolute;text-align:left;width:150px;top:135px;left:-20px;white-space:nowrap">
        <input type="checkbox" id="mask_chk" value="on" onclick="console.log(document.getElementById('hydroSelect').value.indexOf('_sd')); if(document.getElementById('mask_chk').checked || document.getElementById('hydroSelect').value.indexOf('_sd')==4) hydrop.setUrl('hydrop4/four_year_hydroperiod_'+document.getElementById('hydroSelect').value+'_altRange2.png'); else hydrop.setUrl('hydrop4/four_year_hydroperiod_'+parseInt(document.getElementById('hydroSelect').value)+'_altRange2.png');" checked><a href="javascript:void(null)" onclick="showPos(event,'Toggle the 35% opacity mask indicating the areas of greatest four-year hydroperiod standard deviation (&#8805; 58 days).<br><br><span style=\'font-size:10px\'>Click to dismiss.</span>');">High inter-annual hydroperiod variation</a>
      </div>
    </div>
  </div><!--End controls-->
</div><!--End mapobjs-->
<div id="sum" class="tabcontentdiv">
  <h2>Nesting Season/Annual Statistics for Critical Habitats</h2>
  <p>Summary statistics for the Cape Sable seaside sparrow critical habitats, showing percent of subpopulation areas dry during nesting season (March 1 through July 15) for at least 40 and 90 consecutive days; percent of subpopulation areas with discontinuous hydroperiods during the calendar year of 0 to 89, 90 to 210, and > 210 days; and mean four-year hydroperiod and standard deviation. A <abbr title="comma-separated values">CSV</abbr> file of these statistics used in this application can be downloaded <a href="CSSS_subarea_summary_stats.csv.zip">here</a>.</p>
  <p><strong>New: Popup statistics graphs now available; click column headings (e.g., "<span id='modalA402' class='mod'>&#8805; 40</span>") to view.</strong></p>
  <h3>Nesting Season Statistics: Consecutive dry days</h3>
  <table style="background-color:white">
    <tr style="background-color:#a0c1e7">
      <th>&nbsp;</th><th colspan="2">A Nesting</th><th colspan="2">AX Nesting</th><?php if($int) echo "<th colspan='2'>A1 Nesting</th><th colspan='2'>A2 Nesting</th>"; ?><th colspan="2">B Nesting</th><th colspan="2">C Nesting</th><th colspan="2">D Nesting</th><th colspan="2">E Nesting</th><th colspan="2">F Nesting</th>
    </tr>
    <tr style="background-color:#a0c1e7">
      <th style='width:30px'>Year</th>
      <th style='width:50px'><div id='modalA40' class='mod'>&#8805; 40</div></th><th style='width:50px'><div id='modalA90' class='mod'>&#8805; 90</div></th>
      <th style='width:50px'><div id='modalAX40' class='mod'>&#8805; 40</div></th><th style='width:50px'><div id='modalAX90' class='mod'>&#8805; 90</div></th>
<?php if($int) echo "      <th style='width:50px'><div id='modalA140' class='mod'>&#8805; 40</div></th><th style='width:50px'><div id='modalA190' class='mod'>&#8805; 90</a></th>
      <th style='width:50px'><div id='modalA240' class='mod'>&#8805; 40</div></th><th style='width:50px'><div id='modalA290' class='mod'>&#8805; 90</div></th>\n"; ?>
      <th style='width:50px'><div id='modalB40' class='mod'>&#8805; 40</div></th><th style='width:50px'><div id='modalB90' class='mod'>&#8805; 90</div></th>
      <th style='width:50px'><div id='modalC40' class='mod'>&#8805; 40</div></th><th style='width:50px'><div id='modalC90' class='mod'>&#8805; 90</div></th>
      <th style='width:50px'><div id='modalD40' class='mod'>&#8805; 40</div></th><th style='width:50px'><div id='modalD90' class='mod'>&#8805; 90</div></th>
      <th style='width:50px'><div id='modalE40' class='mod'>&#8805; 40</div></th><th style='width:50px'><div id='modalE90' class='mod'>&#8805; 90</div></th>
      <th style='width:50px'><div id='modalF40' class='mod'>&#8805; 40</div></th><th style='width:50px'><div id='modalF90' class='mod'>&#8805; 90</div></th>
    </tr>
    <tr><td style='background-color:#a0c1e7'>1991</td><td>87.4%</td><td>0%</td><td>90.1%</td><td>1.4%</td><?php if($int) echo '<td>100%</td><td>5.5%</td><td>100%</td><td>0%</td>'; ?><td>100%</td><td>32.3%</td><td>100%</td><td>82.6%</td><td>97.2%</td><td>19.5%</td><td>100%</td><td>27.9%</td><td>100%</td><td>78.8%</td></tr>
    <tr><td style='background-color:#a0c1e7'>1992</td><td>56.3%</td><td>25.9%</td><td>65.7%</td><td>41%</td><?php if($int) echo '<td>100%</td><td>74.5%</td><td>100%</td><td>95.7%</td>'; ?><td>95.2%</td><td>90.7%</td><td>100%</td><td>100%</td><td>97.6%</td><td>80.9%</td><td>100%</td><td>99.1%</td><td>100%</td><td>100%</td></tr>
    <tr><td style='background-color:#a0c1e7'>1993</td><td>2.9%</td><td>0.2%</td><td>5.7%</td><td>0.4%</td><?php if($int) echo '<td>0%</td><td>0%</td><td>39.4%</td><td>2.6%</td>'; ?>	<td>78.1%</td><td>60.1%</td><td>98.7%</td><td>97.5%</td><td>72.8%</td><td>58.5%</td><td>91.8%</td><td>62.4%</td><td>100%</td><td>100%</td></tr>
    <tr><td style='background-color:#a0c1e7'>1994</td><td>22.9%</td><td>3.1%</td><td>34.2%</td><td>8%</td><?php if($int) echo '<td>53.9%</td><td>10.5%</td><td>97.4%</td><td>37.1%</td>'; ?><td>94.6%</td><td>73%</td><td>96.2%</td><td>82.2%</td><td>56.5%</td><td>22.8%</td><td>99.7%</td><td>70.2%</td><td>100%</td><td>100%</td></tr>
    <tr><td style='background-color:#a0c1e7'>1995</td><td>0%</td><td>0%</td><td>0%</td><td>0%</td><?php if($int) echo '<td>0%</td><td>0%</td><td>0%</td><td>0%</td>'; ?><td>70.4%</td><td>44.7%</td><td>98.7%</td><td>89.8%</td><td>58.1%</td><td>20.3%</td><td>46.2%</td><td>19.1%</td><td>100%</td><td>99.3%</td></tr>
    <tr><td style='background-color:#a0c1e7'>1996</td><td>21.5%</td><td>2.3%</td><td>37.1%</td><td>9.8%</td><?php if($int) echo '<td>80.8%</td><td>22.1%</td><td>97.7%</td><td>28.8%</td>'; ?><td>79.1%</td><td>42%</td><td>100%</td><td>43.2%</td><td>88.2%</td><td>34.1%</td><td>82%</td><td>48.9%</td><td>100%</td><td>86.8%</td></tr>
    <tr><td style='background-color:#a0c1e7'>1997</td><td>22.5%</td><td>10.5%</td><td>34.3%</td><td>21.4%</td><?php if($int) echo '<td>62.7%</td><td>34.9%</td><td>100%</td><td>82.5%</td>'; ?><td>86.5%</td><td>55.1%</td><td>100%</td><td>81.4%</td><td>94.3%</td><td>70.7%</td><td>98.6%</td><td>35.4%</td><td>100%</td><td>100%</td></tr>
    <tr><td style='background-color:#a0c1e7'>1998</td><td>27.2%</td><td>5.6%</td><td>38.2%</td><td>8.6%</td><?php if($int) echo '<td>85.9%</td><td>27.8%</td><td>89.7%</td><td>10.9%</td>'; ?><td>87.5%</td><td>47.5%</td><td>98.3%</td><td>95.3%</td><td>58.1%</td><td>17.5%</td><td>95.8%</td><td>44.7%</td><td>100%</td><td>100%</td></tr>
    <tr><td style='background-color:#a0c1e7'>1999</td><td>37.3%</td><td>8%</td><td>50.8%</td><td>15.2%</td><?php if($int) echo '<td>100%</td><td>32.8%</td><td>100%</td><td>47.7%</td>'; ?><td>100%</td><td>71%</td><td>100%</td><td>100%</td><td>100%</td><td>72%</td><td>100%</td><td>79.6%</td><td>100%</td><td>100%</td></tr>
    <tr><td style='background-color:#a0c1e7'>2000</td><td>30.1%</td><td>13.4%</td><td>45.1%</td><td>23%</td><?php if($int) echo '<td>100%</td><td>63.6%</td><td>98.3%</td><td>47.4%</td>'; ?><td>90.9%</td><td>73.8%</td><td>100%</td><td>95.8%</td><td>79.3%</td><td>40.2%</td><td>97.5%</td><td>65.2%</td><td>100%</td><td>100%</td></tr>
    <tr><td style='background-color:#a0c1e7'>2001</td><td>84.1%</td><td>39.6%</td><td>87.5%</td><td>52.6%</td><?php if($int) echo '<td>100%</td><td>100%</td><td>100%</td><td>100%</td>'; ?><td>100%</td><td>100%</td><td>100%</td><td>100%</td><td>100%</td><td>89%</td><td>100%</td><td>99.5%</td><td>100%</td><td>100%</td></tr>
    <tr><td style='background-color:#a0c1e7'>2002</td><td>73.5%</td><td>25.1%</td><td>79.2%</td><td>40.4%</td><?php if($int) echo '<td>100%</td><td>85.9%</td><td>100%</td><td>99.7%</td>'; ?><td>99.6%</td><td>62.3%</td><td>100%</td><td>100%</td><td>100%</td><td>68.7%</td><td>98.9%</td><td>59.7%</td><td>100%</td><td>100%</td></tr>
    <tr><td style='background-color:#a0c1e7'>2003</td><td>36.6%</td><td>2.8%</td><td>48%</td><td>5.7%</td><?php if($int) echo '<td>81.5%</td><td>2.9%</td><td>100%</td><td>34.4%</td>'; ?><td>41.2%</td><td>25.5%</td><td>96.6%</td><td>58.9%</td><td>21.5%</td><td>18.3%</td><td>66%</td><td>23.8%</td><td>100%</td><td>10.6%</td></tr>
    <tr><td style='background-color:#a0c1e7'>2004</td><td>51.4%</td><td>29.4%</td><td>61.8%</td><td>44.2%</td><?php if($int) echo '<td>100%</td><td>92.8%</td><td>100%</td><td>100%</td>'; ?><td>100%</td><td>93.3%</td><td>100%</td><td>100%</td><td>98.4%</td><td>84.1%</td><td>100%</td><td>90%</td><td>100%</td><td>100%</td></tr>
    <tr><td style='background-color:#a0c1e7'>2005</td><td>55.9%</td><td>24.8%</td><td>65.4%</td><td>39.3%</td><?php if($int) echo '<td>100%</td><td>85%</td><td>100%</td><td>99%</td>'; ?><td>99.7%</td><td>83%</td><td>100%</td><td>100%</td><td>76.4%</td><td>55.7%</td><td>100%</td><td>93.4%</td><td>100%</td><td>100%</td></tr>
    <tr><td style='background-color:#a0c1e7'>2006</td><td>56.8%</td><td>33.5%</td><td>66.1%</td><td>47.8%</td><?php if($int) echo '<td>100%</td><td>100%</td><td>100%</td><td>99.3%</td>'; ?><td>98.5%</td><td>43.7%</td><td>100%</td><td>100%</td><td>84.6%</td><td>57.3%</td><td>100%</td><td>64.7%</td><td>100%</td><td>100%</td></tr>
    <tr><td style='background-color:#a0c1e7'>2007</td><td>28.6%</td><td>6.3%</td><td>43.9%</td><td>17.6%</td><?php if($int) echo '<td>97.1%</td><td>35.8%</td><td>99.3%</td><td>58.9%</td>'; ?><td>91.5%</td><td>35.6%</td><td>100%</td><td>97.5%</td><td>69.5%</td><td>18.7%</td><td>98.3%</td><td>36.4%</td><td>100%</td><td>100%</td></tr>
    <tr><td style='background-color:#a0c1e7'>2008</td><td>64.1%</td><td>22.6%</td><td>71.8%</td><td>37%</td><?php if($int) echo '<td>100%</td><td>85.5%</td><td>100%</td><td>95.7%</td>'; ?><td>100%</td><td>69.6%</td><td>100%</td><td>99.2%</td><td>95.1%</td><td>20.3%</td><td>100%</td><td>74.8%</td><td>100%</td><td>100%</td></tr>
    <tr><td style='background-color:#a0c1e7'>2009</td><td>72.9%</td><td>16.3%</td><td>78.7%</td><td>33.3%</td><?php if($int) echo '<td>100%</td><td>81.3%</td><td>100%</td><td>84.8%</td>'; ?><td>100%</td><td>67%</td><td>100%</td><td>86.9%</td><td>100%</td><td>20.3%</td><td>100%</td><td>15.8%</td><td>100%</td><td>100%</td></tr>
    <tr><td style='background-color:#a0c1e7'>2010</td><td>29.9%</td><td>10.9%</td><td>42.4%</td><td>18.7%</td><?php if($int) echo '<td>87.4%</td><td>39.4%</td><td>100%</td><td>58.9%</td>'; ?><td>77.3%</td><td>58.6%</td><td>100%</td><td>94.5%</td><td>48.4%</td><td>22.8%</td><td>85.1%</td><td>66.3%</td><td>100%</td><td>60.3%</td></tr>
    <tr><td style='background-color:#a0c1e7'>2011</td><td>74.4%</td><td>62.3%</td><td>79.9%</td><td>70.4%</td><?php if($int) echo '<td>100%</td><td>100%</td><td>100%</td><td>100%</td>'; ?><td>100%</td><td>99.6%</td><td>100%</td><td>100%</td><td>100%</td><td>93.5%</td><td>100%</td><td>100%</td><td>100%</td><td>100%</td></tr>
    <tr><td style='background-color:#a0c1e7'>2012</td><td>57%</td><td>11.5%</td><td>66.2%</td><td>20.3%</td><?php if($int) echo '<td>100%</td><td>53.5%</td><td>100%</td><td>46%</td>'; ?><td>98.4%</td><td>22.6%</td><td>100%</td><td>8.5%</td><td>82.5%</td><td>0.8%</td><td>99.7%</td><td>8%</td><td>100%</td><td>35.8%</td></tr>
    <tr><td style='background-color:#a0c1e7'>2013</td><td>37.6%</td><td>0.6%</td><td>51%</td><td>1.6%</td><?php if($int) echo '<td>99.6%</td><td>2.7%</td><td>99.7%</td><td>6.3%</td>'; ?><td>73.8%</td><td>13%</td><td>100%</td><td>8.9%</td><td>64.2%</td><td>2%</td><td>94.8%</td><td>0%</td><td>100%</td><td>100%</td></tr>
    <tr><td style='background-color:#a0c1e7'>2014</td><td>67.5%</td><td>23.3%</td><td>74.5%</td><td>35.6%</td><?php if($int) echo '<td>100%</td><td>75%</td><td>100%</td><td>98.7%</td>'; ?><td>95%</td><td>67.8%</td><td>100%</td><td>100%</td><td>91.9%</td><td>46.3%</td><td>99.5%</td><td>74.9%</td><td>100%</td><td>100%</td></tr>
    <tr><td style='background-color:#a0c1e7'>2015</td><td>48.9%</td><td>33.5%</td><td>59.9%</td><td>47.6%</td><?php if($int) echo '<td>100%</td><td>99.4%</td><td>100%</td><td>99.3%</td>'; ?><td>95.9%</td><td>30.5%</td><td>100%</td><td>97.5%</td><td>87.8%</td><td>6.5%</td><td>100%</td><td>45.6%</td><td>100%</td><td>100%</td></tr>
    <tr><td style='background-color:#a0c1e7'>2016</td><td>11.2%</td><td>4%</td><td>14.1%</td><td>4.8%</td><?php if($int) echo '<td>53.1%</td><td>18.1%</td><td>3.6%</td><td>1.3%</td>'; ?><td>69.5%</td><td>31.9%</td><td>44.9%</td><td>3.4%</td><td>4.9%</td><td>3.7%</td><td>19.6%</td><td>5.2%</td><td>1.3%</td><td>0%</td></tr>
    <tr><td style='background-color:#a0c1e7'>2017</td><td>54.4%</td><td>32.3%</td><td>64.2%</td><td>46.8%</td><?php if($int) echo '<td>100%</td><td>98.7%</td><td>100%</td><td>99.7%</td>'; ?><td>79.2%</td><td>69.2%</td><td>100%</td><td>100%</td><td>75.2%</td><td>59.8%</td><td>92.8%</td><td>79.6%</td><td>100%</td><td>100%</td></tr>
    <tr><td style='background-color:#a0c1e7'>2018</td><td>50.5%</td><td>0.6%</td><td>60.9%</td><td>1.8%</td><?php if($int) echo '<td>99.8%</td><td>3.4%</td><td>98%</td><td>6.3%</td>'; ?><td>78.2%</td><td>18%</td><td>100%</td><td>14.4%</td><td>77.6%</td><td>5.7%</td><td>86.1%</td><td>5.6%</td><td>100%</td><td>80.8%</td></tr>
    <tr><td style='background-color:#a0c1e7'>2019</td><td>31.2%</td><td>19.1%</td><td>46%</td><td>33.7%</td><?php if($int) echo '<td>100%</td><td>82.5%</td><td>98%</td><td>83.8%</td>'; ?><td>62.6%</td><td>55.1%</td><td>100%</td><td>100%</td><td>61.8%</td><td>40.7%</td><td>87.8%</td><td>79.9%</td><td>100%</td><td>100%</td></tr>
  </table>
  <h3>Annual Statistics: Non-consecutive hydroperiod</h3>
  <table style="background-color:white">
    <tr style="background-color:#a0c1e7">
      <th>&nbsp;</th><th colspan="3">A Annual</th><th colspan="3">AX Annual</th><?php if($int) echo "<th colspan='3'>A1 Annual</th><th colspan='3'>A2 Annual</th>"; ?><th colspan="3">B Annual</th><th colspan="3">C Annual</th><th colspan="3">D Annual</th><th colspan="3">E Annual</th><th colspan="3">F Annual</th>
    </tr>
    <tr style="background-color:#a0c1e7">
      <th style='width:30px'>Year</th>
      <th style='width:45px'><div id='modalA0_89' class='mod'>0 to 89</div></th><th style='width:45px'><div id='modalA90_210' class='mod'>90 to 210</div></th><th style='width:45px'><div id='modalA211' class='mod'>&#8805; 211</div></th>
      <th style='width:45px'><div id='modalAX0_89' class='mod'>0 to 89</div></th><th style='width:45px'><div id='modalAX90_210' class='mod'>90 to 210</div></th><th style='width:45px'><div id='modalAX211' class='mod'>&#8805; 211</div></th>
<?php if($int) echo "      <th style='width:45px'><div id='modalA10_89' class='mod'>0 to 89</div></th><th style='width:45px'><div id='modalA190_210' class='mod'>90 to 210</div></th><th style='width:45px'><div id='modalA1211' class='mod'>&#8805; 211</div></th>
      <th style='width:45px'><div id='modalA20_89' class='mod'>0 to 89</div></th><th style='width:45px'><div id='modalA290_210' class='mod'>90 to 210</div></th><th style='width:45px'><div id='modalA2211' class='mod'>&#8805; 211</div></th>\n"; ?>
      <th style='width:45px'><div id='modalB0_89' class='mod'>0 to 89</div></th><th style='width:45px'><div id='modalB90_210' class='mod'>90 to 210</div></th><th style='width:45px'><div id='modalB211' class='mod'>&#8805; 211</div></th>
      <th style='width:45px'><div id='modalC0_89' class='mod'>0 to 89</div></th><th style='width:45px'><div id='modalC90_210' class='mod'>90 to 210</div></th><th style='width:45px'><div id='modalC211' class='mod'>&#8805; 211</div></th>
      <th style='width:45px'><div id='modalD0_89' class='mod'>0 to 89</div></th><th style='width:45px'><div id='modalD90_210' class='mod'>90 to 210</div></th><th style='width:45px'><div id='modalD211' class='mod'>&#8805; 211</div></th>
      <th style='width:45px'><div id='modalE0_89' class='mod'>0 to 89</div></th><th style='width:45px'><div id='modalE90_210' class='mod'>90 to 210</div></th><th style='width:45px'><div id='modalE211' class='mod'>&#8805; 211</div></th>
      <th style='width:45px'><div id='modalF0_89' class='mod'>0 to 89</div></th><th style='width:45px'><div id='modalF90_210' class='mod'>90 to 210</div></th><th style='width:45px'><div id='modalF211' class='mod'>&#8805; 211</div></th>
    </tr>
    <tr><td style='background-color:#a0c1e7'>1991</td><td>0%</td><td>11.6%</td><td>88.4%</td><td>0%</td><td>24.8%</td><td>75.2%</td><?php if($int) echo '<td>0%</td><td>61.5%</td><td>38.5%</td><td>0%</td><td>63.6%</td><td>36.4%</td>'; ?><td>27.4%</td><td>50.7%</td><td>21.9%</td><td>91.9%</td><td>8.1%</td><td>0%</td><td>12.6%</td><td>57.7%</td><td>29.7%</td><td>35.7%</td><td>59.4%</td><td>4.9%</td><td>94.7%</td><td>5.3%</td><td>0%</td></tr>
    <tr><td style='background-color:#a0c1e7'>1992</td><td>0%</td><td>22.6%</td><td>77.4%</td><td>0%</td><td>38.4%</td><td>61.6%</td><?php if($int) echo '<td>0%</td><td>88%</td><td>12%</td><td>0%</td><td>97%</td><td>3%</td>'; ?><td>26.8%</td><td>56.9%</td><td>16.4%</td><td>91.5%</td><td>8.5%</td><td>0%</td><td>32.9%</td><td>44.3%</td><td>22.8%</td><td>32.6%</td><td>67.2%</td><td>0.2%</td><td>100%</td><td>0%</td><td>0%</td></tr>
    <tr><td style='background-color:#a0c1e7'>1993</td><td>0%</td><td>0.2%</td><td>99.8%</td><td>0%</td><td>0.6%</td><td>99.4%</td><?php if($int) echo '<td>0%</td><td>0%</td><td>100%</td><td>0%</td><td>4.3%</td><td>95.7%</td>'; ?><td>34.8%</td><td>26.9%</td><td>38.3%</td><td>44.1%</td><td>54.7%</td><td>1.3%</td><td>8.5%</td><td>52.4%</td><td>39%</td><td>31.2%</td><td>34.5%</td><td>34.3%</td><td>92.7%</td><td>7.3%</td><td>0%</td></tr>
    <tr><td style='background-color:#a0c1e7'>1994</td><td>0%</td><td>2.1%</td><td>97.9%</td><td>0%</td><td>6.9%</td><td>93.1%</td><?php if($int) echo '<td>0%</td><td>14.1%</td><td>85.9%</td><td>0%</td><td>22.8%</td><td>77.2%</td>'; ?><td>20.9%</td><td>52.2%</td><td>26.9%</td><td>16.1%</td><td>80.1%</td><td>3.8%</td><td>3.7%</td><td>51.6%</td><td>44.7%</td><td>4.9%</td><td>75.4%</td><td>19.7%</td><td>68.2%</td><td>31.8%</td><td>0%</td></tr>
    <tr><td style='background-color:#a0c1e7'>1995</td><td>0%</td><td>0%</td><td>100%</td><td>0%</td><td>0%</td><td>100%</td><?php if($int) echo '<td>0%</td><td>0%</td><td>100%</td><td>0%</td><td>0%</td><td>100%</td>'; ?><td>6.4%</td><td>31.2%</td><td>62.4%</td><td>8.5%</td><td>50%</td><td>41.5%</td><td>0%</td><td>5.7%</td><td>94.3%</td><td>0%</td><td>5.5%</td><td>94.5%</td><td>49.7%</td><td>27.2%</td><td>23.2%</td></tr>
    <tr><td style='background-color:#a0c1e7'>1996</td><td>0%</td><td>0.1%</td><td>99.9%</td><td>0%</td><td>0.2%</td><td>99.8%</td><?php if($int) echo '<td>0%</td><td>0%</td><td>100%</td><td>0%</td><td>1.3%</td><td>98.7%</td>'; ?><td>32.8%</td><td>27%</td><td>40.1%</td><td>57.2%</td><td>41.5%</td><td>1.3%</td><td>5.7%</td><td>52.4%</td><td>41.9%</td><td>17.4%</td><td>26.3%</td><td>56.3%</td><td>88.7%</td><td>11.3%</td><td>0%</td></tr>
    <tr><td style='background-color:#a0c1e7'>1997</td><td>0%</td><td>2.8%</td><td>97.2%</td><td>0%</td><td>6%</td><td>94%</td><?php if($int) echo '<td>0%</td><td>20.2%</td><td>79.8%</td><td>0%</td><td>6%</td><td>94%</td>'; ?><td>18.7%</td><td>30.8%</td><td>50.5%</td><td>14.4%</td><td>85.6%</td><td>0%</td><td>3.7%</td><td>54.9%</td><td>41.5%</td><td>7.4%</td><td>28.2%</td><td>64.4%</td><td>88.7%</td><td>11.3%</td><td>0%</td></tr>
    <tr><td style='background-color:#a0c1e7'>1998</td><td>0%</td><td>0.7%</td><td>99.3%</td><td>0%</td><td>2.2%</td><td>97.8%</td><?php if($int) echo '<td>0%</td><td>6.3%</td><td>93.7%</td><td>0%</td><td>4.3%</td><td>95.7%</td>'; ?><td>25.1%</td><td>13.8%</td><td>61.1%</td><td>59.3%</td><td>33.1%</td><td>7.6%</td><td>6.5%</td><td>19.9%</td><td>73.6%</td><td>14.6%</td><td>16.5%</td><td>69%</td><td>94.7%</td><td>5.3%</td><td>0%</td></tr>
    <tr><td style='background-color:#a0c1e7'>1999</td><td>0%</td><td>0.1%</td><td>99.9%</td><td>0%</td><td>0.2%</td><td>99.8%</td><?php if($int) echo '<td>0%</td><td>0%</td><td>100%</td><td>0%</td><td>1.3%</td><td>98.7%</td>'; ?><td>24.5%</td><td>22.1%</td><td>53.4%</td><td>8.5%</td><td>80.1%</td><td>11.4%</td><td>2.8%</td><td>29.3%</td><td>67.9%</td><td>2.7%</td><td>31%</td><td>66.3%</td><td>55%</td><td>44.4%</td><td>0.7%</td></tr>
    <tr><td style='background-color:#a0c1e7'>2000</td><td>0.9%</td><td>8.1%</td><td>91%</td><td>2.2%</td><td>15.6%</td><td>82.2%</td><?php if($int) echo '<td>6.5%</td><td>45.3%</td><td>48.2%</td><td>3.6%</td><td>28.5%</td><td>67.9%</td>'; ?><td>32.6%</td><td>28.3%</td><td>39.1%</td><td>8.5%</td><td>91.5%</td><td>0%</td><td>3.7%</td><td>33.7%</td><td>62.6%</td><td>20.4%</td><td>28.5%</td><td>51.1%</td><td>95.4%</td><td>4.6%</td><td>0%</td></tr>
    <tr><td style='background-color:#a0c1e7'>2001</td><td>0%</td><td>24.8%</td><td>75.2%</td><td>0%</td><td>40.6%</td><td>59.4%</td><?php if($int) echo '<td>0%</td><td>95%</td><td>5%</td><td>0%</td><td>97.4%</td><td>2.6%</td>'; ?><td>24.9%</td><td>64.4%</td><td>10.8%</td><td>8.9%</td><td>91.1%</td><td>0%</td><td>3.7%</td><td>76.4%</td><td>19.9%</td><td>14.3%</td><td>81.3%</td><td>4.4%</td><td>86.1%</td><td>13.9%</td><td>0%</td></tr>
    <tr><td style='background-color:#a0c1e7'>2002</td><td>0%</td><td>6.1%</td><td>93.9%</td><td>0%</td><td>11.9%</td><td>88.1%</td><?php if($int) echo '<td>0%</td><td>38.5%</td><td>61.5%</td><td>0%</td><td>15.2%</td><td>84.8%</td>'; ?><td>26.4%</td><td>29.6%</td><td>44.1%</td><td>25.4%</td><td>74.6%</td><td>0%</td><td>9.3%</td><td>49.2%</td><td>41.5%</td><td>13.6%</td><td>25.2%</td><td>61.1%</td><td>84.8%</td><td>15.2%</td><td>0%</td></tr>
    <tr><td style='background-color:#a0c1e7'>2003</td><td>0%</td><td>6.2%</td><td>93.8%</td><td>0%</td><td>10.9%</td><td>89.1%</td><?php if($int) echo '<td>0%</td><td>35.4%</td><td>64.6%</td><td>0%</td><td>13.2%</td><td>86.8%</td>'; ?><td>20.6%</td><td>24.3%</td><td>55.1%</td><td>10.2%</td><td>80.9%</td><td>8.9%</td><td>3.7%</td><td>27.6%</td><td>68.7%</td><td>5.8%</td><td>26.2%</td><td>68%</td><td>4.6%</td><td>68.9%</td><td>26.5%</td></tr>
    <tr><td style='background-color:#a0c1e7'>2004</td><td>0%</td><td>5.2%</td><td>94.8%</td><td>0%</td><td>11%</td><td>89%</td><?php if($int) echo '<td>0%</td><td>35.2%</td><td>64.8%</td><td>0%</td><td>14.2%</td><td>85.8%</td>'; ?><td>35.9%</td><td>34.6%</td><td>29.5%</td><td>41.1%</td><td>58.9%</td><td>0%</td><td>19.9%</td><td>39.8%</td><td>40.2%</td><td>19.6%</td><td>33.2%</td><td>47.2%</td><td>89.4%</td><td>10.6%</td><td>0%</td></tr>
    <tr><td style='background-color:#a0c1e7'>2005</td><td>0%</td><td>4%</td><td>96%</td><td>0%</td><td>11%</td><td>89%</td><?php if($int) echo '<td>0%</td><td>26.7%</td><td>73.3%</td><td>0%</td><td>29.1%</td><td>70.9%</td>'; ?><td>22.5%</td><td>59.6%</td><td>18%</td><td>3%</td><td>96.2%</td><td>0.8%</td><td>2.8%</td><td>52.4%</td><td>44.7%</td><td>3.1%</td><td>57.5%</td><td>39.3%</td><td>2.6%</td><td>97.4%</td><td>0%</td></tr>
    <tr><td style='background-color:#a0c1e7'>2006</td><td>0.1%</td><td>8.8%</td><td>91.2%</td><td>0.1%</td><td>15%</td><td>84.9%</td><?php if($int) echo '<td>0.2%</td><td>49.9%</td><td>49.9%</td><td>0.7%</td><td>16.2%</td><td>83.1%</td>'; ?><td>29%</td><td>47.2%</td><td>23.8%</td><td>90.3%</td><td>9.7%</td><td>0%</td><td>17.5%</td><td>50.8%</td><td>31.7%</td><td>29.9%</td><td>32.9%</td><td>37.1%</td><td>100%</td><td>0%</td><td>0%</td></tr>
    <tr><td style='background-color:#a0c1e7'>2007</td><td>4.4%</td><td>17.3%</td><td>78.4%</td><td>11.5%</td><td>25.1%</td><td>63.4%</td><?php if($int) echo '<td>28%</td><td>58.1%</td><td>13.9%</td><td>30.5%</td><td>62.9%</td><td>6.6%</td>'; ?><td>28.6%</td><td>41.5%</td><td>29.8%</td><td>66.5%</td><td>33.5%</td><td>0%</td><td>6.5%</td><td>52.8%</td><td>40.7%</td><td>37%</td><td>34.8%</td><td>28.2%</td><td>100%</td><td>0%</td><td>0%</td></tr>
    <tr><td style='background-color:#a0c1e7'>2008</td><td>0%</td><td>35.2%</td><td>64.8%</td><td>0%</td><td>48.6%</td><td>51.4%</td><?php if($int) echo '<td>0%</td><td>97.9%</td><td>2.1%</td><td>0%</td><td>100%</td><td>0%</td>'; ?><td>29%</td><td>56.7%</td><td>14.3%</td><td>4.7%</td><td>95.3%</td><td>0%</td><td>3.7%</td><td>72.8%</td><td>23.6%</td><td>2.4%</td><td>95%</td><td>2.7%</td><td>16.6%</td><td>83.4%</td><td>0%</td></tr>
    <tr><td style='background-color:#a0c1e7'>2009</td><td>0.2%</td><td>6.7%</td><td>93.1%</td><td>0.4%</td><td>13.4%</td><td>86.1%</td><?php if($int) echo '<td>0%</td><td>42.7%</td><td>57.3%</td><td>3%</td><td>18.2%</td><td>78.8%</td>'; ?><td>23.3%</td><td>33.6%</td><td>43.1%</td><td>6.4%</td><td>58.1%</td><td>35.6%</td><td>3.7%</td><td>16.7%</td><td>79.7%</td><td>5.3%</td><td>24.3%</td><td>70.4%</td><td>52.3%</td><td>47.7%</td><td>0%</td></tr>
    <tr><td style='background-color:#a0c1e7'>2010</td><td>0%</td><td>15.1%</td><td>84.9%</td><td>0%</td><td>24.1%</td><td>75.9%</td><?php if($int) echo '<td>0%</td><td>64.2%</td><td>35.8%</td><td>0%</td><td>52.6%</td><td>47.4%</td>'; ?><td>26.5%</td><td>27.6%</td><td>45.9%</td><td>11.4%</td><td>87.7%</td><td>0.8%</td><td>3.7%</td><td>22.8%</td><td>73.6%</td><td>9.7%</td><td>39.3%</td><td>50.9%</td><td>19.2%</td><td>80.8%</td><td>0%</td></tr>
    <tr><td style='background-color:#a0c1e7'>2011</td><td>3.1%</td><td>21.2%</td><td>75.7%</td><td>8.1%</td><td>30.8%</td><td>61.2%</td><?php if($int) echo '<td>25.7%</td><td>71.8%</td><td>2.5%</td><td>10.9%</td><td>70.9%</td><td>18.2%</td>'; ?><td>31.7%</td><td>42.6%</td><td>25.7%</td><td>36.9%</td><td>63.1%</td><td>0%</td><td>11.8%</td><td>57.7%</td><td>30.5%</td><td>26.5%</td><td>59.9%</td><td>13.6%</td><td>96%</td><td>4%</td><td>0%</td></tr>
    <tr><td style='background-color:#a0c1e7'>2012</td><td>0%</td><td>7.4%</td><td>92.6%</td><td>0%</td><td>12%</td><td>88%</td><?php if($int) echo '<td>0%</td><td>41.3%</td><td>58.7%</td><td>0%</td><td>10.6%</td><td>89.4%</td>'; ?><td>17.4%</td><td>19.7%</td><td>62.9%</td><td>0.8%</td><td>25%</td><td>74.2%</td><td>0.4%</td><td>5.7%</td><td>93.9%</td><td>0%</td><td>18%</td><td>82%</td><td>2.6%</td><td>74.8%</td><td>22.5%</td></tr>
    <tr><td style='background-color:#a0c1e7'>2013</td><td>0%</td><td>3.3%</td><td>96.7%</td><td>0%</td><td>5.6%</td><td>94.4%</td><?php if($int) echo '<td>0%</td><td>21.5%</td><td>78.5%</td><td>0%</td><td>1.3%</td><td>98.7%</td>'; ?><td>20.5%</td><td>20.6%</td><td>58.9%</td><td>2.1%</td><td>57.2%</td><td>40.7%</td><td>2%</td><td>12.6%</td><td>85.4%</td><td>1.7%</td><td>17.4%</td><td>80.9%</td><td>4%</td><td>89.4%</td><td>6.6%</td></tr>
    <tr><td style='background-color:#a0c1e7'>2014</td><td>0.4%</td><td>10.1%</td><td>89.5%</td><td>1.2%</td><td>17.6%</td><td>81.3%</td><?php if($int) echo '<td>2.5%</td><td>48.4%</td><td>49.1%</td><td>3.6%</td><td>36.8%</td><td>59.6%</td>'; ?><td>38.8%</td><td>17.6%</td><td>43.6%</td><td>38.1%</td><td>58.1%</td><td>3.8%</td><td>6.5%</td><td>13%</td><td>80.5%</td><td>25.1%</td><td>21.3%</td><td>53.6%</td><td>79.5%</td><td>20.5%</td><td>0%</td></tr>
    <tr><td style='background-color:#a0c1e7'>2015</td><td>6.2%</td><td>25.4%</td><td>68.4%</td><td>11.3%</td><td>34.9%</td><td>53.8%</td><?php if($int) echo '<td>31.2%</td><td>68.2%</td><td>0.6%</td><td>23.5%</td><td>75.8%</td><td>0.7%</td>'; ?><td>31.1%</td><td>42.3%</td><td>26.7%</td><td>80.1%</td><td>19.9%</td><td>0%</td><td>11%</td><td>51.2%</td><td>37.8%</td><td>35.1%</td><td>51.6%</td><td>13.3%</td><td>100%</td><td>0%</td><td>0%</td></tr>
    <tr><td style='background-color:#a0c1e7'>2016</td><td>0%</td><td>1.5%</td><td>98.5%</td><td>0%</td><td>2.2%</td><td>97.8%</td><?php if($int) echo '<td>0%</td><td>8%</td><td>92%</td><td>0%</td><td>1%</td><td>99%</td>'; ?><td>18.1%</td><td>17.4%</td><td>64.5%</td><td>0.8%</td><td>7.6%</td><td>91.5%</td><td>0.4%</td><td>3.3%</td><td>96.3%</td><td>0%</td><td>6.7%</td><td>93.3%</td><td>0%</td><td>29.8%</td><td>70.2%</td></tr>
    <tr><td style='background-color:#a0c1e7'>2017</td><td>0%</td><td>10%</td><td>90%</td><td>0%</td><td>16.4%</td><td>83.6%</td><?php if($int) echo '<td>0%</td><td>52.8%</td><td>47.2%</td><td>0%</td><td>21.2%</td><td>78.8%</td>'; ?><td>8.8%</td><td>43.5%</td><td>47.7%</td><td>0.4%</td><td>96.2%</td><td>3.4%</td><td>0%</td><td>20.3%</td><td>79.7%</td><td>0%</td><td>42.6%</td><td>57.4%</td><td>0%</td><td>100%</td><td>0%</td></tr>
    <tr><td style='background-color:#a0c1e7'>2018</td><td>0%</td><td>9.4%</td><td>90.6%</td><td>0%</td><td>12.8%</td><td>87.2%</td><?php if($int) echo '<td>0%</td><td>48.8%</td><td>51.2%</td><td>0%</td><td>3%</td><td>97%</td>'; ?><td>18.3%</td><td>17.4%</td><td>64.3%</td><td>2.5%</td><td>21.2%</td><td>76.3%</td><td>2%</td><td>2.4%</td><td>95.5%</td><td>0%</td><td>8%</td><td>92%</td><td>9.9%</td><td>78.8%</td><td>11.3%</td></tr>
    <tr><td style='background-color:#a0c1e7'>2019</td><td>5.5%</td><td>11.5%</td><td>83%</td><td>9.3%</td><td>18.1%</td><td>72.6%</td><?php if($int) echo '<td>31.8%</td><td>48.8%</td><td>19.4%</td><td>8.6%</td><td>34.8%</td><td>56.6%</td>'; ?><td>23.4%</td><td>30.3%</td><td>46.3%</td><td>14%</td><td>58.9%</td><td>27.1%</td><td>2.8%</td><td>20.7%</td><td>76.4%</td><td>9.7%</td><td>28.4%</td><td>61.9%</td><td>49%</td><td>51%</td><td>0%</td></tr>
  </table>
  <h3>Annual Statistics: Mean four-year hydroperiod</h3>
  <table style="background-color:white">
    <tr style="background-color:#a0c1e7">
      <th>&nbsp;</th><th colspan="3">A</th><th colspan="3">AX</th><?php if($int) echo "<th colspan='3'>A1</th><th colspan='3'>A2</th>"; ?><th colspan="3">B</th><th colspan="3">C</th><th colspan="3">D</th><th colspan="3">E</th><th colspan="3">F</th>
    </tr>
    <tr style="background-color:#a0c1e7">
      <th style='width:30px'>Year</th>
      <th style='width:45px'><div id='modalA_HP' class='mod'>Mean 4YHP</div></th><th style='width:45px'><div id='modalA_HPP' class='mod'>Mean 4YHP %</div></th><th style='width:45px'><div id='modalA_SD' class='mod'>Mean 4YHP SD</div></th>
      <th style='width:45px'><div id='modalAX_HP' class='mod'>Mean 4YHP</div></th><th style='width:45px'><div id='modalAX_HPP' class='mod'>Mean 4YHP %</div></th><th style='width:45px'><div id='modalAX_SD' class='mod'>Mean 4YHP SD</div></th>
<?php if($int) echo "      <th style='width:45px'><div id='modalA1_HP' class='mod'>Mean 4YHP</div></th><th style='width:45px'><div id='modalA1_HPP' class='mod'>Mean 4YHP %</div></th><th style='width:45px'><div id='modalA1_SD' class='mod'>Mean 4YHP SD</div></th>
      <th style='width:45px'><div id='modalA2_HP' class='mod'>Mean 4YHP</div></th><th style='width:45px'><div id='modalA2_HPP' class='mod'>Mean 4YHP %</div></th><th style='width:45px'><div id='modalA2_SD' class='mod'>Mean 4YHP SD</div></th>\n"; ?>
      <th style='width:45px'><div id='modalB_HP' class='mod'>Mean 4YHP</div></th><th style='width:45px'><div id='modalB_HPP' class='mod'>Mean 4YHP %</div></th><th style='width:45px'><div id='modalB_SD' class='mod'>Mean 4YHP SD</div></th>
      <th style='width:45px'><div id='modalC_HP' class='mod'>Mean 4YHP</div></th><th style='width:45px'><div id='modalC_HPP' class='mod'>Mean 4YHP %</div></th><th style='width:45px'><div id='modalC_SD' class='mod'>Mean 4YHP SD</div></th>
      <th style='width:45px'><div id='modalD_HP' class='mod'>Mean 4YHP</div></th><th style='width:45px'><div id='modalD_HPP' class='mod'>Mean 4YHP %</div></th><th style='width:45px'><div id='modalD_SD' class='mod'>Mean 4YHP SD</div></th>
      <th style='width:45px'><div id='modalE_HP' class='mod'>Mean 4YHP</div></th><th style='width:45px'><div id='modalE_HPP' class='mod'>Mean 4YHP %</div></th><th style='width:45px'><div id='modalE_SD' class='mod'>Mean 4YHP SD</div></th>
      <th style='width:45px'><div id='modalF_HP' class='mod'>Mean 4YHP</div></th><th style='width:45px'><div id='modalF_HPP' class='mod'>Mean 4YHP %</div></th><th style='width:45px'><div id='modalF_SD' class='mod'>Mean 4YHP SD</div></th>
    </tr>
    <tr><td style='background-color:#a0c1e7'>1995</td><td>298 days</td><td>2%</td><td>57 days</td><td>285 days</td><td>6%</td><td>59 days</td><?php if($int) echo '<td>256 days</td><td>12%</td><td>75 days</td><td>231 days</td><td>21%</td><td>50 days</td>'; ?><td>153 days</td><td>42%</td><td>28 days</td><td>72 days</td><td>25%</td><td>49 days</td><td>188 days</td><td>53%</td><td>44 days</td><td>138 days</td><td>52%</td><td>36 days</td><td>29 days</td><td>6%</td><td>25 days</td></tr>
    <tr><td style='background-color:#a0c1e7'>1996</td><td>329 days</td><td>0%</td><td>45 days</td><td>319 days</td><td>1%</td><td>53 days</td><?php if($int) echo '<td>298 days</td><td>0%</td><td>80 days</td><td>271 days</td><td>4%</td><td>78 days</td>'; ?><td>178 days</td><td>38%</td><td>49 days</td><td>112 days</td><td>71%</td><td>66 days</td><td>218 days</td><td>50%</td><td>64 days</td><td>185 days</td><td>57%</td><td>88 days</td><td>53 days</td><td>24%</td><td>46 days</td></tr>
    <tr><td style='background-color:#a0c1e7'>1997</td><td>348 days</td><td>0%</td><td>17 days</td><td>339 days</td><td>0%</td><td>25 days</td><?php if($int) echo '<td>322 days</td><td>0%</td><td>42 days</td><td>295 days</td><td>1%</td><td>52 days</td>'; ?><td>185 days</td><td>34%</td><td>44 days</td><td>126 days</td><td>74%</td><td>47 days</td><td>234 days</td><td>42%</td><td>44 days</td><td>208 days</td><td>41%</td><td>76 days</td><td>57 days</td><td>26%</td><td>43 days</td></tr>
    <tr><td style='background-color:#a0c1e7'>1998</td><td>342 days</td><td>0%</td><td>20 days</td><td>331 days</td><td>0%</td><td>28 days</td><?php if($int) echo '<td>302 days</td><td>0%</td><td>49 days</td><td>284 days</td><td>1%</td><td>58 days</td>'; ?><td>191 days</td><td>37%</td><td>41 days</td><td>136 days</td><td>82%</td><td>44 days</td><td>234 days</td><td>37%</td><td>44 days</td><td>220 days</td><td>33%</td><td>69 days</td><td>59 days</td><td>29%</td><td>41 days</td></tr>
    <tr><td style='background-color:#a0c1e7'>1999</td><td>343 days</td><td>0%</td><td>18 days</td><td>332 days</td><td>0%</td><td>25 days</td><?php if($int) echo '<td>298 days</td><td>0%</td><td>50 days</td><td>295 days</td><td>1%</td><td>50 days</td>'; ?><td>200 days</td><td>25%</td><td>37 days</td><td>127 days</td><td>75%</td><td>50 days</td><td>242 days</td><td>28%</td><td>47 days</td><td>237 days</td><td>22%</td><td>55 days</td><td>48 days</td><td>20%</td><td>43 days</td></tr>
    <tr><td style='background-color:#a0c1e7'>2000</td><td>333 days</td><td>0%</td><td>12 days</td><td>320 days</td><td>0%</td><td>14 days</td><?php if($int) echo '<td>277 days</td><td>0%</td><td>23 days</td><td>273 days</td><td>3%</td><td>21 days</td>'; ?><td>188 days</td><td>24%</td><td>27 days</td><td>118 days</td><td>73%</td><td>35 days</td><td>226 days</td><td>34%</td><td>33 days</td><td>216 days</td><td>24%</td><td>28 days</td><td>41 days</td><td>12%</td><td>30 days</td></tr>
    <tr><td style='background-color:#a0c1e7'>2001</td><td>326 days</td><td>3%</td><td>14 days</td><td>311 days</td><td>6%</td><td>20 days</td><?php if($int) echo '<td>253 days</td><td>20%</td><td>42 days</td><td>261 days</td><td>9%</td><td>31 days</td>'; ?><td>185 days</td><td>26%</td><td>27 days</td><td>132 days</td><td>83%</td><td>34 days</td><td>235 days</td><td>29%</td><td>30 days</td><td>212 days</td><td>27%</td><td>30 days</td><td>42 days</td><td>11%</td><td>32 days</td></tr>
    <tr><td style='background-color:#a0c1e7'>2002</td><td>307 days</td><td>4%</td><td>38 days</td><td>291 days</td><td>10%</td><td>43 days</td><?php if($int) echo '<td>232 days</td><td>30%</td><td>58 days</td><td>240 days</td><td>20%</td><td>60 days</td>'; ?><td>172 days</td><td>28%</td><td>38 days</td><td>133 days</td><td>83%</td><td>34 days</td><td>225 days</td><td>32%</td><td>43 days</td><td>198 days</td><td>31%</td><td>44 days</td><td>50 days</td><td>11%</td><td>33 days</td></tr>
    <tr><td style='background-color:#a0c1e7'>2003</td><td>297 days</td><td>6%</td><td>35 days</td><td>279 days</td><td>14%</td><td>39 days</td><?php if($int) echo '<td>218 days</td><td>39%</td><td>51 days</td><td>224 days</td><td>27%</td><td>51 days</td>'; ?><td>166 days</td><td>32%</td><td>31 days</td><td>139 days</td><td>90%</td><td>20 days</td><td>209 days</td><td>43%</td><td>36 days</td><td>195 days</td><td>36%</td><td>39 days</td><td>56 days</td><td>15%</td><td>29 days</td></tr>
    <tr><td style='background-color:#a0c1e7'>2004</td><td>292 days</td><td>9%</td><td>31 days</td><td>273 days</td><td>19%</td><td>32 days</td><?php if($int) echo '<td>204 days</td><td>52%</td><td>32 days</td><td>211 days</td><td>38%</td><td>40 days</td>'; ?><td>170 days</td><td>33%</td><td>35 days</td><td>140 days</td><td>87%</td><td>22 days</td><td>209 days</td><td>46%</td><td>36 days</td><td>194 days</td><td>36%</td><td>38 days</td><td>78 days</td><td>31%</td><td>68 days</td></tr>
    <tr><td style='background-color:#a0c1e7'>2005</td><td>287 days</td><td>9%</td><td>24 days</td><td>269 days</td><td>18%</td><td>24 days</td><?php if($int) echo '<td>208 days</td><td>46%</td><td>23 days</td><td>209 days</td><td>41%</td><td>30 days</td>'; ?><td>163 days</td><td>35%</td><td>38 days</td><td>128 days</td><td>80%</td><td>27 days</td><td>191 days</td><td>50%</td><td>35 days</td><td>188 days</td><td>39%</td><td>37 days</td><td>82 days</td><td>39%</td><td>64 days</td></tr>
    <tr><td style='background-color:#a0c1e7'>2006</td><td>296 days</td><td>6%</td><td>12 days</td><td>279 days</td><td>11%</td><td>11 days</td><?php if($int) echo '<td>219 days</td><td>36%</td><td>12 days</td><td>222 days</td><td>16%</td><td>6 days</td>'; ?><td>168 days</td><td>35%</td><td>36 days</td><td>138 days</td><td>84%</td><td>35 days</td><td>201 days</td><td>46%</td><td>31 days</td><td>199 days</td><td>33%</td><td>30 days</td><td>112 days</td><td>76%</td><td>77 days</td></tr>
    <tr><td style='background-color:#a0c1e7'>2007</td><td>297 days</td><td>7%</td><td>13 days</td><td>280 days</td><td>13%</td><td>14 days</td><?php if($int) echo '<td>215 days</td><td>41%</td><td>17 days</td><td>226 days</td><td>17%</td><td>13 days</td>'; ?><td>160 days</td><td>41%</td><td>37 days</td><td>124 days</td><td>82%</td><td>52 days</td><td>194 days</td><td>50%</td><td>37 days</td><td>187 days</td><td>46%</td><td>35 days</td><td>105 days</td><td>76%</td><td>86 days</td></tr>
    <tr><td style='background-color:#a0c1e7'>2008</td><td>295 days</td><td>12%</td><td>21 days</td><td>272 days</td><td>22%</td><td>28 days</td><?php if($int) echo '<td>193 days</td><td>58%</td><td>41 days</td><td>201 days</td><td>51%</td><td>53 days</td>'; ?><td>148 days</td><td>46%</td><td>24 days</td><td>102 days</td><td>64%</td><td>52 days</td><td>188 days</td><td>52%</td><td>32 days</td><td>168 days</td><td>45%</td><td>36 days</td><td>62 days</td><td>8%</td><td>80 days</td></tr>
    <tr><td style='background-color:#a0c1e7'>2009</td><td>285 days</td><td>17%</td><td>30 days</td><td>263 days</td><td>29%</td><td>34 days</td><?php if($int) echo '<td>183 days</td><td>71%</td><td>42 days</td><td>192 days</td><td>70%</td><td>53 days</td>'; ?><td>147 days</td><td>49%</td><td>26 days</td><td>108 days</td><td>75%</td><td>54 days</td><td>193 days</td><td>58%</td><td>29 days</td><td>167 days</td><td>52%</td><td>40 days</td><td>77 days</td><td>15%</td><td>82 days</td></tr>
    <tr><td style='background-color:#a0c1e7'>2010</td><td>285 days</td><td>14%</td><td>31 days</td><td>263 days</td><td>24%</td><td>35 days</td><?php if($int) echo '<td>180 days</td><td>66%</td><td>39 days</td><td>194 days</td><td>51%</td><td>56 days</td>'; ?><td>151 days</td><td>48%</td><td>29 days</td><td>110 days</td><td>80%</td><td>57 days</td><td>199 days</td><td>56%</td><td>37 days</td><td>173 days</td><td>49%</td><td>47 days</td><td>54 days</td><td>9%</td><td>56 days</td></tr>
    <tr><td style='background-color:#a0c1e7'>2011</td><td>289 days</td><td>17%</td><td>34 days</td><td>265 days</td><td>28%</td><td>37 days</td><?php if($int) echo '<td>178 days</td><td>72%</td><td>40 days</td><td>186 days</td><td>68%</td><td>50 days</td>'; ?><td>160 days</td><td>38%</td><td>34 days</td><td>128 days</td><td>87%</td><td>49 days</td><td>222 days</td><td>34%</td><td>42 days</td><td>185 days</td><td>47%</td><td>47 days</td><td>80 days</td><td>39%</td><td>57 days</td></tr>
    <tr><td style='background-color:#a0c1e7'>2012</td><td>276 days</td><td>16%</td><td>37 days</td><td>256 days</td><td>27%</td><td>37 days</td><?php if($int) echo '<td>177 days</td><td>74%</td><td>38 days</td><td>196 days</td><td>55%</td><td>34 days</td>'; ?><td>154 days</td><td>39%</td><td>34 days</td><td>136 days</td><td>89%</td><td>36 days</td><td>215 days</td><td>35%</td><td>46 days</td><td>184 days</td><td>48%</td><td>45 days</td><td>88 days</td><td>50%</td><td>43 days</td></tr>
    <tr><td style='background-color:#a0c1e7'>2013</td><td>288 days</td><td>12%</td><td>34 days</td><td>268 days</td><td>21%</td><td>36 days</td><?php if($int) echo '<td>188 days</td><td>60%</td><td>41 days</td><td>210 days</td><td>41%</td><td>36 days</td>'; ?><td>172 days</td><td>32%</td><td>34 days</td><td>158 days</td><td>94%</td><td>52 days</td><td>235 days</td><td>24%</td><td>47 days</td><td>203 days</td><td>43%</td><td>50 days</td><td>106 days</td><td>66%</td><td>66 days</td></tr>
    <tr><td style='background-color:#a0c1e7'>2014</td><td>298 days</td><td>11%</td><td>38 days</td><td>278 days</td><td>19%</td><td>42 days</td><?php if($int) echo '<td>199 days</td><td>55%</td><td>52 days</td><td>222 days</td><td>33%</td><td>49 days</td>'; ?><td>179 days</td><td>31%</td><td>38 days</td><td>160 days</td><td>95%</td><td>53 days</td><td>243 days</td><td>25%</td><td>48 days</td><td>210 days</td><td>42%</td><td>54 days</td><td>124 days</td><td>87%</td><td>65 days</td></tr>
    <tr><td style='background-color:#a0c1e7'>2015</td><td>293 days</td><td>10%</td><td>35 days</td><td>275 days</td><td>17%</td><td>39 days</td><?php if($int) echo '<td>200 days</td><td>52%</td><td>51 days</td><td>224 days</td><td>29%</td><td>49 days</td>'; ?><td>172 days</td><td>29%</td><td>41 days</td><td>152 days</td><td>90%</td><td>61 days</td><td>239 days</td><td>21%</td><td>45 days</td><td>203 days</td><td>38%</td><td>59 days</td><td>110 days</td><td>71%</td><td>73 days</td></tr>
    <tr><td style='background-color:#a0c1e7'>2016</td><td>295 days</td><td>12%</td><td>31 days</td><td>275 days</td><td>20%</td><td>39 days</td><?php if($int) echo '<td>194 days</td><td>57%</td><td>62 days</td><td>211 days</td><td>40%</td><td>72 days</td>'; ?><td>177 days</td><td>28%</td><td>36 days</td><td>144 days</td><td>91%</td><td>74 days</td><td>243 days</td><td>24%</td><td>39 days</td><td>202 days</td><td>40%</td><td>62 days</td><td>107 days</td><td>70%</td><td>77 days</td></tr>
    <tr><td style='background-color:#a0c1e7'>2017</td><td>306 days</td><td>8%</td><td>42 days</td><td>289 days</td><td>13%</td><td>53 days</td><?php if($int) echo '<td>212 days</td><td>43%</td><td>81 days</td><td>240 days</td><td>13%</td><td>105 days</td>'; ?><td>186 days</td><td>24%</td><td>44 days</td><td>162 days</td><td>83%</td><td>101 days</td><td>263 days</td><td>14%</td><td>66 days</td><td>224 days</td><td>31%</td><td>90 days</td><td>125 days</td><td>75%</td><td>106 days</td></tr>
    <tr><td style='background-color:#a0c1e7'>2018</td><td>298 days</td><td>10%</td><td>41 days</td><td>280 days</td><td>16%</td><td>52 days</td><?php if($int) echo '<td>204 days</td><td>50%</td><td>79 days</td><td>228 days</td><td>20%</td><td>102 days</td>'; ?><td>188 days</td><td>28%</td><td>51 days</td><td>160 days</td><td>89%</td><td>101 days</td><td>259 days</td><td>15%</td><td>66 days</td><td>216 days</td><td>36%</td><td>91 days</td><td>119 days</td><td>72%</td><td>105 days</td></tr>
    <tr><td style='background-color:#a0c1e7'>2019</td><td>301 days</td><td>10%</td><td>41 days</td><td>285 days</td><td>14%</td><td>52 days</td><?php if($int) echo '<td>205 days</td><td>50%</td><td>78 days</td><td>247 days</td><td>11%</td><td>105 days</td>'; ?><td>205 days</td><td>25%</td><td>46 days</td><td>195 days</td><td>53%</td><td>99 days</td><td>272 days</td><td>10%</td><td>67 days</td><td>241 days</td><td>23%</td><td>89 days</td><td>140 days</td><td>95%</td><td>98 days</td></tr>
    <tr><td style='background-color:#a0c1e7'>2020</td><td>312 days</td><td>8%</td><td>32 days</td><td>296 days</td><td>12%</td><td>41 days</td><?php if($int) echo '<td>214 days</td><td>45%</td><td>66 days</td><td>270 days</td><td>8%</td><td>70 days</td>'; ?><td>217 days</td><td>22%</td><td>32 days</td><td>220 days</td><td>36%</td><td>61 days</td><td>289 days</td><td>6%</td><td>46 days</td><td>263 days</td><td>17%</td><td>59 days</td><td>158 days</td><td>87%</td><td>73 days</td></tr>
  </table>
</div>
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
	imageBounds = [[25.168, -81.948], [26.654, -79.657]],
	layerOptions = { opacity: 0.0 };
var dem = L.imageOverlay(demUrl, imageBounds, layerOptions).addTo(map);

var imageUrl = '../csss/images/2020/trans0000.png',
	imageBounds = [[25.222, -81.363], [26.688, -80.222]],
	layerOptions = { opacity: 1.0 };
var eden = L.imageOverlay(imageUrl, imageBounds, layerOptions).addTo(map);

var hydroUrl = 'hydrop4/four_year_hydroperiod_2020_mask65_altRange2.png',
	imageBounds = [[25.222, -81.363], [26.688, -80.222]],
	layerOptions = { opacity: 0.0 };
var hydrop = L.imageOverlay(hydroUrl, imageBounds, layerOptions).addTo(map);

//Test positioning markers for x[c(1, 287)], y[c(1, 405)] image corners
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
	$row = mysqli_fetch_array($result);
	$wl_result = mysqli_query($db, "SELECT date, `stage_{$row['station_name_web']}` + {$row['conv']} AS stage FROM stage_daily WHERE `stage_{$row['station_name_web']}` IS NOT NULL ORDER BY date DESC LIMIT 1");
	$wl_row = mysqli_fetch_array($wl_result);
	echo "var gage{$row['sname']} = L.marker([{$row['lat']}, {$row['long']}], { icon: myIcon";
	echo (substr($row['sname'], 0, 1) == 'G') ? 2 : 3;
	echo ", title: '{$row['sname']}'}).bindPopup('Gage: <strong><a href=\"../station.php?stn_name={$row['station_name_web']}\" target=\"_blank\">{$row['sname']}</a></strong> (<a href=\"../eve/index.php?site_list%5B%5D={$row['station_name_web']}\" target=\"_blank\"><abbr title=\"Explore and View EDEN\">EVE</abbr></a>)<br>" . round($row['lat'], 2) . "&deg;<abbr title=\"north\">N</abbr> " . round($row['long'], 2) . "&deg;<abbr title=\"west\">W</abbr><br><strong>{$wl_row['date']}</strong> Water Level: <strong>" . round($wl_row['stage'], 2) . " ft.</strong> <abbr title=\"North American Vertical Datum of 1988\">NAVD88</abbr><br><a href=\"/../eden/water_level_percentiles.php?name={$row['station_name_web']}&amp;type=gage\" target=\"_blank\"><img src=\"../thumbnails/{$row['station_name_web']}_monthly_thumb.jpg\" alt=\"{$row['sname']} hydrograph thumbnail\" height=\"160\" width=\"240\"><br><span style=\"font-size:small\">[larger graph with axes]</font></a>').addTo(map);\n";
}
?>

function onEachFeature(feature, sparrows) {
	sparrows.bindPopup('Cape Sable Seaside Sparrow habitat');
}

var sparrows2 = L.geoJson(sparrowHome_new, {onEachFeature: onEachFeature, style: function(feature) {
    switch (feature.properties.UNIT_NUM) {
        case 'AX': return {color: "#0F0", fillOpacity: "0.0", weight: "1.5"}; break;
        default: return {color: "#000", fillOpacity: "0.0", weight: "3.5"};
}}}).addTo(map);

var geojsonMarkerOptions = {
    radius: 4,
    fillColor: "#ff7800",
    color: "#000",
    weight: 1,
    opacity: 1,
    fillOpacity: 0.8
};

var myIcon = L.icon({
    iconUrl: 'marker-icon.png',
    iconSize: [0, 0],
    labelAnchor: [-6, 0]
});
L.marker([25.674, -80.800], {icon: myIcon}).bindTooltip('AX', {direction: "left", permanent: true, className: "AXLabelborder"}).addTo(map);
L.marker([25.636, -81.000], {icon: myIcon}).bindTooltip('A', {direction: "left", permanent: true, className: "ALabelborder"}).addTo(map);
<?php if($int) echo "L.marker([25.742, -80.823], {icon: myIcon}).bindTooltip('A1', {direction: 'left', permanent: true, className: 'A1Labelborder'}).addTo(map);
L.marker([25.553, -80.883], {icon: myIcon}).bindTooltip('A2', {direction: 'left', permanent: true, className: 'A2Labelborder'}).addTo(map);\n"; ?>
L.marker([25.363, -80.837], {icon: myIcon}).bindTooltip('B', {direction: "left", permanent: true, className: "BLabelborder"}).addTo(map);
L.marker([25.427, -80.653], {icon: myIcon}).bindTooltip('C', {direction: "left", permanent: true, className: "CLabelborder"}).addTo(map);
L.marker([25.338, -80.588], {icon: myIcon}).bindTooltip('D', {direction: "left", permanent: true, className: "DLabelborder"}).addTo(map);
L.marker([25.448, -80.786], {icon: myIcon}).bindTooltip('E', {direction: "left", permanent: true, className: "ELabelborder"}).addTo(map);
L.marker([25.542, -80.616], {icon: myIcon}).bindTooltip('F', {direction: "left", permanent: true, className: "FLabelborder"}).addTo(map);

function imgtrans(transval) {
	eden.setOpacity(transval / 10);
}

function DEMtrans(transval) {
	dem.setOpacity(transval / 10);
}

function hydrotrans(transval) {
	hydrop.setOpacity(transval / 10);
}

function imgtime(timeval) {
	timeval = timeval.toString();
	var dtrange = document.getElementById("dtSelect");
	var selval = dtrange.options[dtrange.selectedIndex].value;
	if (timeval.length < 2) timeval = '00' + timeval;
	if (timeval.length < 3) timeval = '0' + timeval;
	eden.setUrl("../csss/images/" + selval + "/trans0" + timeval + ".png");
}

var per_dry_label_AX = new L.marker([25.67, -80.78], {icon: myIcon});
per_dry_label_AX.bindTooltip('', {direction: "right", permanent: true, className: "AXLabelborder"}).addTo(map).closeTooltip();
var per_dry_label_A = new L.marker([25.62, -81.00], {icon: myIcon});
per_dry_label_A.bindTooltip('', {direction: "left", permanent: true, className: "ALabelborder"}).addTo(map).closeTooltip();
var per_dry_label_B = new L.marker([25.295, -80.695], {icon: myIcon});
per_dry_label_B.bindTooltip('', {direction: "left", permanent: true, className: "BLabelborder"}).addTo(map).closeTooltip();
var per_dry_label_C = new L.marker([25.39, -80.6], {icon: myIcon});
per_dry_label_C.bindTooltip('', {direction: "right", permanent: true, className: "CLabelborder"}).addTo(map).closeTooltip();
var per_dry_label_D = new L.marker([25.3, -80.52], {icon: myIcon});
per_dry_label_D.bindTooltip('', {direction: "right", permanent: true, className: "DLabelborder"}).addTo(map).closeTooltip();
var per_dry_label_E = new L.marker([25.475, -80.67], {icon: myIcon});
per_dry_label_E.bindTooltip('', {direction: "right", permanent: true, className: "ELabelborder"}).addTo(map).closeTooltip();
var per_dry_label_F = new L.marker([25.525, -80.58], {icon: myIcon});
per_dry_label_F.bindTooltip('', {direction: "right", permanent: true, className: "FLabelborder"}).addTo(map).closeTooltip();
var per_dry17cm_label_AX = new L.marker([25.64, -80.78], {icon: myIcon});
per_dry17cm_label_AX.bindTooltip('', {direction: "right", permanent: true, className: "AXLabelborder"}).addTo(map).closeTooltip();
var per_dry17cm_label_A = new L.marker([25.59, -81.00], {icon: myIcon});
per_dry17cm_label_A.bindTooltip('', {direction: "left", permanent: true, className: "ALabelborder"}).addTo(map).closeTooltip();
var per_dry17cm_label_B = new L.marker([25.265, -80.695], {icon: myIcon});
per_dry17cm_label_B.bindTooltip('', {direction: "left", permanent: true, className: "BLabelborder"}).addTo(map).closeTooltip();
var per_dry17cm_label_C = new L.marker([25.36, -80.6], {icon: myIcon});
per_dry17cm_label_C.bindTooltip('', {direction: "right", permanent: true, className: "CLabelborder"}).addTo(map).closeTooltip();
var per_dry17cm_label_D = new L.marker([25.27, -80.52], {icon: myIcon});
per_dry17cm_label_D.bindTooltip('', {direction: "right", permanent: true, className: "DLabelborder"}).addTo(map).closeTooltip();
var per_dry17cm_label_E = new L.marker([25.445, -80.67], {icon: myIcon});
per_dry17cm_label_E.bindTooltip('', {direction: "right", permanent: true, className: "ELabelborder"}).addTo(map).closeTooltip();
var per_dry17cm_label_F = new L.marker([25.495, -80.58], {icon: myIcon});
per_dry17cm_label_F.bindTooltip('', {direction: "right", permanent: true, className: "FLabelborder"}).addTo(map).closeTooltip();
var per_dry40d_label_AX = new L.marker([25.61, -80.78], {icon: myIcon});
per_dry40d_label_AX.bindTooltip('', {direction: "right", permanent: true, className: "AXLabelborder"}).addTo(map).closeTooltip();
var per_dry40d_label_A = new L.marker([25.56, -81.00], {icon: myIcon});
per_dry40d_label_A.bindTooltip('', {direction: "left", permanent: true, className: "ALabelborder"}).addTo(map).closeTooltip();
var per_dry40d_label_B = new L.marker([25.235, -80.695], {icon: myIcon});
per_dry40d_label_B.bindTooltip('', {direction: "left", permanent: true, className: "BLabelborder"}).addTo(map).closeTooltip();
var per_dry40d_label_C = new L.marker([25.33, -80.6], {icon: myIcon});
per_dry40d_label_C.bindTooltip('', {direction: "right", permanent: true, className: "CLabelborder"}).addTo(map).closeTooltip();
var per_dry40d_label_D = new L.marker([25.24, -80.52], {icon: myIcon});
per_dry40d_label_D.bindTooltip('', {direction: "right", permanent: true, className: "DLabelborder"}).addTo(map).closeTooltip();
var per_dry40d_label_E = new L.marker([25.415, -80.67], {icon: myIcon});
per_dry40d_label_E.bindTooltip('', {direction: "right", permanent: true, className: "ELabelborder"}).addTo(map).closeTooltip();
var per_dry40d_label_F = new L.marker([25.465, -80.58], {icon: myIcon});
per_dry40d_label_F.bindTooltip('', {direction: "right", permanent: true, className: "FLabelborder"}).addTo(map).closeTooltip();
var per_dry90d_label_AX = new L.marker([25.58, -80.78], {icon: myIcon});
per_dry90d_label_AX.bindTooltip('', {direction: "right", permanent: true, className: "AXLabelborder"}).addTo(map).closeTooltip();
var per_dry90d_label_A = new L.marker([25.53, -81.00], {icon: myIcon});
per_dry90d_label_A.bindTooltip('', {direction: "left", permanent: true, className: "ALabelborder"}).addTo(map).closeTooltip();
var per_dry90d_label_B = new L.marker([25.205, -80.695], {icon: myIcon});
per_dry90d_label_B.bindTooltip('', {direction: "left", permanent: true, className: "BLabelborder"}).addTo(map).closeTooltip();
var per_dry90d_label_C = new L.marker([25.30, -80.6], {icon: myIcon});
per_dry90d_label_C.bindTooltip('', {direction: "right", permanent: true, className: "CLabelborder"}).addTo(map).closeTooltip();
var per_dry90d_label_D = new L.marker([25.21, -80.52], {icon: myIcon});
per_dry90d_label_D.bindTooltip('', {direction: "right", permanent: true, className: "DLabelborder"}).addTo(map).closeTooltip();
var per_dry90d_label_E = new L.marker([25.385, -80.67], {icon: myIcon});
per_dry90d_label_E.bindTooltip('', {direction: "right", permanent: true, className: "ELabelborder"}).addTo(map).closeTooltip();
var per_dry90d_label_F = new L.marker([25.435, -80.58], {icon: myIcon});
per_dry90d_label_F.bindTooltip('', {direction: "right", permanent: true, className: "FLabelborder"}).addTo(map).closeTooltip();
var depth_mean_label_AX = new L.marker([25.73, -80.78], {icon: myIcon});
depth_mean_label_AX.bindTooltip('', {direction: "right", permanent: true, className: "AXLabelborder dyn"}).addTo(map).closeTooltip();
var depth_mean_label_A = new L.marker([25.68, -81.00], {icon: myIcon});
depth_mean_label_A.bindTooltip('', {direction: "left", permanent: true, className: "ALabelborder dyn"}).addTo(map).closeTooltip();
var depth_mean_label_B = new L.marker([25.355, -80.695], {icon: myIcon});
depth_mean_label_B.bindTooltip('', {direction: "left", permanent: true, className: "BLabelborder dyn"}).addTo(map).closeTooltip();
var depth_mean_label_C = new L.marker([25.45, -80.6], {icon: myIcon});
depth_mean_label_C.bindTooltip('', {direction: "right", permanent: true, className: "CLabelborder dyn"}).addTo(map).closeTooltip();
var depth_mean_label_D = new L.marker([25.36, -80.52], {icon: myIcon});
depth_mean_label_D.bindTooltip('', {direction: "right", permanent: true, className: "DLabelborder dyn"}).addTo(map).closeTooltip();
var depth_mean_label_E = new L.marker([25.535, -80.67], {icon: myIcon});
depth_mean_label_E.bindTooltip('', {direction: "right", permanent: true, className: "ELabelborder dyn"}).addTo(map).closeTooltip();
var depth_mean_label_F = new L.marker([25.585, -80.58], {icon: myIcon});
depth_mean_label_F.bindTooltip('', {direction: "right", permanent: true, className: "FLabelborder dyn"}).addTo(map).closeTooltip();
var depth_sd_label_AX = new L.marker([25.70,-80.78], {icon: myIcon});
depth_sd_label_AX.bindTooltip('', {direction: "right", permanent: true, className: "AXLabelborder dyn"}).addTo(map).closeTooltip();
var depth_sd_label_A = new L.marker([25.65,-81.00], {icon: myIcon});
depth_sd_label_A.bindTooltip('', {direction: "left", permanent: true, className: "ALabelborder dyn"}).addTo(map).closeTooltip();
var depth_sd_label_B = new L.marker([25.325, -80.695], {icon: myIcon});
depth_sd_label_B.bindTooltip('', {direction: "left", permanent: true, className: "BLabelborder dyn"}).addTo(map).closeTooltip();
var depth_sd_label_C = new L.marker([25.42, -80.6], {icon: myIcon});
depth_sd_label_C.bindTooltip('', {direction: "right", permanent: true, className: "CLabelborder dyn"}).addTo(map).closeTooltip();
var depth_sd_label_D = new L.marker([25.33, -80.52], {icon: myIcon});
depth_sd_label_D.bindTooltip('', {direction: "right", permanent: true, className: "DLabelborder dyn"}).addTo(map).closeTooltip();
var depth_sd_label_E = new L.marker([25.505, -80.67], {icon: myIcon});
depth_sd_label_E.bindTooltip('', {direction: "right", permanent: true, className: "ELabelborder dyn"}).addTo(map).closeTooltip();
var depth_sd_label_F = new L.marker([25.555, -80.58], {icon: myIcon});
depth_sd_label_F.bindTooltip('', {direction: "right", permanent: true, className: "FLabelborder dyn"}).addTo(map).closeTooltip();

<?php if($int) echo "var per_dry_label_A1 = new L.marker([25.70, -80.87], {icon: myIcon});
per_dry_label_A1.bindTooltip('', {direction: 'left', permanent: true, className: 'A1Labelborder'}).addTo(map).closeTooltip();
var per_dry_label_A2 = new L.marker([25.57, -80.84], {icon: myIcon});
per_dry_label_A2.bindTooltip('', {direction: 'right', permanent: true, className: 'A2Labelborder'}).addTo(map).closeTooltip();
var per_dry17cm_label_A1 = new L.marker([25.67, -80.87], {icon: myIcon});
per_dry17cm_label_A1.bindTooltip('', {direction: 'left', permanent: true, className: 'A1Labelborder'}).addTo(map).closeTooltip();
var per_dry17cm_label_A2 = new L.marker([25.54, -80.84], {icon: myIcon});
per_dry17cm_label_A2.bindTooltip('', {direction: 'right', permanent: true, className: 'A2Labelborder'}).addTo(map).closeTooltip();
var per_dry40d_label_A1 = new L.marker([25.64, -80.87], {icon: myIcon});
per_dry40d_label_A1.bindTooltip('', {direction: 'left', permanent: true, className: 'A1Labelborder'}).addTo(map).closeTooltip();
var per_dry40d_label_A2 = new L.marker([25.51, -80.84], {icon: myIcon});
per_dry40d_label_A2.bindTooltip('', {direction: 'right', permanent: true, className: 'A2Labelborder'}).addTo(map).closeTooltip();
var per_dry90d_label_A1 = new L.marker([25.61, -80.87], {icon: myIcon});
per_dry90d_label_A1.bindTooltip('', {direction: 'left', permanent: true, className: 'A1Labelborder'}).addTo(map).closeTooltip();
var per_dry90d_label_A2 = new L.marker([25.48, -80.84], {icon: myIcon});
per_dry90d_label_A2.bindTooltip('', {direction: 'right', permanent: true, className: 'A2Labelborder'}).addTo(map).closeTooltip();
var depth_mean_label_A1 = new L.marker([25.76, -80.87], {icon: myIcon});
depth_mean_label_A1.bindTooltip('', {direction: 'left', permanent: true, className: 'A1Labelborder dyn'}).addTo(map).closeTooltip();
var depth_mean_label_A2 = new L.marker([25.63, -80.84], {icon: myIcon});
depth_mean_label_A2.bindTooltip('', {direction: 'right', permanent: true, className: 'A2Labelborder dyn'}).addTo(map).closeTooltip();
var depth_sd_label_A1 = new L.marker([25.73, -80.87], {icon: myIcon});
depth_sd_label_A1.bindTooltip('', {direction: 'left', permanent: true, className: 'A1Labelborder dyn'}).addTo(map).closeTooltip();
var depth_sd_label_A2 = new L.marker([25.6, -80.84], {icon: myIcon});
depth_sd_label_A2.bindTooltip('', {direction: 'right', permanent: true, className: 'A2Labelborder dyn'}).addTo(map).closeTooltip();\n"; ?>

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
	per_dry_label_AX.setTooltipContent(stats[fulldt2][0] + "% dry");
	per_dry_label_A.setTooltipContent(stats[fulldt2][6] + "% dry");
	per_dry_label_B.setTooltipContent(stats[fulldt2][24] + "% dry");
	per_dry_label_C.setTooltipContent(stats[fulldt2][30] + "% dry");
	per_dry_label_D.setTooltipContent(stats[fulldt2][36] + "% dry");
	per_dry_label_E.setTooltipContent(stats[fulldt2][42] + "% dry");
	per_dry_label_F.setTooltipContent(stats[fulldt2][48] + "% dry");
	per_dry17cm_label_AX.setTooltipContent(stats[fulldt2][1] + "% WD &#8804; 17cm");
	per_dry17cm_label_A.setTooltipContent(stats[fulldt2][7] + "% WD &#8804; 17cm");
	per_dry17cm_label_B.setTooltipContent(stats[fulldt2][25] + "% WD &#8804; 17cm");
	per_dry17cm_label_C.setTooltipContent(stats[fulldt2][31] + "% WD &#8804; 17cm");
	per_dry17cm_label_D.setTooltipContent(stats[fulldt2][37] + "% WD &#8804; 17cm");
	per_dry17cm_label_E.setTooltipContent(stats[fulldt2][43] + "% WD &#8804; 17cm");
	per_dry17cm_label_F.setTooltipContent(stats[fulldt2][49] + "% WD &#8804; 17cm");
	per_dry40d_label_AX.setTooltipContent(stats[fulldt2][2] + "% dry &#8805; 40 days");
	per_dry40d_label_A.setTooltipContent(stats[fulldt2][8] + "% dry &#8805; 40 days");
	per_dry40d_label_B.setTooltipContent(stats[fulldt2][26] + "% dry &#8805; 40 days");
	per_dry40d_label_C.setTooltipContent(stats[fulldt2][32] + "% dry &#8805; 40 days");
	per_dry40d_label_D.setTooltipContent(stats[fulldt2][38] + "% dry &#8805; 40 days");
	per_dry40d_label_E.setTooltipContent(stats[fulldt2][44] + "% dry &#8805; 40 days");
	per_dry40d_label_F.setTooltipContent(stats[fulldt2][50] + "% dry &#8805; 40 days");
	per_dry90d_label_AX.setTooltipContent(stats[fulldt2][3] + "% dry &#8805; 90 days");
	per_dry90d_label_A.setTooltipContent(stats[fulldt2][9] + "% dry &#8805; 90 days");
	per_dry90d_label_B.setTooltipContent(stats[fulldt2][27] + "% dry &#8805; 90 days");
	per_dry90d_label_C.setTooltipContent(stats[fulldt2][33] + "% dry &#8805; 90 days");
	per_dry90d_label_D.setTooltipContent(stats[fulldt2][39] + "% dry &#8805; 90 days");
	per_dry90d_label_E.setTooltipContent(stats[fulldt2][45] + "% dry &#8805; 90 days");
	per_dry90d_label_F.setTooltipContent(stats[fulldt2][51] + "% dry &#8805; 90 days");
	if (stats[fulldt2][4] < -58.4) col = 'rgba(230, 76, 0, 0.8)';
	else if (stats[fulldt2][4] < -43.2) col = 'rgba(245, 217, 1, 0.8)';
	else if (stats[fulldt2][4] < -13.9) col = 'rgba(18, 194, 73, 0.8)';
	else if (stats[fulldt2][4] < -3.9) col = 'rgba(0, 255, 255, 0.8)';
	else col = 'rgba(24, 116, 205, 0.8)';
	depth_mean_label_AX.setTooltipContent("<div style='background-color:" + col + ";padding:5px'>" + stats[fulldt2][4] + "cm mean depth</div>");
	if (stats[fulldt2][10] < -58.4) col = 'rgba(230, 76, 0, 0.8)';
	else if (stats[fulldt2][10] < -43.2) col = 'rgba(245, 217, 1, 0.8)';
	else if (stats[fulldt2][10] < -13.9) col = 'rgba(18, 194, 73, 0.8)';
	else if (stats[fulldt2][10] < -3.9) col = 'rgba(0, 255, 255, 0.8)';
	else col = 'rgba(24, 116, 205, 0.8)';
	depth_mean_label_A.setTooltipContent("<div style='background-color:" + col + ";padding:5px'>" + stats[fulldt2][10] + "cm mean depth</div>");
	if (stats[fulldt2][28] < -58.4) col = 'rgba(230, 76, 0, 0.8)';
	else if (stats[fulldt2][28] < -43.2) col = 'rgba(245, 217, 1, 0.8)';
	else if (stats[fulldt2][28] < -13.9) col = 'rgba(18, 194, 73, 0.8)';
	else if (stats[fulldt2][28] < -3.9) col = 'rgba(0, 255, 255, 0.8)';
	else col = 'rgba(24, 116, 205, 0.8)';
	depth_mean_label_B.setTooltipContent("<div style='background-color:" + col + ";padding:5px'>" + stats[fulldt2][28] + "cm mean depth</div>");
	if (stats[fulldt2][34] < -58.4) col = 'rgba(230, 76, 0, 0.8)';
	else if (stats[fulldt2][34] < -43.2) col = 'rgba(245, 217, 1, 0.8)';
	else if (stats[fulldt2][34] < -13.9) col = 'rgba(18, 194, 73, 0.8)';
	else if (stats[fulldt2][34] < -3.9) col = 'rgba(0, 255, 255, 0.8)';
	else col = 'rgba(24, 116, 205, 0.8)';
	depth_mean_label_C.setTooltipContent("<div style='background-color:" + col + ";padding:5px'>" + stats[fulldt2][34] + "cm mean depth</div>");
	if (stats[fulldt2][40] < -58.4) col = 'rgba(230, 76, 0, 0.8)';
	else if (stats[fulldt2][40] < -43.2) col = 'rgba(245, 217, 1, 0.8)';
	else if (stats[fulldt2][40] < -13.9) col = 'rgba(18, 194, 73, 0.8)';
	else if (stats[fulldt2][40] < -3.9) col = 'rgba(0, 255, 255, 0.8)';
	else col = 'rgba(24, 116, 205, 0.8)';
	depth_mean_label_D.setTooltipContent("<div style='background-color:" + col + ";padding:5px'>" + stats[fulldt2][40] + "cm mean depth</div>");
	if (stats[fulldt2][46] < -58.4) col = 'rgba(230, 76, 0, 0.8)';
	else if (stats[fulldt2][46] < -43.2) col = 'rgba(245, 217, 1, 0.8)';
	else if (stats[fulldt2][46] < -13.9) col = 'rgba(18, 194, 73, 0.8)';
	else if (stats[fulldt2][46] < -3.9) col = 'rgba(0, 255, 255, 0.8)';
	else col = 'rgba(24, 116, 205, 0.8)';
	depth_mean_label_E.setTooltipContent("<div style='background-color:" + col + ";padding:5px'>" + stats[fulldt2][46] + "cm mean depth</div>");
	if (stats[fulldt2][52] < -58.4) col = 'rgba(230, 76, 0, 0.8)';
	else if (stats[fulldt2][52] < -43.2) col = 'rgba(245, 217, 1, 0.8)';
	else if (stats[fulldt2][52] < -13.9) col = 'rgba(18, 194, 73, 0.8)';
	else if (stats[fulldt2][52] < -3.9) col = 'rgba(0, 255, 255, 0.8)';
	else col = 'rgba(24, 116, 205, 0.8)';
	depth_mean_label_F.setTooltipContent("<div style='background-color:" + col + ";padding:5px'>" + stats[fulldt2][52] + "cm mean depth</div>");
	if (stats[fulldt2][5] < 11.1) col = 'rgba(24, 116, 205, 0.8)';
	else if (stats[fulldt2][5] < 14.2) col = 'rgba(0, 255, 255, 0.8)';
	else if (stats[fulldt2][5] < 19.1) col = 'rgba(18, 194, 73, 0.8)';
	else if (stats[fulldt2][5] < 21.7) col = 'rgba(245, 217, 1, 0.8)';
	else col = 'rgba(230, 76, 0, 0.8)';
	depth_sd_label_AX.setTooltipContent("<div style='background-color:" + col + ";padding:5px'>" + stats[fulldt2][5] + "cm depth sd</div>");
	if (stats[fulldt2][11] < 11.1) col = 'rgba(24, 116, 205, 0.8)';
	else if (stats[fulldt2][11] < 14.2) col = 'rgba(0, 255, 255, 0.8)';
	else if (stats[fulldt2][11] < 19.1) col = 'rgba(18, 194, 73, 0.8)';
	else if (stats[fulldt2][11] < 21.7) col = 'rgba(245, 217, 1, 0.8)';
	else col = 'rgba(230, 76, 0, 0.8)';
	depth_sd_label_A.setTooltipContent("<div style='background-color:" + col + ";padding:5px'>" + stats[fulldt2][11] + "cm depth sd</div>");
	if (stats[fulldt2][29] < 11.1) col = 'rgba(24, 116, 205, 0.8)';
	else if (stats[fulldt2][29] < 14.2) col = 'rgba(0, 255, 255, 0.8)';
	else if (stats[fulldt2][29] < 19.1) col = 'rgba(18, 194, 73, 0.8)';
	else if (stats[fulldt2][29] < 21.7) col = 'rgba(245, 217, 1, 0.8)';
	else col = 'rgba(230, 76, 0, 0.8)';
	depth_sd_label_B.setTooltipContent("<div style='background-color:" + col + ";padding:5px'>" + stats[fulldt2][29] + "cm depth sd</div>");
	if (stats[fulldt2][35] < 11.1) col = 'rgba(24, 116, 205, 0.8)';
	else if (stats[fulldt2][35] < 14.2) col = 'rgba(0, 255, 255, 0.8)';
	else if (stats[fulldt2][35] < 19.1) col = 'rgba(18, 194, 73, 0.8)';
	else if (stats[fulldt2][35] < 21.7) col = 'rgba(245, 217, 1, 0.8)';
	else col = 'rgba(230, 76, 0, 0.8)';
	depth_sd_label_C.setTooltipContent("<div style='background-color:" + col + ";padding:5px'>" + stats[fulldt2][35] + "cm depth sd</div>");
	if (stats[fulldt2][41] < 11.1) col = 'rgba(24, 116, 205, 0.8)';
	else if (stats[fulldt2][41] < 14.2) col = 'rgba(0, 255, 255, 0.8)';
	else if (stats[fulldt2][41] < 19.1) col = 'rgba(18, 194, 73, 0.8)';
	else if (stats[fulldt2][41] < 21.7) col = 'rgba(245, 217, 1, 0.8)';
	else col = 'rgba(230, 76, 0, 0.8)';
	depth_sd_label_D.setTooltipContent("<div style='background-color:" + col + ";padding:5px'>" + stats[fulldt2][41] + "cm depth sd</div>");
	if (stats[fulldt2][47] < 11.1) col = 'rgba(24, 116, 205, 0.8)';
	else if (stats[fulldt2][47] < 14.2) col = 'rgba(0, 255, 255, 0.8)';
	else if (stats[fulldt2][47] < 19.1) col = 'rgba(18, 194, 73, 0.8)';
	else if (stats[fulldt2][47] < 21.7) col = 'rgba(245, 217, 1, 0.8)';
	else col = 'rgba(230, 76, 0, 0.8)';
	depth_sd_label_E.setTooltipContent("<div style='background-color:" + col + ";padding:5px'>" + stats[fulldt2][47] + "cm depth sd</div>");
	if (stats[fulldt2][53] < 11.1) col = 'rgba(24, 116, 205, 0.8)';
	else if (stats[fulldt2][53] < 14.2) col = 'rgba(0, 255, 255, 0.8)';
	else if (stats[fulldt2][53] < 19.1) col = 'rgba(18, 194, 73, 0.8)';
	else if (stats[fulldt2][53] < 21.7) col = 'rgba(245, 217, 1, 0.8)';
	else col = 'rgba(230, 76, 0, 0.8)';
	depth_sd_label_F.setTooltipContent("<div style='background-color:" + col + ";padding:5px'>" + stats[fulldt2][53] + "cm depth sd</div>");

<?php if($int) echo "	per_dry_label_A1.setTooltipContent(stats[fulldt2][12] + '% dry');
	per_dry_label_A2.setTooltipContent(stats[fulldt2][18] + '% dry');
	per_dry17cm_label_A1.setTooltipContent(stats[fulldt2][13] + '% WD &#8804; 17cm');
	per_dry17cm_label_A2.setTooltipContent(stats[fulldt2][19] + '% WD &#8804; 17cm');
	per_dry40d_label_A1.setTooltipContent(stats[fulldt2][14] + '% dry &#8805; 40 days');
	per_dry40d_label_A2.setTooltipContent(stats[fulldt2][20] + '% dry &#8805; 40 days');
	per_dry90d_label_A1.setTooltipContent(stats[fulldt2][15] + '% dry &#8805; 90 days');
	per_dry90d_label_A2.setTooltipContent(stats[fulldt2][21] + '% dry &#8805; 90 days');
	if (stats[fulldt2][16] < -58.4) col = 'rgba(230, 76, 0, 0.8)';
	else if (stats[fulldt2][16] < -43.2) col = 'rgba(245, 217, 1, 0.8)';
	else if (stats[fulldt2][16] < -13.9) col = 'rgba(18, 194, 73, 0.8)';
	else if (stats[fulldt2][16] < -3.9) col = 'rgba(0, 255, 255, 0.8)';
	else col = 'rgba(24, 116, 205, 0.8)';
	depth_mean_label_A1.setTooltipContent(\"<div style='background-color:\" + col + \";padding:5px'>\" + stats[fulldt2][16] + \"cm mean depth</div>\");
	if (stats[fulldt2][22] < -58.4) col = 'rgba(230, 76, 0, 0.8)';
	else if (stats[fulldt2][22] < -43.2) col = 'rgba(245, 217, 1, 0.8)';
	else if (stats[fulldt2][22] < -13.9) col = 'rgba(18, 194, 73, 0.8)';
	else if (stats[fulldt2][22] < -3.9) col = 'rgba(0, 255, 255, 0.8)';
	else col = 'rgba(24, 116, 205, 0.8)';
	depth_mean_label_A2.setTooltipContent(\"<div style='background-color:\" + col + \";padding:5px'>\" + stats[fulldt2][22] + \"cm mean depth</div>\");
	if (stats[fulldt2][17] < 11.1) col = 'rgba(24, 116, 205, 0.8)';
	else if (stats[fulldt2][17] < 14.2) col = 'rgba(0, 255, 255, 0.8)';
	else if (stats[fulldt2][17] < 19.1) col = 'rgba(18, 194, 73, 0.8)';
	else if (stats[fulldt2][17] < 21.7) col = 'rgba(245, 217, 1, 0.8)';
	else col = 'rgba(230, 76, 0, 0.8)';
	depth_sd_label_A1.setTooltipContent(\"<div style='background-color:\" + col + \";padding:5px'>\" + stats[fulldt2][17] + 'cm depth sd</div>');
	if (stats[fulldt2][23] < 11.1) col = 'rgba(24, 116, 205, 0.8)';
	else if (stats[fulldt2][23] < 14.2) col = 'rgba(0, 255, 255, 0.8)';
	else if (stats[fulldt2][23] < 19.1) col = 'rgba(18, 194, 73, 0.8)';
	else if (stats[fulldt2][23] < 21.7) col = 'rgba(245, 217, 1, 0.8)';
	else col = 'rgba(230, 76, 0, 0.8)';
	depth_sd_label_A2.setTooltipContent(\"<div style='background-color:\" + col + \";padding:5px'>\" + stats[fulldt2][23] + 'cm depth sd</div>');\n"; ?>
}

function show_gages() {
	if(document.getElementById('gages').checked) {
<?php
mysqli_data_seek($result, 0);
for ($i = 0; $i < $num_results; $i++) {
	$row = mysqli_fetch_array($result);
	echo "gage{$row['sname']}.setOpacity(1);\n";
}
?>
	}
	else {
<?php
mysqli_data_seek($result, 0);
for ($i = 0; $i < $num_results; $i++) {
	$row = mysqli_fetch_array($result);
	echo "gage{$row['sname']}.setOpacity(0);\n";
}
?>
	}
}

function per_dry() {
	per_dry_label_AX.toggleTooltip();
	per_dry_label_A.toggleTooltip();
<?php if($int) echo "	per_dry_label_A1.toggleTooltip();
	per_dry_label_A2.toggleTooltip();\n"; ?>
	per_dry_label_B.toggleTooltip();
	per_dry_label_C.toggleTooltip();
	per_dry_label_D.toggleTooltip();
	per_dry_label_E.toggleTooltip();
	per_dry_label_F.toggleTooltip();
}

function per_dry17cm() {
	per_dry17cm_label_AX.toggleTooltip();
	per_dry17cm_label_A.toggleTooltip();
<?php if($int) echo "	per_dry17cm_label_A1.toggleTooltip();
	per_dry17cm_label_A2.toggleTooltip();\n"; ?>
	per_dry17cm_label_B.toggleTooltip();
	per_dry17cm_label_C.toggleTooltip();
	per_dry17cm_label_D.toggleTooltip();
	per_dry17cm_label_E.toggleTooltip();
	per_dry17cm_label_F.toggleTooltip();
}

function per_dry40d() {
	per_dry40d_label_AX.toggleTooltip();
	per_dry40d_label_A.toggleTooltip();
<?php if($int) echo "	per_dry40d_label_A1.toggleTooltip();
	per_dry40d_label_A2.toggleTooltip();\n"; ?>
	per_dry40d_label_B.toggleTooltip();
	per_dry40d_label_C.toggleTooltip();
	per_dry40d_label_D.toggleTooltip();
	per_dry40d_label_E.toggleTooltip();
	per_dry40d_label_F.toggleTooltip();
}

function per_dry90d() {
	per_dry90d_label_AX.toggleTooltip();
	per_dry90d_label_A.toggleTooltip();
<?php if($int) echo "	per_dry90d_label_A1.toggleTooltip();
	per_dry90d_label_A2.toggleTooltip();\n"; ?>
	per_dry90d_label_B.toggleTooltip();
	per_dry90d_label_C.toggleTooltip();
	per_dry90d_label_D.toggleTooltip();
	per_dry90d_label_E.toggleTooltip();
	per_dry90d_label_F.toggleTooltip();
}

function depth_mean() {
	depth_mean_label_AX.toggleTooltip();
	depth_mean_label_A.toggleTooltip();
<?php if($int) echo "		depth_mean_label_A1.toggleTooltip();
	depth_mean_label_A2.toggleTooltip();\n"; ?>
	depth_mean_label_B.toggleTooltip();
	depth_mean_label_C.toggleTooltip();
	depth_mean_label_D.toggleTooltip();
	depth_mean_label_E.toggleTooltip();
	depth_mean_label_F.toggleTooltip();
}

function depth_sd()
{
	depth_sd_label_AX.toggleTooltip();
	depth_sd_label_A.toggleTooltip();
<?php if($int) echo "	depth_sd_label_A1.toggleTooltip();
	depth_sd_label_A2.toggleTooltip();\n"; ?>
	depth_sd_label_B.toggleTooltip();
	depth_sd_label_C.toggleTooltip();
	depth_sd_label_D.toggleTooltip();
	depth_sd_label_E.toggleTooltip();
	depth_sd_label_F.toggleTooltip();
}

var popup = L.popup();

$('#tabset').tabify({
  selector_tab: '.tab',
  selector_content: '.tabcontentdiv',
  tab_activeClass: 'tab-active',
  content_activeClass: 'tabcontentdiv-active'
});

new jBox('Modal', {
	width: 600,
  height: 435,
  addClass: 'jbox',
  attach: $('#modalA40'),
  position: {
  	x: 'center',
  	y: 100
  },
  title: 'A % 40 days dry',
  overlay: false,
  createOnInit: true,
  content: "<img src='graphs/nest40_A.png'>",
  draggable: true
});
new jBox('Modal', {
	width: 600,
  height: 435,
  addClass: 'jbox',
  attach: $('#modalA402'),
  title: 'A % 40 days dry',
  overlay: false,
  createOnInit: true,
  content: "<img src='graphs/nest40_A.png'>",
  draggable: true
});
new jBox('Modal', {
	width: 600,
  height: 435,
  addClass: 'jbox',
  attach: $('#modalAX40'),
  position: {
  	x: 'center',
  	y: 200
  },
  title: 'AX % 40 days dry',
  overlay: false,
  createOnInit: true,
  content: "<img src='graphs/nest40_AX.png'>",
  draggable: true
});
new jBox('Modal', {
	width: 600,
  height: 435,
  addClass: 'jbox',
  attach: $('#modalA140'),
  title: 'A1 % 40 days dry',
  overlay: false,
  createOnInit: true,
  content: "<img src='graphs/nest40_A1.png'>",
  draggable: true
});
new jBox('Modal', {
	width: 600,
  height: 435,
  addClass: 'jbox',
  attach: $('#modalA240'),
  title: 'A2 % 40 days dry',
  overlay: false,
  createOnInit: true,
  content: "<img src='graphs/nest40_A2.png'>",
  draggable: true
});
new jBox('Modal', {
	width: 600,
  height: 435,
  addClass: 'jbox',
  attach: $('#modalB40'),
  position: {
  	x: 'center',
  	y: 300
  },
  title: 'B % 40 days dry',
  overlay: false,
  createOnInit: true,
  content: "<img src='graphs/nest40_B.png'>",
  draggable: true
});
new jBox('Modal', {
	width: 600,
  height: 435,
  addClass: 'jbox',
  attach: $('#modalC40'),
  position: {
  	x: 'center',
  	y: 400
  },
  title: 'C % 40 days dry',
  overlay: false,
  createOnInit: true,
  content: "<img src='graphs/nest40_C.png'>",
  draggable: true
});
new jBox('Modal', {
	width: 600,
  height: 435,
  addClass: 'jbox',
  attach: $('#modalD40'),
  position: {
  	x: 'center',
  	y: 500
  },
  title: 'D % 40 days dry',
  overlay: false,
  createOnInit: true,
  content: "<img src='graphs/nest40_D.png'>",
  draggable: true
});
new jBox('Modal', {
	width: 600,
  height: 435,
  addClass: 'jbox',
  attach: $('#modalE40'),
  position: {
  	x: 'center',
  	y: 600
  },
  title: 'E % 40 days dry',
  overlay: false,
  createOnInit: true,
  content: "<img src='graphs/nest40_E.png'>",
  draggable: true
});
new jBox('Modal', {
	width: 600,
  height: 435,
  addClass: 'jbox',
  position: {
  	x: 'center',
  	y: 700
  },
  attach: $('#modalF40'),
  title: 'F % 40 days dry',
  overlay: false,
  createOnInit: true,
  content: "<img src='graphs/nest40_F.png'>",
  draggable: true
});
new jBox('Modal', {
	width: 600,
  height: 435,
  addClass: 'jbox',
  attach: $('#modalA90'),
  position: {
  	x: 'center',
  	y: 100
  },
  offset: {
  	x: 100,
  	y: 0
  },
  title: 'A % 90 days dry',
  overlay: false,
  createOnInit: true,
  content: "<img src='graphs/nest90_A.png'>",
  draggable: true
});
new jBox('Modal', {
	width: 600,
  height: 435,
  addClass: 'jbox',
  attach: $('#modalAX90'),
  position: {
  	x: 'center',
  	y: 200
  },
  offset: {
  	x: 100,
  	y: 0
  },
  title: 'AX % 90 days dry',
  overlay: false,
  createOnInit: true,
  content: "<img src='graphs/nest90_AX.png'>",
  draggable: true
});
new jBox('Modal', {
	width: 600,
  height: 435,
  addClass: 'jbox',
  attach: $('#modalA190'),
  title: 'A1 % 90 days dry',
  overlay: false,
  createOnInit: true,
  content: "<img src='graphs/nest90_A1.png'>",
  draggable: true
});
new jBox('Modal', {
	width: 600,
  height: 435,
  addClass: 'jbox',
  attach: $('#modalA290'),
  title: 'A2 % 90 days dry',
  overlay: false,
  createOnInit: true,
  content: "<img src='graphs/nest90_A2.png'>",
  draggable: true
});
new jBox('Modal', {
	width: 600,
  height: 435,
  addClass: 'jbox',
  attach: $('#modalB90'),
  position: {
  	x: 'center',
  	y: 300
  },
  offset: {
  	x: 100,
  	y: 0
  },
  title: 'B % 90 days dry',
  overlay: false,
  createOnInit: true,
  content: "<img src='graphs/nest90_B.png'>",
  draggable: true
});
new jBox('Modal', {
	width: 600,
  height: 435,
  addClass: 'jbox',
  attach: $('#modalC90'),
  position: {
  	x: 'center',
  	y: 400
  },
  offset: {
  	x: 100,
  	y: 0
  },
  title: 'C % 90 days dry',
  overlay: false,
  createOnInit: true,
  content: "<img src='graphs/nest90_C.png'>",
  draggable: true
});
new jBox('Modal', {
	width: 600,
  height: 435,
  addClass: 'jbox',
  attach: $('#modalD90'),
  position: {
  	x: 'center',
  	y: 500
  },
  offset: {
  	x: 100,
  	y: 0
  },
  title: 'D % 90 days dry',
  overlay: false,
  createOnInit: true,
  content: "<img src='graphs/nest90_D.png'>",
  draggable: true
});
new jBox('Modal', {
	width: 600,
  height: 435,
  addClass: 'jbox',
  attach: $('#modalE90'),
  position: {
  	x: 'center',
  	y: 600
  },
  offset: {
  	x: 100,
  	y: 0
  },
  title: 'E % 90 days dry',
  overlay: false,
  createOnInit: true,
  content: "<img src='graphs/nest90_E.png'>",
  draggable: true
});
new jBox('Modal', {
	width: 600,
  height: 435,
  addClass: 'jbox',
  attach: $('#modalF90'),
  position: {
  	x: 'center',
  	y: 700
  },
  offset: {
  	x: 100,
  	y: 0
  },
  title: 'F % 90 days dry',
  overlay: false,
  createOnInit: true,
  content: "<img src='graphs/nest90_F.png'>",
  draggable: true
});
new jBox('Modal', {
	width: 600,
  height: 435,
  addClass: 'jbox',
  attach: $('#modalA0_89'),
  title: 'A % 0 to 89 hydroperiod days',
  position: {
  	x: 'center',
  	y: 100
  },
  offset: {
  	x: -300,
  	y: 0
  },
  overlay: false,
  createOnInit: true,
  content: "<img src='graphs/year0_to_89_A.png'>",
  draggable: true
});
new jBox('Modal', {
	width: 600,
  height: 435,
  addClass: 'jbox',
  attach: $('#modalAX0_89'),
  position: {
  	x: 'center',
  	y: 200
  },
  offset: {
  	x: -300,
  	y: 0
  },
  title: 'AX % 0 to 89 hydroperiod days',
  overlay: false,
  createOnInit: true,
  content: "<img src='graphs/year0_to_89_AX.png'>",
  draggable: true
});
new jBox('Modal', {
	width: 600,
  height: 435,
  addClass: 'jbox',
  attach: $('#modalA10_89'),
  title: 'A1 % 0 to 89 hydroperiod days',
  overlay: false,
  createOnInit: true,
  content: "<img src='graphs/year0_to_89_A1.png'>",
  draggable: true
});
new jBox('Modal', {
	width: 600,
  height: 435,
  addClass: 'jbox',
  attach: $('#modalA20_89'),
  title: 'A2 % 0 to 89 hydroperiod days',
  overlay: false,
  createOnInit: true,
  content: "<img src='graphs/year0_to_89_A2.png'>",
  draggable: true
});
new jBox('Modal', {
	width: 600,
  height: 435,
  addClass: 'jbox',
  attach: $('#modalB0_89'),
  position: {
  	x: 'center',
  	y: 300
  },
  offset: {
  	x: -300,
  	y: 0
  },
  title: 'B % 0 to 89 hydroperiod days',
  overlay: false,
  createOnInit: true,
  content: "<img src='graphs/year0_to_89_B.png'>",
  draggable: true
});
new jBox('Modal', {
	width: 600,
  height: 435,
  addClass: 'jbox',
  attach: $('#modalC0_89'),
  position: {
  	x: 'center',
  	y: 400
  },
  offset: {
  	x: -300,
  	y: 0
  },
  title: 'C % 0 to 89 hydroperiod days',
  overlay: false,
  createOnInit: true,
  content: "<img src='graphs/year0_to_89_C.png'>",
  draggable: true
});
new jBox('Modal', {
	width: 600,
  height: 435,
  addClass: 'jbox',
  attach: $('#modalD0_89'),
  position: {
  	x: 'center',
  	y: 500
  },
  offset: {
  	x: -300,
  	y: 0
  },
  title: 'D % 0 to 89 hydroperiod days',
  overlay: false,
  createOnInit: true,
  content: "<img src='graphs/year0_to_89_D.png'>",
  draggable: true
});
new jBox('Modal', {
	width: 600,
  height: 435,
  addClass: 'jbox',
  attach: $('#modalE0_89'),
  position: {
  	x: 'center',
  	y: 600
  },
  offset: {
  	x: -300,
  	y: 0
  },
  title: 'E % 0 to 89 hydroperiod days',
  overlay: false,
  createOnInit: true,
  content: "<img src='graphs/year0_to_89_E.png'>",
  draggable: true
});
new jBox('Modal', {
	width: 600,
  height: 435,
  addClass: 'jbox',
  attach: $('#modalF0_89'),
  position: {
  	x: 'center',
  	y: 700
  },
  offset: {
  	x: -300,
  	y: 0
  },
  title: 'F % 0 to 89 hydroperiod days',
  overlay: false,
  createOnInit: true,
  content: "<img src='graphs/year0_to_89_F.png'>",
  draggable: true
});
new jBox('Modal', {
	width: 600,
  height: 435,
  addClass: 'jbox',
  attach: $('#modalA90_210'),
  position: {
  	x: 'center',
  	y: 100
  },
  offset: {
  	x: -200,
  	y: 0
  },
  title: 'A % 90 to 210 hydroperiod days',
  overlay: false,
  createOnInit: true,
  content: "<img src='graphs/year90_to_210_A.png'>",
  draggable: true
});
new jBox('Modal', {
	width: 600,
  height: 435,
  addClass: 'jbox',
  attach: $('#modalAX90_210'),
  position: {
  	x: 'center',
  	y: 200
  },
  offset: {
  	x: -200,
  	y: 0
  },
  title: 'AX % 90 to 210 hydroperiod days',
  overlay: false,
  createOnInit: true,
  content: "<img src='graphs/year90_to_210_AX.png'>",
  draggable: true
});
new jBox('Modal', {
	width: 600,
  height: 435,
  addClass: 'jbox',
  attach: $('#modalA190_210'),
  title: 'A1 % 90 to 210 hydroperiod days',
  overlay: false,
  createOnInit: true,
  content: "<img src='graphs/year90_to_210_A1.png'>",
  draggable: true
});
new jBox('Modal', {
	width: 600,
  height: 435,
  addClass: 'jbox',
  attach: $('#modalA290_210'),
  title: 'A2 % 90 to 210 hydroperiod days',
  overlay: false,
  createOnInit: true,
  content: "<img src='graphs/year90_to_210_A2.png'>",
  draggable: true
});
new jBox('Modal', {
	width: 600,
  height: 435,
  addClass: 'jbox',
  attach: $('#modalB90_210'),
  position: {
  	x: 'center',
  	y: 300
  },
  offset: {
  	x: -200,
  	y: 0
  },
  title: 'B % 90 to 210 hydroperiod days',
  overlay: false,
  createOnInit: true,
  content: "<img src='graphs/year90_to_210_B.png'>",
  draggable: true
});
new jBox('Modal', {
	width: 600,
  height: 435,
  addClass: 'jbox',
  attach: $('#modalC90_210'),
  position: {
  	x: 'center',
  	y: 400
  },
  offset: {
  	x: -200,
  	y: 0
  },
  title: 'C % 90 to 210 hydroperiod days',
  overlay: false,
  createOnInit: true,
  content: "<img src='graphs/year90_to_210_C.png'>",
  draggable: true
});
new jBox('Modal', {
	width: 600,
  height: 435,
  addClass: 'jbox',
  attach: $('#modalD90_210'),
  position: {
  	x: 'center',
  	y: 500
  },
  offset: {
  	x: -200,
  	y: 0
  },
  title: 'D % 90 to 210 hydroperiod days',
  overlay: false,
  createOnInit: true,
  content: "<img src='graphs/year90_to_210_D.png'>",
  draggable: true
});
new jBox('Modal', {
	width: 600,
  height: 435,
  addClass: 'jbox',
  attach: $('#modalE90_210'),
  position: {
  	x: 'center',
  	y: 600
  },
  offset: {
  	x: -200,
  	y: 0
  },
  title: 'E % 90 to 210 hydroperiod days',
  overlay: false,
  createOnInit: true,
  content: "<img src='graphs/year90_to_210_E.png'>",
  draggable: true
});
new jBox('Modal', {
	width: 600,
  height: 435,
  addClass: 'jbox',
  attach: $('#modalF90_210'),
  position: {
  	x: 'center',
  	y: 700
  },
  offset: {
  	x: -200,
  	y: 0
  },
  title: 'F % 90 to 210 hydroperiod days',
  overlay: false,
  createOnInit: true,
  content: "<img src='graphs/year90_to_210_F.png'>",
  draggable: true
});
new jBox('Modal', {
	width: 600,
  height: 435,
  addClass: 'jbox',
  attach: $('#modalA211'),
  position: {
  	x: 'center',
  	y: 100
  },
  offset: {
  	x: -100,
  	y: 0
  },
  title: 'A % &#8805;211 hydroperiod days',
  overlay: false,
  createOnInit: true,
  content: "<img src='graphs/year211_A.png'>",
  draggable: true
});
new jBox('Modal', {
	width: 600,
  height: 435,
  addClass: 'jbox',
  attach: $('#modalAX211'),
  position: {
  	x: 'center',
  	y: 200
  },
  offset: {
  	x: -100,
  	y: 0
  },
  title: 'AX % &#8805;211 hydroperiod days',
  overlay: false,
  createOnInit: true,
  content: "<img src='graphs/year211_AX.png'>",
  draggable: true
});
new jBox('Modal', {
	width: 600,
  height: 435,
  addClass: 'jbox',
  attach: $('#modalA1211'),
  title: 'A1 % &#8805;211 hydroperiod days',
  overlay: false,
  createOnInit: true,
  content: "<img src='graphs/year211_A1.png'>",
  draggable: true
});
new jBox('Modal', {
	width: 600,
  height: 435,
  addClass: 'jbox',
  attach: $('#modalA2211'),
  title: 'A2 % &#8805;211 hydroperiod days',
  overlay: false,
  createOnInit: true,
  content: "<img src='graphs/year211_A2.png'>",
  draggable: true
});
new jBox('Modal', {
	width: 600,
  height: 435,
  addClass: 'jbox',
  attach: $('#modalB211'),
  position: {
  	x: 'center',
  	y: 300
  },
  offset: {
  	x: -100,
  	y: 0
  },
  title: 'B % &#8805;211 hydroperiod days',
  overlay: false,
  createOnInit: true,
  content: "<img src='graphs/year211_B.png'>",
  draggable: true
});
new jBox('Modal', {
	width: 600,
  height: 435,
  addClass: 'jbox',
  attach: $('#modalC211'),
  position: {
  	x: 'center',
  	y: 400
  },
  offset: {
  	x: -100,
  	y: 0
  },
  title: 'C % &#8805;211 hydroperiod days',
  overlay: false,
  createOnInit: true,
  content: "<img src='graphs/year211_C.png'>",
  draggable: true
});
new jBox('Modal', {
	width: 600,
  height: 435,
  addClass: 'jbox',
  attach: $('#modalD211'),
  position: {
  	x: 'center',
  	y: 500
  },
  offset: {
  	x: -100,
  	y: 0
  },
  title: 'D % &#8805;211 hydroperiod days',
  overlay: false,
  createOnInit: true,
  content: "<img src='graphs/year211_D.png'>",
  draggable: true
});
new jBox('Modal', {
	width: 600,
  height: 435,
  addClass: 'jbox',
  attach: $('#modalE211'),
  position: {
  	x: 'center',
  	y: 600
  },
  offset: {
  	x: -100,
  	y: 0
  },
  title: 'E % &#8805;211 hydroperiod days',
  overlay: false,
  createOnInit: true,
  content: "<img src='graphs/year211_E.png'>",
  draggable: true
});
new jBox('Modal', {
	width: 600,
  height: 435,
  addClass: 'jbox',
  attach: $('#modalF211'),
  position: {
  	x: 'center',
  	y: 700
  },
  offset: {
  	x: -100,
  	y: 0
  },
  title: 'F % &#8805;211 hydroperiod days',
  overlay: false,
  createOnInit: true,
  content: "<img src='graphs/year211_F.png'>",
  draggable: true
});
new jBox('Modal', {
	width: 600,
  height: 435,
  addClass: 'jbox',
  attach: $('#modalA_HP'),
  position: {
  	x: 'center',
  	y: 100
  },
  offset: {
  	x: 200,
  	y: 0
  },
  title: 'A mean 4yr hydroperiod days',
  overlay: false,
  createOnInit: true,
  content: "<img src='graphs/four_hyd_mean_A.png'>",
  draggable: true
});
new jBox('Modal', {
	width: 600,
  height: 435,
  addClass: 'jbox',
  attach: $('#modalAX_HP'),
  position: {
  	x: 'center',
  	y: 200
  },
  offset: {
  	x: 200,
  	y: 0
  },
  title: 'AX mean 4yr hydroperiod days',
  overlay: false,
  createOnInit: true,
  content: "<img src='graphs/four_hyd_mean_AX.png'>",
  draggable: true
});
new jBox('Modal', {
	width: 600,
  height: 435,
  addClass: 'jbox',
  attach: $('#modalA1_HP'),
  title: 'A1 mean 4yr hydroperiod days',
  overlay: false,
  createOnInit: true,
  content: "<img src='graphs/four_hyd_mean_A1.png'>",
  draggable: true
});
new jBox('Modal', {
	width: 600,
  height: 435,
  addClass: 'jbox',
  attach: $('#modalA2_HP'),
  title: 'A2 mean 4yr hydroperiod days',
  overlay: false,
  createOnInit: true,
  content: "<img src='graphs/four_hyd_mean_A2.png'>",
  draggable: true
});
new jBox('Modal', {
	width: 600,
  height: 435,
  addClass: 'jbox',
  attach: $('#modalB_HP'),
  position: {
  	x: 'center',
  	y: 300
  },
  offset: {
  	x: 200,
  	y: 0
  },
  title: 'B mean 4yr hydroperiod days',
  overlay: false,
  createOnInit: true,
  content: "<img src='graphs/four_hyd_mean_B.png'>",
  draggable: true
});
new jBox('Modal', {
	width: 600,
  height: 435,
  addClass: 'jbox',
  attach: $('#modalC_HP'),
  position: {
  	x: 'center',
  	y: 400
  },
  offset: {
  	x: 200,
  	y: 0
  },
  title: 'C mean 4yr hydroperiod days',
  overlay: false,
  createOnInit: true,
  content: "<img src='graphs/four_hyd_mean_C.png'>",
  draggable: true
});
new jBox('Modal', {
	width: 600,
  height: 435,
  addClass: 'jbox',
  attach: $('#modalD_HP'),
  position: {
  	x: 'center',
  	y: 500
  },
  offset: {
  	x: 200,
  	y: 0
  },
  title: 'D mean 4yr hydroperiod days',
  overlay: false,
  createOnInit: true,
  content: "<img src='graphs/four_hyd_mean_D.png'>",
  draggable: true
});
new jBox('Modal', {
	width: 600,
  height: 435,
  addClass: 'jbox',
  attach: $('#modalE_HP'),
  position: {
  	x: 'center',
  	y: 600
  },
  offset: {
  	x: 200,
  	y: 0
  },
  title: 'E mean 4yr hydroperiod days',
  overlay: false,
  createOnInit: true,
  content: "<img src='graphs/four_hyd_mean_E.png'>",
  draggable: true
});
new jBox('Modal', {
	width: 600,
  height: 435,
  addClass: 'jbox',
  attach: $('#modalF_HP'),
  position: {
  	x: 'center',
  	y: 700
  },
  offset: {
  	x: 200,
  	y: 0
  },
  title: 'F mean 4yr hydroperiod days',
  overlay: false,
  createOnInit: true,
  content: "<img src='graphs/four_hyd_mean_F.png'>",
  draggable: true
});
new jBox('Modal', {
	width: 600,
  height: 435,
  addClass: 'jbox',
  attach: $('#modalA_HPP'),
  position: {
  	x: 'center',
  	y: 100
  },
  offset: {
  	x: 300,
  	y: 0
  },
  title: 'A mean 4yr hydroperiod days, % area',
  overlay: false,
  createOnInit: true,
  content: "<img src='graphs/four_hyd_per_A.png'>",
  draggable: true
});
new jBox('Modal', {
	width: 600,
  height: 435,
  addClass: 'jbox',
  attach: $('#modalAX_HPP'),
  position: {
  	x: 'center',
  	y: 200
  },
  offset: {
  	x: 300,
  	y: 0
  },
  title: 'AX mean 4yr hydroperiod days, % area',
  overlay: false,
  createOnInit: true,
  content: "<img src='graphs/four_hyd_per_AX.png'>",
  draggable: true
});
new jBox('Modal', {
	width: 600,
  height: 435,
  addClass: 'jbox',
  attach: $('#modalA1_HPP'),
  title: 'A1 mean 4yr hydroperiod days',
  overlay: false,
  createOnInit: true,
  content: "<img src='graphs/four_hyd_per_A1.png'>",
  draggable: true
});
new jBox('Modal', {
	width: 600,
  height: 435,
  addClass: 'jbox',
  attach: $('#modalA2_HPP'),
  title: 'A2 mean 4yr hydroperiod days, % area',
  overlay: false,
  createOnInit: true,
  content: "<img src='graphs/four_hyd_per_A2.png'>",
  draggable: true
});
new jBox('Modal', {
	width: 600,
  height: 435,
  addClass: 'jbox',
  attach: $('#modalB_HPP'),
  position: {
  	x: 'center',
  	y: 300
  },
  offset: {
  	x: 300,
  	y: 0
  },
  title: 'B mean 4yr hydroperiod days, % area',
  overlay: false,
  createOnInit: true,
  content: "<img src='graphs/four_hyd_per_B.png'>",
  draggable: true
});
new jBox('Modal', {
	width: 600,
  height: 435,
  addClass: 'jbox',
  attach: $('#modalC_HPP'),
  position: {
  	x: 'center',
  	y: 400
  },
  offset: {
  	x: 300,
  	y: 0
  },
  title: 'C mean 4yr hydroperiod days, % area',
  overlay: false,
  createOnInit: true,
  content: "<img src='graphs/four_hyd_per_C.png'>",
  draggable: true
});
new jBox('Modal', {
	width: 600,
  height: 435,
  addClass: 'jbox',
  attach: $('#modalD_HPP'),
  position: {
  	x: 'center',
  	y: 500
  },
  offset: {
  	x: 300,
  	y: 0
  },
  title: 'D mean 4yr hydroperiod days, % area',
  overlay: false,
  createOnInit: true,
  content: "<img src='graphs/four_hyd_per_D.png'>",
  draggable: true
});
new jBox('Modal', {
	width: 600,
  height: 435,
  addClass: 'jbox',
  attach: $('#modalE_HPP'),
  position: {
  	x: 'center',
  	y: 600
  },
  offset: {
  	x: 300,
  	y: 0
  },
  title: 'E mean 4yr hydroperiod days, % area',
  overlay: false,
  createOnInit: true,
  content: "<img src='graphs/four_hyd_per_E.png'>",
  draggable: true
});
new jBox('Modal', {
	width: 600,
  height: 435,
  addClass: 'jbox',
  attach: $('#modalF_HPP'),
  position: {
  	x: 'center',
  	y: 700
  },
  offset: {
  	x: 300,
  	y: 0
  },
  title: 'F mean 4yr hydroperiod days, % area',
  overlay: false,
  createOnInit: true,
  content: "<img src='graphs/four_hyd_per_F.png'>",
  draggable: true
});
new jBox('Modal', {
	width: 600,
  height: 435,
  addClass: 'jbox',
  attach: $('#modalA_SD'),
  position: {
  	x: 'center',
  	y: 100
  },
  offset: {
  	x: 400,
  	y: 0
  },
  title: 'A mean 4yr hydroperiod days stnd. dev.',
  overlay: false,
  createOnInit: true,
  content: "<img src='graphs/four_hyd_sd_A.png'>",
  draggable: true
});
new jBox('Modal', {
	width: 600,
  height: 435,
  addClass: 'jbox',
  attach: $('#modalAX_SD'),
  position: {
  	x: 'center',
  	y: 200
  },
  offset: {
  	x: 400,
  	y: 0
  },
  title: 'AX mean 4yr hydroperiod days stnd. dev.',
  overlay: false,
  createOnInit: true,
  content: "<img src='graphs/four_hyd_sd_AX.png'>",
  draggable: true
});
new jBox('Modal', {
	width: 600,
  height: 435,
  addClass: 'jbox',
  attach: $('#modalA1_SD'),
  title: 'A1 mean 4yr hydroperiod days stnd. dev.',
  overlay: false,
  createOnInit: true,
  content: "<img src='graphs/four_hyd_sd_A1.png'>",
  draggable: true
});
new jBox('Modal', {
	width: 600,
  height: 435,
  addClass: 'jbox',
  attach: $('#modalA2_SD'),
  title: 'A2 mean 4yr hydroperiod days stnd. dev.',
  overlay: false,
  createOnInit: true,
  content: "<img src='graphs/four_hyd_sd_A2.png'>",
  draggable: true
});
new jBox('Modal', {
	width: 600,
  height: 435,
  addClass: 'jbox',
  attach: $('#modalB_SD'),
  position: {
  	x: 'center',
  	y: 300
  },
  offset: {
  	x: 400,
  	y: 0
  },
  title: 'B mean 4yr hydroperiod days stnd. dev.',
  overlay: false,
  createOnInit: true,
  content: "<img src='graphs/four_hyd_sd_B.png'>",
  draggable: true
});
new jBox('Modal', {
	width: 600,
  height: 435,
  addClass: 'jbox',
  attach: $('#modalC_SD'),
  position: {
  	x: 'center',
  	y: 400
  },
  offset: {
  	x: 400,
  	y: 0
  },
  title: 'C mean 4yr hydroperiod days stnd. dev.',
  overlay: false,
  createOnInit: true,
  content: "<img src='graphs/four_hyd_sd_C.png'>",
  draggable: true
});
new jBox('Modal', {
	width: 600,
  height: 435,
  addClass: 'jbox',
  attach: $('#modalD_SD'),
  position: {
  	x: 'center',
  	y: 500
  },
  offset: {
  	x: 400,
  	y: 0
  },
  title: 'D mean 4yr hydroperiod days stnd. dev.',
  overlay: false,
  createOnInit: true,
  content: "<img src='graphs/four_hyd_sd_D.png'>",
  draggable: true
});
new jBox('Modal', {
	width: 600,
  height: 435,
  addClass: 'jbox',
  attach: $('#modalE_SD'),
  position: {
  	x: 'center',
  	y: 600
  },
  offset: {
  	x: 400,
  	y: 0
  },
  title: 'E mean 4yr hydroperiod days stnd. dev.',
  overlay: false,
  createOnInit: true,
  content: "<img src='graphs/four_hyd_sd_E.png'>",
  draggable: true
});
new jBox('Modal', {
	width: 600,
  height: 435,
  addClass: 'jbox',
  attach: $('#modalF_SD'),
  position: {
  	x: 'center',
  	y: 700
  },
  offset: {
  	x: 400,
  	y: 0
  },
  title: 'F mean 4yr hydroperiod days stnd. dev.',
  overlay: false,
  createOnInit: true,
  content: "<img src='graphs/four_hyd_sd_F.png'>",
  draggable: true
});
</script>
<?php require ($_SERVER['DOCUMENT_ROOT'] . '/../eden/ssi/eden-foot.php'); ?>