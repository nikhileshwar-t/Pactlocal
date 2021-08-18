
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo HTTP_SERVER?>admin/br-validator-tool/assets/css/styles.css">


<section class="offering" id="offering">
   <div class="container-fluid px-1 py-5 mx-auto" id="main">
      <div class="section-title">
         <h2>BR VALIDATOR TOOL</h2>
      </div>
      <div class="container-fluid h-100 main">
         <div class="row" style="height: 30%"></div>
         <div class="row" id="toggler">
            <div class="col-8 offset-2">
               <span class="text-primary form-control-lg">Import Governance Model from :</span>
               <div class="custom-control custom-radio custom-control-inline">
                  <input type="radio" class="custom-control-input" id="tenant" name="toggler" value="tenant" checked>
                  <label class="custom-control-label" for="tenant">Tenant</label>
               </div>
               <div class="custom-control custom-radio custom-control-inline">
                  <input type="radio" class="custom-control-input" id="governmodel" name="toggler"
                     value="governmodel">
                  <label class="custom-control-label" for="governmodel">Governance Model</label>
               </div>
            </div>
         </div>
         <br>
         <div class="row">
            <div class="col-8 offset-2 card show container" id="first">
               <div class="row justify-content-center" id="renderTenant">
                  <div class="col-10 upload">
                     <h4 class="text-center text-dark">Import Governance Model from Tenant</h4>
                     <br>
                  </div>
                  <div class="col-11 offset-1">
                     <span class="text-warning font-weight-bold h5">
                     <i class="fa fa-exclamation-circle"></i>
                     Disclaimer : &nbsp;
                     </span>
                     <div class="d-inline text-secondary">
                        Governance Model of the active tenant in PACT will be used
                     </div>
                  </div>
                  <br><br>
                  <div class="col-8 offset-4">
                     <span class="text-primary font-weight-bold h6">
                     Current tenant : &nbsp;
                     </span>
                     <div class="d-inline text-dark" ><span id="current-tenant"> No Tenant Found</span> 
                        <i class="fa fa-circle fa-xs text-danger" id="tenant-connected"></i>
                     </div>
                  </div>
               </div>
               <br>
               <div class="row justify-content-center d-none" id="renderModel">
                  <div class="card-body col-lg-10 col-md-11 ">
                     <div class="file-field">
                        <label class="form-control-label">Import Governance Model from Data Model </label>
                        <input type="file" id="input" name="rsexcel" class="" accept=".xls , .xlsm , .xlsx">
                        <div class="row">
                           <div id="alert" class="alert alert-warning d-none col-12">
                              <span class="closebtn"
                                 onclick="this.parentElement.style.display='none';">&times;</span>
                              <strong>Warning!</strong> Please upload Governance Model
                           </div>
                           <br>
                           <h9 class="text-info">
                              <i class="fa fa-exclamation-circle"></i>
                              Disclaimer:
                              <div class="d-inline text-secondary">
                                 IF You have single BR to test then
                                 use <a href="https://pact.riversand.com/admin/rbl-editor-web/index.html"
                                    target="_blank">RBL editor</a>
                              </div>
                           </h9>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="row d-flex justify-content-center">
                  <div class="circle">
                     <div class="fa fa-long-arrow-right next" id="next"></div>
                     <div id="prev"></div>
                  </div>
               </div>
            </div>
            <div class="card col-8 offset-2" id="second">
               <div class="row justify-content-center">
                  <div class="col-lg-10 col-md-11 d-none" id="generating">
                     <span class="bold">"Please wait, Generating the report..." </span>
                     <div class="spinner-grow spinner-grow-sm text-light" role="status"></div>
                     <div class="spinner-grow spinner-grow-sm text-light" role="status"></div>
                     <div class="spinner-grow spinner-grow-sm text-light" role="status"></div>
                  </div>
                  <div id="generated">
                     <button class="btn btn-light" id="download">
                     <i class="fa fa-download"></i> Download
                     </button>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>

<script type="text/javascript" language="javascript" >
   var HTTP_SERVER = '<?php echo HTTP_SERVER ?>';
   var JSON_PATH = HTTP_SERVER+ "admin/br-validator-tool/";
</script>

<script src="<?php echo HTTP_SERVER?>assets/js/jquery-3.2.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.16.2/xlsx.full.min.js"></script>

<script src="<?php echo HTTP_SERVER?>admin/br-validator-tool/assets/js/APIController.js"> </script>
<script src="<?php echo HTTP_SERVER?>admin/br-validator-tool/assets/js/ValidationController.js"> </script>
<script src="<?php echo HTTP_SERVER?>admin/br-validator-tool/assets/js/UIController.js"> </script>

<!-- @author Nikhileshwar.T
@company Riversand inc. -->