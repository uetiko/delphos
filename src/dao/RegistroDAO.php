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
        $insert = "insert into user(user, password, id_user_type) values('{$params['usuario']}', '{$params['password']}', 2);";
        $this->logger->querys($insert, "insert user");
        try{
            $rslt = mysql_query($insert, $this->conn->getMysqlConnection());
        }catch(\Exception $e){
            $this->logger->log($e->getTraceAsString(), $e->getMessage(), "SEVERE");
        }
        $this->logger->querys($rslt, "result inser user");
        if($rslt == 1){
            $result = $this->getIdUser($params['usuario'], $params['password']);
            $insert = "insert into user_profile(id_user, id_user_status, nombre, apellido, correo, direccion, pais, estado, telefono)"; 
            $insert .= " values({$result['id_user']}, 1, '{$params['nombre']}', '{$params['apellido']}', '{$params['correo']}', '{$params['direccion']}', '{$params['pais']}', '{$params['estado']}', '{$params['telefono']}');";
            return mysql_query($insert, $this->conn->getMysqlConnection());
        }
    }
    
    public function registraCliente(array $params){
        $this->conn->openPersistentMysqlConnection();
        $insert = "insert into user(user, password, id_user_type) values('{$params['usuario']}', '{$params['password']}', 3);";
        $this->logger->querys($insert, "insert user");
        $rslt = mysql_query($insert, $this->conn->getMysqlConnection());
        $this->logger->querys($rslt, "result inser user");
        if($rslt == 1){
            $result = $this->getIdUser($params['usuario'], $params['password']);
            $insert = "insert into user_profile(id_user, id_user_status, nombre, apellido, correo, direccion, pais, estado, telefono) values('{$result['id_user']}', 1, '{$params['nombre']}', '{$params['apellido']}', '{$params['email']}', '{$params['direccion']}', '{$params['pais']}', '{$params['estado']}', '{$params['telefono']}');";
            return mysql_query($insert, $this->conn->getMysqlConnection());
            
        }
    }
    
    public function actualizaEmpleado(){
        $update = "";
    }
    
    public function actualizaCliente(){
        
    }
    
    public function eliminaUsuario($id){
        $this->conn->openPersistentMysqlConnection();
        $rslt = FALSE;
        $delete1 = "delete from user_profile where id_user = $id";
        $delete2 = "delete from user where id_user = $id";
        try{
            mysql_query($delete1, $this->conn->getMysqlConnection());
            $rslt = mysql_query($delete2, $this->conn->getMysqlConnection());
            $rslt = TRUE;
        }  catch (\Exception $e){
            $this->logger->log($e->getTraceAsString(), mysql_error($this->conn->getMysqlConnection()), "SEVERE");
            $rslt = FALSE;
        }
        return $rslt;
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
    
    public function getUsuarios($tipo){
        $result = array();
        $this->conn->openPersistentMysqlConnection();
        $select = "select u.id_user, u.user, p.nombre, p.apellido, p.correo, p.direccion, p.pais, p.estado, p.telefono ";
        $select .= "from user u inner join user_profile p on u.id_user = p.id_user ";
        $select .= "where u.id_user_type = $tipo";
        $rstl = mysql_query($select, $this->conn->getMysqlConnection());
        while ($row = mysql_fetch_assoc($rstl)) {
            $result[] = $row;
        }
        return $result;
    }
}
?>