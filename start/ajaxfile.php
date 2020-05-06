<!DOCTYPE html>
<html lang="en">
<?php 
require_once "../config.php";

session_start();


$post_ids = $_POST['post_id'];

foreach($post_ids as $id){ 
    $sql = "DELETE FROM guests WHERE guest_id= :guest_id";

    if( $stmt = $pdo->prepare($sql)  ){
        $stmt->bindParam(":guest_id", $param_id);
            
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