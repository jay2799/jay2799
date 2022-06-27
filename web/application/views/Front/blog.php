 <section class="blog pt-60 pb-60">
      <div class="container">
         <div class="row">
            <div class="col-12">
               <div class="section-header  wow fadeInUp animated">
                  <h2 class="sub_cat">Frome the blog</h2>
                 
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