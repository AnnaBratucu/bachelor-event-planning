<!DOCTYPE html>
<!--<html class="menu">-->
<html>
<style type="text/css">
body::before {
  /* content: "";
  display: block; */
  /* position: absolute; */
  /* z-index: -1; */
  width: 100%;
  
   top: 0;
  left: 0; 
  background: white;
  /* background: rgba(93,84,240,0.5);
  background: -webkit-linear-gradient(left, rgba(0,168,255,0.5), rgba(185,0,255,0.5));
  background: -o-linear-gradient(left, rgba(0,168,255,0.5), rgba(185,0,255,0.5));
  background: -moz-linear-gradient(left, rgba(0,168,255,0.5), rgba(185,0,255,0.5));
  background: linear-gradient(left, rgba(0,168,255,0.5), rgba(185,0,255,0.5));  */
  pointer-events: none;
}

.wiz{
  margin-top:-1000px;
}

.wiz{
	margin-top:-200px;
	position: relative;
	background: white;
}

.products{
	background: white;
	
}
.container{
	background: white;
	
}

#regForm{
	margin-top:0;
}
.div {
  position: relative; 
  padding-top: 10px;  
}
.inputText {
  font-size: 14px;
  width: 200px;
  height: 25px;
}
.floating-label {
  position: absolute;
  pointer-events: none;
  left: 15px;
  top: 18px;
  transition: 0.2s ease all;
}
input:focus ~ .floating-label,
input:not(:focus):valid ~ .floating-label {
  top: -18px;
}
.input:focus ~ .floating-label,
.input:not(:focus):valid ~ .floating-label {
  top: -20px;
}
input[type=text] {
	color:black;
}
input[type=number] {
	color:black;
}

/* upload */
#upload {
    opacity: 0;
}

#upload-label {
    position: absolute;
    top: 50%;
    left: 1rem;
    transform: translateY(-50%);
}

.image-area {
    border: 2px dashed rgba(255, 255, 255, 0.7);
    padding: 1rem;
    position: relative;
}

.image-area::before {
    content: 'Uploaded image result';
    color: #fff;
    font-weight: bold;
    text-transform: uppercase;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    font-size: 0.8rem;
    z-index: 1;
}

.image-area img {
    z-index: 2;
    position: relative;
}


.try {display:inline-block;margin-right:3px;} 
.clear {display:inline-block;} 

a.disabled {
  cursor: no-drop;
}


/* calendar */
#calendar {
    width: 700px;
    margin: 0 auto;
	color:black;
}

.response {
    height: 60px;
}

.success {
    background: #cdf3cd;
    padding: 10px 60px;
    border: #c3e6c3 1px solid;
    display: inline-block;
	margin-left:250px;
}


/* disappearing message */
#snackbar {
  visibility: hidden;
  min-width: 250px;
  margin-left: -125px;
  background-color: #333;
  color: #fff;
  text-align: center;
  border-radius: 2px;
  padding: 16px;
  position: fixed;
  z-index: 1;
  left: 50%;
  bottom: 30px;
  font-size: 17px;
}

#snackbar.show {
  visibility: visible;
  -webkit-animation: fadein 0.5s, fadeout 0.5s 2.5s;
  animation: fadein 0.5s, fadeout 0.5s 2.5s;
}

@-webkit-keyframes fadein {
  from {bottom: 0; opacity: 0;} 
  to {bottom: 30px; opacity: 1;}
}

@keyframes fadein {
  from {bottom: 0; opacity: 0;}
  to {bottom: 30px; opacity: 1;}
}

@-webkit-keyframes fadeout {
  from {bottom: 30px; opacity: 1;} 
  to {bottom: 0; opacity: 0;}
}

@keyframes fadeout {
  from {bottom: 30px; opacity: 1;}
  to {bottom: 0; opacity: 0;}
}
</style>​ 
<?php 
session_start();
if( !isset($_SESSION['username']) ){
	header('location: ../log/login.php'); // send to login page
	exit; 
 }
include '../head.php'; 


require_once '../config.php';

 

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
	$input_name = $_POST["name"];
    $input_capacity = $_POST["capacity"];
	$input_price = $_POST["price"];
	$input_address = $_POST["address"];
	$input_phone = $_POST["phone"];
	$input_observations = $_POST["observations"];
	if( !empty($_POST["gmaps"]) ){
		$input_gmaps = $_POST["gmaps"];
	} else{ $input_gmaps = ''; }
	$input_type = $_POST["type"];


   
	

}


?>

<body>
<div class="wiz">

<?php 
require_once '../menu.php'; 
?>

            <div style="background-color:#9999e6;background-size:cover;margin-top:-900px;margin-left:-40px;margin-right:-40px;height:250px;">
            <div style="height:70px;"></div>
			
				<h1 style="color:#1f1f2e;">Favourites</h1><br><br>
			
				</div>
				
				<form action="../start/venue_search.php?event_id=<?php echo $_GET[ 'event_id' ]; ?>" class="row" method="post"> 
					<div class="row" style="margin-left:300px;">
						<div class="column">
<input type="text" name="name" id="name" class="form-control" placeholder="Name" <?php if( !empty( $_SESSION[ 'venue_search_name' ] ) ){ ?>value="<?php echo $_SESSION[ 'venue_search_name' ] ?>" <?php } ?>>
						</div>
						
						<div class="column">
							<button type="submit" class="btn btn-main">Apply filters</button>
						</div>
					</div>
                </form>
				
			
			<form id="regForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
<div class="products" >
			<div class="container">
				
				<div class="row products_row products_container grid">

				<?php


$showRecordPerPage = 9;
if(isset($_GET['page']) && !empty($_GET['page'])){
	$currentPage = $_GET['page'];
	}else{
	$currentPage = 1;
	}
	$startFrom = ($currentPage * $showRecordPerPage) - $showRecordPerPage;

			$user_id = $_SESSION[ 'id' ];
					$sql = "SELECT f.*, v.* FROM favourites f
					LEFT JOIN venues v ON f.venue_id = v.venue_id
					WHERE v.venue_status != 'deleted' AND 
						  f.user_id = $user_id";
			
					if($stmt = $pdo->query($sql)){
						// Bind variables to the prepared statement as parameters
						
						$total = $stmt->rowCount();
						$lastPage = ceil($total/$showRecordPerPage);
						$firstPage = 1;
						$nextPage = $currentPage + 1;
						$previousPage = $currentPage - 1;
				
					$sql2 = "SELECT f.*, v.* FROM favourites f
					LEFT JOIN venues v ON f.venue_id = v.venue_id
					 WHERE v.venue_status != 'deleted' AND 
							f.user_id = $user_id
					" . ( $_SESSION[ 'venue_search_name' ] != '' ? " AND venue_name LIKE '%" . $_SESSION[ 'venue_search_name' ] . "%'"  : "" ) . "
					
					LIMIT $startFrom, $showRecordPerPage";
				
					unset( $_SESSION[ 'venue_search_name' ] );
						if($stmt2 = $pdo->query($sql2)){

						while($venue = $stmt2->fetch()) {
							
							$sql1 = "SELECT * FROM venue_files WHERE venue_id = :venue_id LIMIT 1";
        
							if($stmt1 = $pdo->prepare($sql1)){
								// Bind variables to the prepared statement as parameters
								$stmt1->execute(['venue_id' => $venue[ 'venue_id' ]]); 
								$venue_file = $stmt1->fetch();
								$file_name = $venue_file["file_name"];
								
							
								}

								$sql5 = "SELECT venue_rate FROM venues WHERE venue_id = :venue_id";
                                
                                if($stmt5 = $pdo->prepare($sql5)){
                                    // Bind variables to the prepared statement as parameters
                                    $stmt5->execute(['venue_id' => $venue[ 'venue_id' ]]); 
                                    
                                    $venue_rate = $stmt5->fetch();
                                

                                }
							
							?>
						
					


						<!-- Product -->
						<div class="col-xl-4 col-md-6 grid-item new">
							<div class="product">
								<div style="height:25px;"></div>
								<div class="product_image"><img src='http://localhost/git/bachelor/start_admin/images/<?php echo $file_name; ?>' height="350" width="442"> </div>
								<div class="product_content">
									<div class="product_info d-flex flex-row align-items-start justify-content-start">
										<div>
											<div>
												<div class="product_name"><a href="../start/see_venue.php?venue_id=<?php echo $venue[ 'venue_id' ] ?>&event_id=<?php echo $_GET[ 'event_id' ] ?>"><?= $venue[ 'venue_name' ] ?></a></div>
												<div class="product_category">Capacity: <?= $venue[ 'venue_capacity' ] ?></a></div>
											</div>
										</div>
										<div class="ml-auto text-right">
											<p style="text-align:center;margin-bottom:-20px;"><div style="margin-bottom:-42px;text-align:center;margin-left:-55px;font-size:25px;color:black;"><?php echo $venue_rate[ 'venue_rate' ]; ?></div> <div style="text-align:center;margin-right:-17px;"><i class="fa fa-star" data-rating="2" style="font-size:20px;color:#ff9f00;"></i></div></p>
											<div class="product_price text-right">$<?= $venue[ 'venue_rent_price' ] ?></span></div>
										</div>
									</div>
									<div class="product_buttons">
										<div class="text-right d-flex flex-row align-items-start justify-content-start">
											<div class="product_button product_fav text-center d-flex flex-column align-items-center justify-content-center">
													<a href="../start/see_venue.php?venue_id=<?php echo $venue[ 'venue_id' ] ?>&event_id=<?php echo $_GET[ 'event_id' ] ?>"><div class="plus" data-toggle="tooltip" title="See details!" data-placement="top"><div class="plus"><img src="../start_admin/images/eye_2.png" class="svg" alt="" data-toggle="tooltip" title="See details!" data-placement="top" height="40"><div class="plus">+</a></div></div></div>
											</div>
											<div class="product_button product_cart text-center d-flex flex-column align-items-center justify-content-center">
												<a class="disabled" href="#" onclick="return false;"><div class="plus" data-toggle="tooltip" title="Add to favorites!" data-placement="top"><div class="plus"><img src="../start_admin/images/heart_2.png" class="svg" alt="" data-toggle="tooltip" title="Add to favorites!" data-placement="top" height="40"><div class="plus">+</a></div></div></div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>


						<?php
						
						
						}}}

					?>

				</div>
				<div class="row page_nav_row">
					<div class="col">
						<div class="page_nav">
							<ul class="d-flex flex-row align-items-start justify-content-center">
								<!-- <li class="active"><a href="#">01</a></li>
								<li><a href="#">02</a></li>
								<li><a href="#">03</a></li>
								<li><a href="#">04</a></li> -->


							<?php if($currentPage != $firstPage) { ?>
								<li>
								<a href="?page=<?php echo $firstPage ?>" tabindex="-1" aria-label="Previous">
								<span aria-hidden="true">First</span>
								</a>
								</li>
								<?php } ?>
								<?php if($currentPage >= 2) { ?>
								<li><a href="?page=<?php echo $previousPage ?>"><?php echo $previousPage ?></a></li>
								<?php } ?>
								<li class="active"><a href="?page=<?php echo $currentPage ?>"><?php echo $currentPage ?></a></li>
								<?php if($currentPage != $lastPage) { ?>
								<li><a href="?page=<?php echo $nextPage ?>"><?php echo $nextPage ?></a></li>
								<li>
								<a href="?page=<?php echo $lastPage ?>" aria-label="Next">
								<span aria-hidden="true">Last</span>
								</a>
								</li>
							<?php } ?>
							</ul>
						</div>
					</div>
				</div>
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