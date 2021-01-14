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
  <head>
  <title>CodeWar</title>
  <link rel="stylesheet" href="libs/css/bootstrap.min.css">
  <link rel="stylesheet" href="libs/style.css">
  <link rel="stylesheet" href="libs/div.css">
  <link rel="stylesheet" href="libs/navbar.css">
  </head>
  <ul>
  <li><a href="home.php">Home</a></li>
  <li><a href="contest.php">Contest</a></li>
  <li><a href="/compiler/index.php">Problems</a></li>
  <li><a href="/compiler/submissions.php">Submissions</a></li>
  <li><a href="/compiler/scoreboard.php">Scoreboard</a></li>
  <li><a href="ranking.php">Ranking</a></li>
  <li><a href="news.php">News</a></li>
  <li><a href="contact.php">Contact</a></li>
  <li><a class="active" href="about.php">About</a></li>
  <li><a href="profile.php"><?php echo $rows['username'];?></a></li>
  <li><a class="inactive" href="logout.php">LOGOUT</a></li>
  <li class="right">
  <form action="search.php" method="GET">
  <input id="search" name="search" type="text" placeholder="SEARCH..." required>
  <input id="submit" type="submit" value="Search">
  </form>
  </li>
  </ul>
  <div class="div-profile">
<p class="impact">Coming soon.....</p>
  </div>