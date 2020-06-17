<?php
$title = "<title>Rainfall Data - Everglades Depth Estimation Network (EDEN)</title>\n";
require ($_SERVER['DOCUMENT_ROOT'] . '/../eden/ssi/eden-head.php');
?>
<h3>Rainfall Data</h3>
<div class="tablecell" style="width:200px;background-color:#f4e1b4;border:1px solid #663340;float:left;margin:5px;padding:5px">
  <h4>For More Information on NEXRAD data:</h4>
  <p>See Appendix 2-1 (page 57) of the <a href="http://my.sfwmd.gov/portal/page/portal/pg_grp_sfwmd_sfer/portlet_sfer/tab2236041/volume1/appendices/v1_app_2-1.pdf" target="_blank">2008 South Florida Environmental Report Volume I</a></p>
</div>
<div style="width:400px;background-color:#fff8ca;border:2px solid #663340;margin:20px auto;text-align:center">
  <p><a href="eve/index.php?rainfall=rainfall">Download Rainfall Data</a></p>
</div>
<p>Rainfall data based on Next Generation Radar (NEXRAD) data from the U.S. National Weather Service provides complete spatial coverage of rainfall amounts for the State of Florida. The accuracy of NEXRAD data is enhanced when adjusted using the local rain-gage data (Huebner and others, 2003; Skinner, 2006; Skinner and others, 2008). The NEXRAD coverage for the South Florida Water Management District (SFWMD) area includes rainfall amounts for 15-minute intervals for the period January 1, 2002 to present for 2 km by 2 km grid resolution. (Please note that EDEN data is on a 400 m by 400 m grid.)</p>
<p>The precision for the gage-adjusted radar is considered to be the same as standard rain-gage precision which is typically reported to the nearest 1/100th of an inch. Because the radar is adjusted to agree with the rain gage, the precision for the rain gage used is the governing precision at 1/100th inch (written communication, 2008, Baxter Vieux). Daily gage-adjusted rainfall values were computed for the South Florida Water Management District by OneRain, Inc (<a href="https://www.onerain.com/" target="_blank">https://www.onerain.com/</a>) from January 2002 to October 2007. Starting November 1, 2007, these data are provided by Vieux, Inc (<a href="http://www.vieuxinc.com/solutions/rainvieux/" target="_blank">http://www.vieuxinc.com/solutions/rainvieux/</a>).</p>
<p>Within approximately 45 days after the end of each month, quality-assured rainfall data for the EDEN model domain for that month are received from the SFWMD. Daily rainfall data (in inches) for EDEN gage locations are compiled from the gridded data and loaded into the EDEN database for access through Explore and View EDEN (EVE).</p>
<p>For more information about the rainfall data from the SFWMD, go to Appendix 2-1 of the 2008 South Florida Environmental Report Volume I (<a href="http://my.sfwmd.gov/portal/page/portal/pg_grp_sfwmd_sfer/portlet_sfer/tab2236041/volume1/appendices/v1_app_2-1.pdf" target="_blank">http://my.sfwmd.gov/portal/page/portal/pg_grp_sfwmd_sfer/ portlet_sfer/tab2236041/volume1/appendices/v1_app_2-1.pdf</a>). The SFWMD contacts (2013) for rainfall are Qinglong (Gary) Wu (<a href="mailto:qwu@sfwmd.gov">qwu@sfwmd.gov</a>) and Sarah Noorjahan (<a href="mailto:snoorjah@sfwmd.gov">snoorjah@sfwmd.gov</a>).</p>
<h4>References:</h4>
<ul>
  <li>Huebner, R.S., Pathak, C.S., and Hoblit, B.C., 2003, Development and Use of a NEXRAD Database for Water Management in South Florida. <abbr title="American Society of Civil Engineers">ASCE</abbr> World Water &amp; Environmental Resources Congress. June 23-26, 2003. Philadelphia, Pennsylvania.</li>
  <li>Skinner, C., 2006, Developing a Relationship Between NEXRAD Generated Rainfall Values and Rain Gauges in South Florida. Master's Thesis. Department of Civil Engineering. Florida Atlantic University, Boca Raton, Florida.</li>
  <li>Skinner, C., Bloetscher, F., and Pathak, C.S., 2009, Comparison of NEXRAD and Rain Gauge Precipitation Measurements in South Florida. Journal of Hydrologic Engineering, 14(3):248-260.</li>
</ul>
<?php require ($_SERVER['DOCUMENT_ROOT'] . '/../eden/ssi/eden-foot.php'); ?>