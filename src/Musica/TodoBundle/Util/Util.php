<?php

namespace Musica\TodoBundle\Util;

/**
 * Description of Util
 *
 * @author Oswaldo
 */
class Util {
    
    static public function getUCWord($word) {
        return ucwords($word);
    }
    
    static public function getMyDump($array) {
        echo "<pre>";
        print_r($array);
        echo "</pre>";
        die();
    }
    
    static public function getMyDumpJSON($array) {
        echo "<pre>";
        echo json_encode($array);
        echo "</pre>";
        die();
    }
    
    static public function getJSON($array) {
        return json_encode($array);
    }
    
}
