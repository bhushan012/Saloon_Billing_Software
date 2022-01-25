<?php
include "../header.php";
include "../operations.php";
$operationInstance = new Operations();
$successResponse = "3";
if(isset($_GET['success'])){
    $successResponse = $_GET['success'];
}
?>

<table class="table table-striped table-bordered table-sm mt-4 test" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th class="th-sm">Sr.NO.
            </th>
            <th class="th-sm">Name
            </th>
            <th class="th-sm">Edit
            </th>
            
        </tr>
    </thead>
    <tbody id="editProduct">

        <?php
        $operationInstance = new Operations();
        $result = $operationInstance->getAllProducts();
        $i=0;
        while ($row = $result->fetch_assoc()) {
            $i++;
        ?>
            <tr>
                <td><?php echo $i;?></td>
                <td><?= $row['productName']; ?></td>
               
                <td><button type="button" data-prodID="<?php echo $row["productID"]; ?>" class="btn btn-primary editProd" data-toggle="modal" data-target="#exampleModal">
                <!-- data-toggle="modal" data-target="#exampleModal" -->
  EDIT
</button></td>
            </tr>
        <?php } ?>

    </tbody>
    <tfoot>
        <tr>
            <th>Sr.NO
            </th>
            <th>Name
            </th>
            <th>Edit
            </th>
            
        </tr>
    </tfoot>
</table>
<!--modal-->
<div class="modal" id="exampleModal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Update Products Name</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="../submitData.php">
    <h1 class="display-5 mt-3">Update Products Name</h1>
    <div class="form-row mt-3">
        <div class="form-group col-md-6">
            <label for="firstName">Product Name</label>
             <input type="hidden" name="productID" class="form-control" id="productIDno">
            <input type="text" name="productName" class="form-control" id="productNameUpdate" required>
        </div>
        
    </div>
    <button class="mt-2 btn btn-primary <?=$successResponse == 1 ? 'is-valid' : '';?> <?=$successResponse == 0 ? 'is-invalid' : ''?>" name="productFormSubmit" value="servicesFormSubmit" id="productUpdateName" type="submit">Submit form</button>
        <?php 
            $response = "";
            if($successResponse == 1){
                echo '<div class="valid-feedback">Details Stored Successfully!</div>';
            }else if($successResponse == 0){
                echo '<div class="invalid-feedback">Something went wrong. Try again.</div>';
            }
        ?>
</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<?php include "../footer.php"; ?>
