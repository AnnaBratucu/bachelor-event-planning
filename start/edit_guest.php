<!DOCTYPE html>
<html lang="en">
<?php 
require_once "../config.php";

session_start();


$event_id = $_GET[ 'event_id' ];
$guest_id = $_POST[ 'id' ];


        
            $sql = "UPDATE guests SET guest_name = :guest_name, guest_email = :guest_email WHERE guest_id = :guest_id";
    
		if( $stmt = $pdo->prepare($sql)  ){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":guest_name", $param_name);
            $stmt->bindParam(":guest_email", $param_email);
			$stmt->bindParam(":guest_id", $param_id);
            
            // Set parameters
            $param_name = $_POST[ 'name' ];
            $param_email = $_POST[ 'email' ];;
			$param_id = $guest_id;
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
				// Records created successfully. Redirect to landing page
                header("location: guests.php?event_id=" . $event_id);
                exit();
            } else{
                echo "Something went wrong. Please try again later.";
            }
        }
        

?>

    
</body>
</html>