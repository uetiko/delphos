/**
 * @author Angel angel@pengostores.com
 */
function validaCorreo(correo){
    if(/^[a-z]+@[a-z]+\.[a-z]{2,4}|\.[a-z]{2,4}$/.test(correo)){
        return true;
    }else{
        return false;
    }
}

function validaPassword(password){
    return /(?!^[0-9]*$)(?!^[a-zA-Z]*$)^([a-zA-Z0-9]{8,10})$/.test(password);
}

function confirmacionPassword(p1, p2){
    if(p1 === p2){
        return true;
    }else{
        return false;
    }
}

function campoVacio(campo){
    if($.trim(campo) === ""){
        return true;
    }else{
        return false
    }
}

function usuarioExiste(){
    $("input#usuario").keypress(function(){
        var usr = $("input#usuario").val();
        if(usr.length > 3){
            $.ajax({
                url : "",
                dataType: 'json',
                type : 'post',
                data : {
                    datos : usr
                },
                complete : function(response, textStatus, jqXHR){
                    
                },
                success : function(response, textStatus, jqXHR){
                    
                },
                error : function(response, textStatus, jqXHR){
                    
                }
            });
        }
    });
}