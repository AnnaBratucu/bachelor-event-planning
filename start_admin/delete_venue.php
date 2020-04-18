<?php include '../head.php'; 


require_once "../config.php";

session_start();

if( !isset($_SESSION['username']) ){
	header("location: ../log/login.php"); // send to home page
	exit; 
 }
 


	$input_id = $_GET["venue_id"];

	$sql = "DELETE FROM venues WHERE venue_id= :venue_id";

	if( $stmt = $pdo->prepare($sql)  ){
		$stmt->bindParam(":venue_id", $param_id);
			
			// Set parameters
			$param_id = $input_id;

			$stmt->execute();
	} else {
		echo "Error deleting record";
	}

	unset($stmt);

	$sql = "DELETE FROM venue_files WHERE venue_id= :venue_id";

	if( $stmt = $pdo->prepare($sql)  ){
		$stmt->bindParam(":venue_id", $param_id);
			
			// Set parameters
			$param_id = $input_id;

			$stmt->execute();
	} else {
		echo "Error deleting record";
	}

	unset($stmt);

	$sql = "DELETE FROM tbl_events WHERE venue_id= :venue_id";

	if( $stmt = $pdo->prepare($sql)  ){
		$stmt->bindParam(":venue_id", $param_id);
			
			// Set parameters
			$param_id = $input_id;

			$stmt->execute();
	} else {
		echo "Error deleting record";
	}

	unset($stmt);


	header("location: wizard_admin.php");
	exit();

?>