<?php include '../head.php'; ?>
<title>Password Recovery</title>

<body>
	
	<div class="limiter">
		<div class="container-login100" style="background-image: url('../images/good.jpg');">
			<div class="wrap-login100">
				<form class="login100-form validate-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
					<span class="login100-form-logo">
						<img src="images/Sbis.png">
					</span><br>

					<p class="txt1" style="font-size:22px; text-align:center;">An email was sent to you.</p> <br>

					<div class="text-center p-t-90">
                        <a class="txt1" href="login.php">
							Login!
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