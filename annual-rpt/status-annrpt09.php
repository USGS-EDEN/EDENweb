<?php
$title = "<title>Learn About EDEN - Fiscal Year 2009 Status Report - Everglades Depth Estimation Network (EDEN)</title>\n";
require ($_SERVER['DOCUMENT_ROOT'] . '/eden/ssi/eden-head.php');
?>
<h4>Learn About EDEN</h4>
<h3>Status Report - <abbr title="Fiscal Year 2009">FY09</abbr></h3>
<p><strong>Period Covered:</strong> October 1, 2008 through September 30, 2009</p>
<p><strong>Project:</strong> South Florida Surface Water Monitoring Network for Support of <abbr title="Monitoring and Assessment Plan">MAP</abbr> Projects<br>
<strong>Agency:</strong> <abbr title="U.S. Geological Survey">U.S. Geological Survey (USGS)</abbr><br>
<strong><abbr title="U.S. Geological Survey">USGS</abbr> Point of Contact:</strong> Pamela Telis, <a href="mailto:patelis@usgs.gov">patelis@usgs.gov</a>, 904-232-2602<br>
<strong><abbr title="U.S. Army Corps of Engineers">USACE</abbr> Point of Contact:</strong> David Tipple, 904-232-1375, Gretchen Ehlinger, 904-232-1682<br>
<strong>Agreement:</strong> <abbr title="U.S. Geological Survey">USGS</abbr> IA#12 under <abbr title="Memorandum of Agreement">MOA</abbr> between <abbr title="U.S. Geological Survey">USGS</abbr> and <abbr title="U.S. Army Corps of Engineers">USACE</abbr></p>
<p>This annual report for 2009 summarizes the major accomplishments, lists of deliverables, and outlines the work plan for 2010 for the EDEN project. The EDEN's primary deliverable and product continues to be the EDENweb (<a href="../">sofia.usgs.gov/eden</a>); the project website that provides all data, results, documentation, and other project information for EDEN users.</p> 
<figure style="width:225px;margin:20px auto;border:1px solid black">
  <a href="EDENAnnualReport2009.pdf"><img src="images/EDENAnnualReport2009.gif" alt="thumbnail image of 2009 Status Report" height="346" width="225"></a>
  <figcaption class="caption" style="background-color:#f1fcdd"><a href="EDENAnnualReport2009.pdf">Download &quot;2009 Annual Report&quot;</a> (<abbr title="P D F">PDF</abbr> file, 1.4 <abbr title="megabytes">MB</abbr>)</figcaption>
</figure>
<a id="sxn1"></a>                    
<h3><abbr title="one">I</abbr>. Major Accomplishments</h3>
<ul>
  <li><a href="../models/watersurfacemod_download.php">Real-time, provisional, and final EDEN surfaces</a> are being produced and posted to EDENweb on schedule. Surfaces currently posted on the EDENweb (<a href="../">sofia.usgs.gov/eden</a>) include:
    <ul>
      <li>Final for 1/1/2000 through 9/30/08</li>
      <li>Provisional for 10/1/08 through 6/30/09</li>
      <li>Real-time for 7/1/09 through current</li>
    </ul>
  </li>
  <li>This year the EDEN project completely reevaluated its data management plan (<a href="#sxn8">see issues identified in Section <abbr title="eight">VIII</abbr> below</a>) to handle the agency data from water-level gages, manage and process the data, and create daily water surfaces more efficiently and, if possible, with more automation. This included some of the following:
    <ul>
      <li>Developed a data management plan and obtained a review by an outside reviewer who has provided significant recommendations for efficiency and quality control. Implementation of these recommendations is ongoing.</li>
      <li>Reconfigured the EDEN data management staff to include better mix of skill sets and to provide cross training necessary for consistent daily surfacing and data postings.</li>
    </ul>
  </li>
  <li>A simple regression gap filling program was developed for filling data gaps in water level data at gages prior to creating <a href="../models/watersurfacemod.php">daily water level surfaces</a>. Program was automated for use with provisional (quarterly) and final (annual) data sets. Work is ongoing to use the program potentially for creation of real-time surfaces. Currently requires significant manual review based on data received from agencies, however project staff continue to fine tune program and process. </li>
  <li>EDEN continues to evaluate new and additional gages that may help fill in gaps in the network of gages used to create the daily water-level surfaces and potentially improve the surfaces. In 2009, EDEN added 5 gages to the network:
    <ul>
      <li>BARW4, BARW6A in western Big Cypress National Preserve</li>
      <li>G338_T and G251_T in western <abbr title="Water Conservation Area 1">WCA1</abbr></li>
      <li>SR1 in Everglades National Park</li>
      <li>TSB replaced TS2, in Everglades National Park</li>
    </ul>
    <a id="fig1"></a>
    <figure style="width:430px;margin:5px;border:1px solid black;float:right">
      <a href="images/fig1x_09.jpg"><img src="images/fig1_09.jpg" alt="map of south Florida showing proposed benchmarks and EDEN surface water monitoring site locations" width="430" height="562"></a>
      <figcaption class="caption" style="background-color:#f1fcdd"><strong>Figure 1.</strong> [<a href="images/fig1x_09.jpg">larger version</a>]</figcaption>
    </figure>
  </li>
  <li><a href="../models/groundelevmod.php">EDEN <abbr title="digital elevation model">DEM</abbr></a> was revised and expanded
    <ul>
      <li>Using methodology for nearest-neighbor grid comparison developed by <abbr title="Florida Atlantic University">Florida Atlantic University (FAU)</abbr> in 2008, the <a href="../models/groundelevmod.php">EDEN <abbr title="digital elevation model">DEM</abbr></a> for <abbr title="Water Conservation Area 1">WCA1</abbr> was revised and improved. Other data used in development of this <abbr title="digital elevation model">DEM</abbr> revision included <abbr title="South Florida Water Management District">SFW<abbr title="Maryland">MD</abbr></abbr> Ken Rutchey's vegetation map (based on the 2004 aerial imagery) and the vegetation data from the <abbr title="U.S. Geological Survey">USGS</abbr> aerial height finder data sets.</li>
      <li>The area south of Big Cypress National Preserve to the mangrove edge (an area not previously included in the <a href="../models/groundelevmod.php">EDEN <abbr title="digital elevation model">DEM</abbr></a>) was added to the <a href="../models/groundelevmod.php">EDEN <abbr title="digital elevation model">DEM</abbr></a>. The <abbr title="digital elevation model">DEM</abbr> was developed using the method documented for the current <abbr title="digital elevation model">DEM</abbr>.</li>
      <li>Documentation, metadata, and the new <abbr title="digital elevation model">DEM</abbr> are planned for posting on-line for users in November 2009.</li>
    </ul>
  </li>
  <li>Expand and improve EDEN surface water interpolation model
    <ul>
      <li>The surface water interpolation program is being updated for new and revised datasets and expanded to include an area south of <abbr title="Big Cypress National Preserve">BCNP</abbr> to the mangrove ecotone. The expanded area is interpolated consistent with the existing program. This task has been delayed about 6 months because data quality issues required more time to address than expected. Coordination and integration of multi-agency datasets has proven to be more time intensive than expected at this point in the project.</li>
      <li>3 days per water year (2004, 2007, 2008) are used to represent dry, wet, and average conditions for model calibration. 300-400 runs per day have been completed for the selected 9 days with varying parameter values based on EDEN extended daily medians prior to canal file revisions, including 50 runs randomly selected from 255,744 parameter scenarios. The parameter scenarios and resultant <abbr title="southwest">SW</abbr> grids will serve as reference for evaluating canal file revisions.</li>
      <li><abbr title="U.S. Army Corps of Engineers">USACE</abbr> contract is in place to collect water level data at approximately 65 <a href="../benchmarks/">benchmarks</a> through the Everglades in wet season 2009, dry season 2010, and wet season 2010. These data will be invaluable to continue the validation process of the EDEN surfacing model (a seemingly never-ending pursuit).</li>
    </ul>
  </li>
  <li>EDEN assisted the <abbr title="U.S. Army Corps of Engineers">USACE</abbr> Survey Section in installation and survey of 34 <a href="../benchmarks/">benchmarks</a> (<abbr title="benchmarks">BMs</abbr>, surveyed to Class B standards, stainless steel rod driven to refusal) in the Everglades wetland marshes. EDEN compiled the location of <abbr title="benchmarks">BMs</abbr>, obtained permits where required, and will post all <a href="../benchmarks/"><abbr title="benchmark">BM</abbr> elevations and data sheets</a> on the EDENweb. See <a href="#fig1">Figure 1</a> for proposed <abbr title="benchmark">BM</abbr> locations.</li>
  <li><a href="../nexrad.php">Rainfall</a> and <a href="../evapotrans.php">evapotranspiration data</a> continue to be updated regularly for the EDEN gage network and posted to the EDENweb.</li>
  <li>Began pilot data analysis to review data in Shark River Slough for oligohaline zone analysis.</li>
  <li><a href="../newsletter.php">EDEN Newsletter</a> currently has 90 subscribers and is used to notify users of updates or additions to the EDEN website.</li>
</ul>
<h3><abbr title="two">II</abbr>. Significant Meetings/Workshops/Conferences</h3>
<ul>
  <li>The EDEN team participated in <abbr title="National Conference on Ecosystem Restoration">NCER</abbr> 2009 with 5 posters and oral presentations
    <ul>
      <li>Conrads, P.A., Petkewich, M.D., Daamen, R.C., Roehl, E.A., Dealing with data realities &ndash; Automation of evaluation of data quality and estimation of missing data for the <abbr title="Everglades Depth Estimation Network">Everglades Depth Estimation Network (EDEN)</abbr>, <abbr title="National Conference on Ecosystem Restoration">NCER</abbr> 2009</li>
      <li>Henkel, H.S., The <abbr title="south Florida information access">south Florida information access (SOFIA)</abbr> system, <abbr title="National Conference on Ecosystem Restoration">NCER</abbr> 2009</li>
      <li>Telis, P.A., and Henkel, H., Assessing Everglades restoration using <abbr title="Everglades Depth Estimation Network">Everglades Depth Estimation Network (EDEN)</abbr> , <abbr title="National Conference on Ecosystem Restoration">NCER</abbr> 2009</li>
      <li>Telis, P.A., Henkel, H., McCloskey, B., and Holmes, M., Rainfall and potential evaporation data for <abbr title="Everglades Depth Estimation Network">Everglades Depth Estimation Network (EDEN)</abbr> gages, <abbr title="National Conference on Ecosystem Restoration">NCER</abbr> 2009</li>
      <li>Xie, Z., Liu, Z., and Jones, J.W., The development of digital elevation model for the area south of the Big Cypress National Park in the greater Everglades restoration, <abbr title="National Conference on Ecosystem Restoration">NCER</abbr> 2009</li>
    </ul>
  </li>
  <li><abbr title="United Nations Educational, Scientific and Cultural Organization">UNESCO</abbr> seminars
    <ul>
      <li>Liu, Z. and Z. Xie, 2009. <abbr title="Everglades Depth Estimation Network">Everglades Depth Estimation Network (EDEN)</abbr> - model application, validation, and revision. 2009 <abbr title="United Nations Educational, Scientific and Cultural Organization">UNESCO</abbr> Lectures (organized by <abbr title="U.S. Geological Survey">USGS</abbr>), June 10-11, 2009, Davie, <abbr title="Florida">FL</abbr></li>
      <li>Conrads, P., 2009. Data mining and neural network modeling. 2009 <abbr title="United Nations Educational, Scientific and Cultural Organization">UNESCO</abbr> Lectures (organized by <abbr title="U.S. Geological Survey">USGS</abbr>), June 10-11, 2009, Davie, <abbr title="Florida">FL</abbr></li>
      <li>Henkel, H., 2009. The <abbr title="South Florida Information Access">South Florida Information Access (SOFIA)</abbr> System and <abbr title="Everglades Depth Estimation Network">Everglades Depth Estimation Network (EDEN)</abbr>. 2009 <abbr title="United Nations Educational, Scientific and Cultural Organization">UNESCO</abbr> Lectures (organized by <abbr title="U.S. Geological Survey">USGS</abbr>), June 10-11, 2009, Davie, <abbr title="Florida">FL</abbr></li>
    </ul>
  </li>
  <li>Other conferences
    <ul>
      <li>Telis, P.A., and Henkel, H., Assessing Everglades restoration using <abbr title="Everglades Depth Estimation Network">Everglades Depth Estimation Network (EDEN)</abbr>, <abbr title="U.S. Geological Survey">USGS</abbr> Gulf Coast Science Conference and Florida Integrated Science Center Meeting: Proceedings with Abstracts, October 20-23, 2008, Orlando, <abbr title="Florida">FL</abbr>.</li>
      <li>Liu, Z., F.J. Mazzotti, L.A. Brandt, S.S. Romanach, D.E. Ogurcak, and A.L. Higer. 2009. Relationship between alligator holes and EDEN hydrologic data in Everglades National Park, Florida. Annual Meeting of the Association of American Geographers, Las Vegas, <abbr title="Nevada">NV</abbr>.</li>
      <li>Conrads, P., October 2008. Maximizing data-collection networks by using data-mining techniques &ndash; case studies in the Florida Everglades. Water Environmental Federation Technical Conference 2009, Chicago, <abbr title="Illinois">IL</abbr>.</li>
    </ul>
  </li>
</ul>
<h3><abbr title="three">III</abbr>. Administrative (Contractual and Budgetary)</h3>
<ul>
  <li>The end date for the existing agreement, <abbr title="U.S. Geological Survey">USGS</abbr> IA#12 under <abbr title="Memorandum of Agreement">MOA</abbr> between <abbr title="U.S. Geological Survey">USGS</abbr> and <abbr title="U.S. Army Corps of Engineers">USACE</abbr>, is 3/31/10. A new scope and cost estimate for the period 4/1/10 through 3/31/15 has been vetted through the Greater Everglades module leads and is in process for an Economy Act approval with the <abbr title="U.S. Army Corps of Engineers">USACE</abbr>.</li>
  <li>University of Florida (<abbr title="University of Florida">UF</abbr>, Aaron Higer, Zhongwei Liu) and Florida Atlantic University (<abbr title="Florida Atlantic University">FAU</abbr>, Zhixiao Xie, Dale Gawlik) were funded by the EDEN project through a <abbr title="Cooperative Ecosystem Studies Units">CESU</abbr> agreement in <abbr title="Fiscal Year 2009">FY09</abbr> for:
    <ul>
      <li>Improvement, expansion, and revision of the <a href="../models/groundelevmod.php">EDEN <abbr title="digital elevation model">DEM</abbr></a></li>
      <li>Revision of the EDEN surface water interpolation program</li>
    </ul>
  </li>
</ul>
<h3><abbr title="four">IV</abbr>. Support from other Programs and Funding Sources</h3>
<ul>
  <li>Greater Everglades <abbr title="Priority Ecosystems Science">PES</abbr> funds continue to support the EDEN project by funding efforts by Paul Conrads (<abbr title="U.S. Geological Survey, South Carolina">USGS-SC</abbr>), John Jones (<abbr title="U.S. Geological Survey">USGS</abbr>-Reston), Heather Henkel (<abbr title="U.S. Geological Survey, Florida Integrated Science Center">USGS-FISC</abbr>), and Aaron Higer (<abbr title="University of Florida">UF</abbr>). Additionally, <abbr title="Priority Ecosystems Science">PES</abbr> provides some funds for Pamela Telis (<abbr title="U.S. Geological Survey, Florida Integrated Science Center">USGS-FISC</abbr>) in her role as project coordinator and liaison with the <abbr title="U.S. Army Corps of Engineers">USACE</abbr>.</li>
  <li><abbr title="American Recovery and Reinvestment Act">ARRA</abbr> (economic stimulus) funding was offered to the EDEN project for work that could be conducted under the <abbr title="American Recovery and Reinvestment Act">ARRA</abbr> regulations. Most work by the EDEN team is not allowable under the <abbr title="American Recovery and Reinvestment Act">ARRA</abbr> regulations, i.e. labor for federal government employees. In 2008, the <abbr title="U.S. Geological Survey">USGS</abbr> South Carolina Water Science Center funded Phase 1 of an effort by <abbr title="Advanced Data Mining">Advanced Data Mining (ADM)</abbr>, <abbr title="limited liability company">LLC</abbr>, however, did not have funding for Phase 2 at this time. The project by <abbr title="Advanced Data Mining">ADM</abbr> addresses data quality issues by developing an intelligent software application in order to automate the validation and correction of data, in the case of EDEN, prior to creation of the <a href="../models/watersurfacemod.php">daily water level surfaces</a>. The <abbr title="American Recovery and Reinvestment Act">ARRA</abbr> funding is being used in 2009-2010 to fund Phase 2 of this work. Additionally, the <abbr title="American Recovery and Reinvestment Act">ARRA</abbr> funding partially supports the <abbr title="Cooperative Ecosystem Studies Units">CESU</abbr> agreement with Florida Atlantic University and their work to improve the surface water interpolation program.</li>
  <li>As described in the <a href="#sxn1">Section <abbr title="one">I</abbr> above</a>, <abbr title="U.S. Army Corps of Engineers">USACE</abbr> funding was provided to install and survey <a href="../benchmarks/">benchmarks</a> through the Everglades, collect water level data at this network (during wet season 2009, dry season 2010, and wet season 2010), install continuous water level recorders at <a href="../benchmarks/">benchmarks</a> in Everglades National Park, survey elevations to <abbr title="North American Vertical Datum of 1988">NAVD88</abbr> datum at 8 water level gages in Everglades National Park, and collect ground elevation data at 12 water level gages.</li>
</ul>
<h3><abbr title="five">V</abbr>. <abbr title="Fiscal Year 2009">FY09</abbr> Deliverables/Reports</h3>
<ul>
  <li>EDENweb (<a href="../">sofia.usgs.gov/eden</a>) has been updated throughout the year to provide data, metadata, and documentation to <abbr title="Monitoring and Assessment Plan">MAP</abbr> <abbr title="Principal Investigators">PIs</abbr> and others.</li>
  <li>Reports (partially funded by <abbr title="U.S. Geological Survey">USGS</abbr> <abbr title="Priority Ecosystems Science">PES</abbr> funds):
    <ul>
      <li>Conrads, P.A. and M.D. Petkewich, 2009, <em><a href="http://pubs.usgs.gov/of/2009/1120/">Estimation of missing water-level data for the <abbr title="Everglades Depth Estimation Network">Everglades Depth Estimation Network (EDEN)</abbr></a>:</em> U.S. Geological Survey Open-File Report 2009-1120, 53 <abbr title="pages">p.</abbr></li>
      <li>Telis, P.A. and Henkel, H., 2009, <em><a href="http://pubs.usgs.gov/fs/2009/3052/"><abbr title="Everglades Depth Estimation Network">Everglades Depth Estimation Network (EDEN)</abbr> Applications: Tools to view, extract, plot, and manipulate EDEN data:</a></em> U.S. Geological Fact Sheet 2009-3052, 4 <abbr title="pages">p.</abbr></li>
      <li>Liu, Z., Volin, J., Owen, D., Pearlstine, L., Allen, J., Mazzotti, F., and Higer, A., 2008, <em><a href="http://dx.doi.org/10.1002/eco.56">Validation and ecosystem applications of the EDEN water-surface model for the Florida Everglades</a></em>: Ecohydrology Volume 2, Issue 2, <abbr title="pages">p.</abbr> 182-194 (2009).</li>
    </ul>
  </li>
  <li>For the 2009 System Status Report, EDEN provided hydroperiod maps and mean monthly water depth data to assist with hydrologic assessments of component areas of the Everglades and for understanding the total system hydrology:
    <ul>
      <li>Figures 2 through 6 show maps developed from EDEN daily surfaces of water level. The period of time in increments of a year show areas that have had water surfaces above land surface (based on the EDEN ground elevation model gridded to 400 meters by 400 meters) for the selected date based on data from 1/1/2000 through the selected date. Several observations are noted:
        <ul>
          <li>The <abbr title="Water Conservation Areas">WCAs</abbr> were the wettest following wet season 2005 and driest following wet season 2007.</li>
          <li>Everglades National Park was wettest following wet season 2006 and driest following wet season 2008.</li>
          <li>Areas of southern and southeastern <abbr title="Water Conservation Area 3A">WCA3A</abbr> that remain wet continuously are easily evident on the maps year after year.</li>
        </ul>
        <figure style="width:390px;margin:20px auto;border:1px solid black">
          <a href="images/fig2x_09.jpg"><img src="images/fig2_09.jpg" alt="map showing hydroperiod for greater Everglades for November 1, 2004" width="389" height="520"></a>
          <figcaption class="caption" style="background-color:#f1fcdd"><strong>Figure 2.</strong> Map showing hydroperiod for greater Everglades for November 1, 2004 based on EDEN daily water surfaces and EDEN ground elevation model. [<a href="images/fig2x_09.jpg">larger version</a>]</figcaption>
        </figure>
        <hr style="width:65%">
        <figure style="width:390px;margin:20px auto;border:1px solid black">
          <a href="images/fig3x_09.jpg"><img src="images/fig3_09.jpg" alt="map showing hydroperiod for greater Everglades for November 1, 2005" width="389" height="520"></a>
          <figcaption class="caption" style="background-color:#f1fcdd"><strong>Figure 3.</strong> Map showing hydroperiod for greater Everglades for November 1, 2005 based on EDEN daily water surfaces and EDEN ground elevation model. [<a href="images/fig3x_09.jpg">larger version</a>]</figcaption>
        </figure>
        <hr style="width:65%">
        <figure style="width:390px;margin:20px auto;border:1px solid black">
          <a href="images/fig4x_09.jpg"><img src="images/fig4_09.jpg" alt="map showing hydroperiod for greater Everglades for November 1, 2006" width="389" height="520"></a>
          <figcaption class="caption" style="background-color:#f1fcdd"><strong>Figure 4.</strong> Map showing hydroperiod for greater Everglades for November 1, 2006 based on EDEN daily water surfaces and EDEN ground elevation model. [<a href="images/fig4x_09.jpg">larger version</a>]</figcaption>
        </figure>
        <hr style="width:65%">
        <figure style="width:390px;margin:20px auto;border:1px solid black">
          <a href="images/fig5x_09.jpg"><img src="images/fig5_09.jpg" alt="map showing hydroperiod for greater Everglades for November 1, 2007" width="389" height="520"></a>
          <figcaption class="caption" style="background-color:#f1fcdd"><strong>Figure 5.</strong> Map showing hydroperiod for greater Everglades for November 1, 2007 based on EDEN daily water surfaces and EDEN ground elevation model. [<a href="images/fig5x_09.jpg">larger version</a>]</figcaption>
        </figure>
        <hr style="width:65%">
        <figure style="width:390px;margin:20px auto;border:1px solid black">
          <a href="images/fig6x_09.jpg"><img src="images/fig6_09.jpg" alt="map showing hydroperiod for greater Everglades for November 1, 2008" width="389" height="520"></a>
          <figcaption class="caption" style="background-color:#f1fcdd"><strong>Figure 6.</strong> Map showing hydroperiod for greater Everglades for November 1, 2008 based on EDEN daily water surfaces and EDEN ground elevation model. [<a href="images/fig6x_09.jpg">larger version</a>]</figcaption>
        </figure>
        <hr style="width:65%">
      </li>
      <li>Figures 7 through 11 show plots of mean water depth for EDEN grid cells (400 meters by 400 meters) in subareas of the greater Everglades for water years 2004-05, 2005-06, 2006-07, 2007-08, and 2008-09 (partial year). These water depths are computed from EDEN <a href="../models/watersurfacemod.php">daily water level surfaces</a> and the EDEN <a href="../models/groundelevmod.php">ground elevation model</a>. The mean monthly rainfall for subareas is also plotted. Several observations are noted:
        <ul>
          <li>The storage capacity of the system is quite evident. Initial water depths in the <abbr title="Water Conservation Areas">WCAs</abbr> are relatively high in water year 2005-06, in part, due to the high rainfall and subsequent high water depths the previous year.</li>
          <li>The longer, drier dry season in water year 2006-07 likely impacted the resulting lower mean depths in water year 2007-08.</li>
          <li>The short dataset shows extreme ranges of water depth in <abbr title="Water Conservation Area 3A North">WCA3N</abbr> which appears highly linked to rainfall fluctuations.</li>
        </ul>
        <figure style="width:425px;margin:20px auto;border:1px solid black">
          <a href="images/fig7x_09.gif"><img src="images/fig7_09.gif" alt="plots of mean water depth by month for subareas of the greater Everglades for water year 2004-2005" width="418" height="553"></a>
          <figcaption class="caption" style="background-color:#f1fcdd"><strong>Figure 7.</strong> Plots of mean water depth by month for subareas of the greater Everglades based on EDEN daily water surfaces and ground elevation model for water surfaces and ground elevation model for water year 2004-2005 (May 1 &ndash; April 30). Mean monthly rainfall for subareas also plotted. [<a href="images/fig7x_09.gif">larger version</a>]</figcaption>
        </figure>
        <hr style="width:65%">
        <figure style="width:425px;margin:20px auto;border:1px solid black">
          <a href="images/fig8x_09.gif"><img src="images/fig8_09.gif" alt="plots of mean water depth by month for subareas of the greater Everglades for water year 2005-2006" width="418" height="552"></a>
          <figcaption class="caption" style="background-color:#f1fcdd"><strong>Figure 8.</strong> Plots of mean water depth by month for subareas of the greater Everglades based on EDEN daily water surfaces and ground elevation model for water surfaces and ground elevation model for water year 2005-2006 (May 1 &ndash; April 30). Mean monthly rainfall for subareas also plotted. [<a href="images/fig8x_09.gif">larger version</a>]</figcaption>
        </figure>
        <hr style="width:65%">
        <figure style="width:425px;margin:20px auto;border:1px solid black">
          <a href="images/fig9x_09.gif"><img src="images/fig9_09.gif" alt="plots of mean water depth by month for subareas of the greater Everglades for water year 2006-2007" width="418" height="552"></a>
          <figcaption class="caption" style="background-color:#f1fcdd"><strong>Figure 9.</strong> Plots of mean water depth by month for subareas of the greater Everglades based on EDEN daily water surfaces and ground elevation model for water surfaces and ground elevation model for water year 2006-2007 (May 1 &ndash; April 30). Mean monthly rainfall for subareas also plotted. [<a href="images/fig9x_09.gif">larger version</a>]</figcaption>
        </figure>
        <hr style="width:65%">
        <figure style="width:425px;margin:20px auto;border:1px solid black">
          <a href="images/fig10x_09.gif"><img src="images/fig10_09.gif" alt="plots of mean water depth by month for subareas of the greater Everglades for water year 2007-2008" width="418" height="552"></a>
          <figcaption class="caption" style="background-color:#f1fcdd"><strong>Figure 10.</strong> Plots of mean water depth by month for subareas of the greater Everglades based on EDEN daily water surfaces and ground elevation model for water surfaces and ground elevation model for water year 2007-2008 (May 1 &ndash; April 30). Mean monthly rainfall for subareas also plotted. [<a href="images/fig10x_09.gif">larger version</a>]</figcaption>
        </figure>
        <hr style="width:65%">
        <figure style="width:425px;margin:20px auto;border:1px solid black">
          <a href="images/fig11x_09.gif"><img src="images/fig11_09.gif" alt="plots of mean water depth by month for subareas of the greater Everglades for water year 2008-2009" width="418" height="562"></a>
          <figcaption class="caption" style="background-color:#f1fcdd"><strong>Figure 11.</strong> Plots of mean water depth by month for subareas of the greater Everglades based on EDEN daily water surfaces and ground elevation model for water surfaces and ground elevation model for water year 2008-2009 (May 1 &ndash; April 30). Mean monthly rainfall for subareas also plotted. [<a href="images/fig11x_09.gif">larger version</a>]</figcaption>
        </figure>
        <hr style="width:65%">
      </li>
      <li>Figures 12 through 17 show plots of mean water depth by month for EDEN grid cells (400 meters by 400 meters) in subareas of Everglades National Park for water years 2004-05, 2005-06, 2006-07, 2007-08, and 2008-09 (partial year). These water depths are computed from EDEN <a href="../models/watersurfacemod.php">daily water level surfaces</a> and the EDEN <a href="../models/groundelevmod.php">ground elevation model</a>. The mean monthly rainfall for subareas is also plotted. Several observations are noted:
        <ul>
          <li>Water depths in Everglades National Park were highest in water year 2005-06.</li>
          <li>Water depths in Everglades National Park were lowest in water year 2007-08.</li>
          <li>Relatively high water depths entering dry season 2008-09 (partial year plot) result, in part, from high rainfall amounts in the previous wet season.</li>
          <li>The marl prairie system has the lowest mean water depths and large areas go dry in the dry season. The coastal oligohaline system has the highest mean water depths.</li>
        </ul>
        <figure style="width:440px;margin:20px auto;border:1px solid black">
          <a href="images/fig12x_09.gif"><img src="images/fig12_09.gif" alt="map showing landscape sampling units grouped by subareas of Everglades National Park" width="432" height="573"></a>
          <figcaption class="caption" style="background-color:#f1fcdd"><strong>Figure 12.</strong> Landscape sampling units grouped by subareas of Everglades National Park. [<a href="images/fig12x_09.gif">larger version</a>]</figcaption>
        </figure>
        <hr style="width:65%">
        <figure style="width:425px;margin:20px auto;border:1px solid black">
          <a href="images/fig13x_09.gif"><img src="images/fig13_09.gif" alt="plots of mean water depth by month for subareas of Everglades National Park for water year 2004-2005" width="418" height="346"></a>
          <figcaption class="caption" style="background-color:#f1fcdd"><strong>Figure 13.</strong> Plots of mean water depth by month for subareas of Everglades National Park based on EDEN daily water surfaces and ground elevation model for water year 2004-2005 (May 1 &ndash; April 30). Mean monthly rainfall for subareas also plotted. [<a href="images/fig13x_09.gif">larger version</a>]</figcaption>
        </figure>
        <hr style="width:65%">
        <figure style="width:425px;margin:20px auto;border:1px solid black">
          <a href="images/fig14x_09.gif"><img src="images/fig14_09.gif" alt="plots of mean water depth by month for subareas of Everglades National Park for water year 2005-2006" width="418" height="345"></a>
          <figcaption class="caption" style="background-color:#f1fcdd"><strong>Figure 14.</strong> Plots of mean water depth by month for subareas of Everglades National Park based on EDEN daily water surfaces and ground elevation model for water year 2005-2006 (May 1 &ndash; April 30). Mean monthly rainfall for subareas also plotted. [<a href="images/fig14x_09.gif">larger version</a>]</figcaption>
        </figure>
        <hr style="width:65%">
        <figure style="width:425px;margin:20px auto;border:1px solid black">
          <a href="images/fig15x_09.gif"><img src="images/fig15_09.gif" alt="plots of mean water depth by month for subareas of Everglades National Park for water year 2006-2007" width="418" height="347"></a>
          <figcaption class="caption" style="background-color:#f1fcdd"><strong>Figure 15.</strong> Plots of mean water depth by month for subareas of Everglades National Park based on EDEN daily water surfaces and ground elevation model for water year 2006-2007 (May 1 &ndash; April 30). Mean monthly rainfall for subareas also plotted. [<a href="images/fig15x_09.gif">larger version</a>]</figcaption>
        </figure>
        <hr style="width:65%">
        <figure style="width:425px;margin:20px auto;border:1px solid black">
          <a href="images/fig16x_09.gif"><img src="images/fig16_09.gif" alt="plots of mean water depth by month for subareas of Everglades National Park for water year 2007-2008" width="418" height="347"></a>
          <figcaption class="caption" style="background-color:#f1fcdd"><strong>Figure 16.</strong> Plots of mean water depth by month for subareas of Everglades National Park based on EDEN daily water surfaces and ground elevation model for water year 2007-2008 (May 1 &ndash; April 30). Mean monthly rainfall for subareas also plotted. [<a href="images/fig16x_09.gif">larger version</a>]</figcaption>
        </figure>
        <hr style="width:65%">
        <figure style="width:425px;margin:20px auto;border:1px solid black">
          <a href="images/fig17x_09.gif"><img src="images/fig17_09.gif" alt="plots of mean water depth by month for subareas of Everglades National Park for water year 2008-2009" width="418" height="355"></a>
          <figcaption class="caption" style="background-color:#f1fcdd"><strong>Figure 17.</strong> Plots of mean water depth by month for subareas of Everglades National Park based on EDEN daily water surfaces and ground elevation model for water year 2008-2009 (May 1 &ndash; April 30). Mean monthly rainfall for subareas also plotted. [<a href="images/fig17x_09.gif">larger version</a>]</figcaption>
        </figure>
      </li>
    </ul>
  </li>
</ul>
<h3><abbr title="six">VI</abbr>. <abbr title="Fiscal Year 2010">FY10</abbr> Workplan (in draft form at this time)</h3>
<ul>
  <li>Data management and daily water surface creation
    <ul>
      <li>Create and post daily water surfaces on schedule</li>
      <li>Continue to improve the data gap fill program</li>
      <li>Use new datum surveys at gages to revise water level data</li>
      <li>Add new gages if appropriate</li>
      <li>Create rules for handling 'dry' data at gages and in EDEN surfaces</li>
      <li>Complete revision of surface-water model</li>
      <li>Use water level data at <a href="../benchmarks/">benchmarks</a> to evaluate/improve EDEN surfaces</li>
      <li>Post <a href="../benchmarks/">benchmark data</a> to the EDENweb</li>
    </ul>
  </li>
  <li>Revise EDEN <a href="../models/groundelevmod.php">ground elevation model</a></li>
  <li>Continue to enhance the EDENweb to provide users with data and information that is user-friendly and easily accessible</li>
  <li>Consider <a href="../hindcasted.php">hindcasting water-level data</a> and creation of water surfaces prior to 2000</li>
  <li>Develop protocol for oligohaline zone EDEN</li>
  <li>Update <a href="../nexrad.php">rainfall</a> and <a href="../evapotrans.php">evapotranspiration data</a> on schedule</li>
  <li>Participate in <a href="https://archive.usgs.gov/archive/sites/sofia.usgs.gov/geer/2010/"><abbr title="Greater Everglades Ecosystem Restoration">GEER</abbr> 2010</a></li>
  <li>Make revisions to EDENapps (if staffing resources available)</li>
  <li>Conduct hydrologic assessments for <abbr title="REstoration COordination and VERification">RECOVER</abbr></li>
  <li>Continue to document EDEN protocols, research, and data analyses</li>
</ul>
<h3><abbr title="seven">VII</abbr>. Unfunded Needs in <abbr title="Fiscal Year 2009">FY09</abbr></h3>
<ul>
  <li>With construction of the Tamiami Trail bridge approved for construction, the EDEN project would like to focus on the hydrology directly upstream and downstream of the new proposed bridge. EDEN can provide useful baseline data prior to and following completion of the bridge in 2012. EDEN project staff have already begun initial discussions with Leonard Pearlstine, Everglades National Park, regarding collaboration and data support.</li>
</ul>
<a id="sxn8"></a>
<h3><abbr title="eight">VIII</abbr>. Anticipated Needs or Issues</h3>
<ul>
  <li>Because the water level data at gages is the foundation of the EDEN surface water interpolation program, the quality of gage data is critical to the resultant EDEN daily water surfaces. Gage data used for EDEN surfaces comes from multiple agencies with varying protocols, schedules, and levels of review. It is a highly ambitious goal to receive hourly data from 230 gages daily (approximately 5520 data values). Even if only 1% (rarely this low) of these data appear bad or are missing, 55 values per day or 5000 values per quarter must be identified and resolved. Monitoring, reviewing, editing (when necessary) and estimating missing and bad data has taken more personnel time than expected. Users see the results as EDEN products when, in fact, they are the result of many others' work outside of EDEN. It has been a serious challenge for me as the project chief to balance sufficient data quality with adequate results and appropriate use of funds.</li>
  <li>EDEN staff continues to be concerned that datum surveys and water level data is not as accurate as necessary to produce a high-quality interpolated water-level surface. Independent data sets at gages may look adequate but when surfaced together can show discontinuities and shifts not seen when viewing water level data gage by gage. Continued investigation of data and files suggests that gage data may still have datum inaccuracies. New funding in 2010 may be available to run new datum surveys to the newest standards for many gages in the Everglades. Any significant changes to the water level dataset might require another round of reparameterizing of the surface water model.</li>
</ul>
<h3><abbr title="nine">IX</abbr>. Funding Status</h3>
<ul>
  <li>As of 9/30/08, all <abbr title="Fiscal Year 2009">FY09</abbr> funding has been expended or obligated.</li>
  <li><abbr title="American Recovery and Reinvestment Act">ARRA</abbr> (economic stimulus) funding was received 6/29/09 and is in the process of being obligated for agreement in accordance with <abbr title="American Recovery and Reinvestment Act">ARRA</abbr> regulations. Funding will be expended by 9/30/10.</li>
</ul>
<?php require ($_SERVER['DOCUMENT_ROOT'] . '/eden/ssi/eden-foot.php'); ?>