<?php
session_start();
/*
    Verifica se ja existe usuário logado, caso sim verifica o cargo e redireciona para a pagina correta.
    */
    if(isset($_SESSION['auth'])){
        if($_SESSION['auth'] == 'true'){
            include_once '../php/lib/UsuarioDAO.php';
            $usuario = new UsuarioDAO($_SESSION['id']);
            if($usuario->cargo == 'administrador'){
                header('Location: admin/home.php');
            } else if($usuario->cargo == 'analista'){
                header('Location: analista/home.php');
            }
        }
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>SCC</title>
        <meta charset="UTF-8">
        <link href="../css/bootstrap.css" rel="stylesheet" id="bootstrap-css" >
        <link rel="stylesheet" type="text/css" href="../css/tela_login.css" media="screen" />
        <link rel="stylesheet" type="text/css" href="../css/fa/css/all.min.css" media="screen"/>
    </head>
<body>
    <div id="login">
        <h3 class="text-center text-white pt-5">Sistema de Controle de Chamados</h3>
        <div class="container">
            <div id="login-row" class="row justify-content-center align-items-center">
                <div id="login-column" class="col-md-6">
                    <div id="login-box" class="col-md-12">
                        <form id="login-form" class="form" action="../php/auth.php" method="post">
                            <h3 class="text-center text-info">Login</h3>
                            <div class="form-group">
                                <label for="username" class="text-info"><i class="fas fa fa-user"></i> Usuário:</label><br>
                                <input type="text" id="usuario" class="form-control" required name="usuario" placeholder="Digite seu login">
                            </div>
                            <div class="form-group">
                                <label for="password" class="text-info"><i class="fas fa fa-key"></i> Senha:</label><br>
                                <input type="password" id="senha" class="form-control" required name="senha" placeholder="Digite sua senha">
                            </div>
                            <div class="form-group">
                                <button type="submit" id="submit" name="login" class="btn btn-info btn-md"><span class="fas fa fa-sign-in-alt"></span> Login</button>
                            </div>
                            <div class="form-group" id="retornoformulario">
                                <?php
                                    if(isset($_GET['e'])){

                                        if($_GET['e'] == '1'){
                                            echo '<div id="alertmessage" class="alert alert-danger" role="alert">Usuário desativado</div>';
                                        }else if($_GET['e'] == '2'){
                                            echo '<div id="alertmessage" class="alert alert-danger" role="alert">Usuário não existe</div>';
                                        }else if($_GET['e'] == '3'){
                                            echo '<div id="alertmessage" class="alert alert-danger" role="alert">Preencha todos os campos</div>';
                                        }else if ($_GET['e'] == '4'){
                                            echo '<div id="alertmessage" class="alert alert-danger" role="alert">Por favor, autentique-se.</div>';
                                        }
                                    }
                                ?>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="../js/bootstrap.js"></script>
    <script src="../js/jquery.js"></script>
</body>

</html>