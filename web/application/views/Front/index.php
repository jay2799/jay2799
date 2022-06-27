<div class="slider_bg">
   <div class="container">
      <!-- Banner Start -->
      <section class="banner-one wow fadeInUp ">
         <!-- Banner Carousel -->
         <div class="banner-one__slider slick"
            data-slick='{"dots": true, "infinite": true, "speed": 300, "slidesToShow": 1, "slidesToScroll": 1, "arrows": true "autoplay": true, "autoplaySpeed": 5000, "fade": true, "pauseOnHover": false}'>
            <!-- Slide -->
			<?php
			 $slider = $this->db->get('slider')->result_array();
			 foreach($slider as $si) {
			?>
			<a href="<?php echo $si["url"];?>">
            <div class="banner-one__single-slide d-flex align-items-center "
               style="background-image: url('<?php echo base_url();?>/uploads/slider/<?php echo $si["images"];?> ');background-size: 100% 100%;">
            </div>
			</a>
			 <?php } ?>
         </div>
      </section>
      <!-- Banner End -->
   </div>
</div>
<div class="container mt-3">
   <div class="row">
   
   <?php 
	 $category = $this->db->limit('7')->get('categories')->result_array();
	 foreach($category as $cat) {
	
	?>
      <div class="col-md-3 col-4 line">
         <div class="row">
            <div class="col-md-5 img_line">
               <img src="<?php echo   base_url();?>uploads/categories/<?php echo $cat['images']; ?>" class="img-fluid" alt="chair" >
            </div>
            <div class="col-md-7 abc">
               <div class="divcenter">
                  <p><?php echo $cat['cname']; ?></p>
                  <a href="<?php echo base_url('sub-category/'.str_replace(' ', '_', $cat['cname']));?>">View all ></a>
               </div>
            </div> 
         </div>
      </div>
     <?php } ?>
     
     
      <div class="col-md-3 col-4 text-center abc abcde">
         <div class="divcentera">
            <p>View all products</p>
         </div>
      </div>
   </div>
</div>
<section class="product-offers-one">
   <div class="container">
      <div class="row mt--30 justify-content-center">
         <!--Start Product Offers One Single-->
         <div class="col-lg-4 col-md-4 ">
            <div class="product-offers-one__single mt-30 wow fadeInUp   animated" >
			<?php $banner1 = $this->db->get_where('banner',array('id' => 1))->row_array(); ?>
               <a href="<?php echo $banner1['url']; ?>" class="product-offers-one__single-inner d-block">
                  <img src="<?php echo base_url();?>uploads/banner/<?php echo $banner1['images']; ?>" alt="">
                  
               </a>
            </div>
         </div>
         <!--End Product Offers One Single-->
         <!--Start Product Offers One Single-->
         <div class="col-lg-8 col-md-8">
            <div class="row">
               <div class="col-md-6">
                  <div class="product-offers-one__single mt-30 wow fadeInUp  animated" >
				  <?php $banner2 = $this->db->get_where('banner',array('id' => 2))->row_array(); ?>
                     <a href="<?php echo $banner1['url']; ?>" class="product-offers-one__single-inner d-block">
                        <img src="<?php echo base_url();?>uploads/banner/<?php echo $banner2['images']; ?>" alt="">
                       
                     </a>
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="product-offers-one__single mt-30 wow fadeInUp  animated">
				  <?php $banner3 = $this->db->get_where('banner',array('id' => 3))->row_array(); ?>
                     <a href="<?php echo $banner3['url']; ?>" class="product-offers-one__single-inner d-block">
                        <img src="<?php echo base_url();?>uploads/banner/<?php echo $banner3['images']; ?>" alt="">
                        
                     </a>
                  </div>
               </div>
            </div>
            <div class="product-offers-one__single mt-30 wow fadeInUp  animated" >
			<?php $banner4 = $this->db->get_where('banner',array('id' => 4))->row_array(); ?>
               <a href="<?php echo $banner4['url']; ?>" class="product-offers-one__single-inner d-dlock">
                  <img src="<?php echo base_url();?>uploads/banner/<?php echo $banner4['images']; ?>" alt="">
                  <!--<div class="overlay-text white">
                     <h4 class="office_idea">Office arrangment ideas </h4>
                  </div>--->
               </a>
            </div>
         </div>
      </div>
   </div>
</section>
<div class="container text-center">
   <div class="row">
      <div class="text-center">
         <h3 class="py-5 how">How it works</h3>
      </div>
      <div class="col-md-3 how_text">
         <div class="icon_box">
            <img src="<?php echo base_url(); ?>assets/img/Vector.png">
         </div>
         <h5>Search and discover</h5>
         <p>materials you need</p>
      </div>
      <div class="col-md-3 how_text">
         <div class="icon_box">
           <img src="<?php echo base_url();?>assets/img/Union.png" >
         </div>
         <h5>Add them in to wishlist</h5>
         <p>in different projects</p>
      </div>
      <div class="col-md-3 how_text">
         <div class="icon_box">
           <img src="<?php echo base_url();?>assets/img/Group291.png" >
         </div>
         <h5>Create your own moodboard</h5>
         <p>From wishlist products</p>
      </div>
      <div class="col-md-3 how_text">
         <div class="icon_box">
             <img src="<?php echo base_url();?>assets/img/Group19.png" >
         </div>
         <h5>contect nearby reseller</h5>
         <p>In signle click</p>
      </div>
   </div>
</div>
<div class="container py-5">
   <div class="row">
      <div class="col-lg-6">
         <div class="categories-one__feature-box wow fadeInLeft  mt-30 animated" >
		 <?php $design1 = $this->db->get_where('design',array('id' => 1))->row_array(); ?>
		    <a href="<?php echo $design1['url']; ?>">
            <div class="categories-one__feature-thumb" style="background-image: url('<?php echo base_url();?>uploads/design/<?php echo $design1['images']; ?>');"> </div>
            <div class="categories-one__feature-content">
               <h2 class="get"><?php echo $design1['title']; ?></h2>
            </div>
			</a>
         </div>
      </div>
      <div class="col-lg-6">
         <div class="categories-one__feature-box wow fadeInRight  mt-30 animated" >
		 <?php $design2 = $this->db->get_where('design',array('id' => 2))->row_array(); ?>
		    <a href="<?php echo $design2['url']; ?>">
            <div class="categories-one__feature-thumb" style="background-image: url('<?php echo base_url();?>uploads/design/<?php echo $design2['images']; ?>');"> </div>
            <div class="categories-one__feature-content">
               <h2 class="get"><?php echo $design2['title']; ?></h2>
            </div>
			</a>
         </div>
      </div>
   </div>
</div>
<div class="bg_colore">
   <!-- Categories tab Start -->
   <section class="categories-tab pt-60 pb-60 wow fadeInUp">
      <div class="container ">
         <div class="row">
            <div class="col-md-12 mb-5">
               <h4 class="sub_cat">
               Explore by subcategory</h5>
            </div>
         </div>
         <div class="row">
            <div class="tab-content" id="pills-tabContent-two">
               <div class="tab-pane fade show active" id="pills-best-sellers" role="tabpanel"
                  aria-labelledby="pills-best-sellers-tab">
                  <div class="catagory-slider">
				  
				  
				  <?php $subcategories = $this->db->get('subcategories')->result_array();
						foreach($subcategories as $sub_cat) {
				  ?>
				  <a href="<?php echo base_url('product-list/'.str_replace(' ', '_', $sub_cat['sname']));?>">
                     <div class="products-grid-one">
                        <div class="products-grid-one__product-image">
                           <div class="products-grid-one__badge-box"> <span
                              class="bg_base badge new "><?php echo $sub_cat['sname']; ?></span> </div>
                           <img
                              class="products-grid-one__hover-img now-main"
                              src="<?php echo base_url();?>uploads/subcategories/<?php echo $sub_cat['images']; ?>" alt="Alt"> 
                        </div>
                     </div>
					 </a>
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
   <section class="blog pt-60 pb-60">
      <div class="container">
         <div class="row">
            <div class="col-12">
               <div class="section-header  wow fadeInUp animated">
                  <h2 class="sub_cat">Frome the blog</h2>
                  <p class="blog_text"><a href="<?php echo base_url('blog');?>" style="color: black;"> View All</a></p>
               </div>
            </div>
         </div>
         <div class="row justify-content-center">
		 
		 <?php foreach($blog as $blo) { ?>
            <div class="col-lg-4 col-md-6 wow fadeInUp animated ">
               <div class="blog4-single mt-30">
                  <a href="<?php echo base_url('blog-info/'. $blo['id']);?>" class="thumb">
                  <img src="<?php echo base_url();?>uploads/blog/<?php echo $blo['images'];?>" alt="" />
                  </a>
                  <div class="blog-content">
                     <p><?php echo date("d-m-Y", strtotime($blo['date']));?></p>
                     <a href="<?php echo base_url('blog-info/'. $blo['id']);?>" class="d-block">
                        <h4><?php echo $blo['title'];?></h4>
                     </a>
                  </div>
               </div>
            </div>
		 <?php } ?>  
           
         </div>
      </div>
   </section>
   <!--End Blog Two-->
   <div class="container">
      <div class="row">
         <div class="col-12">
            <div class="section-header  wow fadeInUp animated">
               <h2 class="sub_cat">Brands on board</h2>
               <p class="blog_text"><a href="<?php echo base_url('brand-list');?>" style="color: black;"> View All</a></p>
            </div>
         </div>
      </div>
   </div>
   <div class="partner-one">
      <div class="container">
         <div class="row wow fadeInUp animated">
            <div class="partnerslider">
			
			<?php foreach($brand as $ba) { ?>
               <a href="<?php echo base_url('brandprofile/'.str_replace(' ', '_', $ba['bname']));?>" class="partner-one__brand">
                  <div class="imagebox d-flex justify-content-center align-items-center">
                     <img src="<?php echo base_url();?>uploads/brand/<?php echo $ba['images'];?>" alt=""> 
                  </div>
               </a>
            <?php } ?>   
             
           
              
            </div>
         </div>
      </div>
   </div>
</div>
<div class="container text-center mt-2">
   <div class="images">
   <?php $ads = $this->db->get('ads')->row_array(); ?>
		<a href="<?php echo $ads['url'];?>">
      <img src="<?php echo base_url();?>uploads/ads/<?php echo $ads['images']; ?>">
	  </a>
   </div>
</div>