<?php
namespace dao;
use \Exception;
/**
 * Description of LoginDAO
 *
 * @author Angel Barrientos <uetiko@gmail.com>
 */
class LoginDAO {
    private $conn;
    private $logger;
    private $conf;

    public function __construct() {
        $this->conf = \config\DBConfig::getInstance();
        $this->conn = new \utils\Connection($this->conf->getUser(), $this->conf->getPassword(), $this->conf->getHost(), $this->conf->getPort(), $this->conf->getDBName());
        $this->logger = \utils\JJLogger::InstanceOfJJLogger();
    }
    
    public function Autentificar($user, $password){
        $data = array();
        $this->conn->openPersistentMysqlConnection();
        $query = "select  count(user) as user, c.id_user_type as type from user u, cat_user_type c where u.id_user_type = c.id_user_type and u.user = '$user' and u.password = '$password';";
        $result = mysql_query($query, $this->conn->getMysqlConnection());
        while ($row = mysql_fetch_array($result)) {
            $data = $row;
        }
        return $data;
    }
    public function createSession($user, $password, $token){
        $update = "UPDATE user SET token = '$token' WHERE user = '$user' and password = '$password';";
        $this->conn->openPersistentMysqlConnection();
        try{
            $result = mysql_query($update, $this->conn->getMysqlConnection());
        }  catch (\Exception $e){
            $this->logger->log($e->getTraceAsString(), mysql_error($this->conn->getMysqlConnection()), 'SEVERE');
            $result = FALSE;
        }
        return $result;
    }
}
?>