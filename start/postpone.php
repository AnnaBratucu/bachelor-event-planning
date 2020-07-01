<?php
require_once "../config.php";
$event_id = $_GET[ 'event_id' ];


$sql = "SELECT * FROM users_profile WHERE event_id = :event_id";
    
    if($stmt = $pdo->prepare($sql)){
        // Bind variables to the prepared statement as parameters
        $stmt->bindParam(":event_id", $param_id);
        
        // Set parameters
        $param_id = $event_id;
        
        // Attempt to execute the prepared statement
        $stmt->execute();
        $profile = $stmt->fetch();
        $venue = $profile[ 'venue_id' ];
    }

    $sql = "SELECT * FROM events WHERE event_id = :event_id";
    
    if($stmt = $pdo->prepare($sql)){
        // Bind variables to the prepared statement as parameters
        $stmt->bindParam(":event_id", $param_id);
        
        // Set parameters
        $param_id = $event_id;
        
        // Attempt to execute the prepared statement
        $stmt->execute();
        $ev = $stmt->fetch();
        $start_date = $ev[ 'event_date' ];
        $year= substr( $start_date,0,4 );
        $month= substr( $start_date,5,2 );
        $day= substr( $start_date,8,2 );
        $datee = $year . '-' . $month . '-' . $day;

    }


    $sql = "DELETE FROM tbl_events WHERE venue_id = :venue_id AND start = :start";
    
    if($stmt = $pdo->prepare($sql)){
        // Bind variables to the prepared statement as parameters
        $stmt->bindParam(":venue_id", $param_id);
        $stmt->bindParam(":start", $param_start);
        
        // Set parameters
        $param_id = $venue;
        $param_start = $datee;
        
        // Attempt to execute the prepared statement
        if($stmt->execute()){
            
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }
    }
     
    // Close statement
    unset($stmt);


    $sql = "INSERT INTO notifications (event_id, notification_name, notification_message, notification_status) VALUES (:event_id, :notification_name, :notification_message, :notification_status)";
        if( $stmt = $pdo->prepare($sql)  ){
            // Bind variables to the prepared statement as parameters
			$stmt->bindParam(":event_id", $param_event);
            $stmt->bindParam(":notification_name", $param_name);
            $stmt->bindParam(":notification_message", $param_mess);
            $stmt->bindParam(":notification_status", $param_stat);
            
            // Set parameters
			$param_event = $event_id;
            $param_name = 'Postponed booking';
            $param_mess = 'You have postponed your booking, please choose another date.';
            $param_stat = 'not_seen';
            
            // Attempt to execute the prepared statement
            $stmt->execute();
        }


$sql = "UPDATE events SET event_date = :event_date WHERE event_id = :event_id";
        if( $stmt = $pdo->prepare($sql)  ){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":event_date", $param_date);
			$stmt->bindParam(":event_id", $param_event_id);
            // Set parameters
			$param_date = null;
            $param_event_id = $event_id;
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
				// Records created successfully. Redirect to landing page
				
                header("location: profile.php?event_id=$event_id");
                exit();
            } else{
                echo "Something went wrong. Please try again later.";
            }
        }
         
		// Close statement
		
        unset($stmt);

?>