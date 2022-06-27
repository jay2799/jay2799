<div class="content-wrapper">
   <div class="row">
      <div class="col-md-12 grid-margin stretch-card">
         <div class="card">
            <div class="card-body">
               <h4 class="card-title">Banner Update</h4>
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
                     <label for="exampleInputUsername1">Banner  Url</label>
                     <input type="text" name="url" value="<?php echo $banner->url; ?>"  class="form-control" id="exampleInputUsername1" placeholder="Enter Url">
                  </div>
                  
                  <div class="form-group">
                     <label for="exampleInputUsername1">Banner Image</label>
                     <input type="file" name="images"   class="form-control" id="exampleInputUsername1"  >
                  </div>
                  <button name="submit" type="submit" class="btn btn-gradient-primary mr-2">Submit</button>
               </form>
            </div>
         </div>
      </div>
   </div>
</div>