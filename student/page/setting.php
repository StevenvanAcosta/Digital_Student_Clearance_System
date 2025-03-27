<?php
	$table="student";
	$error="";
	if (isset($_POST['save'])) {
		extract($_POST);


		$sql = "UPDATE $table SET name='$name',email='$email' WHERE id='$user_id'";

		if ($conn->query($sql) === TRUE) {
		  	if('d41d8cd98f00b204e9800998ecf8427e'==md5($c_password)){
		  		$error='<!--begin::Alert-->
					<div class="alert alert-info d-flex align-items-center p-5">
					    <!--begin::Icon-->
					    <i class="ki-duotone ki-shield-tick fs-2hx text-info me-4"><span class="path1"></span><span class="path2"></span></i>
					    <!--end::Icon-->

					    <!--begin::Wrapper-->
					    <div class="d-flex flex-column">
					        <!--begin::Title-->
					        <h4 class="mb-1 text-info">Details updated!</h4>
					        <!--end::Title-->

					        <!--begin::Content-->
					        <span>Data information update successfully</span>
					        <!--end::Content-->
					    </div>
					    <!--end::Wrapper-->
					</div>
					<!--end::Alert-->';
		  	}else{
		  		if(md5($c_password)==$password){


		  			if($new_password==$r_password){
		  				 $password=md5($new_password);
		  				$sql = "UPDATE $table SET password='$password' WHERE id='$user_id'";

						if ($conn->query($sql) === TRUE) {
						  		$error='<!--begin::Alert-->
									<div class="alert alert-success d-flex align-items-center p-5">
									    <!--begin::Icon-->
									    <i class="ki-duotone ki-shield-tick fs-2hx text-success me-4"><span class="path1"></span><span class="path2"></span></i>
									    <!--end::Icon-->

									    <!--begin::Wrapper-->
									    <div class="d-flex flex-column">
									        <!--begin::Title-->
									        <h4 class="mb-1 text-success">Details updated!</h4>
									        <!--end::Title-->

									        <!--begin::Content-->
									        <span>Data information and password update successfully</span>
									        <!--end::Content-->
									    </div>
									    <!--end::Wrapper-->
									</div>
									<!--end::Alert-->';
						 }

		  			}else{
		  				$error='<!--begin::Alert-->
					<div class="alert alert-danger d-flex align-items-center p-5">
					    <!--begin::Icon-->
					    <i class="ki-duotone ki-shield-tick fs-2hx text-danger me-4"><span class="path1"></span><span class="path2"></span></i>
					    <!--end::Icon-->

					    <!--begin::Wrapper-->
					    <div class="d-flex flex-column">
					        <!--begin::Title-->
					        <h4 class="mb-1 text-danger">Incorrect Re-Password!</h4>
					        <!--end::Title-->

					        <!--begin::Content-->
					        <span>Please input correctly</span>
					        <!--end::Content-->
					    </div>
					    <!--end::Wrapper-->
					</div>
					<!--end::Alert-->';
		  			}

		  		}else{
		  			$error='<!--begin::Alert-->
					<div class="alert alert-danger d-flex align-items-center p-5">
					    <!--begin::Icon-->
					    <i class="ki-duotone ki-shield-tick fs-2hx text-danger me-4"><span class="path1"></span><span class="path2"></span></i>
					    <!--end::Icon-->

					    <!--begin::Wrapper-->
					    <div class="d-flex flex-column">
					        <!--begin::Title-->
					        <h4 class="mb-1 text-danger">Incorrect Password!</h4>
					        <!--end::Title-->

					        <!--begin::Content-->
					        <span>Password not update</span>
					        <!--end::Content-->
					    </div>
					    <!--end::Wrapper-->
					</div>
					<!--end::Alert-->';
		  		}
		  	}
		} else {
		  echo "Error updating record: " . $conn->error;
		}
	}
?>

<div class="container p-5">
	<?php echo$error?>
	<form method="POST">
	<div class="card">
		<div class="card-header">
			<h3 class="card-title">Information</h3>
	        <div class="card-toolbar">
	            <button type="submit" name="save" class="btn btn-sm btn-light-primary">
	                Save
	            </button>
	        </div>
		</div>
		<div class="card-body">
			<input type="" name="firstname" class="form-control" placeholder="First Name" value="<?php echo $firstname?>"><br>
			<input type="email" name="email" class="form-control" placeholder="Email" value="<?php echo $email?>">
		</div>
		<div class="card-footer">
			<input type="password" name="c_password" placeholder="Current Password" class="form-control"><br>
			<input type="password" name="new_password" placeholder="New Password" class="form-control"><br>
			<input type="password" name="r_password" placeholder="Re-type password" class="form-control"><br>
			<br>
		</div>
	</div>
	</form>
</div>