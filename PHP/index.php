<?php
include "db.php";

$user_id = isset($_GET['user_id']) ? intval($_GET['user_id']) : 1;

// INSERT POST (if submitted) 
if (isset($_POST['add_post'])) {
    $post = mysqli_real_escape_string($conn, $_POST['post']);
    $date = date("Y-m-d H:i:s");
    
    mysqli_query($conn, "
        INSERT INTO tWall (user_id, post, posting_date)
        VALUES ($user_id, '$post', '$date')
    ");
}

// GET USER DETAILS
$userQuery = mysqli_query($conn, "SELECT * FROM tUser WHERE user_id=$user_id");
$user = mysqli_fetch_assoc($userQuery);


// GET FRIENDS
$friendsQuery = mysqli_query($conn, "
    SELECT tUser.user_id, tUser.name 
    FROM tFriends 
    JOIN tUser ON tFriends.friend_id = tUser.user_id 
    WHERE tFriends.user_id = $user_id
");


// GET WALL POSTS
$wallQuery = mysqli_query($conn, "
    SELECT * FROM tWall 
    WHERE user_id = $user_id 
    ORDER BY posting_date DESC
");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Social Media</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="wrapper">

    <!-- HEADER -->
    <div class="header">
        Welcome 
        <a href="edit_user.php?user_id=<?php echo $user['user_id']; ?>">
            <?php echo $user['name']; ?>
        </a>
    </div>

    <!-- MAIN CONTENT -->
    <div class="main">

        <!-- LEFT SIDE (FRIENDS) -->
        <div class="left">
            <h2><u>Friends</u></h2>
            <?php while($friend = mysqli_fetch_assoc($friendsQuery)) { ?>
                <div class="friend">
                    <a href="index.php?user_id=<?php echo $friend['user_id']; ?>">
                        <?php echo $friend['name']; ?>
                    </a>
                </div>
            <?php } ?>
        </div>

        <!-- RIGHT SIDE (WALL) -->
        <div class="right">

            <!-- POST FORM -->
            <div class="post-box">
                <form method="POST">
                    <textarea name="post" required placeholder="Write something..."></textarea>
                    <button type="submit" name="add_post">Post</button>
                </form>
            </div>

            <!-- POSTS -->
            <?php while($post = mysqli_fetch_assoc($wallQuery)) { ?>
                <div class="post">
                    <div class="post-date">
                        <?php echo $post['posting_date']; ?>
                    </div>
                    <div>
                        <?php echo $post['post']; ?>
                    </div>
                </div>
            <?php } ?>

        </div>

    </div>

</div>

</body>

</html>
