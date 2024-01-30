<?php
require_once "core/Router.php";
require_once "core/Renderer.php";
require_once "Controller/UserController.php";
require_once "Controller/PostController.php";
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


$router->addRoute('GET', '/user/?', function () {
    Renderer::render("login.php");
});

// POST routes
$router->addRoute('POST', '/register', function () {
    (new UserController())->registerUser($_POST);
});

$router->addRoute('POST', '/login', function () {
    (new UserController())->login($_POST);
});

$router->addRoute('POST', '/submit-post', function () {
    (new PostController())->addPost($_FILES["file"]);
});

$router->matchRoute();