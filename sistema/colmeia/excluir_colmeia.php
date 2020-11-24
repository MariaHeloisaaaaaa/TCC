<?php
	 include_once "../../bd/conexao.php";
    include_once "../../utils/validar_sessao.php";
    if(isset($_GET['id']))  {}

    	elseif(isset($_GET['id'])) {
        $stmt = $conexao->prepare("DELETE * FROM colmeia WHERE id_colmeia = ? AND id_usuario = ?");
        $stmt->bind_param("ii", $_GET['id'], $_SESSION["id_usuario"]);
        $stmt->execute();
        if($stmt->rowCount() ==1) {
        } else {
        session_destroy();
        header("location:../../index.php");



        }
?>