<title>Password Recovery</title>
<?php include '../head.php';
require_once '../settings.php'; 
require_once "../config.php";
require("../PHPMailer/src/PHPMailer.php");
require("../PHPMailer/src/SMTP.php");

if(empty($_SESSION)) // if the session not yet started
   session_start();
if(isset($_SESSION['username'])) { // if already login
	header("location: ../plan.php"); // send to home page
	exit; 
 }
// Define variables and initialize with empty values
$email = "";
$email_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
	// Validate email
	$input_email = $_POST["email"];
	if(empty($input_email)){
		$email_err = "Email field is required.";
	} elseif(!filter_var($input_email, FILTER_VALIDATE_EMAIL)){
		$email_err = "Please enter a valid Email.";
	} else{
		$email = $input_email;
	}
    
    // Check input errors before inserting in database
    if(empty($email_err)){

		$sql = "SELECT * FROM users WHERE user_email = :email";
    
		if($stmt = $pdo->prepare($sql)){
			// Bind variables to the prepared statement as parameters
            $stmt->execute(['email' => $input_email]); 
			
			if($stmt->rowCount() == 0){
				$email_err = "Email doesn't exist.";
			} 
    }
}
    if(empty($email_err)){
        $mail = new PHPMailer\PHPMailer\PHPMailer();
        $mail->IsSMTP(); // enable SMTP

        //$mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
        $mail->SMTPAuth = true; // authentication enabled
        $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
        $mail->Host = "smtp.gmail.com";
        $mail->Port = 465; // or 587
        $mail->IsHTML(true);
        $mail->Username = "ana.bratucu@gmail.com";
        $mail->Password = "gotony1997";
        $mail->SetFrom("ana.bratucu@gmail.com");
        $mail->Subject = "Password reset";
        $mail->Body = "Hello, <br><br> Click on the link below to reset your password: <br> <a href=\"http://localhost/git/bachelor/log/reset.php\">Reset password</a> ";
        $mail->AddAddress($input_email);

        if(!$mail->Send()) {
           echo "Mailer Error: " . $mail->ErrorInfo;
        } else {
            if(empty($_SESSION)) // if the session not yet started
            session_start();
            $_SESSION["email_recover"] = $input_email;
            header("location: message.php");
            exit();
        }


    }
	
    // Close connection
    unset($pdo);
}

?>
<body>
	
	<div class="limiter">
		<div class="container-login100" style="background-image: url('../images/good.jpg');">
			<div class="wrap-login100">
				<form class="login100-form validate-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
					<span class="login100-form-logo">
						<img src="images/logo2.png">
					</span>

					<span class="login100-form-title p-b-34 p-t-27">
						Recover Password
					</span>

                    <p class="txt1" style="font-size:22px;">Enter you email</p> <br>

					<div class="wrap-input100" >
						<input class="input100" type="text" name="email" placeholder="Email" value="<?= isset($_POST['email']) ? $_POST['email'] : ''; ?>">
						<span class="focus-input100" data-placeholder="&#xf15a;"></span>
					</div>
					<div style="color:red;"><?php echo $email_err; ?></div> <br>

					<div class="container-login100-form-btn">
						<button class="login100-form-btn">
							Reset password
						</button>
					</div>

					<div class="text-center p-t-90">
						<a class="txt1" href="register.php">
							Don't have an account? Register!
						</a> <br>
                        <a class="txt1" href="login.php">
							Already have an account? Login!
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>
	

	<div id="dropDownSelect1"></div>
	
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
	<script src="vendor/animsition/js/animsition.min.js"></script>
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
	<script src="vendor/select2/select2.min.js"></script>
	<script src="vendor/daterangepicker/moment.min.js"></script>
	<script src="vendor/daterangepicker/daterangepicker.js"></script>
	<script src="vendor/countdowntime/countdowntime.js"></script>
	<script src="js/main.js"></script>

	</body>
</html>