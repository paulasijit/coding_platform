<!DOCTYPE html>
<!--<meta http-equiv="refresh" content="5" >-->
<?php
  include 'connection.php';
  session_start();
  $id=$_SESSION['id'];
  if (!(isset($_SESSION['id']))) {
    header('location:index.php');
  }
  $query=mysqli_query($db,"SELECT * FROM users where user_id='$id'")or die(mysqli_error($db));
  $rows=mysqli_fetch_array($query);
  $d1=date("Y-m-d");
  $sql=mysqli_query($db,"SELECT * FROM contest where start BETWEEN CURDATE() and DATE_ADD(CURDATE(), INTERVAL 10 DAY)")or die(mysqli_error($db));
  $num_row=mysqli_num_rows($sql);
  ?>
<html lang="en-US">
<?php include 'header.php' ?>
<div class="div-profile">
<center><p class="impact">CURRENT OR UPCOMING CONTEST</p></center>
  <?php
    $query=mysqli_query($db,"SELECT * FROM users where user_id='$id'")or die(mysqli_error($db));
    $rows=mysqli_fetch_array($query);
    $d1=date("Y-m-d");
    $sql=mysqli_query($db,"SELECT * FROM contest where start BETWEEN CURDATE() and DATE_ADD(CURDATE(), INTERVAL 30 DAY) order by start")or die(mysqli_error($db));
    $num_row=mysqli_num_rows($sql);
  $d1=date("Y-m-d");
  if($num_row>0){
    while ($con=mysqli_fetch_assoc($sql)){
      $diff = (strtotime( $con['start'])-strtotime($d1));
      $contest = strtotime($con['starttime'])-time();
      $y = floor($diff / (365*60*60*24));
      $m = floor(($diff - $y * 365*60*60*24) / (30*60*60*24));
      $d = floor(($diff - $y* 365*60*60*24 - $m*30*60*60*24)/ (60*60*24));
      $d2='DAYS';
      $h='HRS';
      if ($y<0){
        $d='';
        $d2='CONTEST ENDED';
      }
    ?>
    <div class="div-profile">
    <div><span id="tik"><P class="impact" style=color:green;>CONTEST STARTS IN : <font color="red"><?php echo "$d $d2"; ?></font></P></span>
    <p class="impact">CONTEST: <?php echo $con['contest']; ?></p>
    <p class="impact">DATE: <?php echo $con['start']; ?></p>
    <p class="impact" style=color:BLUE;>STARTS AT: <?php echo $con['starttime']; ?></p>
    <p class="impact" style=color:firebrick;>ENDS AT: <?php echo $con['endtime']; ?></p>
    <form method="post" action="/compiler/contestproblems.php">
    <input type="hidden" name="action" value="contest"/>
    <input type="hidden" id="cname" name="cname" value="<?php echo $con['contest']; ?>"/><br/><br/>
    <p class="impact"><p id="demo" class="countdown-live" style="color: blue;"></p></p>
    <p class="impact"><input class="btn" id="submit" type="submit" name="submit" value="TAKE PART"/></p>
    </form>
    </div></div>
    
    <?php
  }
  ?>
  <?php
}
?>
</div>

<div class="div-profile">
<center><p class="impact">PAST CONTEST</p></center>
  <?php
  $query=mysqli_query($db,"SELECT * FROM users where user_id='$id'")or die(mysqli_error($db));
  $rows=mysqli_fetch_array($query);
  $d1=date("Y-m-d");
  $sql=mysqli_query($db,"SELECT * FROM contest where start<CURDATE()")or die(mysqli_error($db));
  $num_row=mysqli_num_rows($sql);
  $d1=date("Y-m-d");
  if($num_row>0){
    while ($con=mysqli_fetch_assoc($sql)){
      $diff = (strtotime( $con['start'])-strtotime($d1));
      $contest = strtotime($con['starttime'])-time();
      $y = floor($diff / (365*60*60*24));
      $m = floor(($diff - $y * 365*60*60*24) / (30*60*60*24));
      $d = floor(($diff - $y* 365*60*60*24 - $m*30*60*60*24)/ (60*60*24));
      $d2='DAYS';
      $h='HRS';
      if ($y<0){
        $d='';
        $d2='CONTEST ENDED';
    ?>
    <div class="div-profile">
    <div><span id="tik"><P class="impact" style=color:green;>CONTEST STARTS IN : <font color="red"><?php echo "$d $d2"; ?></font></P></span>
    <p class="impact">CONTEST: <?php echo $con['contest']; ?></p>
    <p class="impact">DATE: <?php echo $con['start']; ?></p>
    <!--<p class="impact" style=color:firebrick;>STARTS AT: <?php echo $con['starttime']; ?></p>-->
    </div></div>
    <?php
      }
  }
  ?>
  <?php
}
?>
</div>
</html>
