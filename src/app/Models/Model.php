<?php

namespace App\Models;

use App\DB\DB;
use PDOException;


class Model {

    private $db;

    public function __construct()
    {
        $this->db = (new DB)->connection();
    }

    protected function create($sql, $data)
    {
        $req = $this->db->prepare($sql);
        $req->execute($data);

        return $req->errorInfo();
    }

    public function exists($sql, $data)
    {
        $req = $this->db->prepare($sql);

        $req->execute($data);

        return $req->fetchAll();
    }

    public function __destruct()
    {
        $this->db = null;
    }
}