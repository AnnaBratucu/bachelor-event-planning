<!DOCTYPE html>
<!--<html class="menu">-->
<html>

<?php include '../head.php'; 

require_once "../config.php";

session_start();

$date_err = "";


if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Validate username
    $input_date_min = $_POST["date_min"];
    $input_date_max = $_POST["date_max"];
    if($input_date_min > $input_date_max){
		$date_err = "Date Min can't be bigger than Date Max";
    } else if($input_date_min < date("m-d-Y") || $input_date_max < date("m-d-Y")){
        $date_err = "Date Min or Date Max can't be in the past";
    }else{
        $_SESSION[ 'date_min' ] = $input_date_min;
        $_SESSION[ 'date_max' ] = $input_date_max;
        header("location: wizard_step1.php");
        exit();
    }
}


?>

<body>



<nav class="main-menu">


  
<div class="settings"></div>
<div class="scrollbar" id="style-1">
      
<ul>
  
<li>                                   
<a href="../plan.php">
<i class="fa fa-home fa-lg"></i>
<span class="nav-text">Home</span>
</a>
</li>   
   
<li>                                 
<a href="../profile.php">
<i class="fa fa-user fa-lg"></i>
<span class="nav-text">Your profile</span>
</a>
</li>   

    
<li>                                 
<a href="../contact.php">
<i class="fa fa-envelope-o fa-lg"></i>
<span class="nav-text">Contact</span>
</a>
</li>   
  


 
<li>
<a href="http://startific.com">
<i class="fa fa-heart-o fa-lg"></i>
                        
<span class="share"> 


<div class="addthis_default_style addthis_32x32_style">
  
<div style="position:absolute;
margin-left: 56px;top:3px;"> 
   
  

  
 <a href="https://www.facebook.com/sharer/sharer.php?u=" target="_blank" class="share-popup"><img src="http://icons.iconarchive.com/icons/danleech/simple/512/facebook-icon.png" width="30px" height="30px"></a>

   <a href="https://twitter.com/share" target="_blank" class="share-popup"><img src="https://cdn1.iconfinder.com/data/icons/metro-ui-dock-icon-set--icons-by-dakirby/512/Twitter_alt.png" width="30px" height="30px"></a>

  
  
</div>
<script type="text/javascript">var addthis_config = {"data_track_addressbar":true};</script>
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-4ff17589278d8b3a"></script>
                       
                            
                              
                            
                          
                        </span>
                        <span class="twitter"></span>
                        <span class="fb-like">  
<iframe src="//www.facebook.com/plugins/like.php?href=http%3A%2F%2Ffacebook.com%2Fstartific&amp;width&amp;layout=button&amp;action=like&amp;show_faces=false&amp;share=false&amp;height=35" scrolling="no" frameborder="0" style="border:none; overflow:hidden; height:35px;" allowTransparency="true"></iframe>
                       
                        </span>
                        <span class="nav-text">
                        </span>
                        
                    </a>

</li>
                            

  
  
</li>

<li class="darkerli">
<a href="budget.php">
<i class="fas fa-money-bill-wave"></i>
<span class="nav-text">Budget</span>
</a>
</li>

<li class="darkerli">
<a href="guests.php">
<i class="fas fa-users"></i>
<span class="nav-text">Guests</span>
</a>
</li>

<li class="darkerlishadow" style="background-color:#ffcccc;">
<a href="wizard.php?event_id=<?php echo $_GET[ 'event_id' ] ?>">
<i class="fas fa-hotel"></i>
<span class="nav-text">Venue</span>
</a>
</li>
  
<li class="darkerli">
<a href="http://startific.com">
<i class="fa fa-desktop fa-lg"></i>
<span class="nav-text">Technology</span>
</a>
</li>
  
<li class="darkerli">
<a href="http://startific.com">
<i class="fa fa-plane fa-lg"></i>
<span class="nav-text">Travel</span>
</a>
</li>
  
<li class="darkerli">
<a href="http://startific.com">
<i class="fa fa-shopping-cart"></i>
 <span class="nav-text">Shopping</span>
</a>
</li>
  
<li class="darkerli">
<a href="http://startific.com">
<i class="fa fa-microphone fa-lg"></i>
<span class="nav-text">Film & Music</span>
</a>
</li>

<li class="darkerli">
<a href="http://startific.com">
<i class="fa fa-flask fa-lg"></i>
<span class="nav-text">Web Tools</span>
</a>
</li>
  
<li class="darkerli">
<a href="http://startific.com">
<i class="fa fa-picture-o fa-lg"></i>
<span class="nav-text">Art & Design</span>
</a>
</li>

<li class="darkerli">
<a href="http://startific.com">
<i class="fa fa-align-left fa-lg"></i>
<span class="nav-text">Magazines
</span>
</a>
</li>
  
<li class="darkerli">
<a href="http://startific.com">
<i class="fa fa-gamepad fa-lg"></i>
<span class="nav-text">Games</span>
</a>
</li>
  
<li class="darkerli">
<a href="http://startific.com">
<i class="fa fa-glass fa-lg"></i>
<span class="nav-text">Life & Style
</span>
</a>
</li>
  
<li class="darkerlishadowdown">
<a href="http://startific.com">
<i class="fa fa-rocket fa-lg"></i>
<span class="nav-text">Fun</span>
</a>
</li>
 
  
</ul>

  
<li>
                                   
<a href="http://startific.com">
<i class="fa fa-question-circle fa-lg"></i>
<span class="nav-text">Help</span>
</a>
</li>   
    
  
<ul class="logout">
<li>
                   <a href="../log/logout.php">
                         <i class="fa fa-sign-out fa-lg"></i>
                        <span class="nav-text">
                            LOGOUT 
                        </span>
                        
                    </a>
</li>  
</ul>
        </nav>
       

        <div class="wiz">
        
        <form id="regForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <div style="background-image:url('../images/5631.jpg');background-size:cover;margin-top:-62px;margin-left:-40px;margin-right:-40px;height:250px;">
            <div style="height:70px;"></div>
        <h1 style="color:#1f1f2e;">Choose venue</h1><br><br>
</div>
<div class="row" style="margin-left:80px;">
  <div class="column">
    <a href="novenue.php?event_id=<?php echo $_GET[ 'event_id' ] ?>"><div class="novenue" style="color:black;width:170px;height:50px;text-align:center;margin-top:18px;box-shadow: 0 4px 4px 0 rgba(0, 0, 0, 0.2), 0 4px 15px 0 rgba(0, 0, 0, 0.19);text-decoration: none;border:1px solid #a2a2c3"><p>I don't need a venue.</p></div></a>
  </div>
</div>
<hr/>



<div class="products">
			<div class="container">
				<div class="row products_bar_row">
					<div class="col">
						<div class="products_bar d-flex flex-lg-row flex-column align-items-lg-center align-items-start justify-content-lg-start justify-content-center">
							<div class="products_bar_links">
								<ul class="d-flex flex-row align-items-start justify-content-start">
									<li><a href="#">All</a></li>
									<li><a href="#">Hot Products</a></li>
									<li class="active"><a href="#">New Products</a></li>
									<li><a href="#">Sale Products</a></li>
								</ul>
							</div>
							<div class="products_bar_side d-flex flex-row align-items-center justify-content-start ml-lg-auto">
								<div class="products_dropdown product_dropdown_sorting">
									<div class="isotope_sorting_text"><span>Default Sorting</span><i class="fa fa-caret-down" aria-hidden="true"></i></div>
									<ul>
										<li class="item_sorting_btn" data-isotope-option='{ "sortBy": "original-order" }'>Default</li>
										<li class="item_sorting_btn" data-isotope-option='{ "sortBy": "price" }'>Price</li>
										<li class="item_sorting_btn" data-isotope-option='{ "sortBy": "name" }'>Name</li>
									</ul>
								</div>
								<div class="product_view d-flex flex-row align-items-center justify-content-start">
									<div class="view_item active"><img src="images/view_1.png" alt=""></div>
									<div class="view_item"><img src="images/view_2.png" alt=""></div>
									<div class="view_item"><img src="images/view_3.png" alt=""></div>
								</div>
								<div class="products_dropdown text-right product_dropdown_filter">
									<div class="isotope_filter_text"><span>Filter</span><i class="fa fa-caret-down" aria-hidden="true"></i></div>
									<ul>
										<li class="item_filter_btn" data-filter="*">All</li>
										<li class="item_filter_btn" data-filter=".hot">Hot</li>
										<li class="item_filter_btn" data-filter=".new">New</li>
										<li class="item_filter_btn" data-filter=".sale">Sale</li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row products_row products_container grid">
					
					<!-- Product -->
					<div class="col-xl-4 col-md-6 grid-item new">
						<div class="product">
							<div class="product_image"><img src="images/product_1.jpg" alt=""></div>
							<div class="product_content">
								<div class="product_info d-flex flex-row align-items-start justify-content-start">
									<div>
										<div>
											<div class="product_name"><a href="product.html">Cool Clothing with Brown Stripes</a></div>
											<div class="product_category">In <a href="category.html">Category</a></div>
										</div>
									</div>
									<div class="ml-auto text-right">
										<div class="rating_r rating_r_4 home_item_rating"><i></i><i></i><i></i><i></i><i></i></div>
										<div class="product_price text-right">$3<span>.99</span></div>
									</div>
								</div>
								<div class="product_buttons">
									<div class="text-right d-flex flex-row align-items-start justify-content-start">
										<div class="product_button product_fav text-center d-flex flex-column align-items-center justify-content-center">
											<div class="plus"><div class="plus"><img src="images/heart_2.svg" class="svg" alt=""><div class="plus">+</div></div></div>
										</div>
										<div class="product_button product_cart text-center d-flex flex-column align-items-center justify-content-center">
											<div class="plus"><div class="plus"><img src="images/cart.svg" class="svg" alt=""><div class="plus">+</div></div></div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>

					<!-- Product -->
					<div class="col-xl-4 col-md-6 grid-item hot">
						<div class="product">
							<div class="product_image"><img src="images/product_2.jpg" alt=""></div>
							<div class="product_content">
								<div class="product_info d-flex flex-row align-items-start justify-content-start">
									<div>
										<div>
											<div class="product_name"><a href="product.html">Hype Grey Shirt</a></div>
											<div class="product_category">In <a href="category.html">Category</a></div>
										</div>
									</div>
									<div class="ml-auto text-right">
										<div class="rating_r rating_r_4 home_item_rating"><i></i><i></i><i></i><i></i><i></i></div>
										<div class="product_price text-right">$4<span>.99</span></div>
									</div>
								</div>
								<div class="product_buttons">
									<div class="text-right d-flex flex-row align-items-start justify-content-start">
										<div class="product_button product_fav text-center d-flex flex-column align-items-center justify-content-center">
											<div class="plus"><div class="plus"><img src="images/heart_2.svg" class="svg" alt=""><div class="plus">+</div></div></div>
										</div>
										<div class="product_button product_cart text-center d-flex flex-column align-items-center justify-content-center">
											<div class="plus"><div class="plus"><img src="images/cart.svg" class="svg" alt=""><div class="plus">+</div></div></div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>

					<!-- Product -->
					<div class="col-xl-4 col-md-6 grid-item sale">
						<div class="product">
							<div class="product_image"><img src="images/product_3.jpg" alt=""></div>
							<div class="product_content">
								<div class="product_info d-flex flex-row align-items-start justify-content-start">
									<div>
										<div>
											<div class="product_name"><a href="product.html">Long Sleeve Jacket</a></div>
											<div class="product_category">In <a href="category.html">Category</a></div>
										</div>
									</div>
									<div class="ml-auto text-right">
										<div class="rating_r rating_r_4 home_item_rating"><i></i><i></i><i></i><i></i><i></i></div>
										<div class="product_price text-right">$13<span>.99</span></div>
									</div>
								</div>
								<div class="product_buttons">
									<div class="text-right d-flex flex-row align-items-start justify-content-start">
										<div class="product_button product_fav text-center d-flex flex-column align-items-center justify-content-center">
											<div class="plus"><div class="plus"><img src="images/heart_2.svg" class="svg" alt=""><div class="plus">+</div></div></div>
										</div>
										<div class="product_button product_cart text-center d-flex flex-column align-items-center justify-content-center">
											<div class="plus"><div class="plus"><img src="images/cart.svg" class="svg" alt=""><div class="plus">+</div></div></div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>

					<!-- Product -->
					<div class="col-xl-4 col-md-6 grid-item sale">
						<div class="product">
							<div class="product_image"><img src="images/product_4.jpg" alt=""></div>
							<div class="product_content">
								<div class="product_info d-flex flex-row align-items-start justify-content-start">
									<div>
										<div>
											<div class="product_name"><a href="product.html">Denim Men Shirt</a></div>
											<div class="product_category">In <a href="category.html">Category</a></div>
										</div>
									</div>
									<div class="ml-auto text-right">
										<div class="rating_r rating_r_4 home_item_rating"><i></i><i></i><i></i><i></i><i></i></div>
										<div class="product_price text-right">$5<span>.99</span></div>
									</div>
								</div>
								<div class="product_buttons">
									<div class="text-right d-flex flex-row align-items-start justify-content-start">
										<div class="product_button product_fav text-center d-flex flex-column align-items-center justify-content-center">
											<div class="plus"><div class="plus"><img src="images/heart_2.svg" class="svg" alt=""><div class="plus">+</div></div></div>
										</div>
										<div class="product_button product_cart text-center d-flex flex-column align-items-center justify-content-center">
											<div class="plus"><div class="plus"><img src="images/cart.svg" class="svg" alt=""><div class="plus">+</div></div></div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>

					<!-- Product -->
					<div class="col-xl-4 col-md-6 grid-item hot">
						<div class="product">
							<div class="product_image"><img src="images/product_5.jpg" alt=""></div>
							<div class="product_content">
								<div class="product_info d-flex flex-row align-items-start justify-content-start">
									<div>
										<div>
											<div class="product_name"><a href="product.html">Long Red Shirt</a></div>
											<div class="product_category">In <a href="category.html">Category</a></div>
										</div>
									</div>
									<div class="ml-auto text-right">
										<div class="rating_r rating_r_4 home_item_rating"><i></i><i></i><i></i><i></i><i></i></div>
										<div class="product_price text-right">$7<span>.99</span></div>
									</div>
								</div>
								<div class="product_buttons">
									<div class="text-right d-flex flex-row align-items-start justify-content-start">
										<div class="product_button product_fav text-center d-flex flex-column align-items-center justify-content-center">
											<div class="plus"><div class="plus"><img src="images/heart_2.svg" class="svg" alt=""><div class="plus">+</div></div></div>
										</div>
										<div class="product_button product_cart text-center d-flex flex-column align-items-center justify-content-center">
											<div class="plus"><div class="plus"><img src="images/cart.svg" class="svg" alt=""><div class="plus">+</div></div></div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>

					<!-- Product -->
					<div class="col-xl-4 col-md-6 grid-item new">
						<div class="product">
							<div class="product_image"><img src="images/product_6.jpg" alt=""></div>
							<div class="product_content">
								<div class="product_info d-flex flex-row align-items-start justify-content-start">
									<div>
										<div>
											<div class="product_name"><a href="product.html">Short Sleeve Shirt</a></div>
											<div class="product_category">In <a href="category.html">Category</a></div>
										</div>
									</div>
									<div class="ml-auto text-right">
										<div class="rating_r rating_r_4 home_item_rating"><i></i><i></i><i></i><i></i><i></i></div>
										<div class="product_price text-right">$12<span>.99</span></div>
									</div>
								</div>
								<div class="product_buttons">
									<div class="text-right d-flex flex-row align-items-start justify-content-start">
										<div class="product_button product_fav text-center d-flex flex-column align-items-center justify-content-center">
											<div class="plus"><div class="plus"><img src="images/heart_2.svg" class="svg" alt=""><div class="plus">+</div></div></div>
										</div>
										<div class="product_button product_cart text-center d-flex flex-column align-items-center justify-content-center">
											<div class="plus"><div class="plus"><img src="images/cart.svg" class="svg" alt=""><div class="plus">+</div></div></div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>

					<!-- Product -->
					<div class="col-xl-4 col-md-6 grid-item sale">
						<div class="product">
							<div class="product_image"><img src="images/product_7.jpg" alt=""></div>
							<div class="product_content">
								<div class="product_info d-flex flex-row align-items-start justify-content-start">
									<div>
										<div>
											<div class="product_name"><a href="product.html">Red Stripped Dress</a></div>
											<div class="product_category">In <a href="category.html">Category</a></div>
										</div>
									</div>
									<div class="ml-auto text-right">
										<div class="rating_r rating_r_4 home_item_rating"><i></i><i></i><i></i><i></i><i></i></div>
										<div class="product_price text-right">$6<span>.99</span></div>
									</div>
								</div>
								<div class="product_buttons">
									<div class="text-right d-flex flex-row align-items-start justify-content-start">
										<div class="product_button product_fav text-center d-flex flex-column align-items-center justify-content-center">
											<div class="plus"><div class="plus"><img src="images/heart_2.svg" class="svg" alt=""><div class="plus">+</div></div></div>
										</div>
										<div class="product_button product_cart text-center d-flex flex-column align-items-center justify-content-center">
											<div class="plus"><div class="plus"><img src="images/cart.svg" class="svg" alt=""><div class="plus">+</div></div></div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>

					<!-- Product -->
					<div class="col-xl-4 col-md-6 grid-item new">
						<div class="product">
							<div class="product_image"><img src="images/product_8.jpg" alt=""></div>
							<div class="product_content">
								<div class="product_info d-flex flex-row align-items-start justify-content-start">
									<div>
										<div>
											<div class="product_name"><a href="product.html">White Cotton Shirt</a></div>
											<div class="product_category">In <a href="category.html">Category</a></div>
										</div>
									</div>
									<div class="ml-auto text-right">
										<div class="rating_r rating_r_4 home_item_rating"><i></i><i></i><i></i><i></i><i></i></div>
										<div class="product_price text-right">$21<span>.99</span></div>
									</div>
								</div>
								<div class="product_buttons">
									<div class="text-right d-flex flex-row align-items-start justify-content-start">
										<div class="product_button product_fav text-center d-flex flex-column align-items-center justify-content-center">
											<div class="plus"><div class="plus"><img src="images/heart_2.svg" class="svg" alt=""><div class="plus">+</div></div></div>
										</div>
										<div class="product_button product_cart text-center d-flex flex-column align-items-center justify-content-center">
											<div class="plus"><div class="plus"><img src="images/cart.svg" class="svg" alt=""><div class="plus">+</div></div></div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>

					<!-- Product -->
					<div class="col-xl-4 col-md-6 grid-item sale">
						<div class="product">
							<div class="product_image"><img src="images/product_9.jpg" alt=""></div>
							<div class="product_content">
								<div class="product_info d-flex flex-row align-items-start justify-content-start">
									<div>
										<div>
											<div class="product_name"><a href="product.html">Black Short Sleeve Dress</a></div>
											<div class="product_category">In <a href="category.html">Category</a></div>
										</div>
									</div>
									<div class="ml-auto text-right">
										<div class="rating_r rating_r_4 home_item_rating"><i></i><i></i><i></i><i></i><i></i></div>
										<div class="product_price text-right">$7<span>.99</span></div>
									</div>
								</div>
								<div class="product_buttons">
									<div class="text-right d-flex flex-row align-items-start justify-content-start">
										<div class="product_button product_fav text-center d-flex flex-column align-items-center justify-content-center">
											<div class="plus"><div class="plus"><img src="images/heart_2.svg" class="svg" alt=""><div class="plus">+</div></div></div>
										</div>
										<div class="product_button product_cart text-center d-flex flex-column align-items-center justify-content-center">
											<div class="plus"><div class="plus"><img src="images/cart.svg" class="svg" alt=""><div class="plus">+</div></div></div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>

				</div>
				<div class="row page_nav_row">
					<div class="col">
						<div class="page_nav">
							<ul class="d-flex flex-row align-items-start justify-content-center">
								<li class="active"><a href="#">01</a></li>
								<li><a href="#">02</a></li>
								<li><a href="#">03</a></li>
								<li><a href="#">04</a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>


  <div style="overflow:auto;">
    <div >
      <a href="wizard.php?event_id=<?php echo $_GET[ 'event_id' ] ?>"><button type="button" class="nextBtn" id="nextBtn" style="color:white;width:200px;margin-right:-200px;margin-left:250px;">Previous</button></a>
      <input type="submit" value="Next" class="nextBtn" id="nextBtn" style="color:white;width:200px;margin-left:290px;cursor:pointer;">
    </div>
  </div>
  
</form>
</div>

<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
 


<script src="../js/jquery-3.2.1.min.js"></script>
<script src="../styles/bootstrap-4.1.2/popper.js"></script>
<script src="../styles/bootstrap-4.1.2/bootstrap.min.js"></script>
<script src="../plugins/greensock/TweenMax.min.js"></script>
<script src="../plugins/greensock/TimelineMax.min.js"></script>
<script src="../plugins/scrollmagic/ScrollMagic.min.js"></script>
<script src="../plugins/greensock/animation.gsap.min.js"></script>
<script src="../plugins/greensock/ScrollToPlugin.min.js"></script>
<script src="../plugins/OwlCarousel2-2.2.1/owl.carousel.js"></script>
<script src="../plugins/easing/easing.js"></script>
<script src="../plugins/progressbar/progressbar.min.js"></script>
<script src="../plugins/parallax-js-master/parallax.min.js"></script>
<script src="../plugins/Isotope/isotope.pkgd.min.js"></script>
<script src="../plugins/Isotope/fitcolumns.js"></script>
<script src="../js/category.js"></script>
        
</body>
</html>