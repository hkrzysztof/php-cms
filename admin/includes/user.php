<?php

class User extends Db_object {

    protected static $db_table = 'users';
    protected static $db_table_fields = ['username', 'password', 'first_name', 'last_name', 'filename', 'created_at', 'last_modified'];
    public $id, $username, $password, $first_name, $last_name, $filename, $created_at, $last_modified;
    public $upload_dir = 'user_images';
    public $img_placeholder_link = 'http://via.placeholder.com/150x150?text=image';

    public function image_path_and_placeholder() {
        return empty($this->filename) ? $this->img_placeholder_link : $this->upload_dir . DS . $this->filename;
    }

    //function to verify user in the db
    public static function verify_user($username, $password) {
        global $database;
        $username = $database->escape_string($username);
        $password = $database->escape_string($password);

        $sql = "SELECT * FROM " . self::$db_table . " WHERE username = '{$username}' AND password = '{$password}' LIMIT 1";

        $the_result_array = self::find_query($sql);
        return !empty($the_result_array) ? array_shift($the_result_array) : false;
    }


    //Method for jQuery Ajax (saving photo from modal)
    public function ajax_save_user_image($user_img, $user_id) {

        global $database;

        $user_img = $database->escape_string($user_img);
        $user_id = $database->escape_string($user_id);

        $this->filename = $user_img;
        $this->id = $user_id;

        $sql = "UPDATE " . self::$db_table . " SET filename = '{$this->filename}' WHERE id = {$this->id} ";
        $database->query($sql);

        echo $this->picture_path();
    }

    public static function find_all_user_images() {
        global $database;
        return static::find_query("SELECT filename FROM " . self::$db_table);
    }

}