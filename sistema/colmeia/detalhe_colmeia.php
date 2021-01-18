<!DOCTYPE html>
<html>
<head>
	<title>Detalhes</title>
	<style>
	table {
	  border-collapse: collapse;
	  width: 90%;
	  margin-left: auto;
  	  margin-right: auto;
  	  height: 100px;
  	  position: absolute;
	  top: 50%;
	  left: 5%;
	}

	th, td {
	  padding: 8px;
	  text-align: left;
	  border-bottom: 1px solid #ddd;
	}
	th {
		text-align: left;
  		background-color: #EFA33F;
  		color: white;
		}
	tr:hover {background-color:#FFC06C;}

	.btn-cadastrar {
		
		background-color: #4CAF50;
    	border: none;
    	color: black;
    	padding: 10px 30px;
    	text-align: center;
    	text-decoration: none;
	    display: inline-block;
	    font-size: 16px;
	    margin: 4px 2px;
	    cursor: pointer;
	    border-radius: 5px;
	    text-align: center;

	}
	.btn-excluir {
	 
		background-color: #f44336;
    	border: none;
    	color: black;
    	padding: 10px 30px;
    	text-align: center;
    	text-decoration: none;
	    display: inline-block;
	    font-size: 16px;
	    margin: 4px 2px;
	    cursor: pointer;
	    border-radius: 5px;
	    text-align: center;
	}
	.btn-editar {
	 
	 background-color: #008CBA;
    	border: none;
    	color: black;
    	padding: 10px 30px;
    	text-align: center;
    	text-decoration: none;
	    display: inline-block;
	    font-size: 16px;
	    margin: 4px 2px;
	    cursor: pointer;
	    border-radius: 5px;
	     text-align: center;
	}
	
	
	</style>
</head>
<body>

	

	<?php include_once "../../bd/conexao.php";
		include_once "../../utils/validar_sessao.php";?>

<?php 

		$colmeia_id = $_GET['id'];
		$sql_listar = "select * from verificacao where id_colmeia = $colmeia_id";
		$sql_listar2 = "select * from colmeia where id_colmeia = $colmeia_id";


		$lista = mysqli_query($conexao, $sql_listar);
		$lista2 = mysqli_query($conexao, $sql_listar2);

		if (mysqli_num_rows($lista2) > 0 ) {
			while ($dados = mysqli_fetch_assoc($lista2)) {
				
				$vIdIdentificador = $dados["identificador"];
				$texto_titulo = "Colmeia $vIdIdentificador";
		}}
		
		if ( mysqli_num_rows($lista) > 0 ) {
					
			$tabela = "<table>";
			$tabela = $tabela."<tr><th>Data da visita</th><th>Postura</th><th>Lâmina nova</th><th>Castilho</th><th>Melgueira</th><th>Rainha</th><th>Produção</th><th>Anotações</th><th>Excluir</th></tr>";
			
			while ($dados = mysqli_fetch_assoc($lista)) {
				
				$vIdColmeia = $dados["id_colmeia"];
				$vIdVerificacao = $dados["id_verificacao"];
				$vData_visita = $dados["data_visita"];
				$vData_visita = date('d-m-Y', strtotime( $vData_visita ));
				$vPostura  = $dados["postura"];
				$vLamina_nova  = $dados["lamina_nova"];
				$vCastilho  = $dados["castilho"];
				$vMelgueira  = $dados["melgueira"]; 
				$vRainha  = $dados["rainha"];
				$vProducao = $dados["producao"];
				$vAnotacao  = $dados["anotacao"];

				
				$tabela = $tabela."<tr><td>$vData_visita</td><td>$vPostura</td><td>$vLamina_nova</td><td>$vCastilho</td><td>$vMelgueira</td><td>$vRainha</td><td>$vProducao</td><td>$vAnotacao</td><td><a href='excluir_verificacao.php?id=$vIdVerificacao&&id_colmeia=$vIdColmeia'>Excluir</a>
    				</td></tr>";
	            
			}
			
			$tabela = $tabela."</table>";
			
		} else {
			$tabela = "Não há verificações para listar";
		}
?>
	
	   
	   <?php
	      echo $tabela;
	   ?>
	    
<html>
<!DOCTYPE html>
<html lang="pt">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>ApiSoft</title>
      
        <link rel="icon" type="image/x-icon" href="../../bootstrap/assets/img/favicon.ico" />
       
        <script src="https://use.fontawesome.com/releases/v5.15.1/js/all.js" crossorigin="anonymous"></script>
      
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css" />
       
        <link href="../../bootstrap/css/styles.css" rel="stylesheet" />
    </head>

    <body id="page-top">
        <nav class="navbar navbar-expand-lg bg-secondary text-uppercase fixed-top" id="mainNav">
            <div class="container">
                <a class="navbar-brand js-scroll-trigger" href="../../sistema/index.php">ApiSoft</a>
                <button class="navbar-toggler navbar-toggler-right text-uppercase font-weight-bold bg-primary text-white rounded" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    Menu
                    <i class="fas fa-bars"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="lista_colmeia.php">Colmeias</a></li>
                        <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="lista_verificacao.php">Verificações</a></li>
                        <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="./../logout.php">Sair</a></li>
                    </ul>
                </div>
               
            </div>
        </nav>

         <script type="text/javascript">
         	function confirmaExclusao(id_colmeia) {
		      var deletar = confirm("Tem certeza que deseja excluir essa colmeia?");
		      if(deletar) {
		          window.location.href = "excluir_colmeia.php?id="+id_colmeia;
		      }
		  }

         </script>
        <section class="page-section" id="contact">
            <div class="container">
               
                <p>
                <h2 class="page-section-heading text-center text-uppercase text-secondary mb-0"><?php echo $texto_titulo?></h2>
                </p>
                <div class="divider-custom">
                    <div class="divider-custom-line"></div>
                    <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                    <div class="divider-custom-line"></div>
                </div>
				
				<div class="page-section-heading text-center text-uppercase text-secondary mb-0">
                <a href="verificacao_colmeia.php?id=<?php echo $colmeia_id ?>">
				<input type="button" class="btn-cadastrar" value="Cadastrar">
				</a>
				<a href="formulario_colmeia.php?id=<?php echo $colmeia_id ?>">
				<input type="button" class="btn-editar" value="Editar">
				</a>
				
				<input type="button" class="btn-excluir" value="Excluir" onclick="confirmaExclusao(<?php echo $colmeia_id; ?>)">
				
				</div>




                        </form>
                    </div>
                </div>
            </div>
        </section>

	       
</body>
</html>