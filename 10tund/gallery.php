<?php
  require("../../../config_vp2019.php");
  //require("functionmain.php");
  require("functions_users.php");
  require("function_pic.php");
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
  
  $page = 1;
  $limit = 3;
  $picCount = countPics(2);
  echo $picCount;
  if(!isset($_GET["page"]) or $_GET["page"] < 1){
	  $page =1;
  } elseif (round(($_GET["page"] - 1) * $limit) >= $picCount){
	  $page = round($picCount / $limit);
  } else {
	  $page = round($_GET["page"]);
  }
  
  $galleryHTML= showPics(2, $page, $limit);
  echo $page;
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
  <h2>Pildigalerii</h2>
  <p>
  <?php
	if($page > 1){
		echo '<a href="?page=' .($page - 1) .'">Eelmine leht</a>  ';
	} else {
		echo "<span>Eelmine leht</span>  ";
	}
	if($page * $limit < $picCount){
		echo '<a href="?page=' .($page + 1) .'">Järgmine leht</a>';
	} else {
		echo "<span>Järgmine leht</span>";
	}
  ?>
  
  </p>
  <?php
	echo $galleryHTML;
  ?>
	  
</body>
</html>
