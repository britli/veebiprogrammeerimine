<?php
  require("../../../config_vp2019.php");
  require("functionmain.php");
  require("functions_users.php");
  require("function_message.php");
  $database = "if19_brita_li_1";
  
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
  
  $notice = null;
 
  
  if(isset($_POST["submitMessage"])){
	if(!empty(test_input($_POST["message"]))){
		$notice = storeMessage(test_input($_POST["message"]));
	} else{
		$notice = "TÜhja sõnumit ei salvestata!";
	}
  }
  
  //$messageHTML = readAllMessages();
  $messageHTML = readMyMessages();
  
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
  
  <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
	  <label>Minu sõnum</label><br>
	  <textarea rows="5" cols="51" name="message" placeholder="Lisa siia oma sõnum ..."></textarea>
	  <br>
	  
	  <input name="submitMessage" type="submit" value="Salvesta sõnum"><span><?php echo $notice; ?></span>
	</form>
	<hr>
	<h2>Senised sõnumid</h2>
	<?php
	echo $messageHTML;
	?>
  
</body>
</html>

