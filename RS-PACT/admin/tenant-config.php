<!-- ======= Offering Section ======= -->
<section id="offering" class="offering">   
    <div class="container">
        <div class="alert alert-primary" role="alert"></div>
        <table id="example" class="display table table-hover" style="width:100%">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Tenant id</th>
                    <th>Web Url</th>
                    <!-- <th>Web port</th> -->
                    <th>Created date</th>
                    <th>Status</th>
                    <th>Edit / Delete</th>                
                </tr>
            </thead>            
        </table>
    </div>
</section>
<!-- Modal -->
<div id="tenentConfigModel" class="modal fade " role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title">Tenant configuration </h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>                
            </div>

            <div class="modal-body">
            <form action="" method="post" id="add_form">
            <div class="alert alert-secondary " role="alert"></div>
            <input type="hidden" name="tenantconfig_id" value="0" id="tenantconfig_id">
            <input type="hidden" class="form-control" id="web_port" name="web_port" value="0" >
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group required ">
                            <label for="name" class="control-label">Tenant configuration Name </label>
                            <span class="icofont-question-circle" data-toggle="tooltip" data-original-title="Tenent configuration name helps you identify the Tenant configuration from the list."></span>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Tenant configuration Name" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group required ">
                            <label for="tenant_id" class="control-label">Tenant id</label>
                            <span class="icofont-question-circle" data-toggle="tooltip" data-original-title="Based on your project environment Tenant id would be 'projectds', 'projectfs' or simply project for production environment. "></span>
                            <input type="text" class="form-control" id="tenant_id" name="tenant_id" placeholder="Tenant id" required>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group required ">
                            <label for="web_url" class="control-label">Web url</label>
                            <input type="text" class="form-control" id="web_url" name="web_url" placeholder="Web url" required>
                            <small id="web_urlHelpBlock" class="form-text text-muted">
                                <b>Do not use Manage URL. </b> Tanant URL should begin with "https://". e.g. https://projectds.riversand.com 
                            </small>
                        </div>
                    </div>
                    <!-- <div class="col-md-6">
                        <div class="form-group">
                            <label for="web_port" class="control-label">Web Port</label>
                            <input type="number" class="form-control" id="web_port" name="web_port" value="0" placeholder="Web Port">
                        </div>
                    </div> -->
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group ">
                            <label for="api_user_id" class="control-label">API User ID</label>
                            <input type="text" class="form-control" id="api_user_id" name="api_user_id" placeholder="API User ID">
                        </div>
                   
                    </div>
                
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="api_user_role" class="control-label">API User Role</label>
                            <input type="text" class="form-control" id="api_user_role" name="api_user_role" placeholder="API User Role">
                        </div>
                   
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group required ">
                            <label for="client_id" class="control-label">Client id</label>
                            <input type="text" class="form-control" id="client_id" name="client_id" placeholder="Client id" required>
                        </div>
                   
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group required ">
                            <label for="client_secret" class="control-label">Client secret</label>
                            <input type="text" class="form-control" id="client_secret" name="client_secret" placeholder="Client secret" required>
                        </div>
                   
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="headers" class="control-label">Headers</label>
                            <textarea class="form-control" id="headers" name="headers" rows="3"></textarea>
                        </div>
                   
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary " onclick="testConnection()">Test connection</button>                
                <button id="submit" type="submit" class="btn btn-info">Save changes</button>
            </div>
        </form>
        </div>
    </div>
</div>

<!-- End offering Section -->
<script type="text/javascript" language="javascript" >
    function upsertConfig(){
        // Get the form.
        var form = $('#add_form');
        // Serialize the form data.
        var formData = $(form).serialize();
        $.ajax({
            url: "<?php echo HTTP_SERVER ?>/api/tenantconfig.php?method=upsertTenantConfigs",                       
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
                    $("#tenantconfig_id, #web_port").val(0);
                    $("#name, #tenant_id, #web_url, #client_id, #client_secret, #headers").val("");
                    setTimeout(function(){ location.reload(true); }, 1000);           
                }else{
                    $(".alert-secondary").addClass(" alert-danger");
                }                          
            }
        });
    }


    function testConnection(){
        // Get the form.
        var form = $('#add_form');
        // Serialize the form data.
        var formData = $(form).serialize();
        $.ajax({
            url: "<?php echo HTTP_SERVER ?>/api/tenantconfig.php?method=testConnection",                       
            type: 'POST',
            dataType: 'text',               
            contentType: 'application/x-www-form-urlencoded',
            data: formData, 
            success: function (response) {
                response = JSON.parse(response);                               
                $(".alert-secondary").html(response.data );
                $(".alert-secondary").show()
                $(".alert-secondary").removeClass(" alert-success");
                $(".alert-secondary").removeClass(" alert-danger");
                if(response.status == "success"){
                    $(".alert-secondary").addClass(" alert-success");          
                }else{
                    $(".alert-secondary").addClass(" alert-danger");
                }
                setTimeout(function(){ $(".alert-secondary").hide() }, 5000);                             
            }
        });

    }
        
    function deleteConfig(tenantconfig_id){
        $.ajax({
            url: "<?php echo HTTP_SERVER ?>/api/tenantconfig.php?method=deleteTenantConfigs",                       
            type: 'POST',
            dataType: 'text',               
            contentType: 'application/x-www-form-urlencoded',
            data: { "tenantconfig_id": tenantconfig_id }, 
            success: function (response) {
                response = JSON.parse(response);                               
                $(".alert").html(response.data );
                if(response.status == "success"){
                    $(".alert").addClass(" alert-success");            
                }else{
                    $(".alert").addClass(" alert-danger");
                }
                $(".alert").show(); 
                setTimeout(function(){ location.reload(true); }, 1000);            
            }
        });        
    }

    function getConfigById(tenantconfig_id){

        $.ajax({
            url: "<?php echo HTTP_SERVER ?>/api/tenantconfig.php?method=getTenantConfigById",                       
            type: 'POST',
            dataType: 'text',               
            contentType: 'application/x-www-form-urlencoded',
            data: { "tenantconfig_id": tenantconfig_id }, 
            success: function (response) {
                response = JSON.parse(response);                               
               
                if(response.status == "success"){
                    $("#name").val(response.data[0].name);
                    $("#tenant_id").val(response.data[0].tenant_id);
                    $("#web_url").val(response.data[0].web_url);
                    $("#web_port").val(response.data[0].web_port);
                    $("#headers").val(response.data[0].headers);
                    $("#client_id").val(response.data[0].client_id);
                    $("#client_secret").val(response.data[0].client_secret);
                    $("#api_user_id").val(response.data[0].api_user_id);
                    $("#api_user_role").val(response.data[0].api_user_role);                    
                }           
            }
        });   
    }

    function setStatus( tenantconfig_id, status ){
        $.ajax({
            url: "<?php echo HTTP_SERVER ?>/api/tenantconfig.php?method=setStatus",                       
            type: 'POST',
            dataType: 'text',               
            contentType: 'application/x-www-form-urlencoded',
            data: { "tenantconfig_id": tenantconfig_id , "status": status }, 
            success: function (response) {
                response = JSON.parse(response);
               
                if(response.status == "success"){
                    location.reload(true);                   
                }           
            }
        });

    }

    function editConfig(tenantconfig_id){
        getConfigById(tenantconfig_id);
        $("#tenantconfig_id").val(tenantconfig_id);
        $('#tenentConfigModel').modal('show');
    }

    $(document).ready(function() {
        // Set up an event listener for the contact form.
        $('#add_form').submit(function(event) {
            // Stop the browser from submitting the form.
            event.preventDefault();
            upsertConfig();
        });

       

        $(".alert").hide();
        var selected = [];
        var counter = 1;
        var table = $('#example').DataTable( {
            searching: false,
            lengthChange: false,
            processing: true,
             /*dom: 'Bfrtip',*/
            ajax: "<?php echo HTTP_SERVER ?>/api/tenantconfig.php?method=getTenantConfigs",
            columns: [
                { "data": "name" },
                { "data": "tenant_id" },
                { "data": "web_url" },
                // { "data": "web_port" },                
                { "data": "created_date" },
                {"mRender": function ( data, type, row ) {
                    var checked = (row.status == 1 )? "checked" : '';                    
                    return `<div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="customSwitches${row.tenantconfig_id}" ${checked} onclick="setStatus(${row.tenantconfig_id}, ${row.status})" >
                            <label class="custom-control-label" for="customSwitches${row.tenantconfig_id}"></label>
                            </div>`;                    
                    } 
                },                
                {"mRender": function ( data, type, row ) {
                        return '<a href="#" class="config_edit" onclick="editConfig('+row.tenantconfig_id+')">Edit</a> / <a href="#" class="config_remove"  onclick="deleteConfig('+row.tenantconfig_id+')">Delete</a>';}
                }                
            ],
            dom: 'l<"toolbar">frtip',
            initComplete: function(){
                $("div.toolbar")
                    .html('<button type="button" class="btn btn-info " data-toggle="modal" data-target="#tenentConfigModel">Add</button>');           
            }
        });
    });
</script>