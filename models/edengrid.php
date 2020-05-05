<?php
$title = "<title>EDEN Grid GIS Files - Everglades Depth Estimation Network (EDEN)</title>\n";
require ($_SERVER['DOCUMENT_ROOT'] . '/eden/ssi/eden-head.php');
?>
<h3>EDEN Grid</h3>
<div style="width:200px;border:1px solid #710a11;background-color:#f4e1b4;float:left;font-size:12px;padding:2px;margin-right:10px">
  <h4 style="margin-top:2px">For More Information:</h4>
  <p>&quot;<a href="https://archive.usgs.gov/archive/sites/sofia.usgs.gov/publications/ofr/2007-1200/">Conceptual design of the <abbr title="Everglades Depth Estimation Network">Everglades Depth Estimation Network (EDEN)</abbr> grid</a>&quot; (<abbr title="United States Geological Survey">USGS</abbr> Open File Report 2007-1200) and &quot;<a href="https://archive.usgs.gov/archive/sites/sofia.usgs.gov/publications/fs/021-03/index.html">Measuring and Mapping the Topography of the Florida Everglades for Ecosystem Restoration</a>&quot;. (<abbr title="United States Geological Survey">USGS</abbr> Fact Sheet 021-03)</p>
</div>
<p>The EDEN domain was broken into equal-sized rectangles (&quot;cells&quot;) that in total are referred to as the &quot;grid&quot;. The Universal Transverse Mercator (UTM) projection, using the North American Datum of 1983 (NAD 83) was selected as the EDEN grid map projection and coordinate system. To match the Airborne Height Finder (AHF) system of sampling spacing, the spatial resolution or the dimensions (in ground distance) of each grid cell is 400 <abbr title="meter">m</abbr> on a side. The <abbr title=" Airborne Height Finder">AHF</abbr> is the helicopter-based high accuracy elevation data (HAED) measuring system that has been used in the past to collect Everglades ground surface elevations.</p>
<p>All EDEN data layers (i.e. <a href="watersurfacemod_download.php">water surface elevation</a>, <a href="groundelevmod.php">ground elevation</a>, and <a href="confidenceindexmaps.php">confidence index</a>) are gridded using the EDEN Grid to allow spatial referencing of datasets and to layer datasets in GIS applications.</p>
<p>The GIS and metadata files have been revised to include the expanded EDEN domain that includes the northwestern portion of <abbr title="Everglades National Park">ENP</abbr> and the southern portion of <abbr title="Big Cyperess National Preserve">BCNP</abbr>.</p>
<table style="width:600px;border:3px solid #4b7e83;margin:10px auto">
  <tr>
    <td><a href="../images/maps/eden_grid_v2.gif"><img src="../images/maps/eden_grid_v2th.gif" alt="Small map showing EDEN grid version 2 location" height="305" width="268"></a></td>
    <td><img src="../images/maps/eden_grid_v2_closeup.gif" alt="Close-up map of EDEN grid version 2" height="285" width="311"><br>
      <span class="caption"><strong>Left:</strong> map showing EDEN grid coverage.<br>
      <strong>Above:</strong> close-up of EDEN grid.</span>
    </td>
  </tr>
  <tr>
    <td colspan="2" style="background-color:#f1fcdd"><span class="caption"><strong>Download EDEN Grid (GIS) Files:</strong></span>
      <ul>
        <li><span class="caption"><a href="../data/gis/EDEN_grid_poly_Jan_10.zip">GIS Shapefile</a> (updated <abbr title="October">Oct.</abbr> 2011, zipped, 2 <abbr title="megabytes">MB</abbr>)</span></li>
        <li><span class="caption"><a href="https://archive.usgs.gov/archive/sites/sofia.usgs.gov/metadata/sflwww/eden_grid_poly.html">EDEN Grid Metadata file</a></span></li>
      </ul>
    </td>
  </tr>
</table>
<?php require ($_SERVER['DOCUMENT_ROOT'] . '/eden/ssi/eden-foot.php'); ?>