     <div class="content-wrapper">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Slider List</h4>
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
                            <th>Images</th>
                            <th>Url</th>
                            <th>Created Date</th>
                            <th>Actions</th>
                        </tr>
                      </thead>
                      <tbody>
					  
					  <?php 
							$no =0;
					  
							foreach($slider as $sli) { 
							
							$no=$no + 1;
							
					  ?>		
							
                        <tr>
                            <td><?php echo $no; ?></td>
							                                      						
                            <td>
							<?php if(!empty($sli['images'])) { ?>
							<img src="<?php echo base_url();?>/uploads/slider/<?php echo $sli['images'];?>">
							<?php } else {} ?>
							
							</td>
							
							<td><?php echo $sli['url'];?></td>
							
                            <td><?php echo date("d-m-Y", strtotime($sli['date']));?></td>
							
							
                            <td>
							
                              <a class="btn btn-outline-danger btn-fw" href="<?php echo base_url('admin/delete_slider/').$sli['id'];?>"><i class="ti-trash"></i></a>
							  
							  
							  
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