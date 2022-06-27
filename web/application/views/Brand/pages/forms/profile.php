<div class="content-wrapper">
          <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Brand Update</h4>
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
                      <label for="exampleInputUsername1">Brand Name</label>
                      <input type="text" name="bname" value="<?php echo $brand->bname; ?>"  class="form-control" id="exampleInputUsername1" placeholder="Enter Brand Name">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Email </label>
                      <input type="email" name="email"  value="<?php echo $brand->email; ?>"  class="form-control" id="exampleInputEmail1" placeholder="Enter  Email">
                    </div>
					
					<div class="form-group">
                      <label for="exampleInputEmail1">Contact Number </label>
                      <input type="number" name="mobile"  value="<?php echo $brand->mobile; ?>" class="form-control" id="exampleInputEmail1" placeholder="Enter  Mobile Number">
                    </div>
					
					<div class="form-group">
                      <label for="exampleInputEmail1">Website Url </label>
                      <input type="text" name="web" value="<?php echo $brand->web; ?>"  class="form-control" id="exampleInputEmail1" placeholder="Enter  Website Url">
                    </div>
					<div class="form-group">
                     <label for="exampleInputUsername1">Overview</label>
                     <textarea id="summernoteExample" name="overview"><?php echo $brand->overview; ?></textarea>
                  </div>
				   <div class="row">
                    <div class="form-group col-md-6">
                        <label for="Profile">Brand Logo</label>
                        <input id="Profile" class="form-control" type="file" name="images">
						
                    </div>
					<?php if(!empty( $brand->images)) { ?>
					<div class="form-group mt-3 col-md-6">
                        
						<img src="<?php echo base_url();?>/uploads/brand/<?php echo $brand->images; ?>" style="width:10%;height: 100%;">
                    </div>
					<?php } else {} ?>
					</div>
					<div class="row">
					<div class="form-group col-md-6">
                        <label for="Profile">Brand Cover Image</label>
                        <input id="Profile" class="form-control" type="file" name="cover_image">
                    </div>
                    <?php if(!empty( $brand->cover_image)) { ?>
					<div class="form-group mt-3 col-md-6">
                        
						<img src="<?php echo base_url();?>/uploads/brand/<?php echo $brand->cover_image; ?>" style="width:10%;height: 100%;">
                    </div>
					<?php } else {} ?>
					</div>
                    <button name="submit" type="submit" class="btn btn-gradient-primary mr-2">Submit</button>
                    
                  </form>
                </div>
              </div>
            </div>
         
            
    
          </div>
        </div>