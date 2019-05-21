<?php
session_start();

include 'lib/UsuarioDAO.php';
include 'lib/ChamadoDAO.php';


//Verifica se o usuário está autenticado
if($_SESSION['auth'] == 'true'){


    //Verifica se foram inseridos informações no formulário da página html
    if(isset($_POST['titulo']) && isset($_POST['requerente']) && isset($_POST['id'])){


        //Pega as informações do formulário
        $cid = $_POST['id'];
        $nome = $_POST['titulo'];
        $analista_atribuido = $_POST['analista'];
        $requerente = $_POST['requerente'];

          // Cadastra o chamado no banco de dados
          $chamado = new ChamadoDAO($cid);
          $chamado->nome = $nome;
          $chamado->requerente = $requerente;
          $ret = $chamado->commit();

          //Verifica se foi cadastrado com sucesso
          if($ret == 1){
              //header('Location: cadastrodechamados.php?e=0');  // mensagem de sucesso
              echo '<div class="alert alert-success" role="alert">Alterações realizadas com sucesso!</div>';
          } else {
              //header('Location: cadastrodechamados.php?e=2'); //mensagem de erro
              echo '<div class="alert alert-danger" role="alert">Erro ao realizar alterações.</div>';
          }



    } else {

        //header('Location: ../paginas/index.php');

    }


// Caso o usuário não esteja autenticado, o sistema o mandará para a página de login.
}else{
    header('Location: ../paginas/index.php?e=4');
}
?>
