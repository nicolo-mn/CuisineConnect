<?php

require_once "./core/Controller.php";

class SessionController extends Controller
{
    public static function RegisterSession($id, $username)
    {
        $_SESSION["username"] = $username;
        $_SESSION["user_id"] = $id;
    }
}