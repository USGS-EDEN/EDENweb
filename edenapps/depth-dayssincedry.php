<?php
$title = "<title>EDEN Depth&amp;DaysSinceDry - Everglades Depth Estimation Network (EDEN)</title>\n";
require ($_SERVER['DOCUMENT_ROOT'] . '/../eden/ssi/eden-head.php');
?>
<h3>EDEN <abbr title="Depth and Days Since Dry">Depth&amp;DaysSinceDry</abbr> Tool</h3>
<table style="width:80%;margin:20px auto">
  <tr>
    <th class="bltablehead">Important Information</th>
  </tr>
  <tr>
    <td class="gtablecell2">
      <p>Update: <strong>Version 2.0.1</strong> is now available (February 2013), <strong>for PC and Mac</strong>. See <a href="#install">installation information</a> below.</p>
      <ul>
        <li><a id="zip"></a>Note: <strong>We recommend NOT using the Windows extractor to unpack the .zip file</strong> containing the <abbr title="Depth and Days Since Dry">Depth&amp;DaysSinceDry</abbr>, as the Windows extractor has trouble with complex zip archives and long path names. We recommend using <a href="http://www.winzip.com/">WinZip</a> or <a href="http://www.7-zip.org/">7zip</a>.</li>
        <li>Prior versions of the <abbr title="Depth and Days Since Dry">Depth&amp;DaysSinceDry</abbr> required the user to download NetCDF .dll files and the .NET Framework. This is no longer required, as the latest version of the <abbr title="Depth and Days Since Dry">Depth&amp;DaysSinceDry</abbr> is Java-based. All necessary files are included in the zip file (see below), except for the Java installation.<li><strong>Users will need to have 32-bit Java Virtual Machine (<abbr title="Java Virtual Machine">JVM</abbr>) installed on their system</strong> before they can run the <abbr title="Depth and Days Since Dry">Depth&amp;DaysSinceDry</abbr>. The 64-bit <abbr title="Java Virtual Machine">JVM</abbr> causes issues with the <abbr title="Depth and Days Since Dry">Depth&amp;DaysSinceDry</abbr>, so if you are running a 64-bit system, please ensure you have the 32-bit <abbr title="Java Virtual Machine">JVM</abbr> installed, not the 64-bit one. Most machines will have the 32-bit <abbr title="Java Virtual Machine">JVM</abbr> installed. Please <a href="mailto:%20hhenkel@usgs.gov">contact us</a> if you have questions.</li>
        <li><strong>February 2013 Update: </strong>minor modifications were made to the output files (.nc) to change the units for the &quot;days since dry&quot; from centimeters to days</li>
      </ul>
    </td>
  </tr>
</table>
<img src="../images/ddsd_v2_screenshot.gif" alt="EDEN Depth and Days Since Dry Screenshot" height="329" width="292" style="margin:20px;float:left">
<p>EDEN <abbr title="Depth and Days Since Dry">Depth&amp;DaysSinceDry</abbr> is a program for creating daily surfaces (in <abbr title="net C D F">NetCDF</abbr> file format, .nc) of water depth and days since dry from EDEN daily water level surfaces and ground elevation model.</p>
<p>The daily surface of water depth is created by subtracting the ground elevation for the EDEN grid cell (400 meter by 400 meter cells) from the water level surface. The days since last dry indicates the number of consecutive days since the start of the time period that an EDEN grid cell surface has had a depth value greater than zero. A count of &quot;0&quot; indicates that the cell was wet for that day. Once the cell is dry, the count begins and continues until a wet day is encountered. When this happens, the count is returned to &quot;0&quot;.</p>
<p>All water level data are output in units to <abbr title="North American Vertical Datum of 1988">North American Vertical Datum of 1988 (NAVD88)</abbr>.</p>
<p>Note: the latest version of the Depth&amp;DaysSinceDry Tool was updated with new &quot;Days Since Dry&quot; calculations as well as the ability to select an output path for files. Please see the User's Guide (below) for more information.</p>
<a id="install"></a>
<table style="width:90%;margin:20px auto">
  <tr>
    <th class="grtablehead">Installation</th>
  </tr>
  <tr>
    <td class="gtablecell2">
      <p>Prior versions of the <abbr title="Depth and Days Since Dry">Depth&amp;DaysSinceDry</abbr> required the user to download NetCDF .dll files and the .NET Framework. This is no longer required, as the latest version of the <abbr title="Depth and Days Since Dry">Depth&amp;DaysSinceDry</abbr> is Java-based. All necessary files are included in the zip file (see below), except for the Java installation. <strong>Users will need to have 32-bit Java Virtual Machine (<abbr title="Java Virtual Machine">JVM</abbr>) installed on their system before they can run the </strong><abbr title="Depth and Days Since Dry">Depth&amp;DaysSinceDry</abbr><strong>. The 64-bit <abbr title="Java Virtual Machine">JVM</abbr> causes issues with the </strong><abbr title="Depth and Days Since Dry">Depth&amp;DaysSinceDry</abbr><strong>, so if you are running a 64-bit system, please ensure you have the 32-bit <abbr title="Java Virtual Machine">JVM</abbr> installed, not the 64-bit one. Please <a href="mailto:%20hhenkel@usgs.gov">contact us</a> if you have questions.</strong></p>
      <p><a href="programs/depthdsd_instructions_V2_FINAL.pdf"><strong>User's Guide</strong></a> (pdf, 866 <abbr title="kilobytes">KB</abbr>, <b>updated July 10, 2012</b>) <a href="programs/depthdsd_instructions_V2_FINAL.pdf"><img src="../images/icons/guide.gif" alt="" height="31" width="17"></a></p>
      <p>You will need the following files:</p>
      <ol>
        <li><strong>EDEN Depth&amp;DaysSinceDry zip file</strong> (.zip, 92<abbr title="megabytes">MB</abbr>, currently at 2.0.1, <strong>Version 2 released July 10, 2012; Version 2.0.1 release February 17, 2013</strong>). The .zip file can be saved to any location on your computer. Select the appropriate version for your system. <a href="#zip">Please see note above about unzipping the .zip file.</a>
          <ul>
            <li><strong><a href="programs/EDEN_DDSD_V2.0.1_PC.zip">Windows</a></strong> (for 32- and 64-bit versions - please see note above regarding the JVM)</li>
            <li><strong><a href="programs/EDEN_DDSD_V2.0.1_MAC.zip">Mac</a></strong> (Please note there may be some display issues with the Mac version.)</li>
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
      </ol>
    </td>
  </tr>
  <tr>
    <td class="gvegtablehead">We're looking for feedback! Please <a href="../contacts.php">contact us</a>.</td>
  </tr>
</table>
<p><strong>The <abbr title='Everglades Depth Estimation Network applications'>EDENapps</abbr> are no longer available on <abbr title='Comprehensive Everglades Restoration Plan'>CERPZone</abbr>. Java-based versions of <abbr title='Everglades Depth Estimation Network applications'>EDENapps</abbr> are downloadable at: <a href='/../eden/edenapps/index.php'>http://sofia.usgs.gov/eden/edenapps/index.php</a></strong></p>
<?php require ($_SERVER['DOCUMENT_ROOT'] . '/../eden/ssi/eden-foot.php'); ?>