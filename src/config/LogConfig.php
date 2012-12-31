<?php
namespace config;
/**
 * Description of LogConfig
 * @author Angel Barrientos <uetiko@gmail.com>
 */
class LogConfig {
    private $properties;
    private static $INSTANCE = NULL;
    private function __construct() {
        $this->properties = \spyc\Spyc::YAMLLoad(realpath(__DIR__ . '/../resources/LogConfig.yml'));
    }
    
    public function getErrorLog(){
        return $this->properties['log']['error'];
    }
    
    public function getNoteLog(){
        return $this->properties['log']['note'];
    }
    
    public function getQueryLog(){
        return $this->properties['log']['query'];
    }
    
    public function getAutoloadLog(){
        return $this->properties['log']['autoloader'];
    }
    
    public function getDirLog(){
        return $this->properties['log']['dir'];
    }

        public static function getInstance(){
        if(self::$INSTANCE instanceof \Config\LogConfig){
            return self::$INSTANCE;
        }else{
            return self::$INSTANCE = new \Config\LogConfig();
        }
    }
}
?>