<?php
$title = "<title>Ground Elevation Model - Everglades Depth Estimation Network (EDEN)</title>\n";
require ($_SERVER['DOCUMENT_ROOT'] . '/eden/ssi/eden-head.php');
?>
<h2>Ground Elevation Model</h2>
<div style="width:230px;border:1px solid #710a11;background-color:#f4e1b4;float:left;font-size:12px;padding:2px;margin-right:10px">
  <h4 style="margin-top:2px">For More Information:</h4>
  <ul>
    <li>&quot;<a href="https://archive.usgs.gov/archive/sites/sofia.usgs.gov/publications/papers/regwetdem/">An approach to regional wetland digital elevation model development using a differential global positioning system and a custom-built helicopter-based surveying system</a>&quot; (International Journal of Remote Sensing, Volume 33, Issue 2, <abbr title="pages">p.</abbr> 450-465).</li>
    <li>&quot;<a href="http://www.sciencedirect.com/science/article/pii/S0143622810001189">Landscape unit based digital elevation model development for the freshwater wetlands within the Arthur C. Marshall Loxahatchee National Wildlife Refuge, Southeastern Florida</a>&quot; (Applied Geography Volume 31, Issue 2, <abbr title="pages">p.</abbr> 401-412.)</li>
    <li>&quot;<a href="https://archive.usgs.gov/archive/sites/sofia.usgs.gov/publications/ofr/2007-1034/">Initial Everglades Depth Estimation Network (EDEN) Digital Elevation Model Research and Development</a>&quot; (<abbr title="United States Geological Survey">USGS</abbr> Open File Report 2007-1034)</li>
    <li>&quot;<a href="https://archive.usgs.gov/archive/sites/sofia.usgs.gov/publications/ofr/2007-1200/">Conceptual design of the <abbr title="Everglades Depth Estimation Network">Everglades Depth Estimation Network (EDEN)</abbr> grid</a>&quot; (<abbr title="United States Geological Survey">USGS</abbr> Open File Report 2007-1200).</li>
  </ul>
</div>
<h3 style="text-align:center;color:#550000">New <abbr title="Digital Elevation Model">DEM</abbr> - October 2011<br>(Posted December 2011)</h3>
<p>Ground elevation data for the greater Everglades and the <abbr title="digital ground elevation models">digital ground elevation models (DEM)</abbr> derived from them form the foundation for all EDEN water depth and associated ecological/hydrologic modeling.</p>
<p>This <abbr title="Digital Elevation Model">DEM</abbr> was produced using the <a href="https://archive.usgs.gov/archive/sites/sofia.usgs.gov/exchange/desmond/desmondelev.html">version <abbr title="high accuracy elevation data">HAED</abbr>_v01 of the <abbr title="high accuracy elevation data">HAED</abbr></a>, all available <abbr title="aerial height finder">aerial height finder (AHF)</abbr> data points posted to the <a href="http://sofia.usgs.gov/">SOFIA website</a> as of October 2007. To create a realistic region-wide elevation model for EDEN purposes, the elevation data were segregated by Water Conservation Areas and National Park boundaries so that local trends could be isolated, sub-region specific interpolation models could be developed, and realistic breaks in elevation along sub-region boundaries could be imbedded in a final, region-wide <abbr title="Digital Elevation Model">DEM</abbr>.</p>
<p>The ground elevation, and therefore water depth, in the Everglades can vary by centimeters or tens of centimeters within a few meters of a given location as a result of microtopographic features. In addition, ground surface elevations in the peat soils of the Everglades can drop during droughts due to compaction as the peat dries and can rise again in the wet season with re-hydration. The elevation value for each EDEN 400<abbr title="meter">m</abbr> by 400<abbr title="meter">m</abbr> grid cell is a modeled value influenced by variation in the <abbr title="aerial height finder">AHF</abbr> data surrounding the grid cell. Users are cautioned to use the EDEN data appropriately for site-specific assessments.</p>
<h3>What has changed between the January 2010 and October 2011 Versions?</h3>
<ul>
  <li>For both versions, data for a single grid cell in western WCA3A has been filled</li>
  <li>For centimeter version, the model domain was expanded to include the freshwater portion of northwestern ENP and southern portion of BCNP</li>
</ul>
<table style="width:600px;border:3px solid #4b7e83;margin:10px auto">
  <tr>
    <td colspan="2" style="text-align:center;background-color:#342655"><span class="pagetopheader">Download October 2011<br>EDEN <abbr title="Digital Elevation Model">Digital Elevation Model (DEM)</abbr></span></td>
  </tr>
  <tr>
    <td style="width:40%"><a href="../images/maps/EDEN_oc11_release_graphic_lg.gif"><img src="../images/maps/EDEN_oc11_release_graphic_s.gif" alt="Thumbnail image of EDEN Digital Elevation Model map" height="288" width="191"></a></td>
    <td style="background-color:#f1fcdd">
      <p><strong>Meter Version (<abbr title="North American Vertical Datum of 1988">NAVD88</abbr>):</strong></p>
      <ul>
        <li><a href="../data/dem/eden_em_oc11.zip">Arc .e00</a>
          <ul>
            <li>zipped, with metadata files, 243 <abbr title="kilobytes">KB</abbr></li>
          </ul></li>
        <li><a href="../images/maps/EDEN_oc11_release_graphic_lg.gif">GIF</a> (for web browsing)</li>
        <li><a href="https://archive.usgs.gov/archive/sites/sofia.usgs.gov/metadata/sflwww/eden_em_oc11.html">EDEN <abbr title="Digital Elevation Model">DEM</abbr> Metadata file</a></li>
      </ul>
      <p><strong>Centimeter (EDENapps) Version (<abbr title="North American Vertical Datum of 1988">NAVD88</abbr>):</strong></p>
      <ul>
        <li><a href="../data/dem/eden_dem_cm_oc11.zip">EDENapps <abbr title="Digital Elevation Model">DEM</abbr></a>&nbsp;(for use with EDENapps Tools only) (.zip, 168 <abbr title="kilobytes">KB</abbr>)</li>
        <li><a href="https://archive.usgs.gov/archive/sites/sofia.usgs.gov/metadata/sflwww/eden_em_cm_oc11.html">Metadata</a></li>
      </ul>
    </td>
  </tr>
</table>
<p><strong>Please note:</strong></p>
<ul>
  <li>The <a href="edengrid.php">EDEN grid</a> is used to grid the ground elevation <abbr title="Digital Elevation Model">DEM</abbr> into 400<abbr title="meter">m</abbr> by 400<abbr title="meter">m</abbr> rectangles (&ldquo;cells&rdquo;) and allows for georeferenced layering with other EDEN datasets.</li>
</ul>
<?php require ($_SERVER['DOCUMENT_ROOT'] . '/eden/ssi/eden-foot.php'); ?>