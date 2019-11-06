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
  
  <body>
<?php
  echo "<h1>" .$userName .", veebiprogrammeerimine 2019</h1>";
  ?>
  <p>See veebileht on valminud õppetöö käigus ning ei sisalda mingisugust tõsiseltvõetavat sisu!</p>
  <hr>
  <p>Olete sisseloginud! Logi <a href="?logout=1">välja</a>! Vaheta <a href="parool.php">parooli</a>!</p>
    <ul>
    <li><a href="userprofile.php">Kasutajaprofiil</a></li>
	 <li><a href="messages.php">Sõnumid</a></li>
	 <li><a href="showfilminfo.php">Filmide vaatamine</a></li>
	 <li><a href="photo_upload.php">Piltide üleslaadimine</a></li>
  </ul>

</body>
</html>