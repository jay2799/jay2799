<div class="content-wrapper">
          <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Sub Category Create</h4>
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
                      <label for="exampleInputUsername1">Category Name</label>
                      
					
						<select class="js-example-basic-single w-100" name="cname" >
						  <option value="">Select Category</option>
						  <?php 
						  
						  $category = $this->db->get('categories')->result_array();
						  foreach($category as $cat) {

						  ?>
						  <option value="<?php echo $cat['id']; ?>"><?php echo $cat['cname']; ?></option>
						  
						  <?php } ?>
						  
						</select>
					</div>

                    <div class="form-group">
                      <label for="exampleInputUsername1">Sub Category Name</label>
                      <input type="text" name="sname"  class="form-control" id="exampleInputUsername1" placeholder="Enter Sub Category Name">
                    </div>
					
                    <div class="form-group">
                        <label for="Profile">Category Image</label>
                        <input id="Profile" class="form-control" type="file" name="images">
                    </div>
                    
                    <button name="submit" type="submit" class="btn btn-gradient-primary mr-2">Submit</button>
                    
                  </form>
                </div>
              </div>
            </div>
         
            
    
          </div>
        </div>