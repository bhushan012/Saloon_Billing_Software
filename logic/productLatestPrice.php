
<?php
include "../operations.php";
$operationInstance = new Operations();
$productSelect = $_POST['productSelect'];
$result =  $operationInstance->getProductPrice($productSelect);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $price = $row['cost'];
    }
}
?>
<label for="firstName">Price</label>
<input type="text" name="prodPrice" class="form-control" id="serviceName" value = "<?php echo $price;?>" required>