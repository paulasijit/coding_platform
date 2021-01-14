<?php
include 'connection.php';
	include('../functions.php');
	connectdb();
	if(isset($_POST['action'])){
		if($_POST['action']=='contest') {
			// update the admin email
			if(trim($_POST['cname']) == "")
				header("Location: index.php?derror=1");
			else {
				$query ="INSERT INTO contest (contest,start,starttime,endtime,noofq,total,username) VALUES ('".$_POST['cname']."','".$_POST['date']."','".$_POST['time']."','".$_POST['endtime']."','".$_POST['noq']."','".$_POST['total']."','".$_POST['ps']."')";
				mysqli_query($db,$query) or die ('Error in updating Database');
				header("Location: index.php?changed=1");
			}
		} else if($_POST['action']=='password') {
			// update the admin password
			if(trim($_POST['oldpass']) == "" or trim($_POST['newpass']) == "")
				header("Location: index.php?derror=1");
			else {
				$query = "SELECT * FROM users WHERE username='admin'";
				$result = mysqli_query($db,$query);
				$fields = mysqli_fetch_array($result);
				$currhash = $_POST['oldpass'];
				if($currhash == $fields['password']) {
					$pass = $_POST['newpass'];
					mysqli_query($db,"UPDATE users SET password='$pass' WHERE username='".$_SESSION['username']."'");
					header("Location: index.php?changed=1");
				} else
					header("Location: index.php?passerror=1");
			}
		} else if($_POST['action']=='settings') {
			// update the event settings
			if(trim($_POST['name']) == "")
				header("Location: index.php?derror=1");
			else {
				if($_POST['accept']=='on') $accept=1; else $accept=0;
				if($_POST['c']=='on') $c=1; else $c=0;
				if($_POST['cpp']=='on') $cpp=1; else $cpp=0;
				if($_POST['java']=='on') $java=1; else $java=0;
				if($_POST['python']=='on') $python=1; else $python=0;
				if($_POST['python3']=='on') $python3=1; else $python3=0;
				if($_POST['ruby']=='on') $ruby=1; else $ruby=0;
				mysqli_query($db,"UPDATE prefs SET name='".mysqli_real_escape_string($db,$_POST['name'])."', accept=$accept, c=$c, cpp=$cpp, java=$java, python=$python,python3=$python3,ruby=$ruby");
				$test=$_POST['name'];
				header("Location: index.php?changed=1");
			}
		} else if($_POST['action']=='addproblem') {
			// add a problem
			if(trim($_POST['title']) == "" or trim($_POST['problem']) == "" or !is_numeric($_POST['time']))
				header("Location: problems.php?derror=1");
			else {
				$query="INSERT INTO `problems` (`cname` ,`name` , `text`, `input`, `output`, `time`, `points`,`penalty`) VALUES ('".mysqli_real_escape_string($db,$_POST['cname'])."','".mysqli_real_escape_string($db,$_POST['title'])."', '".mysqli_real_escape_string($db,$_POST['problem'])."', '".$_POST['input']."', '".mysqli_real_escape_string($db,$_POST['output'])."', '".$_POST['time']."', '".$_POST['points']."', '".$_POST['penalty']."')";
				mysqli_query($db,$query);
				header("Location: problems.php?added=1");
			}
		} else if($_POST['action']=='editproblem' and is_numeric($_POST['id'])) {
			// update an already existing problem
			if($_POST['title'] == "" or $_POST['problem'] == "" or !is_numeric($_POST['time']))
				header("Location: problems.php?derror=1&action=edit&id=".$_POST['id']);
			else {
				$query = "UPDATE problems SET input='".mysqli_real_escape_string($db,$_POST['input'])."', output='".mysqli_real_escape_string($db,$_POST['output'])."', name='".mysqli_real_escape_string($db,$_POST['pname'])."', text='".$_POST['problem']."', time='".mysqli_real_escape_string($db,$_POST['time'])."', points='".$_POST['points']."', penalty='".$_POST['penalty']."' WHERE sl='".$_POST['id']."'";
				mysqli_query($db,$query);
				header("Location: problems.php?updated=1&action=edit&id=".$_POST['id']);
			}
		}
	}
	else if(isset($_GET['action'])){
		if($_GET['action']=='delete' and is_numeric($_GET['id'])) {
			// delete an existing problem
			$query="DELETE FROM problems WHERE sl=".$_GET['id'];
			mysqli_query($db,$query);
			$query="DELETE FROM solve WHERE problem_id=".$_GET['id'];
			mysqli_query($db,$query);
			header("Location: problems.php?deleted=1");
		} else if($_GET['action']=='ban') {
			// ban a user from the event
			$query="UPDATE users SET status=0 WHERE username='".mysqli_real_escape_string($db,$_GET['username'])."'";
			mysqli_query($db,$query);
			header("Location: users.php?banned=1");
		} else if($_GET['action']=='unban') {
			// unban a user from the event
			$query="UPDATE users SET status=1 WHERE username='".mysqli_real_escape_string($db,$_GET['username'])."'";
			mysqli_query($db,$query);
			header("Location: users.php?unbanned=1");
		}
	}	
?>
