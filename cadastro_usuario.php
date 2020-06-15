<?php
    session_start();
    include "conexao.php";

    $nome = $_POST['nome'];
    $senha = $_POST['senha'];
    $cidade = $_POST['cidade'];
    $estado = $_POST['estado']; 
    $telefone = $_POST['telefone'];
    $email = $_POST['email'];


    $sql = "insert into usuario(nome,senha,cidade,estado,telefone,email) values('$nome','$senha','$cidade','$estado', '$telefone', '$email' '0')";

    $query = mysqli_query($cadastro,$sql);
    
    if($query){
        echo "Cadastro realizado com sucesso!";
        header("location: login_formulario.php");
    }else{
        echo "Não foi possivel cadastrar-se no banco, tente novamente ". PHP_EOL;

        echo "Debugging erro:". mysqli_connect_error().PHP_EOL;
        exit;
    }
    
    mysqli_close($cadastro);

?>