<?php
include "../header.php";
include "../operations.php";
?>
<table class="table table-striped table-bordered table-sm mt-4" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th class="th-sm">Bill No
            </th>
            <th class="th-sm">Customer
            </th>
            <th class="th-sm">Staff Name
            </th>
            <th class="th-sm">Bill Date
            </th>
            <th class="th-sm">Total
            </th>
            <th class="th-sm">Discount
            </th>
            <th class="th-sm">Amount Paid
            </th>
            <th class="th-sm">Services</th>
        </tr>
    </thead>
    <tbody>

        <?php
        $operationInstance = new Operations();
        $result = $operationInstance->getBillDetail();
        while ($row = $result->fetch_assoc()) {
        ?>
            <tr>
                <td> #TTT <?= $row['billNo']; ?></td>
                <td><?= $row['fullName']; ?></td>
                <td><?= $row['staffName']; ?></td>
                <td><?= $row['billDate']; ?></td>
                <td><?= $row['billTotal']; ?></td>
                <td><?= $row['billDiscount']; ?></td>
                <td><?= $row['billAmountPayable'];?></td>
                <td><button type="button" class="btn btn-demo openServiceModal" data-name = "<?php echo $row['fullName']; ?>" data-billid = "<?php echo $row['billNo']; ?>" data-toggle="modal" data-target="#myModal2">
			        View Details
		</button></td>
            </tr>
        <?php } ?>

    </tbody>
    <tfoot>
        <tr>
        <th >Bill No
            </th>
            <th >Customer
            </th>
            <th >Staff Name
            </th>
            <th >Bill Date
            </th>
            <th>Total
            </th>
            <th >Discount
            </th>
            <th>Amount Paid
            </th>
            <th>Services</th>
        </tr>
    </tfoot>
</table>
<!-- Modal -->
<div class="modal right fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2">
		<div class="modal-dialog" role="document">
			<div class="modal-content">

				<div class="modal-header bg-warning text-white">
                    <h4 class="modal-title" id="myModalLabel2">Bill ID: </h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					
				</div>

				<div class="modal-body">
                    <h4 class="">Services Taken</h4>
					<div id="showServiceData">

                    </div>
				</div>

			</div><!-- modal-content -->
		</div><!-- modal-dialog -->
	</div><!-- modal -->
<?php include "../footer.php"; ?>