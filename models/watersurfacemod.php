<?php
$title = "<title>Water Surfaces - Everglades Depth Estimation Network (EDEN)</title>\n";
require ($_SERVER['DOCUMENT_ROOT'] . '/../eden/ssi/eden-head.php');
?>
<h2>Water Surfaces</h2>
<p>In September of 2020, the EDEN project published a new version (<a href="https://doi.org/10.3133/sir20205083">Version 3, V3</a>) of the EDEN Water Surface Model. This version replaces the last version (<a href="http://dx.doi.org/10.3133/sir20145209">Version 2, V2</a>) of the EDEN model.</p>
<div style="width:400px;border:2px solid #710a11;background-color:#fffccc;margin:20px auto">
	<p style="margin:5px 5px">Download the <a href="watersurfacemod_download.php"><strong>new (V3) EDEN Water Surface</strong></a> files or access the files through our <a href="http://sflthredds.er.usgs.gov/"><strong>EDEN THREDDS</strong></a> server.</p>
</div>
<ul>
  <li><a href="#watersufacefiles">What are EDEN water-surface files?</a></li>
  <li><a href="#area">What area is covered by the EDEN water-surface model domain and how is it gridded?</a></li>
  <li><a href="#available">What files are available?</a></li>
  <li><a href="#changed">What has changed between V2 and V3?</a></li>
  <li><a href="#versions">What are the differences between real-time, provisional, and final surfaces?</a></li>
  <li><a href="#cimaps">How good is the data for a given day?</a></li>
  <li><a href="#moreinfows">How are water surfaces created?</a></li>
</ul>
<h3><a id="watersufacefiles"></a>What are EDEN water surface files?</h3>
<p>Spatially continuous interpolations of water surfaces across the Greater Everglades are generated from daily median values of the <a href="../stationlist.php">water-level gages in the EDEN network</a> beginning January 1, 1991. Surfaces are recorded as elevation in centimeters relative to <abbr title="North American Vertical Datum of 1988">North American Vertical Datum of 1988 (NAVD 88)</abbr>. <a href="#moreinfows">More information on how water surfaces are created is available</a> below.</p>
<p>The list of gages used to generate the daily water surface changes over time because gages are discontinued, new gages are constructed, or gages are added or removed from the EDEN network. The <a href="https://sofia.usgs.gov/eden/models/watersurfacemod_download.php#dmsoutput">daily median output files</a> provide users with the list of gages used for each day's water-level surface.</p>
<h3><a id="area"></a>What area is covered by the EDEN water-surface model domain and how is it gridded?</h3>
<p>The EDEN surface-water model domain includes Water Conservation Areas 1, 2, and 3, the Pennsuco Wetlands, and the freshwater portions of Big Cypress National Preserve (BCNP) and Everglades National Park (ENP). Version 2 (V2) of the model added the northwest corner of ENP and southern portion of BCNP. Version 3 (V3) of the model retains the same footprint as V2.</p>
<p>The EDEN domain is gridded into 400 x 400 meter cells that in total are referred to as the &quot;EDEN grid&quot; and which allow for analysis of subsets of the grid and GIS analysis of other data layers over the EDEN domain, such as ground elevation data, rainfall data, and water depth computation. <a href="edengrid.php">Learn more about the <strong>EDEN Grid</strong></a>.</p>
<h3><a id="available"></a>What files are available?</h3>
<p>Water stage and depth surfaces are available as NetCDFs (.nc), GeoTiffs (.tiff), and jpegs (.jpg). Surface input data are available via our Daily Median Files.</p>
<h3><a id="changed"></a>What has changed between V2 and V3?</h3>
<p>The EDEN surface-water model (V3) is fully documented in a <a href="https://doi.org/10.3133/sir20205083">USGS-series report</a> published in September 2020. A summary of the revisions to the Version 2 (V2) model are listed below:</p>
<ul>
  <li><strong>Model platform changes</strong> - Python and the ESRI ArcGIS9.3.1 Geoprocessing package have been replaced by an R model package and set of workflow scripts. This creates a more efficient model that is easier to run, maintain, and update. <a href="https://code.usgs.gov/water/eden">These model scripts are available here.</a></li>
  <li><strong>Expansion of subarea models for selected basins</strong> - Subarea models developed for WCA1, WCA2A, WCA2B, WCA3A, WCA3B, L-67 Canal, and Pennsuco Wetlands better represent the hydrology of these basins. These surfaces are then merged together with the ENP and BCNP subdomain to create the full-domain model for the final daily water surface.</li>
  <li><strong>Changes to canal modeling process</strong> - The canal files in the V1 and V2 models were used to interpolate hundreds of "pseudocanal" values to stitch together model subdomains. In the V3 model, the use of multiple subdomain models renders the "pseudocanal" process unnecessary (with the exception of five points) because measured canal values naturally create realistic boundary conditions. These model subdomains are stiched together to form the full EDEN domain.</li>
</ul>
<h3><a id="versions"></a>What are the differences between real-time, provisional, and final surfaces?</h3>
<p>EDEN daily surfaces are identified by the quality of the input water-level data used to create the surface. Input data is either real-time, provisional, or final:</p>
<ul>
  <li><strong>Real-time</strong> EDEN water-level surfaces are created daily using real-time water-level data that are relayed by satellite or other telemetry and have received little or no review from the operating agency. Every morning, the <a href="https://doi.org/10.3133/sir20165094">Automated Data Assurance and Management (ADAM)</a> program is used for quick and accurate quality-assurance review of the real-time data for the EDEN network and to allow estimation or replacement of missing or erroneous data. Subsequent reviews and edits of the data may result in substantial revisions to the data.</li>
  <li><strong>Provisional</strong> EDEN water-level surfaces are created quarterly using water-level data that have received some review and edits by  operating agencies. For some agencies, the review is near final while for others, the review is preliminary. Then, the EDEN team uses <a href="https://doi.org/10.3133/ofr20161116">ADAM</a> software to further quality-assure the data and estimate missing data.</li>
  <li><strong>Final</strong> EDEN water-level surfaces are created annually using final approved data from the operating agencies. EDEN's ADAM software is used to verify the final data and estimate missing data. Occasionally, the EDEN team modifies final data from the operating agency when ADAM indicates significant differences. The &quot;release&quot; notation for final surfaces (e.g., "2018_q3_v3r1", meaning "2018, quarter 3, version 3, release 1") is updated only when the surface has been reprocessed, for example, final data at a gage was updated or the EDEN surface-water model was revised (e.g., to "2018_q3_v3r2", meaning "2018, quarter 3, version 3, release 2").</li>
</ul>
<h3><a id="cimaps"></a>How good is the data for a given day?</h3>
<p>Water level surfaces from the V3 model were compared to an independently collected set of over 200 field data measurements at 69 elevation benchmark locations. The root mean square error (RMSE) of the difference between the interpolated and measured values was less than 5 centimeters,  which indicates the ability of the model to estimate water levels extremely well in most areas of the Everglades. However, because there are fewer gages located in BCNP and in the western coastal areas of ENP, users should be more cautious when working with surfaces in these areas. A more detailed validation can be found in the <a href="https://doi.org/10.3133/sir20205083">V3 report</a>.</p>
<h3><a id="moreinfows"></a>How are water surfaces created?</h3>
<p>The <abbr title="U.S. Geological Survey">USGS</abbr> retrieves water-level data daily from nearly 300 gaging stations. Most gages record and transmit several water-level values throughout the day, mostly hourly from recorders. A subset of these gages do not have telemetry and are manually read and added to the network when provisional and final data is produced. All transmitted data are entered and stored in the <abbr title="Everglades Depth Estimation Network">EDEN</abbr> database. There are over 240 gages used for water surface interpolation of the freshwater Everglades.</p>
<p>All gages in the EDEN network are operated and maintained by four separate agencies including <abbr title=" Everglades National Park">Everglades National Park (ENP)</abbr>, <abbr title="South Florida Water Management District">South Florida Water Management District (SFWMD)</abbr>, <abbr title="Big Cypress National Preserve">Big Cypress National Preserve (BCNP)</abbr>, and the <abbr title="U.S. Geological Survey">USGS</abbr>. Data is transferred via a local <abbr title="U.S. Geological Survey">USGS</abbr> <abbr title="file transmission protocol">FTP</abbr> server to the <abbr title="Everglades Depth Estimation Network">EDEN</abbr> database where it is available for surfacing.</p>
<p>The steps to create the daily water-level surfaces are summarized below and shown in Figure 1:</p>
<ol>
  <li>Water-level data for <abbr title="Everglades National Park">ENP</abbr> and <abbr title="South Florida Water Management District">SFWMD</abbr> EDEN gages are retrieved from an <abbr title="file transmission protocol">FTP</abbr> server; data for USGS gages are retrieved from the <a href="https://nwis.waterservices.usgs.gov/">National Water Information System</a>.</li>
  <li>Water-level data reported in <abbr title=" National Geodetic Vertical Datum">NGVD</abbr> 29 are converted to <abbr title="North American Vertical Datum">NAVD</abbr> 88.</li>
  <li>Daily median water levels are calculated at each gage and data gaps are estimated for creation of the surfaces.</li>
  <li>Radial Basis Function multiquadric interpolation of gage data is used in each subdomain to generate continuous water-level surfaces.</li>
  <li>The continuous water surface is predicted on the EDEN grid (400 <abbr title="meters">m</abbr> x 400 <abbr title="meters">m</abbr>).</li>
  <li>Water depth is calculated by subtracting the <a href="groundelevmod.php">EDEN ground digital elevation model (<abbr title="Digital Elevation Model">DEM</abbr>)</a> from the predicted water surface. Water depth data is reported for above ground values only (i.e., "negative" water depth values are set to zero).</li>
</ol>
<div style="width:100%;text-align:center;margin:25px auto">
  <a href="../images/figures/edenservermod-flowlg-new.png"><img src="../images/figures/edenservermod-flowlg-new.png" alt="Flow diagram showing water surface model steps" height="290" width="800"></a>
</div>
<p class="caption">Figure 1: Water level data from <abbr title="US Geological Survey">USGS</abbr>, <abbr title="National Park Service">NPS</abbr>, and <abbr title="South Florida Water Management District">SFWMD</abbr> are collated into the EDEN Database (EDENdb), daily median values are entered into Radial Basis Functions (RBF) to generate modeled water level surfaces; when combined with the EDEN Digital Elevation Model (DEM), modeled water depth surfaces are produced.</p>
<?php require ($_SERVER['DOCUMENT_ROOT'] . '/../eden/ssi/eden-foot.php'); ?>