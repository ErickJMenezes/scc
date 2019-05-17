<?php
session_start();
/*
    Verifica se ja existe usuário logado, caso sim verifica o cargo e redireciona para a pagina correta.
    */
    if(isset($_SESSION['auth'])){
        if($_SESSION['auth'] == 'true'){
            include '../../php/lib/UsuarioDAO.php';
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
<html>
    <head>
        <title>SCC</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" type="text/css" href="../../css/estilo.css" media="screen" />
        <link rel="stylesheet" href="../../css/bootstrap.css">
    </head>

<body>
    <div id="login">
        <h2 class="text-center text-white pt-5">Sistema de Controle de Chamados</h2>
        <div class="container">
            <div id="login-row" class="row justify-content-center align-items-center">
                <div id="login-column" class="col-md-6">
                    <div id="login-box" class="col-md-12">
                        <form id="login-form" class="form" action="../../php/logout.php" method='POST'>
                            <h3 class="text-center text-info">ADM Home</h3>
                            <div class="form-group">
                                <ul>
                                    <li><a href="cadastrousuario.php">Cadastrar Novo Usuário</a></li>
                                    <li><a href="#">Editar usuario</a></li>
                                    <li><a href="#">Cadastrar Novo Ativo</a></li>
                                    <li><a href="#">Editar ativo</a></li>
                                    <form >
                                      <input type="hidden" id="sair" name="sair" value="1">
                                      <input type="submit" value="Sair">
                                    </form>
                                </ul>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="../../js/bootstrap.js"></script>
    <script type="text/javascript" src="../../js/jquery.js"></script>
</body>

</html>
