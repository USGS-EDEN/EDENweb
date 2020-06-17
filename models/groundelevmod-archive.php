<?php
$title = "<title>Ground Elevation Model - Everglades Depth Estimation Network (EDEN)</title>\n";
require ($_SERVER['DOCUMENT_ROOT'] . '/../eden/ssi/eden-head.php');
?>
<div style="background-color:#f0edd9">
<h2>Ground Elevation Model &ndash; Archive</h2>
<p style="text-align:center"><strong>Please note: <a href="groundelevmod.php">a newer version of this file is available</a></strong></p>
<h4 style="text-align:center"><a href="#dem">EDEN DEM</a> | <a href="#edenappsdem">EDENapps DEM</a></h4>
<h3><a id="dem"></a>EDEN DEM</h3>
<h4>2010 (January) Version:</h4>
<table style="width:500px;margin:20px auto">
  <tr>
    <td colspan="2" style="background-color:#342655" class="pagetopheader">January 2010 EDEN Digital Elevation Model (DEM)</td>
  </tr>
  <tr style="background-color:white;text-align:center">
    <td><a href="../images/maps/EDEN_ja10_release_user_notice_lg.gif"><img src="../images/maps/EDEN_ja10_release_user_notice_th.gif" alt="" height="274" width="191"></a><br><span class="caption">Map highlighting areas with new digital elevation models [<a href="../images/maps/EDEN_ja10_release_user_notice_lg.gif">larger version</a>]</span></td>
    <td><a href="../images/maps/WCA1_specf_ja10_user_notice.gif"><img src="../images/maps/WCA1_specf_ja10_user_notice_th.gif" alt="" height="288" width="195"></a><br><span class="caption"><abbr title="Water Conservation Area One"><strong>WCA1</strong></abbr>: Map showing location of four new models [<a href="../images/maps/WCA1_specf_ja10_user_notice.gif">larger version</a>]</span></td>
  </tr>
  <tr>
    <td colspan="2" style="background-color:#f1fcdd">
      <p><strong>What has changed? The shaded polygons in the maps above represent the areas of the EDEN study area for which new digital elevation models have been created:</strong></p>
      <ul>
        <li>Water Conservation Area 1: 4 subzone models created; <strong>least confidence should be placed on the southern zones</strong></li>
        <li>Northwest corner of Everglades National Park and a significant portion of Big Cypress National Preserve</li>
      </ul>
    </td>
  </tr>
  <tr>
    <td style="background-color:white;text-align:center"><a href="../images/maps/EDEN_ja10_release_graphic_lg.gif"><img src="../images/maps/EDEN_ja10_release_graphic_s.gif" alt="Thumbnail image of EDEN Digital Elevation Model map" height="288" width="191"></a></td>
    <td style="background-color:#f1fcdd">
      <p><strong>Download EDEN_EM_JA10 Files:</strong></p>
      <ul>
        <li>PDF:
          <ul>
            <li><a href="../images/maps/EDEN_ja10_release_graphic.pdf">473 <abbr title="kilobytes">KB</abbr> (quick view)</a></li>
            <li><a href="../images/maps/EDEN_ja10_release_graphic_p.pdf">861 <abbr title="kilobytes">KB</abbr> (print-quality)</a></li>
          </ul>
        </li>
        <li>Arc .e00:
          <ul>
            <li><a href="/../eden/data/dem/eden_em_ja10.zip">zipped</a>, with metadata files, 243 <abbr title="kilobytes">KB</abbr></li>
          </ul>
        </li>
        <li><a href="https://archive.usgs.gov/archive/sites/sofia.usgs.gov/metadata/sflwww/eden_em_ja10.html">EDEN DEM Metadata file </a>
      </ul>
      <p><strong>NOTE: THIS <abbr title="Digital Elevation Model">DEM</abbr> FILE REPLACES EDEN_EM_OCT07</strong></p>
    </td>
  </tr>
</table>
<h4>2007 (October) Version:</h4>
<p>This <abbr title="Digital Elevation Model">DEM</abbr> was produced using the <a href="https://archive.usgs.gov/archive/sites/sofia.usgs.gov/exchange/desmond/desmondelev.html">version <abbr title="high accuracy elevation data">HAED</abbr>_v01 of the <abbr title="high accuracy elevation data">HAED</abbr></a>, all available <abbr title="aerial height finder">aerial height finder (AHF)</abbr> data points posted to the <a href="https://archive.usgs.gov/archive/sites/sofia.usgs.gov/">SOFIA website</a> as of October 2007. To create a realistic region-wide elevation model for EDEN purposes, the elevation data were segregated by Water Conservation Areas and National Park boundaries so that local trends could be isolated, sub-region specific interpolation models could be developed, and realistic breaks in elevation along sub-region boundaries could be imbedded in a final, region-wide <abbr title="Digital Elevation Model">DEM</abbr>. To-date, the best performing <abbr title="Digital Elevation Model">DEM</abbr>s for all subareas have been produced using the geostatistical approach called &quot;anisotropic ordinary kriging&quot;.</p>
<p>The ground elevation, and therefore water depth, in the Everglades can vary by centimeters or tens of centimeters within a few meters of a given location as a result of microtopographic features. In addition, ground surface elevations in the peat soils of the Everglades can drop during droughts due to compaction as the peat dries and can rise again in the wet season with re-hydration. The elevation value for each EDEN 400<abbr title="meter">m</abbr> by 400<abbr title="meter">m</abbr> grid cell is a modelled value influenced by variation in the AHF data surrounding the grid cell. Users are cautioned to use the EDEN data appropriately for site-specific assessments.</p>
<table style="width:350px;margin:20px auto">
  <tr>
    <th colspan="2" class="pagetopheader" style="background-color:#006699">Archived File: EDEN_EM_OCT07</th>
  </tr>
  <tr>
    <td style="background-color:white"><a href="../images/maps/EDEN_EM_OCT07_map.jpg"><img src="../images/maps/EDEN_EM_OCT07_mapth.jpg" alt="Thumbnail image of EDEN Digital Elevation Model" height="255" width="192"></a></td>
    <td style="background-color:#f1fcdd"><span class="caption"><strong>Download EDEN_EM_OCT07 Files:</strong></span>
      <ul>
        <li><span class="caption"><a href="../data/dem/EDEN_EM_OCT07_v01_72dpi.pdf">PDF</a> (502 <abbr title="kilobytes">KB</abbr>)</span></li>
        <li><span class="caption"><a href="../data/dem/eden_em_oct07.zip">Arc .e00</a> (zipped, with metadata file, 212 <abbr title="kilobytes">KB</abbr>)</span></li>
        <li><span class="caption"><a href="https://archive.usgs.gov/archive/sites/sofia.usgs.gov/metadata/sflwww/eden_em_oct07_400m.html">EDEN DEM Metadata file</a></span></li>
      </ul>
      <p class="caption"><strong>NOTE: THIS <abbr title="Digital Elevation Model">DEM</abbr> FILE REPLACES EDEN_EM_JAN07 and has been replaced by <a href="groundelevmod.php">EDEN_EM_JA10</a></strong></p>
    </td>
  </tr>
</table>
<p><strong>Please note: The grid used to break up the EDEN area into equal-sized rectangles (&quot;cells&quot;) is at a 400<abbr title="meter">m</abbr> by 400<abbr title="meter">m</abbr> resolution. While previous releases of the EDEN <abbr title="Digital Elevation Model">DEM</abbr> were produced at a resolution of 60<abbr title="meter">m</abbr> by 60<abbr title="meter">m</abbr> to facilitate satellite-based research, this <abbr title="Digital Elevation Model">DEM</abbr> was produced at 400<abbr title="meter">m</abbr> by 400<abbr title="meter">m</abbr> resolution and positioned to match the spatial referencing of the EDEN grid. Also note that the EDEN_EM_OCT07 file is at meter resolution, while EDENapps tools are at centimeter resolution and require a different version of the DEM. <a href="groundelevmod-edenapps.php">Download the EDENapps DEM directly</a> or visit any of the<a href="../edenapps/index.php"> EDENapps pages to download this file.</a></strong></p>
<hr>
<h3><a id="edenappsdem"></a>EDENapps DEM Archived Files</h3>
<h4>2010 (January) Version:</h4>
<p>The released January 2010 data was modified in two ways.</p>
<ul>
  <li>First, elevation values have been converted from meters (m) to centimeters (cm)</li>
  <li>Second, data has been removed from the southern Big Cypress National Preserve and northwestern Everglades National Park area so that this DEM boundary matches the boundary or domain of the EDEN surface-water model still in use in EDEN applications software. This is the area noted in yellow in the right-hand map below.</li>
</ul>
<table style="width:580px;margin:20px auto">
  <tr class="pagetopheader" style="text-align:center;background-color:#006699">
    <td colspan="3">EDENapps January 2010<br>Digital Elevation Model (DEM)</td>
  </tr>
  <tr style="text-align:center;background-color:#f8f1bc">
    <th><p>January 2010<br>EDENapps DEM (<abbr title="centimeters">cm</abbr>)</p></th>
    <th><p>January 2010<br>EDEN DEM (<abbr title="meters">m</abbr>)</p></th>
    <th><p>Map Showing Coverage of January 2010<br>EDEN DEMs and EDEN Surface Water Boundary</p></th>
  </tr>
  <tr>
    <td style="text-align:center;background-color:white"><a href="../images/maps/jan10_notch_maps-centimeters.gif"><img src="../images/maps/jan10_notch_maps-centimetersth.gif" alt="" height="210" width="185"></a><br><span class="caption"><strong>EDENapps DEM</strong> coverage (pink area is the current EDEN surface water domain with no DEM)<br>[<a href="../images/maps/jan10_notch_maps-centimeters.gif">larger version</a>]</span></td>
    <td style="text-align:center;background-color:white"><a href="../images/maps/jan10_notch_maps-meters.gif"><img src="../images/maps/jan10_notch_maps-metersth.gif" alt="" height="209" width="184"></a><br><span class="caption"><strong>EDEN DEM</strong> coverage (pink area is the current EDEN surface water domain with no DEM)<br>[<a href="../images/maps/jan10_notch_maps-meters.gif">larger version</a>]</span></td>
    <td style="text-align:center;background-color:white"><a href="../images/maps/jan10_notch_maps-both.gif"><img src="../images/maps/jan10_notch_maps-bothth.gif" alt="" height="210" width="187"></a><br><br><span class="caption"><strong>Both DEMs</strong> with current EDEN surface water boundary<br>[<a href="../images/maps/jan10_notch_maps-both.gif">larger version</a>]</span></td>
  </tr>
  <tr>
    <td colspan="3" style="background-color:#f1fcdd">
      <p>Download:</p>
      <ul>
        <li><a href="../data/dem/eden_em_cm_ja10-notch.zip">EDENapps January 2010 DEM</a> (for use with EDENapps Tools only) (.zip, 168 <abbr title="kilobytes">KB</abbr>)</li>
        <li><a href="https://archive.usgs.gov/archive/sites/sofia.usgs.gov/metadata/sflwww/eden_em_cm_ja10-notch.html">Metadata for January 2010 DEM</a></li>
      </ul>
    </td>
  </tr>
</table>
<h4>2007 (October) Version:</h4>
<p><a href="../data/dem/eden_dem_cm_nov07.zip">EDENapps DEM file for ground elevation</a> (.zip, 170 <abbr title="kilobytes">KB</abbr>)</p>
<ul>
  <li><strong>Please note:</strong> This file is a modification of the EDEN <abbr title="digital elevation model">DEM</abbr> released in October of 2007 (i.e., eden_em_oct07) in which the elevation values have been converted from <abbr title="meters">meters (m)</abbr> to <abbr title="centimeters">centimeters (cm)</abbr> for use by EDEN applications software. This file is intended specifically for use in the EDEN applications software.</li>
  <li><a href="https://archive.usgs.gov/archive/sites/sofia.usgs.gov/metadata/sflwww/eden_dem_cm_nov07_nc.html">Metadata is also available</a> for this <abbr title="digital elevation model">DEM</abbr> and has been included in the EDEN <abbr title="digital elevation model">DEM</abbr> zip file.</li>
</ul>
<p>For more information, see &quot;<a href="https://archive.usgs.gov/archive/sites/sofia.usgs.gov/publications/ofr/2007-1034/">Initial Everglades Depth Estimation Network (EDEN) Digital Elevation Model Research and Development</a>&quot; (USGS Open File Report 2007-1034) and the <a href="demreleaselog.php">ground elevation model release log</a>, or contact <a href="https://archive.usgs.gov/archive/sites/sofia.usgs.gov/personnel.php-per=51.html">John Jones</a>.</p>
</div>
<?php require ($_SERVER['DOCUMENT_ROOT'] . '/../eden/ssi/eden-foot.php'); ?>