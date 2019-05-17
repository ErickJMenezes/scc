<?php

session_start();

/*
  Verifica se ja existe usuário logado, caso sim verifica o cargo e redireciona para a pagina correta.
  */
  if(isset($_SESSION['auth'])){
      if($_SESSION['auth'] == 'true'){ //verifica se o usuário está autenticado
          include_once 'lib/UsuarioDAO.php';
          $usuario = new UsuarioDAO($_SESSION['id']);
          if($usuario->cargo == 'administrador'){
            //Manda para a home da sua página
            header('Location: ../analista/home.php');
          } else if($usuario->cargo == 'analista'){
            //Não faz nada
          }
      } else {
          header('Location: ../paginas/index.php');
      }
  }

if(isset($_POST['tombo']) and $_POST['tombo'] != ''){
  include_once 'lib/AtivoDAO.php';

  $tombo = $_POST['tombo'];

  $ativo = AtivoDAO::getAtivoPeloTombo($tombo);
  if(is_numeric($ativo)){
    header('Location: ../paginas/analista/home.php?e=1');
  } else {
    if($ativo->status == 'inativo'){
      header('Location: ../paginas/analista/home.php?e=2');
    } else {
      echo $ativo->nome;
      //continuar
    }
  }

} else {
  header('Location: ../paginas/analista/home.php');
}
