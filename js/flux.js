/*
Por Erick Menezes

Arquivo feito para adicionar funcionalidades extras à página que for linkado.
Para usar sua funcinalidade basta inserir no elemento a classe CSS que contem a funcionalidade.
Algumas classes só funcionam em conjunto com outras.
*/

/*
---Botão de pesquisa ---
Objetivo ->
    Adicionar a funcionalidade de apertar o botão "Enter"
    e realizar a busca.
    Extra: Desvanecer a mensagem de retorno da tentativa de edicao.

Requisitos ->
    01 <input de texto>     --> cls: 'flux-search-input'
    01 <botão de pesquisa>  --> cls: 'flux-search-button'
------------------------
 */
$('.flux-search-input').on("keypress", function (key) {
    if(key.key == 'Enter'){
        $('.flux-search-button').click()
        $('#retornoformulario').children().fadeOut('slow', 'swing');
    }
});