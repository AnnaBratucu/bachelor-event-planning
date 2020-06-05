<!DOCTYPE html>
<html lang="en">
<?php 
require_once "../config.php";

session_start();

if( isset($_POST['search']) ){
    if( isset( $_GET[ 'event_id' ] ) && !isset( $_GET[ 'page' ] ) ){
        $event_id = $_GET[ 'event_id' ];

        $_SESSION[ 'food_search_category' ] = $_POST[ 'category' ];
        
        header("Location: ../start_admin/food_admin.php?event_id=" . $event_id);
    }else{
        
        $_SESSION[ 'food_search_category' ] = $_POST[ 'category' ];

        header("Location: ../start_admin/food_admin.php");
    }
    if( isset( $_GET[ 'page' ] ) ){
        $event_id = $_GET[ 'event_id' ];

        $_SESSION[ 'food_search_category' ] = $_POST[ 'caegory' ];
        
        header("Location: list_favourites.php?event_id=" . $event_id);
    }
}else{
    if( isset( $_GET[ 'event_id' ] ) && !isset( $_GET[ 'page' ] ) ){
        $event_id = $_GET[ 'event_id' ];

        unset($_SESSION[ 'food_search_category' ]);
        
        header("Location: ../start_admin/food_admin.php?event_id=" . $event_id);
    }else{
        $event_id = $_GET[ 'event_id' ];

        unset($_SESSION[ 'food_search_category' ]);
       
        header("Location: ../start_admin/food_admin.php");
    }
    if( isset( $_GET[ 'page' ] ) ){
        $event_id = $_GET[ 'event_id' ];

        unset($_SESSION[ 'food_search_category' ]);
        
        header("Location: list_favourites.php?event_id=" . $event_id);
    }
}
?>

    
</body>
</html>