<?php


session_start();

$host = "localhost";
$dbname = "multi_lines";

$root="root";
$pass = "";

$conn = new PDO("mysql:host=$host;dbname=$dbname",$root,$pass);


$query = "SELECT `name`, `code`, `price`, `description` FROM `items` WHERE 1";

$result = $conn->prepare($query);
$result->execute();

$_SESSION["items"] = $result->fetchAll(PDO::FETCH_ASSOC);

?>