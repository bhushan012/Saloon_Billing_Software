<?php
include "../operations.php";
$operationInstance = new Operations();
$contactNumber = $_POST['contactNumber'];
echo $operationInstance->verifyContactNumber($contactNumber);