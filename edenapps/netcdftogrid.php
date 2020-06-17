<?php
$title = "<title>NetCDFtoGrid Tool - Everglades Depth Estimation Network (EDEN)</title>\n";
require ($_SERVER['DOCUMENT_ROOT'] . '/../eden/ssi/eden-head.php');
?>
<h3>NetCDFtoGrid Utility</h3>
<img src="../images/screenshots/netcdftogridscreen.jpg" alt="Screenshot of the netcdf to grid tool" height="289" width="360" style="float:left;margin:20px">
<p>EDEN <abbr title="Net C D F to Grid">NetCDFtoGrid</abbr> is a program for converting EDEN water level, water depth, and days since dry files from <abbr title="Net C D F">netCDF</abbr> (.nc) format to ESRI Grid format. <strong>Note:</strong> This tool only works on 32-bit machines.  For users with 64-bit machines, please use the <a href="http://help.arcgis.com/en/arcgisdesktop/10.0/help/index.html#//00460000000s000000">Multidimension Tools toolbox</a> found within ArcMap to convert NetCDF files.</p>
<table style="width:90%;margin:20px auto">
  <tr>
    <th class="grtablehead">Installation</th>
  </tr>
  <tr>
    <td class="gtablecell2">
      <p><strong>You will need the following files:</strong></p>
      <p>(Note: if you previously installed other EDENapp tools, then you may have some or all of these items already installed)</p>
      <ol>
        <li><a href="programs/EDENNetCDFtoGrid.zip"><abbr title="Net C D F to Grid">NetCDFtoGrid</abbr>.exe</a> (.zip, currently at <abbr title="version">v.</abbr> 1.0, 180 <abbr title="kilobytes">KB</abbr>)
          <ul>
            <li><abbr title="Net C D F to Grid">NetCDFtoGrid</abbr> can be copied to any location on your computer</li>
            <li><strong>Runs only on 32-bit systems. For users with 64-bit machines, please use the <a href="http://help.arcgis.com/en/arcgisdesktop/10.0/help/index.html#//00460000000s000000">Multidimension Tools toolbox</a> found within ArcMap to convert NetCDF files.</strong></li>
          </ul>
        </li>
        <li><a href="programs/netcdf-3.6.1-win32.zip"><abbr title="Net C D F">NetCDF</abbr> dlls</a> (.zip, 176 <abbr title="kilobytes">KB</abbr>)
          <ul>
            <li>Extract all the files in netcdf-3.6.1-win32.zip and copy them to c:\windows\system32</li>
          </ul>
        </li>
        <li><a href="http://www.microsoft.com/">Microsoft .Net version 2.0</a> (download from Microsoft's website)
          <ul>
            <li>Note: this may already be installed on your machine. Go to: Start &gt; Control Panel &gt; Add or Remove Programs. If Microsoft .Net Framework is installed, it will appear in this list</li>
          </ul>
        </li>
        <li><abbr title="Arc G I S">ArcGIS</abbr> (<abbr title="version">v.</abbr> 9.1 or later)</li>
      </ol>
      <p><strong>To Use:</strong></p>
      <p><strong>(Please note: there is no user's guide for this tool. Full instructions are below.)</strong></p>
      <ol>
        <li>Click on the first folder icon <img src="../images/icons/folder.gif" alt="folder icon" height="19" width="19"> to browse to the folder containing the <abbr title="Net C D F">NetCDF</abbr> files</li>
        <li>Click on the second folder icon <img src="../images/icons/folder.gif" alt="folder icon" height="19" width="19"> to browse to the folder where you would like to save the output <abbr title="Net C D F">file</abbr>. Type in an output name.
          <ul>
            <li>If the output file already exists, select:
              <ul>
                <li>Add new dates to existing files or</li>
                <li>Overwrite duplicate dates in existing file</li>
              </ul>
            </li>
          </ul>
        </li>
        <li>Click the &quot;Convert&quot; button</li>
      </ol>
      <p><strong>Files that can be converted with this program:</strong></p>
      <ol>
        <li>EDEN daily water level surfaces 
          <ul>
            <li><abbr title="Net C D F">NetCDF</abbr> format file(s) (.nc) containing daily water level surfaces</li>
            <li>Multiple one-quarter-year files can be used for requested time series (be sure that continuous data files are present for accurate time series calculations)</li>
            <li>Available for download at <a href="/../eden/models/watersurfacemod.php">http://sofia.usgs.gov/eden/models/watersurfacemod.php</a>.</li>
          </ul>
        </li>
        <li>EDEN daily water depth
          <ul>
            <li><abbr title="Net C D F">NetCDF</abbr> format file(s) (.nc) containing daily water depth</li>
            <li>Multiple one-quarter-year files can be used for requested time series (be sure that continuous data files are present for accurate time series calculations)</li>
            <li>Can be derived from EDEN daily water level surfaces and ground elevation surface using the EDEN Depth&amp;DaysSinceDry Tool, available for download at <a href="/../eden/edenapps/index.php">http://sofia.usgs.gov/eden/edenapps/index.php</a></li>
          </ul>
        </li>
        <li>EDEN days since dry
          <ul>
            <li><abbr title="Net C D F">NetCDF</abbr> format file(s) (.nc) containing days since dry</li>
            <li>Multiple one-quarter-year files can be used for requested time series (be sure that continuous data files are present for accurate time series calculations)</li>
            <li>Can be derived from EDEN daily water level surfaces and ground elevation surface using the EDEN Depth&amp;DaysSinceDry Tool, available for download at <a href="/../eden/edenapps/index.php">http://sofia.usgs.gov/eden/edenapps/index.php</a></li>
          </ul>
        </li>
      </ol>
    </td>
  </tr>
  <tr>
    <td class="gvegtablehead">We're looking for feedback! Please <a href="../contacts.php">contact us</a>.</td>
  </tr>
</table>
<p><strong>The <abbr title='Everglades Depth Estimation Network applications'>EDENapps</abbr> are no longer available on <abbr title='Comprehensive Everglades Restoration Plan'>CERPZone</abbr>. Java-based versions of <abbr title='Everglades Depth Estimation Network applications'>EDENapps</abbr> are downloadable at: <a href='/../eden/edenapps/index.php'>http://sofia.usgs.gov/eden/edenapps/index.php</a></strong></p>
<?php require ($_SERVER['DOCUMENT_ROOT'] . '/../eden/ssi/eden-foot.php'); ?>
