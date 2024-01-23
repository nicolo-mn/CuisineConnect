<?php
session_start();
define("UPLOAD_DIR", "./upload/");
require_once("model/database.php");
$db = new Database("localhost", "root", "toor", "SocialNetworkDB", 3306);