<?php

session_start();

if($_SESSION['auth'] == 'true'){
    
    if(isset($_GET['nome']) && isset($_GET['login']) && isset($_GET['senha']) && isset($_GET['status']) && isset($_GET['email']) && isset($_GET['cargo'])){
        
        include "UsuarioDAO.php";

        $nome = $_GET['nome'];
        $login = $_GET['login'];
        $senha = $_GET['senha'];
        $email = $_GET['email'];
        $cargo = $_GET['cargo'];
        $status = $_GET['status'];

        $resultado = UsuarioDAO::create($nome, $login, $senha, $email, $status, $cargo); 
        if($resultado == 1){
            echo '<div class="alert alert-success" role="alert">Usuário cadastrado com sucesso!</div>';
        } else {
            echo '<div class="alert alert-danger" role="alert">Erro ao cadastrar usuário!</div>';
        }
        
        
    } else {
        echo '<div class="alert alert-warning" role="alert">Por favor, preencha os campos obrigatórios.</div>';
    }
    
    
} else {
    
    header('Location: ../paginas/index.php');
    
}