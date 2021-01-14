<?php
include '../connection.php';
	require_once('functions.php');
	if(!loggedin())
		header("Location: login.php");
	else
		include('header.php');
		connectdb();
?>
<div class="div-profile"><p class="impact" style=color:blue;>Below is a list of submissions you have made. Click on any to edit it.</p></div>
    <div class="div-profile">
    <table class="table table-striped">
      <thead><tr>
	  <th>Contest Name</th>
        <th>Problem</th>
        <th>Attempts</th>
        <th>Status</th>
      </tr></thead>
      <tbody>
      <?php
        // list all the submissions made by the user
        $query = "SELECT problem_id, status,cname, attempts FROM solve WHERE username='".$_SESSION['username']."'";
        $result = mysqli_query($db,$query);
       	while($row = mysqli_fetch_array($result)) {
       		$sql = "SELECT name FROM problems WHERE sl=".$row['problem_id'];
       		$res = mysqli_query($db,$sql);
       		if(mysqli_num_rows($res) != 0) {
       			$field = mysqli_fetch_array($res);
	       		echo("<tr><td><span class=\"label label-success\">".$row['cname']."</span></td><td><a href=\"solve.php?id=".$row['problem_id']."\">".$field['name']."</a></td><td><span class=\"badge badge-info\">".$row['attempts']);
       			if($row['status'] == 1)
       				echo("</span></td><td><span class=\"label label-warning\">Attempted</span></td></tr>\n");
       			else if($row['status'] == 2)
       				echo("</span></td><td><span class=\"label label-success\">Solved</span></td></tr>\n");
       		}
       	}
      ?>
      </tbody>
      </table>
	</div> <!-- /container -->
	<?php
include 'footer.php';
?>