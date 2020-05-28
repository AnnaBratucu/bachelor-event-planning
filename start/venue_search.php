<!DOCTYPE html>
<html lang="en">
<?php 
require_once "../config.php";

session_start();

if( isset( $_GET[ 'event_id' ] ) ){
    $event_id = $_GET[ 'event_id' ];

    $_SESSION[ 'venue_search_name' ] = $_POST[ 'name' ];

    header("Location: ../start_admin/wizard_admin.php?event_id=" . $event_id);
}else{
    $_SESSION[ 'venue_search_name' ] = $_POST[ 'name' ];

    header("Location: ../start_admin/wizard_admin.php");
}
?>

    
</body>
</html>