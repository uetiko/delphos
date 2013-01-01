<?php
namespace bo;
/**
 * Description of LoginBO
 *
 * @author silent
 */
class LoginBO {
    
    public function autentification($user, $password){
        $dao = new \dao\LoginDAO();
        $msg;
        $result = $dao->Autentificar($user, sha1($password));
        if($result['user'] != 0){
            $token = \utils\JJUtils::createToken();
            $dao->createSession($user, sha1($password), $token);
            $msg = array('success' => 'success', 'token' => $token, "usr" => $user);
        }else{
            $msg = array('success' => 'fail', "msg" => 'nombre de usuario o password incorrectos');
        }
        return $msg;
    }
}

?>
