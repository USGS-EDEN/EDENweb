<?php
$title = "<title>Everglades Depth Estimation Network (EDEN)</title>\n";
$script = "<script>
setTimeout(function(){var a=document.createElement('script');
var b=document.getElementsByTagName('script')[0];
a.src=document.location.protocol+'//script.crazyegg.com/pages/scripts/0020/3757.js?'+Math.floor(new Date().getTime()/3600000);
a.async=true;a.type='text/javascript';b.parentNode.insertBefore(a,b)}, 1);
  </script>\n";
require ($_SERVER['DOCUMENT_ROOT'] . '/eden/ssi/eden-head.php');
?>
<div style="text-align:center">
  <img src="images/logos/EDEN-logoth.gif" alt="" height="111" width="288">
  <p style="color:#009999;font-weight:bold;font-style:italic;">Providing real-time hydrologic tools for biological and ecological assessments for adaptive management</p>
</div>
<table style="width:250px;float:left">
  <tr>
    <th class="gtablehead">What's New @ EDEN</th>
  </tr>
  <tr>
    <td class="tablecell" style="background-color:#ffffcc">
      <ul>
        <li><a href="models/watersurfacemod_download.php"><strong>2019 <abbr title="fourth quarter">Q4</abbr> Provisional</strong> Water Surfaces</a></li>
        <li><a href="models/watersurfacemod_download.php"><strong>2019 <abbr title="third quarter">Q3</abbr> Provisional</strong> Water Surfaces</a></li>
        <li><a href="models/watersurfacemod_download.php"><strong>2019 <abbr title="second quarter">Q2</abbr> Provisional</strong> Water Surfaces</a></li>
        <li><a href="models/watersurfacemod_download.php"><strong>2019 <abbr title="first quarter">Q1</abbr> Provisional</strong> Water Surfaces</a></li>
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
      <form action="https://sofia.usgs.gov/cgi-bin/dada/mail.cgi" method="get">
        <input type="hidden" name="list" value="edennews">
        <input type="hidden" name="f" value="subscribe">
        <input type="text" name="email" value="email address" size="16" onfocus="this.value='';">
        <input type="submit" value="Submit">
      </form>
    </td>
  </tr>
</table>
<div style="text-align:center">
  <div style="display:inline-block;width:60%;border:4px solid #663340;background-color:#fff8ca">
    <h3 style="color:#663340;text-align:center">EDEN Announcements</h3>
    <p style="text-align:center"><a href="csss/"><strong>Cape Sable Seaside Sparrow (CSSS) Viewer</strong></a></p>
    <a href="csss/"><img src="images/CSSS_viewer_update.jpg" width="288" height="260" alt="screenshot of viewer" style="float:left;padding:3px"></a>
    <p style="text-align:left">Newly added features include a new expanded subarea A sparrow habitat ("AX"), new daily statistics (mean water depth and water depth standard deviation), new display surfaces (4 year hydroperiod and hydroperiod standard deviation), new annual summary statistics (4 year hydroperiod and hydroperiod standard deviation), and some fun new widgets: check out the popup statistics graphs on the Summary Statistics tab linked to the column headers.<br><br>Take a look at the updated <a href="csss/">CSSS Viewer</a>!</p>
  </div>
</div>
<p>The Everglades Depth Estimation Network (EDEN) is an integrated network of water-level gages, interpolation models, and applications that generates daily water-level data and derived hydrologic data across the freshwater part of the greater Everglades landscape. The <abbr title="Comprehensive Everglades Restoration Plan">Comprehensive Everglades Restoration Plan (CERP)</abbr> through the U.S. Army Corps of Engineers and U.S. Geological Survey Greater Everglades Priority Ecosystem Sciences provides support for EDEN and for the goal of providing consistent, documented, and readily accessible hydrologic and ground-elevation data for the Everglades.</p>
<div style="text-align:center">
  <div style="display:inline-block;width:75%;padding:3px;background-color:#f4e1b4">
    <a href="https://archive.usgs.gov/archive/sites/sofia.usgs.gov/publications/fs/2006-3087/index.html"><img src="images/thumbs/fs2006-3087th.jpg" alt="EDEN Fact Sheet" height="216" width="167" style="float:left"></a>
    <p>For more information:</p>
    <p>USGS Fact Sheets on EDEN: &quot;<a href="https://archive.usgs.gov/archive/sites/sofia.usgs.gov/publications/fs/2006-3087/index.html">The Everglades Depth Estimation Network (EDEN) for Support of Ecological and Biological Assessments</a>&quot; and &quot;<a href="http://pubs.usgs.gov/fs/2009/3052/">Everglades Depth Estimation Network (EDEN) Applications: <em>Tools to View, Extract, Plot, and Manipulate EDEN Data</em></a>.&quot; Or visit our &quot;<a href="abouteden.php">Learn About EDEN</a>&quot; page</p>
  </div>
</div>
<?php require ($_SERVER['DOCUMENT_ROOT'] . '/eden/ssi/eden-foot.php'); ?>