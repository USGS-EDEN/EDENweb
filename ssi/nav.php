<?php
$filename = htmlentities($_SERVER['SCRIPT_NAME'], ENT_QUOTES);
echo "<!--Navigation-->
      <table style='width:170px;border:0px'>
        <tr>
          <td class='" . ($filename == '/eden/index.php' ? "rightnavbuttoncurrent'>Home" : "rightnavbuttonhome'><a href='/eden/index.php'>Home</a>") . "</td>
        </tr>
        <tr>
          <td class='rightnavbuttonheader'>Data</td>
        </tr>
        <tr>
          <td class='" . ($filename == '/eden/stationlist.php' ? "rightnavbuttoncurrent'>Water Levels (Gage)" : "rightnavbutton'><a href='/eden/stationlist.php'>Water Levels (Gage)</a>") . "</td>
        </tr>\n";
if ($filename == '/eden/explanations.php')
  echo "        <tr>
          <td class='rightnavbuttoncurrent'>- Explanation of Terms and Methods</td>
        </tr>\n";
elseif (in_array($filename, array('/eden/stationlist.php', '/eden/hindcasted.php', '/eden/data_download.php', '/eden/latlongsearch.php')))
  echo "        <tr>
          <td class='rightnavbutton'>- <a href='/eden/explanation.php'>Explanation of Terms and Methods</a></td>
        </tr>\n";
if ($filename == '/eden/hindcasted.php')
  echo "        <tr>
          <td class='rightnavbuttoncurrent'>- Hindcasted</td>
        </tr>\n";
elseif (in_array($filename, array('/eden/stationlist.php', '/eden/explanations.php', '/eden/data_download.php', '/eden/latlongsearch.php')))
  echo "        <tr>
          <td class='rightnavbutton'>- <a href='hindcasted.php'>Hindcasted</a></td>
        </tr>\n";
if ($filename == '/eden/data_download.php')
  echo "        <tr>
          <td class='rightnavbuttoncurrent'>- Download Station <abbr title='Information'>Info</abbr></td>
        </tr>\n";
elseif (in_array($filename, array('/eden/stationlist.php', '/eden/explanations.php', '/eden/hindcasted.php', '/eden/latlongsearch.php')))
  echo "        <tr>
          <td class='rightnavbutton'>- <a href='data_download.php'>Download Station <abbr title='Information'>Info</abbr></a></td>
        </tr>\n";
if ($filename == '/eden/latlongsearch.php')
  echo "        <tr>
          <td class='rightnavbuttoncurrent'>- Coordinates Search</td>
        </tr>\n";
elseif (in_array($filename, array('/eden/stationlist.php', '/eden/explanations.php', '/eden/hindcasted.php', '/eden/data_download.php')))
  echo "        <tr>
          <td class='rightnavbutton'>- <a href='latlongsearch.php'>Coordinates Search</a></td>
        </tr>\n";
echo "        <tr>
          <td class='" . ($filename == '/eden/models/watersurfacemod.php' ? "rightnavbuttoncurrent'>Water Surfaces" : "rightnavbutton'><a href='/eden/models/watersurfacemod.php'>Water Surfaces</a>") . "</td>
        </tr>\n";
if ($filename == '/eden/watersurfacemod_download.php')
  echo "        <tr>
          <td class='rightnavbuttoncurrent'>- Download Surfaces</td>
        </tr>\n";
elseif (in_array($filename, array('/eden/models/watersurfacemod.php', '/eden/wsreleaselog.php', '/eden/real-time.php', '/eden/differencemaps.php', '/eden/confidenceindexmaps.php', '/eden/watersurfacemod-archive.php')))
  echo "        <tr>
          <td class='rightnavbutton'>- <a href='watersurfacemod_download.php'>Download Surfaces</a></td>
        </tr>\n";
if ($filename == '/eden/wsreleaselog.php')
  echo "        <tr>
          <td class='rightnavbuttoncurrent'>- Release Log</td>
        </tr>\n";
elseif (in_array($filename, array('/eden/models/watersurfacemod.php', '/eden/watersurfacemod_download.php', '/eden/real-time.php', '/eden/differencemaps.php', '/eden/confidenceindexmaps.php', '/eden/watersurfacemod-archive.php')))
  echo "        <tr>
          <td class='rightnavbutton'>- <a href='wsreleaselog.php'>Release Log</a></td>
        </tr>\n";
if ($filename == '/eden/real-time.php')
  echo "        <tr>
          <td class='rightnavbuttoncurrent'>- Real-Time Surfaces</td>
        </tr>\n";
elseif (in_array($filename, array('/eden/models/watersurfacemod.php', '/eden/watersurfacemod_download.php', '/eden/wsreleaselog.php', '/eden/differencemaps.php', '/eden/confidenceindexmaps.php', '/eden/watersurfacemod-archive.php')))
  echo "        <tr>
          <td class='rightnavbutton'>- <a href='real-time.php'>Real-Time Surfaces</a></td>
        </tr>\n";
if ($filename == '/eden/differencemaps.php')
  echo "        <tr>
          <td class='rightnavbuttoncurrent'>- Difference Maps</td>
        </tr>\n";
elseif (in_array($filename, array('/eden/models/watersurfacemod.php', '/eden/watersurfacemod_download.php', '/eden/wsreleaselog.php', '/eden/real-time.php', '/eden/confidenceindexmaps.php', '/eden/watersurfacemod-archive.php')))
  echo "        <tr>
          <td class='rightnavbutton'>- <a href='differencemaps.php'>Difference Maps</a></td>
        </tr>\n";
if ($filename == '/eden/confidenceindexmaps.php')
  echo "        <tr>
          <td class='rightnavbuttoncurrent'>- Confidence Index Maps</td>
        </tr>\n";
elseif (in_array($filename, array('/eden/models/watersurfacemod.php', '/eden/watersurfacemod_download.php', '/eden/wsreleaselog.php', '/eden/real-time.php', '/eden/differencemaps.php', '/eden/watersurfacemod-archive.php')))
  echo "        <tr>
          <td class='rightnavbutton'>- <a href='confidenceindexmaps.php'>Confidence Index Maps</a></td>
        </tr>\n";
if ($filename == '/eden/watersurfacemod-archive.php')
  echo "        <tr>
          <td class='rightnavbuttoncurrent'>- Archived Files</td>
        </tr>\n";
elseif (in_array($filename, array('/eden/models/watersurfacemod.php', '/eden/watersurfacemod_download.php', '/eden/wsreleaselog.php', '/eden/real-time.php', '/eden/differencemaps.php', '/eden/confidenceindexmaps.php')))
  echo "        <tr>
          <td class='rightnavbutton'>- <a href='watersurfacemod-archive.php'>Archived Files</a></td>
        </tr>\n";
echo "        <tr>
          <td class='" . ($filename == '/eden/models/water_depth.php' ? "rightnavbuttoncurrent'>Water Depth" : "rightnavbutton'><a href='/eden/models/water_depth.php'>Water Depth</a>") . "</td>
        </tr>\n";
if ($filename == '/eden/water_depth_data.php')
  echo "        <tr>
          <td class='rightnavbuttoncurrent'>- Water Depth Measure</td>
        </tr>\n";
elseif (in_array($filename, array('/eden/models/water_depth.php', '/eden/water_depth_archive.php')))
  echo "        <tr>
          <td class='rightnavbutton'>- <a href='/eden/water_depth_data.php'>Water Depth Measure</a></td>
        </tr>\n";
if ($filename == '/eden/water_depth_archive.php')
  echo "        <tr>
          <td class='rightnavbuttoncurrent'>- Water Depth Archive</td>
        </tr>\n";
elseif (in_array($filename, array('/eden/models/water_depth.php', '/eden/water_depth_data.php')))
  echo "        <tr>
          <td class='rightnavbutton'>- <a href='/eden/water_depth_archive.php'>Water Depth Archive</a></td>
        </tr>\n";
echo "        <tr>
          <td class='" . ($filename == '/eden/models/groundelevmod.php' ? "rightnavbuttoncurrent'>Ground Elevation (<abbr title='Digital Elevation Model'>DEM</abbr>)" : "rightnavbutton'><a href='/eden/models/groundelevmod.php'>Ground Elevation (<abbr title='Digital Elevation Model'>DEM</abbr>)</a>") . "</td>
        </tr>\n";
if ($filename == '/eden/groundelevmod-edenapps.php')
  echo "        <tr>
          <td class='rightnavbuttoncurrent'>- EDENapps <abbr title='Digital Elevation Model'>DEM</abbr></td>
        </tr>\n";
elseif (in_array($filename, array('/eden/models/groundelevmod.php', '/eden/demreleaselog.php', '/eden/groundelevmod-archive.php')))
  echo "        <tr>
          <td class='rightnavbutton'>- <a href='/eden/groundelevmod-edenapps.php'>EDENapps <abbr title='Digital Elevation Model'>DEM</abbr></a></td>
        </tr>\n";
if ($filename == '/eden/demreleaselog.php')
  echo "        <tr>
          <td class='rightnavbuttoncurrent'>- Release Log</td>
        </tr>\n";
elseif (in_array($filename, array('/eden/models/groundelevmod.php', '/eden/groundelevmod-edenapps.php', '/eden/groundelevmod-archive.php')))
  echo "        <tr>
          <td class='rightnavbutton'>- <a href='/eden/demreleaselog.php'>Release Log</a></td>
        </tr>\n";
if ($filename == '/eden/groundelevmod-archive.php')
  echo "        <tr>
          <td class='rightnavbuttoncurrent'>- Archived Files</td>
        </tr>\n";
elseif (in_array($filename, array('/eden/models/groundelevmod.php', '/eden/groundelevmod-edenapps.php', '/eden/demreleaselog.php')))
  echo "        <tr>
          <td class='rightnavbutton'>- <a href='/eden/groundelevmod-archive.php'>Archived Files</a></td>
        </tr>\n";
echo "        <tr>
          <td class='" . ($filename == '/eden/models/edengrid.php' ? "rightnavbuttoncurrent'>EDEN Grid" : "rightnavbutton'><a href='/eden/models/edengrid.php'>EDEN Grid</a>") . "</td>
        </tr>
        <tr>
          <td class='navbump'></td>
        </tr>
        <tr>
          <td class='" . ($filename == '/eden/eve/index.php' ? "rightnavbuttoncurrent'>Explore and View EDEN (EVE)" : "rightnavbutton'><a href='/eden/eve/index.php'>Explore and View EDEN (EVE)</a>") . "</td>
        </tr>
        <tr>
          <td class='" . ($filename == '/eden/csss/index.php' ? "rightnavbuttoncurrent'>Cape Sable Seaside Sparrow (CSSS) Viewer" : "rightnavbutton'><a href='/eden/csss/index.php'>Cape Sable Seaside Sparrow (CSSS) Viewer</a>") . "</td>
        </tr>
        <tr>
          <td class='" . ($filename == '/eden/coastal.php' ? "rightnavbuttoncurrent'>Coastal EDEN" : "rightnavbutton'><a href='/eden/coastal.php'>Coastal EDEN</a>") . "</td>
        </tr>
        <tr>
          <td class='" . ($filename == '/eden/water_level_percentiles_map.php' ? "rightnavbuttoncurrent'>Daily Water Level Percentiles by Month" : "rightnavbutton'><a href='/eden/water_level_percentiles_map.php'>Daily Water Level Percentiles by Month</a>") . "</td>
        </tr>\n";
if ($filename == '/eden/water_level_percentiles_about.php')
  echo "        <tr>
          <td class='rightnavbuttoncurrent'>- About Water-level Data</td>
        </tr>\n";
elseif (in_array($filename, array('/eden/water_level_percentiles_map.php', '/eden/water_level_percentiles_methods.php', '/eden/water_level_percentiles_alert.php')))
  echo "        <tr>
          <td class='rightnavbutton'>- <a href='/eden/water_level_percentiles_about.php'>About Water-level Data</a></td>
        </tr>\n";
if ($filename == '/eden/water_level_percentiles_methods.php')
  echo "        <tr>
          <td class='rightnavbuttoncurrent'>- Methods</td>
        </tr>\n";
elseif (in_array($filename, array('/eden/water_level_percentiles_map.php', '/eden/water_level_percentiles_about.php', '/eden/water_level_percentiles_alert.php')))
  echo "        <tr>
          <td class='rightnavbutton'>- <a href='/eden/water_level_percentiles_methods.php'>Methods</a></td>
        </tr>\n";
if ($filename == '/eden/water_level_percentiles_alert.php')
  echo "        <tr>
          <td class='rightnavbuttoncurrent'>- Email Alert System</td>
        </tr>\n";
elseif (in_array($filename, array('/eden/water_level_percentiles_map.php', '/eden/water_level_percentiles_about.php', '/eden/water_level_percentiles_methods.php')))
  echo "        <tr>
          <td class='rightnavbutton'>- <a href='/eden/water_level_percentiles_alert.php'>Email Alert System</a></td>
        </tr>\n";
echo "        <tr>
          <td class='navbump'></td>
        </tr>
        <tr>
          <td class='" . ($filename == '/eden/meteorologic.php' ? "rightnavbuttoncurrent'>Meteorologic" : "rightnavbutton'><a href='/eden/meteorologic.php'>Meteorologic</a>") . "</td>
        </tr>\n";
if ($filename == '/eden/nexrad.php')
  echo "        <tr>
          <td class='rightnavbuttoncurrent'>- Rainfall</td>
        </tr>\n";
elseif (in_array($filename, array('/eden/meteorologic.php', '/eden/evapotrans.php')))
  echo "        <tr>
          <td class='rightnavbutton'>- <a href='/eden/nexrad.php'>Rainfall</a></td>
        </tr>\n";
if ($filename == '/eden/evapotrans.php')
  echo "        <tr>
          <td class='rightnavbuttoncurrent'>- Evapotranspiration</td>
        </tr>\n";
elseif (in_array($filename, array('/eden/meteorologic.php', '/eden/nexrad.php')))
  echo "        <tr>
          <td class='rightnavbutton'>- <a href='/eden/evapotrans.php'>Evapotranspiration</a></td>
        </tr>\n";
echo "        <tr>
          <td class='" . ($filename == '/eden/benchmarks.php' ? "rightnavbuttoncurrent'>Benchmarks" : "rightnavbutton'><a href='/eden/benchmarks.php'>Benchmarks</a>") . "</td>
        </tr>\n";
if ($filename == '/eden/bm-installation.php')
  echo "        <tr>
          <td class='rightnavbuttoncurrent'>- Installation Details</td>
        </tr>\n";
elseif ($filename == '/eden/benchmarks.php')
  echo "        <tr>
          <td class='rightnavbutton'>- <a href='/eden/bm-installation.php'>Installation Details</a></td>
        </tr>\n";
echo "        <tr>
          <td class='rightnavbuttonheader'>EDENapps</td>
        </tr>
        <tr>
          <td class='" . ($filename == '/eden/edenapps/index.php' ? "rightnavbuttoncurrent'>Introduction" : "rightnavbutton'><a href='/eden/edenapps/index.php'>Introduction</a>") . "</td>
        </tr>
        <tr>
          <td class='" . ($filename == '/eden/edenapps/dataviewer.php' ? "rightnavbuttoncurrent'>DataViewer" : "rightnavbutton'><a href='/eden/edenapps/dataviewer.php'>DataViewer</a>") . "</td>
        </tr>
        <tr>
          <td class='" . ($filename == '/eden/edenapps/xylocator.php' ? "rightnavbuttoncurrent'>xylocator" : "rightnavbutton'><a href='/eden/edenapps/xylocator.php'>xylocator</a>") . "</td>
        </tr>
        <tr>
          <td class='" . ($filename == '/eden/edenapps/transectplotter.php' ? "rightnavbuttoncurrent'>TransectPlotter" : "rightnavbutton'><a href='/eden/edenapps/transectplotter.php'>TransectPlotter</a>") . "</td>
        </tr>
        <tr>
          <td class='" . ($filename == '/eden/edenapps/depth-dayssincedry.php' ? "rightnavbuttoncurrent'><abbr title='Depth and Days Since Dry'>Depth&amp;DaysSinceDry</abbr>" : "rightnavbutton'><a href='/eden/edenapps/depth-dayssincedry.php'><abbr title='Depth and Days Since Dry'>Depth&amp;DaysSinceDry</abbr></a>") . "</td>
        </tr>
        <tr>
          <td class='" . ($filename == '/eden/edenapps/gridtonetcdf.php' ? "rightnavbuttoncurrent'><abbr title='Grid to Net C D F'>GridtoNetCDF</abbr>" : "rightnavbutton'><a href='/eden/edenapps/gridtonetcdf.php'><abbr title='Grid to Net C D F'>GridtoNetCDF</abbr></a>") . "</td>
        </tr>
        <tr>
          <td class='" . ($filename == '/eden/edenapps/netcdftogrid.php' ? "rightnavbuttoncurrent'><abbr title='Net C D F to Grid'>NetCDFtoGrid</abbr>" : "rightnavbutton'><a href='/eden/edenapps/netcdftogrid.php'><abbr title='Net C D F to Grid'>NetCDFtoGrid</abbr></a>") . "</td>
        </tr>
        <tr>
          <td class='rightnavbuttonheader navhtd'>Information</td>
        </tr>
        <tr>
          <td class='" . ($filename == '/eden/abouteden.php' ? "rightnavbuttoncurrent'>Learn About EDEN" : "rightnavbutton'><a href='/eden/abouteden.php'>Learn About EDEN</a>") . "</td>
        </tr>
        <tr>
          <td class='" . ($filename == '/eden/datause_citation.php' ? "rightnavbuttoncurrent'>Data Use & Citation" : "rightnavbutton'><a href='/eden/datause_citation.php'>Data Use & Citation</a>") . "</td>
        </tr>
        <tr>
          <td class='" . ($filename == '/eden/publications.php' ? "rightnavbuttoncurrent'>Publications" : "rightnavbutton'><a href='/eden/publications.php'>Publications</a>") . "</td>
        </tr>
        <tr>
          <td class='" . ($filename == '/eden/newsletter.php' ? "rightnavbuttoncurrent'>Newsletter" : "rightnavbutton'><a href='/eden/newsletter.php'>Newsletter</a>") . "</td>
        </tr>
        <tr>
          <td class='" . ($filename == '/eden/personnel.php' ? "rightnavbuttoncurrent'>EDEN Personnel" : "rightnavbutton'><a href='/eden/personnel.php'>EDEN Personnel</a>") . "</td>
        </tr>
        <tr>
          <td class='" . ($filename == '/eden/contacts.php' ? "rightnavbuttoncurrent'>Contacts" : "rightnavbutton'><a href='/eden/contacts.php'>Contacts</a>") . "</td>
        </tr>
        <tr>
          <td style='background-color:#477489;height:3px;border:1px solid #bdbdbd'></td>
        </tr>
      </table>
<!--end navigation -->\n";