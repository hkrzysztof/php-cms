<?php

class User {

    public $id, $username, $password, $first_name, $last_name;

    public static function find_all_users() {
        global $database;
//        return $result_set = $database->query("SELECT * FROM users");
        return self::find_this_query("SELECT * FROM users");
    }

    public static function find_by_id($id) {
        global $database;
        $the_result_array = self::find_this_query("SELECT * FROM users where id = $id");

        return !empty($the_result_array) ? array_shift($the_result_array) : false;

//        if(!empty($the_result_array)) {
//            $first_item_of_the_array = array_shift($the_result_array);
//            return $first_item_of_the_array;
//        } else {
//            return false;
//        }
    }


    public static function find_this_query($sql) {
        global $database;
        $result_set = $database->query($sql);
        $obj_array = array();

        while($row = mysqli_fetch_array($result_set)) {
            $obj_array[] = self::instantiation($row);
        }
        return $obj_array;
    }

    public static function instantiation($row) {
        $the_obj = new self;

//        $the_obj->id = $user_found['id'];
//        $the_obj->username = $user_found['username'];
//        $the_obj->password = $user_found['password'];
//        $the_obj->first_name = $user_found['first_name'];
//        $the_obj->last_name = $user_found['last_name'];

        foreach ($row as $attribute => $value) {
            if($the_obj->has_the_attribute($attribute)) {
                $the_obj->$attribute = $value;
            }
        }
        return $the_obj;
    }

    private function has_the_attribute($attribute) {
        //Gets vars assigned to obj
        $obj_properties = get_object_vars($this);

        //returns true or false if attribute exists in obj_properties
        return array_key_exists($attribute, $obj_properties);
    }
}