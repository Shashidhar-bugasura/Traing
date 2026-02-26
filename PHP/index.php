<?php
include "db.php";

$user_id = isset($_GET['user_id']) ? intval($_GET['user_id']) : 1;

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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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

                <textarea id="postText" placeholder="Write something..."></textarea>
                <br>
                <button id="postBtn">Post</button>

                <div id="message"></div>

            </div>

            <!-- POSTS -->
            <div id="postsContainer">
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

</div>
    <script>
        $(document).ready(function(){

            $("#postBtn").click(function(){

                var postText = $("#postText").val();
                var userId = <?php echo $user_id; ?>;

                if(postText.trim() == ""){
                    $("#message").html("<span style='color:red;'>Post cannot be empty!</span>");
                    return;
                }

                $.ajax({
                    url: "post_wall.php",
                    type: "POST",
                    data: {
                        user_id: userId,
                        post: postText
                    },
                    success: function(response){

                        if(response.trim() == "success"){
                            $("#message").html("<span style='color:green;'>Post added successfully!</span>");
                            $("#postText").val("");

                            // Reload posts without refreshing page
                            $("#postsContainer").load("index.php?user_id="+userId+" #postsContainer > *");

                        } else {
                            $("#message").html("<span style='color:red;'>Error adding post!</span>");
                        }

                    },
                    error: function(){
                        $("#message").html("<span style='color:red;'>Server error!</span>");
                    }
                });

            });

        });
    </script>
    </body>

</html>
