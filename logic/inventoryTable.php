
<?php
include "../operations.php";
$operationInstance = new Operations();
$prodID = $_POST['prodID'];
$month = $_POST['month'];
//$productSelect = $_POST['productSelect'];
$result =  $operationInstance->getProductInventory($month,$prodID);
// if ($result->num_rows > 0) {
//     while($row = $result->fetch_assoc()) {
//         $price = $row['cost'];
//     }
// }
echo $result;
?>
