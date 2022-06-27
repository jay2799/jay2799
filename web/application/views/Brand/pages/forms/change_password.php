<div class="content-wrapper">
          <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Update Password</h4>
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
                      <label for="exampleInputUsername1">Old Password</label>
                      <input type="password" name="password" class="form-control" id="exampleInputUsername1" >
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">New Password </label>
                      <input type="password" name="npassword"   class="form-control" id="exampleInputEmail1" >
                    </div>
                    <div class="form-group">
                        <label for="Profile">Confirm Password</label>
                        <input type="password" name="cpassword"   class="form-control" id="exampleInputEmail1" >
                    </div>
                    
                    <button name="submit" type="submit" class="btn btn-gradient-primary mr-2">Submit</button>
                    
                  </form>
                </div>
              </div>
            </div>
         
            
    
          </div>
        </div>