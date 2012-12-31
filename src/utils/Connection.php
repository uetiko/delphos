<?php
namespace utils;
/**
 * Clase de conexion a postgres y mysql
 * @version 0.5.0
 * @author Angel Barrientos Cruz <uetiko@gmail.com>
 * @package com.ife.chart.dao
 * @license http://www.gnu.org/copyleft/lesser.html Distributed under the Lesser General Public License (LGPL)
 * @copyright 2012
 */
class Connection {
    protected $host;
    protected $port;
    protected $user;
    protected $pass;
    protected $db;
    protected $linkpg;
    protected $linkmysql;
    protected $log;

    /**
     * Constructor general de clase de conexion a la base de datos
     *	@param $user Ususario de la base de datos
     *	@param $pass password de la base de datos
     */
    public function __construct($user, $pass, $host, $port, $db) {
        $this -> host = $host;
        $this -> port = $port;
        $this -> user = $user;
        $this -> pass = $pass;
        $this -> db = $db;
        $this -> log = \utils\JJLogger::InstanceOfJJLogger();
    }

    /**
     * Abre una conexión a postgres
     */
    public function openPgConnection() {
        $stringConnection = "host=" . $this -> host . " port=" . $this -> port . " dbname=" . $this -> db . " user=" . $this -> user . " password=" . $this -> pass;
        if (!($this -> linkpg = pg_connect($stringConnection))) {
            $this -> log -> log(pg_last_error(), "Error al conectar con la base de datos postgres", "SEVERE");
            exit();
        }
    }

    /**
     * Funcion beta que abre conexionesPersistentes a postgres
     */
    public function openPersistentPgConnection() {
        $stringConnection = "host=" . $this -> host . " port=" . $this -> port . " dbname=" . $this -> db . " user=" . $this -> user . " password=" . $this -> pass;
        if (!($this -> linkpg = pg_pconnect($stringConnection))) {
            $this -> log -> log(pg_last_error(), "Error al intentar abrir la conexión persistente en postgres", "SEVERE");
        }
    }

    /**
     * Da la instancia de la conexión.
     */
    public function getPgConnection() {
        return $this -> linkpg;
    }

    /**
     * Abre una conexión a MySQL
     */
    public function openMysqlConnection() {
        if (!($this -> linkmysql = mysql_connect($this -> host, $this -> user, $this -> pass))) {
            $this -> log -> log(mysql_error(), "Error al concectar a la base de datos Mysql", "SEVERE");
            exit();
        } elseif (!mysql_select_db($this -> db, $this -> linkmysql)) {
            $this -> log -> log(mysql_error(), "Error al seleccionar el esquema Notificaciones_voto en mysql", "SEVERE");
            exit();
        }
    }

    /**
     * Abre conexiones persistentes a Mysql
     */
    public function openPersistentMysqlConnection() {
        if (!($this -> linkmysql = mysql_pconnect($this -> host, $this -> user, $this -> pass))) {
            $this -> log -> log(mysql_error(), "Error al concectar a la base de datos Mysql", "SEVERE");
            exit();
        } elseif (!mysql_select_db($this -> db, $this -> linkmysql)) {
            $this -> log -> log(mysql_error(), "Error al seleccionar el esquema Notificaciones_voto en mysql", "SEVERE");
            exit();
        }
    }

    public function getMysqlConnection() {
        return $this -> linkmysql;
    }

    /**
     * Cierra la conexión a MySQL
     */
    public function closeCnnMysql() {
        if (!mysql_close($this -> linkmysql)) {
            $this -> log -> log(mysql_error(), "Error al cerrar la conexion.", "SEVERE");
        }
    }

    /**
     * Cierra la conexion a postgres
     */
    public function closeCnnPg() {
        if (!pg_close($this -> linkpg)) {
            $this -> log -> log(mysql_error(), "Error al cerrar la conexion", "SEVERE");
        }
    }

}
?>
