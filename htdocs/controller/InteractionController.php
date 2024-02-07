<?php

require_once "core/Controller.php";

class InteractionController extends Controller
{
    public function getCommentsFromPost($postID)
    {
        return $this->db->getCommentsFromPost($postID);
    }

    public function notifyFollow($followingUserID, $followedUserID)
    {
        return $this->db->notifyFollow($followingUserID, $followedUserID);
    }

    public function loadNotifications()
    {
        $notifications = $this->db->getNotifications(SessionController::getInstance()->getSessionUserID());
        $GLOBALS["templateParams"]["Notifiche"] = $notifications;
        $this->db->readNotifications(SessionController::getInstance()->getSessionUserID());
    }

    public function getTextFromNotificationType($type)
    {
        switch ($type) {
            case "Segui":
                return "ha iniziato a seguirti";
            case "Like":
                return "ha messo like ad un tuo post";
            case "Commento":
                return "ha commentato un tuo post";
            case "Menzione":
                return "ti ha menzionato in un post";
            default:
                return "notification type not found";
        }
    }

    public function likePost($request)
    {
        $this->db->likePost($request["post"], SessionController::getInstance()->getSessionUserID());
    }

    public function removeLike($request)
    {
        $this->db->removeLike($request["post"], SessionController::getInstance()->getSessionUserID());
    }

    public function likeList($request)
    {
        $this->db->likeList($request["post"]);
    }

    public function addComment($request)
    {
        $this->db->addComment(SessionController::getInstance()->getSessionUserID(), $request["comment"], $request["post"]);
    }

    public function updateComment($request)
    {
        $this->db->updateComment($request["commentID"], SessionController::getInstance()->getSessionUserID(), $request["commentText"]);
    }

    public function removeComment($request)
    {
        $this->db->removeComment($request["comment"], SessionController::getInstance()->getSessionUserID());
    }
}