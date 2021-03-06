<!DOCTYPE html>
<?php
  include '../titleupdater.php';
  include '../ratingupdater.php';
  if (!(isset($_SESSION['id']))) {
    header('location:index.php');
  }
  $id=$_SESSION['id'];
  $query=mysqli_query($db,"SELECT * FROM users where user_id='$id'")or die(mysqli_error($db));
  $rows=mysqli_fetch_array($query);
  $sql=mysqli_query($db,"SELECT * FROM register where userid='$id' and start BETWEEN CURDATE() and DATE_ADD(CURDATE(), INTERVAL 3 DAY)")or die(mysqli_error($db));
  $queryAw=mysqli_query($db,"SELECT * FROM awards where userid='$id' and cash='MAX(cash)'")or die(mysqli_error($db));
  $num_row=mysqli_num_rows($sql);
  $num_rows=mysqli_num_rows($queryAw);
  $title=$rows['title']
  ?>
<html lang="en-US">
  <head>
  <title>CodeWar</title>
  <link rel="stylesheet" href="/libs/css/bootstrap.min.css">
  <link rel="stylesheet" href="/libs/style.css">
  <link rel="stylesheet" href="/libs/div.css">
  <link rel="stylesheet" href="/libs/navbar.css">
  <link rel="stylesheet" href="/libs/multidiv.css">
  <link rel="stylesheet" href="/libs/graph.css">
  <style>
  ul.new-style {
    list-style-type: none;
    font-family: Impact, Charcoal, sans-serif;
    font-size: 15px;
    border-radius: 15px;
    margin: 15px;
    padding: 5px;
    overflow: hidden;
    border: 2px solid rgb(95, 92, 92);
    background-color: #f3f3f3;
  }
  </style>
  </head>
  <ul class="new-style">
  <li><a href="/home.php">Home</a></li>
  <li><a href="/contest.php">Contest</a></li>
  <!--<li><a href="index.php">Problems</a></li>-->
  <li><a href="submissions.php">Submissions</a></li>
  <li><a href="scoreboard.php">Scoreboard</a></li>
  <!--<li><a href="/compiler/solve.php">Submit</a></li>-->
  <li><a href="/ranking.php">Ranking</a></li>
  <li><a href="/news.php">News</a></li>
  <li><a href="/contact.php">Contact</a></li>
  <!--<li><a href="/about.php">About</a></li>-->
  <li><a class="active" href="/profile.php"><?php echo $rows['username'];?></a></li>
  <li><a href="/updateprofile.php">Update Profile</a></li>
  <li><a class="inactive" href="/logout.php">LOGOUT</a></li>
  <li class="right">
  <form action="/search.php" method="GET">
  <input id="search" name="search" type="text" placeholder="SEARCH..." required>
  <input id="submit" type="submit" value="Search">
  </form>
  </li>
  </ul>