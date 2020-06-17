<!DOCTYPE html>
<html lang='en'>
<head>
  <meta charset='utf-8'>
  <?php echo $title; ?>
  <link rel='stylesheet' href='/../eden/css/eden-dbweb-html5.css'>
  <?php if ($link) echo $link; ?>
  <script src='https://www2.usgs.gov/scripts/analytics/usgs-analytics.js'></script>
  <?php if ($script) echo $script; ?>
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
    <?php if ($style) echo $style; ?>
  </style>
</head>
<body>
<div style="width:100%;height:90px;background-image:url('/../eden/images/backgrounds/biscbay-blueabstract-tallbg.jpg');padding:2px">
  <div style='float:left'>
    <a href='http://141.232.10.32/pm/recover/recover.aspx'><img src='/../eden/images/logos/recoverbl.gif' width='94' height='89' alt="The Journey to Restore America's Everglades - Recover Home Page"></a>
  </div>
  <div style='float:right'>
    <a href='http://www.nps.gov/'><img src='/../eden/images/logos/NPSlogosm-grbkgd.gif' alt='National Park Service Home Page' height='48' width='41'></a>
    <a href='http://www.sfwmd.gov/'><img src='/../eden/images/logos/sfwmd-logosm-grnbkgd.gif' alt='South Florida Water Management District Home Page' height='48' width='48'></a>
    <a href='http://www.usace.army.mil/'><img src='/../eden/images/logos/usace-logosm.gif' alt='U.S. Army Corps of Engineers Home Page' width='57' height='44'></a>
    <a href='http://www.usgs.gov'><img src='/../eden/images/logos/usgslogosm-greybkgrd.gif' alt='U.S. Geological Survey Home Page' height='45' width='117'></a>
  </div>
  <div class='pagetopheader'>Everglades Depth Estimation Network (EDEN) for Support of Biological and Ecological Assessments</div>
</div>
<div style='clear:both;background-color:#ebcf8c;height:auto;overflow:hidden'><!--Begin page content and nav -->
<!--Navigation-->
<div style='width:170px;float:right;border:1px solid #bdbdbd'>
<?php
$filename = htmlentities($_SERVER['SCRIPT_NAME'], ENT_QUOTES);
echo "  <div class='" . ($filename == '/../eden/index.php' ? "rightnavbuttoncurrent'>Home" : "rightnavbuttonhome'><a href='/../eden/index.php'>Home</a>") . "</div>
  <div class='rightnavbuttonheader'>Data</div>\n";
if ($filename == '/../eden/stationlist.php')
  echo "  <div class='rightnavbuttoncurrent'>Water Levels (Gage)</div>\n";
elseif (in_array($filename, array('/../eden/stationlist-area.php', '/../eden/station.php')))
  echo "  <div class='rightnavbuttoncurrent'><a href='/../eden/stationlist.php'>Water Levels (Gage)</a></div>\n";
else
   echo " <div class='rightnavbutton'><a href='/../eden/stationlist.php'>Water Levels (Gage)</a></div>\n";
if ($filename == '/../eden/explanation.php')
  echo "  <div class='rightnavbuttoncurrent'>- Explanation of Terms and Methods</div>\n";
elseif ($filename == '/../eden/geprotocol.php')
  echo "  <div class='rightnavbuttoncurrent'>- <a href='/../eden/explanation.php'>Explanation of Terms and Methods</a></div>\n";
elseif (in_array($filename, array('/../eden/stationlist.php', '/../eden/hindcasted.php', '/../eden/data_download.php', '/../eden/latlongsearch.php', '/../eden/stationlist-area.php', '/../eden/station.php')))
  echo "  <div class='rightnavbutton'>- <a href='/../eden/explanation.php'>Explanation of Terms and Methods</a></div>\n";
if ($filename == '/../eden/hindcasted.php')
  echo "  <div class='rightnavbuttoncurrent'>- Hindcasted</div>\n";
elseif (in_array($filename, array('/../eden/stationlist.php', '/../eden/explanation.php', '/../eden/data_download.php', '/../eden/latlongsearch.php', '/../eden/stationlist-area.php', '/../eden/station.php', '/../eden/geprotocol.php')))
  echo "  <div class='rightnavbutton'>- <a href='/../eden/hindcasted.php'>Hindcasted</a></div>\n";
if ($filename == '/../eden/data_download.php')
  echo "  <div class='rightnavbuttoncurrent'>- Download Station <abbr title='Information'>Info</abbr></div>\n";
elseif (in_array($filename, array('/../eden/stationlist.php', '/../eden/explanation.php', '/../eden/hindcasted.php', '/../eden/latlongsearch.php', '/../eden/stationlist-area.php', '/../eden/station.php', '/../eden/geprotocol.php')))
  echo "  <div class='rightnavbutton'>- <a href='/../eden/data_download.php'>Download Station <abbr title='Information'>Info</abbr></a></div>\n";
if ($filename == '/../eden/latlongsearch.php')
  echo "  <div class='rightnavbuttoncurrent'>- Coordinates Search</div>\n";
elseif (in_array($filename, array('/../eden/stationlist.php', '/../eden/explanation.php', '/../eden/hindcasted.php', '/../eden/data_download.php', '/../eden/stationlist-area.php', '/../eden/station.php', '/../eden/geprotocol.php')))
  echo "  <div class='rightnavbutton'>- <a href='/../eden/latlongsearch.php'>Coordinates Search</a></div>\n";
echo "  <div class='" . ($filename == '/../eden/models/watersurfacemod.php' ? "rightnavbuttoncurrent'>Water Surfaces" : "rightnavbutton'><a href='/../eden/models/watersurfacemod.php'>Water Surfaces</a>") . "</div>\n";
if ($filename == '/../eden/models/watersurfacemod_download.php')
  echo "  <div class='rightnavbuttoncurrent'>- Download Surfaces</div>\n";
elseif ($filename == '/../eden/models/release_notes_watersurfaces.php')
  echo "  <div class='rightnavbuttoncurrent'>- <a href='/../eden/models/watersurfacemod_download.php'>Download Surfaces</a></div>\n";
elseif (in_array($filename, array('/../eden/models/watersurfacemod.php', '/../eden/models/wsreleaselog.php', '/../eden/models/real-time.php', '/../eden/models/differencemaps.php', '/../eden/models/confidenceindexmaps.php', '/../eden/models/watersurfacemod-archive.php', '/../eden/models/release_notes_watersurfaces.php')))
  echo "  <div class='rightnavbutton'>- <a href='/../eden/models/watersurfacemod_download.php'>Download Surfaces</a></div>\n";
if ($filename == '/../eden/models/wsreleaselog.php')
  echo "  <div class='rightnavbuttoncurrent'>- Release Log</div>\n";
elseif (in_array($filename, array('/../eden/models/watersurfacemod.php', '/../eden/models/watersurfacemod_download.php', '/../eden/models/real-time.php', '/../eden/models/differencemaps.php', '/../eden/models/confidenceindexmaps.php', '/../eden/models/watersurfacemod-archive.php', '/../eden/models/release_notes_watersurfaces.php')))
  echo "  <div class='rightnavbutton'>- <a href='/../eden/models/wsreleaselog.php'>Release Log</a></div>\n";
if ($filename == '/../eden/models/real-time.php')
  echo "  <div class='rightnavbuttoncurrent'>- Real-Time Surfaces</div>\n";
elseif (in_array($filename, array('/../eden/models/watersurfacemod.php', '/../eden/models/watersurfacemod_download.php', '/../eden/models/wsreleaselog.php', '/../eden/models/differencemaps.php', '/../eden/models/confidenceindexmaps.php', '/../eden/models/watersurfacemod-archive.php', '/../eden/models/release_notes_watersurfaces.php')))
  echo "  <div class='rightnavbutton'>- <a href='/../eden/models/real-time.php'>Real-Time Surfaces</a></div>\n";
if ($filename == '/../eden/models/differencemaps.php')
  echo "  <div class='rightnavbuttoncurrent'>- Difference Maps</div>\n";
elseif (in_array($filename, array('/../eden/models/watersurfacemod.php', '/../eden/models/watersurfacemod_download.php', '/../eden/models/wsreleaselog.php', '/../eden/models/real-time.php', '/../eden/models/confidenceindexmaps.php', '/../eden/models/watersurfacemod-archive.php', '/../eden/models/release_notes_watersurfaces.php')))
  echo "  <div class='rightnavbutton'>- <a href='/../eden/models/differencemaps.php'>Difference Maps</a></div>\n";
if ($filename == '/../eden/models/confidenceindexmaps.php')
  echo "  <div class='rightnavbuttoncurrent'>- Confidence Index Maps</div>\n";
elseif (in_array($filename, array('/../eden/models/watersurfacemod.php', '/../eden/models/watersurfacemod_download.php', '/../eden/models/wsreleaselog.php', '/../eden/models/real-time.php', '/../eden/models/differencemaps.php', '/../eden/models/watersurfacemod-archive.php', '/../eden/models/release_notes_watersurfaces.php')))
  echo "  <div class='rightnavbutton'>- <a href='/../eden/models/confidenceindexmaps.php'>Confidence Index Maps</a></div>\n";
if ($filename == '/../eden/models/watersurfacemod-archive.php')
  echo "  <div class='rightnavbuttoncurrent'>- Archived Files</div>\n";
elseif (in_array($filename, array('/../eden/models/watersurfacemod.php', '/../eden/models/watersurfacemod_download.php', '/../eden/models/wsreleaselog.php', '/../eden/models/real-time.php', '/../eden/models/differencemaps.php', '/../eden/models/confidenceindexmaps.php', '/../eden/models/release_notes_watersurfaces.php')))
  echo "  <div class='rightnavbutton'>- <a href='/../eden/models/watersurfacemod-archive.php'>Archived Files</a></div>\n";
echo "  <div class='" . ($filename == '/../eden/models/water_depth.php' ? "rightnavbuttoncurrent'>Water Depth" : "rightnavbutton'><a href='/../eden/models/water_depth.php'>Water Depth</a>") . "</div>\n";
if ($filename == '/../eden/models/water_depth_data.php')
  echo "  <div class='rightnavbuttoncurrent'>- Water Depth Measure</div>\n";
elseif (in_array($filename, array('/../eden/models/water_depth.php', '/../eden/models/water_depth_archive.php')))
  echo "  <div class='rightnavbutton'>- <a href='/../eden/models/water_depth_data.php'>Water Depth Measure</a></div>\n";
if ($filename == '/../eden/models/water_depth_archive.php')
  echo "  <div class='rightnavbuttoncurrent'>- Water Depth Archive</div>\n";
elseif (in_array($filename, array('/../eden/models/water_depth.php', '/../eden/models/water_depth_data.php')))
  echo "  <div class='rightnavbutton'>- <a href='/../eden/models/water_depth_archive.php'>Water Depth Archive</a></div>\n";
echo "  <div class='" . ($filename == '/../eden/models/groundelevmod.php' ? "rightnavbuttoncurrent'>Ground Elevation (<abbr title='Digital Elevation Model'>DEM</abbr>)" : "rightnavbutton'><a href='/../eden/models/groundelevmod.php'>Ground Elevation (<abbr title='Digital Elevation Model'>DEM</abbr>)</a>") . "</div>\n";
if ($filename == '/../eden/models/groundelevmod-edenapps.php')
  echo "  <div class='rightnavbuttoncurrent'>- EDENapps <abbr title='Digital Elevation Model'>DEM</abbr></div>\n";
elseif (in_array($filename, array('/../eden/models/groundelevmod.php', '/../eden/models/demreleaselog.php', '/../eden/models/groundelevmod-archive.php')))
  echo "  <div class='rightnavbutton'>- <a href='/../eden/models/groundelevmod-edenapps.php'>EDENapps <abbr title='Digital Elevation Model'>DEM</abbr></a></div>\n";
if ($filename == '/../eden/models/demreleaselog.php')
  echo "  <div class='rightnavbuttoncurrent'>- Release Log</div>\n";
elseif (in_array($filename, array('/../eden/models/groundelevmod.php', '/../eden/models/groundelevmod-edenapps.php', '/../eden/models/groundelevmod-archive.php')))
  echo "  <div class='rightnavbutton'>- <a href='/../eden/models/demreleaselog.php'>Release Log</a></div>\n";
if ($filename == '/../eden/models/groundelevmod-archive.php')
  echo "  <div class='rightnavbuttoncurrent'>- Archived Files</div>\n";
elseif (in_array($filename, array('/../eden/models/groundelevmod.php', '/../eden/models/groundelevmod-edenapps.php', '/../eden/models/demreleaselog.php')))
  echo "  <div class='rightnavbutton'>- <a href='/../eden/models/groundelevmod-archive.php'>Archived Files</a></div>\n";
echo "  <div class='" . ($filename == '/../eden/models/edengrid.php' ? "rightnavbuttoncurrent'>EDEN Grid" : "rightnavbutton'><a href='/../eden/models/edengrid.php'>EDEN Grid</a>") . "</div>
  <div class='navbump'></div>
  <div class='" . ($filename == '/../eden/eve/index.php' ? "rightnavbuttoncurrent'>Explore and View EDEN (EVE)" : "rightnavbutton'><a href='/../eden/eve/index.php'>Explore and View EDEN (EVE)</a>") . "</div>
  <div class='" . ($filename == '/../eden/csss/index.php' ? "rightnavbuttoncurrent'>Cape Sable Seaside Sparrow (CSSS) Viewer" : "rightnavbutton'><a href='/../eden/csss/index.php'>Cape Sable Seaside Sparrow (CSSS) Viewer</a>") . "</div>
  <div class='" . ($filename == '/../eden/wadem/index.php' ? "rightnavbuttoncurrent'>WADEM<br>Wading Bird Viewer" : "rightnavbutton'><a href='/../eden/wadem/index.php'>WADEM<br>Wading Bird Viewer</a>") . "</div>
  <div class='" . ($filename == '/../eden/coastal.php' ? "rightnavbuttoncurrent'>Coastal EDEN" : "rightnavbutton'><a href='/../eden/coastal.php'>Coastal EDEN</a>") . "</div>\n";
if ($filename == '/../eden/water_level_percentiles_map.php')
  echo "  <div class='rightnavbuttoncurrent'>Daily Water Level Percentiles by Month</div>\n";
elseif ($filename == '/../eden/water_level_percentiles.php')
  echo "  <div class='rightnavbuttoncurrent'><a href='/../eden/water_level_percentiles_map.php'>Daily Water Level Percentiles by Month</a></div>\n";
else
  echo "  <div class='rightnavbutton'><a href='/../eden/water_level_percentiles_map.php'>Daily Water Level Percentiles by Month</a></div>\n";
if ($filename == '/../eden/water_level_percentiles_about.php')
  echo "  <div class='rightnavbuttoncurrent'>- About Water-level Data</div>\n";
elseif (in_array($filename, array('/../eden/water_level_percentiles_map.php', '/../eden/water_level_percentiles_methods.php', '/../eden/water_level_percentiles_alert.php', '/../eden/water_level_percentiles.php')))
  echo "  <div class='rightnavbutton'>- <a href='/../eden/water_level_percentiles_about.php'>About Water-level Data</a></div>\n";
if ($filename == '/../eden/water_level_percentiles_methods.php')
  echo "  <div class='rightnavbuttoncurrent'>- Methods</div>\n";
elseif (in_array($filename, array('/../eden/water_level_percentiles_map.php', '/../eden/water_level_percentiles_about.php', '/../eden/water_level_percentiles_alert.php', '/../eden/water_level_percentiles.php')))
  echo "  <div class='rightnavbutton'>- <a href='/../eden/water_level_percentiles_methods.php'>Methods</a></div>\n";
if ($filename == '/../eden/water_level_percentiles_alert.php')
  echo "  <div class='rightnavbuttoncurrent'>- Email Alert System</div>\n";
elseif (in_array($filename, array('/../eden/water_level_percentiles_map.php', '/../eden/water_level_percentiles_about.php', '/../eden/water_level_percentiles_methods.php', '/../eden/water_level_percentiles.php')))
  echo "  <div class='rightnavbutton'>- <a href='/../eden/water_level_percentiles_alert.php'>Email Alert System</a></div>\n";
echo "  <div class='navbump'></div>
  <div class='" . ($filename == '/../eden/meteorologic.php' ? "rightnavbuttoncurrent'>Meteorologic" : "rightnavbutton'><a href='/../eden/meteorologic.php'>Meteorologic</a>") . "</div>\n";
if ($filename == '/../eden/nexrad.php')
  echo "  <div class='rightnavbuttoncurrent'>- Rainfall</div>\n";
elseif (in_array($filename, array('/../eden/meteorologic.php', '/../eden/evapotrans.php')))
  echo "  <div class='rightnavbutton'>- <a href='/../eden/nexrad.php'>Rainfall</a></div>\n";
if ($filename == '/../eden/evapotrans.php')
  echo "  <div class='rightnavbuttoncurrent'>- Evapotranspiration</div>\n";
elseif (in_array($filename, array('/../eden/meteorologic.php', '/../eden/nexrad.php')))
  echo "  <div class='rightnavbutton'>- <a href='/../eden/evapotrans.php'>Evapotranspiration</a></div>\n";
if ($filename == '/../eden/benchmarks/index.php')
  echo "  <div class='rightnavbuttoncurrent'>Benchmarks</div>\n";
elseif ($filename == '/../eden/benchmarks/benchmark.php')
  echo "  <div class='rightnavbuttoncurrent'><a href='/../eden/benchmarks/index.php'>Benchmarks</a></div>\n";
else
  echo "  <div class='rightnavbutton'><a href='/../eden/benchmarks'>Benchmarks</a></div>\n";
if ($filename == '/../eden/benchmarks/bm-installation.php')
  echo "  <div class='rightnavbuttoncurrent'>- Installation Details</div>\n";
elseif (in_array($filename, array('/../eden/benchmarks/index.php', '/../eden/benchmarks/benchmark.php')))
  echo "  <div class='rightnavbutton'>- <a href='/../eden/benchmarks/bm-installation.php'>Installation Details</a></div>\n";
echo "  <div class='rightnavbuttonheader'>EDENapps</div>
  <div class='" . ($filename == '/../eden/edenapps/index.php' ? "rightnavbuttoncurrent'>Introduction" : "rightnavbutton'><a href='/../eden/edenapps/index.php'>Introduction</a>") . "</div>
  <div class='" . ($filename == '/../eden/edenapps/dataviewer.php' ? "rightnavbuttoncurrent'>DataViewer" : "rightnavbutton'><a href='/../eden/edenapps/dataviewer.php'>DataViewer</a>") . "</div>
  <div class='" . ($filename == '/../eden/edenapps/xylocator.php' ? "rightnavbuttoncurrent'>xylocator" : "rightnavbutton'><a href='/../eden/edenapps/xylocator.php'>xylocator</a>") . "</div>
  <div class='" . ($filename == '/../eden/edenapps/transectplotter.php' ? "rightnavbuttoncurrent'>TransectPlotter" : "rightnavbutton'><a href='/../eden/edenapps/transectplotter.php'>TransectPlotter</a>") . "</div>
  <div class='" . ($filename == '/../eden/edenapps/depth-dayssincedry.php' ? "rightnavbuttoncurrent'><abbr title='Depth and Days Since Dry'>Depth&amp;DaysSinceDry</abbr>" : "rightnavbutton'><a href='/../eden/edenapps/depth-dayssincedry.php'><abbr title='Depth and Days Since Dry'>Depth&amp;DaysSinceDry</abbr></a>") . "</div>
  <div class='" . ($filename == '/../eden/edenapps/gridtonetcdf.php' ? "rightnavbuttoncurrent'><abbr title='Grid to Net C D F'>GridtoNetCDF</abbr>" : "rightnavbutton'><a href='/../eden/edenapps/gridtonetcdf.php'><abbr title='Grid to Net C D F'>GridtoNetCDF</abbr></a>") . "</div>
  <div class='" . ($filename == '/../eden/edenapps/netcdftogrid.php' ? "rightnavbuttoncurrent'><abbr title='Net C D F to Grid'>NetCDFtoGrid</abbr>" : "rightnavbutton'><a href='/../eden/edenapps/netcdftogrid.php'><abbr title='Net C D F to Grid'>NetCDFtoGrid</abbr></a>") . "</div>
  <div class='rightnavbuttonheader'>Information</div>\n";
if ($filename == '/../eden/abouteden.php')
  echo "<div class='rightnavbuttoncurrent'>Learn About EDEN</div>\n";
elseif (in_array($filename, array('/../eden/annual-rpt/summary-annrpt06.php', '/../eden/annual-rpt/summary-annrpt07.php', '/../eden/annual-rpt/status-annrpt08.php', '/../eden/annual-rpt/status-annrpt09.php', '/../eden/annual-rpt/status-annrpt10.php', '/../eden/annual-rpt/status-annrpt11.php', '/../eden/annual-rpt/status-annrpt12.php', '/../eden/annual-rpt/status-annrpt13.php')))
  echo "  <div class='rightnavbuttoncurrent'><a href='/../eden/abouteden.php'>Learn About EDEN</a></div>\n";
else
  echo "<div class='rightnavbutton'><a href='/../eden/abouteden.php'>Learn About EDEN</a></div>\n";
echo "  <div class='" . ($filename == '/../eden/datause_citation.php' ? "rightnavbuttoncurrent'>Data Use & Citation" : "rightnavbutton'><a href='/../eden/datause_citation.php'>Data Use & Citation</a>") . "</div>
  <div class='" . ($filename == '/../eden/publications.php' ? "rightnavbuttoncurrent'>Publications" : "rightnavbutton'><a href='/../eden/publications.php'>Publications</a>") . "</div>
  <div class='" . ($filename == '/../eden/newsletter.php' ? "rightnavbuttoncurrent'>Newsletter" : "rightnavbutton'><a href='/../eden/newsletter.php'>Newsletter</a>") . "</div>
  <div class='" . ($filename == '/../eden/personnel.php' ? "rightnavbuttoncurrent'>EDEN Personnel" : "rightnavbutton'><a href='/../eden/personnel.php'>EDEN Personnel</a>") . "</div>
  <div class='" . ($filename == '/../eden/contacts.php' ? "rightnavbuttoncurrent'>Contacts" : "rightnavbutton'><a href='/../eden/contacts.php'>Contacts</a>") . "</div>
  <div style='background-color:#477489;height:3px;border:1px solid #bdbdbd'></div>\n";
$imgs = array('gt_bwoodnmangfringethf', 'lox_purpleflowerf', 'lox_trailf', 'nps-fltrailf', 'prairie_landscapef', 'sofia-ecopondbirdsf', 'sofia-ecopondf', 'sofia-enpsunsetf', 'tat-treeislandf', 'waterleveldatagagethf');
$alts = array('Photo of a mangrove fringe', 'Photo of a flower', 'Photo of a trail through the woods', 'Photo of a person walking through trees on a trail', 'Photo of sawgrass with tree islands in the distance', 'Photo of birds', 'Photo of a pond', 'Photo of a sunset', 'Photo of tree islands', 'Photo of a water level gage');
$hgts = array(203, 210, 210, 104, 181, 120, 120, 120, 110, 218);
$rnd = rand(0, count($imgs) - 1);
echo "  <img src='/../eden/images/photos/{$imgs[$rnd]}.jpg' alt='{$alts[$rnd]}' height='{$hgts[$rnd]}' width='160' style='padding-left:5px'>
</div>
<!--end navigation -->
<div style='overflow:hidden;padding-right:8px;background-color:white;min-height:875px'><!--Begin body of page -->\n";
?>