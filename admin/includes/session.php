<?php

class Session {

    private $signed_in = false;
    public $user_id, $message, $username, $count, $rights;

    function __construct() {
        session_start();
        $this->visitor_count();
        $this->check_the_login();
        $this->check_message();
    }

    public function visitor_count() {
        if(isset($_SESSION['count'])) {
            return $this->count = $_SESSION['count']++;
        } else {
            return $_SESSION['count'] = 1;
        }
    }

    public function message($msg='') {
        if (!empty($msg)) {
            $_SESSION['message'] = $msg;
        } else {
            return $this->message;
        }
    }

    public function check_message() {
        if(isset($_SESSION['message'])) {
            $this->message = $_SESSION['message'];
            unset($_SESSION['message']);
        } else {
            $this->message = '';
        }
    }

    //Getter
    public function is_signed_in(){
        return $this->signed_in;
    }

    public function login($user) {
        if ($user) {
            $this->user_id = $_SESSION['user_id'] = $user-> id;
            $this->username = $user->username;
            $this->rights = $_SESSION['rights'] = $user->rights;
            $this->signed_in = true;
        }
    }

    public function logout() {
        unset($_SESSION['user_id']);
        unset($_SESSION['rights']);
        unset($this->user_id);
        unset($this->rights);
        $this->signed_in = false;
    }

    //Checks if user is signed in and sets user_id
    private function check_the_login() {
        if (isset($_SESSION['user_id'])) {
            $this->user_id = $_SESSION['user_id'];
            $this->rights = $_SESSION['rights'];
            $this->signed_in = true;
        } else {
            unset($this->user_id);
            unset($this->rights);
            $this->signed_in = false;
        }
    }





}

$session = new Session();