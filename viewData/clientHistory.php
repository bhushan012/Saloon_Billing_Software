<?php
include "../header.php";
include "../operations.php";
$operationInstance = new Operations();
?>
<h1 class="display-5 mt-3">Client History </h1>
    <div class="mt-3">
        <label>Select Product:</label>
        <select class="form-control" id="customerList" name="productSelect" required>
            <option value="">Customers</option>
            <?php
            $result = $operationInstance->getAllCustomers();
            while ($row = $result->fetch_assoc()) {
                echo "<option value=" . $row['customer_Id'] . ">" . $row['fullName'] . "</option>";
            }
            ?>
        </select>
    </div>
<div id="inventoryData">

</div>


<!-- Modal -->
<div class="modal right fade" id="myModal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2">
		<div class="modal-dialog" role="document">
			<div class="modal-content">

				<div class="modal-header bg-warning text-white">
                    <h4 class="modal-title" id="myModalLabel2">Bill ID: </h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					
				</div>

				<div class="modal-body ">
                    
					<div id="showServiceData">

                    </div>
				</div>

			</div><!-- modal-content -->
		</div><!-- modal-dialog -->
	</div><!-- modal -->
<?php include "../footer.php"; ?>