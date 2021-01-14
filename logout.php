<?php
include 'connection.php';
session_start();
$id=$_SESSION['id'];
$query=mysqli_query($db,"SELECT * FROM users WHERE user_id ='$id'");
$num_rows=mysqli_num_rows($query);
$row=mysqli_fetch_array($query);
if ($num_rows>0){
    $query = "UPDATE users SET active='0' WHERE user_id = '$row[user_id]'";
    $result = mysqli_query($db, $query) or die(mysqli_error($db));
unset($_SESSION['id']);
session_destroy();
header("Location: index.php");

}
?>