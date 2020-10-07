<option value="">Service Name</option>
<?php
include "../operations.php";
$operationInstance = new Operations();
$serviceCategoryBilling = $_POST['serviceCategoryBilling'];
$result =  $operationInstance->getAllServicesByCategory($serviceCategoryBilling);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<option id=serviceId".$row['serviceId']." value= serviceId".$row['serviceId']." price=".$row['cost'].">".$row['serviceName']."</option>";
    }
}