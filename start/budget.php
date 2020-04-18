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

.products{
	background: white;
	
}
.container{
	background: white;
	
}
.wiz{
	margin-top:-400px;
	position: relative;
}

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
    if( isset($_POST[ 'emergency' ]) ){
        $input_emergency = $_POST["emergency"];
        if( !is_numeric( $input_emergency ) ){
            $emergency_err = "You must enter the numeric sum";
        } else{
            $emergency = $input_emergency;
        }
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
				$exists = true;
			} else{
				$exists = false;
			}
		}	

    if( $exists == false ){
        $sql = "INSERT INTO budget (user_id, event_id, budget_value, budget_emergency, budget_status) VALUES (:user_id, :event_id, :budget_value, :budget_emergency, :budget_status)";
        if( $stmt = $pdo->prepare($sql)  ){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":user_id", $param_user);
            $stmt->bindParam(":event_id", $param_event);
            $stmt->bindParam(":budget_value", $param_budget);
            $stmt->bindParam(":budget_emergency", $param_emergency);
            $stmt->bindParam(":budget_status", $param_status);
            
            // Set parameters
            $event_id = $_GET[ 'event_id' ];
            $param_user = $_SESSION["id"];
            $param_event = $event_id;
            $param_budget = $budget;
            $param_emergency = $emergency;
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
    } else{
        $sql = "UPDATE budget SET budget_value = :budget_value, budget_emergency = :budget_emergency WHERE event_id = :event_id";
        if( $stmt = $pdo->prepare($sql)  ){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":budget_value", $param_budget);
            $stmt->bindParam(":budget_emergency", $param_emergency);
			$stmt->bindParam(":event_id", $param_event_id);
            $event_id = $_GET[ 'event_id' ];
            // Set parameters
			$param_budget = $budget;
            $param_emergency = $emergency;
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
       

        
        
        <form id="regForm" action="<?php if(isset($_GET[ 'event_id' ])){ echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?event_id=' . $_GET[ 'event_id' ]; } else{ echo htmlspecialchars($_SERVER["PHP_SELF"]); } ?>" method="POST">
            <div style="background-image:url('../images/5631.jpg');background-size:cover;margin-top:-660px;margin-left:-40px;margin-right:-40px;height:250px;">
            <div style="height:70px;"></div>
        <h1 style="color:#1f1f2e;">Make smart investments!</h1><br><br>
</div>
    <h1 style="color:#1f1f2e;">Tell us your budget and we'll try to make sure you don't exceed it</h1><br><br>
    <p style="color:black;"><span style="margin-left:80px;">Budget (lei) :</span> <br><br><input type="numeric" name="budget" id="budget" required placeholder="00000.00" value="<?php if( isset($_SESSION[ 'budget' ])) echo $_SESSION[ 'budget' ] ?>"><i class="fa fa-money" style="color:black;top:0px;left:-50px;"></i></p>
    <div style="color:red;"><?php echo $budget_err; ?></div>
<hr/>
    <h1 style="color:#1f1f2e;">Do you have any emergency fund in case it will be needed?</h1><br><br>
    <p style="color:black;"><span style="margin-left:80px;">Emergency value (lei - optional) :</span> <br><br><input type="numeric" name="emergency" id="emergency" placeholder="00000.00" value="<?php if(isset($_SESSION[ 'emergency' ])) echo $_SESSION[ 'emergency' ] ?>"><i class="fa fa-money" style="color:black;top:0px;left:-50px;"></i></p>
    <div style="color:red;"><?php echo $emergency_err; ?></div> <br><br>

<div style="height=50px;"></div>
  <div style="overflow:auto;">
    <div >
      <!--<button type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button>-->
      <input type="submit" value="Next" class="nextBtn" id="nextBtn" style="color:white;width:200px;margin-left:390px;cursor:pointer;">
    </div>
  </div>
  
</form>
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

        
</body>
</html>