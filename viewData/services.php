<?php
include "../header.php";
include "../operations.php";
?>
<table id="customersData" class="table table-striped table-bordered table-sm mt-4" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th class="th-sm">Service Category
            </th>
            <th class="th-sm">Service Sub-Category
            </th>
            <th class="th-sm">Service Name
            </th>
            <th class="th-sm">Service Cost
            </th>
            
        </tr>
    </thead>
    <tbody>

        <?php
        $operationInstance = new Operations();
        $result = $operationInstance->getAllServices();
        while ($row = $result->fetch_assoc()) {
        ?>
            <tr>
                <td><?= $row['categoryName']; ?></td>
                <td><?= $row['sub_category_name']; ?></td>
                <td><?= $row['serviceName']; ?></td>
                <td><?= $row['cost']; ?></td>
            </tr>
        <?php } ?>

    </tbody>
    <tfoot>
        <tr>
            <th>Service Category
            </th>
            <th>Service Sub-Category
            </th>
            <th>Service Name
            </th>
            <th>Service Cost
            </th>
        </tr>
    </tfoot>
</table>
<?php include "../footer.php"; ?>