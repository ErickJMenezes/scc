$(document).ready(function(){
    $('#novo_ativo').submit(function(e){
        e.preventDefault(e);
        $.ajax({
            url: '../../php/atualizardadosativo.php',
            type: 'POST',
            data: $('#novo_ativo').serialize() ,
            success: function(data){
                $('#retornoformulario').html(data);
                document.getElementById("novo_ativo").reset();
            }
        });

    });


    $('#btpesquisa').click(function () {

        $.ajax({
            url: '../../php/pesquisarativo.php',
            type: 'POST',
            data: $('#campopesquisa').serialize(),
            dataType: 'json',
            success: function (retorno) {
                if(retorno != -1 && retorno != null){
                    var json = retorno;
                    $('#nome').val(json.nome);
                    $('#tombo').val(json.tombo);
                    $('#descricao').val(json.descricao);
                    $('#tomold').val(json.tombo);
                    if(json.status == 'ativo'){
                        $('input:radio[value=ativo]').prop('checked', true);
                    } else if(json.status == 'inativo'){
                        $('input:radio[value=inativo]').prop('checked', true);
                    }

                } else {
                    var msg = 'ATIVO NÃO ENCONTRADO';
                    $('#nome').val(msg);
                    $('#tombo').val(msg);
                    $('#descricao').val(msg);

                }

            }

        });

    });


});

