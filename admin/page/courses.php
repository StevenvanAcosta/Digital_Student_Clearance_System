<div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
	<!--begin::Toolbar container-->
	<div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
		<!--begin::Page title-->
		<div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
			<!--begin::Title-->
			<h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">Manage</h1>
			<!--end::Title-->
			<!--begin::Breadcrumb-->
			<ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
				<!--begin::Item-->
				<li class="breadcrumb-item text-muted"><?php echo ucfirst(str_replace(' ', '_', $page)) ;?></li>
				<!--end::Item-->
			</ul>
			<!--end::Breadcrumb-->
		</div>
		<!--end::Page title-->
		<!--begin::Actions-->
		<div class="d-flex align-items-center gap-2 gap-lg-3">

			<!--begin::Primary button-->
			<a href="#" class="btn btn-sm fw-bold btn-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_1">Add Data</a>
			<!--end::Primary button-->
		</div>
		<!--end::Actions-->
	</div>
	<!--end::Toolbar container-->
</div>
<?php
$table="courses";
$error="";

	if(isset($_POST['add'])){
		extract($_POST);
        $data="";

        $base_section=count($section);

        foreach ($_POST as $k => $v){

            if(empty($data)){
                $data .= " $k='$v' ";
            }else{
                if($k=="add"){
                    $data .= "";
                }else if($k=="section"){
                    $data .= "";
                }else{
                    $data .= ", $k='$v' ";
                }
                
            }
        }

        

        

        $data.=", date_time=NOW()";
        $sql1="SELECT * FROM student;";


        for ($i=0; $i < $base_section; $i++) { 

        	//$section[$i];

        	$sql = "SELECT * FROM $table  WHERE name='$name' AND year_level='$year_level' AND section='$section[$i]';";
				$result = $conn->query($sql);

				if ($result->num_rows > 0) {
				  // output data of each row
				 
				} else {
		        	if($i==0){
						$sql1 = "INSERT INTO $table SET $data, section='$section[$i]'; ";
		        	}else{
		        		$sql1 .= "INSERT INTO $table SET $data, section='$section[$i]'; ";
		        	}
		        }
        }


        

        if ($conn->multi_query($sql1) === TRUE) {
             $last_id = $conn->insert_id;

            ?>
            	<script type="text/javascript">
            		// alert("Successfully added");
            		location.href="?page=<?php echo$page?>";
            	</script>
            <?php

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
			        <span>New data has been recorded</span>
			        <!--end::Content-->
			    </div>
			    <!--end::Wrapper-->
			</div>
			<!--end::Alert-->';
        } else {
          echo "Error: " . $sql . "<br>" . $conn->error;
        }


	}

	if(isset($_POST['update'])){
		extract($_POST);
        $data="";

        foreach ($_POST as $k => $v){

            if(empty($data)){
                $data .= " $k='$v' ";
            }else{
                if($k=="update"){
                    $data .= "";
                }else{
                    $data .= ", $k='$v' ";
                }
                
            }
        }

        

        $data;

        // $data.=", date_time=NOW()";


        $sql = "UPDATE $table SET $data WHERE id='$id'";

        if ($conn->query($sql) === TRUE) {
             $last_id = $conn->insert_id;



            $error='<!--begin::Alert-->
			<div class="alert alert-info d-flex align-items-center p-5">
			    <!--begin::Icon-->
			    <i class="ki-duotone ki-shield-tick fs-2hx text-info me-4"><span class="path1"></span><span class="path2"></span></i>
			    <!--end::Icon-->

			    <!--begin::Wrapper-->
			    <div class="d-flex flex-column">
			        <!--begin::Title-->
			        <h4 class="mb-1 text-info">Update Complete</h4>
			        <!--end::Title-->

			        <!--begin::Content-->
			        <span>Data has been updated</span>
			        <!--end::Content-->
			    </div>
			    <!--end::Wrapper-->
			</div>
			<!--end::Alert-->';
        } else {
          echo "Error: " . $sql . "<br>" . $conn->error;
        }
	}


	if(isset($_POST['delete'])){
		extract($_POST);
        $data="";

        foreach ($_POST as $k => $v){

            if(empty($data)){
                $data .= " $k='$v' ";
            }else{
                if($k=="delete"){
                    $data .= "";
                }else{
                    $data .= ", $k='$v' ";
                }
                
            }
        }

        

        $data;

        // $data.=", date_time=NOW()";


        $sql = "DELETE FROM $table WHERE id='$id'";

        if ($conn->query($sql) === TRUE) {
             $last_id = $conn->insert_id;



            $error='<!--begin::Alert-->
			<div class="alert alert-danger d-flex align-items-center p-5">
			    <!--begin::Icon-->
			    <i class="ki-duotone ki-shield-tick fs-2hx text-danger me-4"><span class="path1"></span><span class="path2"></span></i>
			    <!--end::Icon-->

			    <!--begin::Wrapper-->
			    <div class="d-flex flex-column">
			        <!--begin::Title-->
			        <h4 class="mb-1 text-danger">Delete Complete</h4>
			        <!--end::Title-->

			        <!--begin::Content-->
			        <span>Data has been delete successfully</span>
			        <!--end::Content-->
			    </div>
			    <!--end::Wrapper-->
			</div>
			<!--end::Alert-->';
        } else {
          echo "Error: " . $sql . "<br>" . $conn->error;
        }
	}


?>

<div class="container">
	<?php echo$error?>
	<table id="kt_datatable_dom_positioning" class="table table-striped table-row-bordered gy-5 gs-7 border rounded">
	    <thead>
	        <tr class="fw-bold fs-6 text-gray-800 px-7">
	            <th>Program</th>
	            <th>Description</th>
	            <th>Action</th>
	        </tr>
	    </thead>
	    <tbody>
	    	<?php
	    		$sql = "SELECT * FROM $table";
				$result = $conn->query($sql);

				if ($result->num_rows > 0) {
				  // output data of each row
				  while($row = $result->fetch_assoc()) {
				  	extract($row);
				    ?>
				 	<tr>
				 		<td><?php echo$name?> <?php echo$year_level?><?php echo$section?></td>
				 		<td><?php echo$description?></td>
				 		<td>
				 			<a class="btn btn-light-danger btn-sm" data-bs-toggle="modal" data-bs-target="#kt_modal_3" onclick="deleting('<?php echo$id?>','<?php echo$name?>','<?php echo$description?>');"><i class="bi bi-trash"></i></a>
				 			<a class="btn btn-light-primary btn-sm" data-bs-toggle="modal" data-bs-target="#kt_modal_2" onclick="edit('<?php echo$id?>','<?php echo$name?>','<?php echo$description?>');"><i class="bi bi-pencil"></i>Edit</a>
				 		</td>
				 	</tr>
				    <?php
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

	 function edit(id,name,description){
	 	var form = document.edit_form;

	 	form.id.value=id;
	 	form.name.value=name;
	 	form.description.value=description;
	 }

	 function deleting(id,name,description){
	 	var form = document.delete_form;

	 	form.id.value=id;
	 	form.name.value=name;
	 	form.description.value=description;
	 }
</script>

<div class="modal fade" tabindex="-1" id="kt_modal_1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Add New</h3>

                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                </div>
                <!--end::Close-->
            </div>

            <form method="POST">
            	<div class="modal-body">
              		<input class="form-control" type="" name="name" placeholder="Name" required><br>
              		<input class="form-control" type="" name="description" placeholder="Description" required><br>
              		<label>Year Level</label>
              		<select class="form-select form-select-solid" data-placeholder="Select an Year Level" data-allow-clear="true" name="year_level">
              			<option></option>
					    <option>1</option>
					    <option>2</option>
					    <option>3</option>
					    <option>4</option>
					</select><br>
              		<select class="form-select form-select-solid" data-control="select2"  data-close-on-select="false" data-placeholder="Select an Section" data-allow-clear="true" multiple="multiple" name="section[]">
              			<?php

						$terms='3';
					    		$range = range('A', 'Z');
								if (!empty($terms)) {
								foreach ($range as $letter) {
								  echo '<option>' . $letter . '<option>';
								  }
								}
					    ?>
					</select>
					
	            </div>
	            <div class="modal-footer">
	                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
	                <button type="submit" class="btn btn-primary" name="add">Save</button>
	            </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" tabindex="-1" id="kt_modal_2">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Edit</h3>

                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                </div>
                <!--end::Close-->
            </div>

            <form method="POST" name="edit_form">
            	<div class="modal-body">
            		<input type="hidden" name="id">
              		<input class="form-control" type="" name="name" placeholder="Name" required><br>
              		<input class="form-control" type="" name="description" placeholder="Description" required><br>
	            </div>
	            <div class="modal-footer">
	                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
	                <button type="submit" class="btn btn-primary" name="update">Save</button>
	            </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" tabindex="-1" id="kt_modal_3">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Edit</h3>

                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                </div>
                <!--end::Close-->
            </div>

            <form method="POST" name="delete_form">
            	<div class="modal-body">
            		<center><label class="h1">Are you sure you want to delete?</label></center>
            		<input type="hidden" name="id">
              		<input class="form-control" type="hidden" name="name" placeholder="Name" required><br>
              		<input class="form-control" type="hidden" name="description" placeholder="Description" required><br>
	            </div>
	            <div class="modal-footer">
	                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
	                <button type="submit" class="btn btn-primary" name="delete">Yes</button>
	            </div>
            </form>
        </div>
    </div>
</div>