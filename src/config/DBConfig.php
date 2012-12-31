<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DBConfig
 *
 * @author silent
 */
class DBConfig {
    /**
     * @access private
     * @var array proterties
     */
    private $properties;
    private static $INSTANCE = NULL;

    /**
     * @return void 
     * @access public
     */
    private function __construct() {
        $this->properties = \spyc\Spyc::YAMLLoad(realpath(__DIR__ . '/../resources/DBConfig.yml'));
    }

    /**
     * @return string Nombre de la base de datos.
     */
    public function getHost() {
        return $this->properties['base']['host'];
    }
    
    public function getPort(){
        return$this->properties['base']['puerto'];
    }

    /**
     * @return string Nombre de la base de datos
     */
    public function getDBName() {
        return $this->properties['base']['dbname'];
    }

    /**
     * @return string Nombre del usuario de la base de datos
     */
    public function getUser() {
        return $this->properties['base']['usuario'];
    }

    /**
     * @return string Password de la base de datos.
     * @access public
     */
    public function getPassword() {
        return $this->properties['base']['password'];
    }

    /**
     * @access private
     */
    public function __destruct() {
        $this->properties = NULL;
    }
    /**
     * 
     * @return \Config\config_ConfigDB Instancia de la clase config_ConfigDB
     */
    public static function getInstance(){
        if(!isset(self::$INSTANCE)){
            return self::$INSTANCE = new \Config\config_ConfigDB();
        }else{
            return self::$INSTANCE;
        }
    }
}

?>
