<?php

session_start();

if($_SESSION['auth'] == 'true'){
    
    if(isset($_GET['nome']) && isset($_GET['login']) && isset($_GET['senha']) && isset($_GET['status'])){
        
        include "UsuarioDAO.php";

        $nome = $_GET['nome'];
        $login = $_GET['login'];
        $senha = $_GET['senha'];
        $email = $_GET['email'];
        $cargo = $_GET['cargo'];
        $status = $_GET['status'];

        $resultado = UsuarioDAO::create($nome, $login, $senha, $email, $status, $cargo); 
        if($resultado == 1){
            echo 'Usuario cadastrado com sucesso!';
        } else {
            echo 'Erro ao cadastrar usuario';
        }
        
        
    } else {
        echo 'Por favor, preencha os campos obrigatórios';
    }
    
    
} else {
    
    header('Location: ../paginas/index.php');
    
}