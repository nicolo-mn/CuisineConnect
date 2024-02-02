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

    public function loadUserProfile($username) {
        $user = $this->db->getUser($username);
        $GLOBALS["templateParams"] = array_merge($GLOBALS["templateParams"], $user[0]);
        Renderer::render("profile.php");
    }

    public function loadEditProfile() {
        $user = $this->db->getUser($_SESSION["username"]);
        $GLOBALS["templateParams"] = array_merge($GLOBALS["templateParams"], $user[0]);
        Renderer::render("editprofile.php");
    }

    public function isUserFollowed($followedUserID) {
        $followed = $this->db->getFollowID($_SESSION["user_id"], $followedUserID);
        return !empty($followed);
    }

    public function changeUserFollowStatus($followedUserID) {
        if($this->isUserFollowed($followedUserID)) {
            $this->db->unfollowUser(SessionController::getInstance()->getSessionUserID(), $followedUserID);
        } else {
            $this->db->followUser(SessionController::getInstance()->getSessionUserID(), $followedUserID);
            InteractionController::getInstance()->notifyFollow(SessionController::getInstance()->getSessionUserID(), $followedUserID);
        }
    }

    public function updateProfile($nome, $bio) {
        $this->db->updateProfile(SessionController::getInstance()->getSessionUserID(), $nome, $bio);
        header("Location:/profile");
    }

    public function searchUserFromString($searchString, $username) {
        $users = $this->db->searchUserFromString($searchString, $username);
        echo json_encode(array_values($users));
    }

    public function getUserID($username) {
        $user = $this->db->getUser($username);
        return $user[0]["UserID"];
    }
}