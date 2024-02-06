<?php

require_once "./core/Controller.php";

class SessionController extends Controller
{
    public static function RegisterSession($id, $username)
    {
        $_SESSION["username"] = $username;
        $_SESSION["user_id"] = $id;
    }

    public function getSessionUser() {
        if(isset($_SESSION["username"])){
            return $_SESSION["username"];
        }

        return false;
    }

    public function getSessionUserID() {
        if(isset($_SESSION["user_id"])){
            return $_SESSION["user_id"];
        }

        return false;
    }

    public function logout() {
        session_destroy();
        header('Location: ' . "login");
    }
}