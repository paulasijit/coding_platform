<?php
include '../connection.php';
	require_once('functions.php');
	if(!loggedin())
		header("Location: login.php");
	else
		include('header.php');
		connectdb();
?>
<div class="div-profile"><p class="impact">The current standings of all the participants, the number of problems they have attempted and solved.</p></div>
    <div class="div-profile">
    <table class="table table-striped">
      <thead><tr>
        <th>Name</th>
        <th>Solved</th>
        <th>Attempted</th>
      </tr></thead>
      <tbody>
      <?php
        $query = "SELECT username, status FROM users WHERE username!='admin' and username!='USER NOT FOUND'";
        $result = mysqli_query($db,$query);
       	while($row = mysqli_fetch_array($result)) {
       		// displays the user, problems solved and attempted
       		$sql = "SELECT * FROM solve WHERE (status='2' AND username='".$row['username']."')";
       		$res = mysqli_query($db,$sql);
       		echo("<tr><td>".$row['username']." ");
       		if($row['status'] == 0) echo("</a> <span class=\"label label-important\">Banned</span>");
       		echo("</td><td><span class=\"badge badge-success\">".mysqli_num_rows($res));
       		$sql = "SELECT * FROM solve WHERE (status='1' AND username='".$row['username']."')";
       		$res = mysqli_query($db,$sql);
       		echo("</span></td><td><span class=\"badge badge-warning\">".mysqli_num_rows($res)."</span></td></tr>");
       	}
      ?>
      </tbody>
      </table>
    </div> <!-- /container -->
	<?php
include 'footer.php';
?>