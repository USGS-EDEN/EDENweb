<?php
session_start();
$year = htmlentities(trim($_GET['year']), ENT_QUOTES);
$type = htmlentities(trim($_GET['type']), ENT_QUOTES);
require_once('/var/www/eden/pclzip.lib.php');
$title = "<title>Water Surfaces - Everglades Depth Estimation Network (EDEN)</title>\n";
require ($_SERVER['DOCUMENT_ROOT'] . '/../eden/ssi/eden-head.php');
echo "<h2>Water Surfaces</h2>\n";
if (($type == 'netcdf' || $type == 'geotiff' || $type == 'dailymedian') && $year > 1990 && $year < 2100) {
	set_time_limit(200);
	$zipdir = 'surface_zipfiles';
	if ($handle = opendir($zipdir)) {
		while (false !== ($file = readdir($handle)))
		if ($file != '.' && $file != '..')
			unlink($zipdir . '/' . $file);
		closedir($handle);
	}
	$filename = "surface_zipfiles/{$year}_{$type}_files.zip";
	$archive = new PclZip($filename);
	for ($i = 2; $i <= 3; $i++) {
		$dir = "/var/www/eden/data/$type/v$i";
		if ($handle = opendir($dir)) {
			while (false !== ($file = readdir($handle)))
				if (preg_match("/^$year/", $file)) {
					copy($dir . '/' . $file, $zipdir . '/' . $file);
					$ziplist[] .= $zipdir . '/' . $file;
				}
			closedir($handle);
		}
	}
	$dir = '/var/www/eden/data/realtime2';
	if ($handle = opendir($dir)) {
		switch ($type) {
			case 'netcdf':
				$t = '_v3rt_nc.zip';
				break;
			case 'geotiff':
				$t = '_v3rt_geotif.zip';
				break;
			case 'dailymedian':
				$t = '_median_flag_v3rt.txt';
				break;
		}
		while (false !== ($file = readdir($handle)))
			if (preg_match("/^$year.*$t$/", $file)) {
				copy($dir . '/' . $file, $zipdir . '/' . $file);
				$ziplist[] .= $zipdir . '/' . $file;
			}
		closedir($handle);
	}
	$v_list = $archive -> create($ziplist);
	if ($v_list == 0)
		die('Error : ' . $archive -> errorInfo(true));
	echo "<div style='width:400px;border:3px solid #800000;margin:10px auto;text-align:center'><p><strong>You may download the selected data <a href='surface_zipfiles/{$year}_{$type}_files.zip'>here</a>.</strong></p></div>\n";
}
else
	echo "<p><strong>You have not selected a recognized year and/or data type to download.</strong></p>\n";
?>
<p>Return to <a href="http://sofia.usgs.gov/eden/models/watersurfacemod_download<?php if ($year >= 1990 && $year <= 1999) echo '_1990s';?>.php">Water Surfaces download page</a>.</p>
<?php require ($_SERVER['DOCUMENT_ROOT'] . '/../eden/ssi/eden-foot.php'); ?>