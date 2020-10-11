<?php
include "../header.php";
include "../operations.php";
$operationInstance = new Operations();
$successResponse = "3";
if(isset($_GET['success'])){
    $successResponse = $_GET['success'];
}
?>
<form id="customerForm" method="POST" action="../submitData.php">
    <h1 class="display-5">Inventory </h1>
    <div class="mt-3">
        <label>Service Category:</label>
        <select class="form-control" id="productSelect" name="productSelect" required>
            <option value="">Service Category</option>
            <?php
            $result = $operationInstance->getAllProducts();
            while ($row = $result->fetch_assoc()) {
                echo "<option value=" . $row['productID'] . ">" . $row['productName'] . "</option>";
            }
            ?>
        </select>
    </div>
    <div class="form-row mt-3">
        <div class="form-group col-md-6">
            <label for="firstName">Price</label>
            <input type="text" name="productName" class="form-control" id="serviceName" required>
        </div>
        <div class="form-group col-md-6">
            <label for="lastName">Quantity</label>
            <input type="number" name="qty" class="form-control" id="serviceCost" required>
        </div>
    </div>
    <button class="mt-2 btn btn-primary <?=$successResponse == 1 ? 'is-valid' : '';?> <?=$successResponse == 0 ? 'is-invalid' : ''?>" name="productFormSubmit" value="servicesFormSubmit" id="servicesFormSubmit" type="submit">Add Inventory</button>
        <?php 
            $response = "";
            if($successResponse == 1){
                echo '<div class="valid-feedback">Details Stored Successfully!</div>';
            }else if($successResponse == 0){
                echo '<div class="invalid-feedback">Something went wrong. Try again.</div>';
            }
        ?>
     <button class="mt-2 btn btn-primary <?=$successResponse == 1 ? 'is-valid' : '';?> <?=$successResponse == 0 ? 'is-invalid' : ''?>" name="productFormSubmit" value="servicesFormSubmit" id="servicesFormSubmit" type="submit">+ ADD NEW PRODUCT</button>
</form>

<?php include "../footer.php"; ?>