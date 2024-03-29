<?php
include "../header.php";
include "../operations.php";
?>
<h1 class="display-5 mt-3">Customer Bills</h1>
<button id="excel_export">Export Excel</button>
<table id="billDataExcel" class="table table-striped table-bordered table-sm mt-4" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th class="th-sm">Bill No
            </th>
            <th class="th-sm">Created By
            </th>
            <th class="th-sm">Customer
            </th>
            <th class="th-sm">Staff Name
            </th>
            <th class="th-sm">Bill Date
            </th>
            <th class="th-sm">Total
            </th>
            <th class="th-sm">Gst
            </th>
            <th class="th-sm">Discount
            </th>
            <th class="th-sm">Amount Paid
            </th>
            <th class="th-sm notInExcel">Details</th>
        </tr>
    </thead>
    <tbody>

        <?php
        $operationInstance = new Operations();
        $result = $operationInstance->getBillDetail();
        while ($row = $result->fetch_assoc()) {
           // $name = "";
             if (empty($row['randomCustomerName'])){
                $custID = $row['customerId'];
                $custNameRes = $operationInstance->fetchCustomerName($custID);
                while ($sub1 = $custNameRes->fetch_assoc()){
                   $customerName = $sub1['fullName'];
   
               }
               $name = $customerName;
             }
             else{
                 $name = $row['randomCustomerName'];
             }
             $staffID = $row['staffId'];
             $custNameRes1 = $operationInstance->fetchStaffName($staffID);
             while ($sub2 = $custNameRes1->fetch_assoc()){
                $staffName = $sub2['staffName'];

            }

        ?>
            <tr>
                <td> #TTT <?= $row['billNo']; ?></td>
                <td><?= $row['bill_created_by'] == '1' ? "ADMIN" : "STAFF"; ?></td>
                <td><?= $name; ?></td>
                <td><?= $staffName; ?></td>
                <td><?= $row['billDate']; ?></td>
                <td><?= $row['billTotal']; ?></td>
                <td><?= $row['gstAmount']; ?></td>
                <td><?= $row['billDiscount']; ?></td>
                <?php 
                $amntPaid = $row['amountPaid'];
                $payable = $row['billAmountPayable'];
                if ($row ['creditTaken'] == 1 ){?>
                    <td><?= $row['amountPaid'];?></td>
                    <!-- <td> ( credit: <?php // echo $row['creditRemaining'];?> )</td> -->
                <?php }
                else{?>
                    <td><?= $row['billAmountPayable'];?></td>
                <?php }?>
                
                <td class="notInExcel"><button type="button" class="btn btn-demo openServiceModal" data-name = "<?php echo $name; ?>" data-billid = "<?php echo $row['billNo']; ?>" data-toggle="modal" data-target="#myModal2">
			        View 
		</button></td>
            </tr>
        <?php } ?>

    </tbody>
    <tfoot>
        <tr>
        <th>Bill No
            </th>
            <th>Created By
            </th>
            <th >Customer
            </th>
            <th >Staff Name
            </th>
            <th >Bill Date
            </th>
            <th>Total
            </th>
            <th>Gst
            </th>
            <th >Discount
            </th>
            <th>Amount Paid
            </th>
            <th class="notInExcel">Details</th>
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

				<div class="modal-body ">
                    
					<div id="showServiceData">

                    </div>
				</div>

			</div><!-- modal-content -->
		</div><!-- modal-dialog -->
	</div><!-- modal -->
<?php include "../footer.php"; ?>
