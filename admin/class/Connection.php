<?php
require ('config-local.php');
abstract class Connection{

    private $conn;

    public function __construct(){
        $this->conect();
    }
  
    public function conect(){
        $this->conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
        mysqli_select_db($this->conn, DB_DATABASE);
        mysqli_set_charset($this->conn, 'utf8');
        return $this->conn;
    }
}