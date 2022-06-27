<div class="content-wrapper">
          <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Admin Update</h4>
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
                  <form class="forms-sample" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                      <label for="exampleInputUsername1">Name</label>
                      <input type="text" name="name" value="<?php echo $users->name;?>" class="form-control" id="exampleInputUsername1" placeholder="Enter Your Name">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Email </label>
                      <input type="email" name="email"  value="<?php echo $users->email;?>" class="form-control" id="exampleInputEmail1" placeholder="Enter Your Email">
                    </div>
					<div class="form-group">
                      <label for="exampleInputEmail1">Mobile </label>
                      <input type="number" name="mobile"  value="<?php echo $users->mobile;?>" class="form-control" id="exampleInputEmail1" placeholder="Enter Your Mobile Number">
                    </div>
                    <div class="form-group">
                        <label for="Profile">Profile Pic</label>
                        <input id="Profile" class="form-control" type="file" name="profile_pic">
                    </div>
                    
                    <button name="submit" type="submit" class="btn btn-gradient-primary mr-2">Submit</button>
                    
                  </form>
                </div>
              </div>
            </div>
         
            
    
          </div>
        </div>