<?php
include "../operations.php";
$operationInstance = new Operations();
$customerContact = $_REQUEST['customerContact'];
$customerType = $_REQUEST['customerType'];
$output = array();
$result =  $operationInstance->getCustomerByContact($customerContact,$customerType);
if($result != ""){
    while($row = $result->fetch_assoc()) {
        echo "<p id='".$row["customer_id"]."'>" . $row["fullName"] . "</p>";
    }
    // echo json_encode($output);
}else{
    echo "<p>No matches found</p>";
}
exit;