<style>
input#brand {
    background: #80808073;
    color: #fff;
}
</style>
<div class="content-wrapper">
   <div class="row">
      <div class="col-md-12 grid-margin stretch-card">
         <div class="card">
            <div class="card-body">
               <h4 class="card-title">Resellers Create</h4>
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
                  <div class="form-group">
                     <label for="exampleInputUsername1">Brand Name</label>
					 <?php $brand_id = $this->session->userdata('bid'); 
						   $b_name = $this->db->get_where('brand',array('id' => $brand_id))->row_array();
					 ?>
                     <input type="text"   class="form-control" id="brand" value="<?php echo $b_name['bname']; ?>" readonly>
                     <input type="hidden"   class="form-control" name="brand" id="brand" value="<?php echo $b_name['id']; ?>" >
                  </div>
				  <div class="form-group">
                     <label for="exampleInputUsername1">Resellers City</label>
                     <select class="js-example-basic-single w-100" name="city" >
                        <option value="">Select City</option>
                        <?php 
                           $city = $this->db->get('city')->result_array();
                           foreach($city as $ci) {
                           
                           ?>
                        <option value="<?php echo $ci['id']; ?>"><?php echo $ci['city']; ?></option>
                        <?php } ?>
                     </select>
                  </div>
                  <div class="form-group">
                     <label for="exampleInputUsername1">Resellers Name</label>
                     <input type="text" name="name"  class="form-control" id="exampleInputUsername1" placeholder="Enter Resellers Name">
                  </div>
                  <div class="form-group">
                     <label for="exampleInputUsername1">Address</label>
                     <input type="text" name="address"  class="form-control" id="exampleInputUsername1" placeholder="Enter Address" >
                  </div>
                 
                  <div class="form-group">
                     <label for="exampleInputUsername1">Contact Number</label>
                     <input type="number" name="contact"  class="form-control" id="exampleInputUsername1" placeholder="Enter Contact Number" >
                  </div>
                  <button name="submit" type="submit" class="btn btn-gradient-primary mr-2">Submit</button>
               </form>
            </div>
         </div>
      </div>
   </div>
</div>