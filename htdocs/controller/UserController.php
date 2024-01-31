<?php
include_once "SessionController.php";
require_once "./core/Controller.php";
class UserController extends Controller
{
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

    public function loadUserProfile($username) {
        /** @var Database $db */
        $db = $GLOBALS['db'];
        $user = $db->getUser($username);
        $GLOBALS["templateParams"] = array_merge($GLOBALS["templateParams"], $user[0]);
        Renderer::render("profile.php");
    }

    public function loadEditProfile() {
        /** @var Database $db */
        $db = $GLOBALS['db'];
        $user = $db->getUser($_SESSION["username"]);
        $GLOBALS["templateParams"] = array_merge($GLOBALS["templateParams"], $user[0]);
        Renderer::render("editprofile.php");
    }

    public function isUserFollowed() {
        /** @var Database $db */
        $db = $GLOBALS['db'];
        $followed = $db->getFollowID($_SESSION["user_id"], $GLOBALS["templateParams"]["UserID"]);
        return !empty($followed);
    }

}