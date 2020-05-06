<?php
$title = "<title>Difference Maps - Everglades Depth Estimation Network (EDEN)</title>\n";
require ($_SERVER['DOCUMENT_ROOT'] . '/eden/ssi/eden-head.php');
?>
<h2><img src="../images/maps/eden_difference_mapth.gif" alt="EDEN Difference Map" width="196" height="250" style="float:right">Difference Maps</h2>
<p>EDEN difference maps show users how the daily water-level surfaces created with the V2 model differ from surfaces created with the V1 model. Some users may find that, for their study area, the newly revised surfaces are not significantly different from the previous surfaces. In this case, downloading all the new surfaces may not be necessary.</p>
<p>The difference maps were created by subtracting the original, version 1 (V1) surfaces from newly-processed version 2 (V2) [V2-V1]. For the majority of difference maps provided below, this is V2(final) - V1(final). However, please note that for the WY11 files (2010_q4, 2011_q1, and 2011_q2), only provisional V1 surfaces were created, therefore the difference maps show V2(final) - V1(provisional) data.</p>
<table style="width:100%">
  <tr>
    <th colspan="2" class="grtablehead">Difference Maps</th>
  </tr>
<?php
for ($i = 2000; $i <= 2011; $i++) {
	if ($i == 2011) { $k_max = 2; $month_max = 6; }
	else { $k_max = 4; $month_max = 12; }
	echo "  <tr class='gvegtablehead'>
    <th scope='col' colspan='2'>$i</th>
  </tr>
  <tr class='gtablecell'>
    <th>Quarterly Files:</th>
    <td><strong>Netcdf:</strong> ";
	for ($k = 1; $k <= $k_max; $k++)
		echo "<a href='/eden/data/diffmaps/netcdf/{$i}_q{$k}-diff.zip'>{$i}_q{$k}</a> | ";
	echo '<br><strong>PDF:</strong> ';
	for ($k = 1; $k <= $k_max; $k++)
		echo "<a href='/eden/data/diffmaps/pdf/{$i}_q{$k}_diffmap.pdf'>{$i}_q{$k}</a> | ";
	echo "<br>(please note you will need to have the <a href='http://www.adobe.com/products/reader.html'>free Adobe Acrobat Reader</a> in order to view the PDF files.)</td>
  </tr>
  <tr class='gtablecell2'>
    <th>Daily Files:</th>
    <td>";
	for ($j = strtotime($i . '-01-01 12:00:00'); $j <= strtotime($i . '-' . $month_max . '-31 12:00:00'); $j += 86400) # no June 31, but breaks cleanly
		echo "<a href='/eden/data/diffmaps/png/" . strftime('%Y%m%d', $j) . "_diffmap.png'>" . strftime('%Y%m%d', $j) . '</a> | ';
	echo "</td>
  </tr>\n";
}
?>
  <tr class="grytablehead">
    <td colspan="2" style="text-align:center">Questions or comments? Please contact Heather Henkel (<a href="mailto:hhenkel@usgs.gov">hhenkel@usgs.gov</a>).</td>
  </tr>
</table>
<?php require ($_SERVER['DOCUMENT_ROOT'] . '/eden/ssi/eden-foot.php'); ?>