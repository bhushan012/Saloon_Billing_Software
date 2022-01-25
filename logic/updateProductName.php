<?php
include "../operations.php";
$operationInstance = new Operations();
if (!empty($_SESSION['username'])) {
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $result = $operationInstance->updateProductName($product_name,$product_id);
    return $result;
}