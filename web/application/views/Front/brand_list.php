<div class="shop-details-breadcrumb wow fadeInUp  overflow-hidden   animated" >
   <div class="container">
      <div class="row">
         <div class="col-xl-12">
            <h3 style="padding: 20px 5px 19px 0px;">Brand List</h3>
         </div>
      </div>
   </div>
</div>
<div class="container mt-5 mb-5">
   <div class="row">
      <div class="col-md-3">
      </div>
      <div class="col-md-9 ">
	  <?php foreach($brand as $ba) { ?>
         <div class="brand_box mb-5">
            <div class="row">
               <div class="col-md-3 brand_list_img">
                  <img src="<?php echo base_url(); ?>uploads/brand/<?php echo $ba['images']; ?>">
               </div>
               <div class="col-md-9">
                  <div class="brand_space">
                     <h4><?php echo $ba['bname']; ?></h4>
                     <div class="brand_about mt-2">
                        <p><i class="fas fa-envelope"></i><span><?php echo $ba['email']; ?></span></p>
                        <p><i class="fas fa-phone-alt"></i><span><?php echo $ba['mobile']; ?></span></p>
                        <p><i class="fas fa-globe"></i><span><?php echo $ba['web']; ?></span></p>
                        <p><i class="fas fa-map-marker-alt"></i><span><?php echo $ba['location']; ?></span></p>
                     </div>
                     <div class="button_brand mt-4">
                        <a href="<?php echo base_url('brandprofile/'.str_replace(' ', '_', $ba['bname']));?>">View More</a>
                     </div>
                  </div>
               </div>
               <div>
               </div>
            </div>
         </div>
		 <?php } ?>
      </div>
   </div>
</div>