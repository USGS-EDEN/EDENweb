<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Water Depth - Everglades Depth Estimation Network (EDEN)</title>
  <link rel="stylesheet" href="../css/eden-dbweb-html5.css">
  <script src="http://www.usgs.gov/scripts/analytics/usgs-analytics.js"></script>
  <style>
    body { background-color: white }
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
<table style="width:100%;border:0px">
<?php require ('../ssi/eden-head.txt'); ?>
  <tr>
    <td style="vertical-align:top;width:100%;border:0px"><!--Begin body of page -->
<?php
$size = array("netcdf" => array(0), "geotiff" => array(0), "dailymedian" => array(0), "depth" => array(0));
foreach($size as $a => $b) {
	$dir = "/export1/htdocs/eden/data/$a/v2";
	if ($handle = opendir($dir)) {
		while (false !== ($file = readdir($handle)))
			if (preg_match("/^[0-9]{4}_q[1-4]{1}_[A-Za-z0-9_]{2,}\.zip$/", $file))
				$size[$a][substr($file, 0, 4)] += filesize($dir . '/' . $file) / 1048576;
		closedir($handle);
	}
}
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
    <p>Users can download daily water-depth maps 1) in the table below and 2) through the <a href="http://sflthredds.er.usgs.gov/">EDEN THREDDS Data Server</a>. The EDEN project also provides a tool, <a href="../edenapps/depth-dayssincedry.php"><abbr title="Depth and Days Since Dry">Depth&amp;DaysSinceDry</abbr></a>, that allows users to create their own daily water-depth maps by using the EDEN water surface and ground elevation model (DEM) netCDF files. Daily water-depth maps are computed by subtracting the ground elevation from the daily water level for each EDEN grid cell (400 meters by 400 meters).</p>
    <ul>
      <li>Daily water-depth maps (1991-present) - download below</li>
      <li><a href="http://sflthredds.er.usgs.gov/">THREDDS Data Server</a></li>
      <li><a href="../edenapps/depth-dayssincedry.php"><abbr title="Depth and Days Since Dry">Depth&amp;DaysSinceDry</abbr> tool</a></li>
    </ul>
    <p><abbr title="Net C D F">EDEN surfaces are served mainly as NetCDF</abbr> (Network Common Data Form) files, a set of freely-distributed software libraries and machine-independent binary data formats that support the creation, access, and sharing of large array-oriented scientific data. Each file contains 3 months (one quarter-year) of daily datasets. For example, the data for every day in 2002 will be stored in 4 files: 2002_q1_depth.nc, 2002_q2_depth.nc, 2002_q3_depth.nc, and 2002_q4_depth.nc.</p>
    <table style="width:100%;border:2px #475572 solid">
      <tr>
        <th colspan="5" class="pwtablehead" style="text-align:left">Water-Depth <abbr title="Net C D F">NetCDF</abbr> Files
          <p>File naming conventions:</p>
          <ul>
            <li>
              v# = version  of surface water model (v1 or v2),
            </li>
            <li>
              r# = release of surface (r1 or r2),
            </li>
            <li>
              prov = provisional,
            </li>
            <li>
              rt = real-time
            </li>
          </ul>
          <p>New: You may download a year's worth of data all at once. Simply click the link below for each year. Because of file size limits, the most you can download at one time is a year. If you need to download several year's worth of data at once, please contact Heather Henkel (<a href="mailto:hhenkel@usgs.gov">hhenkel@usgs.gov</a>) and other arrangements can be made.</p>
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
        <td style="text-align:center"><a href="water_depth_1990s.php"><strong>1990-1999</strong></a></td>
        <td style="text-align:left" colspan="4"><a href="water_depth_1990s.php"><strong>data available</strong></a> on a separate page</td>
      </tr>
      <tr class="gtablecell">
        <td style="text-align:center"><a href="waterdepthmod-proc.php?year=2000&type=depth">2000</a><br>
          (zip, <?php echo round($size['depth'][2000]); ?> <abbr title="megabytes">MB</abbr>)</td>
        <td style="text-align:center"><a href="../data/depth/v2/2000_q1_depth_v2r1.zip">2000 <abbr title="first quarter">Q1</abbr></a> (.zip)<br>
          <abbr title=" version 2, release 1">v2r1</abbr>, December 2011</td>
        <td style="text-align:center"><a href="../data/depth/v2/2000_q2_depth_v2r1.zip">2000 <abbr title="second quarter">Q2</abbr></a> (.zip)<br>
          <abbr title=" version 2, release 1">v2r1</abbr>, October 2011</td>
        <td style="text-align:center"><a href="../data/depth/v2/2000_q3_depth_v2r1.zip">2000 <abbr title="third quarter">Q3</abbr></a> (.zip)<br>
          <abbr title=" version 2, release 1">v2r1</abbr>, October 2011</td>
        <td style="text-align:center"><a href="../data/depth/v2/2000_q4_depth_v2r1.zip">2000 <abbr title="fourth quarter">Q4</abbr></a> (.zip)<br>
          <abbr title=" version 2, release 1">v2r1</abbr>, October 2011</td>
      </tr>
      <tr class="gtablecell2">
        <td style="text-align:center"><a href="waterdepthmod-proc.php?year=2001&type=depth">2001</a><br>
          (zip, <?php echo round($size['depth'][2001]); ?> <abbr title="megabytes">MB</abbr>)</td>
        <td style="text-align:center"><a href="../data/depth/v2/2001_q1_depth_v2r1.zip">2001 <abbr title="first quarter">Q1</abbr></a> (.zip)<br>
          <abbr title=" version 2, release 1">v2r1</abbr>, October 2011</td>
        <td style="text-align:center"><a href="../data/depth/v2/2001_q2_depth_v2r1.zip">2001 <abbr title="second quarter">Q2</abbr></a> (.zip)<br>
          <abbr title=" version 2, release 1">v2r1</abbr>, October 2011</td>
        <td style="text-align:center"><a href="../data/depth/v2/2001_q3_depth_v2r1.zip">2001 <abbr title="third quarter">Q3</abbr></a> (.zip)<br>
          <abbr title=" version 2, release 1">v2r1</abbr>, October 2011</td>
        <td style="text-align:center"><a href="../data/depth/v2/2001_q4_depth_v2r1.zip">2001 <abbr title="fourth quarter">Q4</abbr></a> (.zip)<br>
          <abbr title=" version 2, release 1">v2r1</abbr>, October 2011</td>
      </tr>
        <tr class="gtablecell">
          <td style="text-align:center"><a href="waterdepthmod-proc.php?year=2002&type=depth">2002</a><br>
            (zip, <?php echo round($size['depth'][2002]); ?> <abbr title="megabytes">MB</abbr>)</td>
          <td style="text-align:center"><a href="../data/depth/v2/2002_q1_depth_v2r1.zip">2002 <abbr title="first quarter">Q1</abbr></a> (.zip)<br>
            <abbr title=" version 2, release 1">v2r1</abbr>, October 2011</td>
          <td style="text-align:center"><a href="../data/depth/v2/2002_q2_depth_v2r1.zip">2002 <abbr title="second quarter">Q2</abbr></a> (.zip)<br>
            <abbr title=" version 2, release 1">v2r1</abbr>, October 2011</td>
          <td style="text-align:center"><a href="../data/depth/v2/2002_q3_depth_v2r1.zip">2002 <abbr title="third quarter">Q3</abbr></a> (.zip)<br>
            <abbr title=" version 2, release 1">v2r1</abbr>, October 2011</td>
          <td style="text-align:center"><a href="../data/depth/v2/2002_q4_depth_v2r1.zip">2002 <abbr title="fourth quarter">Q4</abbr></a> (.zip)<br>
            <abbr title=" version 2, release 1">v2r1</abbr>, October 2011</td>
        </tr>
        <tr class="gtablecell2">
          <td style="text-align:center"><a href="waterdepthmod-proc.php?year=2003&type=depth">2003</a><br>
            (zip, <?php echo round($size['depth'][2003]); ?> <abbr title="megabytes">MB</abbr>)</td>
          <td style="text-align:center"><a href="../data/depth/v2/2003_q1_depth_v2r1.zip">2003 <abbr title="first quarter">Q1</abbr></a> (.zip)<br>
            <abbr title=" version 2, release 1">v2r1</abbr>, October 2011</td>
          <td style="text-align:center"><a href="../data/depth/v2/2003_q2_depth_v2r1.zip">2003 <abbr title="second quarter">Q2</abbr></a> (.zip)<br>
            <abbr title=" version 2, release 1">v2r1</abbr>, October 2011</td>
          <td style="text-align:center"><a href="../data/depth/v2/2003_q3_depth_v2r1.zip">2003 <abbr title="third quarter">Q3</abbr></a> (.zip)<br>
            <abbr title=" version 2, release 1">v2r1</abbr>, October 2011</td>
          <td style="text-align:center"><a href="../data/depth/v2/2003_q4_depth_v2r1.zip">2003 <abbr title="fourth quarter">Q4</abbr></a> (.zip)<br>
            <abbr title=" version 2, release 1">v2r1</abbr>, October 2011</td>
        </tr>
        <tr class="gtablecell">
          <td style="text-align:center"><a href="waterdepthmod-proc.php?year=2004&type=depth">2004</a><br>
            (zip, <?php echo round($size['depth'][2004]); ?> <abbr title="megabytes">MB</abbr>)</td>
          <td style="text-align:center"><a href="../data/depth/v2/2004_q1_depth_v2r1.zip">2004 <abbr title="first quarter">Q1</abbr></a> (.zip)<br>
            <abbr title=" version 2, release 1">v2r1</abbr>, October 2011</td>
          <td style="text-align:center"><a href="../data/depth/v2/2004_q2_depth_v2r1.zip">2004 <abbr title="second quarter">Q2</abbr></a> (.zip)<br>
            <abbr title=" version 2, release 1">v2r1</abbr>, October 2011</td>
          <td style="text-align:center"><a href="../data/depth/v2/2004_q3_depth_v2r1.zip">2004 <abbr title="third quarter">Q3</abbr></a> (.zip)<br>
            <abbr title=" version 2, release 1">v2r1</abbr>, October 2011</td>
          <td style="text-align:center"><a href="../data/depth/v2/2004_q4_depth_v2r1.zip">2004 <abbr title="fourth quarter">Q4</abbr></a> (.zip)<br>
            <abbr title=" version 2, release 1">v2r1</abbr>, October 2011</td>
        </tr>
        <tr class="gtablecell2">
          <td style="text-align:center"><a href="waterdepthmod-proc.php?year=2005&type=depth">2005</a><br>
            (zip, <?php echo round($size['depth'][2005]); ?> <abbr title="megabytes">MB</abbr>)</td>
          <td style="text-align:center"><a href="../data/depth/v2/2005_q1_depth_v2r1.zip">2005 <abbr title="first quarter">Q1</abbr></a> (.zip)<br>
            <abbr title=" version 2, release 1">v2r1</abbr>, October 2011</td>
          <td style="text-align:center"><a href="../data/depth/v2/2005_q2_depth_v2r1.zip">2005 <abbr title="second quarter">Q2</abbr></a> (.zip)<br>
            <abbr title=" version 2, release 1">v2r1</abbr>, October 2011</td>
          <td style="text-align:center"><a href="../data/depth/v2/2005_q3_depth_v2r1.zip">2005 <abbr title="third quarter">Q3</abbr></a> (.zip)<br>
            <abbr title=" version 2, release 1">v2r1</abbr>, October 2011</td>
          <td style="text-align:center"><a href="../data/depth/v2/2005_q4_depth_v2r1.zip">2005 <abbr title="fourth quarter">Q4</abbr></a> (.zip)<br>
            <abbr title=" version 2, release 1">v2r1</abbr>, October 2011</td>
        </tr>
        <tr class="gtablecell">
          <td style="text-align:center"><a href="waterdepthmod-proc.php?year=2006&type=depth">2006</a><br>
            (zip, <?php echo round($size['depth'][2006]); ?> <abbr title="megabytes">MB</abbr>)</td>
          <td style="text-align:center"><a href="../data/depth/v2/2006_q1_depth_v2r1.zip">2006 <abbr title="first quarter">Q1</abbr></a> (.zip)<br>
            <abbr title=" version 2, release 1">v2r1</abbr>, October 2011</td>
          <td style="text-align:center"><a href="../data/depth/v2/2006_q2_depth_v2r1.zip">2006 <abbr title="second quarter">Q2</abbr></a> (.zip)<br>
            <abbr title=" version 2, release 1">v2r1</abbr>, October 2011</td>
          <td style="text-align:center"><a href="../data/depth/v2/2006_q3_depth_v2r1.zip">2006 <abbr title="third quarter">Q3</abbr></a> (.zip)<br>
            <abbr title=" version 2, release 1">v2r1</abbr>, October 2011</td>
          <td style="text-align:center"><a href="../data/depth/v2/2006_q4_depth_v2r1.zip">2006 <abbr title="fourth quarter">Q4</abbr></a> (.zip)<br>
            <abbr title=" version 2, release 1">v2r1</abbr>, October 2011</td>
        </tr>
        <tr class="gtablecell2">
          <td style="text-align:center"><a href="waterdepthmod-proc.php?year=2007&type=depth">2007</a><br>
            (zip, <?php echo round($size['depth'][2007]); ?> <abbr title="megabytes">MB</abbr>)</td>
          <td style="text-align:center"><a href="../data/depth/v2/2007_q1_depth_v2r1.zip">2007 <abbr title="first quarter">Q1</abbr></a> (.zip)<br>
            <abbr title=" version 2, release 1">v2r1</abbr>, October 2011</td>
          <td style="text-align:center"><a href="../data/depth/v2/2007_q2_depth_v2r1.zip">2007 <abbr title="second quarter">Q2</abbr></a> (.zip)<br>
            <abbr title=" version 2, release 1">v2r1</abbr>, October 2011</td>
          <td style="text-align:center"><a href="../data/depth/v2/2007_q3_depth_v2r1.zip">2007 <abbr title="third quarter">Q3</abbr></a> (.zip)<br>
            <abbr title=" version 2, release 1">v2r1</abbr>, October 2011</td>
          <td style="text-align:center"><a href="../data/depth/v2/2007_q4_depth_v2r1.zip">2007 <abbr title="fourth quarter">Q4</abbr></a> (.zip)<br>
            <abbr title=" version 2, release 1">v2r1</abbr>, October 2011</td>
        </tr>
        <tr class="gtablecellblue">
          <td colspan="5" style="text-align:center;padding:25px 1px">You can also download water-depth NetCDF files via the <a href="http://sflthredds.er.usgs.gov"><strong>EDEN THREDDS</strong></a> server.</td>
        </tr>
        <tr class="gtablecell">
          <td style="text-align:center"><a href="waterdepthmod-proc.php?year=2008&type=depth">2008</a><br>
            (zip, <?php echo round($size['depth'][2008]); ?> <abbr title="megabytes">MB</abbr>)</td>
          <td style="text-align:center"><a href="../data/depth/v2/2008_q1_depth_v2r1.zip">2008 <abbr title="first quarter">Q1</abbr></a> (.zip)<br>
            <abbr title=" version 2, release 1">v2r1</abbr>, October 2011</td>
          <td style="text-align:center"><a href="../data/depth/v2/2008_q2_depth_v2r1.zip">2008 <abbr title="second quarter">Q2</abbr></a> (.zip)<br>
            <abbr title=" version 2, release 1">v2r1</abbr>, October 2011</td>
          <td style="text-align:center"><a href="../data/depth/v2/2008_q3_depth_v2r1.zip">2008 <abbr title="third quarter">Q3</abbr></a> (.zip)<br>
            <abbr title=" version 2, release 1">v2r1</abbr>, October 2011</td>
          <td style="text-align:center"><a href="../data/depth/v2/2008_q4_depth_v2r1.zip">2008 <abbr title="fourth quarter">Q4</abbr></a> (.zip)<br>
            <abbr title=" version 2, release 1">v2r1</abbr>, October 2011</td>
        </tr>
        <tr class="gtablecell2">
          <td style="text-align:center"><a href="waterdepthmod-proc.php?year=2009&type=depth">2009</a><br>
            (zip, <?php echo round($size['depth'][2009]); ?> <abbr title="megabytes">MB</abbr>)</td>
          <td style="text-align:center"><a href="../data/depth/v2/2009_q1_depth_v2r1.zip">2009 <abbr title="first quarter">Q1</abbr></a> (.zip)<br>
            <abbr title=" version 2, release 1">v2r1</abbr>, October 2011</td>
          <td style="text-align:center"><a href="../data/depth/v2/2009_q2_depth_v2r1.zip">2009 <abbr title="second quarter">Q2</abbr></a> (.zip)<br>
            <abbr title=" version 2, release 1">v2r1</abbr>, October 2011</td>
          <td style="text-align:center"><a href="../data/depth/v2/2009_q3_depth_v2r1.zip">2009 <abbr title="third quarter">Q3</abbr></a> (.zip)<br>
            <abbr title=" version 2, release 1">v2r1</abbr>, October 2011</td>
          <td style="text-align:center"><a href="../data/depth/v2/2009_q4_depth_v2r1.zip">2009 <abbr title="fourth quarter">Q4</abbr></a> (.zip)<br>
            <abbr title=" version 2, release 1">v2r1</abbr>, October 2011</td>
        </tr>
        <tr class="gtablecell">
          <td style="text-align:center"><a href="waterdepthmod-proc.php?year=2010&type=depth">2010</a><br>
            (zip, <?php echo round($size['depth'][2010]); ?> <abbr title="megabytes">MB</abbr>)</td>
          <td style="text-align:center"><a href="../data/depth/v2/2010_q1_depth_v2r1.zip">2010 <abbr title="first quarter">Q1</abbr></a> (.zip)<br>
            <abbr title=" version 2, release 1">v2r1</abbr>, October 2011</td>
          <td style="text-align:center"><a href="../data/depth/v2/2010_q2_depth_v2r1.zip">2010 <abbr title="second quarter">Q2</abbr></a> (.zip)<br>
            <abbr title=" version 2, release 1">v2r1</abbr>, October 2011</td>
          <td style="text-align:center"><a href="../data/depth/v2/2010_q3_depth_v2r1.zip">2010 <abbr title="third quarter">Q3</abbr></a> (.zip)<br>
            <abbr title=" version 2, release 1">v2r1</abbr>, October 2011</td>
          <td style="text-align:center"><a href="../data/depth/v2/2010_q4_depth_v2r1.zip">2010 <abbr title="fourth quarter">Q4</abbr></a> (.zip)<br>
            <abbr title=" version 2, release 1">v2r1</abbr>, September 2012</td>
        </tr>
        <tr class="gtablecell2">
          <td style="text-align:center"><a href="waterdepthmod-proc.php?year=2011&type=depth">2011</a><br>
            (zip, <?php echo round($size['depth'][2011]); ?> <abbr title="megabytes">MB</abbr>)</td>
          <td style="text-align:center"><a href="../data/depth/v2/2011_q1_depth_v2r1.zip">2011 <abbr title="first quarter">Q1</abbr></a> (.zip)<br>
            <abbr title=" version 2, release 1">v2r1</abbr>, September 2012</td>
          <td style="text-align:center"><a href="../data/depth/v2/2011_q2_depth_v2r1.zip">2011 <abbr title="second quarter">Q2</abbr></a> (.zip)<br>
            <abbr title=" version 2, release 1">v2r1</abbr>, September 2012</td>
          <td style="text-align:center"><a href="../data/depth/v2/2011_q3_depth_v2r1.zip">2011 <abbr title="third quarter">Q3</abbr></a> (.zip)<br>
            <abbr title=" version 2, release 1">v2r1</abbr>, September 2012</td>
          <td style="text-align:center"><a href="../data/depth/v2/2011_q4_depth_v2r2.zip">2011 <abbr title="fourth quarter">Q4</abbr></a> (.zip)<br>
            <abbr title="version 2, run 2">v2r2</abbr>, March 2018</td>
        </tr>
        <tr class="gtablecell">
          <td style="text-align:center"><a href="waterdepthmod-proc.php?year=2012&type=depth">2012</a><br>
            (zip, <?php echo round($size['depth'][2012]); ?> <abbr title="megabytes">MB</abbr>)</td>
          <td style="text-align:center"><a href="../data/depth/v2/2012_q1_depth_v2r2.zip">2012 <abbr title="first quarter">Q1</abbr></a> (.zip)<br>
            <abbr title="version 2, run 2">v2r2</abbr>, March 2018</td>
          <td style="text-align:center"><a href="../data/depth/v2/2012_q2_depth_v2r2.zip">2012 <abbr title="second quarter">Q2</abbr></a> (.zip)<br>
            <abbr title="version 2, run 2">v2r2</abbr>, March 2018</td>
          <td style="text-align:center"><a href="../data/depth/v2/2012_q3_depth_v2r2.zip">2012 <abbr title="third quarter">Q3</abbr></a> (.zip)<br>
            <abbr title="version 2, run 2">v2r2</abbr>, March 2018</td>
          <td style="text-align:center"><a href="../data/depth/v2/2012_q4_depth_v2r2.zip">2012 <abbr title="fourth quarter">Q4</abbr></a> (.zip)<br>
            <abbr title="version 2, run 2">v2r2</abbr>, March 2018</td>
        </tr>
        <tr class="gtablecell2">
          <td style="text-align:center"><a href="waterdepthmod-proc.php?year=2013&type=depth">2013</a><br>
            (zip, <?php echo round($size['depth'][2013]); ?> <abbr title="megabytes">MB</abbr>)</td>
          <td style="text-align:center"><a href="../data/depth/v2/2013_q1_depth_v2r2.zip">2013 <abbr title="first quarter">Q1</abbr></a> (.zip)<br>
            <abbr title="version 2, run 2">v2r2</abbr>, March 2018</td>
          <td style="text-align:center"><a href="../data/depth/v2/2013_q2_depth_v2r2.zip">2013 <abbr title="second quarter">Q2</abbr></a> (.zip)<br>
            <abbr title="version 2, run 2">v2r2</abbr>, March 2018</td>
          <td style="text-align:center"><a href="../data/depth/v2/2013_q3_depth_v2r2.zip">2013 <abbr title="third quarter">Q3</abbr></a> (.zip)<br>
            <abbr title="version 2, run 2">v2r2</abbr>, March 2018</td>
          <td style="text-align:center"><a href="../data/depth/v2/2013_q4_depth_v2r2.zip">2013 <abbr title="fourth quarter">Q4</abbr></a> (.zip)<br>
            <abbr title="version 2, run 2">v2r2</abbr>, March 2018</td>
        </tr>
        <tr class="gtablecell">
          <td style="text-align:center"><a href="waterdepthmod-proc.php?year=2014&type=depth">2014</a><br>
            (zip, <?php echo round($size['depth'][2014]); ?> <abbr title="megabytes">MB</abbr>)</td>
          <td style="text-align:center"><a href="../data/depth/v2/2014_q1_depth_v2r1.zip">2014 <abbr title="first quarter">Q1</abbr></a> (.zip)<br>
            <abbr title="version 2, run 2">v2r2</abbr>, March 2018</td>
          <td style="text-align:center"><a href="../data/depth/v2/2014_q2_depth_v2r2.zip">2014 <abbr title="second quarter">Q2</abbr></a> (.zip)<br>
            <abbr title="version 2, run 2">v2r2</abbr>, March 2018</td>
          <td style="text-align:center"><a href="../data/depth/v2/2014_q3_depth_v2r2.zip">2014 <abbr title="third quarter">Q3</abbr></a> (.zip)<br>
            <abbr title="version 2, run 2">v2r2</abbr>, March 2018</td>
          <td style="text-align:center"><a href="../data/depth/v2/2014_q4_depth_v2r2.zip">2014 <abbr title="fourth quarter">Q4</abbr></a> (.zip)<br>
            <abbr title="version 2, run 2">v2r2</abbr>, March 2018</td>
        </tr>
        <tr class="gtablecell2">
          <td style="text-align:center"><a href="waterdepthmod-proc.php?year=2015&type=depth">2015</a><br>
            (zip, <?php echo round($size['depth'][2015]); ?> <abbr title="megabytes">MB</abbr>)</td>
          <td style="text-align:center"><a href="../data/depth/v2/2015_q1_depth_v2r2.zip">2015 <abbr title="first quarter">Q1</abbr></a> (.zip)<br>
            <abbr title="version 2, run 2">v2r2</abbr>, March 2018</td>
          <td style="text-align:center"><a href="../data/depth/v2/2015_q2_depth_v2r2.zip">2015 <abbr title="second quarter">Q2</abbr></a> (.zip)<br>
            <abbr title="version 2, run 2">v2r2</abbr>, March 2018</td>
          <td style="text-align:center"><a href="../data/depth/v2/2015_q3_depth_v2r2.zip">2015 <abbr title="third quarter">Q3</abbr></a> (.zip)<br>
            <abbr title="version 2, run 2">v2r2</abbr>, March 2018</td>
          <td style="text-align:center"><a href="../data/depth/v2/2015_q4_depth_v2r2.zip">2015 <abbr title="fourth quarter">Q4</abbr></a> (.zip)<br>
            <abbr title="version 2, run 2">v2r2</abbr>, March 2018</td>
        </tr>
        <tr class="gtablecell">
          <td style="text-align:center"><a href="waterdepthmod-proc.php?year=2016&type=depth">2016</a><br>
            (zip, <?php echo round($size['depth'][2016]); ?> <abbr title="megabytes">MB</abbr>)</td>
          <td style="text-align:center"><a href="../data/depth/v2/2016_q1_depth_v2r2.zip">2016 <abbr title="first quarter">Q1</abbr></a> (.zip)<br>
            <abbr title="version 2, run 2">v2r2</abbr>, March 2018</td>
          <td style="text-align:center"><a href="../data/depth/v2/2016_q2_depth_v2r2.zip">2016 <abbr title="second quarter">Q2</abbr></a> (.zip)<br>
            <abbr title="version 2, run 2">v2r2</abbr>, March 2018</td>
          <td style="text-align:center"><a href="../data/depth/v2/2016_q3_depth_v2r2.zip">2016 <abbr title="third quarter">Q3</abbr></a> (.zip)<br>
            <abbr title="version 2, run 2">v2r2</abbr>, March 2018</td>
          <td style="text-align:center"><a href="../data/depth/v2/2016_q4_depth_v2r3.zip">2016 <abbr title="fourth quarter">Q4</abbr></a> (.zip)<br>
            <abbr title="version 2, run 3">v2r3</abbr>, November 2018</td>
        </tr>
        <tr class="gtablecell2">
          <td style="text-align:center"><a href="waterdepthmod-proc.php?year=2017&type=depth">2017</a><br>
            (zip, <?php echo round($size['depth'][2017]); ?> <abbr title="megabytes">MB</abbr>)</td>
          <td style="text-align:center"><a href="../data/depth/v2/2017_q1_depth_v2r3.zip">2017 <abbr title="first quarter">Q1</abbr></a> (.zip)<br>
            <abbr title="version 2, run 3">v2r3</abbr>, November 2018</td>
          <td style="text-align:center"><a href="../data/depth/v2/2017_q2_depth_v2r3.zip">2017 <abbr title="second quarter">Q2</abbr></a> (.zip)<br>
            <abbr title="version 2, run 3">v2r3</abbr>, November 2018</td>
          <td style="text-align:center"><a href="../data/depth/v2/2017_q3_depth_v2r1.zip">2017 <abbr title="third quarter">Q3</abbr></a> (.zip)<br>
            <abbr title=" version 2, run 1">v2r1</abbr>, November 2017</td>
          <td style="text-align:center"><a href="../data/depth/v2/2017_q4_depth_v2prov.zip">2017 <abbr title="fourth quarter">Q4</abbr></a> (.zip)<br>
            <abbr title=" version 2, provisional run">v2<strong>prov</strong></abbr>, March 2018</td>
        </tr>
        <tr class="gtablecell">
          <td style="text-align:center"><a href="waterdepthmod-proc.php?year=2018&type=depth">2018</a><br>
            (zip, <?php echo round($size['depth'][2018]); ?> <abbr title="megabytes">MB</abbr>)</td>
          <td style="text-align:center"><a href="../data/depth/v2/2018_q1_depth_v2prov.zip">2018 <abbr title="first quarter">Q1</abbr></a> (.zip)<br>
            <abbr title="version 2, provisional ">v2<b>prov</b></abbr>, June 2018</td>
          <td style="text-align:center"><a href="../data/depth/v2/2018_q2_depth_v2prov.zip">2018 <abbr title="second quarter">Q2</abbr></a> (.zip)<br>
            <abbr title="version 2, provisional ">v2<b>prov</b></abbr>, September 2018</td>
          <td style="text-align:center"><a href="../data/depth/v2/2018_q3_depth_v2prov.zip">2018 <abbr title="third quarter">Q3</abbr></a> (.zip)<br>
            <abbr title="version 2, provisional ">v2<b>prov</b></abbr>, December 2018</td>
          <td style="text-align:center"><a href="../data/depth/v2/2018_q4_depth_v2prov.zip">2018 <abbr title="fourth quarter">Q4</abbr></a> (.zip)<br>
            <abbr title="version 2, provisional ">v2<b>prov</b></abbr>, February 2019</td>
        </tr>
        <tr class="gtablecell2">
          <td style="text-align:center"><a href="waterdepthmod-proc.php?year=2019&type=depth">2019</a><br>
            (zip, <?php echo round($size['depth'][2019]); ?> <abbr title="megabytes">MB</abbr>)</td>
          <td style="text-align:center"><a href="../data/depth/v2/2019_q1_depth_v2prov.zip">2019 <abbr title="first quarter">Q1</abbr></a> (.zip)<br>
            <abbr title="version 2, provisional ">v2<b>prov</b></abbr>, June 2019</td>
          <td style="text-align:center"><a href="../data/depth/v3/2019_q2_depth_v3prov.zip">2019 <abbr title="second quarter">Q2</abbr></a> (.zip)<br>
            <abbr title="version 3, provisional ">v3<b>prov</b></abbr>, September 2019</td>
          <td style="text-align:center"><a href="../data/depth/v3/2019_q3_depth_v3prov.zip">2019 <abbr title="third quarter">Q3</abbr></a> (.zip)<br>
            <abbr title="version 3, provisional ">v3<b>prov</b></abbr>, December 2019</td>
          <td style="text-align:center"><a href="../data/depth/v3/2019_q4_depth_v3prov.zip">2019 <abbr title="fourth quarter">Q3</abbr></a> (.zip)<br>
            <abbr title="version 3, provisional ">v3<b>prov</b></abbr>, February 2020</td>
        </tr>
        <tr class="gtablecell">
          <td style="text-align:center"><a href="waterdepthmod-proc.php?year=2020&type=depth">2020</a><br>
            (zip, <?php echo round($size['depth'][2020]); ?> <abbr title="megabytes">MB</abbr>)</td>
          <td style="text-align:center;background-color:#f1b7a6"><a href="real-time.php"><strong>Real-Time Data</strong></a></td>
          <td style="text-align:center;background-color:#f1b7a6"><a href="real-time.php"><strong>Real-Time Data</strong></a></td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr class="grytablehead">
          <td colspan="5" style="text-align:center"><a href="water_depth_archive.php">Archived Water-depth NetCDF Files</a></td>
        </tr>
        <tr class="gvegtablehead">
          <td colspan="5"><strong>Additional Documentation:</strong>
            <ul>
              <li><a href="release_notes_watersurfaces.php">Surface-Water Model Release Notes</a> (for <abbr title="version 1">V1</abbr> and <abbr title="version 2">V2</abbr> of the water surface model)</li>
              <li><a href="wsreleaselog.php">Water-Surface Release Log</a></li>
              <li><a href="https://archive.usgs.gov/archive/sites/sofia.usgs.gov/metadata/sflwww/water_depth.html">Metadata - EDEN Water-Depth Data</a></li>
              <li><a href="../edenapps/EDEN_NetCDF_Data_Format.pdf">EDEN <abbr title="Net C D F">NetCDF</abbr> Data Format</a> (.pdf, 4 <abbr title="kilobytes">KB</abbr>)</li>
              <li><a href="../edenapps/Quick_Guide_Using_EDEN_NetCDF_Files_ArcGIS.pdf">A Quick Guide to Using EDEN <abbr title="Net C D F">NetCDF</abbr> Files in <abbr title="Arc G I S">ArcGIS</abbr> 9.2</a> (.pdf, 62 <abbr title="kilobytes">KB</abbr>)</li>
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
    </td><!--End body of page -->
    <td style="width:8px;border:0px"></td>
    <td style="vertical-align:top;width:170px;background-color:#ebcf8c;border:0px;padding:0px">
<!-- navigation include-->
<?php require ('../ssi/nav.php');?>
<img src="../images/photos/prairie_landscapef.jpg" alt="Photo of sawgrass with tree islands in the distance" height="181" width="160" style="padding-left:5px">
    </td>
  </tr>
  <tr>
    <td style="background-color:#4d7c86;border:0px" colspan="3">
      <span class="footer">Technical support for this Web site is provided by the <a href="http://www.usgs.gov/" class="footer">U.S. Geological Survey</a><br>This page is:
<?php
$filename = htmlentities($_SERVER['SCRIPT_NAME'], ENT_QUOTES); 
echo "http://sofia.usgs.gov$filename";
?>
      <br>Comments and suggestions? Contact: <a href="https://archive.usgs.gov/archive/sites/sofia.usgs.gov/comments.html" class="footer">Heather Henkel - Webmaster</a><br>Last updated:
<?php echo date ("F d, Y h:i A", getlastmod()); ?> (BJM)</span>
    </td>
  </tr>
</table>
</body>
</html>