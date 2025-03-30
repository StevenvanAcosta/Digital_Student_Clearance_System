<div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
	<!--begin::Toolbar container-->
	<div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
		<!--begin::Page title-->
		<div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
			<!--begin::Title-->
			<h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0"><?php echo ucfirst(str_replace(' ', '_', $page)) ;?></h1>
			<!--end::Title-->
			<!--begin::Breadcrumb-->
			<ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
				<!--begin::Item-->
				<li class="breadcrumb-item text-muted">Information</li>
				<!--end::Item-->
			</ul>
			<!--end::Breadcrumb-->
		</div>
		<!--end::Page title-->
		<!--begin::Actions-->
		<div class="d-flex align-items-center gap-2 gap-lg-3">

			<!--begin::Secondary button-->
			<a href="#" class="btn btn-sm fw-bold btn-secondary" data-bs-toggle="modal" data-bs-target="#kt_modal_4"><i class="bi bi-upload"></i>Import</a>
			<!--end::Secondary button-->
			<!--begin::Primary button-->
			<a href="#" class="btn btn-sm fw-bold btn-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_1">Add Data</a>
			<!--end::Primary button-->
		</div>
		<!--end::Actions-->
	</div>
	<!--end::Toolbar container-->
</div>
<?php

$table="student";
$error="";

	if(isset($_POST['add'])){
		extract($_POST);
        $data="";

        foreach ($_POST as $k => $v){

            if(empty($data)){
                $data .= " $k='$v' ";
            }else{
                if($k=="add"){
                    $data .= "";
                }else{
                    $data .= ", $k='$v' ";
                }
                
            }
        }

        

        $data;

        $data.=", date_created=NOW()";
        $data.=", type='student'";
        $data.=", password='4052e09931ceddc2963e2524ee2a2bc7'";

        $sql = "SELECT * FROM student WHERE email='$email' OR student_id='$student_id'";
		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
		  // output data of each row
		  $error='<!--begin::Alert-->
				<div class="alert alert-danger d-flex align-items-center p-5">
				    <!--begin::Icon-->
				    <i class="ki-duotone ki-shield-tick fs-2hx text-danger me-4"><span class="path1"></span><span class="path2"></span></i>
				    <!--end::Icon-->

				    <!--begin::Wrapper-->
				    <div class="d-flex flex-column">
				        <!--begin::Title-->
				        <h4 class="mb-1 text-danger">Failed</h4>
				        <!--end::Title-->

				        <!--begin::Content-->
				        <span>Record Found, please ensured that you are using unique Student ID and Email</span>
				        <!--end::Content-->
				    </div>
				    <!--end::Wrapper-->
				</div>
				<!--end::Alert-->';
		}else{

			$sql = "INSERT INTO $table SET $data";

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


        
	}

	// Update Information Student
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

	// Delete Function
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

        

        echo$data;

        // $data.=", date_time=NOW()";


        $sql = "DELETE FROM $table WHERE id='$id'";

        if ($conn->query($sql) === TRUE) {



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

	// Import Student Function.......
	if(isset($_POST['upload'])){
		$target_dir = "../upload/";
		$base_name = $today_str."-".basename($_FILES["data_file"]["name"]);
		$target_file = $target_dir . $base_name;
		$uploadOk = 1;
		$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

		if($imageFileType != "csv"  ) {

			  $error='<!--begin::Alert-->
				<div class="alert alert-danger d-flex align-items-center p-5">
				    <!--begin::Icon-->
				    <i class="ki-duotone ki-shield-tick fs-2hx text-danger me-4"><span class="path1"></span><span class="path2"></span></i>
				    <!--end::Icon-->

				    <!--begin::Wrapper-->
				    <div class="d-flex flex-column">
				        <!--begin::Title-->
				        <h4 class="mb-1 text-danger">File upload failed</h4>
				        <!--end::Title-->

				        <!--begin::Content-->
				        <span>File must be CSV type</span>
				        <!--end::Content-->
				    </div>
				    <!--end::Wrapper-->
				</div>
				<!--end::Alert-->';
		}else{
			if (move_uploaded_file($_FILES["data_file"]["tmp_name"], $target_file)) {
				$file = fopen($target_file, "r");
				$data="";
				$account_same=0;
				$account_create=0;

			      while (($getData = fgetcsv($file, 10000, ",")) !== FALSE)
			       {
			       	$data.="student_id='$getData[0]',";
			       	$data.="email='$getData[1]',";
			       	$data.="firstname='$getData[2]',";
			       	$data.="lastname='$getData[3]',";
			       	$data.="courses='$getData[4]',";
			       	$data.="year_level='$getData[5]',";
			       	$data.="section='$getData[6]',";
			       	$data.="type='student'";

			       //echo$data;

			       	$sql = "SELECT * FROM $table WHERE email='$getData[1]'";
					$result = $conn->query($sql);

						if ($result->num_rows > 0) {
						  // output data of each row
						 	$account_same=$account_same+1;
						} else {
						  	$sql = "INSERT INTO $table SET $data";
							if ($conn->query($sql) === TRUE) {
							  $last_id = $conn->insert_id;

							$account_create=$account_create+1;
							} else {
							  echo "Error: " . $sql . "<br>" . $conn->error;
							}
					    }
					$error.="<!--begin::Alert-->
							<div class='alert alert-success d-flex align-items-center p-5'>
							    <!--begin::Icon-->
							    <i class='ki-duotone ki-shield-tick fs-2hx text-success me-4'><span class='path1'></span><span class='path2'></span></i>
							    <!--end::Icon-->

							    <!--begin::Wrapper-->
							    <div class='d-flex flex-column'>
							        <!--begin::Title-->
							        <h4 class='mb-1 text-success'>File upload success</h4>
							        <!--end::Title-->

							        <!--begin::Content-->
							        <span>New account created: $account_create | Same account found:  $account_same </span>
							        <!--end::Content-->
							    </div>
							    <!--end::Wrapper-->
							</div>
							<!--end::Alert-->";
					}

			       
			    
			  } else {
			    echo "Sorry, there was an error uploading your file.";
			  }
		}
		

	}


?>

<div class="container-fluid">
	
	<?php echo$error?>
	<table id="kt_datatable_dom_positioning" class="table table-striped table-row-bordered gy-5 gs-7 border rounded">
	    <thead>
	        <tr class="fw-bold fs-6 text-gray-800 px-7">
	        	<th>Student #</th>
	            <th>Full Name</th>
	            <th>Email</th>
	            <th>Program</th>
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
				 		<td><?php echo$student_id?></td>
				 		<td><?php echo$firstname?> <?php echo$lastname?></td>
				 		<td><?php echo$email?></td>
				 		<td><?php echo$courses?> <?php echo$year_level?><?php echo$section?></td>
				 		<td>
				 			<a class="btn btn-light-danger btn-sm" data-bs-toggle="modal" data-bs-target="#kt_modal_3" onclick="deleting('<?php echo$id?>');"><i class="bi bi-trash"></i></a>
				 			<a class="btn btn-light-primary btn-sm" data-bs-toggle="modal" data-bs-target="#kt_modal_2" onclick="select_year_levels('<?php echo$courses?>');edit('<?php echo$id?>','<?php echo$student_id?>','<?php echo$firstname?>','<?php echo$lastname?>','<?php echo$email?>','<?php echo$courses?>','<?php echo$year_level?>','<?php echo$section?>');"><i class="bi bi-pencil"></i>Edit</a>
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


	 function edit(id,student_id,firstname,lastname,email,courses,year_level,section){
	 	var form = document.edit_form;

	 	form.id.value=id;
	 	form.student_id.value=student_id;
	 	form.firstname.value=firstname;
	 	form.lastname.value=lastname;
	 	form.email.value=email;
	 	form.courses.value=courses;
	 	
	 	

	 	setTimeout(function() {
	 		form.year_level.value=year_level;
	 		select_sections(year_level,courses);

	 	}, 300);

	 	setTimeout(function() {
	 		form.section.value=section;
	 		
	 	}, 500);

	 }

	 function deleting(id,student_id,firstname,lastname,email,courses,year_level,section){
	 	var form = document.delete_form;

	 	form.id.value=id;
	 }

	 function select_year_level(courses) {
	  var xhttp = new XMLHttpRequest();
	  xhttp.onreadystatechange = function() {
	    if (this.readyState == 4 && this.status == 200) {
	     document.add_form.year_level.innerHTML = this.response;
	    }
	  };
	  xhttp.open("GET", "select.php?courses="+courses, true);
	  xhttp.send();
	}

	function select_section(year_level,course) {
	  var xhttp = new XMLHttpRequest();
	  xhttp.onreadystatechange = function() {
	    if (this.readyState == 4 && this.status == 200) {
	     document.add_form.section.innerHTML = this.response;
	    }
	  };
	  xhttp.open("GET", "select.php?year_level="+year_level+"&course="+course, true);
	  xhttp.send();
	}

	function select_year_levels(courses) {
	  var xhttp = new XMLHttpRequest();
	  xhttp.onreadystatechange = function() {
	    if (this.readyState == 4 && this.status == 200) {
	     document.edit_form.year_level.innerHTML = this.response;
	    }
	  };
	  xhttp.open("GET", "select.php?courses="+courses, true);
	  xhttp.send();
	}

	function select_sections(year_level,course) {
	  var xhttp = new XMLHttpRequest();
	  xhttp.onreadystatechange = function() {
	    if (this.readyState == 4 && this.status == 200) {
	     document.edit_form.section.innerHTML = this.response;
	    }
	  };
	  xhttp.open("GET", "select.php?year_level="+year_level+"&course="+course, true);
	  xhttp.send();
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

            <form method="POST" name="add_form">
            	<div class="modal-body">
            		<input class="form-control" type="" name="student_id" placeholder="Student ID" required><br>
              		<input class="form-control" type="" name="firstname" placeholder="Firstname" required><br>
              		<input class="form-control" type="" name="lastname" placeholder="Lastname" required><br>
              		<input class="form-control" type="email" name="email" placeholder="Email" required><br>
              		<label>Course</label>
              		<select class="form-select" name="courses" onchange="select_year_level(this.value);">
              			<option></option>
              			<?php
              				$sql = "SELECT DISTINCT (name) FROM courses";
							$result = $conn->query($sql);

							if ($result->num_rows > 0) {
							  // output data of each row
							  while($row = $result->fetch_assoc()) {
							  	extract($row);
							   ?>
							   	<option><?php echo$name?></option>
							   <?php
							  }
							}
              			?>
              		</select><br>
              		<label>Year Level</label>
              		<select class="form-select" name="year_level"  onchange="select_section(this.value,document.add_form.courses.value);">
              		</select><br>
              		<label>Section</label>
              		<select class="form-select" name="section">
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
              		<input class="form-control" type="" name="student_id" placeholder="Student ID" required><br>
              		<input class="form-control" type="" name="firstname" placeholder="Firstname" required><br>
              		<input class="form-control" type="" name="lastname" placeholder="Lastname" required><br>
              		<input class="form-control" type="email" name="email" placeholder="Email" required><br>
              		<label>Course</label>
              		<select class="form-select" name="courses" onchange="select_year_levels(this.value);">
              			<option></option>
              			<?php
              				$sql = "SELECT DISTINCT (name) FROM courses";
							$result = $conn->query($sql);

							if ($result->num_rows > 0) {
							  // output data of each row
							  while($row = $result->fetch_assoc()) {
							  	extract($row);
							   ?>
							   	<option><?php echo$name?></option>
							   <?php
							  }
							}
              			?>
              		</select><br>
              		<label>Year Level</label>
              		<select class="form-select" name="year_level"  onchange="select_sections(this.value,document.edit_form.courses.value);">
              		</select><br>
              		<label>Section</label>
              		<select class="form-select" name="section">
              		</select>
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
	            </div>
	            <div class="modal-footer">
	                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
	                <button type="submit" class="btn btn-primary" name="delete">Yes</button>
	            </div>
            </form>
        </div>
    </div>
</div>


<div class="modal fade" tabindex="-1" id="kt_modal_4">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Import</h3>

                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                </div>
                <!--end::Close-->
            </div>

            <form method="POST" name="import"  enctype="multipart/form-data">
            	<div class="modal-body">
            		<!--begin::Input wrapper-->
					<div class=" position-relative">
					    <!--begin::Input-->
					    <input type="file" class="form-control form-control-solid"  name="data_file"/>
					    <!--end::Input-->

					    <!--begin::CVV icon-->
					    <div class="position-absolute translate-middle-y top-50 end-0 me-3">
					        <i class="ki-duotone ki-document fs-2hx"><span class="path1"></span><span class="path2"></span></i>
					    </div>
					    <!--end::CVV icon-->
					</div>
					<!--end::Input wrapper-->
	            </div>
	            <div class="modal-footer">
	                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
	                <button type="submit" class="btn btn-primary" name="upload">Upload</button>
	            </div>
            </form>
        </div>
    </div>
</div>