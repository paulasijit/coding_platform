<?php
include '../connection.php';
require_once('functions.php');
	include 'dbinfo.php';
	connectdb();
  $id=$_SESSION['id'];
  if (!(isset($_SESSION['id']))) {
    header('location:index.php');
  }
  $queryRank=mysqli_query($db,"SELECT status FROM users WHERE username='".$_SESSION['username']."'")or die(mysqli_error($db));
  $tmp = "SELECT * FROM solve WHERE (problem_id='".$_POST['id']."' AND username='".$_SESSION['username']."')";
				$result = mysqli_query($db,$tmp);
                $fields = mysqli_fetch_array($result);
                $idno=$fields['problem_id'];
                $cups=$fields['score'];
                mysqli_query($db,"UPDATE cups SET cup='$cups', contestid='$idno', date=CURRENT_DATE WHERE username='".$_SESSION['username']."' AND contestid='".$_POST['id']."'");
?>