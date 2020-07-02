<?php
require_once 'core/Database.php';

class Model
{
    protected $database;

    public function __construct()
    {
        $param = parse_ini_file($_SERVER['DOCUMENT_ROOT'].'/conf/db.ini');
        $this->database = new Database($param['host'], $param['user'], $param['password'], $param['database']);
    }
}