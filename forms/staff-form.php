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
    <h1 class="display-5 mt-3">Add Staff</h1>
    <div class="form-row mt-3">
        <div class="form-group col-md-6">
            <label for="staffName">Staff Name</label>
            <input type="text" name="staffName" class="form-control" id="serviceName" required>
        </div>
        <div class="form-group col-md-6">
            <label for="designation">Designation</label>
            <input type="text" name="designation" class="form-control" id="serviceCost" required>
        </div>
        <div class="form-group col-md-6">
            <label for="phno">Phone Number</label>
            <input type="tel" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" name="phno" class="form-control" id="serviceCost" required>
        </div>
    </div>
    <button class="mt-2 btn btn-primary <?=$successResponse == 1 ? 'is-valid' : '';?> <?=$successResponse == 0 ? 'is-invalid' : ''?>" name="staffFormSubmit" value="staffFormSubmit" id="servicesFormSubmit" type="submit">ADD STAFF</button>
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