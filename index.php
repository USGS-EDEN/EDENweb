<?php
$email = isset($_POST['email']) ? htmlentities(trim($_POST['email']), ENT_QUOTES) : 0;
if ($email) {
  $file = fopen('edennews_list.txt', 'a');
  fwrite($file, "$email\n");
  fclose($file);
  $msg = "<h1>$email added to EDEN mailing list</h1>\n";
}
$title = "<title>Everglades Depth Estimation Network (EDEN)</title>\n";
$script = "<script>
setTimeout(function(){var a=document.createElement('script');
var b=document.getElementsByTagName('script')[0];
a.src=document.location.protocol+'//script.crazyegg.com/pages/scripts/0020/3757.js?'+Math.floor(new Date().getTime()/3600000);
a.async=true;a.type='text/javascript';b.parentNode.insertBefore(a,b)}, 1);
  </script>\n";
require ($_SERVER['DOCUMENT_ROOT'] . '/../eden/ssi/eden-head.php');
if (isset($msg)) echo $msg;
?>
<div style="text-align:center">
  <img src="images/logos/EDEN-logoth.gif" alt="" height="111" width="288">
  <p style="color:#009999;font-weight:bold;font-style:italic;">Providing real-time hydrologic tools for biological and ecological assessments for adaptive management</p>
</div>
<table style="width:220px;float:left">
  <tr>
    <th class="gtablehead">What's New @ EDEN</th>
  </tr>
  <tr>
    <td class="tablecell" style="background-color:#ffffcc">
      <ul>
        <li><a href="wadingbirds/index.php"><strong>Wading Bird Depth Viewer</strong></a></li>
        <li><a href="models/watersurfacemod_download.php"><strong><abbr title="water year 2018">WY2018</abbr> Final</strong> Water Surfaces</a></li>
        <li><a href="models/watersurfacemod_download.php"><strong>2020 <abbr title="third quarter">Q3</abbr> Provisional</strong> Water Surfaces</a></li>
        <li><a href="models/watersurfacemod_download.php"><strong>2020 <abbr title="second quarter">Q2</abbr> Provisional</strong> Water Surfaces</a></li>
        <li><a href="models/watersurfacemod_download.php"><strong>2020 <abbr title="first quarter">Q1</abbr> Provisional</strong> Water Surfaces</a></li>
        <li><a href="models/watersurfacemod_download.php"><strong>2019 <abbr title="fourth quarter">Q4</abbr> Provisional</strong> Water Surfaces</a></li>
        <li><a href="models/watersurfacemod_download.php"><strong>2019 <abbr title="third quarter">Q3</abbr> Provisional</strong> Water Surfaces</a></li>
        <li><a href="models/watersurfacemod_download.php"><strong>2019 <abbr title="second quarter">Q2</abbr> Provisional</strong> Water Surfaces</a></li>
      </ul>
    </td>
  </tr>
  <tr>
    <td class="tablecell" style="text-align:center;background-color:#f4f4b4">
      To be notified when major updates or additions are made to the EDEN site, enter in your email address below:
    </td>
  </tr>
  <tr>
    <td style="text-align:center">
      <form method="post">
        <input type="text" name="email" placeholder="email address" size="16">
        <input type="submit" name="submit" value="Submit">
      </form>
    </td>
  </tr>
</table>
<div style="text-align:center">
  <div style="display:inline-block;width:70%;border:4px solid #19aa97;background-color:#e1f2f9">
    <h3 style="color:#ac2c41;text-align:center"><strong>NEW EDEN Surface-Water Interpolation Model Version 3 Released!</strong></h3>
    <p style="text-align:center"><strong>Download: <a href="https://pubs.er.usgs.gov/publication/sir20205083"><abbr title="United States Geological Survey">USGS</abbr> Scientific Investigations Report 2020-5083</a></strong> - 
<a href="https://code.usgs.gov/water/eden"><strong>V3 Model Code</strong></a></p>
    <a href="https://pubs.er.usgs.gov/publication/sir20205083"><img src="images/EDEN_v3_report_cover.png" width="200" height="258" alt="Cover of EDEN Surface-Water Interpolation Model, Version 3 report" style="float:left;padding:10px"></a>
    <p style="text-align:left"> 
The EDEN team is excited to announce the latest version of the EDEN interpolation surface-water model, version 3 (V3).  This version replaces the version 2 (V2) model which was released in 2011.  Changes include updates to the interpolation model, the water-level gage network, and groundwater-level estimations.  With these updates, users will find that levees and canals are better represented in the new interpolation scheme in V3.
</p>
    <p style="text-align:left"> 
The additional groundwater levels provide a realistic estimate of the saturated groundwater surface continuous with the surface-water surface for Water Conservation Areas 2A and 2B from 2000 to 2011. This continuous surface is a more accurate estimation of the spatial distribution of water in the hydrologic system than before, providing needed information for ecological studies in areas where depth to water table affects habitats.
</p>
    <p style="text-align:left">The <strong>souce code</strong> for the latest version of the EDEN surface-water interpolation model is freely available through the official USGS Source Code Archive.  The package contains the scripts that run the interpolations model to create the daily water surfaces and <a href="https://code.usgs.gov/water/eden">can be downloaded here</a>.
</p>
  </div>
</div>
<p>The Everglades Depth Estimation Network (EDEN) is an integrated network of water-level gages, interpolation models, and applications that generates daily water-level data and derived hydrologic data across the freshwater part of the greater Everglades landscape. The <abbr title="Comprehensive Everglades Restoration Plan">Comprehensive Everglades Restoration Plan (CERP)</abbr> through the U.S. Army Corps of Engineers and U.S. Geological Survey Greater Everglades Priority Ecosystem Sciences provides support for EDEN and for the goal of providing consistent, documented, and readily accessible hydrologic and ground-elevation data for the Everglades.</p>
<?php require ($_SERVER['DOCUMENT_ROOT'] . '/../eden/ssi/eden-foot.php'); ?>
