<?php
require_once "db.php";

$id  = isset($_POST['id']) ? $_POST['id'] : "";
$title = isset($_POST['title']) ? $_POST['title'] : "";
$start = isset($_POST['start']) ? $_POST['start'] : "";
$end = isset($_POST['end']) ? $_POST['end'] : "";
$ceremony_id = isset($_POST['ceremony_id']) ? $_POST['ceremony_id'] : "";


$sqlUpdate = "UPDATE tbl_events_ceremony SET title='".$title."',start='".$start."',end='".$end."',ceremony_id='".$ceremony_id."' WHERE id=".$id;

$result = mysqli_query($conn, $sqlUpdate);

if (! $result) {
    $result = mysqli_error($conn);
}

?>