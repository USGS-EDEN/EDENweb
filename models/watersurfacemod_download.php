<?php
$size = $files = array('netcdf' => array(), 'geotiff' => array(), 'dailymedian' => array());
$o = array(1 => 'first', 2 => 'second', 3 => 'third', 4 => 'fourth');
foreach($size as $a => $b) {
	for ($i = 2; $i <= 3; $i++) {
		$dir = "/export1/htdocs/eden/data/$a/v$i";
		if ($handle = opendir($dir)) {
			while (false !== ($file = readdir($handle)))
				if (preg_match("/^2[0-9]{3}_q[1-4]{1}_[A-Za-z0-9_]{2,}\.zip$/", $file)) {
					$q = substr($file, 6, 1);
					$size[$a][substr($file, 0, 4)] += filesize($dir . '/' . $file) / 1048576;
					$files[$a][substr($file, 0, 4)][$q] = $dir . '/' . $file;
				}
			closedir($handle);
		}
	}
	$dir = '/export1/htdocs/eden/data/realtime2';
	if ($handle = opendir($dir)) {
		while (false !== ($file = readdir($handle)))
			if (preg_match("/^2[0-9]{3}_q[1-4]{1}_v3rt_nc\.zip$/", $file)) {
				$q = substr($file, 6, 1);
				$size[$a][substr($file, 0, 4)] += 0;
				$files[$a][substr($file, 0, 4)][$q] = 'realtime';
			}
		closedir($handle);
	}
	ksort($files[$a]);
	foreach ($files[$a] as $c => $d) {
		$odd = $c % 2 ? '2' : '';
		${$a . '_tbl'} .= "<tr class='gtablecell$odd'><td>";
		${$a . '_tbl'} .= $size[$a][$c] ? "<a href='watersurfacemod-proc.php?year=$c&type=$a'>$c</a><br>(zip, " . round($size[$a][$c]) . " <abbr title='megabytes'>MB</abbr>)" : $c;
		${$a . '_tbl'} .= "</td>\n";
    	for ($i = 1; $i <= 4; $i++) {
    		if (!$d[$i])
    			${$a . '_tbl'} .=  "<td></td>\n";
    		elseif ($d[$i] == 'realtime')
    			${$a . '_tbl'} .=  "<td style='background-color:#f1b7a6'><a href='real-time.php'><strong>Real-Time Data</strong></a></td>\n";
    		else {
	    		$v = explode('.', end(explode('_', $d[$i])));
	    		$v1 = strpos($v[0], 'prov') ? str_replace('prov', ', provisional', $v[0]) : str_replace('r', ', release ', $v[0]);
	    		$v1 = preg_replace('/^v/', 'version ', $v1, 1);
				$v2 = str_replace('prov', '<strong>prov</strong>', $v[0]);
				$ft = date('F Y', filemtime($d[$i]));
	    		${$a . '_tbl'} .=  "<td><a href='" . substr($d[$i], 15) . "'>$c <abbr title='$o[$i] quarter'>Q$i</abbr></a> (zip, " . round(filesize($d[$i]) / 1048576, 1) . " <abbr title='megabytes'>MB</abbr>)<br><abbr title='$v1'>$v2</abbr>, $ft</td>\n";
	    	}
    	}
		${$a . '_tbl'} .=  "</tr>\n";
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Download Water Surfaces Data - Everglades Depth Estimation Network (EDEN)</title>
  <link rel="stylesheet" href="/eden/css/eden-dbweb-html5.css">
  <script src="https://www.usgs.gov/scripts/analytics/usgs-analytics.js"></script>
  <style>
    table { border-collapse: collapse }
    table, td, th { border: 1px solid #477489 }
    td, th { padding: 2px }
  </style>
</head>
<body>
<div id='PopUp' style='position:absolute;top:200px;left:100px;z-index:1000;border:solid black 1px;padding:50px;background-color:rgb(200,200,225);font-size:16px;font-weight:bold;width:500px;font-family:Arial;text-align:left' onclick="document.getElementById('PopUp').style.display='none';">
  <span id='PopUpText'>Notice: Starting July 1st, 2019, a newly revised EDEN surface water model (V3) is being used to create EDEN real-time surfaces. As with V2 surfaces, real-time data is considered provisional and may be subject to revision.
  <br><br>The EDEN project is in the process of releasing a new publication which will document V3 of the model.  The report will specify which updates and modifications were made, as well as identify the differences between the two models.  Overall, the differences between V2 and V3 surfaces are minor.<br><br><br><span style='font-size:14px;color:red'>Click to dismiss.</span></span>
</div>
<?php require ($_SERVER['DOCUMENT_ROOT'] . '/eden/ssi/eden-head.txt'); ?>
<?php require ($_SERVER['DOCUMENT_ROOT'] . '/eden/ssi/nav.php'); ?>
<div style="overflow:hidden;padding-right:8px;background-color:white"><!--Begin body of page -->
<h2>Download Water Surfaces Data</h2>
<img src="../images/maps/watersurfacesV2sm.jpg" alt="sample graphic of a version2 water surface map" height="216" width="153" style="float:right">
<p>Data for modeled EDEN water surfaces are available in two different formats:</p>
<ul>
  <li><a href="#netcdf"><abbr title="Net C D F">NetCDF</abbr></a></li>
  <li><a href="#geotiff">GeoTiff</a></li>
</ul>
<p>A daily median file (two files prior to 5/14/12) provides users with a list of gages and data used to generate the day's water-level surface. Metadata for the water-level surfaces is also provided.</p>
<ul>
  <li><a href="#dmsoutput">daily median output file</a></li>
  <li><a href="https://archive.usgs.gov/archive/sites/sofia.usgs.gov/metadata/sflwww/eden_water_surfs.html">metadata (for water surfaces)</a></li>
</ul>
<h3><a id="netcdf"></a><abbr title="Net C D F">NetCDF</abbr> Files:</h3>
<p><abbr title="Net C D F">NetCDF</abbr> (Network Common Data Form) is a set of freely-distributed software libraries and machine-independent binary data formats that support the creation, access, and sharing of large array-oriented scientific data. This format replaces the bulky file structure and difficult file management of ESRI GRIDS for EDEN data. It also allows EDEN applications to run on computers without <abbr title="Arc G I S">ArcGIS</abbr> installations.</p>
<p>Each file contains 3 months (one quarter-year) of daily datasets. For example, the data for every day in 2002 will be stored in 4 files: 2002_q1.nc, 2002_q2.nc, 2002_q3.nc, and 2002_q4.nc. In addition, each zip file contains a <a href="release_notes_watersurfaces.php">readme file which contains brief information about release notes</a> related to this data release.</p>
<table style="width:100%;text-align:center">
  <tr>
    <th colspan="5" class="grtablehead"><abbr title="Net C D F">NetCDF</abbr> Files
      <p style="text-align:left">File naming conventions:</p>
      <ul style="text-align:left">
        <li>v# = version  of surface water model (v1, v2, or v3),</li>
        <li>r# = release of surface (r1, r2, or r3),</li>
        <li>prov = provisional,</li>
        <li>rt = real-time</li>
      </ul>
      <p style="text-align:left">Note: Dates below the links to quarterly files indicate the month and year the data was processed. You may download a year's worth of data all at once. Simply click the link below for each year. Because of file size limits, the most you can download at one time is a year. If you need to download several year's worth of data at once, please contact Heather Henkel (<a href="mailto:hhenkel@usgs.gov">hhenkel@usgs.gov</a>) and other arrangements can be made.</p>
    </th>
  </tr>
  <tr class="gvegtablehead">
    <th scope="col">Date</th>
    <th scope="col">1/1 - 3/31</th>
    <th scope="col">4/1 - 6/30</th>
    <th scope="col">7/1 - 9/30</th>
    <th scope="col">10/1 - 12/31</th>
  </tr>
  <tr class="gtablecell2">
    <td><a href="watersurfacemod_download_1990s.php"><strong>1990-<br>1999</strong></a></td>
    <td colspan="4"><a href="watersurfacemod_download_1990s.php"><strong>data available</strong></a> on a separate page</td>
  </tr>
  <tr class="gtablecellblue">
    <td colspan="5" style="padding:30px">You can also download water-surface <abbr title="Net C D F">NetCDF</abbr> files via the <a href="http://sflthredds.er.usgs.gov"><strong>EDEN THREDDS</strong></a> server.</td>
  </tr>
<?php echo $netcdf_tbl; ?>
  <tr class="grytablehead">
    <td colspan="5"><a href="watersurfacemod-archive.php">Archived <abbr title="Net C D F">NetCDF</abbr> Files</a></td>
  </tr>
  <tr class="gvegtablehead">
    <td colspan="5"><strong>Additional Documentation for EDEN <abbr title="Net C D F">NetCDF</abbr> Files:</strong>
      <ul style="text-align:left">
        <li><a href="release_notes_watersurfaces.php">Release Notes</a> (for <abbr title="version 1">V1</abbr> and <abbr title="version 2">V2</abbr> of the surfaces)</li>
        <li><a href="wsreleaselog.php">Release Log</a></li>
        <li><a href="https://archive.usgs.gov/archive/sites/sofia.usgs.gov/metadata/sflwww/eden_water_surfs.html">Metadata</a></li>
        <li><a href="../edenapps/EDEN_NetCDF_Data_Format.pdf">EDEN <abbr title="Net C D F">NetCDF</abbr> Data Format</a> (.pdf, 4 <abbr title="kilobytes">KB</abbr>)</li>
        <li><a href="../edenapps/Quick_Guide_Using_EDEN_NetCDF_Files_ArcGIS.pdf">A Quick Guide to Using EDEN <abbr title="Net C D F">NetCDF</abbr> Files in <abbr title="Arc G I S">ArcGIS</abbr> 9.2</a> (.pdf, 62 <abbr title="kilobytes">KB</abbr>)</li>
      </ul>
    </td>
  </tr>
</table>
<h3><a id="geotiff"></a>GeoTiff</h3>
<p>Each zip file contains 3 months (one quarter-year) of georeferenced tiff files. For each day, there are two files: a .tif and a .aux file. Both are needed in order to view the file properly.</p>
<table style="width:100%;text-align:center">
  <tr>
    <th colspan="5" class="grtablehead">GeoTiff Files
      <p style="text-align:left">File naming conventions:</p>
      <ul style="text-align:left">
        <li>v# = version  of surface water model (v1, v2, or v3),</li>
        <li>r# = release of surface (r1, r2, or r3),</li>
        <li>prov = provisional,</li>
        <li>rt = real-time</li>
      </ul>
      <p style="text-align:left">Note: Dates below the links to quarterly files indicate the month and year the data was processed. You may download a year's worth of data all at once. Simply click the link below for each year. Because of file size limits, the most you can download at one time is a year. If you need to download several year's worth of data at once, please contact Heather Henkel (<a href="mailto:hhenkel@usgs.gov">hhenkel@usgs.gov</a>) and other arrangements can be made.</p>
    </th>
  </tr>
  <tr class="gvegtablehead">
    <th scope="col">Date</th>
    <th scope="col">1/1 - 3/31</th>
    <th scope="col">4/1 - 6/30</th>
    <th scope="col">7/1 - 9/30</th>
    <th scope="col">10/1 - 12/31</th>
  </tr>
  <tr class="gtablecell2">
    <td><a href="watersurfacemod_download_1990s.php"><strong>1990-<br>1999</strong></a></td>
    <td colspan="4"><a href="watersurfacemod_download_1990s.php"><strong>data available</strong></a> on a separate page</td>
  </tr>
<?php echo $geotiff_tbl; ?>
  <tr class="grytablehead">
    <td colspan="5"><a href="watersurfacemod-archive.php">Archived GeoTiff Files</a></td>
  </tr>
  <tr class="gvegtablehead">
    <td colspan="5"><strong>Additional Documentation for EDEN Geotiff Files:</strong>
      <ul style="text-align:left">
        <li><a href="https://archive.usgs.gov/archive/sites/sofia.usgs.gov/metadata/sflwww/eden_water_surfs.html">Metadata</a></li>
      </ul>
    </td>
  </tr>
</table>
<h3><a id="dmsoutput"></a>Daily Median Output File</h3>
<p>Each zip file contains 3 months (one quarter-year) of daily median files. Prior to 5/14/12, two files are generated each data; &quot;median&quot; and &quot;median_reject&quot;. Starting 5/14/12, a single daily median file combines the information in the previous two files. A <a href="#dm_read_me">readme file</a> is included with each zip file that includes a short description of each file.</p>
<table style="width:100%;text-align:center">
  <tr>
    <th colspan="5" class="grtablehead">Daily Median Output File
      <p style="text-align:left">File naming conventions:</p>
      <ul style="text-align:left">
        <li>v# = version  of surface water model (v1, v2, or v3),</li>
        <li>r# = release of surface (r1, r2, or r3),</li>
        <li>prov = provisional,</li>
        <li>rt = real-time</li>
      </ul>
      <p style="text-align:left">Note: Dates below the links to quarterly files indicate the month and year the data was processed. You may download a year's worth of data all at once. Simply click the link below for each year. Because of file size limits, the most you can download at one time is a year. If you need to download several year's worth of data at once, please contact Heather Henkel (<a href="mailto:hhenkel@usgs.gov">hhenkel@usgs.gov</a>) and other arrangements can be made.</p>
    </th>
  </tr>
  <tr class="gvegtablehead">
    <th scope="col">Date</th>
    <th scope="col">1/1 - 3/31</th>
    <th scope="col">4/1 - 6/30</th>
    <th scope="col">7/1 - 9/30</th>
    <th scope="col">10/1 - 12/31</th>
  </tr>
  <tr class="gtablecell2">
    <td><a href="watersurfacemod_download_1990s.php"><strong>1990-<br>1999</strong></a></td>
    <td colspan="4"><a href="watersurfacemod_download_1990s.php"><strong>data available</strong></a> on a separate page</td>
  </tr>
<?php echo $dailymedian_tbl; ?>
  <tr class="gvegtablehead">
    <td colspan="5"><a id="dm_read_me"></a><strong>Additional Documentation for Daily Median Output Files:</strong>
      <ul style="text-align:left">
        <li><a href="daily_median_readme_v2_051412.txt">Release Notes</a> (for daily median files (&quot;median_flag&quot;) created <strong>after 5/14/12</strong>)</li>
        <li><a href="daily_median_readme_v2.txt">Release Notes</a> (for daily median files (&quot;median&quot; and &quot;median_reject&quot;) created <strong>prior to 5/14/12</strong>)</li>
      </ul>
    </td>
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