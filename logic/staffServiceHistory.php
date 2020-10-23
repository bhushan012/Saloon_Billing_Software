
<?php
include "../operations.php";
$operationInstance = new Operations();
$staffID = $_POST['staffID'];
$month = $_POST['month'];
?>
<table class="table table-striped table-bordered table-sm mt-4" cellspacing="0" width="100%">
<thead>
        <tr>
            <th class="th-sm">Bill No.
            </th>
            <th class="th-sm">Name
            </th>
            <th class="th-sm">Entry Date
            </th>
            <th class="th-sm">Bill Amount
            </th>
            <th class="th-sm">10%
            </th>
            
        </tr>
    </thead>
<?php
$result =  $operationInstance->staffHistory($month,$staffID);
if ($result->num_rows > 0) {
    $i=0;
    
    ?>

    <tbody>
    <?php
    while($row = $result->fetch_assoc()) {
        $i++;
        $tenper = $row['billTotal']*0.1;
        $totalExpense = $totalExpense + $tenper;
        ?>
          <tr>
              <td><?php echo $row['billNo'];?></td>
              <td><?php echo $row['staffName'];?></td>
              <td><?php echo $row['billDate'];?></td>
              <td><?php echo $row['billTotal'];?></td>
              <td><?php echo $tenper?></td>
              <!-- <td><?php echo $row['totalamount'];?></td> -->
          </tr>

         
        <?php
        
    }
    ?>
     </tbody>
    
    <?php
}
else{?>
    <tr>
    <td></td>
    <td></td>
    <td class="text-center"><p>NO DATA FOUND</p></td>
    <td></td>
    <td></td>
    <td></td>
</tr> 
<?php
}
?>
 <tfoot>
        <tr>
        <th>Bill No.
            </th>
            <th >Name
            </th>
            <th >Entry Date
            </th>
            <th >Bill Amount
            </th>
            <th>10%
            </th>
        </tr>
    </tfoot>
</table>
<div class="mt-3 row">
    <div class="col-md-4">
       <h4>TOTAL COMMISSION PAYABLE: </h4>
    </div>

    <div class="col-md-4">

    </div>
    <div class="col-md-4">
       <h3>Rs. <?echo $totalExpense;?></h3>
    </div>
</div>
<?php
//echo $result;
?>
