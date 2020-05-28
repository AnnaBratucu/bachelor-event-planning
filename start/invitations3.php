
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
        <title>Wedding HTML-5 Template </title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="manifest" href="site.webmanifest">
		<link rel="shortcut icon" type="image/x-icon" href="http://localhost/git/bachelor/start/invits/assets/img/favicon.ico">

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
                                <p>July 20, 2020</p>
                            </div>
                            <div class="services-img">
                                <img src="http://localhost/git/bachelor/start/invits/assets/img/service/service2.png" alt="">
                                <div class="back-flower">
                                    <img src="http://localhost/git/bachelor/start/invits/assets/img/service/services_flower1.png" alt="">
                                </div>
                            </div>
                            <div class="bottom-caption">
                                <span>12:00PM-2:00PM</span>
                                <p>The Sierra Resort 14<br> Pacific Grove Monterey, CA</p>
                            </div>
                        </div> 
                    </div><div class="col-lg-4">
                        <div class="singl-services text-center mb-60">
                            <div class="top-caption">
                                <h4>Afterparty</h4>
                                <p>' . $venue[ 'venue_name' ] . '</p>
                            </div>
                            <div class="services-img">
                                <img src="http://localhost/git/bachelor/start/invits/assets/img/service/service3.png" alt="">
                                <div class="back-flower">
                                    <img src="http://localhost/git/bachelor/start/invits/assets/img/service/services_flower1.png" alt="">
                                </div>
                            </div>
                            <div class="bottom-caption">
                                <span>12:00PM-2:00PM</span>
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
                                        <input type="Email" name="subject" placeholder="Email">
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
        $stringData = "

        <html>
        <head>
        <title>hi</title>
        </head>
        <body>
        <h1>test</h1>
        <p>hope</p>
        </body>
        <html>

        "; 
    } else if( $_SESSION[ 'inv' ] == 'img3' ){
        $stringData = "

        <html>
        <head>
        <title>hi</title>
        </head>
        <body>
        <h1>test</h1>
        <p>hope</p>
        </body>
        <html>

        "; 
    } 

    fwrite($fh, $stringData);
    fclose($fh);


     


    header("location: guests.php?event_id=" . $event_id);


?>

