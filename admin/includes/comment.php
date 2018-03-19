<?php

class Comment extends Db_object {

    protected static $db_table = 'comments';
    protected static $db_table_fields = ['photo_id', 'author', 'body', 'created_at'];
    public $id, $photo_id, $author, $body, $created_at;

//    public static function create_comment($photo_id, $author = 'Anonymous', $body) {
//        global $database;
//        if (!empty($photo_id) && !empty($author) && !empty($body)) {
//            $comment = new Comment();
//
//            $comment->photo_id = $database->escape_string($photo_id);
//            $comment->author = $database->escape_string($author);
//            $comment->body = $database->escape_string($body);
//
//            return $comment;
//        } else {
//            return false;
//        }
//}

    public static function find_by_photo_id($photo_id) {
        global $database;
        return static::find_query("SELECT * FROM " . static::$db_table . " where photo_id = " . $database->escape_string($photo_id));
    }

    public function create_comment_secure($photo_id, $author, $body) {
        global $database;
        $this->photo_id = $photo_id = $database->escape_string($photo_id);
        $this->author = $author = $database->escape_string($author);
        $this->body = $body = $database->escape_string($body);
        $this->created_at = $created_at = date('d-m-y H:i:s');


        $sql = "INSERT INTO comments (photo_id, author, body, created_at) VALUES (?, ?, ?, ?)";
        $conn = $database->connection;
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("isss", $photo_id, $author, $body, $created_at);

        if($stmt->execute()) {
            $this->id = $database->the_insert_id();
            return true;
        } else {
            return false;
        }
    }

}