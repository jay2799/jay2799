     <div class="content-wrapper">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Color List</h4>
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
                            <th>Category</th>
							<th>Sub Category</th> 
                            <th>Color Name</th>
							<th>Image</th>
                            <th>Created Date</th>
                            <th>Actions</th>
                        </tr>
                      </thead>
                      <tbody>
					  
					  <?php 
							$no =0;
					  
							foreach($color as $co) { 
							
							$no=$no + 1;
							
					  ?>		
							
                        <tr>
                            <td><?php echo $no; ?></td>
							
							<?php $cat = $this->db->get_where('categories',array('id' => $co['cname'] ))->row_array(); ?>
                            <td><?php echo $cat['cname']; ?></td>
							
							<?php $sub_cat = $this->db->get_where('subcategories',array('id' => $co['sname'] ))->row_array(); ?>
							<td><?php echo $sub_cat['sname']; ?></td>
							
							<td><?php echo $co['name']; ?></td>
							
							
                          
                            <td>
							<?php if(!empty($co['images'])) { ?>
							<img src="<?php echo base_url();?>/uploads/color/<?php echo $co['images'];?>">
							<?php } else {} ?>
							
							</td>
							
                            <td><?php echo date("d-m-Y", strtotime($co['date']));?></td>
							
							
                            <td>
							
                              <a class="btn btn-outline-danger btn-fw" href="<?php echo base_url('admin/delete_color/').$co['id'];?>"><i class="ti-trash"></i></a>
							  
							  <a class="btn btn-outline-success btn-fw" href="<?php echo base_url('admin/edit_color/').$co['id'];?>"><i class="ti-pencil-alt"></i></a>
							  
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