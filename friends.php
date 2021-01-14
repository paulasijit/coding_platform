<?php
include 'connection.php';
session_start();
$id=$_SESSION['id'];
$queryUser=mysqli_query($db,"SELECT * FROM users where user_id='$id'")or die(mysqli_error($db));
$rowUser=mysqli_fetch_array($queryUser);
      if(isset($_POST['frnd'])){
        $idb =$_POST['god'];
        $query=mysqli_query($db,"SELECT * FROM users where user_id='$idb'")or die(mysqli_error($db));
        $row=mysqli_fetch_array($query);
        $u=$row['username'];
        $queryUser="SELECT * FROM friends where user_id_a='$id' and user_id_b='$idb'";
        $result = mysqli_query($db,$queryUser);
        $rowUser=mysqli_fetch_array($result);
        if(mysqli_num_rows($result)>0){
        $c=$rowUser['flag'];
        }
        if(mysqli_num_rows($result)==0){
          $sql="INSERT INTO friends(user_id_a,user_id_b,status,flag) VALUES($id,$idb,'Friends',1)";
          mysqli_query($db,$sql) or die ('Error in updating Database');
          ?>
          <script type="text/javascript">
            alert("Added <?php echo $u; ?> As Friend!");
            window.location = "user.php?user=<?php echo $u; ?>";
        </script>
        <?php
        }
        else if($c=='1'){
            $query = "UPDATE friends SET status='Add Friend', flag='0'
                      WHERE user_id_a = '$id' and user_id_b='$idb'";
                    $result = mysqli_query($db, $query) or die(mysqli_error($db));
                    ?>
                    <script type="text/javascript">
            alert("Removed <?php echo $u; ?> From Friend!");
            window.location = "user.php?user=<?php echo $u; ?>";
        </script><?php
          }else{
            $query = "UPDATE friends SET status='Friends', flag='1'
            WHERE user_id_a = '$id' and user_id_b='$idb'";
          $result = mysqli_query($db, $query) or die(mysqli_error($db));
                    ?>
                     <script type="text/javascript">
            alert("Added <?php echo $u; ?> As Friend!");
            window.location = "user.php?user=<?php echo $u; ?>";
        </script>
        <?php
             }
            }              
?> 