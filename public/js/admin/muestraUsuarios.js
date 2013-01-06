function initEvents(){
    muestraUsuarios();
}


function muestraUsuarios(){
    $("#usuarios").hide();
    $('#send').click(function(){
        var registro = {
            tipo        : $('select#tipo option:selected').val()
        }
        registro = JSON.stringify(registro);
        $.ajax({
            url : 'http://tienda.local.mx/cgi.php',
            dataType : 'json',
            type : 'POST',
            data : {
                peticion : true,
                action : 'muestraEmpleados',
                json : registro
            },
            success : function(response, textStatus, jqXHR){
                $("#usuarios").hide();
                if(response.success == "success"){
                    var table = "<table border=1><tr><td>";
                    table += "<label>id</label><td><label>UserName</label></td><td><label>Nombre</label></td>";
                    table += "<td><label>Apellido</label></td><td><label>Correo</label></td>";
                    table += "<td><label>Direccion</label></td><td><label>Pais</label></td>";
                    table += "<td><label>Estado</label></td><td><label>telefono</label></td></tr><tr>";
                    for(var i = 0; i < response.datos.length; i++){
                        table += "<td><label>" + response.datos[i].id_user + "</label></td>";
                        table += "<td><label>" + response.datos[i].user + "</label></td>";
                        table += "<td><label>" + response.datos[i].nombre + "</label></td>";
                        table += "<td><label>" + response.datos[i].apellido + "</label></td>";
                        table += "<td><label>" + response.datos[i].correo + "</label></td>";
                        table += "<td><label>" + response.datos[i].direccion + "</label></td>";
                        table += "<td><label>" + response.datos[i].pais + "</label></td>";
                        table += "<td><label>" + response.datos[i].telefono + "</label></td>";
                    }
                    table += "</tr></table>";
                    $("#usuarios").html(table);
                    $("#usuarios").show();
                }else{
                    
                }
            },
            error : function(response, textStatus, jqXHR){
                alert(textStatus);
            }
        });
    });
}