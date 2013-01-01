function initEvents(){
    loginFnc();
}

function loginFnc(){
    $("#loginBtn").click(function(){
        var flag = true;
        
        if(campoVacio($("#usuario").val())){
            $("#usuarioAlert").html('Campo obligatorio.');
            $("#usuarioAlert").show();
            flag = false;
        } 
        if(campoVacio($("#password").val())){
            $("#passwordAlert").html("Campo obligatorio.");
            $("#passwordAlert").show();
            flag = false;
        }
        if(flag){
            var login ={
                usuario : $("#usuario").val(),
                password : $("#password").val()
            }
            login = JSON.stringify(login);
            $.ajax({
                url : 'http://tienda.local.mx/cgi.php',
                dataType : 'json',
                type : 'POST',
                data : {
                    peticion : true,
                    action : 'login',
                    json : login
                },
                complete : function(response, textStatus, jqXHR){
                    
                },
                success : function(response, textStatus, jqXHR){
                    if(response.success == "success"){
                        $.cookie("usuario", response.usr);
                        $.cookie("token", response.token);
                        document.cookie;
                        $(window).attr('location', 'admin/dashboard.html');
                    }else{
                        alert(response.msg);
                    }
                },
                error : function(response, textStatus, jqXHR){
                    alert(textStatus);
                }
            });
        }
    });
}