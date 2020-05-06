<!DOCTYPE html>
<html lang="en">
<?php 
require_once "../config.php";

session_start();


$event_id = $_GET[ 'event_id' ];
$guest_id = $_GET[ 'guest_id' ];


        
$sql = "DELETE FROM guests WHERE guest_id= :guest_id";

if( $stmt = $pdo->prepare($sql)  ){
    $stmt->bindParam(":guest_id", $param_id);
        
        // Set parameters
        $param_id = $guest_id;

        $stmt->execute();
        header("location: guests.php?event_id=" . $event_id);
        exit();
} else {
    echo "Error deleting record";
}
        

?>

    
</body>
</html>