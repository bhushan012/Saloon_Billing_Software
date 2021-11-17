<?php
include "../operations.php";
$operationInstance = new Operations();
$billID = $_POST['categoryId'];
$result = $operationInstance->getSaloonSubCategoryById($billID);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<option value=" . $row['sub_category_id'] . ">" . $row['sub_category_name'] . "</option>";
    }
}
