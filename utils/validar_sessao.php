<?php

  session_start();
  
  if (isset($_SESSION["email"]) == false)
      header("location: ..?erro=2")

?>
