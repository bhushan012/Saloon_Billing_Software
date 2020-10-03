<?php
include "../operations.php";
$operationInstance = new Operations();
$customerName = $_POST['customerName'];
$output = array();
$result =  $operationInstance->getCustomerByName($customerName);
while($row = $result->fetch_assoc()) {
    array_push($output,$row['fullName']);
}
echo json_encode($output);