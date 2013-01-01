

function getXHR(){
    var req = false;
    if(XMLHttpRequest){
        req = new XMLHttpRequest();
    }else{
        try{
            req = new ActiveXObject("MSXML2.XMLHTTP.3.0");
        }catch(e){
            window.console.log(e);
            req = false;
        }
    }
    return req;
}

function procesaPeticion(peticion){
    if(peticion.readyState == 4){
        if(peticion.status == 200){
            
        }
    }
}

function ajax(url, metodo, params){
    peticion = getXHR();
    peticion.open(metodo, url, true);
    peticion.onreadystatechange;
    peticion.send(params);
}