<?php
include "../operations.php";
$operationInstance = new Operations();
$billID = $_POST['billID'];

$result = $operationInstance->billDetailsByID($billID);

if ($result->num_rows > 0) {
$i=0;
?>
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
            //   $name = $row[''];
            //   $name = $row[''];
            //   $name = $row[''];
            //   $name = $row[''];
            //   $name = $row[''];
            ?>
                <tr>
                    <td><?= $row['serviceName']; ?></td>
                    <td><?= $row['cost']; ?></td>
                </tr>
            <?php } ?>
    </tbody>
    
</table>
<?php } ?>