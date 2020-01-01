<?php
echo 
'<!DOCTYPE html>
<html>
	<head>';
		if( basename($_SERVER['PHP_SELF']) == 'plan.php' || basename($_SERVER['PHP_SELF']) == 'contact.php' ){ echo '
		<link rel="stylesheet" type="text/css" href="styles/style.css">
		<link rel = "icon" href ="log/images/hi.png" type = "image/x-icon"> ';}
		else if( basename($_SERVER['PHP_SELF']) == 'register.php' || basename($_SERVER['PHP_SELF']) == 'login.php' || basename($_SERVER['PHP_SELF']) == 'forgot.php' || basename($_SERVER['PHP_SELF']) == 'message.php' || basename($_SERVER['PHP_SELF']) == 'reset.php' ){ echo '
			<meta charset="UTF-8">
			<meta name="viewport" content="width=device-width, initial-scale=1">
			<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
			<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
			<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
			<link rel="stylesheet" type="text/css" href="fonts/iconic/css/material-design-iconic-font.min.css">
			<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
			<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
			<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
			<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">	
			<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
			<link rel="stylesheet" type="text/css" href="css/util.css">
			<link rel="stylesheet" type="text/css" href="css/main.css">
			<link rel = "icon" href ="images/hi.png" type = "image/x-icon">';
		}
		else if( basename($_SERVER['PHP_SELF']) == 'start.php' ){ echo '
			<link rel="stylesheet" type="text/css" href="../styles/style_transition.css">
			<link rel = "icon" href ="../log/images/hi.png" type = "image/x-icon"> 
			<link href="https://fonts.googleapis.com/css?family=Fira Sans" rel="stylesheet">';
		}
		else if( basename($_SERVER['PHP_SELF']) == 'wizard.php' || basename($_SERVER['PHP_SELF']) == 'wizard_step1.php' || basename($_SERVER['PHP_SELF']) == 'food.php' || basename($_SERVER['PHP_SELF']) == 'wizard_novenue.php'|| basename($_SERVER['PHP_SELF']) == 'budget.php' || basename($_SERVER['PHP_SELF']) == 'surveys.php' ){ echo '
			<meta charset="utf-8"/>
			<meta http-equiv="X-UA-Compatible" content=="IE=edge"/>
			<meta name="google" value="notranslate"/>
			<title>Start your profile</title>
			<link rel = "icon" href ="../log/images/hi.png" type = "image/x-icon"> 

			<meta charset="utf-8">
			<meta name="viewport" content="width=device-width, initial-scale=1.0">

			<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
			<link rel="stylesheet" href="/resources/demos/style.css">

			<link rel="stylesheet" type="text/css" href="../styles/wizard.css">
			<link rel="stylesheet" type="text/css" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">';
		}
		else if( basename($_SERVER['PHP_SELF']) == 'guests.php' ){ echo '
			<meta charset="utf-8"/>
			<meta http-equiv="X-UA-Compatible" content=="IE=edge"/>
			<meta name="google" value="notranslate"/>
			<title>Start your profile</title>
			<link rel = "icon" href ="../log/images/hi.png" type = "image/x-icon"> 

			<meta charset="utf-8">
			<meta name="viewport" content="width=device-width, initial-scale=1.0">

			<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
			<link rel="stylesheet" href="/resources/demos/style.css">

			<link rel="stylesheet" type="text/css" href="../styles/wizard.css">
			<link rel="stylesheet" type="text/css" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">

			<link rel="stylesheet" type="text/css" href="../vendor/bootstrap/css/bootstrap.min.css">
			<link rel="stylesheet" type="text/css" href="../fonts/font-awesome-4.7.0/css/font-awesome.min.css">
			<link rel="stylesheet" type="text/css" href="../vendor/animate/animate.css">
			<link rel="stylesheet" type="text/css" href="../vendor/select2/select2.min.css">
			<link rel="stylesheet" type="text/css" href="../vendor/perfect-scrollbar/perfect-scrollbar.css">
			<link rel="stylesheet" type="text/css" href="../styles/util_guests.css">
			<link rel="stylesheet" type="text/css" href="../styles/main_guests.css">';
			}
		else if( basename($_SERVER['PHP_SELF']) == 'eventType.php' || basename($_SERVER['PHP_SELF']) == 'choice.php' ){ echo '
			<title>Event Type</title>
			<meta charset="UTF-8">
			<meta name="viewport" content="width=device-width, initial-scale=1">
			<link rel = "icon" href ="../log/images/hi.png" type = "image/x-icon"> 
			<link rel="stylesheet" type="text/css" href="../vendor/bootstrap/css/bootstrap.min.css">
			<link rel="stylesheet" type="text/css" href="../fonts/font-awesome-4.7.0/css/font-awesome.min.css">
			<link rel="stylesheet" type="text/css" href="../fonts/iconic/css/material-design-iconic-font.min.css">
			<link rel="stylesheet" type="text/css" href="../vendor/animate/animate.css">
			<link rel="stylesheet" type="text/css" href="../vendor/css-hamburgers/hamburgers.min.css">
			<link rel="stylesheet" type="text/css" href="../vendor/animsition/css/animsition.min.css">
			<link rel="stylesheet" type="text/css" href="../vendor/select2/select2.min.css">
			<link rel="stylesheet" type="text/css" href="../vendor/daterangepicker/daterangepicker.css">
			<link rel="stylesheet" type="text/css" href="../styles/util_eventType.css">
			<link rel="stylesheet" type="text/css" href="../styles/main_eventType.css">
			<link href="https://fonts.googleapis.com/css?family=Fira Sans" rel="stylesheet">';
		}
		echo '
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link href="https://fonts.googleapis.com/css?family=Livvic&display=swap" rel="stylesheet">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">	
		<script src="https://kit.fontawesome.com/b48c0c89f2.js" crossorigin="anonymous"></script>
	</head> ';
?>