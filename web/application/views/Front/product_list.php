<?php
   $segment_id = $this->uri->segment(2);
   $newid=str_replace('_', ' ', $segment_id);
   ?>
<input type="hidden" value="<?php echo $newid; ?>" id="segment_id">
<div class="shop-details-breadcrumb wow fadeInUp  overflow-hidden  animated">
   <div class="container mb-4">
      <div class="row">
         <div class="col-xl-12">
            <div class="shop-details-inner">
               <ul class="shop-details-menu">
                  <li><a href="#">Catagory</a></li>
                  <li><a href="#"> > </a></li>
                  <li <a href="#">Finishes</a></li>
                  <li><a href="#"> > </a></li>
                  <li class="active">Tiles</li>
               </ul>
            </div>
            <h3 class="inner_title">Tiles</h3>
         </div>
      </div> 
   </div>
</div>
<main class="overflow-hidden ">
<!--Start product-grid-->
<div class="product-grid pt-60 pb-120">
   <div class="container">
      <div class="row gx-4">
         <div class="col-xl-3 col-lg-4">
            <div class="shop-grid-sidebar">
               <button class="remove-sidebar d-lg-none d-block"> <i
                  class="flaticon-cross"> </i> </button>
               <div class="sidebar-holder">
                  <?php $id = $this->uri->segment(2);
                     $newid=str_replace('_', ' ', $id);
                     $s=$this->db->get_where('subcategories',array('sname' => $newid))->row_array(); 
                     $Installation = $this->db->query("SELECT * FROM filter WHERE id='1' AND  FIND_IN_SET(".$s['id'].",`sub_cat`)")->row_array();
                     if(!empty($Installation)) {
                     ?>
                  <div class="single-sidebar-box mt-30 wow fadeInUp animated ">
                     <h2 class="accordion-header" id="headingTwo"> <button class="accordion-button collapsed"
                        type="button" data-bs-toggle="collapse" data-bs-target="#collapseInstallation"
                        aria-expanded="true" aria-controls="collapseInstallation">Installation
                        </button> 
                     </h2>
                     <div id="collapseInstallation" class="accordion-collapse collapse "
                        aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                        <div class="checkbox-item">
                           <form>
                              <?php $insta=$this->db->get('installation')->result_array();
                                 foreach($insta as $in) {	
                                 $sub_cat = explode(",",$in['sub_cat']);
                                 if(in_array($s['id'],$sub_cat)) {
                                 ?>	   
                              <div class="form-group"> <input type="radio" name="installation" value="<?php echo $in['id'];?>" id="ins<?php echo $in['id'];?>" class="installation"> <label
                                 for="ins<?php echo $in['id'];?>"><?php echo $in['text'];?></label> </div>
                              <?php } }?> 
                           </form>
                        </div>
                     </div>
                  </div>
                  <?php } ?>
               </div>
               <div class="sidebar-holder">
                  <?php $id = $this->uri->segment(2);
                     $newid=str_replace('_', ' ', $id);
                     $s=$this->db->get_where('subcategories',array('sname' => $newid))->row_array(); 
                     $Application = $this->db->query("SELECT * FROM filter WHERE id='2' AND  FIND_IN_SET(".$s['id'].",`sub_cat`)")->row_array();
                     if(!empty($Application)) {
                     ?>
                  <div class="single-sidebar-box mt-30 wow fadeInUp animated ">
                     <h2 class="accordion-header" id="headingTwo"> <button class="accordion-button collapsed"
                        type="button" data-bs-toggle="collapse" data-bs-target="#collapseApplication"
                        aria-expanded="true" aria-controls="collapseApplication">Application
                        </button> 
                     </h2>
                     <div id="collapseApplication" class="accordion-collapse collapse "
                        aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                        <div class="checkbox-item">
                           <form>
                              <?php $appli=$this->db->get('application')->result_array();
                                 foreach($appli as $app) {
                                 $sub_cat = explode(",",$app['sub_cat']);
                                 if(in_array($s['id'],$sub_cat)) {   
                                 ?>	   
                              <div class="form-group"> <input type="radio" name="application" value="<?php echo $app['id'];?>" id="app<?php echo $app['id'];?>" class="application"> <label
                                 for="app<?php echo $app['id'];?>"><?php echo $app['application'];?></label> </div>
                              <?php } } ?> 
                           </form>
                        </div>
                     </div>
                  </div>
                  <?php } ?>
               </div>
               <div class="sidebar-holder">
                  <?php $id = $this->uri->segment(2);
                     $newid=str_replace('_', ' ', $id);
                     $s=$this->db->get_where('subcategories',array('sname' => $newid))->row_array(); 
                     $Material = $this->db->query("SELECT * FROM filter WHERE id='3' AND  FIND_IN_SET(".$s['id'].",`sub_cat`)")->row_array();
                     if(!empty($Material)) {
                     ?>
                  <div class="single-sidebar-box mt-30 wow fadeInUp animated ">
                     <h2 class="accordion-header" id="headingTwo"> <button class="accordion-button collapsed"
                        type="button" data-bs-toggle="collapse" data-bs-target="#collapseMaterial"
                        aria-expanded="true" aria-controls="collapseMaterial">Material
                        </button> 
                     </h2>
                     <div id="collapseMaterial" class="accordion-collapse collapse "
                        aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                        <div class="checkbox-item">
                           <form>
                              <?php $mater=$this->db->get('material')->result_array();
                                 foreach($mater as $mat) {
                                 $sub_cat = explode(",",$mat['sub_cat']);
                                 if(in_array($s['id'],$sub_cat)) { 	    
                                 ?>	   
                              <div class="form-group"> <input type="radio" name="material" value="<?php echo $mat['id'];?>" id="mat<?php echo $mat['id'];?>" class="material"> <label
                                 for="mat<?php echo $mat['id'];?>"><?php echo $mat['material'];?></label> </div>
                              <?php } } ?> 
                           </form>
                        </div>
                     </div>
                  </div>
                  <?php } ?>
               </div>
               <div class="sidebar-holder">
                  <?php $id = $this->uri->segment(2);
                     $newid=str_replace('_', ' ', $id);
                     $s=$this->db->get_where('subcategories',array('sname' => $newid))->row_array(); 
                     $Shape = $this->db->query("SELECT * FROM filter WHERE id='4' AND  FIND_IN_SET(".$s['id'].",`sub_cat`)")->row_array();
                     if(!empty($Shape)) {
                     ?>
                  <div class="single-sidebar-box mt-30 wow fadeInUp animated ">
                     <h2 class="accordion-header" id="headingTwo"> <button class="accordion-button collapsed"
                        type="button" data-bs-toggle="collapse" data-bs-target="#collapseShape"
                        aria-expanded="true" aria-controls="collapseShape">Shape
                        </button> 
                     </h2>
                     <div id="collapseShape" class="accordion-collapse collapse "
                        aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                        <div class="checkbox-item">
                           <form>
                              <?php $shap=$this->db->get('shape')->result_array();
                                 foreach($shap as $sh) {
                                 $sub_cat = explode(",",$sh['sub_cat']);
                                 if(in_array($s['id'],$sub_cat)) { 	   
                                 ?>	   
                              <div class="form-group"> <input type="radio" name="shape" value="<?php echo $sh['id'];?>" id="sh<?php echo $sh['id'];?>" class="shape"> <label
                                 for="sh<?php echo $sh['id'];?>"><?php echo $sh['shape'];?></label> </div>
                              <?php }} ?> 
                           </form>
                        </div>
                     </div>
                  </div>
                  <?php } ?>
               </div>
               <div class="sidebar-holder">
                  <?php $id = $this->uri->segment(2);
                     $newid=str_replace('_', ' ', $id);
                     $s=$this->db->get_where('subcategories',array('sname' => $newid))->row_array(); 
                     $Effects = $this->db->query("SELECT * FROM filter WHERE id='5' AND  FIND_IN_SET(".$s['id'].",`sub_cat`)")->row_array();
                     if(!empty($Effects)) {
                     ?>
                  <div class="single-sidebar-box mt-30 wow fadeInUp animated ">
                     <h2 class="accordion-header" id="headingTwo"> <button class="accordion-button collapsed"
                        type="button" data-bs-toggle="collapse" data-bs-target="#collapseEffects"
                        aria-expanded="true" aria-controls="collapseEffects">Effects
                        </button> 
                     </h2>
                     <div id="collapseEffects" class="accordion-collapse collapse "
                        aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                        <div class="checkbox-item">
                           <form>
                              <?php $effect=$this->db->get('effects')->result_array();
                                 foreach($effect as $eff) {
                                 $sub_cat = explode(",",$eff['sub_cat']);
                                 if(in_array($s['id'],$sub_cat)) {	   
                                 ?>	   
                              <div class="form-group"> <input type="radio" name="effects" value="<?php echo $eff['id'];?>" id="eff<?php echo $eff['id'];?>" class="effects"> <label
                                 for="eff<?php echo $eff['id'];?>"><?php echo $eff['effects'];?></label> </div>
                              <?php } } ?> 
                           </form>
                        </div>
                     </div>
                  </div>
                  <?php } ?>
               </div>
               <div class="sidebar-holder">
                  <?php $id = $this->uri->segment(2);
                     $newid=str_replace('_', ' ', $id);
                     $s=$this->db->get_where('subcategories',array('sname' => $newid))->row_array(); 
                     $Finish = $this->db->query("SELECT * FROM filter WHERE id='6' AND  FIND_IN_SET(".$s['id'].",`sub_cat`)")->row_array();
                     if(!empty($Finish)) {
                     ?>
                  <div class="single-sidebar-box mt-30 wow fadeInUp animated ">
                     <h2 class="accordion-header" id="headingTwo"> <button class="accordion-button collapsed"
                        type="button" data-bs-toggle="collapse" data-bs-target="#collapseFinish"
                        aria-expanded="true" aria-controls="collapseFinish">Finish
                        </button> 
                     </h2>
                     <div id="collapseFinish" class="accordion-collapse collapse "
                        aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                        <div class="checkbox-item">
                           <form>
                              <?php $fini=$this->db->get('finish')->result_array();
                                 foreach($fini as $fin) {
                                 $sub_cat = explode(",",$fin['sub_cat']);
                                 if(in_array($s['id'],$sub_cat)) {   
                                 ?>	   
                              <div class="form-group"> <input type="radio" name="finish" value="<?php echo $fin['id'];?>" id="fin<?php echo $fin['id'];?>" class="finish"> <label
                                 for="fin<?php echo $fin['id'];?>"><?php echo $fin['finish'];?></label> </div>
                              <?php } } ?> 
                           </form>
                        </div>
                     </div>
                  </div>
                  <?php } ?>
               </div>
               <div class="sidebar-holder">
                  <?php $id = $this->uri->segment(2);
                     $newid=str_replace('_', ' ', $id);
                     $s=$this->db->get_where('subcategories',array('sname' => $newid))->row_array(); 
                     $Size = $this->db->query("SELECT * FROM filter WHERE id='7' AND  FIND_IN_SET(".$s['id'].",`sub_cat`)")->row_array();
                     if(!empty($Size)) {
                     ?>
                  <div class="single-sidebar-box mt-30 wow fadeInUp animated ">
                     <h2 class="accordion-header" id="headingTwo"> <button class="accordion-button collapsed"
                        type="button" data-bs-toggle="collapse" data-bs-target="#collapseSize"
                        aria-expanded="true" aria-controls="collapseSize">Size
                        </button> 
                     </h2>
                     <div id="collapseSize" class="accordion-collapse collapse "
                        aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                        <div class="checkbox-item">
                           <form>
                              <?php $siz=$this->db->get('size')->result_array();
                                 foreach($siz as $si) {
                                 $sub_cat = explode(",",$si['sub_cat']);
                                 if(in_array($s['id'],$sub_cat)) {   		
                                 ?>	   
                              <div class="form-group"> <input type="radio" name="size" value="<?php echo $si['id'];?>" id="si<?php echo $si['id'];?>" class="size"> <label
                                 for="si<?php echo $si['id'];?>"><?php echo $si['size'];?></label> </div>
                              <?php } } ?> 
                           </form>
                        </div>
                     </div>
                  </div>
                  <?php } ?>
               </div>
               <div class="sidebar-holder">
                  <?php $id = $this->uri->segment(2);
                     $newid=str_replace('_', ' ', $id);
                     $s=$this->db->get_where('subcategories',array('sname' => $newid))->row_array(); 
                     $Thickness = $this->db->query("SELECT * FROM filter WHERE id='8' AND  FIND_IN_SET(".$s['id'].",`sub_cat`)")->row_array();
                     if(!empty($Thickness)) {
                     ?>
                  <div class="single-sidebar-box mt-30 wow fadeInUp animated ">
                     <h2 class="accordion-header" id="headingTwo"> <button class="accordion-button collapsed"
                        type="button" data-bs-toggle="collapse" data-bs-target="#collapseThickness"
                        aria-expanded="true" aria-controls="collapseSize">Thickness
                        </button> 
                     </h2>
                     <div id="collapseThickness" class="accordion-collapse collapse "
                        aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                        <div class="checkbox-item">
                           <form>
                              <?php $thicknes=$this->db->get('thickness')->result_array();
                                 foreach($thicknes as $th) {	
                                 $sub_cat = explode(",",$th['sub_cat']);
                                 if(in_array($s['id'],$sub_cat)) { 
                                 ?>	   
                              <div class="form-group"> <input type="radio" name="thickness" value="<?php echo $th['id'];?>" id="th<?php echo $th['id'];?>" class="thickness"> <label
                                 for="th<?php echo $th['id'];?>"><?php echo $th['thickness'];?></label> </div>
                              <?php } } ?> 
                           </form>
                        </div>
                     </div>
                  </div>
                  <?php } ?>
               </div>
               <div class="sidebar-holder">
                  <?php $id = $this->uri->segment(2);
                     $newid=str_replace('_', ' ', $id);
                     $s=$this->db->get_where('subcategories',array('sname' => $newid))->row_array(); 
                     $Type = $this->db->query("SELECT * FROM filter WHERE id='9' AND  FIND_IN_SET(".$s['id'].",`sub_cat`)")->row_array();
                     if(!empty($Type)) {
                     ?>
                  <div class="single-sidebar-box mt-30 wow fadeInUp animated ">
                     <h2 class="accordion-header" id="headingTwo"> <button class="accordion-button collapsed"
                        type="button" data-bs-toggle="collapse" data-bs-target="#collapseType"
                        aria-expanded="true" aria-controls="collapseSize">Type
                        </button> 
                     </h2>
                     <div id="collapseType" class="accordion-collapse collapse "
                        aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                        <div class="checkbox-item">
                           <form>
                              <?php $typ=$this->db->get('type')->result_array();
                                 foreach($typ as $ty) {
                                 $sub_cat = explode(",",$ty['sub_cat']);
                                 if(in_array($s['id'],$sub_cat)) { 									   
                                 ?>	   
                              <div class="form-group"> <input type="radio" name="type" value="<?php echo $ty['id'];?>" id="ty<?php echo $ty['id'];?>" class="type"> <label
                                 for="ty<?php echo $ty['id'];?>"><?php echo $ty['type'];?></label> </div>
                              <?php } } ?> 
                           </form>
                        </div>
                     </div>
                  </div>
                  <?php } ?>
               </div>
               <div class="sidebar-holder">
                  <?php $id = $this->uri->segment(2);
                     $newid=str_replace('_', ' ', $id);
                     $s=$this->db->get_where('subcategories',array('sname' => $newid))->row_array(); 
                     $Themes = $this->db->query("SELECT * FROM filter WHERE id='10' AND  FIND_IN_SET(".$s['id'].",`sub_cat`)")->row_array();
                     if(!empty($Themes)) {
                     ?>
                  <div class="single-sidebar-box mt-30 wow fadeInUp animated ">
                     <h2 class="accordion-header" id="headingTwo"> <button class="accordion-button collapsed"
                        type="button" data-bs-toggle="collapse" data-bs-target="#collapseThemes"
                        aria-expanded="true" aria-controls="collapseSize">Themes
                        </button> 
                     </h2>
                     <div id="collapseThemes" class="accordion-collapse collapse "
                        aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                        <div class="checkbox-item">
                           <form>
                              <?php $theme=$this->db->get('themes')->result_array();
                                 foreach($theme as $them) {
                                 $sub_cat = explode(",",$them['sub_cat']);
                                 if(in_array($s['id'],$sub_cat)) { 		
                                 ?>	   
                              <div class="form-group"> <input type="radio" name="themes" value="<?php echo $them['id'];?>" id="them<?php echo $them['id'];?>" class="themes"> <label
                                 for="them<?php echo $them['id'];?>"><?php echo $them['themes'];?></label> </div>
                              <?php } } ?> 
                           </form>
                        </div>
                     </div>
                  </div>
                  <?php } ?>
               </div>
               <div class="sidebar-holder">
                  <?php $id = $this->uri->segment(2);
                     $newid=str_replace('_', ' ', $id);
                     $s=$this->db->get_where('subcategories',array('sname' => $newid))->row_array(); 
                     $light_bulb_type = $this->db->query("SELECT * FROM filter WHERE id='11' AND  FIND_IN_SET(".$s['id'].",`sub_cat`)")->row_array();
                     if(!empty($light_bulb_type)) {
                     ?>
                  <div class="single-sidebar-box mt-30 wow fadeInUp animated ">
                     <h2 class="accordion-header" id="headingTwo"> <button class="accordion-button collapsed"
                        type="button" data-bs-toggle="collapse" data-bs-target="#collapselight_bulb_type"
                        aria-expanded="true" aria-controls="collapseSize">Light Bulb Type
                        </button> 
                     </h2>
                     <div id="collapselight_bulb_type" class="accordion-collapse collapse "
                        aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                        <div class="checkbox-item">
                           <form>
                              <?php $light_bulb=$this->db->get('light_bulb_type')->result_array();
                                 foreach($light_bulb as $light) {	
                                 $sub_cat = explode(",",$light['sub_cat']);
                                 if(in_array($s['id'],$sub_cat)) { 
                                 ?>	   
                              <div class="form-group"> <input type="radio" name="light_bulb" value="<?php echo $light['id'];?>" id="light<?php echo $light['id'];?>" class="light_bulb_type"> <label
                                 for="light<?php echo $light['id'];?>"><?php echo $light['light_bulb'];?></label> </div>
                              <?php } } ?> 
                           </form>
                        </div>
                     </div>
                  </div>
                  <?php } ?>
               </div>
               <div class="sidebar-holder">
                  <?php $id = $this->uri->segment(2);
                     $newid=str_replace('_', ' ', $id);
                     $s=$this->db->get_where('subcategories',array('sname' => $newid))->row_array(); 
                     $number_of_seat = $this->db->query("SELECT * FROM filter WHERE id='12' AND  FIND_IN_SET(".$s['id'].",`sub_cat`)")->row_array();
                     if(!empty($number_of_seat)) {
                     ?>
                  <div class="single-sidebar-box mt-30 wow fadeInUp animated ">
                     <h2 class="accordion-header" id="headingTwo"> <button class="accordion-button collapsed"
                        type="button" data-bs-toggle="collapse" data-bs-target="#collapsenumber_of_seat"
                        aria-expanded="true" aria-controls="collapseSize">Number Of Seat
                        </button> 
                     </h2>
                     <div id="collapsenumber_of_seat" class="accordion-collapse collapse "
                        aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                        <div class="checkbox-item">
                           <form>
                              <?php $number_of=$this->db->get('number_of_seat')->result_array();
                                 foreach($number_of as $nu) {
                                 $sub_cat = explode(",",$nu['sub_cat']);
                                 if(in_array($s['id'],$sub_cat)) { 
                                 ?>	   
                              <div class="form-group"> <input type="radio" name="number_of_seat" value="<?php echo $nu['id'];?>" id="nu<?php echo $nu['id'];?>" class="number_of_seat"> <label
                                 for="nu<?php echo $nu['id'];?>"><?php echo $nu['number_of_seat'];?></label> </div>
                              <?php  }} ?> 
                           </form>
                        </div>
                     </div>
                  </div>
                  <?php } ?>
               </div>
               <div class="sidebar-holder">
                  <?php $id = $this->uri->segment(2);
                     $newid=str_replace('_', ' ', $id);
                     $s=$this->db->get_where('subcategories',array('sname' => $newid))->row_array(); 
                     $bed_size = $this->db->query("SELECT * FROM filter WHERE id='13' AND  FIND_IN_SET(".$s['id'].",`sub_cat`)")->row_array();
                     if(!empty($bed_size)) {
                     ?>
                  <div class="single-sidebar-box mt-30 wow fadeInUp animated ">
                     <h2 class="accordion-header" id="headingTwo"> <button class="accordion-button collapsed"
                        type="button" data-bs-toggle="collapse" data-bs-target="#collapsebed_size"
                        aria-expanded="true" aria-controls="collapseSize">Bed Size
                        </button> 
                     </h2>
                     <div id="collapsebed_size" class="accordion-collapse collapse "
                        aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                        <div class="checkbox-item">
                           <form>
                              <?php $bed_s=$this->db->get('bed_size')->result_array();
                                 foreach($bed_s as $be) {
                                 $sub_cat = explode(",",$be['sub_cat']);
                                 if(in_array($s['id'],$sub_cat)) {	   
                                 ?>	   
                              <div class="form-group"> <input type="radio" name="bed_size" value="<?php echo $be['id'];?>" id="be<?php echo $be['id'];?>" class="bed_size"> <label
                                 for="be<?php echo $be['id'];?>"><?php echo $be['bed_size'];?></label> </div>
                              <?php } } ?> 
                           </form>
                        </div>
                     </div>
                  </div>
                  <?php } ?>
               </div>
               <div class="sidebar-holder">
                  <?php $id = $this->uri->segment(2);
                     $newid=str_replace('_', ' ', $id);
                     $s=$this->db->get_where('subcategories',array('sname' => $newid))->row_array(); 
                     $Bowl = $this->db->query("SELECT * FROM filter WHERE id='14' AND  FIND_IN_SET(".$s['id'].",`sub_cat`)")->row_array();
                     if(!empty($Bowl)) {
                     ?>
                  <div class="single-sidebar-box mt-30 wow fadeInUp animated ">
                     <h2 class="accordion-header" id="headingTwo"> <button class="accordion-button collapsed"
                        type="button" data-bs-toggle="collapse" data-bs-target="#collapseBowl"
                        aria-expanded="true" aria-controls="collapseSize">Bowl
                        </button> 
                     </h2>
                     <div id="collapseBowl" class="accordion-collapse collapse "
                        aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                        <div class="checkbox-item">
                           <form>
                              <?php $bowl=$this->db->get('bowl')->result_array();
                                 foreach($bowl as $bo) {	
                                 $sub_cat = explode(",",$bo['sub_cat']);
                                 if(in_array($s['id'],$sub_cat)) {
                                 ?>	   
                              <div class="form-group"> <input type="radio" name="bowl" value="<?php echo $bo['id'];?>" id="bo<?php echo $bo['id'];?>" class="bowl"> <label
                                 for="bo<?php echo $bo['id'];?>"><?php echo $bo['bowl'];?></label> </div>
                              <?php } }?> 
                           </form>
                        </div>
                     </div>
                  </div>
                  <?php } ?>
               </div>
               <div class="sidebar-holder">
                  <?php $id = $this->uri->segment(2);
                     $newid=str_replace('_', ' ', $id);
                     $s=$this->db->get_where('subcategories',array('sname' => $newid))->row_array(); 
                     $Color = $this->db->query("SELECT * FROM filter WHERE id='15' AND  FIND_IN_SET(".$s['id'].",`sub_cat`)")->row_array();
                     if(!empty($Color)) {
                     ?>
                  <div class="single-sidebar-box mt-30 wow fadeInUp animated ">
                     <h2 class="accordion-header" id="headingTwo"> <button class="accordion-button collapsed"
                        type="button" data-bs-toggle="collapse" data-bs-target="#collapseColor"
                        aria-expanded="true" aria-controls="collapseSize">Color
                        </button> 
                     </h2>
                     <div id="collapseColor" class="accordion-collapse collapse "
                        aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                        <div class="checkbox-item">
                           <form>
                              <?php $color=$this->db->get('color')->result_array();
                                 foreach($color as $co) {
                                 $sub_cat = explode(",",$co['sub_cat']);
                                 if(in_array($s['id'],$sub_cat)) {		
                                 ?>	   
                              <div class="form-group"> <input type="radio" name="color" value="<?php echo $co['id'];?>" id="co<?php echo $co['id'];?>" class="color"> <label
                                 for="co<?php echo $co['id'];?>"><?php echo $co['name'];?></label> </div>
                              <?php } } ?> 
                           </form>
                        </div>
                     </div>
                  </div>
                  <?php } ?>
               </div>
			   
			   <div class="sidebar-holder">
                 
                  <div class="single-sidebar-box mt-30 wow fadeInUp animated ">
                     <h2 class="accordion-header" id="headingTwo"> <button class="accordion-button collapsed"
                        type="button" data-bs-toggle="collapse" data-bs-target="#collapsedoor"
                        aria-expanded="true" aria-controls="collapseSize">Indoor/outdoor
                        </button> 
                     </h2>
                     <div id="collapsedoor" class="accordion-collapse collapse "
                        aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                        <div class="checkbox-item">
                           <form>
                              	   
                              <div class="form-group"> 
							  <input type="radio" name="indoor_outdoor" value="Indoor" id="door_indoor" class="door"> 
							  <label for="door_indoor">Indoor</label> 
							  </div>
							  
							  <div class="form-group"> 
							  <input type="radio" name="indoor_outdoor" value="outdoor" id="door_outdoor" class="door"> 
							  <label for="door_outdoor">Outdoor</label> 
							  </div>
							  
							  <div class="form-group"> 
							  <input type="radio" name="indoor_outdoor" value="Indoor/outdoor" id="door_both" class="door"> 
							  <label for="door_both">Indoor/Outdoor</label> 
							  </div>
							  
                             
                           </form>
                        </div>
                     </div>
                  </div>
                  
               </div>
			   
			   <div class="sidebar-holder">
                 
                  <div class="single-sidebar-box mt-30 wow fadeInUp animated ">
                     <h2 class="accordion-header" id="headingTwo"> <button class="accordion-button collapsed"
                        type="button" data-bs-toggle="collapse" data-bs-target="#collapseSensor"
                        aria-expanded="true" aria-controls="collapseSize">Sensor
                        </button> 
                     </h2>
                     <div id="collapseSensor" class="accordion-collapse collapse "
                        aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                        <div class="checkbox-item">
                           <form>
                              	   
                              <div class="form-group"> 
							  <input type="radio" name="sensor" value="Yes" id="sensor_yes" class="sensor"> 
							  <label for="sensor_yes">Yes</label> 
							  </div>
							  
							  <div class="form-group"> 
							  <input type="radio" name="sensor" value="No" id="sensor_no" class="sensor"> 
							  <label for="sensor_no">No</label> 
							  </div>
							  
							  
                             
                           </form>
                        </div>
                     </div>
                  </div>
                  
               </div>
			   
			   
            </div>
         </div>
         <div class="col-xl-9 col-lg-8">
            <div class="row">
               <div class="col-xl-12">
                  <div
                     class="shop-grid-page-top-info p-0 justify-content-md-between justify-content-center">
                     <div class="left-box ">
                        <p>Showing 1–12 of 50 Results</p>
                     </div>
                     <div
                        class="right-box justify-content-md-between justify-content-center wow fadeInUp animated">
                        <div class="short-by">
                           <div class="select-box">
                              <select class="wide">
                                 <option data-display="Short by latest">Featured </option>
                                 <option value="1">Best selling </option>
                                 <option value="2">Alphabetically, A-Z</option>
                                 <option value="3">Alphabetically, Z-A</option>
                                 <option value="3">Price, low to high</option>
                                 <option value="3">Price, high to low</option>
                                 <option value="3">Date, old to new</option>
                              </select>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-12 mt-3">
                  <div class="tab-content" id="pills-tabContent">
                     <div class="tab-pane fade show active" id="pills-grid" role="tabpanel"
                        aria-labelledby="pills-grid-tab">
                        <div class="row" id="filter_data">
                           <?php foreach($products as $pro) { ?>
                           <div class="col-xl-4 col-lg-6 col-md-6 mb-3">
                              <div class="produc_list_page product_hover">
                                 <a href="#popup7<?php echo $pro['id'];?>" class="popup_link"><img class="hover_view  flaticon-visibility" src="<?php echo base_url();?>assets/img/Group313.png"></a>
                                 <a class="product_link" href="<?php echo base_url('brand-profile/'.str_replace(' ', '_', $pro['product_name'])); ?>">
                                 <?php $images=explode(",", $pro['product_image']);?>
                                 <img class="p_main" src="<?php echo base_url();?>/uploads/product/<?php echo $images[0]; ?>">
                                 </a>
                                 <div class="product_text   mt-2 mb-2 __web-inspector-hide-shortcut__">
                                    <?php $brand_name = $this->db->get_where('brand',array('id' => $pro['brand']))->row_array(); ?>
                                    <div class="row">
                                       <div class="col-md-7">
                                          <h4><?php echo $brand_name['bname'];?></h4>
                                          <p class="product_space"><?php echo $pro['product_name']; ?></p>
                                       </div>
                                       <div class="col-md-5">
                                          <?php   
                                             $user_id = $this->session->userdata('user_id');
                                             $get_wishlist = $this->db->get_where('wishlist',array('user_id' =>$user_id,'product_id'=>$pro['id']))->num_rows();
                                             if($get_wishlist == 0) {
                                             ?>
                                          <a href="<?php if(!empty($user_id)) { ?><?php echo base_url('add-wishlist/').$pro['id'].'/'.$this->uri->segment(2); ?> <?php } else { ?><?php echo base_url('login');?><?php } ?> " style="width:100%;"> <span class="product_icon" style="width:100%;"><img src="<?php echo base_url();?>assets/img/Union.png" style="width:20%;display:inline-block;"> <span style="display: inline-block;"><?php echo $count = $this->db->get_where('wishlist',array('product_id' =>$pro['id'] ))->num_rows(); ?></span></span></a>
                                          <?php } else{ ?>
                                          <a href="<?php echo base_url('remove-wishlist/').$pro['id'].'/'.$this->uri->segment(2); ?>" style="width:100%;"> <span class="product_icon" style="width:100%;"><img src="<?php echo base_url();?>assets/img/unwishlist.png" style="width:20%;display:inline-block;"> <span style="display: inline-block;"><?php echo $count = $this->db->get_where('wishlist',array('product_id' =>$pro['id'] ))->num_rows(); ?></span></span></a>
                                          <?php } ?>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div id="popup7<?php echo $pro['id'];?>" class="product-gird__quick-view-popup mfp-hide">
                              <div class="row justify-content-between align-items-center">
                                 <div class="col-lg-8">
                                    <div class="quick-view__left-content">
                                       <div class="tabs">
                                          <div class="popup-product-thumb-box tabsa">
                                             <ul>
                                                <?php $imagesa=explode(",", $pro['product_image']);
                                                   $no = 0;
                                                   foreach ($imagesa as $key => $value) {
                                                   $no = $no + 1;	
                                                   ?>
                                                <li class="tab-nav popup-product-thumb"> <a
                                                   href="#tab<?php echo $no;?>"> <img
                                                   src="<?php echo base_url();?>/uploads/product/<?php echo $value; ?>"
                                                   alt="" /> </a> </li>
                                                <?php } ?>	
                                             </ul>
                                          </div>
                                          <div class="popup-product-main-image-box">
                                             <?php $imagesa=explode(",", $pro['product_image']);
                                                $no = 0;
                                                foreach ($imagesa as $key => $value) {
                                                $no = $no + 1;	
                                                ?>
                                             <div id="tab<?php echo $no;?>"
                                                class="tab-item popup-product-image">
                                                <div class="popup-product-single-image"> <img
                                                   src="<?php echo base_url();?>/uploads/product/<?php echo $value; ?>"
                                                   alt="" /> </div>
                                             </div>
                                             <?php } ?>	
                                             <button class="prev"> <i
                                                class="flaticon-back"></i> </button> <button
                                                class="next"> <i class="flaticon-next"></i>
                                             </button>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="col-lg-4">
                                    <div class="popup-right-content">
                                       <div class="brand_logo_details mb-3">
                                          <a href="<?php echo base_url('brandprofile/'.str_replace(' ', '_', $brand_name['bname']));?>">
                                          <img src="<?php echo base_url();?>uploads/brand/<?php echo $brand_name['images'];?>" class="img-thumbnail"></a>
                                       </div>
                                       <h3><?php echo $brand_name['bname'];?></h3>
                                       <p class="text"> <?php echo $pro['product_name'];?>
                                       </p>
                                       <div class="price">
                                          <p><?php echo substr($pro['description'], 0, 50) ?></p>
                                       </div>
                                       <div class="mt-3 metalic">
                                          <p><b>Collection :  </b><?php echo $pro['collection']; ?></p>
                                          <p><b>Finish :  </b>
                                             <?php $finish=explode(",", $pro['finish']);
                                                foreach ($finish as $key => $fi) {
                                                   $fini = $this->db->get_where('finish',array('id' => $fi))->row_array();
                                                
                                                echo $fini['finish'].","; }
                                                ?>
                                          </p>
                                          <p><b>Use :  </b><?php echo $pro['indoor_outdoor']; ?> </p>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <?php } ?> 
                        </div>
                     </div>
                  </div>
               </div>
               <div class="row">
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
<!--End product-grid-->