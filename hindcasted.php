<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Hindcasted Water Level Data - Everglades Depth Estimation Network (EDEN)</title>
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
  <h3>Hindcasted Water Level Data</h3>
  <div class="tablecell" style="width:200px;float:left;background-color:#f4e1b4;border:1px solid black;margin:5px">
    <h4 style="padding-left:5px">For More Information:</h4>
    <p style="padding-left:5px">&quot;<a href="http://pubs.usgs.gov/of/2007/1350/">Hydrologic Record Extension of Water-Level Data in the Everglades Depth Estimation Network (EDEN) using Artificial Neural Network Models, 2000-2006</a>&quot; (<abbr title="U.S. Geological Survey">USGS</abbr> Open File 2007-1350).</p>
  </div>
  <p>The Everglades Depth Estimation Network (EDEN) is an integrated network of real-time water-level gaging stations, ground-elevation models, and water-surface models designed to provide scientists, engineers, and water-resource managers with current (2000-present) water-depth information for the entire freshwater portion of the greater Everglades. The U.S. Geological Survey Greater Everglades Priority Ecosystem Science provides support for EDEN and the goal of providing quality assured monitoring data for the U.S. Army Corps of Engineers Comprehensive Everglades Restoration Plan. To increase the accuracy of the water-surface models, 25 real-time water-level gaging stations were added to the network of 253 established water-level gaging stations. To incorporate the data from the newly added stations to the 7-year EDEN database in the greater Everglades, the short-term water-level records (generally less than 1 year) needed to be simulated back in time (hindcasted) to be concurrent with data from the established gaging stations in the database. A three-step modeling approach using artificial neural network models was used to estimate the water levels at the new stations. The artificial neural network models used static variables that represent the gaging station location and percent vegetation in addition to dynamic variables that represent water-level data from the established EDEN gaging stations. The final step of the modeling approach was to simulate the computed error of the initial estimate to increase the accuracy of the final water-level estimate.</p>
  <p>The three-step modeling approach for estimating water levels at the new EDEN gaging stations produced satisfactory results. The coefficients of determination (R2) for 21 of the 25 estimates were greater than 0.95, and all of the estimates (25 of 25) were greater than 0.82. The model estimates showed good agreement with the measured data. For some new EDEN stations with limited measured data, the record extension (hindcasts) included periods beyond the range of the data used to train the artificial neural network models. The comparison of the hindcasts with long-term water-level data proximal to the new EDEN gaging stations indicated that the water-level estimates were reasonable. The percent model error (root mean square error divided by the range of the measured data) was less than 6 percent, and for the majority of stations (20 of 25), the percent model error was less than 1 percent.</p>
  <p>For more information, please see &quot;<a href="http://pubs.usgs.gov/of/2007/1350/">Hydrologic Record Extension of Water-Level Data in the Everglades Depth Estimation Network (EDEN) using Artificial Neural Network Models, 2000-2006</a>&quot; (<abbr title="U.S. Geological Survey">USGS</abbr> Open File 2007-1350). You can download data from this publication below. Please note the files have been zipped (.zip). If you have any questions about the data, please contact <a href="https://www.usgs.gov/staff-profiles/matthew-d-petkewich?qt-staff_profile_science_products=0#qt-staff_profile_science_products">Matt Petkewich</a> at <a href="mailto:mdpetkew@usgs.gov">mdpetkew@usgs.gov</a>.</p>
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