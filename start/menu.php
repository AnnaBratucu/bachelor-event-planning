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
  margin-top:-100px;
}

.wiz{
	
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

#snackbar1 {
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

#snackbar1.show {
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
    $input_venue = $_POST["ven"];
	$input_price = $_POST["price"];
	$input_category = $_POST["categ"];
	$input_ingredents = $_POST["ingredients"];
	$input_grams = $_POST["grams"];
	

    // Check input errors before inserting in database
	if( empty($_POST["id"]) ){
	$sql = "INSERT INTO food (venue_id, food_category, food_name, food_price, food_ingredients, food_grams) VALUES (:venue_id, :food_category, :food_name, :food_price, :food_ingredients, :food_grams)";
	if( $stmt = $pdo->prepare($sql)  ){
		// Bind variables to the prepared statement as parameters
		$stmt->bindParam(":venue_id", $param_venue);
		$stmt->bindParam(":food_category", $param_category);
		$stmt->bindParam(":food_name", $param_name);
		$stmt->bindParam(":food_price", $param_price);
		$stmt->bindParam(":food_ingredients", $param_ingredients);
		$stmt->bindParam(":food_grams", $param_grams);
		
		// Set parameters
		$param_venue = $input_venue;
		$param_category = $input_category;
		$param_name = $input_name;
		$param_price = $input_price;
		$param_ingredients = $input_ingredents;
		$param_grams = $input_grams;
		
		
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
	
		$sql = "INSERT INTO food_files (food_id, file_name) VALUES (:food_id, :file_name)";
		if( $stmt = $pdo->prepare($sql)  ){
			// Bind variables to the prepared statement as parameters
			$stmt->bindParam(":food_id", $param_id);
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
		$sql = "UPDATE food SET venue_id = :venue_id, food_category = :food_category, food_name = :food_name, food_price = :food_price, food_ingredients = :food_ingredients, food_grams = :food_grams WHERE food_id = :food_id";
	if( $stmt = $pdo->prepare($sql)  ){
		// Bind variables to the prepared statement as parameters
		$stmt->bindParam(":venue_id", $param_venue);
		$stmt->bindParam(":food_category", $param_category);
		$stmt->bindParam(":food_name", $param_name);
		$stmt->bindParam(":food_price", $param_price);
		$stmt->bindParam(":food_ingredients", $param_ingredients);
		$stmt->bindParam(":food_grams", $param_grams);
	
		$stmt->bindParam(":food_id", $param_id);
		
		// Set parameters
		$param_venue = $input_venue;
		$param_category = $input_category;
		$param_name = $input_name;
		$param_price = $input_price;
		$param_ingredients = $input_ingredents;
		$param_grams = $input_grams;
		
		$param_id = $_POST[ 'id' ];
		
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

	$sql = "DELETE FROM food_files WHERE food_id= :food_id";

	if( $stmt = $pdo->prepare($sql)  ){
		$stmt->bindParam(":food_id", $param_id);
			
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
	
		$sql = "INSERT INTO food_files (food_id, file_name) VALUES (:food_id, :file_name)";
		if( $stmt = $pdo->prepare($sql)  ){
			// Bind variables to the prepared statement as parameters
			$stmt->bindParam(":food_id", $param_id);
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
<div class="wiz">
<?php 
require_once '../menu.php'; 
?>

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
				<h1 style = "color:black;">Add course</h1>
				
				<div class="container">
  <div class="row text-center">
    <div class="col border-right" style="color:black;">
				<input type="text" hidden name="id" id="id">
				<div class='div'>
					<span class='blocking-span'>
						<select class="input js-example-placeholder-single js-example-responsive" name="ven" style="background-color:#f1f1f1;border-radius:4px;height:50px;margin: 5px 0 22px 0;border: none;width:100%;" id="ven" required>
							<option disabled="disabled" selected="selected" value="" style="background-color:#f1f1f1;padding: 12px;margin: 5px 0 18px 0;border: none;"></option>
							<?php
							$sql = "SELECT * FROM venues";
							if($stmt = $pdo->prepare($sql)){
								
								$stmt->execute();

								while ($venues = $stmt->fetch()) { 
								?>
									<option value="<?= $venues[  'venue_id' ] ?>" style="background-color:#f1f1f1;padding: 12px;margin: 5px 0 18px 0;"><?= $venues[ 'venue_name' ] ?></option>

								<?php
								}
							}
							?>
						</select>
						<span class="floating-label" style = "color:grey;padding-top: 12px;">Venue <span style="color:red"> *</span></span>
					</span>
				</div>
				<div class='div'>
					<span class='blocking-span'>
						<input type="text" class="js-example-placeholder-single form-control js-example-responsive" style="background-color:#f1f1f1;height:55px;margin: 5px 0 18px 0;border: none;" class="inputText" name="name" id="name" required>
						<span class="floating-label" style = "color:grey;padding-top: 12px;">Course Name <span style="color:red"> *</span></span>
					</span>
				</div>
				<div class='div'>
					<span class='blocking-span'>
						<select class="input js-example-placeholder-single js-example-responsive" name="categ" style="background-color:#f1f1f1;border-radius:4px;height:50px;margin: 5px 0 22px 0;border: none;width:100%;" id="categ" required>
							<option disabled="disabled" selected="selected" value="" style="background-color:#f1f1f1;padding: 12px;margin: 5px 0 18px 0;border: none;"></option>
							<option value="starters" style="background-color:#f1f1f1;padding: 12px;margin: 5px 0 18px 0;">Starters</option>
							<option value="salad" style="background-color:#f1f1f1;padding: 12px;margin: 5px 0 18px 0;border: none;">Salad</option>
							<option value="entree" style="background-color:#f1f1f1;padding: 12px;margin: 5px 0 18px 0;border: none;">Entree</option>
							<option value="dessert" style="background-color:#f1f1f1;padding: 12px;margin: 5px 0 18px 0;border: none;">Dessert</option>
						</select>
						<span class="floating-label" style = "color:grey;padding-top: 12px;">Category <span style="color:red"> *</span></span>
					</span>
				</div>
				<div class='div'>
					<span class='blocking-span'>
						<input class="js-example-placeholder-single form-control js-example-responsive" style="background-color:#f1f1f1;padding: 12px;margin: 5px 0 18px 0;border: none;" type="number" name="price" step="0.1" id="price" required>
						<span class="floating-label" style = "color:grey;padding-top: 12px;">Course Price per portion <span style="color:red"> *</span></span>
					</span>
				</div>
				<div class='div'>
					<span class='blocking-span'>
						<input class="js-example-placeholder-single form-control js-example-responsive" style="background-color:#f1f1f1;padding: 12px;height:55px;margin: 5px 0 18px 0;border: none;" type="number" name="grams" id="grams" required>
						<span class="floating-label" style = "color:grey;padding-top: 12px;">Grams per portion <span style="color:red"> *</span></span>
					</span>
				</div>
				<div class='div'>
					<span class='blocking-span'>
						<input class="js-example-placeholder-single form-control js-example-responsive" style="background-color:#f1f1f1;padding: 12px;margin: 5px 0 18px 0;border: none;" type="text" name="ingredients" id="ingredients" required>
						<span class="floating-label" style = "color:grey;padding-top: 12px;">Ingredents <span style="color:red"> *</span> </span>
					</span>
				</div>
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
    </div>
  </div>
</div>
				<?php //echo $_GET[ 'name' ]; ?>
				<button type="submit" class="btn">Add</button>
			</form>
        </div>
        <div class="modal-footer">
          <button type="button" style="background-color:red;" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  
  
  <!-- <div class="modal hide fade" id="modal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
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
    </div> -->
  
  

<?php if( $_SESSION[ 'username' ] == 'admin@yahoo.com' ){ ?>
<button type="button" class="open-button btn btn-info btn-lg" data-toggle="modal" data-target="#myModal" data-id="<?php echo 0; ?>"><div data-toggle="tooltip" title="Add Venue!" data-placement="top" style="font-size:42px;color:black;"><b>+</b></div></button>
<?php } ?>
            <div style="background-image:url('../images/menu.jpg');background-size:cover;margin-top:-925px;margin-left:-40px;margin-right:-40px;height:300px;">
            <div style="height:70px;"></div>
			<?php if( $_SESSION[ 'username' ] == 'admin@yahoo.com' ){ ?>
				<h1 style="color:white">Add courses</h1><br><br>
			<?php } else{ ?>
				<h1 style="color:white">Available courses</h1><br><br>
			<?php } ?>
				</div>
				<!-- <div class="row" style="margin-left:80px;">
					<div class="column">
						<?php if( isset( $_GET[ 'message' ] ) ){ ?>
							<div class="isa_error">
								<i class="fa fa-times-circle"></i>
								<?php echo $_GET[ 'message' ] ?>
							</div>
						<?php } ?>
					</div>
				</div> -->
				
			
			<form id="regForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
<div class="products" style="margin-top:-90px;">
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

if( $_SESSION['username'] != 'admin@yahoo.com' ){
	$sql = "SELECT * FROM users_profile WHERE event_id = :event_id AND user_id = :user_id";
    
	if($stmt = $pdo->prepare($sql)){
		// Bind variables to the prepared statement as parameters
		$stmt->bindParam(":event_id", $param_id);
		$stmt->bindParam(":user_id", $param_user);
		
		// Set parameters
		$param_id = $_GET[ 'event_id' ];
		$param_user = $_SESSION[ 'id' ];
		
		// Attempt to execute the prepared statement
  $stmt->execute();
  $profile = $stmt->fetch();
  $venue_id = $profile[ 'venue_id' ];
	
}
}


			
			if( $_SESSION['username'] == 'admin@yahoo.com' ){
					$sql = "SELECT * FROM food";
			}else{
				$event_id = $_GET[ 'event_id' ];
				$sql = "SELECT m.*,f.*,f.food_id AS foodid FROM menu m
				LEFT JOIN food f ON m.food_id = f.food_id
				 WHERE m.event_id =$event_id";
			}
					if($stmt = $pdo->query($sql)){
						// Bind variables to the prepared statement as parameters
						
						$total = $stmt->rowCount();
						$lastPage = ceil($total/$showRecordPerPage);
						$firstPage = 1;
						$nextPage = $currentPage + 1;
						$previousPage = $currentPage - 1;
				if($_SESSION['username'] == 'admin@yahoo.com'){
						$sql2 = "SELECT * FROM food WHERE 1
						" . ( isset($_SESSION[ 'food_search_category' ]) && $_SESSION[ 'food_search_category' ] != '' ? " AND food_category = '" . $_SESSION[ 'food_search_category' ] . "'"  : "" ) . "
						 LIMIT $startFrom, $showRecordPerPage";
				}else{
					$sql2 = "SELECT m.*,f.*,f.food_id AS foodid FROM menu m
							LEFT JOIN food f ON m.food_id = f.food_id
							WHERE m.event_id =$event_id
							GROUP BY f.food_id
							LIMIT $startFrom, $showRecordPerPage";
				}
				
						if($stmt2 = $pdo->query($sql2)){

						while($venue = $stmt2->fetch()) {
							
							$sql1 = "SELECT * FROM food_files WHERE food_id = :food_id LIMIT 1";
        
							if($stmt1 = $pdo->prepare($sql1)){
								// Bind variables to the prepared statement as parameters
								$stmt1->execute(['food_id' => $venue[ 'foodid' ]]); 
								$venue_file = $stmt1->fetch();
								$file_name = $venue_file["file_name"];
								
							
								}



								$sql = "SELECT * FROM menu WHERE event_id = :event_id AND food_id = :food_id";
    
								if($stmt = $pdo->prepare($sql)){
									// Bind variables to the prepared statement as parameters
									$stmt->bindParam(":event_id", $param_id);
									$stmt->bindParam(":food_id", $param_food);
									
									// Set parameters
									$param_id = $_GET[ 'event_id' ];
									$param_food = $venue[ 'food_id' ];
									
									// Attempt to execute the prepared statement
										$stmt->execute();
										$food = $stmt->fetch();
										$food_count = $stmt->rowCount();
								
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
												<div class="product_name"><a href="../start/see_food.php?food_id=<?php echo $venue[ 'food_id' ] ?>&event_id=<?php echo $_GET[ 'event_id' ] ?>"><?= $venue[ 'food_name' ] ?></a></div>
												<div class="product_category">Category: <?= $venue[ 'food_category' ] ?></a></div>
												<?php if( $food_count > 0 ){ ?><div style="color:red;">CHOSEN</div><?php } ?>
											</div>
										</div>
										<div class="ml-auto text-right">
											
											<div class="product_price text-right">$<?= $venue[ 'food_price' ] ?></span></div>
										</div>
									</div>
									<div class="product_buttons">
										<div class="text-right d-flex flex-row align-items-start justify-content-start">
											<div class="product_button product_fav text-center d-flex flex-column align-items-center justify-content-center">
												<?php if( $_SESSION[ 'username' ] == 'admin@yahoo.com' ){ ?>
													<a href="see_food.php?food_id=<?php echo $venue[ 'food_id' ] ?>" data-toggle="modal" data-target="#myModal" data-id="<?php echo $venue[ 'food_id' ] ?>"><div class="plus" data-toggle="tooltip" title="Edit venue!" data-placement="top"><div class="plus"><img src="images/eye_2.png" class="svg" alt="" data-toggle="tooltip" title="Edit venue!" data-placement="top" height="40"><div class="plus">+</a></div></div></div>
												<?php } else { ?>
													<a href="../start/see_food.php?food_id=<?php echo $venue[ 'food_id' ] ?>&event_id=<?php echo $_GET[ 'event_id' ] ?>"><div class="plus" data-toggle="tooltip" title="See details!" data-placement="top"><div class="plus"><img src="../start_admin/images/eye_2.png" class="svg" alt="" data-toggle="tooltip" title="See details!" data-placement="top" height="40"><div class="plus">+</a></div></div></div>
												<?php } ?>
											</div>
											<div class="product_button product_cart text-center d-flex flex-column align-items-center justify-content-center">
												<?php if( $_SESSION[ 'username' ] == 'admin@yahoo.com' ){ ?>
													<a href="choose_venue.php" class="disabled" onclick="return false;"><div class="plus" data-toggle="tooltip" title="Add to favorites!" data-placement="top"><div class="plus"><img src="images/heart_2.png" class="svg" alt="" data-toggle="tooltip" title="Add to favorites!" data-placement="top" height="40"><div class="plus">+</a></div></div></div>
												<?php } else { ?>
												<a href="../start/add_favourites.php?food_id=<?php echo $venue[ 'food_id' ] ?>&event_id=<?php echo $_GET[ 'event_id' ] ?>" onclick="if (!confirm('Are you sure you want to add to favourites?')) { return false;  }"><div class="plus" data-toggle="tooltip" title="Add to favorites!" data-placement="top"><div class="plus"><img src="../start_admin/images/heart_2.png" class="svg" alt="" data-toggle="tooltip" title="Add to favorites!" data-placement="top" height="40"><div class="plus">+</a></div></div></div>
												<div id="snackbar">Course added to favourites!</div>
												<div id="snackbar1">Course was already added to favourites!</div>

												<?php 
												$recordAdded = false;
												$recordAddedBefore = false;

												if(isset($_SESSION['status']) && $_SESSION['status'] == 5)
												{
													$recordAdded = true;
													unset($_SESSION['status']);
												}else if(isset($_SESSION['status']) && $_SESSION['status'] == 6){
													$recordAddedBefore = true;
													unset($_SESSION['status']);
												}

												if($recordAdded)
												{
												echo '
												<script type="text/javascript">
												
													var x = document.getElementById("snackbar");
													x.className = "show";
													setTimeout(function(){ x.className = x.className.replace("show", ""); }, 4000);
												
												</script>';
												} else if( $recordAddedBefore ){
													echo '
													<script type="text/javascript">
													
														var x = document.getElementById("snackbar1");
														x.className = "show";
														setTimeout(function(){ x.className = x.className.replace("show", ""); }, 4000);
													
													</script>';
												} ?>

												<?php }?>
											</div>
										</div>
									</div>
									<?php if( $_SESSION[ 'username' ] == 'admin@yahoo.com' ){ ?>
									<div class="product_buttons">
										<div class="text-right d-flex flex-row align-items-start justify-content-start">
											<div class="product_button product_fav text-center d-flex flex-column align-items-center justify-content-center">
												
												<a href="delete_food.php?food_id=<?php echo $venue[ 'food_id' ] ?>" onclick="if (!confirm('Are you sure you want to delete?')) { return false; }"><div class="plus" data-toggle="tooltip" title="Delete!" data-placement="top"><div class="plus"><img src="../start_admin/images/trash.png" class="svg" alt="" data-toggle="tooltip" title="Delete!" data-placement="top" height="40"><div class="plus">-</a></div></div></div>
												
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


							<?php 
							if( $_SESSION[ 'username' ] != 'admin@yahoo.com' ){
								if($currentPage != $firstPage) { ?>
									<li>
									<a href="?page=<?php echo $firstPage ?>&event_id=<?php echo $_GET[ 'event_id' ] ?>" tabindex="-1" aria-label="Previous">
									<span aria-hidden="true">First</span>
									</a>
									</li>
									<?php } ?>
									<?php if($currentPage >= 2) { ?>
									<li><a href="?page=<?php echo $previousPage ?>&event_id=<?php echo $_GET[ 'event_id' ] ?>"><?php echo $previousPage ?></a></li>
									<?php } ?>
									<li class="active"><a href="?page=<?php echo $currentPage ?>&event_id=<?php echo $_GET[ 'event_id' ] ?>"><?php echo $currentPage ?></a></li>
									<?php if($currentPage != $lastPage) { ?>
									<li><a href="?page=<?php echo $nextPage ?>&event_id=<?php echo $_GET[ 'event_id' ] ?>"><?php echo $nextPage ?></a></li>
									<li>
									<a href="?page=<?php echo $lastPage ?>&event_id=<?php echo $_GET[ 'event_id' ] ?>" aria-label="Next">
									<span aria-hidden="true">Last</span>
									</a>
									</li>
								<?php }
							}else{ 
								if($currentPage != $firstPage) {?>
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
							<?php }} ?>
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
            url : 'fetch_record_food.php', //Here you will fetch records 
            data :  'rowid='+ rowid, //Pass $id
            success : function(data){
            //$('.fetched-data').html(data);//Show fetched data from database
			//testValue.toString().replaceAll("\"", "");
			//x={age:"clar"};
			//alert(data);
			
			var myObj = JSON.parse(data);
			$('#id').val(myObj.id);
			$('#name').val(myObj.name);
			$('#ven').val(myObj.ven);
			$('#price').val(myObj.price);
			$('#categ').val(myObj.categ);
			$('#grams').val(myObj.grams);
			$('#ingredients').val(myObj.ingredients);
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
<?php include '../footer.php';  ?> 
</body>
</html>