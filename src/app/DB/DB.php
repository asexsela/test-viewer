<?php

namespace App\DB;

use PDO;
use Exception;
use PDOException;

class DB {

    private $db;

    public function __construct()
    {
        if (is_null($this->db)) {
            try {
                $this->db = new PDO(
                    sprintf('mysql:host=%s;dbname=%s', getenv('DB_SERVER'), getenv('DB_NAME')),
                    getenv('DB_USERNAME'),
                    getenv('DB_PASSWORD')
                );
            } catch (PDOException $err) {
                throw new Exception("Ошибка подключения к базе - ".$err, 1);
            }
        }
    }

    public function connection()
    {
       return $this->db;
    }
}