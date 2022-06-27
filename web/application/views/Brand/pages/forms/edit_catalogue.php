<style>
input#brand {
    background: #80808073;
    color: #fff;
}
</style>
<div class="content-wrapper">
          <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Catalogue Upload</h4>
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
                  <form class="forms-sample" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                      <label for="exampleInputUsername1">Brand Name</label>
                      <?php  $brand_id = $this->session->userdata('bid');
					  
							$brand = $this->db->get_where('brand',array('id' => $brand_id))->row_array();?>
								
                     <input type="text" value="<?php echo $brand['bname']; ?>"  class="form-control" id="brand" readonly>
                     <input type="hidden" name="brand" value="<?php echo $brand['id']; ?>"  class="form-control" id="brand" readonly>
					</div>
					<div class="form-group">
                      <label for="exampleInputUsername1">Catalogue Title</label>
                      <input type="text" name="title" value="<?php echo $catalogue->title; ?>"  class="form-control" id="exampleInputUsername1" placeholder="Enter Catalogue Title">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputUsername1">Catalogue Thumbnail Image</label>
                      <input type="file" name="images"  class="form-control" id="exampleInputUsername1" >
                    </div>
					
                    <div class="form-group">
                        <label for="Profile">Catalogue Pdf</label>
                        <input id="Profile" class="form-control" type="file" name="pdf">
                    </div>
                    
                    <button name="submit" type="submit" class="btn btn-gradient-primary mr-2">Submit</button>
                    
                  </form>
                </div>
              </div>
            </div>
         
            
    
          </div>
        </div>