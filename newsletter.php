<?php
$title = "<title>Newsletter - Everglades Depth Estimation Network (EDEN)</title>\n";
require ($_SERVER['DOCUMENT_ROOT'] . '/../eden/ssi/eden-head.php');
?>
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
<?php require ($_SERVER['DOCUMENT_ROOT'] . '/../eden/ssi/eden-foot.php'); ?>