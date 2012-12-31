<?php
namespace action;
class LoginAction {
    public static final function loginExecute($json){
        $bo = new \bo\LoginBO();
        $login = \utils\JJUtils::parseJsonToArray($json);
        return \utils\JJUtils::parseArrayToJson($bo->autentification($login['user'], $login['password']));
    }
}

?>
