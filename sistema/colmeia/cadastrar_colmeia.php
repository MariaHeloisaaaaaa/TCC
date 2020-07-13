<?php
    session_start();
    include_once "../../bd/conexao.php";

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
            $stmt = $conexao->prepare("insert into colmeia (identificador,procedencia) values(?, ?)");
            $stmt->bind_param("ss", $identificador, $procedencia);
            
        if ($stmt->execute()) {
                echo "Colméia cadastrada com sucesso!";
                header("location: .");
        } else {
            echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
            header("location:.?erro=1");
        }
        mysqli_close($conexao);
            
    }}

?>



<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de colméia</title>
</head>
<body>
    <h1>Cadastro de Colméia</h1>
    <form action="" method="POST">
        <label for="identificador">Identificador:</label>
        <input type="text" name="identificador" id="identificador" value="<?php echo $identificador?>" required/>
        <br>

        <label for="procedencia">Procedencia:</label>
        <input type="text" name="procedencia" id="procedencia" value="<?php echo $procedencia?>" required>
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