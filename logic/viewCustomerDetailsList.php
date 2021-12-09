<?php
include "../operations.php";
$operationInstance = new Operations();
$billID = $_POST['billID'];

$result = $operationInstance->billDetailsByID($billID);

if ($result->num_rows > 0) {
$i=0;
?>
<h5 class="">Services Taken</h4>
<table class="table table-striped table-bordered table-sm mt-4" cellspacing="0" width="100%">
<thead>
        <tr>
            <th class="th-sm">Service Name
            </th>
            <th class="th-sm">Price
            </th>
        </tr>
    </thead>
    <tbody>
    <?php
          while ($row = $result->fetch_assoc()) {
              $date = $row['billDate'];
              $total = $row['billTotal'];
              $discount = $row['billDiscount'];
              $paid = $row['billAmountPayable'];
            //   $name = $row[''];
            //   $name = $row[''];
            ?>
                <tr>
                    <td><?= $row['serviceName']; ?></td>
                    <td><?= $row['price']; ?></td>
                </tr>
            <?php } ?>
    </tbody>
    
</table>
<?php } ?>
<?php
$result = $operationInstance->fetchProductsInBill($billID);
if ($result->num_rows > 0) {
    $i=0;
?>
<h5>Products Purchased</h5>
<table class="table table-striped table-bordered table-sm mt-4" cellspacing="0" width="100%">
<thead>
        <tr>
            <th class="th-sm">Product Name
            </th>
            <th class="th-sm">Qty
            </th>
            <th class="th-sm">Price
            </th>
        </tr>
    </thead>
    <tbody>
    <?php
          while ($row = $result->fetch_assoc()) {
              
            ?>
                <tr>
                    <td><?= $row['productName']; ?></td>
                    <td><?= $row['qty']; ?></td>
                    <td><?= $row['price']; ?></td>
                </tr>
            <?php } ?>
    </tbody>
    
</table>
<?php } ?>
<div class="billDetails">
   <p>Bill Date: <?php echo $date; ?></p>
   <p>Bill Total: <?php echo $total; ?></p>
   <p>Bill Discount: <?php echo $discount; ?></p>
   <p>Bill Amount Paid: <?php echo $paid; ?></p>
</div>
