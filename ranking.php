<!DOCTYPE html>
<?php
  include 'connection.php';
  session_start();
  $id=$_SESSION['id'];
  if (!(isset($_SESSION['id']))) {
    header('location:index.php');
  }
  $query=mysqli_query($db,"SELECT * FROM users where user_id='$id'")or die(mysqli_error($db));
  $row=mysqli_fetch_array($query);
  ?>
<html lang="en-US">
  <head>
  <style>
#ranking {
  font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
  border:5px solid orangered;
  border-radius: 10px;
  width: 100%;
}
#ranking td, #ranking th {
  border: 1px solid #ddd;
  font-weight: bold;
  padding: 8px;
}

#ranking tr:nth-child(even){background-color: #f2f2f2;}

#ranking tr:hover {background-color: #ddd;}
</style>
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
  <li><a class="active" href="ranking.php">Ranking</a></li>
  <li><a href="news.php">News</a></li>
  <li><a href="contact.php">Contact</a></li>
  <li><a href="about.php">About</a></li>
  <li><a href="profile.php"><?php echo $row['username'];?></a></li>
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
  $queryRank=mysqli_query($db,"SELECT cup,title,username,rating,country FROM users where age<>0 and username!='admin' order by cup DESC")or die(mysqli_error($db));
  echo "<br>";
  echo '<div class="div-profile">';
  echo '<center>';
  echo '<table id="ranking">';
  echo '<tr>';
  echo '<th style="background-color:orange">CUP</th>';
  echo '<th style="background-color:orange">TTILE</th>';
  echo '<th style="background-color:orange">USERNAME</th>';
  echo '<th style="background-color:orange">RATING</th>';
  echo '<th style="background-color:orange">COUNTRY</th>';
  echo '</tr>';
  while ($rowRank=mysqli_fetch_assoc($queryRank)){
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
