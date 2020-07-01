<?php
require_once "../config.php";
$event_id = $_GET[ 'event_id' ];
$notif_id = $_GET[ 'notif_id' ];

$sql = "DELETE FROM notifications WHERE notification_id = :notif_id";
    
    if($stmt = $pdo->prepare($sql)){
        // Bind variables to the prepared statement as parameters
        $stmt->bindParam(":notif_id", $param_id);
        
        // Set parameters
        $param_id = $notif_id;
        
        // Attempt to execute the prepared statement
        if($stmt->execute()){
            header("location: profile.php?event_id=$event_id");
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }
    }
     
    // Close statement
    unset($stmt);

?>