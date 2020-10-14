<?php
include "connection.php";

class Operations {
    Function addFund($reason,$ServiceType,$amount,$date) : bool{
        $sql = "INSERT INTO funds (reason, service_type, amount, date) VALUES ('".$reason."','".$ServiceType."','".$amount."','".$date."')";
        global $conn;
        if ($conn->query($sql) === TRUE) {
            return true;
            //header("Location: $redirectPageName");
        } else {
            $log = "Error: " . $sql . "<br>" . $conn->error;
            file_put_contents('logs/log_'.date("j.n.Y").'.txt', $log, FILE_APPEND);
            return false;
            //header("Location: $redirectPageName");
        }
    }
    
    Function addExpense($reason,$category,$amount,$date): bool{
        $sql = "INSERT INTO funds (reason, service_type, amount, date) VALUES ('".$reason."','".$category."','".$amount."','".$date."')";
        global $conn;
        if ($conn->query($sql) === TRUE) {
            return true;
            //header("Location: $redirectPageName");
        } else {
            $log = "Error: " . $sql . "<br>" . $conn->error;
            file_put_contents('logs/log_'.date("j.n.Y").'.txt', $log, FILE_APPEND);
            return false;
            //header("Location: $redirectPageName");
        }
    }

    Function addCustomer($firstName,$lastName,$contactNumber,$emailAddress,$address,$dateOfBirth,$medicationDetails,$allergy,$membership): bool{
        $fullName = $firstName." ".$lastName;
        $sql = "INSERT INTO `customers` (`firstName`, `lastName`, `fullName` ,`contactNumber`, `emailAddress`, `dateOfBirth`, `medicationDetails`, `allergy`, `membership`, `address`) VALUES ('".$firstName."', '".$lastName."', '".$fullName."', '".$contactNumber."', '".$emailAddress."', '".$dateOfBirth."', '".$medicationDetails."', '".$allergy."', '".$membership."', '".$address."')";
        global $conn;
        if ($conn->query($sql) === TRUE) {
            return true;
        } else {
            $log = "Error: " . $sql . "<br>" . $conn->error;
            file_put_contents('logs/log_'.date("j.n.Y").'.txt', $log, FILE_APPEND);
            return false;
        }
    }
    Function addService($serviceCategory,$serviceName,$serviceCost): bool{
        $sql = "INSERT INTO `service_details` (`serviceCategoryId`, `serviceName`, `cost`) VALUES ('".$serviceCategory."', '".$serviceName."', '".$serviceCost."')";
        global $conn;
        if ($conn->query($sql) === TRUE) {
            return true;
        } else {
            $log = "Error: " . $sql . "<br>" . $conn->error;
            file_put_contents('logs/log_'.date("j.n.Y").'.txt', $log, FILE_APPEND);
            return false;
        }
    }
    Function verifyContactNumber($contactNumber): bool{
        $sql = "SELECT * FROM `customers` WHERE `contactNumber` = '".$contactNumber."'";
        global $conn;
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            return false;
        }else{
            return true;
        }
    }
    Function getAllCustomers(){
        $sql = "SELECT * FROM `customers`";
        global $conn;
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            return $result;
        }else{
            return "";
        }
    }
    Function getAllSaloonCategory(){
        $sql = "SELECT * FROM saloon_category";
        global $conn;
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            return $result;
        }else{
            return "";
        }
    }
    Function getAllServices(){
        $sql = "SELECT sd.serviceName,sd.cost,sc.categoryName FROM service_details as sd INNER JOIN saloon_category as sc ON sd.serviceCategoryId = sc.categoryId";
        global $conn;
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            return $result;
        }else{
            return "";
        }
    }
    Function getAllServicesByCategory($categoryId){
        $sql = "SELECT * FROM service_details where serviceCategoryId = ".$categoryId;
        global $conn;
        $result = $conn->query($sql);
        return $result;
        // if ($result->num_rows > 0) {
        //     return $result;
        // }else{
        //     return "";
        // }
    }
    Function getCustomerType(){
        $sql = "SELECT * FROM customer_type";
        global $conn;
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            return $result;
        }else{
            return "";
        }
    }
    Function getCustomerByName($customerName,$customerType){
        $sql = "SELECT * FROM customers where `fullName` LIKE '%".$customerName."%' AND `membership` = ".$customerType."";
        global $conn;
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            return $result;
        }else{
            return "";
        }
    }
    ///ADD PRODUCT
    function addNewProduct($productName,$productCost,$qty)
    {
        $date = date('Y-m-d');
        $sql = "INSERT INTO `productList` (`productName`, `date`) VALUES ('".$productName."', '".$date."')";
        global $conn;
        if ($conn->query($sql) === TRUE) {
            $prodID = $conn->insert_id;
            $totalamount = $qty*$productCost;
            $subSql = "INSERT INTO `inventory` (`productID`, `cost`, `qty`, `entrydate`, `totalamount`) VALUES ('".$prodID."','".$productCost."', '".$qty."','".$date."','".$totalamount."')";
            if($conn->query($subSql) === TRUE){
                return true;
            }
            
        } else {
            $log = "Error: " . $sql . "<br>" . $conn->error;
            file_put_contents('logs/log_'.date("j.n.Y").'.txt', $log, FILE_APPEND);
            return false;
        }
    }
    //INVENTORY
    function addInventory($prodID,$price,$qty){
        $date = date('Y-m-d');
        global $conn;
        $totalamount = $qty*$price;
        $subSql = "INSERT INTO `inventory` (`productID`, `cost`, `qty`, `entrydate`, `totalamount`) VALUES ('".$prodID."','".$price."', '".$qty."','".$date."','".$totalamount."')";
        if($conn->query($subSql) === TRUE){
            return true;
        }
        else {
            $log = "Error: " . $subSql . "<br>" . $conn->error;
            file_put_contents('logs/log_'.date("j.n.Y").'.txt', $log, FILE_APPEND);
            return false;
        }

    }
    //GET PRODUCTS
    function getAllProducts(){
        $sql = "SELECT * FROM productList where 1";
        global $conn;
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            return $result;
        }else{
            return "";
        }
    }
    //GET PRODUCT PRICE
    function getProductPrice($prodID){
        $sql = "SELECT * FROM inventory where `productID` = '".$prodID."'";
        global $conn;
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            return $result;
        }else{
            return "";
        }
    }
    //PRODUCT INVENTORY TABLE
    function getProductInventory($month,$prodID){
        if(!empty($month)){
            $first_day = date('Y-'.$month.'-01'); 
            $last_day  = date('Y-'.$month.'-t');
            $query = " inventory.entrydate BETWEEN '".$first_day."' AND '".$last_day."'";
        }
        if(!empty($prodID)){
            $prodQuery = " inventory.productID = '".$prodID."'";
        }
        if(!empty($month) && !empty($prodID)){
            $query = " inventory.entrydate BETWEEN '".$first_day."' AND '".$last_day."' AND inventory.productID = '".$prodID."'";
        }
        
        $sql = "SELECT * FROM inventory INNER JOIN productList ON inventory.productID = productList.productID WHERE ".$query;
        
        global $conn;
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            return $result;
        }else{
            return "";
        }
    }

    //ADD STAFF MEMBERS
    function addStaffMembers($name,$designation,$phno){
       $date = date('Y-m-d');
       $sql = "INSERT INTO `staffTable`(`staffName`, `designation`, `phno`,`entryDate`) VALUES ('".$name."','".$designation."','".$phno."','".$date."')";
       global $conn;
       if($conn->query($sql) === TRUE){
            return true;
        }
        else {
            $log = "Error: " . $sql . "<br>" . $conn->error;
            file_put_contents('logs/log_'.date("j.n.Y").'.txt', $log, FILE_APPEND);
            return false;
        }
    }
    function fetchStaffMembers(){
        $sql = "SELECT staffID,staffName FROM staffTable";
        global $conn;
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            return $result;
        }else{
            return "";
        }
    }
}
