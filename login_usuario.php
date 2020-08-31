<?php

   include_once("./bd/conexao.php");

   $email = mysqli_real_escape_string($conexao, $_POST["email"]);
   $senha = mysqli_real_escape_string($conexao, $_POST["senha"]);
      
   $stmt = $conexao->prepare("SELECT * FROM usuario WHERE email = ?");
   $stmt->bind_param("s", $email);
   $stmt->execute();

   $usuario = $stmt->get_result()->fetch_assoc();

   if ($usuario && password_verify($senha, $usuario['senha'])) {

      session_start(); 
      
      $_SESSION["email"] = $email;
      $_SESSION["id_usuario"] = $usuario["id_usuario"];

      mysqli_close($conexao);
      
      header("location: ./sistema/");
      
   } else {
      mysqli_close($conexao);
      header("location: .?erro=1");
   }

?>
