<!DOCTYPE html>
<html lang="en">
<?php 
require_once "../config.php";
require("../PHPMailer/src/Exception.php");
require("../PHPMailer/src/PHPMailer.php");
require("../PHPMailer/src/SMTP.php");

session_start();


$event_id = $_GET[ 'event_id' ];
$guest_id = $_GET[ 'guest_id' ];
$email = $_GET[ 'guest_email' ];


        $mail = new PHPMailer\PHPMailer\PHPMailer();
        $mail->IsSMTP(); // enable SMTP
      
        //$mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
        $mail->SMTPAuth = true; // authentication enabled
        $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
        //$mail->Host = "smtp.gmail.com";
        $mail->Host = "ssl://smtp.gmail.com"; 
        $mail->Port = 465; // or 587
        $mail->IsHTML(true);
        $mail->Username = "ana7bratucu@gmail.com";
        $mail->Password = "gotony1997";
        $mail->SetFrom("ana7bratucu@gmail.com");
        $mail->Subject = "Event Invitation";
        $mail->Body = "Hello, <br><br> You are on invited to an event. Would you like to give her your opinion regarding what you expect from it?<br>Click on the link below to answer a few questions: <br> <a href=\"http://localhost/git/bachelor/start/survey_for_guests.php?eventid=". $_GET[ 'event_id' ] . "\">Take Survey</a> ";
        $mail->AddAddress($email);
        
        if(!$mail->Send()) {
           echo "Mailer Error: " . $mail->ErrorInfo;
        }else{
            $sql = "UPDATE guests SET guest_send = :guest_send WHERE guest_id = :guest_id";
    
		if( $stmt = $pdo->prepare($sql)  ){
            // Bind variables to the prepared statement as parameters
			$stmt->bindParam(":guest_send", $param_send);
			$stmt->bindParam(":guest_id", $param_id);
            
            // Set parameters
			$param_send = 'yes';
			$param_id = $guest_id;
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
				// Records created successfully. Redirect to landing page
                header("location: guests.php?event_id=" . $event_id);
                exit();
            } else{
                echo "Something went wrong. Please try again later.";
            }
        }
        }

?>

    
</body>
</html>