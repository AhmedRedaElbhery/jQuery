<?php

if(isset($_POST["item_name"])){

    $conn = new PDO("mysql:host=localhost;dbname=units","root","");
    $order_id = uniqid();

    for($count = 0; $count < count($_POST["item_name"]); $count++)
    {
        $query = "INSERT INTO tbl_order_items 
        (order_id, item_name, item_quantity, item_unit) 
        VALUES (:order_id, :item_name, :item_quantity, :item_unit)";
        
        $statement = $conn->prepare($query);
        
        $result = $statement->execute(
            array(
                ':order_id' => $order_id,
                ':item_name' => $_POST["item_name"][$count],
                ':item_quantity' => $_POST["item_quantity"][$count],
                ':item_unit' => $_POST["item_unit"][$count]
            )
        );
    }

    if($result){
        echo "OK";
    }

}
?>