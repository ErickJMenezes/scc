<?php
session_start();

if($_SESSION['auth'] == 'true'){

    if(isset($_POST['descricao']) && isset($_POST['usuario_id']) && isset($_POST['chamado_id'])){

        include_once "lib/AcompanhamentoDAO.php";

        $descricao = $_POST['descricao'];
        $uid = $_POST['usuario_id'];
        $cid = $_POST['chamado_id'];

        $resultado = AcompanhamentoDAO::create($descricao, $cid, $uid);
        if($resultado == 1){
            header('Location: ../paginas/analista/acompanhamento.php?id='.$_POST['chamado_id']);
        } else {
            header('Location: ../paginas/analista/acompanhamento.php?id='.$_POST['chamado_id']);
        }


    } else {
        echo '<div class="alert alert-warning" role="alert">Por favor, preencha os campos obrigatórios.</div>';
    }


} else {

    header('Location: ../paginas/index.php');

}
