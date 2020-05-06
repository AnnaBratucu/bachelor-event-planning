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
  
}
input[type=number] {
	color:black;
}

</style>​  
<?php include '../head.php'; 

require_once "../config.php";

session_start();

$venue_id = $_GET[ 'venue_id' ];
$event_id = $_GET[ 'event_id' ];

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
        
        <form id="regForm" autocomplete="off" action="<?php //if(isset($_GET[ 'event_id' ])){ echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?event_id=' . $_GET[ 'event_id' ]; } else{ echo htmlspecialchars($_SERVER["PHP_SELF"]); } ?>" method="POST">
            <div style="background-image:url('../images/5631.jpg');background-size:cover;margin-top:-62px;margin-left:-40px;margin-right:-40px;height:250px;">
            <div style="height:70px;"></div>
        <h1 style="color:#1f1f2e;">See all reviews</h1><br><br>
</div>

<section class="section bg-gray" style="background-color:white;">
	<!-- Container Start -->
	<div class="container">
		<div class="row">
			<!-- Left sidebar -->
			<div class="col-md-8">
				<div class="product-details" style="margin-top:-180px;">
					
                    <!-- product slider -->
					<div class="content mt-5 pt-5">
						<div class="tab-content" id="pills-tabContent">
							<div class="tab-pane fade show active" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
								<h3 class="tab-title">Venue Reviews</h3>
								<div class="product-review">

                                <?php 

                                if (isset($_GET['pageno'])) {
                                    $pageno = $_GET['pageno'];
                                } else {
                                    $pageno = 1;
                                }

                                $no_of_records_per_page = 4;
                                $offset = ($pageno-1) * $no_of_records_per_page;

                                if( $_SERVER["REQUEST_METHOD"] == "POST" ){
                                    $c = $count1[ 'count_reviews1' ];
                                }else{
                                    $c = $count[ 'count_reviews' ];
                                }

                                $total_pages = ceil($c / $no_of_records_per_page);


                    
                                $sql1 = "SELECT * FROM rating WHERE venue_id = :venue_id ORDER BY rate_id DESC LIMIT $offset, $no_of_records_per_page";
                    
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
                                <?php } } } ?>


                                <ul class="pagination">
                                    <li><a href="?pageno=1&event_id=<?php echo $_GET[ 'event_id' ]; ?>&venue_id=<?php echo $_GET[ 'venue_id' ]; ?>">First</a></li>
                                    <li class="<?php if($pageno <= 1){ echo 'disabled'; } ?>">
                                        <a href="<?php if($pageno <= 1){ echo '#'; } else { echo "?pageno=".($pageno - 1) ."&event_id=" . $event_id . "&venue_id=" . $venue_id; } ?>">Prev</a>
                                    </li>
                                    <li class="<?php if($pageno >= $total_pages){ echo 'disabled'; } ?>">
                                        <a href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo "?pageno=".($pageno + 1)."&event_id=" . $event_id . "&venue_id=" . $venue_id; } ?>">Next</a>
                                    </li>
                                    <li><a href="?pageno=<?php echo $total_pages; ?>&event_id=<?php echo $_GET[ 'event_id' ]; ?>&venue_id=<?php echo $_GET[ 'venue_id' ]; ?>">Last</a></li>
                                </ul>

                                   <div class="review-submission">
										<h3 class="tab-title">Submit your review</h3>
                                        <!-- Rate -->
                                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>&event_id=<?php echo $_GET[ 'event_id' ]; ?>&venue_id=<?php echo $_GET[ 'venue_id' ]; ?>" class="row" method="post">
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
													<button type="submit" class="btn btn-main">Sumbit</button>
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
		</div>
	</div>
	<!-- Container End -->
</section>




  <div style="overflow:auto;">
    <div >
      <!--<button type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button>-->
      <a href="see_venue.php?event_id=<?php echo $_GET[ 'event_id' ] ?>&venue_id=<?php echo $_GET[ 'venue_id' ] ?>"><button type="button" style="color:white;width:200px;cursor:pointer;margin-left:700px;margin-bottom:100px;">Back</button></a>
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