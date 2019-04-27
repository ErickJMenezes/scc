<!DOCTYPE html>
<html>
    <head>
        <title>SCC</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="../../css/estilo.css" media="screen" />
        <link href="../../css/bootstrap.css" rel="stylesheet" id="bootstrap-css" >
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
                                    <label for="id" class="text-info">Login:</label>
                                    <input type="text" id="id" required name="login" class="form-control"/>
                                    <br/>
                                    <br/>
                                    <label for="nome" class="text-info">Nome:</label>
                                    <input type="text" id="nome" required name="nome" class="form-control"/>
                                    <br/>
                                    <br/>
                                    <label for="email" class="text-info">E-mail:</label>
                                    <input type="email" id="email" required name="email" class="form-control"/>
                                    <br/>
                                    <br/>
                                    <label for="senha" class="text-info">Senha:</label>
                                    <input type="password" id="senha" required name="senha" class="form-control"/>
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
                                    <a href="#novo_usuario" style="text-decoration: none;"><input type="submit" name="cadastrar" class="btn btn-info btn-md" value="Cadastrar"/></a>
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
                    } 
                });
                
                document.getElementById("myForm").reset();
            });
            
            
        });
        
        
    </script>
</body>

</html>