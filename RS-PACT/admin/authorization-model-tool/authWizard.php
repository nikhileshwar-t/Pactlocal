<body onload="populateData();">

    <!-- ======= Offering Section ======= -->
    <section id="form-section" class="offering">
        <div class="container">

          <div class="section-title">
            <h2>Authorization Wizard</h2>
            <h4>Step 1: Roles & Authorizations</h4>  <hr />
            <div class="alert alert-primary" role="alert"></div>

            <nav aria-label="...">
              <ul class="pagination justify-content-end">
                <li class="page-item ">
                  <a class="page-link" href="<?php echo HTTP_SERVER?>admin/index.php?t=authorization-model-tool&p=authconfig-api">< Download Page</a>
                </li>                
                <li class="page-item">
                  <a class="page-link" href="<?php echo HTTP_SERVER?>admin/index.php?t=authorization-model-tool&p=thingWizard">Next ></a>
                </li>
              </ul>
            </nav>
            <div class="row">
              <div class="col-md-6 ">
                <div class="form-card " >
                  <h4>Create</h4>  <hr />
                                 
                  <form>
                    <div class="form-group">
                      <label for="exampleFormControlInput1">Roles</label>
                      <input type="text" class="form-control" id="addRoles" name ="addRoles" placeholder="Role name">
                    </div>
                    <div class="form-group">
                      <label for="exampleFormControlTextarea1">Users</label>
                      <textarea class="form-control" id="addUsers" name ="addUsers" rows="3"></textarea>
                    </div>
                    <button type="reset" name="addrolesuser" id="addrolesuser" class="btn btn-success" onclick="addNewRolesUsers(); location.reload();">Add Details</button>                 
                  </form>
                </div>
              </div>

              <div class="col-md-6 ">
                <div class="form-card " >
                  <h4>View & Update</h4>  <hr />  
                  <a href="#" class="loadUserData btn btn-primary"> Load Tenant Data >></a><br />            
                  <form>
                    <div class="form-group">
                      <label for="exampleFormControlInput1">Roles</label>
                      <select class="form-control"id="updateRoles" name ="updateRoles" >
                        <option value="" selected disabled hidden>Choose Existing Role</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="exampleFormControlTextarea1">Users</label>
                      <textarea class="form-control" id="updateUsers" name ="updateUsers" rows="3"></textarea>
                    </div>
                    
                    <button type="reset"  name="clearroleuserdata" id="clearroleuserdata" value="Clear Data History" class="btn btn-success" onclick="clearRoleData(); location.reload();">Clear Data History</button>           
                    <button type="reset"  name="updaterolesuser" id="updaterolesuser" value="Update Details" class="btn btn-success" onclick="updateRolesUsers(); location.reload();">Update Details</button>      
                  </form>
                </div>
              </div>            

            </div>
            <br />
            <nav aria-label="...">
                <ul class="pagination justify-content-end">
                  <li class="page-item ">
                    <a class="page-link" href="<?php echo HTTP_SERVER?>admin/index.php?t=authorization-model-tool&p=authconfig-api">< Download Page</a>
                  </li>                
                  <li class="page-item">
                    <a class="page-link" href="<?php echo HTTP_SERVER?>admin/index.php?t=authorization-model-tool&p=thingWizard">Next ></a>
                  </li>
                </ul>
              </nav>     
        </section><!-- End offering Section -->
</body>
    
<script type="text/javascript" language="javascript" >
$(".alert").hide(); 
var addNewRolesUsers = function (role, user) {
	// retrieve it (Or create a blank array if there isn't any info saved yet),
	var roleuser = JSON.parse(localStorage.getItem('rolesUsers')) || [];
	// add to it,
	var varGetRoles = document.getElementById("addRoles").value;
	var varGetUsers = document.getElementById("addUsers").value;

	roleuser.push({
		role: varGetRoles,
		user: varGetUsers
	});
	// then put it back.
	localStorage.setItem('rolesUsers', JSON.stringify(roleuser));
}

var updateRolesUsers = function (role, user) {
	// retrieve it (Or create a blank array if there isn't any info saved yet),
	var roleuser = JSON.parse(localStorage.getItem('rolesUsers'));
	// add to it,
	if (roleuser != "") {
		var varGetRoles = document.getElementById("updateRoles");
		var opt = varGetRoles.options[varGetRoles.selectedIndex];
		var varGetUsers = document.getElementById("updateUsers").value;
		var element = _.findWhere(roleuser, {
			role: opt.text
		});
		element.user = varGetUsers;
		localStorage.setItem('rolesUsers', JSON.stringify(roleuser));
	}
}


var populateData = function () {

	let roleUsersDetails_deserialized = JSON.parse(localStorage.getItem("rolesUsers"));
	var rolesIndex;
	if (roleUsersDetails_deserialized != ""); {
		for (rolesIndex = 0; rolesIndex < roleUsersDetails_deserialized.length; rolesIndex++) {
			var myselect = document.getElementById("updateRoles");
			myselect.add(new Option(roleUsersDetails_deserialized[rolesIndex].role, rolesIndex), null);
		}
		myselect.onchange = function () {
			var chosenoption = this.options[this.selectedIndex]; //this refers to "selectmenu"
			if (chosenoption.value != "nothing") {
				document.getElementById("updateUsers").innerHTML = roleUsersDetails_deserialized[this.selectedIndex - 1].user;
			}
		}
	}
}

var clearRoleData = function () {
	localStorage.removeItem('rolesUsers');
}


$(".loadUserData").on("click", function(){
    $.ajax({
        url: "<?php echo HTTP_SERVER ?>api/users.php?method=getTenantUsersAndRoles",                       
        type: 'POST',
        dataType: 'text',               
        contentType: 'application/x-www-form-urlencoded',          
        success: function (response) {
            response = JSON.parse(response);            
            if(response.status == "success"){
                localStorage.setItem('rolesUsers', JSON.stringify(response.data));
                location.reload(true);
            } else{
              $(".alert").addClass(" alert-danger");
              $(".alert").html(response.data );
              $(".alert").show()
            }
        }
    });
});


</script>