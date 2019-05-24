<?php
session_start();
/*
    Verifica se ja existe usuário logado, caso sim verifica o cargo e redireciona para a pagina correta.
    */
    if(isset($_SESSION['auth'])){
        if($_SESSION['auth'] == 'true'){
            include_once '../../php/lib/UsuarioDAO.php';
            $usuario = new UsuarioDAO($_SESSION['id']);
            if($usuario->cargo == 'administrador'){
              header('Location: ../admin/home.php');
            } else if($usuario->cargo == 'analista'){

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
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="../../css/bootstrap.css">
    <link rel="stylesheet" href="../../css/estilo.css" media="screen">
    <title>SCC</title>
  </head>
  <body>
      <div id="login">
        <div class="container">
            <div id="login-row" class="row justify-content-center align-items-center">
                <div id="login-column" class="col-md-6">
                    <div id="login-box" class="col-md-12">
                        <div id="login-form" class="form">
                            <h3 class="text-center text-info">Abrir Chamado</h3>
                            <div class="form-group">
                                <form id="novo_chamado" class="form" method="POST" action="../../php/cadastrochamado.php">
                                    <h3 class="text-center text-info">Insira os dados abaixo:</h3>
                                    <br/>
                                    <div id="retornoformulario"></div>
                                    <br/>
                                    <label for="titulo" class="text-info">Título:</label>
                                    <input type="text" id="id" required name="titulo" class="form-control" placeholder="Digite o título do chamado"/>
                                    <br/>
                                    <br/>
                                    <label for="requerente" class="text-info">Requerente:</label>
                                    <input type="text" id="requerente" required name="requerente" class="form-control" placeholder="Digite o nome do requerente"/>
                                    <br/>
                                    <br/>
                                    <!--Preencher com o nome do funcionário-->
                                    <label for="funcionario" class="text-info">Analista atribuído: <?php echo '<br>'.$usuario->nome ?></label>
                                    <input type="text" id="analista" required readonly name="analista" class="form-control" value="<?php echo $usuario->getId(); ?>"/>
                                    <br/>
                                    <br/>
                                    <!--Preencher com o ativo-->
                                    <label for="ativo" class="text-info">Ativo(TOMBO): </label>
                                    <input type="text" id="ativo" required name="ativo" class="form-control" placeholder="Digite o tombo do ativo"/>
                                    <br/>
                                    <br/>
                                    <a href="#abrir_chamado" style="text-decoration: none;"><input type="submit" name="abrir chamado" class="btn btn-info btn-md" value="Abrir novo Chamado"/></a>
                                    <a href="home.php" style="text-decoration: none;">Voltar</a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="../../js/bootstrap.js"></script>
    <script type="text/javascript" src="../../js/jquery.js"></script>
    <script>

        $(document).ready(function(){
            $('#novo_chamado').submit(function(e){
                e.preventDefault(e);
                $.ajax({
                    url: '../../php/cadastrochamado.php',
                    type: 'POST',
                    data: $('#novo_chamado').serialize() ,
                    success: function(data){
                        $('#retornoformulario').html(data);
                        document.getElementById("novo_chamado").reset();
                    }
                });

            });


        });

    </script>
  </body>
</html>
