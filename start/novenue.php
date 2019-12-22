<?php
require_once "../config.php";

$sql = "UPDATE events SET event_need_venue = :event_need_venue, event_stage = :event_stage WHERE event_id = :event_id";
        if( $stmt = $pdo->prepare($sql)  ){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":event_need_venue", $param_need_venue);
            $stmt->bindParam(":event_stage", $param_event_stage);
			$stmt->bindParam(":event_id", $param_event_id);
            $event_id = $_GET[ 'event_id' ];
            // Set parameters
			$param_need_venue = 'no';
            $param_event_id = $event_id;
            $param_event_stage = 'table_arrangement';
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
				// Records created successfully. Redirect to landing page
				
                header("location: pages.php?event_id=$event_id");
                exit();
            } else{
                echo "Something went wrong. Please try again later.";
            }
        }
         
		// Close statement
		
        unset($stmt);

?>