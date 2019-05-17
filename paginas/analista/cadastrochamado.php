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

            } else if($usuario->cargo == 'analista'){
                header('Location: ../analista/home.php');
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
                                <form id="novo_usuario" class="form" method="POST">
                                    <h3 class="text-center text-info">Insira os dados abaixo:</h3>
                                    <br/>
                                    <div id="retornoformulario"></div>
                                    <br/>
                                    <label for="id" class="text-info">Título:</label>
                                    <input type="text" id="id" required name="login" class="form-control"/>
                                    <br/>
                                    <br/>
                                    <label for="nome" class="text-info">Descrição:</label>
                                    <input type="text" id="nome" required name="nome" class="form-control"/>
                                    <br/>
                                    <br/>
                                    <label for="email" class="text-info">Nome do requerente:</label>
                                    <input type="email" id="email" required name="email" class="form-control"/>
                                    <br/>
                                    <br/>
                                    <label for="funcionario" class="text-info">Funcionário atribuído:</label>
                                    <br/>
                                    <br/>
                                    <label for="ativo" class="text-info">Ativo: </label>
                                    <br/>
                                    <br/>
                                    <label for="status" class="text-info">Status: </label>
                                    <label for="status" class="text-info">Aberto</label>
                                    <input type="radio" id="status" value="aberto" required name="status"/>
                                    <label for="status" class="text-info">Fechado</label>
                                    <input type="radio" id="status" value="fechado" required name="status"/>
                                    <br/>
                                    <br/>
                                    <a href="#novo_chamado" style="text-decoration: none;"><input type="submit" name="abrir chamado" class="btn btn-info btn-md" value="Abrir Chamado"/></a>
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
  </body>
</html>