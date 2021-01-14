<?php
	include('functions.php');
	connectdb();
	include '../connection.php';
	if($_POST['action']=='email') {
		// change the email id of the user
		if(trim($_POST['email']) == "")
			header("Location: account.php?derror=1");
		else {
			mysqli_query($db,"UPDATE users SET email='".$_POST['email']."' WHERE username='".$_SESSION['username']."'");
			header("Location: account.php?changed=1");
		}
	} else if($_POST['action']=='password') {
		// change the password of the user
		if($_POST['oldpass'] == "" or $_POST['newpass'] == "")
			header("Location: account.php?derror=1");
		else {
			$query = "SELECT * FROM users WHERE username='".$_SESSION['username']."'";
			$result = mysqli_query($db,$query);
			$fields = mysqli_fetch_array($result);
			$pass = $_POST['oldpass'];
			if($pass == $fields['password']) {
				$newpass = $_POST['newpass'];
				mysqli_query($db,"UPDATE users SET password='$newhash' WHERE username='".$_SESSION['username']."'");
				header("Location: account.php?changed=1");
			} else
				header("Location: account.php?passerror=1");
		}
	}
?>
<?php
include 'footer.php';
?>