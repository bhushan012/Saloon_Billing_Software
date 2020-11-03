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
        $sql = "SELECT sd.serviceId,sd.serviceName,sd.cost,sc.categoryName FROM service_details as sd INNER JOIN saloon_category as sc ON sd.serviceCategoryId = sc.categoryId";
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
        $sql = "SELECT fullName,customer_id FROM customers where `fullName` LIKE '%".$customerName."%' AND `membership` = ".$customerType."";
        global $conn;
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            return $result;
        }else{
            return "";
        }
    }
    Function getCustomerByContact($customerContact,$customerType){
        $sql = "SELECT fullName,customer_id FROM customers where `contactNumber` LIKE '%".$customerContact."%' AND `membership` = ".$customerType."";
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
            $query = "SELECT totalqty FROM `productList` WHERE productID = '".$prodID."'";
            $result = $conn->query($query);
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $totalqty = $row['totalqty'];
                }
            }
            $totalqty = $totalqty + $qty;
            $setQuery = "UPDATE `productList` SET `totalqty`= '".$totalqty."' WHERE productID = '".$prodID."'";
            if($conn->query($setQuery) === TRUE){
                return true;
            }
            
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
            $query = " inventory.productID = '".$prodID."'";
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
    //GET STAFF SERVICE HISTORY
    function staffHistory($month,$staffId){
        if(!empty($month)){
            $first_day = date('Y-'.$month.'-01'); 
            $last_day  = date('Y-'.$month.'-t');
            $query = " billing.billDate BETWEEN '".$first_day."' AND '".$last_day."'";
        }
        if(!empty($staffId)){
            $query = " billing.staffId = '".$staffId."'";
        }
        if(!empty($month) && !empty($staffId)){
            $query = " billing.billDate BETWEEN '".$first_day."' AND '".$last_day."' AND billing.staffId = '".$staffId."'";
        }
        
        $sql = "SELECT billing.billNo, billing.billDate, staffTable.staffName, billing.billTotal  FROM `billing` INNER JOIN staffTable on billing.staffId = staffTable.staffID WHERE  ".$query;
        
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
    //FUNCTION UPDATE SOLD COUNT INVENTORY
    function updateSoldCount($prodID , $count){
        global $conn;
        $query = "SELECT totalqty , sold FROM `productList` WHERE productID = '".$prodID."'";
            $result = $conn->query($query);
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $totalqty = $row['totalqty'];
                    $sold = $row['sold'];
                }
            }
            $sold = $sold + $count;
            $setQuery = "UPDATE `productList` SET `sold`= '".$sold."' WHERE productID = '".$prodID."'";
            if($conn->query($setQuery) === TRUE){
                return true;
            }

    }
    //INSERT BILL DETAILS
    function inserBillDetails($billDiscount,$billTotal,$billAmountPayable,$customerType,$customerId,$randomCustomerName,$staffId, $servicesIds, $productList){
        $date = date('Y-m-d');
        $billDiscountSelected = $billDiscount>0 ? '1' : '0';
       $sql = "INSERT INTO `billing`( `billDate`, `billDiscountSelected`, `billDiscount`, `billTotal`, `billAmountPayable`, `customerType`, `customerId`, `staffId`, `randomCustomerName`) 
       VALUES ('".$date."','".$billDiscountSelected."','".$billDiscount."','".$billTotal."','".$billAmountPayable."','".$customerType."','".$customerId."','".$staffId."','".$randomCustomerName."')";
       global $conn;
       if($conn->query($sql) === TRUE){
          $billId = $conn->insert_id;
          foreach ($servicesIds as $value) {
              $subsql = "INSERT INTO `bill_services`(`billNo`, `serviceId`) VALUES ('".$billId."','".$value."')";
              $result = $conn->query($subsql);
          }
          foreach ($productList as $key => $value) {
              $pID = str_replace("prod","",$key);
              $addProd = "INSERT INTO `productBilling`(`billID`, `productID`, `qty`) VALUES ('".$billId."','".$pID."','".$value."')";
              $result = $conn->query($addProd);
              $query = "SELECT totalqty , sold FROM `productList` WHERE productID = '".$pID."'";
            $result = $conn->query($query);
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                   // $totalqty = $row['totalqty'];
                    $sold = $row['sold'];
                }
            }
            $sold = $sold + $value;
            $setQuery = "UPDATE `productList` SET `sold`= '".$sold."' WHERE productID = '".$pID."'";
            $conn->query($setQuery);
          }
          return true;
        }
        else { 
            $log = "Error: " . $sql . "<br>" . $conn->error;
            file_put_contents('logs/log_'.date("j.n.Y").'.txt', $log, FILE_APPEND);
            return false;
        }
    }
    //FETCH BILL DETAILS
    function getBillDetail(){
        $sql = "SELECT billing.billNo , billing.billDate , billing.billTotal , billing.billDiscount , billing.billAmountPayable , customers.fullName , staffTable.staffName FROM `billing` INNER JOIN customers ON billing.customerId = customers.customer_Id INNER JOIN staffTable ON billing.staffId = staffTable.staffID";
        global $conn;
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            return $result;
        }else{
            return "";
        }
    }
    //FETCH CLIENT HISTORY
    function getClientHistory($staffID){
        $sql = "SELECT customers.medicationDetails , customers.allergy, 
        customers.membership , customers.fullName, customers.contactNumber, 
        customers.address, billing.billNo, billing.billDate, billing.billAmountPayable, 
        staffTable.staffName FROM `customers` INNER JOIN billing ON billing.customerId = customers.customer_Id 
        INNER JOIN staffTable on billing.staffId = staffTable.staffID WHERE customers.customer_Id = '".$staffID."'";
        global $conn;
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            return $result;
        }else{
            return "";
        }
    }
    //FETCH DASHBOARD DETAILS
    function getTotalSales(){
        $totalSales = "SELECT sum(billAmountPayable) as total FROM billing WHERE 1";
        global $conn;
        $result = $conn->query($totalSales);
        if ($result->num_rows > 0) {
            return $result;
        }else{
            return "";
        }
    }
    function getTotalCustomers(){
        $totalCust = "SELECT COUNT(*) as customers FROM customers WHERE 1";
        global $conn;
        $result = $conn->query($totalCust);
        if ($result->num_rows > 0) {
            return $result;
        }else{
            return "";
        }
    }
    function totalServices(){
        $totalCust = "SELECT COUNT(*) as services FROM service_details WHERE 1";
        global $conn;
        $result = $conn->query($totalCust);
        if ($result->num_rows > 0) {
            return $result;
        }else{
            return "";
        }
    }
    function totalDiscount(){
        $totalCust = "SELECT SUM(billDiscount) as discount FROM billing WHERE 1";
        global $conn;
        $result = $conn->query($totalCust);
        if ($result->num_rows > 0) {
            return $result;
        }else{
            return "";
        }
    }
    function fetchMonthlySales($month){
        $first_day = date('Y-'.$month.'-01'); 
        $last_day  = date('Y-'.$month.'-t');
        $query = "SELECT SUM(billAmountPayable) as total FROM `billing` WHERE billDate BETWEEN '".$first_day."' AND '".$last_day."'";
        global $conn;
        $result = $conn->query($query);
        if ($result->num_rows > 0) {
            return $result;
        }else{
            return "";
        }
    }
    function perServiceSale($serviceID){
        $month = date('m');
        $first_day = date('Y-'.$month.'-01'); 
        $last_day  = date('Y-'.$month.'-t');
        $query = "SELECT COUNT(bill_services.serviceId) as totalCount FROM `billing` INNER JOIN bill_services ON billing.billNo = bill_services.billNo WHERE bill_services.serviceId = '".$serviceID."' AND billing.billDate BETWEEN '".$first_day."' AND '".$last_day."'";
        global $conn;
        $result = $conn->query($query);
        if ($result->num_rows > 0) {
            return $result;
        }else{
            return "";
        }
    }
    //function to get details by bill ID
    function billDetailsByID ($billid){
        $query = "SELECT * FROM billing INNER JOIN bill_services on billing.billNo = bill_services.billNo INNER JOIN service_details ON bill_services.serviceId = service_details.serviceId INNER JOIN customers ON billing.customerId = customers.customer_Id WHERE billing.billNo = '".$billid."'";
        global $conn;
        $result = $conn->query($query);
        if ($result->num_rows > 0) {
            return $result;
        }else{
            return "";
        }
    }
    
}
