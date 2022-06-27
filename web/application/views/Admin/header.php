<!DOCTYPE html>
<html lang="en">



<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Nexdee || Admin</title>
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
  
    <link rel="stylesheet" href="<?php echo base_url();?>/admin_assets/vendors/font-awesome/css/font-awesome.min.css"/>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
   
  <link rel="stylesheet" href="<?php echo base_url();?>/admin_assets/vendors/jquery-bar-rating/bars-1to10.css">
  <link rel="stylesheet" href="<?php echo base_url();?>/admin_assets/vendors/jquery-bar-rating/bars-horizontal.css">
  <link rel="stylesheet" href="<?php echo base_url();?>/admin_assets/vendors/jquery-bar-rating/bars-movie.css">
  <link rel="stylesheet" href="<?php echo base_url();?>/admin_assets/vendors/jquery-bar-rating/bars-pill.css">
  <link rel="stylesheet" href="<?php echo base_url();?>/admin_assets/vendors/jquery-bar-rating/bars-reversed.css">
  <link rel="stylesheet" href="<?php echo base_url();?>/admin_assets/vendors/jquery-bar-rating/bars-square.css">
  <link rel="stylesheet" href="<?php echo base_url();?>/admin_assets/vendors/jquery-bar-rating/bootstrap-stars.css">
  <link rel="stylesheet" href="<?php echo base_url();?>/admin_assets/vendors/jquery-bar-rating/css-stars.css">
  <link rel="stylesheet" href="<?php echo base_url();?>/admin_assets/vendors/jquery-bar-rating/examples.css">
  <link rel="stylesheet" href="<?php echo base_url();?>/admin_assets/vendors/jquery-bar-rating/fontawesome-stars-o.css">
  <link rel="stylesheet" href="<?php echo base_url();?>/admin_assets/vendors/jquery-bar-rating/fontawesome-stars.css">
  <link rel="stylesheet" href="<?php echo base_url();?>/admin_assets/vendors/jquery-asColorPicker/css/asColorPicker.min.css">
  <link rel="stylesheet" href="<?php echo base_url();?>/admin_assets/vendors/x-editable/bootstrap-editable.css">
  <link rel="stylesheet" href="<?php echo base_url();?>/admin_assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css">
  <link rel="stylesheet" href="<?php echo base_url();?>/admin_assets/vendors/dropify/dropify.min.css">
  <link rel="stylesheet" href="<?php echo base_url();?>/admin_assets/vendors/jquery-file-upload/uploadfile.css">
  <link rel="stylesheet" href="<?php echo base_url();?>/admin_assets/vendors/jquery-tags-input/jquery.tagsinput.min.css">
  <link rel="stylesheet" href="<?php echo base_url();?>/admin_assets/vendors/tempusdominus-bootstrap-4/tempusdominus-bootstrap-4.min.css">
  <link rel="stylesheet" href="<?php echo base_url();?>/admin_assets/vendors/dropzone/dropzone.css">
   
   
   
   
   
   
   
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
            <a class="nav-link" href="<?php echo base_url('admin/index');?>">
              <i class="ti-home menu-icon"></i>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>
		  
		   <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#user" aria-expanded="false" aria-controls="user">
              <i class="ti-user menu-icon"></i>
              <span class="menu-title">User</span>
              <i class="ti-angle-down menu-arrow"></i>
            </a>
            <div class="collapse" id="user">
              <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="<?php echo base_url('admin/add_user'); ?>"> Add User </a></li>
                  <li class="nav-item"> <a class="nav-link" href="<?php echo base_url('admin/user_list'); ?>"> User List  </a></li>
                  
              </ul>
            </div>
          </li>
		  
		  
		  
		  <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-appsa" aria-expanded="false" aria-controls="ui-appsa">
              <i class="ti-user menu-icon"></i>
              <span class="menu-title">Sub Admin</span>
              <i class="ti-angle-down menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-appsa">
              <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="<?php echo base_url('admin/create_subadmin'); ?>"> Add Sub Admin </a></li>
                  <li class="nav-item"> <a class="nav-link" href="<?php echo base_url('admin/sub_admin'); ?>"> Sub Admin List  </a></li>
                  
              </ul>
            </div>
          </li>
		  
		  <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#brand" aria-expanded="false" aria-controls="brand">
              <i class="ti-server menu-icon"></i>
              <span class="menu-title">Brand Registration</span>
              <i class="ti-angle-down menu-arrow"></i>
            </a>
            <div class="collapse" id="brand">
              <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="<?php echo base_url('admin/create_brand'); ?>"> Add Brand </a></li>
                  <li class="nav-item"> <a class="nav-link" href="<?php echo base_url('admin/brand_list'); ?>"> Brand List  </a></li>
				  <li class="nav-item"> <a class="nav-link" href="<?php echo base_url('admin/catalogue_list'); ?>"> Catalogue List  </a></li>
				  <li class="nav-item"> <a class="nav-link" href="<?php echo base_url('admin/city_list'); ?>"> City List  </a></li>
                  <li class="nav-item"> <a class="nav-link" href="<?php echo base_url('admin/resellers_list'); ?>"> Resellers List  </a></li>
              </ul>
            </div>
          </li>
		  

		  
		  
		  <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#categories" aria-expanded="false" aria-controls="categories">
              <i class="ti-layout menu-icon"></i>
              <span class="menu-title">Categories</span>
              <i class="ti-angle-down menu-arrow"></i>
            </a>
            <div class="collapse" id="categories">
              <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="<?php echo base_url('admin/create_categories'); ?>"> Add Categories </a></li>
                  <li class="nav-item"> <a class="nav-link" href="<?php echo base_url('admin/get_all_categories'); ?>"> Categories List  </a></li>
                  
              </ul>
            </div>
          </li> 
		  
		  
		  
		   <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#subcategories" aria-expanded="false" aria-controls="subcategories">
              <i class="ti-layout menu-icon"></i>
              <span class="menu-title">Sub Categories</span>
              <i class="ti-angle-down menu-arrow"></i>
            </a>
            <div class="collapse" id="subcategories">
              <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="<?php echo base_url('admin/create_subcategories'); ?>"> Add Sub Categories </a></li>
                  <li class="nav-item"> <a class="nav-link" href="<?php echo base_url('admin/sub_categories_list'); ?>">Sub Categories List  </a></li>
                  
              </ul>
            </div>
          </li>
		  
		  
		  <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#product" aria-expanded="false" aria-controls="product">
              <i class="ti-shopping-cart-full menu-icon"></i>
              <span class="menu-title">Products</span>
              <i class="ti-angle-down menu-arrow"></i>
            </a>
            <div class="collapse" id="product">
              <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="<?php echo base_url('admin/create_product'); ?>"> Add Product </a></li>
                  <li class="nav-item"> <a class="nav-link" href="<?php echo base_url('admin/product_list'); ?>">Product List  </a></li>
                  
              </ul>
            </div>
          </li>
		  
		<!---  <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#color" aria-expanded="false" aria-controls="color">
              <i class="ti-palette menu-icon"></i>
              <span class="menu-title">Color</span>
              <i class="ti-angle-down menu-arrow"></i>
            </a>
            <div class="collapse" id="color">
              <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="<?php echo base_url('admin/add_color'); ?>"> Add Color</a></li>
                  <li class="nav-item"> <a class="nav-link" href="<?php echo base_url('admin/color_list'); ?>">Color List  </a></li>
                  
              </ul>
            </div>
          </li>--->
		  
		   <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#blog" aria-expanded="false" aria-controls="blog">
              <i class="ti-calendar menu-icon"></i>
              <span class="menu-title">Blogs</span>
              <i class="ti-angle-down menu-arrow"></i>
            </a>
            <div class="collapse" id="blog">
              <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="<?php echo base_url('admin/create_blog'); ?>"> Add Blogs</a></li>
                  <li class="nav-item"> <a class="nav-link" href="<?php echo base_url('admin/blog_list'); ?>">Blogs List  </a></li>
                  
              </ul>
            </div>
          </li>
		  
		  
		     <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#gallery" aria-expanded="false" aria-controls="gallery">
              <i class="ti-gallery menu-icon"></i>
              <span class="menu-title">Gallery</span>
              <i class="ti-angle-down menu-arrow"></i>
            </a>
            <div class="collapse" id="gallery">
              <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="<?php echo base_url('admin/create_gallery'); ?>"> Add Gallery</a></li>
                  <li class="nav-item"> <a class="nav-link" href="<?php echo base_url('admin/gallery_list'); ?>">Gallery List  </a></li>
                  
              </ul>
            </div>
          </li>
		 

		     <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#slider" aria-expanded="false" aria-controls="slider">
              <i class="ti-camera menu-icon"></i>
              <span class="menu-title">Slider</span>
              <i class="ti-angle-down menu-arrow"></i>
            </a>
            <div class="collapse" id="slider">
              <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="<?php echo base_url('admin/create_slider'); ?>"> Add Slider</a></li>
                  <li class="nav-item"> <a class="nav-link" href="<?php echo base_url('admin/slider_list'); ?>">Slider List  </a></li>
                  
              </ul>
            </div>
          </li>
		  
		   <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url('admin/banner_list');?>">
              <i class="ti-gallery menu-icon"></i>
              <span class="menu-title">Banner</span>
            </a>
          </li>
		  
		  
		  <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url('admin/design_list');?>">
              <i class="ti-image menu-icon"></i>
              <span class="menu-title">Design</span>
            </a>
          </li>
		  
		  <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url('admin/ads_list');?>">
              <i class="ti-wand menu-icon"></i>
              <span class="menu-title">Ads</span>
            </a>
          </li>
		  
		   <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#filter" aria-expanded="false" aria-controls="filter">
              <i class="ti-filter menu-icon"></i>
              <span class="menu-title">Filter</span>
              <i class="ti-angle-down menu-arrow"></i>
            </a>
            <div class="collapse" id="filter">
              <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="<?php echo base_url('admin/installation'); ?>">Installation</a></li>
                  <li class="nav-item"> <a class="nav-link" href="<?php echo base_url('admin/application'); ?>">Application  </a></li>
                  <li class="nav-item"> <a class="nav-link" href="<?php echo base_url('admin/material'); ?>">Material  </a></li>
                  <li class="nav-item"> <a class="nav-link" href="<?php echo base_url('admin/shape'); ?>">Shape  </a></li>
                  <li class="nav-item"> <a class="nav-link" href="<?php echo base_url('admin/effects'); ?>">Effects</a></li>
                  <li class="nav-item"> <a class="nav-link" href="<?php echo base_url('admin/finish'); ?>">Finish</a></li>
                  <li class="nav-item"> <a class="nav-link" href="<?php echo base_url('admin/size'); ?>">Size</a></li>
                  <li class="nav-item"> <a class="nav-link" href="<?php echo base_url('admin/thickness'); ?>">Thickness</a></li>
                  <li class="nav-item"> <a class="nav-link" href="<?php echo base_url('admin/type'); ?>">Type</a></li>
                  <li class="nav-item"> <a class="nav-link" href="<?php echo base_url('admin/themes'); ?>">Themes</a></li>
                  <li class="nav-item"> <a class="nav-link" href="<?php echo base_url('admin/light_bulb_type'); ?>">Light Bulb Type</a></li>
                  <li class="nav-item"> <a class="nav-link" href="<?php echo base_url('admin/number_of_seat'); ?>">Number Of Seat</a></li>
                  <li class="nav-item"> <a class="nav-link" href="<?php echo base_url('admin/bed_size'); ?>">Bed Size</a></li>
                  <li class="nav-item"> <a class="nav-link" href="<?php echo base_url('admin/bowl'); ?>">Bowl</a></li>
				  <li class="nav-item"> <a class="nav-link" href="<?php echo base_url('admin/add_color'); ?>">Color</a></li>
                  
              </ul>
            </div>
          </li>
		  
		  
		  <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url('admin/get_number');?>">
              <i class="ti-mobile menu-icon"></i>
              <span class="menu-title">Resellers Number Inquiry</span>
            </a>
          </li>
		  
		  
		  <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url('admin/brand_request');?>">
              <i class="ti-mobile menu-icon"></i>
              <span class="menu-title">Brand Request Inquiry</span>
            </a>
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
        
          <ul class="navbar-nav navbar-nav-right ml-auto">
            
           
           
            <li class="nav-item nav-profile dropdown">
              <a class="nav-link" href="#" data-toggle="dropdown" id="profileDropdown">
			    <?php 
				$admin_id =$this->session->userdata('aid');
				$admin = $this->db->get_where('admin',array('id' =>$admin_id ))->row_array();
				?>
                <img src="<?php echo base_url();?>/uploads/admin/<?php echo $admin['images'];?>" alt="profile"/>
              </a>
              <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
                <a class="dropdown-item" href="<?php echo base_url('admin/admin_profile');?>" >
                  <i class="ti-settings text-primary"></i>
                  Settings
                </a>
				
				<a class="dropdown-item" href="<?php echo base_url('admin/change_password');?>" >
                  <i class="ti-settings text-primary"></i>
                  Change Password
                </a>
				
                <a class="dropdown-item" href="<?php echo base_url('admin/logout');?>">
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
    


