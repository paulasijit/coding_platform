<?php
include '../connection.php';
session_start();
include '../titleupdater.php';
include '../ratingupdater.php';
if (!(isset($_SESSION['id']))) {
  header('location:../index.php');
}
$id=$_SESSION['id'];
//insert posts into database
    $ptitle = $_POST['posttitle'];
    $content = $_POST['content'];
    $user = $_POST['authorname'];
    $country = $_POST['country'];

$sql="INSERT INTO blog (posttitle,content,username,userid,postdate) 
            values('".$ptitle."','".$content."','".$user."','".$id."',now())";
mysqli_query($db,$sql)or die ('Error in updating Database');
?>
<script type="text/javascript">
alert("Blog Added Successfully!");
window.location = "blog_view.php";
</script>