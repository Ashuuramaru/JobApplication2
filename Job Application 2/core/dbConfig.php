<?php 

$host = "localhost";
$user = "root";
$password = "";
$dbname = "eugenio3";

$dsn = "mysql:host={$host};dbname={$dbname}";
$pdo = new PDO($dsn, $user, $password);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$pdo->exec("SET time_zone = '+08:00';");

?>
