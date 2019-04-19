<!DOCTYPE html>
<html>
    <head>
        <title>SCC</title>
        <meta charset="UTF-8">
        <link href="../css/bootstrap.css" rel="stylesheet" id="bootstrap-css" >
        <link rel="stylesheet" type="text/css" href="../css/tela_login.css" media="screen" />
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
                                <label for="username" class="text-info">Usuário:</label><br>
                                <input type="text" id="usuario" class="form-control" required name="usuario">
                            </div>
                            <div class="form-group">
                                <label for="password" class="text-info">Senha:</label><br>
                                <input type="password" id="senha" class="form-control" required name="senha">
                            </div>
                            <div class="form-group">
                                <input type="submit" name="login" class="btn btn-info btn-md" value="login">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="../js/bootstrap.js"></script>
</body>

</html>
