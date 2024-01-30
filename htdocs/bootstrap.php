<?php
session_start();
require_once("model/database.php");
$GLOBALS['db'] = new Database("localhost", "root", "toor", "SocialNetworkDB", 3306);
$GLOBALS['templateParams'] = array();