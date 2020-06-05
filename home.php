<?php
if(empty($_SESSION)) // if the session not yet started
session_start();
?>

<!DOCTYPE html>
<html>
<style>
h2{
  text-align:center;
  padding: 20px;
}
/* Slider */

.slick-slide {
    margin: 0px 20px;
}

.slick-slide img {
    width: 100%;
}

.slick-slider
{
    position: relative;
    display: block;
    box-sizing: border-box;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
            user-select: none;
    -webkit-touch-callout: none;
    -khtml-user-select: none;
    -ms-touch-action: pan-y;
        touch-action: pan-y;
    -webkit-tap-highlight-color: transparent;
}

.slick-list
{
    position: relative;
    display: block;
    overflow: hidden;
    margin: 0;
    padding: 0;
}
.slick-list:focus
{
    outline: none;
}
.slick-list.dragging
{
    cursor: pointer;
    cursor: hand;
}

.slick-slider .slick-track,
.slick-slider .slick-list
{
    -webkit-transform: translate3d(0, 0, 0);
       -moz-transform: translate3d(0, 0, 0);
        -ms-transform: translate3d(0, 0, 0);
         -o-transform: translate3d(0, 0, 0);
            transform: translate3d(0, 0, 0);
}

.slick-track
{
    position: relative;
    top: 0;
    left: 0;
    display: block;
}
.slick-track:before,
.slick-track:after
{
    display: table;
    content: '';
}
.slick-track:after
{
    clear: both;
}
.slick-loading .slick-track
{
    visibility: hidden;
}

.slick-slide
{
    display: none;
    float: left;
    height: 100%;
    min-height: 1px;
}
[dir='rtl'] .slick-slide
{
    float: right;
}
.slick-slide img
{
    display: block;
}
.slick-slide.slick-loading img
{
    display: none;
}
.slick-slide.dragging img
{
    pointer-events: none;
}
.slick-initialized .slick-slide
{
    display: block;
}
.slick-loading .slick-slide
{
    visibility: hidden;
}
.slick-vertical .slick-slide
{
    display: block;
    height: auto;
    border: 1px solid transparent;
}
.slick-arrow.slick-hidden {
    display: none;
}










.holderCircle { width: 500px; height: 500px; border-radius: 100%; margin: 60px auto; position: relative; }


.dotCircle { width: 100%; height: 100%; position: absolute; margin: auto; top: 0; left: 0; right: 0; bottom: 0; border-radius: 100%; z-index: 20; }
.dotCircle  .itemDot { display: block; width: 80px; height: 80px; position: absolute; background: #ffffff; color: #7d4ac7; border-radius: 20px; text-align: center; line-height: 80px; font-size: 30px; z-index: 3; cursor: pointer; border: 2px solid #e6e6e6; }
.dotCircle  .itemDot .forActive { width: 56px; height: 56px; position: absolute; top: 0; left: 0; right: 0; bottom: 0; display: none; }
.dotCircle  .itemDot .forActive::after { content: ''; width: 5px; height: 5px; border: 3px solid #7d4ac7; bottom: -31px; left: -14px; filter: blur(1px); position: absolute; border-radius: 100%; }
.dotCircle  .itemDot .forActive::before { content: ''; width: 6px; height: 6px; filter: blur(5px); top: -15px; position: absolute; transform: rotate(-45deg); border: 6px solid #a733bb; right: -39px; }
.dotCircle  .itemDot.active .forActive { display: block; }
.round { position: absolute; left: 40px; top: 45px; width: 410px; height: 410px; border: 2px dotted #a733bb; border-radius: 100%; -webkit-animation: rotation 100s infinite linear; }
.dotCircle .itemDot:hover, .dotCircle .itemDot.active { color: #ffffff; transition: 0.5s;   /* Permalink - use to edit and share this gradient: http://colorzilla.com/gradient-editor/#7d4ac7+0,a733bb+100 */ background: #7d4ac7; /* Old browsers */ background: -moz-linear-gradient(left, #7d4ac7 0%, #a733bb 100%); /* FF3.6-15 */ background: -webkit-linear-gradient(left, #7d4ac7 0%, #a733bb 100%); /* Chrome10-25,Safari5.1-6 */ background: linear-gradient(to right, #7d4ac7 0%, #a733bb 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */ filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#7d4ac7', endColorstr='#a733bb', GradientType=1); /* IE6-9 */ border: 2px solid #ffffff; -webkit-box-shadow: 0 30px 30px 0 rgba(0, 0, 0, .13); -moz-box-shadow: 0 30px 30px 0 rgba(0, 0, 0, .13); box-shadow: 0 30px 30px 0 rgba(0, 0, 0, .13); }
.dotCircle .itemDot { font-size: 40px; }
.contentCircle { width: 250px; border-radius: 100%; color: #222222; position: relative; top: 150px; left: 50%; transform: translate(-50%, -50%); }
.contentCircle .CirItem { border-radius: 100%; color: #222222; position: absolute; text-align: center; bottom: 0; left: 0; opacity: 0; transform: scale(0); transition: 0.5s; font-size: 15px; width: 100%; height: 100%; top: 0; right: 0; margin: auto; line-height: 250px; }
.CirItem.active { z-index: 1; opacity: 1; transform: scale(1); transition: 0.5s; }
.contentCircle .CirItem i { font-size: 180px; position: absolute; top: 0; left: 50%; margin-left: -90px; color: #000000; opacity: 0.1; }
@media only screen and (min-width:300px) and (max-width:599px) {
	.holderCircle {/* width: 300px; height: 300px;*/ margin: 110px auto; }
	.holderCircle::after { width: 100%; height: 100%; }
	.dotCircle { width: 100%; height: 100%; top: 0; right: 0; bottom: 0; left: 0; margin: auto; }
}
@media only screen and (min-width:600px) and (max-width:767px) { }
@media only screen and (min-width:768px) and (max-width:991px) { }
@media only screen and (min-width:992px) and (max-width:1199px) { }
@media only screen and (min-width:1200px) and (max-width:1499px) { }
  .title-box .title { font-weight: 600; letter-spacing: 2px; position: relative; z-index: -1; }
        .title-box span { text-shadow: 0 10px 10px rgba(0, 0, 0, .15); font-weight: 800; color: #640178; }
		.title-box p {font-size: 17px; line-height: 2em; }
		





.aa{
	background-color: #ffb800;
    background-size: cover;
    background-image: url('../log/images/pattern.svg'),linear-gradient(45deg, #ffb800 0%, #e6a600 100%);
    color: #fff;
}
</style>

<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>


<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>



	<?php 
		include 'head.php'; 
		
	?>

	
	<body>
		<div class="header">
			<?php include 'header.php'; ?>
		
			<div class="header_side">
				<h1>Be a guest at your own event.</h1>
				<div class="space1"></div>
				<p>Some events you attend,</p>
				<p>Some you keep.</p>
				<div class="space"></div>
				
				<a href="log/register.php" class="start"><span>Sign Up Now!</span></a>
				
			</div>

		</div>

		


		<div style="height:30px;"></div>





		
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">  
<section class="iq-features">
            <div class="container">
			<h2>Our  Services</h2>
               <div class="row align-items-center">
                  <div class="col-lg-3 col-md-12"></div>
                  <div class="col-lg-6 col-md-12">
                     <div class="holderCircle">
                        <div class="round"></div>
                        <div class="dotCircle">
                           <span class="itemDot active itemDot1" data-tab="1">
                           <i class="fa fa-money"></i>
                           <span class="forActive"></span>
                           </span>
                           <span class="itemDot itemDot2" data-tab="2">
                           <i class="fa fa-newspaper-o"></i>
                           <span class="forActive"></span>
                           </span>
                           <span class="itemDot itemDot3" data-tab="3">
                           <i class="fas fa-user-tie"></i>
                           <span class="forActive"></span>
                           </span>
                           <span class="itemDot itemDot4" data-tab="4">
                           <i class="fas fa-hotel"></i>
                           <span class="forActive"></span>
                           </span>
                           <span class="itemDot itemDot5" data-tab="5">
                           <i class="fa fa-object-ungroup"></i>
                           <span class="forActive"></span>
                           </span>
                           <span class="itemDot itemDot6" data-tab="6">
                           <i class="fas fa-music"></i>
                           <span class="forActive"></span>
                           </span>
                        </div>
                        <div class="contentCircle">
                           <div class="CirItem title-box active CirItem1">
                              <h2 class="title"><span>Budget</span></h2>
                              <p>Establish your budget and we make sure you stick by it with every purchase you make.</p>
                              <i class="fa fa-money"></i>
                           </div>
                           <div class="CirItem title-box CirItem2">
                              <h2 class="title"><span>Invitations </span></h2>
                              <p>Select from our invitation templates, customize it with your own data and pictures and send it to your guests.</p>
                              <i class="fa fa-newspaper-o"></i>
                           </div>
                           <div class="CirItem title-box CirItem3">
                              <h2 class="title"><span>Guests</span></h2>
                              <p>Complete your list of guests easy and fast and use it to manage every aspect of planning your event.</p>
                              <i class="fas fa-user-tie"></i>
                           </div>
                           <div class="CirItem title-box CirItem4">
                              <h2 class="title"><span>Venues</span></h2>
                              <p>When it comes to vendors, our app offers a various selection to choose from due to the big list of partners.</p>
                              <i class="fas fa-hotel"></i>
                           </div>
                           <div class="CirItem title-box CirItem5">
                              <h2 class="title"><span>Arrangements</span></h2>
                              <p>Design the floor of your venue as you like and place your all your guests at tables with just a few clicks.</p>
                              <i class="fa fa-object-ungroup"></i>
                           </div>
                           <div class="CirItem title-box CirItem6">
                              <h2 class="title"><span>Music</span></h2>
                              <p>Create your own playlist of songs and don't worry about dancing to bad music again.</p>
                              <i class="fas fa-music"></i>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-lg-3 col-md-12"></div>
               </div>
            </div>
        </section>





<div class="aa" style="height:400px;">
<br><br>
	<h2>There's a world of possibilities out there</h2><br>
	<h2>And you might just meet them on our app.</h2>
	<p style="text-align:center;color:white;font-size:16px;">Try it now!</p>
</div>


<div style="height:30px;"></div>


		<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick.js"></script>

<div class="container">
  <h2>Our  Partners/ Our Clients</h2>
   <section class="customer-logos slider">
      <div class="slide"><img src="https://www.designevo.com/images/home/2-5-0/company-logo.png"></div>
      <div class="slide"><img src="https://upload.wikimedia.org/wikipedia/ro/thumb/5/51/Logo_Universitatea_Politehnica_din_Bucure%C8%99ti.svg/768px-Logo_Universitatea_Politehnica_din_Bucure%C8%99ti.svg.png"></div>
      <div class="slide"><img src="https://seeklogo.com/images/U/UPB-logo-33388F1CF7-seeklogo.com.gif"></div>
      <div class="slide"><img src="https://scontent.fotp3-1.fna.fbcdn.net/v/t1.0-9/12994306_511294935722794_8185831813709411586_n.jpg?_nc_cat=107&_nc_sid=09cbfe&_nc_ohc=mNKU6-8rql8AX9J9GLZ&_nc_ht=scontent.fotp3-1.fna&oh=bc421a83c7bf0e9f6589e0fceae15580&oe=5EFEE578"></div>
      <div class="slide"><img src="https://lh3.googleusercontent.com/WETi4kiHx6KfyGBDsZ1-jgPdAATt8n6Fq4tK05TOBe_z6NxsoWjrGkDyy8PIW29pvJw"></div>
      <div class="slide"><img src="https://upload.wikimedia.org/wikipedia/en/thumb/8/86/Network_10_logo_2018.svg/1200px-Network_10_logo_2018.svg.png"></div>
      <div class="slide"><img src="https://vignette.wikia.nocookie.net/logopedia/images/5/54/Channel_10_logo-0.jpg/revision/latest?cb=20160122174039"></div>
      <div class="slide"><img src="https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcRQUpbZx4JLRYpkJRPavi3wY6xczE3SYz8YbhHV-eewGZ8-oq-u&usqp=CAU"></div>
      <div class="slide"><img src="https://www.ventrix.com.br/wp/wp-content/uploads/2015/11/windows-10-logo.png"></div>
   </section>
   
   <div style="height:100px;"></div>
</div>
<script>

    $('.customer-logos').slick({
        slidesToShow: 6,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 1500,
        arrows: false,
        dots: false,
        pauseOnHover: false,
        responsive: [{
            breakpoint: 768,
            settings: {
                slidesToShow: 4
            }
        }, {
            breakpoint: 520,
            settings: {
                slidesToShow: 3
            }
        }]
    });









	let i=2;

	
	$(document).ready(function(){
		var radius = 200;
		var fields = $('.itemDot');
		var container = $('.dotCircle');
		var width = container.width();
 radius = width/2.5;
 
		 var height = container.height();
		var angle = 0, step = (2*Math.PI) / fields.length;
		fields.each(function() {
			var x = Math.round(width/2 + radius * Math.cos(angle) - $(this).width()/2);
			var y = Math.round(height/2 + radius * Math.sin(angle) - $(this).height()/2);
			if(window.console) {
				console.log($(this).text(), x, y);
			}
			
			$(this).css({
				left: x + 'px',
				top: y + 'px'
			});
			angle += step;
		});
		
		
		$('.itemDot').click(function(){
			
			var dataTab= $(this).data("tab");
			$('.itemDot').removeClass('active');
			$(this).addClass('active');
			$('.CirItem').removeClass('active');
			$( '.CirItem'+ dataTab).addClass('active');
			i=dataTab;
			
			$('.dotCircle').css({
				"transform":"rotate("+(360-(i-1)*36)+"deg)",
				"transition":"2s"
			});
			$('.itemDot').css({
				"transform":"rotate("+((i-1)*36)+"deg)",
				"transition":"1s"
			});
			
			
		});
		
		setInterval(function(){
			var dataTab= $('.itemDot.active').data("tab");
			if(dataTab>6||i>6){
			dataTab=1;
			i=1;
			}
			$('.itemDot').removeClass('active');
			$('[data-tab="'+i+'"]').addClass('active');
			$('.CirItem').removeClass('active');
			$( '.CirItem'+i).addClass('active');
			i++;
			
			
			$('.dotCircle').css({
				"transform":"rotate("+(360-(i-2)*36)+"deg)",
				"transition":"2s"
			});
			$('.itemDot').css({
				"transform":"rotate("+((i-2)*36)+"deg)",
				"transition":"1s"
			});
			
			}, 5000);
		
	});



</script>



		<?php include 'footer.php';  ?>
	</body>
	
</html> 


