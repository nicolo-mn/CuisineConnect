<?php

require_once "core/Controller.php";

class InteractionController extends Controller {
    public function getCommentsFromPost($postID){
        return $this->db->getCommentsFromPost($postID);
    }

    public function notifyFollow($followingUserID, $followedUserID) {
        return $this->db->notifyFollow($followingUserID, $followedUserID);
    }

    public function loadNotifications() {
        $notifications = $this->db->getNotifications(SessionController::getInstance()->getSessionUserID());
        // echo "<p class=\"bg-light\">";
        // var_dump($notifications);
        // echo "</p>";
        $GLOBALS["templateParams"]["Notifiche"] = array_values($notifications);
        // $this->db->readNotifications(SessionController::getInstance()->getSessionUserID());
        Renderer::render("notifications.php");
    }

    public function getTextFromNotificationType($type) {
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
}