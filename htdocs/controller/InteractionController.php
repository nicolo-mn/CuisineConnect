<?php

require_once "core/Controller.php";

class InteractionController extends Controller {
    public function getCommentsFromPost($postID){
        return $this->db->getCommentsFromPost($postID);
    }
}