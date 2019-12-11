<?php
  require("../../../config_vp2019.php");
  require("functionmain.php");
  //require("functions_users.php");
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
  
  $notice = null;
  $trucknumber = null;
  $trucknumbererror = null;
  $truckNotice = null;
  
  if(isset($_POST["storeTruck"])){
	if(!empty(test_input($_POST["trucknumber"]))){
		$notice = storeTruck(test_input($_POST["trucknumber"]));
	} else{
		$notice = "Palun täida lahter!";
	}
	
	if(empty($trucknumberError)){
		  $truckNotice = addTruckNumber($trucknumber);
		  if($truckNotice == 1){
			  $trucknumber = null;
			  $truckNotice = "Uue ameti lisamine õnnestus!";
		  }
	  }
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
  <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
	  <label>Auto registrinumber:</label><br>
	  <input type="text" name="trucknumber" value="<?php echo $trucknumber; ?>">&nbsp;<span><?php echo $trucknumbererror; ?></span><br>
	  <input name="submitdata" type="submit" value="Lisa auto">&nbsp;<span><?php echo $notice; ?>
	</form>
	
	
  
  </body>
</html>