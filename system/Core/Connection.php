<?php

namespace system\Core;

use Exception;
use PDO;

use PDOException;

class Connection {

    private static $instance;

    public static function getInstance()
    {
        if(empty(self::$instance)){
            try {
                self::$instance = new PDO(
                    'mysql: host='.DB_HOST.'; port='.DB_PORT.';dbname='.DB_NAME,
                     DB_USER, DB_PASSWORD,[
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
                        PDO::ATTR_CASE => PDO::CASE_NATURAL
                     ]);

            } catch ( PDOException $e) {
                die("Erro de conexão".$e->getMessage());
            }
            return self::$instance;
        }
    }

    protected function __construct()
    {
        
    }

    private function __clone(): void
    {

    }
}