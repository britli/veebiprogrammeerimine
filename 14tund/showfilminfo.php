<?php
  require("../../../config_vp2019.php");
  require("functionmain.php");
  require("functions_users.php");
  require("function_film.php");
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
  $filmInfoHTML = null;
  //var_dump($_POST);
  
  unset($_SESSION["filmPersonAdded"]);
  unset($_SESSION["filmAdded"]);
  unset($_SESSION["filmProfessionAdded"]);
  
  if(isset($_POST["submit1"])){
	 $filmInfoHTML = showFullDataByPerson();	
  }//
  $filmInfoHTML = showFullDataByPerson();
  
  require("header.php");
?>

  <?php
    echo "<h1>" .$userName ." koolitöö leht</h1>";
  ?>
  <p>See leht on loodud koolis õppetöö raames
  ja ei sisalda tõsiseltvõetavat sisu!</p>
  <hr>
  <p><a href="?logout=1">Logi välja!</a> | Tagasi <a href="home.php">avalehele</a></p>
  <h2>Eesti filmid ja filmitegelased</h2>
  <p>Lisa uut <a href="add.film.php">infot</a>!</p>
  <!--
  <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" style="display:inline;">
	  <input name="sumit1" type="submit" value="Kogu info lähtudes filmitegijaist">
  </form>
	<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" style="display:inline;">
	  <input name="submitNewPassword" type="submit" value="Salvesta uus salasõna">
	</form>
	-->
	
	<hr>
	<?php
		echo $filmInfoHTML;
	?>
  
</body>
</html>


