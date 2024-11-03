<?php
session_start();

$host = "localhost";
$user = "root";
$password = "";
$dbname = "third-year-midterm-exam"; //database name
$dsn = "mysql:host={$host};dbname={$dbname}";

$pdo = new PDO($dsn, $user, $password);
$pdo->exec("SET time_zone = '+08:00';");

?>