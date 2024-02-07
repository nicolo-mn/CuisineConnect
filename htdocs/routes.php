<?php
require_once "core/Router.php";
require_once "core/Renderer.php";
require_once "Controller/UserController.php";
require_once "Controller/PostController.php";
require_once "Controller/SessionController.php";
require_once "Controller/RecipeController.php";

$router = new Router();

// GET routes
$router->addRoute('GET', '/', function () {
    if (isset($_SESSION["username"])) {
        Renderer::render("home.php");
    } else {
        header('Location: ' . "login");
    }
});

$router->addRoute('GET', '/login', function () {
    Renderer::render("login.php");
});

$router->addRoute('GET', '/register', function () {
    Renderer::render("login.php");
});

$router->addRoute('GET', '/profile', function () {
    UserController::getInstance()->loadUserProfile(SessionController::getInstance()->getSessionUser());
});

$router->addRoute('GET', '/user/{username}', function ($username) {
    UserController::getInstance()->loadUserProfile($username);
});

$router->addRoute('GET', '/user\?id={id}&?name={name}', function ($id, $name) {
    SessionController::RegisterSession($id, $name);
});

$router->addRoute('GET', '/editprofile', function () {
    UserController::getInstance()->loadEditProfile();
});

$router->addRoute('GET', '/search', function () {
    Renderer::render("search.php");
});

$router->addRoute('GET', '/notifications', function () {
    InteractionController::getInstance()->loadNotifications();
    Renderer::render("notifications.php");
});

$router->addRoute('GET', '/recipes', function () {
    RecipeController::getInstance()->loadUserRecipes(SessionController::getInstance()->getSessionUserID());
});

$router->addRoute('GET', '/newrecipe', function () {
    Renderer::render("newrecipe.php");
});

$router->addRoute('GET', '/logout', function () {
    SessionController::getInstance()->logout();
});

// POST routes
$router->addRoute('POST', '/register', function () {
    UserController::getInstance()->registerUser($_POST);
});

$router->addRoute('POST', '/login', function () {
    UserController::getInstance()->login($_POST);
});

$router->addRoute('POST', '/submit-post', function () {
    PostController::getInstance()->addPost($_FILES["file"]);
});

$router->addRoute('POST', '/get-post', function () {
    PostController::getInstance()->getPostFullInfo($_POST);
});

$router->addRoute('POST', '/like-post', function () {
    InteractionController::getInstance()->likePost($_POST);
});

$router->addRoute('POST', '/remove-like', function () {
    InteractionController::getInstance()->removeLike($_POST);
});

$router->addRoute('POST', '/like-list', function () {

    InteractionController::getInstance()->likeList($_POST);
});

$router->addRoute('POST', '/add-comment', function () {
    InteractionController::getInstance()->addComment($_POST);
});

$router->addRoute('POST', '/update-comment', function () {
    InteractionController::getInstance()->updateComment($_POST);
});

$router->addRoute('POST', '/remove-comment', function () {
    InteractionController::getInstance()->removeComment($_POST);
});


$router->addRoute('POST', '/follow-unfollow', function () {
    UserController::getInstance()->changeUserFollowStatus(UserController::getInstance()->getUserID($_POST["username"]));
});

$router->addRoute('POST', '/update-profile', function () {
    UserController::getInstance()->updateProfile($_POST["nome"], $_POST["bio"], $_FILES["profile-image"]);
});

$router->addRoute('POST', '/search-user', function () {
    UserController::getInstance()->searchUserFromString($_POST["searchString"], $_SESSION["username"]);
});

$router->addRoute('POST', '/mentioned-posts', function () {
    $UserID = UserController::getInstance()->getUserID($_POST["username"]);
    PostController::getInstance()->getMentionedPosts($UserID);
});

$router->addRoute('POST', '/posted-posts', function () {
    $UserID = UserController::getInstance()->getUserID($_POST["username"]);
    echo json_encode(PostController::getInstance()->getUserPosts($UserID));
});

$router->addRoute('POST', '/add-recipe', function () {
    RecipeController::getInstance()->addRecipe(SessionController::getInstance()->getSessionUserID(),$_POST["recipeName"], $_POST["process"], $_POST["ingredients"], $_POST["nutrients"]);
});

$router->addRoute('POST', '/get-recipe', function () {
    echo json_encode(RecipeController::getInstance()->getRecipeByID($_POST["RecipeID"])[0]);
});


$router->matchRoute();