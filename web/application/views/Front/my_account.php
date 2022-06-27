 <main class="overflow-hidden ">
        <!--Start Breadcrumb Style2-->
        <section class="breadcrumb-area" style="background-image: url(assets/img/breadcome.png);">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="breadcrumb-content text-center wow fadeInUp animated">
                            <h2>My Account </h2>
                            <div class="breadcrumb-menu">
                                <ul>
                                    <li><a href="<?php echo base_url(); ?>"><i class="flaticon-home pe-2"></i>Home</a></li>
                                    <li> <i class="flaticon-next"></i> </li>
                                    <li class="active">My Account</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--End Breadcrumb Style2-->
        <!--Start My Account Page-->
        <section class="my-account-page pt-120 pb-120">
            <div class="container">
                <div class="row wow fadeInUp animated">
                    <!--Start My Account Page Menu-->
                    <div class="col-xl-3 col-lg-4">
                        <div class="d-flex align-items-start">
                            <div class="nav my-account-page__menu flex-column nav-pills me-3" id="v-pills-tab"
                                role="tablist" aria-orientation="vertical"> 
							
						   <button class="nav-link active" id="v-pills-account-tab" data-bs-toggle="pill" data-bs-target="#v-pills-account" type="button" role="tab" aria-controls="v-pills-account" aria-selected="false"> <span> Account Details</span>
                           </button>
						   
						   <button class="nav-link" id="v-pills-password-tab" data-bs-toggle="pill" data-bs-target="#v-pills-password" type="button" role="tab" aria-controls="v-pills-password" aria-selected="false"> <span> Change Password</span>
                           </button>
						   
							<a href="<?php echo base_url('logout');?>" class="nav-link"> <span> Logout </span> </a> 
							
						  </div>
                        </div>
                    </div>
                    <div class="col-lg-8">
					   <div class="tab-content " id="v-pills-tabContent">
						  <div class="tab-pane fade show active" id="v-pills-account" role="tabpanel"
							 aria-labelledby="v-pills-account-tab">
							 <div class="tabs-content__single">
								<div class="contact-form">
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
								   <form method="POST" action="<?php echo base_url('welcome/user_profile');?>"  enctype="multipart/form-data"  class="account_details">
									  <div class="row">
										 <div class="col-lg-6">
											<div class="form-group"> <label for="name"> Your Name</label> <input type="text"
											   id="name" class="form-control" name="name" value="<?php echo $user['name'];?>" placeholder="Enter Your Name"> </div>
										 </div>
										 <div class="col-lg-6">
											<div class="form-group"> <label for="number"> Phone Number </label> <input
											   type="text" id="number" name="number" value="<?php echo $user['number'];?>" class="form-control" placeholder="Enter Your Number"> </div>
										 </div>
										 <div class="col-lg-12">
											<div class="form-group"> <label for="email"> Email Address </label> <input
											   type="text" id="email" name="email" value="<?php echo $user['email'];?>" class="form-control"
											   placeholder="Enter Your Email" readonly> </div>
										 </div>
										 <div class="col-lg-6">
											<div class="form-group"> <label for="email"> Profile Image </label> <input
											   type="file" id="email" name="images" class="form-control"> 
											</div>
										 </div>
										 
										  <div class="col-lg-6">
										  <div class="form-group">
											<?php if(!empty($user['images'])) { ?>
											<img src ="<?php echo base_url();?>/uploads/user/<?php echo $user['images'];?>" style="    width: 25%;" >
											<?php } else {} ?>
											</div>
										 </div>
										 
									  </div>
									  <button type="submit" class="btn--primary style2 ">Update </button>
								   </form>
								</div>
							 </div>
						  </div>
						   <div class="tab-pane fade " id="v-pills-password" role="tabpanel"
							 aria-labelledby="v-pills-password-tab">
							 <div class="tabs-content__single">
								<form method="POST" action="<?php echo base_url('welcome/change_password');?>"  enctype="multipart/form-data"  class="account_details">
									  <div class="row">
										 <div class="col-lg-12">
											<div class="form-group"> <label for="name">Old Password</label> <input type="password"
											   id="name" class="form-control" name="password" placeholder="Enter Your Old Password" required > </div>
										 </div>
										 <div class="col-lg-12">
											<div class="form-group"> <label for="number">New Password</label> <input
											   type="password" id="number" name="npassword" class="form-control" placeholder="Enter Your New Password" required > </div>
										 </div>
										 <div class="col-lg-12">
											<div class="form-group"> <label for="email">Confirm Password </label> <input
											   type="password" id="email" name="cpassword"  class="form-control"
											   placeholder="Enter Your Confirm Password " required> </div>
										 </div>
										
										 
									  </div>
									  <button type="submit" class="btn--primary style2 ">Update </button>
								   </form>
						  </div>
						  </div>
					   </div>
					</div>
                </div>
            </div>
        </section>
        <!--End My Account Page-->
    </main>