
		
        <div class="content-wrapper">
          <div class="row">
           
            <div class="col-12 col-sm-6 col-xl-3 grid-margin">
              <div class="card">
                <div class="card-body">
                  <div class="d-flex align-items-center justify-content-between">
                    <div>
                      <h4>Total Product</h4>
					   <?php 
							$brand_id =$this->session->userdata('bid');
							$brand = $this->db->get_where('product',array('brand' =>$brand_id ))->num_rows();
							?>
                      <h4 class="text-white mt-3"><?php echo $brand ?></h4>
                    </div>
                    <div class="icon-box icon-box-bg-image-danger">
                      <i class="ti-server gradient-card-icon"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
           <div class="col-12 col-sm-6 col-xl-3 grid-margin">
              <div class="card">
                <div class="card-body">
                  <div class="d-flex align-items-center justify-content-between">
                    <div>
                      <h4>Resellers</h4>
					  <?php 
							$brand_id =$this->session->userdata('bid');
							$resellers = $this->db->get_where('resellers',array('brand' =>$brand_id ))->num_rows();
							?>
                      <h4 class="text-white mt-3"><?php echo $resellers ?></h4>
                    </div>
                    <div class="icon-box icon-box-bg-image-info">
                      <i class="ti-shine"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
			<div class="col-12 col-sm-6 col-xl-3 grid-margin">
              <div class="card">
                <div class="card-body">
                  <div class="d-flex align-items-center justify-content-between">
                    <div>
                      <h4>Catalogue </h4>
					  <?php 
							$brand_id =$this->session->userdata('bid');
							$catalogue = $this->db->get_where('catalogue',array('brand' =>$brand_id ))->num_rows();
							?>
                      <h4 class="text-white mt-3"><?php echo $catalogue ?></h4>
                    </div>
                    <div class="icon-box icon-box-bg-image-warning">
                      <i class="ti-notepad"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
         
        </div>

      