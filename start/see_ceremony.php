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

?>

<body>

<div class="wiz">

<?php 
require_once '../menu.php'; 
?>
       

        <div class="wiz">
        
            <div style="background-image:url('../images/ceremony.jpg');background-size:cover;margin-top:-262px;margin-left:-40px;margin-right:-40px;height:300px;">
                <div style="height:70px;"></div>
                <h1 style="color:white;">See ceremony venue details</h1><br><br>
            </div>
        <form id="regForm" autocomplete="off" action="<?php //if(isset($_GET[ 'event_id' ])){ echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?event_id=' . $_GET[ 'event_id' ]; } else{ echo htmlspecialchars($_SERVER["PHP_SELF"]); } ?>" method="POST">

<?php $sql = "SELECT * FROM ceremonies WHERE ceremony_id = :ceremony_id";
				
                if($stmt = $pdo->prepare($sql)){
                    // Bind variables to the prepared statement as parameters
                    $stmt->bindParam(":ceremony_id", $param_id);
                    
                    // Set parameters
                    $param_id = $_GET["ceremony_id"];
                    
                    // Attempt to execute the prepared statement
                    if($stmt->execute()){
                       
                        /* Fetch result row as an associative array. Since the result set contains only one row, we don't need to use while loop */
                        $row = $stmt->fetch(PDO::FETCH_ASSOC);
                        
                        // Retrieve individual field value
                        $id = $row["ceremony_id"];
                        $name = $row["ceremony_name"];
                        $address = $row["ceremony_address"];
                        $obs = $row["ceremony_observations"];
                        $capacity = $row["ceremony_capacity"];
                        $phone = $row["ceremony_phone"];
                        $live = $row["ceremony_live"];
                        $bell = $row["ceremony_bell"];
                        $flower = $row["ceremony_flower"];
                        $heat = $row["ceremony_heat"];
                        
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
                    
                    $sql1 = "SELECT * FROM ceremony_files WHERE ceremony_id = :ceremony_id";
        
							if($stmt1 = $pdo->prepare($sql1)){
								// Bind variables to the prepared statement as parameters
								$stmt1->execute(['ceremony_id' => $id]); 
								
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
						</ul>
						<div class="tab-content" id="pills-tabContent">
							<div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
								<h3 class="tab-title">Venue Description</h3>
								<p><?php echo $obs; ?></p>

								</div>
							<div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
								<h3 class="tab-title">Venue Specifications</h3>
								<table class="table table-bordered product-table">
									<tbody>
										<tr>
											<td>Capacity</td>
											<td><?php echo $capacity; ?> guests</td>
										</tr>
										<tr>
											<td>Phone</td>
											<td><?php echo $phone; ?></td>
										</tr>
										<tr>
                      <td>Facilities</td>
                        <td>
                          <table>
                            <tr>
                              <?php if( $live == 'yes' ){ ?>
                                <td style="background-color:white;">Live Music</td>
                              <?php } ?>
                              <?php if( $bell == 'yes' ){ ?>
                                <td style="background-color:white;">Church Bells</td>
                              <?php } ?>
                              <?php if( $flower == 'yes' ){ ?>
                                <td style="background-color:white;">Flowers Provided</td>
                              <?php } ?>
                              <?php if( $heat == 'yes' ){ ?>
                                <td style="background-color:white;">Heating</td>
                              <?php } ?>
                            </tr>
                          </table>
                        </td>         
										  </tr>
									</tbody>
								</table>
							</div>
							
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="sidebar">
					
					<!-- User Profile widget -->
					<div class="widget user text-center" style="background-color:#ccffcc;">
                        <form action="choose_ceremony.php?ceremony_id=<?php echo $id ?>&event_id=<?php echo $_GET[ 'event_id' ] ?>" method="post">
                            
                        </form>
                        <form autocomplete="off" action="choose_ceremony.php?ceremony_id=<?php echo $id ?>&event_id=<?php echo $_GET[ 'event_id' ] ?>" method="post" name="myForm" id="myForm">
                            <h3>Book venue</h3>
                            <div class="col-lg-6">
                            <?php 
                                $event_start = [];
                                $sql5 = "SELECT start FROM tbl_events_ceremony WHERE ceremony_id = :ceremony_id";
                                
                                if($stmt5 = $pdo->prepare($sql5)){
                                    // Bind variables to the prepared statement as parameters
                                    $stmt5->execute(['ceremony_id' => $_GET[ 'ceremony_id' ]]); 
                                    
                                    while($start = $stmt5->fetch()) {
                                        $event_start[] = $start[ 'start' ];
                                    }
                                }
                            ?>
                            <input type="text" hidden id='strawberry-plant' data-id="<?php print_r( $event_start ) ?>"/>
                            <input type="text" name="date" class="form-control datepicker" placeholder="Select Date Here" required style="width:250px;margin-left:-20px;"/><i class="fas fa-calendar-day" style="color:black;top:-30px;left:160px;"></i>
                            <input type="time" style="margin-left:-30px;margin-top:-20px;margin-bottom:20px;border-radius:5px;width:100px;" id="hour" name="hour" max="15:00" required>
                            </div>
                           
                            <div class="col-12">
                                <!-- <button type="submit" class="btn btn-main">Book ceremony venue</button><br> -->
                                <button type="submit" form="myForm" value="Submit">Submit</button>
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
        <a href="../start_admin/ceremony_admin.php?event_id=<?php echo $_GET[ 'event_id' ] ?>"><button type="button" style="color:white;width:200px;cursor:pointer;margin-left:700px;margin-bottom:100px;">Back</button></a>
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