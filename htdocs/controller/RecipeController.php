<?php

require_once "core/Controller.php";

class RecipeController extends Controller {
    public function loadUserRecipes($UserID) {
        $recipes = $this->db->getUserRecipes($UserID);
        $GLOBALS["templateParams"]["Ricette"] = $recipes;
        Renderer::render("myrecipes.php");
    }
}