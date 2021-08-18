
<link rel="stylesheet" href="<?php echo HTTP_SERVER?>admin/attribute-mapping-tool/assets/css/styles.css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.14.0/css/all.css" integrity="" crossorigin="anonymous">

<link href="//cdn.syncfusion.com/ej2/ej2-base/styles/material.css" rel="stylesheet">
<link href="//cdn.syncfusion.com/ej2/ej2-inputs/styles/material.css" rel="stylesheet">
<link href="//cdn.syncfusion.com/ej2/ej2-dropdowns/styles/material.css" rel="stylesheet">
<link href="//cdn.syncfusion.com/ej2/ej2-buttons/styles/material.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jsoneditor/9.1.1/jsoneditor.css" integrity="" crossorigin="anonymous" />

<section id="offering" class="offering">
   <div class="container">
      <div class="section-title ">
         <h2>Attribute Mapping Tool</h2>
      </div>
      <br>
      <div class="row attribute-mapping-tool-container">
         <div class="container-fluid h-100">
            <ul class="nav nav-tabs d-none" id="tab-navigation" role="tablist">
               <li class="nav-item">
                  <a class="nav-link active" data-toggle="tab" href="#tab-1" role="tab" aria-controls="tab-1" aria-selected="true">tab-1</a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" data-toggle="tab" href="#tab-2" role="tab" aria-controls="tab-2" aria-selected="true">tab-2</a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" data-toggle="tab" href="#tab-3" role="tab" aria-controls="tab-3" aria-selected="true">tab-3</a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" data-toggle="tab" href="#tab-4" role="tab" aria-controls="tab-4" aria-selected="true">tab-4</a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" data-toggle="tab" href="#tab-5" role="tab" aria-controls="tab-5" aria-selected="true">tab-5</a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" data-toggle="tab" href="#tab-4" role="tab" aria-controls="tab-6" aria-selected="true">tab-6</a>
               </li>
            </ul>
            <div class="tab-content" id="navigation">
               <div class=" tab-pane fade show active" id="tab-1">
                  <br><br><br>
                  <div class="row">
                     <div class="col-md-3 offset-1">
                       <button class="btn btn-success" id="create-mapping"><h5>Create new mapping</h5></button>
                     </div>
                     <div class="col-md-4 offset-3">
                     <button class="btn btn-warning" id="download-existing-mapping"><h5>Download existing mappings</h5></button>
                     </div>
                  </div>
                  <br><br>
                  <div class="row">
                     <div class="col-md-10 offset-1 tt d-none">
                        <table id="saved-mappings" class='table table-striped table-bordered align-self-center'>
                           <thead>
                              <tr>
                                 <th>Name</th>
                                 <th>Excel</th>
                                 <th>Json</th>
                              </tr>
                           </thead>
                           <tbody>
                           </tbody>
                        </table>
                     </div>
                  </div>
                  <a id="existing-json"></a>
               </div>

               <div class=" tab-pane fade" id="tab-2">
                  <div class="row" style="height: 30%;">
                     <div class="col-md-12 ">
                        <div class="container-fluid">
                           <div class="row">
                              <!-- <br><br><br><br><br><br><br> -->
                           </div>
                           <div class="row">
                              <div class="col-md-1"></div>
                              <div class="text-primary form-control-lg">Import attributes from :
                                 &nbsp;&nbsp;&nbsp;
                                 <label for="customRadioInline1" class="text-dark">
                                 <input type="radio" id="pim-from-1" name="pim-from" value="pim-from-menu" checked>&nbsp; Tenant
                                 </label>&nbsp;&nbsp;&nbsp;
                                 <label for="customRadioInline1" class="text-dark">
                                 <input type="radio" id="pim-from-2" name="pim-from" value="pim-from-excel">&nbsp; Excel
                                 </label>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div style="line-height: 10px;">
                     &nbsp;
                  </div>
                  <div class="row">
                     <div class="col-md-1"></div>
                     <div class="col-md-5 upload">
                        <h5 class="text-center text-primary">Import Master Data</h5>
                        <br>
                        <div class="tab-content" id="tabContent">
                           <ul class="nav nav-tabs d-none">
                              <li class="nav-item">
                                 <a class="nav-link active" href="#pim-from-menu" data-toggle="tab" role="tab"
                                    aria-controls="pim-from-menu" aria-selected="true">Menu</a>
                              </li>
                              <li class="nav-item">
                                 <a class="nav-link" href="#pim-from-excel" data-toggle="tab" role="tab" aria-controls="pim-from-excel"
                                    aria-selected="true">Excel</a>
                              </li>
                           </ul>
                           <div id="pim-from-menu" class="tab-pane fade show active" role="tabpanel">
                              <div class="container">
                                 <div class="row h-100">
                                    &nbsp;
                                    <br>
                                 </div>
                                 <div class="row">
                                    <h5 class="text-warning">
                                       <i class="fa fa-exclamation-circle"></i>
                                       Disclaimer : 
                                       <div class="d-inline text-secondary">
                                          All attributes will be automatically fetched from the tenant configured in PACT Tenant Config Tab.
                                       </div>
                                    </h5>
                                 </div>
                                 <br>
                                 <br>
                                 <div class="row justify-content-center">
                                    <h6>
                                       <div class="d-inline text-primary">Current tenant </div>
                                       <div class="d-inline text-dark" id="current-tenant"></div>
                                       <div class="d-inline text-danger" id="tenant-connected"><i class="fa fa-circle fa-xs"></i></div>
                                    </h6>
                                 </div>
                              </div>
                           </div>
                           <div id="pim-from-excel" class="tab-pane fade" role="tabpanel">
                              <br>
                              <div class="custom-file">
                                 <input type="file" class="custom-file-input" id="pim-excel"
                                    aria-describedby="fileHelptext" accept=".xls , .xlsx , .xslm" required multiple>
                                 <label class="custom-file-label" id="pim-excel-label" for="downstream-excel">Upload the data model or template here..</label>
                              </div>
                              <div class="row">
                                    <h6 class="text-info">
                                       <i class="fa fa-exclamation-circle"></i>
                                       info : 
                                       <div class="d-inline text-secondary">
                                       You can directly upload your DataModel or populate your Attributes using below template
                                       </div>
                                    </h6>
                              </div>
                              <br><br>
                              <a id="pim-excel-templete" download="PIMExcelTemplate"><button
                                 class="btn btn-success">Download Excel Template</button></a>
                           </div>
                        </div>
                     </div>
                     &nbsp;&nbsp;&nbsp;
                     <div class="col-md-5 upload">
                        <h5 class="text-center text-primary">Import External System Attributes</h5>
                        <br>
                        <br>
                        <div class="custom-file">
                           <input type="file" class="custom-file-input" id="external-from-excel" aria-describedby="fileHelp"
                              accept=".xls , .xlsx , .xslm" required>
                           <label class="custom-file-label" id="external-excel-label" for="external-from-excel">Upload the populated template here...</label>
                        </div>
                        <h6 class="text-info">
                           <i class="fa fa-exclamation-circle"></i>
                           info : 
                           <div class="d-inline text-secondary">
                           use the below template to populate your attributes and upload
                           </div>
                        </h6>                        
                        <br><br>
                        <a id="external-excel-templete" download="externalExcelTemplate"><button class="btn btn-success">Download
                        Excel Template</button></a>
                     </div>
                     <div class="col-md-1"></div>
                  </div>
               </div>

               <div class="tab-pane fade" id="tab-3">
                  <br>
                  <div class="row">
                     <div class="col-md-6 offset-1">
                     
                        <button class="btn btn-primary" id="global-save" data-toggle="tooltip" data-placement="top" title="Save the Mapping">Save</button>
                        <button class="btn btn-warning" id="global-download" data-toggle="tooltip" data-placement="top" title="Download Mapped Attributes in Excel">Download</button>
                        <button class="btn btn-success" id="go-to-filter" data-toggle="tooltip" data-placement="top" title="Apply Filters">Filter <i class="fa fa-filter"></i></button>
                     </div>
                     <div class=" col-md-3 offset-2">                        
                     <button class="btn btn-warning" id="generate-global-config" data-toggle="tooltip" data-placement="top" title="generate config file">Generate Config Json</button>
                     </div>
                  </div>
                  <br>
                  <!-- <div class="row" style="height: 10%;"><br></div> -->
                  <div class="row">
                     <div class="col-md-1"></div>
                     <div class="col-md-10">
                        <table id="global-datatable" class=" table display" style="width:100%">
                           <thead class="thead-light">
                              <tr>
                                 <th class='d-none'>Slno.</th>
                                 <th>PIM Attributes</th>
                                 <th>Display Name</th>
                                 <th>Data Type</th>
                                 <th>External Mapped Attributes</th>
                                 <th>Delete</th>
                              </tr>
                           </thead>
                           <tbody >
                           </tbody>
                        </table>
                     </div>
                     <div class="col-md-1"></div>
                  </div>
               </div>

               <div class="tab-pane fade" id="tab-4">
                  <br><br>
                  <div class="row">
                     <div class="col-md-4">
                        <!-- <textarea name="" id="config-template" cols="50" rows="13" placeholder="Enter the config json template" spellcheck="false"></textarea> -->
                        <div id="config-template" style="width: 400px; height: 350px;"></div>
                     </div>

                     <div class="col-md-7 offset-1 align-self-center">
                        <h6>
                           <i class="fa fa-info-circle text-primary">Disclaimer : </i>
                           <div>
                              Enter the <b>@@pim_attribute@@ , @@external_attribute@@ , @@datatype@@</b> where you want the respective values to be populated in your custom template
                           </div>
                           <br>
                           Here is a sample json template : 
                           <img id="sample-json">
                        </h6>
                     </div>
                  </div>
                     
                  <br><br>
                  <div class="row">
                     <div class="col-md-4 offset-8">
                        <button id="generate-config" class="btn btn-primary">Generate Config File
                           <a id="download-config" style="display:none"></a></button>
                        <button id="go-to-filter2" class="btn btn-success">Filter Attributes</button>
                        <button id="generate-config2" class="btn btn-primary d-none">Generate Config File
                           <a id="download-config2" style="display:none"></a></button>
                     </div>
                  </div>
               </div>

               <div class="tab-pane fade" id="tab-5">
                  <div class="row">
                     <div class="col-md-3" id="domain-selector-block">
                        <label for="domain-selector" class="blockquote">Choose the Domains</label>
                        <br>
                        <select id="domain-selector" name="domain-selector" class="selectpicker" multiple>
                           <option value="thing" selected>Thing</option>
                           <option value="party">Party</option>
                           <option value="digitalasset">digital Asset</option>
                        </select>
                     </div>
                     <div class="col-md-3 d-none" id="entity-selector-block">
                        <label for="entity-selector" class="blockquote">Entity Types</label> 
                        <br>
                        <select id="entity-selector" name="entity-selector" class="selectpicker" multiple data-live-search="true">
                        </select>
                     </div>
                     <div class="col-md-3 d-none" id="enhancer-attributes-selector-block">
                        <label for="enhancer-attributes-selector" class="blockquote">Enhancer Attributes</label>
                        <br>
                        <select name="enhancer-attributes-selector" id="enhancer-attributes-selector"  class="selectpicker" multiple data-live-search="true">
                        </select>
                     </div>
                     <div class="col-md-3 d-none" id="context-selector-block" >
                        <label for="context-selector" class="blockquote">Context Types</label>
                        <br>
                        <select id="context-selector" name="context-selector" class="selectpicker" multiple data-live-search="true">
                        </select>
                     </div>
                  </div>
                  <br>
                  <div class="row d-none" id="taxonomy-block">
                     <div class="col-md-4" >
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <label for="taxonomy-input" class="blockquote">Taxonomy (Enter coalesce path) : </label>
                     </div>

                     <div class="col-md-7">
                        <input type="text" name="taxonomy-input" id="taxonomy-input" placeholder="Coalesce path" class="input-group-text w-100">
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-md-5 offset-1">
                        <button class="btn btn-success" id="filter">Submit <i class="fa fa-bolt"></i></button>
                        <button class="btn btn-warning d-none" id="filter-download">Download</button>
                        <button class="btn btn-primary d-none" id="filter-save">Save</button>
                     </div>
                     <div class="col-md-3 offset-3">
                     <button class="btn btn-warning d-none" id="generate-filter-config" data-toggle="tooltip" data-placement="top" title="generate config file">Generate Config Json</button>
                     </div>
                  </div>
                  <br>
                  <div class="row">
                     <div class="col-md-1"></div>
                     <div class="col-md-10">
                        <table id="filtered-datatable" class=" table display d-none" style="width:100%">
                        </table>
                     </div>
                     <div class="col-md-1"></div>
                  </div>
               </div>
            </div>
            <br>
            <div class="row">
               <div class="col-md-10"></div>
               <div>
                  <button class="btn btn-secondary  d-none" id="prev">Prev</button>
                  <button class="btn btn-success d-none" id="next">Map the Attributes</button>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>

<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="modal-title">Modal title</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body" id="modal-body">
            please provide the inputs needed
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-primary" data-dismiss="modal" id="modal-button">Ok</button>
        </div>
        </div>
    </div>
</div>

<script type="text/javascript" language="javascript" >
   var HTTP_SERVER = '<?php echo HTTP_SERVER ?>';
   var JSON_PATH = HTTP_SERVER+ "admin/attribute-mapping-tool/";
</script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.16.7/xlsx.full.min.js"></script>
    <script src="<?php echo HTTP_SERVER?>admin/attribute-mapping-tool/assets/js/resources/jquery-3.5.1.js"></script>
    <script src="<?php echo HTTP_SERVER?>admin/attribute-mapping-tool/assets/js/resources/popper.min.js"></script>
    <script src="https://cdn.syncfusion.com/ej2/dist/ej2.min.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jsoneditor/9.1.1/jsoneditor.min.js" integrity="" crossorigin="anonymous"></script>

    <script src="<?php echo HTTP_SERVER?>admin/attribute-mapping-tool/assets/js/apis/phpAPIs.js"></script>
    <script src="<?php echo HTTP_SERVER?>admin/attribute-mapping-tool/assets/js/apis/APIController.js"></script>
    <script src="<?php echo HTTP_SERVER?>admin/attribute-mapping-tool/assets/js/jaroWinklerDistanceAlgo.js"></script>
    <script src="<?php echo HTTP_SERVER?>admin/attribute-mapping-tool/assets/js/levenshteinDistanceAlgo.js"></script>
    <script src="<?php echo HTTP_SERVER?>admin/attribute-mapping-tool/assets/js/excelFileConverter.js"></script>
    <script src="<?php echo HTTP_SERVER?>admin/attribute-mapping-tool/assets/js/algoController.js"></script>
    <script src="<?php echo HTTP_SERVER?>admin/attribute-mapping-tool/assets/js/dataTablesRenderer.js"></script>
    <script src="<?php echo HTTP_SERVER?>admin/attribute-mapping-tool/assets/js/filters.js"></script>
    <script src="<?php echo HTTP_SERVER?>admin/attribute-mapping-tool/assets/js/configGenerator.js"></script>
    <script src="<?php echo HTTP_SERVER?>admin/attribute-mapping-tool/assets/js/UIController.js"></script>
    <script src="<?php echo HTTP_SERVER?>admin/attribute-mapping-tool/assets/js/StoreInDatabase.js"></script>
