<div class="content-wrapper">
          <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">User Create</h4>
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
                      <label for="exampleInputUsername1">User Name</label>
                      <input type="text" name="name"  class="form-control" id="exampleInputUsername1" placeholder="Enter User Name">
                    </div>
					
					<div class="form-group">
                      <label for="exampleInputUsername1">User Email</label>
                      <input type="email" name="email"  class="form-control" id="exampleInputUsername1" placeholder="Enter User Email">
                    </div>
					
					<div class="form-group">
                      <label for="exampleInputUsername1">User Mobile</label>
                      <input type="number" name="number"  class="form-control" id="exampleInputUsername1" placeholder="Enter User Number">
                    </div>
					
					<div class="form-group">
                      <label for="exampleInputUsername1">User Password</label>
                      <input type="password" name="password"  class="form-control" id="exampleInputUsername1" placeholder="Enter User Password">
                    </div>
                    
                    <div class="form-group">
                        <label for="Profile">User Profile</label>
                        <input id="Profile" class="form-control" type="file" name="images">
                    </div>
                    
                    <button name="submit" type="submit" class="btn btn-gradient-primary mr-2">Submit</button>
                    
                  </form>
                </div>
              </div>
            </div>
         
            
    
          </div>
        </div>