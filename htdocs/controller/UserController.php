<?php
include_once "SessionController.php";
require_once "./core/Controller.php";
class UserController extends Controller
{
    public function registerUser($request)
    {
        if (count($this->db->getUser($request["username"]))) {
            echo json_encode(false);
            return;
        }
        if($this->db->insertUser(
            $request["username"],
            $request["email"],
            password_hash($request["password"], PASSWORD_DEFAULT)
        )) {
            // $this->login($request);
            $userId = $this->db->getUser($request["username"])[0]["UserID"];
            SessionController::RegisterSession($userId, $request["username"]);
            echo json_encode(true);
        } else {
            // header("Location:/register");
            echo json_encode(false);
        }
    }

    public function login($request)
    {
        if($result = $this->db->login($request["username"])){
            $user = $result[0];
            if (password_verify($request["password"], $user["Password"])){
                SessionController::RegisterSession($user["UserID"], $request["username"]);
                echo json_encode(true);
            } else {
                echo json_encode(false);
            }
        } else {
            echo json_encode(false);
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

    public function updateProfile($nome, $bio, $profileImage) {
        $this->db->updateProfile(SessionController::getInstance()->getSessionUserID(), $nome, $bio);
        if (!empty($profileImage["name"])) {
            $result = ImageController::getInstance()->addImage($profileImage);
            if($result[0]) {
                $this->db->updateProfileImage(SessionController::getInstance()->getSessionUserID(), $result[1]);
            }
        }
        header("Location:/profile");
    }

    public function searchUserFromString($searchString, $username) {
        $users = $this->db->searchUserFromString($searchString, $username);
        echo json_encode($users);
    }

    public function getUserID($username) {
        $user = $this->db->getUser($username);
        return $user[0]["UserID"];
    }

    public function getFollowersList($userID) {
        return $this->db->getFollowersList($userID);
    }

    public function getFollowingList($userID) {
        return $this->db->getFollowingList($userID);
    }
}