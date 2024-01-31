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

$router->addRoute('GET', '/profile', function () {
    (new UserController)->loadMyProfile();
});

$router->addRoute('GET', '/user/{username}', function ($username) {
    (new UserController)->loadUserProfile($username);
});

$router->addRoute('GET', '/editprofile', function () {
    (new UserController)->loadEditProfile();
});

// POST routes
$router->addRoute('POST', '/register', function () {
    (new UserController())->registerUser($_POST);
});

$router->addRoute('POST', '/login', function () {
    (new UserController())->login($_POST);
});


$router->matchRoute();