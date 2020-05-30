<!DOCTYPE html>
<html lang="en">
<?php 
require_once "../config.php";

session_start();

if( isset($_POST['search']) ){
    if( isset( $_GET[ 'event_id' ] ) ){
        $event_id = $_GET[ 'event_id' ];

        $_SESSION[ 'category' ] = $_POST[ 'category' ];
        
        header("Location: list_favourites.php?event_id=" . $event_id);
    }
}else{
    $event_id = $_GET[ 'event_id' ];

    unset($_SESSION[ 'category' ]);
    
    header("Location: list_favourites.php?event_id=" . $event_id);
}
?>

    
</body>
</html>