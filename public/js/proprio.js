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

    if (document.getElementById("edtid").value != '') {
        document.getElementById("tb-endereco").className = 'nav-link';
        document.getElementById("tb-contato").className = 'nav-link';
    } else {
        document.getElementById("tb-endereco").className = 'nav-link disabled';
        document.getElementById("tb-contato").className = 'nav-link disabled';
    }
    //CONFIGURAÇÕES DOS PARAMENTRO DE VALIDAÇÃO DO FORMULÁRIO
    $('#frmproprio').validate({
        rules: {
            edtimagems: {
                required: true,
                file: true,
            },
            agree: "required"
        },
        errorElement: 'span',
        errorPlacement: function (error, element) {
            error.addClass('invalid-feedback');
            element.closest('.form-group').append(error);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        }
    });

    $("#btn-salvar").click(function (e) {
        e.preventDefault();
        //RECEBEMOS O RESULTADO DA VALIDAÇÃO DO FORMULARIO
        let valida = $('#frmproprio').valid();
        // let acao = document.getElementById("edtacao");
        if (valida == true) {
            //CONTANTE CONTEM OS DADOS DO FORMULÁRIO
            const proprio = document.getElementById("frmproprio");
            const form = new FormData(proprio);
            $.ajax({
                type: "post",
                url: "controleproprio",
                data: form,
                processData: false,
                contentType: false,
                success: function (response) {

                }
            });
        }
    });
    //FILE INPUT DO LOGO E DO ICONE.
    $("#edtlogo").fileinput({});
    $("#edticone").fileinput({});
});