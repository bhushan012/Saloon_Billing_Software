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
    <h1 class="display-5 mt-3">Service Form</h1>
    <div class="mt-3">
        <label>Service Category:</label>
        <select class="form-control test" id="serviceCategory" name="serviceCategory" required>
            <option value="">Service Category</option>
            <?php
            $result = $operationInstance->getAllSaloonCategory();
            while ($row = $result->fetch_assoc()) {
                echo "<option value=" . $row['categoryId'] . ">" . $row['categoryName'] . "</option>";
            }
            ?>
        </select>
    </div>
    <div class="form-row mt-3">
        <div class="form-group col-md-6">
            <label for="firstName">Service Name</label>
            <input type="text" name="serviceName" class="form-control" id="serviceName" required>
        </div>
        <div class="form-group col-md-6">
            <label for="lastName">Service Cost</label>
            <input type="number" min="0" name="serviceCost" class="form-control" id="serviceCost" required>
        </div>
    </div>
    <button class="mt-2 btn btn-primary <?=$successResponse == 1 ? 'is-valid' : '';?> <?=$successResponse == 0 ? 'is-invalid' : ''?>" name="servicesFormSubmit" value="servicesFormSubmit" id="servicesFormSubmit" type="submit">Submit form</button>
        <?php 
            $response = "";
            if($successResponse == 1){
                echo '<div class="valid-feedback">Details Stored Successfully!</div>';
            }else if($successResponse == 0){
                echo '<div class="invalid-feedback">Something went wrong. Try again.</div>';
            }
        ?>
</form>

<?php include "../footer.php"; ?>