<div class="content-wrapper">
   <div class="row">
      <div class="col-md-12 grid-margin stretch-card">
         <div class="card">
            <div class="card-body">
               <h4 class="card-title">Resellers Update</h4>
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
                     <select class="js-example-basic-single w-100" name="brand" >
                        <option value="">Select Brand</option>
                        <?php 
                           $brand = $this->db->get('brand')->result_array();
                           foreach($brand as $br) {
                           
                           ?>
                        <option <?php if($resellers->brand == $br['id']) { ?> selected <?php } else { } ?> value="<?php echo $br['id']; ?>"><?php echo $br['bname']; ?></option>
                        <?php } ?>
                     </select>
                  </div>
				  <div class="form-group">
                     <label for="exampleInputUsername1">Resellers City</label>
                     <select class="js-example-basic-single w-100" name="city" >
                        <option value="">Select City</option>
                        <?php 
                           $city = $this->db->get('city')->result_array();
                           foreach($city as $ci) {
                           
                           ?>
                        <option <?php if($resellers->city == $ci['id']) { ?> selected <?php } else { } ?> value="<?php echo $ci['id']; ?>"><?php echo $ci['city']; ?></option>
                        <?php } ?>
                     </select>
                  </div>
                  <div class="form-group">
                     <label for="exampleInputUsername1">Resellers Name</label>
                     <input type="text" name="name" value="<?php echo $resellers->name; ?>"  class="form-control" id="exampleInputUsername1" placeholder="Enter Resellers Name">
                  </div>
                  <div class="form-group">
                     <label for="exampleInputUsername1">Address</label>
                     <input type="text" name="address"  value="<?php echo $resellers->address; ?>"  class="form-control" id="exampleInputUsername1" placeholder="Enter Address" >
                  </div>
                  
                  <div class="form-group">
                     <label for="exampleInputUsername1">Contact Number</label>
                     <input type="number" name="contact"  value="<?php echo $resellers->contact; ?>"  class="form-control" id="exampleInputUsername1" placeholder="Enter Contact Number" >
                  </div>
                  <button name="submit" type="submit" class="btn btn-gradient-primary mr-2">Submit</button>
               </form>
            </div>
         </div>
      </div>
   </div>
</div>