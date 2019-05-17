
<?php
session_start();
  /*
    Verifica se ja existe usuário logado, caso sim verifica o cargo e redireciona para a pagina correta.
    */
    if(isset($_SESSION['auth'])){
        if($_SESSION['auth'] == 'true'){ //verifica se o usuário está autenticado
            include_once '../../php/lib/UsuarioDAO.php';
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

<!DOCTYPE html>
<html lang="pt" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>SCC Analista</title>
    <link rel="stylesheet" href="../../css/bootstrap.css">
    <link rel="stylesheet" href="../../css/estilo.css" media="screen">
  </head>
  <body>
    <div id="principal">

      <div id="barrapesquisa">
        <button type="button" class="btn btn-primary barra-pesquisa-alinhar" id="nomeusuario">
           Bem vindo <span class="badge badge-light"><?php echo $usuario->nome ?></span>
          <span class="sr-only">Nome</span>
        </button>
        <?php
            if(isset($_GET['e'])){

                if($_GET['e'] == '1'){
                    echo '<div id="alertmessage" class="alert alert-danger" role="alert" style="width:200px;  height:50px; postion:relative; float:right; margin:0px; margin-right:10px; top:5px; text-align:center;">Ativo inexistente</div>';
                }else if($_GET['e'] == '2'){
                    echo '<div id="alertmessage" class="alert alert-danger" role="alert" style="width:200px;  height:50px; postion:relative; float:right; margin-left:0px; margin-right:10px; top:5px; text-align:center;">Ativo Desativado.</div>';
                }
            }
        ?>
        <form id="pesquisatombo" class="barra-pesquisa-alinhar" action="../../php/pesquisatombo.php" method="POST">
          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <button class="btn btn-outline-secondary" type="submit">Pesquisar</button>
            </div>
            <input type="text" class="form-control" name="tombo" placeholder="Tombo" aria-label="" aria-describedby="basic-addon1" required>
          </div>
        </form>
      </div>

      <div id="lista-chamados">
        <table class="table">
          <thead class="thead-dark">
            <tr>
              <th>ID</th>
              <th>título</th>
              <th>Requerente</th>
              <th>Atribuido para</th>
              <th>Status</th>
              <th>Criado em</th>
              <th>Ativo</th>
              <th></th>
            </tr>
          </thead>
          <?php
          include_once '../../php/lib/ChamadoDAO.php';
          $chamados = ChamadoDAO::getAllForUser($usuario->getId());


          for($i = 0; $i < sizeof($chamados); $i++){
            echo "<tr>";
              echo "<td>".$chamados[$i]['id']."</td>";
              echo "<td>".$chamados[$i]['nome']."</td>";
              echo "<td>".$chamados[$i]['requerente']."</td>";
              echo "<td>".$usuario->nome."</td>";
              echo "<td>".$chamados[$i]['status']."</td>";
              echo "<td>".$chamados[$i]['data_abertura']."</td>";
              echo "<td>".$chamados[$i]['ativo_linkado']."</td>";
              echo "<td>"."edit"."</td>";
            echo "</tr>";
          }

           ?>
        </table>
      </div>

      <div id="home-opcoes">
        <div id="menu">
          Menu
        </div>

        <p class="lead">
          <a class="btn btn-primary btn-lg" href="../../php/logout.php" role="button">Sair</a>
        </p>

      </div>

    </div>
    <script type="text/javascript" src="../../js/bootstrap.js"></script>
    <script type="text/javascript" src="../../js/jquery.js"></script>
  </body>
</html>
