<?php include '../head.php'; 


require_once "../config.php";

session_start();

if( !isset($_SESSION['username']) ){
	header("location: ../log/login.php"); // send to home page
	exit; 
 }
 

    $message = '';
    $event_id = $_GET["event_id"];
    $food_id = $_GET["food_id"];
    $price = $_GET[ 'food_price' ];
    
    
        $sql = "SELECT * FROM guests WHERE event_id = :event_id AND guest_status = :guest_status AND guest_menu = :guest_menu";
    
        if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":event_id", $param_id);
            $stmt->bindParam(":guest_status", $param_status);
            $stmt->bindParam(":guest_menu", $param_menu);
            
            // Set parameters
            $param_id = $event_id;
            $param_status = 'accepted';
            $param_menu = 'no';
            
            // Attempt to execute the prepared statement
              $stmt->execute();
              $guests_send_no = $stmt->fetch();
              $yes_count = $stmt->rowCount();
        
      }


      $sql = "SELECT * FROM budget WHERE event_id = :event_id";
    
        if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":event_id", $param_id);
           
            
            // Set parameters
            $param_id = $event_id;
            
            // Attempt to execute the prepared statement
              $stmt->execute();
              $budg = $stmt->fetch();
              $budget = $budg[ 'budget_value' ];
              $emergency = $budg[ 'budget_emergency' ];
        
      }

      if( $budget == 0 ){
          if( $emergency == 0 ){
              $message = "You exceeded your budget. Please go to the budget tab and add more.";
          } else {
              if( $emergency - $yes_count * $price < 0 ){
                  $message = "You don't have enough money for this dish.";
              }else{
                $sql7 = "UPDATE budget SET budget_emergency = :budget_emergency WHERE (user_id = :user_id AND event_id = :event_id)";
                if( $stmt7 = $pdo->prepare($sql7)  ){
                    // Bind variables to the prepared statement as parameters
                    $stmt7->bindParam(":budget_emergency", $param_emergency);
                    $stmt7->bindParam(":user_id", $param_user);
                    $stmt7->bindParam(":event_id", $param_event);
                    
                    // Set parameters
                    $param_emergency = $emergency - $yes_count * $price;
                    $param_user = $_SESSION["id"];
                    $param_event = $event_id;
                    
                    // Attempt to execute the prepared statement
                    $stmt7->execute();
                }
              }
          }
      }else{
          if( $budget - $yes_count * $price >= 0 ){
            $sql7 = "UPDATE budget SET budget_value = :budget_value WHERE (user_id = :user_id AND event_id = :event_id)";
            if( $stmt7 = $pdo->prepare($sql7)  ){
                // Bind variables to the prepared statement as parameters
                $stmt7->bindParam(":budget_value", $param_value);
                $stmt7->bindParam(":user_id", $param_user);
                $stmt7->bindParam(":event_id", $param_event);
                
                // Set parameters
                $param_value = $budget - $yes_count * $price;
                $param_user = $_SESSION["id"];
                $param_event = $event_id;
                
                // Attempt to execute the prepared statement
                $stmt7->execute();
            }
          }else{
              $tot_p = $yes_count * $price;
              $b = $tot_p - $budget;
              if( $emergency - $b < 0 ){
                  $message = "You don't have enough money for this dish.";
              }else{
                $sql7 = "UPDATE budget SET budget_value = :budget_value, budget_emergency = :budget_emergency WHERE (user_id = :user_id AND event_id = :event_id)";
                if( $stmt7 = $pdo->prepare($sql7)  ){
                    // Bind variables to the prepared statement as parameters
                    $stmt7->bindParam(":budget_value", $param_value);
                    $stmt7->bindParam(":budget_emergency", $param_emergency);
                    $stmt7->bindParam(":user_id", $param_user);
                    $stmt7->bindParam(":event_id", $param_event);
                    
                    // Set parameters
                    $param_value = 0;
                    $param_emergency = $emergency - $b;
                    $param_user = $_SESSION["id"];
                    $param_event = $event_id;
                    
                    // Attempt to execute the prepared statement
                    $stmt7->execute();
                }
              }
          }
      }


      if( $message == '' ){
        $sql = "INSERT INTO menu (food_id, event_id) VALUES (:food_id, :event_id)";
        if( $stmt = $pdo->prepare($sql)  ){
            // Bind variables to the prepared statement as parameters
			$stmt->bindParam(":food_id", $param_food);
            $stmt->bindParam(":event_id", $param_event_id);
            
            // Set parameters
			$param_food = $food_id;
            $param_event_id = $event_id;
            
            // Attempt to execute the prepared statement
            $stmt->execute();
        }

        $sql7 = "UPDATE guests SET guest_menu = :guest_menu WHERE event_id = :event_id AND guest_status = :guest_status";
        if( $stmt7 = $pdo->prepare($sql7)  ){
            // Bind variables to the prepared statement as parameters
            $stmt7->bindParam(":guest_menu", $param_guest_menu);
            $stmt7->bindParam(":guest_status", $param_status);
            $stmt7->bindParam(":event_id", $param_event);
            
            // Set parameters
            $param_guest_menu = 'yes';
            $param_status = 'accepted';
            $param_event = $event_id;
            
            // Attempt to execute the prepared statement
            $stmt7->execute();
        }


      }


        header("location: ../start_admin/food_admin.php?event_id=" . $event_id . "&message=" . $message);
        exit();
    

    
?>