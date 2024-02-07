<?php

require_once "core/Controller.php";

class RecipeController extends Controller {
    public function loadUserRecipes($UserID) {
        $recipes = $this->db->getUserRecipes($UserID);
        $GLOBALS["templateParams"]["Ricette"] = $recipes;
        Renderer::render("myrecipes.php");
    }

    public function loadUserRecipesIDs() {
        return $this->db->getUserRecipesIDs(SessionController::getInstance()->getSessionUserId());
    }

    public function addRecipe($UserID, $RecipeName, $RecipeProcess, $RecipeIngredients, $RecipeNutrients) {
        $this->db->addRecipe($UserID, $RecipeName, $RecipeProcess, $RecipeIngredients, $RecipeNutrients);
    }

    public function getRecipeByID($recipeID) {
        return $this->db->getRecipeByID($recipeID);
    }

    public function deleteRecipe($recipeID) {
        $this->db->deleteRecipe($recipeID);
    }
}