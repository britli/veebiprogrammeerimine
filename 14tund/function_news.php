<?php
function storeContent($content, $title, $content, $expire){
	$notice = null;
	$conn = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
	$stmt = $conn -> prepare("INSERT INTO vpnews (userid, title, content, expire) VALUES (?,?,?,?)");
	echo $conn -> error;
	$stmt -> bind_param("issi", $_SESSION["userId"], $content);
	if($stmt -> execute()){
		$notice = "Uudis salvestati";
	} else {
		$notice = "Uudise salvestamisel tekkis tehniline tõrge: " .$stmt -> error;
	}
	
	$stmt->close();
	$conn->close();
	return $notice;
}

function readAllContent (){
	$notice = null;
	$conn = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
	$stmt = $conn -> prepare("SELECT title, content, expire FROM vpnews WHERE deleted IS NULL ORDER BY expire DESC");
	echo $conn -> error;
	$stmt -> bind_result($titleFromDb, $contentFromDb, $expireFromDb);
	$stmt -> execute();
	while($stmt -> fetch()){
		$notice .= "<li>" .$titleFromDb ." (Kustub: " .$expireFromDb .")</li> \n";
	}
	if(!empty($notice)){
	   $notice = "<ul> \n" .$notice ."</li> \n";
	} else {
		$notice = "<p>Kahjuks uudiseid ei ole</p> \n";
	}
	
	$stmt->close();
	$conn->close();
	return $notice;
}

function readMyContent (){
	$notice = null;
	$conn = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
	$stmt = $conn -> prepare("SELECT title, content, expire FROM vpnews WHERE userid = ? AND deleted IS NULL ORDER BY expire DESC");
	echo $conn -> error;
	$stmt -> bind_param("i", $_SESSION["userId"]);
	$stmt -> bind_result($titleFromDb, $contentFromDb, $expireFromDb);
	$stmt -> execute();
	while($stmt -> fetch()){
		$notice .= "<li>" .$contentFromDb ." (Kustub: " .$expireFromDb .")</li> \n";
	}
	if(!empty($notice)){
	   $notice = "<ul> \n" .$notice ."</li> \n";
	} else {
		$notice = "<p>Kahjuks uudiseid ei ole</p> \n";
	}
	
	$stmt->close();
	$conn->close();
	return $notice;
}



