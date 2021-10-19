//SELECIONAMOS O CNPJ
const cnpj = document.querySelector("#cnpj");
//NESTA FUNÇÃO PERCORREMOS TODAS AS POSIÇÕES DOS CAMPO DO JSON E 
//TEMTAMOS ENCONTRAR O CAMPO COM MESMO ID NO FORME CASO ENCONTRE
//ERÁ PREENCHER COM O VALOR ORIUNDO DA API
const showData = (result) => {
    for (const campo in result) {
        if (document.querySelector("#" + campo)) {
            //VERIFICAMOS SE O CAMPO SE TRATA DE UMA DATA
            if (campo == "data_inicio_atividade") {
                //CONVERTEMOS A DATA PARA O FORMATO BRASILEIRO
                document.querySelector("#" + campo).value = result[campo].split('-').reverse().join('/');
            } else {
                document.querySelector("#" + campo).value = result[campo];
            }
        }
    }
}
//SELECIONAMOS O CPNJ PARA EFETUAR A BUSCA PELO DADOS CADASTRAIS DA EMPRESA
cnpj.addEventListener("blur", (e) => {
    let search = cnpj.value.replace("-", "").replace(".", "").replace("/", "");
    const options = {
        method: "GET",
        mode: "cors",
        cache: "default"
    }
    //PESQUISAMOS OS DADOS DA EMPRESA BRASIL API
    fetch(`https://brasilapi.com.br/api/cnpj/v1/${search}`, options)
        .then(response => {
            response.json()
                .then(data => showData(data))
        })
        .catch(e => console.log('Deu erro: ' + e.message()))
});

$(document).ready(function () {

    $("#cnpj").inputmask({
        mask: ['999.999.999-99', '99.999.999/9999-99'],
        keepStatic: true
    });

    $("#data_inicio_atividade").inputmask({
        mask: '99/99/9999'
    });
    $('#data_inicio_atividade').datepicker({
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