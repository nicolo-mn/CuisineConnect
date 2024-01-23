<?php
session_start();
require_once("model/database.php");
$db = new Database("localhost", "root", "toor", "SocialNetworkDB", 3306);