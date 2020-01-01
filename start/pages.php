<?php 
require_once "../config.php";
session_start();


		$sql = "SELECT * FROM events WHERE event_id = :event_id";
    
		if($stmt = $pdo->prepare($sql)){
            $event_id = $_GET[ 'event_id' ];
			// Bind variables to the prepared statement as parameters
			$stmt->execute(['event_id' => $event_id ]); 
			$user = $stmt->fetch();
			
			// Attempt to execute the prepared statement
			
			if( $user[ 'event_stage' ] == 'budget' ){
				header("location: budget.php?event_id=$event_id");
				exit();
			} else if( $user[ 'event_stage' ] == 'guests' ){
				header("location: guests.php?event_id=$event_id");
				exit();
			} else if( $user[ 'event_stage' ] == 'surveys' ){
				header("location: surveys.php?event_id=$event_id");
				exit();
			} else if( $user[ 'event_stage' ] == 'venue' ){
				header("location: wizard.php?event_id=$event_id");
				exit();
			} else if( $user[ 'event_stage' ] == 'table_arrangement' ){
				header("location: table_arrangement.php?event_id=$event_id");
				exit();
			} else if( $user[ 'event_stage' ] == 'food' ){
				header("location: food.php?event_id=$event_id");
				exit();
			}
		}	
	
	
    // Close connection
    unset($pdo);


?>