<?php
  require("../../../config_vp2019.php");
  require("functionmain.php");
  require("functions_users.php");
  require("function_pic.php");
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
  $picid = null;
  $return = null;
  $notice = null;
  $delnotice = null;
  
  if(isset($_POST["changeUserPicInfo"])){
	  $notice = changePicInfo($_POST["picid"], test_input($_POST["altText"]));
  }
  if(isset($_POST["deleteUserPic"])){
	  $delnotice = deletePic($_POST["picid"], $_POST["return"]);
  }
  
  if(isset($_GET["photoid"])){
	  echo $_GET["photoid"];
	  $userPicHTML = readuserPic($_GET["photoid"]);
  } else {
	  $userPicThumbsHTML = "<p>Pildi lugemisel tekkis viga!</p> \n";
  }
  
  if(isset($_GET["photoid"])){
	  //echo $_GET["photoid"];
	  $picid = $_GET["photoid"];
	  $userPicHTML = readuserPicToEdit($_GET["photoid"]);
	  $return = $_GET["return"];
  } elseif(isset($_POST["picid"])){
	  $picid = $_POST["picid"];
	  $userPicHTML = readuserPicToEdit($_POST["picid"]);
	  $return = $_POST["return"];
  } else {
	  $userPicHTML = null;
  }
  
  //$publicThumbsHTML = readAllPublicPics(2);
  //<link rel="stylesheet" type="text/css" href="style/modal.css">
  
  
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
  <h2>Minu piltide muutmine või kustutamine</h2>
  <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
	<?php
		if(!empty($userPicHTML)){
			echo $userPicHTML;
			echo '<input name="picid" type="hidden" value="' .$picid .'">';
			echo '<input name="return" type="hidden" value="' .$return .'">'; 
			echo "<br>";
			echo '<input name="changeUserPicInfo" type="submit" value="Salvesta muutus!"><span>';
			echo $notice;
			echo "</span> \n";
		} else {
			echo "<p>Pildi laadimisel tekkis viga!</p> \n";
		}
	?>
  </form>
  <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
	<?php
		if(!empty($userPicHTML)){
			echo '<input name="picid" type="hidden" value="' .$picid .'">';
			echo '<input name="return" type="hidden" value="' .$return .'">'; 
			echo '<input name="deleteUserPic" type="submit" value="Kustuta pilt!"><span>';
			echo $delnotice;
			echo "</span> \n";
		}
	?>
  </form>
  	    
  <hr>
</body>
</html>