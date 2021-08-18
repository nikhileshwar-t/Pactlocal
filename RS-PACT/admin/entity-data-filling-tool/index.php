
    <!-- <link rel="stylesheet" href="<?php echo HTTP_SERVER?>assets/css/resources/bootstrap.min.css"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo HTTP_SERVER?>admin/entity-data-filling-tool/assets/css/styles.css">




<section class="offering" id="offering">
    <div class="container" >
        <div class="section-title">

            <h2>Entity Data Filling Tool</h2>
        </div>
        <br>
        <div class="container-fluid px-1 py-5 mx-auto "id="main"s>
        <div class="row d-flex justify-content-center">
            <div class="col-xl-7 col-lg-8 col-md-9">
                <ul id="progressbar" class="text-center">
                    <li class="active step0" id="step1">UPLOAD EXCELS</li>
                    <li class="step0" id="step2">UPLOAD MAPPING</li>
                    <li class="step0" id="step3">DOWNLOAD</li>
                </ul>
                <div class="card b-0 show">
                    <div class="row justify-content-center">
                        <div class="card-body col-lg-10 col-md-11">
                            <div class="file-field">
                            <label class="form-control-label">Entity Data (entity RS excel format) </label><span class="label label-danger">new</span>
                              <input type="file" id="rsexcel" name="rsexcel" class="" onchange=" processFiles()" multiple accept=".xls , .xlsm , .xlsx"  onblur="validate1(1)">
                            </div>
                            <div class="file-field">
                                <label class="form-control-label">External Template (xls,xlsx)</label>
                             
                                   <input type="file" id="externalexcel" name="externalexcel" class=""  onchange="headerFiles()" multiple accept=".xls , .xlsm , .xlsx" 
                                    onblur="validate1(2)">
                            </div>
                            <div class="row">
                            <h9 class="text-info">
                           <i class="fa fa-exclamation-circle"></i>
                           Disclaimer: 
                           <div class="d-inline text-secondary">
                           The External template should contain headers in the first row and the sheet name should be Sheet1
                                       
                           </div>
                        </h9>
                            </div>
                           
                        </div>
                    </div>
                    <div class="row d-flex justify-content-center">
                        <div class="circle">
                            <div class="fa fa-long-arrow-right next" id="next1" onclick="validate1(0)"></div>
                        </div>
                    </div>
                </div>



                <div class="card b-0">
                    <!-- <div class="fa fa-long-arrow-left prev"> </div> -->
                    <div class="row justify-content-center">
                        <div class="col-lg-10 col-md-11">
                            <div class="file-field">
                                <label class="form-control-label">Attribute Mappingfile</label>
                                <input type="file" id="mapping" name="mapping" onchange="mappingFiles()" multiple class="" accept=".xls , .xlsm , .xlsx"
                                    onblur="validate2(1)">
                            </div>
                        </div>
                    </div>
                    <div class="row d-flex justify-content-center">
                        <div class="circle">
                            <div class="fa fa-long-arrow-right next" id="next2" onclick="validate2(0)"></div>
                        </div>
                    </div>
                </div>
                <div class="card b-0">
                    <div class="row justify-content-center">
                        <div class="col-lg-10 col-md-11">
                            <button class="btn" id="download"><i class="fa fa-download"> </i> Updated file with Data</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
        
 
</div>
</section>


<script type="text/javascript" language="javascript" >
   var HTTP_SERVER = '<?php echo HTTP_SERVER ?>';
   var JSON_PATH = HTTP_SERVER+ "admin/entity-data-filling-tool/";
</script>

     <script src="https://code.jquery.com/jquery-3.5.1.min.js"
        integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <!-- <script src="<?php echo HTTP_SERVER?>assets/js/resources/jquery-3.5.1.min.js" integrity=""></script>
    <script src="<?php echo HTTP_SERVER?>assets/js/resources/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script> -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.16.2/xlsx.full.min.js"></script>

    <script src="<?php echo HTTP_SERVER?>admin/entity-data-filling-tool/assets/js/script.js"> </script>

   

