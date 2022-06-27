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
				  <?php $Catagory = $this->db->get_where('categories',array('id'=> $product['cname']))->row_array(); ?>
                  <li><a href="<?php echo base_url('sub-category/'.str_replace(' ', '_', $Catagory['cname']));?>"><?php echo $Catagory['cname'];?></a></li>
                  <li><a href="#"> > </a></li>
				  <?php $sub_cat = $this->db->get_where('subcategories',array('id'=> $product['sname']))->row_array(); ?>
                  <li><a href="<?php echo base_url('product-list/'.str_replace(' ', '_', $sub_cat['sname']));?>"><?php echo $sub_cat['sname'];?></a></li>
                  
                  <li><a href="#"> > </a></li>
                  <li class="active"><?php  echo $product['product_name'];?></li>
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
							
							<?php   
							 $user_id = $this->session->userdata('user_id');
							 $get_wishlist = $this->db->get_where('wishlist',array('user_id' =>$user_id,'product_id'=>$product['id']))->num_rows();
							 if($get_wishlist == 0) {
							 ?>
                           <a href="<?php if(!empty($user_id)) { ?><?php echo base_url('add-product-wishlist/').$product['id'].'/'.$this->uri->segment(2); ?> <?php } else { ?><?php echo base_url('login');?><?php } ?>" class="pshare"> <i class="far fa-heart"></i> </a>
						   
						    <?php } else{ ?>
						   
						    <a href="<?php echo base_url('remove-product-wishlist/').$product['id'].'/'.$this->uri->segment(2); ?>" class="pshare"> <i class="fa-solid fa-heart"></i> </a>
						   
						    <?php } ?>
						   
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
                  <a href="<?php echo base_url('resellers/'.str_replace(' ', '_', $product['product_name'])); ?>" class="btn--primary newbtn">GET NEARBY RESELLERS LIST</a> 
               </div>
               <div class="shop-details-top-buy-now-btn"> 
                  <a href="#b_form"  class="btn--primary newbtn">CONTACT BRAND</a> 
               </div>
            </div>
         </div>
      </div>
      <div class="col-md-6">
         <div class="overview mt-2">
            <p>Overview</p>
         </div>
         <h3 class="mt-3 mb-3"><?php echo $product['product_name']; ?>  by  <?php  $brand = $this->db->get_where('brand',array('id' => $product['brand']))->row_array(); echo $brand['bname'];  ?></h3>
         <div class="row ">
            <div class="col-md-3">
               <p class="p_side">Collection</p>
               <p class="p_side">Manufacture year</p>
               <?php if($product['effects'] ==0) { } else { ?>
               <p class="p_side">Effects</p>
               <?php } ?>
               <?php if($product['application'] ==0) { } else { ?>
               <p class="p_side">Application</p>
               <?php } ?>
               <p class="p_side">SKU</p>
               <?php if($product['type'] ==0) { } else { ?>
               <p class="p_side">Type</p>
               <?php } ?>
               <p class="p_side">Sensor</p>
               <p class="p_side">Indoor/outdoor</p>
               <?php if($product['installation'] ==0) { } else { ?>
               <p class="p_side">Installation</p>
               <?php } ?>
               <?php if($product['shape'] ==0) { } else { ?>
               <p class="p_side">Shape</p>
               <?php } ?> 
               <?php if($product['thickness'] ==0) { } else { ?>
               <p class="p_side">Thickness</p>
               <?php } ?> 
               <?php if($product['themes'] ==0) { } else { ?>
               <p class="p_side">Themes</p>
               <?php } ?>
               <?php if($product['light_bulb'] ==0) { } else { ?>
               <p class="p_side">Light Bulb Type</p>
               <?php } ?>
               <?php if($product['number_of_seat'] ==0) { } else { ?>
               <p class="p_side">Number Of Seat</p>
               <?php } ?>
               <?php if($product['bed_size'] ==0) { } else { ?>
               <p class="p_side">Bed Size</p>
               <?php } ?>
               <?php if($product['bowl'] ==0) { } else { ?>
               <p class="p_side">Bowl</p>
               <?php } ?>
            </div>
            <div class="col-md-9">
               <p><?php echo $product['collection']; ?></p>
               <p><?php echo $product['manufacture_year']; ?></p>
               <?php if($product['effects'] ==0) { } else { ?>
               <p>
                  <?php $effects=explode(",", $product['effects']);
                     foreach ($effects as $key => $eff) {
                     $effect = $this->db->get_where('effects',array('id' => $eff))->row_array();
                     
                     echo $effect['effects'].","; }
                     ?>
               </p>
               <?php } ?>
               <?php if($product['application'] ==0) { } else { ?>
               <p>
                  <?php $application=explode(",", $product['application']);
                     foreach ($application as $key => $applic) {
                     $applicatio = $this->db->get_where('application',array('id' => $applic))->row_array();
                     
                     echo $applicatio['application'].","; }
                     ?>
               </p>
               <?php } ?>
               <p><?php echo $product['sku']; ?></p>
               <?php if($product['type'] ==0) { } else { ?>
               <p>
                  <?php $type=explode(",", $product['type']);
                     foreach ($type as $key => $ty) {
                     $typ = $this->db->get_where('type',array('id' => $ty))->row_array();
                     
                     echo $typ['type'].","; }
                     ?>
               </p>
               <?php } ?>
               <p><?php echo $product['sensor']; ?></p>
               <p><?php echo $product['indoor_outdoor']; ?></p>
               <?php if($product['installation'] ==0) { } else { ?>
               <p>
                  <?php $installation=explode(",", $product['installation']);
                     foreach ($installation as $key => $insta) {
                     $install = $this->db->get_where('installation',array('id' => $insta))->row_array();
                     
                     echo $install['text'].","; }
                     ?>
               </p>
               <?php } ?>
               <?php if($product['shape'] ==0) { } else { ?>
               <p>
                  <?php $shape=explode(",", $product['shape']);
                     foreach ($shape as $key => $shap) {
                     $shpe = $this->db->get_where('shape',array('id' => $shap))->row_array();
                     
                     echo $shpe['shape'].","; }
                     ?>
               </p>
               <?php } ?>
               <?php if($product['thickness'] ==0) { } else { ?>
               <p>
                  <?php $thickness=explode(",", $product['thickness']);
                     foreach ($thickness as $key => $thic) {
                     $thickn = $this->db->get_where('thickness',array('id' => $thic))->row_array();
                     
                     echo $thickn['thickness'].","; }
                     ?>
               </p>
               <?php } ?>
               <?php if($product['themes'] ==0) { } else { ?>
               <p>
                  <?php $themes=explode(",", $product['themes']);
                     foreach ($themes as $key => $them) {
                     $theme = $this->db->get_where('themes',array('id' => $them))->row_array();
                     
                     echo $theme['themes'].","; }
                     ?>
               </p>
               <?php } ?>
               <?php if($product['light_bulb'] ==0) { } else { ?>
               <p>
                  <?php $light_bulb=explode(",", $product['light_bulb']);
                     foreach ($light_bulb as $key => $light_bul) {
                     $light = $this->db->get_where('light_bulb_type',array('id' => $light_bul))->row_array();
                     
                     echo $light['light_bulb'].","; }
                     ?>
               </p>
               <?php } ?>
               <?php if($product['number_of_seat'] ==0) { } else { ?>
               <p>
                  <?php $number_of_seat=explode(",", $product['number_of_seat']);
                     foreach ($number_of_seat as $key => $number_of) {
                     $number_of_sea = $this->db->get_where('number_of_seat',array('id' => $number_of))->row_array();
                     
                     echo $number_of_sea['number_of_seat'].","; }
                     ?>
               </p>
               <?php } ?>
               <?php if($product['bed_size'] ==0) { } else { ?>
               <p>
                  <?php $bed_size=explode(",", $product['bed_size']);
                     foreach ($bed_size as $key => $bed_siz) {
                     $bed = $this->db->get_where('bed_size',array('id' => $bed_siz))->row_array();
                     
                     echo $bed['bed_size'].","; }
                     ?>
               </p>
               <?php } ?>
               <?php if($product['bowl'] ==0) { } else { ?>
               <p>
                  <?php $bowl=explode(",", $product['bowl']);
                     foreach ($bowl as $key => $bow) {
                     $bo = $this->db->get_where('bowl',array('id' => $bow))->row_array();
                     
                     echo $bo['bowl'].","; }
                     ?>
               </p>
               <?php } ?>
            </div>
         </div>
         <p class="mt-2"><?php echo $product['description']; ?></p>
         <div class="accordion-item mt-5 >
            <h2 class="accordion-header" id="headingTwo">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo"> Dimensions
            </button> </h2>
            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample" style="">
               <div class="accordion-body">
                   <div class="row ">
                     <div class="col-md-3">
                        <p>Trickness</p>
						</div>
					 <div class="col-md-9">
					 <p><?php echo $product['thickness_input']; ?></p>
					</div>
					<div class="col-md-3">	
                        <p>Sizes: </p>
					</div>
					<div class="col-md-9">
					<p><?php echo $product['lenth_width'] ?>, <?php echo $product['height'] ?>, <?php echo $product['l_w_h'] ?> </p>
					</div>
					<div class="col-md-3">	
                        <p>Area:</p>
						</div>
						<div class="col-md-9">
						 <p><?php echo $product['area'] ?></p>
						</div>
                     </div>
               </div>
            </div>
            <h2 class="accordion-header" id="headingTwo mt-3">
               <button class="accordion-button collapsed mt-3" type="button" data-bs-toggle="collapse" data-bs-target="#cad" aria-expanded="false" aria-controls="cad"> CAD, 3D, PDF 
               </button> 
            </h2>
            <div id="cad" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample" >
               <div class="accordion-body">
                  <div class="row ">
                     <?php $pdf=explode(",", $product['cad']);
                        foreach ($pdf as $key => $valuea) {
                         ?>
                     <div class="col-md-1">
                        <a class="cad_link" target="_blank" href="<?php echo base_url();?>uploads/product/<?php echo $valuea; ?>">
                        <i class="fa-solid fa-file cad_icon"></i>
                        </a>	
                     </div>
                     <?php } ?> 
                  </div>
               </div>
            </div>
            <h2 class="accordion-header" id="headingTwo mt-3">
               <button class="accordion-button collapsed mt-3" type="button" data-bs-toggle="collapse" data-bs-target="#catalogues" aria-expanded="false" aria-controls="catalogues"> Catalogues
               </button> 
            </h2>
            <div id="catalogues" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample" >
               <div class="accordion-body">
                  <div class="row ">
				  <?php  $cataloguea = $this->db->get_where('catalogue',array('brand' => $product['brand']))->result_array();  
                     
                        foreach ($cataloguea as $key => $catal) {
                         ?>
                     <div class="col-md-2">
                        <a class="cad_link" target="_blank" href="<?php echo base_url();?>uploads/catalogue/<?php echo $catal['pdf']; ?>">
                        <img src="<?php echo base_url();?>uploads/catalogue/<?php echo $catal['images']; ?>">
                        </a>	
                     </div>
                     <?php } ?> 
                  </div>
               </div>
            </div>
            <h2 class="accordion-header" id="headingTwo mt-3">
               <button class="accordion-button collapsed mt-3" type="button" data-bs-toggle="collapse" data-bs-target="#video" aria-expanded="false" aria-controls="video"> Videos
               </button> 
            </h2>
            <div id="video" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample" >
               <div class="accordion-body">
                  <div class="row ">
                     <?php $product_video = $this->db->get_where('product_video',array('product_id' => $product['id']))->result_array();
                        foreach ($product_video as  $p_video) {
                         ?>
                     <div class="col-md-1">
						<?php if(!empty($p_video['videolink'])) { ?>
                        <a class="cad_link" target="_blank" href="<?php echo $p_video['videolink'];?>">
                        <i class="fa-solid fa-video cad_icon"></i>
                        </a>
						<?php } ?>	
                     </div>
                     <?php } ?> 
                  </div>
               </div>
            </div>
            <h2 class="accordion-header" id="headingTwo mt-3">
               <button class="accordion-button collapsed mt-3" type="button" data-bs-toggle="collapse" data-bs-target="#tags" aria-expanded="false" aria-controls="tags"> Tags
               </button> 
            </h2>
            <div id="tags" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample" >
               <div class="accordion-body">
                  <p><?php echo $product['tags']; ?></p>
               </div>
            </div>
            <div class="req_form mt-5 " id="b_form">
               <div class="form_head">
                  <h4>Request for information</h4>
               </div>
               <div class="form_body">
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
                  <div class="row ">
                     <div class="col-md-2">
                        <div class="logo_img">
                           <img src="<?php echo base_url();?>uploads/brand/<?php echo $brand_logo['images'];?>">
                        </div>
                     </div>
                     <div class="col-md-10">
                        <div class="text_req">
                           <h5>Get in touch with</h5>
                           <h3><?php  $brand = $this->db->get_where('brand',array('id' => $product['brand']))->row_array(); echo $brand['bname'];  ?></h3>
						  
                        </div>
                     </div>
                  </div>
                  <div class="form_contain mt-5" >
                     <form method="POST" action="<?php echo base_url('brand-request');?>">
					     
                        <div class="row"> 
                           <div class="col-md-6">
                              <input type="text" name="f_name"  class="form-control" placeholder="First name">
                           </div>
                           <div class="col-md-6">
                              <input type="text" name="l_name" class="form-control" placeholder="Last name">
                           </div>
                           <div class="col-md-6">
                              <input type="email" name="email" class="form-control" placeholder="Email ">
                           </div>
                           <div class="col-md-6">
                              <input type="text" name="proffasion" class="form-control" placeholder="Proffasion">
                           </div>
                           <div class="col-7">
                              <input type="text" name="compny" class="form-control" placeholder="Compny">
                           </div>
                           <div class="col">
                              <input type="text" name="city" class="form-control" placeholder="City / Town">
                           </div>
                           <div class="col">
                              <input type="number" name="postcode" class="form-control" placeholder="Post code">
                           </div>
                           <div class="col-md-6">
                              <input type="text" name="address" class="form-control" placeholder="Address">
                           </div>
                           <div class="col-md-6">
                              <input type="number" name="m_no" class="form-control" placeholder="Mobile No.">
                           </div>
                           <div class="col-md-12">
                              <label for="exampleInputPassword1" class="form-label">Send a message</label>
                              <textarea class="form-control" id="exampleFormControlTextarea5" name="message" placeholder="Type your request" rows="3" spellcheck="false"></textarea>
                           </div>
						    <?php $user_id = $this->session->userdata('user_id'); ?>
						   <input type="hidden" name="user_id" class="form-control" value="<?php echo $user_id;?>">
						   <input type="hidden" name="brand_id" class="form-control" value="<?php echo $brand['id'];?>">
						   <input type="hidden" name="product_id" class="form-control" value="<?php echo $product['id'];?>">
						   <input type="hidden" name="uri" class="form-control" value="<?php echo $this->uri->segment(2);?>">
						   
                           <div class="col-md-12 text-center mb-3">
                              <button type="submit" class="btn"><i class="fa-brands fa-telegram c_icon"></i> CONTACT</button>
                           </div>
                        </div>
                     </form>
                  </div>
               </div>
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