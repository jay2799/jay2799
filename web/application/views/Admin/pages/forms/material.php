<?php error_reporting('0'); ?>
<div class="content-wrapper">
          <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  
                 <?php
				  $materiala= $this->session->flashdata('material');
				  $error_msg= $this->session->flashdata('error_msg');

				  if($materiala){
					?>
					<div class="alert alert-success" role="alert">
						<?php echo $materiala; ?>
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
				
                  <form class="forms-sample" method="POST" action="<?php echo base_url('admin/update_material'); ?>" enctype="multipart/form-data">
                    <div class="form-group">
                     <label for="exampleInputUsername1">Category Name</label>
                     <select class="js-example-basic-multiple w-100" id="cat_value" multiple="multiple" name="categories[]" required>
                        <option value="">Select Category</option>
						<?php $filter = $this->db->get_where('filter',array('id' =>3))->row_array();?>
                        <?php 
                           $category = $this->db->get('categories')->result_array();
                           foreach($category as $cat) {
                           
                           ?>
                        <?php $cate=explode(",", $filter['cat']);
                            ?>
						   
                        <option <?php if(in_array($cat['id'],$cate)) {?> selected <?php } else{} ?>  value="<?php echo $cat['id']; ?>"><?php echo $cat['cname']; ?></option>
                        <?php } ?>
                     </select>
                  </div>
				  
				   <div class="form-group">
                     <label for="exampleInputUsername1">Sub Category Name</label>
                     <select class="js-example-basic-multiple w-100" multiple="multiple" id="sub_cat_value" name="subcategories[]" required>
                         <option value="">Select Sub Category</option>
						 <?php $filter = $this->db->get_where('filter',array('id' =>3))->row_array();?>
						 <?php 
							   $subcategories = $this->db->get('subcategories')->result_array();
							   foreach($subcategories as $sub_cat) {
						 ?>
						  <?php $subcate=explode(",", $filter['sub_cat']); ?>
                         
						 <option <?php if(in_array($sub_cat['id'],$subcate)) { ?> selected <?php } else{} ?>  value="<?php echo $sub_cat['id']; ?>"><?php echo $sub_cat['sname']; ?></option>
						 <?php } ?>
						
                     </select>
                  </div>
                
                    
                    <button name="submit" type="submit" class="btn btn-gradient-primary mr-2">Submit</button>
                    
                  </form>
                </div>
              </div>
            </div>
         
            
    
          </div>
        </div>


<div class="content-wrapper">
          <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Material</h4>
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
                     <select class="js-example-basic-multiple w-100" id="new_cat" multiple="multiple" name="cat[]" required>
                        <option value="">Select Category</option>
                        <?php 
                           $category = $this->db->get('categories')->result_array();
                           foreach($category as $cat) {
                           
                           ?>
                        <?php $cate=explode(",", $mate->cat); ?> 
                        <option <?php if(in_array($cat['id'],$cate)) {?> selected <?php } else{} ?>   value="<?php echo $cat['id']; ?>"><?php echo $cat['cname']; ?></option>
                        <?php } ?>
                     </select>
                  </div>
                  <div class="form-group">
                     <label for="exampleInputUsername1">Sub Category Name</label>
                     <select class="js-example-basic-multiple w-100" multiple="multiple" id="new_sub" name="sub_cat[]" required>
                        <option value="">Select Sub Category</option>
                        <?php 
                           $subcategories = $this->db->get('subcategories')->result_array();
                           foreach($subcategories as $sub_cat) {
                           ?>
                        <?php $subcate=explode(",", $mate->sub_cat); ?>
                        <option <?php if(in_array($sub_cat['id'],$subcate)) { ?> selected <?php } else{} ?>  value="<?php echo $sub_cat['id']; ?>"><?php echo $sub_cat['sname']; ?></option>
                        <?php } ?>
                     </select>
                  </div>
                    <div class="form-group">
                      <label for="exampleInputUsername1">Material Name</label>
                      <input type="text" name="material" value="<?php echo $mate->material; ?>"  class="form-control" id="exampleInputUsername1" placeholder="Enter Material Name">
                    </div>
                
                    
                    <button name="submit" type="submit" class="btn btn-gradient-primary mr-2">Submit</button>
                    
                  </form>
                </div>
              </div>
            </div>
         
            
    
          </div>
        </div>
		
		     <div class="content-wrapper">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Material List</h4>
			
              <div class="row">
                <div class="col-12">
                  <div class="table-responsive">
                    <table id="order-listing" class="table">
                      <thead>
                        <tr>
                            <th>No #</th>
                            <th>Material Name</th>
							<th>Category Name</th>
							<th>Sub Category Name</th>
                            <th>Actions</th>
                        </tr>
                      </thead>
                      <tbody>
					  
					  <?php 
							$no =0;
					  
							foreach($material as $mat) { 
							
							$no=$no + 1;
							
					  ?>		
							
                        <tr>
                            <td><?php echo $no; ?></td>
							                                      						
                           
							
                            <td><?php echo $mat['material'];?></td>
							
							<td>
                              <?php if(!empty($mat['cat'])) { ?>
                              <?php $categories=explode(",", $mat['cat']);
                                 foreach ($categories as $key => $cat) {
                                 $cat_name = $this->db->get_where('categories',array('id' => $cat))->row_array();	
                                    ?>
                              <?php echo $cat_name['cname'];?>,
                              <?php } } ?>
                           </td>
                           <td>
                              <?php if(!empty($mat['sub_cat'])) { ?> 
                              <?php $subcategories=explode(",", $mat['sub_cat']);
                                 foreach ($subcategories as $key => $sub) {
                                 $sub_name = $this->db->get_where('subcategories',array('id' => $sub))->row_array();	
                                    ?>
                              <?php echo $sub_name['sname'];?>,
                              <?php }} ?>
                           </td>
							
                            <td>
							
                              <a class="btn btn-outline-danger btn-fw" href="<?php echo base_url('admin/delete_material/').$mat['id'];?>"><i class="ti-trash"></i></a>
							  
							  <a class="btn btn-outline-success btn-fw" href="<?php echo base_url('admin/edit_material/').$mat['id'];?>"><i class="ti-pencil-alt"></i></a>
							  						  
							  </td>
                        </tr>
					 <?php } ?> 
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>