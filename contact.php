<!DOCTYPE html>
<?php
  include 'connection.php';
  session_start();
  $id=$_SESSION['id'];
  if (!(isset($_SESSION['id']))) {
    header('location:index.php');
  }
  $query=mysqli_query($db,"SELECT * FROM users where user_id='$id'")or die(mysqli_error($db));
  $rows=mysqli_fetch_array($query);
  ?>
<html lang="en-US">
<?php include 'header.php' ?>
  <div class="div-profile">
<p class="impact">Coming soon.....</p>
  </div>