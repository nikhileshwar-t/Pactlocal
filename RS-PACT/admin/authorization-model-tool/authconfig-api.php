<body onload="getAuthDetailsFromLocalStorage();">
    <!-- ======= Offering Section ======= -->
    <section id="form-section" class="offering">
        <form id="form1" name="form1" method="post" action="<?php echo HTTP_SERVER?>admin/authorization-model-tool/generateexcel.php" >
        <div class="container">

          <div class="section-title"> <h2>Riversand Authorization Service</h2> </div>
            <div class="row">
                <div class="col-md-6 ">
                    <div class="form-card " >
                        <h4>Riversand Auth Service</h4>  <hr />

                        <h5>Click below steps to configutre Authorization Model:</h5>
                        <div class="list-group">                       
                            <a href = "<?php echo HTTP_SERVER?>admin/index.php?t=authorization-model-tool&p=authWizard" class="list-group-item list-group-item-action al">Step 1: Manage Roles & Users</a>
                            <a href = "<?php echo HTTP_SERVER?>admin/index.php?t=authorization-model-tool&p=thingWizard" class="list-group-item list-group-item-action al">Step 2: Manage Thing Entity types & related attributes</a>
                            <a href = "<?php echo HTTP_SERVER?>admin/index.php?t=authorization-model-tool&p=contextWizard" class="list-group-item list-group-item-action al ">Step 3: Manage Context type & Context names</a>
                            <a href = "<?php echo HTTP_SERVER?>admin/index.php?t=authorization-model-tool&p=contextEntityWizard" class="list-group-item list-group-item-action al">Step 4: Manage Context Entity types & related attributes</a>
                        </div>

                        <div id="upload">
                            <h3> Download Authorization Model</h3>
                            <div id="internalborder">                        
                                <p> Download files here </p>
                                <input type="Submit" name="send" id="send" value="Download"  class="btn btn-success">    
                            </div>
                            </br>
                        </div>
                        </br>
                        <label >Hit Refresh Page button below to clear values:</label><br />
                        <input type="button" name="clear" id="clear" value="Clear Data History" onclick="clearLocalStorage();" class="btn btn-success">
                    </div>
                </div>

              <div class="col-md-6 ">
                <ul class="nav nav-tabs">
                    <li><a data-toggle="tab" href="#step1" class="active">Authorized Roles</a></li>                
                    <li><a data-toggle="tab" href="#step2">Thing Domain</a></li>
                    <li><a data-toggle="tab" href="#step3">Context Type & Names</a></li>
                    <li><a data-toggle="tab" href="#step4">Context Domain</a></li>
                </ul>

                <div class="tab-content">
                   
                    <div id="step1" class="tab-pane fade show active">
                        <div class="form-card">
                            <div class="form-group">
                                <label >Authorized Roles</label>
                                <select class="form-control"  id="roles" name ="roles" >
                                    <option value="" selected disabled hidden>Choose Role</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label >Role Related Users </label>
                                <textarea name="roleusers" id="roleusers" rows="4" cols="70" placeholder="Users for authorization model" class="form-control" ></textarea>
                            </div>
                        </div>
                    </div>
                    <div id="step2" class="tab-pane fade">
                        <div class="form-card">                        
                            <div class="form-group">
                                <label >Entity Type </label>
                                <select class="form-control"  id="thingentitytypes" name ="thingentitytypes" class="form-control">
                                    <option value="" selected disabled hidden>Choose Entity Type</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label >Related Attributes</label>
                                <textarea name="thingattributes" id="thingattributes" rows="4" cols="70" placeholder="Attributes from thing data model" class="form-control" ></textarea>   
                            </div>
                        </div>
                    </div>
                    <div id="step3" class="tab-pane fade">
                        <div class="form-card">
                            <div class="form-group">
                                <label >Context Type </label>
                                <select class="form-control"  id="contexttype" name ="contexttype" class="form-control">
                                    <option value="" selected disabled hidden>Choose Context Type</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label >Related Context Names</label>
                                <textarea name="contextnames" id="contextnames" rows="4" cols="70" placeholder="Context names from instance data model" class="form-control" ></textarea>
                            </div>
                        </div>
                    </div>
                    <div id="step4" class="tab-pane fade">
                        <div class="form-card">
                            <div class="form-group">
                                <label >Entity  Type </label>
                                <select class="form-control" id="contextentitytypes" name ="contextentitytypes" >
                                    <option value="" selected disabled hidden>Choose Context Entity Type</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label >Related Attributes</label>
                                <textarea  name="contextattributes" id="contextattributes" rows="4" cols="70" placeholder="Attributes from instance data model" class="form-control" ></textarea>
                            </div>
                        </div>
                    </div>
                </div>
               



                <!-- <div class="form-card " >
                  <h4>Step 1: Authorized Roles </h4><hr />
                    <div class="form-group">
                      <label >Authorized Roles</label>
                      <select class="form-control"  id="roles" name ="roles" >
                        <option value="" selected disabled hidden>Choose Role</option>
                      </select>
                    </div>
                    <div class="form-group">
                        <label >Role Related Users </label>
                        <textarea name="roleusers" id="roleusers" rows="4" cols="70" placeholder="Users for authorization model" class="form-control" ></textarea>
                    </div>

                    <h4>Step 2: Thing Domain </h4><hr />
                    <div class="form-group">                    
                        <label >Entity Type </label>
                        <select class="form-control"  id="thingentitytypes" name ="thingentitytypes" class="form-control">
                            <option value="" selected disabled hidden>Choose Entity Type</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label >Related Attributes</label>
                        <textarea name="thingattributes" id="thingattributes" rows="4" cols="70" placeholder="Attributes from thing data model" class="form-control" ></textarea>   
                    </div>

                    <h4>Step 3: Context Type & Names </h4><hr />
                    <div class="form-group">                    
                        <label >Context Type </label>
                        <select class="form-control"  id="contexttype" name ="contexttype" class="form-control">
                            <option value="" selected disabled hidden>Choose Context Type</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label >Related Context Names</label>
                        <textarea name="contextnames" id="contextnames" rows="4" cols="70" placeholder="Context names from instance data model" class="form-control" ></textarea>
                    </div>

                    <h4>Step 4: Context Domain </h4><hr />
                    <div class="form-group">                    
                        <label >Entity  Type </label>
                        <select class="form-control" id="contextentitytypes" name ="contextentitytypes" >
                            <option value="" selected disabled hidden>Choose Context Entity Type</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label >Related Attributes</label>
                        <textarea  name="contextattributes" id="contextattributes" rows="4" cols="70" placeholder="Attributes from instance data model" class="form-control" ></textarea>
                    </div>
                </div> -->
                    <textarea name="inviRoles" id="inviRoles" style="visibility: hidden"></textarea>
                    <textarea name="inviThing" id="inviThing"  style="visibility: hidden"></textarea>
                    <textarea name="inviContextDetails" id="inviContextDetails" style="visibility: hidden"></textarea>
                    <textarea name="inviContext" id="inviContext" style="visibility: hidden"></textarea>
              </div>

              
            </div>
            </div>
         </form>
      </section><!-- End offering Section -->

<script type="text/javascript" language="javascript" >
    var varRoles;
    function getAuthDetailsFromLocalStorage(){
        document.getElementById('inviRoles').innerHTML = localStorage.getItem("rolesUsers");
        document.getElementById('inviThing').innerHTML = localStorage.getItem("thingEntityTypeAttributes");
        document.getElementById('inviContextDetails').innerHTML = localStorage.getItem("contextTypeNames");
        document.getElementById('inviContext').innerHTML = localStorage.getItem("contextEntityTypeAttributes");

        let roleUsersDetails_deserialized = JSON.parse(localStorage.getItem("rolesUsers"));
        var rolesIndex;
        for (rolesIndex = 0; rolesIndex < roleUsersDetails_deserialized.length; rolesIndex++) {
            var myselect=document.getElementById("roles");
        myselect.add(new Option(roleUsersDetails_deserialized[rolesIndex].role, rolesIndex), null);
        }
        
        myselect.onchange=function(){ 
            var chosenoption=this.options[this.selectedIndex]; //this refers to "selectmenu"
            if (chosenoption.value!="nothing"){
            document.getElementById("roleusers").innerHTML = roleUsersDetails_deserialized[this.selectedIndex-1].user;
            }          
        }

        let thingEntityTypeAttributes_deserialized = JSON.parse(localStorage.getItem("thingEntityTypeAttributes"));
        var thingentityTypeIndex;
        for(thingentityTypeIndex=0;thingentityTypeIndex<thingEntityTypeAttributes_deserialized.length;thingentityTypeIndex++){
        var myselect=document.getElementById("thingentitytypes");
        myselect.add(new Option(thingEntityTypeAttributes_deserialized[thingentityTypeIndex].entitytype, thingentityTypeIndex), null);
        }
        
        myselect.onchange=function(){ 
            var chosenoption=this.options[this.selectedIndex]; //this refers to "selectmenu"
            if (chosenoption.value!="nothing"){
            document.getElementById("thingattributes").innerHTML = thingEntityTypeAttributes_deserialized[this.selectedIndex-1].entityattributes;
            }          
        }

        let contextTypeNames_deserialized = JSON.parse(localStorage.getItem("contextTypeNames"));
        var contextTypeNamesIndex;
        for(contextTypeNamesIndex=0;contextTypeNamesIndex<contextTypeNames_deserialized.length;contextTypeNamesIndex++){
        var myselect=document.getElementById("contexttype");
        myselect.add(new Option(contextTypeNames_deserialized[contextTypeNamesIndex].contexttype, contextTypeNamesIndex), null);
        }
        
        myselect.onchange=function(){ 
            var chosenoption=this.options[this.selectedIndex]; //this refers to "selectmenu"
            if (chosenoption.value!="nothing"){
            document.getElementById("contextnames").innerHTML = contextTypeNames_deserialized[this.selectedIndex-1].contextnames;
            }          
        }
    

    let contextEntityTypeAttributes_deserialized = JSON.parse(localStorage.getItem("contextEntityTypeAttributes"));
        var contextEntityTypeAttributesIndex;
        for(contextEntityTypeAttributesIndex=0;contextEntityTypeAttributesIndex<contextEntityTypeAttributes_deserialized.length;contextEntityTypeAttributesIndex++){
        var myselect=document.getElementById("contextentitytypes");
        myselect.add(new Option(contextEntityTypeAttributes_deserialized[contextEntityTypeAttributesIndex].contextentitytype, contextEntityTypeAttributesIndex), null);
        }
        
        myselect.onchange=function(){ 
            var chosenoption=this.options[this.selectedIndex]; //this refers to "selectmenu"
            if (chosenoption.value!="nothing"){
            document.getElementById("contextattributes").innerHTML = contextEntityTypeAttributes_deserialized[this.selectedIndex-1].contextattributes;
            }          
        }
    }

    function clearLocalStorage(){
        localStorage.removeItem('rolesUsers');
        localStorage.removeItem('thingEntityTypeAttributes');
        localStorage.removeItem('contextTypeNames');
        localStorage.removeItem('contextEntityTypeAttributes');
        location.reload();
    }
</script>