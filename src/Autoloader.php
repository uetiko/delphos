<?php
include_once realpath(__DIR__ . '/utils/JJLogger.php');
/**
 * Clase de Auto carga de clases bajo demanda capaz de leer namespaces y la 
 * convencion de ZendFramework 1
 * @author Claudio <claudio@pengostores.com>
 * @author Angel Barrientos <uetiko@gmail.com>
 */
class Autoloader {
    private $logger = NULL;
    /**
     * @access public
     * @return void 
     */
    public function __construct(){
        $this->logger = \utils\JJLogger::InstanceOfJJLogger();
    }
    /**
     * Se encarga de registrar las clases que se van necesitando.
     * @access public
     * @return boolean
     */
    public function registro(){
        //$this->logger->autoLoadLogger("ini_set: " . ini_set('unserialize_callback_func', 'spl_autoload_call'));
        ini_set('unserialize_callback_func', 'spl_autoload_call');
        return spl_autoload_register(array(new Autoloader, 'autoload'));
    }
    /**
     * @access public
     * @param string $classname el nombre de la clase
     * @return void 
     */
    public  function autoload($classname) {
        $tmp = $classname;
        $this->logger->autoLoadLogger($classname);
        $arrayClass = array_reverse(explode('\\', $classname));
        $classname = $arrayClass[0];
        $reverse = array_reverse(explode(DIRECTORY_SEPARATOR, dirname(__FILE__)));
        $base = array_splice($reverse, 1, count($reverse));
        $basefolder = implode(DIRECTORY_SEPARATOR, array_reverse($base));
        $sourceFile = implode(DIRECTORY_SEPARATOR, array($basefolder, 'src'));
        $libfolder = implode(DIRECTORY_SEPARATOR, array($sourceFile, 'lib'));
        
        $path = '';
        $namespace = '';
        $s = ($last = strripos($classname, '\\'));
        if (false !== ($last = strripos($classname, '\\'))) {
            $namespace = substr($classname, 0, $last);
            $classname = substr($classname, $last + 1);
            $path .= str_replace('\\', DIRECTORY_SEPARATOR, $namespace) . DIRECTORY_SEPARATOR;
        }elseif(false == ereg('_', $tmp)){
            $path .= str_replace('\\', DIRECTORY_SEPARATOR, $tmp) . '.php';
        }else{
            $path .= str_replace('_', DIRECTORY_SEPARATOR, $classname) . '.php';
        }
        $inbase = implode(DIRECTORY_SEPARATOR, array($basefolder, $path));
        $inlib = implode(DIRECTORY_SEPARATOR, array($libfolder, $path));
        $insrc = implode(DIRECTORY_SEPARATOR, array($sourceFile, $path));
        if (file_exists($inbase)) {
            $this->logger->autoLoadLogger("inbase: {$inbase}");
            require $inbase;
        } else if (file_exists($inlib)) {
            $this->logger->autoLoadLogger("inlib: {$inlib}");
             require $inlib;
        } else if (file_exists($insrc)) {
            $this->logger->autoLoadLogger("insrc: {$insrc}");
            require $insrc;
        }
    }   
}
?>
