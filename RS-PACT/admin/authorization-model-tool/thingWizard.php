<body onload="populateData();">

  <!-- ======= Offering Section ======= -->
  <section id="form-section" class="offering">
      <div class="container">

        <div class="section-title">
          <h2>Authorization Wizard</h2>
          <h4>Step 2: Thing Domain </h4>  <hr />
          <div class="alert alert-primary" role="alert"></div>
          <nav aria-label="...">
                <ul class="pagination justify-content-end">                 
                  <li class="page-item"><a class="page-link" href="<?php echo HTTP_SERVER?>admin/index.php?t=authorization-model-tool&p=authWizard">< Previous</a></li>                
                  <li class="page-item">
                    <a class="page-link" href="<?php echo HTTP_SERVER?>admin/index.php?t=authorization-model-tool&p=contextWizard">Next ></a>
                  </li>
                </ul>
              </nav>
          <div class="row">

            <div class="col-md-6 ">
              <div class="form-card " >
                <h4>Create</h4>  <hr />               
                <form>
                  <div class="form-group">
                    <label for="exampleFormControlInput1">Entity Type </label>
                    <input type="text" class="form-control"  id="addThingEntityTypes" name ="addThingEntityTypes" placeholder="Entity type">
                  </div>
                  <div class="form-group">
                    <label for="exampleFormControlTextarea1">Entity Attributes (Add short names on new lines for the attributes.)</label>
                    <textarea class="form-control" id="addThingEntityAttributes" name ="addThingEntityAttributes" rows="3"></textarea>
                  </div>
                  <button type="reset" name="addthingentitytypeattrs" id="addthingentitytypeattrs" class="btn btn-success" onclick="addNewThingDetails(); location.reload();">Add Details</button>                 
                </form>
              </div>
            </div>

            <div class="col-md-6 ">
              <div class="form-card " >
                <h4>View & Update</h4>  <hr />
                <a href="#" class="loadUserData btn btn-primary"> Load Tenant Data >></a><br />               
                <form>
                  <div class="form-group">
                    <label for="exampleFormControlInput1">Entity Type </label>
                    <select class="form-control" id="updateThingEntityTypes" name ="updateThingEntityTypes" >
                      <option value="" selected disabled hidden>Choose Existing Entity Type</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="exampleFormControlTextarea1">Entity Attributes</label>
                    <textarea class="form-control" id="updateThingEntityAttributes" name ="updateThingEntityAttributes"  rows="3"></textarea>
                  </div>
                  
                  <button type="reset"  name="clearthingentitydata" id="clearthingentitydata" class="btn btn-success" onclick="clearThingData(); location.reload();">Clear Data History</button>           
                  <button type="reset"   name="updatethingentitytypeattrs" id="updatethingentitytypeattrs" class="btn btn-success" onclick="updateThingDetails(); location.reload();">Update Details</button>      
                </form>
              </div>
            </div>
          </div>
          <br />
          <nav aria-label="...">
                <ul class="pagination justify-content-end">                 
                  <li class="page-item"><a class="page-link" href="<?php echo HTTP_SERVER?>admin/index.php?t=authorization-model-tool&p=authWizard">< Previous</a></li>                
                  <li class="page-item">
                    <a class="page-link" href="<?php echo HTTP_SERVER?>admin/index.php?t=authorization-model-tool&p=contextWizard">Next ></a>
                  </li>
                </ul>
              </nav>        
    </section><!-- End offering Section -->
    
</body>
    
<script type="text/javascript" language="javascript" >
$(".alert").hide(); 
var addNewThingDetails = function (entitytype,entityattributes) {
    // retrieve it (Or create a blank array if there isn't any info saved yet),
    var thingentitytypeattrs = JSON.parse(localStorage.getItem('thingEntityTypeAttributes')) || [];
    // add to it,
    varGetEntityTypes = document.getElementById("addThingEntityTypes").value;
    varGetEntityAttibutes = document.getElementById("addThingEntityAttributes").value;
    thingentitytypeattrs.push({entitytype: varGetEntityTypes,entityattributes: varGetEntityAttibutes});
    // then put it back.
    localStorage.setItem('thingEntityTypeAttributes', JSON.stringify(thingentitytypeattrs));
}

var updateThingDetails = function (entitytype,entityattributes) {

    // retrieve it (Or create a blank array if there isn't any info saved yet),
    var thingentitytypeattrs = JSON.parse(localStorage.getItem('thingEntityTypeAttributes'));
    // add to it,
    if(thingentitytypeattrs!=""){
    var varGetTypes = document.getElementById("updateThingEntityTypes");
    var opt = varGetTypes.options[varGetTypes.selectedIndex];    
    var varGetAttrs = document.getElementById("updateThingEntityAttributes").value;
    var element = _.findWhere(thingentitytypeattrs, {entitytype:opt.text});
    element.entityattributes = varGetAttrs;
    localStorage.setItem('thingEntityTypeAttributes', JSON.stringify(thingentitytypeattrs));
    }
}

var populateData = function(){
  
  let thingEntityTypeAttributes_deserialized = JSON.parse(localStorage.getItem("thingEntityTypeAttributes"));
  var thingentityTypeIndex;
  for(thingentityTypeIndex=0;thingentityTypeIndex<thingEntityTypeAttributes_deserialized.length;thingentityTypeIndex++){
  var myselect=document.getElementById("updateThingEntityTypes");
  myselect.add(new Option(thingEntityTypeAttributes_deserialized[thingentityTypeIndex].entitytype, thingentityTypeIndex), null);
  }
  
  myselect.onchange=function(){ 
      var chosenoption=this.options[this.selectedIndex]; //this refers to "selectmenu"
      if (chosenoption.value!="nothing"){
      document.getElementById("updateThingEntityAttributes").innerHTML = thingEntityTypeAttributes_deserialized[this.selectedIndex-1].entityattributes;
      }          
  }
}

var clearThingData = function() {
  localStorage.removeItem('thingEntityTypeAttributes');
}

$(".loadUserData").on("click", function(){
    $.ajax({
        url: "<?php echo HTTP_SERVER ?>api/users.php?method=getthingEntityTypeAttributes", 
        type: 'POST',
        dataType: 'text',               
        contentType: 'application/x-www-form-urlencoded',          
        success: function (response) {
            response = JSON.parse(response);            
            if(response.status == "success"){
                localStorage.setItem('thingEntityTypeAttributes', JSON.stringify(response.data));
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
