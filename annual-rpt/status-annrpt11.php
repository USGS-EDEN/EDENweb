<?php
$title = "<title>Learn About EDEN - Fiscal Year 2011 Status Report - Everglades Depth Estimation Network (EDEN)</title>\n";
require ($_SERVER['DOCUMENT_ROOT'] . '/../eden/ssi/eden-head.php');
?>
<h4>Learn About EDEN</h4>
<h3>Status Report - <abbr title="Fiscal Year 2011">FY11</abbr></h3>
<p><strong>Period Covered:</strong> October 1, 2010 through September 30, 2011</p>
<p><strong>Project:</strong> South Florida Surface Water Monitoring Network for Support of <abbr title="Monitoring and Assessment Plan">MAP</abbr> Projects<br>
<strong>Agency:</strong> <abbr title="U.S. Geological Survey">U.S. Geological Survey (USGS)</abbr><br>
<strong><abbr title="U.S. Geological Survey">USGS</abbr> Point of Contact:</strong> Pamela Telis, <a href="mailto:patelis@usgs.gov">patelis@usgs.gov</a>, 904-232-2602<br>
<strong><abbr title="U.S. Army Corps of Engineers">USACE</abbr> Point of Contact:</strong> David Tipple, 904-232-1375, Gretchen Ehlinger, 904-232-1682<br>
<strong>Agreement:</strong> <abbr title="U.S. Geological Survey">USGS</abbr> IA#28 under <abbr title="Memorandum of Agreement">MOA</abbr> between <abbr title="U.S. Geological Survey">USGS</abbr> and <abbr title="U.S. Army Corps of Engineers">USACE</abbr></p>
<p>This annual report for 2011 summarizes the major accomplishments, lists deliverables and reports, and outlines the work plan for 2012 for the EDEN project. The EDEN's primary deliverable and product continues to be the EDENweb (<a href="../">http://sofia.usgs.gov/eden</a>); the project website that provides all data, results, documentation, and other project information for EDEN users.</p>
<figure style="width:225px;margin:20px auto;border:1px solid black">
  <a href="EDENAnnualReport2011.pdf"><img src="images/EDENAnnualReport2011.gif" alt="thumbnail image of 2011 Status Report" height="346" width="225"></a>
  <figcaption class="caption" style="background-color:#f1fcdd"><a href="EDENAnnualReport2011.pdf">Download &quot;2011 Annual Report&quot;</a> (<abbr title="P D F">PDF</abbr> file, 0.4 <abbr title="megabytes">MB</abbr>)</figcaption>
</figure>
<h3><abbr title="one">I</abbr>. Major Accomplishments</h3>
<ul>
  <li><strong><a href="../models/watersurfacemod_download.php">Real-time, provisional, and final EDEN surfaces</a></strong> are being produced and posted to EDENweb on schedule. Surfaces currently posted on the EDENweb include:
    <ul>
      <li>Final for 1/1/2000 through 9/30/2010 (using <abbr title="version 2">V2</abbr> surface-water model)</li>
      <li>Provisional for 10/1/2010 through 6/30/2011 (using <abbr title="version 2">V2</abbr> surface-water model)</li>
      <li>Real-time for 7/1/2011 through current</li>
    </ul>
  </li>
  <li>Additionally, all surfaces 1/1/2000 through 6/30/11 have been recreated using our <strong>new expanded and improved EDEN surface water interpolation model (<abbr title="version 2">V2</abbr> model)</strong>
    <ul>
      <li>Real-time surfaces using <abbr title="version 2">V2</abbr> model to go online during the first quarter of <abbr title="Fiscal Year 2012">FY2012</abbr>.</li>
    </ul>
  </li>
  <li>Completed development of the <strong>EDEN surface-water model (<abbr title="version 2">V2</abbr>).</strong> Revisions include:
    <ul>
      <li><em>Model platform changes</em> &ndash; Python and the <abbr title="Environmental Systems Research Institute Arc G I S 9.3.1">ESRI ArcGIS9.3.1</abbr> Geoprocessing package replaces Winbatch and <abbr title="Environmental Systems Research Institute Arc G I S Arc Map">ESRI ArcGIS ArcMap</abbr> 9.1 and creates a more efficient model that is easier to run and update.</li>
      <li><em>Expansion of the EDEN domain</em> &ndash; The model domain is expanded to include the remainder of Big Cypress National Preserve and Everglades National Park along the southwest coast of Florida.</li>
      <li><em>Development of subarea models for selected basins</em> &ndash; Subarea models developed for <abbr title="Water Conservation Area 1">WCA1</abbr>, <abbr title="Water Conservation Area 2 B">WCA2B</abbr>, <abbr title="Water Conservation Area 3 B">WCA3B</abbr> and Pennsuco Wetlands better represent the hydrology of these basins. These surfaces are then merged to the full domain model for the final daily water surface.</li>
      <li><em>Changes to canal files</em> - The canal files in the <abbr title="version 2">V2</abbr> full domain model are used the same way as in the <abbr title="version 1">V1</abbr> model. In the <abbr title="version 2">V2</abbr> model, several canal files were updated, added, or deleted to better represent the hydraulic conditions near canals.</li>
      <li><em>Updated water-level gage data</em> &ndash; Water-level gage data for the <abbr title="version 2">V2</abbr> model is updated by adding, deleting and revising gage data based on new information about the gage network.</li>
      <li><em>Model validation</em> -- The model was assessed with <a href="../benchmarks/">benchmark data</a>, surface contour and expert comments which confirmed its improved performance.</li>
      <li>See <a href="#fig1">figure 1</a>.</li>
    </ul>
    <a id="fig1"></a>
    <figure style="width:450px;margin:20px auto;border:1px solid black">
      <a href="images/fig1x_11.jpg"><img src="images/fig1_11.jpg" alt="example maps of daily water-level surfaces created by version 1 EDEN surface-water model and version 2 EDEN surface-water model" width="450" height="272"></a>
      <figcaption class="caption" style="background-color:#f1fcdd"><strong>Figure 1.</strong> Example of daily water-level surfaces created by <abbr title="version 1">V1</abbr> EDEN surface-water model and <abbr title="version 2">V2</abbr> EDEN surface-water model (note change in model domain) [<a href="images/fig1x_11.jpg">larger version</a>]</figcaption>
    </figure>
  </li>
  <li>The <strong><abbr title="Automated Data Assurance and Management">ADAM (Automated Data Assurance and Management)</abbr> software</strong> developed in <abbr title="Fiscal Year 2011">FY2011</abbr> is making data review and processing much more efficient.
    <ul>
      <li><abbr title="Automated Data Assurance and Management">ADAM</abbr> is being used for quarterly and annual data processing to find and fill data gaps and problem data.</li>
      <li><abbr title="Automated Data Assurance and Management">ADAM</abbr> was used to review the historic 10-year data set (2000-2009) and to find and fill data gaps and problem data.</li>
      <li><abbr title="Automated Data Assurance and Management">ADAM</abbr> will be used for real-time data processing.</li>
      <li>See <a href="#fig2">figure 2</a>.</li>
    </ul>
    <a id="fig2"></a>
    <figure style="width:470px;margin:20px auto;border:1px solid black">
      <a href="images/fig2x_11.gif"><img src="images/fig2_11.gif" alt="screenshot of Automated Data Assurance and Management software screen" width="468" height="252"></a>
      <figcaption class="caption" style="background-color:#f1fcdd"><strong>Figure 2.</strong> Example of <abbr title="Automated Data Assurance and Management">ADAM</abbr> software screen for a single gage that is reviewed, gap filled, and stored. [<a href="images/fig2x_11.gif">larger version</a>]</figcaption>
    </figure>
  </li>
  <li>Developed independent <strong>EDEN database</strong> that will supplement the <abbr title="U.S. Geological Survey">USGS</abbr> <abbr title="National Water Information System">NWIS</abbr> database for expanded EDEN capabilities. This database was necessitated by <abbr title="Automated Data Assurance and Management">ADAM</abbr> software datasets and confidence index computations and allows storage of <abbr title="Automated Data Assurance and Management">ADAM</abbr> estimated data.
    <ul>
      <li>New GAPFILL equations were derived based on new period-of-record data.</li>
    </ul>
  </li>
  <li>Developed a <strong><abbr title="confidence index"><a href="../models/confidenceindexmaps.php">confidence index (CI)</a></abbr><a href="../models/confidenceindexmaps.php"> maps</a></strong> for the EDEN model water-level surfaces to account for differences in reliability of the model based on distance from gages, canals, and model boundaries, and known cross validation errors of the model.
    <ul>
      <li>Final testing of the <abbr title="confidence index">CI</abbr> and website modifications will be completed in November 2011 when daily <abbr title="confidence index">CI</abbr> surfaces will be posted for all daily water-level surfaces.</li>
      <li>See <a href="#fig3">figure 3</a>.</li>
    </ul>
    <a id="fig3"></a>
    <figure style="width:290px;margin:20px auto;border:1px solid black">
      <a href="images/fig3x_11.gif"><img src="images/fig3_11.gif" alt="example of a daily confidence index map for a given day" width="288" height="285"></a>
      <figcaption class="caption" style="background-color:#f1fcdd"><strong>Figure 3.</strong> Example of a daily confidence index map for a given day; green shows areas of high confidence, yellow shows areas of medium confidence, red shows areas of low confidences, and grey shows areas that are dry. [<a href="images/fig3x_11.gif">larger version</a>]</figcaption>
    </figure>
  </li>
  <li>Provided <strong>support to several <abbr title="REstoration COordination and VERification">RECOVER</abbr> principal investigators</strong> and agencies representatives for EDEN data.
    <ul>
      <li>For example, met with Snail Kite researchers to discuss their need for water-level data that synthesizes extreme-case conditions for use in their models. In <abbr title="Fiscal Year 2012">FY2012</abbr>, we hope to develop datasets that can be used by these and other researchers.</li>
      <li>The member list for the <a href="../newsletter.php">EDEN newsletter</a> is 124 and includes participants from federal government agencies (such as <abbr title="Department of the Interior">DOI</abbr>, <abbr title="Everglades National Park">ENP</abbr>, <abbr title="U.S. Geological Survey">USGS</abbr>, <abbr title="Fish and Wildlife Service">FWS</abbr>, <abbr title="Environmental Protection Agency">EPA</abbr>), State agencies (such as <abbr title="South Florida Water Management District">SFW<abbr title="Maryland">MD</abbr></abbr>, <abbr title="Florida Department of Environmental Protection">FDEP</abbr>), many local and other universities and several international affiliations.</li>
    </ul>
  </li>
</ul>
<h3><abbr title="two">II</abbr>. Support from other Programs and Funding Sources</h3>
<p><em>Greater Everglades <abbr title="Priority Ecosystems Science">PES</abbr> funds</em> continue to support the EDEN project by funding efforts by Paul Conrads (<abbr title="U.S. Geological Survey, South Carolina">USGS-SC</abbr>), John Jones (<abbr title="U.S. Geological Survey">USGS</abbr>-Reston), Heather Henkel (<abbr title="U.S. Geological Survey, Saint Petersburg">USGS-St. Pete</abbr>), Bryan McCloskey (<abbr title="U.S. Geological Survey, Saint Petersburg">USGS-St. Pete</abbr>), and Matt Petkewich (<abbr title="U.S. Geological Survey, South Carolina">USGS-SC</abbr>). Additionally, <abbr title="Priority Ecosystems Science">PES</abbr> provides some funds for Pamela Telis (<abbr title="U.S. Geological Survey">USGS</abbr>-Jacksonville) in her role as project coordinator and liaison with the <abbr title="U.S. Army Corps of Engineers">USACE</abbr>.</p>
<ul>
  <li><em><abbr title="REstoration COordination and VERification">RECOVER</abbr> funds and <abbr title="U.S. Geological Survey">USGS</abbr> Greater Everglades <abbr title="Priority Ecosystems Science">PES</abbr> funds</em> -- <strong><a href="../hindcasted.php">Hindcasting</a></strong><a href="../hindcasted.php"> the EDEN stations</a> in the freshwater portion of the Everglades for the period 1990 - 1999 was completed in FY 2011.
    <ul>
      <li>Various approaches for hindcasting the stations data have been applied including linear regression and artificial neural network models.</li>
      <li>Estimates of period of missing record prior to 2000 have been adjusted by applying "shifts" to the estimates. The application of shifts is analogous to the procedure for computing continuous stage and water-quality records. </li>
      <li>The example below (<a href="#fig4"><abbr title="figure">fig.</abbr> 4</a>) shows the benefit of applying the shift. The model for estimating Site 76 using site <abbr title="S R S 1">SRS1</abbr> has an R<sup>2</sup> of 0.84 indicating that the model captures 84 percent of the variability in the water levels of Site 76. The statistic indicates a satisfactory model and is an indication of the model's ability to capture the overall trend of the data. The trend is  <strong>not</strong> an absolute prediction of the value at a particular time. In the example below, the difference at the beginning and end of the 8-day estimation of missing data is 0.48 and 0.49 <abbr title="feet">ft</abbr>, respectively. The 8-day estimate is adjusted by these difference is generate a more accurate absolute prediction of the missing record.
        <a id="fig4"></a>
        <figure style="width:400px;margin:20px auto;border:1px solid black">
          <a href="images/fig4x_11.gif"><img src="images/fig4_11.gif" alt="example graph showing application of a shift to adjust and estimate water level to a more accurate prediction of the actual water level" width="400" height="309"></a>
          <figcaption class="caption" style="background-color:#f1fcdd"><strong>Figure 4.</strong> Example of the application of a "shift" to adjust and estimate water level to a more accurate prediction of the actual water level. [<a href="images/fig4x_11.gif">larger version</a>]</figcaption>
        </figure>
      </li>
      <li>The generation of the 252 <a href="../hindcasted.php">hindcasted EDEN records</a> back to 1990, including the filling and shifting of the missing record of stations established in 1990 or before, has been more time consuming than anticipated.</li>
      <li>These datasets will be used to create daily water-level surfaces using the <abbr title="version 2">V2</abbr> EDEN surface-water model for the period 1990-1999.</li>
      <li>See <a href="#fig5"><abbr title="figure">fig.</abbr> 5</a> for an example of hindcasted data for a gage based on data from a nearby gage.
        <a id="fig5"></a>
        <figure style="width:550px;margin:20px auto;border:1px solid black">
          <a href="images/fig5x_11.gif"><img src="images/fig5_11.gif" alt="example plot of hindcasted water level data" width="550" height="456"></a>
          <figcaption class="caption" style="background-color:#f1fcdd"><strong>Figure 5.</strong> Example of hindcasted data is shown for site W18 in Water Conservation Area 3A South. The measured data for site W18 starts in January 2006. An empirical model was developed to estimate the daily water level back to January 1990. Site 3A9, a site near W18 with measured data dating back before 1990, is shown for comparison. [<a href="images/fig5x_11.gif">larger version</a>]</figcaption>
        </figure>
      </li>
    </ul>
  </li>
  <li><em>Greater Everglades <abbr title="Priority Ecosystems Science">PES</abbr> funds</em> -- The <strong>EDENapps tools</strong> continue to offer EDEN users capabilities such as data viewing, data retrieval, and data access and manipulation. Expansion of the EDEN datasets and increased digital requirements require that the EDENapps tools be upgraded to 64-bit processing. To take advantage of the work funded by other <abbr title="Priority Ecosystems Science">PES</abbr> funds, the <abbr title="National Wetlands Research Center">National Wetlands Research Center (NWRC)</abbr> in Lafayette, <abbr title="Louisiana">LA</abbr> is working with EDEN to improve capabilities of the existing tools and provide access to the new datasets, such as the <a href="../models/confidenceindexmaps.php">confidence index maps</a>.</li>
  <li><em>Greater Everglades <abbr title="Priority Ecosystems Science">PES</abbr> funds</em> -- <strong><a href="../nexrad.php">Rainfall</a> and <abbr title="evapotranspiration"><a href="../evapotrans.php">evapotranspiration (ET)</a></abbr></strong><a href="../evapotrans.php"> data</a> continue to be updated regularly for the EDEN gage network and posted to the EDENweb. Currently, <a href="../nexrad.php">rainfall data</a> available for 2002 to August 2011 and <abbr title="evapotranspiration"><a href="../evapotrans.php">ET</a></abbr><a href="../evapotrans.php"> data</a> available for 1995 to 2010.</li>
  <li><em>Greater Everglades <abbr title="Priority Ecosystems Science">PES</abbr> funds</em> &ndash; Initiated development of a prototype Web application for the display of current conditions and the change in conditions for coastal water-level data described as <strong><a href="../coastal.php">Coastal EDEN</a></strong>.</li>
</ul>
<h3><abbr title="three">III</abbr>. Significant Meetings/Workshops/Conferences</h3>
<ul>
  <li><em>National Conference on Ecosystem Restoration (Baltimore, <abbr title="Maryland">MD</abbr>)</em>
    <ul>
      <li>POSTER - <strong>The <abbr title="South Florida Information Access">South Florida Information Access (SOFIA)</abbr> System and <abbr title="Everglades Depth Estimation Network">Everglades Depth Estimation Network (EDEN)</abbr>: Providing Support for Everglades Restoration;</strong> Heather Henkel</li>
    </ul>
  </li>
  <li><em><abbr title="U.S. Geological Survey">USGS</abbr> National Surface Water Conference (Tampa, <abbr title="Florida">FL</abbr> )</em>
    <p>The EDEN Team conducted an EDEN session to highlight the work by EDEN and relevance for other large gage network efforts:</p>
    <ul>
      <li>PRESENTATION &ndash; <strong><abbr title="Everglades Depth Estimation Network">Everglades Depth Estimation Network (EDEN)</abbr>: Providing Hydrologic Data for the Restoration of the Everglades</strong>; Pamela Telis</li>
      <li>PRESENTATION &ndash; <strong><abbr title="Everglades Depth Estimation Network">Everglades Depth Estimation Network (EDEN)</abbr> Data Management Cycle: From Data Input to Analysis of Confidence Index Maps</strong>; Heather Henkel and Bryan McCloskey</li>
      <li>PRESENTATION &ndash; <strong>Hindcasting Water-Surface Elevations for Water Conservation Area 3A South</strong>; Paul Conrads, Zhixiao Xie, and Bryan McCloskey</li>
      <li>PRESENTATION &ndash; <strong>Water-Level Record Extension of the Everglades Depth Estimation Network</strong>; Paul A. Conrads,<sup> </sup>Bryan J. McCloskey, and Andrew M. O'Reilly</li>
      <li>PRESENTATION &ndash; <strong>Using Inferential Sensors for Quality Control of Water-level Data for the <abbr title="Everglades Depth Estimation Network">Everglades Depth Estimation Network (EDEN)</abbr>; </strong>Matthew D. Petkewich, Paul A. Conrads, and Ruby C. Daamen (Advanced Data Mining International)</li>
      <li>POSTER &ndash; <strong>Automation of the Estimation of Missing Water-Level Data for the <abbr title="Everglades Depth Estimation Network">Everglades Depth Estimation Network (EDEN)</abbr></strong>; Matthew D. Petkewich, Paul A. Conrads, and Brian D. Reece</li>
      <li>POSTER &ndash; <strong>The <abbr title="Everglades Depth Estimation Network">Everglades Depth Estimation Network (EDEN)</abbr> for Support of Biological and Ecological Assessment</strong>; Pamela A. Telis</li>
      <li>POSTER &ndash; <strong>Rainfall and Potential Evapotranspiration Data for <abbr title="Everglades Depth Estimation Network">Everglades Depth Estimation Network (EDEN)</abbr>;</strong> Bryan McCloskey</li>
      <li>POSTER &ndash; <strong>Hindcasting Water-Surface Elevation for Water Conservation Area 3A South</strong>; Paul Conrads</li>
      <li>POSTER &ndash; <strong>Conceptual Components for the <abbr title="Coastal Everglades Depth Estimation Network">Coastal Everglades Depth Estimation Network (Coastal EDEN)</abbr></strong>; Heather Henkel</li>
    </ul>
  </li>
  <li><em><abbr title="United Nations Educational, Scientific and Cultural Organization">UNESCO</abbr> seminars</em>
    <ul>
      <li><strong>The <abbr title="South Florida Information Access">South Florida Information Access (SOFIA)</abbr> System and <abbr title="Everglades Depth Estimation Network">Everglades Depth Estimation Network (EDEN)</abbr>;</strong> Heather Henkel</li>
    </ul>
  </li>
  <li><em>2011 South Carolina Water Resources Conference (Columbia, <abbr title="South Carolina">SC</abbr>)</em>
    <ul>
      <li>POSTER &ndash; <strong>Automation of the Estimation of Missing Water-Level Data for the <abbr title="Everglades Depth Estimation Network">Everglades Depth Estimation Network (EDEN)</abbr></strong>; Matthew D. Petkewich, Paul A. Conrads, and Brian D. Reece</li>
      <li>PRESENTATION &ndash; <strong>Development of Inferential Sensors for Real-Time Quality Control of Water-Level Data for the Everglades Depth Estimation Network</strong>; Ruby Daamen (Advanced Data Mining International)</li>
    </ul>
  </li>
  <li><em>2011 <abbr title="U.S. Geological Survey">USGS</abbr> Eastern Region (Chider) Data Conference (Pittsburgh, <abbr title="Pennsylvania">PA</abbr>)</em>
    <ul>
      <li><strong>Using Inferential Sensors for Quality Control of Water-level Data for the <abbr title="Everglades Depth Estimation Network">Everglades Depth Estimation Network (EDEN)</abbr>;</strong> Paul Conrads, Matt Petkewich, and Ruby Daamen</li>
    </ul>
  </li>
</ul>
<h3><abbr title="four">IV</abbr>. Administrative (Contractual and Budgetary)</h3>
<ul>
  <li>The EDEN project was fully funded in <abbr title="Fiscal Year 2011">FY11</abbr> under the <abbr title="U.S. Geological Survey">USGS</abbr> IA# 28 under the <abbr title="Memorandum of Agreement">MOA</abbr> between <abbr title="U.S. Geological Survey">USGS</abbr> and <abbr title="U.S. Army Corps of Engineers">USACE</abbr>.</li>
  <li>Florida Atlantic University (<abbr title="Florida Atlantic University">FAU</abbr>, Zhixiao Xie, Zhongwei Liu) was funded by the EDEN project through a <abbr title="Cooperative Ecosystem Studies Units">CESU</abbr> agreement in <abbr title="Fiscal Year 2011">FY11</abbr> for:
    <ul>
      <li>Revision/documentation of the EDEN surface water interpolation program.</li>
    </ul>
  </li>
</ul>
<h3><abbr title="five">V</abbr>. <abbr title="Fiscal Year 2011">FY11</abbr> Deliverables/Reports</h3>
<ul>
  <li>EDENweb has been updated throughout the year to provide data, metadata, and documentation to <abbr title="Monitoring and Assessment Plan">MAP</abbr> <abbr title="Principal Investigators">PIs</abbr> and others.</li>
  <li>Quarterly Reports have been submitted on time to the <abbr title="REstoration COordination and VERification">RECOVER</abbr> <abbr title="Monitoring and Assessment Plan">MAP</abbr> coordinators.</li>
</ul>
<h3><abbr title="six">VI</abbr>. <abbr title="Fiscal Year 2012">FY12</abbr> Workplan</h3>
<p>This plan includes work elements funded from both <abbr title="REstoration COordination and VERification">RECOVER</abbr>
<abbr title="Monitoring and Assessment Plan">MAP</abbr> and <abbr title="U.S. Geological Survey">USGS</abbr> <abbr title="Greater Everglades Priority Ecosystems Science">GEPES</abbr>:</p>
<ul>
  <li>Data management and daily water-surface creation
    <ul>
      <li>Create and post daily water surfaces on schedule</li>
      <li>Use <abbr title="Automated Data Assurance and Management">ADAM</abbr> for data gap filling and EDEN database for data storage</li>
      <li>Use <abbr title="version 2">V2</abbr> surface-water model for creation of all surfaces</li>
      <li>Create and post daily confidence index maps for surfaces</li>
      <li>Use confidence index maps to test impacts of less dense network of gages</li>
    </ul>
  </li>
  <li>Complete creation of <a href="../hindcasted.php">hindcasted water-level surfaces</a> for the period 1990 &ndash; 1999</li>
  <li>Continue to work with agencies that are monitoring water levels and develop a plan for creating EDEN daily surfaces with fewer surface-water gages as funding cuts reduce the network. </li>
  <li>Implement webpage for EDEN oligohaline zone (<a href="../coastal.php">Coastal EDEN</a>)</li>
  <li>Document all the new work via <abbr title="U.S. Geological Survey">USGS</abbr> series reports and journal articles</li>
  <li>Participate in <abbr title="Greater Everglades Ecosystem Restoration 2012">GEER2012</abbr> and present recent EDEN improvements and results</li>
  <li>Collaborate with National Wetlands Research Center for revisions to several of the EDENapps tools</li> <li>Provide hydrologic analyses and results for 2012 System Status Report to Congress.</li>
</ul>
<h3><abbr title="seven">VII</abbr>. Anticipated Needs and Issues</h3>
<ul>
  <li>The significant impact of funding cuts for South Florida monitoring will be the reduction in the gage network by all operating agencies. As the water-level gage network becomes less dense, the confidence of the modeled water surface is reduced. In some areas, a less dense network will have less impact than in areas where the hydrology is more complex. Pamela Telis will work with the operating agencies over the next few months to attempt to coordinate loss of gages to reduce the impacts on the EDEN surfaces.</li>
</ul>
<a id="sxn8"></a>
<h3><abbr title="eight">VIII</abbr>. Funding Status</h3>
<ul>
  <li>As of 9/30/11, all of the <abbr title="Fiscal Year 2011">FY11</abbr> funding under <abbr title="U.S. Geological Survey">USGS</abbr> IA #28 has been expended or obligated. Invoices will be electronically submitted to the <abbr title="U.S. Army Corps of Engineers">USACE</abbr> within the next few months.</li>
  <li><abbr title="U.S. Geological Survey">USGS</abbr> <abbr title="Priority Ecosystems Science">Priority Ecosystem Science (PES)</abbr> funding in <abbr title="Fiscal Year 2011">FY2011</abbr> was  to multiple principal investigators in support for EDEN research efforts. This level of support is expected to be continued in <abbr title="Fiscal Year 2012">FY2012</abbr> with a potential 10% cut.</li>
</ul>
<?php require ($_SERVER['DOCUMENT_ROOT'] . '/../eden/ssi/eden-foot.php'); ?>