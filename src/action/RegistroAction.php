<?php

namespace action;

abstract class RegistroAction {

    public static final function registraUsuarioExecute($json) {
        $array = \utils\JJUtils::parseJsonToArray($json);
        $bo = new \bo\AltaBO();
        return \utils\JJUtils::parseArrayToJson($bo->registraUsuario($array));
    }
    
    public static final function registraClienteExecute($json){
        $array = \utils\JJUtils::parseJsonToArray($json);
        $array['tipo'] = 'C';
        return \utils\JJUtils::parseArrayToJson($array);
    }
    
    public final static function muestraUsuarios($json){
        $bo = new \bo\AltaBO();
        $array = \utils\JJUtils::parseJsonToArray($json);
        return \utils\JJUtils::parseArrayToJson($bo->muestraUsuariosBO($array));
    }  
}
?>