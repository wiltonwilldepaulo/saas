$(document).ready(function () {
    $.ajax({
        type: "post",
        url: "controleproprio",
        data: { "edtnome": "WILTON WILL DE PAULO" },
        success: function (response) {
            alert(response);
        }
    });
});