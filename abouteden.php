<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Learn About EDEN - Everglades Depth Estimation Network (EDEN)</title>
  <link rel="stylesheet" href="/eden/css/eden-dbweb-html5.css">
  <script src="https://www.usgs.gov/scripts/analytics/usgs-analytics.js"></script>
  <style>
    table { border-collapse: collapse }
    table, td, th { border: 1px solid #477489 }
    td, th { padding: 2px }
  </style>
</head>
<body>
<?php require ($_SERVER['DOCUMENT_ROOT'] . '/eden/ssi/eden-head.txt'); ?>
<?php require ($_SERVER['DOCUMENT_ROOT'] . '/eden/ssi/nav.php'); ?>
<div style="overflow:hidden;padding-right:8px;background-color:white;min-height:825px"><!--Begin body of page -->
  <h4>Learn About EDEN</h4>
  <div style="width:230px;border:1px solid #710a11;background-color:#f4e1b4;float:left;font-size:12px;padding:2px;margin-right:10px">
    <h4>For More Information:</h4>
    <ul>
      <li><a href="https://archive.usgs.gov/archive/sites/sofia.usgs.gov/publications/papers/regwetdem/">An approach to regional wetland digital elevation model development using a differential global positioning system and a custom-built helicopter-based surveying system</a> (International Journal of Remote Sensing, Volume 33, Issue 2, <abbr title="pages">p.</abbr> 450-465).</li>
      <li>Annual Report: <a href="annual-rpt/summary-annrpt06.php">2006</a>, <a href="annual-rpt/summary-annrpt07.php">2007</a>, <a href="annual-rpt/status-annrpt08.php">2008</a>, <a href="annual-rpt/status-annrpt09.php">2009</a>, <a href="annual-rpt/status-annrpt10.php">2010</a>, <a href="annual-rpt/status-annrpt11.php">2011</a>, <a href="annual-rpt/status-annrpt12.php">2012</a></li>
      <li><a href="http://pubs.usgs.gov/fs/2009/3052/">Everglades Depth Estimation Network (EDEN) Applications: <i>Tools to View, Extract, Plot, and Manipulate EDEN Data</i></a> (<abbr title="U.S. Geological Survey">USGS</abbr> Fact Sheet 2009-3052)</li>
      <li>&quot;<a href="https://archive.usgs.gov/archive/sites/sofia.usgs.gov/publications/fs/2006-3087/index.html">The Everglades Depth Estimation Network (EDEN) for Support of Ecological and Biological Assessments</a>&quot; (<abbr title="U.S. Geological Survey">USGS</abbr> Fact Sheet 2006-3087)</li>
      <li><a href="../projects/eden/">EDEN Project page on <abbr title="U.S. Geological Survey">USGS</abbr> SOFIA Website</a></li>
    </ul>
  </div>
  <p>The purpose of this website is to make hydrologic and ground elevation data readily available to scientists, managers, and others working in the Everglades.</p>
  <p>Water-level data for over 300 gages operated by multiple agencies are accessed through an <a href="stationlist.php">interactive map</a>. A Station Information page for each gage lists location, ground elevation, and vegetation in the vicinity of the gage. Through data links, the Explore and View EDEN (<a href="eve/index.php">EVE</a>) graphical interface allows users to graph and download historic and near-real-time (within 24 hours) data for the gage.</p>
  <p>Data from the network of gages are transmitted daily by radio or satellite telemetry to the operating agency then transferred to the USGS for interpolation of daily water-level surfaces for the Everglades. The interpolation model produces gridded surfaces (400m by 400m) of <a href='models/watersurfacemod.php'>water-level surfaces</a> for the freshwater part of the Everglades which are posted daily.</p>
  <table style="width:325px;border:2px solid #4b7e83;margin:20px auto">
    <tr>
      <td><a id="figure"></a><a href="images/dataflow.png"><img src="images/dataflow.png" alt="Graphic showing the path of data from the field to the website" height="258" width="510"></a></td>
    </tr>
    <tr>
      <td style="background-color:#f1fcdd"><span class="caption">Transmission, transfer storage, and access of data from the water-level data collected in the field to website access by users. <abbr title="National Water Information System">NWIS</abbr> is National Water Information System. <abbr title="Everglades Depth Estimation Network">EDEN</abbr> is Everglades Depth Estimation Network. [<a href="images/dataflow.png">larger image</a>]</span></td>
    </tr>
  </table>
  <p>A set of EDEN application tools (<a href="edenapps.php">EDENapps</a>) make data in the daily water-level surfaces accessible by allowing users to view, plot, and manipulate the data. The tools include: <a href="edenapps/dataviewer.php">DataViewer</a>, <a href="edenapps/xylocator.php"><abbr title="x y">xy</abbr>Locator </a>, <a href="edenapps/transectplotter.php">TransectPlotter</a>, <abbr title="Depth and Days Since Dry"><a href="edenapps/depth-dayssincedry.php">Depth&amp;DaysSinceDry</a></abbr>, and <abbr title="Net C D F to Grid"><a href="edenapps/netcdftogrid.php">NetCDFtoGrid</a></abbr>.</p>
  <p>For more information about EDEN, please see our <a href="publications.php">publications page</a>.</p>
</div><!--End body of page -->
</div><!--End content and nav -->
<div style="clear:both;width:100%;background-color:#4d7c86">
  <span class="footer">Technical support for this Web site is provided by the <a href="http://www.usgs.gov/" class="footer">U.S. Geological Survey</a><br>This page is:
<?php
$filename = htmlentities($_SERVER['SCRIPT_NAME'], ENT_QUOTES); 
echo "http://sofia.usgs.gov$filename";
?>
  <br>Comments and suggestions? Contact: <a href="https://archive.usgs.gov/archive/sites/sofia.usgs.gov/comments.html" class="footer">Heather Henkel - Webmaster</a><br>Last updated:
<?php echo date ("F d, Y h:i A", getlastmod()); ?> (BJM)</span>
</div>
</body>
</html>