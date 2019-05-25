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
    </head>

<body>
    <div id="login">
        <div class="container">
            <div id="login-row" class="row justify-content-center align-items-center">
                <div id="login-column" class="col-md-6">
                    <div id="login-box" class="col-md-12">
                        <div id="login-form" class="form">
                            <h3 class="text-center text-info">Editar usuário</h3>
                            <div class="form-group">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <button class="btn btn-outline-secondary" id="btpesquisa">Pesquisar</button>
                                    </div>
                                    <input type="text" id="campopesquisa" class="form-control" name="pesquisa" placeholder="Digite o Login do usuário" aria-label="" aria-describedby="basic-addon1" required>
                                </div>
                                <form id="novo_usuario" action="../../php/atualizardadosusuario.php" class="form" method="POST">
                                    <div id="retornoformulario"></div>
                                    <br/>
                                    <label for="id" class="text-info">Login:</label>
                                    <input type="text" id="id" required name="login" class="form-control" placeholder="Pesquise um usuário para alterar os dados"/>
                                    <br/>
                                    <br/>
                                    <label for="nome" class="text-info">Nome:</label>
                                    <input type="text" id="nome" required name="nome" class="form-control" placeholder="Pesquise um usuário para alterar os dados"/>
                                    <br/>
                                    <br/>
                                    <label for="email" class="text-info">E-mail:</label>
                                    <input type="email" id="email" required name="email" class="form-control" placeholder="Pesquise um usuário para alterar os dados"/>
                                    <br/>
                                    <br/>
                                    <label for="senha" class="text-info">Senha:</label>
                                    <input type="password" id="senha" name="senha" class="form-control" placeholder="Pesquise um usuário para alterar os dados"/>
                                    <br/>
                                    <br/>
                                    <label for="cargo" class="text-info">Cargo: </label>
                                    <label for="cargo" class="text-info">Analista</label>
                                    <input type="radio" id="cargo" value="analista" required name="cargo"/>
                                    <label for="cargo" class="text-info">Administrador</label>
                                    <input type="radio" id="cargo" value="administrador" required name="cargo"/>
                                    <br/>
                                    <br/>
                                    <label for="status" class="text-info">Status: </label>
                                    <label for="status" class="text-info">Ativo</label>
                                    <input type="radio" id="status" value="ativo" required name="status"/>
                                    <label for="status" class="text-info">Inativo</label>
                                    <input type="radio" id="status" value="inativo" required name="status"/>
                                    <br/>
                                    <br/>
                                    <a href="#novo_usuario" style="text-decoration: none;"><input type="submit" name="cadastrar" class="btn btn-info btn-md" value="Salvar Alterações"/></a>
                                    <a href="home.php" style="text-decoration: none;">Voltar</a>
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
                    url: '../../php/atualizardadosusuario.php',
                    type: 'POST',
                    data: $('#novo_usuario').serialize() ,
                    success: function(data){
                        $('#retornoformulario').html(data);
                        document.getElementById("novo_usuario").reset();
                    }
                });

            });


            $('#btpesquisa').click(function () {
                $.ajax({
                    url: '../../../php/pesquisarusuario.php',
                    type: 'POST',
                    data: $('#campopesquisa').serialize(),
                    success: function (retorno) {
                        if(retorno == -1){
                            var msg = 'USUÁRIO INEXITENTE';
                            $('#email').val(msg);
                            $('#id').val(msg);
                            $('#nome').val(msg);
                            $('#senha').val(msg);
                            $('#campopesquisa').val('');
                        } else {

                            var json = JSON.parse(retorno);
                            $('#email').val(json.email);
                            $('#id').val(json.login);
                            $('#nome').val(json.nome);
                            if(json.status == 'ativo'){
                                $('input:radio[value=ativo]').prop('checked', true);
                            } else if(json.status == 'inativo'){
                                $('input:radio[value=inativo]').prop('checked', true);
                            }
                            if(json.cargo == 'analista'){
                                $('input:radio[value=analista]').prop('checked', true);
                            } else if(json.cargo == 'administrador'){
                                $('input:radio[value=administrador]').prop('checked', true);
                            }
                            $('#senha').prop('placeholder', 'Deixe em branco para manter a senha antiga');

                        }
                    }
                })
            })

        });


    </script>
</body>

</html>
