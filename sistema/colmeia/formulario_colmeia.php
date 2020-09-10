<?php
    session_start();
    include_once "../../bd/conexao.php";
    include_once "../../utils/validar_sessao.php";


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
            var_dump($stmt);
            if ($stmt->execute()) {
                echo "Colméia cadastrada com sucesso!";
                header("location: .");
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
            // Bota nas variaveis para aparecer nos campos
            $identificador = $colmeia['identificador']; 
            $procedencia = $colmeia['procedencia'];
        } else {
            // Destroi a sessão
            // redireciona para o login
            header("location:../../index.php");

        }
    }

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