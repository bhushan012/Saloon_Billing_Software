<?php
include "../header.php";
include "../operations.php";
$operationInstance = new Operations();
?>
<h1 class="display-5 mt-3">Inventory </h1>
<div class="mt-3">
        <label>Select Month:</label>
        <?php
        $months = array();
for ($i = 1; $i < 12; $i++) {
    $timestamp = mktime(0, 0, 0, $i, 1);
    $months[date('n', $timestamp)] = date('F', $timestamp);
} ?>
        <select class="form-control" id="selectMonth" name="productSelect" required>
            <option value="">Select Month</option>
            <?php
            foreach ($months as $key => $value) {
                echo "<option value=" . $key . ">" . $value . "</option>";
            }
            // $result = $operationInstance->getAllProducts();
            // while ($row = $result->fetch_assoc()) {
            //     
            // }
            ?>
        </select>
    </div>
    <div class="mt-3">
        <label>Select Product:</label>
        <select class="form-control" id="prodList" name="productSelect" required>
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

</table>
<?php include "../footer.php"; ?>