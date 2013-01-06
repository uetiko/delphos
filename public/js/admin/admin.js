function initEvents(){
    registra();
}

function registra(){
    $('#creausuario').click(function(){
        var registro = {
            nombre      : $('#nombre').val(),
            apellido    : $('#apellido').val(),
            usuario     : $('#usuario').val(),
            password    : $('#password').val(),
            email       : $('#email').val(),
            telefono    : $('#telefono').val(),
            direccion   : $('#direccion').val(),
            pais        : $('#pais').val(),
            estado      : $('#estado').val(),
            tipo        : $('select#tipo option:selected').val()
        }
        registro = JSON.stringify(registro);
        $.ajax({
            url : 'http://tienda.local.mx/cgi.php',
            dataType : 'json',
            type : 'POST',
            data : {
                peticion : true,
                action : 'adminReistro',
                json : registro
            },
            success : function(response, textStatus, jqXHR){
                alert(textStatus);
            },
            error : function(response, textStatus, jqXHR){
                alert(textStatus);
            }
        });
    });
}