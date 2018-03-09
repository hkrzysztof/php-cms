<?php

class Photo extends Db_object {

    protected static $db_table = 'photos';
    protected static $db_table_fields = ['title', 'description', 'filename', 'alt_text', 'type', 'size', 'created_at', 'last_modified', 'author'];
    public $id, $title, $description, $filename, $alt_text, $type, $size, $created_at, $last_modified, $author;
    public $upload_dir = 'images';

    public function delete_photo() {
        if($this->delete()) {
            $target_path = SITE_ROOT . DS . 'admin' . DS . $this->picture_path();
            return unlink($target_path) ? true : false;
        } else {
            return false;
        }
    }





}