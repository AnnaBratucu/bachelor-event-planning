<?php
require_once "../config.php";
$event_id = $_GET[ 'event_id' ];
$notif_id = $_GET[ 'notif_id' ];

$sql = "UPDATE notifications SET notification_status = :status WHERE notification_id = :notification_id";
        if( $stmt = $pdo->prepare($sql)  ){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":status", $param_status);
			$stmt->bindParam(":notification_id", $param_notif);
            // Set parameters
			$param_status = 'seen';
            $param_notif = $notif_id;
            
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