<?php
include "db.php";

if(isset($_POST['user_id']) && isset($_POST['post'])){

    $user_id = intval($_POST['user_id']);
    $post = mysqli_real_escape_string($conn, $_POST['post']);
    $date = date("Y-m-d H:i:s");

    if($post == ""){
        echo "error";
        exit();
    }

    $query = mysqli_query($conn, "
        INSERT INTO tWall (user_id, post, posting_date)
        VALUES ($user_id, '$post', '$date')
    ");

    if($query){
        echo "success";
    } else {
        echo "error";
    }

} else {
    echo "error";
}
?>
