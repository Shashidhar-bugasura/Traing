<?php
include "db.php";

$user_id = intval($_POST['user_id']);
$post = $_POST['post'];

$sql = "INSERT INTO tWall(user_id, post) VALUES($user_id, '$post')";
mysqli_query($conn, $sql);

header("Location: index.php?user_id=$user_id");
?>
