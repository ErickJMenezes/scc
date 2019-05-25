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
                            <h3 class="text-center text-info">Editar ativo</h3>
                            <div class="form-group">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <button class="btn btn-outline-secondary" type="submit">Pesquisar</button>
                                    </div>
                                    <input type="text" class="form-control" name="tombo" placeholder="Digite o tombo do ativo" aria-label="" aria-describedby="basic-addon1" required>
                                </div>
                                <form id="novo_ativo" class="form" method="get" action="../../php/cadastro_ativo.php">
                                <br/>
                                    <div id="retornoformulario"></div>
                                    <br/>
                                    <label for="nome" class="text-info">Nome do ativo:</label>
                                    <input type="text" id="nome" required name="nome" class="form-control" placeholder="Digite o nome do ativo"/>
                                    <br/>
                                    <br/>
                                    <label for="tombo" class="text-info">Tombo:</label>
                                    <input type="text" id="tombo" required name="tombo" class="form-control" placeholder="Digite o tombo do ativo"/>
                                    <br/>
                                    <br/>
                                    <label for="descricao" class="text-info">Descrição:</label>
                                    <input type="text" id="descricao" required name="descricao" class="form-control" placeholder="Marca, modelo, setor..."/>
                                    <br/>
                                    <br/>
                                    <label for="ativo" class="text-info">Status: </label>
                                    <label for="cargo" class="text-info">Ativo</label>
                                    <input type="radio" id="ativo" value="ativo" required name="status"/>
                                    <label for="inativo" class="text-info">inativo</label>
                                    <input type="radio" id="inativo" value="inativo" required name="status"/>
                                    <br/>
                                    <br/>
                                    <a href="#novo_ativo" id="voltar_ao_topo" style="text-decoration: none;"><input onclick="$('#voltar_ao_topo').click();" type="submit" name="cadastrar ativo" class="btn btn-info btn-md" value="Cadastrar Ativo"/></a>
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
            $('#novo_ativo').submit(function(e){
                e.preventDefault(e);
                $.ajax({
                    url: '../../php/cadastro_ativo.php',
                    type: 'POST',
                    data: $('#novo_ativo').serialize() ,
                    success: function(data){
                        $('#retornoformulario').html(data);
                        document.getElementById("novo_ativo").reset();
                    }
                });

            });


        });


    </script>
  </body>
</html>
