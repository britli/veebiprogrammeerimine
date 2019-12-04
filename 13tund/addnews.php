<?php
  require("../../../config_vp2019.php");
  require("functionmain.php");
  require("functions_users.php");
  require("function_news.php");
  $database = "if19_brita_li_1";
  
  require("classes/Session.class.php");
  SessionManager::SessionStart("vp", 0, "/~britalii/", "greeny.cs.tlu.ee");
  
  //kui pole sisseloginud
  if(!isset($_SESSION["userId"])){
	  //siis jõuga sisselogimise lehele
	  header("Location: my.index.php");
	  exit();
  }
  
  //väljalogimine
  if(isset($_GET["logout"])){
	  session_destroy();
	  header("Location: my.index.php");
	  exit();
  }
  
  $userName = $_SESSION["userFirstname"] ." " .$_SESSION["userLastname"];
  
	$error = "";
	$newsTitle = "";
	$news = "";
	$expiredate = date("Y-m-d");
  
  
  if(isset($_POST["newsBtn"])){
	$notice = storeNews($_POST["newsTitle"], $_POST["newsEditor"], $_POST["expiredate"]);
	if(!empty($_POST["newsTitle"])){
	  $myDescription = $_POST["newsTitle"];
	}
	$_SESSION["newsEditor"] = $_POST["newsEditor"];
	$_SESSION["expiredate"] = $_POST["expiredate"];
  } else {
	$myProfileDesc = showMyDesc();
	if($myContent != ""){
	  $myContent = $myProfileContent;
    }
  }
  
  $contentHTML = readMyContent();
  
  $toScript = "\t" .'<script src="//cdn.tinymce.com/4/tinymce.min.js"></script><script>tinymce.init({selector:"textarea#newsEditor", plugins: "link", menubar: "edit",});</script>' ."\n";
  
  require("header.php");
?>
<body>
  <?php
    echo "<h1>" .$userName ." koolitöö leht</h1>";
  ?>
  <p>See leht on loodud koolis õppetöö raames
  ja ei sisalda tõsiseltvõetavat sisu!</p>
  <hr>
  <p><a href="?logout=1">Logi välja!</a> | Tagasi <a href="home.php">avalehele</a></p>
  <h2>Lisa uudis</h2>
	<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
		<label>Uudise pealkiri:</label><br><input type="text" name="newsTitle" id="newsTitle" style="width: 100%;" value="<?php echo $newsTitle; ?>"><br>
		<label>Uudise sisu:</label><br>
		<textarea name="newsEditor" id="newsEditor"><?php echo $news; ?></textarea>
		<br>
		<label>Uudis nähtav kuni (kaasaarvatud)</label>
		<input type="date" name="expiredate" required pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}" value="<?php echo $expiredate; ?>">
		
		<input name="newsBtn" id="newsBtn" type="submit" value="Salvesta uudis!"> <span>&nbsp;</span><span><?php echo $error; ?></span>
	</form>
	<hr>
	<h3>Lisatud uudised</h3>
	<?php
	echo $contentHTML;
	?>

</body>
</html>

