<!--
<?php
session_start();
  /*
    Verifica se ja existe usuário logado, caso sim verifica o cargo e redireciona para a pagina correta.
    */
    if(isset($_SESSION['auth'])){
        if($_SESSION['auth'] == 'true'){ //verifica se o usuário está autenticado
            include '../../php/lib/UsuarioDAO.php';
            $usuario = new UsuarioDAO($_SESSION['id']);
            if($usuario->cargo == 'administrador'){
              //Manda para a home da sua página
              header('Location: ../analista/home.php');
            } else if($usuario->cargo == 'analista'){
              //Não faz nada
            }
        } else {
            header('Location: ../index.php');
        }
    }
?>
-->

<!DOCTYPE html>
<html lang="pt" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>SCC Analista</title>
    <link rel="stylesheet" href="../../css/bootstrap.css">
    <link rel="stylesheet" href="../../css/estilo.css" media="screen">
  </head>
  <body>
    <div id="pg_analista">

    </div>
    <script type="text/javascript" src="../../js/bootstrap.js"></script>
    <script type="text/javascript" src="../../js/jquery.js"></script>
  </body>
</html>
