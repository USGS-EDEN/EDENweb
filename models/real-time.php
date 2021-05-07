<?php
// Generate array of quarters, decending (nc.zip files)
$viewExt2 = '_v3rt_nc.zip';
$dirHandle = opendir('../data/realtime2/');
while ($file = readdir($dirHandle))
  if (preg_match("/($viewExt2)$/i", $file))
    $stack2[] = $file;
closedir($dirHandle);
rsort($stack2);
// For every quarterly _v3rt_nc.zip surface file, get associated dailys, quarterly geotif.zip
$tbl = '';
foreach($stack2 as $value2) {
  $viewExt = 'rt.zip';   // only days with geotiffs will be displayed
  $dirHandle = opendir('../data/realtime2/');

  // Add only those files from the quarter to $stack
  $stack = array();
  while ($file = readdir($dirHandle))
    if (preg_match("/($viewExt)$/i", $file) && ceil(substr($file, 4, 2) / 3) == substr($value2, 6, 1)) //check month of file in current qtr
      $stack[] = $file;
  closedir($dirHandle);
  rsort($stack);
  $filedate_check = $i = 0;
  $stack_first_pass = 1;

  // Cycle through all the files for the quarter
  foreach($stack as $value) {
    $filedate = substr($value, 0, 8);
    $d = substr($filedate, 4, 2) . '/' . substr($filedate, 6, 2) . '/' . substr($filedate, 0, 4);
    $y = substr($value2, 0, 4);
    $q = substr($value2, 6, 1);
    $c = count($stack);
    $tbl .= "<tr class='gtablecell";
    $tbl .= $i++ % 2 == 1 ? '2' : '';
    $tbl .= "'>\n<td>\n$d</td>\n<td>\n";
    $tbl .= file_exists("../data/realtime2/{$filedate}_median_flag_v3rt.txt") ? "<a href='../data/realtime2/{$filedate}_median_flag_v3rt.txt' target='_blank'>Daily&nbsp;Median</a>\n" : '(missing)';
    $tbl .= "<br><a href='../data/realtime2/$value'>GeoTiff</a>\n</td>\n<td>\n";
    $tbl .= is_file("../data/pngs/EDENsurface_$filedate.png") ? "<a href='../data/pngs/EDENsurface_$filedate.png' target='_blank'><img src='../data/pngs/EDENsurface_{$filedate}_small.png' alt='EDEN surface for $filedate'></a></td>\n" : "(missing)</td>\n";
    $tbl .= $stack_first_pass == 1 ? "<td rowspan='$c' style='vertical-align:top'><a href='../data/realtime2/" . substr($value2, 0, 13) . "geotif.zip'>$y Quarter $q <strong>Water Surface</strong> GeoTiff</a><br>(contains the dates for this quarter listed at left)<br></td>
    <td rowspan='$c' style='vertical-align:top'><a href='../data/realtime2/$value2'>$y Quarter $q <strong>Water Surface</strong> NetCDF</a><br>(contains the dates for this quarter listed at left)<br></td>\n" : '';
    $tbl .= "<td>\n";
    $tbl .= is_file("../data/pngs/EDENsurface_{$filedate}_depth.png") ? "<a href='../data/pngs/EDENsurface_{$filedate}_depth.png' target='_blank'><img src='../data/pngs/EDENsurface_{$filedate}_depth_small.png' alt='EDEN surface for $filedate'></a></td>\n" : "(missing)</td>\n";
    $tbl .= $stack_first_pass++ == 1 ? "<td rowspan='$c' style='vertical-align:top'><a href='../data/realtime2/" . substr($value2, 0, 10) . "rt_depth_nc.zip'>$y Quarter $q <strong>Water Depth</strong> NetCDF</a><br>(contains the dates for this quarter listed at left)<br></td>\n" : '';
    $tbl .= "</tr>\n";
  }
}
$title = "<title>Real-Time Water Surfaces and Water Depths - Everglades Depth Estimation Network (EDEN)</title>\n";
require ($_SERVER['DOCUMENT_ROOT'] . '/../eden/ssi/eden-head.php');
?>
<h2>Real-Time Water Surfaces and Water Depths</h2>
<p>EDEN real-time water surfaces are created daily using real-time water level data for the EDEN network. Most data relayed by satellite or other telemetry have received little or no review. Inaccuracies in the data may be present because of instrument malfunctions or physical changes at the measurement site. A threshold comparison program eliminates daily values that appear erroneous (i.e. extremely high or low, extremely different from previous days). <strong>Subsequent review of the data may result in significant revisions to the data.</strong></p>
<p>Users are cautioned to consider carefully the provisional nature of the information when using provisional data.</p>
<p>Within approximately 45 days after the end of each quarter (December 31, March 31, June 30, September 30), finalized and approved water level data are provided by SFWMD and ENP at which time real-time EDEN surfaces will be <a href="watersurfacemod.php">replaced by provisional surfaces</a>. EDEN surfaces created with final, approved water level data from all agency gages will be available in approximately July of each year for the previous year's water year (October &ndash; September).</p>
<p>(Note: NetCDF files contain up to three months worth of files; daily geotiff files have been zipped up (.zip) and contain a .tif and .aux file)</p>
<table style="width:700px;margin:20px auto;text-align:center">
  <tr class="grtablehead">
    <th colspan="7">It is recommended to always review the daily median file to see which gages were used in the production of the daily surface</th>
  </tr>
  <tr class="gtablehead">
    <th style="width:14%">Date</th>
    <th style="width:14%">Daily Water<br>Surface (WS)</th>
    <th style="width:10%">WS<br>Quick View</th>
    <th style="width:17%">WS Geotiff<br>(Quarterly)</th>
    <th style="width:17%">WS NetCDF<br>(Quarterly)</th>
    <th style="width:10%;background-color:#D2EBF3">Water Depth<br>Quick View</th>
    <th style="width:19%;background-color:#D2EBF3">Water Depth<br>NetCDF (Quarterly)</th>
  </tr>
  <tr class="tablecell">
    <th colspan='7' style="background-color:#f1b7a6">Input data on weekends and holidays will be reviewed on the next business day. The daily water-level surface will be updated and posted that day.</th>
  </tr>
<?php echo $tbl; ?>
</table>
<?php require ($_SERVER['DOCUMENT_ROOT'] . '/../eden/ssi/eden-foot.php'); ?>