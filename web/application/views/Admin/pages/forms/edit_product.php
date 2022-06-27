<div class="content-wrapper">
   <div class="row">
      <div class="col-md-12 grid-margin stretch-card">
         <div class="card">
            <div class="card-body">
               <h4 class="card-title">Add Product</h4>
               <?php
                  $success_msg= $this->session->flashdata('success_msg');
                  $error_msg= $this->session->flashdata('error_msg');
                  
                  if($success_msg){
                  ?>
               <div class="alert alert-success" role="alert">
                  <?php echo $success_msg; ?>
               </div>
               <?php
                  }
                  if($error_msg){
                  ?>
               <div class="alert alert-danger" role="alert">
                  <?php echo $error_msg; ?>
               </div>
               <?php
                  }
                  ?>
               <form class="forms-sample" method="POST" enctype="multipart/form-data">
                  <div class="row">
                     <div class="col-md-4">
                        <div class="fix_bar">
                           <div class="form-group">
                              <label for="upload_imgs">Product Image</label>
                              <input id="upload_imgs" class="show-for-sr form-control" type="file" name="product_image[]" multiple>
                              <div class="quote-imgs-thumbs quote-imgs-thumbs--hidden" id="img_preview" aria-live="polite"></div>
                              <?php if(!empty($product['product_image'])) { ?>
                              <?php $product_image_img=explode(",", $product['product_image']);
                                 foreach ($product_image_img as $key => $product_imageimg) {
                                 ?>
                              <img class="mt-2" src="<?php echo base_url();?>/uploads/product/<?php echo $product_imageimg; ?>" alt="Image_not_found" style="width:10%;">
                              <?php } ?>
                              <?php } else {}?>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-8">
                        <div class="row">
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label for="Profile">Product Name</label>
                                 <input id="Profile" class="form-control" value="<?php echo $product['product_name'];?>" type="text" name="product_name" placeholder="Enter Product Name" required>
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label for="exampleInputUsername1">Category Name</label>
                                 <select class="js-example-basic-single w-100" id="sid" name="cname" required>
                                    <option value="">Select Category</option>
                                    <?php 
                                       $category = $this->db->get('categories')->result_array();
                                       foreach($category as $cat) {
                                       
                                       ?>
                                    <option <?php if($cat['id'] == $product['cname']) { ?> selected <?php } else { } ?> value="<?php echo $cat['id']; ?>"><?php echo $cat['cname']; ?></option>
                                    <?php } ?>
                                 </select>
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label for="Sku">Sku</label>
                                 <input id="Sku" class="form-control" type="text" value="<?php echo $product['sku'];?>" name="sku" placeholder="Enter Sku Code">
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label for="exampleInputUsername1">Sub Category Name</label>
                                 <select class="js-example-basic-single w-100" id="did" name="sname" required >
                                    <?php 
                                       $subcategories = $this->db->get('subcategories')->result_array();
                                       foreach($subcategories as $sub_cat) {
                                       ?>
                                    <option <?php if($sub_cat['id'] == $product['sname']) { ?> selected <?php } else { } ?> value="<?php echo $sub_cat['id']; ?>"><?php echo $sub_cat['sname']; ?></option>
                                    <?php } ?>	 
                                 </select>
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label for="collection">Collection</label>
                                 <input id="collection" class="form-control" value="<?php echo $product['collection'];?>" type="text" name="collection" placeholder="Enter Collection Name">
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label for="exampleInputUsername1">Brand Name</label>
                                 <select class="js-example-basic-single w-100"  name="brand" required >
                                    <option value="">Select Brand</option>
                                    <?php 
                                       $brand = $this->db->get('brand')->result_array();
                                       foreach($brand as $ba) {
                                       
                                       ?>
                                    <option <?php if($ba['id'] == $product['brand']) { ?> selected <?php } else { } ?> value="<?php echo $ba['id']; ?>"><?php echo $ba['bname']; ?></option>
                                    <?php } ?>
                                 </select>
                              </div>
                           </div>
                        </div>
                        <h4 class="card-title">Dimentions</h4>
                        <div class="row">
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label for="lenth_width">Lenth x Width</label>
                                 <input id="lenth_width" class="form-control" type="text" value="<?php echo $product['lenth_width'];?>" name="lenth_width" placeholder="Enter Lenth x Width">
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label for="height">Height</label>
                                 <input id="height" class="form-control" type="text" value="<?php echo $product['height'];?>" name="height" placeholder="Enter Height">
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label for="l_w_h">Lenth x Width x Height</label>
                                 <input id="l_w_h" class="form-control" type="text" value="<?php echo $product['l_w_h'];?>" name="l_w_h" placeholder="Enter Lenth x Width x Height">
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label for="thickness">Thickness</label>
                                 <input id="thickness" class="form-control" type="text" value="<?php echo $product['thickness_input'];?>" name="thickness_input" placeholder="Enter Thickness">
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label for="area">Area</label>
                                 <input id="area" class="form-control" type="text" value="<?php echo $product['area'];?>" name="area" placeholder="Enter Area">
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label for="jpegimg">Jpeg of dimention if any</label>
                                 <input id="jpegimg" class="form-control" type="file" name="d_image" >
                                 <?php if(!empty($product['d_image'])) { ?>
                                 <img class="mt-2" src="<?php echo base_url();?>/uploads/product/<?php echo $product['d_image'];?>" style="width:20%;">
                                 <?php } else {} ?>
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label for="c_origin">Country of origin</label>
                                 <input id="c_origin" class="form-control" type="text" value="<?php echo $product['c_origin'];?>" name="c_origin" placeholder="Enter Country of origin">
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label for="manufacture_year">Manufacture year</label>
                                 <input id="manufacture_year" class="form-control" type="text" value="<?php echo $product['manufacture_year'];?>" name="manufacture_year" placeholder="Enter Manufacture year">
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label for="designer">Designer</label>
                                 <input id="designer" class="form-control" type="text" value="<?php echo $product['designer'];?>" name="designer" placeholder="Enter Designer">
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label for="price_range">Price range </label>
                                 <input id="price_range" class="form-control" type="text" value="<?php echo $product['price_range'];?>" name="price_range" placeholder="Enter Price range">
                              </div>
                           </div>
                        </div>
                        <label for="sensor">Color</label>
                        <div class="row mb-3">
                           <?php $color = $this->db->get('color')->result_array();
                              $colorb = explode(",",$product['color']);
                              foreach($color as $col) { ?>
                           <div class="col-md-3">
                              <div class="form-check">
                                 <label class="form-check-label">
                                 <img src="<?php echo base_url();?>uploads/color/<?php echo $col['images'];?>" style="width:7%;">
                                 <input <?php if(in_array($col['id'],$colorb )){ ?> checked <?php } else {} ?>  type="checkbox" class="form-check-input" name="color[]" value="<?php echo $col['id']; ?>">
                                 <?php echo $col['name']; ?>
                                 </label>
                              </div>
                           </div>
                           <?php } ?>
                        </div>
                        <div class="form-group">
                           <label for="designer">Tags</label>
                           <input class="form-control"  name="tags[]" id="tags" value="<?php echo $product['tags']; ?>" />
                        </div>
                        <label for="sensor">Sensor</label>
                        <div class="row">
                           <div class="col-md-1">
                              <div class="form-check">
                                 <label class="form-check-label">
                                 <input type="radio" class="form-check-input" name="sensor" id="optionsRadios2" value="Yes" <?php if($product['sensor'] =="Yes") { ?> checked <?php } else {} ?> >
                                 Yes
                                 </label>
                              </div>
                           </div>
                           <div class="col-md-1">
                              <div class="form-check">
                                 <label class="form-check-label">
                                 <input type="radio" class="form-check-input" name="sensor" id="optionsRadios2" value="No" <?php if($product['sensor'] =="No") { ?> checked <?php } else {} ?> >
                                 No
                                 </label>
                              </div>
                           </div>
                           <div class="col-md-2">
                              <div class="form-check">
                                 <label class="form-check-label">
                                 <input type="radio" class="form-check-input" name="sensor" id="optionsRadios3" value="0" <?php if($product['sensor'] =="0") { ?> checked <?php } else {} ?> >
                                 Not applicable
                                 </label>
                              </div>
                           </div>
                        </div>
                        <hr>
                        <label for="area">Indoor/outdoor</label>
                        <div class="row">
                           <div class="col-md-2">
                              <div class="form-check">
                                 <label class="form-check-label">
                                 <input type="radio" class="form-check-input" name="indoor_outdoor" id="indoor_outdoor" value="Indoor" <?php if($product['indoor_outdoor'] =="Indoor") { ?> checked <?php } else {} ?> >
                                 Indoor
                                 </label>
                              </div>
                           </div>
                           <div class="col-md-2">
                              <div class="form-check">
                                 <label class="form-check-label">
                                 <input type="radio" class="form-check-input" name="indoor_outdoor" id="indoor_outdoor" value="outdoor" <?php if($product['indoor_outdoor'] =="outdoor") { ?> checked <?php } else {} ?> >
                                 outdoor
                                 </label>
                              </div>
                           </div>
                           <div class="col-md-2">
                              <div class="form-check">
                                 <label class="form-check-label">
                                 <input type="radio" class="form-check-input" name="indoor_outdoor" id="indoor_outdoor" value="outdoor" <?php if($product['indoor_outdoor'] =="Indoor/outdoor") { ?> checked <?php } else {} ?> >
                                 Indoor/Outdoor
                                 </label>
                              </div>
                           </div>
                           <div class="col-md-2">
                              <div class="form-check">
                                 <label class="form-check-label">
                                 <input type="radio" class="form-check-input" name="indoor_outdoor" id="indoor_outdoor" value="0"  <?php if($product['indoor_outdoor'] =="0") { ?> checked <?php } else {} ?>>
                                 Not applicable
                                 </label>
                              </div>
                           </div>
                        </div>
                        <hr>
                        <h4 class="card-title mt-3">Filter</h4>
                        <label for="installation">Installation</label>
                        <div class="row mb-3">
                           <?php $installation = $this->db->get('installation')->result_array();
                              $installationabc = explode(",",$product['installation']);
                              foreach($installation as $ins) { ?>
                           <div class="col-md-3">
                              <div class="form-check">
                                 <label class="form-check-label">
                                 <input <?php if(in_array($ins['id'],$installationabc )){ ?> checked <?php } else {} ?> type="checkbox" class="form-check-input" name="installation[]" value="<?php echo $ins['id']; ?>">
                                 <?php echo $ins['text']; ?>
                                 </label>
                              </div>
                           </div>
                           <?php } ?>
                           <div class="col-md-3">
                              <div class="form-check">
                                 <label class="form-check-label">
                                 <input type="checkbox" class="form-check-input" name="installation[]" value="0" <?php if($product['installation'] =="0") { ?> checked <?php } else {} ?> >
                                 Not applicable
                                 </label>
                              </div>
                           </div>
                        </div>
                        <hr>
                        <label for="application">Application</label>
                        <div class="row mb-3">
                           <?php $application = $this->db->get('application')->result_array();
                              $applicationabc = explode(",",$product['application']);
                              foreach($application as $app) { ?>
                           <div class="col-md-3">
                              <div class="form-check">
                                 <label class="form-check-label">
                                 <input <?php if(in_array($app['id'],$applicationabc )){ ?> checked <?php } else {} ?> type="checkbox" class="form-check-input" name="application[]" value="<?php echo $app['id']; ?>">
                                 <?php echo $app['application']; ?>
                                 </label>
                              </div>
                           </div>
                           <?php } ?>
                           <div class="col-md-3">
                              <div class="form-check">
                                 <label class="form-check-label">
                                 <input type="checkbox" class="form-check-input" name="application[]" value="0" <?php if($product['application'] =="0") { ?> checked <?php } else {} ?>>
                                 Not applicable
                                 </label>
                              </div>
                           </div>
                        </div>
                        <hr>
                        <label for="material">Material</label>
                        <div class="row mb-3">
                           <?php $material = $this->db->get('material')->result_array();
                              $materialabc = explode(",",$product['material']);
                              foreach($material as $mate) { ?>
                           <div class="col-md-3">
                              <div class="form-check">
                                 <label class="form-check-label">
                                 <input <?php if(in_array($mate['id'],$materialabc )){ ?> checked <?php } else {} ?> type="checkbox" class="form-check-input" name="material[]" value="<?php echo $mate['id']; ?>">
                                 <?php echo $mate['material']; ?>
                                 </label>
                              </div>
                           </div>
                           <?php } ?>
                           <div class="col-md-3">
                              <div class="form-check">
                                 <label class="form-check-label">
                                 <input type="checkbox" class="form-check-input" name="material[]" value="0" <?php if($product['material'] =="0") { ?> checked <?php } else {} ?>>
                                 Not applicable
                                 </label>
                              </div>
                           </div>
                        </div>
                        <hr>
                        <label for="shape">Shape</label>
                        <div class="row mb-3">
                           <?php $shape = $this->db->get('shape')->result_array();
                              $shapabc = explode(",",$product['shape']);
                              foreach($shape as $shap) { ?>
                           <div class="col-md-3">
                              <div class="form-check">
                                 <label class="form-check-label">
                                 <input <?php if(in_array($shap['id'],$shapabc )){ ?> checked <?php } else {} ?> type="checkbox" class="form-check-input" name="shape[]" value="<?php echo $shap['id']; ?>">
                                 <?php echo $shap['shape']; ?>
                                 </label>
                              </div>
                           </div>
                           <?php } ?>
                           <div class="col-md-3">
                              <div class="form-check">
                                 <label class="form-check-label">
                                 <input type="checkbox" class="form-check-input" name="shape[]" value="0" <?php if($product['shape'] =="0") { ?> checked <?php } else {} ?>>
                                 Not applicable
                                 </label>
                              </div>
                           </div>
                        </div>
                        <hr>
                        <label for="effects">Effects</label>
                        <div class="row mb-3">
                           <?php $effects = $this->db->get('effects')->result_array();
                              $effectsabc = explode(",",$product['effects']);
                              foreach($effects as $eff) { ?>
                           <div class="col-md-3">
                              <div class="form-check">
                                 <label class="form-check-label">
                                 <input <?php if(in_array($eff['id'],$effectsabc )){ ?> checked <?php } else {} ?> type="checkbox" class="form-check-input" name="effects[]" value="<?php echo $eff['id']; ?>">
                                 <?php echo $eff['effects']; ?>
                                 </label>
                              </div>
                           </div>
                           <?php } ?>
                           <div class="col-md-3">
                              <div class="form-check">
                                 <label class="form-check-label">
                                 <input type="checkbox" class="form-check-input" name="effects[]" value="0" <?php if($product['effects'] =="0") { ?> checked <?php } else {} ?>>
                                 Not applicable
                                 </label>
                              </div>
                           </div>
                        </div>
                        <hr>
                        <label for="finish">Finish</label>
                        <div class="row mb-3">
                           <?php $finish = $this->db->get('finish')->result_array();
                              $finishabc = explode(",",$product['finish']);
                              foreach($finish as $fini) { ?>
                           <div class="col-md-3">
                              <div class="form-check">
                                 <label class="form-check-label">
                                 <input <?php if(in_array($fini['id'],$finishabc )){ ?> checked <?php } else {} ?> type="checkbox" class="form-check-input" name="finish[]" value="<?php echo $fini['id']; ?>">
                                 <?php echo $fini['finish']; ?>
                                 </label>
                              </div>
                           </div>
                           <?php } ?>
                           <div class="col-md-3">
                              <div class="form-check">
                                 <label class="form-check-label">
                                 <input type="checkbox" class="form-check-input" name="finish[]" value="0" <?php if($product['finish'] =="0") { ?> checked <?php } else {} ?>>
                                 Not applicable
                                 </label>
                              </div>
                           </div>
                        </div>
                        <hr>
                        <label for="size">Size</label>
                        <div class="row mb-3">
                           <?php $size = $this->db->get('size')->result_array();
                              $sizeabc = explode(",",$product['size']);
                              foreach($size as $si) { ?>
                           <div class="col-md-3">
                              <div class="form-check">
                                 <label class="form-check-label">
                                 <input <?php if(in_array($si['id'],$sizeabc )){ ?> checked <?php } else {} ?> type="checkbox" class="form-check-input" name="size[]" value="<?php echo $si['id']; ?>">
                                 <?php echo $si['size']; ?>
                                 </label>
                              </div>
                           </div>
                           <?php } ?>
                           <div class="col-md-3">
                              <div class="form-check">
                                 <label class="form-check-label">
                                 <input type="checkbox" class="form-check-input" name="size[]" value="0" <?php if($product['size'] =="0") { ?> checked <?php } else {} ?>>
                                 Not applicable
                                 </label>
                              </div>
                           </div>
                        </div>
                        <hr>
                        <label for="thicknessa">Thickness</label>
                        <div class="row mb-3">
                           <?php $thickness = $this->db->get('thickness')->result_array();
                              $thicknessabc = explode(",",$product['thickness']);
                              foreach($thickness as $thi) { ?>
                           <div class="col-md-3">
                              <div class="form-check">
                                 <label class="form-check-label">
                                 <input <?php if(in_array($thi['id'],$thicknessabc )){ ?> checked <?php } else {} ?> type="checkbox" class="form-check-input" name="thickness[]" value="<?php echo $thi['id']; ?>">
                                 <?php echo $thi['thickness']; ?>
                                 </label>
                              </div>
                           </div>
                           <?php } ?>
                           <div class="col-md-3">
                              <div class="form-check">
                                 <label class="form-check-label">
                                 <input type="checkbox" class="form-check-input" name="thickness[]" value="0" <?php if($product['thickness'] =="0") { ?> checked <?php } else {} ?>>
                                 Not applicable
                                 </label>
                              </div>
                           </div>
                        </div>
                        <hr>
                        <label for="type">Type</label>
                        <div class="row mb-3">
                           <?php $type = $this->db->get('type')->result_array();
                              $typeabc = explode(",",$product['type']);
                              foreach($type as $ty) { ?>
                           <div class="col-md-3">
                              <div class="form-check">
                                 <label class="form-check-label">
                                 <input <?php if(in_array($ty['id'],$typeabc )){ ?> checked <?php } else {} ?> type="checkbox" class="form-check-input" name="type[]" value="<?php echo $ty['id']; ?>">
                                 <?php echo $ty['type']; ?>
                                 </label>
                              </div>
                           </div>
                           <?php } ?>
                           <div class="col-md-3">
                              <div class="form-check">
                                 <label class="form-check-label">
                                 <input type="checkbox" class="form-check-input" name="type[]" value="0" <?php if($product['type'] =="0") { ?> checked <?php } else {} ?>>
                                 Not applicable
                                 </label>
                              </div>
                           </div>
                        </div>
                        <hr>
                        <label for="themes">Themes</label>
                        <div class="row mb-3">
                           <?php $themes = $this->db->get('themes')->result_array();
                              $themesabc = explode(",",$product['themes']);
                              foreach($themes as $the) { ?>
                           <div class="col-md-3">
                              <div class="form-check">
                                 <label class="form-check-label">
                                 <input <?php if(in_array($the['id'],$themesabc )){ ?> checked <?php } else {} ?> type="checkbox" class="form-check-input" name="themes[]" value="<?php echo $the['id']; ?>">
                                 <?php echo $the['themes']; ?>
                                 </label>
                              </div>
                           </div>
                           <?php } ?>
                           <div class="col-md-3">
                              <div class="form-check">
                                 <label class="form-check-label">
                                 <input type="checkbox" class="form-check-input" name="themes[]" value="0" <?php if($product['themes'] =="0") { ?> checked <?php } else {} ?>>
                                 Not applicable
                                 </label>
                              </div>
                           </div>
                        </div>
                        <hr>
                        <label for="light_bulb">Light Bulb Type</label>
                        <div class="row mb-3">
                           <?php $light_bulb = $this->db->get('light_bulb_type')->result_array();
                              $light_bulbabc =  explode(",",$product['light_bulb']);
                              foreach($light_bulb as $light) { ?>
                           <div class="col-md-3">
                              <div class="form-check">
                                 <label class="form-check-label">
                                 <input <?php if(in_array($light['id'],$light_bulbabc )){ ?> checked <?php } else {} ?> type="checkbox" class="form-check-input" name="light_bulb[]" value="<?php echo $light['id']; ?>">
                                 <?php echo $light['light_bulb']; ?>
                                 </label>
                              </div>
                           </div>
                           <?php } ?>
                           <div class="col-md-3">
                              <div class="form-check">
                                 <label class="form-check-label">
                                 <input type="checkbox" class="form-check-input" name="light_bulb[]" value="0" <?php if($product['light_bulb'] =="0") { ?> checked <?php } else {} ?>>
                                 Not applicable
                                 </label>
                              </div>
                           </div>
                        </div>
                        <hr>
                        <label for="number_of_seat">Number Of Seat</label>
                        <div class="row mb-3">
                           <?php $number_of_seat = $this->db->get('number_of_seat')->result_array();
                              $number_of_seatabc =  explode(",",$product['number_of_seat']);
                              foreach($number_of_seat as $num_seat) { ?>
                           <div class="col-md-3">
                              <div class="form-check">
                                 <label class="form-check-label">
                                 <input <?php if(in_array($num_seat['id'],$number_of_seatabc )){ ?> checked <?php } else {} ?> type="checkbox" class="form-check-input" name="number_of_seat[]" value="<?php echo $num_seat['id']; ?>">
                                 <?php echo $num_seat['number_of_seat']; ?>
                                 </label>
                              </div>
                           </div>
                           <?php } ?>
                           <div class="col-md-3">
                              <div class="form-check">
                                 <label class="form-check-label">
                                 <input type="checkbox" class="form-check-input" name="number_of_seat[]" value="0" <?php if($product['number_of_seat'] =="0") { ?> checked <?php } else {} ?>>
                                 Not applicable
                                 </label>
                              </div>
                           </div>
                        </div>
                        <hr>
                        <label for="bed_size">Bed Size</label>
                        <div class="row mb-3">
                           <?php $bed_size = $this->db->get('bed_size')->result_array();
                              $bed_sizeabc =  explode(",",$product['bed_size']);
                              foreach($bed_size as $bed) { ?>
                           <div class="col-md-3">
                              <div class="form-check">
                                 <label class="form-check-label">
                                 <input <?php if(in_array($bed['id'],$bed_sizeabc )){ ?> checked <?php } else {} ?> type="checkbox" class="form-check-input" name="bed_size[]" value="<?php echo $bed['id']; ?>">
                                 <?php echo $bed['bed_size']; ?>
                                 </label>
                              </div>
                           </div>
                           <?php } ?>
                           <div class="col-md-3">
                              <div class="form-check">
                                 <label class="form-check-label">
                                 <input type="checkbox" class="form-check-input" name="bed_size[]" value="0" <?php if($product['bed_size'] =="0") { ?> checked <?php } else {} ?>>
                                 Not applicable
                                 </label>
                              </div>
                           </div>
                        </div>
                        <hr>
                        <label for="bowl">Bowl</label>
                        <div class="row mb-3">
                           <?php $bowl = $this->db->get('bowl')->result_array();
                              $bowlabc =  explode(",",$product['bowl']);
                              foreach($bowl as $bo) { ?>
                           <div class="col-md-3">
                              <div class="form-check">
                                 <label class="form-check-label">
                                 <input  <?php if(in_array($bo['id'],$bowlabc )){ ?> checked <?php } else {} ?> type="checkbox" class="form-check-input" name="bowl[]" value="<?php echo $bo['id']; ?>">
                                 <?php echo $bo['bowl']; ?>
                                 </label>
                              </div>
                           </div>
                           <?php } ?>
                           <div class="col-md-3">
                              <div class="form-check">
                                 <label class="form-check-label">
                                 <input type="checkbox" class="form-check-input" name="bowl[]" value="0" <?php if($product['bowl'] =="0") { ?> checked <?php } else {} ?>>
                                 Not applicable
                                 </label>
                              </div>
                           </div>
                        </div>
                        <hr>
                        <div class="row">
                           <div class="col-md-12">
                              <div class="form-group">
                                 <label for="cad">CAD, 3D, PDF</label>
                                 <input id="cad" class="form-control" type="file" name="cad[]" multiple>
                                 <?php if(!empty($product['cad'])) { ?>
                                 <?php $cad_img=explode(",", $product['cad']);
                                    foreach ($cad_img as $key => $cadimg) {
                                    ?>
                                 <img class="mt-2" src="<?php echo base_url();?>/uploads/product/<?php echo $cadimg; ?>" alt="Image_not_found" style="width:10%;">
                                 <?php } ?>
                                 <?php } else {}?>
                              </div>
                           </div>
                        </div>
                        <div class="row mb-5">
                           <div class="col-md-12">
                              <div class="form-group customer_records">
                                 <label for="video_link">Video Link</label>
                                 <input id="video_link" class="form-control" type="text" name="video_link[]" placeholder="Enter Video Link" >
                              </div>
                           </div>
                           <div class="col-md-12 ">
                              <a class="extra-fields-customer btn btn-gradient-success">Add More Video Link</a>
                              <div class="customer_records_dynamic mt-2">
                                 <?php
                                    $vid = $product['id'];
                                    $video = $this->db->query("SELECT * FROM `product_video` WHERE product_id ='$vid'")->result_array();
                                    foreach($video as $vd)
                                    {
                                    ?>
                                 <div class="remove">
                                    <label for="video_link">Video Link</label>
                                    <input id="video_link" class="form-control" type="text" name="video_link[]" placeholder="Enter Video Link" value="<?php echo $vd['videolink']; ?>">
                                    <a href="#" class="remove-field btn-remove-customer btn btn-gradient-danger mb-2 mt-3">Remove Fields</a>
                                 </div>
                                 <?php
                                    }
                                    ?>
                              </div>
                           </div>
                        </div>
                        <label for="number_of_seat mt-5 mb-3">Variant</label>
                        <div class="table-repsonsive mb-3">
                           <span id="error"></span>
                           <table class="table table-bordered" id="item_table">
                              <thead>
                                 <tr>
                                    <th>Variant Name</th>
                                    <th>Variant Code</th>
                                    <th>Variant Image</th>
                                    <th><button type="button" name="add" class="btn btn-success btn-xs add"><span><i class="ti-plus"></i></span></button>
                                       <?php
                                          $vid = $product['id'];
                                          $vcount = $this->db->query("SELECT * FROM `product_color` WHERE product_id ='$vid'")->num_rows();
                                          ?>
                                       <input type="hidden" id="vlength" value="<?php echo $vcount; ?>">
                                    </th>
                                 </tr>
                              </thead>
                              <tbody>
                                 <?php
                                    $vid = $product['id'];
                                    $vproduct = $this->db->query("SELECT * FROM `product_color` WHERE product_id ='$vid'")->result_array();
                                    $no = 0;
                                    foreach($vproduct as $vp)
                                    {
                                    ?>
                                 <tr>
                                    <td><input type="text" name="variant_name[]" class="form-control " required=""  value="<?php echo $vp['variant_name']; ?>"></td>
                                    <td><input type="text" name="variant_code[]" class="form-control " required="" value="<?php echo $vp['variant_code']; ?>"></td>
                                    <td><input type="file" name="img_<?php echo $no; ?>" class="form-control "><img src="<?php echo base_url('uploads/color/'.$vp['variant_image']); ?>" width="30"></td>
                                    <td><button type="button" name="remove" class="btn btn-danger btn-xs remove"><span> <i class="ti-minus"></i></span></button></td>
                                 </tr>
                                 <?php
                                    $no = $no + 1;
                                    }
                                    ?>
                              </tbody>
                           </table>
                        </div>
                        <div class="form-group">
                           <label for="designer">Description</label>
                           <textarea id="summernoteExample" name="description"><?php echo $product['description']; ?></textarea>
                        </div>
                     </div>
                     <button name="submit" type="submit" class="btn btn-gradient-primary mr-2" style="width:100%;">Submit</button>
               </form>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>