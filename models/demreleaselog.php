<?php
$title = "<title>Ground Elevation: Release Log - Everglades Depth Estimation Network (EDEN)</title>\n";
require ($_SERVER['DOCUMENT_ROOT'] . '/eden/ssi/eden-head.php');
?>
<h2>Ground Elevation Model &ndash; Release Log</h2>
<table style="width:90%">
  <tr class="gtablehead">
    <th>Date</th>
    <th>Release</th>
    <th>Comments</th>
  </tr>
  <tr class="gtablecell">
    <td>January 2007</td>
    <td><p>EDEN_EM_JAN07</p></td>
    <td><p>EDEN <abbr title="Digital Elevation Model">DEM</abbr> produced at a resolution of <strong>60<abbr title="meter">m</abbr> by 60<abbr title="meter">m</abbr></strong> to facilitate satellite-based research</p></td>
  </tr>
  <tr class="gtablecell2">
    <td>November 2007</td>
    <td><p>EDEN_EM_OCT07</p></td>
    <td><p>EDEN <abbr title="Digital Elevation Model">DEM</abbr> has been resampled to <strong>400<abbr title="meter">m</abbr> by 400<abbr title="meter">m</abbr></strong> to match the resolution of the input <abbr title="high accuracy elevation data">HAED</abbr> data and the EDEN applications for which it was developed</p></td>
  </tr>
  <tr class="gtablecell">
    <td>November 2007</td>
    <td><p>EDEN_CM_NOV07</p></td>
    <td><p>EDEN <abbr title="Digital Elevation Model">DEM</abbr> produced at centimeter resolution for use with the EDENapps Tools. (The previous versions were at meter resolution.)</p></td>
  </tr>
  <tr class="gtablecell2">
    <td>January 2010</td>
    <td><p>EDEN_EM_JA10</p></td>
    <td><p><a href="groundelevmod.php">EDEN DEM (meter units)</a>, gridded at 400<abbr title="meters">m</abbr> by 400<abbr title="meters">m</abbr>, updated:</p>
      <ul>
        <li><p>the krigging algorithm applied to newly modeled subareas was changed from ordinary to universal krigging - resulting in slightly lower errors during cross-validation and accuracy assessment.</p></li>
        <li><p>a previously omitted area in the northwestern corner of the Everglades National Park (ENP) and southern Big Cypress National Preserve (BCNP) has been filled.</p></li>
        <li><p>to increase accuracy in WCA1, the most challenging EDEN subarea from an elevation modeling standpoint, the Conservation area is subdivided into 4 zones (Northern, Central, Southwest and Southeast).</p></li>
      </ul>
      <p>The <a href="groundelevmod-archive.php">previous DEM has been archived</a>.</p>
    </td>
  </tr>
  <tr class="gtablecell">
    <td>January 2010</td>
    <td><p>EDEN_EM_CM_JA10-NOTCH</p></td>
    <td><p><a href="groundelevmod-edenapps.php">New EDEN DEM& (centimeter units)</a> released for use specifically in EDENapps Tools. Changes include:</p>
      <ul>
        <li><p>elevation values have been converted from meters (m) to centimeters (cm)</p></li>
        <li><p>data has been removed from the southern Big Cypress National Preserve and northwestern Everglades National Park area so that this DEM boundary matches the boundary or domain of the EDEN surface-water model still in use in EDEN applications software.</p></li>
      </ul>
    </td>
  </tr>
  <tr class="gtablecell2">
    <td>October 2011</td>
    <td><p>EDEN_EM_CM_JA10</p></td>
    <td><p><a href="groundelevmod-edenapps.php">Updated January 2010 version of EDENapps DEM (centimeter units) released</a>. Area of southern Big Cypress National Preserve and northwestern Everglades National Park filled in so that DEM now matchs the version 2 (V2) water surface model in that area.</p>
      <p>The <a href="groundelevmod-archive.php">previous DEM has been archived</a>.</p>
    </td>
  </tr>
</table>
<?php require ($_SERVER['DOCUMENT_ROOT'] . '/eden/ssi/eden-foot.php'); ?>