<?php

require_once ('db_config.php');

class Database {

    public $connection;

    //auto-connection
    function __construct() {
        $this->open_db_connection();
    }

    //Connection function with global constants
    public function open_db_connection() {
        //procedural
//        $this->connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

        //oop
        $this->connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

        if ($this->connection->connect_errno) {
            die('Database connection has failed' . $this->connection->connect_error);
        }
    }

    //function to make queries to db
    public function query($sql) {
        $result = $this->connection->query($sql);
        $this->confirm_query($result);
        return $result;
    }

    //confirmation of queries - kills query and shows error when failed
    private function confirm_query($result) {
        if (!$result) {
            die('Query has failed' . $this->connection->connect_error);
        }
    }

    //escaping strings
    public function escape_string($string) {
        return $escaped_string = $this->connection->real_escape_string($string);
    }

    public function the_insert_id() {
        return $this->connection->insert_id;
    }

}

$database = new Database();