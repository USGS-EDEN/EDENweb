<?php
$title = "<title>EDENapps Introduction - Everglades Depth Estimation Network (EDEN)</title>\n";
require ($_SERVER['DOCUMENT_ROOT'] . '/../eden/ssi/eden-head.php');
?>
<h3>EDENapps Introduction</h3>
<p>EDENapps is a series of independent EDEN tools that assist users in using the EDEN spatial data layers.  These tools interface with the <a href="../models/watersurfacemod.php">EDEN water surfaces</a> and <a href="../models/groundelevmod-edenapps.php">EDENapps DEM</a>. <strong>Please note that these tools were developed initally developed for 32-bit systems</strong>; however, most tools do have a 64-bit version available.</p>
<table style="width:90%;border:3px solid #4b7e83;margin:10px auto">
  <tr class="gtablehead">
    <th>Tool</th>
    <th>Purpose</th>
    <th>Screenshot</th>
  </tr>
  <tr class="gtablecell">
    <td><a href="dataviewer.php"><strong>DataViewer</strong></a></td>
    <td>Displays EDEN data layers including panning, zooming, and animation of multiple dates of water surface, depth, and days since dry; queries of data values, and generation of time-series graphs.</td>
    <td><a href="dataviewer.php"><img src="../images/screenshots/eden-dataviewv2-screentiny.jpg" alt="screenshot of the EDEN Data Viewer" height="94" width="144"></a></td>
  </tr>
  <tr class="gtablecell2">
    <td><a href="xylocator.php"><strong><abbr title="x y">xy</abbr>Locator</strong></a></td>
    <td>Returns values from EDEN data layers at specific x,y coordinates over a specified time period. Users can input a file with a list of sample site locations.</td>
    <td><a href="xylocator.php"><img src="../images/screenshots/xy-screenshottiny.gif" alt="Screenshot of the x y Locator" height="144" width="188"></a></td>
  </tr>
  <tr class="gtablecell">
    <td><a href="transectplotter.php"><strong>TransectPlotter</strong></a></td>
    <td>Select a point-to-point transect (not necessarily a straight line) and plots EDEN data profile over the time series, includes animation, plotting of observer data, and ground slope.</td>
    <td><a href="transectplotter.php"><img src="../images/screenshots/transect-screenshottiny.gif" alt="Screenshot of the EDEN TransectPlotter" height="70" width="144"></a></td>
  </tr>
  <tr class="gtablecell2">
    <td><abbr title="Depth and Days Since Dry"><a href="depth-dayssincedry.php"><b>Depth&amp;DaysSinceDry</b></a></abbr></td>
    <td><p>EDEN <abbr title="Depth and Days Since Dry">Depth&amp;DaysSinceDry</abbr> is a program for creating daily surfaces (in <abbr title="net C D F">NetCDF</abbr> file format, .nc) of water depth and days since dry from EDEN daily water level surfaces and ground elevation model.</p></td>
    <td><a href="depth-dayssincedry.php"><img src="../images/screenshots/depth_dsd-screenth.gif" alt="EDEN Depth and Days Since Dry Tool Screenshot" height="144" width="111"></a></td>
  </tr>
  <tr class="tablecell">
    <td colspan="3" style="background-color:#f8dcbc">
      <strong>Download <a href="../models/groundelevmod-edenapps.php">EDEN DEM file for ground elevation</a></strong> for use in the tools above<b>.</b>  Please note: This file is intended specifically for use in the EDEN applications software as elevation values have been converted from <abbr title="meters">meters (m)</abbr> to <abbr title="centimeters">centimeters (cm)</abbr> for use by EDEN applications software.</td>
  </tr>
  <tr class="gtablecell">
    <td><abbr title="Net C D F to Grid"><a href="netcdftogrid.php"><strong>NetCDFtoGrid</strong></a></abbr></td>
    <td><p>EDEN <abbr title="Net C D F to Grid">NetCDFtoGrid</abbr> is a program for converting EDEN water level, water depth, and days since dry files from EDEN <abbr title="Net C D F">NetCDF</abbr> files to ESRI Grid files.</p></td>
    <td><a href="netcdftogrid.php"><img src="../images/screenshots/netcdftogridscreenth.jpg" alt="Screenshot of the net c d f to grid tool" height="116" width="144"></a></td>
  </tr>
  <tr class="gtablecell2">
    <td><a href="gridtonetcdf.php"><abbr title="Grid to Net C D F"><strong>GridtoNetCDF</strong></abbr></a></td>
    <td><p>The EDEN <abbr title="Grid to Net C D F">GridtoNetCDF</abbr> is no longer available. Please contact Heather Henkel (<a href="mailto:hhenkel@usgs.gov">hhenkel@usgs.gov</a>) with questions regarding this tool.</p></td>
    <td></td>
  </tr>
</table>
<?php require ($_SERVER['DOCUMENT_ROOT'] . '/../eden/ssi/eden-foot.php'); ?>