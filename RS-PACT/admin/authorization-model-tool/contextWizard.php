<body onload="populateData();">


<!-- ======= Offering Section ======= -->
<section id="form-section" class="offering">
      <div class="container">

        <div class="section-title">
          <h2>Authorization Wizard</h2>
          <h4>Step 3: Context type and Names </h4>  <hr />
          <div class="alert alert-primary" role="alert"></div>
          <nav aria-label="...">
                <ul class="pagination justify-content-end">
                  
                  <li class="page-item"><a class="page-link" href="<?php echo HTTP_SERVER?>admin/index.php?t=authorization-model-tool&p=thingWizard">< Previous</a></li>                
                  <li class="page-item">
                    <a class="page-link" href="<?php echo HTTP_SERVER?>admin/index.php?t=authorization-model-tool&p=contextEntityWizard">Next ></a>
                  </li>
                </ul>
              </nav>
          <div class="row">

            <div class="col-md-6 ">
              <div class="form-card " >
                <h4>Create</h4>  <hr />               
                <form>
                  <div class="form-group">
                    <label for="exampleFormControlInput1">Context Type </label>
                    <input type="text" class="form-control" id="addContextType" name ="addContextType" placeholder="Context type">
                  </div>
                  <div class="form-group">
                    <label for="exampleFormControlTextarea1">Context Names</label>
                    <textarea class="form-control" id="addContextNames" name ="addContextNames" rows="3"></textarea>
                  </div>
                  <button type="reset" name="addcontextdetails" id="addcontextdetails"  class="btn btn-success" onclick="addNewContextDetails(); location.reload();">Add Details</button>                 
                </form>
              </div>
            </div>

            <div class="col-md-6 ">
              <div class="form-card " >
                <h4>View & Update</h4>  <hr />
                <a href="#" class="loadUserData btn btn-primary"> Load Tenant Data >></a><br />
                <form>
                  <div class="form-group">
                    <label for="exampleFormControlInput1">Context Type </label>
                    <select class="form-control"  id="updateContextType" name ="updateContextType" >
                      <option value="" selected disabled hidden>Choose Existing Context Type</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="exampleFormControlTextarea1">Context Names</label>
                    <textarea class="form-control" id="updateContextNames" name ="updateContextNames"  rows="3"></textarea>
                  </div>
                  
                  <button type="reset"   name="clearcontexttypedata" id="clearcontexttypedata"  class="btn btn-success" onclick="clearContextData(); location.reload();">Clear Data History</button>           
                  <button type="reset" name="updatecontextdetails" id="updatecontextdetails" class="btn btn-success" onclick="updateContextDetails(); location.reload();">Update Details</button>      
                </form>
              </div>
            </div>
          </div><br />

          <nav aria-label="...">
                <ul class="pagination justify-content-end">
                  
                  <li class="page-item"><a class="page-link" href="<?php echo HTTP_SERVER?>admin/index.php?t=authorization-model-tool&p=thingWizard">< Previous</a></li>                
                  <li class="page-item">
                    <a class="page-link" href="<?php echo HTTP_SERVER?>admin/index.php?t=authorization-model-tool&p=contextEntityWizard">Next ></a>
                  </li>
                </ul>
              </nav>        
    </section><!-- End offering Section -->
</body>
    
<script type="text/javascript" language="javascript" >
var addNewContextDetails = function (contexttype,contextnames) {
    // retrieve it (Or create a blank array if there isn't any info saved yet),
    var contexttypename = JSON.parse(localStorage.getItem('contextTypeNames')) || [];
    // add to it,
    varGetContextType = document.getElementById("addContextType").value;
    varGetContextNames = document.getElementById("addContextNames").value;
    contexttypename.push({contexttype: varGetContextType,contextnames: varGetContextNames});
    // then put it back.
    localStorage.setItem('contextTypeNames', JSON.stringify(contexttypename));
}

var updateContextDetails = function (contexttype,contextnames) {

    // retrieve it (Or create a blank array if there isn't any info saved yet),
    var contexttypename = JSON.parse(localStorage.getItem('contextTypeNames'));
    // add to it,
    if(contexttypename!=""){
    var varGetTypes = document.getElementById("updateContextType");
    var opt = varGetTypes.options[varGetTypes.selectedIndex];    
    var varGetNames = document.getElementById("updateContextNames").value;
    var element = _.findWhere(contexttypename, {contexttype:opt.text});
    element.contextnames = varGetNames;
    localStorage.setItem('contextTypeNames', JSON.stringify(contexttypename));
    }
}

var populateData = function(){

  let contextTypeNames_deserialized = JSON.parse(localStorage.getItem("contextTypeNames"));
  var contextTypeIndex;
  for(contextTypeIndex=0;contextTypeIndex<contextTypeNames_deserialized.length;contextTypeIndex++){
  var myselect=document.getElementById("updateContextType");
  myselect.add(new Option(contextTypeNames_deserialized[contextTypeIndex].contexttype, contextTypeIndex), null);
  }
  
  myselect.onchange=function(){ 
      var chosenoption=this.options[this.selectedIndex]; //this refers to "selectmenu"
      if (chosenoption.value!="nothing"){
      document.getElementById("updateContextNames").innerHTML = contextTypeNames_deserialized[this.selectedIndex-1].contextnames;
      }          
  }
}

var clearContextData = function() {
  localStorage.removeItem('contextTypeNames');
}
$(".alert").hide(); 
$(".loadUserData").on("click", function(){
    $.ajax({
        url: "<?php echo HTTP_SERVER ?>api/users.php?method=getContext", 
        type: 'POST',
        dataType: 'text',               
        contentType: 'application/x-www-form-urlencoded',          
        success: function (response) {
            response = JSON.parse(response); 
            if(response.status == "success"){
              let contextList
                localStorage.setItem('contextTypeNames', JSON.stringify(response.data.context));
                localStorage.setItem('contextList', JSON.stringify(response.data.contextList));
                location.reload(true);
            }else{
              $(".alert").addClass(" alert-danger");
              $(".alert").html(response.data );
              $(".alert").show()
            }           
        }
    });
});
</script>
