<?php
include "../operations.php";
$operationInstance = new Operations();
$billDiscount = htmlentities($_POST['billDiscount'],ENT_QUOTES,'utf-8', TRUE);
$billTotal = htmlentities($_POST['billTotal'],ENT_QUOTES,'utf-8', TRUE);
$billAmountPayable = htmlentities($_POST['billAmountPayable'],ENT_QUOTES,'utf-8', TRUE);
$customerType = htmlentities($_POST['customerType'],ENT_QUOTES,'utf-8', TRUE);
$customerId = htmlentities($_POST['customerId'],ENT_QUOTES,'utf-8', TRUE);
$randomCustomerName = htmlentities($_POST['randomCustomerName'],ENT_QUOTES,'utf-8', TRUE);
$staffId = htmlentities($_POST['staffId'],ENT_QUOTES,'utf-8', TRUE);
$servicesIds[] = htmlentities($_POST['servicesTaken'],ENT_QUOTES,'utf-8', TRUE);
print_r($servicesIds);
//$result =  $operationInstance->inserBillDetails($billDiscount,$billTotal,$billAmountPayable,$customerType,$customerId,$randomCustomerName,$staffId, $servicesIds);
//echo $result;
?>