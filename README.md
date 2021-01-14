# [CODING EXAM PORTAL](https://www.linkedin.com/in/asijit-paul-2142881a2/)

### Clone the code or fork it to your local machine
#### Step 1: Host the website
* Upload all the files except the folder `code-judge-compiler` inside `./compiler/`
* Move the `codejudge-compiler` to your compiler machine
* You need to set a port for the compiler and make sure the compiler machine is accessable in `WEB`
* Make sure to write rules for firewall as someone code can take over your comiler server machine with injected code!

#### Step 2: Install all the languages
* Make sure all the language is compiling in your server

#### Step 3: Admin Registration
* To set exam and question use admin portal 

### CODE EDITOR
* We used [`ACE Editor`](https://ace.c9.io/) as our editor you can use anything! All required files for `ACE Editor` is inside `./src/ace.js`

### SCRIPT FOR ACE EDITOR

```javascript

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

```
* NOTE: To use `ACE Editor in your textfield use the below code (Please consider the aboce code as a part of it).
```html
<textarea style="font-family: mono; height:400px;" class="span9" row="200" col="400" name="soln" id="editor">
```


### Note:
Adding new languages is easy just follow the code which are already there!

```java
//for python3 support

public void compile() {
		try {
			BufferedWriter out = new BufferedWriter(new OutputStreamWriter(new FileOutputStream(dir + "/" + file)));
			out.write(contents);
			out.close();
			// create the execution script
			out = new BufferedWriter(new OutputStreamWriter(new FileOutputStream(dir + "/run.sh")));
			out.write("cd \"" + dir +"\"\n");
			out.write("chroot .\n");
			out.write("python3 " + file + "< in.txt > out.txt 2>err.txt");
			out.close();
			Runtime r = Runtime.getRuntime();
			Process p = r.exec("chmod +x " + dir + "/run.sh");
			p.waitFor();
			p = r.exec(dir + "/run.sh"); // execute the script
			TimedShell shell = new TimedShell(this, p, 3000);
			shell.start();
			p.waitFor();
		} catch (FileNotFoundException e) {
			e.printStackTrace();
		} catch (IOException e) {
			e.printStackTrace();
		} catch (InterruptedException e) {
			e.printStackTrace();
		}
	}


```

```java
//for Cpp support

public void compile() {
		try {
			BufferedWriter out = new BufferedWriter(new OutputStreamWriter(new FileOutputStream(dir + "/" + file)));
			out.write(contents);
			out.close();
			// create the compiler script
			out = new BufferedWriter(new OutputStreamWriter(new FileOutputStream(dir + "/compile.sh")));
			out.write("cd \"" + dir +"\"\n");
			out.write("g++ -lm " + file + " 2> err.txt");
			out.close();
			Runtime r = Runtime.getRuntime();
			Process p = r.exec("chmod +x " + dir + "/compile.sh");
			p.waitFor();
			p = r.exec(dir + "/compile.sh"); // execute the compiler script
			p.waitFor();
		} catch (FileNotFoundException e) {
			e.printStackTrace();
		} catch (IOException e) {
			e.printStackTrace();
		} catch (InterruptedException e) {
			e.printStackTrace();
		}
	}
	
	public void execute() {
		try {
			// create the execution script
			BufferedWriter out = new BufferedWriter(new OutputStreamWriter(new FileOutputStream(dir + "/run.sh")));
			out.write("cd \"" + dir +"\"\n");
			out.write("chroot .\n");
			out.write("./a.out < in.txt > out.txt");
			out.close();
			Runtime r = Runtime.getRuntime();
			Process p = r.exec("chmod +x " + dir + "/run.sh");
			p.waitFor();
			p = r.exec(dir + "/run.sh"); // execute the script
			TimedShell shell = new TimedShell(this, p, 3000);
			shell.start();
			p.waitFor();
		} catch (FileNotFoundException e) {
			e.printStackTrace();
		} catch (IOException e) {
			e.printStackTrace();
		} catch (InterruptedException e) {
			e.printStackTrace();
		}
	}

```

```java

public void compile() {
		try {
			BufferedWriter out = new BufferedWriter(new OutputStreamWriter(new FileOutputStream(dir + "/" + file)));
			out.write(contents);
			out.close();
			// create the execution script
			out = new BufferedWriter(new OutputStreamWriter(new FileOutputStream(dir + "/run.sh")));
			out.write("cd \"" + dir +"\"\n");
			out.write("chroot .\n");
			out.write("ruby " + file + "< in.txt > out.txt 2>err.txt");
			out.close();
			Runtime r = Runtime.getRuntime();
			Process p = r.exec("chmod +x " + dir + "/run.sh");
			p.waitFor();
			p = r.exec(dir + "/run.sh"); // execute the script
			TimedShell shell = new TimedShell(this, p, 3000);
			shell.start();
			p.waitFor();
		} catch (FileNotFoundException e) {
			e.printStackTrace();
		} catch (IOException e) {
			e.printStackTrace();
		} catch (InterruptedException e) {
			e.printStackTrace();
		}
	}

```

### Note:

We need `execute()` function for languages like `cpp, c, java,` etc.

We don't need `execute()` function for languages like `python, python3, pypy`, etc.


### GET ACCESS TO THE COMPILER SERVER
* Install `Visual Studio Code` to run the server side script with ease!
* [Visual Studio Code Link](https://code.visualstudio.com/download)
* Make sure your compiler server support `python`, `pypy`, `java`, `C++`, `ruby`, `C`.

```php
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
```

#### Note:
* The working code can be found in `eval.php` file.
* The variable `$compilerhost, $compilerport` in the below line contains compiler server `ip address & port` to make a socket connection

### SOCKET CONNECTION
```php

// $host="localhost";
// $user="root";
// $password="";
// $database="codewar";
$compilerhost="192.168.0.5";
$compilerport=3029;

```


```php

//reading compiler server details
$socket = fsockopen($compilerhost, $compilerport);

```


### EVALUATION OF CODE

```php

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
}

```
The working code can be found in `eval.php` file.

### GRAP SCRIPT
```javascript

window.onload = function () { 
		
	var chart = new CanvasJS.Chart("chartContainer", {
        animationEnabled: true, 
			title:{ 
				text: "<?php echo $username ?>'s SCORE GRAPH"
			},	 
			axisY: { 
				title: "SCORE", 
				titleFontColor: "#4F81BC", 
				lineColor: "#4F81BC", 
				labelFontColor: "#4F81BC", 
				tickColor: "#4F81BC"
			}, 	 
			toolTip: { 
				shared: true 
			}, 
			legend: { 
				cursor:"pointer", 
				itemclick: toggleDataSeries 
			}, 
			data: [{ 
				type: "line", 
				name: "SCORE", 
				legendText: "SCORE", 
				showInLegend: true, 
                dataPoints:<?php echo json_encode($dataPoints,
                            JSON_NUMERIC_CHECK); ?> 
			}, ] 
			}); 
		chart.render(); 
			function toggleDataSeries(e) { 
                    if (typeof(e.dataSeries.visible) === "undefined"
                    			|| e.dataSeries.visible) { 
					e.dataSeries.visible = false; 
				} 
				    else { 
					    e.dataSeries.visible = true; 
				} 
			chart.render(); 
		} 
		
    }
```

### TITLE UPDATE CODE 

```php
//logical part
if($cup < 1200){
     mysqli_query($db,"UPDATE users SET title='Newbie',cup='$cup' WHERE user_id='$id'");
  }
  elseif($cup >1200 and $cup<1400)
  {
    mysqli_query($db,"UPDATE users SET title='Pupil',cup='$cup' WHERE user_id='$id'");
  }
  elseif($cup >1400 and $cup < 1600)
  {
    mysqli_query($db,"UPDATE users SET title='Specialist',cup='$cup' WHERE user_id='$id'");
  }
  elseif($cup >1600 and $cup < 1900)
  {
    mysqli_query($db,"UPDATE users SET title='Expert',cup='$cup' WHERE user_id='$id'");
  }
  elseif($cup >1900 and $cup < 2100)
  {
    mysqli_query($db,"UPDATE users SET title='Candidate Master',cup='$cup' WHERE user_id='$id'");
  }
  elseif($cup >2100 and $cup < 2300)
  {
    mysqli_query($db,"UPDATE users SET title='Master',cup='$cup' WHERE user_id='$id'");
  }
  elseif($cup >2300 and $cup < 2400)
  {
    mysqli_query($db,"UPDATE users SET title='International Master',cup='$cup' WHERE user_id='$id'");
  }
  elseif($cup >2400 and $cup < 2600)
  {
    mysqli_query($db,"UPDATE users SET title='International Grandmaster',cup='$cup' WHERE user_id='$id'");
  }
  elseif($cup >3000)
  {
    mysqli_query($db,"UPDATE users SET title='Legendry Grandmaster',cup='$cup' WHERE user_id='$id'");
  }

```

### ADDING FRIENDS

```php
<?php
if(isset($_POST['frnd'])){
    $idb =$_POST['god'];
    $query=mysqli_query($db,"SELECT * FROM users where user_id='$idb'")or die(mysqli_error($db));
    $row=mysqli_fetch_array($query);
    $u=$row['username'];
    $queryUser="SELECT * FROM friends where user_id_a='$id' and user_id_b='$idb'";
    $result = mysqli_query($db,$queryUser);
    $rowUser=mysqli_fetch_array($result);
    if(mysqli_num_rows($result)>0){
        $c=$rowUser['flag'];
    }
    if(mysqli_num_rows($result)==0){
        $sql="INSERT INTO friends(user_id_a,user_id_b,status,flag) VALUES($id,$idb,'Friends',1)";
        mysqli_query($db,$sql) or die ('Error in updating Database');
?>
 <script type="text/javascript">
        alert("Added <?php echo $u; ?> As Friend!");
        window.location = "user.php?user=<?php echo $u; ?>";
</script>
<?php
    }
    else if($c=='1'){
        $query = "UPDATE friends SET status='Add Friend', flag='0'
        WHERE user_id_a = '$id' and user_id_b='$idb'";
        $result = mysqli_query($db, $query) or die(mysqli_error($db));
?>
<script type="text/javascript">
        alert("Removed <?php echo $u; ?> From Friend!");
        window.location = "user.php?user=<?php echo $u; ?>";
</script>
<?php
        }else{
            $query = "UPDATE friends SET status='Friends', flag='1'
            WHERE user_id_a = '$id' and user_id_b='$idb'";
            $result = mysqli_query($db, $query) or die(mysqli_error($db));
?>
<script type="text/javascript">
        alert("Added <?php echo $u; ?> As Friend!");
        window.location = "user.php?user=<?php echo $u; ?>";
</script>
<?php
    }
}
?>

```

### CONTEST SCHEDULE

```php

$query=mysqli_query($db,"SELECT * FROM users where user_id='$id'")or die(mysqli_error($db));
$rows=mysqli_fetch_array($query);
$d1=date("Y-m-d");
$sql=mysqli_query($db,"SELECT * FROM contest where start BETWEEN CURDATE() and DATE_ADD(CURDATE(), INTERVAL 30 DAY) order by start")or die(mysqli_error($db));
$num_row=mysqli_num_rows($sql);
$d1=date("Y-m-d");
if($num_row>0){
    while ($con=mysqli_fetch_assoc($sql)){
        $diff = (strtotime( $con['start'])-strtotime($d1));
        $contest = strtotime($con['starttime'])-time();
        $y = floor($diff / (365*60*60*24));
        $m = floor(($diff - $y * 365*60*60*24) / (30*60*60*24));
        $d = floor(($diff - $y* 365*60*60*24 - $m*30*60*60*24)/ (60*60*24);
        $d2='DAYS';
        $h='HRS';
    if ($y<0){
        $d='';
        $d2='CONTEST ENDED';
        }

```

### WANT TO CONTRIBUTE
* Clone the project make a new brunch with your name
* commit it and make pull request
* add me as a reviewer

### My Profiles
* [@twitter](https://twitter.com/asijit_paul)
* [@facebook](https://www.facebook.com/asijit.paul/)
* [@instagram](https://www.instagram.com/heyasijit)
* Currently working at [MapUp.Ai](https://mapup.ai/)

## License
ISC License (ISC). Copyright 2021 &copy;ASIJIT PAUL. https://www.linkedin.com/in/asijit-paul-2142881a2/

Permission to use, copy, modify, and/or distribute this software for any purpose without fee is hereby granted, provided that the above copyright notice and this permission notice appear in all copies.

Permission to use, copy, modify, and/or distribute this software for any purpose with fee is hereby not granted!

THE SOFTWARE IS PROVIDED "AS IS" AND THE AUTHOR DISCLAIMS ALL WARRANTIES WITH REGARD TO THIS SOFTWARE INCLUDING ALL IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS. IN NO EVENT SHALL THE AUTHOR BE LIABLE FOR ANY SPECIAL, DIRECT, INDIRECT, OR CONSEQUENTIAL DAMAGES OR ANY DAMAGES WHATSOEVER RESULTING FROM LOSS OF USE, DATA OR PROFITS, WHETHER IN AN ACTION OF CONTRACT, NEGLIGENCE OR OTHER TORTIOUS ACTION, ARISING OUT OF OR IN CONNECTION WITH THE USE OR PERFORMANCE OF THIS SOFTWARE.
