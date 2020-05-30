
<?php
require_once "../config.php";
//Include database connection
if($_POST['rowid']) {
    $id = $_POST['rowid']; //escape string
    $sql2 = "SELECT * FROM ceremonies WHERE ceremony_id = '$id'";
    if($stmt2 = $pdo->query($sql2)){

    while($venue = $stmt2->fetch()) {



        $sql1 = "SELECT file_name FROM ceremony_files WHERE ceremony_id = :ceremony_id";

        if($stmt1 = $pdo->prepare($sql1)){
            $stmt1->execute(['ceremony_id' => $id]); 
            $venue_file = $stmt1->fetch();
            //print_r($venue_file);
       // echo $venue[ 'venue_name' ];
       $data[ 'id' ] = $venue[ 'ceremony_id' ];
       $data[ 'name' ] = $venue[ 'ceremony_name' ];
       $data[ 'capacity' ] = $venue[ 'ceremony_capacity' ];
       $data[ 'address' ] = $venue[ 'ceremony_address' ];
       $data[ 'phone' ] = $venue[ 'ceremony_phone' ];
       $data[ 'live' ] = $venue[ 'ceremony_live' ];
       $data[ 'bell' ] = $venue[ 'ceremony_bell' ];
       $data[ 'flower' ] = $venue[ 'ceremony_flower' ];
       $data[ 'heat' ] = $venue[ 'ceremony_heat' ];
       $data[ 'observations' ] = $venue[ 'ceremony_observations' ];
       $data['file_name'] = $venue_file;
    } 
    echo json_encode($data);
}
 }
}
?>
