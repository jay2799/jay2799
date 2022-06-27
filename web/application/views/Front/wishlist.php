<div class="top-sec">
   <div class="container">
      <div class="row">
         <div class="col-md-1">
            <div class="wish-title text-center">
               <h4>Wishlist</h4>
            </div>
         </div>
         <div class="col-md-11">
            <div class="wish-ref">
               <a href="#">Moodboard</a>
            </div>
         </div>
      </div>
   </div>
</div>
<main class="overflow-hidden ">
<!--Start product-grid-->
<div class="product-grid pt-60 pb-120">
   <div class="container">
      <div class="row"
      <div class="row gx-4">
         <div class="col-xl-3 col-lg-4 mt-3">
            <div class="shop-grid-sidebar">
               <button class="remove-sidebar d-lg-none d-block"> <i
                  class="flaticon-cross"> </i> </button>
               <div class="sidebar-holder">
                  <div class="product">
                     <h4>Projects</h4>
                  </div>
					
					<ul class="list-unstyled" id="page_list">
					<?php 
					$user_id = $this->session->userdata('user_id');
								$folder = $this->db->order_by('page_order','ASC')->get_where('folder',array('user_id'=>$user_id))->result_array();
								
								foreach($folder as $fo) {
								$cc = $this->db->get_where('wishlist',array('user_id'=>$user_id,'folder'=>$fo['id']))->num_rows();	
					echo '<li id="'.$fo["id"].'">  <i class="fa-solid fa-up-down-left-right"></i><a href="'.base_url('wishlist-folder/').$fo["folder_name"].'"> '.$fo['folder_name'].' ['.$cc.']</a>
					  <span class="remove_f"><a href="'.base_url('folder-remove/') .$fo["id"].'"><i class="fa-solid fa-trash-can"></i></a></span>
					
					</li>';
					}
					?>
					</ul>
					<input type="hidden" name="page_order_list" id="page_order_list" />
					
					<!--End product-grid-->
				  <div class="adder">
				  <form method="POST" action="<?php echo base_url('welcome/add_project'); ?>">
					<input type="text" name="folder_name" class="inputa" maxlength="10" placeholder=" Add project"/ required>
					
					<button type="submit" class="add">+</button>
					<p class="mt-2" style="color:red;">*Maximum Length 10 Characters</p>
					</form>
				  </div>
               </div>
            </div>
         </div>
         <div class="col-xl-9 col-lg-8">
            <div class="row">
               <div class="col-xl-12">
                  <div class="shop-grid-page-top-info p-0 justify-content-md-between justify-content-center">
                     <div class="left-box wow fadeInUp  animated" style="visibility: visible; animation-name: fadeInUp;">
                        <p>Wishlist</p>
                     </div>
                     <div class="right-box justify-content-md-between justify-content-center wow fadeInUp  animated" style="visibility: visible; animation-name: fadeInUp;">
                        <input type="text" class="form-control" placeholder="Search">
                     </div>
						
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
            <div class="row mt-3">
               <div class="col-12">
                  <div class="tab-content" id="pills-tabContent">
                     <div class="tab-pane fade show active" id="pills-grid" role="tabpanel"
                        aria-labelledby="pills-grid-tab">
                        <div class="row">
						<?php foreach($wishlist as $wish) {
							
							$product = $this->db->get_where('product',array('id' => $wish['product_id']))->row_array();
							$brand = $this->db->get_where('brand',array('id'=>$product['brand']))->row_array();

						?>
                           <div class="col-xl-4 col-lg-6 col-6  mb-3">
						  <div class="produc_list_page product_hover">
                              <a class="product_link" href="<?php echo base_url('brand-profile/'.str_replace(' ', '_', $product['product_name'])); ?>">
							    <img class="hover_view" src="<?php echo base_url();?>/assets/img/Group313.png">
								<?php $images=explode(",", $product['product_image']);?>
                                
								 <img class="p_main" src="<?php echo base_url();?>/uploads/product/<?php echo $images[0]; ?>">
							  </a>
                              <div class="product_text   mt-2 mb-2 __web-inspector-hide-shortcut__">
								<div class="row">
								 <div class="col-md-7">
                                 <h4><?php echo $brand['bname'];?></h4>
                                 
                                 <p class="product_space"><?php echo $product['product_name'];?></p>
								 </div>
								 <div class="col-md-5">
								 
								 								
								<a href="<?php echo base_url('wishlist-remove/').$product['id'] ?>" style="width:100%;"> 
									<span class="product_icon" style="width:100%;">
										<img src="<?php echo base_url();?>/assets/img/unwishlist.png" style="width:20%;display:inline-block;"> 
									<span style="display: inline-block;"><?php echo $count = $this->db->get_where('wishlist',array('product_id' =>$product['id'] ))->num_rows(); ?></span></span>
								</a>
								
																 
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
            
            </div>
         </div>
      </div>
   </div>
</div>




<style>
.adder .inputa {
    outline: none;
    border: 1px solid #dbdbdb;
    / background-color: #000; /
    color: black;
    height: 50px;
    width: 200px;
    padding-left: 10px;
    font-family: "Raleway", sans-serif;
    font-weight: 800;
    font-size: 16px;
    margin: 9px 15px 0px 0px;
}
.adder span {
    position: absolute;
    
    font-size: 30px;
    font-weight: 800;
    line-height: 1.8;
    cursor: pointer;
    transition: all 200ms;
    color: black;
    will-change: transform;
}
 .adder span:hover {
  transform: rotate(180deg);
}
 ul {
  padding: 0px;
}
ul .draggable {
    
    height: 50px;
    list-style-type: none;
   
    background-color: white;
    
    width: 250px;
    line-height: 3.2;
    padding-left: 10px;
    cursor: move;
    transition: all 200ms;
    user-select: none;
    margin: 18px 0px 0px 0px;
    position: relative;
    border: 1px solid #D1D1D1;
    box-sizing: border-box;
    border-radius: 3px;
}
ul .draggable:after {
  content: "drag me";
  right: 7px;
  font-size: 10px;
  position: absolute;
  cursor: pointer;
  line-height: 5;
  transition: all 200ms;
  transition-timing-function: cubic-bezier(0.48, 0.72, 0.62, 1.5);
  transform: translateX(120%);
  opacity: 0;
}
ul .draggable:hover:after {
  opacity: 1;
  transform: translate(0);
}

.over {
  transform: scale(1.1, 1.1);
}

</style>
