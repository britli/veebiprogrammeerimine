<?php
  require("../../../config_vp2019.php");
  require("functionmain.php");
  require("functions_users.php");
  $database = "if19_brita_li_1";
  
  //kontrollime, kas on sisse loginud
  if(!isset($_SESSION["userId"])){
	  header("Location: my.index.php");
	  exit();
  }
  
  //väljalogimine
  if(isset($_GET["logout"])){
	  //sessioon kinni
	  session_unset();
	  session_destroy();
	  header("Location: my.index.php");
	  exit();
  }
  
  $userName = $_SESSION["userFirstname"] ." " .$_SESSION["userLastname"];
 
  
   require("header.php");
    echo "<h1>" .$userName .", veebiprogrammeerimine 2019</h1>";



  ?>
  
  <form method="POST" action="<?php
      $mydescription = null;
	  $bgcolor = null;
	  $mytxtcolor = null;
	  
      echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
	  <label>Minu kirjeldus</label><br>
	  <textarea rows="10" cols="80" name="description"><?php echo $mydescription; ?></textarea>
	  <br>
	  <label>Minu valitud taustavärv: </label><input name="bgcolor" type="color" value="
	  <?php echo $mybgcolor; ?>"><br>
	  <label>Minu valitud tekstivärv: </label><input name="txtcolor" type="color" value="<?php echo $mytxtcolor; ?>"><br>
	  <input name="submitProfile" type="submit" value="Salvesta profiil">
	</form>
	
  
  <p>See veebileht on valminud õppetöö käigus ning ei sisalda mingisugust tõsiseltvõetavat sisu!</p>
  <hr>
  <p>Olete sisseloginud! Logi <a href="?logout=1">välja</a>!</p>

</body>
</html>