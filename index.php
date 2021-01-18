
<?php
   
   if (isset($_GET["erro"]) && $_GET["erro"] == "1")
        $mensagem = "<br><span style='color: red;'>Email ou senha 
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
                <a class="navbar-brand js-scroll-trigger" href="#page-top">ApiSoft</a>
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
                <h2 class="page-section-heading text-center text-uppercase text-secondary mb-0">Identifique-se</h2>
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
                        <form action="login_usuario.php" method="post" id="contactForm" name="sentMessage" novalidate="novalidate">
                            <div class="control-group">
                                <div class="form-group floating-label-form-group controls mb-0 pb-2">
                                    <label for="email">Email</label>
                                    <input type="text" id="email" name="email" class="form-control" placeholder="Email" required="required" data-validation-required-message="Por favor informe seu email." />
                                    <p class="help-block text-danger"></p>
                                </div>
                            </div>
                            <div class="control-group">
                                <div class="form-group floating-label-form-group controls mb-0 pb-2">
                                    <label for="senha">Senha</label>
                                    <input type="password" id="senha" name="senha" class="form-control" placeholder="Senha" required="required" data-validation-required-message="Por favor informe sua senha." />
                                    <p class="help-block text-danger"></p>
                                </div>
                            
                            </div>
                            <br />
                            <div id="success"></div>
                            <div class="form-group"  value="Entrar"><button class="btn btn-primary btn-xl" id="sendMessageButton" type="submit">Entrar</button></div>
                            <center>
                            <h3><a href="cadastro_usuario.php">Fazer cadastro</a></h3>
                            </center>

                            <?php echo $mensagem; ?>
                        </form>
                    </div>
                </div>
            </div>
        </section>
                       


<!--<body>
    
    <center>
    <form action="login_usuario.php" method="post">
     
       <legend>Identifique-se</legend>
       
       <label for="email">Email:</label> 
       <input type="text" id="email" name="email">
       
       
       <br>
       
       <label for="senha">Senha:</label>
       <input type="password" id="senha" name="senha">
       
       <?php //echo $mensagem; ?>
       

     <input type="submit" value="Entrar">
        <li><a href="cadastro_usuario.php">Faça cadastro</a></li>

    </form>
    </center>
    
</body>

</html>
