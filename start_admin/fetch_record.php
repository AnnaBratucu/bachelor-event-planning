
<?php
require_once "../config.php";
//Include database connection
if($_POST['rowid']) {
    $id = $_POST['rowid']; //escape string
    $sql2 = "SELECT * FROM venues WHERE venue_id = '$id'";
    if($stmt2 = $pdo->query($sql2)){

    while($venue = $stmt2->fetch()) {



        $sql1 = "SELECT file_name FROM venue_files WHERE venue_id = :venue_id";

        if($stmt1 = $pdo->prepare($sql1)){
            $stmt1->execute(['venue_id' => $id]); 
            $venue_file = $stmt1->fetch();
            //print_r($venue_file);
       // echo $venue[ 'venue_name' ];
       $data[ 'id' ] = $venue[ 'venue_id' ];
       $data[ 'name' ] = $venue[ 'venue_name' ];
       $data[ 'capacity' ] = $venue[ 'venue_capacity' ];
       $data[ 'price' ] = $venue[ 'venue_rent_price' ];
       $data[ 'address' ] = $venue[ 'venue_address' ];
       $data[ 'phone' ] = $venue[ 'venue_phone' ];
       $data[ 'type' ] = $venue[ 'venue_type' ];
       $data[ 'observations' ] = $venue[ 'venue_observations' ];
       if( !empty($venue[ 'venue_gmaps' ]) ){
        $data[ 'gmaps_choose' ] = 'yes';
       } else {
        $data[ 'gmaps_choose' ] = 'no';
       }
       $data[ 'gmaps' ] = $venue[ 'venue_gmaps' ];
       $data['file_name'] = $venue_file;
    } 
    echo json_encode($data);
}
 }
}
?>
