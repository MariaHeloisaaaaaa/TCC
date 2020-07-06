<?php

  include_once("conexao.php");

  $email = mysqli_real_escape_string($conexao, $_POST["email"]);
  $senha = mysqli_real_escape_string($conexao, $_POST["senha"]);
    
  $stmt = $conexao->prepare("SELECT * FROM usuario WHERE email = ? AND senha = ?");
  $stmt->bind_param("ss", $_POST['name'], $_POST['age']);
  $stmt->execute();
  $stmt->close();
  
  
  if (mysqli_num_rows($stmt) == 1) {
      
     session_start(); 
     
     $dados = mysqli_fetch_assoc($stmt);
     
    $_SESSION["email"] = $email;
    $_SESSION["id_usuario"] = $dados["id_usuario"];

     mysqli_close($conexao);
     
  
     header("location: menu.php");
     
  } else {
     mysqli_close($conexao);
     header("location: index.php?erro=1");
  }

?>
