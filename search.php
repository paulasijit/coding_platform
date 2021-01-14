<!DOCTYPE html>
<?php
  include 'connection.php';
  session_start();
  if (!(isset($_SESSION['id']))) {
    header('location:index.php');
  }
  $id=$_SESSION['id'];
  $queryUser=mysqli_query($db,"SELECT * FROM users where user_id='$id'")or die(mysqli_error($db));
  $rowUser=mysqli_fetch_array($queryUser);
?>
<html lang="en-US">
  <head>
  <title>CodeWar</title>
  <link rel="stylesheet" href="libs/css/bootstrap.min.css">
  <link rel="stylesheet" href="libs/style.css">
  <link rel="stylesheet" href="libs/div.css">
  <link rel="stylesheet" href="libs/navbar.css">
  <link rel="stylesheet" href="libs/multidiv.css">
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
  <li><a href="about.php">About</a></li>
  <li><a href="profile.php"><?php echo $rowUser['username'];?></a></li>
  <li><a class="inactive" href="logout.php">LOGOUT</a></li>
  <li class="right">
  <form action="search.php" method="GET">
  <input id="search" name="search" type="text" placeholder="SEARCH..." required>
  <input id="submit" type="submit" value="Search">
  </form>
  </li>
  </ul>
<?php
include 'connection.php';
$search =$_GET['search'];
$result = mysqli_query($db,"SELECT * FROM users WHERE username = '$search' OR workplace='$search' OR title='$search'")or die(mysqli_error($db));
$rows=mysqli_fetch_array($result);
if (empty($rows)) { 
    echo '<p class="impactSearch">No Results Found</p>';
    $result = mysqli_query($db,"SELECT * FROM users WHERE username = 'USER NOT FOUND'")or die(mysqli_error($db));
    $rows=mysqli_fetch_array($result);
} else {
    echo '<p class="impactSearch">Search Results</p>';
}
?>
<div class="div-profile">
<?php
  include 'connection.php';
  $search =$_GET['search'];
  $result = mysqli_query($db,"SELECT * FROM users WHERE username = '$search' OR workplace='$search' OR title='$search' OR country='$search' order by cup DESC")or die(mysqli_error($db));
  echo "<br>";
  echo '<div class="div-profile">';
  echo '<center>';
  echo '<table border="10" style="width:100%">';
  echo '<tr>';
  echo '<th style="background-color:orange">CUP</th>';
  echo '<th style="background-color:orange">TTILE</th>';
  echo '<th style="background-color:orange">USERNAME</th>';
  echo '<th style="background-color:orange">RATING</th>';
  echo '<th style="background-color:orange">COUNTRY</th>';
  echo '</tr>';
  while ($rowRank=mysqli_fetch_array($result)){
      echo "<tr>";
      echo "<td>";
      echo $rowRank["cup"];
      echo "</td>";
      echo "<td>";
      echo $rowRank["title"];
      echo "</td>";
      echo "<td>";
      $name=$rowRank["username"];
      echo "<a href='user.php?user=",$rowRank["username"],"'>$name</a>";
      echo "</td>";
      echo "<td>";
      echo $rowRank["rating"];
      echo "</td>";
      echo "<td>";
      echo $rowRank["country"];
      echo "</td>";
      echo "</tr>";
  }
  echo "</table>";
  echo '</center>';
  echo '</div>';
  ?>
  </div>