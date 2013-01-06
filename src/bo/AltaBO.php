<?php
namespace bo;
/**
 * Description of AltaBO
 * @author Angel Barrientos <uetiko@gmail.com>
 */
class AltaBO {
    private $logger;
    public function __construct() {
        $this->logger = \utils\JJLogger::InstanceOfJJLogger();
    }
    
    public function registraUsuario(array $params){
        $result = NULL;
        $dao = new \dao\RegistroDAO();
        switch ($params['tipo']) {
            case 'E':
                $result = $this->getMensajeRegistro($dao->registraEmpleado($params));
                break;
            case 'C':
                $result = $this->getMensajeRegistro($dao->registraCliente($params));
                break;
        }
        return $result;
    }
    
    private function getMensajeRegistro($boolean){
        $msg = array('success' => '', 'msg' => '');
        if($boolean){
            $msg['success'] = 'success';
            $msg['msg'] = 'Se ha registrado el usuario.';
        }  else {
            $msg['success'] = 'fail';
            $msg['msg'] = 'No se pudo registrar el usuario.';
        }
        return $msg;
    }
    
    public function muestraUsuariosBO($tipoUsuario){
        $dao = new \dao\RegistroDAO();
        $result = array();
        switch ($tipoUsuario['tipo']) {
            case 'E':
                $result = $dao->getUsuarios(2);
                break;
            case 'C':
                $result = $dao->getUsuarios(3);
                break;
        }
        return array("success" => "success", "datos" => $result);      
    }
}
?>