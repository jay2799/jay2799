     <div class="content-wrapper">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Ads List</h4>
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
                            <th>Url</th>
                            <th>Image</th>
                            <th>Actions</th>
                        </tr>
                      </thead>
                      <tbody>
					  
					  <?php 
							$no =0;
					  
							foreach($ads as $ad) { 
							
							$no=$no + 1;
							
					  ?>		
							
                        <tr>
                            <td><?php echo $no; ?></td>
							
                          						
                            <td> <a class="btn btn-outline-secondary btn-rounded btn-icon" target="_blank" href="<?php echo $ad['url']; ?>" style="padding:11px;"><i class="ti-world"></i></a></td>
							
							<td>
							<?php if(!empty($ad['images'])) { ?>
							<img src="<?php echo base_url();?>/uploads/ads/<?php echo $ad['images'];?>">
							<?php } else {} ?>
							
							
                            <td>
							
							  <a class="btn btn-outline-success btn-fw" href="<?php echo base_url('admin/edit_ads/').$ad['id'];?>"><i class="ti-pencil-alt"></i></a>
							  
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