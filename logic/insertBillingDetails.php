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
$servicesIds= $_POST['servicesTaken'];
$productList = $_POST['prodList'];
$serviceid;
$i=0;
foreach ($servicesIds as $value) {
    
    $serviceid[$i] = str_replace("serviceId","",$value);
    $i++;

}
$prodList;
// foreach ($productList as $key => $value) {
//     $keyval = str_replace("prod","",$key);
//     $prodList[$keyval] = $value;

// }
var_dump($productList);
 //$result =  $operationInstance->inserBillDetails($billDiscount,$billTotal,$billAmountPayable,$customerType,$customerId,$randomCustomerName,$staffId, $serviceid);
 //echo $result;
?>