<title>Register</title>
<?php include '../head.php'; 


require_once "../config.php";
if(empty($_SESSION)) // if the session not yet started
   session_start();
if(isset($_SESSION['username'])) { // if already login
	header("location: ../plan.php"); // send to home page
	exit; 
 }
// Define variables and initialize with empty values
$username = $password = $repassword = $email = "";
$username_err = $password_err = $repassword_err = $email_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Validate username
	$input_username = $_POST["username"];
    if(empty($input_username)){
		$username_err = "Name field is required.";
    } elseif(!preg_match("/^[a-zA-Z ]*$/",$input_username)){
        $username_err = "Please enter a valid Name (only letters and white space allowed).";
    } else{
        $username = $input_username;
	}
	
	// Validate email
	$input_email = $_POST["email"];
	if(empty($input_email)){
		$email_err = "Email field is required.";
	} elseif(!filter_var($input_email, FILTER_VALIDATE_EMAIL)){
		$email_err = "Please enter a valid Email.";
	} else{
		$email = $input_email;
	}
    
    // Validate password
    $input_password = $_POST["password"];
    if(empty($input_password)){
        $password_err = "Password field is required.";     
    } elseif(strlen($input_password)<8){
        $password_err = "Password too short.";
    } elseif(!preg_match("#[0-9]+#", $input_password)){
        $password_err = "Password must include at least one number.";
    } elseif(!preg_match("#[A-Z]+#", $input_password )){
        $password_err = "Password must include at least one CAPS.";
    } elseif(!preg_match("#\W+#", $input_password )){
        $password_err = "Password must include at least one symbol.";
    } else{
        $password = $input_password;
	}
	
	// Validate repassword
	$input_repassword = $_POST["repassword"];
	if(empty($input_repassword)){
		$repassword_err = "You must repeat the password.";
	} elseif($input_repassword != $input_password){
		$repassword_err = "Password is not the same.";
	} else{
		$repassword = $input_repassword;
	}
    
    // Check input errors before inserting in database
    if(empty($username_err) && empty($password_err) && empty($email_err) && empty($repassword_err)){




		$sql = "SELECT * FROM users WHERE user_email = :email";
    
		if($stmt = $pdo->prepare($sql)){
			// Bind variables to the prepared statement as parameters
			$stmt->bindParam(":email", $param_email);
			
			// Set parameters
			$param_email = $email;
			
			// Attempt to execute the prepared statement
			if($stmt->execute()){
				if($stmt->rowCount() > 0){
					$email_err = "Email already exists.";
				} 
				
			} else{
				echo "Oops! Something went wrong. Please try again later.";
			}


	}
}

	if(empty($username_err) && empty($password_err) && empty($email_err) && empty($repassword_err)){
		$sql = "INSERT INTO users (user_name, user_password, user_email, user_status) VALUES (:username, :user_password, :user_email, :user_status)";
        if( $stmt = $pdo->prepare($sql)  ){
            // Bind variables to the prepared statement as parameters
			$stmt->bindParam(":username", $param_username);
			$stmt->bindParam(":user_password", $param_password);
			$stmt->bindParam(":user_email", $param_email);
			$stmt->bindParam(":user_status", $param_status);
            
            // Set parameters
			$param_username = $username;
			$options = [
				'cost' => 12,
			];
			$param_password = password_hash( $password, PASSWORD_DEFAULT, $options);
			$param_email = $email;
			$param_status = 'active';
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
				// Records created successfully. Redirect to landing page
				$_SESSION["username"] = $param_email;
                //header("location: ../plan.php");
                //exit();
            } else{
                echo "Something went wrong. Please try again later.";
            }
        }
         
		// Close statement
		
        unset($stmt);
	} 


	if(empty($username_err) && empty($password_err) && empty($email_err) && empty($repassword_err)){
		$sql = "SELECT user_id FROM users ORDER BY user_id DESC limit 1";
    
		if($stmt = $pdo->prepare($sql)){
			// Bind variables to the prepared statement as parameters
			$stmt->execute(); 
			$user = $stmt->fetch();
			
			// Attempt to execute the prepared statement
			
			if($stmt->rowCount() != 0){
					$_SESSION["id"] = $user['user_id'];
					header("location: ../plan.php");
					exit();
			}
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
						REGISTER
					</span>

					<div class="wrap-input100" >
						<input class="input100" type="text" name="username" placeholder="Name" value="<?= isset($_POST['username']) ? $_POST['username'] : ''; ?>">
						<span class="focus-input100" data-placeholder="&#xf207;"></span>
					</div>
					<div style="color:red;"><?php echo $username_err; ?></div>
					<div class="wrap-input100" >
						<input class="input100" type="text" name="email" placeholder="Email" value="<?= isset($_POST['email']) ? $_POST['email'] : ''; ?>">
						<span class="focus-input100" data-placeholder="&#xf15a;"></span>
					</div>
					<div style="color:red;"><?php echo $email_err; ?></div>
					<div class="wrap-input100" >
						<input class="input100" type="password" name="password" placeholder="Password" id="password-field" value="<?= isset($_POST['password']) ? $_POST['password'] : ''; ?>">
						<span class="focus-input100" data-placeholder="&#xf191;"></span>
						<span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password" style="color:white"></span>
					</div>
					<div style="color:red;"><?php echo $password_err; ?></div>
					<div class="wrap-input100" >
						<input class="input100" type="password" name="repassword" placeholder="Confirm Password" id="repassword-field" value="<?= isset($_POST['repassword']) ? $_POST['repassword'] : ''; ?>">
						<span class="focus-input100" data-placeholder="&#xf191;"></span>
						<span toggle="#repassword-field" class="fa fa-fw fa-eye field-icon toggle-password" style="color:white"></span>
					</div>
					<div style="color:red;"><?php echo $repassword_err; ?></div>
					
					<div class="container-login100-form-btn">
						<button class="login100-form-btn">
							Register
						</button>
					</div>

					<div class="text-center p-t-90">
						Already have an account? <br>
						<a class="txt1" href="login.php">
							Login
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

	<script>
		$(".toggle-password").click(function() {

		$(this).toggleClass("fa-eye fa-eye-slash");
		var input = $($(this).attr("toggle"));
		if (input.attr("type") == "password") {
		input.attr("type", "text");
		} else {
		input.attr("type", "password");
		}
		});
	</script>

</body>
</html>