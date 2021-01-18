<?php
    
    include_once "../../bd/conexao.php";
    include_once "../../utils/validar_sessao.php";

    $texto_botao = 'Cadastrar';
    $texto_titulo = 'Cadastrar Colmeia';


    $identificador = NULL; 
    $procedencia = NULL;
    
    $mensagens = [];

    if(isset($_POST['cadastrar'])){
        $identificador = isset($_POST['identificador']) ? $_POST['identificador'] : NULL;
        $procedencia = isset($_POST['procedencia']) ? $_POST['procedencia'] : NULL;

       
        if(!$identificador || !(strlen($identificador) > 0) || (strlen($identificador) > 255)){
            array_push($mensagens, "Por favor preencha o Identificador");
        }
        
        if(!$procedencia || !(strlen($procedencia) > 4) || (strlen($procedencia) > 255)){
            array_push($mensagens, "Por favor preencha Procedencia");
        }

        

        if(count($mensagens) === 0) {

            $stmt = NULL;
            if(isset($_GET['id'])){
                //fazer aqui o UPDATE
                $stmt = $conexao->prepare("UPDATE colmeia SET identificador = ?, procedencia = ? WHERE id_colmeia = ? AND id_usuario = ?");
                $stmt->bind_param("ssii", $identificador, $procedencia, $_GET['id'], $_SESSION["id_usuario"]);
                echo "entrou";
            } else {
                $stmt = $conexao->prepare("insert into colmeia (identificador,procedencia,id_usuario) values(?, ?, ?)");
                $stmt->bind_param("ssi", $identificador, $procedencia, $_SESSION["id_usuario"]);
            }
            if ($stmt->execute()) {
                echo "Colméia cadastrada com sucesso!";
                header("location: ./lista_colmeia.php");
            } else {
                echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
                header("location:.?erro=1");
            }
            mysqli_close($conexao);
            
        }
    } elseif(isset($_GET['id'])) {
        // Pega os dadso da colméia
        $stmt = $conexao->prepare("SELECT * FROM colmeia WHERE id_colmeia = ? AND id_usuario = ?");
        $stmt->bind_param("ii", $_GET['id'], $_SESSION["id_usuario"]);
        $stmt->execute();
        $colmeia = $stmt->get_result()->fetch_assoc();
        // Se a colméia existir
        if($colmeia) {
            $identificador = $colmeia['identificador']; 
            $procedencia = $colmeia['procedencia'];
            $texto_botao = 'Atualizar';
            $texto_titulo = "Atualizar colmeia";
        } else {
            // Destroi a sessão
            // redireciona para o login
        session_destroy();
        header("location:../../index.php");



        }
    }

?>
    <br>
     <?php 
        if(count($mensagens) > 0){
            echo "<b>ERROS!</b> <br>";
            foreach($mensagens as $mensagem){
                echo $mensagem;
                echo "<br>";
            }
        }
    ?>

</body>
</html>
<html>
<!DOCTYPE html>
<html lang="pt">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>ApiSoft</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="../../bootstrap/assets/img/favicon.ico" />
        <!-- Font Awesome icons (free version)-->
        <script src="https://use.fontawesome.com/releases/v5.15.1/js/all.js" crossorigin="anonymous"></script>
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="../../bootstrap/css/styles.css" rel="stylesheet" />
    </head>

    <body id="page-top">
        <!-- Navigation-->
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
         <!-- Contact Section-->
        <section class="page-section" id="contact">
            <div class="container">
                <!-- Contact Section Heading-->
                <p>
                <h2 class="page-section-heading text-center text-uppercase text-secondary mb-0"><?php echo $texto_titulo?></h2>
                </p>
                <!-- Icon Divider-->
                <div class="divider-custom">
                    <div class="divider-custom-line"></div>
                    <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                    <div class="divider-custom-line"></div>
                </div>
                <!-- Contact Section Form-->
                <div class="row">
                    <div class="col-lg-8 mx-auto">
                        <!-- To configure the contact form email address, go to mail/contact_me.php and update the email address in the PHP file on line 19.-->
                        <form action="" method="post" id="contactForm" name="sentMessage" novalidate="novalidate">
                            <div class="control-group">
                                <div class="form-group floating-label-form-group controls mb-0 pb-2">
                                    <label for="identificador">Identificador</label>
                                    <input value="<?php echo $identificador?>" type = "text" minlength="3" required type="text" placeholder="Identificador" id="identificador" name="identificador" class="form-control" required="required" data-validation-required-message="Por favor informe seu nome."/>
                                    <p class="help-block text-danger"></p>
                                </div>
                                <div class="control-group">
                                <div class="form-group floating-label-form-group controls mb-0 pb-2">
                                    <label for="procedencia">Procedencia</label>
                                    <input type="text" id="procedencia" name="procedencia" class="form-control" placeholder="Procedência" required="required" data-validation-required-message="Por favor informe a procedência da sua colmeia." />
                                    <p class="help-block text-danger"></p>
                                </div>
                            
                            </div>
                            <br />
                            <div id="success"></div>
                            <div class="form-group" value="<?php echo $texto_botao?>" type="submit"><button class="btn btn-primary btn-xl" id="sendMessageButton" input type="submit" name="cadastrar" button><?php echo $texto_botao?></div>
                            
                        </form>
                    </div>
                </div>
            </div>
        </section>