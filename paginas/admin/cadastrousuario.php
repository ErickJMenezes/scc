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
        <link rel="stylesheet" type="text/css" href="../../css/fa/css/all.min.css" media="screen"/>
    </head>

<body>
    <div id="login">
        <div class="container">
            <div id="login-row" class="row justify-content-center align-items-center">
                <div id="login-column" class="col-md-6">
                    <div id="login-box" class="col-md-12">
                        <div id="login-form" class="form">
                            <h3 class="text-center text-info">Cadastrar novo usuário</h3>
                            <div class="form-group">
                                <form id="novo_usuario" class="form" method="POST">
                                    <h3 class="text-center text-info">Insira os dados abaixo:</h3>
                                    <br/>
                                    <div id="retornoformulario"></div>
                                    <br/>
                                    <label for="id" class="text-info"><i class="fas fa fa-user-alt"></i> Login:</label>
                                    <input type="text" id="id" required name="login" class="form-control" placeholder="Digite um login para o novo usuário"/>
                                    <br/>
                                    <br/>
                                    <label for="nome" class="text-info"><i class="fas fa fa-signature"></i> Nome:</label>
                                    <input type="text" id="nome" required name="nome" class="form-control" placeholder="Digite o nome do novo usuário"/>
                                    <br/>
                                    <br/>
                                    <label for="email" class="text-info"><i class="fas fa fa-at"></i> E-mail:</label>
                                    <input type="email" id="email" required name="email" class="form-control" placeholder="Digite o e-mail do novo usuário"/>
                                    <br/>
                                    <br/>
                                    <label for="senha" class="text-info"><i class="fas fa fa-key"></i> Senha:</label>
                                    <input type="password" id="senha" required name="senha" class="form-control" placeholder="Digite uma senha para o novo usuário"/>
                                    <br/>
                                    <br/>
                                    <label for="cargo" class="text-info"><i class="fas fa fa-user-tag"></i> Cargo: </label><br>
                                    <label for="cargo" class="text-info">Analista</label>
                                    <input type="radio" id="cargo" value="analista" required name="cargo"/>
                                    <label for="cargo" class="text-info">Administrador</label>
                                    <input type="radio" id="cargo" value="administrador" required name="cargo"/>
                                    <br/>
                                    <br/>
                                    <label for="status" class="text-info"><i class="fas fa fa-toggle-on"></i> Status: </label><br>
                                    <label for="status" class="text-info">Ativo</label>
                                    <input type="radio" id="status" value="ativo" required name="status"/>
                                    <label for="status" class="text-info">Inativo</label>
                                    <input type="radio" id="status" value="inativo" required name="status"/>
                                    <br/>
                                    <br/>
                                    
                                    <a href="#retornoformulario" style="text-decoration: none;"><button class="btn btn-info btn-md" type="submit" name="cadastrar"><i class="fas fa fa-user-plus"></i> Cadastrar</button></a>
                                    <a href="home.php" class="btn btn-primary" style="text-decoration: none;"><i class="fas fa fa-arrow-left"></i> Voltar</a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="../../js/bootstrap.js"></script>
    <script src="../../js/jquery.js"></script>
    <script>

        $(document).ready(function(){
            $('#novo_usuario').submit(function(e){
                e.preventDefault(e);
                $.ajax({
                    url: '../../php/cadastroanalista.php',
                    type: 'POST',
                    data: $('#novo_usuario').serialize() ,
                    success: function(data){
                        $('#retornoformulario').html(data);
                        document.getElementById("novo_usuario").reset();
                    }
                });

            });


        });


    </script>
</body>

</html>
