<?php
include '../connection.php';
	require_once('functions.php');
	if(!loggedin())
		header("Location: login.php");
	else
		include('header.php');
		connectdb();
?>

    <style>
      body {
        padding-top: 60px; /* 60px to make the container go all the way to the bottom of the topbar */
      }
      </style>
    <div class="div-profile">
    <link href="css/bootstrap.css" rel="stylesheet">
      <div class="container">
    <?php
    	if(isset($_GET['terror']))
          echo("<div class=\"alert alert-warning\">\nYour program exceeded the time limit. Maybe you should improve your algorithm.\n</div>");
        if(isset($_GET['cerror']))
          echo("<div class=\"alert alert-error\">\n<strong>The following errors occured:</strong><br/>\n<pre>\n".$_SESSION['cerror']."\n</pre>\n</div>");
        else if(isset($_GET['oerror']))
          echo("<div class=\"alert alert-error\">\nYour program output did not match the solution for the problem. Please check your program and try again.\n</div>");
        else if(isset($_GET['lerror']))
          echo("<div class=\"alert alert-error\">\nYou did not use one of the allowed languages. Please use a language that is allowed.\n</div>");
        else if(isset($_GET['serror']))
          echo("<div class=\"alert alert-error\">\nCould not connect to the compiler server. Please contact the admin to solve the problem.\n</div>");
        else if(isset($_GET['derror']))
          echo("<div class=\"alert alert-error\">\nPlease enter all the details asked before you can continue!\n</div>");
        else if(isset($_GET['ferror']))
          echo("<div class=\"alert alert-error\">\nPlease enter a legal filename.\n</div>");
          
        $query = "SELECT * FROM prefs";
        $result = mysqli_query($db,$query);
        $accept = mysqli_fetch_array($result);
        $query = "SELECT status FROM users WHERE username='".$_SESSION['username']."'";
        $result = mysqli_query($db,$query);
        $status = mysqli_fetch_array($result);
        if($accept['accept'] == 0)
          echo("<div class=\"alert alert-error\">\nSubmissions are closed now!\n</div>");
        if($status['status'] == 0)
          echo("<div class=\"alert alert-error\">\nYou have been banned. You cannot submit a solution.\n</div>");
      ?>
    <h1><small>Submit Solution</small></h1>
      <?php
        // display the problem statement
      	if(isset($_GET['id']) and is_numeric($_GET['id'])) {
      		$query = "SELECT * FROM problems WHERE sl='".$_GET['id']."'";
          	$result = mysqli_query($db,$query);
          	$row = mysqli_fetch_array($result);
      		include('markdown.php');
		$out = Markdown($row['text']);
		echo("<hr/>\n<h1>".$row['name']."</h1>\n");
		echo($out);
      ?>
      <br/><span class="label label-info">Time Limit: <?php echo($row['time']/1000); ?> seconds</span>
      <?php
        // get the peviously submitted solution if exists
        if(is_numeric($_GET['id'])) {
          $query = "SELECT * FROM solve WHERE problem_id='".$_GET['id']."' AND username='".$_SESSION['username']."'";
          $result = mysqli_query($db,$query);
          $num = mysqli_num_rows($result);
          $fields = mysqli_fetch_array($result);
        }
      ?>
      <form method="post" action="eval.php">
      <?php if($num == 0)
          echo('<input type="hidden" name="ctype" value="new"/>');
        else
          echo('<input type="hidden" name="ctype" value="change"/>');
      ?>
      <input type="hidden" name="id" value="<?php if(is_numeric($_GET['id'])) echo($_GET['id']);?>"/>
      <?php $query="SELECT cname from problems WHERE sl='".$_GET['id']."'";
      $res=mysqli_query($db,$query);
      $nums=mysqli_num_rows($res);
      $f=mysqli_fetch_array($res);
      ?>
      <input type="hidden" name="cname" value="<?php if($nums == 0) echo('NO DATA'); else echo($f['cname']);?>"/>
      <input type="hidden" name="lang" id="hlang" value="<?php if($num == 0) echo('c'); else echo($fields['lang']);?>"/>
      <br><div class="btn-group">
        <div id="blank"></div>
        <a id="lang" class="btn dropdown-toggle" data-toggle="dropdown" href="#">Language: 
        <?php
          if($num == 0) echo('C');
          else if($fields['lang']=='c') echo('C');
          else if($fields['lang']=='cpp') echo('C++');
          else if($fields['lang']=='java') echo('Java');
          else if($fields['lang']=='python') echo('Python');
          else if($fields['lang']=='python3') echo('Python3');
          else if($fields['lang']=='ruby') echo('Ruby');
        ?>
        <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="#" onclick="changeLang('C');">C</a></li>
          <li><a href="#" onclick="changeLang('C++');">C++</a></li>
          <li><a href="#" onclick="changeLang('Java');">Java</a></li>
          <li><a href="#" onclick="changeLang('Python');">Python</a></li>
          <li><a href="#" onclick="changeLang('Python3');">Python3</a></li>
          <li><a href="#" onclick="changeLang('Ruby');">Ruby</a></li>
        </ul>
      </div>
      <br/><br>
      Filename: <input class="span8" type="text" id="filename" name="filename" value="<?php if(!($num == 0)) echo($fields['filename']);?>"/>
      <br/>Type your program below:<br/><br/>
      
      <textarea style="font-family: mono; height:400px;" class="span9" row="200" col="200" name=soln id="soln"><?php if(!($num == 0)) echo($fields['soln']);?></textarea><br/>
      <?php if($accept['accept'] == 1 and $status['status'] == 1) echo("<input type=\"submit\" value=\"Run\" class=\"btn btn-primary btn-large\"/>");
            else echo("<input type=\"submit\" value=\"Run\" class=\"btn disabled btn-large\" disabled=\"disabled\"/>");
      ?>
      <span class="label label-info">You are allowed to use any of the following languages: 
      <?php $txt="";
        if($accept['c'] == 1) $txt = "C, ";
        if($accept['cpp'] == 1) $txt = $txt."C++, ";
        if($accept['java'] == 1) $txt = $txt."Java, ";
        if($accept['python'] == 1) $txt = $txt."Python, ";
        if($accept['python3'] == 1) $txt = $txt."Python3, ";
        if($accept['ruby'] == 1) $txt = $txt."Ruby, ";
        $final = substr($txt, 0, strlen($txt) - 2);
        echo($final."</span>\n");
      ?>
      </form>
      <?php
	}
      ?>
    </div> <!-- /container -->
    <?php
include 'footer.php';
?>
    <script language="javascript">
      function changeLang(lang) {
        $('#lang').remove();
        $('#blank').after('<a id="lang" class="btn dropdown-toggle" data-toggle="dropdown" href="#">Language: ' + lang + ' <span class="caret"></span></a>');
        if(lang == 'C')
          $('#hlang').val('c');
        else if(lang== 'C++')
          $('#hlang').val('cpp');
        else if(lang== 'Java')
          $('#hlang').val('java');
        else if(lang== 'Python')
          $('#hlang').val('python');
        else if(lang== 'Python3')
          $('#hlang').val('python3');
        else if(lang== 'Ruby')
          $('#hlang').val('ruby');
      }
    </script>
<script src="src/ace.js"></script>
<script src="src-noconflict/ace.js"></script>
<script src="src-noconflict/ext-language_tools.js"></script>
<script>
    function createEditor(name) {
        // find the textarea
        var textarea = document.querySelector("form textarea[name=" + name + "]");

        // create ace editor 
        var editor = ace.edit()
        editor.setTheme("ace/theme/dracula");
        editor.session.setMode("ace/mode/python");
        editor.setOptions({
          enableBasicAutocompletion: true,
          enableSnippets: true,
          enableLiveAutocompletion: true,
          enableEmmet: true
        });
        editor.container.style.height = "250px"
        editor.session.setValue(textarea.value)
        // replace textarea with ace
        textarea.parentNode.insertBefore(editor.container, textarea)
        textarea.style.display = "none"
        // find the parent form and add submit event listener
        var form = textarea
        while (form && form.localName != "form") form = form.parentNode
        form.addEventListener("submit", function() {
            // update value of textarea to match value in ace
            textarea.value = editor.getValue()
        }, true)
    }
    createEditor("soln")
</script>
