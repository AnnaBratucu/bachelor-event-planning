<!DOCTYPE html>
<html lang="en">
<?php 
require_once "../config.php";

session_start();


$post_ids = $_POST['post_id'];

foreach($post_ids as $id){ 
    $sql = "DELETE FROM music WHERE music_id= :music_id";

    if( $stmt = $pdo->prepare($sql)  ){
        $stmt->bindParam(":music_id", $param_id);
            
            // Set parameters
            $param_id = $id;
    
            $stmt->execute();
            
    } else {
        echo "Error deleting record";
    }
}
echo 1;

?>

    
</body>
</html>