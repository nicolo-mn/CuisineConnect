<?php

require_once "ImageController.php";
require_once "InteractionController.php";
require_once "./core/Controller.php";

class PostController extends Controller
{
    public function addPost($image) {
        $result = (new ImageController())->addImage($image);
        if($result[0]) {
            if($this->db->insertPost($_SESSION["user_id"], $_POST["title"], $_POST["description"], $result[1])) {
                echo true;
            }
        }
    }

    public function getUserPosts($UserID) {
        $posts = $this->db->getUserPosts($UserID);
        return $posts;
    }

    public function getPosts() {
        $posts = $this->db->getPosts(SessionController::getInstance()->getSessionUserID());
        foreach ($posts as &$post) {
            $post["Commenti"] = InteractionController::getInstance()->getCommentsFromPost($post["PostID"]);
        }

        return $posts;
    }

    public function getMentionedPosts($UserID) {
        $posts = $this->db->getMentionedPosts($UserID);
        echo json_encode($posts);
    }
}