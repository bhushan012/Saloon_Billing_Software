<?php
include "../header.php";
include "../operations.php";
$operationInstance = new Operations();
?>
<h1 class="display-5 mt-3">Inventory </h1>
<div class="mt-3">
        <label>Select Month:</label>
        <select class="form-control" id="productSelect" name="productSelect" required>
            <option value="">Products</option>
            <?php
            // $result = $operationInstance->getAllProducts();
            // while ($row = $result->fetch_assoc()) {
            //     echo "<option value=" . $row['productID'] . ">" . $row['productName'] . "</option>";
            // }
            ?>
        </select>
    </div>
    <div class="mt-3">
        <label>Select Product:</label>
        <select class="form-control" id="productSelect" name="productSelect" required>
            <option value="">Products</option>
            <?php
            $result = $operationInstance->getAllProducts();
            while ($row = $result->fetch_assoc()) {
                echo "<option value=" . $row['productID'] . ">" . $row['productName'] . "</option>";
            }
            ?>
        </select>
    </div>

<table id="customersData" class="table table-striped table-bordered table-sm mt-4" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th class="th-sm">Name
            </th>
            <th class="th-sm">Email
            </th>
            <th class="th-sm">Contact
            </th>
            <th class="th-sm">Birth Date
            </th>
            <th class="th-sm">Medication Details
            </th>
            <th class="th-sm">Allergy
            </th>
            <th class="th-sm">Member
            </th>
        </tr>
    </thead>
    <tbody>

        <?php
        $operationInstance = new Operations();
        $result = $operationInstance->getAllCustomers();
        while ($row = $result->fetch_assoc()) {
        ?>
            <tr>
                <td><?= $row['firstName']; ?> <?= $row['lastName']; ?></td>
                <td><?= $row['emailAddress']; ?></td>
                <td><?= $row['contactNumber']; ?></td>
                <td><?= $row['dateOfBirth']; ?></td>
                <td><?= $row['medicationDetails']; ?></td>
                <td><?= $row['allergy']; ?></td>
                <td><?= $row['membership'] == "1" ? 'Yes' : 'No'; ?></td>
            </tr>
        <?php } ?>

    </tbody>
    <tfoot>
        <tr>
            <th>Name
            </th>
            <th>Email
            </th>
            <th>Contact
            </th>
            <th>Birth Date
            </th>
            <th>Medication Details
            </th>
            <th>Allergy
            </th>
            <th>Member
            </th>
        </tr>
    </tfoot>
</table>
<?php include "../footer.php"; ?>