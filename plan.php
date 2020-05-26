<!DOCTYPE html>
<html>
	<?php 
		include 'head.php'; 
		require_once('settings.php');
		require_once('google-login-api.php');
		
	// Google passes a parameter 'code' in the Redirect Url
	if(isset($_GET['code'])) {
		try {
			$gapi = new GoogleLoginApi();
			
			// Get the access token 
			$data = $gapi->GetAccessToken(CLIENT_ID, CLIENT_REDIRECT_URL, CLIENT_SECRET, $_GET['code']);
			
			// Get user information
			$user_info = $gapi->GetUserProfileInfo($data['access_token']);
		}
		catch(Exception $e) {
			echo $e->getMessage();
			exit();
		}

		if(empty($_SESSION)) // if the session not yet started
		session_start();
		$_SESSION["username"] = $user_info['email'];

	}
	?>

	
	<body>

		<?php
			if(empty($_SESSION)) // if the session not yet started
			session_start();

			if(!isset($_SESSION['username'])) { //if not yet logged in
			header("Location: log/login.php");// send to login page
			exit;
			}
			if( $_SESSION['username'] != 'admin@yahoo.com' ){
		?>

		<div class="header">
			<?php include 'header.php'; ?>
		
			<div class="header_side">
				<h1>Be a guest at your own event.</h1>
				<div class="space1"></div>
				<p>Some events you attend,</p>
				<p>Some you keep.</p>
				<div class="space"></div>
				
				<a href="start/start.php" class="start"><span>START!</span></a>
				
			</div>

		</div>
		
		
		<?php } else{ ?>
			<div class="header">
			<?php include 'header.php'; ?>

			<div class="header_side">
				<h1>New collaborations?</h1>
				<div class="space"></div>
				<a href="start_admin/wizard_admin.php" class="start"><span>ADD!</span></a>
			</div>
			</div>
		<?php } ?>
		<div style="height:200px;"></div>
		<?php include 'footer.php';  ?>
	</body>
	
</html> 


