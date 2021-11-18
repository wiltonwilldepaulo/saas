function alerta(status, mensagem, titulo, link) {
    document.getElementById("titulo").innerHTML = titulo;
    document.getElementById("mensagem").innerHTML = mensagem;
    //MENSAGEM DE SUCESSO
    if (status == 0) {
        document.getElementById("alerta").className = 'callout callout-success';
    }
    //MENSAGEM DE ERRO
    if (status == 1) {
        document.getElementById("alerta").className = 'callout callout-danger';
    }
    setTimeout(() => {
        document.getElementById("alerta").className = 'callout callout-warning';
        document.getElementById("titulo").innerHTML = 'Atenção!';
        document.getElementById("mensagem").innerHTML = 'Todos os campos sinalizado com * são requeridos para o cadastro!';
    }, 1700);
    //APÓS AGUARDA 500MS REDIRECIONAMOS PARA PAGINA
    setTimeout(() => {
        if (link != '') {
            //REDIRECIONAMOS PARA A INTERFACE DE LISTAGEM
            window.location.replace(link);
        }
    }, 1800);
}