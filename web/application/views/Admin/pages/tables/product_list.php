     <div class="content-wrapper">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Product List</h4>
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
                            <th>Product Name</th>
                            <th>Category Name</th>
                            <th>Sub Category Name</th>
							<th>Brand Name</th>
							<th>Manufacture year</th>
							<th>Product Image</th>
                            <th>Created Date</th>
                            <th>Actions</th>
                        </tr>
                      </thead>
                      <tbody>
					  
					  <?php 
							$no =0;
					  
							foreach($product as $pro) { 
							
							$no=$no + 1;
							
					  ?>		
							
                        <tr>
						
                            <td><?php echo $no; ?></td>
							
                            <td><?php echo $pro['product_name']; ?></td>
							
							
							<?php $cat = $this->db->get_where('categories',array('id' => $pro['cname']))->row_array();?>
                            <td><?php echo $cat['cname']; ?></td>
							
							<?php $sub_cat = $this->db->get_where('subcategories',array('id' => $pro['sname']))->row_array();?>
                            <td><?php echo $sub_cat['sname']; ?></td>
							
							<?php $brand = $this->db->get_where('brand',array('id' => $pro['brand']))->row_array();?>
                            <td><?php echo $brand['bname']; ?></td>
							
                            <td><?php echo $pro['manufacture_year']; ?></td>
							
                            <td>

								<?php $images=explode(",", $pro['product_image']);
								foreach ($images as $key => $value) {
								?>
								
									<img src="<?php echo base_url();?>/uploads/product/<?php echo $value; ?>" alt="Image_not_found">
								
								<?php } ?>
								
							</td>
							
                            <td><?php echo date("d-m-Y", strtotime($pro['date']));?></td>
                            
							<td>
							
                              <a class="btn btn-outline-danger btn-fw" href="<?php echo base_url('admin/delete_product/').$pro['id'];?>"><i class="ti-trash"></i></a>
							  
							  <a class="btn btn-outline-success btn-fw" href="<?php echo base_url('admin/edit_product/').$pro['id'];?>"><i class="ti-pencil-alt"></i></a>
							  
							  <a class="btn btn-outline-warning btn-fw" href="<?php echo base_url('admin/copy_product/').$pro['id'];?>"><i class="ti-layers"></i></a>
							  
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