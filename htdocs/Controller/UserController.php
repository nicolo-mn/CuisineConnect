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

    public function loadMyProfile() {
        /** @var Database $db */
        $db = $GLOBALS['db'];
        $user = $db->getUser($_SESSION["user_id"]);
        // metti in templateparams
        $GLOBALS["templateParams"] = array_merge($GLOBALS["templateParams"], $user[0]);
        //fai il render
        var_dump($GLOBALS["templateParams"]);
        Renderer::render("account.php");
    }

}