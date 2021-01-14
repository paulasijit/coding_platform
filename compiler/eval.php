<?php
include '../connection.php';
require_once('functions.php');
	include 'dbinfo.php';
	connectdb();
	$id=$_SESSION['id'];
	$query = "SELECT * FROM prefs";
        $result = mysqli_query($db,$query);
        $accept = mysqli_fetch_array($result);
        $query = "SELECT status FROM users WHERE username='".$_SESSION['username']."'";
        $result = mysqli_query($db,$query);
		$status = mysqli_fetch_array($result);
	if (!preg_match("/^[^\\/?* :;{}\\\\]+\\.[^\\/?*: ;{}\\\\]{1,4}$/", $_POST['filename']))
		header("Location: solve.php?ferror=1&id=".$_POST['id']); // invalid filename
        // check if the user is banned or allowed to submit and SQL Injection checks
        else if($accept['accept'] == 1 and $status['status'] == 1 and is_numeric($_POST['id'])) {
        	$soln = mysqli_real_escape_string($db,$_POST['soln']);
			$filename = mysqli_real_escape_string($db,$_POST['filename']);
			$cname = mysqli_real_escape_string($db,$_POST['cname']);
        	$lang = mysqli_real_escape_string($db,$_POST['lang']);
        	//check if entries are empty
        	if(trim($soln) == "" or trim($filename) == "" or trim($lang) == "")
        		header("Location: solve.php?derror=1&id=".$_POST['id']);
        	else {
			if($_POST['ctype']=='new'){
				// add to database if it is a new submission
				$query = "INSERT INTO `solve` ( `problem_id` , `username`, `soln`, `filename`, `lang`) VALUES ('".$_POST['id']."', '".$_SESSION['username']."', '".$soln."', '".$filename."', '".$lang."')";
				$sql= "INSERT INTO cups (contest,contestid,date,userid,username) VALUES ('".$cname."','".$_POST['id']."',CURRENT_DATE,'$id','".$_SESSION['username']."')";
				mysqli_query($db,$sql)or die ('Error in updating Database');
			}else {
				// update database if it is a re-submission
				$tmp = "SELECT * FROM solve WHERE (problem_id='".$_POST['id']."' AND username='".$_SESSION['username']."')";
				$result = mysqli_query($db,$tmp);
				$fields = mysqli_fetch_array($result);
				$sql= "SELECT * FROM problems where sl='".$_POST['id']."'";
				$r = mysqli_query($db,$sql);
				$f= mysqli_fetch_array($r);
				$p=$f['penalty'];
				$query = "UPDATE solve SET lang='".$lang."', attempts='".($fields['attempts']+1)."',penalty='".($fields['attempts']+1)*$p."',score='".($fields['points']-$fields['penalty'])."', soln='".$soln."', filename='".$filename."' WHERE (username='".$_SESSION['username']."' AND problem_id='".$_POST['id']."')";
			}
			mysqli_query($db,$query);
			// connect to the java compiler server to compile the file and fetch the results

			$socket = fsockopen($compilerhost, $compilerport);
			if($socket) {
				fwrite($socket, $_POST['filename']."\n");
				$query = "SELECT time, input, output FROM problems WHERE sl='".$_POST['id']."'";
				$result = mysqli_query($db,$query);
				$fields = mysqli_fetch_array($result);
				fwrite($socket, $fields['time']."\n");
				$soln = str_replace("\n", '$_n_$', treat($_POST['soln']));
				fwrite($socket, $soln."\n");
				$input = str_replace("\n", '$_n_$', treat($fields['input']));
				fwrite($socket, $input."\n");
				fwrite($socket, $lang."\n");
				$status = fgets($socket);
				$contents = "";
				while(!feof($socket))
					$contents = $contents.fgets($socket);
				if($status == 0) {
					// oops! compile error
					$query = "UPDATE solve SET status=1 WHERE (username='".$_SESSION['username']."' AND problem_id='".$_POST['id']."')";
					mysqli_query($db,$query);
					$_SESSION['cerror'] = trim($contents);
					header("Location: solve.php?cerror=1&id=".$_POST['id']);
				} else if($status == 1) {
					if(trim($contents) == trim(treat($fields['output']))) {
						// holla! problem solved
						$sql= "SELECT * FROM problems where sl='".$_POST['id']."'";
						$r = mysqli_query($db,$sql);
						$f= mysqli_fetch_array($r);
						$s=$f['points'];
						$query = "UPDATE solve SET status=2, points='$s' WHERE (username='".$_SESSION['username']."' AND problem_id='".$_POST['id']."')";
						mysqli_query($db,$query);
						header("Location: index.php?success=1");
					} else {
						// duh! wrong output
						echo trim($contents);
						$query = "UPDATE solve SET status=1 WHERE (username='".$_SESSION['username']."' AND problem_id='".$_POST['id']."')";
						mysqli_query($db,$query);
						header("Location: solve.php?oerror=1&id=".$_POST['id']);
					}
				} else if($status == 2) {
					$query = "UPDATE solve SET status=1 WHERE (username='".$_SESSION['username']."' AND problem_id='".$_POST['id']."')";
					mysqli_query($db,$query);
					header("Location: solve.php?terror=1&id=".$_POST['id']);
				}
			} else
				header("Location: solve.php?serror=1&id=".$_POST['id']); // compiler server not running
		}
	}
?>
<?php
include 'footer.php';
include 'cupsupdate.php';
?>