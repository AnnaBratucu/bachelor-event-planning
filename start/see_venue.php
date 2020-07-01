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
  margin-top:-537px;
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
  
}
input[type=number] {
	color:black;
}

</style>​  
<?php include '../head.php'; 

require_once "../config.php";

session_start();

$sql = "SELECT count(*) AS count_reviews FROM rating WHERE venue_id = :venue_id";
        
            if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->execute(['venue_id' => $_GET[ 'venue_id' ] ]); 
            $count = $stmt->fetch();

        }

if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Validate username
    $input_rate = $_POST["rating"];
    if($input_rate == 'one'){
        $tru_rate = 1;
    } else if($input_rate == 'two'){
        $tru_rate = 2;
    } else if($input_rate == 'three'){
        $tru_rate = 3;
    } else if($input_rate == 'four'){
        $tru_rate = 4;
    } else if($input_rate == 'five'){
        $tru_rate = 5;
    }
    $input_name = $_POST["name"];
    $input_mess = $_POST["review"];
    $input_date = date('Y-m-d');
    $sql = "INSERT INTO rating (user_name, venue_id, date, message, value) VALUES (:username, :venue_id, :date, :message, :value)";
        if( $stmt = $pdo->prepare($sql)  ){
            // Bind variables to the prepared statement as parameters
			$stmt->bindParam(":username", $param_username);
			$stmt->bindParam(":venue_id", $param_venue);
			$stmt->bindParam(":date", $param_date);
            $stmt->bindParam(":message", $param_message);
            $stmt->bindParam(":value", $param_value);
            
            // Set parameters
			$param_username = $input_name;
			$param_venue = $_GET[ 'venue_id' ];
			$param_date = $input_date;
            $param_message = $input_mess;
            $param_value = $tru_rate;

            $stmt->execute();
            
        }

        $sql = "SELECT venue_rate FROM venues WHERE venue_id = :venue_id";
        
        if($stmt = $pdo->prepare($sql)){
        // Bind variables to the prepared statement as parameters
        $stmt->execute(['venue_id' => $_GET[ 'venue_id' ] ]); 
        $last_rate = $stmt->fetch();

    }

    $sql = "SELECT count(*) AS count_reviews1 FROM rating WHERE venue_id = :venue_id";
        
            if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->execute(['venue_id' => $_GET[ 'venue_id' ] ]); 
            $count1 = $stmt->fetch();

        }

    $sql7 = "UPDATE venues SET venue_rate = :venue_rate WHERE venue_id = :venue_id";
                if( $stmt7 = $pdo->prepare($sql7)  ){
                    // Bind variables to the prepared statement as parameters
                    $stmt7->bindParam(":venue_rate", $param_rate);
                    $stmt7->bindParam(":venue_id", $venue_id);
                    
                    // Set parameters
                    $param_rate = ($last_rate[ 'venue_rate' ]+$tru_rate)/$count1[ 'count_reviews1' ];
                    $venue_id = $_GET[ 'venue_id' ];
                    
                    $stmt7->execute();
                    
                }
}


?>

<body>

<div class="wiz">

<?php 
require_once '../menu.php'; 
?>
       

        <div class="wiz">
        
            <div style="background-image:url('../images/venue.jpg');background-size:cover;margin-top:-262px;margin-left:-40px;margin-right:-40px;height:300px;">
                <div style="height:70px;"></div>
                <h1 style="color:#1f1f2e;">See venue details</h1><br><br>
            </div>
        <form id="regForm" autocomplete="off" action="<?php //if(isset($_GET[ 'event_id' ])){ echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?event_id=' . $_GET[ 'event_id' ]; } else{ echo htmlspecialchars($_SERVER["PHP_SELF"]); } ?>" method="POST">

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
	<div class="container" style="margin-top:-200px;">
		<div class="row">
			<!-- Left sidebar -->
			<div class="col-md-8">
				<div class="product-details">
					<h1 class="product-title"><?php echo $name; ?></h1>
					<div class="product-meta">
                        <table>
                            <tr>
                                <td><i class="fa fa-location-arrow" style="margin-top:-30px;"></td>
                                <td><?php echo $address; ?></td>
                            </tr>
                        </table>
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
								<h3 class="tab-title">Venue Reviews</h3>
								<div class="product-review">

                                <?php 
                    
                                $sql1 = "SELECT * FROM rating WHERE venue_id = :venue_id ORDER BY rate_id DESC LIMIT 4";
                    
                                        if($stmt1 = $pdo->prepare($sql1)){
                                            // Bind variables to the prepared statement as parameters
                                            $stmt1->execute(['venue_id' => $_GET[ 'venue_id' ] ]); 
                                            if($stmt1->rowCount() == 0){
                                                echo 'No reviews';
                                                echo '<br><br>';
                                            }else{
                                            while ($row = $stmt1->fetch()) { 

                                ?>
									<div class="media">
										<div class="media-body">
											<!-- Ratings -->
											<div class="ratings">
                                                <p style="text-align:center;"><div style="margin-bottom:-50px;text-align:center;margin-left:-55px;font-size:35px;"><?php echo $row[ 'value' ] ?></div> <div style="text-align:center;margin-right:-17px;"><i class="fa fa-star" data-rating="2" style="font-size:20px;color:#ff9f00;"></i></div></p>
                                            </div>
											<div class="name">
												<h5><?php echo $row[ 'user_name' ]; ?></h5>
											</div>
											<div class="date">
												<p><?php echo date_format( date_create( $row[ 'date' ] ), 'd-m-Y' ); ?></p>
											</div>
											<div class="review-comment">
												<p>
                                                    <?php echo $row[ 'message' ]; ?>
												</p>
											</div>
										</div>
                                    </div>
                                <?php } } } if($stmt1->rowCount() == 4 ){ ?>
                                    <a href="all_reviews.php?event_id=<?php echo $_GET[ 'event_id' ]; ?>&venue_id=<?php echo $_GET[ 'venue_id' ]; ?>"><p>See all reviews</p></a>
                                <?php } ?>
									<div class="review-submission">
										<h3 class="tab-title">Submit your review</h3>
                                        <!-- Rate -->
                                        <form autocomplete="off" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>&event_id=<?php echo $_GET[ 'event_id' ]; ?>&venue_id=<?php echo $_GET[ 'venue_id' ]; ?>" class="row" method="post">
                                            <div class="rate">
                                                <div class="ratings">
                                                    <ul class="list-inline">
                                                        <li class="list-inline-item">
                                                            <label for="one">1</label><br><input type="radio" id="one" name="rating" value="one" required="true">
                                                        </li>
                                                        <li class="list-inline-item">
                                                            <label for="two">2</label><br><input type="radio" id="two" name="rating" value="two">
                                                        </li>
                                                        <li class="list-inline-item">
                                                            <label for="three">3</label><br><input type="radio" id="three" name="rating" value="three">
                                                        </li>
                                                        <li class="list-inline-item">
                                                            <label for="four">4</label><br><input type="radio" id="four" name="rating" value="four">
                                                        </li>
                                                        <li class="list-inline-item">
                                                            <label for="five">5</label><br><input type="radio" id="five" name="rating" value="five">
                                                        </li>
                                                    </ul>
                                                </div>
										    </div>
										    <div class="review-submit">
												<div class="col-lg-6">
													<input type="text" name="name" id="name" class="form-control" placeholder="Name" required>
												</div>
												<div class="col-12">
													<textarea name="review" id="review" rows="10" class="form-control" placeholder="Message"></textarea>
												</div>
												<div class="col-12">
													<button type="submit">Submit</button>
												</div>
                                            </div>
                                        </form>
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
					<div class="widget user text-center" style="background-color:#ccffcc;">
                        <form autocomplete="off" action="choose_venue.php?venue_id=<?php echo $id ?>&event_id=<?php echo $_GET[ 'event_id' ] ?>&venue_price=<?php echo $price ?>" method="post" class="row" enctype='multipart/form-data' >
                            <div class="col-12">
                                <h3>Book venue</h3>
                            </div>
                            <div class="col-lg-6">
                            <?php 
                                $event_start = [];
                                $sql5 = "SELECT start FROM tbl_events WHERE venue_id = :venue_id";
                                
                                if($stmt5 = $pdo->prepare($sql5)){
                                    // Bind variables to the prepared statement as parameters
                                    $stmt5->execute(['venue_id' => $_GET[ 'venue_id' ]]); 
                                    
                                    while($start = $stmt5->fetch()) {
                                        $event_start[] = $start[ 'start' ];
                                    }
                                }
                            ?>
                            <input type="text" hidden id='strawberry-plant' data-id="<?php print_r( $event_start ) ?>"/>
                            <input type="text" name="date" class="form-control datepicker" placeholder="Select Date Here" required style="width:250px;"/><i class="fas fa-calendar-day" style="color:black;top:-30px;left:180px;"></i>
                            <input type="time" style="margin-left:-4px;margin-top:-20px;margin-bottom:20px;border-radius:5px;width:100px;" id="hour" name="hour" min="15:00" max="20:00" required>
                            </div>
                           
                            <div class="col-12">
                                <button type="submit">Book venue</button><br>
                            </div>
                        </form>
							<!-- <li class="list-inline-item"><a href="choose_venue.php?venue_id=<?php echo $id ?>&event_id=<?php echo $_GET[ 'event_id' ] ?>&venue_price=<?php echo $price ?>" onclick="if (!confirm('Are you sure you want to book this venue?')) { return false; }" class="btn btn-offer d-inline-block btn-primary ml-n1 my-1 px-lg-4 px-md-3">Book venue</a></li> -->
						
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
                        <h5 class="widget-header text-center">Rating</h5>

						<!-- Rate -->
						<?php 
                                $sql5 = "SELECT venue_rate FROM venues WHERE venue_id = :venue_id";
                                
                                if($stmt5 = $pdo->prepare($sql5)){
                                    // Bind variables to the prepared statement as parameters
                                    $stmt5->execute(['venue_id' => $_GET[ 'venue_id' ]]); 
                                    
                                    $venue_rate = $stmt5->fetch();
                                

                                }

                                if( $venue_rate[ 'venue_rate' ] == 0.00 ){
                         ?>
                            <p style="text-align:center;"><div style="margin-bottom:-50px;text-align:center;font-size:35px;">No reviews...</div></p>
                        <?php } else { ?>
                            <p style="text-align:center;"><div style="margin-bottom:-50px;text-align:center;margin-left:-55px;font-size:35px;"><?php echo $venue_rate[ 'venue_rate' ]; ?></div> <div style="text-align:center;margin-right:-17px;"><i class="fa fa-star" data-rating="2" style="font-size:20px;color:#ff9f00;"></i></div><br><div style="text-align:center;">/<?php if( $_SERVER["REQUEST_METHOD"] == "POST") { echo $count1[ 'count_reviews1' ]; } else { echo $count[ 'count_reviews' ]; } ?> reviews</div></p>
                        <?php } ?>
					</div>
					<!-- Safety tips widget -->
					<!-- <div class="widget disclaimer">
						<h5 class="widget-header">Safety Tips</h5>
						<ul>
							<li>Meet seller at a public place</li>
							<li>Check the item before you buy</li>
							<li>Pay only after collecting the item</li>
							<li>Pay only after collecting the item</li>
						</ul>
					</div> -->
					<!-- Coupon Widget -->
					<!-- <div class="widget coupon text-center"> -->
						<!-- Coupon description -->
						<!-- <p>Have a great product to post ? Share it with -->
							<!-- your fellow users. -->
						<!-- </p> -->
						<!-- Submii button -->
						<!-- <a href="" class="btn btn-transparent-white">Submit Listing</a> -->
					<!-- </div> -->

				</div>
			</div>

		</div>
	</div>
	<!-- Container End -->
</section>




  <div style="overflow:auto;margin-top:-180px;">
    <div >
      <!--<button type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button>-->
      <?php if( !isset( $_GET[ 'type' ] ) ){ ?>
        <a href="../start_admin/wizard_admin.php?event_id=<?php echo $_GET[ 'event_id' ] ?>"><button type="button" style="color:white;width:200px;cursor:pointer;margin-left:700px;margin-bottom:100px;">Back</button></a>
      <?php }else{ ?>
        <a href="list_favourites.php?event_id=<?php echo $_GET[ 'event_id' ] ?>"><button type="button" style="color:white;width:200px;cursor:pointer;margin-left:700px;margin-bottom:100px;">Back</button></a>
      <?php } ?>
    </div>
  </div>
  
</form>
</div>

<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>


<script type="text/javascript" src="../vendor/jquery/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="../vendor/jquery/jquery-ui.js"></script>

<script type="text/javascript">

   // $( "#datepicker" ).datepicker();
 

// $( ".datepicker" ).datepicker();

//var disabledDates = ["2020-05-28","2015-11-14","2015-11-21"];

var plant = document.getElementById('strawberry-plant');
var fruitCount = plant.getAttribute('data-id');
//alert(fruitCount);

// $('.datepicker').on('click', function (e) {
//         var rowid = $(e.relatedTarget).data('id');
//         alert(rowid);
//     });
$('.datepicker').datepicker({
    minDate: 0,
    
    beforeShowDay: function(date){

        var string = jQuery.datepicker.formatDate('yy-mm-dd', date);

        return [ fruitCount.indexOf(string) == -1 ]

    }

});
</script>

<?php include '../footer.php';  ?> 

<!-- <script src="../vendor/jquery/jquery-3.2.1.min.js"></script> -->
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