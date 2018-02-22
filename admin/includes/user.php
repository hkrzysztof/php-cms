<?php

class User {

    protected static $db_table = 'users';
    protected static $db_table_fields = ['username', 'password', 'first_name', 'last_name'];
    public $id, $username, $password, $first_name, $last_name;

    //finds all users
    public static function find_all_users() {
        global $database;
        return self::find_this_query("SELECT * FROM " . self::$db_table);
    }

    //finds user by ID
    public static function find_by_id($id) {
        global $database;
        $the_result_array = self::find_this_query("SELECT * FROM " . self::$db_table . " where id = $id");
        return !empty($the_result_array) ? array_shift($the_result_array) : false;
    }

    //Makes the query, fetches the array and assigns it to an empty array
    public static function find_this_query($sql) {
        global $database;
        $result_set = $database->query($sql);
        $obj_array = array();

        while($row = mysqli_fetch_array($result_set)) {
            $obj_array[] = self::instantiation($row);
        }
        return $obj_array;
    }

    //function to verify user in the db
    public static function verify_user($username, $password) {
        global $database;
        $username = $database->escape_string($username);
        $password = $database->escape_string($password);

        $sql = "SELECT * FROM " . self::$db_table . " WHERE username = '{$username}' AND password = '{$password}' LIMIT 1";

        $the_result_array = self::find_this_query($sql);
        return !empty($the_result_array) ? array_shift($the_result_array) : false;
    }

    //Makes new instance of object and assigns all available attributes - returns object with assigned attributes
    public static function instantiation($row) {
        $the_obj = new self;

        // Assigns attributes and values to the obj ($the_obj->id = $user_found['id']; etc.)
        foreach ($row as $attribute => $value) {
            if($the_obj->has_the_attribute($attribute)) {
                $the_obj->$attribute = $value;
            }
        }
        return $the_obj;
    }

    //Instantiation function helper - checks if object attribute exists
    private function has_the_attribute($attribute) {
        //Gets vars assigned to obj
        $obj_properties = get_object_vars($this);

        //returns true or false if attribute exists in obj_properties
        return array_key_exists($attribute, $obj_properties);
    }

    protected function get_properties() {
        $properties = array();

        foreach (self::$db_table_fields as $db_field) {
            if (property_exists($this, $db_field)) {
                $properties[$db_field] = $this->$db_field;
            }
        }
        return $properties;
    }

    protected function clean_properties() {
        global $database;
        $clean_properties = array();

        foreach ($this->get_properties() as $key => $value) {
            $clean_properties[$key] = $database->escape_string($value);
        }

        return $clean_properties;
    }

    //db CRUD
    //create db entry
    public function create() {
        global $database;
        $properties = $this->clean_properties();

        $sql = "INSERT INTO " . self::$db_table . "(" . implode(",", array_keys($properties)) . ")";
        $sql .= " VALUES ('" .implode("','", array_values($properties)). "')";

        if($database->query($sql)) {
            $this->id = $database->the_insert_id();
            return true;
        } else {
            return false;
        }
    }

    //update db entry
    public function update() {
        global $database;
        $properties = $this->clean_properties();
        $property_pairs = array();

        foreach ($properties as $key => $value) {
            $property_pairs[] = "{$key}='{$value}'";
        }

        $sql = "UPDATE " . self::$db_table . " SET ";
        $sql .= implode(",", $property_pairs);
        $sql .= " WHERE id =" . $database->escape_string($this->id);

        $database->query($sql);

        return (mysqli_affected_rows($database->connection) == 1) ? true : false;
    }

    //If object already exists - updates it, if not - creates new one
    public function save() {
        return isset($this->id) ? $this->update() : $this->create();
    }

    //delete db entry
    public function delete() {
        global $database;

        $sql = "DELETE FROM " . self::$db_table . " WHERE id = " . $database->escape_string($this->id) . " LIMIT 1";

        return $database->query($sql) ? true : false;
    }



}