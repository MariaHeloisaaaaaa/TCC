<?php

  session_start();
  
  if (isset($_SESSION["email"]) == false)
      header("location: index.php?erro=2")

?>
