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
//RETORNA UMA PROMESSA
function send(url, options) {
    return fetch(url, options);
}
//FUNÇÃO DE CADASTRAMENTO DE ENDEREÇOS.
async function adiciona_endereco() {
    //RECEBEMOS A AÇÃO INICIAL ANTERIOS AO ENVIO DO FORM
    let acao = document.getElementById("edtacao").value;
    document.getElementById("edtacao").value = "c";
    const proprio = document.getElementById("frmproprio");
    const form = new FormData(proprio);
    const options = {
        method: 'POST',
        mode: 'cors',
        body: form,
        cache: 'default'
    }
    try {
        //RECEBEMOS O RESULTADO DA VALIDAÇÃO DO FORMULARIO
        const valida = await $('#frmproprio').valid();
        //VERICAMOS SE A VALIDAÇÃO FOI EFETUADA COM SUCESSO.
        if (valida) {
            //APOS TERMINAR RECEBEMOS O RETORNO DA FUNÇÃO
            const result = await send(`controleendereco`, options);
            document.getElementById("edtacao").value = acao;
            //APOS RECEBERMOS O RETORNO DA FUNÇÃO TENTAMOS CONVERTER PRA JSON
            const data = await result.json();
            //VERIFICAMOS SE OUVE SUCESSO AO CONVERTER PARA JSON
            if (data.status == true) {
                alerta(0, 'Endereço adicionado com sucesso!', 'Sucesso!', '');
                lista_endereco();
            } else {
                alerta(1, 'Falha ao adicionar o endereço ' + error.message(), 'Falha!', '');
            }
        }
    } catch (error) {
        console.log(error);
    }
}
//FUNÇÃO DE CADASTRAMENTO DE CONTATO
async function adiciona_contato() {
    //RECEBEMOS A AÇÃO INICIAL ANTERIOS AO ENVIO DO FORM
    let acao = document.getElementById("edtacao").value;
    document.getElementById("edtacao").value = "c";
    const proprio = document.getElementById("frmproprio");
    const form = new FormData(proprio);
    const options = {
        method: 'POST',
        mode: 'cors',
        body: form,
        cache: 'default'
    }
    try {
        //RECEBEMOS O RESULTADO DA VALIDAÇÃO DO FORMULARIO
        const valida = await $('#frmproprio').valid();
        //VERICAMOS SE A VALIDAÇÃO FOI EFETUADA COM SUCESSO.
        if (valida) {
            //APOS TERMINAR RECEBEMOS O RETORNO DA FUNÇÃO
            const result = await send(`controlecontato`, options);
            document.getElementById("edtacao").value = acao;
            //APOS RECEBERMOS O RETORNO DA FUNÇÃO TENTAMOS CONVERTER PRA JSON
            const data = await result.json();
            //VERIFICAMOS SE OUVE SUCESSO AO CONVERTER PARA JSON
            if (data.status == true) {
                alerta(0, 'Contato adicionado com sucesso!', 'Sucesso!', '');
                lista_contato();
            } else {
                alerta(1, 'Falha ao adicionar o contato ' + error.message(), 'Falha!', '');
            }
        }
    } catch (error) {
        console.log(error);
    }
}
//SELECIONAMOS O TIPO DE CONTATO
const tipocontato = document.querySelector("#tipocontato");
//SELECIONAMOS A ABA DE ENDEREÇO
const tstendereco = document.querySelector("#tb-endereco");
//SELECIONAMOS A ABA DE CONTATOS
const tstcontato = document.querySelector("#tb-contato");
//SELECIONAMOS O CNPJ
const cnpj = document.querySelector("#cnpj");
//SELECIONAMOS O BOTÃO DE ADICIONAR ENDERECO.
const addc_endereco = document.querySelector("#btnendereco");
//SELECIONAMOS O BOTÃO DE ADICIONAR CONTATO.
const addc_contato = document.querySelector("#btncontato");
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
//MAPEAMOS O EVENTO DE MUDANÇÃ DO CAMPO
tipocontato.addEventListener("blur", () => {
    switch (tipocontato.value) {
        case 'celular':
            document.getElementById("enderecocontato").type = 'text';
            $("#enderecocontato").inputmask({
                mask: ['(99) 9999[9]-9999']
            });
            break;
        case 'whatsapp':
            document.getElementById("enderecocontato").type = 'text';
            $("#enderecocontato").inputmask({
                mask: ['(99) 9999[9]-9999']
            });
            break;
        case 'telegram':
            document.getElementById("enderecocontato").type = 'text';
            $("#enderecocontato").inputmask({
                mask: ['(99) 9999[9]-9999']
            });
            break;
        case 'telefone':
            document.getElementById("enderecocontato").type = 'text';
            $("#enderecocontato").inputmask({
                mask: ['(99) 9999-9999']
            });
            break;
        case 'email':
            document.getElementById("enderecocontato").type = 'email';
            $("#enderecocontato").inputmask({
                mask: ['']
            });
            break;
        case 'facebook':
            document.getElementById("enderecocontato").type = 'url';
            $("#enderecocontato").inputmask({
                mask: ['']
            });
            break;
        case 'instagram':
            document.getElementById("enderecocontato").type = 'url';
            $("#enderecocontato").inputmask({
                mask: ['']
            });
            break;
    }
});
addc_endereco.addEventListener('click', () => {
    adiciona_endereco();
});
addc_contato.addEventListener('click', () => {
    adiciona_contato();
});
//FUNÇÃO DE LISTAGEM DE ENDEREÇOS
async function lista_endereco() {
    //LIMPA TODOS OS CAMPO DO FORUMULARIO DE CADASTRO DE ENDEREÇOS
    document.getElementById("cep").value = '';
    document.getElementById("logradouro").value = '';
    document.getElementById("numero").value = '';
    document.getElementById("complemento").value = '';
    document.getElementById("bairro").value = '';
    document.getElementById("localidade").value = '';
    document.getElementById("uf").value = '';
    document.getElementById("ibge").value = '';
    document.getElementById("titulo").value = '';
    //HABILITAMOS A VISIBILIDADE DO SPINER CARREGADO
    document.getElementById("carregando").className = 'col-12';
    let act = document.getElementById("edtacao").value;
    //ALTERAMOS O VALOR DA AÇÃO PARA LISTAGEM    
    document.getElementById("edtacao").value = "l";
    //SELECIONAMOS OS NOVOS VALORES DO FORMULARIO
    const formulario = document.getElementById("frmproprio");
    const frm = new FormData(formulario);
    const opt = {
        method: 'POST',
        mode: 'cors',
        body: frm,
        cache: 'default'
    }
    //RECEBEMOS A REPOSTA DE TODOS ENDEREÇOS CADASTRADOR
    const lista = await send(`controleendereco`, opt);
    //CONVERTEMOS O ENDEREÇO PARA TEXTO
    const html = await lista.text();
    //ATRIBUIMOS O HTML DO ENDEREÇO PARA LIST-GROUP
    document.getElementById("lista").innerHTML = html;
    //COLOCAMOS O VALOR PADRÃO NO CAMPO AÇÃO
    document.getElementById("edtacao").value = act;
    //DESABILITAMOS A VISIBILIDADE DO SPINER CARREGADO
    document.getElementById("carregando").className = 'col-12 d-none';
}
//FUNÇÃO DE LISTAGEM DE ENDEREÇOS
async function lista_contato() {
    document.getElementById("tipocontato").value = '';
    document.getElementById("titulocontato").value = '';
    document.getElementById("enderecocontato").value = '';
    //HABILITAMOS A VISIBILIDADE DO SPINER CARREGADO
    document.getElementById("carregandocontato").className = 'col-12';
    let act = document.getElementById("edtacao").value;
    //ALTERAMOS O VALOR DA AÇÃO PARA LISTAGEM    
    document.getElementById("edtacao").value = "l";
    //SELECIONAMOS OS NOVOS VALORES DO FORMULARIO
    const formulario = document.getElementById("frmproprio");
    const frm = new FormData(formulario);
    const opt = {
        method: 'POST',
        mode: 'cors',
        body: frm,
        cache: 'default'
    }
    //RECEBEMOS A REPOSTA DE TODOS ENDEREÇOS CADASTRADOR
    const lista = await send(`controlecontato`, opt);
    //CONVERTEMOS O ENDEREÇO PARA TEXTO
    const html = await lista.text();
    //ATRIBUIMOS O HTML DO ENDEREÇO PARA LIST-GROUP
    document.getElementById("listacontato").innerHTML = html;
    //COLOCAMOS O VALOR PADRÃO NO CAMPO AÇÃO
    document.getElementById("edtacao").value = act;
    //DESABILITAMOS A VISIBILIDADE DO SPINER CARREGADO
    document.getElementById("carregandocontato").className = 'col-12 d-none';
}
//AO CLICAR NO TAB DE ENDEREÇOS ATUALIZAMOS A LISTA DE ENDEREÇOS
tstendereco.addEventListener('click', () => {
    lista_endereco();
});
//AO CLICAR NO TAB DE CONTATOS ATUALIZAMOS A LISTA DE CONTATOS
tstcontato.addEventListener('click', () => {
    lista_contato();
});
//REMOVE O PROPRIO
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
//REMOVE O ENDEREÇO DO PROPRIO
async function remove_endereco(id) {
    //HABILITAMOS A VISIBILIDADE DO SPINER CARREGADO
    document.getElementById("carregando").className = 'col-12';
    document.getElementById("edtidendereco").value = id;
    let act = document.getElementById("edtacao").value;
    //ALTERAMOS O VALOR DA AÇÃO PARA EXCLUSÃO    
    document.getElementById("edtacao").value = "d";
    //SELECIONAMOS OS NOVOS VALORES DO FORMULARIO
    const formulario = document.getElementById("frmproprio");
    const frm = new FormData(formulario);
    const opt = {
        method: 'POST',
        mode: 'cors',
        body: frm,
        cache: 'default'
    }
    //RECEBEMOS A REPOSTA DA EXCLUSÃO DO ENDEREÇO
    const resulta = await send(`controleendereco`, opt);
    //CONVERTEMOS O ENDEREÇO PARA JSON
    const json = await resulta.json();
    console.log(json);
    //VERIFICAMOS SE O ENDEREÇO FOI EXCLUIDO
    if (json.status) {
        console.log("oi");
        $("#endereco" + id).remove();
    }
    //COLOCAMOS O VALOR PADRÃO NO CAMPO AÇÃO
    document.getElementById("edtacao").value = act;
    //DESABILITAMOS A VISIBILIDADE DO SPINER CARREGADO
    document.getElementById("carregando").className = 'col-12 d-none';
}
//REMOVE O CONTATO DO PROPRIO
async function remove_contato(id) {
    //HABILITAMOS A VISIBILIDADE DO SPINER CARREGADO
    document.getElementById("carregandocontato").className = 'col-12';
    document.getElementById("edtidcontato").value = id;
    let act = document.getElementById("edtacao").value;
    //ALTERAMOS O VALOR DA AÇÃO PARA EXCLUSÃO    
    document.getElementById("edtacao").value = "d";
    //SELECIONAMOS OS NOVOS VALORES DO FORMULARIO
    const formulario = document.getElementById("frmproprio");
    const frm = new FormData(formulario);
    const opt = {
        method: 'POST',
        mode: 'cors',
        body: frm,
        cache: 'default'
    }
    //RECEBEMOS A REPOSTA DA EXCLUSÃO DO CONTATO
    const resulta = await send(`controlecontato`, opt);
    //CONVERTEMOS O ENDEREÇO PARA JSON
    const json = await resulta.json();
    console.log(json);
    //VERIFICAMOS SE O ENDEREÇO FOI EXCLUIDO
    if (json.status) {
        $("#enderecocontato" + id).remove();
    }
    //COLOCAMOS O VALOR PADRÃO NO CAMPO AÇÃO
    document.getElementById("edtacao").value = act;
    //DESABILITAMOS A VISIBILIDADE DO SPINER CARREGADO
    document.getElementById("carregandocontato").className = 'col-12 d-none';
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