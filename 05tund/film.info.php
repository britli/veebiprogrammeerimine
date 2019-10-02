<?php
  require("../../../config_vp2019.php");
  require("function_film.php");
  //echo $serverHost;
  $userName = "Brita Liivamaa";
  $database = "if19_brita_li_1";
  
  $filmInfoHTML = readAllFilms();
  
  require("header.php");
  echo "<h1>" .$userName .", veebiprogrammeerimine 2019</h1>";
 ?>
	
  <p>See veebileht on valminud õppetöö käigus ning ei sisalda mingisugust tõsiseltvõetavat sisu!</p>
    
 <hr>
 <h2>Eesti filmid</h2>
 <p>Meie andmebaasis leiduvad järgmised filmid:</p>
  <hr>
  <?php
   echo $filmInfoHTML;
	
  ?>
  

</body>
</html>