<?php

$name = $_POST['name'];
$code = $_POST['code'];
$price = $_POST['price'];
$description = $_POST['description'];

$host = "localhost";
$dbname = "multi_lines";

$conn = new PDO("mysql:host=$host;dbname=$dbname","root","");



for ($i = 0; $i < count($name); $i++) {

    $stmt = $conn->prepare("INSERT INTO items (name, code, price, description) VALUES (?, ?, ?, ?)");
    $stmt->execute([
        $name[$i],
        $code[$i],
        $price[$i],
        $description[$i]
    ]);
}
?>