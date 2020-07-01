<!DOCTYPE html>
<html lang="en">
<?php include '../head.php'; 

require_once "../config.php";

session_start();

if (!isset($_GET['status'])) {
    $sql = "SELECT * FROM events WHERE user_id = :user_id";
        
    if($stmt = $pdo->prepare($sql)){
        // Bind variables to the prepared statement as parameters
        $stmt->execute(['user_id' => $_SESSION[ 'id' ]]); 
        $user = $stmt->fetch();
        
        // Attempt to execute the prepared statement
        
        if($stmt->rowCount() > 0){
                header("location: choice.php");
                exit();
            } 
        }
    }




$eventType_err = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Validate username
	$input_eventType = $_POST["eventType"];
    if($input_eventType == "Select an event"){
		$eventType_err = "Select an event.";
    } else{
        $eventType = $input_eventType;
    }
    

    if(empty($eventType_err)){
		$sql = "INSERT INTO events (user_id, event_type, event_need_venue, event_need_ceremony, event_date, ceremony_date, event_stage, event_status) VALUES (:user_id, :event_type, :event_need_venue, :event_need_ceremony, :event_date, :ceremony_date, :event_stage, :event_status)";
        if( $stmt = $pdo->prepare($sql)  ){
            // Bind variables to the prepared statement as parameters
			$stmt->bindParam(":user_id", $param_user_id);
            $stmt->bindParam(":event_type", $param_eventType);
            $stmt->bindParam(":event_need_venue", $param_need_venue);
            $stmt->bindParam(":event_need_ceremony", $param_need_ceremony);
            $stmt->bindParam(":event_date", $param_date);
            $stmt->bindParam(":ceremony_date", $param_ceremony_date);
            $stmt->bindParam(":event_stage", $param_stage);
			$stmt->bindParam(":event_status", $param_status);
            
            // Set parameters
			$param_user_id = $_SESSION["id"];
            $param_eventType = $eventType;
            $param_need_venue = '';
            $param_need_ceremony = '';
            $param_date = '';
            $param_ceremony_date = '';
            $param_stage = 'budget';
			$param_status = 'preparing';
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
				// Records created successfully. Redirect to landing page
                
                $last_id = $pdo->lastInsertId();
                header("location: pages.php?event_id=$last_id");
                exit();
            } else{
                echo "Something went wrong. Please try again later.";
            }
        }
         
		// Close statement
		
        unset($stmt);
	} 
	
    // Close connection
    unset($pdo);
}

?>
<body>
	<div class="container-login100" style="background-image: url('https://static.tumblr.com/94eb957a00fd03c0c2f7d26decd71578/u1rhacw/osAmyyh1q/tumblr_static_tumblr_static_gaussian_blur_gradient_desktop_1680x943_wallpaper-393751.jpg');">
		<div class="wrap-login100 p-l-55 p-r-55 p-t-80 p-b-30">
			<form autocomplete="off" class="login100-form validate-form" action="<?php if( !isset($_GET['status']) ) echo htmlspecialchars($_SERVER["PHP_SELF"]); else echo htmlspecialchars($_SERVER["PHP_SELF"] . '?status=new'); ?>" method="post">
				<span class="login100-form-title p-b-37">
					What event are you planning?
				</span>
                
                <select class="js-example-placeholder-single form-control js-example-responsive" name="eventType">
                    <option name="eventType">Select an event</option>
                    <option name="eventType">Wedding</option>
                    <option name="eventType">Christening</option>
                    <option name="eventType">Birthday party</option>
                    <option name="eventType">Office party</option>
                    <option name="eventType">Ball</option>
                </select> 
                <div style="color:red;"><?php echo $eventType_err; ?></div>

                <div style="height:40px;"></div>

				<div class="container-login100-form-btn">
					<button class="login100-form-btn">
						Great! Go to the next step!
					</button>
				</div>
			</form>

			
		</div>
	</div>
	
	

	<div id="dropDownSelect1"></div>
	
	<script src="../vendor/jquery/jquery-3.2.1.min.js"></script>
	<script src="../vendor/animsition/js/animsition.min.js"></script>
	<script src="../vendor/bootstrap/js/popper.js"></script>
	<script src="../vendor/bootstrap/js/bootstrap.min.js"></script>
	<script src="../vendor/select2/select2.min.js"></script>
	<script src="../vendor/daterangepicker/moment.min.js"></script>
	<script src="../vendor/daterangepicker/daterangepicker.js"></script>
	<script src="../vendor/countdowntime/countdowntime.js"></script>
    <script src="../js/main.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
	<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
	<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>

    <script>
        $(".js-example-placeholder-single").select2({
            placeholder: "Select an event",
            allowClear: true
        });
        var select2 = $(".js-example-placeholder-single").select2();
        select2.data('select2').$selection.css('height', '35px');
        select2.data('select2').$selection.css('background-color', '#ffccff');
        select2.data('select2').$selection.css('font-size', '20px');
        select2.data('select2').$selection.css('font-family', 'Fira Sans');
        select2.data('select2').$selection.css('padding', '2px');


     

    </script>
    
    

</body>
</html>