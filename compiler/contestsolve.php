<?php
include '../connection.php';
	require_once('functions.php');
	if(!loggedin())
		header("Location: login.php");
	else
        {include('header.php');
		connectdb();}
?>
             
    <div class="div-profile">
    <?php
        if(isset($_GET['success']))
          echo("<div class=\"alert alert-success\">\nCongratulations! You have solved the problem successfully.\n</div>");
    ?>
	<div class="div-profile"><p class="impact">Below is a list of available problems for you to solve.</p>
	<div><p class="impact" style=color:crimson;>FOR FIRST WRONG SUBMISSION NO PENALTY WILL BE DEDUCTED(IF ANY PENALTY POINT IS THERE)</p></div>
</div>
      <ul class="nav nav-list">
        <li>
        <?php
            // list all the problems from the database
            $sql = "SELECT cname FROM problems where sl='".$_GET['id']."'";
            $res = mysqli_query($db,$sql);
            $r = mysqli_fetch_array($res);
        	$query = "SELECT * FROM problems where cname='".$r['cname']."'";
          	$result = mysqli_query($db,$query);
          	if(mysqli_num_rows($result)==0)
			echo("<li> None </li>\n"); // no problems are there
		else {
			while($row = mysqli_fetch_array($result)) {
				$sql = "SELECT status FROM solve WHERE (username='".$_SESSION['username']."' AND problem_id='".$row['sl']."')";
				$res = mysqli_query($db,$sql);
				$tag = "";
				// decide the attempted or solve tag
				if(mysqli_num_rows($res) !== 0) {
					$r = mysqli_fetch_array($res);
					if($r['status'] == 1)
						$tag = " <span class=\"label label-warning\">Attempted</span>";
					else if($r['status'] == 2)
						$tag = " <span class=\"label label-success\">Solved</span>";
				}
				if(isset($_GET['id']) and $_GET['id']==$row['sl']) {
					$selected = $row;
					echo("<li class=\"active\"><a href=\"#\">".$row['name'].$tag."</a></li>\n");
          	      		} else
          	        		echo("<li><a href=\"contestsolve.php?id=".$row['sl']."\"><font color=green>QUESTION : </font>".$row['name'].$tag."</a></li>\n");
          	    	}
		}
	?></li>
      </ul>
      <?php
        // if any problem is selected then list its details parsed by Markdown
      	if(isset($_GET['id'])) {
      		include('markdown.php');
		$out = Markdown($selected['text']);
		echo("<hr/>\n<h2 style=color:blue;>".$selected['name']."</h2>\n");
		echo($out);
      ?>
      <br/>
      <form action="csolve.php" method="get">
      <input type="hidden" name="id" value="<?php echo($selected['sl']);?>"/>
      <?php
        // number of people who have solved the problem
        $query = "SELECT * FROM solve WHERE(status=2 AND problem_id='".$selected['sl']."')";
        $result = mysqli_query($db,$query);
        $num = mysqli_num_rows($result);
      ?>
      <input class="btn btn-primary btn-large" type="submit" value="Solve"/> <span class="badge badge-info"><?php echo($num);?></span> have solved the problem.
      </form>
      <?php
	}
      ?>
	</div> <!-- /container -->
	<?php
include 'footer.php';
?>