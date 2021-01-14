<!DOCTYPE html>
<?php
  include '../connection.php';
  session_start();
  include '../titleupdater.php';
  include '../ratingupdater.php';
  if (!(isset($_SESSION['id']))) {
    header('location:../index.php');
  }
  $id=$_SESSION['id'];
  $query=mysqli_query($db,"SELECT * FROM users where user_id='$id'")or die(mysqli_error($db));
  $rows=mysqli_fetch_array($query);
  $queryVote=mysqli_query($db,"SELECT * FROM rating where userid='$id'")or die(mysqli_error($db));
  $row=mysqli_fetch_array($queryVote);
  $queryPost=mysqli_query($db,"SELECT count(username) FROM blog where userid='$id'")or die(mysqli_error($db));
  $rowb=mysqli_fetch_assoc($queryPost);
  $title=$rows['title']
  ?>
<html lang="en-US">
  <head>
  <style>
#post {
  font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
  border:5px solid gray;
  border-radius: 10px;
  width: 100%;
}
#post td, #ranking th {
  
  font-weight: bold;
  padding: 8px;
}
</style>
  <title>CodeWar</title>
  <link rel="stylesheet" href="/libs/css/bootstrap.min.css">
  <link rel="stylesheet" href="/libs/style.css">
  <link rel="stylesheet" href="/libs/div.css">
  <link rel="stylesheet" href="/libs/navbar.css">
  <link rel="stylesheet" href="/libs/multidiv.css">
  <link rel="stylesheet" href="/libs/graph.css">
  </head>
  <ul>
  <li><a href="/home.php">Home</a></li>
  <li><a href="/contest.php">Contest</a></li>
  <li><a href="/compiler/editor.php">Submit</a></li>
  <li><a href="/ranking.php">Ranking</a></li>
  <li><a href="/news.php">News</a></li>
  <li><a href="/contact.php">Contact</a></li>
  <li><a href="/about.php">About</a></li>
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
<?php
//$sql="SELECT * FROM blog;”
$sql=mysqli_query($db,"SELECT * FROM blog order by postdate")or die(mysqli_error($db));
while($row = mysqli_fetch_array($sql)){
?>
<div class="div-profile">
<p class="impact" style=color:#F41717;>Title : <?php echo $row['posttitle'];?></p>
<p class="impact" style=color:green;>by : <?php echo $row['username'];?> on <?php echo $row['postdate'];?></p>
<!--<div  class="div-profile">
<p class="impact"><?php echo $row['content']; ?></p>
</div>-->
<p class="impact">UPVOTE : <input size="5" id="upv" type="text" value="<?php echo $row['upv']; ?>" class="btn btn-primary" readonly>&nbsp;
DOWNVOTE : <input size="5" id="upv" type="text" value="<?php echo $row['dv']; ?>" class="btn btn-primary" readonly></p>
<p class="impact"><button class="btn btn-primary" onclick="window.location.href='read.php?read=<?php echo $row['id'];?>'">READ</button></p>
</div>
<?php 
}
?>
</body>
</html>