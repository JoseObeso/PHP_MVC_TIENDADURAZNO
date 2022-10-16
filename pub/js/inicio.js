var url = window.parent.location.href;
// http://localhost/durazno/auth/


$(document).ready(function() {
    $("#msj_aviso").html("<center>-- Bienvenidos--</center>").show();


    $("#ingresar").click(function() {
        var lc_dni = $('#dni').val(),
            lc_clave = $('#clave').val();
        console.log(lc_dni);
        console.log(lc_clave);



    })


});