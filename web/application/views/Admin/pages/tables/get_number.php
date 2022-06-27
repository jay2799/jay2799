     <div class="content-wrapper">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Resellers Number Inquiry</h4>
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
                            <th>Resellers Name</th>
                            <th>User Name</th>
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