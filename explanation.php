<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Explanation of Terms and Methods: Water-Level Data - Everglades Depth Estimation Network (EDEN)</title>
  <link rel="stylesheet" href="/eden/css/eden-dbweb-html5.css">
  <script src="https://www.usgs.gov/scripts/analytics/usgs-analytics.js"></script>
  <style>
    table { border-collapse: collapse; margin: 20px 20px }
    table, td, th { border: 1px solid #477489 }
    td, th { padding: 2px }
  </style>
</head>
<body>
<?php require ($_SERVER['DOCUMENT_ROOT'] . '/eden/ssi/eden-head.txt'); ?>
<?php require ($_SERVER['DOCUMENT_ROOT'] . '/eden/ssi/nav.php'); ?>
<div style="overflow:hidden;padding-right:8px;background-color:white"><!--Begin body of page -->
  <h4>Explanations of Terms and Methods (for Water-Level Values)</h4>
  <ul>
    <li><a href="#opagency">Operating Agency</a></li>
    <li><a href="#stationname">EDEN Station Name</a></li>
    <li><a href="#locationarea">Location Area</a></li>
    <li><a href="#datalinks">Data Links</a></li>
    <li><a href="#gagedataref">Datum Information</a></li>
    <li><a href="#groundelev">Ground Elevation and Vegetation Information</a></li>
    <li><a href="#vegecomm">Vegetation Community</a></li>
    <li><a href="#typeofstation">Type of Station</a></li>
  </ul>
  <table style="width:400px">
    <tr>
      <td colspan="2" class="gtablehead"><a id="opagency"></a>Operating Agency:</td>
    </tr>
    <tr>
      <td class="gtablecell"><abbr title="Big Cypress National Preserve">BCNP</abbr></td>
      <td class="gtablecell"><a href="http://www.nps.gov/bicy">Big Cypress National Preserve</a></td>
    </tr>
    <tr>
      <td class="gtablecell"><abbr title="Everglades National Park">ENP</abbr></td>
      <td class="gtablecell"><a href="http://www.nps.gov/ever">Everglades National Park</a></td>
    </tr>
    <tr>
      <td class="gtablecell"><abbr title="South Florida Water Management District">SFWMD</abbr></td>
      <td class="gtablecell"><a href="http://www.sfwmd.gov/">South Florida Water Mangement District</a></td>
    </tr>
    <tr>
      <td class="gtablecell"><abbr title="U.S. Geological Survey">USGS</abbr></td>
      <td class="gtablecell"><a href="http://www.usgs.gov/">U.S. Geological Survey</a></td>
    </tr>
  </table>
  <table style="width:450px">
    <tr>
      <td class="gtablehead"><a id="stationname"></a>EDEN Station Name:</td>
    </tr>
    <tr>
      <td class="gtablecell">The station name used in the site is specific to the EDEN site.  It generally is the same name as the agency station name, but there could be slight variations (either this is a shortened form, or a modified form).  For example:
        <ul>
          <li>EDEN name: 3A9; Station name used by operating agency: 3A9+</li>
          <li>EDEN name: 3AN1W1; Station name used by operating agency: 3AN1W1+</li>
        </ul>
      </td>
    </tr>
  </table>
  <table style="width:550px">
    <tr>
      <td colspan="3" class="gtablehead"><a id="locationarea"></a>Location Area:</td>
    </tr>
    <tr>
      <td class="gtablecell" colspan="3">Area of Everglades where gage is located (gages along canals are reported by the canal name, gages across canals are reported by what area the headwater or tailwater gage measures)</td>
    </tr>
    <tr>
      <td class="gtablecell2">Marsh Stations Choices:</td>
      <td class="gtablecell2">Canal Stations Choices:</td>
      <td class="gtablecell2">Coastal Stations Choices:</td>
    </tr>
    <tr>
      <td class="gtablecell"><abbr title="Big Cypress National Preserve">BCNP</abbr></td>
      <td class="gtablecell">Hillsboro Canal</td>
      <td class="gtablecell">Coast of Florida Bay</td>
    </tr>
    <tr>
      <td class="gtablecell"><abbr title="Everglades National Park">ENP</abbr></td>
      <td class="gtablecell">Tamiami Canal</td>
      <td class="gtablecell">Coast of Gulf of Mexico</td>
    </tr>
    <tr>
      <td class="gtablecell"><abbr title="Water Conservation Area 1">WCA1</abbr></td>
      <td class="gtablecell">L-40</td>
      <td class="gtablecell"></td>
    </tr>
    <tr>
      <td class="gtablecell"><abbr title="Water Conservation Area 2A">WCA2A</abbr></td>
      <td class="gtablecell">etc.</td>
      <td class="gtablecell"></td>
    </tr>
    <tr>
      <td class="gtablecell"><abbr title="Water Conservation Area 2B">WCA2B</abbr></td>
      <td class="gtablecell"></td>
      <td class="gtablecell"></td>
    </tr>
    <tr>
      <td class="gtablecell"><abbr title="Water Conservation Area 3A">WCA3A</abbr></td>
      <td class="gtablecell"></td>
      <td class="gtablecell"></td>
    </tr>
    <tr>
      <td class="gtablecell"><abbr title="Water Conservation Area 3B">WCA3B</abbr></td>
      <td class="gtablecell"></td>
      <td class="gtablecell"></td>
    </tr>
    <tr>
      <td class="gtablecell">Pennsuco Wetlands</td>
      <td class="gtablecell"></td>
      <td class="gtablecell"></td>
    </tr>
  </table>
  <table style="width:550px">
    <tr>
      <td colspan="2" class="gtablehead"><a id="datalinks"></a>Data Links:</td>
    </tr>
    <tr>
      <td class="gtablecell2" style="width:35%">Available Parameters</td>
      <td class="gtablecell">List of data parameters stored in the <abbr title="Everglades Depth Estimation Network">EDEN</abbr> database; data for graphing and downloading available using Explore and View EDEN (EVE) webpage.</td>
    </tr>
    <tr>
      <td class="gtablecell2">Daily Water Level Percentiles</td>
      <td class="gtablecell">Link to daily water-level percentile plot used to monitor water level during the Everglades Restoration Transition Plan (ERTP) period. Data also used to compare water levels during the ERTP period with water levels that occurred during the Interim Operational Plan (IOP) period.</td>
    </tr>
    <tr>
      <td class="gtablecell2">Operating Agency Link (if available)</td>
      <td class="gtablecell">
        <p>Link to the operating agency for the original source data, full period of record (POR) for the gage, and other parameter datasets, if available. Note that Everglades National Park (ENP) has no public web access to their database.</p>
        <p>Point of contact for operating agencies:</p>
        <ul>
          <li><abbr title="Big Cypress National Preserve">BCNP</abbr>: <a href="mailto:Robert_Sobczak@nps.gov">Robert Sobczak</a></li>
          <li><abbr title="Everglades National Park">ENP</abbr>: <a href="mailto:George_Schardt@nps.gov">George Schardt</a></li>
          <li><abbr title="South Florida Water Management District">SFWMD</abbr>: <a href="mailto:speterk@sfwmd.gov">Sharon Peterkin</a></li>
          <li><abbr title="U.S. Geological Survey">USGS</abbr>: <a href="mailto:mdickman@usgs.gov">Mark Dickman</a></li>
        </ul>
      </td>
    </tr>
  </table>
  <table style="width:550px">
    <tr>
      <td colspan="2" class="gtablehead">Datum Information:</td>
    </tr>
    <tr>
      <td class="gtablecell2" style="width:35%"><a id="gagedataref"></a>Why are all gage data not referenced to the same datum?</td>
      <td class="gtablecell">
        <p>Prior to 1991, all water gages were surveyed to the National Geodetic Vertical Datum of 1929 (<abbr title="National Geodetic Vertical Datum of 1929">NGVD29</abbr>) in Florida, a vertical reference from which Elevations can be measured to provide relative differences between water levels at gages. In 1991, the North American Vertical Datum of 1988 (<abbr title="North American Vertical Datum of 1988">NAVD88</abbr>) was established and some gages were referenced from this new vertical reference. In south Florida, the difference between elevations referenced in <abbr title="National Geodetic Vertical Datum of 1929">NGVD29</abbr> and elevations referenced to <abbr title="North American Vertical Datum of 1988">NAVD88</abbr> are between 1 and 2 feet depending on the location. (See <a href="http://wwwest.ngs.noaa.gov/faq.shtml">wwwest.ngs.noaa.gov/faq.shtml</a> for more information about vertical datums.)</p>
        <p>Data for many gages in the EDEN network are referenced to <abbr title="National Geodetic Vertical Datum of 1929">NGVD29</abbr> by the operating agencies. When posted to EDENweb, they have been converted to <abbr title="North American Vertical Datum of 1988">NAVD88</abbr> using the conversion value documented on the station information page. Some gages operated by the USGS have not yet been converted to <abbr title="North American Vertical Datum of 1988">NAVD88</abbr>.</p>
        <p>Users are advised to note the datum of all datasets to avoid using or comparing data with different datums.</p>
      </td>
    </tr>
    <tr>
      <td class="gtablecell2"><a id="convertgage"></a>How do I convert data at a gage from one datum to another?</td>
      <td class="gtablecell">
        <p>The Station Information page for each gage on EDENweb provides the value to convert data at the gage from <abbr title="National Geodetic Vertical Datum of 1929">NGVD29</abbr> to <abbr title="North American Vertical Datum of 1988">NAVD88</abbr>:</p>
        <ul>
          <li>For data in <abbr title="National Geodetic Vertical Datum of 1929">NGVD29</abbr>, ADD the conversion value</li>
          <li>For data in <abbr title="North American Vertical Datum of 1988">NAVD88</abbr>, SUBTRACT the conversion value</li>
        </ul>
        <p>For example: Site 69:</p>
        <ul>
          <li>On 01/16/07 at 12:00, gage height = 8.63 ft. <abbr title="National Geodetic Vertical Datum of 1929">NGVD29</abbr></li>
          <li>To convert to <abbr title="North American Vertical Datum of 1988">NAVD88</abbr>: 8.63 + (-1.66) = 6.97 ft. <abbr title="North American Vertical Datum of 1988">NAVD88</abbr></li>
        </ul>
        <p>For example: Site L28_GAP:</p>
        <ul>
          <li>On 01/21/07 at 01:00, gage height = 10.22 ft. <abbr title="North American Vertical Datum of 1988">NAVD88</abbr></li>
          <li>To convert to <abbr title="National Geodetic Vertical Datum of 1929">NGVD29</abbr>: 10.22 - (-1.42) = 11.64 ft. <abbr title="North American Vertical Datum of 1988">NAVD88</abbr></li>
        </ul>
      </td>
    </tr>
    <tr>
      <td class="gtablecell2"><a id="conversiondeterm"></a>How were the vertical conversions at gages determined by EDEN?</td>
      <td class="gtablecell">
        <p>The operating agencies provided the vertical conversions at most gages. For gages only surveyed to <abbr title="North American Vertical Datum of 1988">NAVD88</abbr>, the datum conversion was estimated using the CORPSCON 6.0 for VERTCON version 2.5 grid modified by the <abbr title="U.S. Army Corps of Engineers">USACE</abbr> Jacksonville District to incorporate the <abbr title="Comprehensive Everglades Restoration Plan">CERP</abbr> vertical control network established in 2001-2002 (Rory Sutton, <abbr title="U.S. Army Corps of Engineers">USACE</abbr>).</p>
        <p>More information about CORPSCON 6.0: <a href="http://crunch.tec.army.mil/software/corpscon/corpscon.html">http://crunch.tec.army.mil/software/corpscon/corpscon.html</a></p>
      </td>
    </tr>
  </table>
  <table style="width:450px">
    <tr>
      <td class="gtablehead"><a id="groundelev"></a>Ground Elevation and Vegetation Information:</td>
    </tr>
    <tr>
      <td class="gtablecell2">Only the most current measurement of ground elevation and observation of vegetation are provided. When new data are collected, previous data are replaced.</td>
    </tr>
    <tr>
      <td class="gtablecell">
        <p>Ground elevation at gages is determined in one of two ways:</p>
        <ol>
          <li>Ground elevation was provided by the operating agency if one measurement of ground elevation is indicated. Generally, no data of measurement is available.</li>
          <li>Water depth was measured or ground elevation was surveyed at a minimum of 6 locations in the major vegetation community surrounding the water level <a href="geprotocol.php"><img src="images/figures/gage-orientationth.gif" alt="thumbnail of line drawing showing methodology for obtaining water depths" height="144" width="139" style="float:right"></a>gaging station. For water depth measurements, the ground elevation at each site was calculated by subtracting the water depth from the water level reading at the gage. The ground elevations for all measurements were averaged to compute the reported value.</li>
        </ol>
        <p><a href="geprotocol.php"><strong>Protocol for 6-location method for collection of data at a water level (stage) gage</strong></a> is available.</p>
      </td>
    </tr>
  </table>
  <table style="width:500px">
    <tr>
      <td class="gtablehead"><a id="vegecomm"></a>Vegetation Community:</td>
    </tr>
    <tr>
      <td class="gtablecell">
        <p>Vegetation community at the gage, field descriptions are categorized into major communities for freshwater and tidal gages.</p>
        <p>Choices for freshwater gages:</p>
        <ul>
          <li>Slough or open water</li>
          <li>Wet prairie</li>
          <li>Ridge or sawgrass and emergent marsh</li>
          <li>Exotics and cattail</li>
          <li>Upland</li>
          <li>Canal (gage constructed in a canal along a levee or in the marsh but not at a canal structure)</li>
          <li>Other (mostly wetland shrub and wetland forested)</li>
        </ul>
        <p>Choices for tidal gages:</p>
        <ul>
          <li>Marsh</li>
          <li>Upland</li>
          <li>Forest</li>
          <li>Open water (river, canal, bay, etc.)</li>
        </ul>
      </td>
    </tr>
  </table>
  <table style="width:550px">
    <tr>
      <td class="gtablehead"><a id="typeofstation"></a>Type of Station:</td>
    </tr>
    <tr>
      <td class="gtablecell">
        <p><strong>Physical Location:</strong> Canal and marsh indicate stations located in uncontrolled regions, canal structure indicates a station located within a canal at a structure, usually with an associated station on the other side of the structure, marsh structure indicates a station located in the marsh at a structure, usually with an associated station on the other side of the structure. In both cases, the associated station does not have to be of the same type (canal or marsh). Values:</p>
        <ul>
          <li>Canal</li>
          <li>Canal structure</li>
          <li>Marsh</li>
          <li>Marsh structure</li>
          <li>River</li>
          <li>Forest</li>
        </ul>
        <p><strong>Water:</strong> There are only two options for this value:</p>
        <ul>
          <li>Freshwater</li>
          <li>Tidal</li>
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