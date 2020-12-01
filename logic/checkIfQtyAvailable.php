
<?php
include "../operations.php";
$operationInstance = new Operations();
$productSelect = $_POST['id'];
$result =  $operationInstance->fetchAvailableQty($productSelect);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $availableStock = $row['available'];
    }
}
echo $availableStock;
?>
