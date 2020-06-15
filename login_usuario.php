<?php

  include_once("conexao.php");

  $email = mysqli_real_escape_string($cadastro, $_POST["email"]);
  $senha = mysqli_real_escape_string($cadastro, $_POST["senha"]);
    
  $sql = "select * from usuario where email = '$email' and senha = '$senha' ";
  
  $resultado = mysqli_query($cadastro, $sql);
  
  if (mysqli_num_rows($resultado) == 1) {
      
     session_start(); 
     
     $dados = mysqli_fetch_assoc($resultado);
     
    $_SESSION["email"] = $email;
    $_SESSION["id_usuario"] = $dados["id_usuario"];

     mysqli_close($cadastro);
     
  
     header("location: menu.php");
     
  } else {
     mysqli_close($cadastro);
     header("location: index.php?erro=1");
  }

?>
