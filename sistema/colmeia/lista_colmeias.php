<!DOCTYPE html>
<html>
<head>
	<title>Lista de colméias</title>
</head>
<body>
<?php 

		include_once "../../bd/conexao.php";

		
		$sql_listar = "select * from colmeia";
		
		$lista = mysqli_query($conexao, $sql_listar);
		
		if ( mysqli_num_rows($lista) > 0 ) {
					
			$tabela = "<table border=1>";
			$tabela = $tabela."<tr><th>Identificador</th><th>Procedencia</th></tr>";
			
			while ($dados = mysqli_fetch_assoc($lista)) {
				
				$vIdColmeia  = $dados["id_colmeia"];
				$vIdentificador = $dados["identificador"];
				$vProcedencia  = $dados["procedencia"];
				
				$tabela = $tabela."<tr><td>$vIdentificador</td><td>$vProcedencia</td>";
				            
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
	       
</body>
</html>