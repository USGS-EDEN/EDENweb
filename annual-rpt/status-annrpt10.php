<?php
$title = "<title>Learn About EDEN - Fiscal Year 2010 Status Report - Everglades Depth Estimation Network (EDEN)</title>\n";
require ($_SERVER['DOCUMENT_ROOT'] . '/../eden/ssi/eden-head.php');
?>
<h4>Learn About EDEN</h4>
<h3>Status Report - <abbr title="Fiscal Year 2010">FY10</abbr></h3>
<p><strong>Period Covered:</strong> October 1, 2009 through September 30, 2010</p>
<p><strong>Project:</strong> South Florida Surface Water Monitoring Network for Support of <abbr title="Monitoring and Assessment Plan">MAP</abbr> Projects<br>
<strong>Agency:</strong> <abbr title="U.S. Geological Survey">U.S. Geological Survey (USGS)</abbr><br>
<strong><abbr title="U.S. Geological Survey">USGS</abbr> Point of Contact:</strong> Pamela Telis, <a href="mailto:patelis@usgs.gov">patelis@usgs.gov</a>, 904-232-2602<br>
<strong><abbr title="U.S. Army Corps of Engineers">USACE</abbr> Point of Contact:</strong> David Tipple, 904-232-1375, Gretchen Ehlinger, 904-232-1682<br>
<strong>Agreement:</strong> <abbr title="U.S. Geological Survey">USGS</abbr> IA#28 under <abbr title="Memorandum of Agreement">MOA</abbr> between <abbr title="U.S. Geological Survey">USGS</abbr> and <abbr title="U.S. Army Corps of Engineers">USACE</abbr></p>
<p>This annual report for 2010 summarizes the major accomplishments, lists of deliverables, and outlines the work plan for 2011 for the EDEN project. The EDEN's primary deliverable and product continues to be the EDENweb (<a href="../">http://sofia.usgs.gov eden</a>); the project website that provides all data, results, documentation, and other project information for EDEN users.</p>
<figure style="width:225px;margin:20px auto;border:1px solid black">
  <a href="EDENAnnualReport2010.pdf"><img src="images/EDENAnnualReport2010.gif" alt="thumbnail image of 2010 Status Report" height="347" width="225"></a>
  <figcaption class="caption" style="background-color:#f1fcdd"><a href="EDENAnnualReport2010.pdf">Download &quot;2010 Annual Report&quot;</a> (<abbr title="P D F">PDF</abbr> file, 0.5 <abbr title="megabytes">MB</abbr>)</figcaption>
</figure>
<h3><abbr title="one">I</abbr>. Major Accomplishments</h3>
<ul>
  <li><a href="../models/watersurfacemod_download.php">Real-time, provisional, and final EDEN surfaces</a> are being produced and posted to EDENweb on schedule. Surfaces currently posted on the EDENweb include:
    <ul>
      <li>Final for 1/1/2000 through 9/30/09</li>
      <li>Provisional for 10/1/09 through 6/30/10</li>
      <li>Real-time for 7/1/10 through current</li>
    </ul>
  </li>
  <li>Expanded and improved EDEN surface water interpolation model
    <ul>
      <li>Improved water level datasets with datum corrections and gapfilling techniques</li>
      <li>Added area south of Big Cypress Natural Preserve</li>
      <li>Dry protocols for gage data were tested</li>
      <li>Several canal files revisions were made and tested</li>
      <li>Tested revisions with water level data from new <a href="../benchmarks/">benchmark network</a></li>
      <li>Started development of subarea models for potential improvements of results and for scenario testing using model</li>
      <li>Model to be finalized and documented in first quarter 2011</li>
    </ul>
  </li>
  <li>Continued to improve quality and efficiency of data management
    <ul>
      <li>Improved communication and response time with agencies for addressing problems with water-level data</li>
      <li>Improved scripts that load, test, and verify data sets in <abbr title="National Water Information System">NWIS</abbr> database</li>
      <li>GAPFILL program now processed in a SQL server for improved computing capabilities and efficiency of processing</li>
      <li>Began testing the inferential sensor tool for daily data processing.</li>
    </ul>
  </li>
  <li>EDEN <a href="../models/groundelevmod.php">digital elevation model for ground surface</a> revised and expanded in 2009 was documented with <a href="https://archive.usgs.gov/archive/sites/sofia.usgs.gov/metadata/sflwww/eden_em_oc11.html">metadata</a> and posted to EDENweb for users
    <figure style="width:220px;margin:20px auto;border:1px solid black">
      <a href="images/newdemsx_10.jpg"><img src="images/newdems_10.jpg" alt="map showing study area for which new digital elevation models have been developed" width="216" height="315"></a>
      <figcaption class="caption" style="background-color:#f1fcdd">The shaded polygons represent the areas of the EDEN study area for which new <a href="../models/groundelevmod.php">digital elevation models</a> have been developed: <abbr title="Water Conservation Area 1">WCA1</abbr> (4 new models), the northwest corner of <abbr title="Everglades National Park">ENP</abbr>/southern portion of <abbr title="Big Cypress National Preserve">BCNP</abbr>. [<a href="images/newdemsx_10.jpg">larger version</a>]</figcaption>
    </figure>
  </li>
</ul>
<ul>
  <li>Revisions to EDENapps completed, including:
    <ul>
      <li>Easier and consistent loading of datasets</li>
      <li>Improved color ramps</li>
      <li>Standardization of terms and techniques across tools</li>
      <li>Crashing problems were identified and fixed</li>
    </ul>
  </li>
  <li><a href="../nexrad.php">Rainfall</a> and <abbr title="evapotranspiration"><a href="../evapotrans.php">evapotranspiration (ET)</a></abbr><a href="../evapotrans.php"> data</a> continue to be updated regularly for the EDEN gage network and posted to the EDENweb. Currently, <a href="../nexrad.php">rainfall data</a> available for 2002 to 2010 and <abbr title="evapotranspiration"><a href="../evapotrans.php">ET</a></abbr><a href="../evapotrans.php"> data</a> available for 1995 to 2009.</li>
  <li>Database and webpage created for <abbr title="benchmark"><a href="../benchmarks/">benchmark (BM)</a></abbr> <a href="../benchmarks/">network</a> installed by <abbr title="U.S. Army Corps of Engineers">USACE</abbr> at EDEN direction
    <ul>
      <li><abbr title="benchmark"><a href="../benchmarks/">BM</a></abbr><a href="../benchmarks/"> network</a> used to test/verify new EDEN surface-water model</li>
      <li>First <a href="../benchmarks/">network of <abbr title="benchmarks">BMs</abbr></a> in Everglades marsh away from water-level gages</li>
    </ul>
    <figure style="width:275px;margin:20px auto;border:1px solid black">
      <a href="images/bmarkpgx_10.jpg"><img src="images/bmarkpg_10.jpg" alt="screen shot of webpage created for benchmark network" width="274" height="281"></a>
      <figcaption class="caption" style="background-color:#f1fcdd"><a href="../benchmarks/">http://sofia.usgs.gov/eden/benchmarks/</a> [<a href="images/bmarkpgx_10.jpg">larger version</a>]</figcaption>
    </figure>
    <figure style="width:230px;margin:20px auto;border:1px solid black">
      <a href="images/bmarkmapx_10.gif"><img src="images/bmarkmap_10.gif" alt="map of south Florida showing location of benchmarks" width="230" height="318"></a>
      <figcaption class="caption" style="background-color:#f1fcdd">Map showing location of benchmarks [<a href="images/bmarkmapx_10.gif">larger version</a>]</figcaption>
    </figure>
  </li>
</ul>
<ul>
  <li>Compilation of a data library of <abbr title="Tides and Inflows in the Mangrove Ecotone">TIME</abbr> model input for 10/1/06 through 9/30/09. This data set will allow running of the <abbr title="Tides and Inflows in the Mangrove Ecotone">TIME</abbr> (now called the <abbr title="BIscayne SouthEastern Coastal Transport">BISECT</abbr> model) for <abbr title="Everglades National Park">ENP</abbr> for use in the coastal EDEN analyses planned in 2011.</li>
  <li>Support to numerous <abbr title="REstoration COordination and VERification">RECOVER</abbr>-funded and other Everglades Investigators (examples below):
    <ul>
      <li>Joel Trexler, <abbr title="Florida International University">FIU</abbr> &ndash; developed spreadsheet format of selected water depth data for assessment of fish datasets:
        <figure style="width:470px;margin:20px auto;border:1px solid black">
          <a href="images/trexlerx_10.gif"><img src="images/trexler_10.gif" alt="example of Joel Trexler's spreadsheet format of selected water depth data for assessment of fish datasets" width="468" height="167"></a>
          <figcaption class="caption" style="background-color:#f1fcdd">[<a href="images/trexlerx_10.gif">larger version</a>]</figcaption>
        </figure>
      </li>
      <li>Vic Engel, <abbr title="Everglades National Park">ENP</abbr> &ndash; Three-month mean water level surfaces for 2009 <abbr title="System Status Report">SSR</abbr>:
        <figure style="width:470px;margin:20px auto;border:1px solid black">
          <a href="images/engelx_10.jpg"><img src="images/engel_10.jpg" alt="example of Vic Engel's three-month mean water level surfaces maps" width="468" height="333"></a>
          <figcaption class="caption" style="background-color:#f1fcdd">[<a href="images/engelx_10.jpg">larger version</a>]</figcaption>
        </figure>
      </li>
    </ul>
  </li>
  <li><a href="../newsletter.php">EDEN Newsletter</a> currently has 120 subscribers and is used to notify users of updates or additions to the EDEN website.</li>
</ul>
<h3><abbr title="two">II</abbr>. Significant Meetings/Workshops/Conferences</h3>
<ul>
  <li>The EDEN team participated in <a href="https://archive.usgs.gov/archive/sites/sofia.usgs.gov/geer/2010/"><abbr title="Greater Everglades Ecosystem Restoration">GEER</abbr> 2010</a> with 5 posters and 2 oral presentations (All posters are posted on EDENweb):
    <ul>
      <li>Higer, A., Conrads, P., Henkel, H., Telis, P., and McCloskey, B., <a href="https://archive.usgs.gov/archive/sites/sofia.usgs.gov/publications/posters/coastal_eden/">Conceptual Components for the <abbr title="Coastal Everglades Depth Estimation Network">Coastal Everglades Depth Estimation Network (Coastal EDEN)</abbr></a>, <abbr title="Greater Everglades Ecosystem Restoration 2010">GEER2010</abbr>.</li>
      <li>Roehl, E., Daamen, R., and Conrads, P., Development of Inferential Sensors for Real-time Quality Control of Water-level Data for the EDEN Network, <abbr title="Greater Everglades Ecosystem Restoration 2010">GEER2010</abbr>.</li>
      <li>Conrads, P., Xie, Z., McCloskey, B., <a href="https://archive.usgs.gov/archive/sites/sofia.usgs.gov/publications/posters/hindcasting_eden/index.html">Hindcasting Water-Surface Elevations for Water Conservation Area 3A</a> South, <abbr title="Greater Everglades Ecosystem Restoration 2010">GEER2010</abbr>.</li>
      <li>Petkewich, M., Conrads, P., and Reece, B., <a href="https://archive.usgs.gov/archive/sites/sofia.usgs.gov/publications/posters/auto_est_level_eden/index.html">Automation of the Estimation of Missing Water-Level Data for the <abbr title="Everglades Depth Estimation Network">Everglades Depth Estimation Network (EDEN)</abbr></a>, <abbr title="Greater Everglades Ecosystem Restoration 2010">GEER2010</abbr>.</li>
      <li>Telis, P., McCloskey, B., and Xie, Z., Using a Network of Benchmarks to Evaluate and Verify the EDEN Surface-Water Model, <abbr title="Greater Everglades Ecosystem Restoration 2010">GEER2010</abbr>.</li>
      <li>Xie, Z., Liu, Z., Pearlstine, L., Sonenshein, R., Conrads, P., Henkel, H., and Telis, P., Revision and Assessment of Water-Surface Modeling of the <abbr title="Everglades Depth Estimation Network">Everglades Depth Estimation Network (EDEN)</abbr>, <abbr title="Greater Everglades Ecosystem Restoration 2010">GEER2010</abbr>.</li>
      <li>Xie, Z., Liu, Z., Jones, J., Higer, A., Telis, P., and Conrads, P., Revisions to the EDEN Ground-Surface Digital Elevation Model and Water Surface Model in the Water Conservation Area 1, <abbr title="Greater Everglades Ecosystem Restoration 2010">GEER2010</abbr>.</li>
    </ul>
  </li>
  <li><abbr title="United Nations Educational, Scientific and Cultural Organization">UNESCO</abbr> seminars
    <ul>
      <li>Bryan McCloskey (presenter), The <abbr title="South Florida Information Access">South Florida Information Access (SOFIA)</abbr> System and <abbr title="Everglades Depth Estimation Network">Everglades Depth Estimation Network (EDEN)</abbr>, June 8, 2010, Davie, <abbr title="Florida">FL</abbr> </li>
    </ul>
  </li>
  <li>Community for Data Integration Workshop
    <ul>
      <li>Conrads, P., Xie, Z., McCloskey, B., Hindcasting Water-Surface Elevations for Water Conservation Area 3A.</li>
      <li>Henkel, H. and McCloskey, B., <abbr title="Everglades Depth Estimation Network">Everglades Depth Estimation Network (EDEN)</abbr>: How the Right Mix of Scripts, Programs and Databases Can Create Better Maps, Data, and Tools.</li>
      <li>Higer, A., Conrads, P., Henkel, H., Telis, P., and McCloskey, B., Conceptual Components for the <abbr title="Coastal Everglades Depth Estimation Network">Coastal Everglades Depth Estimation Network (Coastal EDEN)</abbr>.</li>
    </ul>
  </li>
  <li>Other conferences
    <ul>
      <li><em><abbr title="third">3<sup>rd</sup></abbr> <abbr title="U.S. Geological Survey">USGS</abbr> Modeling Conference</em> -- Revision and Assessment of Water-Surface Modeling of the <abbr title="Everglades Depth Estimation Network">Everglades Depth Estimation Network (EDEN)</abbr>.</li>
      <li><em><a href="http://www.clemson.edu/restoration/events/past_events/sc_water_resources/archives_2010/index.html">2010 South Carolina Water Resources Conference</a></em> -- New approved paper will be presented in October -- Daamen, R.C., Roehl, E.A., and Conrads, P.C., 2010, Development of Inferential Sensors for Real-time Quality Control of Water-level Data for the Everglades Depth Estimation Network: <em>Proceedings of the 2010 South Carolina Water Resources Conference,</em> held October 13-14, 2010, at the Columbia Metropolitan Convention Center.</li>
    </ul>
  </li>
</ul>
<h3><abbr title="three">III</abbr>. Administrative (Contractual and Budgetary)</h3>
<ul>
  <li>The previous agreement, <abbr title="U.S. Geological Survey">USGS</abbr> IA#12 under <abbr title="Memorandum of Agreement">MOA</abbr> between <abbr title="U.S. Geological Survey">USGS</abbr> and <abbr title="U.S. Army Corps of Engineers">USACE</abbr>, ended 3/31/10. A final report delivered on 3/18/10 documented all deliverables for that agreement.</li>
  <li>A new agreement, <abbr title="U.S. Geological Survey">USGS</abbr> IA# 28 under the <abbr title="Memorandum of Agreement">MOA</abbr> between <abbr title="U.S. Geological Survey">USGS</abbr> and <abbr title="U.S. Army Corps of Engineers">USACE</abbr>, started 4/1/10 for the period 4/1/10 through 3/31/15.</li>
  <li>University of Florida (<abbr title="University of Florida">UF</abbr>, Aaron Higer) and Florida Atlantic University (<abbr title="Florida Atlantic University">FAU</abbr>, Zhixiao Xie, Zhongwei Liu) were funded by the EDEN project through a <abbr title="Cooperative Ecosystem Studies Units">CESU</abbr> agreement in <abbr title="Fiscal Year 2010">FY10</abbr> for:
    <ul>
      <li>Revision/documentation of the EDEN surface water interpolation program</li>
      <li>Compilation of <abbr title="Tides and Inflows in the Mangrove Ecotone">TIME</abbr> datasets for the period 2007-2009.</li>
    </ul>
  </li>
</ul>
<h3><abbr title="four">IV</abbr>. Support from other Programs and Funding Sources</h3>
<ul>
  <li>The <abbr title="REstoration COordination and VERification">RECOVER</abbr> Evaluation Team funded (<abbr title="Fiscal Year 2010">FY2010</abbr>) the compilation of data for creation of <a href="../hindcasted.php">hindcasted water level data</a> and generation of EDEN surfaces prior to 2000 back to 1990 for the EDEN domain. Effort to be completed 3/31/11. Figure below shows preliminary results for <abbr title="Water Conservation Area 3A">WCA3A</abbr>-South.
    <figure style="width:380px;margin:20px auto;border:1px solid black">
      <a href="images/watersurfx_10.jpg"><img src="images/watersurf_10.jpg" alt="1992 and 1995 maps showing water surfaces for WCA3AS" width="374" height="342"></a>
      <figcaption class="caption" style="background-color:#f1fcdd">[<a href="images/watersurfx_10.jpg">larger version</a>]</figcaption>
    </figure>
  </li>
</ul>
<ul>
  <li>Greater Everglades <abbr title="Priority Ecosystems Science">PES</abbr> funds continue to support the EDEN project by funding efforts by Paul Conrads (<abbr title="U.S. Geological Survey, South Carolina">USGS-SC</abbr>), John Jones (<abbr title="U.S. Geological Survey">USGS</abbr>-Reston), Heather Henkel (<abbr title="U.S. Geological Survey, Saint Petersburg">USGS-St. Pete</abbr>), and Bryan McCloskey (<abbr title="U.S. Geological Survey, Saint Petersburg">USGS-St. Pete</abbr>). Additionally, <abbr title="Priority Ecosystems Science">PES</abbr> provides some funds for Pamela Telis (<abbr title="U.S. Geological Survey">USGS</abbr>-Jacksonville) in her role as project coordinator and liaison with the <abbr title="U.S. Army Corps of Engineers">USACE</abbr>.</li>
  <li><abbr title="American Recovery and Reinvestment Act">ARRA</abbr> (economic stimulus) funding (June 2009 through Sept 2010) supported an effort by <abbr title="Advanced Data Mining">Advanced Data Mining (ADM)</abbr>, <abbr title="limited liability company">LLC</abbr> to address data quality issues by developing an intelligent software application to automate the validation and correction of data, in the case of EDEN, prior to creation of the <a href="../models/watersurfacemod.php">daily water level surfaces</a>. Additionally, the <abbr title="American Recovery and Reinvestment Act">ARRA</abbr> funding partially supported the <abbr title="Cooperative Ecosystem Studies Units">CESU</abbr> agreement with Florida Atlantic University to improve the surface water interpolation program based on the improved datasets based on <abbr title="Advanced Data Mining's">ADM's</abbr> effort. The final report for this effort is due 9/30/10.</li>
  <li><abbr title="U.S. Army Corps of Engineers">USACE</abbr> funding paid to install and survey a <a href="../benchmarks/">network of benchmarks</a> throughout the Everglades, collect water level data at this network (during wet season 2009, dry season 2010, and wet season 2010), install continuous water level recorders at <a href="../benchmarks/">benchmarks</a> in Everglades National Park, survey elevations to <abbr title="North American Vertical Datum of 1988">NAVD88</abbr> datum at 8 water level gages in Everglades National Park, and collect ground elevation data at 12 water level gages. The EDEN project used these data to improve the quality of the EDEN daily water level surfaces.</li>
</ul>
<h3><abbr title="five">V</abbr>. <abbr title="Fiscal Year 2010">FY10</abbr> Deliverables/Reports</h3>
<ul>
  <li>EDENweb has been updated throughout the year to provide data, metadata, and documentation to <abbr title="Monitoring and Assessment Plan">MAP</abbr> <abbr title="Principal Investigators">PIs</abbr> and others.</li>
  <li>Report (partially funded by <abbr title="U.S. Geological Survey">USGS</abbr> <abbr title="Priority Ecosystems Science">PES</abbr> funds):
    <ul>
      <li>Xie, Z., Liu, Z., Jones, J., Higer, A., and Telis, P., Landscape Unit Based Digital Elevation Model Development in the Freshwater Wetlands of Southeastern Florida, submitted to the Journal of Applied Geology, September 2010.</li>
    </ul>
  </li>
  <li>For the 2009 System Status Report, EDEN provided hydroperiod maps and mean monthly water depth data to assist with hydrologic assessments of component areas of the Everglades and for understanding the total system hydrology. Then in July 2010, the <abbr title="System Status Report">SSR</abbr> review team asked that EDEN prepare additional maps that show contours of the water surface elevation and flow directions through the EDEN domain during wet and dry conditions. See example above.</li>
</ul>
<h3><abbr title="six">VI</abbr>. <abbr title="Fiscal Year 2011">FY11</abbr> Workplan</h3>
<ul>
  <li>Data management and daily water surface creation
    <ul>
      <li>Create and post daily water surfaces on schedule</li>
      <li>Implement automated data assurance and estimation program</li>
      <li>Use new datum surveys at gages to revise water level data</li>
      <li>Add new gages if appropriate</li>
      <li>Implement rules for handling 'dry' data at gages and in EDEN surfaces</li>
      <li>Complete revision of surface-water model</li>
      <li>Use water level data at <a href="../benchmarks/">benchmarks</a> to evaluate/improve EDEN surfaces</li>
      <li>Post <a href="../benchmarks/">benchmark data</a> to the EDENweb</li>
    </ul>
  </li>
  <li>Fully test, document and use the newly revised surface model for EDEN surfacing
    <ul>
      <li>Develop confidence layers for surfaces</li>
      <li>Pilot additional surfaces, such as slope, rainfall, <abbr title="evapotranspiration">ET</abbr></li>
    </ul>
  </li>
  <li>Continue to enhance the EDENweb to provide users with data and information that is user-friendly and easily accessible </li>
  <li>Complete effort to <a href="../hindcasted.php">hindcast water-level data</a> and create of water surfaces prior to 2000</li>
  <li>Implement webpage for EDEN oligohaline zone (<a href="../coastal.php">coastal EDEN</a>)</li>
  <li>Update <a href="../nexrad.php">rainfall</a> and <a href="../evapotrans.php">evapotranspiration data</a> on schedule</li>
  <li>Participate in <abbr title="National Conference on Ecosystem Restoration 2011">NCER2011 </abbr></li>
  <li>Consider collaboration with National Wetlands Research Center for revisions to EDENapps </li>
  <li>Conduct hydrologic assessments for <abbr title="REstoration COordination and VERification">RECOVER</abbr></li>
  <li>Continue to document EDEN protocols, research, and data analyses</li>
</ul>
<h3><abbr title="seven">VII</abbr>. Anticipated Needs or Issues</h3>
<ul>
  <li>The needs/issues reported in the 2009 Annual Report are still relevant and of concern to the EDEN project team. See bullets below.</li>
  <li>Because the water level data at gages is the foundation of the EDEN surface water interpolation program, the quality of gage data is critical to the resultant EDEN daily water surfaces. Gage data used for EDEN surfaces comes from multiple agencies with varying protocols, schedules, and levels of review. It is a highly ambitious goal to receive hourly data from 230 gages daily (approximately 5520 data values). Even if only 1% (rarely this low) of these data appear bad or are missing, 55 values per day or 5000 values per quarter must be identified and resolved. Monitoring, reviewing, editing (when necessary) and estimating missing and bad data has taken more personnel time than expected. Users see the results as EDEN products when, in fact, they are the result of many others' work outside of EDEN. It has been a serious challenge for me as the project chief to balance sufficient data quality with adequate results and appropriate use of funds.</li>
  <li>EDEN staff continues to be concerned that datum surveys and water level data is not as accurate as necessary to produce a high-quality interpolated water-level surface. Independent data sets at gages may look adequate but when surfaced together can show discontinuities and shifts not seen when viewing water level data gage by gage. Continued investigation of data and files suggests that gage data may still have datum inaccuracies. New funding in 2011 may be available to run new datum surveys to the newest standards for many gages in the Everglades. Any significant changes to the water level dataset might require another round of reparameterizing of the surface water model.</li>
</ul>
<a id="sxn8"></a>
<h3><abbr title="eight">VIII</abbr>. Funding Status</h3>
<ul>
  <li>As of 9/30/10, part of the <abbr title="Fiscal Year 2010">FY10</abbr> funding under the new agreement has been expended or obligated. The remaining for the hindcasting effort will be expended by 3/31/11 as per the agreement.</li>
  <li><abbr title="American Recovery and Reinvestment Act">ARRA</abbr> (economic stimulus) funding was received 6/29/09 and is fully expended as of 9/30/10.</li>
  <li><abbr title="U.S. Geological Survey">USGS</abbr> <abbr title="Priority Ecosystems Science">Priority Ecosystem Science (PES)</abbr> funding in <abbr title="Fiscal Year 2010">FY2010</abbr> was  to multiple principal investigators in support for EDEN research efforts. This level of support is expected to be continued in <abbr title="Fiscal Year 2011">FY2011</abbr>.</li>
</ul>
<?php require ($_SERVER['DOCUMENT_ROOT'] . '/../eden/ssi/eden-foot.php'); ?>