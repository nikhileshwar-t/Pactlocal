<!-- ======= Offering Section ======= -->
<section id="offering" class="offering">
   <div class="container">
      <div class="section-title">
         <h2>Riversand PACT Dashboard</h2>
         <div class="row">
         <?php if( !empty($_SESSION["AdminLogin"]) || !empty($_SESSION["permissions"]["RBL_WEB"]["permission"]) ) {  ?>
            <div class="col-md-6 ">
               <div class="offering-card pact" data-aos="fade-up">
                  <a href="#">
                     <h4>Riversand Business Language Editor Web version </h4>
                  </a>
                  <hr>
                  <ul>
                     <li><a href="<?php echo HTTP_SERVER ?>admin/rbl-editor-web/index.html" data-event='rbl-editor-web' class='addLogAndRedirect'>Click here goto RBL Web editor</a></li>
                  <ul>
               </div>
            </div>

            <?php }  if( !empty($_SESSION["AdminLogin"]) || !empty($_SESSION["permissions"]["BR_VALIDATOR_TOOL"]["permission"]) ) {  ?>
            <div class="col-md-6 ">
               <div class="offering-card pact" data-aos="fade-up">
                  <a href="<?php echo HTTP_SERVER ?>admin/index.php?t=br-validator-tool&p=index">
                     <h4>BR Validator Tool</h4>
                  </a>
                  <hr>
                  <ul>
                  <li><a href="#">Import Governance Model</a></li>
                  <li><a href="#">Export Validated Governance Model</a></li>
                  </ul>
               </div>
            </div>

            <?php } if( !empty($_SESSION["AdminLogin"]) || !empty($_SESSION["permissions"]["AUTHORIZATION_MODEL_TOOL"]["permission"]) ) { ?> 

            <div class="col-md-6 ">
               <div class="offering-card pact" data-aos="fade-up">
                  <a href="<?php echo HTTP_SERVER ?>admin/index.php?t=authorization-model-tool&p=authconfig-api">
                     <h4>Authorization Model</h4>
                  </a>
                  <hr>
                  <ul>
                  <li><a href="<?php echo HTTP_SERVER?>admin/index.php?t=authorization-model-tool&p=authWizard">Authorization Create Wizard</a></li>
                  <li><a href="#">Authorization Postman Config</a></li>
                  <li><a href="#">Import Pivot Model</a></li>
                  <li><a href="#">Export Authorization Model </a></li>
                  <ul>
               </div>
            </div>

         <?php } if( !empty($_SESSION["AdminLogin"]) || !empty($_SESSION["permissions"]["WORKFLOW_APP_MODEL"]["permission"]) ) {  ?>
            <div class="col-md-6 ">
               <div class="offering-card pact" data-aos="fade-up">
                  <a href="<?php echo HTTP_SERVER ?>admin/index.php?t=workflow-app-model&p=workflow-app-model">
                     <h4>Workflow App Model</h4>
                  </a>
                  <hr>
                  <ul>
                  <li><a href="#">Import Workflow XAML</a></li>
                  <li><a href="#">Export Workflow App Model</a></li>
                  <ul>
               </div>
            </div>
           
         <?php } if( !empty($_SESSION["AdminLogin"]) || !empty($_SESSION["permissions"]["RBL"]["permission"]) ) {  ?>    
            <div class="col-md-6 ">
               <div class="offering-card pact" data-aos="fade-up">
                  <a href="<?php echo HTTP_SERVER ?>admin/index.php?t=rbl-editor-desktop&p=rbl">
                     <h4>Riversand Business Language Editor Desktop version </h4>
                  </a>
                  <hr>
                  <ul>
                     <li><a href="<?php echo HTTP_SERVER ?>admin/rbl-editor-desktop/RBL-Editor.zip">Click here to download the .exe file</a></li>
                     <li><a href="<?php echo HTTP_SERVER ?>admin/rbl-editor-desktop/jdk-8u231-windows-x64.zip" >Click here to download the jdk-8u231-windows-x64 file</a></li>
                  <ul>
               </div>
            </div>

            <?php } if( !empty($_SESSION["AdminLogin"]) || !empty($_SESSION["permissions"]["UI_CONFIG_TOOL"]["permission"]) ) {  ?>
            <div class="col-md-6 ">
               <div class="offering-card pact" data-aos="fade-up">
                  <a href='https://pact-uiconfigurator.riversand.com/' data-event='ui-config-tool' class='addLogAndRedirect' >
                     <h4>UI Configuration Tool</h4>
                  </a>
                  <hr>
                  <ul>
                  <li><a href="#">Base Configurations</a></li>
                  <li><a href="#">Multi Level Configurations</a></li>
                  <ul>
               </div>
            </div>
            
         <?php }  if( !empty($_SESSION["AdminLogin"]) || !empty($_SESSION["permissions"]["GRAPH_PROCESS_TOOL"]["permission"]) ) {  ?>
            <div class="col-md-6 ">
               <div class="offering-card pact" data-aos="fade-up">
                  <a href="<?php echo HTTP_SERVER ?>admin/index.php?t=graph-process-tool&p=index">
                     <h4>Graph Process Tool</h4>
                  </a>
                  <hr>
                  <ul>
                  <!-- <li><a href="#">Graph Process Tool</a></li>
                  <li><a href="#">Multi Level Configurations</a></li> -->
                   
                  <li><a href="#">Roll Up From Child to Parent</a></li>
                  <li><a href="#">Roll Down Parent to Child</a></li>
                  <li><a href="#">Autolink The Assets to TargetEntity</a></li>
                  <ul>
               </div>
            </div>
            
         <?php } if( !empty($_SESSION["AdminLogin"]) || !empty($_SESSION["permissions"]["ATTR_MAPPING_TOOL"]["permission"]) ) {  ?>
            <div class="col-md-6 ">
               <div class="offering-card pact" data-aos="fade-up">
                  <a href="<?php echo HTTP_SERVER ?>admin/index.php?t=attribute-mapping-tool&p=index">
                     <h4>Attribute Mapping Tool</h4>
                  </a>
                  <hr>
                  <ul>
                     
                  <li><a href="#">Import Master Data</a></li>
                  <li><a href="#">Import External System Attributes</a></li>
                  <li><a href="#">Export Attribute Mapped File</a></li>
                 
                  <!-- <li><a href="#">Graph Process Tool</a></li>
                  <li><a href="#">Multi Level Configurations</a></li> -->
                  <ul>
               </div>
            </div>
            
         <?php } ?> 
         </div>
</section>
<!-- End offering Section -->
