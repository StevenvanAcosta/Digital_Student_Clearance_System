<?php

	include'connect/connect.php';
	session_start();
	$error="";
	$type=$_SESSION['type'];

	if(isset($_POST['code_1'])){
		extract($_POST);

		extract($_GET);

		$code=$code_1."".$code_2."".$code_3."".$code_4."".$code_5."".$code_6;

		$sql = "SELECT * FROM $type WHERE email='$email'";
		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
		  // output data of each row
		  while($row = $result->fetch_assoc()) {
		    extract($row);

		    if($verification==$code){
		    	$sql = "UPDATE $type SET status='verified' WHERE email='$email'";

					if ($conn->query($sql) === TRUE) {
					  	header("location: ".$type."/");
					} else {
					  echo "Error updating record: " . $conn->error;
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
					        <h4 class="mb-1 text-danger">Please Type Correctly</h4>
					        <!--end::Title-->

					        <!--begin::Content-->
					        <span>Make sure you type the right authentication key</span>
					        <!--end::Content-->
					    </div>
					    <!--end::Wrapper-->
					</div>
					<!--end::Alert-->';
		    }
		  }
		}

	}
?>
<!DOCTYPE html>
<html lang="en">
	<!--begin::Head-->
	<head>
<base href="" />
		<title>Digital Student Clearance System</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="canonical" href="http://preview.keenthemes.comauthentication/layouts/creative/sign-in.html" />
		<link rel="shortcut icon" href="images/logo.png" />
		<!--begin::Fonts(mandatory for all pages)-->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
		<!--end::Fonts-->
		<!--begin::Global Stylesheets Bundle(mandatory for all pages)-->
		<link href="assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
		<link href="assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
		<!--end::Global Stylesheets Bundle-->
		<script>// Frame-busting to prevent site from being loaded within a frame without permission (click-jacking) if (window.top != window.self) { window.top.location.replace(window.self.location.href); }</script>
	</head>
	<!--end::Head-->
	<!--begin::Body-->
	<body id="kt_body" class="app-blank bgi-size-cover bgi-attachment-fixed bgi-position-center bgi-no-repeat" style="background: #FFFFFF;">
		<!--begin::Theme mode setup on page load-->
		<script>var defaultThemeMode = "light"; var themeMode; if ( document.documentElement ) { if ( document.documentElement.hasAttribute("data-bs-theme-mode")) { themeMode = document.documentElement.getAttribute("data-bs-theme-mode"); } else { if ( localStorage.getItem("data-bs-theme") !== null ) { themeMode = localStorage.getItem("data-bs-theme"); } else { themeMode = defaultThemeMode; } } if (themeMode === "system") { themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light"; } document.documentElement.setAttribute("data-bs-theme", themeMode); }</script>
		<!--end::Theme mode setup on page load-->
		<!--begin::Root-->
		<div class="d-flex flex-column flex-root" id="kt_app_root">
			<!--begin::Page bg image-->
			<style>body { background-image: url('assets/media/auth/bg4.jpg'); } [data-bs-theme="dark"] body { background-image: url('assets/media/auth/bg4-dark.jpg'); }</style>
			<!--end::Page bg image-->
			<!--begin::Authentication - Two-factor -->
			<div class="d-flex flex-column flex-column-fluid flex-lg-row">
				<!--begin::Aside-->
				<div class="d-flex flex-center w-lg-50 pt-15 pt-lg-0 px-10">
					<!--begin::Aside-->
					<div class="d-flex flex-center flex-lg-start flex-column">
						<!--begin::Logo-->
						<a href="index.html" class="mb-7">
							<img alt="Logo" src="images/dscs-logo.png" style="height: 500px;" />
						</a>
						<!--end::Logo-->
						<!--begin::Title-->
						<!-- <h2 class="text-white fw-normal m-0">Branding tools designed for your business</h2> -->
						<!--end::Title-->
					</div>
					<!--begin::Aside-->
				</div>
				<!--begin::Aside-->
				<!--begin::Body-->
				<div class="d-flex flex-column-fluid flex-lg-row-auto justify-content-center justify-content-lg-end p-12 p-lg-20" >
					<!--begin::Card-->
					<div class=" d-flex flex-column align-items-stretch flex-center rounded-4 w-md-600px p-20" style="background: #163B6D;" >
						<!--begin::Wrapper-->
						<div class="d-flex flex-center flex-column flex-column-fluid px-lg-10 pb-15 pb-lg-20" >
							<!--begin::Form-->
							<form class="form w-100 mb-13" novalidate="novalidate" data-kt-redirect-url="index.html" id="kt_sing_in_two_factor_form" method="POST"  >
								<!--begin::Icon-->
								<div class="text-center mb-10">
									<img alt="Logo" class="mh-125px" src="assets/media/svg/misc/smartphone-2.svg" />
								</div>
								<!--end::Icon-->
								<!--begin::Heading-->
								<div class="text-center mb-10">
									<!--begin::Title-->
									<h1 class="text-white mb-3">Two-Factor Verification</h1>
									<!--end::Title-->
									<!--begin::Sub-title-->
									<div class="text-white fw-semibold fs-5 mb-5">Enter the verification code we sent </div>
									<!--end::Sub-title-->
									<!--begin::Mobile no-->
									<!-- <div class="fw-bold text-gray-900 fs-3">******7859</div> -->
									<!--end::Mobile no-->
								</div>
								<!--end::Heading-->
								<?php echo$error?>
								<!--begin::Section-->
								<div class="mb-10">
									<!--begin::Label-->
									<div class="fw-bold text-start text-white fs-6 mb-1 ms-1">Type your 6 digit security code</div>
									<!--end::Label-->
									<!--begin::Input group-->
									<div class="d-flex flex-wrap flex-stack">
										<input type="text" name="code_1" data-inputmask="'mask': '9', 'placeholder': ''" maxlength="1" class="form-control bg-transparent h-60px w-60px fs-2qx text-center mx-1 my-2" value="" />
										<input type="text" name="code_2" data-inputmask="'mask': '9', 'placeholder': ''" maxlength="1" class="form-control bg-transparent h-60px w-60px fs-2qx text-center mx-1 my-2" value="" />
										<input type="text" name="code_3" data-inputmask="'mask': '9', 'placeholder': ''" maxlength="1" class="form-control bg-transparent h-60px w-60px fs-2qx text-center mx-1 my-2" value="" />
										<input type="text" name="code_4" data-inputmask="'mask': '9', 'placeholder': ''" maxlength="1" class="form-control bg-transparent h-60px w-60px fs-2qx text-center mx-1 my-2" value="" />
										<input type="text" name="code_5" data-inputmask="'mask': '9', 'placeholder': ''" maxlength="1" class="form-control bg-transparent h-60px w-60px fs-2qx text-center mx-1 my-2" value="" />
										<input type="text" name="code_6" data-inputmask="'mask': '9', 'placeholder': ''" maxlength="1" class="form-control bg-transparent h-60px w-60px fs-2qx text-center mx-1 my-2" value="" />
									</div>
									<!--begin::Input group-->
								</div>
								<!--end::Section-->
								<!--begin::Submit-->
								<div class="d-flex flex-center">
									<button type="button" id="kt_sing_in_two_factor_submit" class="btn btn-lg btn-primary fw-bold">
										<span class="indicator-label">Submit</span>
										<span class="indicator-progress">Please wait... 
										<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
									</button>
								</div>
								<!--end::Submit-->
							</form>
							<!--end::Form-->
						</div>
						<!--end::Wrapper-->
					</div>
					<!--end::Card-->
				</div>
				<!--end::Body-->
			</div>
			<!--end::Authentication - Two-factor-->
		</div>
		<!--end::Root-->
		<!--begin::Javascript-->
		<script>var hostUrl = "assets/";</script>
		<!--begin::Global Javascript Bundle(mandatory for all pages)-->
		<script src="assets/plugins/global/plugins.bundle.js"></script>
		<script src="assets/js/scripts.bundle.js"></script>
		<!--end::Global Javascript Bundle-->
		<!--begin::Custom Javascript(used for this page only)-->
		<script src="assets/js/custom/authentication/sign-in/two-factor.js"></script>
		<!--end::Custom Javascript-->
		<!--end::Javascript-->
	</body>
	<!--end::Body-->
</html>