<?php
    require_once "db.php";
    $id = $_GET['venue_id'];
    //$id = isset($_POST['venue_id']) ? $_POST['venue_id'] : "";
    $json = array();
    $sqlQuery = "SELECT * FROM tbl_events WHERE venue_id=".$id." ORDER BY id";

    $result = mysqli_query($conn, $sqlQuery);
    $eventArray = array();
    while ($row = mysqli_fetch_assoc($result)) {
        array_push($eventArray, $row);
    }
    mysqli_free_result($result);

    mysqli_close($conn);
    echo json_encode($eventArray);
?>