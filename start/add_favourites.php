<!DOCTYPE html>
<html lang="en">
<?php 
require_once "../config.php";

session_start();


$event_id = $_GET[ 'event_id' ];


if( isset( $_GET[ 'venue_id' ] ) ){
    $venue_id = $_GET[ 'venue_id' ];

    $sql = "SELECT * FROM favourites WHERE venue_id = :venue_id AND user_id = :user_id";
        
    if($stmt = $pdo->prepare($sql)){
        $stmt->bindParam(":venue_id", $param_venue);
        $stmt->bindParam(":user_id", $param_user);

        $param_venue = $venue_id;
        $param_user = $_SESSION[ 'id' ];

        // Bind variables to the prepared statement as parameters
        $stmt->execute(); 
        
        // Attempt to execute the prepared statement
        
        if($stmt->rowCount() == 0){
            $sql = "INSERT INTO favourites (event_id, ceremony_id, venue_id, food_id, user_id, category) VALUES (:event_id, :ceremony_id, :venue_id, :food_id, :user_id, :category)";
            if( $stmt = $pdo->prepare($sql)  ){
                // Bind variables to the prepared statement as parameters
                $stmt->bindParam(":event_id", $param_event);
                $stmt->bindParam(":ceremony_id", $param_ceremony);
                $stmt->bindParam(":venue_id", $param_venue);
                $stmt->bindParam(":food_id", $param_food);
                $stmt->bindParam(":user_id", $param_user);
                $stmt->bindParam(":category", $param_category);
                
                // Set parameters
                $param_event = $event_id;
                $param_ceremony = 0;
                $param_venue = $venue_id;
                $param_food = 0;
                $param_user = $_SESSION[ 'id' ];
                $param_category = 'venue';
                
                // Attempt to execute the prepared statement
                if($stmt->execute()){
                    $_SESSION[ 'status' ] = 1;

                    header("Location: ../start_admin/wizard_admin.php?event_id=" . $event_id);
                } else{
                    echo "Something went wrong. Please try again later.";
                }
            }
        }else{
            $_SESSION[ 'status' ] = 2;
            header("Location: ../start_admin/wizard_admin.php?event_id=" . $event_id);
        }
    }
}    
if( isset( $_GET[ 'ceremony_id' ] ) ){
    $ceremony_id = $_GET[ 'ceremony_id' ];

    $sql1 = "SELECT * FROM favourites WHERE ceremony_id = :ceremony_id AND user_id = :user_id";
        
    if($stmt1 = $pdo->prepare($sql1)){
        $stmt1->bindParam(":ceremony_id", $param_ceremony);
        $stmt1->bindParam(":user_id", $param_user);

        $param_ceremony = $ceremony_id;
        $param_user = $_SESSION[ 'id' ];

        // Bind variables to the prepared statement as parameters
        $stmt1->execute(); 
        
        // Attempt to execute the prepared statement
        
        if($stmt1->rowCount() == 0){
            $sql = "INSERT INTO favourites (event_id, ceremony_id, venue_id, food_id, user_id, category) VALUES (:event_id, :ceremony_id, :venue_id, :food_id, :user_id, :category)";
            if( $stmt = $pdo->prepare($sql)  ){
                // Bind variables to the prepared statement as parameters
                $stmt->bindParam(":event_id", $param_event);
                $stmt->bindParam(":ceremony_id", $param_ceremony);
                $stmt->bindParam(":venue_id", $param_venue);
                $stmt->bindParam(":food_id", $param_food);
                $stmt->bindParam(":user_id", $param_user);
                $stmt->bindParam(":category", $param_category);
                
                // Set parameters
                $param_event = $event_id;
                $param_ceremony = $ceremony_id;
                $param_venue = 0;
                $param_food = 0;
                $param_user = $_SESSION[ 'id' ];
                $param_category = 'ceremony';
                
                // Attempt to execute the prepared statement
                if($stmt->execute()){
                    $_SESSION[ 'status' ] = 3;

                    header("Location: ../start_admin/ceremony_admin.php?event_id=" . $event_id);
                } else{
                    echo "Something went wrong. Please try again later.";
                }
            }
        }else{
            $_SESSION[ 'status' ] = 4;
            header("Location: ../start_admin/ceremony_admin.php?event_id=" . $event_id);
        }
    }
}
if( isset( $_GET[ 'food_id' ] ) ){
    $food_id = $_GET[ 'food_id' ];

    $sql1 = "SELECT * FROM favourites WHERE food_id = :food_id AND user_id = :user_id";
        
    if($stmt1 = $pdo->prepare($sql1)){
        $stmt1->bindParam(":food_id", $param_food);
        $stmt1->bindParam(":user_id", $param_user);

        $param_food = $food_id;
        $param_user = $_SESSION[ 'id' ];

        // Bind variables to the prepared statement as parameters
        $stmt1->execute(); 
        
        // Attempt to execute the prepared statement
        
        if($stmt1->rowCount() == 0){
            $sql = "INSERT INTO favourites (event_id, ceremony_id, venue_id, food_id, user_id, category) VALUES (:event_id, :ceremony_id, :venue_id, :food_id, :user_id, :category)";
            if( $stmt = $pdo->prepare($sql)  ){
                // Bind variables to the prepared statement as parameters
                $stmt->bindParam(":event_id", $param_event);
                $stmt->bindParam(":ceremony_id", $param_ceremony);
                $stmt->bindParam(":venue_id", $param_venue);
                $stmt->bindParam(":food_id", $param_food);
                $stmt->bindParam(":user_id", $param_user);
                $stmt->bindParam(":category", $param_category);
                
                // Set parameters
                $param_event = $event_id;
                $param_ceremony = 0;
                $param_venue = 0;
                $param_food = $food_id;
                $param_user = $_SESSION[ 'id' ];
                $param_category = 'food';
                
                // Attempt to execute the prepared statement
                if($stmt->execute()){
                    $_SESSION[ 'status' ] = 5;

                    header("Location: ../start_admin/food_admin.php?event_id=" . $event_id);
                } else{
                    echo "Something went wrong. Please try again later.";
                }
            }
        }else{
            $_SESSION[ 'status' ] = 6;
            header("Location: ../start_admin/food_admin.php?event_id=" . $event_id);
        }
    }
}

?>

    
</body>
</html>