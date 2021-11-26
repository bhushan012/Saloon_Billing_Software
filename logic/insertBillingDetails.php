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
$creditAmnt = htmlentities($_POST['creditAmnt'],ENT_QUOTES,'utf-8', TRUE);
$amntpaid = htmlentities($_POST['amntpaid'],ENT_QUOTES,'utf-8', TRUE);
$servicesIds= $_POST['servicesTaken'];
session_start();
$userId = $_SESSION['userId'];

$productList = $_POST['prodList'];
$sendList;
$serviceid;
$i=0;
foreach ($servicesIds as $value) {
    $serviceArray = explode("-",$value);
    $serviceid[$i] = str_replace("serviceId","",$serviceArray[0]);
    $i++;

}
foreach ($productList as $key) {
   $sendList["prod".$key['id']] = $key['qty'];

}
//  if($creditAmnt == 0 && $amntpaid == 0){
//      $amntpaid = "Paid";
//  }
 $result =  $operationInstance->inserBillDetails($userId,$amntpaid, $creditAmnt, $billDiscount,$billTotal,$billAmountPayable,$customerType,$customerId,$randomCustomerName,$staffId, $serviceid, $sendList);
 echo $result;
?>