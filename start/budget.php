<!DOCTYPE html>
<!--<html class="menu">-->
<html>

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
<a href="../profile.php">
<i class="fa fa-user fa-lg"></i>
<span class="nav-text">Your profile</span>
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
<a href="budget.php?event_id=<?php echo $_GET[ 'event_id' ] ?>">
<i class="fas fa-money-bill-wave"></i>
<span class="nav-text">Budget</span>
</a>
</li>

<li class="darkerli">
<a href="guests.php?event_id=<?php echo $_GET[ 'event_id' ] ?>">
<i class="fas fa-users"></i>
<span class="nav-text">Guests</span>
</a>
</li>

<li class="darkerli">
<a href="wizard.php?event_id=<?php echo $_GET[ 'event_id' ] ?>">
<i class="fas fa-hotel"></i>
<span class="nav-text">Venue</span>
</a>
</li>
  
<li class="darkerli">
<a href="food.php?event_id=<?php echo $_GET[ 'event_id' ] ?>">
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
        
        <form id="regForm" action="<?php if(isset($_GET[ 'event_id' ])){ echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?event_id=' . $_GET[ 'event_id' ]; } else{ echo htmlspecialchars($_SERVER["PHP_SELF"]); } ?>" method="POST">
            <div style="background-image:url('../images/5631.jpg');background-size:cover;margin-top:-62px;margin-left:-40px;margin-right:-40px;height:250px;">
            <div style="height:70px;"></div>
        <h1 style="color:#1f1f2e;">Make smart investments!</h1><br><br>
</div>
    <h1 style="color:#1f1f2e;">Tell us your budget and we'll try to make sure you don't exceed it</h1><br><br>
    <p style="color:black;"><span style="margin-left:80px;">Budget (lei) :</span> <br><br><input type="numeric" name="budget" id="budget" required placeholder="00000.00" value="<?php if( isset($_SESSION[ 'budget' ])) echo $_SESSION[ 'budget' ] ?>"><i class="fas fa-money-bill" style="color:black;top:0px;left:-50px;"></i></p>
    <div style="color:red;"><?php echo $budget_err; ?></div>
<hr/>
    <h1 style="color:#1f1f2e;">Do you have any emergency fund in case it will be needed?</h1><br><br>
    <p style="color:black;"><span style="margin-left:80px;">Emergency value (lei - optional) :</span> <br><br><input type="numeric" name="emergency" id="emergency" placeholder="00000.00" value="<?php if(isset($_SESSION[ 'emergency' ])) echo $_SESSION[ 'emergency' ] ?>"><i class="fas fa-search-dollar" style="color:black;top:0px;left:-50px;"></i></p>
    <div style="color:red;"><?php echo $emergency_err; ?></div>

<div style="height=50px;"></div>
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

        
</body>
</html>