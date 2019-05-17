<?php

class Conexao {

    private static $instance;

    private function __construct() {
        //
    }

    public static function getInstance() {
        if (!isset(self::$instance)) {
            self::$instance = new PDO('mysql:host=localhost;dbname=id9282948_scc', '', '');
        }

        return self::$instance;
    }

}
