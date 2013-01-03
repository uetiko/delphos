<?php
namespace dao;
use \Exception;
class RegistroDAO {
    private $conn;
    private $logger;
    private $conf;
    public function __construct() {
        $this->conf = \config\DBConfig::getInstance();
        $this->conn = new \utils\Connection($this->conf->getUser(), $this->conf->getPassword(), $this->conf->getHost(), $this->conf->getPort(), $this->conf->getDBName());
        $this->logger = \utils\JJLogger::InstanceOfJJLogger();
    }
    
    public function registraEmpleado(array $params){
        $this->conn->openPersistentMysqlConnection();
        $insert = "insert into user(user, password, id_user_type) values({$params['usuario']}, {$params['pasword']}, 2);";
        $rslt = mysql_query($insert, $this->conn->getMysqlConnection());
        if($rslt == TRUE){
            $result = $this->getIdUser($params['usuario'], $params['pasword']);
            $insert = "insert into user_profile(id_user, id_user_status, nombre, apellido, correo, direccion, pais, estado, telefono) values({$result['id_user']}, 1, {$params['nombre']}, {$params['apellido']}, {$params['correo']}, {$params['direccion']}, {$params['pais']}, {$params['estado']}, {$params['telefono']});";
            return mysql_query($insert, $this->conn->getMysqlConnection());
            
        }
    }
    
    public function registraCliente(array $params){
        $this->conn->openPersistentMysqlConnection();
        $insert = "insert into user(user, password, id_user_type) values({$params['usuario']}, {$params['pasword']}, 3);";
        $rslt = mysql_query($insert, $this->conn->getMysqlConnection());
        if($rslt == TRUE){
            $result = $this->getIdUser($params['usuario'], $params['pasword']);
            $insert = "insert into user_profile(id_user, id_user_status, nombre, apellido, correo, direccion, pais, estado, telefono) values({$result['id_user']}, 1, {$params['nombre']}, {$params['apellido']}, {$params['correo']}, {$params['direccion']}, {$params['pais']}, {$params['estado']}, {$params['telefono']});";
            return mysql_query($insert, $this->conn->getMysqlConnection());
            
        }
    }
    
    public function actualizaEmpleado(){
        $update = "";
    }
    
    public function actualizaCliente(){
        
    }
    
    public function eliminaEmpleado(){
        
    }
    
    public function eliminaCliente(){
        
    }
    
    private function getIdUser($user, $password){
        $data = array();
        $this->conn->openPersistentMysqlConnection();
        $select = "select id_user from user where user = '$user' and password = '$password';";
        $result = mysql_query($select, $this->conn->getMysqlConnection());
        while ($row = mysql_fetch_assoc($result)) {
            $data = $row;
        }
        return $data;
    }
    
    public function getEmpleados(){
        
    }
    
    public function getClientes(){
        
    }
}
?>