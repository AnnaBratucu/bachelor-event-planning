<!DOCTYPE html>
<html lang="en">
<?php 
require_once "../config.php";

session_start();


$event_id = $_GET[ 'event_id' ];
$venue_id = $_GET[ 'venue_id' ];


$sql = "SELECT * FROM favourites WHERE venue_id = :venue_id AND event_id = :event_id";
    
		if($stmt = $pdo->prepare($sql)){
            $stmt->bindParam(":venue_id", $param_venue);
            $stmt->bindParam(":event_id", $param_event);

            $param_venue = $venue_id;
            $param_event = $event_id;

			// Bind variables to the prepared statement as parameters
			$stmt->execute(); 
			
			// Attempt to execute the prepared statement
			
			if($stmt->rowCount() == 0){
                $sql = "INSERT INTO favourites (event_id, venue_id, user_id, category) VALUES (:event_id, :venue_id, :user_id, :category)";
                if( $stmt = $pdo->prepare($sql)  ){
                    // Bind variables to the prepared statement as parameters
                    $stmt->bindParam(":event_id", $param_event);
                    $stmt->bindParam(":venue_id", $param_venue);
                    $stmt->bindParam(":user_id", $param_user);
                    $stmt->bindParam(":category", $param_category);
                    
                    // Set parameters
                    $param_event = $event_id;
                    $param_venue = $venue_id;
                    $param_user = $_SESSION[ 'id' ];
                    $param_category = 'venue';
                    
                    // Attempt to execute the prepared statement
                    if($stmt->execute()){
                        $_SESSION[ 'status' ] = 1;

                        header("Location: ../start_admin/wizard_admin.php?event_id=" . $event_id);
                    } else{
                        echo "Something went wrong. Please try again later.";
                    }
                }
			}
		}

?>

    
</body>
</html>