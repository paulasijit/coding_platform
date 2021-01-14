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
  <style>
    button {
    background-color: Transparent;
    background-repeat:no-repeat;
    border: none;
    cursor:pointer;
    overflow: hidden;
    outline:none;
}
    </style>
  <title>CodeWar</title>
  <link rel="stylesheet" href="libs/css/bootstrap.min.css">
  <link rel="stylesheet" href="libs/style.css">
  <link rel="stylesheet" href="libs/div.css">
  <link rel="stylesheet" href="libs/navbar.css">
  <link rel="stylesheet" href="libs/multidiv.css">
  <link rel="stylesheet" href="libs/graph.css">
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
  <input id="search" name="search" type="text" placeholder="User Name" required>
  <input id="submit" type="submit" value="Search">
  </form>
  </li>
  </ul>
  <?php
  include 'connection.php';
  $username =$_GET['user'];
  $result = mysqli_query($db,"SELECT * FROM users WHERE username = '$username'")or die(mysqli_error($db));
  $rows=mysqli_fetch_array($result);
  if($rows>0){
  $active=$rows['active'];
  $idb=$rows['user_id'];
  $title=$rows['title'];
  }
  if (empty($rows)) { 
    echo '<center><p class="impactSearch" style=color:red;><font size="25">No Results Found</p></center>';
    exit();
} else {
    echo '<center><p class="impactSearch" style=color:blue;><font size="5">SEARCH RESULT</p></center>';
}
?>
<div class="div-profile">
    <div class="small">
    <p class="impact">Title : <a href="search.php?search=<?php echo $rows['title'];?>"><?php echo $rows['title'];?></a></p>
    <p class="impact">USER NAME : <?php echo $rows['username'];?></p>
    <p class="impact">Full Name : <?php 
      if($title=='Legendry Grandmaster')
        echo '<a style=color:#F41717;>';
        else if($title=='International Grandmaster')
        echo '<a style=color:#CB3617;>';
        else if($title=='International Master')
        echo '<a style=color:#EC5E41;>';
        else if($title=='Master')
        echo '<a style=color:#F47B17;>';
        else if($title=='Candidate Master')
        echo '<a style=color:#F4C217;>';
        else if($title=='Expert')
        echo '<a style=color:#D9F417;>';
        else if($title=='Specialist')
        echo '<a style=color:#8CF417;>';
        else if($title=='Pupil')
        echo '<a style=color:#17F471;>';
        else if($title=='Newbie')
        echo '<a style=color:#9BA6A7;>';?>
        <?php echo $rows['full_name'];?></a></p>
    <p class="impact">Rating : <?php echo $rows['rating'];?>%</p>
    <p class="impact">Cups : <?php echo $rows['cup'];?></p>
    <p class="impact">Country : <?php echo $rows['country'];?></p>
    <p class="impact">Workplace : <?php echo $rows['workplace'];?></p>
    <p class="impact"><?php
    if($active==1){
      ?>
      <p class="impact" style=color:chartreuse><font color="black">NOW : </font><?PHP echo "ONLINE";?></p>
<?php
    }else{
      ?>
      <p class="impact" style=color:crimson><font color="black">NOW : </font><?PHP echo "OFFLINE";?></p>
      <?php
    }
  ?>
  </p>
    <p class="impact"><a href="logout.php">LOGOUT</a></p></div>
    <div class="small"><p class="impact">DISPLAY PICTURE</p>
      <div><?php echo "<center><img src='upload/image/",$rows['dp'],"'width='200' height='200'/></center>";?></div></div>
      <div class="small"><p class="impact">AWARDS</p><div class="div-profile"></div></div>
    <div class="smallSocial"><p class="impact">SOCIAL</p><div>
    <p class="impact"><a href="<?php echo $rows['facebook']; ?>">Facebook</a></p>
    <p class="impact"><a href="<?php echo $rows['twitter']; ?>">Twitter</a></p>
    <p class="impact"><a href="<?php echo $rows['others']; ?>">Other</a></p></div>
  </div>
  <div class="smallSocial"><p class="impact">ACTIVITY</p><div>
    <p class="impact"><a href="/blog/blog.php">WRITE BLOGS</a></p>
    <p class="impact"><a href="/blog/myblogs.php">MY BLOGS</a></p>
    <p class="impact"><a href="/blog/blog_view.php">BLOGS</a></p></div>
</div>
<div class="smallSocial"><p class="impact">STATUS</p>
<div>
<?php
if($id!=$idb){
$queryUser=mysqli_query($db,"SELECT * FROM friends where user_id_a='$id' and user_id_b='$idb'")or die(mysqli_error($db));
$rowUser=mysqli_fetch_array($queryUser);
}
if(mysqli_num_rows($queryUser)>0){
    ?>
    <form action="friends.php" method="POST">
    <input type="hidden" class="form-control" name="god" style="width:20em;" value="<?php echo $idb; ?>" readonly/>
    <p class="impact" style=color:red;><?php echo $rowUser['status']; ?>&nbsp;<button type="submit" name="frnd"><img src="/img/sy.png"/></button></p>
</form>
<?php
}else{
  ?>
  <form action="friends.php" method="POST">
    <input type="hidden" class="form-control" name="god" style="width:20em;" value="<?php echo $idb; ?>" readonly/>
    <p class="impact" style=color:red;><?php echo 'Add Friend' ?>&nbsp;<button type="submit" name="frnd"><img src="/img/sy.png"/></button></p>

<?php
}
?>
<?php
$queryUser=mysqli_query($db,"SELECT COUNT(*) FROM friends where user_id_b='$idb' and flag='1'")or die(mysqli_error($db));
$rowUser=mysqli_fetch_array($queryUser);
$toatalCount = array_shift($rowUser);
?>
<p class="impact">Friends: <?php echo $toatalCount; ?></p>
<p class="impact">Text</p>
</div>
</div>
      <div class="graph">
        <p class="impact">SCORE GRAPH</p>
        <?php
      include 'plot/usergraph.php';
      ?>
      </div>
  </div>
