<?php
  include 'connection.php';
  $id=$_SESSION['id'];
  $queryRank=mysqli_query($db,"SELECT cup,title FROM users where user_id='$id'")or die(mysqli_error($db));
  $sql=mysqli_query($db,"SELECT * FROM cups where userid='$id'")or die(mysqli_error($db));
  $cup=0;
  while($row=mysqli_fetch_assoc($sql)){
      $cup+=$row['cup'];
  }
  if($cup < 1200){
     mysqli_query($db,"UPDATE users SET title='Newbie',cup='$cup' WHERE user_id='$id'");
  }
  elseif($cup >1200 and $cup<1400)
  {
    mysqli_query($db,"UPDATE users SET title='Pupil',cup='$cup' WHERE user_id='$id'");
  }
  elseif($cup >1400 and $cup < 1600)
  {
    mysqli_query($db,"UPDATE users SET title='Specialist',cup='$cup' WHERE user_id='$id'");
  }
  elseif($cup >1600 and $cup < 1900)
  {
    mysqli_query($db,"UPDATE users SET title='Expert',cup='$cup' WHERE user_id='$id'");
  }
  elseif($cup >1900 and $cup < 2100)
  {
    mysqli_query($db,"UPDATE users SET title='Candidate Master',cup='$cup' WHERE user_id='$id'");
  }
  elseif($cup >2100 and $cup < 2300)
  {
    mysqli_query($db,"UPDATE users SET title='Master',cup='$cup' WHERE user_id='$id'");
  }
  elseif($cup >2300 and $cup < 2400)
  {
    mysqli_query($db,"UPDATE users SET title='International Master',cup='$cup' WHERE user_id='$id'");
  }
  elseif($cup >2400 and $cup < 2600)
  {
    mysqli_query($db,"UPDATE users SET title='International Grandmaster',cup='$cup' WHERE user_id='$id'");
  }
  elseif($cup >3000)
  {
    mysqli_query($db,"UPDATE users SET title='Legendry Grandmaster',cup='$cup' WHERE user_id='$id'");
  }
  ?>