<?php
include "../operations.php";
$operationInstance = new Operations();
$customerName = $_POST['customerName'];
$customerType = $_POST['customerType'];
$output = array();
$result =  $operationInstance->getCustomerByName($customerName,$customerType);
while($row = $result->fetch_assoc()) {
    array_push($output,$row['fullName']);
}
echo json_encode($output);