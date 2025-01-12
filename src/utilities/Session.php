<?php 
require_once ("./src/utilities/JWT.php");
session_start ();

class Session {
    static public function Start (array $payload) {
        $_SESSION["token"] = JWT::encode ($payload, getenv ("JWT_SECRET"));
    }
}
?>