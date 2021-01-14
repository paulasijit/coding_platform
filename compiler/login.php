<?php
include '../connection.php';
session_start();
	require_once('functions.php');
	if(loggedin())
		header("Location: account.php");
	else if(!isset($_POST['action'])) {
    $id=$_SESSION['id'];
    $query=mysqli_query($db,"SELECT * FROM users where user_id='$id'")or die(mysqli_error($db));
    $rows=mysqli_fetch_array($query);
    //$username = $_POST['username'];
    $username = $rows['username'];
    $pass=$rows['password'];
    $status='login';
		if($status=='login') {
			if($username == "" or $pass == "") {
				header("Location: login.php?derror=1"); // empty entry
			} else {
				// code to login the user and start a session
        include '../connection.php';
				$query = "SELECT * FROM users WHERE username='".$username."'";
				$result = mysqli_query($db,$query);
				$fields = mysqli_fetch_array($result);
				$user =$fields['username'];
				if(True) {
					$_SESSION['username'] = $user;
					header("Location: index.php");
				} else
					header("Location: login.php?error=1");
			}
		} 
	}
?>
      <?php
        if(isset($_GET['logout']))
          echo("<div class=\"alert alert-info\">\nYou have logged out successfully!\n</div>");
        else if(isset($_GET['error']))
          echo("<div class=\"alert alert-error\">\nIncorrect username or password!\n</div>");
        else if(isset($_GET['registered']))
          echo("<div class=\"alert alert-success\">\nYou have been registered successfully! Login to continue.\n</div>");
        else if(isset($_GET['exists']))
          echo("<div class=\"alert alert-error\">\nUser already exists! Please select a different username.\n</div>");
        else if(isset($_GET['derror']))
          echo("<div class=\"alert alert-error\">\nPlease enter all the details asked before you can continue!\n</div>");
      ?>
      <?php 
      ?>

<?php
	include('footer.php');
?>
