<?php 
include "../header.php"; 
$successResponse = "3";
if(isset($_GET['success'])){
    $successResponse = $_GET['success'];
}
?>
<form method="POST" action="../submitData.php"> 
    <h1 class="display-5 mt-3">Customer Form</h1>
    <div class="form-row mt-3">
        <div class="form-group col-md-6">
            <label for="firstName">First Name</label>
            <input type="text" name="firstName" class="form-control" id="firstName" required>
        </div>
        <div class="form-group col-md-6">
            <label for="lastName">Last Name</label>
            <input type="text" name="lastName" class="form-control" id="lastName" required>
            <!-- <div class="valid-feedback">
                Looks good!
            </div> -->
        </div>
    </div>
    <div class="form-group">
        <label for="address">Address</label>
        <input type="text" name="address" class="form-control" id="address">
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="emailAddress">Email</label>
            <input type="email" name="emailAddress" class="form-control" id="emailAddress">
        </div>
        <div class="form-group col-md-6">
            <label for="contactNumber">Contact Number</label>
            <input type="number" name="contactNumber" class="form-control" id="contactNumber">
            <div class="invalid-feedback">
                Phone number already exists.
            </div>
        </div>
    </div>
    <div class="form-group">
        <label>Date of Birth</label>
        <div class="input-group date">
            <div class="input-group-addon ml-1">
                <i class="fa fa-calendar iconPlacement"></i>
            </div>
            <input type="text" value="<?= date("m/d/Y"); ?>" name="dateOfBirth" class="form-control" id="datepicker" readonly>
        </div>
        <!-- /.input group -->
    </div>
    <div class="form-group">
        <label for="medicationDetails">List any medications, supplements, or herbal remedies you currently take</label>
        <textarea class="form-control" name="medicationDetails" id="medicationDetails"></textarea>
    </div>
    <div class="form-group">
        <label for="allergy">Please list allergies or sensitivities</label>
        <input type="text" class="form-control" name="allergy" id="allergy">
    </div>
    <div class="form-group">
        <div class="form-check mb-2">
            <input class="form-check-input" type="checkbox" value="1" name="membership" id="membership">
            <label class="form-check-label" for="membership">
                Membership
            </label>
        </div>
        <button class="mt-2 btn btn-primary <?=$successResponse == 1 ? 'is-valid' : 'is-invalid';?>" name="customerFormSubmit" value="customerFormSubmit" id="customerFormSubmit" type="submit">Submit form</button>
        <?php 
            if($successResponse == 1){
                echo '<div class="valid-feedback">Details Stored Successfully!</div>';
            }else if($successResponse == 0){
                echo '<div class="invalid-feedback">Something went wrong. Try again.</div>';
            }
        ?>
            
    </div>
</form>
<?php include "../footer.php"; ?>