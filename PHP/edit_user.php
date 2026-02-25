<?php
include "db.php";

$user_id = intval($_GET['user_id']);
$result = mysqli_query($conn, "SELECT * FROM tUser WHERE user_id=$user_id");
$user = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit User</title>
</head>
<body>

<h2>Edit User Details</h2>

<form action="update_user.php" method="POST">
    <input type="hidden" name="user_id" value="<?php echo $user['user_id']; ?>">

    Name: <input type="text" name="name" value="<?php echo $user['name']; ?>"><br><br>
    Email: <input type="text" name="email_id" value="<?php echo $user['email_id']; ?>"><br><br>
    Password: <input type="text" name="password" value="<?php echo $user['password']; ?>"><br><br>
    Address: <input type="text" name="address" value="<?php echo $user['address']; ?>"><br><br>
    Phone: <input type="text" name="phone" value="<?php echo $user['phone']; ?>"><br><br>

    <button type="submit">Update</button>
</form>

<br>

<a href="index.php?user_id=<?php echo $user_id; ?>">Back to Wall</a>

</body>
</html>
