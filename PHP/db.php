<?php
$host = "localhost";
$user = "root";       
$password = "Shashi";   
$database = "facebookdb";

$conn = mysqli_connect($host, $user, $password, $database);

if (!$conn) {
    die("MySQL Connection Failed: " . mysqli_connect_error());
}
?>
