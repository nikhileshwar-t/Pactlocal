<script src="<?php echo HTTP_SERVER?>admin/graph-process-tool/assets/js/ag-grid-enterprise.min.js"></script>
<script src="<?php echo HTTP_SERVER?>admin/graph-process-tool/assets/js/jquery.min.js"></script>
<!-- <script src="<?php echo HTTP_SERVER?>admin/graph-process-tool/assets/js/bootstrap.min.js"></script> -->
<link href="<?php echo HTTP_SERVER?>admin/graph-process-tool/assets/css/jsoneditor.min.css" rel="stylesheet" type="text/css">
<script src="<?php echo HTTP_SERVER?>admin/graph-process-tool/assets/js/jsoneditor.min.js"></script>
<link rel="stylesheet" href="<?php echo HTTP_SERVER?>admin/graph-process-tool/assets/css/style.css">
<script src="https://cdn.jsdelivr.net/npm/lodash@4.17.10/lodash.min.js"></script>
<section id="form-section" class="offering">
   <div class="container">
   <div class="section-title">
      <h2>Graph Process Model Generator</h2>
   </div>
   <div class="row arrange">
      <div class="col-md-12" id="above">
         <form id="regForm" >
            <div class="tab" id="landing_page">
               <div class="container">
                  <div class="row">
                     <div class="col-6">
                        <button type="button" class="btn btn-success btn-lg" id="create">Create a Graph Process Model</button>
                     </div>
                     <div class="col-6">
                        <button type="button" class="btn btn-warning btn-lg float-right" id="modify">Modify an existing Graph Process Model</button>
                     </div>
                  </div>
                  <br>
                  <div class="row justify-content-center">
                     <table id="myTable" class="display table table-hover" style="width:100%">
                        <thead>
                           <tr>
                              <th>ID</th>
                              <th>Name</th>
                              <th>Link</th>
                           </tr>
                        </thead>
                     </table>
                  </div>
               </div>
            </div>
            <div class="tab" id="entity-selection">
               <h1>Basic Info</h1>
               <div class="entity-selection" style="display:none">
                  <div class="alert alert-danger alert-dismissible fade show" role="alert" id="entity-selection">
                     <b>No Relationships Found Between the Source and Target Entities</b>
                     <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                     </button>
                  </div>
               </div>
               <label for="sourceentitytype"><b>Step 1: Select the Source Entity Type</b></label>
               <select class="form-control" id="sourceentitytype" type="text" name="sourceentitytype" required>
                  <option value="">Select the Source Entity Type</option>
               </select>
               <div id="checker">
                  <label for="targetentitytype"><b>Step 2: Select the Target Entity Type</b></label>
                  <select class="form-control" id="targetentitytype" type="text" name="targetentitytype" required 
                     required disabled>
                     <option value="">Select the Target Entity Type</option>
                  </select>
               </div>
               <label for="relationshiptype" ><b>Step 3: Select the Relationship Type</b></label>
               <select class="form-control" id="relationshiptype" type="text" name="relationshiptype" required>
                  <option value=" ">Select Relationship</option>
               </select>
               <br>
            </div>
            <div class="tab" id="info">
               <h1> Basic Info</h1>
               <label for="id"><b> ID</b></label>
               <input id="id" class="form-control" type="text" name="id" required>
               <label for="name"><b> Name</b></label>
               <input id="name" class="form-control" type="text" name="name" required>
               <label for="graphprocess"><b> Graph Process Path</b></label>
               <input id="graphprocess" class="form-control"  type="text" name="graphprocess" required>
               <label for="Matchruleoperator"><b>Match Rule Operator</b></label>
               <select id="matchruleoperator" class="form-control" type="text" name="Matchruleoperator" required>
                  <option value="or">OR</option>
                  <option value="and">AND</option>
               </select>
               <br><br>
            </div>
            <div class="tab" id="matchrule">
               <h1> Match Rule Set</h1>
               <div class="match-rule-alert" style="display:none">
                  <div class="alert alert-danger alert-dismissible fade show" role="alert" id="match-rule-alert">
                     <b>Select all the MatchResults</b>
                     <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                     </button>
                  </div>
               </div>
               <label for="sequence"><b>Step 1: Enter Match Sequence</b></label>
               <input type="number"  id="sequence" class="form-control">
               <label for="Matchtype"><b>Step 2: Select the Match Type</b></label>
               <select id="Matchtype" class="form-control" type="text" name="Matchtype" required>
                  <option value="">select</option>
                  <option value="attributeBased">attributeBased</option>
                  <option value="relationshipBased">relationshipBased</option>
                  <option value="whereUsedRelationshipBased">whereUsedRelationshipBased</option>
               </select>
               <div id="attMapAppend" class="container">
                  <div class="row">
                     <br>
                     <label for="" class="col-12"><b>Select Source and Target attributes</b></label><br>
                     <select  id="sourceattributes" class="form-control col">
                        <option value="">Select</option>
                     </select>
                     <select  id="targetattributes" class="form-control col">
                        <option value="">Select</option>
                     </select>
                  </div>
                  <div class="row">
                     <textarea class="form-control" placeholder="select the source and target attributes to map one to one relation between them the mapping will be displayed here in it's json format" id="attributemapping" cols="75" rows="4" spellcheck="false" readonly></textarea>
                  </div>
                  <div class="row">
                     <label for="">Do you want smartIdAttributes
                     <input type="checkbox"  id="smartidcheck">
                     </label>
                     <textarea class="form-control" id="smartidattributes" cols="75" rows="4" spellcheck="false"></textarea>
                  </div>
               </div>
               <label for="nomatchresult"><b>Step 3: Select No Match Result</b></label>
               <select id="nomatchresult" class="form-control" type="text" name="nomatchresult" required>
                  <option value="" selected>Select</option>
                  <option value="Create">Create</option>
                  <option value="AddSourceRelationship">AddSourceRelationship</option>
                  <option value="AddTargetRelationship">AddTargetRelationship</option>
                  <option value="CopyData">CopyData</option>
                  <option value="Create,AddSourceRelationship">Create,AddSourceRelationship</option>
                  <option value="AddSourceRelationship,CopyData">AddSourceRelationship,CopyData</option>
                  <option value="Create,AddSourceRelationship,CopyData">Create,AddSourceRelationship,CopyData</option>
                  <option value="Create,AddTargetRelationship">Create,AddTargetRelationship</option>
                  <option value="AddTargetRelationship,CopyData">AddTargetRelationship,CopyData</option>
                  <option value="Create,AddTargetRelationship,CopyData">Create,AddTargetRelationship,CopyData</option>
                  <option value="Error">Error</option>
                  <option value="DoNothing">DoNothing</option>
               </select>
               <label for="singlematchresult"><b>Step 4: Select Single Match Result</b></label>
               <select id="singlematchresult" class="form-control" type="text" name="singlematchresult" required>
                  <option value="" selected>Select</option>
                  <option value="AddSourceRelationship">AddSourceRelationship</option>
                  <option value="AddTargetRelationship">AddTargetRelationship</option>
                  <option value="CopyData">CopyData</option>
                  <option value="AddSourceRelationship,CopyData">AddSourceRelationship,CopyData</option>
                  <option value="AddTargetRelationship,CopyData">AddTargetRelationship,CopyData</option>
                  <option value="Error">Error</option>
                  <option value="DoNothing">DoNothing</option>
               </select>
               <label for="multimatchresult"><b>Step 5: Multi Match Result</b></label>
               <select id="multimatchresult" class="form-control" type="text" name="multimatchresult" required>
                  <option value="" selected>Select</option>
                  <option value="AddSourceRelationship">AddSourceRelationship</option>
                  <option value="AddTargetRelationship">AddTargetRelationship</option>
                  <option value="CopyData">CopyData</option>
                  <option value="AddSourceRelationship,CopyData">AddSourceRelationship,CopyData</option>
                  <option value="AddTargetRelationship,CopyData">AddTargetRelationship,CopyData</option>
                  <option value="Error">Error</option>
                  <option value="DoNothing">DoNothing</option>
               </select>
               <br>
               <div class="container">
                  <div id="matchRuleSetButtons" class="">
                  </div>
                  <div class="float-right">
                     <button type="button" class="btn btn-warning" id="modifymatchrule">Update Match Tool Set</button>
                     <button type="button" class="btn btn-warning" id="addmatchrule">Add Match Rule Set</button>
                  </div>
               </div>
               <br><br>
            </div>
            <div class="tab" id="attributes">
               <h2 style="text-align:center"> Attribute Strategy Definition</h2>
               <br>
               <div class="container">
                  <div class="d-flex flex-row-reverse">
                     <div class="col-1"></div>
                     <button type="button" class=" btn btn-secondary" id="addRow" style="background-color:#fff"><i class="icofont-plus" style="font-size:15px;color:#575A61;"></i></button>
                  </div>
                  <div class="row">
                     <div class="col-md-4 offset-1">
                        <textarea   class="form-control" id="excel" cols="30" rows="10" spellcheck="false" placeholder="Paste the attributes here to import, please paste each attribute in a newline and hit import Remember to import existing attributes before you add any additional attributes"></textarea>
                     </div>
                     <div class="col-md-1 d-flex align-items-center">
                        <button type="button" class=" btn btn-success " id="importAttributes" style="background-color:#fff"><i class="icofont-arrow-right" style="font-size:30px;color:#4CAF50;"></i></button>
                     </div>
                     <div class="col-md-4">
                        <div id="myGrid"  class ="ag-theme-alpine att"></div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-md-5 offset-6">
                        <select class="form-control"  id="bulk-edit">
                           <option value=" ">Select Strategy Selection for Bulk Edit</option>
                           <option value="copy">copy</option>
                           <option value="copyWhenNotLocal">copyWhenNotLocal</option>
                           <option value="copyWhenEmpty">copyWhenEmpty</option>
                           <option value="aggregate">aggregate</option>
                           <option value="min">min</option>
                           <option value="max">max</option>
                        </select>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-md-5 offset-6">
                        <select  id="bulk-edit-mode" class="form-control">
                           <option value=" ">Select Strategy Mode for Bulk Edit</option>
                           <option value="none"></option>
                           <option value="merge">merge</option>
                           <option value="replace">replace</option>
                        </select>
                     </div>
                  </div>
               </div>
               <br><br>
            </div>
            <div class="tab" id="relationships">
               <h1>Relationships Selection</h1>
               <div id="relations" class="float-left">
               </div>
               <br>
               <br>
               <br>
               <br>
               <br>
               <br>
            </div>
            <div class="container">
               <div class="float-right row">
                  <button type="button" class="btn btn-secondary" id="prev">Previous</button>&nbsp;
                  <button type="button" class="btn btn-success" id="next" >Next</button>
               </div>
            </div>
            <div style="text-align:center">
               <span class="step"></span>
               <span class="step"></span>
               <span class="step"></span>
               <span class="step"></span>
               <span class="step"></span>
               <span class="step"></span>
            </div>
         </form>
      </div>
      <div class="col-md-12 " id="below">
         <div class="row button-row">
            <button class="btn btn-warning back" > Back </button>
         </div>         
         <div class="row jeditorrow">
            <div id="jsoneditor1"></div>
            <div id="jsoneditor2"></div>
         </div>        
         <div class="row button-row">
            <button class="btn btn-warning back">Back</button>
         </div>
      </div>
   </div>
   <!-- Button trigger modal -->
   <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#deleteimpacted" id="deletetrigger" style="display:none">
   delete impacted attributes and relationships
   </button>
   <!-- Modal -->
   <div class="modal fade" id="deleteimpacted" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
         <div class="modal-content">
            <div class="modal-body">
               Do you want to create Graph Process Model to Delete Impacted Attributes and Relationships
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
               <button type="button" class="btn btn-primary" data-dismiss="modal" data-toggle="modal"  data-target="#exampleModalCenter" id="choseActionName">Yes</button>
            </div>
         </div>
      </div>
   </div>
   <!-- Modal -->
   <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title" id="exampleModalLongTitle">Choose The Action Name </h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
               </button>
            </div>
            <div class="modal-body">
               <div class="form-check">
                  <label class="form-check-label">
                  <input type="radio" class="form-check-input" name="actionName" id="delete" value="delete">Delete
                  </label>
               </div>
               <div class="form-check">
                  <label class="form-check-label">
                  <input type="radio" class="form-check-input" name="actionName" id="deleterelationship" value="deleterelationship" >Delete Relationship
                  </label>
               </div>
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
               <button type="button" class="btn btn-primary" data-dismiss="modal" id="deleteJson">Generate Json</button>
            </div>
         </div>
      </div>
   </div>
   <!-- Button trigger modal -->
   <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#checkIfUserNeedRelations" id="relations-trigger" style="display:none">
   delete impacted attributes and relationships
   </button>
   <!-- Modal -->
   <div class="modal fade" id="checkIfUserNeedRelations" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
         <div class="modal-content">
            <div class="modal-body">
               <b>Do you want to add Relationships data to your Graph Process</b>
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-secondary" data-dismiss="modal" id="noReltaionsNeeded">No</button>
               <button type="button" class="btn btn-primary" data-dismiss="modal"  data-target="#exampleModalCenter">Yes</button>
            </div>
         </div>
      </div>
   </div>
</section>
<script type="text/javascript" language="javascript" >
   var HTTP_SERVER = '<?php echo HTTP_SERVER ?>';
   var JSON_PATH = HTTP_SERVER+ "admin/graph-process-tool/";
</script>
<script src="<?php echo HTTP_SERVER?>admin/graph-process-tool/assets/js/editor.js"></script>
<script src="<?php echo HTTP_SERVER?>admin/graph-process-tool/assets/js/api-caller.js"></script>
<script src="<?php echo HTTP_SERVER?>admin/graph-process-tool/assets/js/auto-filler.js"></script>
<script src="<?php echo HTTP_SERVER?>admin/graph-process-tool/assets/js/match-rule-set.js"></script>
<script src="<?php echo HTTP_SERVER?>admin/graph-process-tool/assets/js/attributes-grid.js"></script>
<script src="<?php echo HTTP_SERVER?>admin/graph-process-tool/assets/js/result-json-populator.js"></script>
<script src="<?php echo HTTP_SERVER?>admin/graph-process-tool/assets/js/tab-switcher.js"></script>