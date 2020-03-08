<!DOCTYPE html>
<!--<html class="menu">-->
<html>
<style type="text/css">
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

</style>​ 
<?php include '../head.php'; 


require_once "../config.php";

session_start();

if( !isset($_SESSION['username']) ){
	header("location: ../log/login.php"); // send to login page
	exit; 
 }
 

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


    // Check input errors before inserting in database
	if( empty($_POST["id"]) ){
	$sql = "INSERT INTO venues (venue_name, venue_capacity, venue_rent_price, venue_rate, venue_address, venue_phone, venue_observations, venue_type, venue_gmaps, venue_status) VALUES (:venue_name, :venue_capacity, :venue_rent_price, :venue_rate, :venue_address, :venue_phone, :venue_observations, :venue_type, :venue_gmaps, :venue_status)";
	if( $stmt = $pdo->prepare($sql)  ){
		// Bind variables to the prepared statement as parameters
		$stmt->bindParam(":venue_name", $param_name);
		$stmt->bindParam(":venue_capacity", $venue_capacity);
		$stmt->bindParam(":venue_rent_price", $venue_rent_price);
		$stmt->bindParam(":venue_rate", $venue_rate);
		$stmt->bindParam(":venue_address", $venue_address);
		$stmt->bindParam(":venue_phone", $venue_phone);
		$stmt->bindParam(":venue_observations", $venue_observations);
		$stmt->bindParam(":venue_gmaps", $venue_gmaps);
		$stmt->bindParam(":venue_type", $venue_type);
		$stmt->bindParam(":venue_status", $venue_status);
		
		// Set parameters
		$param_name = $input_name;
		$venue_capacity = $input_capacity;
		$venue_rent_price = $input_price;
		$venue_rate = 0;
		$venue_address = $input_address;
		$venue_phone = $input_phone;
		$venue_observations = $input_observations;
		$venue_type = $input_type;
		if( !empty($input_gmaps) ){
			$venue_gmaps = $input_gmaps;
		}
		else{
			$venue_gmaps = '';
		}
		$venue_status = 'available';
		
		// Attempt to execute the prepared statement
		if($stmt->execute()){
			// Records created successfully. Redirect to landing page
			//$_SESSION["username"] = $param_email;
			//header("location: ../plan.php");
			//exit();

			$last_id = $pdo->lastInsertId();
		} else{
			echo "Something went wrong. Please try again later.";
		}
	}
	 
	// Close statement
	
	unset($stmt);

	$allowed = array("jpeg", "gif", "png", "jpg");
	// Count total files
	$countfiles = count($_FILES['file']['name']);
	
	// Looping all files
	for($i=0;$i<$countfiles;$i++){
	 $filename = $_FILES['file']['name'][$i];
	 $info = pathinfo($filename);
	 if(in_array($info["extension"], $allowed)) {
		
	
		// Upload file
		move_uploaded_file($_FILES['file']['tmp_name'][$i],'images/'.$filename);
	
		$sql = "INSERT INTO venue_files (venue_id, file_name) VALUES (:venue_id, :file_name)";
		if( $stmt = $pdo->prepare($sql)  ){
			// Bind variables to the prepared statement as parameters
			$stmt->bindParam(":venue_id", $param_id);
			$stmt->bindParam(":file_name", $file_name);
			
			// Set parameters
			$param_id = $last_id;
			$file_name = $filename;
			
			// Attempt to execute the prepared statement
			if($stmt->execute()){
				// Records created successfully. Redirect to landing page
				//$_SESSION["username"] = $param_email;
				//header("location: ../plan.php");
				//exit();
			} else{
				echo "Something went wrong. Please try again later.";
			}
		}
		 
		// Close statement
		
		unset($stmt);
	
	}
	 }
	}
	else{
		$sql = "UPDATE venues SET venue_name = :venue_name, venue_capacity = :venue_capacity, venue_rent_price = :venue_rent_price, venue_address = :venue_address, venue_phone = :venue_phone, venue_observations = :venue_observations, venue_type = :venue_type, venue_gmaps = :venue_gmaps WHERE venue_id = :venue_id";
	if( $stmt = $pdo->prepare($sql)  ){
		// Bind variables to the prepared statement as parameters
		$stmt->bindParam(":venue_name", $param_name);
		$stmt->bindParam(":venue_capacity", $venue_capacity);
		$stmt->bindParam(":venue_rent_price", $venue_rent_price);
		$stmt->bindParam(":venue_address", $venue_address);
		$stmt->bindParam(":venue_phone", $venue_phone);
		$stmt->bindParam(":venue_observations", $venue_observations);
		$stmt->bindParam(":venue_gmaps", $venue_gmaps);
		$stmt->bindParam(":venue_type", $venue_type);
		$stmt->bindParam(":venue_id", $venue_id);
		
		// Set parameters
		$param_name = $input_name;
		$venue_capacity = $input_capacity;
		$venue_rent_price = $input_price;
		$venue_address = $input_address;
		$venue_phone = $input_phone;
		$venue_observations = $input_observations;
		$venue_type = $input_type;
		if( !empty($input_gmaps) ){
			$venue_gmaps = $input_gmaps;
		}
		else{
			$venue_gmaps = '';
		}
		$venue_id = $_POST[ 'id' ];
		
		// Attempt to execute the prepared statement
		if($stmt->execute()){
			// Records created successfully. Redirect to landing page
			//$_SESSION["username"] = $param_email;
			//header("location: ../plan.php");
			//exit();

		} else{
			echo "Something went wrong. Please try again later.";
		}
	}
	 
	// Close statement
	
	unset($stmt);

	$sql = "DELETE FROM venue_files WHERE venue_id= :venue_id";

	if( $stmt = $pdo->prepare($sql)  ){
		$stmt->bindParam(":venue_id", $param_id);
			
			// Set parameters
			$param_id = $_POST["id"];

			$stmt->execute();
	} else {
		echo "Error deleting record";
	}

	unset($stmt);

	$allowed = array("jpeg", "gif", "png", "jpg");
	// Count total files
	$countfiles = count($_FILES['file']['name']);
	
	// Looping all files
	for($i=0;$i<$countfiles;$i++){
	 $filename = $_FILES['file']['name'][$i];
	 $info = pathinfo($filename);
	 if(in_array($info["extension"], $allowed)) {
		
	
		// Upload file
		move_uploaded_file($_FILES['file']['tmp_name'][$i],'images/'.$filename);
	
		$sql = "INSERT INTO venue_files (venue_id, file_name) VALUES (:venue_id, :file_name)";
		if( $stmt = $pdo->prepare($sql)  ){
			// Bind variables to the prepared statement as parameters
			$stmt->bindParam(":venue_id", $param_id);
			$stmt->bindParam(":file_name", $file_name);
			
			// Set parameters
			$param_id = $_POST["id"];
			$file_name = $filename;
			
			// Attempt to execute the prepared statement
			if($stmt->execute()){
				// Records created successfully. Redirect to landing page
				//$_SESSION["username"] = $param_email;
				//header("location: ../plan.php");
				//exit();
			} else{
				echo "Something went wrong. Please try again later.";
			}
		}
		 
		// Close statement
		
		unset($stmt);
	
	}
	 }
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

<li class="darkerlishadow" style="background-color:#ffcccc;">
<a href="wizard.php">
<i class="fas fa-hotel"></i>
<span class="nav-text">Venue</span>
</a>
</li>

<li class="darkerli">
<a href="food.php">
<i class="fas fa-utensils"></i>
<span class="nav-text">Food</span>
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

  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
  
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content" style="width:900px;margin-left:-190px;">
        <div class="modal-header" style="width:900px;">
          <button type="button" class="close" style="margin-left:830px;" data-dismiss="modal">&times;</button>
        
        </div>
        <div class="modal-body" style="width:900px;">
			<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="form-container" enctype='multipart/form-data'>
			<!-- <div class="fetched-data" style="color:black;"></div>  -->
				<h1 style = "color:black;">Add venue</h1>
				
				<div class="container">
  <div class="row text-center">
    <div class="col border-right" style="color:black;">
	  
	
				<input type="text" hidden name="id" id="id">
				<div class='div'>
					<span class='blocking-span'>
						<input type="text" class="js-example-placeholder-single form-control js-example-responsive" style="background-color:#f1f1f1;height:55px;margin: 5px 0 18px 0;border: none;" class="inputText" name="name" id="name" required>
						<span class="floating-label" style = "color:grey;padding-top: 12px;">Venue Name <span style="color:red"> *</span></span>
					</span>
				</div>
				<div class='div'>
					<span class='blocking-span'>
						<input class="js-example-placeholder-single form-control js-example-responsive" style="background-color:#f1f1f1;padding: 12px;height:55px;margin: 5px 0 18px 0;border: none;" type="number" name="capacity" id="capacity" required>
						<span class="floating-label" style = "color:grey;padding-top: 12px;">Capacity <span style="color:red"> *</span></span>
					</span>
				</div>
				<div class='div'>
					<span class='blocking-span'>
						<input class="js-example-placeholder-single form-control js-example-responsive" style="background-color:#f1f1f1;padding: 12px;margin: 5px 0 18px 0;border: none;" type="number" name="price" step="0.1" id="price" required>
						<span class="floating-label" style = "color:grey;padding-top: 12px;">Venue Price <span style="color:red"> *</span></span>
					</span>
				</div>
				<div class='div'>
					<span class='blocking-span'>
						<input class="js-example-placeholder-single form-control js-example-responsive" style="background-color:#f1f1f1;padding: 12px;margin: 5px 0 18px 0;border: none;" type="text" name="address" id="address" required>
						<span class="floating-label" style = "color:grey;padding-top: 12px;">Address <span style="color:red"> *</span> <span style="color:#b8b894;">(street, number, building)</span></span>
					</span>
				</div>
				<div class='div'>
					<span class='blocking-span'>
						<input class="js-example-placeholder-single form-control js-example-responsive" style="background-color:#f1f1f1;padding: 12px;margin: 5px 0 18px 0;border: none;" type="text" name="phone" id="phone" required>
						<span class="floating-label" style = "color:grey;padding-top: 12px;">Phone <span style="color:red"> *</span></span>
					</span>
				</div>
				<div class='div'>
					<span class='blocking-span'>
						<select class="input js-example-placeholder-single js-example-responsive" name="type" style="background-color:#f1f1f1;border-radius:4px;height:50px;margin: 5px 0 22px 0;border: none;width:100%;" id="type" required>
							<option disabled="disabled" selected="selected" value="" style="background-color:#f1f1f1;padding: 12px;margin: 5px 0 18px 0;border: none;"></option>
							<option value="outdoor" style="background-color:#f1f1f1;padding: 12px;margin: 5px 0 18px 0;">Outdoor</option>
							<option value="indoor" style="background-color:#f1f1f1;padding: 12px;margin: 5px 0 18px 0;border: none;">Indoor</option>
							<option value="both" style="background-color:#f1f1f1;padding: 12px;margin: 5px 0 18px 0;border: none;">Outdoor & Indoor</option>
						</select>
						<span class="floating-label" style = "color:grey;padding-top: 12px;">Type <span style="color:red"> *</span></span>
					</span>
				</div>
				<div class='div'>
					<span class='blocking-span'>
						<textarea class="input js-example-placeholder-single js-example-responsive" style="background-color:#f1f1f1;padding: 12px;margin: 5px 0 18px 0;border: none;border-radius:4px;" rows="4" cols="57" name="observations" id="observations" required></textarea>
						<span class="floating-label" style = "color:grey;padding-top: 12px;">Observations <span style="color:red"> *</span></span>
					</span>
				</div>




    </div>
    <div class="col" style="color:black;">
	  <br> 

	  	<h3 style = "color:black;">Venue Virtual Tour</h3> <br>

	    <div class='div'>
			<span class='blocking-span'>
				<select id='dropdown' class="input js-example-placeholder-single js-example-responsive" name="gmaps_choose" style="background-color:#f1f1f1;border-radius:4px;height:50px;margin: 5px 0 22px 0;border: none;width:100%;" required>
					<option disabled="disabled" selected="selected" value="" style="background-color:#f1f1f1;padding: 12px;margin: 5px 0 18px 0;border: none;"></option>
					<option value="yes" style="background-color:#f1f1f1;padding: 12px;margin: 5px 0 18px 0;">Yes</option>
					<option value="no" style="background-color:#f1f1f1;padding: 12px;margin: 5px 0 18px 0;border: none;">No</option>
				</select>
				<span class="floating-label" style = "color:grey;padding-top: 12px;">Do you have gmaps street view? <span style="color:red"> *</span></span>
			</span>
		</div>

		<div class='div'>
			<span class='blocking-span'>
				<input id="textInput" type="text" class="js-example-placeholder-single form-control js-example-responsive" style="background-color:#f1f1f1;height:55px;border: none;margin-top:-10px;" class="inputText" name="gmaps" required>
				<span class="floating-label" style = "color:grey;padding-top: 12px;margin-top:-14px;">Gmaps link <span style="color:red"> *</span></span>
			</span>
		</div>

		<h3 style = "color:black;">Venue Photos</h3>

		<table>
   			<tr>
				<td>
					<div class="input-group mb-3 px-2 py-2 rounded-pill bg-white shadow-sm">
						<input id="upload" type="file" name="file[]" onchange="readURL(this);" class="form-control border-0" multiple="multiple" required>
						<i class="fa fa-cloud-upload mr-2 text-muted" id="iclass"></i><label id="upload-label" for="upload" class="font-weight-light text-muted">Choose files</label>
					</div>
				</td>
				<td style="width:5px;"></td>
				<td><a href="#" id="clear">&times;</a></td>
			</tr>
		</table>
		<span style="color:red;font-size:12px;">Only image files are allowed!</span>

		<!-- <input type="file" name="file[]" id="file" class="form-control" multiple> -->
		
		

        <!-- <div class="image-area mt-4"><img id="imageResult" src="#" alt="" class="img-fluid rounded shadow-sm mx-auto d-block"></div> -->


    </div>
  </div>
</div>
				<?php echo $_GET[ 'name' ]; ?>
				<button type="submit" class="btn">Add</button>
			</form>
        </div>
        <div class="modal-footer">
          <button type="button" style="background-color:red;" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  
  
  <div class="modal hide fade" id="modal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
      <div class="modal-dialog" style="width: 800px;margin-left: 180px;height:900px;">
        <div class="modal-content" style="width: 800px;margin-left: 180px;">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title" id="myModalLabel"></h4>
          </div>
          <div class="modal-body">

			<div class="response"></div>
			<div id='calendar'></div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
  
  

<?php if( $_SESSION[ 'username' ] == 'admin@yahoo.com' ){ ?>
<button type="button" class="open-button btn btn-info btn-lg" data-toggle="modal" data-target="#myModal" data-id="<?php echo 0; ?>"><div data-toggle="tooltip" title="Add Venue!" data-placement="top" style="font-size:42px;color:black;"><b>+</b></div></button>
<?php } ?>
        <form id="regForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <div style="background-color:#9999e6;background-size:cover;margin-top:-62px;margin-left:-40px;margin-right:-40px;height:250px;">
            <div style="height:70px;"></div>
		<h1 style="color:#1f1f2e;">Add venue</h1><br><br>

</div>
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
						<div class="col-xl-4 col-md-6 grid-item new">
							<div class="product">
								<div style="height:25px;"></div>
								<div class="product_image"><img src='http://localhost/git/bachelor/start_admin/images/<?php echo $file_name; ?>' height="350" width="442"> </div>
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
												<?php if( $_SESSION[ 'username' ] == 'admin@yahoo.com' ){ ?>
													<a href="see_venue.php?venue_id=<?php echo $venue[ 'venue_id' ] ?>" data-toggle="modal" data-target="#myModal" data-id="<?php echo $venue[ 'venue_id' ] ?>"><div class="plus" data-toggle="tooltip" title="Edit venue!" data-placement="top"><div class="plus"><img src="images/eye_2.png" class="svg" alt="" data-toggle="tooltip" title="Edit venue!" data-placement="top" height="40"><div class="plus">+</a></div></div></div>
												<?php } else { ?>
													<a href="see_venue.php?venue_id=<?php echo $venue[ 'venue_id' ] ?>"><div class="plus" data-toggle="tooltip" title="See details!" data-placement="top"><div class="plus"><img src="images/eye_2.png" class="svg" alt="" data-toggle="tooltip" title="See details!" data-placement="top" height="40"><div class="plus">+<</a>/div></div></div>
												<?php } ?>
											</div>
											<div class="product_button product_cart text-center d-flex flex-column align-items-center justify-content-center">
												<?php if( $_SESSION[ 'username' ] == 'admin@yahoo.com' ){ ?>
													<a href="choose_venue.php" class="disabled" onclick="return false;"><div class="plus" data-toggle="tooltip" title="Choose this venue!" data-placement="top"><div class="plus"><img src="images/cart.png" class="svg" alt="" data-toggle="tooltip" title="Choose this venue!" data-placement="top" height="40"><div class="plus">+</a></div></div></div>
												<?php } else { ?>
													<a href="choose_venue.php?venue_id=<?php echo $venue[ 'venue_id' ] ?>"><div class="plus" data-toggle="tooltip" title="Choose this venue!" data-placement="top"><div class="plus"><img src="images/cart.png" class="svg" alt="" data-toggle="tooltip" title="Choose this venue!" data-placement="top" height="40"><div class="plus">+</div></div></div></a>
												<?php }?>
											</div>
										</div>
									</div>
									<?php if( $_SESSION[ 'username' ] == 'admin@yahoo.com' ){ ?>
									<div class="product_buttons">
										<div class="text-right d-flex flex-row align-items-start justify-content-start">
											<div class="product_button product_fav text-center d-flex flex-column align-items-center justify-content-center">
												
												<a href="delete_venue.php?venue_id=<?php echo $venue[ 'venue_id' ] ?>" onclick="if (!confirm('Are you sure you want to delete?')) { return false; }"><div class="plus" data-toggle="tooltip" title="Delete venue!" data-placement="top"><div class="plus"><img src="images/trash.png" class="svg" alt="" data-toggle="tooltip" title="Delete venue!" data-placement="top" height="40"><div class="plus">-</a></div></div></div>
												
											</div>
											<div class="product_button product_cart text-center d-flex flex-column align-items-center justify-content-center">
												
												<a href="add_dates.php?venue_id=<?php echo $venue[ 'venue_id' ] ?>" data-toggle="modal" data-target="#modal1" data-id="<?php echo $venue[ 'venue_id' ] ?>"><div class="plus" data-toggle="tooltip" title="Add booked dates!" data-placement="top"><div class="plus"><img src="images/calendar.png" class="svg" alt="" data-toggle="tooltip" title="Add booked dates!" data-placement="top" height="40"><div class="plus">+</a></div></div></div>
												
											</div>
										</div>
									</div>
									<?php } ?>
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


			<script src="fullcalendar/lib/moment.min.js"></script>
			<script src="fullcalendar/fullcalendar.min.js"></script>

<script>

	$(document).ready(function() {
	
	$('#dropdown').change(function() {
	if( $(this).val() == 'yes') {
			$('#textInput').prop( "disabled", false );
	} else {       
		$('#textInput').val( '' );
	$('#textInput').prop( "disabled", true );
	}
	});

	});

	// upload
	function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#imageResult')
                .attr('src', e.target.result);
        };
        reader.readAsDataURL(input.files[0]);
    }
}

$(function () {
    $('#upload').on('change', function () {
        readURL(input);
    });
});

/*  ==========================================
    SHOW UPLOADED IMAGE NAME
* ========================================== */
var input = document.getElementById( 'upload' );
var infoArea = document.getElementById( 'upload-label' );


input.addEventListener( 'change', showFileName );
function showFileName( event ) {
  var input = event.srcElement;
  var fileName = input.files[0].name;

  var files = $(this)[0].files;
         if(files.length > 1){
			 infoArea.textContent = files.length + ' files';
		 }
		 else{
			 infoArea.textContent = 'File name: ' + fileName;
		 }
  $("#iclass").hide();
}


// Referneces
var control = $("#upload"),
    clearBn = $("#clear");

// Setup the clear functionality
clearBn.on("click", function(){
    infoArea.textContent = 'Choose files';
	$("#iclass").show();
	$('#imageResult').attr('src','');
	input.val('');
});

// Some bound handlers to preserve when cloning
control.on({
    change: function(){ console.log( "Changed" ) },
     focus: function(){ console.log(  "Focus"  ) }
});


$(document).ready(function(){
    $('#myModal').on('show.bs.modal', function (e) {
        var rowid = $(e.relatedTarget).data('id');
        $.ajax({
            type : 'post',
            url : 'fetch_record.php', //Here you will fetch records 
            data :  'rowid='+ rowid, //Pass $id
            success : function(data){
            //$('.fetched-data').html(data);//Show fetched data from database
			//testValue.toString().replaceAll("\"", "");
			//x={age:"clar"};
			//alert(data);
			//alert(x);
			var myObj = JSON.parse(data);
			$('#id').val(myObj.id);
			$('#name').val(myObj.name);
			$('#capacity').val(myObj.capacity);
			$('#price').val(myObj.price);
			$('#address').val(myObj.address);
			$('#phone').val(myObj.phone);
			$('#type').val(myObj.type);
			$('#observations').val(myObj.observations);
			$('#dropdown').val(myObj.gmaps_choose);
			$('#textInput').val(myObj.gmaps);
			if( $('#dropdown').val() == 'no') {
				$('#textInput').prop( "disabled", true );
			} else {
				$('#textInput').prop( "disabled", false );
			}
			$('#dropdown').change(function() {
			if( $(this).val() == 'yes') {
					$('#textInput').prop( "disabled", false );
			} else {       
				$('#textInput').val( '' );
			$('#textInput').prop( "disabled", true );
			}
			});
			
            }
        });
     });
});
$('#myModal').on('hidden.bs.modal', function () {
    $(this).find('form').trigger('reset');
})

//caledarr

$('#modal1').on('show.bs.modal', function (e) {
	var rowid = $(e.relatedTarget).data('id');
	//alert("fetch-event.php?venue_id="+rowid);
    calendar = $('#calendar').fullCalendar({
		contentHeight: 400,
        editable: true,
        events: "fetch-event.php?venue_id="+rowid,
	// 	var events = {
    //     url: "fetch-event.php",
    //     type: 'POST',
    //     data: {
    //         venue_id: $(e.relatedTarget).data('id')
    //     }
    // },
        displayEventTime: false,
        eventRender: function (event, element, view) {
            if (event.allDay === 'true') {
                event.allDay = true;
            } else {
                event.allDay = false;
            }
        },
        selectable: true,
        selectHelper: true,
        select: function (start, end, allDay) {
            var title = prompt('Event Title:');
            if (title) {
                var start = $.fullCalendar.formatDate(start, "Y-MM-DD HH:mm:ss");
                var end = $.fullCalendar.formatDate(end, "Y-MM-DD HH:mm:ss");

                $.ajax({
                    url: 'add-event.php',
                    data: 'title=' + title + '&start=' + start + '&end=' + end + '&venue_id=' + rowid,
                    type: "POST",
                    success: function (data) {
						$('#calendar').fullCalendar('option', 'height', 800);
                        displayMessage("Added Successfully");
                    }
                });
                calendar.fullCalendar('renderEvent',
                        {
                            title: title,
                            start: start,
                            end: end,
                            allDay: allDay
                        },
                true
                        );
            }
            calendar.fullCalendar('unselect');
        },
        editable: true,
				eventDrop: function (event, delta) {
                    var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
                    var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
                    $.ajax({
                        url: 'edit-event.php',
                        data: 'title=' + event.title + '&start=' + start + '&end=' + end + '&id=' + event.id + '&venue_id=' + rowid,
                        type: "POST",
                        success: function (response) {
							$('#calendar').fullCalendar('option', 'height', 800);
                            displayMessage("Updated Successfully");
                        }
                    });
                },
        eventClick: function (event) {
            var deleteMsg = confirm("Do you really want to delete?");
            if (deleteMsg) {
                $.ajax({
                    type: "POST",
                    url: "delete-event.php",
                    data: "&id=" + event.id,
                    success: function (response) {
                        if(parseInt(response) > 0) {
                            $('#calendar').fullCalendar('removeEvents', event.id);
							$('#calendar').fullCalendar('option', 'height', 800);
                            displayMessage("Deleted Successfully");
                        }
                    }
                });
            }
        }

    });
});
$('#modal1').on('hidden.bs.modal', function () {
	$('#calendar').fullCalendar('destroy');  
})


</script>
        
</body>
</html>