<?php
    session_start();
    include "../bd/conexao.php";

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



<!DOCTYPE html>
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