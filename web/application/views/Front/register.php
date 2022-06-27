<main class="overflow-hidden ">
   <!--Start Breadcrumb Style2-->
   <section class="breadcrumb-area" style="background-image: url(assets/img/breadcome.png);">
      <div class="container">
         <div class="row">
            <div class="col-xl-12">
               <div class="breadcrumb-content text-center wow fadeInUp animated">
                  <h2>Register</h2>
                  <div class="breadcrumb-menu">
                     <ul>
                        <li><a href="<?php echo base_url(); ?>"><i class="flaticon-home pe-2"></i>Home</a></li>
                        <li> <i class="flaticon-next"></i> </li>
                        <li class="active">Register</li>
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
                     <h2>Register</h2>
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
                     <p>Already have an account? <a href="<?php echo base_url('login'); ?>">Log in</a></p>
                  </div>
                  <form method="POST" action="<?php echo base_url('add-user');?>" class="common-form">
                     <div class="form-group"> 
						<input type="text" name="name" class="form-control" placeholder="Your Name"> 
					 </div>
                    
                     <div class="form-group"> 
						<input type="email" name="email" class="form-control" placeholder="Your Email">
					 </div>
                     <div class="form-group eye">
                        <div class="icon icon-1"> 
							<i class="flaticon-hidden"></i>
						</div>
                        <input type="password" name="password" id="password-field" class="form-control" placeholder="Password">
                        <div class="icon icon-2 ">
							<i class="flaticon-visibility"></i> 
						</div>
                     </div>
                     <div class="checkk ">
                        <div class="form-check p-0 m-0"> <input type="checkbox" id="remember"> <label
                           class="p-0" for="remember"> Accept the Terms and Privacy Policy </label>
                        </div>
                     </div>
                     <button type="submit" class="btn--primary style2">Register </button>
                  </form>
               </div>
            </div>
         </div>
      </div>
   </section>
   <!--End Login Page-->
</main>