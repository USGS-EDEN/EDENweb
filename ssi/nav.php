<?php
$filename = htmlentities($_SERVER['SCRIPT_NAME'], ENT_QUOTES);
echo "<!--Navigation-->
<div style='width:170px;float:right;border:1px solid #bdbdbd'>
  <div class='" . ($filename == '/eden/index.php' ? "rightnavbuttoncurrent'>Home" : "rightnavbuttonhome'><a href='/eden/index.php'>Home</a>") . "</div>
  <div class='rightnavbuttonheader'>Data</div>
  <div class='" . ($filename == '/eden/stationlist.php' ? "rightnavbuttoncurrent'>Water Levels (Gage)" : "rightnavbutton'><a href='/eden/stationlist.php'>Water Levels (Gage)</a>") . "</div>\n";
if ($filename == '/eden/explanation.php')
  echo "  <div class='rightnavbuttoncurrent'>- Explanation of Terms and Methods</div>\n";
elseif (in_array($filename, array('/eden/stationlist.php', '/eden/hindcasted.php', '/eden/data_download.php', '/eden/latlongsearch.php')))
  echo "  <div class='rightnavbutton'>- <a href='/eden/explanation.php'>Explanation of Terms and Methods</a></div>\n";
if ($filename == '/eden/hindcasted.php')
  echo "  <div class='rightnavbuttoncurrent'>- Hindcasted</div>\n";
elseif (in_array($filename, array('/eden/stationlist.php', '/eden/explanation.php', '/eden/data_download.php', '/eden/latlongsearch.php')))
  echo "  <div class='rightnavbutton'>- <a href='hindcasted.php'>Hindcasted</a></div>\n";
if ($filename == '/eden/data_download.php')
  echo "  <div class='rightnavbuttoncurrent'>- Download Station <abbr title='Information'>Info</abbr></div>\n";
elseif (in_array($filename, array('/eden/stationlist.php', '/eden/explanation.php', '/eden/hindcasted.php', '/eden/latlongsearch.php')))
  echo "  <div class='rightnavbutton'>- <a href='data_download.php'>Download Station <abbr title='Information'>Info</abbr></a></div>\n";
if ($filename == '/eden/latlongsearch.php')
  echo "  <div class='rightnavbuttoncurrent'>- Coordinates Search</div>\n";
elseif (in_array($filename, array('/eden/stationlist.php', '/eden/explanation.php', '/eden/hindcasted.php', '/eden/data_download.php')))
  echo "  <div class='rightnavbutton'>- <a href='latlongsearch.php'>Coordinates Search</a></div>\n";
echo "  <div class='" . ($filename == '/eden/models/watersurfacemod.php' ? "rightnavbuttoncurrent'>Water Surfaces" : "rightnavbutton'><a href='/eden/models/watersurfacemod.php'>Water Surfaces</a>") . "</div>\n";
if ($filename == '/eden/watersurfacemod_download.php')
  echo "  <div class='rightnavbuttoncurrent'>- Download Surfaces</div>\n";
elseif (in_array($filename, array('/eden/models/watersurfacemod.php', '/eden/wsreleaselog.php', '/eden/real-time.php', '/eden/differencemaps.php', '/eden/confidenceindexmaps.php', '/eden/watersurfacemod-archive.php')))
  echo "  <div class='rightnavbutton'>- <a href='watersurfacemod_download.php'>Download Surfaces</a></div>\n";
if ($filename == '/eden/wsreleaselog.php')
  echo "  <div class='rightnavbuttoncurrent'>- Release Log</div>\n";
elseif (in_array($filename, array('/eden/models/watersurfacemod.php', '/eden/watersurfacemod_download.php', '/eden/real-time.php', '/eden/differencemaps.php', '/eden/confidenceindexmaps.php', '/eden/watersurfacemod-archive.php')))
  echo "  <div class='rightnavbutton'>- <a href='wsreleaselog.php'>Release Log</a></div>\n";
if ($filename == '/eden/real-time.php')
  echo "  <div class='rightnavbuttoncurrent'>- Real-Time Surfaces</div>\n";
elseif (in_array($filename, array('/eden/models/watersurfacemod.php', '/eden/watersurfacemod_download.php', '/eden/wsreleaselog.php', '/eden/differencemaps.php', '/eden/confidenceindexmaps.php', '/eden/watersurfacemod-archive.php')))
  echo "  <div class='rightnavbutton'>- <a href='real-time.php'>Real-Time Surfaces</a></div>\n";
if ($filename == '/eden/differencemaps.php')
  echo "  <div class='rightnavbuttoncurrent'>- Difference Maps</div>\n";
elseif (in_array($filename, array('/eden/models/watersurfacemod.php', '/eden/watersurfacemod_download.php', '/eden/wsreleaselog.php', '/eden/real-time.php', '/eden/confidenceindexmaps.php', '/eden/watersurfacemod-archive.php')))
  echo "  <div class='rightnavbutton'>- <a href='differencemaps.php'>Difference Maps</a></div>\n";
if ($filename == '/eden/confidenceindexmaps.php')
  echo "  <div class='rightnavbuttoncurrent'>- Confidence Index Maps</div>\n";
elseif (in_array($filename, array('/eden/models/watersurfacemod.php', '/eden/watersurfacemod_download.php', '/eden/wsreleaselog.php', '/eden/real-time.php', '/eden/differencemaps.php', '/eden/watersurfacemod-archive.php')))
  echo "  <div class='rightnavbutton'>- <a href='confidenceindexmaps.php'>Confidence Index Maps</a></div>\n";
if ($filename == '/eden/watersurfacemod-archive.php')
  echo "  <div class='rightnavbuttoncurrent'>- Archived Files</div>\n";
elseif (in_array($filename, array('/eden/models/watersurfacemod.php', '/eden/watersurfacemod_download.php', '/eden/wsreleaselog.php', '/eden/real-time.php', '/eden/differencemaps.php', '/eden/confidenceindexmaps.php')))
  echo "  <div class='rightnavbutton'>- <a href='watersurfacemod-archive.php'>Archived Files</a></div>\n";
echo "  <div class='" . ($filename == '/eden/models/water_depth.php' ? "rightnavbuttoncurrent'>Water Depth" : "rightnavbutton'><a href='/eden/models/water_depth.php'>Water Depth</a>") . "</div>\n";
if ($filename == '/eden/water_depth_data.php')
  echo "  <div class='rightnavbuttoncurrent'>- Water Depth Measure</div>\n";
elseif (in_array($filename, array('/eden/models/water_depth.php', '/eden/water_depth_archive.php')))
  echo "  <div class='rightnavbutton'>- <a href='/eden/water_depth_data.php'>Water Depth Measure</a></div>\n";
if ($filename == '/eden/water_depth_archive.php')
  echo "  <div class='rightnavbuttoncurrent'>- Water Depth Archive</div>\n";
elseif (in_array($filename, array('/eden/models/water_depth.php', '/eden/water_depth_data.php')))
  echo "  <div class='rightnavbutton'>- <a href='/eden/water_depth_archive.php'>Water Depth Archive</a></div>\n";
echo "  <div class='" . ($filename == '/eden/models/groundelevmod.php' ? "rightnavbuttoncurrent'>Ground Elevation (<abbr title='Digital Elevation Model'>DEM</abbr>)" : "rightnavbutton'><a href='/eden/models/groundelevmod.php'>Ground Elevation (<abbr title='Digital Elevation Model'>DEM</abbr>)</a>") . "</div>\n";
if ($filename == '/eden/groundelevmod-edenapps.php')
  echo "  <div class='rightnavbuttoncurrent'>- EDENapps <abbr title='Digital Elevation Model'>DEM</abbr></div>\n";
elseif (in_array($filename, array('/eden/models/groundelevmod.php', '/eden/demreleaselog.php', '/eden/groundelevmod-archive.php')))
  echo "  <div class='rightnavbutton'>- <a href='/eden/groundelevmod-edenapps.php'>EDENapps <abbr title='Digital Elevation Model'>DEM</abbr></a></div>\n";
if ($filename == '/eden/demreleaselog.php')
  echo "  <div class='rightnavbuttoncurrent'>- Release Log</div>\n";
elseif (in_array($filename, array('/eden/models/groundelevmod.php', '/eden/groundelevmod-edenapps.php', '/eden/groundelevmod-archive.php')))
  echo "  <div class='rightnavbutton'>- <a href='/eden/demreleaselog.php'>Release Log</a></div>\n";
if ($filename == '/eden/groundelevmod-archive.php')
  echo "  <div class='rightnavbuttoncurrent'>- Archived Files</div>\n";
elseif (in_array($filename, array('/eden/models/groundelevmod.php', '/eden/groundelevmod-edenapps.php', '/eden/demreleaselog.php')))
  echo "  <div class='rightnavbutton'>- <a href='/eden/groundelevmod-archive.php'>Archived Files</a></div>\n";
echo "  <div class='" . ($filename == '/eden/models/edengrid.php' ? "rightnavbuttoncurrent'>EDEN Grid" : "rightnavbutton'><a href='/eden/models/edengrid.php'>EDEN Grid</a>") . "</div>
  <div class='navbump'></div>
  <div class='" . ($filename == '/eden/eve/index.php' ? "rightnavbuttoncurrent'>Explore and View EDEN (EVE)" : "rightnavbutton'><a href='/eden/eve/index.php'>Explore and View EDEN (EVE)</a>") . "</div>
  <div class='" . ($filename == '/eden/csss/index.php' ? "rightnavbuttoncurrent'>Cape Sable Seaside Sparrow (CSSS) Viewer" : "rightnavbutton'><a href='/eden/csss/index.php'>Cape Sable Seaside Sparrow (CSSS) Viewer</a>") . "</div>
  <div class='" . ($filename == '/eden/coastal.php' ? "rightnavbuttoncurrent'>Coastal EDEN" : "rightnavbutton'><a href='/eden/coastal.php'>Coastal EDEN</a>") . "</div>
  <div class='" . ($filename == '/eden/water_level_percentiles_map.php' ? "rightnavbuttoncurrent'>Daily Water Level Percentiles by Month" : "rightnavbutton'><a href='/eden/water_level_percentiles_map.php'>Daily Water Level Percentiles by Month</a>") . "</div>\n";
if ($filename == '/eden/water_level_percentiles_about.php')
  echo "  <div class='rightnavbuttoncurrent'>- About Water-level Data</div>\n";
elseif (in_array($filename, array('/eden/water_level_percentiles_map.php', '/eden/water_level_percentiles_methods.php', '/eden/water_level_percentiles_alert.php')))
  echo "  <div class='rightnavbutton'>- <a href='/eden/water_level_percentiles_about.php'>About Water-level Data</a></div>\n";
if ($filename == '/eden/water_level_percentiles_methods.php')
  echo "  <div class='rightnavbuttoncurrent'>- Methods</div>\n";
elseif (in_array($filename, array('/eden/water_level_percentiles_map.php', '/eden/water_level_percentiles_about.php', '/eden/water_level_percentiles_alert.php')))
  echo "  <div class='rightnavbutton'>- <a href='/eden/water_level_percentiles_methods.php'>Methods</a></div>\n";
if ($filename == '/eden/water_level_percentiles_alert.php')
  echo "  <div class='rightnavbuttoncurrent'>- Email Alert System</div>\n";
elseif (in_array($filename, array('/eden/water_level_percentiles_map.php', '/eden/water_level_percentiles_about.php', '/eden/water_level_percentiles_methods.php')))
  echo "  <div class='rightnavbutton'>- <a href='/eden/water_level_percentiles_alert.php'>Email Alert System</a></div>\n";
echo "  <div class='navbump'></div>
  <div class='" . ($filename == '/eden/meteorologic.php' ? "rightnavbuttoncurrent'>Meteorologic" : "rightnavbutton'><a href='/eden/meteorologic.php'>Meteorologic</a>") . "</div>\n";
if ($filename == '/eden/nexrad.php')
  echo "  <div class='rightnavbuttoncurrent'>- Rainfall</div>\n";
elseif (in_array($filename, array('/eden/meteorologic.php', '/eden/evapotrans.php')))
  echo "  <div class='rightnavbutton'>- <a href='/eden/nexrad.php'>Rainfall</a></div>\n";
if ($filename == '/eden/evapotrans.php')
  echo "  <div class='rightnavbuttoncurrent'>- Evapotranspiration</div>\n";
elseif (in_array($filename, array('/eden/meteorologic.php', '/eden/nexrad.php')))
  echo "  <div class='rightnavbutton'>- <a href='/eden/evapotrans.php'>Evapotranspiration</a></div>\n";
echo "  <div class='" . ($filename == '/eden/benchmarks/index.php' ? "rightnavbuttoncurrent'>Benchmarks" : "rightnavbutton'><a href='/eden/benchmarks'>Benchmarks</a>") . "</div>\n";
if ($filename == '/eden/bm-installation.php')
  echo "  <div class='rightnavbuttoncurrent'>- Installation Details</div>\n";
elseif ($filename == '/eden/benchmarks/index.php')
  echo "  <div class='rightnavbutton'>- <a href='/eden/bm-installation.php'>Installation Details</a></div>\n";
echo "  <div class='rightnavbuttonheader'>EDENapps</div>
  <div class='" . ($filename == '/eden/edenapps/index.php' ? "rightnavbuttoncurrent'>Introduction" : "rightnavbutton'><a href='/eden/edenapps/index.php'>Introduction</a>") . "</div>
  <div class='" . ($filename == '/eden/edenapps/dataviewer.php' ? "rightnavbuttoncurrent'>DataViewer" : "rightnavbutton'><a href='/eden/edenapps/dataviewer.php'>DataViewer</a>") . "</div>
  <div class='" . ($filename == '/eden/edenapps/xylocator.php' ? "rightnavbuttoncurrent'>xylocator" : "rightnavbutton'><a href='/eden/edenapps/xylocator.php'>xylocator</a>") . "</div>
  <div class='" . ($filename == '/eden/edenapps/transectplotter.php' ? "rightnavbuttoncurrent'>TransectPlotter" : "rightnavbutton'><a href='/eden/edenapps/transectplotter.php'>TransectPlotter</a>") . "</div>
  <div class='" . ($filename == '/eden/edenapps/depth-dayssincedry.php' ? "rightnavbuttoncurrent'><abbr title='Depth and Days Since Dry'>Depth&amp;DaysSinceDry</abbr>" : "rightnavbutton'><a href='/eden/edenapps/depth-dayssincedry.php'><abbr title='Depth and Days Since Dry'>Depth&amp;DaysSinceDry</abbr></a>") . "</div>
  <div class='" . ($filename == '/eden/edenapps/gridtonetcdf.php' ? "rightnavbuttoncurrent'><abbr title='Grid to Net C D F'>GridtoNetCDF</abbr>" : "rightnavbutton'><a href='/eden/edenapps/gridtonetcdf.php'><abbr title='Grid to Net C D F'>GridtoNetCDF</abbr></a>") . "</div>
  <div class='" . ($filename == '/eden/edenapps/netcdftogrid.php' ? "rightnavbuttoncurrent'><abbr title='Net C D F to Grid'>NetCDFtoGrid</abbr>" : "rightnavbutton'><a href='/eden/edenapps/netcdftogrid.php'><abbr title='Net C D F to Grid'>NetCDFtoGrid</abbr></a>") . "</div>
  <div class='rightnavbuttonheader'>Information</div>
  <div class='" . ($filename == '/eden/abouteden.php' ? "rightnavbuttoncurrent'>Learn About EDEN" : "rightnavbutton'><a href='/eden/abouteden.php'>Learn About EDEN</a>") . "</div>
  <div class='" . ($filename == '/eden/datause_citation.php' ? "rightnavbuttoncurrent'>Data Use & Citation" : "rightnavbutton'><a href='/eden/datause_citation.php'>Data Use & Citation</a>") . "</div>
  <div class='" . ($filename == '/eden/publications.php' ? "rightnavbuttoncurrent'>Publications" : "rightnavbutton'><a href='/eden/publications.php'>Publications</a>") . "</div>
  <div class='" . ($filename == '/eden/newsletter.php' ? "rightnavbuttoncurrent'>Newsletter" : "rightnavbutton'><a href='/eden/newsletter.php'>Newsletter</a>") . "</div>
  <div class='" . ($filename == '/eden/personnel.php' ? "rightnavbuttoncurrent'>EDEN Personnel" : "rightnavbutton'><a href='/eden/personnel.php'>EDEN Personnel</a>") . "</div>
  <div class='" . ($filename == '/eden/contacts.php' ? "rightnavbuttoncurrent'>Contacts" : "rightnavbutton'><a href='/eden/contacts.php'>Contacts</a>") . "</div>
  <div style='background-color:#477489;height:3px;border:1px solid #bdbdbd'></div>\n";
$imgs = array('prairie_landscapef', 'sofia-ecopondbirdsf', 'waterleveldatagagethf', 'lox_purpleflowerfadedf', 'nps-fltrailf', 'sofia-enpsunsetf', 'tat-treeislandf');
$alts = array('Photo of sawgrass with tree islands in the distance', 'Photo of birds', 'Photo of a water level gage', 'Photo of a flower', 'Photo of a person walking through trees on a trail', 'Photo of a sunset', 'Photo of tree islands');
$hgts = array(181, 120, 218, 210, 104, 120, 110);
$rnd = rand(0, count($imgs) - 1);
echo "  <img src='/eden/images/photos/{$imgs[$rnd]}.jpg' alt='{$alts[$rnd]}' height='{$hgts[$rnd]}' width='160' style='padding-left:5px'>
</div>
<!--end navigation -->\n";
?>