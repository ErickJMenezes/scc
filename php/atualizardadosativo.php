<?php
session_start();
if($_SESSION['auth'] == 'true'){

    if(isset($_POST['nome']) && isset($_POST['tombo']) && isset($_POST['descricao']) && isset($_POST['status'])){

        include_once "lib/AtivoDAO.php";

        $nome = $_POST['nome'];
        $tombo = $_POST['tombo'];
        $descricao = $_POST['descricao'];
        $status = $_POST['status'];

        $ativo = new AtivoDAO(AtivoDAO::getIdPeloTombo($tombo));

        $ativo->nome = $nome;
        $ativo->descricao = $descricao;
        $ativo->status = $status;
        $ativo->tombo = $tombo;

        $resultado = $ativo->commit();

        if($resultado == 1){
            echo '<div class="alert alert-success" role="alert">Alterações feitas com sucesso!</div>';
        } else {
            echo '<div class="alert alert-danger" role="alert">Erro ao alterar informações do ativo '.$nome.'</div>';
        }


    } else {
        echo '<div class="alert alert-warning" role="alert">Por favor, preencha os campos obrigatórios.</div>';
    }


} else {

    header('Location: ../paginas/index.php');

}

?>
