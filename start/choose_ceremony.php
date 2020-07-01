<?php include '../head.php'; 


require_once "../config.php";

session_start();

if( !isset($_SESSION['username']) ){
	header("location: ../log/login.php"); // send to home page
	exit; 
 }
 


    $event_id = $_GET["event_id"];
    $ceremony_id = $_GET["ceremony_id"];
    $hour = $_POST[ 'hour' ];
    $date = $_POST[ 'date' ];
    // echo $date;
    // echo '<br>';
    $month = substr( $date,0,2 );
    // echo $month;
    // echo '<br>';
    $day = substr( $date,3,2 );
    // echo $day;
    // echo '<br>';
    $year = substr( $date, 6 );
    // echo $year;
    // echo '<br>';
    $date1 = $year . '-' .  $month . '-' . $day;
    //echo 'aa' . $date1;
    $message='';
    
    $sql = "SELECT * FROM users_profile WHERE user_id = :user_id AND event_id = :event_id";
        
    if($stmt = $pdo->prepare($sql)){
    // Bind variables to the prepared statement as parameters
    $stmt->execute(['user_id' => $_SESSION[ 'id' ], 'event_id' => $event_id]); 
    $profile = $stmt->fetch();

    if($stmt->rowCount() != 0 && $profile[ 'ceremony_id' ] != 0){
        $message = "You already booked a ceremony venue.";
    } 

    }


    if( empty($message) ){
        $sql = "INSERT INTO users_profile (user_id, event_id, ceremony_id, venue_id, profile_status) VALUES (:user_id, :event_id, :ceremony_id, :venue_id, :profile_status) ON DUPLICATE KEY UPDATE ceremony_id = :ceremony_id";
        if( $stmt = $pdo->prepare($sql)  ){
            // Bind variables to the prepared statement as parameters
			$stmt->bindParam(":user_id", $param_user_id);
            $stmt->bindParam(":event_id", $param_event_id);
            $stmt->bindParam(":ceremony_id", $param_ceremony_id);
            $stmt->bindParam(":venue_id", $param_venue_id);
            $stmt->bindParam(":profile_status", $param_status);
            
            // Set parameters
			$param_user_id = $_SESSION["id"];
            $param_event_id = $event_id;
            $param_ceremony_id = $ceremony_id;
            $param_venue_id = 0;
            $param_status = 'ongoing';
            
            // Attempt to execute the prepared statement
            $stmt->execute();
        }


        $sql = "INSERT INTO tbl_events_ceremony (title, start, end, ceremony_id) VALUES (:title, :start, :end, :ceremony_id)";
        if( $stmt = $pdo->prepare($sql)  ){
            // Bind variables to the prepared statement as parameters
			$stmt->bindParam(":title", $param_title);
            $stmt->bindParam(":start", $param_start);
            $stmt->bindParam(":end", $param_end);
            $stmt->bindParam(":ceremony_id", $param_ceremony_id);
            
            // Set parameters
			$param_title = 'event';
            $param_start = $date1 . ' 00:00:00';
            $param_end = $date1 . ' 00:00:00';
            $param_ceremony_id = $ceremony_id;
            
            // Attempt to execute the prepared statement
            $stmt->execute();
        }


        $sql = "UPDATE events SET ceremony_date = :ceremony_date WHERE event_id = :event_id";
    
		if( $stmt = $pdo->prepare($sql)  ){
            // Bind variables to the prepared statement as parameters
			$stmt->bindParam(":ceremony_date", $param_date);
			$stmt->bindParam(":event_id", $param_id);
            
			$param_date = $date1 . ' ' . $hour . ':00';
            $param_id = $event_id;
            
            $stmt->execute();
        }




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

        if( $stage == 'ceremony' ){
            $sql1 = "UPDATE events SET event_stage = :event_stage WHERE event_id = :event_id";
            if( $stmt1 = $pdo->prepare($sql1)  ){
                // Bind variables to the prepared statement as parameters
                $stmt1->bindParam(":event_stage", $param_event_stage);
                $stmt1->bindParam(":event_id", $param_event_id);
                $event_id = $_GET[ 'event_id' ];
                // Set parameters
                $param_event_id = $event_id;
                $param_event_stage = 'venue';
                
                // Attempt to execute the prepared statement
                if(!$stmt1->execute()){
                    echo "Something went wrong. Please try again later.";
                }
            }
          }


        header("location: pages.php?event_id=" . $event_id);
        exit();
    }else{
        header("location: pages.php?event_id=" . $event_id . "&message=" . $message);
        exit();
    }

    
?>