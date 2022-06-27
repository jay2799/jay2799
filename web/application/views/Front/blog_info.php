    <main class="overflow-hidden ">
        <!--Start Breadcrumb Style2-->
        <section class="breadcrumb-area" style="background-image: url(<?php echo base_url();?>assets/img/breadcome.png);">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="breadcrumb-content text-center wow fadeInUp animated">
                            <h2>Our Blog</h2>
                            <div class="breadcrumb-menu">
                                <ul>
                                    <li><a href="<?php echo base_url();?>"><i class="flaticon-home pe-2"></i>Home</a></li>
                                    <li> <i class="flaticon-next"></i> </li>
                                    <li class="active">Our Blog</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--End Breadcrumb Style2-->
        <!--Start Blog Page-->
        <section class="blog-page pt-120 pb-120">
            <div class="container">
                <div class="row mt--30">
                    <div class="col-xl-8 col-lg-7 mt-30">
                        <div class="blog-page-left">
                            <!--Start Blog Page Single-->
                            <div class="blog-page-single wow fadeInUp animated">
                                <div class="blog-page-img"> <img
                                            src="<?php echo base_url();?>uploads/blog/<?php echo $blog['images'];?>" alt="">
                                    <div class="blog-page-date">
                                        <p> <?php echo date("d-m-Y", strtotime($blog['date']));?></p>
                                    </div>
                                </div>
                                <div class="blog-page-content">
                                    
                                    <h3 class="blog-page-title"><?php echo $blog['title'];?></h3>
                                    
									<p class="blog-page-text"><?php echo $blog['description'];?></p>
                                    
                                </div>
                            </div>
                            
                          
                        </div>
                    </div>
					             <div class="col-xl-4 col-lg-5 mt-30 ">
                        <div class="sidebar-content-box">
                          
                          
                            <!--End Single Sidebar Box-->
                            <!--Start Single Sidebar Box-->
                            <div class="sidebar-box mt-30 style-4 wow fadeInUp animated">
                                <h4>Recent Blog</h4>
								
								<?php foreach($recent as $re) { ?>
                                <div class="sidebar-blog-post"> <a href="<?php echo base_url('blog-info/'. $re['id']);?>" class="img-box"> <img
                                            src="<?php echo base_url();?>uploads/blog/<?php echo $re['images'];?>" alt="Awesome Image">
                                        <div class="overlay-content"> </div>
                                    </a>
                                    <div class="title-box">
                                        <p class="date"> <?php echo date("d-m-Y", strtotime($re['date']));?></p>
                                        <h5><a href="<?php echo base_url('blog-info/'. $re['id']);?>"><?php echo $re['title'];?></a></h5>
                                    </div>
                                </div>
								<?php } ?>
                                
                            </div>
                        
                            <!--End Single Sidebar Box-->
                        </div>
                    </div>
                   
                </div>
            </div>
        </section>
        <!--End Blog Page-->
    </main>