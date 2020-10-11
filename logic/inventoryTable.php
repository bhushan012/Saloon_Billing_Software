
<?php
include "../operations.php";
$operationInstance = new Operations();
$prodID = $_POST['prodID'];
$month = $_POST['month'];
?>
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
//echo $result;
?>
