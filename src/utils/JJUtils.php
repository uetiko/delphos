<?php
namespace utils;
/**
 * Description of JJUtils
 *
 * @author Angel Barrientos <uetiko@gmail.com>
 */
abstract class JJUtils {
    public final static function createToken(){
        return substr(sha1(date('dmYHis') . rand(10000, 99999)), 0, 15);
    }
    /**
     * parsea una cadena json a un array
     * @param string $json String en formato json
     * @return array regresa un arreglo asociativo
     */
    public final static function parseJsonToArray($json) {
        return self::clearDataArray(json_decode($json, TRUE));
    }
    /**
     * Parsea un array a una cadena en formaro json
     * @param array $data un arreglo de datos
     * @return string regresa una cadena en formato json
     */
    public final static function parseArrayToJson(array $data){
        return json_encode($data);
    }
}
?>