<!DOCTYPE html>
<html lang="en">



<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Nexdee || Brand</title>
  <!-- base:css -->
  <link rel="stylesheet" href="<?php echo base_url();?>/admin_assets/vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="<?php echo base_url();?>/admin_assets/vendors/css/vendor.bundle.base.css">
  
  <link rel="stylesheet" href="<?php echo base_url();?>/admin_assets/css/layout/style.css">
  
   <link rel="stylesheet" href="<?php echo base_url();?>/admin_assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css">
   
   <link rel="stylesheet" href="<?php echo base_url();?>/admin_assets/vendors/select2/select2.min.css">
  <link rel="stylesheet" href="<?php echo base_url();?>/admin_assets/vendors/select2-bootstrap-theme/select2-bootstrap.min.css">
  
  
  <link rel="stylesheet" href="<?php echo base_url();?>/admin_assets/vendors/summernote/dist/summernote-bs4.css">
  <link rel="stylesheet" href="<?php echo base_url();?>/admin_assets/vendors/quill/quill.snow.css">
  <link rel="stylesheet" href="<?php echo base_url();?>/admin_assets/vendors/simplemde/simplemde.min.css">
   
  <!-- endinject -->
  <link rel="shortcut icon" href="<?php echo base_url();?>img/favicon.png" />
</head>
<body>
  <div class="container-scroller">
    <!-- partial:partials/_sidebar.html -->
    <nav class="sidebar sidebar-danger" id="sidebar">
      <div class="sidebar-content-wrapper sidebar-offcanvas">
        <ul class="nav">
          <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url('brand/index');?>">
              <i class="ti-home menu-icon"></i>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>
		  
		  <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#product" aria-expanded="false" aria-controls="product">
              <i class="ti-shopping-cart-full menu-icon"></i>
              <span class="menu-title">Products</span>
              <i class="ti-angle-down menu-arrow"></i>
            </a>
            <div class="collapse" id="product">
              <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="<?php echo base_url('brand/create_product');?>"> Add Product </a></li>
                  <li class="nav-item"> <a class="nav-link" href="<?php echo base_url('brand/product_list');?>">Product List  </a></li>
                  
              </ul>
            </div>
          </li>
		  
		  
		  <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#resellers" aria-expanded="false" aria-controls="resellers">
              <i class="ti-shine menu-icon"></i>
              <span class="menu-title">Resellers</span>
              <i class="ti-angle-down menu-arrow"></i>
            </a>
            <div class="collapse" id="resellers">
              <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="<?php echo base_url('brand/create_resellers');?>"> Add Resellers </a></li>
                  <li class="nav-item"> <a class="nav-link" href="<?php echo base_url('brand/resellers_list');?>">Resellers List  </a></li>
                  
              </ul>
            </div>
          </li>
		  
		  
		   <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#catalogue " aria-expanded="false" aria-controls="catalogue">
              <i class="ti-notepad menu-icon"></i>
              <span class="menu-title">Catalogue </span>
              <i class="ti-angle-down menu-arrow"></i>
            </a>
            <div class="collapse" id="catalogue">
              <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="<?php echo base_url('brand/create_catalogue');?>"> Add Catalogue  </a></li>
                  <li class="nav-item"> <a class="nav-link" href="<?php echo base_url('brand/catalogue_list');?>">Catalogue  List  </a></li>
                  
              </ul>
            </div>
          </li>
		  
		  
         
        </ul>
      </div>
    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
    
      <nav class="navbar p-0 d-flex flex-row">
        <div class="navbar-menu-wrapper d-flex align-items-center">
          <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="ti-align-left"></span>
          </button>
			<div class="navbar-brand-wrapper d-flex align-items-center justify-content-center">
			<?php 
				$brand_id =$this->session->userdata('bid');
				$brand = $this->db->get_where('brand',array('id' =>$brand_id ))->row_array();
			?>
            <h3 class="navbar-brand brand-logo text-white"><?php echo $brand['bname'];?></h3>
            <h3 class="navbar-brand brand-logo-mini text-white"><?php echo $brand['bname'];?></h3>
          </div>
          <ul class="navbar-nav navbar-nav-right ml-auto">
            
           
           
            <li class="nav-item nav-profile dropdown">
              <a class="nav-link" href="#" data-toggle="dropdown" id="profileDropdown">
			    <?php 
				$brand_id =$this->session->userdata('bid');
				$brand = $this->db->get_where('brand',array('id' =>$brand_id ))->row_array();
				?>
                <img src="<?php echo base_url();?>/uploads/brand/<?php echo $brand['images'];?>" alt="profile"/>
              </a>
              <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
                <a class="dropdown-item" href="<?php echo base_url('brand/brand_profile');?>" >
                  <i class="ti-settings text-primary"></i>
                  Settings
                </a>
				
				<a class="dropdown-item" href="<?php echo base_url('brand/change_password');?>" >
                  <i class="ti-settings text-primary"></i>
                  Change Password
                </a>
				
                <a class="dropdown-item" href="<?php echo base_url('brand/logout');?>">
                  <i class="ti-new-window text-primary"></i>
                  Logout
                </a>
              </div>
            </li>
          </ul>
          <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
            <span class="ti-menu"></span>
          </button>
		 
        </div>
      </nav> 
      <!-- partial -->
      <div class="main-panel">
    


