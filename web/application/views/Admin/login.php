<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Nexdee || Admin</title>
  <!-- base:css -->
  <link rel="stylesheet" href="<?php echo base_url();?>/admin_assets/vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="<?php echo base_url();?>/admin_assets/vendors/css/vendor.bundle.base.css">
  
  <link rel="stylesheet" href="<?php echo base_url();?>/admin_assets/css/layout/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="<?php echo base_url();?>img/favicon.png" />
</head>

<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left py-5 px-4 px-sm-5">
              <div class="brand-logo text-center">
                <img src="<?php echo base_url(); ?>assets/img/logo_white.png" alt="logo">
              </div>
              
              <h6 class="font-weight-light">Sign in to continue.</h6>
			  <?php
				  $success_msg= $this->session->flashdata('success_msg');
				  $error_msg= $this->session->flashdata('error_msg');

				  if($success_msg){
					?>
					<div class="alert alert-success" role="alert">
						<?php echo $success_msg; ?>
                    </div>
				  <?php
				  }
				  if($error_msg){
					?>
					  <div class="alert alert-danger" role="alert">
						<?php echo $error_msg; ?>
					  </div>
					<?php
				  }
				?>
              <form class="pt-3"  method="post" action="<?php echo base_url('admin/login_admin'); ?>">
                <div class="form-group">
                  <input type="email" name="email" class="form-control form-control-lg" id="exampleInputEmail1" placeholder="Username">
                </div>
                <div class="form-group">
                  <input type="password" name="password" class="form-control form-control-lg" id="exampleInputPassword1" placeholder="Password">
                </div>
                <div class="mt-3">
                  <button type="submit" name="submit" class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn">SIGN IN</button>
                </div>
               </form>
            </div>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- base:js -->
  <script src="<?php echo base_url();?>/admin_assets/vendors/js/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- inject:js -->
  <script src="<?php echo base_url();?>/admin_assets/js/off-canvas.js"></script>
  <script src="<?php echo base_url();?>/admin_assets/js/hoverable-collapse.js"></script>
  <script src="<?php echo base_url();?>/admin_assets/js/template.js"></script>
  <script src="<?php echo base_url();?>/admin_assets/js/settings.js"></script>
  <script src="<?php echo base_url();?>/admin_assets/js/todolist.js"></script>
  <!-- endinject -->
</body>



</html>
