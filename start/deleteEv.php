<?php
require_once "../config.php";
$event_id = $_GET[ 'event_id' ];


$sql = "SELECT * FROM users_profile WHERE event_id = :event_id";
    
    if($stmt = $pdo->prepare($sql)){
        // Bind variables to the prepared statement as parameters
        $stmt->bindParam(":event_id", $param_id);
        
        // Set parameters
        $param_id = $event_id;
        
        // Attempt to execute the prepared statement
        $stmt->execute();
        $profile = $stmt->fetch();
        $venue = $profile[ 'venue_id' ];
    }

    $sql = "SELECT * FROM events WHERE event_id = :event_id";
    
    if($stmt = $pdo->prepare($sql)){
        // Bind variables to the prepared statement as parameters
        $stmt->bindParam(":event_id", $param_id);
        
        // Set parameters
        $param_id = $event_id;
        
        // Attempt to execute the prepared statement
        $stmt->execute();
        $ev = $stmt->fetch();
        $start_date = $ev[ 'event_date' ];
    }


    $sql = "DELETE FROM tbl_events WHERE venue_id = :venue_id AND start = :start";
    
    if($stmt = $pdo->prepare($sql)){
        // Bind variables to the prepared statement as parameters
        $stmt->bindParam(":venue_id", $param_id);
        $stmt->bindParam(":start", $param_start);
        
        // Set parameters
        $param_id = $venue;
        $param_start = $start_date;
        
        // Attempt to execute the prepared statement
        if($stmt->execute()){
            
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }
    }
     
    // Close statement
    unset($stmt);

$sql = "DELETE FROM budget WHERE event_id = :event_id";
    
    if($stmt = $pdo->prepare($sql)){
        // Bind variables to the prepared statement as parameters
        $stmt->bindParam(":event_id", $param_id);
        
        // Set parameters
        $param_id = $event_id;
        
        // Attempt to execute the prepared statement
        if($stmt->execute()){
            
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }
    }
     
    // Close statement
    unset($stmt);

$sql = "DELETE FROM events WHERE event_id = :event_id";
    
    if($stmt = $pdo->prepare($sql)){
        // Bind variables to the prepared statement as parameters
        $stmt->bindParam(":event_id", $param_id);
        
        // Set parameters
        $param_id = $event_id;
        
        // Attempt to execute the prepared statement
        if($stmt->execute()){
            
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }
    }
     
    // Close statement
    unset($stmt);

    $sql = "DELETE FROM guests WHERE event_id = :event_id";
    
    if($stmt = $pdo->prepare($sql)){
        // Bind variables to the prepared statement as parameters
        $stmt->bindParam(":event_id", $param_id);
        
        // Set parameters
        $param_id = $event_id;
        
        // Attempt to execute the prepared statement
        if($stmt->execute()){
            
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }
    }
     
    // Close statement
    unset($stmt);

    $sql = "DELETE FROM menu WHERE event_id = :event_id";
    
    if($stmt = $pdo->prepare($sql)){
        // Bind variables to the prepared statement as parameters
        $stmt->bindParam(":event_id", $param_id);
        
        // Set parameters
        $param_id = $event_id;
        
        // Attempt to execute the prepared statement
        if($stmt->execute()){
            
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }
    }
     
    // Close statement
    unset($stmt);

    $sql = "DELETE FROM music WHERE event_id = :event_id";
    
    if($stmt = $pdo->prepare($sql)){
        // Bind variables to the prepared statement as parameters
        $stmt->bindParam(":event_id", $param_id);
        
        // Set parameters
        $param_id = $event_id;
        
        // Attempt to execute the prepared statement
        if($stmt->execute()){
            
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }
    }
     
    // Close statement
    unset($stmt);

    $sql = "DELETE FROM notifications WHERE event_id = :event_id";
    
    if($stmt = $pdo->prepare($sql)){
        // Bind variables to the prepared statement as parameters
        $stmt->bindParam(":event_id", $param_id);
        
        // Set parameters
        $param_id = $event_id;
        
        // Attempt to execute the prepared statement
        if($stmt->execute()){
            
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }
    }
     
    // Close statement
    unset($stmt);

    $sql = "DELETE FROM users_profile WHERE event_id = :event_id";
    
    if($stmt = $pdo->prepare($sql)){
        // Bind variables to the prepared statement as parameters
        $stmt->bindParam(":event_id", $param_id);
        
        // Set parameters
        $param_id = $event_id;
        
        // Attempt to execute the prepared statement
        if($stmt->execute()){
            
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }
    }
     
    // Close statement
    unset($stmt);

    header("location: ../plan.php");
    exit();
    

?>