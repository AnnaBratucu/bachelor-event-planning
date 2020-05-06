
<?php
require_once "../config.php";
if($_POST['rowid']) {
    $id = $_POST['rowid']; //escape string
    $sql2 = "SELECT * FROM guests WHERE guest_id = '$id'";
    if($stmt2 = $pdo->query($sql2)){
        while($guest = $stmt2->fetch()) {
            $data[ 'id' ] = $guest[ 'guest_id' ];
            $data[ 'name' ] = $guest[ 'guest_name' ];
            $data[ 'email' ] = $guest[ 'guest_email' ];
        } 
        echo json_encode($data);
    }
}

?>
