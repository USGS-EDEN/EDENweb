<?php
$title = "<title>DataViewer - Everglades Depth Estimation Network (EDEN)</title>\n";
require ($_SERVER['DOCUMENT_ROOT'] . '/../eden/ssi/eden-head.php');
?>
<h3>EDEN DataViewer</h3>
<table style="width:80%;margin:20px auto">
  <tr>
    <th class="bltablehead">Important Information</th>
  </tr>
  <tr>
    <td class="gtablecell2">
      <p>Update: <strong>Version 2.2.0 </strong>is now available (February 2013), <strong>for PC (Mac coming soon)</strong>. See <a href="#install">installation information</a> below.</p>
      <ul>
        <li><a id="zip"></a>Note: <strong>We recommend NOT using the Windows extractor to unpack the .zip file</strong> containing the <abbr title="Depth and Days Since Dry">DataViewer</abbr>, as the Windows extractor has trouble with complex zip archives and long path names. We recommend using <a href="http://www.winzip.com/">WinZip</a> or <a href="http://www.7-zip.org/">7zip</a>.</li>
        <li>Prior versions of the <abbr title="Depth and Days Since Dry">DataViewer</abbr> required the user to download NetCDF .dll files and the .NET Framework. This is no longer required, as the latest version of the <abbr title="Depth and Days Since Dry">DataViewer</abbr> is Java-based. All necessary files are included in the zip file (see below), except for the Java installation.</li>
        <li><strong>Users will need to have 32-bit Java Virtual Machine (<abbr title="Java Virtual Machine">JVM</abbr>) installed on their system</strong> before they can run the <abbr title="Depth and Days Since Dry">DataViewer</abbr>. The 64-bit <abbr title="Java Virtual Machine">JVM</abbr> causes issues with the <abbr title="Depth and Days Since Dry">DataViewer</abbr>, so if you are running a 64-bit system, please ensure you have the 32-bit <abbr title="Java Virtual Machine">JVM</abbr> installed, not the 64-bit one. Most machines will have the 32-bit <abbr title="Java Virtual Machine">JVM</abbr> installed. Please <a href="mailto:%20hhenkel@usgs.gov">contact us</a> if you have questions.</li>
      </ul>
    </td>
  </tr>
</table>
<img src="../images/screenshots/DV_screen_v2.jpg" alt="EDEN DataViewer Screenshot" height="374" width="576" style="display:block;margin:20px auto">
<p>The EDEN DataViewer is a program for viewing the daily EDEN surfaces of water level and ground elevation from the ground surface digital elevation model and creates daily surfaces of water depth and days since last dry. The user can view all or a selected area of the EDEN domain and the surfaces can be animated over time. Data values for each surface are reported for user-selected <abbr title="Universal Transverse Mercator">UTM</abbr>-coordinate locations.</p>
<table style="width:90%;margin:20px auto">
  <tr>
    <th class="grtablehead">Installation</th>
  </tr>
  <tr>
    <td class="gtablecell2">
      <p>Prior versions of the <abbr title="Depth and Days Since Dry">DataViewer</abbr> required the user to download NetCDF .dll files and the .NET Framework. This is no longer required, as the latest version of the <abbr title="Depth and Days Since Dry">DataViewer</abbr> is Java-based. All necessary files are included in the zip file (see below), except for the Java installation. <strong><b>Users will need to have 32-bit Java Virtual Machine (<abbr title="Java Virtual Machine">JVM</abbr>) installed on their system before they can run the </b></strong><abbr title="Depth and Days Since Dry">DataViewer</abbr><strong><b>. The 64-bit <abbr title="Java Virtual Machine">JVM</abbr> causes issues with the </b></strong><abbr title="Depth and Days Since Dry">DataViewer</abbr><strong><b>, so if you are running a 64-bit system, please ensure you have the 32-bit <abbr title="Java Virtual Machine">JVM</abbr> installed, not the 64-bit one. Please <a href="mailto:%20hhenkel@usgs.gov">contact us</a> if you have questions.</b></strong></p>
      <p><a href="programs/EDENDataViewerV2_UserGuide.pdf"><b>User's Guide</b></a> (pdf, 738 <abbr title="kilobytes">KB</abbr>, <b>updated February 16, 2013</b>) <a href="programs/EDENDataViewerV2_UserGuide.pdf"><img src="../images/icons/guide.gif" alt="" height="31" width="17"></a></p>
      <p>You will need the following files:</p>
      <ol>
        <li><strong><b>EDEN DataViewer zip file</b></strong><b> </b>(.zip, 116 <abbr title="megabytes">MB</abbr>, currently at 2.2.0, <strong>Version 2 released February 2013</strong>). The .zip file can be saved to any location on your computer. Select the appropriate version for your system. <a href="#zip">Please see note above about unzipping the .zip file.</a>
          <ul>
            <li><strong><a href="programs/EDEN_DataViewer_2.2.0.zip">Windows</a></strong> (for 32- and 64-bit versions - please see note above regarding the JVM)</li>
            <li><strong>Mac</strong> (Coming soon.)</li>
          </ul>
        </li>
        <li><strong>JavaSE-1.6</strong>
          <ul>
            <li>Make sure it is the 32-bit version</li>
            <li>Download from <a href="http://www.java.com">http://www.java.com</a></li>
          </ul>
        </li>
      </ol>
      <p><strong>Required User Input Files:</strong></p>
      <ol>
        <li><a href="../models/groundelevmod.php">EDEN DEM file for ground elevation</a>
          <ul>
            <li>Must be in <abbr title="net C D F">netCDF</abbr> file format (.nc)</li>
            <li><a href="https://archive.usgs.gov/archive/sites/sofia.usgs.gov/metadata/sflwww/eden_em_cm_ja10-notch.html">Metadata is also available</a> for this <abbr title="digital elevation model">DEM</abbr> and has been included in the EDEN <abbr title="digital elevation model">DEM</abbr> zip file.</li>
          </ul>
        </li>
        <li><a href="../models/watersurfacemod.php">EDEN daily water-level surfaces</a> (must be in <abbr title="net C D F">NetCDF</abbr> file format (.nc))
      </ol>
    </td>
  </tr>
  <tr>
    <td class="gvegtablehead">We're looking for feedback! Please <a href="../contacts.php">contact us</a>.</td>
  </tr>
</table>
<p><strong>The <abbr title='Everglades Depth Estimation Network applications'>EDENapps</abbr> are no longer available on <abbr title='Comprehensive Everglades Restoration Plan'>CERPZone</abbr>. Java-based versions of <abbr title='Everglades Depth Estimation Network applications'>EDENapps</abbr> are downloadable at: <a href='/../eden/edenapps/index.php'>http://sofia.usgs.gov/eden/edenapps/index.php</a></strong></p>
<?php require ($_SERVER['DOCUMENT_ROOT'] . '/../eden/ssi/eden-foot.php'); ?>