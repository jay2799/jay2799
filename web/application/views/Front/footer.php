<section class="newsLetter-one four mt-3 pt-100 ">
            <div class="container">
                <div class="row">
					
					<div class="col-md-6 text-center">
						<img src="<?php echo base_url();?>assets/img/tab1.png">
					</div>
				
                    <div class="col-md-6">
                        <div class="section-header text-center mt-5">
                            <h4> Subscribe Our Newsletter </h4>
                            <p>Stay updated with trends</p>
                        </div>
                        <div class="newsLetter-one__content-box three">
                            <form action="#0" class="form">
                                <div class="newsLetter-one__subscribe-box align-items-end"> 
								<input type="email" name="email"  placeholder="YOUR EMAIL ADDRESS" class="mt-2" name="email">
									<div class="container text-center">
										<button type="submit" class="fashon--primary1 mt-2"> SUBSCRIBE </button> 
									</div>	
										</div>
                            </form>
                        </div>
                    </div>
					
                </div>
            </div> 
        </section>	
		
 <footer class="footer-default home4-footer ">
        <!--Start Footer-->
        <div class="footer-default__main-footer position-relative">
            <div class="container">
                <div class="row">
                    <div class="col-xl-2 col-lg-6 col-md-6 col-6 mt-30 wow fadeInUp animated">
                        <div class="footer-default__single-box">
                            <div class="footer-title">
                                <h4> Nexdee</h4>
                            </div>
                            <ul class="footer-links">
                                <li><a href="#0"> About</a></li>
                                <li><a href="#0">FAQ</a></li>
                                <li><a href="#0">Contact us</a></li>
                                <li><a href="#0">Work with us</a></li>
                                
                            </ul>
                        </div>
                    </div>
                    <div class="col-xl-2 col-lg-6 col-md-6 col-6 mt-30 wow fadeInUp animated">
                        <div class="footer-default__single-box">
                            <div class="footer-title">
                                <h4> Explor </h4>
                            </div>
                            <ul class="footer-links">
                                <li><a href="#0">Product catagory</a></li>
                                <li><a href="<?php echo base_url('brand-list');?>">Brands</a></li>
                                
                            </ul>
                        </div>
                    </div>
                    <div class="col-xl-2 col-lg-6 col-md-6 col-6 mt-30 wow fadeInUp animated">
                        <div class="footer-default__single-box">
                            <div class="footer-title">
                                <h4> For brands</h4>
                            </div>
                          <ul class="footer-links">
                                <li><a href="#0">Publish your products</a></li>
                                <li><a href="#0">Advertise with us</a></li>
                               
                                
                            </ul>
                        </div>
                    </div>
                    <div class="col-xl-2 col-lg-6 col-md-6 col-6 mt-30 wow fadeInUp animated">
                        <div class="footer-default__single-box">
                            <div class="footer-title">
                                <h4> For architects </h4>
                            </div>
                            <ul class="footer-links">
                                <li><a href="#0">connect with us</a></li>
                                
                            </ul>
                        </div>
                    </div>
					
					<div class="col-xl-4 col-lg-6 col-md-6 col-12 mt-30 wow fadeInUp animated footer_img">
					 <ul class="footer-payment wow fadeInUp animated">
                        <li><a href="#0"><img src="<?php echo base_url(); ?>/assets/img/Facebook-Negative.png"></a></li>
                        <li><a href="#0"><img src="<?php echo base_url(); ?>/assets/img/twitter.png"></a></li>
                        <li><a href="#0"><img src="<?php echo base_url(); ?>/assets/img/Instagram-Negative.png"></a></li>
                        <li><a href="#0"><img src="<?php echo base_url(); ?>/assets/img/LinkedIn-Negative.png"></a></li>
						 <li><a href="#0"><img src="<?php echo base_url(); ?>/assets/img/YouTube-Negative.png"></a></li>
                    </ul>
					<a href="<?php echo base_url();?>" style="width:100%;">
					<img class="footer_logo" src="<?php echo base_url();?>assets/img/logo_white.png">
					</a>
					</div>
					
					
					
                </div>
            </div>
        </div> <!-- footer-bottom Footer-->
        <div class="footer_bottom position-relative">
            <div class="container text-center white">
                
                        <p> © 2022  All rights reserved  -<a href="#"> Terms</a> -<a href="#"> Privacy policy</a> -<a href="#"> General Terms </a>- <a href="#">Manage cookies</a></p>
                    </div>
                   
                </div>
            
    </footer>

<div id="popup5" class="product-gird__quick-view-popup mfp-hide">
   
      <div class="contact-form">
         <h3>Send Us Message</h3>
         <form action="<?php echo base_url('request-call-back');?>" method="POST" class="common-form">
            <div class="row">
               <div class="col-lg-6">
                  <div class="form-group"> <label for="name"> Your Name</label> <input type="text" id="name"  name="name" class="form-control" placeholder="Enter Your Name" required> </div>
               </div>
               <div class="col-lg-6">
                  <div class="form-group"> <label for="number"> Phone Number </label> <input type="number" name="number" id="number" class="form-control" placeholder="Enter Your Contact Number" required> </div>
               </div>
               <div class="col-lg-12">
                  <div class="form-group"> <label for="email"> Email Address </label> <input type="email" name="email" id="email" class="form-control" placeholder="Enter Your Email" required> </div>
               </div>
			   
			   <input type="hidden" name="uri" id="email" class="form-control" value="<?php echo $uri_id =$this->uri->segment(2); ?>"> 
              
               <div class="col-12">
                  <div class="form-group m-0"> <label for="email"> Write Message </label>
                     <textarea name="message" placeholder="Enter Your Message"></textarea> 
                  </div>
               </div>
            </div>
            <button type="submit" class="btn--primary style2 ">Send Inquiry  </button>
         </form>
      
   </div>
</div>

<div id="popup56" class="product-gird__quick-view-popup mfp-hide">
   
      <div class="contact-form">
         <h3>Send Us Message</h3>
         <form action="<?php echo base_url('request-call-back-re');?>" method="POST" class="common-form">
            <div class="row">
               <div class="col-lg-6">
                  <div class="form-group"> <label for="name"> Your Name</label> <input type="text" id="name"  name="name" class="form-control" placeholder="Enter Your Name" required> </div>
               </div>
               <div class="col-lg-6">
                  <div class="form-group"> <label for="number"> Phone Number </label> <input type="number" name="number" id="number" class="form-control" placeholder="Enter Your Contact Number" required> </div>
               </div>
               <div class="col-lg-12">
                  <div class="form-group"> <label for="email"> Email Address </label> <input type="email" name="email" id="email" class="form-control" placeholder="Enter Your Email" required> </div>
               </div>
			   
			   <input type="hidden" name="uri" id="email" class="form-control" value="<?php echo $uri_id =$this->uri->segment(2); ?>"> 
              
               <div class="col-12">
                  <div class="form-group m-0"> <label for="email"> Write Message </label>
                     <textarea name="message" placeholder="Enter Your Message"></textarea> 
                  </div>
               </div>
            </div>
            <button type="submit" class="btn--primary style2 ">Send Inquiry  </button>
         </form>
      
   </div>
</div>






    <!--==== Js Scripts Start ====-->
    <!-- Jquery v3.6.0 Js -->
    <script src="<?php echo base_url();?>assets/js/jqurey.v3.6.0.min.js"></script> <!-- Popper v2.9.3 Js -->
    <script src="<?php echo base_url();?>assets/js/popper.v2.9.3.min.js"></script> <!-- Bootstrap v5.1.1 js -->
    <script src="<?php echo base_url();?>assets/js/bootstrap.v5.1.1.min.js"></script> <!-- jquery ui js -->
    <script src="<?php echo base_url();?>assets/js/plugin/jquery-ui.min.js"></script> <!-- Parallax js -->
    <script src="<?php echo base_url();?>assets/js/plugin/jarallax.min.js"></script> <!-- Slick Slider Js -->
    <script src="<?php echo base_url();?>assets/js/plugin/slick.min.js"></script> <!-- isotope Js -->
    <script src="<?php echo base_url();?>assets/js/plugin/isotope.js"></script> <!-- magnific-popup v2.3.4 Js -->
    <script src="<?php echo base_url();?>assets/js/plugin/jquery.magnific-popup.min.js"></script> <!-- Tweenmax v2.3.4 Js -->
    <script src="<?php echo base_url();?>assets/js/plugin/tweenMax.min.js"></script> <!-- Nice Select Js -->
    <script src="<?php echo base_url();?>assets/js/plugin/nice-select.v1.0.min.js"></script> <!-- Wow js -->
    <script src="<?php echo base_url();?>assets/js/plugin/wow.v1.3.0.min.js"></script> <!-- Wow js -->
    <script src="<?php echo base_url();?>assets/js/plugin/jquery.countdown.min.js"></script> <!-- Main js -->
    <script src="<?php echo base_url();?>assets/js/main.js"></script>
	
	
	
	<script src='https://unpkg.com/masonry-layout@4/dist/masonry.pkgd.min.js'></script>
	<script src='https://unpkg.com/imagesloaded@4/imagesloaded.pkgd.min.js'></script>
	
	<script src="https://cdnjs.cloudflare.com/ajax/libs/fabric.js/2.6.0/fabric.min.js"></script>
	
	<script>
	$(".megamenu-list li").hover(function(){

       var val = $(this).attr("data-id");
            console.log(val);
    
            $.ajax({
			url:"<?php echo base_url('welcome/get_sub_cat_img'); ?>",
			method:"POST",
			data:{id:val},
			success:function(data)
			{
			  $(".subcat_img").attr("src","<?php echo base_url('uploads/subcategories/'); ?>" + data);
			}
		   }), function(){
            $(".subcat_img").attr("src","");
		   }
     });
	
	
	$("#choosec").click(function () {
      var color = $("#ccolor").val() + " ";
    
      //$(".color-picker").css("background-color", color);
      $(".mainul").append('<img class="image img_dragging">');
      $(".mainul").children().last().css("background-color", color);
    
    });

	
        var canvas = (this.__canvas = new fabric.Canvas("c"));
        var imageOffsetX, imageOffsetY;
        
        function handleDragStart(e) {
          [].forEach.call(images, function (img) {
            img.classList.remove("img_dragging");
          });
          this.classList.add("img_dragging");
        
          var imageOffset = $(this).offset();
          imageOffsetX = e.clientX - imageOffset.left;
          imageOffsetY = e.clientY - imageOffset.top;
        }
        
        function handleDragOver(e) {
          if (e.preventDefault) {
            e.preventDefault();
          }
          e.dataTransfer.dropEffect = "copy";
          return false;
        }
        
        function handleDragEnter(e) {
          this.classList.add("over");
        }
        
        function handleDragLeave(e) {
          this.classList.remove("over");
        }
        
        function handleDrop(e) {
          e = e || window.event;
          if (e.preventDefault) {
            e.preventDefault();
          }
          if (e.stopPropagation) {
            e.stopPropagation();
          }
          var img = document.querySelector("img.img_dragging");
        
          console.log("event: ", e);
          var offset = $(canvas.lowerCanvasEl).offset();
          var y = e.clientY - (offset.top + imageOffsetY);
          var x = e.clientX - (offset.left + imageOffsetX);
        
          console.log(img.width);
          console.log(img.height);
        
          var newImage = new fabric.Image(img, {
            left: x,
            top: y
          });
        
          canvas.add(newImage);
          return false;
        }
        
        function handleDragEnd(e) {
          $(e.target).removeClass("img_dragging");
        }
        
        function handleClick(e) {
          var img = e.target;
          var newImage = new fabric.Image(img, {
            width: img.width,
            height: img.height,
            top: 10,
            left: 10
          });
          canvas.add(newImage);
        }
        
        var images = document.querySelectorAll(".images img");
        [].forEach.call(images, function (img) {
          img.addEventListener("dragstart", handleDragStart, false);
          img.addEventListener("dragend", handleDragEnd, false);
          img.addEventListener("click", handleClick, false);
        });
        
        var imagesn = document.querySelectorAll(".mainul img");
        [].forEach.call(imagesn, function (imgn) {
          imgn.addEventListener("dragstart", handleDragStart, false);
          imgn.addEventListener("dragend", handleDragEnd, false);
          imgn.addEventListener("click", handleClick, false);
        });
        
        var canvasContainer = canvas.wrapperEl;
        
        canvasContainer.addEventListener("dragenter", handleDragEnter, false);
        canvasContainer.addEventListener("dragover", handleDragOver, false);
        canvasContainer.addEventListener("dragleave", handleDragLeave, false);
        canvasContainer.addEventListener("drop", handleDrop, false);
        
        console.log(canvasContainer);
    
    </script>
	
	<script>
		$(document).ready(function(){
		 $( "#page_list" ).sortable({
		  placeholder : "ui-state-highlight",
		  update  : function(event, ui)
		  {
		   var page_id_array = new Array();
		   $('#page_list li').each(function(){
			page_id_array.push($(this).attr("id"));
		   });
		   console.log(page_id_array);
		   $.ajax({
			url:"<?php echo base_url('welcome/update_order'); ?>",
			method:"POST",
			data:{page_id_array:page_id_array},
			success:function(data)
			{
			 alert(data);
			}
		   });
		  }
		 });

		});
</script>
	
	
	
	
	
	
	<script>
	$('.option').click(function(){
 var f_id = $(this).attr('data-value');
    console.log(f_id);
    $.ajax({
        method: "POST",
        url: "<?php echo base_url("welcome/status_update") ?>",
        data: { f_id: f_id },
        success: function(data) {
            location.reload();
        }
    });
	
	});
	
	var grid = document.querySelector('.grid');
var msnry;
// element selectors
var imgAll = document.querySelectorAll('.grid-item');
<?php 
 $category  = $this->db->get('categories')->result_array();
foreach($category as $cat) { ?>
var <?php echo 'test'.trim($cat['cname']) ?> = document.querySelectorAll('.<?php echo trim($cat['cname']) ?>');
<?php } ?>
// buttons
const tabsUl = document.getElementById('buttonGroup');
const lis = tabsUl.children;
const gridItems = grid.children;


imagesLoaded(grid, function(){
	msnry = new Masonry( grid, {
		//options
		itemSelector: '.grid-item',
		columnWidth: '.grid-sizer',
		percentPosition: true
	});
});

//element & class name
function toggleClass(parentElem, childElems, className){
	for(let i = 0; i <childElems.length; i++){
		if(childElems[i]==parentElem){
			childElems[i].classList.add(className);
		}
		else{
			childElems[i].classList.remove(className);
		}
	}
}

function showImages(showImg, <?php foreach($category as $cat) { ?> hideImg<?php echo $cat['id'].","; ?> <?php } ?>){
	for(let i = 0; i < showImg.length; i++){
			showImg[i].style.display = "block";
		}
		<?php foreach($category as $cat) { ?>
		for(let i = 0; i < hideImg<?php echo $cat['id']; ?>.length; i++){
			hideImg1[i].style.display = "none";
		}
		<?php } ?>
}


tabsUl.addEventListener('click', (event) =>{
	let tabLi = event.target.parentNode;
	
	toggleClass(tabLi, lis, 'is-active');
	
	//show all images
	if(event.target.id == "all"){
		for(let i = 0; i< imgAll.length; i++){
			imgAll[i].style.display = "block";
		}
	}
	
	//show ny images
	
	
	<?php 
 $category  = $this->db->get('categories')->result_array();
foreach($category as $cat) { ?>
	if(event.target.id == "<?php echo trim($cat['cname']) ?>"){
		showImages(<?php echo 'test'.trim($cat['cname']) ?>, <?php 
		foreach($category as $cata) { 
		if($cata['cname'] == $cat['cname']){ }else{
		echo 'test'.trim($cata['cname']).",";
		}}		?>);
	}
<?php } ?>
	
	msnry.layout();
	
});

grid.addEventListener('click',function(event){
	let imgContainer = event.target.parentNode;
	toggleClass(imgContainer, gridItems, );
	msnry.layout();
});
	</script>
	
	<script>
	var btn = document.querySelector('.add');
var remove = document.querySelector('.draggable');

function dragStart(e) {
  this.style.opacity = '0.4';
  dragSrcEl = this;
  e.dataTransfer.effectAllowed = 'move';
  e.dataTransfer.setData('text/html', this.innerHTML);
};

function dragEnter(e) {
  this.classList.add('over');
}

function dragLeave(e) {
  e.stopPropagation();
  this.classList.remove('over');
}

function dragOver(e) {
  e.preventDefault();
  e.dataTransfer.dropEffect = 'move';
  return false;
}

function dragDrop(e) {
  if (dragSrcEl != this) {
    dragSrcEl.innerHTML = this.innerHTML;
    this.innerHTML = e.dataTransfer.getData('text/html');
  }
  return false;
}

function dragEnd(e) {
  var listItens = document.querySelectorAll('.draggable');
  [].forEach.call(listItens, function(item) {
    item.classList.remove('over');
  });
  this.style.opacity = '1';
}

function addEventsDragAndDrop(el) {
	
	console.log(el);
  el.addEventListener('dragstart', dragStart, false);
  el.addEventListener('dragenter', dragEnter, false);
  el.addEventListener('dragover', dragOver, false);
  el.addEventListener('dragleave', dragLeave, false);
  el.addEventListener('drop', dragDrop, false);
  el.addEventListener('dragend', dragEnd, false);
}

var listItens = document.querySelectorAll('.draggable');
[].forEach.call(listItens, function(item) {
  addEventsDragAndDrop(item);
});

function addNewItem() {
  var newItem = document.querySelector('.input').value;
  if (newItem != '') {
    document.querySelector('.input').value = '';
    var li = document.createElement('li');
    var attr = document.createAttribute('draggable');
    var ul = document.querySelector('ul');
    li.className = 'draggable';
    attr.value = 'true';
    li.setAttributeNode(attr);
    li.appendChild(document.createTextNode(newItem));
    ul.appendChild(li);
    addEventsDragAndDrop(li);
  }
}

btn.addEventListener('click', addNewItem);
	</script>
<script>
window.onload = function() {
  initDragElement();
  initResizeElement();
};

function initDragElement() {
  var pos1 = 0,
    pos2 = 0,
    pos3 = 0,
    pos4 = 0;
  var popups = document.getElementsByClassName("popup");
  var elmnt = null;
  var currentZIndex = 100; //TODO reset z index when a threshold is passed

  for (var i = 0; i < popups.length; i++) {
    var popup = popups[i];
    var header = getHeader(popup);

    popup.onmousedown = function() {
      this.style.zIndex = "" + ++currentZIndex;
    };

    if (header) {
      header.parentPopup = popup;
      header.onmousedown = dragMouseDown;
    }
  }

  function dragMouseDown(e) {
    elmnt = this.parentPopup;
    elmnt.style.zIndex = "" + ++currentZIndex;

    e = e || window.event;
    // get the mouse cursor position at startup:
    pos3 = e.clientX;
    pos4 = e.clientY;
    document.onmouseup = closeDragElement;
    // call a function whenever the cursor moves:
    document.onmousemove = elementDrag;
  }

  function elementDrag(e) {
    if (!elmnt) {
      return;
    }

    e = e || window.event;
    // calculate the new cursor position:
    pos1 = pos3 - e.clientX;
    pos2 = pos4 - e.clientY;
    pos3 = e.clientX;
    pos4 = e.clientY;
    // set the element's new position:
    elmnt.style.top = elmnt.offsetTop - pos2 + "px";
    elmnt.style.left = elmnt.offsetLeft - pos1 + "px";
  }

  function closeDragElement() {
    /* stop moving when mouse button is released:*/
    document.onmouseup = null;
    document.onmousemove = null;
  }

  function getHeader(element) {
    var headerItems = element.getElementsByClassName("popup-header");

    if (headerItems.length === 1) {
      return headerItems[0];
    }

    return null;
  }
}

function initResizeElement() {
  var popups = document.getElementsByClassName("popup");
  var element = null;
  var startX, startY, startWidth, startHeight;

  for (var i = 0; i < popups.length; i++) {
    var p = popups[i];

    var right = document.createElement("div");
    right.className = "resizer-right";
    p.appendChild(right);
    right.addEventListener("mousedown", initDrag, false);
    right.parentPopup = p;

    var bottom = document.createElement("div");
    bottom.className = "resizer-bottom";
    p.appendChild(bottom);
    bottom.addEventListener("mousedown", initDrag, false);
    bottom.parentPopup = p;

    var both = document.createElement("div");
    both.className = "resizer-both";
    p.appendChild(both);
    both.addEventListener("mousedown", initDrag, false);
    both.parentPopup = p;
  }

  function initDrag(e) {
    element = this.parentPopup;

    startX = e.clientX;
    startY = e.clientY;
    startWidth = parseInt(
      document.defaultView.getComputedStyle(element).width,
      10
    );
    startHeight = parseInt(
      document.defaultView.getComputedStyle(element).height,
      10
    );
    document.documentElement.addEventListener("mousemove", doDrag, false);
    document.documentElement.addEventListener("mouseup", stopDrag, false);
  }

  function doDrag(e) {
    element.style.width = startWidth + e.clientX - startX + "px";
    element.style.height = startHeight + e.clientY - startY + "px";
  }

  function stopDrag() {
    document.documentElement.removeEventListener("mousemove", doDrag, false);
    document.documentElement.removeEventListener("mouseup", stopDrag, false);
  }
}
</script>

<script>
	
	$('.installation').click(function(){
	var i_id = $(this).val();
    var s_id = $('#segment_id').val();
    console.log("i_id" +i_id);
    console.log("s_id" +s_id);
    $.ajax({
        method: "POST",
        url: "<?php echo base_url('welcome/installation_data') ?>", 
        data: { i_id: i_id , s_id: s_id},
        success: function(data) {
         $('#filter_data').html(data.html);   
		 console.log(data);
        }
    });
	
	});
</script>

<script>
	
	$('.application').click(function(){
	var i_id = $(this).val();
	var s_id = $('#segment_id').val();
    console.log("i_id" +i_id);
    console.log("s_id" +s_id);
    $.ajax({
        method: "POST",
        url: "<?php echo base_url('welcome/application_data') ?>", 
        data: { i_id: i_id , s_id: s_id},
        success: function(data) {
         $('#filter_data').html(data.html);   
		 console.log(data);
        }
    });
	
	});
</script>

<script>
	
	$('.material').click(function(){
	var i_id = $(this).val();
    var s_id = $('#segment_id').val();
    console.log("i_id" +i_id);
    console.log("s_id" +s_id);
    $.ajax({
        method: "POST",
        url: "<?php echo base_url('welcome/material_data') ?>", 
        data: { i_id: i_id , s_id: s_id},
        success: function(data) {
         $('#filter_data').html(data.html);   
		 console.log(data);
        }
    });
	
	});
</script>


<script>
	
	$('.shape').click(function(){
	var i_id = $(this).val();
   var s_id = $('#segment_id').val();
    console.log("i_id" +i_id);
    console.log("s_id" +s_id);
    $.ajax({
        method: "POST",
        url: "<?php echo base_url('welcome/shape_data') ?>", 
        data: { i_id: i_id , s_id: s_id},
        success: function(data) {
         $('#filter_data').html(data.html);   
		 console.log(data);
        }
    });
	
	});
</script>


<script>
	
	$('.effects').click(function(){
	var i_id = $(this).val();
   var s_id = $('#segment_id').val();
    console.log("i_id" +i_id);
    console.log("s_id" +s_id);
    $.ajax({
        method: "POST",
        url: "<?php echo base_url('welcome/effects_data') ?>", 
        data: { i_id: i_id , s_id: s_id},
        success: function(data) {
         $('#filter_data').html(data.html);   
		 console.log(data);
        }
    });
	
	});
</script>


<script>
	
	$('.finish').click(function(){
	var i_id = $(this).val();
   var s_id = $('#segment_id').val();
    console.log("i_id" +i_id);
    console.log("s_id" +s_id);
    $.ajax({
        method: "POST",
        url: "<?php echo base_url('welcome/finish_data') ?>", 
        data: { i_id: i_id , s_id: s_id},
        success: function(data) {
         $('#filter_data').html(data.html);   
		 console.log(data);
        }
    });
	
	});
</script>

<script>
	
	$('.size').click(function(){
	var i_id = $(this).val();
    var s_id = $('#segment_id').val();
    console.log("i_id" +i_id);
    console.log("s_id" +s_id);
    $.ajax({
        method: "POST",
        url: "<?php echo base_url('welcome/size_data') ?>", 
        data: { i_id: i_id , s_id: s_id},
        success: function(data) {
         $('#filter_data').html(data.html);   
		 console.log(data);
        }
    });
	
	});
</script>


<script>
	
	$('.thickness').click(function(){
	var i_id = $(this).val();
     var s_id = $('#segment_id').val();
    console.log("i_id" +i_id);
    console.log("s_id" +s_id);
    $.ajax({
        method: "POST",
        url: "<?php echo base_url('welcome/thickness_data') ?>", 
        data: { i_id: i_id , s_id: s_id},
        success: function(data) {
         $('#filter_data').html(data.html);   
		 console.log(data);
        }
    });
	
	});
</script>


<script>
	
	$('.type').click(function(){
	var i_id = $(this).val();
     var s_id = $('#segment_id').val();
    console.log("i_id" +i_id);
    console.log("s_id" +s_id);
    $.ajax({
        method: "POST",
        url: "<?php echo base_url('welcome/type_data') ?>", 
       data: { i_id: i_id , s_id: s_id},
        success: function(data) {
         $('#filter_data').html(data.html);   
		 console.log(data);
        }
    });
	
	});
</script>


<script>
	
	$('.themes').click(function(){
	var i_id = $(this).val();
     var s_id = $('#segment_id').val();
    console.log("i_id" +i_id);
    console.log("s_id" +s_id);
    $.ajax({
        method: "POST",
        url: "<?php echo base_url('welcome/themes_data') ?>", 
        data: { i_id: i_id , s_id: s_id},
        success: function(data) {
         $('#filter_data').html(data.html);   
		 console.log(data);
        }
    });
	
	});
</script>


<script>
	
	$('.light_bulb_type').click(function(){
	var i_id = $(this).val();
     var s_id = $('#segment_id').val();
    console.log("i_id" +i_id);
    console.log("s_id" +s_id);
    $.ajax({
        method: "POST",
        url: "<?php echo base_url('welcome/light_bulb_type_data') ?>", 
        data: { i_id: i_id , s_id: s_id},
        success: function(data) {
         $('#filter_data').html(data.html);   
		 console.log(data);
        }
    });
	
	});
</script>

<script>
	
	$('.number_of_seat').click(function(){
	var i_id = $(this).val();
     var s_id = $('#segment_id').val();
    console.log("i_id" +i_id);
    console.log("s_id" +s_id);
    $.ajax({
        method: "POST",
        url: "<?php echo base_url('welcome/number_of_seat_data') ?>", 
        data: { i_id: i_id , s_id: s_id},
        success: function(data) {
         $('#filter_data').html(data.html);   
		 console.log(data);
        }
    });
	
	});
</script>

<script>
	
	$('.bed_size').click(function(){
	var i_id = $(this).val();
     var s_id = $('#segment_id').val();
    console.log("i_id" +i_id);
    console.log("s_id" +s_id);
    $.ajax({
        method: "POST",
        url: "<?php echo base_url('welcome/bed_size_data') ?>", 
        data: { i_id: i_id , s_id: s_id},
        success: function(data) {
         $('#filter_data').html(data.html);   
		 console.log(data);
        }
    });
	
	});
</script>

<script>
	
	$('.bowl').click(function(){
	var i_id = $(this).val();
     var s_id = $('#segment_id').val();
    console.log("i_id" +i_id);
    console.log("s_id" +s_id);
    $.ajax({
        method: "POST",
        url: "<?php echo base_url('welcome/bowl_data') ?>", 
        data: { i_id: i_id , s_id: s_id},
        success: function(data) {
         $('#filter_data').html(data.html);   
		 console.log(data);
        }
    });
	
	});
</script>

<script>
	
	$('.color').click(function(){
	var i_id = $(this).val();
     var s_id = $('#segment_id').val();
    console.log("i_id" +i_id);
    console.log("s_id" +s_id);
    $.ajax({
        method: "POST",
        url: "<?php echo base_url('welcome/color_data') ?>", 
        data: { i_id: i_id , s_id: s_id},
        success: function(data) {
         $('#filter_data').html(data.html);   
		 console.log(data);
        }
    });
	
	});
</script>

<script>
	
	$('.door').click(function(){
	var i_id = $(this).val();
    
    console.log("i_id" + i_id);
    
    $.ajax({
        method: "POST",
        url: "<?php echo base_url('welcome/door_data')?>", 
        data: { i_id: i_id },
        success: function(data) {
         $('#filter_data').html(data.html);   
		 console.log(data);
        }
    });
	
	});
</script>


<script>
	
	$('.sensor').click(function(){
	var i_id = $(this).val();
    
    console.log("i_id" + i_id);
    
    $.ajax({
        method: "POST",
        url: "<?php echo base_url('welcome/sensor_data')?>", 
        data: { i_id: i_id },
        success: function(data) {
         $('#filter_data').html(data.html);   
		 console.log(data);
        }
    });
	
	});
</script>


<script>
	
	$('.city').click(function(){
	var i_id = $(this).val();
    console.log(i_id);
    $.ajax({
        method: "POST",
        url: "<?php echo base_url('welcome/city_data_filter')?>", 
        data: { i_id: i_id },
        success: function(data) {
         $('#city_data').html(data.html);   
		 console.log(data);
        }
    });
	
	});
</script>	
	
    <!--==== Js Scripts End ====-->
</body>



</html>