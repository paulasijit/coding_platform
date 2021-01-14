<?php
  include 'connection.php';
  $id=$_SESSION['id'];
  if (!(isset($_SESSION['id']))) {
    header('location:index.php');
  }
  //$sql="SELECT * FROM blog;”
  $u=0;
  $d=0;
  $c=0;
  $sql=mysqli_query($db,"SELECT * FROM blog where userid='$id'")or die(mysqli_error($db));
  while($row = mysqli_fetch_assoc($sql)){
  $u+=$row['upv'];
  $d+=$row['dv'];
  $c+=1;
  }
  $queryRank=mysqli_query($db,"SELECT * FROM users where user_id='$id'")or die(mysqli_error($db));
  $sql=mysqli_query($db,"SELECT upvote,downvote FROM rating where userid='$id'")or die(mysqli_error($db));
  $row=mysqli_fetch_assoc($sql);
  $up=$u;
  $down=$d;
  if ($u+$d==0){
    $rating=0;
  }else{
  $rating=(($up-$down)/($up+$down))*100;
  }
  mysqli_query($db,"UPDATE users SET rating='$rating', postcount='$c' WHERE user_id='$id'");
  mysqli_query($db,"UPDATE rating SET userid='$id'  WHERE userid='0'");
  mysqli_query($db,"UPDATE rating SET rating='$rating', upvote='$u', downvote='$d' WHERE userid='$id'");
  ?>