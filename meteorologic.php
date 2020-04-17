<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Meteorologic Data - Everglades Depth Estimation Network (EDEN)</title>
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
  <h3>Meteorologic Data</h3>
  <h2><a href="nexrad.php">Rainfall Data</a></h2>
  <p>Rainfall data based on Next Generation Radar (NEXRAD) data from the U.S. National Weather Service provides complete spatial coverage of rainfall amounts for the State of Florida. The accuracy of NEXRAD data is enhanced when adjusted using the local rain-gage data. The NEXRAD coverage for the South Florida Water Management District area includes rainfall amounts for 15-minute intervals for the period January 1, 2002 to present for 2 <abbr title="kilometer">km</abbr> by 2 <abbr title="kilometer">km</abbr> grid resolution. <strong>(Please note that EDEN data is on a 400 <abbr title="meter">m</abbr> by 400 <abbr title="meter">m</abbr> grid.)</strong> The <abbr title="South Florida Water Management District">SFWMD</abbr> receives &ldquo;near real-time&rdquo; 15-minute data (<abbr title="near real time data">NRD</abbr>) continuously. These <abbr title="near real time data">NRD</abbr> are compiled, verified, and quality-assured at the end of each month in the end-of-month (EOM) sets of 15-minute files. The <abbr title="end of the month">EOM</abbr> files use 81 additional rain gage data that are not available real-time and a proprietary algorithm based on the Brandes method to adjust radar rainfall values. <strong><a href="nexrad.php">Download Rainfall data.</a></strong></p>
  <h2><a href="evapotrans.php">Evapotranspiration Data</a></h2>
  <p><abbr title="Evapotranspiration">Evapotranspiration (ET)</abbr> is a term used to describe the sum of evaporation and plant transpiration from the Earth's land surface to atmosphere. <strong><a href="evapotrans.php">Download Evapotranspiration data.</a></strong></p>
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