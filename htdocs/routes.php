<?php
require_once "core/Router.php";
require_once "core/Renderer.php";
require_once "Controller/UserController.php";
require_once "Controller/PostController.php";
require_once "Controller/SessionController.php";

$router = new Router();

// GET routes
$router->addRoute('GET', '/', function () {
    if (isset($_SESSION["username"])) {
        Renderer::render("home.php");
    } else {
        header('Location: '."login");
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

$router->addRoute('GET', '/user\?name={name}&?surname={surname}', function ($name, $surname) {
    echo $name." ".$surname;
});

$router->addRoute('GET', '/editprofile', function () {
    UserController::getInstance()->loadEditProfile();
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

$router->matchRoute();