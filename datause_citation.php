<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Data Use & Citation - Everglades Depth Estimation Network (EDEN)</title>
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
  <h2>EDEN Data Use & Citation</h2>
  <h3>DATA RELIABILITY</h3>
  <p>Provisional and real-time data are subject to significant change prior to final review and approval. Neither the EDEN project nor the USGS are held liable for improper or inappropriate use of the data on this website.</p>
  <p>For information about reliability of data collected by other agencies, contact the agency points of contact provided.</p>
  <p>The data are provided free of charge, and may be shown, distributed, or published at will.</p>
  <h3>SUGGESTED DATA CITATION</h3>
  <p>The only provision for use of these datasets is that we request acknowledgement of the EDEN website and the USGS in all instances of publication or reference. We suggest using the following text:</p>
  <p><em>The authors acknowledge the Everglades Depth Estimation Network (EDEN) project and the US Geological Survey for providing the [insert data type here] for the purpose of this research/report.</em></p>
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