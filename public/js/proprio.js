//RETORNA UMA PROMESSA
function send(url, options) {
    return fetch(url, options);
}
//FUNÇÃO ASSINCRONA.
async function adiciona_endereco() {
    const proprio = document.getElementById("frmproprio");
    const form = new FormData(proprio);
    const options = {
        method: 'POST',
        mode: 'cors',
        body: form,
        cache: 'default'
    }
    try {
        const alerta = await document.querySelector();
        alert
        //APOS TERMINAR RECEBEMOS O RETORNO DA FUNÇÃO
        const result = await send(`controleendereco`, options);
        //APOS RECEBERMOS O RETORNO DA FUNÇÃO TENTAMOS CONVERTER PRA JSON
        const data = await result.json();
        //VERIFICAMOS SE OUVE SUCESSO AO CONVERTER PARA JSON
        if (data.status == true) {
            alert("Sucesso!");
        } else {
            alert("Falha!");
        } data
    } catch (error) {
        console.log(error);
    }
}
//SELECIONAMOS O CNPJ
const cnpj = document.querySelector("#cnpj");
//SELECIONAMOS O BOTÃO DE ADICIONAR ENDERECO.
const addc_endereco = document.querySelector("#btnendereco");
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

addc_endereco.addEventListener('click', () => {
    adiciona_endereco();
});

function deleta(id) {
    $("#edtid").val(id);
    const proprio = document.getElementById("proprio");
    alert(id);
    const form = new FormData(proprio);
    const options = {
        method: "post",
        mode: "cors",
        cache: "default",
        body: form
    }
    //PESQUISAMOS OS DADOS DA EMPRESA BRASIL API
    fetch(`controleproprio`, options)
        .then(response => {
            response.json()
                .then(data => {
                    $("#" + id).remove();
                })
        })
        .catch(e => console.log('Deu erro: ' + e.message()))
    return false;
}

$(document).ready(function () {
    const cadastroEndereco = (result) => {
        document.getElementById('edtacao').value = result;
    }
    const showEndereco = (result) => {
        for (const campo in result) {
            if (document.querySelector("#" + campo)) {
                document.querySelector("#" + campo).value = result[campo]
            }
        }
    }


    $("#cep").blur(function () {
        let search = document.getElementById("cep").value.replace("-", "");
        const option = {
            method: 'GET',
            mode: 'cors',
            cache: 'default'
        }
        fetch(`https://viacep.com.br/ws/${search}/json/`, option)
            .then(response => {
                response.json()
                    .then(data => showEndereco(data))
            })
            .catch(e => console.log('Deu erro : ' + e.message()));
    });

    $("#cnpj").inputmask({
        mask: ['999.999.999-99', '99.999.999/9999-99'],
        keepStatic: true
    });
    $("#cep").inputmask({
        mask: ['99999-999'],
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
                    if (document.getElementById('edtacao').value == 'c') {
                        if (response != 'false') {
                            $('html, body').animate({ scrollTop: 0 }, 'slow');
                            //COLOCAMOS O ID DA EMPRESA CADASTRADA NA URL
                            window.history.pushState('Object', 'Categoria JavaScript', 'proprio?id=' + response);
                            //CHAMAMOS A FUNÇÃO DE CONTROLE DE ALERTAS PARA EXEBIR A MSG DE SUCESSO
                            alerta(0, 'Cadastro realizado com sucesso!', 'Sucesso!', '');
                        } else {
                            //CHAMAMOS A FUNÇÃO DE CONTROLE DE ALERTAS PARA EXEBIR A MSG DE FALHA NA ROTINA
                            alerta(0, 'Falha no cadastro!', 'Falha!', '');
                        }

                    } else if (document.getElementById('edtacao').value == 'e') {
                        if (response != 'false') {
                            $('html, body').animate({ scrollTop: 0 }, 'slow');
                            //CHAMAMOS A FUNÇÃO DE CONTROLE DE ALERTAS PARA EXEBIR A MSG DE SUCESSO
                            alerta(0, 'Alterações realizado com sucesso!', 'Sucesso!', 'listaproprio');
                        } else {
                            //CHAMAMOS A FUNÇÃO DE CONTROLE DE ALERTAS PARA EXEBIR A MSG DE FALHA NA ROTINA
                            alerta(0, 'Falha ao aplicar as alterações!', 'Falha!', 'listaproprio');
                        }
                    }
                }
            });
        }
    });
    //FILE INPUT DO LOGO E DO ICONE.
    $("#edtlogo").fileinput({});
    $("#edticone").fileinput({});
});