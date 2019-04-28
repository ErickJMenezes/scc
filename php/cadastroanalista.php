<?php

session_start();

if($_SESSION['auth'] == 'true'){
    
    if(isset($_POST['nome']) && isset($_POST['login']) && isset($_POST['senha']) && isset($_POST['status']) && isset($_POST['email']) && isset($_POST['cargo'])){
        
        include "lib/UsuarioDAO.php";

        $nome = $_POST['nome'];
        $login = $_POST['login'];
        $senha = $_POST['senha'];
        $email = $_POST['email'];
        $cargo = $_POST['cargo'];
        $status = $_POST['status'];

        $resultado = UsuarioDAO::create($nome, $login, $senha, $email, $status, $cargo); 
        if($resultado == 1){
            echo '<div class="alert alert-success" role="alert">Usuário cadastrado com sucesso!</div>';
        } else {
            echo '<div class="alert alert-danger" role="alert">Erro ao cadastrar usuário.</div>';
        }
        
        
    } else {
        echo '<div class="alert alert-warning" role="alert">Por favor, preencha os campos obrigatórios.</div>';
    }
    
    
} else {
    
    header('Location: ../paginas/index.php');
    
}