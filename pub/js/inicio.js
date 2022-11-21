var lc_http = 'https://',
    lc_domain = document.domain,
    lc_modulo = "/durazno/",
    lc_acceso = 'auth/',
    lc_gra = 'pub/gra/',
    lc_app = lc_http + lc_domain + lc_modulo + lc_acceso,
    lc_url_grafico = lc_http + lc_domain + lc_modulo + lc_gra,
    leer_dni, leer_clave, nro_registros, json_encontrados, filas;

function validar_usuario(lc_dni, lc_clave) {
    var etiqueta_aviso = $("#msj_aviso"),
        data_validar = { "dni": lc_dni, "clave": lc_clave };
    $.ajax({
        data: data_validar,
        dataType: 'json',
        url: lc_app + 'validar/verificar_ingreso_usuario',
        type: 'post',
        beforeSend: function() {
            etiqueta_aviso.html("<center><img src='" + lc_url_grafico + "/cargando.gif' width='180' height='13'></center>");
        },
        success: function(json_encontrados) {
            etiqueta_aviso.html("");
            console.log(json_encontrados);
            nro_registros = json_encontrados.length;
            if (nro_registros > 0) {
                json_encontrados.forEach(function(filas) {
                    if (filas.encontro === '1') {
                        var lc_apellidos_nombres = filas.apellidos_nombres;
                        etiqueta_aviso.html("<center><strong><font color='#162939'>Bienvenido : " + lc_apellidos_nombres + "<br> </font><strong></center>").show();
                        setInterval(function() {
                            window.location.href = lc_app + 'app';
                        }, 1000);

                    } else {
                        etiqueta_aviso.html("<center><strong><font color='#162939'>Usuario no existe o clave incorrecta o desactivado...</font><strong></center>").show();
                        setInterval(function() {
                            etiqueta_aviso.html("<center><strong><font color='#162939'>Usuario no existe o clave incorrecta o desactivado...</font><strong></center>").hide("slow");
                        }, 3000);
                    }
                });
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            alert('Error, Revisar consola ');
            console.log('jqXHR:');
            console.log(jqXHR);
            console.log('textStatus:');
            console.log(textStatus);
            console.log('errorThrown:');
            console.log(errorThrown);
        }
    });

}

$(document).ready(function() {
    $('.crear-tooltip').tooltip();
    $('#dni').val('').focus();
    $('#clave').val('');
    $('#dni').keypress(function(e) {
        if (e.which === 13) {
            $('#clave').focus();
        }
    });
    $('#ingresar').click(function() {
        lc_dni = $('#dni').val();
        lc_clave = $('#clave').val();
        if (lc_dni == "" || lc_clave == "") {
            $("#msj_aviso").html("<center><strong><font color='#162939'>Nombre de usuario y/o clave vacia...</font><strong></center>").show();
            setInterval(function() {
                $("#msj_aviso").html("<center><strong><font color='#162939'>Nombre de usuario y/o clave vacia...</font><strong></center>").hide("slow");
            }, 3000);
        } else {
            validar_usuario(lc_dni, lc_clave);
        }
    });

});