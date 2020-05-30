<?php include '../head.php'; 


require_once "../config.php";

session_start();

if( !isset($_SESSION['username']) ){
	header("location: ../log/login.php"); // send to home page
	exit; 
 }
 


	$input_id = $_GET["ceremony_id"];

	$sql = "DELETE FROM ceremonies WHERE ceremony_id= :ceremony_id";

	if( $stmt = $pdo->prepare($sql)  ){
		$stmt->bindParam(":ceremony_id", $param_id);
			
			// Set parameters
			$param_id = $input_id;

			$stmt->execute();
	} else {
		echo "Error deleting record";
	}

	unset($stmt);

	$sql = "DELETE FROM ceremony_files WHERE ceremony_id= :ceremony_id";

	if( $stmt = $pdo->prepare($sql)  ){
		$stmt->bindParam(":ceremony_id", $param_id);
			
			// Set parameters
			$param_id = $input_id;

			$stmt->execute();
	} else {
		echo "Error deleting record";
	}

	unset($stmt);

	$sql = "DELETE FROM tbl_events_ceremony WHERE ceremony_id= :ceremony_id";

	if( $stmt = $pdo->prepare($sql)  ){
		$stmt->bindParam(":ceremony_id", $param_id);
			
			// Set parameters
			$param_id = $input_id;

			$stmt->execute();
	} else {
		echo "Error deleting record";
	}

	unset($stmt);


	header("location: ceremony_admin.php");
	exit();

?>