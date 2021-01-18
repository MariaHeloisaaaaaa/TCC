<?php
	 include_once "../../bd/conexao.php";
    include_once "../../utils/validar_sessao.php";


    if(isset($_GET['id'])) {
        $stmt = $conexao->prepare("delete from colmeia WHERE id_colmeia = ? AND id_usuario = ?");
        
        //if (!$stmt) {
        //        $error = $conexao->errno.' '.$conexao->error;
        //        echo $error;
        //   }

        $stmt->bind_param("ii", $_GET['id'], $_SESSION["id_usuario"]);
        $stmt->execute();
        if($stmt->num_rows() == 0) {
            header("location: lista_colmeia.php");
        } else {
        session_destroy();
        header("location: lista_colmeia.php");
        }
    }
?>