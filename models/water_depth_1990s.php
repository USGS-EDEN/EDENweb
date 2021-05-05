<?php
$size = array('netcdf' => array(), 'geotiff' => array(), 'dailymedian' => array(), 'depth' => array());
foreach ($size as $a => $b) {
	$dir = "/export1/htdocs/eden/data/$a/v2";
	if ($handle = opendir($dir)) {
		while (false !== ($file = readdir($handle)))
			if (preg_match("/^[0-9]{4}_q[1-4]{1}_[A-Za-z0-9_]{2,}\.zip$/", $file))
				$size[$a][substr($file, 0, 4)] += filesize($dir . '/' . $file) / 1048576;
		closedir($handle);
	}
}
$title = "<title>Download Water Surfaces Data - 1990-1999 - Everglades Depth Estimation Network (EDEN)</title>\n";
require ($_SERVER['DOCUMENT_ROOT'] . '/../eden/ssi/eden-head.php');
?>
<h2>Water-Depth Surfaces - 1990-1999</h2>
<table style="width:190px;float:right;text-align:center;margin:10px auto">
  <tr>
    <td>
      <img src="../images/maps/depth_map_example.jpg" alt="Example of EDEN water-depth map" height="250" width="176">
    </td>
  </tr>
  <tr>
    <td style="background-color:#d5ea90">
      <p>Example EDEN water-depth map.</p>
    </td>
  </tr>
</table>
<p><strong>Note: it is recommended that users <a href="watersurfacemod_download_1990s.php">read the details regarding the creation of  water-level surfaces used to generate these water-depth maps</a>.</strong></p>
<h3><a id="netcdf"></a><abbr title="Net C D F">NetCDF</abbr> Files:</h3>
<p><abbr title="Net C D F">NetCDF</abbr> (Network Common Data Form) is a set of freely-distributed software libraries and machine-independent binary data formats that support the creation, access, and sharing of large array-oriented scientific data. This format replaces the bulky file structure and difficult file management of ESRI GRIDS for EDEN data. It also allows EDEN applications to run on computers without <abbr title="Arc G I S">ArcGIS</abbr> installations.</p>
<p><a id="ncfile"></a>Each file contains 3 months (one quarter-year) of daily datasets. For example, the data for every day in 1992 will be stored in 4 files: 1992_q1_depth.nc, 1992_q2_depth.nc, 1992_q3_depth.nc, and 1992_q4_depth.nc.</p>
<table style="width:100%">
  <tr>
    <th colspan="5" class="pwtablehead"><abbr title="Net C D F">Water-Depth NetCDF</abbr> Files
      <p style="text-align:left">File naming conventions:</p>
      <ul style="text-align:left">
        <li>v# = version  of surface water model (v1 or v2),</li>
        <li>r# = release of surface (r1 or r2),</li>
        <li>prov = provisional</li>
      </ul>
      <p style="text-align:left">Note: You may download a year's worth of data all at once. Simply click the link below for each year.  Because of file size limits, the most you can download at one time is a year.  If you need to download several year's worth of data at once, please contact Bryan McCloskey (<a href="mailto:bmccloskey@usgs.gov">bmccloskey@usgs.gov</a>) and other arrangements can be made.</p>
    </th>
  </tr>
  <tr class="gvegtablehead">
    <th scope="col">Date</th>
    <th scope="col">1/1 - 3/31</th>
    <th scope="col">4/1 - 6/30</th>
    <th scope="col">7/1 - 9/30</th>
    <th scope="col">10/1 - 12/31</th>
  </tr>
  <tr class="gtablecell">
    <td colspan="5">1990: Not yet available. Extreme record low water conditions - will require additional analysis.</td>
  </tr>
  <tr class="gtablecell2" style="text-align:center">
    <td><a href="waterdepthmod-proc.php?year=1991&type=depth">1991</a><br>
      (zip, <?php echo round($size['depth'][1991]); ?> <abbr title="megabytes">MB</abbr>)</td>
    <td><a href="../data/depth/v2/1991_q1_depth_v2prov_r2.zip">1991 <abbr title="first quarter">Q1</abbr></a> (.zip)<br>
      <abbr title="version 2, provisional run 2">v2prov_r2</abbr>, October 2014</td>
    <td><a href="../data/depth/v2/1991_q2_depth_v2prov_r2.zip">1991 <abbr title="second quarter">Q2</abbr></a> (.zip)<br>
      <abbr title="version 2, provisional run 2">v2prov_r2</abbr>, October 2014</td>
    <td><a href="../data/depth/v2/1991_q3_depth_v2prov_r2.zip">1991 <abbr title="third quarter">Q3</abbr></a> (.zip)<br>
      <abbr title="version 2, provisional run 2">v2prov_r2</abbr>, October 2014</td>
    <td><a href="../data/depth/v2/1991_q4_depth_v2prov_r2.zip">1991 <abbr title="fourth quarter">Q4</abbr></a> (.zip)<br>
      <abbr title="version 2, provisional run 2">v2prov_r2</abbr>, October 2014</td>
  </tr>
  <tr class="gtablecell" style="text-align:center">
    <td><a href="waterdepthmod-proc.php?year=1992&type=depth">1992</a><br>
      (zip, <?php echo round($size['depth'][1992]); ?> <abbr title="megabytes">MB</abbr>)</td>
    <td><a href="../data/depth/v2/1992_q1_depth_v2prov_r2.zip">1992 <abbr title="first quarter">Q1</abbr></a> (.zip)<br>
      <abbr title="version 2, provisional run 2">v2prov_r2</abbr>, October 2014</td>
    <td><a href="../data/depth/v2/1992_q2_depth_v2prov_r2.zip">1992 <abbr title="second quarter">Q2</abbr></a> (.zip)<br>
      <abbr title="version 2, provisional run 2">v2prov_r2</abbr>, October 2014</td>
    <td><a href="../data/depth/v2/1992_q3_depth_v2prov_r2.zip">1992 <abbr title="third quarter">Q3</abbr></a> (.zip)<br>
      <abbr title="version 2, provisional run 2">v2prov_r2</abbr>, October 2014</td>
    <td><a href="../data/depth/v2/1992_q4_depth_v2prov_r2.zip">1992 <abbr title="fourth quarter">Q4</abbr></a> (.zip)<br>
      <abbr title="version 2, provisional run 2">v2prov_r2</abbr>, October 2014</td>
  </tr>
  <tr class="gtablecell2" style="text-align:center">
    <td><a href="waterdepthmod-proc.php?year=1993&type=depth">1993</a><br>
      (zip, <?php echo round($size['depth'][1993]); ?> <abbr title="megabytes">MB</abbr>)</td>
    <td><a href="../data/depth/v2/1993_q1_depth_v2prov_r2.zip">1993 <abbr title="first quarter">Q1</abbr></a> (.zip)<br>
      <abbr title="version 2, provisional run 2">v2prov_r2</abbr>, October 2014</td>
    <td><a href="../data/depth/v2/1993_q2_depth_v2prov_r2.zip">1993 <abbr title="second quarter">Q2</abbr></a> (.zip)<br>
      <abbr title="version 2, provisional run 2">v2prov_r2</abbr>, October 2014</td>
    <td><a href="../data/depth/v2/1993_q3_depth_v2prov_r2.zip">1993 <abbr title="third quarter">Q3</abbr></a> (.zip)<br>
      <abbr title="version 2, provisional run 2">v2prov_r2</abbr>, October 2014</td>
    <td><a href="../data/depth/v2/1993_q4_depth_v2prov_r2.zip">1993 <abbr title="fourth quarter">Q4</abbr></a> (.zip)<br>
      <abbr title="version 2, provisional run 2">v2prov_r2</abbr>, October 2014</td>
  </tr>
  <tr class="gtablecell" style="text-align:center">
    <td><a href="waterdepthmod-proc.php?year=1994&type=depth">1994</a><br>
      (zip, <?php echo round($size['depth'][1994]); ?> <abbr title="megabytes">MB</abbr>)</td>
    <td><a href="../data/depth/v2/1994_q1_depth_v2prov_r2.zip">1994 <abbr title="first quarter">Q1</abbr></a> (.zip)<br>
      <abbr title="version 2, provisional run 2">v2prov_r2</abbr>, October 2014</td>
    <td><a href="../data/depth/v2/1994_q2_depth_v2prov_r2.zip">1994 <abbr title="second quarter">Q2</abbr></a> (.zip)<br>
      <abbr title="version 2, provisional run 2">v2prov_r2</abbr>, October 2014</td>
    <td><a href="../data/depth/v2/1994_q3_depth_v2prov_r2.zip">1994 <abbr title="third quarter">Q3</abbr></a> (.zip)<br>
      <abbr title="version 2, provisional run 2">v2prov_r2</abbr>, October 2014</td>
    <td><a href="../data/depth/v2/1994_q4_depth_v2prov_r2.zip">1994 <abbr title="fourth quarter">Q4</abbr></a> (.zip)<br>
      <abbr title="version 2, provisional run 2">v2prov_r2</abbr>, October 2014</td>
  </tr>
  <tr class="gtablecellblue" style="text-align:center">
    <td colspan="5">You can also download water-depth NetCDF files via the <a href="http://sflthredds.er.usgs.gov"><strong>EDEN THREDDS</strong></a> server.</td>
  </tr>
  <tr class="gtablecell2" style="text-align:center">
    <td><a href="waterdepthmod-proc.php?year=1995&type=depth">1995</a><br>
      (zip, <?php echo round($size['depth'][1995]); ?> <abbr title="megabytes">MB</abbr>)</td>
    <td><a href="../data/depth/v2/1995_q1_depth_v2prov_r2.zip">1995 <abbr title="first quarter">Q1</abbr></a> (.zip)<br>
      <abbr title="version 2, provisional run 2">v2prov_r2</abbr>, October 2014</td>
    <td><a href="../data/depth/v2/1995_q2_depth_v2prov_r2.zip">1995 <abbr title="second quarter">Q2</abbr></a> (.zip)<br>
      <abbr title="version 2, provisional run 2">v2prov_r2</abbr>, October 2014</td>
    <td><a href="../data/depth/v2/1995_q3_depth_v2prov_r2.zip">1995 <abbr title="third quarter">Q3</abbr></a> (.zip)<br>
      <abbr title="version 2, provisional run 2">v2prov_r2</abbr>, October 2014</td>
    <td><a href="../data/depth/v2/1995_q4_depth_v2prov_r2.zip">1995 <abbr title="fourth quarter">Q4</abbr></a> (.zip)<br>
      <abbr title="version 2, provisional run 2">v2prov_r2</abbr>, October 2014</td>
  </tr>
  <tr class="gtablecell" style="text-align:center">
    <td><a href="waterdepthmod-proc.php?year=1996&type=depth">1996</a><br>
      (zip, <?php echo round($size['depth'][1996]); ?> <abbr title="megabytes">MB</abbr>)</td>
    <td><a href="../data/depth/v2/1996_q1_depth_v2prov_r2.zip">1996 <abbr title="first quarter">Q1</abbr></a> (.zip)<br>
      <abbr title="version 2, provisional run 2">v2prov_r2</abbr>, October 2014</td>
    <td><a href="../data/depth/v2/1996_q2_depth_v2prov_r2.zip">1996 <abbr title="second quarter">Q2</abbr></a> (.zip)<br>
      <abbr title="version 2, provisional run 2">v2prov_r2</abbr>, October 2014</td>
    <td><a href="../data/depth/v2/1996_q3_depth_v2prov_r2.zip">1996 <abbr title="third quarter">Q3</abbr></a> (.zip)<br>
      <abbr title="version 2, provisional run 2">v2prov_r2</abbr>, October 2014</td>
    <td><a href="../data/depth/v2/1996_q4_depth_v2prov_r2.zip">1996 <abbr title="fourth quarter">Q4</abbr></a> (.zip)<br>
      <abbr title="version 2, provisional run 2">v2prov_r2</abbr>, October 2014</td>
  </tr>
  <tr class="gtablecell2" style="text-align:center">
    <td><a href="waterdepthmod-proc.php?year=1997&type=depth">1997</a><br>
      (zip, <?php echo round($size['depth'][1997]); ?> <abbr title="megabytes">MB</abbr>)</td>
    <td><a href="../data/depth/v2/1997_q1_depth_v2prov_r2.zip">1997 <abbr title="first quarter">Q1</abbr></a> (.zip)<br>
      <abbr title="version 2, provisional run 2">v2prov_r2</abbr>, October 2014</td>
    <td><a href="../data/depth/v2/1997_q2_depth_v2prov_r2.zip">1997 <abbr title="second quarter">Q2</abbr></a> (.zip)<br>
      <abbr title="version 2, provisional run 2">v2prov_r2</abbr>, October 2014</td>
    <td><a href="../data/depth/v2/1997_q3_depth_v2prov_r2.zip">1997 <abbr title="third quarter">Q3</abbr></a> (.zip)<br>
      <abbr title="version 2, provisional run 2">v2prov_r2</abbr>, October 2014</td>
    <td><a href="../data/depth/v2/1997_q4_depth_v2prov_r2.zip">1997 <abbr title="fourth quarter">Q4</abbr></a> (.zip)<br>
      <abbr title="version 2, provisional run 2">v2prov_r2</abbr>, October 2014</td>
  </tr>
  <tr class="gtablecell" style="text-align:center">
    <td><a href="waterdepthmod-proc.php?year=1998&type=depth">1998</a><br>
      (zip, <?php echo round($size['depth'][1998]); ?> <abbr title="megabytes">MB</abbr>)</td>
    <td><a href="../data/depth/v2/1998_q1_depth_v2prov_r2.zip">1998 <abbr title="first quarter">Q1</abbr></a> (.zip)<br>
      <abbr title="version 2, provisional run 2">v2prov_r2</abbr>, October 2014</td>
    <td><a href="../data/depth/v2/1998_q2_depth_v2prov_r2.zip">1998 <abbr title="second quarter">Q2</abbr></a> (.zip)<br>
      <abbr title="version 2, provisional run 2">v2prov_r2</abbr>, October 2014</td>
    <td><a href="../data/depth/v2/1998_q3_depth_v2prov_r2.zip">1998 <abbr title="third quarter">Q3</abbr></a> (.zip)<br>
      <abbr title="version 2, provisional run 2">v2prov_r2</abbr>, October 2014</td>
    <td><a href="../data/depth/v2/1998_q4_depth_v2prov_r2.zip">1998 <abbr title="fourth quarter">Q4</abbr></a> (.zip)<br>
      <abbr title="version 2, provisional run 2">v2prov_r2</abbr>, October 2014</td>
  </tr>
  <tr class="gtablecell2" style="text-align:center">
    <td><a href="waterdepthmod-proc.php?year=1999&type=depth">1999</a><br>
      (zip, <?php echo round($size['depth'][1999]); ?> <abbr title="megabytes">MB</abbr>)</td>
    <td><a href="../data/depth/v2/1999_q1_depth_v2prov_r2.zip">1999 <abbr title="first quarter">Q1</abbr></a> (.zip)<br>
      <abbr title="version 2, provisional run 2">v2prov_r2</abbr>, October 2014</td>
    <td><a href="../data/depth/v2/1999_q2_depth_v2prov_r2.zip">1999 <abbr title="second quarter">Q2</abbr></a> (.zip)<br>
      <abbr title="version 2, provisional run 2">v2prov_r2</abbr>, October 2014</td>
    <td><a href="../data/depth/v2/1999_q3_depth_v2prov_r2.zip">1999 <abbr title="third quarter">Q3</abbr></a> (.zip)<br>
      <abbr title="version 2, provisional run 2">v2prov_r2</abbr>, October 2014</td>
    <td><a href="../data/depth/v2/1999_q4_depth_v2prov_r2.zip">1999 <abbr title="fourth quarter">Q4</abbr></a> (.zip)<br>
      <abbr title="version 2, provisional run 2">v2prov_r2</abbr>, October 2014</td>
  </tr>
  <tr class="gtablecell">
    <td colspan="5">
      <strong><a href="water_depth.php">2000 - Current</a> available on separate page</strong>
    </td>
  </tr>
  <tr class="gvegtablehead">
    <td colspan="5"><strong>Additional Documentation:</strong>
      <ul>
        <li><a href="release_notes_watersurfaces.php">Surface-Water Model Release Notes</a> (for <abbr title="version 1">V1</abbr> and <abbr title="version 2">V2</abbr> of the surface-water model)</li>
        <li><a href="wsreleaselog.php">Water-Surface Release Log</a></li>
        <li><a href="../../metadata/sflwww/water_depth.html">Metadata - EDEN Water-Depth Data</a></li>
        <li><a href="../edenapps/EDEN_NetCDF_Data_Format.pdf">EDEN <abbr title="Net C D F">NetCDF</abbr> Data Format</a> (.pdf, 4 <abbr title="kilobytes">KB</abbr>)</li>
        <li><a href="../edenapps/Quick_Guide_Using_EDEN_NetCDF_Files_ArcGIS.pdf">A Quick Guide to Using EDEN <abbr title="Net C D F">NetCDF</abbr> Files in <abbr title="Arc G I S">ArcGIS</abbr> 9.2</a> (.pdf, 62 <abbr title="kilobytes">KB</abbr>)</li>
      </ul>
    </td>
  </tr>
</table>
<?php require ($_SERVER['DOCUMENT_ROOT'] . '/../eden/ssi/eden-foot.php'); ?>