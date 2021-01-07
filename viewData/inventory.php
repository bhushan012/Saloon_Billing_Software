<?php
include "../header.php";
include "../operations.php";
$operationInstance = new Operations();
?>
<h1 class="display-5 mt-3">Inventory </h1>
<div class="mt-3">
        <label>Select Year:</label>
        <select class="form-control" id="selectYear" name="productSelect" required>
            <?php 
                $year = date("Y");
            ?>
            <option value="2020" <?php if($year == 2020) { echo "Selected"; } ?>>2020</option>
            <option value="2021" <?php if($year == 2021) { echo "Selected"; } ?>>2021</option>
            <option value="2022" <?php if($year == 2022) { echo "Selected"; } ?>>2022</option>
            <option value="2023" <?php if($year == 2023) { echo "Selected"; } ?>>2023</option>
            <option value="2024" <?php if($year == 2024) { echo "Selected"; } ?>>2024</option>
            
        </select>
    </div>
<div class="mt-3">
        <label>Select Month:</label>
        <?php
        $months = array();
for ($i = 1; $i <= 12; $i++) {
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
<div id="inventoryData">

</div>


</table>
<?php include "../footer.php"; ?>