<?php
$title = "<title>TransectPlotter - Everglades Depth Estimation Network (EDEN)</title>\n";
require ($_SERVER['DOCUMENT_ROOT'] . '/eden/ssi/eden-head.php');
?>
<h3>TransectPlotter</h3>
<table style="width:80%;margin:20px auto">
  <tr>
    <th class="bltablehead">Important Information</th>
  </tr>
  <tr>
    <td class="gtablecell2">
      <p>The TransectPlotter has been modified to <strong>run on 64-bit machines</strong>. Please see installation instructions below for more information.</p>
      <p>The &quot;<strong>stations.txt</strong>&quot; file (needed to run the TransectPlotter) has also be <strong>updated</strong> to include to include the current (2013) version of EDEN gages. The new file has been zipped up with both the 32-bit and 64-bit programs.</p>
    </td>
  </tr>
</table>
<img src="../images/screenshots/transect-screenshot.jpg" alt="screenshot of EDEN transect utility" height="211" width="432" style="display:block;margin:20px auto">
<p>EDEN TransectPlotter is a program for plotting daily water level surfaces and ground elevation profiles for user-specified transects across the Everglades. The water surface can be animated over a user-specified time period and the water surface slope is calculated and displayed along the transect for user-specified distances.</p>
<p>Location of nearby water level gaging stations can be indicated on the transect plot. The location of the gage in meters perpendicular to the transect line provides users with information about data that may have been used in development of the transect plot.  The daily median output files must be reviewed to determine if gage data were available for the period of interest.</p>
<p>Additionally, user-provided observations of water level and water depth can be plotted on the transect for comparison with the EDEN water surface. The user-specified distance perpendicular to the transect identifies a selection criteria for observations that are plotted on the transect plot.</p>
<p>All water level and ground elevation data are output in units of <abbr title="North American Vertical Datum of 1988">North American Vertical Datum of 1988 (NAVD88)</abbr>.</p>
<table style="width:90%;margin:20px auto">
  <tr>
    <th class="grtablehead">Installation</th>
  </tr>
  <tr>
    <td class="gtablecell2">
      <p>You will need the following files:</p>
      <p><strong>Required for execution of the program:</strong></p>
      <p>(Note: if you previously installed other EDENapp tools, then you may have some or all of these items already installed)</p>
      <ol>
        <li>EDENTransect Plotter.exe (.zip, 106-237 <abbr title="kilobytes">KB</abbr>, currently at <abbr title="version">v.</abbr> 1.2)
          <ul>
            <li>Executable file can be copied to any location on your computer</li>
            <li><strong>Download: <a href="programs/EDENTransectPlotter_32bit.zip">32-bit version</a> | <a href="programs/EDENTransectPlotter_64bit.zip">64-bit version</a></strong></li>
          </ul>
        </li>
        <li>List of EDEN stations and locations (<strong>updated September 10, 2013</strong>)
          <ul>
            <li>Used to incorporate nearby gage locations on the transect plot</li>
            <li>Filename must be stations.txt</li>
            <li>Must be copied to folder containing the TransectPlotter.exe file</li>
            <li>Included as part of the EDENTransectPlotter.zip file download</li>
          </ul>
        </li>
        <li><a href="programs/netcdf-3.6.1-win32.zip">netCDF dlls</a> (.zip, 176 <abbr title="kilobytes">KB</abbr>)
          <ol>
            <li>For <strong>32-bit systems</strong>: extract all the files in netcdf-3.6.1-win32.zip and copy them to C:\Windows\<strong>System32</strong>\</li>
            <li>For<strong> 64-bit systems</strong>: extract all the files in netcdf-3.6.1-win32.zip and copy them to C:\Windows\<strong>SysWOW64</strong>\</li>
          </ol>
        </li>
        <li><a href="http://www.microsoft.com/">Microsoft .Net version 2.0</a> (download from Microsoft's website)
          <ul>
            <li>Note: this may already be installed on your machine. Go to: Start &gt; Control Panel &gt; Add or Remove Programs. If Microsoft .Net Framework is installed, it will appear in this list</li>
          </ul>
        </li>
      </ol>
      <p><strong>Required User Input Files:</strong></p>
      <ol>
        <li><a href="../models/groundelevmod-edenapps.php">EDEN DEM file for ground elevation</a> (updated January 2010)
          <ul>
            <li>Must be in <abbr title="net C D F">netCDF</abbr> file format (.nc)</li>
            <li><strong>Please note:</strong> The released January 2010 data was modified in two ways:
              <ul>
                <li>First, elevation values have been converted from meters (m) to centimeters (cm)</li>
                <li>Second, data has been removed from the southern Big Cypress National Preserve and northwestern Everglades National Park area so that this DEM boundary matches the boundary or domain of the EDEN surface-water model still in use in EDEN applications software. This is the area noted in yellow in the right-hand map below.</li>
              </ul>
            </li>
            <li><a href="https://archive.usgs.gov/archive/sites/sofia.usgs.gov/metadata/sflwww/eden_em_cm_ja10-notch.html">Metadata is also available</a> for this <abbr title="digital elevation model">DEM</abbr> and has been included in the EDEN <abbr title="digital elevation model">DEM</abbr> zip file.</li>
          </ul>
        </li>
        <li><a href="../models/watersurfacemod.php#netcdf">EDEN daily water level surfaces</a> (must be in <abbr title="net C D F">NetCDF</abbr> file format (.nc))</li>
        <li>Transect points file (see User's Guide below for more information)</li>
      </ol>
      <p><strong><a href="programs/EDENTransectPlotterGuide.pdf">User's Guide</a></strong> (pdf, 545 <abbr title="kilobytes">KB</abbr> - <strong>updated September 10, 2013</strong>) <a href="programs/EDENTransectPlotterGuide.pdf"><img src="../images/icons/guide.gif" alt="" height="31" width="17"></a></p>
      <hr style="width:70%">
      <p><strong>Notes:</strong></p>
      <ul>
        <li>EDEN TransectPlotter can only run on a Windows machine</li>
        <li>The <abbr title="net C D F">netCDF</abbr> dll is required to use EDENapps. Extract all the files in <a href="programs/netcdf-3.6.1-win32.zip">netcdf-3.6.1-win32.zip</a> and copy them to the appropriate location, depending up whether or not you have a 32- or 64-bit system.</li>
      </ul>
    </td>
  </tr>
  <tr>
    <td class="gvegtablehead">We're looking for feedback! Please <a href="../contacts.php">contact us</a>.</td>
  </tr>
</table>
<p><strong>The <abbr title='Everglades Depth Estimation Network applications'>EDENapps</abbr> are no longer available on <abbr title='Comprehensive Everglades Restoration Plan'>CERPZone</abbr>. Java-based versions of <abbr title='Everglades Depth Estimation Network applications'>EDENapps</abbr> are downloadable at: <a href="http://sofia.usgs.gov/eden/edenapps/index.php">http://sofia.usgs.gov/eden/edenapps/index.php</a></strong></p>
<?php require ($_SERVER['DOCUMENT_ROOT'] . '/eden/ssi/eden-foot.php'); ?>