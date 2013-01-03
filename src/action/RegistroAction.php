<?php

namespace action;

/**
 * Description of RegistroAction
 *
 * @author silent
 */
class RegistroAction {

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
    
}

?>
