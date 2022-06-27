<div class="gallery">
<div class="container  text-center py-3 ">
	<h1 class="gallery_text">Welcome to the inspiration section</h1>
	<p class="gallery_texta">Explore the ideas and get that material frome our website</p>
</div>
</div>


 <section class="hero is-light is-medium mt-2">
   <div class="hero-foot">
    <nav class="tabs is-boxed is-fullwidth">
      <div class="container">
        <ul id="buttonGroup">
          <li ><a id="all">All</a></li>
		  <?php foreach($category as $cat) { ?>
          <li><a id="<?php echo trim($cat['cname']) ?>"><?php echo $cat['cname']; ?></a></li>
          <?php } ?>
		  
        </ul>
      </div>
    </nav>
  </div>
  <div class="container">
  <div class="grid" id="container">
    <div class="grid-sizer"></div>
	 <?php foreach($category as $cat) { 
	 $gallery =  $this->db->get_where('gallery',array('cname' => $cat['id']))->result_array();
	 foreach($gallery as $ga) { 
	 
	 ?>
	 
    <div class="grid-item  <?php echo trim($cat['cname']) ?>">
		<img src="<?php echo base_url();?>/uploads/gallery/<?php echo $ga['images']; ?>" alt=""/>
	</div>
	
	 <?php } ?>
	 <?php } ?>
  </div>
  </div>
</section>



