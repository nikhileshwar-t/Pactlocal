<body onload="populateData();">

    <!-- ======= Offering Section ======= -->
    <section id="form-section" class="offering">
        <div class="container">

          <div class="section-title">
            <h2>Authorization Wizard</h2>
            <h4>Step 4: Context Domain</h4>  <hr />
            <nav aria-label="...">
                <ul class="pagination justify-content-end">
                 
                  <li class="page-item"><a class="page-link" href="<?php echo HTTP_SERVER?>admin/index.php?t=authorization-model-tool&p=contextWizard">< Previous</a></li>                
                  <li class="page-item">
                    <a class="page-link" href="<?php echo HTTP_SERVER?>admin/index.php?t=authorization-model-tool&p=authconfig-api">Next ></a>
                  </li>
                </ul>
              </nav>
            <div class="row">

              <div class="col-md-6 ">
                <div class="form-card " >
                  <h4>Create</h4>  <hr />               
                  <form>
                    <!-- <div class="form-group">
                      <label for="exampleFormControlInput1">Select Context </label>
                      <select class="form-control" id="updateContextEntityTypes" name ="updateContextEntityTypes">
                        <option value="" selected disabled hidden>Choose Existing Entity Type</option>
                      </select>
                    </div> -->
                    <div class="form-group">
                      <label for="exampleFormControlInput1">Context Entity Type</label>
                      <input type="text" class="form-control" id="addContextEntityTypes" name ="addContextEntityTypes" placeholder="Context entity type">
                    </div>
                    <div class="form-group">
                      <label for="exampleFormControlTextarea1">Context Entity Attributes</label>
                      <textarea class="form-control"  id="addContextEntityAttributes" name ="addContextEntityAttributes" rows="3"></textarea>
                    </div>
                    <button type="reset" name="addcontextentitytypeattrs" id="addcontextentitytypeattrs" class="btn btn-success" onclick="addNewContextEntityDetails(); location.reload();">Add Details</button>                 
                  </form>
                </div>
              </div>

              <div class="col-md-6 ">
                <div class="form-card " >
                  <h4>View & Update</h4>  <hr />
                  <!-- <a href="#" class="loadUserData btn btn-primary"> Load Tenant Data >></a><br />                -->
                  <form>
                    <div class="form-group">
                      <label for="exampleFormControlInput1">Context Entity Type </label>
                      <select class="form-control" id="updateContextEntityTypes" name ="updateContextEntityTypes">
                        <option value="" selected disabled hidden>Choose Existing Entity Type</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="exampleFormControlTextarea1">Context Entity Attributes</label>
                      <textarea class="form-control" id="updateContextEntityAttributes" name ="updateContextEntityAttributes" rows="3"></textarea>
                    </div>
                    
                    <button type="reset" name="clearcontextattrdata" id="clearcontextattrdata" value="Clear Data History" class="btn btn-success" onclick="clearInstanceData(); location.reload();">Clear Data History</button>           
                    <button type="reset" name="updatecontextentitytypeattrs" id="updatecontextentitytypeattrs" value="Update Details" class="btn btn-success" onclick="updateContextEntityDetails(); location.reload();">Update Details</button>      
                  </form>
                </div>
              </div>
            </div>
            <br />
            <nav aria-label="...">
              <ul class="pagination justify-content-end">                  
                <li class="page-item"><a class="page-link" href="<?php echo HTTP_SERVER?>admin/index.php?t=authorization-model-tool&p=contextWizard">< Previous</a></li>                
                <li class="page-item">
                  <a class="page-link" href="<?php echo HTTP_SERVER?>admin/index.php?t=authorization-model-tool&p=authconfig-api">Next ></a>
                </li>
              </ul>
            </nav>
      </section><!-- End offering Section -->
</body>
    
<script type="text/javascript" language="javascript" >

// if(localStorage.getItem('contextEntityTypeAttributes') ==  undefined ){
//     var thingEntity = JSON.parse(localStorage.getItem('thingEntityTypeAttributes')) || [];
//     var contextAttribute = [];
//     jQuery.each( thingEntity, function( i, contextVal ) {
//       contextAttribute.push({contextentitytype: contextVal.entitytype,contextattributes: contextVal.entityattributes});
//     });
//     localStorage.setItem('contextEntityTypeAttributes', JSON.stringify(contextAttribute));
// }

var addNewContextEntityDetails = function (contextentitytype,contextattributes) {
    // retrieve it (Or create a blank array if there isn't any info saved yet),
    var contextentitytypeattrs = JSON.parse(localStorage.getItem('contextEntityTypeAttributes')) || [];
    // add to it,
    varGetContextEntityType = document.getElementById("addContextEntityTypes").value;
    varGetContextAttributes = document.getElementById("addContextEntityAttributes").value;
    contextentitytypeattrs.push({contextentitytype: varGetContextEntityType,contextattributes: varGetContextAttributes});
    // then put it back.
    localStorage.setItem('contextEntityTypeAttributes', JSON.stringify(contextentitytypeattrs));    
}

var updateContextEntityDetails = function (contextentitytype,contextattributes) {
    // retrieve it (Or create a blank array if there isn't any info saved yet),
    var contextentitytypeattrs = JSON.parse(localStorage.getItem('contextEntityTypeAttributes'));
    // add to it,
    if(contextentitytypeattrs!=""){
    var varGetTypes = document.getElementById("updateContextEntityTypes");
    var opt = varGetTypes.options[varGetTypes.selectedIndex];
    var varGetContextAttributes = document.getElementById("updateContextEntityAttributes").value;
    var element = _.findWhere(contextentitytypeattrs, {contextentitytype:opt.text});
    element.contextattributes = varGetContextAttributes;
    // then put it back.
    localStorage.setItem('contextEntityTypeAttributes', JSON.stringify(contextentitytypeattrs));
    }    
}

var populateData = function(){
  
  let contextEntityTypeAttributes_deserialized = JSON.parse(localStorage.getItem("contextEntityTypeAttributes"));
  var contextEntityTypeIndex;
  
  for(contextEntityTypeIndex=0;contextEntityTypeIndex<contextEntityTypeAttributes_deserialized.length;contextEntityTypeIndex++){
    var myselect=document.getElementById("updateContextEntityTypes");
    myselect.add(new Option(contextEntityTypeAttributes_deserialized[contextEntityTypeIndex].contextentitytype, contextEntityTypeIndex), null);
  }
  
  myselect.onchange=function(){ 
      var chosenoption=this.options[this.selectedIndex]; //this refers to "selectmenu"
      if (chosenoption.value!="nothing"){
      document.getElementById("updateContextEntityAttributes").innerHTML = contextEntityTypeAttributes_deserialized[this.selectedIndex-1].contextattributes;
      }          
  }            
} 

var clearInstanceData = function(){
  localStorage.removeItem('contextEntityTypeAttributes');
}

</script>
