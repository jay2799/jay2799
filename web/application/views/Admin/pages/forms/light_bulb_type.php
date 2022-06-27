<?php error_reporting('0'); ?>
<div class="content-wrapper">
          <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  
                 <?php
				  $light_bulb_type= $this->session->flashdata('light_bulb_type');
				  $error_msg= $this->session->flashdata('error_msg');

				  if($light_bulb_type){
					?>
					<div class="alert alert-success" role="alert">
						<?php echo $light_bulb_type; ?>
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
				
                  <form class="forms-sample" method="POST" action="<?php echo base_url('admin/update_l_b_t'); ?>" enctype="multipart/form-data">
                    <div class="form-group">
                     <label for="exampleInputUsername1">Category Name</label>
                     <select class="js-example-basic-multiple w-100" id="cat_value" multiple="multiple" name="categories[]" required>
                        <option value="">Select Category</option>
						<?php $filter = $this->db->get_where('filter',array('id' =>11))->row_array();?>
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
						 <?php $filter = $this->db->get_where('filter',array('id' =>11))->row_array();?>
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
               <h4 class="card-title">Light Bulb Type</h4>
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
                        <?php $cate=explode(",", $lig->cat); ?> 
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
                        <?php $subcate=explode(",", $lig->sub_cat); ?>
                        <option <?php if(in_array($sub_cat['id'],$subcate)) { ?> selected <?php } else{} ?>  value="<?php echo $sub_cat['id']; ?>"><?php echo $sub_cat['sname']; ?></option>
                        <?php } ?>
                     </select>
                  </div>
                  <div class="form-group">
                     <label for="exampleInputUsername1">Light Bulb Type</label>
                     <input type="text" name="light_bulb" value="<?php echo $lig->light_bulb; ?>"  class="form-control" id="exampleInputUsername1" placeholder="Enter Light Bulb Type">
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
         <h4 class="card-title">Light Bulb Type List</h4>
         <div class="row">
            <div class="col-12">
               <div class="table-responsive">
                  <table id="order-listing" class="table">
                     <thead>
                        <tr>
                           <th>No #</th>
                           <th>Light Bulb Type</th>
						   <th>Category Name</th>
                           <th>Sub Category Name</th>
                           <th>Actions</th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php 
                           $no =0;
                           
                           foreach($light_bulb as $li) { 
                           
                           $no=$no + 1;
                           
                           ?>		
                        <tr>
                           <td><?php echo $no; ?></td>
                           <td><?php echo $li['light_bulb'];?></td>
						   <td>
                              <?php if(!empty($li['cat'])) { ?>
                              <?php $categories=explode(",", $li['cat']);
                                 foreach ($categories as $key => $cat) {
                                 $cat_name = $this->db->get_where('categories',array('id' => $cat))->row_array();	
                                    ?>
                              <?php echo $cat_name['cname'];?>,
                              <?php } } ?>
                           </td>
                           <td>
                              <?php if(!empty($li['sub_cat'])) { ?> 
                              <?php $subcategories=explode(",", $li['sub_cat']);
                                 foreach ($subcategories as $key => $sub) {
                                 $sub_name = $this->db->get_where('subcategories',array('id' => $sub))->row_array();	
                                    ?>
                              <?php echo $sub_name['sname'];?>,
                              <?php }} ?>
                           </td>
                           <td>
                              <a class="btn btn-outline-danger btn-fw" href="<?php echo base_url('admin/delete_light_bulb_type/').$li['id'];?>"><i class="ti-trash"></i></a>
                              <a class="btn btn-outline-success btn-fw" href="<?php echo base_url('admin/edit_light_bulb_type/').$li['id'];?>"><i class="ti-pencil-alt"></i></a>
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