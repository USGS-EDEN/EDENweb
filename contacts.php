<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>EDEN Contacts - Everglades Depth Estimation Network (EDEN)</title>
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
  <p>For questions regarding the <strong>EDEN Project</strong>, please contact:</p>
  <table style="width:400px;border:2px solid;margin:20px auto">
    <tr>
      <td colspan="2" style="background-color:#f4e1b4" class="contacttablehead">Eric Swain</td>
    </tr>
    <tr>
      <td class="contacttable" style="width:100px">Email:</td>
      <td class="contacttable"><a href="mailto:edswain@usgs.gov">edswain@usgs.gov</a></td>
    </tr>
    <tr>
      <td class="contacttable">Address:</td>
      <td class="contacttable"><abbr title="U.S. Geological Survey">US Geologial Survey</abbr><br>
        Caribbean-Florida Water Science Center<br>
        NSU Center for Collaborative Research<br>
        3321 College Avenue<br>
        Davie, FL 33314
      </td>
    </tr>
    <tr>
      <td class="contacttable">Phone/Fax:</td>
      <td class="contacttable">Office: 954-377-5925<br>
        Fax: 954-377-5901</td>
    </tr>
  </table>
  <p>For questions regarding the <strong>EDEN website</strong>, please contact:</p>
  <table style="width:400px;border:2px solid;margin:20px auto">
    <tr>
      <td colspan="2" style="background-color:#f4e1b4" class="contacttablehead">Heather Henkel</td>
    </tr>
    <tr>
      <td class="contacttable" style="width:100px">Email:</td>
      <td class="contacttable"><a href="mailto:hhenkel@usgs.gov">hhenkel@usgs.gov</a></td>
    </tr>
    <tr>
      <td class="contacttable">Address:</td>
      <td class="contacttable"><abbr title="U.S. Geological Survey">USGS</abbr>-<abbr title="Saint">St.</abbr> Petersburg, Florida<br>
        600 4th <abbr title="Street">St.</abbr> South<br>
        <abbr title="Saint">St.</abbr> Petersburg, <abbr title="Florida">FL</abbr> 33701<br>
      </td>
    </tr>
    <tr>
      <td class="contacttable">Phone/Fax:</td>
      <td class="contacttable">Office: (727) 502-8028<br>
        Fax: (727) 502-8182</td>
    </tr>
  </table>
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