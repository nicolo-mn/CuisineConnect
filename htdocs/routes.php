<?php
require_once "core/Router.php";
require_once "core/Renderer.php";
require_once "Controller/UserController.php";
$router = new Router();

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

$router->addRoute('POST', '/register', function () {
    (new UserController)->registerUser($_POST);
});

$router->addRoute('POST', '/login', function () {
    (new UserController)->login($_POST);
});

$router->addRoute('GET', '/var', function () {
    var_dump($_GET["name"]);
});

$router->matchRoute();