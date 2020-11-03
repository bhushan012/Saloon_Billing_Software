<?php
include "../header.php";
include "../operations.php";
?>
<table id="customersData" class="table table-striped table-bordered table-sm mt-4" cellspacing="0" width="100%">
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
                <td><?= $row['billNo']; ?></td>
                <td><?= $row['fullName']; ?></td>
                <td><?= $row['staffName']; ?></td>
                <td><?= $row['billDate']; ?></td>
                <td><?= $row['billTotal']; ?></td>
                <td><?= $row['billDiscount']; ?></td>
                <td><?= $row['billAmountPayable'];?></td>
                <td><button type="button" class="btn btn-demo" data-toggle="modal" data-target="#myModal2">
			Right Sidebar Modal
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

				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel2">Right Sidebar</h4>
				</div>

				<div class="modal-body">
					<p>Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
					</p>
				</div>

			</div><!-- modal-content -->
		</div><!-- modal-dialog -->
	</div><!-- modal -->
<?php include "../footer.php"; ?>