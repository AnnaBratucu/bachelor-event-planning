<?php include '../head.php'; 


require_once "../config.php";

session_start();

if( !isset($_SESSION['username']) ){
	header("location: ../log/login.php"); // send to home page
	exit; 
 }
 


    $event_id = $_GET["event_id"];
    $venue_id = $_GET["venue_id"];
    $venue_price = $_GET["venue_price"];
    $hour = $_POST[ 'hour' ];
    $date = $_POST[ 'date' ];
    // echo $date;
    // echo '<br>';
    $month = substr( $date,0,2 );
    // echo $month;
    // echo '<br>';
    $day = substr( $date,3,2 );
    // echo $day;
    // echo '<br>';
    $year = substr( $date, 6 );
    // echo $year;
    // echo '<br>';
    $date1 = $year . '-' .  $month . '-' . $day;
    //echo 'aa' . $date1;
    $message='';
    $budget_val = 0.00;
    $budget_emer = 0.00;


    $sql = "SELECT * FROM users_profile WHERE user_id = :user_id AND event_id = :event_id";
        
    if($stmt = $pdo->prepare($sql)){
    // Bind variables to the prepared statement as parameters
        $stmt->execute(['user_id' => $_SESSION[ 'id' ], 'event_id' => $event_id]); 
        $profile = $stmt->fetch();

        if($stmt->rowCount() != 0 && $profile[ 'venue_id' ] != 0){
            $message = "You already booked a venue.";
        } 

    }


    if( empty($message) ){

    $sql = "SELECT * FROM budget WHERE user_id = :user_id AND event_id = :event_id";
        
    if($stmt = $pdo->prepare($sql)){
    // Bind variables to the prepared statement as parameters
    $stmt->execute(['user_id' => $_SESSION[ 'id' ], 'event_id' => $event_id]); 
    $budget = $stmt->fetch();
    
    
    
    
    

    if( $budget[ 'budget_value' ] != 0.00 ){
        if( $budget[ 'budget_value' ] < $venue_price ){
            $budget_val = 0.00;
            $venue_price = $venue_price - $budget[ 'budget_value' ];
            if( $budget[ 'budget_emergency' ] < $venue_price ){
                $message = "You exceeded your budget.";
                $sql = "UPDATE budget SET budget_status = :status WHERE budget_id = :budget_id";
    
                if( $stmt = $pdo->prepare($sql)  ){
                    // Bind variables to the prepared statement as parameters
                    $stmt->bindParam(":status", $param_status);
                    $stmt->bindParam(":budget_id", $param_id);
                    
                    // Set parameters
                    $param_status = 'exceeded';
                    $param_id = $budget[ 'budget_id' ];
                    
                    // Attempt to execute the prepared statement
                    $stmt->execute();
                   
                }
            }else{
                $budget_emer = $budget[ 'budget_emergency' ] - $venue_price;
                $sql = "UPDATE budget SET budget_status = :status WHERE budget_id = :budget_id";
    
                if( $stmt = $pdo->prepare($sql)  ){
                    // Bind variables to the prepared statement as parameters
                    $stmt->bindParam(":status", $param_status);
                    $stmt->bindParam(":budget_id", $param_id);
                    
                    // Set parameters
                    $param_status = 'onemergency';
                    $param_id = $budget[ 'budget_id' ];
                    
                    // Attempt to execute the prepared statement
                    $stmt->execute();
                   
                }
            }
        }else{
            $budget_val = $budget[ 'budget_value' ] - $venue_price;
            $budget_emer = $budget[ 'budget_emergency' ];
        }
    }else{
        if( $budget[ 'budget_emergency' ] < $venue_price ){
            $message = "You exceeded your budget.";
            $sql = "UPDATE budget SET budget_status = :status WHERE budget_id = :budget_id";
    
                if( $stmt = $pdo->prepare($sql)  ){
                    // Bind variables to the prepared statement as parameters
                    $stmt->bindParam(":status", $param_status);
                    $stmt->bindParam(":budget_id", $param_id);
                    
                    // Set parameters
                    $param_status = 'exceeded';
                    $param_id = $budget[ 'budget_id' ];
                    
                    // Attempt to execute the prepared statement
                    $stmt->execute();
                   
                }
        }else{
            $budget_val = 0.00;
            $budget_emer = $budget[ 'budget_emergency' ] - $venue_price;
            $sql = "UPDATE budget SET budget_status = :status WHERE budget_id = :budget_id";
    
                if( $stmt = $pdo->prepare($sql)  ){
                    // Bind variables to the prepared statement as parameters
                    $stmt->bindParam(":status", $param_status);
                    $stmt->bindParam(":budget_id", $param_id);
                    
                    // Set parameters
                    $param_status = 'onemergency';
                    $param_id = $budget[ 'budget_id' ];
                    
                    // Attempt to execute the prepared statement
                    $stmt->execute();
                   
                }
        }
    }
    unset($stmt);
    } }

    if( empty($message) ){
        $sql = "INSERT INTO users_profile (user_id, event_id, ceremony_id, venue_id, profile_status) VALUES (:user_id, :event_id, :ceremony_id, :venue_id, :profile_status) ON DUPLICATE KEY UPDATE venue_id = :venue_id";
        if( $stmt = $pdo->prepare($sql)  ){
            // Bind variables to the prepared statement as parameters
			$stmt->bindParam(":user_id", $param_user_id);
            $stmt->bindParam(":event_id", $param_event_id);
            $stmt->bindParam(":ceremony_id", $param_ceremony_id);
            $stmt->bindParam(":venue_id", $param_venue_id);
            $stmt->bindParam(":profile_status", $param_status);
            
            // Set parameters
			$param_user_id = $_SESSION["id"];
            $param_event_id = $event_id;
            $param_ceremony_id = 0;
            $param_venue_id = $venue_id;
            $param_status = 'ongoing';
            
            // Attempt to execute the prepared statement
            $stmt->execute();
        }


        $sql7 = "UPDATE budget SET budget_value = :budget_value, budget_emergency = :budget_emergency WHERE (user_id = :user_id AND event_id = :event_id)";
        if( $stmt7 = $pdo->prepare($sql7)  ){
            // Bind variables to the prepared statement as parameters
            $stmt7->bindParam(":budget_value", $param_value);
            $stmt7->bindParam(":budget_emergency", $param_emergency);
            $stmt7->bindParam(":user_id", $param_user);
            $stmt7->bindParam(":event_id", $param_event);
            
            // Set parameters
            $param_value = $budget_val;
            $param_emergency = $budget_emer;
            $param_user = $_SESSION["id"];
            $param_event = $event_id;
            
            // Attempt to execute the prepared statement
            $stmt7->execute();
        }


        $sql = "INSERT INTO tbl_events (title, start, end, venue_id) VALUES (:title, :start, :end, :venue_id)";
        if( $stmt = $pdo->prepare($sql)  ){
            // Bind variables to the prepared statement as parameters
			$stmt->bindParam(":title", $param_title);
            $stmt->bindParam(":start", $param_start);
            $stmt->bindParam(":end", $param_end);
            $stmt->bindParam(":venue_id", $param_venue_id);
            
            // Set parameters
			$param_title = 'event';
            $param_start = $date1 . ' 00:00:00';
            $param_end = $date1 . ' 00:00:00';
            $param_venue_id = $venue_id;
            
            // Attempt to execute the prepared statement
            $stmt->execute();
        }


        $sql = "UPDATE events SET event_date = :event_date WHERE event_id = :event_id";
    
		if( $stmt = $pdo->prepare($sql)  ){
            // Bind variables to the prepared statement as parameters
			$stmt->bindParam(":event_date", $param_date);
			$stmt->bindParam(":event_id", $param_id);
            
			$param_date = $date1 . ' ' . $hour . ':00';
            $param_id = $event_id;
            
            $stmt->execute();
        }


        header("location: ../start_admin/wizard_admin.php?event_id=" . $event_id);
        exit();
    }else{
        header("location: ../start_admin/wizard_admin.php?event_id=" . $event_id . "&message=" . $message);
        exit();
    }

    
?>