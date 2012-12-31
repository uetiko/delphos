<?php
namespace utils;

include_once realpath(__DIR__ . '/../config/LogConfig.php');
include_once realpath(__DIR__ . '/../lib/spyc/Spyc.php');
#Prototipo de log de errores en php
/**
 * Clase para la creación de logs
 * @author Angel Barrientos <uetiko@gmail.com>
 * @copyright 2012
 * @license http://www.gnu.org/copyleft/lesser.html Distributed under the Lesser General Public License (LGPL)
 * @version 0.5
 */

class JJLogger {
    /**
     * Variable estaca para insanciar JJLogger
     * @access private
     * @var static INSANCE
     */
    private static $INSTANCE = NULL;
    /**
     *Variable que guarda las configuraciones para JJLogger
     * @access private
     * @var Object
     */
    private $config;

    /**
     * Método que te permite crear diferentes logs.
     * @param string $err Nombre del log de errores.
     * @param string $note Nombre del log de notas.
     * @param string $query Nombre del log donde se guardan los querys y su descripción
     * @param string $dir Nombre del directorio donde se guardaran
     */
    private function __construct() {
        date_default_timezone_set('America/Mexico_City');
        $this->config = \Config\LogConfig::getInstance();
    }

    /**
     * Funcion para abrir el log y guardar el error que se genera
     * @access protected
     * @param $errorMsg Formato del mensaje de error creado.
     * @param $logName Nombre del log donde se va a guardar.
     * @return void
     */
    private function guardar($errorMsg, $logName) {
        if (is_dir($this->config->getDirLog())) {
            $logDir = $this->config->getDirLog() . "/" . $logName . ".log";
            try {
                $openDir = fopen($logDir, "a+");
                fwrite($openDir, $errorMsg);
                fclose($openDir);
            } catch (Exception $e) {
                $e->getMessage();
                $e->getTrace();
            }
        } else {
            mkdir($this->config->getDirLog(), 0777);
            $logDir = $this->config->getDirLog() . "/" . $logName . ".log";
            try {
                $openDir = fopen($logDir, "a+");
                fwrite($openDir, $errorMsg);
                fclose($openDir);
            } catch (Exception $e) {
                $e->getMessage();
                $e->getTrace();
            }
        }
    }

    /**
     * Método para definir el nivel del log
     * 
     * @param string $error Tipo de error
     * @param string $msg Mensaje relacionado al error
     * @param string $level Nivel del error. Niveles: SEVERE, WARNING, INFO, CONFIG, FINER, FINEST
     * @access public
     * @return void
     */
    public function log($error, $msg, $level) {
        $fech = date("d-m-Y h:i:s");
        $body = "[$fech] [$level] $msg\n$error\n\n";
        $this->guardar($body, $this->config->getErrorLog());
    }

    /**
     * Metodo para guardar los querys generados
     * @param string $query Query a guardar en el log
     * @param string $desc Descripcion relacionado al query
     * @access public
     * @return void
     */
    public function querys($query, $desc) {
        $fech = date("d-m-Y h:i:s");
        $body = "--[$fech]\n -- Descripcion: $desc\n $query\n\n";
        $this->guardar($body, $this->config->getQueryLog());
    }

    /**
     * Método para crear la cabecera del log para notas
     * deprecated
     * @access public
     * @param string $header texto para el encabezado
     * @return void
     */
    public function setHeaderNotes($header = null) {
        $fech = date("d-m-Y h:i:s");
        $desc = "[$fech]: $header \n";
        $this->guardar($desc, $this->config->getNoteLog());
    }

    /**
     * Método para crear la cabecera del log para notas
     * deprecated
     * @access public
     * @param string $data  a ser lanzado al log
     * @return void
     */
    public function setBodyNotes($data) {
        $this->guardar("$data\n", $this->config->getNoteLog());
    }

    /**
     * Método para el registro del autoload.
     * @access public
     * @param string $datos
     * @return void
     */
    public function autoLoadLogger($datos) {
        $this->guardar("$datos\n", $this->config->getAutoloadLog());
    }
    /**
     * Metodo para implementar el patron singleton
     * @access public
     * @return \utils\JJLogger
     */
    public static function InstanceOfJJLogger() {
        if (self::$INSTANCE instanceof \utils\JJLogger) {
            return self::$INSTANCE;
        } else {
            return self::$INSTANCE = new \utils\JJLogger();
        }
    }

}

?>
