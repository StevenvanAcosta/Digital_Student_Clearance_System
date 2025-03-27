<?php
	$table="admin";
	$error="";
	if (isset($_POST['save'])) {
		extract($_POST);

		$sql = "UPDATE $table SET name='$name', email='$email' WHERE id='$user_id'";

		if ($conn->query($sql) === TRUE) {
		  	if ('d41d8cd98f00b204e9800998ecf8427e' == md5($c_password)) {
		  		$error='<div class="alert alert-info alert-dismissible fade show d-flex align-items-center p-5" role="alert">
					<i class="ki-duotone ki-shield-tick fs-2hx text-info me-4"></i>
					<div class="d-flex flex-column">
						<h4 class="mb-1 text-info">Details updated!</h4>
						<span>Data information updated successfully</span>
					</div>
				</div>';
		  	}else{
		  		if(md5($c_password) == $password) {

		  			if($new_password == $r_password) {
		  				$password = md5($new_password);
						$sql = "UPDATE $table SET password='$password' WHERE id='$user_id'";

						if ($conn->query($sql) === TRUE) {
							$error='<div class="alert alert-success alert-dismissible fade show d-flex align-items-center p-5" role="alert">
								<i class="ki-duotone ki-shield-tick fs-2hx text-success me-4"></i>
								<div class="d-flex flex-column">
									<h4 class="mb-1 text-success">Details updated!</h4>
									<span>Data information and password updated successfully</span>
								</div>
							</div>';
						}
		  			}else{
		  				$error='<div class="alert alert-danger alert-dismissible fade show d-flex align-items-center p-5" role="alert">
							<i class="ki-duotone ki-shield-tick fs-2hx text-danger me-4"></i>
							<div class="d-flex flex-column">
								<h4 class="mb-1 text-danger">Incorrect Re-Password!</h4>
								<span>Please input correctly</span>
							</div>
						</div>';
		  			}
		  		}else{
		  			$error='<div class="alert alert-danger alert-dismissible fade show d-flex align-items-center p-5" role="alert">
						<i class="ki-duotone ki-shield-tick fs-2hx text-danger me-4"></i>
						<div class="d-flex flex-column">
							<h4 class="mb-1 text-danger">Incorrect Password!</h4>
							<span>Password not updated</span>
						</div>
					</div>';
		  		}
		  	}
		} else {
			echo "Error updating record: " . $conn->error;
		}
	}
?>

<div class="container p-5">
	<?php echo $error ?>
	<script>
		setTimeout(function() {
			const alertElements = document.querySelectorAll('.alert');
			alertElements.forEach(alert => {
				alert.classList.add('fade');
				setTimeout(() => alert.remove(), 500);
			});
		}, 5000);
	</script>

	<form method="POST">
		<div class="card">
			<div class="card-header">
				<h3 class="card-title">Information</h3>
		        <div class="card-toolbar">
		            <button type="submit" name="save" class="btn btn-sm btn-light-primary">Save</button>
		        </div>
			</div>
			<div class="card-body">
				<input type="text" name="name" class="form-control" placeholder="Full Name" value="<?php echo $name?>"><br>
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