<div class="content-wrapper">
          <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Add Color</h4>
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
                      
					
						<select class="js-example-basic-single w-100" id="sid" name="cname" required>
						  <option value="">Select Category</option>
						  <?php 
						  
						  $category = $this->db->get('categories')->result_array();
						  foreach($category as $cat) {

						  ?>
						  <option <?php if($color['cname'] == $cat['id']) { ?> selected <?php } else {} ?>  value="<?php echo $cat['id']; ?>"><?php echo $cat['cname']; ?></option>
						  
						  <?php } ?>
						  
						</select>
					</div>
					
					
					<div class="form-group">
                      <label for="exampleInputUsername1">Sub Category Name</label>
                      
					
						<select class="js-example-basic-single w-100" id="did" name="sname" required >
						
						<option value="">Select Sub Category</option>
						  <?php 
						  
						  $subcategories = $this->db->get('subcategories')->result_array();
						  foreach($subcategories as $subcat) {

						  ?>
						  <option <?php if($color['sname'] == $subcat['id']) { ?> selected <?php } else {} ?>  value="<?php echo $subcat['id']; ?>"><?php echo $subcat['sname']; ?></option>
						  
						  <?php } ?>
						  
						</select>
					</div>

                    <div class="form-group">
                      <label for="exampleInputUsername1">Color Name</label>
                      <input type="text" name="name" value="<?php echo $color['name'];?>"  class="form-control" id="exampleInputUsername1" placeholder="Enter Color Name" required>
                    </div>
					
                    <div class="form-group">
                        <label for="Profile">Color Image</label>
                        <input id="Profile" class="form-control" type="file" name="images">
                    </div>
                    
                    <button name="submit" type="submit" class="btn btn-gradient-primary mr-2">Submit</button>
                    
                  </form>
                </div>
              </div>
            </div>
         
            
    
          </div>
        </div>