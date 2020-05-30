<?php
require_once "db.php";

$title = isset($_POST['title']) ? $_POST['title'] : "";
$start = isset($_POST['start']) ? $_POST['start'] : "";
$end = isset($_POST['end']) ? $_POST['end'] : "";
$ceremony_id = isset($_POST['ceremony_id']) ? $_POST['ceremony_id'] : "";

$sqlInsert = "INSERT INTO tbl_events_ceremony (title,start,end,ceremony_id) VALUES ('".$title."','".$start."','".$end ."','".$ceremony_id ."')";

$result = mysqli_query($conn, $sqlInsert);

if (! $result) {
    $result = mysqli_error($conn);
}
?>