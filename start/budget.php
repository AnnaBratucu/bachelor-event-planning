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

/* .products{
	background: white;
	
}
.container{
	background: white;
	
} */
.wiz{
	margin-top:-400px;
	position: relative;
}

.required:after { content:" *"; color:red;}
</style>​ 

<?php include '../head.php'; 

require_once "../config.php";

session_start();

$budget_err = $emergency_err = "";
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Validate username
    $input_budget = $_POST["budget"];
    if($input_budget == ''){
		$budget_err = "You must enter your budget";
    } else if( !is_numeric( $input_budget ) ){
        $budget_err = "You must enter the numeric sum";
    } else{
		$budget = $input_budget;
    }
    echo isset($_POST[ 'emergency' ]);
    if( $_POST[ 'emergency' ] != 0 ){
        $input_emergency = $_POST["emergency"];
        if( !is_numeric( $input_emergency ) ){
            $emergency_err = "You must enter the numeric sum";
        } else{
            $emergency = $input_emergency;
        }
    } 


    $sql = "SELECT * FROM events WHERE event_id = :event_id";
    
  if($stmt = $pdo->prepare($sql)){
      // Bind variables to the prepared statement as parameters
      $stmt->bindParam(":event_id", $param_id);
      
      // Set parameters
      $param_id = $_GET[ 'event_id' ];
      
      // Attempt to execute the prepared statement
        $stmt->execute();
        $eventt = $stmt->fetch();
        $stage = $eventt[ 'event_stage' ];
  
}
    
    if( $budget_err == '' && $emergency_err == '' ){
        $_SESSION[ 'budget' ] = $budget;
        $_SESSION[ 'emergency' ] = $emergency;

        
		$sql = "SELECT * FROM budget WHERE event_id = :event_id";
    
		if($stmt = $pdo->prepare($sql)){
			// Bind variables to the prepared statement as parameters
			$stmt->execute(['event_id' => $_GET[ 'event_id' ]]); 
			$user = $stmt->fetch();
			
			// Attempt to execute the prepared statement
			
			if($stmt->rowCount() > 0){
                if( $stage == 'guests' || $stage == 'ceremony' || $stage == 'venue' ){
                    $exists = 'true';
                }else{
                    $exists = 'add';
                    $bud = $user[ 'budget_value' ];
                    $emer = $user[ 'budget_emergency' ];
                    $budfi = $user[ 'budget_value_first' ];
                    $emerfi = $user[ 'budget_emergency_first' ];
                }
			} else{
				$exists = 'false';
            }
        
		}	

    if( $exists == 'false' ){
        $sql = "INSERT INTO budget (user_id, event_id, budget_value, budget_emergency, budget_value_first, budget_emergency_first, budget_status) VALUES (:user_id, :event_id, :budget_value, :budget_emergency, :budget_value_first, :budget_emergency_first, :budget_status)";
        if( $stmt = $pdo->prepare($sql)  ){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":user_id", $param_user);
            $stmt->bindParam(":event_id", $param_event);
            $stmt->bindParam(":budget_value", $param_budget);
            $stmt->bindParam(":budget_emergency", $param_emergency);
            $stmt->bindParam(":budget_value_first", $param_budget_first);
            $stmt->bindParam(":budget_emergency_first", $param_emergency_first);
            $stmt->bindParam(":budget_status", $param_status);
            
            // Set parameters
            $event_id = $_GET[ 'event_id' ];
            $param_user = $_SESSION["id"];
            $param_event = $event_id;
            $param_budget = $budget;
            $param_emergency = $emergency;
            $param_budget_first = $budget;
            $param_emergency_first = $emergency;
            $param_status = 'onbudget';
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
				// Records created successfully. Redirect to landing page
                
                $sql = "UPDATE events SET event_stage = :event_stage WHERE event_id = :event_id";
                if( $stmt = $pdo->prepare($sql)  ){
                    // Bind variables to the prepared statement as parameters
                    $stmt->bindParam(":event_stage", $param_event_stage);
                    $stmt->bindParam(":event_id", $param_event_id);
                    
                    // Set parameters
                    $param_event_id = $event_id;
                    $param_event_stage = 'guests';
                    
                    // Attempt to execute the prepared statement
                    if($stmt->execute()){
                        // Records created successfully. Redirect to landing page
                        
                        header("location: pages.php?event_id=$event_id");
                        exit();
                    } else{
                        echo "Something went wrong. Please try again later.";
                    }
                }

            } else{
                echo "Something went wrong. Please try again later.";
            }
        }
    } else if( $exists == 'true' ){
        $sql = "UPDATE budget SET budget_value = :budget_value, budget_emergency = :budget_emergency, budget_value_first = :budget_value_first, budget_emergency_first = :budget_emergency_first WHERE event_id = :event_id";
        if( $stmt = $pdo->prepare($sql)  ){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":budget_value", $param_budget);
            $stmt->bindParam(":budget_emergency", $param_emergency);
            $stmt->bindParam(":budget_value_first", $param_budget_first);
            $stmt->bindParam(":budget_emergency_first", $param_emergency_first);
			$stmt->bindParam(":event_id", $param_event_id);
            $event_id = $_GET[ 'event_id' ];
            // Set parameters
			$param_budget = $budget;
            $param_emergency = $emergency;
            $param_budget_first = $budget;
            $param_emergency_first = $emergency;
            $param_event_id = $event_id;
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
				// Records created successfully. Redirect to landing page
				
                $sql = "UPDATE events SET event_stage = :event_stage WHERE event_id = :event_id";
                if( $stmt = $pdo->prepare($sql)  ){
                    // Bind variables to the prepared statement as parameters
                    $stmt->bindParam(":event_stage", $param_event_stage);
                    $stmt->bindParam(":event_id", $param_event_id);
                    
                    // Set parameters
                    $param_event_id = $event_id;
                    $param_event_stage = 'guests';
                    
                    // Attempt to execute the prepared statement
                    if($stmt->execute()){
                        // Records created successfully. Redirect to landing page
                        
                        header("location: pages.php?event_id=$event_id");
                        exit();
                    } else{
                        echo "Something went wrong. Please try again later.";
                    }
                }
            } else{
                echo "Something went wrong. Please try again later.";
            }
        }
    }else{
        $sql = "UPDATE budget SET budget_value = :budget_value, budget_emergency = :budget_emergency, budget_value_first = :budget_value_first, budget_emergency_first = :budget_emergency_first WHERE event_id = :event_id";
        if( $stmt = $pdo->prepare($sql)  ){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":budget_value", $param_budget);
            $stmt->bindParam(":budget_emergency", $param_emergency);
            $stmt->bindParam(":budget_value_first", $param_budget_first);
            $stmt->bindParam(":budget_emergency_first", $param_emergency_first);
			$stmt->bindParam(":event_id", $param_event_id);
            $event_id = $_GET[ 'event_id' ];
            // Set parameters
			$param_budget = $bud + $budget;
            $param_emergency = $emer + $emergency;
            $param_event_id = $event_id;
            $param_budget_first = $budfi + $budget;
            $param_emergency_first = $emerfi + $emergency;
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
				// Records created successfully. Redirect to landing page
				
                $sql = "UPDATE events SET event_stage = :event_stage WHERE event_id = :event_id";
                if( $stmt = $pdo->prepare($sql)  ){
                    // Bind variables to the prepared statement as parameters
                    $stmt->bindParam(":event_stage", $param_event_stage);
                    $stmt->bindParam(":event_id", $param_event_id);
                    
                    // Set parameters
                    $param_event_id = $event_id;
                    $param_event_stage = 'guests';
                    
                    // Attempt to execute the prepared statement
                    if($stmt->execute()){
                        // Records created successfully. Redirect to landing page
                        
                        header("location: pages.php?event_id=$event_id");
                        exit();
                    } else{
                        echo "Something went wrong. Please try again later.";
                    }
                }
            } else{
                echo "Something went wrong. Please try again later.";
            }
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
<div class="wiz">


<?php 
require_once '../menu.php'; 
?>
       

        
        
        
            <div style="background-image:url('../images/banner2.jpg');background-size:cover;margin-top:-680px;margin-left:-40px;height:300px;">
            <div style="height:70px;"></div>
        <h1 style="color:#1f1f2e;">Make smart investments!</h1><br><br>
</div>



<div class="form-v4">
	<div class="page-content" style="background-color:#edc9af;">
		<div class="form-v4-content" style="-webkit-box-shadow: 21px 23px 47px -22px rgba(143,143,143,0.83);
-moz-box-shadow: 21px 23px 47px -22px rgba(143,143,143,0.83);
box-shadow: 21px 23px 47px -22px rgba(143,143,143,0.83);">
			<div class="form-left">
				<h2>INFOMATION</h2><br>
				<p class="text-1" style="color:white;">Tell us your budget and we'll try to make sure you don't exceed it.</p><br><br>
				<p class="text-2" style="color:white;">Do you have any emergency fund in case it will be needed?</p>
				
			</div>
			<form class="form-detail" autocomplete="off" action="<?php if(isset($_GET[ 'event_id' ])){ echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?event_id=' . $_GET[ 'event_id' ]; } else{ echo htmlspecialchars($_SERVER["PHP_SELF"]); } ?>" method="post" id="myform">
            	<h2>REGISTER BUDGET</h2>
				<div class="form-row">
					<label for="budget">Budget</label> <label class="required"></label><label style="font-size:10px;margin-top:5px;margin-left:5px;">(RON)</label>
					<input type="text" name="budget" id="budget1" class="input-text" required placeholder="00.00" pattern="[+-]?([0-9]*[.])?[0-9]+">
				</div>
				<div class="form-row">
                    <label for="emergency">Emergency value</label><label style="font-size:10px;margin-top:5px;margin-left:5px;">(RON)</label>
                    <input type="text" name="emergency" id="emergency1" class="input-text" placeholder="00.00" pattern="[+-]?([0-9]*[.])?[0-9]+">
				</div>
				<div class="form-row-last">
					<input type="submit" name="register" class="register" value="Save">
				</div>
			</form>
		</div>
	</div>
	
</div>
</div>
<?php include '../footer.php';  ?>
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
<script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>

        
</body>
</html>