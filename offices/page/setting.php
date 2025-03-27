<?php
	$table="offices";
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
                    <button type="submit" name="save" class="btn btn-sm btn-light-primary">Save</button>
                </div>
            </div>
            <div class="card-body">
                <input type="text" name="name" class="form-control" placeholder="Name" value="<?php echo $name?>"><br>
                <input type="email" name="email" class="form-control" placeholder="Email" value="<?php echo $email?>">
            </div>
            <div class="card-footer">
                <div class="input-group mb-3">
                    <input type="password" id="c_password" name="c_password" placeholder="Current Password" class="form-control" required>
                    <button type="button" class="btn btn-outline-secondary" onclick="togglePassword('c_password')">Show</button>
                </div>

                <div class="input-group mb-3">
                    <input type="password" id="new_password" name="new_password" placeholder="New Password" class="form-control" required>
                    <button type="button" class="btn btn-outline-secondary" onclick="togglePassword('new_password')">Show</button>
                </div>

                <div class="input-group mb-3">
                    <input type="password" id="r_password" name="r_password" placeholder="Re-type Password" class="form-control" required>
                    <button type="button" class="btn btn-outline-secondary" onclick="togglePassword('r_password')">Show</button>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
function togglePassword(id) {
    const passwordField = document.getElementById(id);
    const button = passwordField.nextElementSibling;
    if (passwordField.type === "password") {
        passwordField.type = "text";
        button.innerText = "Hide";
    } else {
        passwordField.type = "password";
        button.innerText = "Show";
    }
}
</script>