<?php
    session_start();
    include "./bd/conexao.php";

    $nome = NULL; 
    $email = NULL;
    $telefone = NULL;
    $cidade = NULL;
    $estado = NULL;

    $mensagens = [];

     if(isset($_POST['cadastrar'])){
        $nome = isset($_POST['nome']) ? $_POST['nome'] : NULL;
        $email = isset($_POST['email']) ? $_POST['email'] : NULL;
        $senha_1 = isset($_POST['senha_1']) ? $_POST['senha_1'] : NULL;
        $senha_2 = isset($_POST['senha_2']) ? $_POST['senha_2'] : NULL;
        $telefone = isset($_POST['telefone']) ? $_POST['telefone'] : NULL;
        $cidade = isset($_POST['cidade']) ? $_POST['cidade'] : NULL;
        $estado = isset($_POST['estado']) ? $_POST['estado'] : NULL;

       
     if(!$nome || !(strlen($nome) > 2) || (strlen($nome) > 255)){
            array_push($mensagens, "Por favor preencha Nome entre 2 e 255 caracteres");
        }
        
        if(!$email || !(strlen($email) > 6) || (strlen($email) > 255)){
            array_push($mensagens, "Por favor preencha Email entre 6 e 255 caracteres");
        }

        
        if(!$senha_1){
            array_push($mensagens, "Por favor preencha Senha");
    
        }
        
        if(!$senha_2){
            array_push($mensagens, "Por favor preencha Confirmar Senha");
        }

        if($senha_1 != $senha_2){
            array_push($mensagens, "A Senha e a sua confirmação devem ser iguais");
        } else {
            if((strlen($senha_1) < 8)){
                array_push($mensagens, "A Senha deve ter no minimo 8 caracteres");
            }
        }
        
        if(!$telefone){
            array_push($mensagens, "Por favor preencha Telefone");
        }
        
         if(!$cidade){
            array_push($mensagens, "Por favor selecione uma Cidade");
        }

        if(!$estado){
            array_push($mensagens, "Por favor selecione um Estado");
        }
        

        if(count($mensagens) === 0) {
            $senha_hashed = password_hash($senha_1, PASSWORD_DEFAULT);
            $stmt = $conexao->prepare("insert into usuario (nome,senha,cidade,estado,telefone,email) values(?, ?, ?, ?, ?,?)");
            $stmt->bind_param("ssssss", $nome, $senha_hashed, $cidade, $estado, $telefone, $email);
            
        if ($stmt->execute()) {
                echo "Cadastro realizado com sucesso!";
                header("location: .");
        } else {
            echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
            header("location: .?erro=1");
        }
        mysqli_close($conexao);
            
    }}

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
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="bootstrap/assets/img/favicon.ico" />
        <!-- Font Awesome icons (free version)-->
        <script src="https://use.fontawesome.com/releases/v5.15.1/js/all.js" crossorigin="anonymous"></script>
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="bootstrap/css/styles.css" rel="stylesheet" />
    </head>

    <body id="page-top">
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg bg-secondary text-uppercase fixed-top" id="mainNav">
            <div class="container">
                <a class="navbar-brand js-scroll-trigger" href="index.php">ApiSoft</a>
                <button class="navbar-toggler navbar-toggler-right text-uppercase font-weight-bold bg-primary text-white rounded" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    Menu
                    <i class="fas fa-bars"></i>
                </button>
               
            </div>
        </nav>
         <!-- Contact Section-->
        <section class="page-section" id="contact">
            <div class="container">
                <!-- Contact Section Heading-->
                <p>
                <h2 class="page-section-heading text-center text-uppercase text-secondary mb-0">Cadastre-se</h2>
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
                                    <label for="nome">Nome</label>
                                    <input 
                                        value="<?php echo $nome?>" 
                                        type = "text"
                                        minlength="3" 
                                        required type="text" 
                                        placeholder="Nome"
                                        id="nome" 
                                        name="nome" 
                                        class="form-control" 
                                        required="required" 
                                        data-validation-required-message="Por favor informe seu nome."/>
                                    <p class="help-block text-danger"></p>
                                </div>
                                <div class="control-group">
                                <div class="form-group floating-label-form-group controls mb-0 pb-2">
                                    <label for="email">Email</label>
                                    <input type="text" id="email" name="email" class="form-control" placeholder="Email" required="required" data-validation-required-message="Por favor informe seu email." />
                                    <p class="help-block text-danger"></p>
                                </div>
                                <div class="control-group">
                                <div class="form-group floating-label-form-group controls mb-0 pb-2">
                                    <label for="telefone">Telefone</label>
                                    <input value="<?php echo $telefone?>" type="text" id="telefone" name="telefone" class="form-control" placeholder="Telefone" required="required" data-validation-required-message="Por favor informe seu telefone." />
                                    <p class="help-block text-danger"></p>
                                </div>
                                <div class="control-group">
                                <div class="form-group floating-label-form-group controls mb-0 pb-2">
                                    <label for="cidade">Cidade</label>
                                    <input value="<?php echo $cidade?>"  type="text" id="cidade" name="cidade" class="form-control" placeholder="Cidade" required="required" data-validation-required-message="Por favor informe seu email." />
                                    <p class="help-block text-danger"></p>
                                </div>
                                <div class="control-group">
                                <div class="form-group floating-label-form-group controls mb-0 pb-2">
                                    <label for="estado">Estado</label>
                                    <input type="text" id="estado" name="estado" class="form-control" placeholder="Estado" required="required" data-validation-required-message="Por favor informe seu estado." />
                                    <p class="help-block text-danger"></p>
                                </div>
                                <div class="control-group">
                                <div class="form-group floating-label-form-group controls mb-0 pb-2">
                                    <label for="senha">Senha</label>
                                    <input type="password" id="senha" name="senha" class="form-control" placeholder="Senha" required="required" data-validation-required-message="Por favor informe sua senha." />
                                    <p class="help-block text-danger"></p>
                                </div>
                            </div>
                            <div class="control-group">
                                <div class="form-group floating-label-form-group controls mb-0 pb-2">
                                    <label for="senha_2">Confirmar senha</label>
                                    <input type="password" id="senha_2" name="senha_2" class="form-control" placeholder="Confirmar senha" required="required" data-validation-required-message="Por favor informe sua senha." />
                                    <p class="help-block text-danger"></p>
                                </div>
                            
                            </div>
                            <br />
                            <div id="success"></div>
                            <div class="form-group" value="Cadastrar"><button class="btn btn-primary btn-xl" id="sendMessageButton" type="submit">Cadastrar</button></div>
                            
                        </form>
                    </div>
                </div>
            </div>
        </section>

<!--<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
</head>
<body>
    <h1>Cadastro de Usuário</h1>
    <form action="" method="POST">
        <label for="nome">Nome:</label>
        <input 
            type="text"
            name="nome"
            id="nome"
            value="<?php echo $nome?>"
            minlength="3"
            required
        />
        <br>

        <label for="email">Email:</label>
        <input type="email" name="email" id="email" value="<?php echo $email?>" required>
        <br>

        <label for="senha_1">Senha:</label>
        <input type="password" name="senha_1" id="senha_1" required>
        <br>

        <label for="senha_2">Confirmar Senha:</label>
        <input type="password" name="senha_2" id="senha_2" required>
        <br>

        <label for="telefone">Telefone:</label>
        <input name="telefone" id="telefone" value="<?php echo $telefone?>" required>
        <br>

        <label for="cidade">Cidade:</label>
        <input type="text" name="cidade" id="cidade" value="<?php echo $cidade?>" required>
        <br>

        <label for="estado">Estado:</label>
        <input type="text" name="estado" id="estado" value="<?php echo $estado?>" required>
        <br>
        
        <input type="submit" name="cadastrar" value="Cadastrar">
    </form>

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