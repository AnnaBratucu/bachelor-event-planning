<!DOCTYPE html>
<html lang="en">
<?php 
require_once "../config.php";

session_start();


$event_id = $_GET[ 'event_id' ];
$music_id = $_GET[ 'music_id' ];


        
$sql = "DELETE FROM music WHERE music_id= :music_id";

if( $stmt = $pdo->prepare($sql)  ){
    $stmt->bindParam(":music_id", $param_id);
        
        // Set parameters
        $param_id = $music_id;

        $stmt->execute();
        header("location: music.php?event_id=" . $event_id);
        exit();
} else {
    echo "Error deleting record";
}
        

?>

    
</body>
</html>