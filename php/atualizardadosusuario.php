<?php
session_start();

if($_SESSION['auth'] == 'true'){

    if(isset($_POST['nome'])  && isset($_POST['lold']) && isset($_POST['login']) && isset($_POST['senha']) && isset($_POST['status']) && isset($_POST['email']) && isset($_POST['cargo'])){

        include_once "lib/UsuarioDAO.php";

        $nome = $_POST['nome'];
        $login = $_POST['login'];
        $senha = $_POST['senha'];
        $email = $_POST['email'];
        $cargo = $_POST['cargo'];
        $status = $_POST['status'];


        $usuario = new UsuarioDAO(UsuarioDAO::getIdByLogin($_POST['lold']));

        $usuario->nome = $nome;
        if($senha == ''){

        } else {
            $usuario->senha = $senha;
        }
        $usuario->email = $email;
        $usuario->status = $status;
        $usuario->cargo = $cargo;
        $usuario->login = $login;


        $resultado = $usuario->commit();

        if($resultado == 1){
            echo '<div class="alert alert-success" role="alert">Alterações feitas com sucesso!</div>';
        } else {
            echo '<div class="alert alert-danger" role="alert">Erro ao alterar informações do usuário '.$nome.'</div>';
        }


    } else {
        echo '<div class="alert alert-warning" role="alert">Por favor, preencha os campos obrigatórios.</div>';
    }


} else {

    header('Location: ../paginas/index.php');

}

?>