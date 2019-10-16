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
	  <input name="newPassword" type="Password"><span><?php echo $passwordError; ?></span><br>
	  <label>Korrake uut salasõna:</label><br>
	  <input name="confirmnewpassword" type="password"><span><?php echo $confirmpasswordError; ?></span><br>
	  <input name="submitUserData" type="submit" value="Muuda parooli"><span><?php echo $notice; ?></span>
	</form>
	<hr>
		
  </body>
</html>