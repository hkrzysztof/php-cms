<?php

class Db_object {
    public $tmp_path;
    public $errors = array();
    public $upload_errors = array(
        UPLOAD_ERR_OK => 'No error occured',
        UPLOAD_ERR_INI_SIZE => "The uploaded file's size exceeds the upload_max_filesize",
        UPLOAD_ERR_FORM_SIZE => "The uploaded file's size exceeds the MAX_FILE_SIZE",
        UPLOAD_ERR_PARTIAL => "The file was uploaded only partially",
        UPLOAD_ERR_NO_FILE => "No file uploaded",
        UPLOAD_ERR_NO_TMP_DIR => "Temporary directory not found",
        UPLOAD_ERR_CANT_WRITE => "Atempt to write to disk has failed",
        UPLOAD_ERR_EXTENSION => "PHP extension has stopped the upload"
    );

    public function picture_path() {
        return $this->upload_dir . DS . $this->filename;
    }

    public function set_file($file) { //$_FILES['name_of_uploaded_file'] as an argument
        if (empty($file) || !$file || !is_array($file)) {
            $this->errors[] = 'No file uploaded';
            return false;
        } elseif ($file['error'] !=0) {
            $this->errors[] = $this->upload_errors[$file['error']];
            return false;
        } else {
            $this->filename = basename($file['name']);
            $this->tmp_path = $file['tmp_name'];
            $this->type = $file['type'];
            $this->size = $file['size'];
        }
    }


    public function save_with_image() {
        if($this->id && isset($this->title)) {
            $this->update();
        } else {
            if (!empty($this->errors)) {
                return false;
            }

            if (empty($this->filename) || empty($this->tmp_path)) {
                $this->errors[] =  'Wrong file uploaded';
                return false;
            }

            $target_path = SITE_ROOT . DS . 'admin' . DS . $this->upload_dir . DS . $this->filename;

            if (file_exists($target_path)) {
                $this->errors[] = 'File duplicate';
                return false;
            }

            if (move_uploaded_file($this->tmp_path, $target_path)) {
                if ($this->save()) {
                    unset($this->tmp_path);
                    return true;
                }

            } else {
                $this->errors[] = 'Unknown error has occured';
                return false;
            }

        }
    }


    //finds all users
    public static function find_all() {
        global $database;
        return static::find_query("SELECT * FROM " . static::$db_table);
    }

    
    //finds user by ID
    public static function find_by_id($id) {
        global $database;
        $the_result_array = static::find_query("SELECT * FROM " . static::$db_table . " where id = " . $database->escape_string($id));
        return !empty($the_result_array) ? array_shift($the_result_array) : false;
    }


    //Makes the query, fetches the array and assigns it to an empty array
    public static function find_query($sql) {
        global $database;
        $result_set = $database->query($sql);
        $obj_array = array();

        while($row = mysqli_fetch_array($result_set)) {
            $obj_array[] = static::instantiation($row);
        }
        return $obj_array;
    }


    //Makes new instance of object and assigns all available attributes - returns object with assigned attributes
    public static function instantiation($row) {
        $calling_class = get_called_class();
        $the_obj = new $calling_class;

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

    
    //gets properties from db_table
    protected function get_properties() {
        $properties = array();

        foreach (static::$db_table_fields as $db_field) {
            if (property_exists($this, $db_field)) {
                $properties[$db_field] = $this->$db_field;
            }
        }
        return $properties;
    }


    //escapes properties
    protected function clean_properties() {
        global $database;
        $clean_properties = array();

        foreach ($this->get_properties() as $key => $value) {
            $clean_properties[$key] = $database->escape_string($value);
        }

        return $clean_properties;
    }


    //DB CRUD
    //create db entry
    public function create() {
        global $database;
        $properties = $this->clean_properties();

        $sql = "INSERT INTO " . static::$db_table . "(" . implode(",", array_keys($properties)) . ")";
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

        $sql = "UPDATE " . static::$db_table . " SET ";
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

        $sql = "DELETE FROM " . static::$db_table . " WHERE id = " . $database->escape_string($this->id) . " LIMIT 1";

        return $database->query($sql) ? true : false;
    }

    //END OF DB CRUD

    public static function count_all() {
        global $database;

       return count(static::find_query("SELECT * FROM " . static::$db_table));

    }

    public static function count_all_by_user($username) {
        global $database;
        return count(static::find_query("SELECT * FROM " . static::$db_table . " WHERE author = '" . $username . "'"));

    }
}