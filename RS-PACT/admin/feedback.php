<section id="offering" class="offering">
   <div class="container">
      <div class="section-title">
         <h2>Feedback</h2>
      </div>
      <div class="row">
         <div class="col-md-6 ac">
            <div id="mail-status"></div>
			
            <form id="frmEnquiry" action="" method="post" enctype='multipart/form-data'>
               <div class="form-group">
                  
                  <select class="form-control" id="appselect" name="appselect" required>
                     <option value="">Select an App</option>
                     <option value="Authorization Model Tool" >Authorization Model Tool</option>
                     <option value="UI Configuration Tool" >UI Configuration Tool</option>
                     <option value="RBL Web version" >RBL Web version </option>
                     <option value="RBL Desktop Version" >RBL Desktop Version</option>
                     <option value="WorkFlow App Model" >WorkFlow App Model</option>
                     <option value="Graph Process Tool" >Graph Process Tool</option>
                     <option value="Pact Website" >Pact Website</option>
                     <option value="Other" >Other</option>
                  </select>
               </div>
               <div class="form-group">
                  
                  <textarea class="form-control" name="content" id="content" cols="60" rows="6" placeholder="Message" required ></textarea>
               </div>
               <div class="form-group">
                  <label for="attachment">Attachment: </label>
                  <input type="file" name="attachment[]" class="demoInputBox" id="attachment" multiple="multiple">
               </div>
               <div class="form-group ">
			   	<button type="submit" class="btn btn-primary float-right">Send</button>
               </div>
            </form>
            <div id="loader-icon" style="display: none;">
               <img src="<?php echo HTTP_SERVER?>assets/images/LoaderIcon.gif" />
            </div>
         </div>
      </div>
   </div>
</section>

		 
<script type="text/javascript">
$(document).ready(function (e){
	$("#frmEnquiry").on('submit',(function(e){
		e.preventDefault();
		$('#loader-icon').show();	
		$.ajax({
			url: "<?php echo HTTP_SERVER ?>api/feedback-mail-send.php",
			type: "POST",
			data:  new FormData(this),
			contentType: false,
			cache: false,
			processData:false,
		success: function(data){
			$("#mail-status").html(data);
			$('#loader-icon').hide();
		},
		error: function(){} 
		});
	}));
});

</script>