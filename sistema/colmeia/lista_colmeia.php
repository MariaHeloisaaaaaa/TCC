<!DOCTYPE html>
<html>
<head>
	<title>Lista de colméias</title>
</head>
<body>
<?php 

		include_once "../../bd/conexao.php";
		include_once "../../utils/validar_sessao.php";

		$usuario = $_SESSION['id_usuario'];
		$sql_listar = "select * from colmeia WHERE id_usuario = $usuario";
		
		$lista = mysqli_query($conexao, $sql_listar);
		
		if ( mysqli_num_rows($lista) > 0 ) {
					
			$tabela = "<table border=1>";
			$tabela = $tabela."<tr><th>Identificador</th><th>Procedencia</th></tr>";
			
			while ($dados = mysqli_fetch_assoc($lista)) {
				
				$vIdColmeia  = $dados["id_colmeia"];
				$vIdentificador = $dados["identificador"];
				$vProcedencia  = $dados["procedencia"];
				
				$tabela = $tabela."<tr><td><a href='detalhe_colmeia.php?id=$vIdColmeia'>$vIdentificador</a></td><td>$vProcedencia</td>";
				            
			}
			
			$tabela = $tabela."</table>";
			
		} else {
			$tabela = "Não há colméias para listar";
		}
?>

	   <legend>Colmeias Cadastradas:</legend>
	   
	   <?php
	      echo $tabela;
	   ?>

	     <li><a href="./formulario_colmeia.php?id=$vIdColmeia">Editar</a></li>
	     <li><a href="./formulario_colmeia.php?id=$vIdColmeia">Excluir</a></li>


	       
</body>
</html>