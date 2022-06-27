     <div class="content-wrapper">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Banner List</h4>
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
                            <th>Banner Url</th>
                            <th>Image</th>
                            <th>Actions</th>
                        </tr>
                      </thead>
                      <tbody>
					  
					  <?php 
							$no =0;
					  
							foreach($banner as $ba) { 
							
							$no=$no + 1;
							
					  ?>		
							
                        <tr>
                            <td><?php echo $no; ?></td>
							
							<td><?php echo $ba['url']; ?></td>
							
                            <td>
							<?php if(!empty($ba['images'])) { ?>
							<img src="<?php echo base_url();?>/uploads/banner/<?php echo $ba['images'];?>">
							<?php } else {} ?>
							
							</td>
							
							
                            <td>
							
							  <a class="btn btn-outline-success btn-fw" href="<?php echo base_url('admin/edit_banner/').$ba['id'];?>"><i class="ti-pencil-alt"></i></a>
							  
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