<?php
	$table='signatory_list';
	$error="";

	if(isset($_GET['msg'])){
		if($_GET['msg']=="sent"){
			$error='<!--begin::Alert-->
				<div class="alert alert-info d-flex align-items-center p-5">
				    <!--begin::Icon-->
				    <i class="ki-duotone ki-shield-tick fs-2hx text-info me-4"><span class="path1"></span><span class="path2"></span></i>
				    <!--end::Icon-->

				    <!--begin::Wrapper-->
				    <div class="d-flex flex-column">
				        <!--begin::Title-->
				        <h4 class="mb-1 text-info">Success</h4>
				        <!--end::Title-->

				        <!--begin::Content-->
				        <span>Mail has been send</span>
				        <!--end::Content-->
				    </div>
				    <!--end::Wrapper-->
				</div>
				<!--end::Alert-->';
		}
	}

	if(isset($_GET['approve'])){
		extract($_GET);

		$sql = "SELECT * FROM signatory WHERE signatory_list_id='$user_id' AND student_id='$approve'";
		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
		  // output data of each row
		  while($row = $result->fetch_assoc()) {

		  	$error='<!--begin::Alert-->
				<div class="alert alert-warning d-flex align-items-center p-5">
				    <!--begin::Icon-->
				    <i class="ki-duotone ki-shield-tick fs-2hx text-warning me-4"><span class="path1"></span><span class="path2"></span></i>
				    <!--end::Icon-->

				    <!--begin::Wrapper-->
				    <div class="d-flex flex-column">
				        <!--begin::Title-->
				        <h4 class="mb-1 text-warning">Approval</h4>
				        <!--end::Title-->

				        <!--begin::Content-->
				        <span>Signatory has been approved already</span>
				        <!--end::Content-->
				    </div>
				    <!--end::Wrapper-->
				</div>
				<!--end::Alert-->';
		    	
		  }
		} else {
		  	$sql = "INSERT INTO signatory SET signatory_list_id='$user_id', student_id='$approve', date_created=NOW(), status='approve'";

	        if ($conn->query($sql) === TRUE) {
	             $last_id = $conn->insert_id;



	            $error='<!--begin::Alert-->
				<div class="alert alert-success d-flex align-items-center p-5">
				    <!--begin::Icon-->
				    <i class="ki-duotone ki-shield-tick fs-2hx text-success me-4"><span class="path1"></span><span class="path2"></span></i>
				    <!--end::Icon-->

				    <!--begin::Wrapper-->
				    <div class="d-flex flex-column">
				        <!--begin::Title-->
				        <h4 class="mb-1 text-success">Success</h4>
				        <!--end::Title-->

				        <!--begin::Content-->
				        <span>Signatory has been approved</span>
				        <!--end::Content-->
				    </div>
				    <!--end::Wrapper-->
				</div>
				<!--end::Alert-->';
	        } else {
	          echo "Error: " . $sql . "<br>" . $conn->error;
	        }
		}

		
	}

?>

<div class="container">
	<?php echo$error?>
    <h1>Approved</h1>
	<table id="kt_datatable_dom_positioning" class="table table-striped table-row-bordered gy-5 gs-7 border rounded">
	    <thead>
	        <tr class="fw-bold fs-6 text-gray-800 px-7">
	            <th>Name</th>
	            <th>Program</th>
	            <th>Status</th>
	            <th>Action</th>
	        </tr>
	    </thead>
	    <tbody>
	    	<?php
	    		$sql = "SELECT t.*,
	    		(SELECT name FROM courses WHERE id=t.courses_id LIMIT 1) AS name,
	    		(SELECT year_level FROM courses WHERE id=t.courses_id LIMIT 1) AS year_level,
	    		(SELECT section FROM courses WHERE id=t.courses_id LIMIT 1) AS section
	    		 FROM $table t WHERE offices_id='$user_id'";
				$result = $conn->query($sql);

				if ($result->num_rows > 0) {
				  // output data of each row
				  while($row = $result->fetch_assoc()) {
				  	extract($row);

				  	$sql1 = "SELECT * FROM student WHERE courses='$name' AND year_level='$year_level' AND section='$section'";
					$result1 = $conn->query($sql1);

					if ($result1->num_rows > 0) {
					  // output data of each row
					  while($row1 = $result1->fetch_assoc()) {
					  	extract($row1);

					  	$sql2 = "SELECT * FROM signatory WHERE signatory_list_id='$user_id' AND student_id='$id'";
						$result2 = $conn->query($sql2);

						if ($result2->num_rows > 0) {
						  	$status='Approved';
						}else{
							$status='Pending';
						}
					  	?>
					  	<tr>
					  		<td><?php echo$firstname?> <?php echo$lastname?></td>
					  		<td><?php echo$name?> <?php echo$year_level?><?php echo$section?></td>
					  		<td><?php echo$status?></td>
					  		<td>
					  			<a class="btn btn-light-success btn-sm" href="?page=<?php echo$page?>&approve=<?php echo$id?>">Approve</a>
					  			<a class="btn btn-light-info btn-sm" onclick="mails('<?php echo$email?>');"  data-bs-toggle="modal" data-bs-target="#kt_modal_2"><i class="bi bi-send"></i> Mail</a>
					  		</td>
					  	</tr>
					  	<?php
					  	
					    
					  }
					}
				    
				  }
				}
	    	?>
	    </tbody>
	</table>
</div>

<script type="text/javascript">
	function table(){
		$("#kt_datatable_dom_positioning").DataTable({
			"language": {
				"lengthMenu": "Show _MENU_",
			},
			"dom":
				"<'row mb-2'" +
				"<'col-sm-6 d-flex align-items-center justify-conten-start dt-toolbar'l>" +
				"<'col-sm-6 d-flex align-items-center justify-content-end dt-toolbar'f>" +
				">" +

				"<'table-responsive'tr>" +

				"<'row'" +
				"<'col-sm-12 col-md-5 d-flex align-items-center justify-content-center justify-content-md-start'i>" +
				"<'col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-end'p>" +
				">"
		});
	}
	

	 setTimeout(function() {
	 	table();
	 }, 1000);
	 function mails(email){
	 	document.sendmail.email.value=email;
	 }
</script>

<div class="modal fade" tabindex="-1" id="kt_modal_2">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Mailing</h3>

                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                </div>
                <!--end::Close-->
            </div>

            <form method="GET" action="../send-mail.php" name="sendmail">
            	<div class="modal-body">
            		<input type="hidden" name="email">
            		<input type="hidden" name="offices" value="<?php echo$user_name?>">
            		<textarea class="form-control" placeholder="Please type here" name="msg" required></textarea>
	            </div>
	            <div class="modal-footer">
	                <button type="button" class="btn btn-light btn-sm" data-bs-dismiss="modal">Close</button>
	                <button type="submit" class="btn btn-info btn-sm" name="send"><i class="bi bi-send"></i>Send</button>
	            </div>
            </form>
        </div>
    </div>
</div>