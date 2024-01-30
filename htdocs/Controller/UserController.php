<?php
include_once "SessionController.php";
class UserController
{
    public function __construct()
    {
    }

    public function registerUser($request): bool
    {
        /** @var Database $db */
        $db = $GLOBALS['db'];
        if($db->insertUser(
            $request["username"],
            $request["email"],
            password_hash($request["password"], PASSWORD_DEFAULT)
        )) {
            $this->login($request);
            return true;
        }
        return false;
    }

    public function login($request)
    {
        /** @var Database $db */
        $db = $GLOBALS['db'];
        if($result = $db->login($request["username"])){
            $user = $result[0];
            if (password_verify($request["password"], $user["Password"])){
                SessionController::RegisterSession($user["UserID"], $request["username"]);
                header("Location:/");
            }
        }
    }

}