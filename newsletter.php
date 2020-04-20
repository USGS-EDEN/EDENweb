<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Newsletter - Everglades Depth Estimation Network (EDEN)</title>
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
  <h3>EDEN Newsletter</h3>
  <table style="width:200px;border:2px solid #477489;float:right">
    <tr>
      <td style="background-color:#f4f4b4">
        <span class="tablecell">To be notified when major updates or additions are made to the EDEN site, enter in your email address below:</span>
      </td>
    </tr>
    <tr>
      <td>
        <form action="http://sofia.usgs.gov/cgi-bin/dada/mail.cgi" method="get">
          <input type="hidden" name="list" value="edennews" />
          <input type="hidden" name="f" value="subscribe" />
          <input type="text" name="email" value="email address" size="16" onfocus="this.value='';" />
          <input type="submit" value="Submit" />
        </form>
      </td>
    </tr>
  </table>
  <p>If you would like to be informed of posting of </p>
  <ul>
    <li>EDEN datasets updates,</li>
    <li>model results, and</li>
    <li>new EDEN publications,</li>
  </ul>
  <p>please sign up for the free EDEN newsletter.</p>
  <p class="sectionheader">How do I subscribe?</p>
  <p>Subscription is easy - either use the form to the right or send an email to <a href="mailto:hhenkel@usgs.gov">hhenkel@usgs.gov</a> and we will subscribe you.</p>
  <p class="sectionheader">Will my email address be shared with anyone or be used for anything other than this newsletter?</p>
  <p>No. Your email address will not be shared with anyone. Ever. At anytime. It will be used only for this newsletter.</p>
  <p class="sectionheader">How do I unsubscribe?</p>
  <p>You can unsubscribe at anytime; just follow the link at the bottom of any of the emails we send you. You can also send an email to <a href="mailto:hhenkel@usgs.gov">hhenkel@usgs.gov</a> and we will unsubscribe you.</p>
  <p class="sectionheader">What does it cost?</p>
  <p>This is a free newsletter.</p>
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