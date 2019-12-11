<?php
  require("../../../config_vp2019.php");
  require("functionmain.php");
  //require("functions_users.php");
  $database = "if19_brita_li_1";
  
  require("classes/Session.class.php");
  SessionManager::SessionStart("vp", 0, "/~britalii/", "greeny.cs.tlu.ee");
  
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
  
  //küpsised ehk cookie's
  //nimi, väärtus, aegumistähtaeg, kataloogide rada, domeen, kas https, kas http ühendus (http only)
  setcookie("vpusername", $_SESSION["userFirstname"] ." " .$_SESSION["userLastname"], time() + (86400 * 31), "/~britalii/", "greeny.cs.tlu.ee", isset($_SERVER["HTTPS"]), true);
  
  //Kustutamiseks seada küpsis aegumistähtajaga minevikus
  //time() - 1000
  
  echo "Küpsiste arve:" .count($_COOKIE);
  if(isset($_COOKIE["vpusername"])){
	  echo "Leiti küpsis: " .$_COOKIE["vpusername"];
  } else {
	  echo "Ei mingeid küpsiseid!";
  }
  
  $userName = $_SESSION["userFirstname"] ." " .$_SESSION["userLastname"];
 
  
   require("header.php");
    echo "<h1>" .$userName .", veebiprogrammeerimine 2019</h1>";



  ?>
  
  <body>
  <p>See veebileht on valminud õppetöö käigus ning ei sisalda mingisugust tõsiseltvõetavat sisu!</p>
  <hr>
  <p>Olete sisseloginud! Logi <a href="?logout=1">välja</a>! Vaheta <a href="parool.php">parooli</a>!</p>
    <ul>
    <li><a href="userprofile.php">Kasutajaprofiil</a></li>
	 <li><a href="messages.php">Sõnumid</a></li>
	 <li><a href="showfilminfo.php">Filmide vaatamine</a></li>
	 <li><a href="photo_upload.php">Piltide üleslaadimine</a></li>
	 <li><a href="gallery.php">Pildigalerii</a></li>
	 <li><a href="usergallery.php">Minu enda piltide galerii</a></li>
	 <li><a href="editpic.php">Minu piltide muutmine või kustutamine</a></li>
	 <li><a href="addnews.php">Uudiste lisamine</a></li>
	 <li><a href="veokite_lisamine.php">Veokite lisamine</a></li>
	 <li><a href="viljavedu.php">viljavedu</a></li>
	 <li><a href="kokkuvote.php">Kokkuvõte</a></li>
  </ul>

</body>
</html>