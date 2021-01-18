<?php
	 include_once "../../bd/conexao.php";
    include_once "../../utils/validar_sessao.php";


    if(isset($_GET['id'])) {
        $stmt = $conexao->prepare("delete from verificacao WHERE id_verificacao = ?");

        $stmt->bind_param("i", $_GET['id']);
        $stmt->execute();
        $id_colmeia = $_GET["id_colmeia"];
        
        if($stmt->num_rows() == 0) {
            header("location: detalhe_colmeia.php?id=$id_colmeia");
        } else {
        session_destroy();
        header("location: detalhe_colmeia.php?id=$id_colmeia");
        }
    }
?>