<?php
$size = $files = array('netcdf' => array(), 'geotiff' => array(), 'dailymedian' => array());
$o = array(1 => 'first', 2 => 'second', 3 => 'third', 4 => 'fourth');
foreach ($size as $a => $b) {
	for ($i = 2; $i <= 3; $i++) {
		$dir = "/var/www/eden/data/$a/v$i";
		if ($handle = opendir($dir)) {
			while (false !== ($file = readdir($handle)))
				if (preg_match("/^[0-9]{4}_q[1-4]{1}_[A-Za-z0-9_]{2,}\.zip$/", $file)) {
					$q = substr($file, 6, 1);
					$size[$a][substr($file, 0, 4)] += filesize($dir . '/' . $file) / 1048576;
					$files[$a][substr($file, 0, 4)][$q] = $dir . '/' . $file;
				}
			closedir($handle);
		}
	}
	$dir = '/var/www/eden/data/realtime2';
	if ($handle = opendir($dir)) {
		while (false !== ($file = readdir($handle)))
			if (preg_match("/^2[0-9]{3}_q[1-4]{1}_v3rt_nc\.zip$/", $file)) {
				$q = substr($file, 6, 1);
				$size[$a][substr($file, 0, 4)] += 0;
				$files[$a][substr($file, 0, 4)][$q] = 'realtime';
			}
		closedir($handle);
	}
	krsort($files[$a]);
  ${$a . '_tbl'} = '';
  foreach ($files[$a] as $c => $d) {
    if ($c == 1999)
      ${$a . '_tbl'} .= "  <tr class='pwtablehead'>
    <td style='text-align:center' colspan='5'><a onClick='toggle();' style='text-decoration:underline'>toggle 1990-1999</a> <a href='watersurfacemod_download_1990s.php'><strong>(hindcast data quality information)</strong></a></td>
  </tr>\n";
		$odd = $c % 2 ? '2' : '';
		${$a . '_tbl'} .= "<tr class='gtablecell$odd" . ($c < 2000 ? " hidethis' style='display:none;'" : '') . "'><td>";
		${$a . '_tbl'} .= $size[$a][$c] ? "<a href='watersurfacemod-proc.php?year=$c&type=$a'>$c</a><br>(zip, " . round($size[$a][$c]) . " <abbr title='megabytes'>MB</abbr>)" : $c;
		${$a . '_tbl'} .= "</td>\n";
  	for ($i = 1; $i <= 4; $i++) {
  		if (!array_key_exists($i, $d))
  			${$a . '_tbl'} .=  "<td></td>\n";
  		elseif ($d[$i] == 'realtime')
  			${$a . '_tbl'} .=  "<td style='background-color:#f1b7a6'><a href='real-time.php'><strong>Real-Time Data</strong></a></td>\n";
  		else {
        $v = explode('_', $d[$i]);
    		$v = explode('.', end($v));
    		$v1 = strpos($v[0], 'prov') ? str_replace('prov', ', provisional', $v[0]) : $v[0];
    		$v1 = preg_replace('/^v/', 'version ', $v1, 1);
			  $v2 = str_replace('prov', '<strong>prov</strong>', $v[0]);
    		${$a . '_tbl'} .=  "<td><a href='../" . substr($d[$i], 14) . "'>$c <abbr title='$o[$i] quarter'>Q$i</abbr></a> (zip, " . round(filesize($d[$i]) / 1048576, 1) . " <abbr title='megabytes'>MB</abbr>)<br><abbr title='$v1'>$v2</abbr></td>\n";
    	}
  	}
		${$a . '_tbl'} .=  "</tr>\n";
	}
}
$title = "<title>Download Water Level Data - Everglades Depth Estimation Network (EDEN)</title>\n";
$script = "<script>
function toggle() {
  var x = document.getElementsByClassName('hidethis');
  for (var i = 0; i < x.length; i++) {
    if (x[i].style.display == 'none') {
      x[i].style.display = 'table-row';
    } else {
     x[i].style.display = 'none';
    }
  }
}
</script>\n";
require ($_SERVER['DOCUMENT_ROOT'] . '/../eden/ssi/eden-head.php');
?>
<h2>Download Water Level Data</h2>
<img src="../images/maps/watersurfacesV2sm.jpg" alt="sample graphic of a version2 water level surface map" height="216" width="153" style="float:right">
<p>Data for modeled EDEN water level surfaces are available in two different formats:</p>
<ul>
  <li><a href="#netcdf"><abbr title="Net C D F">NetCDF</abbr></a></li>
  <li><a href="#geotiff">GeoTiff</a></li>
</ul>
<p>A daily median file provides users with a list of gages and data used to generate the day's water-level surface. Metadata for the water-level surfaces is also provided.</p>
<ul>
  <li><a href="#dmsoutput">daily median output file</a></li>
  <li><a href="https://archive.usgs.gov/archive/sites/sofia.usgs.gov/metadata/sflwww/eden_water_surfs.html">metadata (for water level surfaces)</a></li>
</ul>
<h3><a id="netcdf"></a><abbr title="Net C D F">NetCDF</abbr> Files:</h3>
<p><abbr title="Net C D F">NetCDF</abbr> (Network Common Data Form) is a set of freely-distributed software libraries and machine-independent binary data formats that support the creation, access, and sharing of large array-oriented scientific data. This format replaces the bulky file structure and difficult file management of ESRI GRIDS for EDEN data. It also allows EDEN applications to run on computers without <abbr title="Arc G I S">ArcGIS</abbr> installations.</p>
<p>Each file contains 3 months (one quarter-year) of daily datasets. For example, the data for every day in 2020 will be stored in 4 files: 2020_q1.nc, 2020_q2.nc, 2020_q3.nc, and 2020_q4.nc. In addition, each zip file contains a <a href="release_notes_watersurfaces.php">readme file which contains brief information about release notes</a> related to this data release.</p>
<table style="width:100%;text-align:center">
  <tr>
    <th colspan="5" class="grtablehead"><abbr title="Net C D F">NetCDF</abbr> Files
      <p style="text-align:left">File naming conventions:</p>
      <ul style="text-align:left">
        <li>v# = version of water level surface model (v2 or v3),</li>
        <li>prov = provisional,</li>
        <li>rt = real-time</li>
      </ul>
      <p style="text-align:left">Note: You may download a year's worth of data all at once. Simply click the link below for each year. Because of file size limits, the most you can download at one time is a year. If you need to download several year's worth of data at once, please contact Bryan McCloskey (<a href="mailto:bmccloskey@usgs.gov">bmccloskey@usgs.gov</a>) and other arrangements can be made.</p>
    </th>
  </tr>
  <tr class="gvegtablehead">
    <th scope="col">Date</th>
    <th scope="col">1/1 - 3/31</th>
    <th scope="col">4/1 - 6/30</th>
    <th scope="col">7/1 - 9/30</th>
    <th scope="col">10/1 - 12/31</th>
  </tr>
  <tr class="gtablecellblue">
    <td colspan="5" style="padding:30px">You can also download water-level surface <abbr title="Net C D F">NetCDF</abbr> files via the <a href="http://sflthredds.er.usgs.gov"><strong>EDEN THREDDS</strong></a> server.</td>
  </tr>
<?php echo $netcdf_tbl; ?>
  <tr class="gvegtablehead">
    <td colspan="5"><strong>Additional Documentation for EDEN <abbr title="Net C D F">NetCDF</abbr> Files:</strong>
      <ul style="text-align:left">
        <li><a href="https://archive.usgs.gov/archive/sites/sofia.usgs.gov/metadata/sflwww/eden_water_surfs.html">Metadata</a></li>
        <li><a href="https://www.jem.gov/Tools/EverView">NetCDF files can be easily viewed using the EverView Data Viewer</a></li>
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
        <li>v# = version  of water level surface model (v2 or v3),</li>
        <li>prov = provisional,</li>
        <li>rt = real-time</li>
      </ul>
      <p style="text-align:left">Note: You may download a year's worth of data all at once. Simply click the link below for each year. Because of file size limits, the most you can download at one time is a year. If you need to download several year's worth of data at once, please contact Bryan McCloskey (<a href="mailto:bmccloskey@usgs.gov">bmccloskey@usgs.gov</a>) and other arrangements can be made.</p>
    </th>
  </tr>
  <tr class="gvegtablehead">
    <th scope="col">Date</th>
    <th scope="col">1/1 - 3/31</th>
    <th scope="col">4/1 - 6/30</th>
    <th scope="col">7/1 - 9/30</th>
    <th scope="col">10/1 - 12/31</th>
  </tr>
<?php echo $geotiff_tbl; ?>
  <tr class="gvegtablehead">
    <td colspan="5"><strong>Additional Documentation for EDEN Geotiff Files:</strong>
      <ul style="text-align:left">
        <li><a href="https://archive.usgs.gov/archive/sites/sofia.usgs.gov/metadata/sflwww/eden_water_surfs.html">Metadata</a></li>
      </ul>
    </td>
  </tr>
</table>
<h3><a id="dmsoutput"></a>Daily Median Output File</h3>
<p>Each zip file contains 3 months (one quarter-year) of daily median files. Prior to 5/14/12, two files are generated each day; &quot;median&quot; and &quot;median_reject&quot;. Starting 5/14/12, a single daily median file combines the information in the previous two files. A <a href="#dm_read_me">readme file</a> is included with each zip file that includes a short description of each file.</p>
<table style="width:100%;text-align:center">
  <tr>
    <th colspan="5" class="grtablehead">Daily Median Output File
      <p style="text-align:left">File naming conventions:</p>
      <ul style="text-align:left">
        <li>v# = version  of water level surface model (v2 or v3),</li>
        <li>prov = provisional,</li>
        <li>rt = real-time</li>
      </ul>
      <p style="text-align:left">Note: You may download a year's worth of data all at once. Simply click the link below for each year. Because of file size limits, the most you can download at one time is a year. If you need to download several year's worth of data at once, please contact Bryan McCloskey (<a href="mailto:bmccloskey@usgs.gov">bmccloskey@usgs.gov</a>) and other arrangements can be made.</p>
    </th>
  </tr>
  <tr class="gvegtablehead">
    <th scope="col">Date</th>
    <th scope="col">1/1 - 3/31</th>
    <th scope="col">4/1 - 6/30</th>
    <th scope="col">7/1 - 9/30</th>
    <th scope="col">10/1 - 12/31</th>
  </tr>
<?php echo $dailymedian_tbl; ?>
</table>
<?php require ($_SERVER['DOCUMENT_ROOT'] . '/../eden/ssi/eden-foot.php'); ?>