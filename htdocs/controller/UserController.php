<?php
include_once "SessionController.php";
require_once "./core/Controller.php";
class UserController extends Controller
{
    public function registerUser($request): bool
    {
        if($this->db->insertUser(
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
        if($result = $this->db->login($request["username"])){
            $user = $result[0];
            if (password_verify($request["password"], $user["Password"])){
                SessionController::RegisterSession($user["UserID"], $request["username"]);
                header("Location:/");
            }
        }
    }

    public function loadMyProfile() {
        $user = $this->db->getUser($_SESSION["username"]);
        $GLOBALS["templateParams"] = array_merge($GLOBALS["templateParams"], $user[0]);
        Renderer::render("profile.php");
    }

    public function loadUserProfile($username) {
        $user = $this->db->getUser($username);
        $GLOBALS["templateParams"] = array_merge($GLOBALS["templateParams"], $user[0]);
        Renderer::render("profile.php");
    }

    public function getPosts() {
        $posts = $this->db->getPosts($GLOBALS["templateParams"]["UserID"]);
        return $posts;
    }

    public function loadEditProfile() {
        $user = $this->db->getUser($_SESSION["username"]);
        $GLOBALS["templateParams"] = array_merge($GLOBALS["templateParams"], $user[0]);
        Renderer::render("editprofile.php");
    }

    public function getFollowers() {
        $followers = $this->db->getFollowers($GLOBALS["templateParams"]["UserID"])[0]["NumeroFollower"];
        return $followers;
    }

    public function getFollowing() {
        $followed = $this->db->getFollowing($GLOBALS["templateParams"]["UserID"])[0]["NumeroFollowing"];
        return $followed;
    }

    public function getPostsNumber() {
        $posts = $this->db->getPostsNumber($GLOBALS["templateParams"]["UserID"])[0]["NumeroPost"];
        return $posts;
    }

}