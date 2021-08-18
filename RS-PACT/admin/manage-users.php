<!-- ======= Offering Section ======= -->
<section id="offering" class="offering">
    <div class="container">

        <ul class="nav nav-tabs">
            <li><a data-toggle="tab" href="#manageuser" class="active">Manage users</a></li>                
            <li><a data-toggle="tab" href="#userlog">User Log</a></li>
        </ul>
        <div class="tab-content">
        <div id="manageuser" class="tab-pane fade show active">
            <div class="alert alert-primary" role="alert"></div>    
            <table id="userlist" class="display table table-hover" style="width:100%">
                <thead>
                    <tr>
                        <th></th>
                        <th>Name</th>
                        <th>Email</th>                    
                        <th>Is Partner</th>
                        <th>Partner Name</th>
                        <th>Last Login</th>                    
                        <th>Status</th>                   
                        <th>Permissions</th>                
                    </tr>
                </thead>            
            </table>
        </div>

        <div id="userlog" class="tab-pane fade ">
            <table id="userlistlog" class="display table table-hover" style="width:100%">
                <thead>
                    <tr>
                        <th></th>
                        <th>Name</th>
                        <th>Email</th>                    
                        <th>Events</th>
                        <th>Dates</th>                
                    </tr>
                </thead>            
            </table>            
        </div>
        </div>

    </div>    
</section>


<!-- Modal -->
<div id="userPermissionsModel" class="modal fade " role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">User Permissions </h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>                
            </div>
            <div class="alert alertpermissions alert-info" role="alert"></div>            
            <form action="" method="post" id="add_form">
            <input type="hidden" name="user_id" value="0" id="user_id">
            <div class="modal-body"  id="formBody"> 

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button id="submit" type="submit" class="btn btn-info">Save changes</button>
            </div>
        </form>
        </div>
    </div>
</div>

<!-- Modal -->
<div id="addUserModel" class="modal fade " role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">       

            <div class="modal-header">
                <h4 class="modal-title">User Add </h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>                
            </div>

            <div class="modal-body">
            <div class="alertuser alert-secondary alert" role="alert"></div>
                <form action="" method="post" id="add_user_form">
           
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group required">
                            <label for="name" class="control-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="User name" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group required">
                            <label for="email" class="control-label">Email</label>
                            <input type="text" class="form-control" id="email" name="email" placeholder="Email Address" required>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                    <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input"  id="status" name="status">
                        <label class="custom-control-label" for="status" >User Active </label>
                    </div>
                    </div> 
                </div>

                </hr>

                <div class="row">
                    <div class="col-md-12">
                    <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input"  id="is_partner" name="is_partner">
                        <label class="custom-control-label" for="is_partner" >Is Partner</label>
                    </div>
                    </div> 
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group required">
                            <label for="partner_name" class="control-label">Partner Name</label>
                            <input type="text" class="form-control" id="partner_name" name="partner_name" placeholder="Partner Name" required>
                        </div>
                    </div>
                </div> 

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button id="submit" type="submit" class="btn btn-info">Save changes</button>
            </div>
        </form>
        </div>
    </div>
</div>

<!-- End offering Section -->
<script type="text/javascript" language="javascript" >
    function savePermissions(){
        // Get the form.
        var form = $('#add_form');
        // Serialize the form data.
        var formData = $(form).serialize();
        $.ajax({
            url: "<?php echo HTTP_SERVER ?>/api/users.php?method=savePermissions",                       
            type: 'POST',
            dataType: 'text',               
            contentType: 'application/x-www-form-urlencoded',
            data: formData, 
            success: function (response) {
                response = JSON.parse(response);                               
                $(".alert-info").html(response.data );
                if(response.status == "success"){
                    $(".alert-info").addClass(" alert-success");            
                }else{
                    $(".alert-info").addClass(" alert-danger");
                }
                $(".alert-info").show();
                $("#user_id").val(0);
                $('#userPermissionsModel').modal('hide');
                $("#formBody").html("");
               
                setTimeout(function(){ location.reload(true); }, 1000);          
            }
        });
    }        

    function getUserPermissions(user_id, admin){
        $("#formBody").html("");

        var checked = (admin ==1 )? "checked" : "";
        $("#formBody").append(`
            <div class="row">
                <div class="col-md-12">
                <div class="custom-control custom-switch">
                    <input type="checkbox" class="custom-control-input" ${checked} id="adminuser" name="administrator">
                    <label class="custom-control-label" for="adminuser" >Administrator user </label>
                </div>
                </div> 
            </div> <hr/>`);

        $.ajax({
            url: "<?php echo HTTP_SERVER ?>/api/users.php?method=getUserPermissions",                       
            type: 'POST',
            dataType: 'text',               
            contentType: 'application/x-www-form-urlencoded',
            data: { "user_id": user_id }, 
            success: function (response) {
                response = JSON.parse(response);       
               
                if(response.status == "success"){                 

                    $.each(response.data, function(i, obj) {
                        var permission = (obj.permission == 1)? "checked" : "";
                        $("#formBody").append(`
                            <div class="row">
                                <div class="col-md-12">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" ${permission} id="${obj.code}" name="${obj.code}">
                                    <label class="custom-control-label" for="${obj.code}" >${obj.page}</label>
                                </div>
                                </div> 
                            </div> `);
                   
                    });
                }           
            }
        });   
    }

    function setStatus( user_id, status ){
        $.ajax({
            url: "<?php echo HTTP_SERVER ?>/api/users.php?method=setStatus",                       
            type: 'POST',
            dataType: 'text',               
            contentType: 'application/x-www-form-urlencoded',
            data: { "user_id": user_id , "status": status }, 
            success: function (response) {
                response = JSON.parse(response);
               
                if(response.status == "success"){
                    location.reload(true);                   
                }           
            }
        });
    }

    function editPermissions(user_id, is_admin){
        getUserPermissions(user_id, is_admin);
        $("#user_id").val(user_id);
        $('#userPermissionsModel').modal('show');
    }

    function addUser(){

        // Get the form.
        var form = $('#add_user_form');
        // Serialize the form data.
        var formData = $(form).serialize();
        $.ajax({
            url: "<?php echo HTTP_SERVER ?>/api/users.php?method=add",                       
            type: 'POST',
            dataType: 'text',               
            contentType: 'application/x-www-form-urlencoded',
            data: formData, 
            success: function (response) {
                response = JSON.parse(response);                               
                $(".alert-secondary").html(response.data );
                $(".alert-secondary").show()
                if(response.status == "success"){
                    $(".alert-secondary").addClass(" alert-success");
                    setTimeout(function(){ location.reload(true); }, 1000);             
                }else{
                    $(".alert-secondary").addClass(" alert-danger");
                }       
            }
        });

    }

    $(document).ready(function() {
        // Set up an event listener for the contact form.
        $('#add_form').submit(function(event) {
            // Stop the browser from submitting the form.
            event.preventDefault();
            savePermissions();
        });    

        $('#add_user_form').submit(function(event) {
            // Stop the browser from submitting the form.
            event.preventDefault();
            addUser();
        });      

        $(".alert").hide();
        var selected = [];
        var counter = 1;
        var table = $('#userlist').DataTable( {
            searching: true,
            lengthChange: false,
            processing: true,
             /*dom: 'Bfrtip',*/
            ajax: "<?php echo HTTP_SERVER ?>/api/users.php?method=getUsers",
            columns: [
                {"mRender": function ( data, type, row ) {
                    return  (row.is_online == 1 )? '<span class="indicator online"></span>' : '<span class="indicator offline"></span>';     
                    } 
                },
                { "data": "name" },
                { "data": "email" },
                {"mRender": function ( data, type, row ) {
                    return (row.is_partner == 1 )? "Yes" : 'No';
                    }
                },
                { "data": "partner_name" }, 
                { "data": "last_login" },               
                {"mRender": function ( data, type, row ) {
                    var checked = (row.status == 1 )? "checked" : '';                    
                    return `<div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="customSwitches${row.user_id}" ${checked} onclick="setStatus(${row.user_id}, ${row.status})" >
                            <label class="custom-control-label" for="customSwitches${row.user_id}"></label>
                            </div>`;
                    } 
                },                
                {"mRender": function ( data, type, row ) {
                        return '<a href="#" class="permissions_edit" onclick="editPermissions('+row.user_id+', '+row.is_admin+')">Edit Permissions</a> ';}
                },               
            ],dom: 'l<"toolbar">frtip',
                initComplete: function(){
                $("div.toolbar")
                    .html('<button type="button" class="btn btn-info dtbtn" data-toggle="modal" data-target="#addUserModel">Add</button>');           
                }   
        });

        $('#userlistlog').DataTable( {
            searching: true,
            lengthChange: false,
            processing: true,
             /*dom: 'Bfrtip',*/
            ajax: "<?php echo HTTP_SERVER ?>/api/users.php?method=getUserLog",
            columns: [
                {"mRender": function ( data, type, row ) {
                    return  (row.is_online == 1 )? '<span class="indicator online"></span>' : '<span class="indicator offline"></span>';     
                    } 
                },
                { "data": "name" },
                { "data": "email" },                
                { "data": "event" }, 
                { "data": "log_date" }                               
            ],
                  
        });
    });
</script>
