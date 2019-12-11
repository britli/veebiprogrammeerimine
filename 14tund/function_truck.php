<?php
function storeTruck($trucknumber){
	$notice = null;
	$conn = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
	$stmt = $conn -> prepare("INSERT INTO vptrucks (trucknumber) VALUES (?)");
	echo $conn -> error;
	$stmt -> bind_param("s");
	if($stmt -> execute()){
		$notice = "Auto salvestati";
	} else {
		$notice = "Auto salvestamisel tekkis tehniline tõrge: " .$stmt -> error;
	}
	
	$stmt->close();
	$conn->close();
	return $notice;
}

function readAllTrucksForSelect(){
	  $trucksHTML = null;
	  $maxTruckId = 0;
	  if(isset($_SESSION["truckNumberAdded"]) and !empty($_SESSION["truckNumberAdded"])){
		  $maxPersonId = $_SESSION["truckNumberAdded"];
	  }
	  $conn = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
	  $stmt = $conn->prepare("SELECT id, trucknumber FROM vptrucks ORDER BY trucknumber DESC");
	  echo $conn->error;
	  $stmt->bind_result($idFromDb, $truckNumberFromDb);
	  $stmt->execute();
	  while($stmt->fetch()){
	  	  $trucksHTML .= '<option value="' .$idFromDb .'"';
		  if($idFromDb == $maxTruckId){
			  $trucksHTML .= " selected";
		  }
		  $trucksHTML .= ">" .$trucknumberFromDb ."</option> \n";
	  }
	  $stmt->close();
	  $conn->close();
	  return $trucksHTML;
  }