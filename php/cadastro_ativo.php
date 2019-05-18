<?php
session_start();

if($_SESSION['auth'] == 'true'){

    if(isset($_POST['nome']) && isset($_POST['tombo']) && isset($_POST['descricao']) && isset($_POST['status'])){

        include "lib/AtivoDAO.php";

        $nome = $_POST['nome'];
        $descricao = $_POST['tombo'];
        $tombo = $_POST['descricao'];
        $status = $_POST['status'];

        $resultado = AtivoDAO::create($nome, $descricao, $tombo, $status);
        if($resultado == 1){
            echo '<div class="alert alert-success" role="alert">Ativo cadastrado com sucesso!</div>';
        } else {
            echo '<div class="alert alert-danger" role="alert">Erro ao cadastrar Ativo.</div>';
        }


    } else {
        echo '<div class="alert alert-warning" role="alert">Por favor, preencha os campos obrigatórios.</div>';
    }


} else {

    header('Location: ../paginas/index.php');

}
