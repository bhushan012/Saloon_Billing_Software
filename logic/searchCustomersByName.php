<?php
include "../operations.php";
$operationInstance = new Operations();
$customerName = $_POST['customerName'];
$customerType = $_POST['customerType'];
$output = array();
$result =  $operationInstance->getCustomerByName($customerName,$customerType);
if($result != ""){
    while($row = $result->fetch_assoc()) {
        echo "<p id='".$row["customer_id"]."'>" . $row["fullName"] . "</p>";
    }
    // echo json_encode($output);
}else{
    echo "<p>No matches found</p>";
}
exit;