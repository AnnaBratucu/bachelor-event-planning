<?php include '../head.php'; 


require_once "../config.php";


 


    $event_id = $_GET["event_id"];
    
    $name = $_POST[ 'name' ];
    $email = $_POST[ 'email' ];
    $accept = $_POST[ 'accept' ];
    $plus = $_POST[ 'plus' ];

       
    $sql = "UPDATE guests SET guest_plus = :guest_plus, guest_status = :guest_status WHERE event_id = :event_id AND guest_email = :guest_email";

    if( $stmt = $pdo->prepare($sql)  ){
        // Bind variables to the prepared statement as parameters
        $stmt->bindParam(":guest_plus", $param_plus);
        $stmt->bindParam(":guest_status", $param_status);
        $stmt->bindParam(":event_id", $param_id);
        $stmt->bindParam(":guest_email", $param_email);
        
        // Set parameters
        $param_plus = $plus;
        if( $accept == 'yes' ){
            $param_status = 'accepted';
        }else{
            $param_status = 'denied';
        }
        $param_id = $event_id;
        $param_email = $email;
        
        // Attempt to execute the prepared statement
        $stmt->execute();
        
    }


    $sql = "INSERT INTO notifications (event_id, notification_name, notification_message, notification_status) VALUES (:event_id, :notification_name, :notification_message, :notification_status)";
    if( $stmt = $pdo->prepare($sql)  ){
        // Bind variables to the prepared statement as parameters
        $stmt->bindParam(":event_id", $param_event);
        $stmt->bindParam(":notification_name", $param_name);
        $stmt->bindParam(":notification_message", $param_mess);
        $stmt->bindParam(":notification_status", $param_stat);
        
        // Set parameters
        $param_event = $event_id;
        $param_name = 'Guest answer';
        if( $accept == 'yes' ){
            $param_mess = $name . ', with email ' . $email . ', has accepted your invitation.';
        }else{
            $param_mess = $name . ', with email ' . $email . ', has denied your invitation.';
        }
        $param_stat = 'not_seen';
        
        // Attempt to execute the prepared statement
        $stmt->execute();
    }
    


    header("location: thanks.php");
     
    

    
?>