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
  <body>
  <div class="div-profile">
      <p class="impact">UPVOTE AND DOWN VOTE RECEIVED ON A POST EFFECT YOUR RATINGS!</p>
      <p class="impact" style=color:#17F471;> YOUR UPVOTES : <?php echo $row['upvote'];?></p>
      <p class="impact" style=color:#F41717;> YOUR DOWNVOTES : <?php echo $row['downvote'];?></p>
      <p class="impact"> YOUR RATING : <?php echo $row['rating'];?>%</p>
      <p class="impact"> YOUR POSTS : <?php echo $rows['postcount'];?></p>
  </div>
<div class="div-profile">
<form action="insert.php" method="POST">
<table id="post">
<tr>
<td>Post Title :</td>
<td><input type="text" maxlength="255" size="150" name="posttitle" name="blogtitle" placeholder="Title here...."/></td>
</tr>
<tr>
<td>Content :</td>
<td><textarea rows="4" cols="200" id="content" name="content" placeholder="Type here..........."></textarea></td>
</tr>
<tr>
<td>Author Name : </td>
<td><input type="text" size="15" id="authorname" name="authorname" value="<?php echo $rows['username']; ?>" readonly/></td>
</tr>
<tr>
<td>Country : </td><td><input type="text" size="15" id="country" name="country" value="<?php echo $rows['country']; ?>" readonly/></td>
</tr>
<tr>
<td></td>
<td align="center">
<input id="submit" type="submit" value="Save" class="btn btn-primary">
</td>
</tr>
</table>
</form>
</div>
</body>
</html>