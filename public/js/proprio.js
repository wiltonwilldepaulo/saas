$(document).ready(function () {
    let btn = document.querySelector("#btn-salvar");
    btn.onclick = function () {
        //CONTANTE CONTEM OS DADOS DO FORMULÁRIO
        const form = $("#frmproprio").serialize();
        $.ajax({
            type: "post",
            url: "controleproprio",
            data: form,
            //contentType: 'application/json',
            success: function (response) {

            }
        });
    }
});