/*
Arquivo feito para adicionar funcionalidades extras à página que for linkado.
Para usar sua funcinalidade basta inserir no elemento a classe CSS que contem a funcionalidade.
Algumas classes só funcionam em conjunto com outras.

BIBLIOTECA DE CLASSES:

Botão de pesquisa ---

Objetivo ->
    Adicionar a funcionalidade de apertar o botão "Enter"
    e realizar a busca.

Requisitos ->
    01 input de texto    --> cls: 'flux-search-input'
    01 botão de pesquisa --> cls: 'flux-search-button'


---------------------

 */
$('.flux-search-input').on("keypress", function (key) {
    if(key.key == 'Enter'){
        $('.flux-search-button').click()
    }
})

