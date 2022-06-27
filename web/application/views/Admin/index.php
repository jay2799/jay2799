
     
        <div class="content-wrapper">
          <div class="row">
            <div class="col-12 col-sm-6 col-xl-3 grid-margin">
              <div class="card">
                <div class="card-body">
                  <div class="d-flex align-items-center justify-content-between">
                    <div>
                      <h4>Users</h4>
                      <h4 class="text-white mt-3"><?php echo $user = $this->db->get('user')->num_rows();?></h4>
                    </div>
                    <div class="icon-box icon-box-bg-image-warning">
                      <i class="fa fa-users"></i>
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
                      <h4>Sub Admin </h4>
                      <h4 class="text-white mt-3"><?php echo $sub_admin = $this->db->get_where('admin',array('role' => 0))->num_rows();?></h4>
                    </div>
                    <div class="icon-box icon-box-bg-image-info">
                      <i class="ti-face-smile"></i>
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
                      <h4>Brand</h4>
                      <h4 class="text-white mt-3"><?php echo $brand = $this->db->get('brand')->num_rows();?></h4>
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
                      <h4>Categories</h4>
                      <h4 class="text-white mt-3"><?php echo $Categories = $this->db->get('categories')->num_rows();?></h4>
                    </div>
                    <div class="icon-box icon-box-bg-image-success">
                      <i class="ti-layout gradient-card-icon"></i>
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
                      <h4> Sub Categories</h4>
                      <h4 class="text-white mt-3"><?php echo $Sub  = $this->db->get('subcategories')->num_rows();?></h4>
                    </div>
                    <div class="icon-box icon-box-bg-image-success">
                      <i class="ti-layout gradient-card-icon"></i>
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
                      <h4>Blogs</h4>
                      <h4 class="text-white mt-3"><?php echo $blog = $this->db->get('blog')->num_rows();?></h4>
                    </div>
                    <div class="icon-box icon-box-bg-image-warning">
                      <i class="ti-calendar "></i>
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
                      <h4>Gallery </h4>
                      <h4 class="text-white mt-3"><?php echo $gallery = $this->db->get('gallery')->num_rows();?></h4>
                    </div>
                    <div class="icon-box icon-box-bg-image-info">
                      <i class="ti-gallery"></i>
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
                      <h4>Slider</h4>
                      <h4 class="text-white mt-3"><?php echo $Slider = $this->db->get('slider')->num_rows();?></h4>
                    </div>
                    <div class="icon-box icon-box-bg-image-danger">
                      <i class="ti-camera gradient-card-icon"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
         
        </div>
