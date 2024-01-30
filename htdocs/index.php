<?php
require_once 'bootstrap.php';
require_once 'routes.php';

echo password_hash("pass", PASSWORD_DEFAULT);