<?php

require_once 'config.php';

$user = "root";
$pass = $dbPassword;
$pdo = new PDO('mysql:host=localhost;dbname=serenatto', $user, $pass);

