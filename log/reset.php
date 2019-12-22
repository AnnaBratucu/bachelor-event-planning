<title>Reset password</title>
<?php include '../head.php';
require_once "../config.php";

if(empty($_SESSION)) // if the session not yet started
   session_start();

// Define variables and initialize with empty values
$password = $repassword = "";
$password_err = $repassword_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
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
    if(empty($repassword_err) && empty($password_err) ){

		$sql = "UPDATE users SET user_password = :password WHERE user_email = :email";
    
		if( $stmt = $pdo->prepare($sql)  ){
            // Bind variables to the prepared statement as parameters
			$stmt->bindParam(":password", $param_password);
			$stmt->bindParam(":email", $param_email);
            
            // Set parameters
			$options = [
				'cost' => 12,
			];
			$param_password = password_hash( $password, PASSWORD_DEFAULT, $options);
			$param_email = $_SESSION[ 'username' ];
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
				// Records created successfully. Redirect to landing page
                header("location: ../plan.php");
                exit();
            } else{
                echo "Something went wrong. Please try again later.";
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
						<img src="images/Sbis.png">
					</span>

					<span class="login100-form-title p-b-34 p-t-27">
						Reset password
					</span>

					<div class="wrap-input100" >
						<input class="input100" type="password" name="password" placeholder="New Password" id="password-field" value="<?= isset($_POST['password']) ? $_POST['password'] : ''; ?>">
						<span class="focus-input100" data-placeholder="&#xf191;"></span>
						<span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password" style="color:white"></span>
					</div>
					<div style="color:red;"><?php echo $password_err; ?></div>

                    <div class="wrap-input100" >
						<input class="input100" type="password" name="repassword" placeholder="Confirm New Password" id="repassword-field" value="<?= isset($_POST['repassword']) ? $_POST['repassword'] : ''; ?>">
						<span class="focus-input100" data-placeholder="&#xf191;"></span>
						<span toggle="#repassword-field" class="fa fa-fw fa-eye field-icon toggle-password" style="color:white"></span>
					</div>
					<div style="color:red;"><?php echo $repassword_err; ?></div>

					<div class="contact100-form-checkbox">
						<input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">
						<label class="label-checkbox100" for="ckb1">
							Remember me
						</label>
					</div>

					<div class="container-login100-form-btn">
						<button class="login100-form-btn">
							Reset
						</button>
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