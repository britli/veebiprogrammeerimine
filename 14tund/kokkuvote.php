<?php
  require("../../../config_vp2019.php");
  require("functionmain.php");
  require("functions_users.php");
  require("function_truck.php");
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
  $truckInfoHTML = null;

  unset($_SESSION["trucNumberAdded"]);
  unset($_SESSION["inweightAdded"]);
  unset($_SESSION["outweightAdded"]);
  
  if(isset($_POST["submit1"])){
	 $filmInfoHTML = showFullData();	
  }
 
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
  <hr>
  <h2>Veokite info</h2>
  <?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>
  
  <?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>
  
  <hr>
	<?php
		echo $truckInfoHTML;
	?>
  </body>
</html>