<?php
session_start();
/*
    Verifica se ja existe usuário logado, caso sim verifica o cargo e redireciona para a pagina correta.
    */
    if(isset($_SESSION['auth'])){
        if($_SESSION['auth'] == 'true'){
            include_once '../../php/lib/ChamadoDAO.php';
            $usuario = new UsuarioDAO($_SESSION['id']);
            if($usuario->cargo == 'administrador'){
              header('Location: ../admin/home.php');
            } else if($usuario->cargo == 'analista'){
              if(isset($_GET['id'])){
                $chamado = new ChamadoDAO($_GET['id']);
              } else {
                header('Location: ../index.php');
              }
            }
        } else {
            header('Location: ../index.php');
        }
    } else {
      header('Location: ../index.php');
    }
?>
<!DOCTYPE html>
<html lang="pt" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Acompanhamento <?php
    echo $chamado->nome; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="../../css/bootstrap.css">
    <link rel="stylesheet" href="../../css/estilo.css" media="screen">
    <link rel="stylesheet" href="../../css/acompanhamento.css">
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
        <a href="./home.php" class="btn btn-primary" id="btvoltar">Voltar</a>
      </div>
      <div id="container-acompanhamento">
        <div class="acompanhamento">
          <div class="acompanhamento-titulo">
            <?php echo "<h3>Abertura</h3>"; ?>
          </div>
            <h6>
              Chamado criado em:
              <?php echo $chamado->data_abertura; ?>
            </h6>
        </div>
        <?php

        include_once '../../php/lib/AcompanhamentoDAO.php';

        $acompanhamentos = AcompanhamentoDAO::getAllForChamado($_GET['id']);

        for($i = 0; $i < sizeof($acompanhamentos); $i++){
          echo "<div id='container-acompanhamento'>\n<div class='acompanhamento'>\n<div class='acompanhamento-titulo'><h3><h3>".$usuario->nome."</h3></h3></div><h6>".$acompanhamentos[$i]['descricao']."</h6></div>";
        }

         ?>
         <div id="container-acompanhamento" style="<?php if($chamado->status == 'fechado'){echo "display: none";} else {echo "display: block;";}?>">
           <div class="acompanhamento">
             <div class="acompanhamento-titulo">
               <?php echo "<h3>".$usuario->nome."</h3>"; ?>
             </div>
               <h6>
                 <form id="formdesc" class="form" action="../../php/escreverchamado.php" method="post">
                   <textarea name="descricao" form="formdesc" style="width: 100%; border-style: none; resize: none;" placeholder="Acompanhamento..." maxlength="100"></textarea>
                   <input type="text" name="usuario_id" hidden value="<?php echo $_SESSION['id']; ?>">
                   <input type="text" name="chamado_id" hidden value="<?php echo $_GET['id']; ?>">
                   <br>
                   <input type="submit" class="btn btn-primary" name="" value="Escrever"><br>
                   <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="status" name="status">
                    <label class="custom-control-label" for="status">Fechar chamado</label>
                  </div>
                 </form>
               </h6>
           </div>

         </div>
  </body>
  <script type="text/javascript" src="../../js/bootstrap.js"></script>
  <script type="text/javascript" src="../../js/jquery.js"></script>
  <script type="text/javascript">

  </script>
</html>
