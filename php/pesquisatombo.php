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
      echo '<div class="alert alert-success" role="alert">'.$ativo->nome.' '.$ativo->descricao.' '.$ativo->tombo.'</div>';
      echo '<a href="../paginas/analista/home.php">Voltar</a>';
    }
  }

} else {
  header('Location: ../paginas/analista/home.php');
}
?>

<!DOCTYPE html>
<html lang="pt" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>SCC Analista</title>
    <link rel="stylesheet" href="../../css/bootstrap.css">
    <link rel="stylesheet" href="../../css/estilo.css" media="screen">
  </head>
<body>
    <div id="ativo-pesquisado">
        <table class="table table-bordered table-hover" style="text-align:center;">
            <thead class="thead-dark">
                <tr>
                  <th>Nome do ativo</th>
                  <th>Tombo</th>
                  <th>Descrição</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</body>