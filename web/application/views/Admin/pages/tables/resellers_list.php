     <div class="content-wrapper">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Resellers List</h4>
			  <a class="btn btn-gradient-warning mb-3" href="<?php echo base_url('admin/create_resellers'); ?>" >Add Resellers</a>
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
                            <th>Resellers Name</th>
                            <th>Address</th>
							<th>City</th>
							<th>Contact Number</th>
							<th>Created Date</th>
                            <th>Actions</th>
                        </tr>
                      </thead>
                      <tbody>
					  
					  <?php 
							$no =0;
					  
							foreach($resellers as $re) { 
							
							$no=$no + 1;
							
					  ?>		
							
                        <tr>
                            <td><?php echo $no; ?></td>
							
                            <td>
								<?php $brand = $this->db->get_where('brand',array('id' => $re['brand']))->row_array();?>
								<?php echo $brand['bname']; ?>
							
							</td>
							
                            <td><?php echo $re['name']; ?></td>
							
                            <td><?php echo $re['address']; ?></td>
							
							<?php $city = $this->db->get_where('city',array('id' => $re['city']))->row_array();?>
							<td><?php echo $city['city']; ?></td>
							
							<td><?php echo $re['contact']; ?></td>
							
							
                            <td><?php echo date("d-m-Y", strtotime($re['date']));?></td>
							
							
                            <td>
							
                              <a class="btn btn-outline-danger btn-fw" href="<?php echo base_url('admin/delete_resellers/').$re['id'];?>"><i class="ti-trash"></i></a>
							  
							  <a class="btn btn-outline-success btn-fw" href="<?php echo base_url('admin/edit_resellers/').$re['id'];?>"><i class="ti-pencil-alt"></i></a>
							  
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