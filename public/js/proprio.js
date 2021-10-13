$(document).ready(function () {

    $("#edtcpf").inputmask({
        mask: ['999.999.999-99', '99.999.999/9999-99'],
        keepStatic: true
    });

    $("#edtnascimento").inputmask({
        mask: '99/99/9999'
    });
    $('#edtnascimento').datepicker({
        language: "pt-BR",
        autoclose: true
    });

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