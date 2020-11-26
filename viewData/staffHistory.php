<?php
include "../header.php";
include "../operations.php";
$operationInstance = new Operations();
?>
<h1 class="display-5 mt-3">Staff History </h1>
<div class="mt-3">
        <label>Select Month:</label>
        <?php
        $months = array();
for ($i = 1; $i < 13; $i++) {
    $timestamp = mktime(0, 0, 0, $i, 1);
    $months[date('n', $timestamp)] = date('F', $timestamp);
} ?>
        <select class="form-control" id="selectMonth1" name="productSelect" required>
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
        <select class="form-control" id="staffList" name="productSelect" required>
            <option value="">Staff Members</option>
            <?php
            $result = $operationInstance->fetchStaffMembers();
            while ($row = $result->fetch_assoc()) {
                echo "<option value=" . $row['staffID'] . ">" . $row['staffName'] . "</option>";
            }
            ?>
        </select>
    </div>
<div id="inventoryData">

</div>


</table>
<?php include "../footer.php"; ?>