<?php
$size = array('netcdf' => array(), 'geotiff' => array(), 'dailymedian' => array());
foreach($size as $a => $b) {
	$dir = "/var/www/eden/data/$a/v2";
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
<h2>Water Level Surfaces - 1990-1999 (Updated May 2012)</h2>
<img src="../images/maps/watersurfacesV2sm-historical.jpg" alt="sample graphic of a version2 water surface map" height="216" width="153" style="float:right">
<p style="color:#780000"><strong>CAUTION TO USERS - See <a href="#caution">discussion below</a> about the quality of the hindcasted gage data used to generate these surfaces</strong></p>
<p>In May 2012, <span style="color:#780000">PROVISIONAL (Release 2)</span> daily water-level surfaces for the period 1/1/1991 through 12/31/1999 were generated using the newly revised (2011) EDEN V2 surface-water model. About 50% of the EDEN network of gages was operational back to 1991, therefore significant hindcast of datasets, gapfilling of missing measured data, and quality assurance of water-level data was required prior to input to the model. Record dry conditions throughout the Everglades were measured in 1990. As with any modeling effort, empirical or deterministic, the reliability of the model is dependent on the quality of the data and range of measured conditions used for model development. Model performance is typically evaluated against measured conditions when the models are interpolating within the ranged of measured conditions. It is more difficult to evaluate how models will extrapolate to conditions beyond the range of the measured data. Small variations in how the hindcast models extrapolated to extreme conditions can cause errors in the water-surface gradients between stations. The extreme range that the hindcast models needed to extrapolate substantially  reduced the confidence in hindcasted data therefore water-level surfaces are not provided for users prior to 1/1/91.</p>
<p>A summary of the input data includes:</p>
<ul>
  <li>Data for all gages was compiled from multiple sources.</li>
  <li>Data gaps were filled using one of the several estimation methods.</li>
  <li>Data for structure gages (G300_T, G339_H, and G339_T) were not hindcasted prior to their initial data of operation.</li>
  <li>Data for marsh gages were hindcasted back to 1/1/91 even when the gage was not constructed at that time.</li>
  <li>Only outliers from the measured data were removed.</li>
</ul>
<table style="width:450px;text-align:center;margin:10px auto">
  <tr>
    <th colspan="2" style="background-color:#d5ea90">
      <p>EDEN Gages (1990-1999) Data Status</p>
    </th>
  </tr>
  <tr>
    <td>
      <p>The <a href="../images/maps/hindcast_gages_v2.gif">map to the right</a> shows the location and data status for 1990-1999 EDEN water-level surfaces. [<a href="../images/maps/hindcast_gages_v2.gif">larger version</a>]</p>
      <p>A <a href="EDEN_1990s_hindcast_period_v2.xls">spreadsheet lists all gages in the EDEN network used in the surface-water model</a> (.xls file, 71 <abbr title="kilobytes">KB</abbr>), period of measured data, and whether they were hindcasted back to 1990 (based on type of gage, i.e. structure gage). A <a href="EDEN_1990s_hindcast_period_v2.txt">tab-delimited text file</a> is also availble for this data set.</p>
    </td>
    <td><a href="../images/maps/hindcast_gages_v2.gif"><img src="../images/maps/hindcast_gagesth_v2.gif" alt="Map showing location and period of record for hindcasted gages" height="342" width="216"></a></td>
  </tr>
</table>
<p><a id="caution"></a>Users are cautioned about the quality of the water-level surfaces for several subareas and in the vicinity of several gages prior to using the data:</p>
<ul>
  <li>During 1991, portions of the model domain are still within extreme low water level conditions which limits the confidence of hindcasted datasets.</li>
  <li><strong>WCA2B:</strong> For the period 1/1/1991 - 4/27/1993, no data is available for the northern boundary structures (S144_T, S145_T, S146_T), therefore the water-level surfaces in WCA3B are not considered valid in the northern portion of the subarea.</li>
  <li><strong>BCA18: </strong>Measured data for this gage is higher than surrounding gages and therefore estimated data is generally high and at times, significantly higher than nearby gages.</li>
  <li><strong>3ANE and 3ANW</strong> have measured data in 1991 and portions of 1992 that appear to be lower and higher, respectively, than nearby gages. The EDEN team is unsure if these differences are the result of operating practices at the time or the results of systematic data collection error.</li>
  <li><strong>Pennsuco Wetlands:</strong> The surface of this subarea is modeled only when data for 5 or more gages is available.)</li>
</ul>
<h3><a id="netcdf"></a><abbr title="Net C D F">NetCDF</abbr> Files:</h3>
<p><abbr title="Net C D F">NetCDF</abbr> (Network Common Data Form) is a set of freely-distributed software libraries and machine-independent binary data formats that support the creation, access, and sharing of large array-oriented scientific data. This format replaces the bulky file structure and difficult file management of ESRI GRIDS for EDEN data. It also allows EDEN applications to run on computers without <abbr title="Arc G I S">ArcGIS</abbr> installations.</p>
<p><a id="ncfile"></a>Each file contains 3 months (one quarter-year) of daily datasets. For example, the data for every day in 1992 will be stored in 4 files: 1992_q1.nc, 1992_q2.nc, 1992_q3.nc, and 1992_q4.nc. In addition, each zip file contains a <a href="release_notes_watersurfaces.php">readme file which contains brief information about release notes</a> related to this data release.</p>
<table style="width:100%">
  <tr>
    <th colspan="5" class="bltablehead"><abbr title="Net C D F">NetCDF</abbr> Files
      <p style="text-align:left">File naming conventions:</p>
      <ul style="text-align:left">
        <li>v# = version  of surface water model (v1 or v2),</li>
        <li>r# = release of surface (r1 or r2),</li>
        <li>prov = provisional</li>
      </ul>
      <p style="text-align:left">New: You may download a year's worth of data all at once. Simply click the link below for each year.  Because of file size limits, the most you can download at one time is a year. If you need to download several year's worth of data at once, please contact Heather Henkel (<a href="mailto:hhenkel@usgs.gov">hhenkel@usgs.gov</a>) and other arrangements can be made.</p>
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
    <td><a href="watersurfacemod-proc.php?year=1991&type=netcdf">1991</a><br>
      (zip, <?php echo round($size['netcdf'][1991]); ?> <abbr title="megabytes">MB</abbr>)</td>
    <td><a href="../data/netcdf/v2/1991_q1_v2prov_r2.zip">1991 <abbr title="first quarter">Q1</abbr></a> (zip, 18 <abbr title="megabytes">MB</abbr>)<br>
      <abbr title="version 2, provisional run 2">v2prov_r2</abbr>, May 2012</td>
    <td><a href="../data/netcdf/v2/1991_q2_v2prov_r2.zip">1991 <abbr title="second quarter">Q2</abbr></a> (zip, 18 <abbr title="megabytes">MB</abbr>)<br>
      <abbr title="version 2, provisional run 2">v2prov_r2</abbr>, May 2012</td>
    <td><a href="../data/netcdf/v2/1991_q3_v2prov_r2.zip">1991 <abbr title="third quarter">Q3</abbr></a> (zip, 18 <abbr title="megabytes">MB</abbr>)<br>
      <abbr title="version 2, provisional run 2">v2prov_r2</abbr>, May 2012</td>
    <td><a href="../data/netcdf/v2/1991_q4_v2prov_r2.zip">1991 <abbr title="fourth quarter">Q4</abbr></a> (zip, 18 <abbr title="megabytes">MB</abbr>)<br>
      <abbr title="version 2, provisional run 2">v2prov_r2</abbr>, May 2012</td>
  </tr>
  <tr class="gtablecell" style="text-align:center">
    <td><a href="watersurfacemod-proc.php?year=1992&type=netcdf">1992</a><br>
      (zip, <?php echo round($size['netcdf'][1992]); ?> <abbr title="megabytes">MB</abbr>)</td>
    <td><a href="../data/netcdf/v2/1992_q1_v2prov_r2.zip">1992 <abbr title="first quarter">Q1</abbr></a> (zip, 18 <abbr title="megabytes">MB</abbr>)<br>
      <abbr title="version 2, provisional run 2">v2prov_r2</abbr>, May 2012</td>
    <td><a href="../data/netcdf/v2/1992_q2_v2prov_r2.zip">1992 <abbr title="second quarter">Q2</abbr></a> (zip, 18 <abbr title="megabytes">MB</abbr>)<br>
      <abbr title="version 2, provisional run 2">v2prov_r2</abbr>, May 2012</td>
    <td><a href="../data/netcdf/v2/1992_q3_v2prov_r2.zip">1992 <abbr title="third quarter">Q3</abbr></a> (zip, 18 <abbr title="megabytes">MB</abbr>)<br>
      <abbr title="version 2, provisional run 2">v2prov_r2</abbr>, May 2012</td>
    <td><a href="../data/netcdf/v2/1992_q4_v2prov_r2.zip">1992 <abbr title="fourth quarter">Q4</abbr></a> (zip, 18 <abbr title="megabytes">MB</abbr>)<br>
      <abbr title="version 2, provisional run 2">v2prov_r2</abbr>, May 2012</td>
  </tr>
  <tr class="gtablecell2" style="text-align:center">
    <td><a href="watersurfacemod-proc.php?year=1993&type=netcdf">1993</a><br>
      (zip, <?php echo round($size['netcdf'][1993]); ?> <abbr title="megabytes">MB</abbr>)</td>
    <td><a href="../data/netcdf/v2/1993_q1_v2prov_r2.zip">1993 <abbr title="first quarter">Q1</abbr></a> (zip, 18 <abbr title="megabytes">MB</abbr>)<br>
      <abbr title="version 2, provisional run 2">v2prov_r2</abbr>, May 2012</td>
    <td><a href="../data/netcdf/v2/1993_q2_v2prov_r2.zip">1993 <abbr title="second quarter">Q2</abbr></a> (zip, 18 <abbr title="megabytes">MB</abbr>)<br>
      <abbr title="version 2, provisional run 2">v2prov_r2</abbr>, May 2012</td>
    <td><a href="../data/netcdf/v2/1993_q3_v2prov_r2.zip">1993 <abbr title="third quarter">Q3</abbr></a> (zip, 18 <abbr title="megabytes">MB</abbr>)<br>
      <abbr title="version 2, provisional run 2">v2prov_r2</abbr>, May 2012</td>
    <td><a href="../data/netcdf/v2/1993_q4_v2prov_r2.zip">1993 <abbr title="fourth quarter">Q4</abbr></a> (zip, 18 <abbr title="megabytes">MB</abbr>)<br>
      <abbr title="version 2, provisional run 2">v2prov_r2</abbr>, May 2012</td>
  </tr>
  <tr class="gtablecell" style="text-align:center">
    <td><a href="watersurfacemod-proc.php?year=1994&type=netcdf">1994</a><br>
      (zip, <?php echo round($size['netcdf'][1994]); ?> <abbr title="megabytes">MB</abbr>)</td>
    <td><a href="../data/netcdf/v2/1994_q1_v2prov_r2.zip">1994 <abbr title="first quarter">Q1</abbr></a> (zip, 18 <abbr title="megabytes">MB</abbr>)<br>
      <abbr title="version 2, provisional run 2">v2prov_r2</abbr>, May 2012</td>
    <td><a href="../data/netcdf/v2/1994_q2_v2prov_r2.zip">1994 <abbr title="second quarter">Q2</abbr></a> (zip, 18 <abbr title="megabytes">MB</abbr>)<br>
      <abbr title="version 2, provisional run 2">v2prov_r2</abbr>, May 2012</td>
    <td><a href="../data/netcdf/v2/1994_q3_v2prov_r2.zip">1994 <abbr title="third quarter">Q3</abbr></a> (zip, 18 <abbr title="megabytes">MB</abbr>)<br>
      <abbr title="version 2, provisional run 2">v2prov_r2</abbr>, May 2012</td>
    <td><a href="../data/netcdf/v2/1994_q4_v2prov_r2.zip">1994 <abbr title="fourth quarter">Q4</abbr></a> (zip, 18 <abbr title="megabytes">MB</abbr>)<br>
      <abbr title="version 2, provisional run 2">v2prov_r2</abbr>, May 2012</td>
  </tr>
  <tr class="gtablecellblue" style="text-align:center">
    <td colspan="5">You can also download water-surface NetCDF files via the <a href="http://sflthredds.er.usgs.gov"><strong>EDEN THREDDS</strong></a> server.</td>
  </tr>
  <tr class="gtablecell2" style="text-align:center">
    <td><a href="watersurfacemod-proc.php?year=1995&type=netcdf">1995</a><br>
      (zip, <?php echo round($size['netcdf'][1995]); ?> <abbr title="megabytes">MB</abbr>)</td>
    <td><a href="../data/netcdf/v2/1995_q1_v2prov_r2.zip">1995 <abbr title="first quarter">Q1</abbr></a> (zip, 18 <abbr title="megabytes">MB</abbr>)<br>
      <abbr title="version 2, provisional run 2">v2prov_r2</abbr>, May 2012</td>
    <td><a href="../data/netcdf/v2/1995_q2_v2prov_r2.zip">1995 <abbr title="second quarter">Q2</abbr></a> (zip, 18 <abbr title="megabytes">MB</abbr>)<br>
      <abbr title="version 2, provisional run 2">v2prov_r2</abbr>, May 2012</td>
    <td><a href="../data/netcdf/v2/1995_q3_v2prov_r2.zip">1995 <abbr title="third quarter">Q3</abbr></a> (zip, 18 <abbr title="megabytes">MB</abbr>)<br>
      <abbr title="version 2, provisional run 2">v2prov_r2</abbr>, May 2012</td>
    <td><a href="../data/netcdf/v2/1995_q4_v2prov_r2.zip">1995 <abbr title="fourth quarter">Q4</abbr></a> (zip, 18 <abbr title="megabytes">MB</abbr>)<br>
      <abbr title="version 2, provisional run 2">v2prov_r2</abbr>, May 2012</td>
  </tr>
  <tr class="gtablecell" style="text-align:center">
    <td><a href="watersurfacemod-proc.php?year=1996&type=netcdf">1996</a><br>
      (zip, <?php echo round($size['netcdf'][1996]); ?> <abbr title="megabytes">MB</abbr>)</td>
    <td><a href="../data/netcdf/v2/1996_q1_v2prov_r2.zip">1996 <abbr title="first quarter">Q1</abbr></a> (zip, 18 <abbr title="megabytes">MB</abbr>)<br>
      <abbr title="version 2, provisional run 2">v2prov_r2</abbr>, May 2012</td>
    <td><a href="../data/netcdf/v2/1996_q2_v2prov_r2.zip">1996 <abbr title="second quarter">Q2</abbr></a> (zip, 18 <abbr title="megabytes">MB</abbr>)<br>
      <abbr title="version 2, provisional run 2">v2prov_r2</abbr>, May 2012</td>
    <td><a href="../data/netcdf/v2/1996_q3_v2prov_r2.zip">1996 <abbr title="third quarter">Q3</abbr></a> (zip, 18 <abbr title="megabytes">MB</abbr>)<br>
      <abbr title="version 2, provisional run 2">v2prov_r2</abbr>, May 2012</td>
    <td><a href="../data/netcdf/v2/1996_q4_v2prov_r2.zip">1996 <abbr title="fourth quarter">Q4</abbr></a> (zip, 18 <abbr title="megabytes">MB</abbr>)<br>
      <abbr title="version 2, provisional run 2">v2prov_r2</abbr>, May 2012</td>
  </tr>
  <tr class="gtablecell2" style="text-align:center">
    <td><a href="watersurfacemod-proc.php?year=1997&type=netcdf">1997</a><br>
      (zip, <?php echo round($size['netcdf'][1997]); ?> <abbr title="megabytes">MB</abbr>)</td>
    <td><a href="../data/netcdf/v2/1997_q1_v2prov_r2.zip">1997 <abbr title="first quarter">Q1</abbr></a> (zip, 18 <abbr title="megabytes">MB</abbr>)<br>
      <abbr title="version 2, provisional run 2">v2prov_r2</abbr>, May 2012</td>
    <td><a href="../data/netcdf/v2/1997_q2_v2prov_r2.zip">1997 <abbr title="second quarter">Q2</abbr></a> (zip, 18 <abbr title="megabytes">MB</abbr>)<br>
      <abbr title="version 2, provisional run 2">v2prov_r2</abbr>, May 2012</td>
    <td><a href="../data/netcdf/v2/1997_q3_v2prov_r2.zip">1997 <abbr title="third quarter">Q3</abbr></a> (zip, 18 <abbr title="megabytes">MB</abbr>)<br>
      <abbr title="version 2, provisional run 2">v2prov_r2</abbr>, May 2012</td>
    <td><a href="../data/netcdf/v2/1997_q4_v2prov_r2.zip">1997 <abbr title="fourth quarter">Q4</abbr></a> (zip, 18 <abbr title="megabytes">MB</abbr>)<br>
      <abbr title="version 2, provisional run 2">v2prov_r2</abbr>, May 2012</td>
  </tr>
  <tr class="gtablecell" style="text-align:center">
    <td><a href="watersurfacemod-proc.php?year=1998&type=netcdf">1998</a><br>
      (zip, <?php echo round($size['netcdf'][1998]); ?> <abbr title="megabytes">MB</abbr>)</td>
    <td><a href="../data/netcdf/v2/1998_q1_v2prov_r2.zip">1998 <abbr title="first quarter">Q1</abbr></a> (zip, 18 <abbr title="megabytes">MB</abbr>)<br>
      <abbr title="version 2, provisional run 2">v2prov_r2</abbr>, May 2012</td>
    <td><a href="../data/netcdf/v2/1998_q2_v2prov_r2.zip">1998 <abbr title="second quarter">Q2</abbr></a> (zip, 18 <abbr title="megabytes">MB</abbr>)<br>
      <abbr title="version 2, provisional run 2">v2prov_r2</abbr>, May 2012</td>
    <td><a href="../data/netcdf/v2/1998_q3_v2prov_r2.zip">1998 <abbr title="third quarter">Q3</abbr></a> (zip, 18 <abbr title="megabytes">MB</abbr>)<br>
      <abbr title="version 2, provisional run 2">v2prov_r2</abbr>, May 2012</td>
    <td><a href="../data/netcdf/v2/1998_q4_v2prov_r2.zip">1998 <abbr title="fourth quarter">Q4</abbr></a> (zip, 18 <abbr title="megabytes">MB</abbr>)<br>
      <abbr title="version 2, provisional run 2">v2prov_r2</abbr>, May 2012</td>
  </tr>
  <tr class="gtablecell2" style="text-align:center">
    <td><a href="watersurfacemod-proc.php?year=1999&type=netcdf">1999</a><br>
      (zip, <?php echo round($size['netcdf'][1999]); ?> <abbr title="megabytes">MB</abbr>)</td>
    <td><a href="../data/netcdf/v2/1999_q1_v2prov_r2.zip">1999 <abbr title="first quarter">Q1</abbr></a> (zip, 18 <abbr title="megabytes">MB</abbr>)<br>
      <abbr title="version 2, provisional run 2">v2prov_r2</abbr>, May 2012</td>
    <td><a href="../data/netcdf/v2/1999_q2_v2prov_r2.zip">1999 <abbr title="second quarter">Q2</abbr></a> (zip, 18 <abbr title="megabytes">MB</abbr>)<br>
      <abbr title="version 2, provisional run 2">v2prov_r2</abbr>, May 2012</td>
    <td><a href="../data/netcdf/v2/1999_q3_v2prov_r2.zip">1999 <abbr title="third quarter">Q3</abbr></a> (zip, 18 <abbr title="megabytes">MB</abbr>)<br>
      <abbr title="version 2, provisional run 2">v2prov_r2</abbr>, May 2012</td>
    <td><a href="../data/netcdf/v2/1999_q4_v2prov_r2.zip">1999 <abbr title="fourth quarter">Q4</abbr></a> (zip, 18 <abbr title="megabytes">MB</abbr>)<br>
      <abbr title="version 2, provisional run 2">v2prov_r2</abbr>, May 2012</td>
  </tr>
  <tr class="gtablecell">
    <td colspan="5">
      <a href="watersurfacemod_download.php"><strong>2000 - Current</strong></a><strong> available on separate page</strong>
    </td>
  </tr>
  <tr class="grytablehead" style="text-align:center">
    <td colspan="5"><a href="watersurfacemod-archive.php">Archived NetCDF Files</a></td>
  </tr>
  <tr class="gvegtablehead">
    <td colspan="5"><b>Additional Documentation for EDEN NetCDF Files:</b>
      <ul>
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
<table style="width:100%">
  <tr>
    <th colspan="5" class="bltablehead">GeoTiff Files
      <p style="text-align:left">File naming conventions:</p>
      <ul style="text-align:left">
        <li>v# = version  of surface water model (v1 or v2),</li>
        <li>r# = release of surface (r1 or r2),</li>
        <li>prov = provisional</li>
      </ul>
      <p style="text-align:left">New: You may download a year's worth of data all at once. Simply click the link below for each year.  Because of file size limits, the most you can download at one time is a year. If you need to download several year's worth of data at once, please contact Heather Henkel (<a href="mailto:hhenkel@usgs.gov">hhenkel@usgs.gov</a>) and other arrangements can be made.</p>
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
    <td><a href="watersurfacemod-proc.php?year=1991&type=geotiff">1991</a><br>
      (zip, <?php echo round($size['geotiff'][1991]); ?> <abbr title="megabytes">MB</abbr>)</td>
    <td><a href="../data/geotiff/v2/1991_q1_tiff_v2prov_r2.zip">1991 <abbr title="first quarter">Q1</abbr></a> (zip, 65 <abbr title="megabytes">MB</abbr>)<br>
      <abbr title="version 2, provisional run 2">v2prov_r2</abbr>, May 2012</td>
    <td><a href="../data/geotiff/v2/1991_q2_tiff_v2prov_r2.zip">1991 <abbr title="second quarter">Q2</abbr></a> (zip, 65 <abbr title="megabytes">MB</abbr>)<br>
      <abbr title="version 2, provisional run 2">v2prov_r2</abbr>, May 2012</td>
    <td><a href="../data/geotiff/v2/1991_q3_tiff_v2prov_r2.zip">1991 <abbr title="third quarter">Q3</abbr></a> (zip, 65 <abbr title="megabytes">MB</abbr>)<br>
      <abbr title="version 2, provisional run 2">v2prov_r2</abbr>, May 2012</td>
    <td><a href="../data/geotiff/v2/1991_q4_tiff_v2prov_r2.zip">1991 <abbr title="fourth quarter">Q4</abbr></a> (zip, 65 <abbr title="megabytes">MB</abbr>)<br>
      <abbr title="version 2, provisional run 2">v2prov_r2</abbr>, May 2012</td>
  </tr>
  <tr class="gtablecell" style="text-align:center">
    <td><a href="watersurfacemod-proc.php?year=1992&type=geotiff">1992</a><br>
      (zip, <?php echo round($size['geotiff'][1992]); ?> <abbr title="megabytes">MB</abbr>)</td>
    <td><a href="../data/geotiff/v2/1992_q1_tiff_v2prov_r2.zip">1992 <abbr title="first quarter">Q1</abbr></a> (zip, 65 <abbr title="megabytes">MB</abbr>)<br>
      <abbr title="version 2, provisional run 2">v2prov_r2</abbr>, May 2012</td>
    <td><a href="../data/geotiff/v2/1992_q2_tiff_v2prov_r2.zip">1992 <abbr title="second quarter">Q2</abbr></a> (zip, 65 <abbr title="megabytes">MB</abbr>)<br>
      <abbr title="version 2, provisional run 2">v2prov_r2</abbr>, May 2012</td>
    <td><a href="../data/geotiff/v2/1992_q3_tiff_v2prov_r2.zip">1992 <abbr title="third quarter">Q3</abbr></a> (zip, 65 <abbr title="megabytes">MB</abbr>)<br>
      <abbr title="version 2, provisional run 2">v2prov_r2</abbr>, May 2012</td>
    <td><a href="../data/geotiff/v2/1992_q4_tiff_v2prov_r2.zip">1992 <abbr title="fourth quarter">Q4</abbr></a> (zip, 65 <abbr title="megabytes">MB</abbr>)<br>
      <abbr title="version 2, provisional run 2">v2prov_r2</abbr>, May 2012</td>
  </tr>
  <tr class="gtablecell2" style="text-align:center">
    <td><a href="watersurfacemod-proc.php?year=1993&type=geotiff">1993</a><br>
      (zip, <?php echo round($size['geotiff'][1993]); ?> <abbr title="megabytes">MB</abbr>)</td>
    <td><a href="../data/geotiff/v2/1993_q1_tiff_v2prov_r2.zip">1993 <abbr title="first quarter">Q1</abbr></a> (zip, 65 <abbr title="megabytes">MB</abbr>)<br>
      <abbr title="version 2, provisional run 2">v2prov_r2</abbr>, May 2012</td>
    <td><a href="../data/geotiff/v2/1993_q2_tiff_v2prov_r2.zip">1993 <abbr title="second quarter">Q2</abbr></a> (zip, 65 <abbr title="megabytes">MB</abbr>)<br>
      <abbr title="version 2, provisional run 2">v2prov_r2</abbr>, May 2012</td>
    <td><a href="../data/geotiff/v2/1993_q3_tiff_v2prov_r2.zip">1993 <abbr title="third quarter">Q3</abbr></a> (zip, 65 <abbr title="megabytes">MB</abbr>)<br>
      <abbr title="version 2, provisional run 2">v2prov_r2</abbr>, May 2012</td>
    <td><a href="../data/geotiff/v2/1993_q4_tiff_v2prov_r2.zip">1993 <abbr title="fourth quarter">Q4</abbr></a> (zip, 65 <abbr title="megabytes">MB</abbr>)<br>
      <abbr title="version 2, provisional run 2">v2prov_r2</abbr>, May 2012</td>
  </tr>
  <tr class="gtablecell" style="text-align:center">
    <td><a href="watersurfacemod-proc.php?year=1994&type=geotiff">1994</a><br>
      (zip, <?php echo round($size['geotiff'][1994]); ?> <abbr title="megabytes">MB</abbr>)</td>
    <td><a href="../data/geotiff/v2/1994_q1_tiff_v2prov_r2.zip">1994 <abbr title="first quarter">Q1</abbr></a> (zip, 65 <abbr title="megabytes">MB</abbr>)<br>
      <abbr title="version 2, provisional run 2">v2prov_r2</abbr>, May 2012</td>
    <td><a href="../data/geotiff/v2/1994_q2_tiff_v2prov_r2.zip">1994 <abbr title="second quarter">Q2</abbr></a> (zip, 65 <abbr title="megabytes">MB</abbr>)<br>
      <abbr title="version 2, provisional run 2">v2prov_r2</abbr>, May 2012</td>
    <td><a href="../data/geotiff/v2/1994_q3_tiff_v2prov_r2.zip">1994 <abbr title="third quarter">Q3</abbr></a> (zip, 65 <abbr title="megabytes">MB</abbr>)<br>
      <abbr title="version 2, provisional run 2">v2prov_r2</abbr>, May 2012</td>
    <td><a href="../data/geotiff/v2/1994_q4_tiff_v2prov_r2.zip">1994 <abbr title="fourth quarter">Q4</abbr></a> (zip, 65 <abbr title="megabytes">MB</abbr>)<br>
      <abbr title="version 2, provisional run 2">v2prov_r2</abbr>, May 2012</td>
  </tr>
  <tr class="gtablecell2" style="text-align:center">
    <td><a href="watersurfacemod-proc.php?year=1995&type=geotiff">1995</a><br>
      (zip, <?php echo round($size['geotiff'][1995]); ?> <abbr title="megabytes">MB</abbr>)</td>
    <td><a href="../data/geotiff/v2/1995_q1_tiff_v2prov_r2.zip">1995 <abbr title="first quarter">Q1</abbr></a> (zip, 65 <abbr title="megabytes">MB</abbr>)<br>
      <abbr title="version 2, provisional run 2">v2prov_r2</abbr>, May 2012</td>
    <td><a href="../data/geotiff/v2/1995_q2_tiff_v2prov_r2.zip">1995 <abbr title="second quarter">Q2</abbr></a> (zip, 65 <abbr title="megabytes">MB</abbr>)<br>
      <abbr title="version 2, provisional run 2">v2prov_r2</abbr>, May 2012</td>
    <td><a href="../data/geotiff/v2/1995_q3_tiff_v2prov_r2.zip">1995 <abbr title="third quarter">Q3</abbr></a> (zip, 65 <abbr title="megabytes">MB</abbr>)<br>
      <abbr title="version 2, provisional run 2">v2prov_r2</abbr>, May 2012</td>
    <td><a href="../data/geotiff/v2/1995_q4_tiff_v2prov_r2.zip">1995 <abbr title="fourth quarter">Q4</abbr></a> (zip, 65 <abbr title="megabytes">MB</abbr>)<br>
      <abbr title="version 2, provisional run 2">v2prov_r2</abbr>, May 2012</td>
  </tr>
  <tr class="gtablecell" style="text-align:center">
    <td><a href="watersurfacemod-proc.php?year=1996&type=geotiff">1996</a><br>
      (zip, <?php echo round($size['geotiff'][1996]); ?> <abbr title="megabytes">MB</abbr>)</td>
    <td><a href="../data/geotiff/v2/1996_q1_tiff_v2prov_r2.zip">1996 <abbr title="first quarter">Q1</abbr></a> (zip, 65 <abbr title="megabytes">MB</abbr>)<br>
      <abbr title="version 2, provisional run 2">v2prov_r2</abbr>, May 2012</td>
    <td><a href="../data/geotiff/v2/1996_q2_tiff_v2prov_r2.zip">1996 <abbr title="second quarter">Q2</abbr></a> (zip, 65 <abbr title="megabytes">MB</abbr>)<br>
      <abbr title="version 2, provisional run 2">v2prov_r2</abbr>, May 2012</td>
    <td><a href="../data/geotiff/v2/1996_q3_tiff_v2prov_r2.zip">1996 <abbr title="third quarter">Q3</abbr></a> (zip, 65 <abbr title="megabytes">MB</abbr>)<br>
      <abbr title="version 2, provisional run 2">v2prov_r2</abbr>, May 2012</td>
    <td><a href="../data/geotiff/v2/1996_q4_tiff_v2prov_r2.zip">1996 <abbr title="fourth quarter">Q4</abbr></a> (zip, 65 <abbr title="megabytes">MB</abbr>)<br>
      <abbr title="version 2, provisional run 2">v2prov_r2</abbr>, May 2012</td>
  </tr>
  <tr class="gtablecell2" style="text-align:center">
    <td><a href="watersurfacemod-proc.php?year=1997&type=geotiff">1997</a><br>
      (zip, <?php echo round($size['geotiff'][1997]); ?> <abbr title="megabytes">MB</abbr>)</td>
    <td><a href="../data/geotiff/v2/1997_q1_tiff_v2prov_r2.zip">1997 <abbr title="first quarter">Q1</abbr></a> (zip, 65 <abbr title="megabytes">MB</abbr>)<br>
      <abbr title="version 2, provisional run 2">v2prov_r2</abbr>, May 2012</td>
    <td><a href="../data/geotiff/v2/1997_q2_tiff_v2prov_r2.zip">1997 <abbr title="second quarter">Q2</abbr></a> (zip, 65 <abbr title="megabytes">MB</abbr>)<br>
      <abbr title="version 2, provisional run 2">v2prov_r2</abbr>, May 2012</td>
    <td><a href="../data/geotiff/v2/1997_q3_tiff_v2prov_r2.zip">1997 <abbr title="third quarter">Q3</abbr></a> (zip, 65 <abbr title="megabytes">MB</abbr>)<br>
      <abbr title="version 2, provisional run 2">v2prov_r2</abbr>, May 2012</td>
    <td><a href="../data/geotiff/v2/1997_q4_tiff_v2prov_r2.zip">1997 <abbr title="fourth quarter">Q4</abbr></a> (zip, 65 <abbr title="megabytes">MB</abbr>)<br>
      <abbr title="version 2, provisional run 2">v2prov_r2</abbr>, May 2012</td>
  </tr>
  <tr class="gtablecell" style="text-align:center">
    <td><a href="watersurfacemod-proc.php?year=1998&type=geotiff">1998</a><br>
      (zip, <?php echo round($size['geotiff'][1998]); ?> <abbr title="megabytes">MB</abbr>)</td>
    <td><a href="../data/geotiff/v2/1998_q1_tiff_v2prov_r2.zip">1998 <abbr title="first quarter">Q1</abbr></a> (zip, 65 <abbr title="megabytes">MB</abbr>)<br>
      <abbr title="version 2, provisional run 2">v2prov_r2</abbr>, May 2012</td>
    <td><a href="../data/geotiff/v2/1998_q2_tiff_v2prov_r2.zip">1998 <abbr title="second quarter">Q2</abbr></a> (zip, 65 <abbr title="megabytes">MB</abbr>)<br>
      <abbr title="version 2, provisional run 2">v2prov_r2</abbr>, May 2012</td>
    <td><a href="../data/geotiff/v2/1998_q3_tiff_v2prov_r2.zip">1998 <abbr title="third quarter">Q3</abbr></a> (zip, 65 <abbr title="megabytes">MB</abbr>)<br>
      <abbr title="version 2, provisional run 2">v2prov_r2</abbr>, May 2012</td>
    <td><a href="../data/geotiff/v2/1998_q4_tiff_v2prov_r2.zip">1998 <abbr title="fourth quarter">Q4</abbr></a> (zip, 65 <abbr title="megabytes">MB</abbr>)<br>
      <abbr title="version 2, provisional run 2">v2prov_r2</abbr>, May 2012</td>
  </tr>
  <tr class="gtablecell2" style="text-align:center">
    <td><a href="watersurfacemod-proc.php?year=1999&type=geotiff">1999</a><br>
      (zip, <?php echo round($size['geotiff'][1999]); ?> <abbr title="megabytes">MB</abbr>)</td>
    <td><a href="../data/geotiff/v2/1999_q1_tiff_v2prov_r2.zip">1999 <abbr title="first quarter">Q1</abbr></a> (zip, 65 <abbr title="megabytes">MB</abbr>)<br>
      <abbr title="version 2, provisional run 2">v2prov_r2</abbr>, May 2012</td>
    <td><a href="../data/geotiff/v2/1999_q2_tiff_v2prov_r2.zip">1999 <abbr title="second quarter">Q2</abbr></a> (zip, 65 <abbr title="megabytes">MB</abbr>)<br>
      <abbr title="version 2, provisional run 2">v2prov_r2</abbr>, May 2012</td>
    <td><a href="../data/geotiff/v2/1999_q3_tiff_v2prov_r2.zip">1999 <abbr title="third quarter">Q3</abbr></a> (zip, 65 <abbr title="megabytes">MB</abbr>)<br>
      <abbr title="version 2, provisional run 2">v2prov_r2</abbr>, May 2012</td>
    <td><a href="../data/geotiff/v2/1999_q4_tiff_v2prov_r2.zip">1999 <abbr title="fourth quarter">Q4</abbr></a> (zip, 65 <abbr title="megabytes">MB</abbr>)<br>
      <abbr title="version 2, provisional run 2">v2prov_r2</abbr>, May 2012</td>
  </tr>
  <tr class="gtablecell">
    <td colspan="5">
      <a href="watersurfacemod_download.php"><strong>2000 - Current</strong></a><strong> available on separate page</strong>
    </td>
  </tr>
  <tr class="grytablehead" style="text-align:center">
    <td colspan="5"><a href="watersurfacemod-archive.php">Archived GeoTiff Files</a></td>
  </tr>
  <tr class="gvegtablehead">
    <td colspan="5"><b>Additional Documentation for EDEN Geotiff Files:</b>
      <ul>
        <li><a href="https://archive.usgs.gov/archive/sites/sofia.usgs.gov/metadata/sflwww/eden_water_surfs.html">Metadata</a></li>
      </ul>
    </td>
  </tr>
</table>
<h3><a id="dmsoutput"></a>Daily Median Output Files</h3>
<p>Each zip file contains 3 months (one quarter-year) of daily datasets. There are two files for each day: a &quot;median&quot; and a &quot;median_reject&quot;. The &quot;median&quot; file is the one that was used to create the surfaces for a given day; the &quot;median_reject&quot; file contains a list of the gages not used for that day. A <a href="daily_median_readme_v2.txt">readme file</a> is included with each zip file that includes a short description of each file.</p>
<table style="width:100%">
  <tr>
    <th colspan="5" class="bltablehead">Daily Median Output Files
      <p style="text-align:left">File naming conventions:</p>
      <ul style="text-align:left">
        <li>v# = version  of surface water model (v1 or v2),</li>
        <li>r# = release of surface (r1 or r2),</li>
        <li>prov = provisional</li>
      </ul>
      <p style="text-align:left">New: You may download a year's worth of data all at once. Simply click the link below for each year.  Because of file size limits, the most you can download at one time is a year. If you need to download several year's worth of data at once, please contact Heather Henkel (<a href="mailto:hhenkel@usgs.gov">hhenkel@usgs.gov</a>) and other arrangements can be made.</p>
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
    <td><a href="watersurfacemod-proc.php?year=1991&type=dailymedian">1991</a><br>
      (zip, <?php echo round($size['dailymedian'][1991]); ?> <abbr title="megabytes">MB</abbr>)</td>
    <td><a href="../data/dailymedian/v2/1991_q1_DM_v2prov_r2.zip">1991 <abbr title="first quarter">Q1</abbr></a> (zip, .5 <abbr title="megabytes">MB</abbr>)<br>
      <abbr title="version 2, provisional run 2">v2prov_r2</abbr>, May 2012</td>
    <td><a href="../data/dailymedian/v2/1991_q2_DM_v2prov_r2.zip">1991 <abbr title="second quarter">Q2</abbr></a> (zip, .5 <abbr title="megabytes">MB</abbr>)<br>
      <abbr title="version 2, provisional run 2">v2prov_r2</abbr>, May 2012</td>
    <td><a href="../data/dailymedian/v2/1991_q3_DM_v2prov_r2.zip">1991 <abbr title="third quarter">Q3</abbr></a> (zip, .5 <abbr title="megabytes">MB</abbr>)<br>
      <abbr title="version 2, provisional run 2">v2prov_r2</abbr>, May 2012</td>
    <td><a href="../data/dailymedian/v2/1991_q4_DM_v2prov_r2.zip">1991 <abbr title="fourth quarter">Q4</abbr></a> (zip, .5 <abbr title="megabytes">MB</abbr>)<br>
      <abbr title="version 2, provisional run 2">v2prov_r2</abbr>, May 2012</td>
  </tr>
  <tr class="gtablecell" style="text-align:center">
    <td><a href="watersurfacemod-proc.php?year=1992&type=dailymedian">1992</a><br>
      (zip, <?php echo round($size['dailymedian'][1992]); ?> <abbr title="megabytes">MB</abbr>)</td>
    <td><a href="../data/dailymedian/v2/1992_q1_DM_v2prov_r2.zip">1992 <abbr title="first quarter">Q1</abbr></a> (zip, .5 <abbr title="megabytes">MB</abbr>)<br>
      <abbr title="version 2, provisional run 2">v2prov_r2</abbr>, May 2012</td>
    <td><a href="../data/dailymedian/v2/1992_q2_DM_v2prov_r2.zip">1992 <abbr title="second quarter">Q2</abbr></a> (zip, .5 <abbr title="megabytes">MB</abbr>)<br>
      <abbr title="version 2, provisional run 2">v2prov_r2</abbr>, May 2012</td>
    <td><a href="../data/dailymedian/v2/1992_q3_DM_v2prov_r2.zip">1992 <abbr title="third quarter">Q3</abbr></a> (zip, .5 <abbr title="megabytes">MB</abbr>)<br>
      <abbr title="version 2, provisional run 2">v2prov_r2</abbr>, May 2012</td>
    <td><a href="../data/dailymedian/v2/1992_q4_DM_v2prov_r2.zip">1992 <abbr title="fourth quarter">Q4</abbr></a> (zip, .5 <abbr title="megabytes">MB</abbr>)<br>
      <abbr title="version 2, provisional run 2">v2prov_r2</abbr>, May 2012</td>
  </tr>
  <tr class="gtablecell2" style="text-align:center">
    <td><a href="watersurfacemod-proc.php?year=1993&type=dailymedian">1993</a><br>
      (zip, <?php echo round($size['dailymedian'][1993]); ?> <abbr title="megabytes">MB</abbr>)</td>
    <td><a href="../data/dailymedian/v2/1993_q1_DM_v2prov_r2.zip">1993 <abbr title="first quarter">Q1</abbr></a> (zip, .5 <abbr title="megabytes">MB</abbr>)<br>
      <abbr title="version 2, provisional run 2">v2prov_r2</abbr>, May 2012</td>
    <td><a href="../data/dailymedian/v2/1993_q2_DM_v2prov_r2.zip">1993 <abbr title="second quarter">Q2</abbr></a> (zip, .5 <abbr title="megabytes">MB</abbr>)<br>
      <abbr title="version 2, provisional run 2">v2prov_r2</abbr>, May 2012</td>
    <td><a href="../data/dailymedian/v2/1993_q3_DM_v2prov_r2.zip">1993 <abbr title="third quarter">Q3</abbr></a> (zip, .5 <abbr title="megabytes">MB</abbr>)<br>
      <abbr title="version 2, provisional run 2">v2prov_r2</abbr>, May 2012</td>
    <td><a href="../data/dailymedian/v2/1993_q4_DM_v2prov_r2.zip">1993 <abbr title="fourth quarter">Q4</abbr></a> (zip, .5 <abbr title="megabytes">MB</abbr>)<br>
      <abbr title="version 2, provisional run 2">v2prov_r2</abbr>, May 2012</td>
  </tr>
  <tr class="gtablecell" style="text-align:center">
    <td><a href="watersurfacemod-proc.php?year=1994&type=dailymedian">1994</a><br>
      (zip, <?php echo round($size['dailymedian'][1994]); ?> <abbr title="megabytes">MB</abbr>)</td>
    <td><a href="../data/dailymedian/v2/1994_q1_DM_v2prov_r2.zip">1994 <abbr title="first quarter">Q1</abbr></a> (zip, .5 <abbr title="megabytes">MB</abbr>)<br>
      <abbr title="version 2, provisional run 2">v2prov_r2</abbr>, May 2012</td>
    <td><a href="../data/dailymedian/v2/1994_q2_DM_v2prov_r2.zip">1994 <abbr title="second quarter">Q2</abbr></a> (zip, .5 <abbr title="megabytes">MB</abbr>)<br>
      <abbr title="version 2, provisional run 2">v2prov_r2</abbr>, May 2012</td>
    <td><a href="../data/dailymedian/v2/1994_q3_DM_v2prov_r2.zip">1994 <abbr title="third quarter">Q3</abbr></a> (zip, .5 <abbr title="megabytes">MB</abbr>)<br>
      <abbr title="version 2, provisional run 2">v2prov_r2</abbr>, May 2012</td>
    <td><a href="../data/dailymedian/v2/1994_q4_DM_v2prov_r2.zip">1994 <abbr title="fourth quarter">Q4</abbr></a> (zip, .5 <abbr title="megabytes">MB</abbr>)<br>
      <abbr title="version 2, provisional run 2">v2prov_r2</abbr>, May 2012</td>
  </tr>
  <tr class="gtablecell2" style="text-align:center">
    <td><a href="watersurfacemod-proc.php?year=1995&type=dailymedian">1995</a><br>
      (zip, <?php echo round($size['dailymedian'][1995]); ?> <abbr title="megabytes">MB</abbr>)</td>
    <td><a href="../data/dailymedian/v2/1995_q1_DM_v2prov_r2.zip">1995 <abbr title="first quarter">Q1</abbr></a> (zip, .5 <abbr title="megabytes">MB</abbr>)<br>
      <abbr title="version 2, provisional run 2">v2prov_r2</abbr>, May 2012</td>
    <td><a href="../data/dailymedian/v2/1995_q2_DM_v2prov_r2.zip">1995 <abbr title="second quarter">Q2</abbr></a> (zip, .5 <abbr title="megabytes">MB</abbr>)<br>
      <abbr title="version 2, provisional run 2">v2prov_r2</abbr>, May 2012</td>
    <td><a href="../data/dailymedian/v2/1995_q3_DM_v2prov_r2.zip">1995 <abbr title="third quarter">Q3</abbr></a> (zip, .5 <abbr title="megabytes">MB</abbr>)<br>
      <abbr title="version 2, provisional run 2">v2prov_r2</abbr>, May 2012</td>
    <td><a href="../data/dailymedian/v2/1995_q4_DM_v2prov_r2.zip">1995 <abbr title="fourth quarter">Q4</abbr></a> (zip, .5 <abbr title="megabytes">MB</abbr>)<br>
      <abbr title="version 2, provisional run 2">v2prov_r2</abbr>, May 2012</td>
  </tr>
  <tr class="gtablecell" style="text-align:center">
    <td><a href="watersurfacemod-proc.php?year=1996&type=dailymedian">1996</a><br>
      (zip, <?php echo round($size['dailymedian'][1996]); ?> <abbr title="megabytes">MB</abbr>)</td>
    <td><a href="../data/dailymedian/v2/1996_q1_DM_v2prov_r2.zip">1996 <abbr title="first quarter">Q1</abbr></a> (zip, .5 <abbr title="megabytes">MB</abbr>)<br>
      <abbr title="version 2, provisional run 2">v2prov_r2</abbr>, May 2012</td>
    <td><a href="../data/dailymedian/v2/1996_q2_DM_v2prov_r2.zip">1996 <abbr title="second quarter">Q2</abbr></a> (zip, .5 <abbr title="megabytes">MB</abbr>)<br>
      <abbr title="version 2, provisional run 2">v2prov_r2</abbr>, May 2012</td>
    <td><a href="../data/dailymedian/v2/1996_q3_DM_v2prov_r2.zip">1996 <abbr title="third quarter">Q3</abbr></a> (zip, .5 <abbr title="megabytes">MB</abbr>)<br>
      <abbr title="version 2, provisional run 2">v2prov_r2</abbr>, May 2012</td>
    <td><a href="../data/dailymedian/v2/1996_q4_DM_v2prov_r2.zip">1996 <abbr title="fourth quarter">Q4</abbr></a> (zip, .5 <abbr title="megabytes">MB</abbr>)<br>
      <abbr title="version 2, provisional run 2">v2prov_r2</abbr>, May 2012</td>
  </tr>
  <tr class="gtablecell2" style="text-align:center">
    <td><a href="watersurfacemod-proc.php?year=1997&type=dailymedian">1997</a><br>
      (zip, <?php echo round($size['dailymedian'][1997]); ?> <abbr title="megabytes">MB</abbr>)</td>
    <td><a href="../data/dailymedian/v2/1997_q1_DM_v2prov_r2.zip">1997 <abbr title="first quarter">Q1</abbr></a> (zip, .5 <abbr title="megabytes">MB</abbr>)<br>
      <abbr title="version 2, provisional run 2">v2prov_r2</abbr>, May 2012</td>
    <td><a href="../data/dailymedian/v2/1997_q2_DM_v2prov_r2.zip">1997 <abbr title="second quarter">Q2</abbr></a> (zip, .5 <abbr title="megabytes">MB</abbr>)<br>
      <abbr title="version 2, provisional run 2">v2prov_r2</abbr>, May 2012</td>
    <td><a href="../data/dailymedian/v2/1997_q3_DM_v2prov_r2.zip">1997 <abbr title="third quarter">Q3</abbr></a> (zip, .5 <abbr title="megabytes">MB</abbr>)<br>
      <abbr title="version 2, provisional run 2">v2prov_r2</abbr>, May 2012</td>
    <td><a href="../data/dailymedian/v2/1997_q4_DM_v2prov_r2.zip">1997 <abbr title="fourth quarter">Q4</abbr></a> (zip, .5 <abbr title="megabytes">MB</abbr>)<br>
      <abbr title="version 2, provisional run 2">v2prov_r2</abbr>, May 2012</td>
  </tr>
  <tr class="gtablecell" style="text-align:center">
    <td><a href="watersurfacemod-proc.php?year=1998&type=dailymedian">1998</a><br>
      (zip, <?php echo round($size['dailymedian'][1998]); ?> <abbr title="megabytes">MB</abbr>)</td>
    <td><a href="../data/dailymedian/v2/1998_q1_DM_v2prov_r2.zip">1998 <abbr title="first quarter">Q1</abbr></a> (zip, .5 <abbr title="megabytes">MB</abbr>)<br>
      <abbr title="version 2, provisional run 2">v2prov_r2</abbr>, May 2012</td>
    <td><a href="../data/dailymedian/v2/1998_q2_DM_v2prov_r2.zip">1998 <abbr title="second quarter">Q2</abbr></a> (zip, .5 <abbr title="megabytes">MB</abbr>)<br>
      <abbr title="version 2, provisional run 2">v2prov_r2</abbr>, May 2012</td>
    <td><a href="../data/dailymedian/v2/1998_q3_DM_v2prov_r2.zip">1998 <abbr title="third quarter">Q3</abbr></a> (zip, .5 <abbr title="megabytes">MB</abbr>)<br>
      <abbr title="version 2, provisional run 2">v2prov_r2</abbr>, May 2012</td>
    <td><a href="../data/dailymedian/v2/1998_q4_DM_v2prov_r2.zip">1998 <abbr title="fourth quarter">Q4</abbr></a> (zip, .5 <abbr title="megabytes">MB</abbr>)<br>
      <abbr title="version 2, provisional run 2">v2prov_r2</abbr>, May 2012</td>
  </tr>
  <tr class="gtablecell2" style="text-align:center">
    <td><a href="watersurfacemod-proc.php?year=1999&type=dailymedian">1999</a><br>
      (zip, <?php echo round($size['dailymedian'][1999]); ?> <abbr title="megabytes">MB</abbr>)</td>
    <td><a href="../data/dailymedian/v2/1999_q1_DM_v2prov_r2.zip">1999 <abbr title="first quarter">Q1</abbr></a> (zip, .5 <abbr title="megabytes">MB</abbr>)<br>
      <abbr title="version 2, provisional run 2">v2prov_r2</abbr>, May 2012</td>
    <td><a href="../data/dailymedian/v2/1999_q2_DM_v2prov_r2.zip">1999 <abbr title="2nd quarter">Q2</abbr></a> (zip, .5 <abbr title="megabytes">MB</abbr>)<br>
      <abbr title="version 2, provisional run 2">v2prov_r2</abbr>, May 2012</td>
    <td><a href="../data/dailymedian/v2/1999_q3_DM_v2prov_r2.zip">1999 <abbr title="3rd quarter">Q3</abbr></a> (zip, .5 <abbr title="megabytes">MB</abbr>)<br>
      <abbr title="version 2, provisional run 2">v2prov_r2</abbr>, May 2012</td>
    <td><a href="../data/dailymedian/v2/1999_q4_DM_v2prov_r2.zip">1999 <abbr title="4th quarter">Q4</abbr></a> (zip, .5 <abbr title="megabytes">MB</abbr>)<br>
      <abbr title="version 2, provisional run 2">v2prov_r2</abbr>, May 2012</td>
  </tr>
  <tr class="gtablecell">
    <td colspan="5">
      <a href="watersurfacemod_download.php"><strong>2000 - Current</strong></a><strong> available on separate page</strong>
    </td>
  </tr>
  <tr class="grytablehead" style="text-align:center">
    <td colspan="5"><a href="watersurfacemod-archive.php">Archived Daily Median Output Files</a></td>
  </tr>
  <tr class="gvegtablehead">
    <td colspan="5"><b>Additional Documentation for Daily Median Output Files:</b>
      <ul>
        <li><a href="daily_median_readme_v2_051412.txt">Release Notes</a> (new daily median file format - updated May 2012)</li>
      </ul>
    </td>
  </tr>
</table>
<?php require ($_SERVER['DOCUMENT_ROOT'] . '/../eden/ssi/eden-foot.php'); ?>