<?php
session_start();

include 'lib/UsuarioDAO.php';
include 'lib/ChamadoDAO.php';


//Verifica se o usuário está autenticado
if($_SESSION['auth'] == 'true'){


    //Verifica se foram inseridos informações no formulário da página html
    if(isset($_POST['titulo']) && isset($_POST['status']) && isset($_POST['analista']) && isset($_POST['requerente']) && isset($_POST['ativo'])){


        //Pega as informações do formulário
        $nome = $_POST['titulo'];
        $analista_atribuido = $_POST['analista'];
        $requerente = $_POST['requerente'];
        $status = $_POST['status'];
        $ativo = $_POST['ativo'];

        if(AtivoDAO::getIdPeloTombo($ativo) === -1){
          echo '<div class="alert alert-danger" role="alert">Tombo Inexistente, digite um tombo válido</div>';
        } else {
          // Cadastra o chamado no banco de dados
          $chamado = ChamadoDAO::create($nome, $status, $requerente, $analista_atribuido, $ativo);

          //Verifica se foi cadastrado com sucesso
          if($chamado == 1){
              //header('Location: cadastrodechamados.php?e=0');  // mensagem de sucesso
              echo '<div class="alert alert-success" role="alert">Chamado aberto com sucesso!</div>';
          } else {
              //header('Location: cadastrodechamados.php?e=2'); //mensagem de erro
              echo '<div class="alert alert-danger" role="alert">Erro ao cadastrar chamado.</div>';
          }
        }



    } else {

        //header('Location: cadastrodechamados.php?e=1');

    }


// Caso o usuário não esteja autenticado, o sistema o mandará para a página de login.
}else{
    header('Location: ../paginas/index.php?e=4');
}
