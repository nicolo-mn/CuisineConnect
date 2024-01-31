<?php

require_once "ImageController.php";
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

    public function getUserPosts() {
        /** @var Database $db */
        $posts = $this->db->getPosts($GLOBALS["templateParams"]["UserID"]);
        return $posts;
    }

    public function getPosts() {

    }
}