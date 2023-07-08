<!------ Include the above in your HEAD tag ---------->

<!DOCTYPE html>
<html>

<head><base href="../../../">
		<title>Assignment In Need</title>
		<meta charset="utf-8" />
		<meta name="description" content="The most advanced Bootstrap Admin Theme on Themeforest trusted by 94,000 beginners and professionals. Multi-demo, Dark Mode, RTL support and complete React, Angular, Vue &amp; Laravel versions. Grab your copy now and get life-time updates for free." />
		<meta name="keywords" content="Metronic, bootstrap, bootstrap 5, Angular, VueJs, React, Laravel, admin themes, web design, figma, web development, free templates, free admin themes, bootstrap theme, bootstrap template, bootstrap dashboard, bootstrap dak mode, bootstrap button, bootstrap datepicker, bootstrap timepicker, fullcalendar, datatables, flaticon" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<meta property="og:locale" content="en_US" />
		<meta property="og:type" content="article" />
		<meta property="og:title" content="Metronic - Bootstrap 5 HTML, VueJS, React, Angular &amp; Laravel Admin Dashboard Theme" />
		<meta property="og:url" content="https://keenthemes.com/metronic" />
		<meta property="og:site_name" content="Keenthemes | Metronic" />
		<link rel="canonical" href="https://preview.keenthemes.com/metronic8" />
		<link rel="shortcut icon" href="<?php echo base_url(); ?>uploads_old/assignment_logo.png" />
		<!--begin::Fonts-->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
		<!--end::Fonts-->
		<!--begin::Global Stylesheets Bundle(used by all pages)-->
		<link href="<?php echo base_url(); ?>assets1/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
		<link href="<?php echo base_url(); ?>assets1/css/style.bundle.css" rel="stylesheet" type="text/css" />
		<!--end::Global Stylesheets Bundle-->
	</head>

<body id="kt_body" class="bg-body">
		<!--begin::Main-->
		<div class="d-flex flex-column flex-root">
			<!--begin::Authentication - Sign-in -->
			<div class="d-flex flex-column flex-column-fluid bgi-position-y-bottom position-x-center bgi-no-repeat bgi-size-contain bgi-attachment-fixed" style="background-image: url(assets/media/illustrations/sketchy-1/14.png">
				<!--begin::Content-->
				<div class="d-flex flex-center flex-column flex-column-fluid p-10 pb-lg-20">
					<!--begin::Logo-->
					<a href="#" class="mb-5">
						<img alt="Logo" src="<?php echo base_url(); ?>uploads_old/assignment_logo.png" class="h-150px" />
					</a>
					<!--end::Logo-->
					<!--begin::Wrapper-->
					<div class="w-lg-500px bg-body rounded shadow-sm p-10 p-lg-15 mx-auto">
					<div class="" style="color:blue;">
                     <?php echo validation_errors(); ?>

                     <?php if ($this->session->flashdata('success')) : ?>
                        <div class="alert alert-success alert-dismissible">
                           <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                           <h5><i class="icon fa fa-check"></i> Success!</h5>
                           <?php echo $this->session->flashdata('success'); ?>
                        </div>
                        <!-- <span class="successs_mesg"><?php echo $this->session->flashdata('success'); ?></span> -->
                     <?php endif; ?>

                     <?php if ($this->session->flashdata('failed')) : ?>
                        <div class="alert alert-error alert-dismissible ">
                           <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                           <h5><i class="icon fa fa-check"></i> Alert!</h5>
                           <?php echo $this->session->flashdata('failed'); ?>
                        </div>
                     <?php endif; ?>
                     <?php if (@$email) {
                        echo "<span style='padding:4px;font-weight:600;'>Your password is user@123</span><br/>";
                     } ?>
                  </div>
						<!--begin::Form-->
						<form class="form w-100" novalidate="novalidate" id="kt_sign_in_form" action="<?php echo base_url(); ?>index.php/User_authentication/user_login_process" method="post">
							<!--begin::Heading-->
							<div class="text-center mb-10">
								<!--begin::Title-->
								<h1 class="text-dark mb-3">Sign In to Assignmentinneed</h1>
								<!--end::Title-->
								<!--begin::Link-->
								<div class="text-gray-400 fw-bold fs-4">New Here?
								<a href="<?php echo base_url(); ?>/User_authentication/user_registration_show" class="link-primary fw-bolder">Create an Account</a></div>
								<!--end::Link-->
							</div>
							<!--begin::Heading-->
							<!--begin::Input group-->
							<div class="fv-row mb-10">
								<!--begin::Label-->
								<label class="form-label fs-6 fw-bolder text-dark">Email</label>
								<!--end::Label-->
								<!--begin::Input-->
								<input class="form-control form-control-lg form-control-solid" type="text" name="username" autocomplete="off" />
								<!--end::Input-->
							</div>
							<!--end::Input group-->
							<!--begin::Input group-->
							<div class="fv-row mb-10">
								<!--begin::Wrapper-->
								<div class="d-flex flex-stack mb-2">
									<!--begin::Label-->
									<label class="form-label fw-bolder text-dark fs-6 mb-0">Password</label>
									<!--end::Label-->
									<!--begin::Link-->
									<a href="<?php echo base_url(); ?>User_authentication/ForgotPassword" class="link-primary fs-6 fw-bolder">Forgot Password ?</a>
									<!--end::Link-->
								</div>
								<!--end::Wrapper-->
								<!--begin::Input-->
								<input class="form-control form-control-lg form-control-solid" type="password" name="password" autocomplete="off" />
								<!--end::Input-->
							</div>
							<!--end::Input group-->
							<!--begin::Actions-->
							<div class="text-center">
								<!--begin::Submit button-->
								<button type="submit" id="" class="btn btn-lg btn-primary w-100 mb-5">
									<span class="indicator-label">Continue</span>
									<span class="indicator-progress">Please wait...
									<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
								</button>
								<!--end::Submit button-->
							</div>
							<!--end::Actions-->
						</form>
						<!--end::Form-->
					</div>
					<!--end::Wrapper-->
				</div>
				<!--end::Content-->
				<!--begin::Footer-->
				<div class="d-flex flex-center flex-column-auto p-10">
					<!--begin::Links-->
					<div class="d-flex align-items-center fw-bold fs-6">
						<a href="https://www.assignnmentinneed.com/" class="text-muted text-hover-primary px-2">About</a>
						<a href="https://www.assignnmentinneed.com/contact-us/" class="text-muted text-hover-primary px-2">Contact</a>
						<a href="https://www.assignnmentinneed.com/contact-us/" class="text-muted text-hover-primary px-2">Contact Us</a>
					</div>
					<!--end::Links-->
				</div>
				<!--end::Footer-->
			</div>
			<!--end::Authentication - Sign-in-->
		</div>
		<!--end::Main-->
		<script>var hostUrl = "<?php echo base_url(); ?>assets/";</script>
		<!--begin::Javascript-->
		<!--begin::Global Javascript Bundle(used by all pages)-->
		<script src="<?php echo base_url(); ?>assets/plugins/global/plugins.bundle.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/scripts.bundle.js"></script>
		<!--end::Global Javascript Bundle-->
		<!--begin::Page Custom Javascript(used by this page)-->
		<script src="<?php echo base_url(); ?>assets/js/custom/authentication/sign-in/general.js"></script>
		<!--end::Page Custom Javascript-->
		<!--end::Javascript-->
	</body>

</html>

<script src="<?php echo base_url() . "assets/"; ?>plugins/jquery/jquery.min.js"></script>
<script>
   $('#close').on('click', function(e) {
      $(this).parent('.error_mesg').remove();
   });
</script>