<?php
session_start();

include 'lib/UsuarioDAO.php';
include 'lib/ChamadoDAO.php';


//Verifica se o usuário está autenticado
if($_SESSION['auth'] == 'true'){
    
    
    //Verifica se foram inseridos informações no formulário da página html
    if(isset($_POST['titulo']) && isset($_POST['descricao']) && isset($_POST['analista']) && isset($_POST['requerente']) && isset($_POST['ativo'])){
        
        
        //Pega as informações do formulário
        $nome = $_POST['titulo'];
        $descricao = $_POST['descricao'];
        $analista_atribuido = $_POST['analista'];
        $requerente = $_POST['requerente'];
        $status = 'aberto';
        $ativo = $_GET['ativo'];

        // Cadastra o chamado no banco de dados
        $chamado = ChamadoDAO::create($nome, $status, $requerente, $_GET['id'], $ativo);
        
        //Verifica se foi cadastrado com sucesso
        if($chamado == 1){
            //header('Location: cadastrodechamados.php?e=0');  // mensagem de sucesso
        } else {
            //header('Location: cadastrodechamados.php?e=2'); //mensagem de erro
        }
        
    } else {
        
        //header('Location: cadastrodechamados.php?e=1');
        
    }
    
    
// Caso o usuário não esteja autenticado, o sistema o mandará para a página de login.
}else{
    header('Location: ../paginas/index.php?e=4');
}