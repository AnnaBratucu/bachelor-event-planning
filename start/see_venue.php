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
  margin-top:-500px;
}


.products{
	background: white;
	
	
}
.container{
	background: white;
	
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
    $input_date_min_time = strtotime($_POST["date_min"]);
    $input_date_max_time = strtotime($_POST["date_max"]);
    $today_time = strtotime( date("m/d/Y") );
    if($input_date_min_time > $input_date_max_time){
		$date_err = "Date Min can't be bigger than Date Max";
    } else if( $input_date_min_time < $today_time || $input_date_max_time < $today_time ){
        $date_err = "Date Min or Date Max can't be in the past" ;
    }else{
        $_SESSION[ 'date_min' ] = $input_date_min;
        $_SESSION[ 'date_max' ] = $input_date_max;
        if(isset($_GET[ 'event_id' ])){
            $id = $_GET[ 'event_id' ];
            header("location: ../start_admin/wizard_admin.php?event_id=$id");
            exit();
        }else{
            header("location: ../start_admin/wizard_admin.php");
            exit();
        }
    }
}


?>

<body>

<div class="wiz">

<?php 
require_once '../menu.php'; 
?>
       

        <div class="wiz">
        
        <form id="regForm" autocomplete="off" action="<?php if(isset($_GET[ 'event_id' ])){ echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?event_id=' . $_GET[ 'event_id' ]; } else{ echo htmlspecialchars($_SERVER["PHP_SELF"]); } ?>" method="POST">
            <div style="background-image:url('../images/5631.jpg');background-size:cover;margin-top:-62px;margin-left:-40px;margin-right:-40px;height:250px;">
            <div style="height:70px;"></div>
        <h1 style="color:#1f1f2e;">See venue details</h1><br><br>
</div>

<?php $sql = "SELECT * FROM venues WHERE venue_id = :venue_id";
				
                if($stmt = $pdo->prepare($sql)){
                    // Bind variables to the prepared statement as parameters
                    $stmt->bindParam(":venue_id", $param_id);
                    
                    // Set parameters
                    $param_id = $_GET["venue_id"];
                    
                    // Attempt to execute the prepared statement
                    if($stmt->execute()){
                       
                        /* Fetch result row as an associative array. Since the result set contains only one row, we don't need to use while loop */
                        $row = $stmt->fetch(PDO::FETCH_ASSOC);
                        
                        // Retrieve individual field value
                        $id = $row["venue_id"];
                        $name = $row["venue_name"];
                        $address = $row["venue_address"];
                        $obs = $row["venue_observations"];
                        $price = $row["venue_rent_price"];
                        $gmaps = $row["venue_gmaps"];
                        $capacity = $row["venue_capacity"];
                        $phone = $row["venue_phone"];
                        $type = $row["venue_type"];
                        
                        
                        
                    } else{
                        echo "Oops! Something went wrong. Please try again later.";
                    }
                } 
                
                $address1 = $address; // Address
                $apiKey = '5970d7a2091d43c5a9883bcbf56631a1'; // Google maps now requires an API key.
                // Get JSON results from this request
                $geo = file_get_contents('https://api.opencagedata.com/geocode/v1/json?q='.urlencode($address1).'&key='.$apiKey);
                $geo = json_decode($geo, true); // Convert the JSON to an array

                $latitude = $geo['results'][0]['geometry']['lat']; // Latitude
                $longitude = $geo['results'][0]['geometry']['lng']; // Longitude
                
                ?>


<section class="section bg-gray" style="background-color:white;">
	<!-- Container Start -->
	<div class="container">
		<div class="row">
			<!-- Left sidebar -->
			<div class="col-md-8">
				<div class="product-details">
					<h1 class="product-title"><?php echo $name; ?></h1>
					<div class="product-meta">
						<ul class="list-inline">
                            <li class="list-inline-item"><i class="fa fa-location-arrow"></i><?php echo $address; ?></li>
						</ul>
                    </div>
                    <!-- product slider -->
                    <div class="product-slider">

                    <?php 
                    
                    $sql1 = "SELECT * FROM venue_files WHERE venue_id = :venue_id";
        
							if($stmt1 = $pdo->prepare($sql1)){
								// Bind variables to the prepared statement as parameters
								$stmt1->execute(['venue_id' => $id]); 
								
								while ($row = $stmt1->fetch()) { 

                                
                    
                    ?>
					
						<div class="product-slider-item my-4" data-image='http://localhost/git/bachelor/start_admin/images/<?php echo $row[ 'file_name' ]; ?>'>
							<img class="img-fluid w-100" src='http://localhost/git/bachelor/start_admin/images/<?php echo $row[ 'file_name' ]; ?>' style="height:500px;">
                        </div>
                        
                    <?php } } ?>
                    </div>
                    <!-- product slider -->
					<div class="content mt-5 pt-5">
						<ul class="nav nav-pills  justify-content-center" id="pills-tab" role="tablist">
							<li class="nav-item">
								<a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home"
								 aria-selected="true" style="color:black">Venue Details</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile"
								 aria-selected="false" style="color:black">Specifications</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact"
								 aria-selected="false" style="color:black">Reviews</a>
							</li>
						</ul>
						<div class="tab-content" id="pills-tabContent">
							<div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
								<h3 class="tab-title">Venue Description</h3>
								<p><?php echo $obs; ?></p>

								<?php echo $gmaps; ?>
								
								

							</div>
							<div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
								<h3 class="tab-title">Venue Specifications</h3>
								<table class="table table-bordered product-table">
									<tbody>
										<tr>
											<td>Rent Price</td>
											<td>$<?php echo $price; ?></td>
										</tr>
										<tr>
											<td>Capacity</td>
											<td><?php echo $capacity; ?> guests</td>
										</tr>
										<tr>
											<td>Phone</td>
											<td><?php echo $phone; ?></td>
										</tr>
										<tr>
                                            <td>Space facilities</td>
                                            <?php if( $type == 'outdoor' ){ ?>
                                                <td>Outdoor setting</td>
                                            <?php } else if( $type == 'indoor' ){ ?>
                                                <td>Indoor setting</td>
                                            <?php } else if( $type == 'both' ){ ?>
                                                <td>Indoor and Outdoor settings</td>
                                            <?php } ?>
										</tr>
									</tbody>
								</table>
							</div>
							<div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
								<h3 class="tab-title">Venue Review</h3>
								<div class="product-review">
									<div class="media">
										<!-- Avater -->
										<img src="images/user/user-thumb.jpg" alt="avater">
										<div class="media-body">
											<!-- Ratings -->
											<div class="ratings">
												<ul class="list-inline">
													<li class="list-inline-item">
														<i class="fa fa-star"></i>
													</li>
													<li class="list-inline-item">
														<i class="fa fa-star"></i>
													</li>
													<li class="list-inline-item">
														<i class="fa fa-star"></i>
													</li>
													<li class="list-inline-item">
														<i class="fa fa-star"></i>
													</li>
													<li class="list-inline-item">
														<i class="fa fa-star"></i>
													</li>
												</ul>
											</div>
											<div class="name">
												<h5>Jessica Brown</h5>
											</div>
											<div class="date">
												<p>Mar 20, 2018</p>
											</div>
											<div class="review-comment">
												<p>
													Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremqe laudant tota rem ape
													riamipsa eaque.
												</p>
											</div>
										</div>
									</div>
									<div class="review-submission">
										<h3 class="tab-title">Submit your review</h3>
										<!-- Rate -->
										<div class="rate">
											<div class="starrr"></div>
										</div>
										<div class="review-submit">
											<form action="#" class="row">
												<div class="col-lg-6">
													<input type="text" name="name" id="name" class="form-control" placeholder="Name">
												</div>
												<div class="col-lg-6">
													<input type="email" name="email" id="email" class="form-control" placeholder="Email">
												</div>
												<div class="col-12">
													<textarea name="review" id="review" rows="10" class="form-control" placeholder="Message"></textarea>
												</div>
												<div class="col-12">
													<button type="submit" class="btn btn-main">Sumbit</button>
												</div>
											</form>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="sidebar">
					<div class="widget price text-center">
						<h4>Price</h4>
						<p>$<?php echo $price; ?></p>
					</div>
					<!-- User Profile widget -->
					<div class="widget user text-center">
						<img class="rounded-circle img-fluid mb-5 px-5" src="images/user/user-thumb.jpg" alt="">
						<h4><a href="">Jonathon Andrew</a></h4>
						<p class="member-time">Member Since Jun 27, 2017</p>
						<a href="" style="color:black;">See all ads</a>
						<ul class="list-inline mt-20">
							<li class="list-inline-item"><a href="" class="btn btn-contact d-inline-block  btn-primary px-lg-5 my-1 px-md-3">Contact</a></li>
							<li class="list-inline-item"><a href="choose_venue.php?venue_id=<?php echo $id ?>&event_id=<?php echo $_GET[ 'event_id' ] ?>&venue_price=<?php echo $price ?>" onclick="if (!confirm('Are you sure you want to book this venue?')) { return false; }" class="btn btn-offer d-inline-block btn-primary ml-n1 my-1 px-lg-4 px-md-3">Book venue</a></li>
						</ul>
					</div>
					<!-- Map Widget -->
					<div class="widget map">
						<div class="map">
							<div id="map_canvas" data-latitude=<?php echo $latitude ?> data-longitude=<?php echo $longitude ?>></div>
						</div>
					</div>
					<!-- Rate Widget -->
					<div class="widget rate">
						<!-- Heading -->
						<h5 class="widget-header text-center">What would you rate
							<br>
							this product</h5>
						<!-- Rate -->
						<div class="starrr"></div>
					</div>
					<!-- Safety tips widget -->
					<div class="widget disclaimer">
						<h5 class="widget-header">Safety Tips</h5>
						<ul>
							<li>Meet seller at a public place</li>
							<li>Check the item before you buy</li>
							<li>Pay only after collecting the item</li>
							<li>Pay only after collecting the item</li>
						</ul>
					</div>
					<!-- Coupon Widget -->
					<div class="widget coupon text-center">
						<!-- Coupon description -->
						<p>Have a great product to post ? Share it with
							your fellow users.
						</p>
						<!-- Submii button -->
						<a href="" class="btn btn-transparent-white">Submit Listing</a>
					</div>

				</div>
			</div>

		</div>
	</div>
	<!-- Container End -->
</section>




  <div style="overflow:auto;">
    <div >
      <!--<button type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button>-->
      <input type="submit" value="Next" class="nextBtn" id="nextBtn" style="color:white;width:200px;margin-left:390px;cursor:pointer;">
    </div>
  </div>
  
</form>
</div>

<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>
  $( function() {
    $( "#datepicker" ).datepicker();
  } );
  $( function() {
    $( "#datepicker1" ).datepicker();
  } );
  </script>

<?php include '../footer.php';  ?> 

<script src="../vendor/jquery/jquery-3.2.1.min.js"></script>
<script src="../vendor/bootstrap/js/popper.min.js"></script>
<script src="../vendor/bootstrap/js/bootstrap.min.js"></script>
<script src="../vendor/bootstrap/js/bootstrap-slider.js"></script>
  <!-- tether js -->
<script src="../vendor/tether/js/tether.min.js"></script>
<script src="../vendor/raty/jquery.raty-fa.js"></script>
<script src="../vendor/slick-carousel/slick/slick.min.js"></script>
<script src="../vendor/jquery-nice-select/js/jquery.nice-select.min.js"></script>
<script src="../vendor/fancybox/jquery.fancybox.pack.js"></script>
<script src="../vendor/smoothscroll/SmoothScroll.min.js"></script>
<!-- google map -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCcABaamniA6OL5YvYSpB3pFMNrXwXnLwU&libraries=places"></script>
<script src="../vendor/google-map/gmap.js"></script>
<script src="../js/script_see_venue.js"></script>

</body>
</html>