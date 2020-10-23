<?php
include "../header.php";
include "../operations.php";
$operationInstance = new Operations();
?>
<h1 class="display-5 mt-3">Client History </h1>
    <div class="mt-3">
        <label>Select Product:</label>
        <select class="form-control" id="customerList" name="productSelect" required>
            <option value="">Customers</option>
            <?php
            $result = $operationInstance->getAllCustomers();
            while ($row = $result->fetch_assoc()) {
                echo "<option value=" . $row['customer_Id'] . ">" . $row['fullName'] . "</option>";
            }
            ?>
        </select>
    </div>
<div id="inventoryData">

</div>


</table>
<?php include "../footer.php"; ?>