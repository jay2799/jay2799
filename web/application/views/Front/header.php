<!DOCTYPE html>
<html lang="en">
   <head>
      <!-- Required Meta -->
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <!-- Title For This Document -->
      <title> Nexdee </title>
      <!-- Favicon For This Document -->
      <link rel="shortcut icon" href="<?php echo base_url();?>assets/img/favicon.png" type="image/x-icon">
      <!-- Bootstrap 5 Css -->
      <link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap.5.1.1.min.css">
      <!-- Google fonts -->
      <link
         href="https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@300;400;500;600;700&amp;family=Roboto:wght@300;400;500;700&amp;display=swap"
         rel="stylesheet">
      <!-- FlatIcon Css -->
      <link rel="stylesheet" href="<?php echo base_url();?>assets/fonts/flaticon.css">
      <!-- Slick Slider Css -->
      <link rel="stylesheet" href="<?php echo base_url();?>assets/css/plugin/slick.css">
      <!--  Ui Tabs Css -->
      <link rel="stylesheet" href="<?php echo base_url();?>assets/css/plugin/jquery-ui.min.css">
      <!-- Magnific-popup Css -->
      <link rel="stylesheet" href="<?php echo base_url();?>assets/css/plugin/magnific-popup.css">
      <!-- Nice Select Css -->
      <link rel="stylesheet" href="<?php echo base_url();?>assets/css/plugin/nice-select.v1.0.css">
      <!-- Animate Css -->
      <link rel="stylesheet" href="<?php echo base_url();?>assets/css/plugin/animate.css">
      <!-- Style Css -->
      <link rel="stylesheet" href="<?php echo base_url();?>assets/css/style.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
      <link rel="preconnect" href="https://fonts.googleapis.com">
      <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
      <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400&family=Jost:wght@300&family=Pacifico&family=Poppins:wght@200&family=Roboto+Slab:wght@100&display=swap" rel="stylesheet">
   </head>
   <body class="jewellery">
      <!-- ==========Preloader========== -->
      <!-- <div class="loader"><span>Karte...</span></div> -->
      <!-- ==========Preloader========== -->
      <!--===scroll bottom to top===--> <a href="#0" class="scrollToTop"><i class="flaticon-up-arrow"></i></a>
      <!--===scroll bottom to top===-->
      <!-- header-default -->
      <header class="header-default">
         <!-- Start Desktop Menu -->
         <div class="menubox">
            <div class="top-info d-flex">
               <div class="container">
                  <div class="row g-0 ">
                     <div class="col-12">
                        <div class="top-info__top-content d-flex align-items-center justify-content-between">
                           <div class="medio-boxx">
                              <ul>
                                 <li> <a href="#" class="Publish">Publish you products</a> </li>
                                 <li> <a href="#" class="Publish" >Advertise</a> </li>
                              </ul>
                           </div>
                           <div class="middle">
                              <a href="<?php echo base_url();?>">
                              <img src="<?php echo base_url();?>assets/img/black_logo.png" alt="">
                              </a>  
                           </div>
                           <div class=" d-flex align-items-center signa ">
                              <?php
                                 $user_id =  $this->session->userdata('user_id');
                                 if(!empty($user_id )) {
                                 
                                 ?>
                              <a href="<?php echo base_url('wishlist') ?>" ><img src="<?php echo base_url();?>assets/img/Union.png" ></a> 
                              <div class="language currency">
                                 <select>
                                    <?php $user_id =  $this->session->userdata('user_id'); ?>
                                    <?php $folder = $this->db->get_where('folder',array('user_id' =>$user_id))->result_array();
                                       foreach($folder as $fo) {
                                        ?>
                                    <option value="<?php echo $fo['id']; ?>" onclick='UpdateStatus(<?php echo $fo['id']; ?>)'<?php if($fo['status']== "1") {?>selected <?php } else {} ?>><?php echo $fo['folder_name']; ?></option>
                                    <?php } ?>         
                                 </select>
                              </div>
                              <?php } else { } ?> 
                              <a href="#"><img src="<?php echo base_url();?>assets/img/Group291.png" ></a>
                              <?php
                                 $user_id =  $this->session->userdata('user_id');
                                 if(!empty($user_id )) {
                                 $user = $this->db->get_where('user',array('id' => $user_id))->row_array();
                                 ?>
                              <?php if($user['images'] =="") { ?>
                              <a  class="signbuttonabc" href="<?php echo base_url('my-account');?>"><img src="<?php echo base_url();?>/img/user.png"></a>
                              <?php } else { ?>
                              <a  class="signbuttonabc" href="<?php echo base_url('my-account');?>"><img src="<?php echo base_url();?>/uploads/user/<?php echo $user['images'] ?>"></a>
                              <?php } ?>							
                              <!--<a  class="signbutton" href="<?php echo base_url('my-account');?>"><?php echo $user['name'];?></a>-->
                              <?php } else { ?>
                              <a  class="signbutton" href="<?php echo base_url('login');?>">SIGN IN</a>
                              <?php } ?>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="mobile-menu d-lg-none d-block ">
               <div class="mobile-menu__menu-top border-bottom-0">
                  <div class="container ">
                     <div class="row">
                        <div class="menu-info d-flex justify-content-between align-items-center">
                           <div class="menubar"> <span></span> <span></span> <span></span> </div>
                           <a
                              href="<?php echo base_url();?>" class="logo"> <img src="<?php echo base_url();?>assets/img/black_logo.png" alt=""> </a>
                           <div class="cart-holder">
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="menu-closer"></div>
               <div class="mobile-menu__sidebar-menu">
                  <div class="menu-closer two"> <span> Close Menu</span> <span class="cross"><i
                     class="flaticon-cross"></i></span> </div>
                  <div class="search-box-holder">
                     <form action="#0">
                        <div class="form-group search-box menu"> <input type="text" class="form-control"
                           placeholder="Search for products"> <span class="search-icon"> <i
                           class="flaticon-magnifying-glass"></i> </span> </div>
                     </form>
                  </div>
                  <ul class="page-dropdown-menu">
                     <?php 
                        $category = $this->db->get('categories')->result_array();
                        foreach($category as $cat) {
                        
                        ?>
                     <li class="dropdown-list">
                        <a href="<?php echo base_url('sub-category/'.str_replace(' ', '_', $cat['cname']));?>"> <span><?php echo $cat['cname'];?> </span> <span class="menuarrow"> <i
                           class="flaticon-next-1"></i> </span> </a>
                        <ul class="dropdown">
                           <?php $subcategories = $this->db->get_where('subcategories',array('cname' =>$cat['id']))->result_array();
                              foreach($subcategories as $sub_cat) {
                              ?>
                           <li> <a href="<?php echo base_url('product-list/'.str_replace(' ', '_', $sub_cat['sname']));?>"><?php echo $sub_cat['sname']; ?></a> </li>
                           <?php } ?>   
                        </ul>
                     </li>
                     <li class="dropdown-list"> <a href="<?php echo base_url('brand-list'); ?>"> <span>Brands </span> <span class="menuarrow"> <i class="flaticon-next-1"></i> </span> </a></li>
                     <?php } ?>
                     <?php
                        $user_id =  $this->session->userdata('user_id');
                        if(!empty($user_id )) {
                        $user = $this->db->get_where('user',array('id' => $user_id))->row_array();
                        ?>
                     <?php if($user['images'] =="") { ?>
                     <a  class="signbuttonabc" href="<?php echo base_url('my-account');?>"><img src="<?php echo base_url();?>/img/user.png"></a>
                     <?php } else { ?>
                     <a  class="signbuttonabc" href="<?php echo base_url('my-account');?>"><img src="<?php echo base_url();?>/uploads/user/<?php echo $user['images'] ?>"></a>
                     <?php } ?>	
                     <?php } else { ?>
                     <li class="dropdown-list"> <a href="<?php echo base_url('login');?>"><span>Sign In</span></a></li>
                     <?php } ?>
                  </ul>
               </div>
            </div>
            <div class="main-menu d-lg-block d-none">
               <div class="container">
                  <div class="row align-items-center justify-content-between">
                     <div class="col-12 text-start">
                        <div class="left d-lg-block d-none ">
                           <div class="search-box-holder">
                              <form action="#0">
                                 <div class="form-group search-box menu"> <input type="text" class="form-control"
                                    placeholder="search from 600+ brands and 25,000 + products"> <span class="search-icon"> <i
                                    class="flaticon-magnifying-glass"></i> </span> </div>
                              </form>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="mega-menu-default mega-menu d-lg-block d-none">
               <div class="container position-relative">
                  <div class="row">
                     <nav>
                        <ul class="page-dropdown-menu d-flex align-items-center justify-content-center">
                           <?php 
                              $category = $this->db->get('categories')->result_array();
                              foreach($category as $cat) {
                              
                              ?>
                           <li class="dropdown-list megamenu ">
                              <a href="<?php echo base_url('sub-category/'.str_replace(' ', '_', $cat['cname']));?>"> <span><?php echo $cat['cname']; ?>
                              </span> <span class="menuarrow"> <i
                                 class="flaticon-down-arrow"></i> </span> </a>
                              <div class="dropdown megamenu-dropdown">
                                 <div class="row g-0">
                                    <div class="col-xl-6 col-lg-7 megamenu-padding-one">
                                       <div class="row g-0">
                                          <div class="col-lg-12">
                                             <div class="megamenu-box one">
                                                <ul class="megamenu-list">
                                                   <?php $subcategories = $this->db->get_where('subcategories',array('cname' =>$cat['id']))->result_array();
                                                      foreach($subcategories as $sub_cat) {
                                                      ?>
                                                   <li data-id="<?php echo $sub_cat['id']; ?>"><a href="<?php echo base_url('product-list/'.str_replace(' ', '_', $sub_cat['sname']));?>"><?php echo $sub_cat['sname']; ?></a>
                                                   </li>
                                                   <?php } ?> 
                                                </ul>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                    <div
                                       class="col-xl-6 col-lg-5 megamenu-padding background">
                                       <div class="row g-0">
                                          <div class="col-xl-12 col-lg-5">
                                             <div class="content"> <a
                                                href="#"
                                                class="thumb d-block"> <img
                                                src="<?php echo base_url();?>/uploads/categories/<?php  echo $cat['menu_image'];?>"
                                                alt="" > </a> </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </li>
                           <?php } ?>
                        </ul>
                        <ul class=" align-items-center justify-content-center">
                           <li class="dropdown-list brand"> <a href="<?php echo base_url('brand-list');?>">Brands</a></li>
                        </ul>
                     </nav>
                  </div>
               </div>
            </div>
         </div>
         <div class="sticy-header">
            <div class="main-menu border-bottom-0a d-lg-block d-none">
               <div class="container">
                  <div class="row align-items-center justify-content-between">
                     <div class="col-2 text-start">
                        <a href="<?php echo base_url();?>" class="logo"> <img src="<?php echo base_url();?>assets/img/black_logo.png" alt="">
                        </a>
                     </div>
                     <div class="col-10 ">
                        <div class="d-flex align-items-center justify-content-between">
                           <div class="d-flex align-items-center searchclass">
                              <div class="search-box-holder desktops" style="width:100%;">
                                 <form action="#0">
                                    <div class="form-group search-box menu meanua">
                                       <input type="text" class="form-control" placeholder="search from 600+ brands and 25,000 + products">
                                       <span class="search-icon"> <i class="flaticon-loupe"></i> </span>
                                    </div>
                                 </form>
                              </div>
                           </div>
                           <div class=" d-flex align-items-center signa ">
                              <?php
                                 $user_id =  $this->session->userdata('user_id');
                                 if(!empty($user_id )) {
                                 
                                 ?>
                              <a href="<?php echo base_url('wishlist') ?>" ><img src="<?php echo base_url();?>assets/img/Union.png" ></a> 
                              <div class="language currency">
                                 <select>
                                    <?php $user_id =  $this->session->userdata('user_id'); ?>
                                    <?php $folder = $this->db->get_where('folder',array('user_id' =>$user_id))->result_array();
                                       foreach($folder as $fo) {
                                        ?>
                                    <option value="<?php echo $fo['id']; ?>"onclick='UpdateStatus(<?php echo $fo['id']; ?>)' <?php if($fo['status']== "1") {?>selected <?php } else {} ?>><?php echo $fo['folder_name']; ?></option>
                                    <?php } ?>         
                                 </select>
                              </div>
                              <?php } else { } ?> 
                              <a href="#"><img src="<?php echo base_url();?>assets/img/Group291.png"></a>		
                              <?php
                                 $user_id =  $this->session->userdata('user_id');
                                 if(!empty($user_id )) {
                                 $user = $this->db->get_where('user',array('id' => $user_id))->row_array();
                                 ?>
                              <?php if($user['images'] =="") { ?>
                              <a  class="signbuttonabc" href="<?php echo base_url('my-account');?>"><img src="<?php echo base_url();?>/img/user.png"></a>
                              <?php } else { ?>
                              <a  class="signbuttonabc" href="<?php echo base_url('my-account');?>"><img src="<?php echo base_url();?>/uploads/user/<?php echo $user['images'] ?>"></a>
                              <?php } ?>	
                              <?php } else { ?>
                              <a class="signbutton" href="<?php echo base_url('login');?>">SIGN IN</a>
                              <?php } ?>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </header>