<?php include '../head.php'; 


require_once "../config.php";

session_start();

if( !isset($_SESSION['username']) ){
	header("location: ../log/login.php"); // send to home page
	exit; 
 }
 


	$input_id = $_GET["food_id"];

	$sql = "DELETE FROM food WHERE food_id= :food_id";

	if( $stmt = $pdo->prepare($sql)  ){
		$stmt->bindParam(":food_id", $param_id);
			
			// Set parameters
			$param_id = $input_id;

			$stmt->execute();
	} else {
		echo "Error deleting record";
	}

	unset($stmt);

	$sql = "DELETE FROM food_files WHERE food_id= :food_id";

	if( $stmt = $pdo->prepare($sql)  ){
		$stmt->bindParam(":food_id", $param_id);
			
			// Set parameters
			$param_id = $input_id;

			$stmt->execute();
	} else {
		echo "Error deleting record";
	}

	unset($stmt);

	header("location: food_admin.php");
	exit();

?>