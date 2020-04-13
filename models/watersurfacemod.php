<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Water Surfaces - Everglades Depth Estimation Network (EDEN)</title>
  <link rel="stylesheet" href="../css/eden-dbweb-html5.css">
  <script src="http://www.usgs.gov/scripts/analytics/usgs-analytics.js"></script>
  <style>
  	body { background-color: white }
    table { border-collapse: collapse }
    table, td, th { border: 1px solid #477489 }
    td, th { padding: 2px }
  </style>
</head>
<body>
<table style="width:100%;border:0px">
<?php require ('../ssi/eden-head.txt'); ?>
  <tr>
    <td style="vertical-align:top;width:100%;border:0px"><!--Begin body of page -->
      <h2>Water Surfaces</h2>
      <p>In October of 2011, the EDEN project released a new version (Version 2, V2) of the EDEN Water Surface Model. This version replaces the last version (Version 1, V1) of the EDEN model. As part of this upgrade, most (4/1/00-6/30/11) EDEN water surfaces were recreated, new data was processed (1991-1999), and several new map datasets are now available (see below).</p>
      <div style="width:400px;border:2px solid #710a11;background-color:#fffccc;margin:20px auto">
      	<p style="margin:5px 5px">Download the <a href="watersurfacemod_download.php"><strong>new (V2) EDEN Water Surface</strong></a> files or access the files through our <a href="http://sflthredds.er.usgs.gov/"><strong>EDEN THREDDS</strong></a> server.</p>
      </div>
      <ul>
        <li><a href="#watersufacefiles">What are EDEN water-surface files?</a></li>
        <li><a href="#area">What area is covered by the EDEN water-surface model domain and how is it gridded?</a></li>
        <li><a href="#available">What files are available?</a></li>
        <li><a href="#changed">What has changed between V1 and V2?</a></li>
        <li><a href="#differencemaps">Are there maps showing what has changed between V1 and V2?</a></li>
        <li><a href="#versions">What are the differences between real-time, provisional, and final surfaces?</a></li>
        <li><a href="#cimaps">How good is the data for a given day?</a></li>
        <li><a href="#moreinfows">How are water surfaces created?</a></li>
      </ul>
      <h3><a id="watersufacefiles"></a>What are EDEN water surface files?</h3>
      <p>Spatially continuous interpolation of water surface across the greater Everglades is generated for daily median values of the <a href="../stationlist.php">water-level gages for the EDEN network</a> beginning January 1, 1991. Surfaces are recorded as elevation in centimeters relative to <abbr title="North American Vertical Datum of 1988">North American Vertical Datum of 1988 (NAVD 88)</abbr>. <a href="#moreinfows">More information on how water surfaces are created is available</a> below.</p>
      <p>The list of gages used to generate the daily water surface changes over time because gages are discontinued, new gages are constructed, or gages are added or removed from the EDEN network. The daily median output files provide users with the list of gages used for each day's water-level surface.</p>
      <h3><a id="area"></a>What area is covered by the EDEN water-surface model domain and how is it gridded?</h3>
      <p>The EDEN surface-water model domain includes Water Conservation Areas 1, 2, and 3, Pennsuco Wetlands and the freshwater portions of Big Cypress National Preserve (BCNP) and Everglades National Park (ENP). Version 2 (V2) of the model added the northwest corner of ENP and southern portion of BCNP.</p>
      <p>The EDEN domain is gridded into 400 x 400 meter cells that in total are referred to as the &quot;EDEN grid&quot; and which allow for analysis of subsets of the grid and GIS analysis of other data layers over the EDEN domain, such as ground elevation data, rainfall data, and water depth computation. <a href="edengrid.php">Learn more about the <strong>EDEN Grid</strong></a>.</p>
      <h3><a id="available"></a>What files are available?</h3>
      <p>The EDEN project has created a series of new map datasets as part of this V2 release:</p>
      <ul>
        <li><a href="watersurfacemod_download.php">water surface maps</a></li>
        <li><a href="differencemaps.php">difference maps</a> (for surfaces previously created using the V1 model)</li>
      </ul>
      <p>When used in conjunction with our <a href="groundelevmod.php">modeled ground elevation map</a>, derived data (such as depth, days since last dry, etc.) can be calculated.</p>
      <p>Most maps are available as NetCDF (.nc), GeoTiff (.tiff), and jpegs (.jpg).</p>
      <h3><a id="changed"></a>What has changed between V1 and V2?</h3>
      <p>The EDEN surface-water model (V2) will be fully documented in a USGS-series report planned for publication in Spring 2012. A summary of the revisions to the Version 1 (V1) model are listed below:</p>
      <ul>
        <li><strong>Model platform changes</strong> - Python and the ESRI ArcGIS9.3.1 Geoprocessing package replaces Winbatch and ESRI ArcGIS ArcMap 9.1 and creates a more efficient model that is easier to run and update.</li>
        <li><strong>Expansion of the EDEN domain</strong> - The model domain is expanded to include the remainder of Big Cypress National Preserve and Everglades National Park along the southwest coast of Florida.</li>
        <li><strong>Development of subarea models for selected basins</strong> - Subarea models developed for WCA1, WCA2B, WCA3B and Pennsuco Wetlands better represent the hydrology of these basins. These surfaces are then merged to the full-domain model for the final daily water surface.</li>
        <li><strong>Changes to canal files</strong> - The canal files in the V2 full domain model are used the same way as in the V1 model. In the V2 model, several canal files were updated, added, or deleted to better represent the hydraulic conditions near canals.</li>
        <li><strong>Updated water-level gage data</strong> - Water-level gage data for the V2 model is updated by adding, deleting and revising gage data based on new information about the gage network.</li>
      </ul>
      <h3><a id="differencemaps"></a>Are there maps showing what has changed between V1 and V2?</h3>
      <p>In order for EDEN users to more easily see what has changed between V1 and V2 of the model, a series of &quot;Difference Maps&quot; were created. EDEN difference maps show users how the daily water-level surfaces created with the V2 model differ from surfaces created with the V1 model. Some users may find that, for their study area, the newly revised surfaces are not significantly different from the previous surfaces. In this case, downloading all the new surfaces may not be necessary. <a href="differencemaps.php">Learn more and view <strong>EDEN Difference Maps</strong>.</a></p>
      <h3><a id="versions"></a>What are the differences between real-time, provisional, and final surfaces?</h3>
      <p>EDEN daily surfaces are identified by the quality of the input water-level data used to create the surface. Input data is either real-time, provisional, or final:</p>
      <ul>
        <li><strong>Real-time</strong> EDEN water-level surfaces are created daily using real-time water-level data that are relayed by satellite or other telemetry and have received little or no review from the operating agency. A threshold comparison program eliminates daily values that appear erroneous (i.e., extremely high or low, extremely different from the previous day). Subsequent reviews and edits of the data may result in substantial revisions to the data.</li>
        <li><strong>Provisional</strong> EDEN water-level surfaces are created quarterly using water-level data that have received some review and edits by  operating agencies. For some agencies, the review is near final while for others, the review is preliminary. Then, the EDEN team uses ADAM (Automated Data Assurance and Management) software to further quality-assure the data and estimate missing data.<li><strong>Final</strong> EDEN water-level surfaces are created annually using final approved data from the operating agencies. EDEN's ADAM (Automated Data Assurance and Management) software is used to verify the final data and estimate missing data. Occasionally, the EDEN team modifies final data from the operating agency when ADAM indicates significant differences. The &quot;release&quot; notation for final surfaces is used only when the surface has been reprocessed, for example, final data at a gage was updated or the EDEN surface-water model was revised.</li>
      </ul>
      <h3><a id="cimaps"></a>How good is the data for a given day?</h3>
      <p>The confidence index developed by Pearlstine and others (2007) for the V1 model was tested using the V2 model and measured water levels at benchmarks in the Everglades. For the V2 model, none of the parameters are strongly correlated with measured water levels therefore the parameters that define the areas of low confidence are not yet clear. However, over 82 percent of differences at benchmarks are plus or minus 5 centimeters which indicates the ability of the model to estimate the water levels extremely well in most areas of the Everglades.</p>
      <h3><a id="moreinfows"></a>How are water surfaces created?</h3>
      <p>The steps to create the daily water-level surfaces are summarized below:</p>
      <ol>
        <li>Water-level data for all the EDEN gages is retrieved from an <abbr title="file transmission protocol">ftp</abbr> server.</li>
        <li>Water-level data reported in <abbr title=" National Geodetic Vertical Datum">NGVD</abbr> 29 are converted to <abbr title="North American Vertical Datum">NAVD</abbr> 88.<li>Daily median water levels are calculated at each gage and data gaps are estimated for creation of the provisional and final surfaces.</li>
        <li>Linear interpolation is used to create boundary conditions along canals and levees.</li>
        <li>Radial Basis Function multiquadric interpolation of extended data (median water level from gages in marsh and interpolated values along canals) is used to generate continuous water-level surfaces.</li>
        <li>The continuous water surface is predicted on the EDEN grid (400 <abbr title="meters">m</abbr> x 400 <abbr title="meters">m</abbr>).</li>
        <li>Derived data, such as water depth, can be estimated by subtracting the <a href="groundelevmod.php">EDEN ground digital elevation model (<abbr title="Digital Elevation Model">DEM</abbr>)</a> from the predicted water surface.</li>
      </ol>
      <div style="width:100%;text-align:center;margin:25px auto">
        <a href="../images/figures/edenservermod-flowlg.gif"><img src="../images/figures/edenservermod-flow.gif" alt="Flow diagram showing water surface model steps" height="183" width="482"></a>
        <p class="caption">[<a href="../images/figures/edenservermod-flowlg.gif">larger image</a>]</p>
      </div>
      <p>The <abbr title="U.S. Geological Survey">USGS</abbr> retrieves water-level data daily from nearly 300 gaging stations. Most gages record and transmit several water-level values throughout the day, mostly hourly from recorders. A subset of these gages do not have telemetry and are manually read and added to the network when provisional and final data is produced. All transmitted data are entered and stored in the <abbr title="Everglades Depth Estimation Network">EDEN</abbr> database. There are over 240 gages used for water surface interpolation of the freshwater Everglades.</p>
      <p>All gages in the EDEN network are operated and maintained by four separate agencies including <abbr title=" Everglades National Park">Everglades National Park (ENP)</abbr>, <abbr title="South Florida Water Management District">South Florida Water Management District (SFWMD)</abbr>, <abbr title="Big Cypress National Preserve">Big Cypress National Preserve (BCNP)</abbr>, and the <abbr title="U.S. Geological Survey">USGS</abbr>. Data is transferred via a local <abbr title="U.S. Geological Survey">USGS</abbr> <abbr title="file transmission protocol">FTP</abbr> server to the <abbr title="Everglades Depth Estimation Network">EDEN</abbr> database where it is available for surfacing.</p>
      <p>(Graphic from &quot;<a href="http://edis.ifas.ufl.edu/UW278">Spatially Continuous Interpolation of Water Stage and Water Depths Using the Everglades Depth Estimation Network (EDEN)</a>&quot;, University of Florida, <abbr title="Institute of Food and Agricultural Sciences">IFAS</abbr>,CIR1521.)</p>
    </td><!--End body of page -->
    <td style="width:8px;border:0px"></td>
    <td style="vertical-align:top;width:170px;background-color:#ebcf8c;border:0px;padding:0px">
<!-- navigation include-->
<?php require ('../ssi/nav.php');?>
<img src="../images/photos/prairie_landscapef.jpg" alt="Photo of sawgrass with tree islands in the distance" height="181" width="160" style="padding-left:5px">
    </td>
  </tr>
  <tr>
    <td style="background-color:#4d7c86;border:0px" colspan="3">
      <span class="footer">Technical support for this Web site is provided by the <a href="http://www.usgs.gov/" class="footer">U.S. Geological Survey</a><br>This page is:
<?php
$filename = htmlentities($_SERVER['SCRIPT_NAME'], ENT_QUOTES); 
echo "http://sofia.usgs.gov$filename";
?>
      <br>Comments and suggestions? Contact: <a href="https://archive.usgs.gov/archive/sites/sofia.usgs.gov/comments.html" class="footer">Heather Henkel - Webmaster</a><br>Last updated:
<?php echo date ("F d, Y h:i A", getlastmod()); ?> (BJM)</span>
    </td>
  </tr>
</table>
</body>
</html>
