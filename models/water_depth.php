<?php
$size = $files = array();
$o = array(1 => 'first', 2 => 'second', 3 => 'third', 4 => 'fourth');
for ($i = 2; $i <= 3; $i++) {
	$dir = "/var/www/eden/data/depth/v$i";
	if ($handle = opendir($dir)) {
		while (false !== ($file = readdir($handle)))
			if (preg_match("/^[0-9]{4}_q[1-4]{1}_depth_[A-Za-z0-9_]{2,}\.zip$/", $file)) {
        $q = substr($file, 6, 1);
				$size[substr($file, 0, 4)] += filesize($dir . '/' . $file) / 1048576;
        $files[substr($file, 0, 4)][$q] = $dir . '/' . $file;
      }
		closedir($handle);
	}
}
$dir = '/var/www/eden/data/realtime2';
if ($handle = opendir($dir)) {
  while (false !== ($file = readdir($handle)))
    if (preg_match("/^2[0-9]{3}_q[1-4]{1}_v3rt_depth_nc\.zip$/", $file)) {
      $q = substr($file, 6, 1);
      $size[substr($file, 0, 4)] += 0;
      $files[substr($file, 0, 4)][$q] = 'realtime';
    }
  closedir($handle);
}
krsort($files);
$tbl = '';
foreach ($files as $c => $d) {
  if ($c == 1999)
    $tbl .= "  <tr class='pwtablehead'>
    <td style='text-align:center' colspan='5'><a onClick='toggle();' style='text-decoration:underline'>toggle 1990-1999</a> <a href='watersurfacemod_download_1990s.php'><strong>(hindcast data quality information)</strong></a></td>
  </tr>\n";
  $odd = $c % 2 ? '2' : '';
  $tbl .= "<tr class='gtablecell$odd" . ($c < 2000 ? " hidethis' style='display:none;'" : '') . "'><td>";
  $tbl .= $size[$c] ? "<a href='watersurfacemod-proc.php?year=$c&type=depth'>$c</a><br>(zip, " . round($size[$c]) . " <abbr title='megabytes'>MB</abbr>)" : $c;
  $tbl .= "</td>\n";
  for ($i = 1; $i <= 4; $i++) {
    if (!array_key_exists($i, $d))
      $tbl .=  "<td></td>\n";
    elseif ($d[$i] == 'realtime')
      $tbl .=  "<td style='background-color:#f1b7a6'><a href='real-time.php'><strong>Real-Time Data</strong></a></td>\n";
    else {
      $v = explode('_', $d[$i]);
      $v = explode('.', end($v));
      $v1 = strpos($v[0], 'prov') ? str_replace('prov', ', provisional', $v[0]) : $v[0];
      $v1 = preg_replace('/^v/', 'version ', $v1, 1);
      $v2 = str_replace('prov', '<strong>prov</strong>', $v[0]);
      $tbl .=  "<td><a href='../" . substr($d[$i], 14) . "'>$c <abbr title='$o[$i] quarter'>Q$i</abbr></a> (zip, " . round(filesize($d[$i]) / 1048576, 1) . " <abbr title='megabytes'>MB</abbr>)<br><abbr title='$v1'>$v2</abbr></td>\n";
    }
  }
  $tbl .=  "</tr>\n";
}
$title = "<title>Download Water Depth Data - Everglades Depth Estimation Network (EDEN)</title>\n";
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
<h2>Water-Depth Data</h2>
<p>Users can obtain two types of water-depth data using EDEN:</p>
<ul>
  <li><a href="#dailymaps">Daily water-depth maps</a></li>
  <li><a href="#timeseries">Time series</a><a href="#dailymaps"></a> of water depths for specific (user-defined) locations</li>
</ul>
<h3><a id="dailymaps"></a>Daily Maps of Water Depth</h3>
<div style="width:190px;border:3px #4b7e83 solid;float:right;background-color:#e5f4cc;margin-bottom:20px">
  <img src="../images/maps/depth_map_example.jpg" alt="Example of EDEN water-depth map" height="250" width="176" style="border:1px black solid;margin:3px 6px">
  <p style="margin:3px 3px">Example EDEN water-depth map.</p>
</div>
<p>Users can download daily water-depth maps 1) in the table below and 2) through the <a href="http://sflthredds.er.usgs.gov/">EDEN THREDDS Data Server</a>. The EDEN project also provides a tool, <a href="../edenapps/depth-dayssincedry.php"><abbr title="Depth and Days Since Dry">Depth&amp;DaysSinceDry</abbr></a>, that allows users to create their own daily water-depth maps by using the EDEN water surface and ground elevation model (DEM) netCDF files. Daily water-depth maps are computed by subtracting the ground elevation from the daily water level for each EDEN grid cell (400 meters by 400 meters); negative water level values are shifted to zero.</p>
<ul>
  <li>Daily water-depth maps (1991-present) - download below</li>
  <li><a href="http://sflthredds.er.usgs.gov/">THREDDS Data Server</a></li>
  <li><a href="../edenapps/depth-dayssincedry.php"><abbr title="Depth and Days Since Dry">Depth&amp;DaysSinceDry</abbr> tool</a></li>
</ul>
<p><abbr title="Net C D F">EDEN surfaces are served mainly as NetCDF</abbr> (Network Common Data Form) files, a set of freely-distributed software libraries and machine-independent binary data formats that support the creation, access, and sharing of large array-oriented scientific data. Each file contains 3 months (one quarter-year) of daily datasets. For example, the data for every day in 2020 will be stored in 4 files: 2020_q1_depth.nc, 2020_q2_depth.nc, 2020_q3_depth.nc, and 2020_q4_depth.nc.</p>
<table style="width:100%;text-align:center">
  <tr>
    <th colspan="5" class="pwtablehead" style="text-align:left">Water-Depth <abbr title="Net C D F">NetCDF</abbr> Files
      <p style="text-align:left">File naming conventions:</p>
      <ul style="text-align:left">
        <li>v# = version  of surface water model (v2 or v3),</li>
        <li>prov = provisional,</li>
        <li>rt = real-time</li>
      </ul>
      <p style="text-align:left">Note: You may download a year's worth of data all at once. Simply click the link below for each year. Because of file size limits, the most you can download at one time is a year. If you need to download several year's worth of data at once, please contact Bryan McCloskey (<a href="mailto:bmccloksey@usgs.gov">bmccloskey@usgs.gov</a>) and other arrangements can be made.</p>
    </th>
  </tr>
  <tr class="gvegtablehead">
    <th scope="col">Date</th>
    <th scope="col">1/1 - 3/31</th>
    <th scope="col">4/1 - 6/30</th>
    <th scope="col">7/1 - 9/30</th>
    <th scope="col">10/1 - 12/31</th>
  </tr>
<?php echo $tbl; ?>
  <tr class="gvegtablehead">
    <td colspan="5"><strong>Additional Documentation:</strong>
      <ul style="text-align:left">
        <li><a href="https://archive.usgs.gov/archive/sites/sofia.usgs.gov/metadata/sflwww/water_depth.html">Metadata - EDEN Water-Depth Data</a></li>
        <li><a href="https://www.jem.gov/Tools/EverView">EverVIEW Data Viewer</a></li>
      </ul>
    </td>
  </tr>
</table>
<h3><a id="timeseries"></a>Time Series of Water-Depth Data</h3>
<p>Using the <a href="../edenapps/xylocator.php"><strong>xyLocator tool</strong></a>, users can extract water-depth data for specific x, y locations over the user-defined time range. Visit the <a href="../edenapps/xylocator.php"><strong>xyLocator tool</strong></a> page for more information.</p>
<div style="margin:10px auto;width:650px;border:3px #4b7e83 solid">
  <a href="../edenapps/xylocator.php"><img src="../images/screenshots/xyLocator_V2_screenshotth.gif" alt="" height="300" width="400" style="margin:5px"></a>
  <img src="../images/rt_blue_arrow.gif" alt="" height="28" width="51" style="margin-bottom:150px">
  <img src="../images/xylocator_output_example.gif" alt="" height="250" width="176" style="border:1px black solid;margin-bottom:25px;">
  <p style="background-color:#e5f4cc;padding:10px;margin:1px"><a href="../edenapps/xylocator.php"><strong>Download the xyLocator tool.</strong></a></p>
</div>
<?php require ($_SERVER['DOCUMENT_ROOT'] . '/../eden/ssi/eden-foot.php'); ?>