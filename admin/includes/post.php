<?php

class Post extends Db_object {

    protected static $db_table = 'posts';
    protected static $db_table_fields = ['author', 'title', 'body', 'created_at', 'last_modified'];
    public $id, $author, $title, $body, $created_at, $last_modified;

}

