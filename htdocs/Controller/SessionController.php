<?php

class SessionController
{
    public static function RegisterSession($id, $username)
    {
        $_SESSION["username"] = $username;
        $_SESSION["user_id"] = $id;
    }
}