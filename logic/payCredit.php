<?php
include "../operations.php";
$operationInstance = new Operations();
$creditAmount = $_POST['creditAmount'];
$userId = $_POST['userId'];
$result = $operationInstance->creditPayment($userId,$creditAmount);
if($result || $result == 'true'){
    return "success";
}else{
    return "error";
}
