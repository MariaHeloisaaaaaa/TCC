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

     if(isset($_POST['cadastrar'])){
        $data_visita = isset($_POST['data_visita']) ? $_POST['data_visita'] : NULL;
        $producao = isset($_POST['producao']) ? $_POST['producao'] : NULL;
        $postura = isset($_POST['postura']) ? $_POST['postura'] : NULL;
        $lamina_nova = isset($_POST['lamina_nova']) ? $_POST['lamina_nova'] : NULL;
        $castilho = isset($_POST['castilho']) ? $_POST['castilho'] : NULL;
        $melgueira = isset($_POST['melgueira']) ? $_POST['melgueira'] : NULL;
        $rainha = isset($_POST['rainha']) ? $_POST['rainha'] : NULL;
        $anotacao = isset($_POST['anotacao']) ? $_POST['anotacao'] : NULL;

       
            $stmt = $conexao->prepare("insert into verificacao (data_visita, producao, postura, lamina_nova, castilho, melgueira, rainha, anotacao) values(?, ?, ?, ?, ?,?, ?, ?)");
            $stmt->bind_param("sssssiss", $data_visita, $producao, $postura, $lamina_nova, $castilho, $melgueira, $rainha, $anotacao);
            
        if ($stmt->execute()) {
                echo "Cadastro de verificação realizado com sucesso!";
                header("location: .");
        } else {
            echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
            header("location: .?erro=1");
        }
        mysqli_close($conexao);
            
  }

?>



<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Verificação</title>
</head>
<body>
    <h1>Cadastro de Verificação</h1>
    <form action="" method="POST">
        <label for="nome">Data da verificação:</label>
        <input type="date" name="data_visita" id="data_visita" value="<?php echo $data_visita?>" required/>
        <br>

        <label for="email">Prudução:</label>
        <input type="text" name="producao" id="producao" value="<?php echo $producao?>">
        <br>

        <label for="senha_1">Postura:</label>
        <input type="text" name="postura" id="postura" value="<?php echo $postura?>" required>
        <br>

        <label for="senha_2">Laminas novas:</label>
        <input type="text" name="lamina_nova" id="lamina_nova" value="<?php echo $lamina_nova?>" required>
        <br>

        <label for="telefone">Castilhos:</label>
        <input  type="text" name="castilho" id="castilho" value="<?php echo $castilho?>" required>
        <br>

        <label for="cidade">Melgueiras:</label>
        <input type="text" name="melgueira" id="melgueira" value="<?php echo $melgueira?>">
        <br>

        <label for="rainha">Rainha:</label>
        <select name="rainha" id="rainha" required>
            <option value="">---------</option>
            <option value="nova" <?php if($rainha == "nova"){ echo "selected";} ?> >Nova</option>
            <option value="velha" <?php if($rainha == "velha"){ echo "selected";} ?> >Velha</option>
            <option value="sem" <?php if($rainha == "sem"){ echo "selected";} ?> >Sem rainha</option>
        </select>
        <br>

        <label for="anotacao">Anotações adicionais:</label><br>
        <textarea type="text" name="anotacao" id="anotacao" rows="10" cols="40" maxlength="500" value="<?php echo $anotacao?>"></textarea>

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