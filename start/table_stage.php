<?php
require_once "../config.php";
$event_id = $_GET[ 'event_id' ];


$sql = "SELECT * FROM events WHERE event_id = :event_id";
    
if($stmt = $pdo->prepare($sql)){
    // Bind variables to the prepared statement as parameters
    $stmt->bindParam(":event_id", $param_id);
    
    // Set parameters
    $param_id = $_GET[ 'event_id' ];
    
    // Attempt to execute the prepared statement
      $stmt->execute();
      $eventt = $stmt->fetch();
      $stage = $eventt[ 'event_stage' ];

}

        if( $stage == 'table_arrangement' ){
            $sql1 = "UPDATE events SET event_stage = :event_stage WHERE event_id = :event_id";
            if( $stmt1 = $pdo->prepare($sql1)  ){
                // Bind variables to the prepared statement as parameters
                $stmt1->bindParam(":event_stage", $param_event_stage);
                $stmt1->bindParam(":event_id", $param_event_id);
                $event_id = $_GET[ 'event_id' ];
                // Set parameters
                $param_event_id = $event_id;
                $param_event_stage = 'food';
                
                // Attempt to execute the prepared statement
                if(!$stmt1->execute()){
                    echo "Something went wrong. Please try again later.";
                }
            }
          }

          header("location: pages.php?event_id=" . $event_id);

?>