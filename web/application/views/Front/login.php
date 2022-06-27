<main class="overflow-hidden ">
   <!--Start Breadcrumb Style2-->
   <section class="breadcrumb-area" style="background-image: url(assets/img/breadcome.png);">
      <div class="container">
         <div class="row">
            <div class="col-xl-12">
               <div class="breadcrumb-content text-center wow fadeInUp animated">
                  <h2>Login</h2>
                  <div class="breadcrumb-menu">
                     <ul>
                        <li><a href="<?php echo base_url(); ?>"><i class="flaticon-home pe-2"></i>Home</a></li>
                        <li> <i class="flaticon-next"></i> </li>
                        <li class="active">Login</li>
                     </ul>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </section>
   <!--End Breadcrumb Style2-->
   <!--Start Login Page-->
   <section class="login-page pt-120 pb-120">
      <div class="container">
         <div class="row justify-content-center">
            <div class="col-xl-6 col-lg-8 col-md-9 wow fadeInUp animated">
               <div class="login-register-form"
                  style="background-image: url('assets/images/inner-pages/login-bg.png');">
                  <div class="top-title text-center ">
                     <h2 class="mb-3">Login</h2>
					 <?php
					  $success= $this->session->flashdata('success');
					  $error= $this->session->flashdata('error');

					  if($success){
					  ?>
					  <div class="alert alert-success" role="alert">
						<?php echo $success; ?>
								</div>
					  <?php
					  }
					  if($error){
					  ?>
						<div class="alert alert-danger" role="alert">
						<?php echo $error; ?>
						</div> 
					  <?php 
					  }
					  ?>
                     <p>Don't have an account yet?  <a href="<?php echo base_url('register');?>">Sign up for free</a></p>
                  </div>
              <form method="POST" action="<?php echo base_url('login-user'); ?>" class="common-form">
				   <div class="form-group"> 
						<input type="email" name="email" class="form-control" placeholder="Your Email Address"> 
				   </div>
				   <div class="form-group eye">
					  <div class="icon icon-1" > 
						<i class="flaticon-hidden"></i>
					  </div>
					  <input type="password" name="password" id="password-field" class="form-control" placeholder="Password">
					  <div class="icon icon-2 " >
						<i class="flaticon-visibility"></i> 
					  </div>
				   </div>
				   <div class="checkk ">
					  <div class="form-check p-0 m-0"> 
						  <input type="checkbox" id="remember"> 
						  <label class="p-0" for="remember"> Remember Me</label> 
					  </div>
					  <a href="#0" class="forgot"> Forgot Password?</a>
				   </div>
				   <button type="submit" class="btn--primary style2">Login </button>
				</form>
               </div>
            </div>
         </div>
      </div>
   </section>
   <!--End Login Page-->
</main>