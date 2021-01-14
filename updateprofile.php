<!DOCTYPE html>
<?php
  include 'connection.php';
  session_start();
  if (!(isset($_SESSION['id']))) {
    header('location:index.php');
  }
  $id=$_SESSION['id'];
  $query=mysqli_query($db,"SELECT * FROM users where user_id='$id'")or die(mysqli_error($db));
  $rows=mysqli_fetch_array($query);
  ?>
<html lang="en-US">
  <?php include 'header.php' ?>
<div class="div-profile">
<p class="impact">Please Fill-out All Fields</p>
        <form method="post" action="#" >
          <div class="div-profileUpdate">
            <label>Full Name</label>
            <input type="text" class="form-control" name="fname" style="width:20em;" placeholder="Enter your Fullname" value="<?php echo $rows['full_name']; ?>" readonly />
          </div>
          <div class="div-profileUpdate">
            <label>Gender</label>
            <input type="text" class="form-control" name="gender" style="width:20em;" placeholder="Enter your Gender" required value="<?php echo $rows['gender']; ?>" readonly/>
          </div>
          <div class="div-profileUpdate">
            <label>Age</label>
            <input type="number" class="form-control" name="age" style="width:20em;" placeholder="Enter your Age" value="<?php echo $rows['age']; ?>">
          </div>
          <div class="div-profileUpdate">
            <label>Country</label>
            <input type="text" class="form-control" name="country" style="width:20em;" required placeholder="Enter your Country" value="<?php echo $rows['country']; ?>" required></textarea>
          </div>
          <div class="div-profileUpdate">
            <label>Username</label>
            <input type="text" class="form-control" name="uname" style="width:20em;" placeholder="Edit your Username" value="<?php echo $rows['username']; ?>" required/>
          </div>
          <div>
          <center>
            <input type="submit" name="submit" class="btn btn-primary" style="width:20em; margin:0;"><br><br>
           </center>
          </div>
        </form>
</div>
<div class="div-profile">

<p class="impact">Please Fill-out All Fields</p>
<div class="small">
        <form method="post" action="" enctype="multipart/form-data">
        <div class="div-profileUpdate">
          <label>Upload Picture</label>
          <input type='file' class="form-control" name="profilepic"/>
          </div>
          <div>
          <center>
            <button type="submit" name="upload" class="btn btn-primary" style="width:10em; margin:0;">UPLOAD</button><br><br>
          </center>
          </div>
        </form>
        </div>
        <div class="small">
        <form method="post" action="#" >
          <div class="div-profileUpdate">
            <label>Facebook</label>
            <input type="text" class="form-control" name="fb" placeholder="Enter URL" value="<?php echo $rows['facebook']; ?>" />
          </div>
          <div>
          <center>
            <button type="submit" name="flink" class="btn btn-primary" style="width:10em; margin:0;">CONNECT</button><br><br>
          </center>
          </div>
        </form>
        </div>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <div class="small">
        <form method="post" action="#" >
          <div class="div-profileUpdate">
            <label>Twitter</label>
            <input type="text" class="form-control" name="twitter" placeholder="Enter URL" value="<?php echo $rows['twitter']; ?>" />
          </div>
          <div>
          <center>
            <button type="submit" name="tlink" class="btn btn-primary" style="width:10em; margin:0;">CONNECT</button><br><br>
          </center>
          </div>
        </form>
        </div>
        <div class="small">
        <form method="post" action="#" >
          <div class="div-profileUpdate">
            <label>Other</label>
            <input type="text" class="form-control" name="other" placeholder="Enter URL" value="<?php echo $rows['others']; ?>"  />
          </div>
          <div>
          <center>
            <button type="submit" name="olink" class="btn btn-primary" style="width:10em; margin:0;">CONNECT</button><br><br>
          </center>
          </div>
        </form>
        </div>
        <center>
        <p class="impact"><a href="logout.php">Log out</a></p>
           </center>
      </div>
      </html>
      <?php
      if(isset($_POST['submit'])){
        $fullname = $_POST['fname'];
        $username = $_POST['uname'];
        $gender = $_POST['gender'];
        $age = $_POST['age'];
        $country = $_POST['country'];
      $query = "UPDATE users SET age = $age, country = '$country', username='$username'
                      WHERE user_id = '$id'";
                    $result = mysqli_query($db, $query) or die(mysqli_error($db));
                    ?>
                     <script type="text/javascript">
            alert("Update Successfull.");
            window.location = "profile.php";
        </script>
        <?php
             }               
?> 
<?php
      if(isset($_POST['flink'])){
        $url = $_POST['fb'];
      $query = "UPDATE users SET facebook ='$url'
                      WHERE user_id = '$id'";
                    $result = mysqli_query($db, $query) or die(mysqli_error($db));
                    ?>
                     <script type="text/javascript">
            alert("Update Successfull.");
            window.location = "updateprofile.php";
        </script>
        <?php
             }               
?> 
<?php
if(isset($_POST['tlink'])){
  $url = $_POST['twitter'];
$query = "UPDATE users SET twitter ='$url'
                WHERE user_id = '$id'";
              $result = mysqli_query($db, $query) or die(mysqli_error($db));
              ?>
               <script type="text/javascript">
      alert("Update Successfull.");
      window.location = "updateprofile.php";
  </script>
  <?php
       }               
?> 
<?php
if(isset($_POST['olink'])){
  $url = $_POST['other'];
$query = "UPDATE users SET others = '$url'
                WHERE user_id = '$id'";
              $result = mysqli_query($db, $query) or die(mysqli_error($db));
              ?>
               <script type="text/javascript">
      alert("Update Successfull.");
      window.location = "updateprofile.php";
  </script>
  <?php
       }               
?> 
<?php
// If upload button is clicked ... 
if (isset($_POST['upload'])) { 
  
  $filename = $_FILES["profilepic"]["name"]; 
  $tempname = $_FILES["profilepic"]["tmp_name"];     
      $folder = "upload/image/".$filename; 

      // Get all the submitted data from the form 
      $sql= "UPDATE users SET dp='$filename'
                      WHERE user_id = '$id'"; 
      // Execute query 
      mysqli_query($db, $sql); 
        
      // Now let's move the uploaded image into the folder: image 
      if (move_uploaded_file($tempname, $folder))  { 
          $msg = "Image uploaded successfully"; 
      }else{ 
          $msg = "Failed to upload image"; 
    } 
} 
$result = mysqli_query($db, "SELECT * FROM users"); 
?>
