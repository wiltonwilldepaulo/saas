$(document).ready(function () {

    let btn = document.querySelector("#btn-salvar");

    btn.onclick = function () {
        $.ajax({
            type: "post",
            url: "controleproprio",
            data: { dado: "teste" },
            //contentType: 'application/json',
            success: function (response) {

            }
        });
    }
});