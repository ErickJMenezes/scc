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
            url: '../../php/pesquisarusuario.php',
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
                    $('#lold').val(json.login);
                    $('#nome').val(json.nome);
                    $('#senha').val('');
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

