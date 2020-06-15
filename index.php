<?php
   
   if (isset($_GET["erro"]) && $_GET["erro"] == "1")
        $mensagem = "<br><span style='color: red;'>Usuário ou senha 
                       incorretos tente novamente</span>";
   else {
	  
	  if (isset($_GET["erro"]) && $_GET["erro"] == "2")
	    $mensagem = "<br><span style='color: green;'>Sua sessão 
	       expirou ou você está tentando acessar uma página
	       sem autorização! </span>";
	  else 
	     $mensagem = "";
   }
?>

<html>

<head>
	
	<meta charset="utf-8" />
</head>

<body>
	
	<center>
	<form action="login_usuario.php" method="post">
	 
	   <legend>Identifique-se</legend>
	   
	   <label for="email">Email:</label> 
	   <input type="text" id="email" name="email">
	   
	   
	   <br>
	   
	   <label for="senha">Senha:</label>
	   <input type="password" id="senha" name="senha">
	   
	   <?php echo $mensagem; ?>
	   
	 

	 <input type="submit" value="Entrar">
		<li><a href="cadastro_formulario.php">Faça cadastro</a></li>

	</form>
	</center>
	
</body>

</html>
