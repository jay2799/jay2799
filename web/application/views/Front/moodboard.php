<link href="https://cdnjs.cloudflare.com/ajax/libs/fullPage.js/2.9.2/jquery.fullPage.min.css" rel="stylesheet">
<div class="top-sec">
   <div class="container">
      <div class="row">
         <div class="col-md-1">
            <div class="wish-ref">
               <a href="#">Wishlist  </a>
            </div>
         </div>
         <div class="col-md-11">
            <div class="wish-titlea ">
               <h4><u>Moodboard</u></h4>
            </div>
         </div>
      </div>
   </div>
</div>
<div class="border-bottom">
   <div class="container mb-3">
      <div class="row">
         <div class="col-md-9 mt-4">
            <input type="text" class="form-control mood" placeholder="Name your moodboard">
         </div>
         <div class="col-md-3">
            <a href="#" class="btn"><i class="fa-brands fa-telegram c_icon"></i> SEND</a>&nbsp;&nbsp;&nbsp;
            <a href="#" class="btna">...</a>
         </div>
      </div>
   </div>
</div>
<div class="moodboard mt-4">
   <div class="container-fluid">
      <div class="row">
         <div class="col-md-4 ">
            <div class="row">
               <div class="col-md-4 mood_menu">
                   <div class="d-flex align-items-start">
                        <div class="nav my-account-page__menu flex-column nav-pills me-3" id="v-pills-tab"
                            role="tablist" aria-orientation="vertical"> 
						
					   <button style="margin: 0;" class="nav-link active" id="v-pills-wishlist-tab" data-bs-toggle="pill" data-bs-target="#v-pills-wishlist" type="button" role="tab" aria-controls="v-pills-wishlist" aria-selected="false"> <span> <i class="fa fa-folder" aria-hidden="true"></i> Wishlist</span>
                       </button>
                       
                       <span class="folder_w"><a href="javascript:void(0);">Folder NM</a></span>
                     <span class="folder_w"><a href="javascript:void(0);">Folder NM</a></span>
                     <span class="folder_w"><a href="javascript:void(0);">Folder NM</a></span>
					   
					   <button style="margin-top: 15px;" class="nav-link" id="v-pills-text-tab" data-bs-toggle="pill" data-bs-target="#v-pills-text" type="button" role="tab" aria-controls="v-pills-text" aria-selected="false"> <span> <i class="fa-solid fa-highlighter"></i> Text</span>
                       </button>
                       
                       <button class="nav-link" id="v-pills-color-tab" data-bs-toggle="pill" data-bs-target="#v-pills-color" type="button" role="tab" aria-controls="v-pills-color" aria-selected="false"> <span> <i class="fas fa-eye-dropper"></i>  Color</span>
                       </button>
						
					  </div>
                    </div>
               </div>
               <div class="col-md-8 mood_text">
                   <div class="tab-content " id="v-pills-tabContent">
					  <div class="tab-pane fade show active" id="v-pills-wishlist" role="tabpanel"
						 aria-labelledby="v-pills-wishlist-tab">
						 <div class="tabs-content__single">
							    <div class="col  images">
                              <img src="https://nexdee.com/web/uploads/subcategories/6278b365609c1.jpg" class="image" />
                              <img src="https://nexdee.com/web/uploads/subcategories/6278b4a402f65.jpg" class="image" />
                              <img src="https://nexdee.com/web/uploads/subcategories/6278b5f274a62.jpg" class="image" />
                              <img src="https://nexdee.com/web/uploads/subcategories/6278b7089338b.jpg" class="image" />
                              <img src="https://nexdee.com/web/uploads/subcategories/6278b90e66433.jpg" class="image" />
                              <img src="https://nexdee.com/web/uploads/subcategories/6278b9334a4e0.jpg" class="image" />
                              
                              
                              </div>
						 </div>
					  </div>
					  
					   <div class="tab-pane fade " id="v-pills-text" role="tabpanel"
						 aria-labelledby="v-pills-text-tab">
						 <div class="tabs-content__single">
							text
					    </div>
					  </div>
					  
					  <div class="tab-pane fade " id="v-pills-color" role="tabpanel"
						 aria-labelledby="v-pills-color-tab">
						 <div class="tabs-content__single">
							<div class="color-picker">
                              <h2>Pick a color</h2>
                              <input type="color" value="#ffffff" id="ccolor"></input>
                            </div>
                            
                            <button id="choosec">Submit</button>
                            
                            <section>
                              <div class="picked-color">
                                <div class="mainul">
                                    
                                </div>
                              </div>
                            </section>
					    </div>
					  </div>
					  
				   </div>
               </div>
            </div>
         </div>
         <div class="col-md-8 ">
            <div class="col">
               <canvas height="500" id="c"></canvas>
            </div>
         </div>
      </div>
   </div>
</div>
<style>
div.color-picker {
  width: 84%;
  border-radius: 10px;
  margin-left: 8%;
  background-color: rgba(199, 13, 0, 0.3);
  transition: background-color 0.3s;
}

section {
  width: 100%;
}

div.picked-color {
  font-family: Helvetica Neue;
  font-weight: lighter;
  font-size: 2em;
  text-align: center;
}

.picked-color .mainul {
  width: 50%;
  margin-left: 25%;
  padding: 0;
  list-style: none;
}

.picked-color span {
  width: 51%;
  min-width: 120px;
  margin: auto;
  border-radius: 5px;
  cursor: pointer;
  display: inline-block;
  z-index: 2;
}

div.trash {
  width: 25%;
  text-align: center;
  font-family: Helvetica Neue;
  font-weight: lighter;
  font-size: 2em;
  position: fixed;
  bottom: 0;
  right: 0;
  border: 1px solid #d52100;
  border-bottom: none;
  border-right: none;
  color: #d52100;
  padding: 15px 0;
  border-radius: 5px 0 0 0;
  background-color: white;
  transition: background-color 0.3s, color 0.3s;
}

div.hover.trash {
  background-color: #d52100;
  color: white;
}

div.clear {
  width: 25%;
  text-align: center;
  font-family: Helvetica Neue;
  font-weight: lighter;
  font-size: 2em;
  position: fixed;
  bottom: 0;
  left: 0;
  border: 1px solid #d52100;
  border-bottom: none;
  border-left: none;
  color: #d52100;
  padding: 15px 0;
  border-radius: 0 5px 0 0;
  background-color: white;
  transition: background-color 0.3s, color 0.3s;
  z-index: 100;
}
.picked-color img
{
    width:50px;
    height:50px;
}
div.clear:hover {
  background-color: #d52100;
  color: white;
  cursor: pointer;
  z-index: 100;
}
    .mood_text {
        border: 1px solid #eee;
        border-radius: 20px;
    }
    .mood_menu {
        border: 1px solid #eee;
        border-radius: 20px;
        background: #f4f4f4 !important;
    }
    .mood_menu .nav-link {
        margin-bottom: 10px;
    }
    .mood_menu .nav {
        padding: 25px 15px 25px;
        margin: 0px !important;
    }
   .footer-default.home4-footer {
   background: #232323;
   width: 100%;
   float: left;
   }
   section.newsLetter-one {
   width: 100%;
   float: left;
   }
   .moodboard {
   width: 100%;
   float: left;
   }
   [draggable] {
   -moz-user-select: none;
   -khtml-user-select: none;
   -webkit-user-select: none;
   user-select: none;
   -khtml-user-drag: element;
   -webkit-user-drag: element;
   cursor: move;
   }
   canvas {
   border: 1px solid #ccc;
   display: block;
   width: 100%;
   }
   .images img {
   width: 121px;
   margin: 5px;
   float: left;
   }
   .col {
   float: left;
   width: 100%;
   }
   span.folder_w {
        font-size: 14px;
        font-weight: 400;
    }
</style>