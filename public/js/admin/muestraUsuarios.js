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
                    table += "<label>UserName</label></td><td><label>Nombre</label></td>";
                    table += "<td><label>Apellido</label></td><td><label>Correo</label></td>";
                    table += "<td><label>Direccion</label></td><td><label>Pais</label></td>";
                    table += "<td><label>Estado</label></td><td><label>telefono</label></td></tr>";
                    for(var i = 0; i < response.datos.length; i++){
                        table += "<tr><td><label>" + response.datos[i].user + "</label></td>";
                        table += "<td><label>" + response.datos[i].nombre + "</label></td>";
                        table += "<td><label>" + response.datos[i].apellido + "</label></td>";
                        table += "<td><label>" + response.datos[i].correo + "</label></td>";
                        table += "<td><label>" + response.datos[i].direccion + "</label></td>";
                        table += "<td><label>" + response.datos[i].pais + "</label></td>";
                        table += "<td><label>" + response.datos[i].estado + "</label></td>";
                        table += "<td><label>" + response.datos[i].telefono + "</label></td>";
                        table += '<td><input type="button" id="' + response.datos[i].id_user + '" value="Eliminar" /></td></tr>';
                    }
                    table += "</tr></table>";
                    $("#usuarios").html(table);
                    eliminar();
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

function eliminar(){
    $('input').click(function(){
        var id = $(this);
        id = id[0].id;
        var obj = {
            id  : id
        }
        obj = JSON.stringify(obj);
        $.ajax({
            url : 'http://tienda.local.mx/cgi.php',
            dataType : 'json',
            type : 'POST',
            data : {
                peticion : true,
                action : 'eliminaUsuario',
                json : obj
            },
            success : function(response, textStatus, jqXHR){
                if(response.success == 'success'){
                    alert(response.msg);
                }else{
                    alert(response.msg);
                }
            },
            error : function(response, textStatus, jqXHR){
                alert(textStatus);
            }
        });
    });
}