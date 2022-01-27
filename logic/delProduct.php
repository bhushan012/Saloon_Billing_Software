<?php
session_start();
if(!empty($_SESSION['username'])){
    include "../operations.php";
    $operationInstance = new Operations();
    $productId = $_POST['productId'];
    echo $operationInstance->deleteProduct($productId);
}