<?php
include "../header.php";
include "../operations.php";
$operationInstance = new Operations();
$successResponse = "3";
if(isset($_GET['success'])){
    $successResponse = $_GET['success'];
}
?>
<?php 
            $response = "";
            if($successResponse == 1){
                echo '<div class="valid-feedback">Name Updated Successfully!</div>';
            }else if($successResponse == 0){
                echo '<div class="invalid-feedback">Something went wrong. Try again.</div>';
            }
        ?>
<table class="table table-striped table-bordered table-sm mt-4 test" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th class="th-sm">Sr.NO.
            </th>
            <th class="th-sm">Name
            </th>
            <th class="th-sm">Update
            </th>
            <th class="th-sm">Remove
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
               
                <td><button type="button" data-oldproductname = "<?= $row['productName']; ?>" data-prodID="<?php echo $row["productID"]; ?>" class="btn btn-primary editProd" data-toggle="modal" data-target="#exampleModal">
                <!-- data-toggle="modal" data-target="#exampleModal" -->
                EDIT
                </button></td>
                <td>
                    <button type="button" data-prodID="<?php echo $row["productID"]; ?>" class="btn btn-primary deleteProd">
                    <i class="fa fa-trash"></i> Delete
                    </button>
                </td>

            </tr>
        <?php } ?>

    </tbody>
    <tfoot>
        <tr>
            <th>Sr.NO
            </th>
            <th>Name
            </th>
            <th>Update
            </th>
            <th>Remove
            </th>
            
        </tr>
    </tfoot>
</table>
<!--modal-->
<div class="modal" id="exampleModal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Update Product Name</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="../submitData.php">
    <h1 class="display-5 mt-3" id="oldProductName"></h1>
    <div class="form-row mt-3">
        <div class="form-group col-md-6">
            <label for="firstName">New Name</label>
             <input type="hidden" name="product_id" class="form-control" id="productIDno">
            <input type="text" name="product_name" class="form-control" id="productNameUpdate" required>
        </div>
        
    </div>
    <button class="mt-2 btn btn-primary <?=$successResponse == 1 ? 'is-valid' : '';?> <?=$successResponse == 0 ? 'is-invalid' : ''?>" name="productUpdateNames" value="productUpdateNames" type="submit">Submit form</button>
        
</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<?php include "../footer.php"; ?>
