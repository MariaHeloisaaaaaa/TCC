<?php
    session_start();
    include_once "../../bd/conexao.php";

    $data_visita = NULL; 
    $producao = NULL;
    $postura = NULL;
    $lamina_nova = NULL;
    $castilho = NULL;
    $melgueira = NULL;
    $rainha = NULL;
    $anotacao = NULL;


    $mensagens = [];
            var_dump($_POST);


     if(isset($_POST['cadastrar'])){
        $data_visita = isset($_POST['data_visita']) ? $_POST['data_visita'] : NULL;
        $producao = isset($_POST['producao']) ? $_POST['producao'] : NULL;
        $postura = isset($_POST['postura']) ? $_POST['postura'] : NULL;
        $lamina_nova = isset($_POST['lamina_nova']) ? $_POST['lamina_nova'] : NULL;
        $castilho = isset($_POST['castilho']) ? $_POST['castilho'] : NULL;
        $melgueira = isset($_POST['melgueira']) ? $_POST['melgueira'] : NULL;
        $rainha = isset($_POST['rainha']) ? $_POST['rainha'] : NULL;
        $anotacao = isset($_POST['anotacao']) ? $_POST['anotacao'] : NULL;
        $id_colmeia = isset($_POST['id_colmeia']) ? $_POST['id_colmeia'] : NULL;
        echo "$data_visita";
       
            $stmt = $conexao->prepare("insert into verificacao (data_visita, producao, postura, lamina_nova, castilho, melgueira, rainha, anotacao, id_colmeia) values(?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("sssssissi", $data_visita, $producao, $postura, $lamina_nova, $castilho, $melgueira, $rainha, $anotacao, $id_colmeia);
        
        if ($stmt->execute()) {
                echo "Cadastro de verificação realizado com sucesso!";
                header("location: lista_verificacao.php");
        } else {
            echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
            //header("location: .?erro=1");
        }
        mysqli_close($conexao);
            
  }

?>


<!DOCTYPE html>
<html lang="pt-br">
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
                <h2 class="page-section-heading text-center text-uppercase text-secondary mb-0">Cadastrar verificação</h2>
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
                        <form id="contactForm" action="" method="POST">
                            <label for="id_colmeia">Colmeia </label>
                                        <select name="id_colmeia"> 
                                        <?php 
                                            $id_colmeia_selecionada = "0";
                                            if(isset($_GET['id'])){
                                                $id_colmeia_selecionada = $_GET['id']; 
                                        }

                                            $usuario = $_SESSION['id_usuario'];
                                            $colmeias = "select * from colmeia WHERE id_usuario = $usuario;";
                                            $colmeias = mysqli_query($conexao, $colmeias);
                                            while ($colmeia = mysqli_fetch_assoc($colmeias)) {
                                                $id_colmeia = $colmeia['id_colmeia'];
                                                $label_colmeia = $colmeia['identificador'] . " - " . $colmeia['procedencia'];
                                            if ($id_colmeia == $id_colmeia_selecionada) {
                                                echo "<option value = '$id_colmeia' selected='selected'>$label_colmeia</option>";
                                            }else{
                                                echo "<option value = '$id_colmeia'>$label_colmeia</option>";
                                            }               

                                            }

                                         ?>
                                        </select>
                            <div class="control-group">
                                <div class="form-group floating-label-form-group controls mb-0 pb-2">
                                     
                                </div>
                            </div>
                            <div class="control-group">
                                <div class="form-group floating-label-form-group controls mb-0 pb-2">
                                    <label>Data da verificação</label>
                                    <input class="form-control" name="data_visita" type="date" placeholder="Data da Verificação" required="required" data-validation-required-message="Por favor informe a data da verificação." />
                                    <p class="help-block text-danger"></p>
                                </div>
                            </div>
                            <div class="control-group">
                                <div class="form-group floating-label-form-group controls mb-0 pb-2">
                                    <label>Produção</label>
                                    <input class="form-control" name="producao" type="text" placeholder="Produção" required="required" data-validation-required-message="Por favor informe a produção"/>
                                    <p class="help-block text-danger"></p>
                                </div>
                            <div class="control-group">
                                <div class="form-group floating-label-form-group controls mb-0 pb-2">
                                    <label>Postura</label>
                                    <input class="form-control" name="postura" type="text" placeholder="Postura" required="required" data-validation-required-message="Por favor informe o estado da postura"/>
                                    <p class="help-block text-danger"></p>
                                </div>
                            <div class="control-group">
                                <div class="form-group floating-label-form-group controls mb-0 pb-2">
                                    <label>Laminas novas</label>
                                    <input class="form-control" name="lamina_nova" type="text" placeholder="Lâminas novas" required="required" data-validation-required-message="Por favor preencha o campo Lâminas novas"/>
                                    <p class="help-block text-danger"></p>
                                </div>
                            <div class="control-group">
                                <div class="form-group floating-label-form-group controls mb-0 pb-2">
                                    <label>Caixilhos</label>
                                    <input class="form-control" name="castilho" type="text" placeholder="Caixilhos" required="required" data-validation-required-message="Por favor preencha o campo Caixilhos"/>
                                    <p class="help-block text-danger"></p>
                                </div>
                            <div class="control-group">
                                <div class="form-group floating-label-form-group controls mb-0 pb-2">
                                    <label>Melgueiras</label>
                                    <input class="form-control" name="melgueira" type="text" placeholder="Melgueiras" required="required" data-validation-required-message="Por favor preencha o campo Melgueiras"/>
                                    <p class="help-block text-danger"></p>
                                </div>
                            <div class="control-group">
                                <div class="form-group floating-label-form-group controls mb-0 pb-2">
                                    <label>Rainha</label>
                                    <input class="form-control" name="rainha" type="text" placeholder="Rainha" required="required" data-validation-required-message="Por favor preencha o campo Rainha"/>
                                    <p class="help-block text-danger"></p>
                                </div>
                            </div>
                            <div class="control-group">
                                <div class="form-group floating-label-form-group controls mb-0 pb-2">
                                    <label>Anotações adicionais</label>
                                    <textarea class="form-control" name="anotacao" rows="5" placeholder="Anotações adicionais" required="required" data-validation-required-message="Please enter a message."></textarea>
                                    <p class="help-block text-danger"></p>
                                </div>
                            </div>
                            <br />
                            <div id="success"></div>
                            <div class="form-group"><button class="btn btn-primary btn-xl" id="sendMessageButton"type="submit" name="cadastrar" value="Cadastrar">Cadastrar</button></div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
       
    </body>
</html>