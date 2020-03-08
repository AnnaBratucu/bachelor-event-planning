<?php
require_once "db.php";

$title = isset($_POST['title']) ? $_POST['title'] : "";
$start = isset($_POST['start']) ? $_POST['start'] : "";
$end = isset($_POST['end']) ? $_POST['end'] : "";
$venue_id = isset($_POST['venue_id']) ? $_POST['venue_id'] : "";

$sqlInsert = "INSERT INTO tbl_events (title,start,end,venue_id) VALUES ('".$title."','".$start."','".$end ."','".$venue_id ."')";

$result = mysqli_query($conn, $sqlInsert);

if (! $result) {
    $result = mysqli_error($conn);
}
?>