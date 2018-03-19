<?php

class User extends Db_object {

    protected static $db_table = 'users';
    protected static $db_table_fields = ['username', 'password', 'first_name', 'last_name', 'rights', 'filename', 'created_at', 'last_modified'];
    public $id, $username, $password, $first_name, $last_name, $rights, $filename, $created_at, $last_modified;
    public $upload_dir = 'user_images';
    public $img_placeholder_link = 'http://via.placeholder.com/150x150?text=image';

    public function image_path_and_placeholder() {
        return empty($this->filename) ? $this->img_placeholder_link : $this->upload_dir . DS . $this->filename;
    }

    //function to verify user in the db
//    public static function verify_user($username, $password) {
//        global $database;
//        $username = $database->escape_string($username);
//        $password = $database->escape_string($password);
//
//        $sql = "SELECT * FROM " . self::$db_table . " WHERE username = '{$username}' AND password = '{$password}' LIMIT 1";
//
//        $the_result_array = self::find_query($sql);
//        return !empty($the_result_array) ? array_shift($the_result_array) : false;
//    }

    public static function verify_user_secure($username, $password) {
        global $database;
        $conn = $database->connection;
        $username = $database->escape_string($username);
        $password = $database->escape_string($password);


        $stmt = $conn->prepare("SELECT password FROM users WHERE username=? LIMIT 1");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $set_result = $stmt->get_result();
        $result = $set_result->fetch_assoc();
        $hashed_password = $result['password'];

        if (password_verify("$password", $hashed_password)) {
            $sql = "SELECT * FROM users WHERE username = ? LIMIT 1";
            $statement = $conn->prepare($sql);
            $statement->bind_param("s", $username);
            $statement->execute();
            $result_set = $statement->get_result();
            $obj_array = array();

            while($row = mysqli_fetch_array($result_set)) {
                $obj_array[] = static::instantiation($row);
            }
            return !empty($obj_array) ? array_shift($obj_array) : false;
        } else {
            return false;
        }
    }

    public function create_account_secure($username, $password, $first_name, $last_name) {
        global $database;
        $this->username = $username = $database->escape_string($username);
        $this->password = $password = $database->escape_string($password);
        $this->first_name = $first_name = $database->escape_string($first_name);
        $this->last_name = $last_name = $database->escape_string($last_name);
        $this->rights = $rights = 'subscriber';
        $this->created_at = $created_at = date('d-m-y H:i:s');
        $this->filename = $filename ='';
        $this->last_name = $last_modified='';


        $sql = "INSERT INTO users (username, password, first_name, last_name, rights, filename, created_at, last_modified) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $conn = $database->connection;
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssssss", $username, $password, $first_name, $last_name, $rights, $filename, $created_at, $last_modified);

        if($stmt->execute()) {
            $this->id = $database->the_insert_id();
            return true;
        } else {
            return false;
        }
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

    public static   function secured_hash($input)
    {
        $output = password_hash($input,PASSWORD_DEFAULT);
        return $output;
    }

}