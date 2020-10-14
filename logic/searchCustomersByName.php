<?php
include "../operations.php";
$operationInstance = new Operations();
$customerName = $_POST['customerName'];
$customerType = $_POST['customerType'];
$output = array();
$result =  $operationInstance->getCustomerByName($customerName,$customerType);
if($result != ""){
    while($row = $result->fetch_assoc()) {
        $output[] = array("value"=>$row['customer_Id'],"label"=>$row['fullName']);
    }
    echo json_encode($output);
}
exit;