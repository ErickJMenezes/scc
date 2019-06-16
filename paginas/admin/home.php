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
<html>
    <head>
        <title>SCC</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="../../css/bootstrap.css">
        <link rel="stylesheet" href="../../css/estilo.css" media="screen">
        <link rel="stylesheet" href="../../css/menuadmin.css">
        <link rel="stylesheet" type="text/css" href="../../css/fa/css/all.min.css" media="screen"/>
    </head>

<body>
    <div id="login">
        <h2 class="text-center text-white pt-5">Sistema de Controle de Chamados</h2>
        <div class="container">
            <div id="login-row" class="row justify-content-center align-items-center">
                <div id="login-column" class="col-md-6">
                    <div id="login-box" class="col-md-12">
                            <h3 class="text-center text-info">Menu Administrador</h3>
                            <div class="form-group">
                                <ul id="adm-menu">
                                    <li><a href="cadastrousuario.php"><i class="fas fa fa-user-plus"></i> Cadastrar Novo Usuário</a></li>
                                    <li><a href="editarusuario.php"><i class="fas fa fa-user-edit"></i> Editar usuario</a></li>
                                    <li><a href="cadastroativo.php"><i class="fas fa fa-plus-circle"></i> Cadastrar Novo Ativo</a></li>
                                    <li><a href="editarativo.php"><i class="fas fa fa-edit"></i> Editar ativo</a></li>
                                    <li><a href="../../php/logout.php"><i class="fas fa fa-door-open"></i> Sair</a></li>
                                </ul>
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
