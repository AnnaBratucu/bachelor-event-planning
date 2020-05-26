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
  margin-top:-100px;
}


/* .products{
	background: white;
	
	
}
.container{
	background: white;
	
} */

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
  background-color:pink;
}
input[type=number] {
	color:black;
}

</style>​ 
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

<div class="wiz">

<?php 
require_once '../menu.php'; 
?>
       

        <div class="wiz">
        
        <form id="regForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <div style="background-image:url('../images/5631.jpg');background-size:cover;margin-top:-162px;margin-left:-40px;margin-right:-40px;height:250px;">
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
				
				<div class="row products_row products_container grid">



				<?php


$showRecordPerPage = 9;
if(isset($_GET['page']) && !empty($_GET['page'])){
	$currentPage = $_GET['page'];
	}else{
	$currentPage = 1;
	}
	$startFrom = ($currentPage * $showRecordPerPage) - $showRecordPerPage;
					
					$sql = "SELECT * FROM venues WHERE venue_status != 'deleted'";
					if($stmt = $pdo->query($sql)){
						// Bind variables to the prepared statement as parameters
						
						$total = $stmt->rowCount();
						$lastPage = ceil($total/$showRecordPerPage);
						$firstPage = 1;
						$nextPage = $currentPage + 1;
						$previousPage = $currentPage - 1;

						$sql2 = "SELECT * FROM venues WHERE venue_status != 'deleted' LIMIT $startFrom, $showRecordPerPage";
						if($stmt2 = $pdo->query($sql2)){

						while($venue = $stmt2->fetch()) {
							
							$sql1 = "SELECT * FROM venue_files WHERE venue_id = :venue_id LIMIT 1";
        
							if($stmt1 = $pdo->prepare($sql1)){
								// Bind variables to the prepared statement as parameters
								$stmt1->execute(['venue_id' => $venue[ 'venue_id' ]]); 
								$venue_file = $stmt1->fetch();
								$file_name = $venue_file["file_name"];
								
							
								}
							
							
							
							?>

					<!-- Product -->
					<div class="col-xl-4 col-md-6 grid-item sale">
						<div class="product">
							<div class="product_image"><img src='http://localhost/git/bachelor/start_admin/images/<?php echo $file_name; ?>' height="350" width="442"></div>
							<div class="product_content">
								<div class="product_info d-flex flex-row align-items-start justify-content-start">
									<div>
										<div>
											<div class="product_name"><a href="product.html"><?= $venue[ 'venue_name' ] ?></a></div>
											<div class="product_category">Capacity: <?= $venue[ 'venue_capacity' ] ?></a></div>
										</div>
										</div>
										<div class="ml-auto text-right">
											<div class="rating_r rating_r_4 home_item_rating"><i></i><i></i><i></i><i></i><i></i></div>
											<div class="product_price text-right">$<?= $venue[ 'venue_rent_price' ] ?></span></div>
										</div>
									</div>
								<div class="product_buttons">
									<div class="text-right d-flex flex-row align-items-start justify-content-start">
										<div class="product_button product_fav text-center d-flex flex-column align-items-center justify-content-center">
											<a href="see_venue.php?venue_id=<?php echo $venue[ 'venue_id' ] ?>"><div class="plus" data-toggle="tooltip" title="See details!" data-placement="top"><div class="plus"><img src="images/eye_2.png" class="svg" alt="" data-toggle="tooltip" title="See details!" data-placement="top" height="40"><div class="plus">+</a></div></div></div>
										</div>
										<div class="product_button product_cart text-center d-flex flex-column align-items-center justify-content-center">
											<a href="choose_venue.php?venue_id=<?php echo $venue[ 'venue_id' ] ?>"><div class="plus" data-toggle="tooltip" title="Choose this venue!" data-placement="top"><div class="plus"><img src="images/cart.png" class="svg" alt="" data-toggle="tooltip" title="Choose this venue!" data-placement="top" height="40"><div class="plus">+</a></div></div></div>
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


  <div style="overflow:auto;">
    <div >
      <a href="wizard.php?event_id=<?php echo $_GET[ 'event_id' ] ?>"><button type="button"  style="color:white;width:200px;margin-right:-500px;margin-left:550px;cursor:pointer;background-color: #bbbbbb;">Previous</button></a>
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
		

<div style="height:800px;"></div>
<?php include '../footer.php';  ?> 
</body>
</html>