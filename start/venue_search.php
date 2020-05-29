<!DOCTYPE html>
<html lang="en">
<?php 
require_once "../config.php";

session_start();

if( isset($_POST['search']) ){
    if( isset( $_GET[ 'event_id' ] ) && !isset( $_GET[ 'page' ] ) ){
        $event_id = $_GET[ 'event_id' ];

        $_SESSION[ 'venue_search_name' ] = $_POST[ 'name' ];
        $_SESSION[ 'venue_search_price_min' ] = $_POST[ 'price_min' ];
        $_SESSION[ 'venue_search_price_max' ] = $_POST[ 'price_max' ];
        $_SESSION[ 'venue_search_address' ] = $_POST[ 'address' ];
        $_SESSION[ 'venue_search_capacity_min' ] = $_POST[ 'capacity_min' ];
        $_SESSION[ 'venue_search_capacity_max' ] = $_POST[ 'capacity_max' ];

        header("Location: ../start_admin/wizard_admin.php?event_id=" . $event_id);
    }else{
        $_SESSION[ 'venue_search_name' ] = $_POST[ 'name' ];
        $_SESSION[ 'venue_search_price_min' ] = $_POST[ 'price_min' ];
        $_SESSION[ 'venue_search_price_max' ] = $_POST[ 'price_max' ];
        $_SESSION[ 'venue_search_address' ] = $_POST[ 'address' ];
        $_SESSION[ 'venue_search_capacity_min' ] = $_POST[ 'capacity_min' ];
        $_SESSION[ 'venue_search_capacity_max' ] = $_POST[ 'capacity_max' ];

        header("Location: ../start_admin/wizard_admin.php");
    }
    if( isset( $_GET[ 'page' ] ) ){
        $event_id = $_GET[ 'event_id' ];

        $_SESSION[ 'venue_search_name' ] = $_POST[ 'name' ];
        $_SESSION[ 'venue_search_price_min' ] = $_POST[ 'price_min' ];
        $_SESSION[ 'venue_search_price_max' ] = $_POST[ 'price_max' ];
        $_SESSION[ 'venue_search_address' ] = $_POST[ 'address' ];
        $_SESSION[ 'venue_search_capacity_min' ] = $_POST[ 'capacity_min' ];
        $_SESSION[ 'venue_search_capacity_max' ] = $_POST[ 'capacity_max' ];

        header("Location: list_favourites.php?event_id=" . $event_id);
    }
}else{
    if( !isset( $_GET[ 'page' ] ) ){
        $event_id = $_GET[ 'event_id' ];

        unset($_SESSION[ 'venue_search_name' ]);
        unset($_SESSION[ 'venue_search_price_min' ]);
        unset($_SESSION[ 'venue_search_price_max' ]);
        unset($_SESSION[ 'venue_search_address' ]);
        unset($_SESSION[ 'venue_search_capacity_min' ]);
        unset($_SESSION[ 'venue_search_capacity_max' ]);
        
        header("Location: ../start_admin/wizard_admin.php?event_id=" . $event_id);
    }else{
        $event_id = $_GET[ 'event_id' ];

        unset($_SESSION[ 'venue_search_name' ]);
        unset($_SESSION[ 'venue_search_price_min' ]);
        unset($_SESSION[ 'venue_search_price_max' ]);
        unset($_SESSION[ 'venue_search_address' ]);
        unset($_SESSION[ 'venue_search_capacity_min' ]);
        unset($_SESSION[ 'venue_search_capacity_max' ]);
        
        header("Location: list_favourites.php?event_id=" . $event_id);
    }
}
?>

    
</body>
</html>