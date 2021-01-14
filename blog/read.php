<!DOCTYPE html>
<?php
  include '../connection.php';
  session_start();
  $counter=0;
  $counterD=0;
  if(!isset($_SESSION['counter'])) {
    $_SESSION['counter'] = 0;
}
if(!isset($_SESSION['counterD'])) {
  $_SESSION['counterD'] = 0;
}
  if (!(isset($_SESSION['id']))) {
    header('location:../index.php');
  }
  $idu=$_SESSION['id'];
  $queryUser=mysqli_query($db,"SELECT * FROM users where user_id='$idu'")or die(mysqli_error($db));
  $rowUser=mysqli_fetch_array($queryUser);
  $usern=$rowUser['username'];
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
  <li><a href="/ranking.php">Ranking</a></li>
  <li><a href="/news.php">News</a></li>
  <li><a href="/contact.php">Contact</a></li>
  <li><a href="/about.php">About</a></li>
  <li><a href="/profile.php"><?php echo $rowUser['username'];?></a></li>
  <li><a class="inactive" href="/logout.php">LOGOUT</a></li>
  <li class="right">
  <form action="/search.php" method="GET">
  <input id="search" name="search" type="text" placeholder="User Name" required>
  <input id="submit" type="submit" value="Search">
  </form>
  </li>
  </ul>
  <?php
  include '../connection.php';
  $username =$_GET['read'];
  $result = mysqli_query($db,"SELECT * FROM blog WHERE id = '$username'")or die(mysqli_error($db));
  $num_rows=mysqli_num_rows($result);
  if ($num_rows>0){
    $id=$row['id'];
    
  }else{
    echo '<div class="div-profile">';
    echo '<center><p class="impact" style=color:#F41717;><font size=5>NO RESULT FOUND!</font></p></center>';
    echo '</div>';
    exit();
  }
  $row=mysqli_fetch_array($result);
  $bid=$row['id'];
  $resulta = mysqli_query($db,"SELECT * FROM comment WHERE blogid = '$bid'")or die(mysqli_error($db));
    $num_row=mysqli_num_rows($resulta);
?>
<?php
//$sql="SELECT * FROM blog;”
$sql=mysqli_query($db,"SELECT * FROM blog where id='$id' order by postdate")or die(mysqli_error($db));
while($row = mysqli_fetch_array($sql)){
?>
<div class="div-profile"><p class="impact" style=color:mediumblue;>YOU CAN DOWN VOTE, UP VOTE OR YOU CAN DO BOTH!</p></div>
<div class="div-profile">
<p class="impact" style=color:#F41717;>Title : <?php echo $row['posttitle'];?></p>
<p class="impact" style=color:#F41717;>by : <?php echo $row['username'];?> on <?php echo $row['postdate'];?></p>
<div  class="div-profile">
<p class="impact"><?php echo $row['content']; ?></p>
</div>
<form action="#" method="POST">
<p class="impact" style=color:lime;><?php echo $row['upv']; ?>&nbsp;<button type="submit" name="upv"><img src="/img/voteup.png"/></button></p>
</form>
<form action="#" method="POST">
<p class="impact" style=color:red;><?php echo $row['dv']; ?>&nbsp;<button type="submit" name="dv"><img src="/img/votedown.png"/></button></p>
</form>
<form action="#" method="POST">
<p class="impact" style=color:red;><input type="text" maxlength="255" size="150" name="comment" id="comment" placeholder="Type your comment here...."/><input id="submit" type="submit" name="cmnt" class="btn btn-primary"></p>
</form>
<p class="impact"><button class="btn btn-primary" onclick="window.location.href='blog_view.php'">BACK</button></p>
</div>
<div class="div-profile"><p class="impact" style=color:mediumblue;>COMMENTS</p>
<?php while($rows=mysqli_fetch_array($resulta)) {?>
<div class="div-profile">
<p class="impact">COMMENT :<font style=color:darkmagenta;> <?php echo $rows['cmnt'];?></font></p>
<p class="impact">by : <font style=color:#F41717;><?php echo $rows['username'];?></font> on <font style=color:fuchsia;><?php echo $rows['date'];?></font></p>
</div>
<?php
}
?>
</div>
<?php
if(isset($_POST['cmnt'])){
  $comment = $_POST['comment'];
  $query = "INSERT INTO COMMENT
  (blogid, cmnt, userid,username,date)
  VALUES ('$bid','$comment','$idu','$usern',CURRENT_DATE)";
  mysqli_query($db,$query)or die ('Error in updating Database');
  ?>
  <script type="text/javascript">
alert("COMMENT ADDED!");
window.location = "read.php?read=<?php echo $id; ?>";
</script>
<?php
}
?>
<?php
      if(isset($_POST['upv'])){
        $c=$_SESSION['counter'];
          $up=$row['upv'];
          if($c>=1){
            $_SESSION['counter'] = 0;
            $query = "UPDATE blog SET upv = $up-1
                      WHERE id = '$id'";
                    $result = mysqli_query($db, $query) or die(mysqli_error($db));
                    ?>
                    <script type="text/javascript">
            alert("Upvote Removed!");
            window.location = "read.php?read=<?php echo $id; ?>";
        </script><?php
          }else{
            ++$_SESSION['counter'];
      $query = "UPDATE blog SET upv = $up+1
                      WHERE id = '$id'";
                    $result = mysqli_query($db, $query) or die(mysqli_error($db));
                    ?>
                     <script type="text/javascript">
            alert("Upvote Added!");
            window.location = "read.php?read=<?php echo $id; ?>";
        </script>
        <?php
             }
            }              
?> 
<?php
      if(isset($_POST['dv'])){
        $d=$_SESSION['counterD'];
          $dv=$row['dv'];
          if($d>=1){
            $_SESSION['counterD'] = 0;
      $query = "UPDATE blog SET dv=$dv-1
                      WHERE id = '$id'";
                    $result = mysqli_query($db, $query) or die(mysqli_error($db));
                    ?>
                     <script type="text/javascript">
            alert("Downvote Removed!");
            window.location = "read.php?read=<?php echo $id; ?>";
        </script>
        <?php
             }else{
              ++$_SESSION['counterD'];
              $query = "UPDATE blog SET dv=$dv+1
              WHERE id = '$id'";
            $result = mysqli_query($db, $query) or die(mysqli_error($db));
            ?>
                     <script type="text/javascript">
            alert("Downvote Added!");
            window.location = "read.php?read=<?php echo $id; ?>";
        </script><?php
             }
            }           
?> 
<?php 
}
?>
</html>