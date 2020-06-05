
<?php
require_once "../config.php";
//Include database connection
if($_POST['rowid']) {
    $id = $_POST['rowid']; //escape string
    $sql2 = "SELECT * FROM food WHERE food_id = '$id'";
    if($stmt2 = $pdo->query($sql2)){

    while($venue = $stmt2->fetch()) {



        $sql1 = "SELECT file_name FROM food_files WHERE food_id = :food_id";

        if($stmt1 = $pdo->prepare($sql1)){
            $stmt1->execute(['food_id' => $id]); 
            $food_file = $stmt1->fetch();
            //print_r($venue_file);
       // echo $venue[ 'venue_name' ];
       $data[ 'id' ] = $venue[ 'food_id' ];
       $data[ 'name' ] = $venue[ 'food_name' ];
       $data[ 'ven' ] = $venue[ 'venue_id' ];
       $data[ 'price' ] = $venue[ 'food_price' ];
       $data[ 'categ' ] = $venue[ 'food_category' ];
       $data[ 'ingredients' ] = $venue[ 'food_ingredients' ];
       $data[ 'grams' ] = $venue[ 'food_grams' ];
       
       $data['file_name'] = $food_file;
    } 
    echo json_encode($data);
}
 }
}
?>
