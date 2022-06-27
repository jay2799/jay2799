<style>
   span.single-item img{
   height:100px;
   }
   .single-item.top_slide {
   height: 580px;
   }
   .single-item img{
   height: 100%;
   }
</style>

<div class="shop-details-breadcrumb  overflow-hidden  animated">
   <div class="container ">
      <div class="row">
         <div class="col-xl-12">
            <div class="shop-details-innera">
               <ul class="shop-details-menu">
                  <li><a href="#">Catagory</a></li>
                  <li><a href="#"> > </a></li>
                  <li><a href="#">Finishes</a></li>
                  <li><a href="#"> > </a></li>
                  <li><a href="#">Floor covoring</a></li>
                  <li><a href="#"> > </a></li>
                  <li><a href="#">Indoor flooring</a></li>
                  <li><a href="#"> > </a></li>
                  <li class="active"> Metalic copper </li>
               </ul>
            </div>
         </div>
      </div>
   </div>
</div>
<section class="shop-details-top three">
   <div class="container">
      <div class="row mt--30">
         <div class="col-xl-7 col-lg-7 mt-30 wow fadeInUp animated">
            <div class="single-product-box">
               <div class="big-product single-product-three slider-for">
                  <?php $images=explode(",", $product['product_image']);
                     foreach ($images as $key => $value) {
                     ?>
                  <div>
                     <div class="single-item top_slide">
                        <img  src="<?php echo base_url(); ?>uploads/product/<?php echo $value;?>" alt="">
                     </div>
                  </div>
                  <?php } ?>
                  <?php $varient = $this->db->get_where('product_color',array('product_id' =>$product['id']))->result_array(); ?>
                  <?php foreach($varient as $va)  {  ?>
                  <div>
                     <div class="single-item top_slide"> 
                        <img  src="<?php echo base_url();?>uploads/color/<?php echo $va['variant_image']; ?>" alt="">
                     </div>
                  </div>
                  <?php }  ?>
               </div>
               <div class="product-slicknav single-product-three-nav slider-nav">
                  <?php $images=explode(",", $product['product_image']);
                     foreach ($images as $key => $value) {
                     ?>
                  <div> 
                     <span class="single-item"> 
                     <img src="<?php echo base_url(); ?>uploads/product/<?php echo $value;?>" alt="">
                     </span> 
                  </div>
                  <?php } ?>
               </div>
            </div>
         </div>
         <div class="col-xl-5 col-lg-5 mt-30 wow fadeInUp animated">
            <div class="shop-details-top-right three">
               <div class="shop-details-top-right-content-box">
                  <div class="row">
                     <div class="col-md-9">
                        <div class="shop-details-top-price-box">
                           <div class="brand_logo_details">
                              <?php $brand_logo = $this->db->get_where('brand',array('id' =>$product['brand']))->row_array(); ?>
                              <a href="<?php echo base_url('brandprofile/'.str_replace(' ', '_', $brand_logo['bname']));?>"><img src ="<?php echo base_url();?>uploads/brand/<?php echo $brand_logo['images'];?>" class = "img-thumbnail"></a>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-3">
                        <div class="shop-details-top-price-box d-flex">
                           <a href="#0" class="pshare"> <i class="flaticon-share-1"></i> </a>
                           <a href="#0" class="pshare"> <i class="far fa-heart"></i> </a>
                        </div>
                     </div>
                  </div>
               </div>
               <div
                  class="shop-details-top-price-box d-flex align-items-center justify-content-between flex-wrap ">
                  <div>
                     <a href="<?php echo base_url('brandprofile/'.str_replace(' ', '_', $brand_logo['bname']));?>">
                        <h3 class="pe-1 soriso"><?php  $brand = $this->db->get_where('brand',array('id' => $product['brand']))->row_array(); echo $brand['bname'];  ?> </h3>
                     </a>
                  </div>
               </div>
               <div class="mt-2 metalic">
                  <h4><?php echo $product['product_name']; ?></h4>
                  <p><span class="price_range">Price range : </span> <?php echo $product['price_range']; ?></p>
               </div>
               <div class="shop-details-top-color-sky-box">
                  <h4 class="p_variants">Product Variants : </h4>
                  <ul class="varients">
                     <?php $varient = $this->db->get_where('product_color',array('product_id' =>$product['id']))->result_array(); ?>
                     <?php foreach($varient as $va)  {  ?>
                     <li> 
                        <a href="#0" class="shop-details-top-color-sky-img"
                           data-src="<?php echo base_url();?>uploads/color/<?php echo $va['variant_image']; ?>"> 
                        <img
                           src="<?php echo base_url();?>uploads/color/<?php echo $va['variant_image']; ?>"
                           alt=""> </a> 
                     </li>
                     <?php } ?>
                  </ul>
               </div>
               <div class="mt-3 metalic">
                  <p><span class="p_side">Color :  </span>
                     <?php $colore=explode(",", $product['color']);
                        foreach ($colore as $key => $colores) {
                        $colo = $this->db->get_where('color',array('id' => $colores))->row_array();
                        echo $colo['name'].","; }
                        ?>
                  </p>
                  <?php if($product['finish'] ==0) { } else { ?>
                  <p><span class="p_side">  Finish :  </span>
                     <?php $finish=explode(",", $product['finish']);
                        foreach ($finish as $key => $fi) {
                           $fini = $this->db->get_where('finish',array('id' => $fi))->row_array();
                        
                        echo $fini['finish'].","; } 
                        ?>
                  </p>
                  <?php } ?>
                  <?php if($product['size'] ==0) { } else { ?>
                  <p><span class="p_side">Size :  </span>
                     <?php $size=explode(",", $product['size']);
                        foreach ($size as $key => $si) {
                           $siz = $this->db->get_where('size',array('id' => $si))->row_array();
                        
                        echo $siz['size'].","; } 
                        ?>
                  </p>
                  <?php } ?>
                  <?php if($product['material'] ==0) { } else { ?>
                  <p><span class="p_side">Mterial  :  </span>
                     <?php $mterial=explode(",", $product['material']);
                        foreach ($mterial as $key => $mteri) {
                           $mter = $this->db->get_where('material',array('id' => $mteri))->row_array();
                        
                        echo $mter['material'].","; }
                        ?>	
                  </p>
                  <?php } ?>
               </div>
              <div class="shop-details-top-buy-now-btn mt-5"> 
                  <a href="#" class="btn--primary ">GET NEARBY RESELLERS LIST</a> 
               </div>
               <div class="shop-details-top-buy-now-btn"> 
                  <a href="#" class="btn--primary newbtn">CONTACT BRAND</a> 
               </div>
            </div>
         </div>
      </div>
      <div class="reseller mt-5">
         <div class="row">
            <div class="col-md-10">
               <h3>RESELLERS LIST</h3>
            </div>
            <div class="col-md-2 text-rightsec">
               <p>View All</p>
            </div>
         </div>
      </div>
      <div class="row">
         <div class="col-md-3 ">
            <div class="shop-grid-sidebar">
               <button class="remove-sidebar d-lg-none d-block"> <i class="flaticon-cross"> </i> </button>
               <div class="sidebar-holder">
                  <div class="single-sidebar-box mt-30 wow fadeInUp   animated" style="visibility: visible; animation-name: fadeInUp;">
                     <h2 class="accordion-header" id="headingTwo"> <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">City
                        </button> 
                     </h2>
                     <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample" style="">
                        <div class="checkbox-item">
                           <form>
							<?php $city = $this->db->get('city')->result_array();
								  foreach ($city as $ci) { 
							?>
                              <div class="form-group"> <input type="radio" name="city" value="<?php echo $ci['id'];?>" id="ci<?php echo $ci['city'];?>" class="city"> <label for="ci<?php echo $ci['city'];?>"><?php echo $ci['city'];?></label> </div>
                              
							<?php } ?>  
                           </form>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="col-md-9 mt-4" id="city_data">
		 
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
                           <a href="<?php echo base_url('get-number-re/'.$re['id'].'/'.$this->uri->segment(2));?>" class="call-back mb-2" >GET NUMBER</a>
                           <?php } } else {?>  
                           <i class="fas fa-phone-alt"></i> &nbsp;<span><?php echo $re['contact'];?></span>
                           <?php } ?>
                           <p>OR</p>
                        </div>
                        <div class="col-md-8 mt-2">
                           <p class="address-text"><?php echo $re['address'];?></p>
                        </div>
                        <div class="col-md-4 text-rightsec mt-2">
                           <a href="#popup56" class="call-back popup_link">REQUEST A CALL BACK</a>
                        </div>
                     </div>
                  </div>
                  <?php } ?>
			
			
                  <div class="col-12 d-flex justify-content-center wow fadeInUp animated">
                     <p><?php echo $links; ?></p>
                     <!-- <ul class="pagination text-center">
                        <li class="next"><a href="#0"><i class="flaticon-left-arrows"
                           aria-hidden="true"></i> </a></li>
                        <li><a href="#0">1</a></li>
                        <li><a href="#0" class="active">2</a></li>
                        <li><a href="#0">3</a></li>
                        <li><a href="#0">...</a></li>
                        <li><a href="#0">10</a></li>
                        <li class="next"><a href="#0"><i class="flaticon-next-1"
                           aria-hidden="true"></i>  </a></li>
                        </ul>--->
                  </div>
               
         </div>
      </div>
   </div>
   </div>
</section>
<!--End Shop Details Top-->
<style>
   input.form-control {
   padding: 10px;
   margin: 0px 0px 25px 0px;
   }
</style>