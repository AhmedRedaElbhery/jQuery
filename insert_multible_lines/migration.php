<?php

$host = "localhost";
$user = "root";
$pass = "";

$pdo = new PDO("mysql:host=$host", $user, $pass);

$sql = "CREATE DATABASE IF NOT EXISTS multi_lines";

$pdo->exec($sql);

$dbname="multi_lines";

$pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);


$table = "CREATE TABLE IF NOT EXISTS items (
                id INT AUTO_INCREMENT PRIMARY KEY,
                name VARCHAR(255) NOT NULL,
                code VARCHAR(100),
                price DECIMAL(10,2),
                description TEXT
            )";

            
$pdo->exec($table);