     <div class="content-wrapper">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Sub Admin List</h4>
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
              <div class="row">
                <div class="col-12">
                  <div class="table-responsive">
                    <table id="order-listing" class="table">
                      <thead>
                        <tr>
                            <th>No #</th>
                            <th>Brand Name</th>
                            <th>Category Name</th>
                            <th>Sub Category Name</th>
                            <th>Email Id</th>
                            <th>Mobile</th>
							<th>Website</th>
							<th>Location</th>
							<th>Address</th>
                            <th>Image</th>
                            <th>Cover Image</th>
							<th>Product</th>
                            <th>Created Date</th>
                            <th>Actions</th>
                        </tr>
                      </thead>
                      <tbody>
					  
					  <?php 
							$no =0;
					  
							foreach($brand_list as $brand) { 
							
							$no=$no + 1;
							
					  ?>		
							
                        <tr>
                            <td><?php echo $no; ?></td>
							
                            <td><?php echo $brand['bname']; ?></td>
							
							
                            <td>
								<?php if(!empty($brand['categories'])) { ?>
								<?php $categories=explode(",", $brand['categories']);
								foreach ($categories as $key => $cat) {
								$cat_name = $this->db->get_where('categories',array('id' => $cat))->row_array();	
							    ?>
								
								<?php echo $cat_name['cname'];?>,
								
								<?php } } ?>
								
							</td>
							
							
                            <td>
								<?php if(!empty($brand['subcategories'])) { ?>
								<?php $subcategories=explode(",", $brand['subcategories']);
								foreach ($subcategories as $key => $sub) {
								$sub_name = $this->db->get_where('subcategories',array('id' => $sub))->row_array();	
							    ?>
								
								<?php echo $sub_name['sname'];?>,
								
								<?php }} ?>
								
							</td>
							
                            <td><?php echo $brand['email']; ?></td>
							
                            <td><?php echo $brand['mobile']; ?></td>
							
							<td> <a class="btn btn-outline-secondary btn-rounded btn-icon" target="_blank" href="<?php echo $brand['web']; ?>" style="padding:11px;"><i class="ti-world"></i></a></td>
							
							<td><?php echo $brand['location']; ?></td>
							
							<td><?php echo  substr($brand['address'], 0, 25) ?></td>
							
                            <td>
							<?php if(!empty($brand['images'])) { ?>
							<img src="<?php echo base_url();?>/uploads/brand/<?php echo $brand['images'];?>">
							<?php } else {} ?>
							
							</td>
							
							
							<td>
							<?php if(!empty($brand['cover_image'])) { ?>
							<img src="<?php echo base_url();?>/uploads/brand/<?php echo $brand['cover_image'];?>">
							<?php } else {} ?>
							
							</td>
							
							<td><a  href="<?php echo base_url('admin/brand_wise_product/').$brand['id'];?>" class="btn btn-outline-secondary btn-rounded btn-icon" style="padding:11px;">
									<i class="ti-eye text-danger"></i>
								  </a></td>
							
                            <td><?php echo date("d-m-Y", strtotime($brand['date']));?></td>
							
							
                            <td>
							
                              <a class="btn btn-outline-danger btn-fw" href="<?php echo base_url('admin/delete_brand/').$brand['id'];?>"><i class="ti-trash"></i></a>
							  
							  <a class="btn btn-outline-success btn-fw" href="<?php echo base_url('admin/edit_brand/').$brand['id'];?>"><i class="ti-pencil-alt"></i></a>
							  
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