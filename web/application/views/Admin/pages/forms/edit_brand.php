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
                     <label for="exampleInputUsername1">Category Name</label>
                     <select class="js-example-basic-multiple w-100" id="cat_value" multiple="multiple" name="categories[]" required>
                        <option value="">Select Category</option>
                        <?php 
                           $category = $this->db->get('categories')->result_array();
                           foreach($category as $cat) {
                           
                           ?>
                        <?php $cate=explode(",", $brand->categories);
                            ?>
						   
                        <option <?php if(in_array($cat['id'],$cate)) {?> selected <?php } else{} ?>  value="<?php echo $cat['id']; ?>"><?php echo $cat['cname']; ?></option>
                        <?php } ?>
                       
                     </select>
                  </div>
				  <div class="form-group">
                     <label for="exampleInputUsername1">Sub Category Name</label>
                     <select class="js-example-basic-multiple w-100" multiple="multiple" id="sub_cat_value" name="subcategories[]" required>
                         <option value="">Select Sub Category</option>
						 <?php 
							   $subcategories = $this->db->get('subcategories')->result_array();
							   foreach($subcategories as $sub_cat) {
						 ?>
						  <?php $subcate=explode(",", $brand->subcategories); ?>
                         
						 <option <?php if(in_array($sub_cat['id'],$subcate)) { ?> selected <?php } else{} ?>  value="<?php echo $sub_cat['id']; ?>"><?php echo $sub_cat['sname']; ?></option>
						 <?php } ?>
						
                     </select>
                  </div>
                  <div class="form-group">
                     <label for="exampleInputUsername1">Brand Name</label>
                     <input type="text" name="bname"  value="<?php echo $brand->bname; ?>" class="form-control" id="exampleInputUsername1" placeholder="Enter Brand Name">
                  </div>
                  <div class="form-group">
                     <label for="exampleInputEmail1">Email </label>
                     <input type="email" name="email"  value="<?php echo $brand->email; ?>"  class="form-control" id="exampleInputEmail1" placeholder="Enter  Email">
                  </div>
                  <div class="form-group">
                     <label for="exampleInputEmail1">Password </label>
                     <input type="password" name="password"   class="form-control" id="exampleInputEmail1" placeholder="Enter Password">
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
                     <label for="exampleInputEmail1">Location </label>
                     <input type="text" name="location" value="<?php echo $brand->location; ?>"  class="form-control" id="exampleInputEmail1" placeholder="Enter  Location">
                  </div>
                  <div class="form-group">
                     <label for="exampleInputEmail1">Address </label>
                     <input type="text" name="address" value="<?php echo $brand->address; ?>"  class="form-control" id="exampleInputEmail1" placeholder="Enter  Address">
                  </div>
                  <div class="form-group">
                     <label for="exampleInputUsername1">Overview</label>
                     <textarea id="summernoteExample" name="overview"><?php echo $brand->overview; ?></textarea>
                  </div>
                  <div class="form-group">
                     <label for="Profile">Brand Logo</label>
                     <input id="Profile" class="form-control" type="file" name="images">
                  </div>
                  <div class="form-group">
                     <label for="Profile">Brand Cover Image</label>
                     <input id="Profile" class="form-control" type="file" name="cover_image">
                  </div>
                  <button name="submit" type="submit" class="btn btn-gradient-primary mr-2">Submit</button>
               </form>
            </div>
         </div>
      </div>
   </div>
</div>