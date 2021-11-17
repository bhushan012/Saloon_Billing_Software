<?php
include "../operations.php";
$operationInstance = new Operations();
$categoryId = $_POST['categoryId'];
$result = $operationInstance->getSaloonSubCategoryById($categoryId);
if ($result->num_rows > 0) {
    echo '<option value="">Service Sub-Category</option>';
    while ($row = $result->fetch_assoc()) {
        echo "<option value=" . $row['sub_category_id'] . ">" . $row['sub_category_name'] . "</option>";
    }
}else{
    echo '<option value="">Service Sub-Category</option>';
}
