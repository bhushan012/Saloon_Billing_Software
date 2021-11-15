<?php
include "../header.php";
include "../operations.php";
?>
<table id="customersData" class="table table-striped table-bordered table-sm mt-4 test" cellspacing="0" width="100%">
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