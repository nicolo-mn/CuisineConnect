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

    public function loadMyProfile() {
        /** @var Database $db */
        $db = $GLOBALS['db'];
        $user = $db->getUser($_SESSION["username"]);
        $GLOBALS["templateParams"] = array_merge($GLOBALS["templateParams"], $user[0]);
        Renderer::render("profile.php");
    }

    public function loadUserProfile($username) {
        /** @var Database $db */
        $db = $GLOBALS['db'];
        $user = $db->getUser($username);
        $GLOBALS["templateParams"] = array_merge($GLOBALS["templateParams"], $user[0]);
        Renderer::render("profile.php");
    }

    public function getPosts() {
        /** @var Database $db */
        $db = $GLOBALS['db'];
        $posts = $db->getPosts($GLOBALS["templateParams"]["UserID"]);
        return $posts;
    }

    public function loadEditProfile() {
        /** @var Database $db */
        $db = $GLOBALS['db'];
        $user = $db->getUser($_SESSION["username"]);
        $GLOBALS["templateParams"] = array_merge($GLOBALS["templateParams"], $user[0]);
        Renderer::render("editprofile.php");
    }

    public function getFollowers() {
        /** @var Database $db */
        $db = $GLOBALS['db'];
        $followers = $db->getFollowers($GLOBALS["templateParams"]["UserID"])[0]["NumeroFollower"];
        return $followers;
    }

    public function getFollowing() {
        /** @var Database $db */
        $db = $GLOBALS['db'];
        $followed = $db->getFollowing($GLOBALS["templateParams"]["UserID"])[0]["NumeroFollowing"];
        return $followed;
    }

    public function getPostsNumber() {
        /** @var Database $db */
        $db = $GLOBALS['db'];
        $posts = $db->getPostsNumber($GLOBALS["templateParams"]["UserID"])[0]["NumeroPost"];
        return $posts;
    }

}