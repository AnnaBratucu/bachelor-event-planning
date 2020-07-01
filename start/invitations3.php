
<?php

require_once "../config.php";


require '../vendor/autoload.php';
session_start();
$event_id = $_GET[ 'event_id' ];


  $name       = $_FILES['file']['name'];  
  $temp_name  = $_FILES['file']['tmp_name'];  
  if(isset($name) and !empty($name)){
      $location = 'img/';      
      if(move_uploaded_file($temp_name, $location.$name)){
          //echo 'File uploaded successfully';
      }
  } else {
      echo 'You should select a file to upload !!';
  }

  
	$sql = "SELECT * FROM events WHERE event_id = :event_id";
    
		if($stmt = $pdo->prepare($sql)){
			// Bind variables to the prepared statement as parameters
			$stmt->bindParam(":event_id", $param_id);
			
			// Set parameters
			$param_id = $event_id;
			
			// Attempt to execute the prepared statement
      $stmt->execute();
      $event = $stmt->fetch();

  }

  $sql = "SELECT * FROM users_profile WHERE user_id = :user_id AND event_id = :event_id";
    
		if($stmt = $pdo->prepare($sql)){
			// Bind variables to the prepared statement as parameters
      $stmt->bindParam(":event_id", $param_id);
      $stmt->bindParam(":user_id", $param_user);
			
			// Set parameters
      $param_id = $event_id;
      $param_user = $_SESSION[ 'id' ];
			
			// Attempt to execute the prepared statement
      $stmt->execute();
      $profile = $stmt->fetch();

  }

  $sql = "SELECT * FROM venues WHERE venue_id = :venue_id";
    
		if($stmt = $pdo->prepare($sql)){
			// Bind variables to the prepared statement as parameters
      $stmt->bindParam(":venue_id", $param_id);
			
			// Set parameters
      $param_id = $profile[ 'venue_id' ];
			
			// Attempt to execute the prepared statement
      $stmt->execute();
      $venue = $stmt->fetch();

  }

  $sql = "SELECT * FROM ceremonies WHERE ceremony_id = :ceremony_id";
    
		if($stmt = $pdo->prepare($sql)){
			// Bind variables to the prepared statement as parameters
      $stmt->bindParam(":ceremony_id", $param_id);
			
			// Set parameters
      $param_id = $profile[ 'ceremony_id' ];
			
			// Attempt to execute the prepared statement
      $stmt->execute();
      $ceremony = $stmt->fetch();

  }


  $sql1 = "SELECT * FROM venue_files WHERE venue_id = :venue_id LIMIT 1";
        
        if($stmt1 = $pdo->prepare($sql1)){
            // Bind variables to the prepared statement as parameters
            $stmt1->execute(['venue_id' => $venue[ 'venue_id' ]]); 
            $venue_file = $stmt1->fetch();
            $file_name = $venue_file["file_name"];
            
        
        }


    $sql1 = "SELECT * FROM ceremony_files WHERE ceremony_id = :ceremony_id LIMIT 1";
        
        if($stmt1 = $pdo->prepare($sql1)){
            // Bind variables to the prepared statement as parameters
            $stmt1->execute(['ceremony_id' => $ceremony[ 'ceremony_id' ]]); 
            $ceremony_file = $stmt1->fetch();
            $file_name_ceremony = $ceremony_file["file_name"];
            
        
        }
  
  $event_date = $event[ 'event_date' ];
  $day = substr( $event_date, 8, 2 );
  $m = substr( $event_date, 5, 2 );
  if( $m == '01' ){
    $month = 'January';
  } else if( $m == '02' ){
    $month = 'February';
  } else if( $m == '03' ){
    $month = 'March';
  } else if( $m == '04' ){
    $month = 'April';
  } else if( $m == '05' ){
    $month = 'May';
  } else if( $m == '06' ){
    $month = 'June';
  } else if( $m == '07' ){
    $month = 'July';
  } else if( $m == '08' ){
    $month = 'August';
  } else if( $m == '09' ){
    $month = 'September';
  } else if( $m == '10' ){
    $month = 'October';
  } else if( $m == '11' ){
    $month = 'November';
  } else if( $m == '12' ){
    $month = 'December';
  }
  $year = substr( $event_date, 0, 4 );

  $hour = substr( $event_date, 11, 5 );




  $ceremony_date = $event[ 'ceremony_date' ];
  $dayc = substr( $ceremony_date, 8, 2 );
  $mc = substr( $ceremony_date, 5, 2 );
  if( $mc == '01' ){
    $monthc = 'January';
  } else if( $mc == '02' ){
    $monthc = 'February';
  } else if( $mc == '03' ){
    $monthc = 'March';
  } else if( $mc == '04' ){
    $monthc = 'April';
  } else if( $mc == '05' ){
    $monthc = 'May';
  } else if( $mc == '06' ){
    $monthc = 'June';
  } else if( $mc == '07' ){
    $monthc = 'July';
  } else if( $mc == '08' ){
    $monthc = 'August';
  } else if( $mc == '09' ){
    $monthc = 'September';
  } else if( $mc == '10' ){
    $monthc = 'October';
  } else if( $mc == '11' ){
    $monthc = 'November';
  } else if( $mc == '12' ){
    $monthc = 'December';
  } else{
    $monthc = 'xx';
  }
  $yearc = substr( $ceremony_date, 0, 4 );

  $hourc = substr( $ceremony_date, 11, 5 );

    
    $her_name = $_POST[ 'her_name' ];
    $his_name = $_POST[ 'his_name' ];
    $story = $_POST[ 'story' ];


    $myFile = "invitations/index_" . $event_id . ".html"; // or .php  
    $fh = fopen($myFile, 'w'); // or die("error");  


    if( $_SESSION[ 'inv' ] == 'img1' ){
      $stringData = '

      <!doctype html>
<html class="no-js" lang="zxx">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Wedding Invitation</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="manifest" href="site.webmanifest">
		<link rel="shortcut icon" type="image/x-icon" href="http://localhost/git/bachelor/log/images/try.png">

		<!-- CSS here -->
            <link rel="stylesheet" href="http://localhost/git/bachelor/start/invits/assets/css/bootstrap.min.css">
            <link rel="stylesheet" href="http://localhost/git/bachelor/start/invits/assets/css/owl.carousel.min.css">
            <link rel="stylesheet" href="http://localhost/git/bachelor/start/invits/assets/css/flaticon.css">
            <link rel="stylesheet" href="http://localhost/git/bachelor/start/invits/assets/css/slicknav.css">
            <link rel="stylesheet" href="http://localhost/git/bachelor/start/invits/assets/css/animate.min.css">
            <link rel="stylesheet" href="http://localhost/git/bachelor/start/invits/assets/css/magnific-popup.css">
            <link rel="stylesheet" href="http://localhost/git/bachelor/start/invits/assets/css/fontawesome-all.min.css">
            <link rel="stylesheet" href="http://localhost/git/bachelor/start/invits/assets/css/themify-icons.css">
            <link rel="stylesheet" href="http://localhost/git/bachelor/start/invits/assets/css/slick.css">
            <link rel="stylesheet" href="http://localhost/git/bachelor/start/invits/assets/css/nice-select.css">
            <link rel="stylesheet" href="http://localhost/git/bachelor/start/invits/assets/css/style.css">
            <style>
                ::-webkit-input-placeholder { 
                    text-transform: none;
                }
                :-moz-placeholder { /* Mozilla Firefox 4 to 18 */
                    text-transform: none;
                }
                ::-moz-placeholder { /* Mozilla Firefox 19+ */
                    text-transform: none;
                }
                :-ms-input-placeholder { /* Internet Explorer 10+ */
                    text-transform: none;
                }
            </style>
   </head>

   <body>
       
    <!-- Preloader Start 
    <div id="preloader-active">
        <div class="preloader d-flex align-items-center justify-content-center">
            <div class="preloader-inner position-relative">
                <div class="preloader-circle"></div>
                <div class="preloader-img pere-text">
                    <img src="http://localhost/git/bachelor/start/invits/assets/img/logo/logo.png" alt="">
                </div>
            </div>
        </div>
    </div>
     Preloader Start -->


    <main>
        <!-- Slider Area Start-->
        <div class="slider-area ">
            <div class="slider-active">
                <div class="single-slider slider-height hero-overly d-flex align-items-center" data-background="http://localhost/git/bachelor/start/img/'. $name .'">
                    <div class="container">
                        <div class="row d-flex align-items-center">
                            <div class="col-lg-7 col-md-9 ">
                                <div class="hero__caption text-center d-flex align-items-center caption-bg">
                                   <div class="circle-caption">
                                        <span  data-animation="fadeInUp" data-delay=".3s">' . $day . 'th of ' . $month . ', ' . $year . '</span>
                                        <h1  data-animation="fadeInUp" data-delay=".5s">' . $her_name . ' & ' . $his_name . '</h1>
                                        <p  data-animation="fadeInUp" data-delay=".9s">We are getting married</p>
                                   </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Slider Area End-->
        <!-- Our Story Start -->
        <div class="Our-story-area story-padding">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="story-img mb-100">
                            
                             <!-- shape flower -->
                             <div class="shape-flower-img">
                                <img src="http://localhost/git/bachelor/start/invits/assets/img/our_story/flower_top.png" class="flower-top" alt="">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="story-caption">
                            <img src="http://localhost/git/bachelor/start/invits/assets/img/our_story/flower_right.png" alt="">
                            <h3>Our Story</h3>
                            <p class="story1">' . $story . '</p>
                            
                        </div>
                    </div>
                </div>
            </div>
            <!-- shape -->
            <div class="shape-flower d-none d-xl-block">
                <img src="http://localhost/git/bachelor/start/invits/assets/img/our_story/shape_left.png" class="flower1" alt="">
                <img src="http://localhost/git/bachelor/start/invits/assets/img/our_story/shape_right.png" class="flower2 " alt="">
            </div>
        </div>
        <!-- Our Story Ende -->
        <!-- Services Area Start-->
        <div class="service-area ">
            <div class="container">
                <div class="row">
                    <div class="col-lg-2">
                        
                    </div><div class="col-lg-4">
                        <div class="singl-services text-center mb-60">
                            <div class="top-caption">
                                <h4>The Ceremony</h4>
                                <p>' . $ceremony[ 'ceremony_name' ] . '</p>
                                <p style="margin-top:-30px;">' . $dayc . 'th of ' . $monthc . ', ' . $yearc . '</p>
                            </div>
                            <div class="services-img">
                                <img src="http://localhost/git/bachelor/start_admin/images/'.$file_name_ceremony.'" alt="" height="310" width="310">
                                <div class="back-flower">
                                    <img src="http://localhost/git/bachelor/start/invits/assets/img/service/services_flower1.png" alt="">
                                </div>
                            </div>
                            <div class="bottom-caption">
                                <span>' . $hourc . '</span>
                                <p>' . $ceremony[ 'ceremony_address' ] . '</p>
                            </div>
                        </div> 
                    </div><div class="col-lg-4">
                        <div class="singl-services text-center mb-60">
                            <div class="top-caption">
                                <h4>Afterparty</h4>
                                <p>' . $venue[ 'venue_name' ] . '</p>
                                <p style="margin-top:-30px;">' . $day . 'th of ' . $month . ', ' . $year . '</p>
                            </div>
                            <div class="services-img" style="margin-top:110px;">
                                <img src="http://localhost/git/bachelor/start_admin/images/'.$file_name.'" alt="" height="310" width="310">
                                <div class="back-flower">
                                    <img src="http://localhost/git/bachelor/start/invits/assets/img/service/services_flower1.png" alt="">
                                </div>
                            </div>
                            <div class="bottom-caption">
                                <span>' . $hour . '</span>
                                <p>' . $venue[ 'venue_address' ] . '</p>
                            </div>
                        </div> 
                    </div>
                </div>
             </div>
        </div>
        
      
        <!-- Contact form Start -->
        <div class="contact-form section-padding2 fix">
            <div class="container">
                <div class="row">
                    <div class="col-xl-6 col-lg-6 offset-lg-3 offset-xl-3">
                        <div class="form-wrapper">
                             <!-- section tittle -->
                            <div class="row ">
                                <div class="col-lg-12">
                                    <div class="section-tittle tittle-form text-center">
                                        <img src="http://localhost/git/bachelor/start/invits/assets/img/memories/section_tittle_flowre.png" alt="">
                                        <h2>Are you attending?</h2>
                                    </div>
                                </div>
                            </div>
                            <form id="contact-form" action="http://localhost/git/bachelor/start/accept.php?event_id=' . $event_id . '" method="POST">
                              <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-box mb-30">
                                        <input type="text" name="name" placeholder="Name">
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-box subject-icon mb-30">
                                        <input type="Email" name="email" placeholder="Email" style="text-transform:lowercase">
                                    </div>
                                </div>
                                <div class="col-lg-12 mb-30">
                                    <div class="select-itms">
                                        <p>Are you accepting?</p>
                                        <input type="radio" id="yes" name="accept" value="yes" style="height:13px;width:13px;">
                                        <label for="yes">Yes</label>
                                        <input type="radio" id="no" name="accept" value="no" style="height:13px;width:13px;">
                                        <label for="no">No</label>
                                    </div>
                                </div>
                                <div class="col-lg-12 mb-30">
                                    <div class="select-itms">
                                        <p>Are you bringing a plus one?</p>
                                        <input type="radio" id="yes" name="plus" value="yes" style="height:13px;width:13px;">
                                        <label for="yes">Yes</label>
                                        <input type="radio" id="no" name="plus" value="no" style="height:13px;width:13px;">
                                        <label for="no">No</label>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    
                                <div class="submit-info">
                                        <button class="btn2" type="submit">R.S.V.P</button>
                                </div>
                                </div>
                              </div>
                            </form>
                            
                            <!-- Shape inner Flower -->
                            <div class="shape-inner-flower">
                                <img src="http://localhost/git/bachelor/start/invits/assets/img/flower/form-smoll-left.png" class="top1" alt="">
                                <img src="http://localhost/git/bachelor/start/invits/assets/img/flower/form-smoll-right.png" class="top2" alt="">
                                <img src="http://localhost/git/bachelor/start/invits/assets/img/flower/form-smoll-b-left.png"class="top3"  alt="">
                                <img src="http://localhost/git/bachelor/start/invits/assets/img/flower/form-smoll-b-right.png"class="top4"  alt="">
                            </div>
                            <!-- Shape outer Flower -->
                            <div class="shape-outer-flower">
                                <img src="http://localhost/git/bachelor/start/invits/assets/img/flower/from-top.png" class="outer-top" alt="">
                                <img src="http://localhost/git/bachelor/start/invits/assets/img/flower/from-bottom.png" class="outer-bottom" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Contact form End -->

       
         
    </main>
   
   
	<!-- JS here -->
	
		<!-- All JS Custom Plugins Link Here here -->
        <script src="http://localhost/git/bachelor/start/invits/assets/js/vendor/modernizr-3.5.0.min.js"></script>
		<!-- Jquery, Popper, Bootstrap -->
		<script src="http://localhost/git/bachelor/start/invits/assets/js/vendor/jquery-1.12.4.min.js"></script>
        <script src="http://localhost/git/bachelor/start/invits/assets/js/popper.min.js"></script>
        <script src="http://localhost/git/bachelor/start/invits/assets/js/bootstrap.min.js"></script>
	    <!-- Jquery Mobile Menu -->
        <script src="http://localhost/git/bachelor/start/invits/assets/js/jquery.slicknav.min.js"></script>

		<!-- Jquery Slick , Owl-Carousel Plugins -->
        <script src="http://localhost/git/bachelor/start/invits/assets/js/owl.carousel.min.js"></script>
        <script src="http://localhost/git/bachelor/start/invits/assets/js/slick.min.js"></script>
        <!-- Date Picker -->
        <script src="http://localhost/git/bachelor/start/invits/assets/js/gijgo.min.js"></script>
		<!-- One Page, Animated-HeadLin -->
        <script src="http://localhost/git/bachelor/start/invits/assets/js/wow.min.js"></script>
		<script src="http://localhost/git/bachelor/start/invits/assets/js/animated.headline.js"></script>
        <script src="http://localhost/git/bachelor/start/invits/assets/js/jquery.magnific-popup.js"></script>

		<!-- Scrollup, nice-select, sticky -->
        <script src="http://localhost/git/bachelor/start/invits/assets/js/jquery.scrollUp.min.js"></script>
        <script src="http://localhost/git/bachelor/start/invits/assets/js/jquery.nice-select.min.js"></script>
		<script src="http://localhost/git/bachelor/start/invits/assets/js/jquery.sticky.js"></script>
        
        <!-- contact js -->
        <script src="http://localhost/git/bachelor/start/invits/assets/js/contact.js"></script>
        <script src="http://localhost/git/bachelor/start/invits/assets/js/jquery.form.js"></script>
        <script src="http://localhost/git/bachelor/start/invits/assets/js/jquery.validate.min.js"></script>
        <script src="http://localhost/git/bachelor/start/invits/assets/js/mail-script.js"></script>
        <script src="http://localhost/git/bachelor/start/invits/assets/js/jquery.ajaxchimp.min.js"></script>
        
		<!-- Jquery Plugins, main Jquery -->	
        <script src="http://localhost/git/bachelor/start/invits/assets/js/plugins.js"></script>
        <script src="http://localhost/git/bachelor/start/invits/assets/js/main.js"></script>
        
    </body>
</html>

      ';   
    } else if( $_SESSION[ 'inv' ] == 'img2' ){
        $link = "'http://localhost/git/bachelor/start/img/$name'";
        $stringData = '
        <!DOCTYPE html>
        <html lang="zxx">
        <head>
        <title>Elite Match a Matrimonial Category Bootstrap Responsive Website Template  | Home :: W3layouts</title>
        <!-- for-mobile-apps -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="keywords" content="Elite Match Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
        Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, Sony Ericsson, Motorola web design" />
        <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
                function hideURLbar(){ window.scrollTo(0,1); } </script>
        <!-- //for-mobile-apps -->
        <link href="http://localhost/git/bachelor/start/web1/css/bootstrap.css" rel="stylesheet" type="text/css" media="all" /><!-- Bootstrap -->
        <link href="http://localhost/git/bachelor/start/web1/css/font-awesome.css" rel="stylesheet"> <!-- Font awesome -->
        <link href="http://localhost/git/bachelor/start/web1/css/owl.carousel.css" rel="stylesheet"><!-- Clients -->
        <link href="http://localhost/git/bachelor/start/web1/css/popuo-box.css" rel="stylesheet" type="text/css" media="all" /><!-- Pop-up -->
        <link href="http://localhost/git/bachelor/start/web1/css/lsb.css" rel="stylesheet" type="text/css"><!-- gallery -->
        <link href="http://localhost/git/bachelor/start/web1/css/style.css" rel="stylesheet" type="text/css" media="all" />
        <!--fonts-->
        <link href="//fonts.googleapis.com/css?family=Raleway:400,500,600,700,800,900" rel="stylesheet">
        <link href="//fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">
        <link href="//fonts.googleapis.com/css?family=Dancing+Script:400,700" rel="stylesheet">
        <!--//fonts-->
        
        </head>
        <body>
        <!--banner start here-->
        <div class="banner-w3ls" id="home" style="background-image:url('. $link .');">
            <div class="container">
                    <!-- banner-slider -->
                    <div class="w3l_banner_info" >
                        <div class="slider">
                            <div class="callbacks_container">
                                        <ul class="rslides" id="slider3">
                                            
                                            <li>
                                                <div class="w3ls-info">
                                                    <h4>' . $his_name . ' and ' . $her_name . '</h4>
                                                    <p>' . $story . '</p>
                                                </div>
        
                                            </li>
        
                                        </ul>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                <!-- //banner-slider -->
                        
                    
                </div>
        </div>
        <!--//home-->
        <!--banner end here-->
        <!-- services -->
            <div class="services" id="services">
                <div class="container">
                <div class="tittle-agileinfo">
                        <h3>RSVP</h3>
                    </div>
                    <div class="col-md-6 w3_agileits_services_grids">
                        
                        <div class="w3_agileits_services_grid">
                            <div class="w3_agileits_services_grid_agile">
                                
                                <img src="http://localhost/git/bachelor/start_admin/images/'.$file_name_ceremony.'" alt="" height="110" width="110">
                                
                                <h3>' . $ceremony[ 'ceremony_name' ] . '</h3>
                                <p>' . $dayc . 'th of ' . $monthc . ', ' . $yearc . ' at ' . $hourc . '</p>
                                <p>' . $ceremony[ 'ceremony_address' ] . '</p>
                            </div>
                        </div>
                        <div class="w3_agileits_services_grid">
                            <div class="w3_agileits_services_grid_agile">
                                
                                <img src="http://localhost/git/bachelor/start_admin/images/'.$file_name.'" alt="" height="110" width="110">
                                
                                <h3>' . $venue[ 'venue_name' ] . '</h3>
                                <p>' . $day . 'th of ' . $month . ', ' . $year . ' at ' . $hour . '</p>
                                <p>' . $venue[ 'venue_address' ] . '</p>
                            </div>
                        </div>
                        
                        <div class="clearfix"> </div>
                    </div>
                    <div class="col-md-6 regstr-r-w3-agileits">
                    <div class="form-bg-w3ls">
                        <h3 class="subhead-agileits white-w3ls">Will you be joining us?</h3>
                        
                        <form action="http://localhost/git/bachelor/start/accept.php?event_id=' . $event_id . '" method="post" >
                                        <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-box mb-30">
                                            <input type="text" name="name" placeholder="Name">
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-box subject-icon mb-30">
                                            <input type="Email" name="email" placeholder="Email">
                                        </div>
                                    </div>
                                    <div class="col-lg-12 mb-30">
                                        <div class="select-itms">
                                            <p>Are you accepting?</p>
                                            <input type="radio" id="yes" name="accept" value="yes" style="height:13px;width:13px;">
                                            <label for="yes">Yes</label>
                                            <input type="radio" id="no" name="accept" value="no" style="height:13px;width:13px;">
                                            <label for="no">No</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 mb-30">
                                        <div class="select-itms">
                                            <p>Are you bringing a plus one?</p>
                                            <input type="radio" id="yes" name="plus" value="yes" style="height:13px;width:13px;">
                                            <label for="yes">Yes</label>
                                            <input type="radio" id="no" name="plus" value="no" style="height:13px;width:13px;">
                                            <label for="no">No</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        
                                    <div class="submit-info">
                                    <input type="submit" value="R.S.V.P." >
                                    </div>
                                    </div>
                                  </div>
                                    </form>
                        
                        
                        
                        
                    </div>
                    </div>
                </div>
            </div>
        <!-- //services -->
        
        <!-- js -->
        <script type="text/javascript" src="http://localhost/git/bachelor/start/web1/js/jquery-2.2.3.min.js"></script>
        <!-- flexisel -->
                <script type="text/javascript">
                $(window).load(function() {
                    $("#flexiselDemo1").flexisel({
                        visibleItems: 4,
                        animationSpeed: 1000,
                        autoPlay: true,
                        autoPlaySpeed: 3000,    		
                        pauseOnHover: true,
                        enableResponsiveBreakpoints: true,
                        responsiveBreakpoints: { 
                            portrait: { 
                                changePoint:480,
                                visibleItems: 1
                            }, 
                            landscape: { 
                                changePoint:640,
                                visibleItems:2
                            },
                            tablet: { 
                                changePoint:768,
                                visibleItems: 2
                            }
                        }
                    });
                    
                });
            </script>
            <script type="text/javascript" src="http://localhost/git/bachelor/start/web1/js/jquery.flexisel.js"></script>
        <!-- //flexisel -->
        <!-- gallery-pop-up -->
            <script src="http://localhost/git/bachelor/start/web1/js/lsb.min.js"></script>
            <script>
            $(window).load(function() {
                  $.fn.lightspeedBox();
                });
            </script>
        <!-- //gallery-pop-up -->
        <script src="http://localhost/git/bachelor/start/web1/js/SmoothScroll.min.js"></script>
        <!--responsive slider -->
        <script src="http://localhost/git/bachelor/start/web1/js/responsiveslides.min.js"></script>
                                    <script>
                                        // You can also use "$(window).load(function() {"
                                        $(function () {
                                          // Slideshow 3
                                          $("#slider3").responsiveSlides({
                                            auto: true,
                                            pager:true,
                                            nav:true,
                                            speed: 500,
                                            namespace: "callbacks",
                                            before: function () {
                                              $(".events").append("<li>before event fired.</li>");
                                            },
                                            after: function () {
                                              $(".events").append("<li>after event fired.</li>");
                                            }
                                          });
                                    
                                        });
                                     </script>
        <!--//responsive slider -->
        <!--pop-up-box -->
                            <script src="http://localhost/git/bachelor/start/web1/js/jquery.magnific-popup.js" type="text/javascript"></script>
                            <script>
                            $(document).ready(function() {
                            $(".popup-with-zoom-anim").magnificPopup({
                            type: "inline",
                            fixedContentPos: false,
                            fixedBgPos: true,
                            overflowY: "auto",
                            closeBtnInside: true,
                            preloader: false,
                            midClick: true,
                            removalDelay: 300,
                            mainClass: "my-mfp-zoom-in"
                            });
        
                            });
                            </script>
        <!-- //pop-up-box -->
        
        <!-- smooth scrolling -->
            <script type="text/javascript">
                $(document).ready(function() {
                /*
                    var defaults = {
                    containerID: "toTop", // fading element id
                    containerHoverID: "toTopHover", // fading element hover id
                    scrollSpeed: 1200,
                    easingType: "linear" 
                    };
                */								
                $().UItoTop({ easingType: "easeOutQuart" });
                });
            </script>
            
            
            <a href="#home" class="scroll" id="toTop" style="display: block;"> <span id="toTopHover" style="opacity: 1;"> </span></a>
        <!-- //smooth scrolling -->
            <!-- for-Clients -->
                <script src="http://localhost/git/bachelor/start/web1/js/owl.carousel.js"></script>
                    <!-- requried-jsfiles-for owl -->
                                            <script>
                                                $(document).ready(function() {
                                                  $("#owl-demo2").owlCarousel({
                                                    items : 1,
                                                    lazyLoad : false,
                                                    autoPlay : true,
                                                    navigation : false,
                                                    navigationText :  false,
                                                    pagination : true,
                                                  });
                                                });
                                              </script>
                    <!-- //requried-jsfiles-for owl -->
            <!-- //for-Clients -->
            <!-- start-smoth-scrolling -->
        <script type="text/javascript" src="http://localhost/git/bachelor/start/web1/js/move-top.js"></script>
        <script type="text/javascript" src="http://localhost/git/bachelor/start/web1/js/easing.js"></script>
        <script type="text/javascript">
            jQuery(document).ready(function($) {
                $(".scroll").click(function(event){		
                    event.preventDefault();
                    $("html,body").animate({scrollTop:$(this.hash).offset().top},1000);
                });
            });
        </script>
        <!-- start-smoth-scrolling -->
        <script type="text/javascript" src="http://localhost/git/bachelor/start/web1/js/bootstrap-3.1.1.min.js"></script>
            
        
        </body>
        </html>
        '; 
    } else if( $_SESSION[ 'inv' ] == 'img3' ){
        $link = "'http://localhost/git/bachelor/start/img/$name'";
        $stringData = '
        <!DOCTYPE html>
        <html>
        <head>
        <title>Invitation</title>
        <!-- for-mobile-apps -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
                function hideURLbar(){ window.scrollTo(0,1); } </script>
        <!-- //for-mobile-apps -->
        <link href="http://localhost/git/bachelor/start/web/css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
        <link href="http://localhost/git/bachelor/start/web/css/style.css" rel="stylesheet" type="text/css" media="all" />
        <link rel="stylesheet" href="http://localhost/git/bachelor/start/web/css/chocolat.css" type="text/css" media="screen" charset="utf-8">
        <!-- js -->
        <script type="text/javascript" src="http://localhost/git/bachelor/start/web/js/jquery-2.1.4.min.js"></script>
        <!-- //js -->
        <!-- script -->
            <script src="http://localhost/git/bachelor/start/web/js/jquery.chocolat.js"></script>
                <!--light-box-files-->
            <script type="text/javascript" charset="utf-8">
                $(function() {
                    $(".portfolio-grids a").Chocolat();
                });
            </script>
        <!-- script -->
        <!-- animation-effect -->
        <link href="http://localhost/git/bachelor/start/web/css/animate.min.css" rel="stylesheet"> 
        <script src="http://localhost/git/bachelor/start/web/js/wow.min.js"></script>
        <script>
         new WOW().init();
        </script>
        <!-- //animation-effect -->
        <!-- timer -->
        <link rel="stylesheet" href="http://localhost/git/bachelor/start/web/css/jquery.countdown.css" />
        <!-- //timer -->
        <link href="//fonts.googleapis.com/css?family=Poiret+One" rel="stylesheet" type="text/css">
        <link href="//fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic" rel="stylesheet" type="text/css">
        <!-- start-smoth-scrolling -->
        <script type="text/javascript">
            jQuery(document).ready(function($) {
                $(".scroll").click(function(event){		
                    event.preventDefault();
                    $("html,body").animate({scrollTop:$(this.hash).offset().top},1000);
                });
            });
        </script>
        <!-- start-smoth-scrolling -->
        </head>
            
        <body>
        <!-- banner -->
            <div class="banner" id="home1" style="background-image:url('. $link .');">
                <div class="container">
                    
                    
                    
                    <div class="clearfix"> </div>
                    <div class="banner-info animated wow zoomIn" data-wow-delay=".5s">
                        <p>wedding invitation</p>
                    </div>
                    
                    </div>
                </div>
            </div>
        <!-- //banner -->
        
        
        <!-- services -->
            <div class="services" id="services">
                <div class="container">
                    <h3 class="animated wow zoomIn" data-wow-delay=".5s"><span>Ceremony and Afterparty</span></h3>
                    <div class="services-grids">
                        
                        
                        <div class="col-md-6 services-grid">
                            
                            <img src="http://localhost/git/bachelor/start_admin/images/'.$file_name_ceremony.'" alt="" height="210" width="210">
                            
                            <div class="bootstrap-pop-up">
                                <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
                                    ' . $ceremony[ 'ceremony_name' ] . '
                                </button>
                            </div>
                            <p>' . $dayc . 'th of ' . $monthc . ', ' . $yearc . ' at ' . $hourc . '</p>
                            <p>' . $ceremony[ 'ceremony_address' ] . '</p>
                        </div>

                        <div class="col-md-6 services-grid">
                            
                            <img src="http://localhost/git/bachelor/start_admin/images/'.$file_name.'" alt="" height="210" width="210">
                    
                            <div class="bootstrap-pop-up">
                                <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
                                    ' . $venue[ 'venue_name' ] . '
                                </button>
                            </div>
                            <p>' . $day . 'th of ' . $month . ', ' . $year . ' at ' . $hour . '</p>
                            <p>' . $venue[ 'venue_address' ] . '</p>
                        </div>

                        <div class="clearfix"> </div>
                    </div>
                    <div class="services-grids-wedding">
                        <div class="services-grids-wedding1">
                            <div class="services-grids-wedding-left animated wow slideInLeft" data-wow-delay=".5s">
                                <h4>' . $his_name . '</h4>
                            </div>
                            <div class="services-grids-wedding-right animated wow slideInRight" data-wow-delay=".5s">
                                
                                <h4>' . $her_name . '</h4>
                            </div>
                            <div class="clearfix"> </div>
                        </div>
                        <h5 class="animated wow slideInUp" data-wow-delay=".5s">We are getting married!</h5>
                        <p class="animated wow slideInUp" data-wow-delay=".5s">Please join us on our big day!</p>
                        
                    </div>
                </div>
            </div>
        <!-- //services -->
        <!-- services-bottom -->
            <div class="services-bottom">
                <div class="container">
                    <h2 class="animated wow slideInLeft" data-wow-delay=".5s">' . $story . '</h2>
                </div>
            </div>
        <!-- //services-bottom -->
        
        
        <!-- contact -->
            <div class="contact" id="mail">
                <div class="container">
                    <h3 class="animated wow zoomIn" data-wow-delay=".5s"><span>Will you be attending?</span></h3>
                    <div class="mail-grids">
                        <div class="col-md-6 mail-grid-left animated wow " data-wow-delay=".5s">
                            <form action="http://localhost/git/bachelor/start/accept.php?event_id=' . $event_id . '" method="post" >
                                <div class="row">
                            <div class="col-lg-12">
                                <div class="form-box mb-30">
                                    <input type="text" name="name" placeholder="Name">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-box subject-icon mb-30">
                                    <input type="Email" name="email" placeholder="Email">
                                </div>
                            </div>
                            <div class="col-lg-12 mb-30">
                                <div class="select-itms">
                                    <p>Are you accepting?</p>
                                    <input type="radio" id="yes" name="accept" value="yes" style="height:13px;width:13px;">
                                    <label for="yes">Yes</label>
                                    <input type="radio" id="no" name="accept" value="no" style="height:13px;width:13px;">
                                    <label for="no">No</label>
                                </div>
                            </div>
                            <div class="col-lg-12 mb-30">
                                <div class="select-itms">
                                    <p>Are you bringing a plus one?</p>
                                    <input type="radio" id="yes" name="plus" value="yes" style="height:13px;width:13px;">
                                    <label for="yes">Yes</label>
                                    <input type="radio" id="no" name="plus" value="no" style="height:13px;width:13px;">
                                    <label for="no">No</label>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                
                            <div class="submit-info">
                            <input type="submit" value="R.S.V.P." >
                            </div>
                            </div>
                          </div>
                            </form>



                            








                        </div>
                    
                    </div>
                </div>
            </div>
        <!-- //contact -->
        
        <!-- for bootstrap working -->
            <script src="http://localhost/git/bachelor/start/web/js/bootstrap.js"></script>
        <!-- //for bootstrap working -->
        </body>
        </html>
        '; 
    } 

    fwrite($fh, $stringData);
    fclose($fh);


     
    $sql = "SELECT * FROM events WHERE event_id = :event_id";
    
if($stmt = $pdo->prepare($sql)){
    // Bind variables to the prepared statement as parameters
    $stmt->bindParam(":event_id", $param_id);
    
    // Set parameters
    $param_id = $_GET[ 'event_id' ];
    
    // Attempt to execute the prepared statement
      $stmt->execute();
      $eventt = $stmt->fetch();
      $stage = $eventt[ 'event_stage' ];

}

        if( $stage == 'invitation' ){
            $sql1 = "UPDATE events SET event_stage = :event_stage WHERE event_id = :event_id";
            if( $stmt1 = $pdo->prepare($sql1)  ){
                // Bind variables to the prepared statement as parameters
                $stmt1->bindParam(":event_stage", $param_event_stage);
                $stmt1->bindParam(":event_id", $param_event_id);
                $event_id = $_GET[ 'event_id' ];
                // Set parameters
                $param_event_id = $event_id;
                $param_event_stage = 'send';
                
                // Attempt to execute the prepared statement
                if(!$stmt1->execute()){
                    echo "Something went wrong. Please try again later.";
                }
            }
          }

          $sql = "INSERT INTO notifications (event_id, notification_name, notification_message, notification_status) VALUES (:event_id, :notification_name, :notification_message, :notification_status)";
          if( $stmt = $pdo->prepare($sql)  ){
              // Bind variables to the prepared statement as parameters
              $stmt->bindParam(":event_id", $param_event);
              $stmt->bindParam(":notification_name", $param_name);
              $stmt->bindParam(":notification_message", $param_mess);
              $stmt->bindParam(":notification_status", $param_stat);
              
              // Set parameters
              $param_event = $event_id;
              $param_name = 'Send invitation';
              $param_mess = 'You now can send invitations to your guests.';
              $param_stat = 'not_seen';
              
              // Attempt to execute the prepared statement
              $stmt->execute();
          }

    header("location: pages.php?event_id=" . $event_id);


?>

