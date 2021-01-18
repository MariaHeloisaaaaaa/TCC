<!DOCTYPE html>
<html>
<head>
	<title>Lista de colméias</title>
	<style>
	table {
	  border-collapse: collapse;
	  width: 50%;
	  margin-left: auto;
  	  margin-right: auto;
  	  height: 90px;
  	  position: absolute;
	  top: 51%;
	  left: 25%;
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
	</style>
</head>
<body>
<?php 

		include_once "../../bd/conexao.php";
		include_once "../../utils/validar_sessao.php";

		$usuario = $_SESSION['id_usuario'];
		$sql_listar = "select * from colmeia WHERE id_usuario = $usuario";
		
		$lista = mysqli_query($conexao, $sql_listar);
		
		if ( mysqli_num_rows($lista) > 0 ) {
					
			$tabela = "<table>";
			$tabela = $tabela."<tr><th>Identificador</th><th>Procedência</th></tr>";
			
			while ($dados = mysqli_fetch_assoc($lista)) {
				
				$vIdColmeia  = $dados["id_colmeia"];
				$vIdentificador = $dados["identificador"];
				$vProcedencia  = $dados["procedencia"];
				
				$tabela = $tabela."<p><tr><td><center><a href='detalhe_colmeia.php?id=$vIdColmeia'>$vIdentificador</a></center></td><td>$vProcedencia</td></tr>";
				            
			}
			
			$tabela = $tabela."</table>";
			
		} else {
			$tabela = "Não há colméias para listar";
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

         
        <section class="page-section" id="contact">
            <div class="container">
               
                <p>
                <h2 class="page-section-heading text-center text-uppercase text-secondary mb-0">Colmeias cadastradas</h2>
                </p>
                <div class="divider-custom">
                    <div class="divider-custom-line"></div>
                    <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                    <div class="divider-custom-line"></div>
                </div>
                <div class="page-section-heading text-center text-uppercase text-secondary mb-0">
                <a href="formulario_colmeia.php">
				<input type="button" class="btn-cadastrar" value="Cadastrar">
				</a>
                </div>
               		

                        </form>
                    </div>
                </div>
            </div>
        </section>

	       
</body>
</html>