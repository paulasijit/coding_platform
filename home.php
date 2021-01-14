<!DOCTYPE html>
<?php
  include 'connection.php';
  session_start();
  $id=$_SESSION['id'];
  if (!(isset($_SESSION['id']))) {
    header('location:index.php');
  }
  $query=mysqli_query($db,"SELECT * FROM users where user_id='$id'")or die(mysqli_error($db));
  $row=mysqli_fetch_array($query);
  ?>
<html lang="en-US">
<style>
      body {
        padding-top: 50px; /* 60px to make the container go all the way to the bottom of the topbar */
      }
      </style>
  <head>
  <title>CodeWar</title>
  <link rel="stylesheet" href="libs/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/text.css">
  <link rel="stylesheet" href="libs/style.css">
  <link rel="stylesheet" href="libs/div.css">
  <link rel="stylesheet" href="libs/navbar.css">
  <link rel="stylesheet" href="libs/multidiv.css">

  </head>
  <ul>
  <li><a class="active" href="home.php">Home</a></li>
  <li><a href="contest.php">Contest</a></li>
  <!--<li><a href="/compiler/index.php">Problems</a></li>-->
  <li><a href="/compiler/submissions.php">Submissions</a></li>
  <li><a href="/compiler/scoreboard.php">Scoreboard</a></li>
  <li><a href="ranking.php">Ranking</a></li>
  <li><a href="news.php">News</a></li>
  <li><a href="contact.php">Contact</a></li>
  <li><a href="about.php">About</a></li>
  <li><a href="profile.php"><?php echo $row['username'];?></a></li>
  <li><a class="inactive" href="logout.php">LOGOUT</a></li>
  <li class="right">
  <form action="search.php" method="GET">
  <input id="search" name="search" type="text" placeholder="SEARCH..." required>
  <input id="submit" type="submit" value="Search">
  </form>
  </li>
  </ul>

  <br/><b><font style="color: blue;"> EDITORIAL SECTION:</font> SOLUTION FOR B. Non-zero Segments</b><br/><br/>
  <forn>
  <p style="color:red;"><b>SOLUTION 1</b></p>
  <center><textarea style="font-family: mono; height:300px;" class="span9" row="200" col="400" name="soln" id="editor" readonly>
n = int(input())
lst = list(map(int,input().split()))
pref = dict()
sum = lst[0]
pref[lst[0]] = 1
pref[0] = 1
res = 0
for r in range(1, n):
    sum += lst[r]
    if pref.get(sum, 0):
        pref = dict()
        pref[0] = 1
        res += 1
        sum = lst[r]
    pref[sum] = 1
print(res)</textarea></center><br/>
<p style="color:red;"><b>SOLUTION 2</b></p>
 <center><textarea style="font-family: mono; height:300px;" class="span9" row="200" col="400" name="soln" id="editor" readonly>
def cal(n, arr):
    dic = {}
    res = 0
    cur_sum = 0
    for num in arr:
        cur_sum += num
        if (cur_sum in dic) or (cur_sum == 0):
            res += 1
            dic = {}
            cur_sum = num
        dic[cur_sum] = True
 
    return res
 
n = int(input())
arr = list(map(int, input().split()))
print(cal(n, arr))
 </textarea><br/>
 </center>
</forn>
<script src="src/ace.js"></script>
<script src="src-noconflict/ace.js"></script>
<script src="src-noconflict/ext-language_tools.js"></script>
<script src="js/jquery.js"></script>
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

        textarea.css('visibility', 'hidden');
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