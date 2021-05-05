<?php
$title = "<title>Download Water Surfaces Data - 1990-1999 - Everglades Depth Estimation Network (EDEN)</title>\n";
require ($_SERVER['DOCUMENT_ROOT'] . '/../eden/ssi/eden-head.php');
?>
<h2>Water Level Surfaces - 1990-1999 (Updated May 2012)</h2>
<img src="../images/maps/watersurfacesV2sm-historical.jpg" alt="sample graphic of a version2 water surface map" height="216" width="153" style="float:right">
<p style="color:#780000"><strong>CAUTION TO USERS - See <a href="#caution">discussion below</a> about the quality of the hindcasted gage data used to generate these surfaces</strong></p>
<p>In May 2012, <span style="color:#780000">PROVISIONAL (Release 2)</span> daily water-level surfaces for the period 1/1/1991 through 12/31/1999 were generated using the newly revised (2011) EDEN V2 surface-water model. About 50% of the EDEN network of gages was operational back to 1991, therefore significant hindcast of datasets, gapfilling of missing measured data, and quality assurance of water-level data was required prior to input to the model. Record dry conditions throughout the Everglades were measured in 1990. As with any modeling effort, empirical or deterministic, the reliability of the model is dependent on the quality of the data and range of measured conditions used for model development. Model performance is typically evaluated against measured conditions when the models are interpolating within the ranged of measured conditions. It is more difficult to evaluate how models will extrapolate to conditions beyond the range of the measured data. Small variations in how the hindcast models extrapolated to extreme conditions can cause errors in the water-surface gradients between stations. The extreme range that the hindcast models needed to extrapolate substantially  reduced the confidence in hindcasted data therefore water-level surfaces are not provided for users prior to 1/1/91.</p>
<p>A summary of the input data includes:</p>
<ul>
  <li>Data for all gages was compiled from multiple sources.</li>
  <li>Data gaps were filled using one of the several estimation methods.</li>
  <li>Data for structure gages (G300_T, G339_H, and G339_T) were not hindcasted prior to their initial data of operation.</li>
  <li>Data for marsh gages were hindcasted back to 1/1/91 even when the gage was not constructed at that time.</li>
  <li>Only outliers from the measured data were removed.</li>
</ul>
<table style="width:450px;text-align:center;margin:10px auto">
  <tr>
    <th colspan="2" style="background-color:#d5ea90">
      <p>EDEN Gages (1990-1999) Data Status</p>
    </th>
  </tr>
  <tr>
    <td>
      <p>The <a href="../images/maps/hindcast_gages_v2.gif">map to the right</a> shows the location and data status for 1990-1999 EDEN water-level surfaces. [<a href="../images/maps/hindcast_gages_v2.gif">larger version</a>]</p>
      <p>A <a href="EDEN_1990s_hindcast_period_v2.xls">spreadsheet lists all gages in the EDEN network used in the surface-water model</a> (.xls file, 71 <abbr title="kilobytes">KB</abbr>), period of measured data, and whether they were hindcasted back to 1990 (based on type of gage, i.e. structure gage). A <a href="EDEN_1990s_hindcast_period_v2.txt">tab-delimited text file</a> is also availble for this data set.</p>
    </td>
    <td><a href="../images/maps/hindcast_gages_v2.gif"><img src="../images/maps/hindcast_gagesth_v2.gif" alt="Map showing location and period of record for hindcasted gages" height="342" width="216"></a></td>
  </tr>
</table>
<p><a id="caution"></a>Users are cautioned about the quality of the water-level surfaces for several subareas and in the vicinity of several gages prior to using the data:</p>
<ul>
  <li>During 1991, portions of the model domain are still within extreme low water level conditions which limits the confidence of hindcasted datasets.</li>
  <li><strong>WCA2B:</strong> For the period 1/1/1991 - 4/27/1993, no data is available for the northern boundary structures (S144_T, S145_T, S146_T), therefore the water-level surfaces in WCA3B are not considered valid in the northern portion of the subarea.</li>
  <li><strong>BCA18: </strong>Measured data for this gage is higher than surrounding gages and therefore estimated data is generally high and at times, significantly higher than nearby gages.</li>
  <li><strong>3ANE and 3ANW</strong> have measured data in 1991 and portions of 1992 that appear to be lower and higher, respectively, than nearby gages. The EDEN team is unsure if these differences are the result of operating practices at the time or the results of systematic data collection error.</li>
  <li><strong>Pennsuco Wetlands:</strong> The surface of this subarea is modeled only when data for 5 or more gages is available.)</li>
</ul>
<?php require ($_SERVER['DOCUMENT_ROOT'] . '/../eden/ssi/eden-foot.php'); ?>