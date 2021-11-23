<?php
include "../operations.php";
$operationInstance = new Operations();
$creditAmount = $_POST['creditAmount'];
$userId = $_POST['userId'];
$result = $operationInstance->creditPayment($userId,$creditAmount);
if($result){
    return "success";
}else{
    return "error";
}
