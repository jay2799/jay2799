     <div class="content-wrapper">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Catalogue List</h4>
			 
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
                            <th>Catalogue Title</th>
                            <th>Catalogue Thumbnail Image</th>
							<th>Catalogue Pdf</th>
							<th>Created Date</th>
                            <th>Actions</th>
                        </tr>
                      </thead>
                      <tbody>
					  
					  <?php 
							$no =0;
					  
							foreach($catalogue as $cata) { 
							
							$no=$no + 1;
							
					  ?>		
							
                        <tr>
                            <td><?php echo $no; ?></td>
							
                            <td>
							
							<?php $brand = $this->db->get_where('brand',array('id' => $cata['brand']))->row_array(); ?>
							<?php echo $brand['bname']; ?>
							
							</td>
							
                            <td><?php echo $cata['title']; ?></td>
							
                            
							
							<td>
								<?php if(!empty($cata['images'])) { ?>
								<img src="<?php echo base_url(); ?>/uploads/catalogue/<?php echo  $cata['images']; ?>">
								<?php } else {} ?>
							</td>
							
							<td>
							    <?php if(!empty($cata['pdf'])) { ?>
								<a class="btn btn-outline-primary btn-fw" target="_blank" href="<?php echo base_url(); ?>/uploads/catalogue/<?php echo  $cata['pdf']; ?>"><i class="ti-file"></i></a>
								<?php } else {} ?>
							</td>
							
							
                            <td><?php echo date("d-m-Y", strtotime($cata['date']));?></td>
							
							
                            <td>
							
                              <a class="btn btn-outline-danger btn-fw" href="<?php echo base_url('brand/delete_catalogue/').$cata['id'];?>"><i class="ti-trash"></i></a>
							  
							  <a class="btn btn-outline-success btn-fw" href="<?php echo base_url('brand/edit_catalogue/').$cata['id'];?>"><i class="ti-pencil-alt"></i></a>
							  
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