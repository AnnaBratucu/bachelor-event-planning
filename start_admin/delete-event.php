<?php
require_once "db.php";
require_once '../config.php';

$id = $_POST['id'];


$sql = "SELECT * FROM tbl_events WHERE id = :id";
    
if($stmt = $pdo->prepare($sql)){
    // Bind variables to the prepared statement as parameters
    $stmt->bindParam(":id", $param_id);
    
    // Set parameters
    $param_id = $id;
    
    // Attempt to execute the prepared statement
      $stmt->execute();
      $eventt = $stmt->fetch();
      $event = $eventt[ 'title' ];

}


$sqlDelete = "DELETE from tbl_events WHERE id=".$id;

mysqli_query($conn, $sqlDelete);
echo mysqli_affected_rows($conn);

mysqli_close($conn);




$sql = "INSERT INTO notifications (event_id, notification_name, notification_message, notification_status) VALUES (:event_id, :notification_name, :notification_message, :notification_status)";
        if( $stmt = $pdo->prepare($sql)  ){
            // Bind variables to the prepared statement as parameters
			$stmt->bindParam(":event_id", $param_event);
            $stmt->bindParam(":notification_name", $param_name);
            $stmt->bindParam(":notification_message", $param_mess);
            $stmt->bindParam(":notification_status", $param_stat);
            
            // Set parameters
			$param_event = $event;
            $param_name = 'Deleted booking';
            $param_mess = 'The venue you have chosen has deleted your booking, please choose another date.';
            $param_stat = 'not_seen';
            
            // Attempt to execute the prepared statement
            $stmt->execute();
        }
?>