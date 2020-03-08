<?php
$conn = mysqli_connect("localhost","root","","plan") ;

if (!$conn)
{
echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
?>