<?php
	//GET meetodiga saadetud väärtused
	$rating = $_REQUEST["rating"];
	$photoId = $_REQUEST["photoid"];
	require("../../../config_vp2019.php");
	require("functions_users.php");
	$database = "if19_brita_li_1";
	
	require("classes/Session.class.php");
    SessionManager::SessionStart("vp", 0, "/~britalii/", "greeny.cs.tlu.ee");
	
	
	$conn = new mysqli($serverHost, $serverUsername, $serverPassword, $database);
	$stmt = $conn->prepare("INSERT INTO vpphotoratings (photoid, userid, rating) VALUES (?, ?, ?)");
	$stmt->bind_param("iii", $photoId, $_SESSION["userId"], $rating);
	$stmt->execute();
	$stmt->close();
	//küsime uue keskmise hinde
	$stmt=$conn->prepare("SELECT AVG(rating)FROM vpphotoratings WHERE photoid=?");
	$stmt->bind_param("i", $photoId);
	$stmt->bind_result($score);
	$stmt->execute();
	$stmt->fetch();
	$stmt->close();
	$conn->close();
	//ümardan keskmise hinde kaks kohta pärast koma ja tagastan
	echo round($score, 2);