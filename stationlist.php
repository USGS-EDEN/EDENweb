<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Water-Level Data - Everglades Depth Estimation Network (EDEN)</title>
  <link rel="stylesheet" href="css/eden-dbweb-html5.css">
  <script src="https://www2.usgs.gov/scripts/analytics/usgs-analytics.js"></script>
  <style>
    table { border-collapse: collapse }
    table, td, th { border: 1px solid #477489 }
    td, th { padding: 2px }
    p {
      text-align: left;
      margin: 2px 1px
    }
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
  </style>
</head>
<body>
<?php require ($_SERVER['DOCUMENT_ROOT'] . '/eden/ssi/eden-head.txt'); ?>
<?php require ($_SERVER['DOCUMENT_ROOT'] . '/eden/ssi/nav.php'); ?>
<div style="overflow:hidden;padding-right:8px;background-color:white"><!--Begin body of page -->
  <h2>Gage Data for EDEN Network</h2>
  <div style="text-align:center">
    <div style="display:inline-block;width:766px">
      <table style="width:350px;float:left">
        <tr>
          <td class="sectionheader">Search by Area</td>
        </tr>
        <tr>
          <td>
      	    <img src="images/maps/EDEN_website_map_w_legend_w_inserts-sm.gif" alt="map showing areas within south Florida" height="366" width="326" usemap="#area-location-map-trim">
      	    <map name="area-location-map-trim">
      	      <area shape="poly" coords="153,316,212,286,177,269,159,218,98,165,68,166,125,224,136,257,132,292" href="stationlist-area.php?area=GOM" alt="">
      	      <area shape="poly" coords="290,299,207,359,154,317,208,292,274,284" href="stationlist-area.php?area=FLBay" alt="">
      	      <area shape="poly" coords="279,278,223,290,180,267,163,220,202,217,203,188,269,188,251,240,254,262" href="stationlist-area.php?area=ENP" alt="">
      	      <area shape="poly" coords="273,186,319,186,319,168,275,162" href="stationlist-area.php?area=Pennsuco" alt="">
      	      <area shape="poly" coords="297,7,281,22,284,46,302,63,316,66,326,54,321,25" href="stationlist-area.php?area=WCA1" alt="">
      	      <area shape="poly" coords="279,44,293,64,309,69,310,101,296,113,281,111,276,88,264,71" href="stationlist-area.php?area=WCA2" alt="">
      	      <area shape="poly" coords="206,73,263,74,275,90,280,126,281,150,272,160,271,184,203,184,201,118" href="stationlist-area.php?area=WCA3" alt="">
      	      <area shape="poly" coords="105,87,195,88,201,213,164,216,98,156" href="stationlist-area.php?area=BCNP" alt="">
      	      <area shape="rect" coords="2,105,72,204" href="images/maps/EDEN_website_map-NPSWCAonly_sm.gif" alt="">
      	      <area shape="rect" coords="2,225,72,327" href="images/maps/EDEN_website_map-EDENonly_sm.gif" alt="">
      	    </map>
      	  </td>
        </tr>
        <tr>
          <td>
            <h3 class="caption" style="margin-top:2px"><a href="stationlist-area.php?area=WCA1">WCA1</a> | <a href="stationlist-area.php?area=WCA2">WCA2</a> | <a href="stationlist-area.php?area=WCA3">WCA3</a> | <a href="stationlist-area.php?area=BCNP">Big Cypress National Preserve</a> | <a href="stationlist-area.php?area=ENP">Everglades National Park</a> | <a href="stationlist-area.php?area=Pennsuco">Pennsuco Wetlands</a> | <a href="stationlist-area.php?area=FLBay">Coast of Florida Bay</a> | <a href="stationlist-area.php?area=GOM">Coast of Gulf of Mexico</a></h3>
            <p class="caption" style="text-align:left">(full station list below)</p>
          </td>
        </tr>
      </table>
      <table style="width:413px;float:right">
        <tr>
          <td class="sectionheader">Gages by Name</td>
        </tr>
        <tr>
          <td>
            <p>Access stations quickly by name: <a href="station.php?stn_name=2A300">2A300</a>, <a href="station.php?stn_name=3A-5">3A-5</a>, <a href="station.php?stn_name=3A9">3A9</a>, <a href="station.php?stn_name=BARW4">BARW4</a>, <a href="station.php?stn_name=EDEN_7">EDEN_7</a>, and more. A <a href="#stationlisting">full list is below</a>...</p>
          </td>
        </tr>
        <tr>
          <td class="sectionheader">Search by Bounding Coordinates</td>
        </tr>
        <tr>
          <td style="text-align:left">
            <form action="latlongsearch.php" method="post">
              <div class="rightnavbuttoncurrent">Latitude:<br>
              From: <input type='text' size='10' name="lat_from">
              <br>To: <span style="padding-left:18px"><input type='text' size='10' name="lat_to"></span>
              <p class="desc">Enter a latitude range from 25 to 27 degrees north.</p>
              Longitude:<br>
              From: <input type='text' size='10' name="long_from">
              <br>To: <span style="padding-left:18px"><input type='text' size='10' name="long_to"></span>
              <p class="desc">Enter a longitude range from 80 to 82 degrees west.</p></div>
              <input type="submit">
            </form>
          </td>
        </tr>
        <tr>
          <td class="sectionheader">Download Station Information</td>
        </tr>
        <tr>
          <td>
            <p><a href="data_download.php"><img src="images/db-thumb.gif" alt="screenshot of an excel file" height="57" width="122" style="float:right">Download metadata information about stations</a> including Latitude, Longitude, datum, vegetation, more.... This new feature allows you to <a href="data_download.php">download the data from our database</a> directly into a tab-delineated text format.</p>
          </td>
        </tr>
        <tr>
          <td class="sectionheader">Google Earth (KML) - View EDEN Stations</td>
        </tr>
        <tr>
          <td>
            <p><img src="images/eden_google_maps_thumbnail.jpg" alt="screenshot of a Google Earth showing eden gage locations" height="49" width="72" style="float:right;border:1px solid black">A Google Earth file (.kml) is available for those users who wish to view EDEN&nbsp;gages in Google Earth. <a href="EDEN_gages.kml">Download the EDEN (.kml) file</a>.</p>
          </td>
        </tr>
      </table>
    </div>
    <a id="stationlisting"></a>
<?php
require ('ssi/login.php');
mysql_select_db('eden_new');
echo "<table style='width:450px;margin:20px auto'><tr class='gtablehead'><th>Station Listing</th></tr>\n";
echo "<tr class='gvegtablehead'><td style='text-align:center'>[ ";

// Letter navigation
$letter_query = "select distinct left(station_name, 1) as 'left' from station";
$letter_result = mysql_query($letter_query);
while ($letter_row = mysql_fetch_array($letter_result))
	$used_letters[] = $letter_row['left'];

foreach (array_merge(range('0', '9'), range('A', 'Z')) as $letter) {
	echo in_array($letter, $used_letters) ? "<a href='#$letter'>$letter</a> " : "$letter ";
	if ($letter != 'Z')
		echo '| ';
}
echo "]</td></tr>\n";

// Generate array of gages
$gage_query = 'select station_name_web from station where display = 1';
$gage_result = mysql_query($gage_query);
while ($gage_row = mysql_fetch_array($gage_result))
	$gage[] = $gage_row['station_name_web'];
natcasesort($gage);
$gage = array_reverse($gage);
$one_gage = array_pop($gage);

$row_color = 0;
$letter_range = array_merge(range('0', '9'), range('A', 'Z'));

// Loop for title starting letters
foreach ($letter_range as $letter) {
	$j = 0;
	while (substr($one_gage, 0, 1) == $letter) {
		$query = "select station_name_web from station where display = 1 and station_name_web = '$one_gage'";
		$result = mysql_query($query);
		$row = mysql_fetch_array($result);
		echo "<tr class='gtablecell";
		if ($row_color % 2)
			echo '2';

		echo "'><td>";
		if ($j == 0)
			echo "<a id='$letter'></a>\n";

		echo "<a href='station.php?stn_name={$row['station_name_web']}'>{$row['station_name_web']}";
		if ($row['station_name_web'] == 'MO-214') echo ' (formerly LO1)';
		else if ($row['station_name_web'] == 'MO-215') echo ' (formerly SH1)';
		else if ($row['station_name_web'] == 'MO-216') echo ' (formerly CH1)';
		else if ($row['station_name_web'] == 'Tamiami_Canal_40-Mile_Bend_to_Monroe') echo ' (formerly BCA6)';
		else if ($row['station_name_web'] == 'Tamiami_Canal_Monroe_to_Carnestown') echo ' (formerly BCA7)';
		else if ($row['station_name_web'] == 'C111_wetland_east_of_FIU_LTER_TSPH5') {
			echo "</a></td></tr>\n<tr class='gtablecell";
			if ($row_color % 2 == 0) echo '2';
			echo "'><td><a href='station.php?stn_name=MO-216'>CH1 (now MO-216)";
			$row_color++;
		}
		else if ($row['station_name_web'] == 'L31W') {
			echo "</a></td></tr>\n<tr class='gtablecell";
			if (!$row_color % 2 == 0) echo '2';
			echo "'><td><a href='station.php?stn_name=MO-214'>LO1 (now MO-214)";
			$row_color++;
		}
		else if ($row['station_name_web'] == 'S380_H') {
			echo "</a></td></tr>\n<tr class='gtablecell";
			if (!$row_color % 2 == 0) echo '2';
			echo "'><td><a href='station.php?stn_name=MO-215'>SH1 (now MO-215)";
			$row_color++;
		}
		else if ($row['station_name_web'] == 'BCA5') {
			echo "</a></td></tr>\n<tr class='gtablecell";
			if (!$row_color % 2 == 0) echo '2';
			echo "'><td><a href='station.php?stn_name=Tamiami_Canal_40-Mile_Bend_to_Monroe'>BCA6 (now Tamiami_Canal_40-Mile_Bend_to_Monroe)";
			echo "</a></td></tr>\n<tr class='gtablecell";
			if ($row_color % 2) echo '2';
			echo "'><td><a href='station.php?stn_name=Tamiami_Canal_Monroe_to_Carnestown'>BCA7 (now Tamiami_Canal_Monroe_to_Carnestown)";
		}
		echo "</a></td></tr>\n";
		$row_color++;
		$j++;
		$one_gage = array_pop($gage);
	}
}
	echo "</table>\n";
?>
  </div>
</div><!--End body of page -->
</div><!--End content and nav -->
<div style="width:100%;background-color:#4d7c86">
  <span class="footer">Technical support for this Web site is provided by the <a href="http://www.usgs.gov/" class="footer">U.S. Geological Survey</a><br>This page is:
<?php
$filename = htmlentities($_SERVER['SCRIPT_NAME'], ENT_QUOTES); 
echo "http://sofia.usgs.gov$filename";
?>
  <br>Comments and suggestions? Contact: <a href="https://archive.usgs.gov/archive/sites/sofia.usgs.gov/comments.html" class="footer">Heather Henkel - Webmaster</a><br>Last updated:
<?php echo date ("F d, Y h:i A", getlastmod()); ?> (BJM)</span>
</div>
</body>
</html>
