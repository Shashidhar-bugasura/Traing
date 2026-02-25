<?php
include "db.php";

$user_id = intval($_POST['user_id']);
$name = $_POST['name'];
$email = $_POST['email_id'];
$password = $_POST['password'];
$address = $_POST['address'];
$phone = $_POST['phone'];

$sql = "UPDATE tUser SET 
        name='$name',
        email_id='$email',
        password='$password',
        address='$address',
        phone='$phone'
        WHERE user_id=$user_id";

mysqli_query($conn, $sql);

header("Location: index.php?user_id=$user_id");
?>
