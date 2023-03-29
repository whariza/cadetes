<?php

namespace App\Models;


use mysqli;

class Contact{
    protected $db_host = DB_HOST;
    protected $db_user = DB_USER;
    protected $db_pass = DB_PASSWORD;
    protected $db_name = DB_NAME;

    protected $connection;

    public function __construct()
    {
        $this->connection();
    }

    public function connection(){
        $this->connection = new mysqli();

        //video 61  conexion con la ddbb
    }
}