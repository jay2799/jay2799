<div class="shop-details-breadcrumb wow fadeInUp  overflow-hidden  animated">
   <div class="container mb-4">
      <div class="row">
         <div class="col-xl-12">
            <div class="shop-details-inner">
               <ul class="shop-details-menu">
                  <li><a href="#">Catagory</a></li>
                  <li><a href="#"> > </a></li>
				  <?php $uri_id = $this->uri->segment(2); ?>
				  <?php $cat_name = $this->db->get_where('categories',array('cname'=> $uri_id))->row_array(); ?>
                  <li class="active"><?php echo $cat_name['cname'];?></li>
               </ul>
            </div>
            <h3><?php echo $cat_name['cname'];?></h3>
         </div>
      </div>
   </div>
</div>
<div class="container mt-2">
   <div class="row">
     <?php foreach($sub_cat as $s_cat ) { ?>
      <div class="col-md-3">
	    <a href="<?php echo base_url('product-list/'.str_replace(' ', '_', $s_cat['sname']));?>">
         <img class="img-fluid" src="<?php echo base_url();?>uploads/subcategories/<?php echo $s_cat['images'];?>">
         <div class="img_title py-2">
            <h4><?php echo $s_cat['sname'];?> ></h4>
         </div>
		 </a>
      </div>
     <?php } ?>
   </div>
</div>
<!-- Categories tab Start -->
<section class="categories-tab pt-60 pb-60 wow fadeInUp">
   <div class="container ">
      <div class="row">
         <div class="col-md-12 mb-5">
            <h4 class="sub_cat">
            Browse by brands</h5>
            <p class="blog_text"> View All</p>
         </div>
      </div>
      <div class="row">
         <div class="tab-content" id="pills-tabContent-two">
            <div class="tab-pane fade show active" id="pills-best-sellers" role="tabpanel"
               aria-labelledby="pills-best-sellers-tab">
               <div class="catagory-slider">
			   
			   <?php foreach($product_brand as $b_product) { 
				 
			   ?>
                  <div class="products-grid-one">
                     <div class="products-grid-one__product-image">
                        <div class="products-grid-one__badge-box"> <span
                           class="bg_base badge new ">New</span> </div>
                        <img
                           class="products-grid-one__hover-img now-main"
                           src="<?php echo base_url();?>/uploads/brand/<?php echo $b_product['images']; ?>" alt="Alt"> 
                        <div class="img_title py-2">
                           <h4><?php echo $b_product['bname'];?></h4>
                        </div>
                     </div>
                  </div>
			   <?php } ?>
                
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
<!-- Categories tab End -->
<section class="categories-tab  wow fadeInUp">
   <div class="container ">
      <h3 class="designer mb-3">Designers choice</h3>
      <div class="row">
         <div class="col-12">
            <ul class="nav nav-pills " id="pills-tab-two" role="tablist">
               <li class="nav-item" role="presentation"> <button class="nav-link active"
                  id="pills-best-sellers-tab1" data-bs-toggle="pill"
                  data-bs-target="#seller" type="button" role="tab"
                  aria-controls="seller" aria-selected="true"> Best Sellers </button>
               </li>
               <li class="nav-item" role="presentation"> <button class="nav-link"
                  id="pills-new-arrivals-tab" data-bs-toggle="pill"
                  data-bs-target="#pills-new-arrivals" type="button" role="tab"
                  aria-controls="pills-new-arrivals" aria-selected="false"> New Arrivals </button>
               </li>
             
            </ul>
         </div>
      </div>
      <div class="row mt-3">
         <div class="tab-content" id="pills-tabContent-two">
            <div class="tab-pane fade show active" id="seller" role="tabpanel"
               aria-labelledby="pills-best-sellers-tab1">
               <div class="catagory-slider">
			   <?php foreach($product_best as $best) { ?>
                  <div class="products-grid-one">
                     <div class="products-grid-one__product-image back_colore">
					 <?php $imagesa=explode(",", $best['product_image']);?>
                        <img
                           class="products-grid-one__hover-img now-main"
                           src="<?php echo base_url();?>/uploads/product/<?php echo $imagesa[0]; ?>" alt="Alt">
                        <div class="product_text mt-2 mb-2">
						<?php $brand_name = $this->db->get_where('brand',array('id' =>$best['brand']))->row_array(); ?>
                           <h4><?php echo $brand_name['bname']; ?></h4>
                           <br>
                           <p><?php echo $best['product_name']; ?></p>
                        </div>
                     </div>
                  </div>
			   <?php } ?>
                  
               </div>
            </div>
            <div class="tab-pane fade" id="pills-new-arrivals" role="tabpanel"
               aria-labelledby="pills-new-arrivals-tab">
               <div class="catagory-slider">
			   <?php foreach($product_new as $new) { ?>
                  <div class="products-grid-one">
                     <div class="products-grid-one__product-image back_colore">
					 <?php $images=explode(",", $new['product_image']);?>
                        <img
                           class="products-grid-one__hover-img now-main"
                           src="<?php echo base_url();?>/uploads/product/<?php echo $images[0]; ?>" alt="Alt">
                        <div class="product_text mt-2 mb-2">
                           <?php $brand_name = $this->db->get_where('brand',array('id' =>$new['brand']))->row_array(); ?>
                           <h4><?php echo $brand_name['bname']; ?></h4>
                           <br>
                           <p><?php echo $new['product_name']; ?></p>
                        </div>
                     </div>
                  </div>
			   <?php } ?>
                  
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
<div class="container text-center mt-2">
   <div class="images">
   <?php $ads = $this->db->get('ads')->row_array(); ?>
		<a href="<?php echo $ads['url'];?>">
      <img src="<?php echo base_url();?>uploads/ads/<?php echo $ads['images']; ?>">
	  </a>
   </div>
</div>

<style>
.products-grid-one__product-image img {
		height: 235px;
	}
</style>