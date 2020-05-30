<!DOCTYPE html>
<html lang="en">
<?php 
require_once "../config.php";

session_start();

if( isset($_POST['search']) ){
    if( isset( $_GET[ 'event_id' ] ) && !isset( $_GET[ 'page' ] ) ){
        $event_id = $_GET[ 'event_id' ];

        $_SESSION[ 'venue_search_name' ] = $_POST[ 'name' ];
        $_SESSION[ 'venue_search_address' ] = $_POST[ 'address' ];
        
        header("Location: ../start_admin/ceremony_admin.php?event_id=" . $event_id);
    }else{
        $_SESSION[ 'venue_search_name' ] = $_POST[ 'name' ];
        $_SESSION[ 'venue_search_address' ] = $_POST[ 'address' ];
        
        header("Location: ../start_admin/ceremony_admin.php");
    }
    if( isset( $_GET[ 'page' ] ) ){
        $event_id = $_GET[ 'event_id' ];

        $_SESSION[ 'venue_search_name' ] = $_POST[ 'name' ];
        $_SESSION[ 'venue_search_address' ] = $_POST[ 'address' ];
       
        header("Location: list_favourites.php?event_id=" . $event_id);
    }
}else{
    if( !isset( $_GET[ 'page' ] ) ){
        $event_id = $_GET[ 'event_id' ];

        unset($_SESSION[ 'venue_search_name' ]);
        unset($_SESSION[ 'venue_search_address' ]);
        
        header("Location: ../start_admin/ceremony_admin.php?event_id=" . $event_id);
    }else{
        $event_id = $_GET[ 'event_id' ];

        unset($_SESSION[ 'venue_search_name' ]);
        unset($_SESSION[ 'venue_search_address' ]);
        
        header("Location: list_favourites.php?event_id=" . $event_id);
    }
}
?>

    
</body>
</html>