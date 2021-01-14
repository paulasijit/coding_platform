<!DOCTYPE html>
<?php
  include 'connection.php';
  session_start();
  include 'titleupdater.php';
  include 'ratingupdater.php';
  if (!(isset($_SESSION['id']))) {
    header('location:index.php');
  }
  $id=$_SESSION['id'];
  $query=mysqli_query($db,"SELECT * FROM users where user_id='$id'")or die(mysqli_error($db));
  $rows=mysqli_fetch_array($query);
  $sql=mysqli_query($db,"SELECT * FROM register where userid='$id' and start BETWEEN CURDATE() and DATE_ADD(CURDATE(), INTERVAL 1 DAY)")or die(mysqli_error($db));
  $queryAw=mysqli_query($db,"SELECT * FROM awards where userid='$id' and cash='MAX(cash)'")or die(mysqli_error($db));
  $num_row=mysqli_num_rows($sql);
  $num_rows=mysqli_num_rows($queryAw);
  $title=$rows['title']
  ?>
<html lang="en-US">
  <?php include 'header.php' ?>
  <div class="div-profile">
    <div class="small">
    <p class="impact">Title : <a href="search.php?search=<?php echo $rows['title'];?>"><?php echo $rows['title'];?></a></p>
    <p class="impact">User Name :<?php echo $rows['username'];?></p>
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
    <p class="impact">Total Cups : <?php echo $rows['cup'];?></p>
    <p class="impact">Country : <?php echo $rows['country'];?></p>
    <p class="impact">Workplace : <?php echo $rows['workplace'];?></p>
    <p class="impact"><a href="logout.php">LOGOUT</a></p></div>
    <div class="small"><p class="impact">DISPLAY PICTURE</p>
    <div><?php echo "<center><img src='upload/image/",$rows['dp'],"'width='200' height='200'/></center>";?></div></div>
    <div class="small"><p class="impact">CONTESTS WITHIN 1 DAYS</p>
    <div class="div-profile"><?php
if($num_row>0){
    $rowCon=mysqli_fetch_array($sql);
    ?>
    <p class="impact">CONTEST: <?php echo $rowCon['contest']; ?></p>
    <p class="impact">DATE: <?php echo $rowCon['start']; ?></p>
    <p class="impact">STARTS AT: <?php echo $rowCon['starttime']; ?></p>
    <?php
  }?>
  </div>
    </div>
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
<div><?php
$queryUser=mysqli_query($db,"SELECT COUNT(*) FROM friends where user_id_a='$id' and flag='1'")or die(mysqli_error($db));
$rowUser=mysqli_fetch_array($queryUser);
$toatalCount = array_shift($rowUser);
?>
<p class="impact">Friends: <?php echo $toatalCount; ?></p>
<?php
if($num_rows>0){
    $rowAw=mysqli_fetch_array($queryAw);
    ?>
    <p class="impact">AWARD: <?php echo $rowAw['awardname']; ?></p>
    <p class="impact">CASH: <?php echo $rowAw['cash']; ?></p>
    <p class="impact">CONTEST: <?php echo $rowAw['contestname']; ?></p>
<?php
  }?>
</div>
</div>
      <div class="graph">
        <p class="impact">SCORE GRAPH</p>
        <?php
      include 'plot/graph.php';
      ?>
      </div>
  </div>
</html>