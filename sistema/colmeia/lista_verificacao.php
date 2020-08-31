<!DOCTYPE html>
<html>
<head>
	<title>Lista de colméias</title>
</head>
<body>
<?php 

		include_once "../../bd/conexao.php";

		
		$sql_listar = "select * from verificacao ORDER BY data_visita ASC|DESC";
		
		$lista = mysqli_query($conexao, $sql_listar);
		
		if ( mysqli_num_rows($lista) > 0 ) {
					
			$tabela = "<table border=1>";
			$tabela = $tabela."<tr><th>Colméia</th><th>Data da visita</th><th>Postura</th><th>Lâmina nova</th><th>Castilho</th><th>Melgueira</th><th>Rainha</th><th>Produção</th><th>Anotações</th></tr>";;
			
			while ($dados = mysqli_fetch_assoc($lista)) {
				
				$vIdColmeia = $dados["id_colmeia"];
				$vData_visita = $dados["data_visita"];
				$vPostura  = $dados["postura"];
				$vLamina_nova  = $dados["lamina_nova"];
				$vCastilho  = $dados["castilho"];
				$vMelgueira  = $dados["melgueira"];
				$vRainha  = $dados["rainha"];
				$vProducao = $dados["producao"];
				$vAnotacao  = $dados["anotacao"];
				
				$tabela = $tabela."<tr><td>$vIdColmeia</td><td>$vData_visita</td><td>$vPostura</td><td>$vLamina_nova</td><td>$vCastilho</td><td>$vMelgueira</td><td>$vRainha</td><td>$vProducao</td><td>$vAnotacao</td>";
				            
			}
			
			$tabela = $tabela."</table>";
			
		} else {
			$tabela = "Não há verificações para listar";
		}
?>

	   <legend>Colmeias Cadastradas:</legend>
	   
	   <?php
	      echo $tabela;
	   ?>
	       
</body>
</html>
