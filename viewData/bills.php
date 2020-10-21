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
        </tr>
    </tfoot>
</table>
<?php include "../footer.php"; ?>