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
  
  $notice = null;
  $trucknumber = null;
  $inweight = null;
  $outweight = null;
  
  $trucknumbererror = null;
  $inweighterror = null;
  $outweighterror = null;
  
  $trucksHTML = readAllTrucksForSelect();
  
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
  
  <h2>Veoki sisenemismassi sisestamine</h3>
	<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" style="display:inline;">
	  <label>Auto registrinumber: </label>
	  <br>
	  <select name="trucknumber">
	    <option value="" selected disabled>Vali auto</option>
		<?php echo $trucksHTML; ?>
	  </select>
	  <br>
	  <label>Veoki sisenemismass:</label><br>
	  <input type="text" name="inweight" value="<?php echo $inweight; ?>">&nbsp;<span><?php echo $inweighterror; ?></span><br>
	  <input name="submitdata" type="submit" value="Salvesta info">&nbsp;<span><?php echo $notice; ?>
	</form>
	
	<h3>Veoki väljumismassi sisestamine</h3>
	<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" style="display:inline;">
	  <label>Auto registrinumber: </label>
	  <br>
	  <select name="trucknumber">
	    <option value="" selected disabled>Vali auto</option>
		<?php echo $trucksHTML; ?>
	  </select>
	  <br>
	  <label>Veoki väljumismass:</label><br>
	  <input type="text" name="outweight" value="<?php echo $outweight; ?>">&nbsp;<span><?php echo $outweighterror; ?></span><br>
	  <input name="submitdata" type="submit" value="Salvesta info">&nbsp;<span><?php echo $notice; ?>
	</form>
  
  </body>
</html>