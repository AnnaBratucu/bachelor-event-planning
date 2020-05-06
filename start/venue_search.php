<!DOCTYPE html>
<html lang="en">
<?php 
require_once "../config.php";

session_start();


$event_id = $_GET[ 'event_id' ];

$_SESSION[ 'venue_search_name' ] = $_POST[ 'name' ];

header("Location: ../start_admin/wizard_admin.php?event_id=" . $event_id);

?>

    
</body>
</html>