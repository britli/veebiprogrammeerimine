<?php
  require("functionmain.php");
  require("../../../config_vp2019.php");
  require("functions_users.php");
  $database = "if19_brita_li_1";
  
  $notice = null;
  $email =  null;
  $emailError = null;
  $oldPasswordError = null;
  $confirmpasswordError = null;
  $newpasswordError = null;
  


function passwordChange($password){
	$notice = null;
	$stmt->close();
		$stmt = $conn->prepare("UPDATE vpusers password");
		echo $conn->error;
		#$stmt->bind_param("sssi", $description, $bgColor, $txtColor, $_SESSION["userID"]);
		if($stmt->execute()){
			$notice = "Parool edukalt muudetud!";
			
		} else {
			$notice = "Parooli muutmisel tekkis tõrge! " .$stmt->error;
		}
	
	$stmt->close();
	$conn->close();
	return $notice;
}


if (!isset($_POST["newpassword"]) or empty($_POST["newpassword"])){
	  $newpasswordError = "Palun sisesta salasõna!";
	} else {
	  if(strlen($_POST["newpassword"]) < 8){
	    $newpasswordError = "Liiga lühike salasõna (sisestasite ainult " .strlen($_POST["newpassword"]) ." märki).";
	  }
	}


  if (!isset($_POST["confirmnewpassword"]) or empty($_POST["confirnewmpassword"])){
	  $confirmpasswordError = "Palun sisestage salasõna kaks korda!";  
	} else {
	  if($_POST["confirmnewpassword"] != $_POST["newpassword"]){
	    $confirmpasswordError = "Sisestatud salasõnad ei olnud ühesugused!";
	  }
	}

if(empty($emailerror) and empty($oldPasswordError) and empty($confirmpasswordError) and empty($newpasswordError)){
		$notice = signUp($_POST["password"]);
	} else {
		$notice = "Ei saa parooli muuta, andmed on puudulikud!";
	}
	
  

  ?>
  
  <!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
	<title>Parooli vahetus</title>
  </head>
  <body>
    <h1>Vaheta enda parooli</h1>
	<hr>
	
	<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
	  <label>Kasutajanimi mille parooli soovid muuta:</label><br>
	  <input type="email" name="email" value="<?php echo $email; ?>">&nbsp;<span><?php echo $emailError; ?></span><br>
	  
	  <label>Vana salasõna:</label><br>
	  <input name="oldPassword" type="Password">&nbsp;<span><?php echo $oldPasswordError; ?></span><br>
	  <label>Uus salasõna (min 8 tähemärki):</label><br>
	  <input name="newPassword" type="Password"><span><?php echo $newpasswordError; ?></span><br>
	  <label>Korrake uut salasõna:</label><br>
	  <input name="confirmnewpassword" type="password"><span><?php echo $confirmpasswordError; ?></span><br>
	  <input name="submitUserData" type="submit" value="Muuda parooli"><span><?php echo $notice; ?></span>
	</form>
	<hr>
		
  </body>
</html>
