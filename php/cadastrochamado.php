<?php
session_start();

include 'lib/UsuarioDAO.php';
include 'lib/ChamadoDAO.php';

if($_SESSION['auth'] == 'true'){
    
    
    
    if(isset($_POST['titulo']) && isset($_POST['descricao']) && isset($_POST['analista']) && isset($_POST['requerente']) && isset($_POST['ativo'])){
        
        
        $nome = $_POST['titulo'];
        $descricao = $_POST['descricao'];
        $analista_atribuido = $_POST['analista'];
        $requerente = $_POST['requerente'];
        $status = 'aberto';
        $ativo = $_GET['ativo'];

        
        $chamado = ChamadoDAO::create($nome, $status, $requerente, $_GET['id'], $ativo);
        
        if($chamado == 1){
            //header('Location: cadastrodechamados.php?e=0');  // mensagem de sucesso
        } else {
            //header('Location: cadastrodechamados.php?e=2'); //mensagem de erro
        }
        
    } else {
        
        //header('Location: cadastrodechamados.php?e=1');
        
    }
    
    
}else{
    header('Location: ../paginas/index.php?e=4');
}