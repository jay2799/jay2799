     <div class="content-wrapper">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Brand Request Inquiry</h4>
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
                            <th>User Name</th>
                            <th>Brand Name</th>
                            <th>Product Name</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Proffasion</th>
                            <th>Compny</th>
                            <th>City</th>
                            <th>Post Code</th>
                            <th>Address</th>
                            <th>Mobile No.</th>
                            <th>Message</th>
                            <th>Inquiry Date</th>
                            
                        </tr>
                      </thead>
                      <tbody>
					  
					  <?php 
							$no =0;
					  
							foreach($number as $nu) { 
							
							$no=$no + 1;
							
					  ?>		
							
                        <tr>
                            <td><?php echo $no; ?></td>
							
							<?php  $re = $this->db->get_where('resellers',array('id' =>$nu['resellers_id']))->row_array(); ?>
                            <td><?php echo $re['name']; ?></td>
							
							<?php  $ue = $this->db->get_where('user',array('id' =>$nu['user_id']))->row_array(); ?>
                            <td><?php echo $ue['name']; ?></td>
							
                            <td><?php echo date("d-m-Y", strtotime($nu['date']));?></td>
							
                            
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