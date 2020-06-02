<?php
$title = "<title>xyLocator - Everglades Depth Estimation Network (EDEN)</title>\n";
require ($_SERVER['DOCUMENT_ROOT'] . '/eden/ssi/eden-head.php');
?>
<h3><abbr title="x y">xy</abbr>Locator</h3>
<table style="width:80%;margin:20px auto">
  <tr>
    <th class="bltablehead">Important Information</th>
  </tr>
  <tr>
    <td class="gtablecell2">
      <p>Update: <strong>Version 2.0.1</strong> is now available (November 2012), <strong>for PC and Mac</strong>. See <a href="#install">installation information</a> below.</p>
      <ul>
        <li><a id="zip"></a>Note: <strong>We recommend NOT using the Windows extractor to unpack the .zip file</strong> containing the xyLocator, as the Windows extractor has trouble with complex zip archives and long path names. We recommend using <a href="http://www.winzip.com/">WinZip</a> or <a href="http://www.7-zip.org/">7zip</a>.</li>
        <li>Prior versions of the xyLocator required the user to download NetCDF .dll files and the .NET Framework. This is no longer required, as the latest version of the xyLocator is Java-based. All necessary files are included in the zip file (see below), except for the Java installation.</li>
        <li><strong>Users will need to have 32-bit Java Virtual Machine (<abbr title="Java Virtual Machine">JVM</abbr>) installed on their system</strong> before they can run the xyLocator. The 64-bit <abbr title="Java Virtual Machine">JVM</abbr> causes issues with the xyLocator, so if you are running a 64-bit system, please ensure you have the 32-bit <abbr title="Java Virtual Machine">JVM</abbr> installed, not the 64-bit one. Most machines will have the 32-bit <abbr title="Java Virtual Machine">JVM</abbr> installed.  Please <a href="mailto:%20hhenkel@usgs.gov">contact us</a> if you have questions.</li>
      </ul>
    </td>
  </tr>
</table>
<img src="../images/screenshots/xyLocator_V2_screenshotth.gif" alt="screenshot of xy utility" height="300" width="400" style="float:left;margin:20px">
<p>EDEN <abbr title="x y">xy</abbr>Locator is a program for extracting data from spatial hydrology time-series. Data is extracted for specific x,y positions over the time range supplied by the user. The user can also choose among outputs for water stage, water depth, ground elevation (<abbr title="Digital Elevation Model">DEM</abbr>), and days since dry-down (counting from the start of the specified time range).</p>
<p>The user supplies EDEN <abbr title="x y">xy</abbr>Locator with a tab-delimited or comma-delimited text file. The first row is a header. Each following row is a point position that the user wants extracted from the EDEN dataset. The row must include a position name, x coordinate and y coordinate. Coordinates must be in <abbr title="Universe Transverse Mercator">UTM</abbr>, zone 17<abbr title="north">N</abbr>, <abbr title="North American Datum of 1983">NAD83</abbr> projection.</p>
<a id="install"></a>
<table style="width:90%;margin:20px auto">
  <tr>
    <th class="grtablehead">Installation</th>
  </tr>
  <tr>
    <td class="gtablecell2">
      <p>Prior versions of the xyLocator required the user to download NetCDF .dll files and the .NET Framework. This is no longer required, as the latest version of the xyLocator is Java-based. All necessary files are included in the zip file (see below), except for the Java installation. <strong>Users will need to have 32-bit Java Virtual Machine (<abbr title="Java Virtual Machine">JVM</abbr>) installed on their system before they can run the xyLocator.  The 64-bit <abbr title="Java Virtual Machine">JVM</abbr> causes issues with the xyLocator, so if you are running a 64-bit system, please ensure you have the 32-bit <abbr title="Java Virtual Machine">JVM</abbr> installed, not the 64-bit one.  Please <a href="mailto:hhenkel@usgs.gov">contact us</a> if you have questions.</strong></p>
      <p><a href="programs/EDEN_xyLocator_V2_Instructions.pdf"><b>User's Guide</b></a> (pdf, 204 <abbr title="kilobytes">KB</abbr>, <b>updated November 21, 2012</b>) <a href="programs/EDEN_xyLocator_Instructions.pdf"><img src="../images/icons/guide.gif" alt="" height="31" width="17"></a></p>
      <p>You will need the following files:</p>
      <ol>
        <li><b>EDEN xyLocator zip file </b>(.zip, 92<abbr title="megabytes">MB</abbr>, currently at 2.0.1, <strong>Version 2.0.1 updated November 6, 2012</strong>). The .zip file can be saved to any location on your computer. Select the appropriate version for your system.  <a href="#zip">Please see note above about unzipping the .zip file.</a>
          <ul>
            <li><a href="programs/EDEN_xyLocator_V2.0.1_PC.zip"><strong>Windows</strong></a> (for 32- and 64-bit versions - please see note above regarding the JVM)</li>
            <li><a href="programs/EDEN_xyLocator_V2.0.1_Mac.zip"><strong>Mac</strong></a> (Please note there may be some display issues with the Mac version.)</li>
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
        <li><a href="../models/watersurfacemod.php">EDEN daily water-level surfaces</a> (must be in <abbr title="net C D F">NetCDF</abbr> file format (.nc))</li>
        <li>x,y points files (see User's Guide below for more information)</li>
      </ol>
    </td>
  </tr>
  <tr>
    <td class="gvegtablehead">We're looking for feedback! Please <a href="../contacts.php">contact us</a>.</td>
  </tr>
</table>
<p><strong>The <abbr title='Everglades Depth Estimation Network applications'>EDENapps</abbr> are no longer available on <abbr title='Comprehensive Everglades Restoration Plan'>CERPZone</abbr>. Java-based versions of <abbr title='Everglades Depth Estimation Network applications'>EDENapps</abbr> are downloadable at: <a href='http://sofia.usgs.gov/eden/edenapps/index.php'>http://sofia.usgs.gov/eden/edenapps/index.php</a></strong></p>
<?php require ($_SERVER['DOCUMENT_ROOT'] . '/eden/ssi/eden-foot.php'); ?>