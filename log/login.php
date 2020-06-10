<title>Login</title>
<?php include '../head.php';
require_once '../settings.php'; 
require_once "../config.php";

if(empty($_SESSION)) // if the session not yet started
   session_start();
if(isset($_SESSION['username'])) { // if already login
	header("location: ../plan.php"); // send to home page
	exit; 
 }
// Define variables and initialize with empty values
$password = $email = "";
$password_err = $email_err = "";
 
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
    
    // Validate password
    $input_password = $_POST["password"];
    if(empty($input_password)){
        $password_err = "Password field is required.";     
    } else{
        $password = $input_password;
	}
	
    // Check input errors before inserting in database
    if(empty($username_err) && empty($password_err) && empty($email_err) && empty($repassword_err)){

		$sql = "SELECT * FROM users WHERE user_email = :email";
    
		if($stmt = $pdo->prepare($sql)){
			// Bind variables to the prepared statement as parameters
			$stmt->execute(['email' => $input_email]); 
			$user = $stmt->fetch();
			
			// Attempt to execute the prepared statement
			
			if($stmt->rowCount() == 0){
				$email_err = "Email doesn't exist.";
			} else{
				if( !password_verify( $input_password, $user['user_password'] ) ){
					$password_err = "Incorrect password.";
				} else{
					$_SESSION["username"] = $input_email;
					$_SESSION["id"] = $user['user_id'];
					header("location: ../plan.php");
					exit();
				}
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
						Log in
					</span>

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

					<div class="container-login100-form-btn">
						<button class="login100-form-btn">
							Login
						</button>
					</div>

					<div class="text-center p-t-90">
						<a class="txt1" href="forgot.php">
							Forgot Password?
						</a> <br>
						<a class="txt1" href="register.php">
							Don't have an account? Register!
						</a> <br>
						<a class="txt1" id="login-button" href="<?= 'https://accounts.google.com/o/oauth2/auth?scope=' . urlencode('https://www.googleapis.com/auth/userinfo.profile https://www.googleapis.com/auth/userinfo.email') . '&redirect_uri=' . urlencode(CLIENT_REDIRECT_URL) . '&response_type=code&client_id=' . CLIENT_ID . '&access_type=online' ?>">
							Or Login with Google!
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