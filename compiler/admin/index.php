<?php
include 'connection.php';
	require_once('../functions.php');
	if(!loggedin())
		header("Location: login.php");
	else if($_SESSION['username'] !== 'admin')
		header("Location: login.php");
	else
		include('header.php');
		connectdb();
?>
              <li class="active"><a href="#">Admin Panel</a></li>
              <li><a href="users.php">Users</a></li>
              <li><a href="logout.php">Logout</a></li>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>

    <div class="container">
    
      <?php
        if(isset($_GET['changed']))
          echo("<div class=\"alert alert-success\">\nSettings Saved!\n</div>");
        else if(isset($_GET['passerror']))
          echo("<div class=\"alert alert-error\">\nThe old password is incorrect!\n</div>");
        else if(isset($_GET['derror']))
          echo("<div class=\"alert alert-error\">\nPlease enter all the details asked before you can continue!\n</div>");
      ?>
      <ul class="nav nav-tabs">
        <li class="active"><a href="#">General</a></li>
        <li><a href="problems.php">Problems</a></li>
      </ul>
      <div>
        <div>
          <form method="post" action="update.php">
          <?php
          	$query = "SELECT name, accept, c, cpp, java, python,python3,ruby FROM prefs";
          	$result = mysqli_query($db,$query);
          	$fields = mysqli_fetch_array($result);
          ?>
          <input type="hidden" name="action" value="settings"/>
          Name of event: <input name="name" type="text" value="<?php echo($fields['name']);?>"/><br/>
          <input name="accept" type="checkbox" <?php if($fields['accept']==1) echo("checked=\"true\"");?>/> <span class="label label-important">Accept submissions</span><br/>
          <h1><small>Languages</small></h1>
          <input name="c" type="checkbox" <?php if($fields['c']==1) echo("checked=\"true\"");?>/> C<br/>
          <input name="cpp" type="checkbox" <?php if($fields['cpp']==1) echo("checked=\"true\"");?>/> C++<br/>
          <input name="java" type="checkbox" <?php if($fields['java']==1) echo("checked=\"true\"");?>/> Java<br/>
          <input name="python" type="checkbox" <?php if($fields['python']==1) echo("checked=\"true\"");?>/> Python<br/>
          <input name="python3" type="checkbox" <?php if($fields['python3']==1) echo("checked=\"true\"");?>/> Python3<br/>
          <input name="ruby" type="checkbox" <?php if($fields['ruby']==1) echo("checked=\"true\"");?>/> Ruby<br/><br/>
          <input class="btn" type="submit" name="submit" value="Save Settings"/>
          </form>

          <form method="post" action="update.php">
          <input type="hidden" name="action" value="contest"/>
          <h1><small>CONTEST REGISTER</small></h1>
          Contest Name : <input type="text" id="cname" name="cname"/><br/>
          Problem Setter : <input type="text" id="ps" name="ps"/><br/>
          Number of Question : <input type="text" id="noq" name="noq"/><br/>
          Total Score : <input type="text" id="total" name="total"/><br/>
          Date : <input type="date" id="date" name="date"/><br/>
          Start Time : <input type="time" id="time" name="time"/><br/><br/>
          End Time : <input type="time" id="endtime" name="endtime"/><br/><br/>
          <input class="btn" type="submit" name="submit" value="add contest"/>
          </form>


          <hr/>
          <form method="post" action="update.php">
          <input type="hidden" name="action" value="password"/>
          <h1><small>Change Password</small></h1>
          Old password: <input type="password" name="oldpass"/><br/>
          New password: <input type="password" name="newpass"/><br/><br/>
          <input class="btn" type="submit" name="submit" value="Change Password"/>
          </form>
          <hr/>
        </div>
      </div>
    </div> <!-- /container -->
<?php
	include('footer.php');
?>

