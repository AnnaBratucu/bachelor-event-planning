<?php
require_once "../config.php";
$event_id = $_GET[ 'event_id' ];
$fav_id = $_GET[ 'fav_id' ];

$sql = "DELETE FROM favourites WHERE fav_id = :fav_id";
    
    if($stmt = $pdo->prepare($sql)){
        // Bind variables to the prepared statement as parameters
        $stmt->bindParam(":fav_id", $param_id);
        
        // Set parameters
        $param_id = $fav_id;
        
        // Attempt to execute the prepared statement
        if($stmt->execute()){
            header("location: list_favourites.php?event_id=$event_id");
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }
    }
     
    // Close statement
    unset($stmt);

?>