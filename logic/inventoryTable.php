
<?php
include "../operations.php";
$operationInstance = new Operations();
$prodID = $_POST['prodID'];
$month = $_POST['month'];
?>
<table class="table table-striped table-bordered table-sm mt-4" cellspacing="0" width="100%">
<thead>
        <tr>
            <th class="th-sm">Sr. No.
            </th>
            <th class="th-sm">Name
            </th>
            <th class="th-sm">Entry Date
            </th>
            <th class="th-sm">Price
            </th>
            <th class="th-sm">Quantity
            </th>
            <th class="th-sm">Total Amount
            </th>
        </tr>
    </thead>
<?php
$result =  $operationInstance->getProductInventory($month,$prodID);
if ($result->num_rows > 0) {
    $i=0;
    
    ?>

    <tbody>
    <?php
    while($row = $result->fetch_assoc()) {
        $i++;
        $totalExpense = $totalExpense + $row['totalamount'];
        ?>
          <tr>
              <td><?php echo $i;?></td>
              <td><?php echo $row['productName'];?></td>
              <td><?php echo $row['entrydate'];?></td>
              <td><?php echo $row['cost'];?></td>
              <td><?php echo $row['qty'];?></td>
              <td><?php echo $row['totalamount'];?></td>
          </tr>

         
        <?php
        
    }
    ?>
     </tbody>
     <tfoot>
        <tr>
        <th >Sr. No.
            </th>
            <th >Name
            </th>
            <th >Entry Date
            </th>
            <th >Price
            </th>
            <th >Quantity
            </th>
            <th>Total Amount
            </th>
        </tr>
    </tfoot>
    <?php
}
?>
</table>
<div class="mt-3 row">
    <div class="col-md-4">
       <h3>TOTAL EXPENSE: </h3>
    </div>

    <div class="col-md-4">

    </div>
    <div class="col-md-4">
       <h3><?echo $totalExpense;?></h3>
    </div>
</div>
<?php
//echo $result;
?>
