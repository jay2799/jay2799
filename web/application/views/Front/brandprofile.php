<div class="shop-details-breadcrumb  overflow-hidden  animated">
   <div class="container ">
      <div class="row">
         <div class="col-xl-12">
            <div class="shop-details-innera">
               <ul class="shop-details-menu">
                  <li><a href="<?php echo base_url('brand-list'); ?>">Brands</a></li>
                  <li><a href="#"> > </a></li>
                  <li class="active"> <?php echo $brand['bname']; ?> </li>
               </ul>
            </div>
         </div>
      </div>
   </div>
</div>
<div class="container">
   <div class="banner-img">
      <img src="<?php echo base_url();?>uploads/brand/<?php echo $brand['cover_image']; ?>">
   </div>
</div>
<div class="container logo_box">
   <div class="row">
      <div class="col-md-2">
         <div class="box-sec logo_secbox text-center">
            <img src="<?php echo base_url();?>uploads/brand/<?php echo $brand['images']; ?>">
         </div>
      </div>
      <div class="col-md-7 text-brand">
         <h2><?php echo $brand['bname']; ?></h2>
         <p><?php echo $brand['location']; ?></p>
      </div>
      <div class="col-md-3">
		<div id="wrapper">
		<?php  $currentURL = current_url(); ?>
		  <input type="checkbox" class="checkbox" id="share"  />
		  <label for="share" class="label entypo-export"><i class="fa fa-share" aria-hidden="true"></i></label>
		  <div class="social">
			<ul>
			  <li class="entypo-twitter"><a href="http://www.twitter.com/share?url=<?php echo $currentURL ?>"><i class="fab fa-twitter"></i></a></li>
			  <li class="entypo-youtube"><a href="https://api.whatsapp.com/send?text=<?php echo $currentURL ?>"><i class="fab fa-whatsapp" aria-hidden="true"></i></a></li>
			  <li class="entypo-facebook"><a href="https://www.facebook.com/sharer.php?u=<?php echo $currentURL ?>"><i class="fab fa-facebook"></i></a></li>    
			  <li class="entypo-instagram"><a href=""><i class="fab fa-instagram"></i></a></li>
			  <li class="entypo-github"><a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo $currentURL ?>"><i class="fab fa-linkedin"></i></a></li>      
			</ul>
		  </div>
		  
		</div>
         <a href="tel:<?php echo $brand['mobile']; ?>" class="btn"><i class="fa-brands fa-telegram c_icon"></i> CONTACT</a>&nbsp;&nbsp;&nbsp;
         <a target="_blank" href="<?php echo $brand['web']; ?>" class="btna">WEBSITE</a> 
      </div>
   </div>
</div>
<div class="container mt-5 mb-5">
   <?php
      $success= $this->session->flashdata('success');
      $error= $this->session->flashdata('error');
      
      if($success){
      ?>
   <div class="alert alert-success" role="alert">
      <?php echo $success; ?>
   </div>
   <?php
      }
      if($error){
      ?>
   <div class="alert alert-danger" role="alert">
      <?php echo $error; ?>
   </div>
   <?php 
      }
      ?>
</div>
<!-- Categories tab End -->
<section class="categories-tab  mt-5">
   <div class="container ">
      <div class="row">
         <div class="col-12">
            <ul class="nav nav-pills " id="pills-tab-two" role="tablist">
               <li class="nav-item" role="presentation"> <button class="nav-link active"
                  id="pills-best-sellers-tab1" data-bs-toggle="pill"
                  data-bs-target="#seller" type="button" role="tab"
                  aria-controls="seller" aria-selected="true"> Overview </button>
               </li>
               <li class="nav-item" role="presentation">
                  <button class="nav-link" id="product-tab" data-bs-toggle="pill"
                     data-bs-target="#product" type="button" role="tab" aria-selected="false">
                  Products
                  </button>
               </li>
               <li class="nav-item" role="presentation">
                  <button class="nav-link" id="Catalogs-tab" data-bs-toggle="pill"
                     data-bs-target="#Catalogs" type="button" role="tab" aria-selected="false">
                  Catalogs
                  </button>
               </li>
               <li class="nav-item" role="presentation">
                  <button class="nav-link" id="Resellers-tab" data-bs-toggle="pill"
                     data-bs-target="#Resellers" type="button" role="tab" aria-selected="false">
                  Resellers
                  </button>
               </li>
               <li class="nav-item" role="presentation">
                  <button class="nav-link" id="info-tab" data-bs-toggle="pill"
                     data-bs-target="#info" type="button" role="tab" aria-selected="false">
                  info
                  </button>
               </li>
            </ul>
         </div>
      </div>
      <div class="row mt-3">
         <div class="tab-content" id="pills-tabContent-two">
            <div class="tab-pane fade show active" id="seller" role="tabpanel"
               aria-labelledby="pills-best-sellers-tab1">
               <p class="tab-text mb-4">
                  <?php echo $brand['overview'];?>
               </p>
               <div class="s_title bottom-border mb-3 mt-5">
                  <div class="row ">
                     <div class="col-md-9">
                        <div class="t-text">
                           <h4>Products</h4>
                        </div>
                     </div>
                     <div class="col-md-3">
                        <div class="v-button">
                           <a href="#">View All</a>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="catagory-slider">
                  <?php foreach($product as $pro){?>
				  <div class="products-grid-one">
                     <div class="products-grid-one__product-image ">
					 <?php $images=explode(",", $pro['product_image']);?>
                                 
                        <img
                           class="products-grid-one__hover-img now-main"
                           src="<?php echo base_url();?>/uploads/product/<?php echo $images[0]; ?>" alt="Alt">
                        <div class="product_texta text-center mt-2 mb-2">
                           <h4><?php echo $pro['product_name'];?></h4>
                        </div>
                     </div>
                  </div>
				  <?php } ?>
				 
               </div>
               <div class="s_title bottom-border mb-3 mt-5">
                  <div class="row ">
                     <div class="col-md-9">
                        <div class="t-text">
                           <h4>Catalog</h4>
                        </div>
                     </div>
                     <div class="col-md-3">
                        <div class="v-button">
                           <a href="#">View All</a>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="catagory-slider">
                  <?php foreach($catalog as $cata) { ?>
                  <a target="_blank" href="<?php echo base_url(); ?>/uploads/catalogue/<?php echo $cata['pdf']; ?>">
                     <div class="products-grid-one">
                        <div class="products-grid-one__product-image ">
                           <img
                              class="products-grid-one__hover-img now-main"
                              src="<?php echo base_url();?>uploads/catalogue/<?php echo $cata['images']; ?>" alt="Alt">
                           <div class="product_texta text-center mt-2 mb-2">
                              <h4><?php echo $cata['title']; ?></h4>
                           </div>
                        </div>
                     </div>
                  </a>
                  <?php } ?>
               </div>
            </div>
            <div class="tab-pane fade show " id="Resellers" role="tabpanel"
               aria-labelledby="pills-top-rated-tab">
               <div class="col-md-12 mt-4">
                  <?php foreach($resellers as $re) {  ?>
                  <div class="card-sec mb-3">
                     <div class="row">
                        <div class="col-md-6">
                           <div class="review-single pt-0 hed">
                              <div class="ratting">
                                 <span class="ananta"><?php echo $re['name'];?></span>
								 <?php $city = $this->db->get_where('city',array('id' => $re['city']))->row_array();?>
                                 <p class="text-ananta"> <?php echo $city['city'];?></p>
                              </div>
                           </div>
                        </div>
                        <div class="col-md-6 text-rightsec">
                           <?php $user_id = $this->session->userdata('user_id');
                              $check = $this->db->get_where('get_number',array('user_id' => $user_id,'resellers_id' => $re['id'],'date' => date('Y-m-d')))->num_rows();
                              if($check == 0){
                              if($user_id == "") {
                              ?>
                           <a href="<?php echo base_url('login');?>" class="call-back mb-2" >GET NUMBER</a>
                           <?php } else { ?>
                           <a href="<?php echo base_url('get-number/'.$re['id'].'/'.$this->uri->segment(2));?>" class="call-back mb-2" >GET NUMBER</a>
                           <?php } } else {?>  
                           <i class="fas fa-phone-alt"></i> &nbsp;<span><?php echo $re['contact'];?></span>
                           <?php } ?>
                           <p>OR</p>
                        </div>
                        <div class="col-md-8 mt-2">
                           <p class="address-text"><?php echo $re['address'];?></p>
                        </div>
                        <div class="col-md-4 text-rightsec mt-2">
                           <a href="#popup5" class="call-back popup_link">REQUEST A CALL BACK</a>
                        </div>
                     </div>
                  </div>
                  <?php } ?>
               </div>
            </div>
			<div class="tab-pane fade show " id="Catalogs" role="tabpanel"
               aria-labelledby="Catalogs-tab">
			    <div class="catagory-slider">
                  <?php foreach($catalog as $cata) { ?>
                  <a target="_blank" href="<?php echo base_url(); ?>/uploads/catalogue/<?php echo $cata['pdf']; ?>">
                     <div class="products-grid-one">
                        <div class="products-grid-one__product-image ">
                           <img
                              class="products-grid-one__hover-img now-main"
                              src="<?php echo base_url();?>uploads/catalogue/<?php echo $cata['images']; ?>" alt="Alt">
                           <div class="product_texta text-center mt-2 mb-2">
                              <h4><?php echo $cata['title']; ?></h4>
                           </div>
                        </div>
                     </div>
                  </a>
                  <?php } ?>
               </div>
			 </div> 
			 <div class="tab-pane fade show " id="product" role="tabpanel"
               aria-labelledby="product-tab">
			   <div class="s_title bottom-border mb-3 mt-5">
                  <div class="row ">
                     <div class="col-md-9">
                        <div class="t-text">
                           <h4>Products</h4>
                        </div>
                     </div>
                     <div class="col-md-3">
                        <div class="v-button">
                           <a href="#">View All</a>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="catagory-slider">
                  <?php foreach($product as $pro){?>
				  <div class="products-grid-one">
                     <div class="products-grid-one__product-image ">
					 <?php $images=explode(",", $pro['product_image']);?>
                                 
                        <img
                           class="products-grid-one__hover-img now-main"
                           src="<?php echo base_url();?>/uploads/product/<?php echo $images[0]; ?>" alt="Alt">
                        <div class="product_texta text-center mt-2 mb-2">
                           <h4><?php echo $pro['product_name'];?></h4>
                        </div>
                     </div>
                  </div>
				  <?php } ?>
				 
               </div>
			   
			   
			 </div>
			 
			 
			 
			<div class="tab-pane fade show " id="info" role="tabpanel"
               aria-labelledby="info-tab">
			   <div class="brand_abouta mt-2">
					<p><i class="fas fa-envelope"></i><span><?php echo $brand['email']; ?></span></p>
					<p><i class="fas fa-phone-alt"></i><span><?php echo $brand['mobile']; ?></span></p>
					<p><i class="fas fa-globe"></i><span><?php echo $brand['web']; ?></span></p>
					<p><i class="fas fa-map-marker-alt"></i><span><?php echo $brand['location']; ?></span></p>
				</div>
			</div>   
            <div class="loder">
               <div id="overlay" style="display:none;">
                  <div class="spinner"></div>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>
<style>
	 .slick-list.draggable {
	    border-bottom: none !important;
	 }
	.brand_abouta p{
		font-size: 21px;
		margin: 10px;
	}
	.brand_abouta span{
		margin-left: 11px;
	}
	input[type="checkbox"]{display:none;}

	.checkbox:checked + .label{
	  background:transparent;
	  color:#231733;
	}

	.checkbox:checked ~ .social {
	  opacity:1;
	  transform:scale(1) translateY(-90px);
	}
	div#wrapper {
		display: inline-block;
		width: 14%;
		margin: 0 !important;
	}
	input[type="checkbox"] {
		display: none;
	}
	label.label.entypo-export {
		position: relative;
		top: 12px;
	}
	social .label {
	  background:#231733;
	  font-size:16px;
	  cursor:pointer;
	  margin:0;
	  padding:5px 10px;
	  border-radius:10%;
	  color:#7B7484;
	}
	.social a{
		color:#fff !important;
		
	}
	.social a:hover{
		color:#000 !important;
	}
	.social {
	  transform-origin:50% 0%;
	  transform:scale(0) translateY(-190px);
	  opacity:0;
	  transition:.5s;
	}
	.social ul {
	  position:relative;
	  left: -133px;
	  right:0;
	  margin:-5px auto 0;
	  color:#fff;
	  height:46px;
	  width:300px;
	  background:#3B5998;
	  padding:0;
	  list-style:none;
	}

	.social ul li {
	  font-size:17px;
	  cursor:pointer;
	  width:60px;
	  margin:0;
	  padding:12px 0;
	  text-align:center;
	  float:left;
	  display:block;
	  height: 46px;}

	.social ul li:hover {color:rgba(0,0,0,.5);}

	.social ul:after {
	  content:'';
	  display:block;
	  position:absolute;
	  left:0;
	  right:0;
	  margin:46px auto;
	  height:0;
	  width:0;
	  border-left: 20px solid transparent;
		border-right: 20px solid transparent;
		border-top: 20px solid #E34429;
	}

	li[class*="twitter"] {background:#6CDFEA;padding:12px 0;}
	li[class*="gplus"] {background:#E34429;padding:12px 0;}
	li[class*="dropbox"] {background:#8DC5F2;padding:12px 0;}
	li[class*="github"] {background:#008fdd;padding:12px 0;}
	li[class*="instagram"] {background:#dd2a7b;padding:12px 0;}
	li[class*="youtube"] {background:#128c7e;padding:12px 0;}

	.credits a {
	  color: #fff;
	  text-decoration: none;
	}
	.products-grid-one__product-image img {
		height: 235px;
	}
</style>