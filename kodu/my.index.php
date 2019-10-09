<?php
 $userName = "Brita Liivamaa";
 
 $photoDir = "../photos/";
 $photoTypesAllowed = ["image/jpeg", "image/png"];
 
 $fullTimeNow = date("D.M.Y H:i:s");
 $hourNow = date("H");
 $partOfDay = "hägune aeg";
 
 if($hourNow < 8){
  $partOfDay = "hommik";
 }
if($hourNow >= 8 and $hourNow <12){
  $partOfDay = "ennelõuna";
 }
if($hourNow >= 12 and $hourNow <16){
  $partOfDay = "lõuna";
 }
 if($hourNow >= 16 and $hourNow <22){
  $partOfDay = "õhtu";
 }
 if($hourNow >= 22){
  $partOfDay = "aeg on magama minna";
 }
 
 //info semestri kulgemise kohta
 $semesterStart = new DateTime("2019-9-2");
 $semesterEnd = new DateTime("2019-12-13");
 $semesterDuration = $semesterStart -> diff($semesterEnd);
 //echo $semesterStart; //objekti nii näidata ei saa!!
 //var_dump($semesterStart);
 //echo $semesterStart -> timezone;
 $today = new DateTime("now");
 $fromSemesterStart = $semesterStart -> diff($today);
 //var_dump($fromSemesterStart);
 //echo $fromSemesterStart -> days;
 //echo "Päevi: " .$fromSemesterStart -> format("%r%a");
 //<p>Semester on täies hoos: <meter min="0" max="110" value="55" >17%</meter></p>
$semesterInfoHTML = "<p>Info semestri kohta pole kättesaadav.</p>";
if ($fromSemesterStart -> format("%r%a") > 0 and $fromSemesterStart -> format("%r%a") <= $semesterDuration -> format("%r%a")){
	 $semesterInfoHTML = "<p>Semester on täies hoos: ";
	 $semesterInfoHTML .= '<meter min="0" ';
	 $semesterInfoHTML .= 'max="' .$semesterDuration -> format("%r%a") .'" ';
	 $semesterInfoHTML .= 'value="' .$fromSemesterStart -> format("%r%a") .'">';
	 $semesterInfoHTML .= round($fromSemesterStart -> format("%r%a") / $semesterDuration -> format("%r%a") * 100, 1) ."%";
	 $semesterInfoHTML .= "</meter></p>";
	 
}
    //juhusliku photo kasutamine 
	$photoList = [];//array ehk massiiv
	
	$allFiles =array_slice(scandir($photoDir), 2);
	//var_dump($allFiles);
	//kontrollin, kas on pildid
	foreach ($allFiles as $file) {
		$fileInfo = getimagesize($photoDir .$file);
		//var_dump($fileInfo);
	if(in_array($fileInfo["mime"], $photoTypesAllowed) == true){
		array_push($photoList, $file);
	  }
	}
	
	//var_dump($photoList);
	//echo $photoList[2];
	$photoCount = count($photoList);
	$randomImgHTML = "";
	if ($photoCount > 0){
	  $photoNum = mt_rand(0, $photoCount - 1);
	  //echo $photoNum;
	  //<img src="../photos/tlu_terra_600x400_1.jpg" alt="juhuslik foto">
	  $randomImgHTML = '<img src="' .$photoDir .$photoList[$photoNum] .'" alt="juhuslik foto">';
	 } else {
		 $randomImgHTML = "<p>Kahjuks pilte ei ole</p>";
         if(isset($_POST["login"])){
		if (isset($_POST["email"]) and !empty($_POST["email"])){
		  $email = test_input($_POST["email"]);
		} else {
		  $emailError = "Palun sisesta kasutajatunnusena e-posti aadress!";
		}
	  
		if (!isset($_POST["password"]) or strlen($_POST["password"]) < 8){
		  $passwordError = "Palun sisesta parool, vähemalt 8 märki!";
		}
	  
		if(empty($emailError) and empty($passwordError)){
		   $notice = signIn($email, $_POST["password"]);
		} else {
			$notice = "Ei saa sisse logida!";
		}
	 }
    require("header.php");
   echo "<h1>" .$userName .", veebiprogrammeerimine 2019</h1>";
    ?>
	
  <p>See veebileht on valminud õppetöö käigus ning ei sisalda mingisugust tõsiseltvõetavat sisu!</p>
    
<?php
 echo $semesterInfoHTML; 
 echo "See on minu esimene PHP!</p>";
 echo "<p> Lehe avamise hetkel oli " .$fullTimeNow .", " .$partOfDay . ".</p>" ;
?>
<hr>
  <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
	  <label>E-mail (kasutajatunnus):</label><br>
	  <input type="email" name="email" value="<?php echo $email; ?>">&nbsp;<span><?php echo $emailError; ?></span><br>
	  
	  <label>Salasõna:</label><br>
	  <input name="password" type="password">&nbsp;<span><?php echo $passwordError; ?></span><br>
	  
	  <input name="login" type="submit" value="Logi sisse">&nbsp;<span><?php echo $notice; ?>
	</form>
  <hr>
  <?php
    echo $randomImgHTML;
	
  ?>
  

</body>
</html>