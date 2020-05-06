<?php
$title = "<title>Confidence Index Maps - Everglades Depth Estimation Network (EDEN)</title>\n";
require ($_SERVER['DOCUMENT_ROOT'] . '/eden/ssi/eden-head.php');
?>
<h2>Confidence Index Maps</h2>
<p>(updated July 10, 2012)</p>
<table style="width:224px;float:right">
  <tr>
    <td><a href="../images/maps/confidenceindexmap.gif"><img src="../images/maps/confidenceindexmapth.gif" alt="Map showing confience index" height="305" width="216"></a></td>
  </tr>
  <tr>
    <td class="caption" style="background-color:#e5f4cc">
      <p>Confidence index computed by Pearlstine then binned into low (<abbr title="confidence index">CI</abbr> &lt; or = 0.39), medium (<abbr title="confidence index">CI</abbr> &gt; 0.39 and &lt; or = 0.69), and high (<abbr title="confidence index">CI</abbr> &gt; 0.69) (from Pearlstine, 2007). [<a href="../images/maps/confidenceindexmap.gif">larger image</a>]</p>
    </td>
  </tr>
</table>
<p>In 2007, Pearlstine and others (2007) developed a <abbr title="confidence index ">confidence index (CI)</abbr> for the <abbr title="version 1">V1</abbr> surface-water model to give a general indication of confidence in the accuracy of the EDEN-modeled water levels. The <abbr title="confidence index">CI</abbr> for a grid cell is the geometric mean of three parameters weighted by level of significance:</p>
<ol>
  <li>distance from the nearest marsh water-level gage,</li>
  <li>distance from canals or boundaries, and</li>
  <li>model <abbr title="cross-validation error">cross-validation error (CVE)</abbr> of the nearest water-surface model gage.</li>
</ol>
<p>This index was tested using the newest version (<abbr title="version 2">V2</abbr>) of the EDEN surface-water model and water-level measurements at a network of 72 <a href="../benchmarks/index.php">benchmarks</a>. Differences for 300 measurements were computed between the measured water levels at these benchmarks and the modeled water levels using the <abbr title="version 2">V2</abbr> model. The absolute values of these differences were plotted against the gage distance parameter, canal distance parameter, <abbr title="cross-validation error">CVE</abbr> parameter and the <abbr title="confidence index">CI</abbr> to test the correlations.</p>
<table style="width:440px;margin:20px auto">
  <tr>
    <td><a href="../images/maps/confidenceindexgraphs.gif"><img src="../images/maps/confidenceindexgraphsth.gif" alt="Graphs showing gage distance parameter, canal distance parameter, model cross-validation error parameter, and confidence index" height="278" width="430"></a></td>
  </tr>
  <tr>
    <td class="caption" style="background-color:#e5f4cc">
      <p>Plots of gage distance parameter, canal distance parameter, model cross-validation error parameter, and confidence index by Pearlstine et al. versus the absolute differences between the modeled water level using the EDEN water-surface model and the measured water levels at the benchmarks between 2007 and 2011. [<a href="../images/maps/confidenceindexgraphs.gif">larger image</a>]</p>
    </td>
  </tr>
</table>
<p>Plots of the gage distance parameter, canal distance parameter, and <abbr title="cross-validation error">CVE</abbr> parameter show that none of these parameters are strongly correlated with the water-level differences at the benchmarks. Likewise, the differences do not correlate with the <abbr title="confidence index">CI</abbr>.</p>
<table style="width:310px;margin:20px auto">
  <tr>
    <td><a href="../images/maps/freq_vs_waterleveldiff.gif"><img src="../images/maps/freq_vs_waterleveldiffth.gif" alt="Graph showing plot of water-level distance versus frequenc" height="216" width="296"></a></td>
  </tr>
  <tr>
    <td class="caption" style="background-color:#e5f4cc">
      <p>Plots of water-level distance versus frequency. [<a href="../images/maps/freq_vs_waterleveldiff.gif">larger image</a>]</p>
    </td>
  </tr>
</table>
<p>Over 82 percent of differences at the benchmarks are plus or minus 5 centimeters, which indicates the ability of the model to estimate the daily water-level surface extremely well in most areas of the Everglades.</p>
<p>Although a <abbr title="confidence index">CI</abbr> map would provide users with a general guideline about the accuracy of water levels modeled by EDEN, the parameters that define the areas with lower confidence are not yet clear. See the USGS-series report documenting the EDEN <abbr title="version 2">V2</abbr> surface-water model due later this year for more details about the accuracy of the EDEN water-level surfaces.</p>
<hr>
<p>Pearlstine, L., Higer, A., Palaseanu, M., Fujisaki, I., and Mazzotti, F., 2007, Spatially continuous interpolation of water stage and water depths using the Everglades Depth Estimation Network (EDEN): Gainesville, FL. Institute of Food and Agriculture, University of Florida, <abbr title="circular">CIR</abbr> 1521, 18 <abbr title="pages">p.</abbr>, 2 apps.</p>
<?php require ($_SERVER['DOCUMENT_ROOT'] . '/eden/ssi/eden-foot.php'); ?>