<?php
include "urlMapping.php";
include "operations.php";
$operationInstance = new Operations();

////////////////////////////// NEW CUSTOMER ADD
if(isset($_POST['customerFormSubmit'])):
    $firstName = htmlentities($_POST['firstName'],ENT_QUOTES,'utf-8', TRUE);
    $lastName = htmlentities($_POST['lastName'],ENT_QUOTES,'utf-8', TRUE);
    $address = htmlentities($_POST['address'],ENT_QUOTES,'utf-8', TRUE);
    $emailAddress = htmlentities($_POST['emailAddress'],ENT_QUOTES,'utf-8', TRUE);
    $contactNumber = htmlentities($_POST['contactNumber'],ENT_QUOTES,'utf-8', TRUE);
    $dateOfBirth = date('Y-m-d', strtotime(str_replace('-','/', $_POST['dateOfBirth'])));
    $medicationDetails = htmlentities($_POST['medicationDetails'],ENT_QUOTES,'utf-8', TRUE);
    $allergy = htmlentities($_POST['allergy'],ENT_QUOTES,'utf-8', TRUE);
    $membership = htmlentities($_POST['membership'] ?? "0",ENT_QUOTES,'utf-8', TRUE);
    $response = $operationInstance->addCustomer($firstName,$lastName,$contactNumber,$emailAddress,$address,$dateOfBirth,$medicationDetails,$allergy,$membership);
    if($response):
        $actual_link = $formUrl."/customer-form.php?success=1";
        header("Location: $actual_link");
    else:
        echo "something went wrong.";
        $actual_link = $formUrl."/customer-form.php?success=0";
        header("Location: $actual_link");
    endif;
endif;

////////////////////////////// LOGIN
if(isset($_POST['login_submit'])):
    $username = $_POST['username'];
    $hashPassword =  md5($_POST['password']);
    $response = $operationInstance->userLogin($username,$hashPassword);
    // print_r($response);
    // echo $hashPassword;
    session_start();
    
    $_SESSION["test"] = "test";
    
    $actual_link = $formUrl."/dashboard.php";
    header("Location: $actual_link");
    // if($response['status']):
    //     session_start();
    //     $_SESSION['username'] = $response['username']; 
    //     $_SESSION['userId'] = $response['userId']; 
    //     $_SESSION['user_type'] = $response['user_type']; 
    //     $actual_link = $formUrl."/dashboard.php";
        
    //     // echo "<br> Actual Link: ".$actual_link;
    //     // print_r($response);
    //     // echo "<br>".$_SESSION['username'];
    //     // echo "<br>";
    //     // print_r($_SESSION);
    //     header("Location: $actual_link");
    // else:
    //     // echo "something went wrong.";
    //     $actual_link = $homeUrl."/login.php?error=1";
    //     header("Location: $actual_link");
    // endif;
endif;
////////////////////////////// NEW SERVICE ADD
if(isset($_POST['servicesFormSubmit'])):
    $serviceCategory = htmlentities($_POST['serviceCategory'],ENT_QUOTES,'utf-8', TRUE);
    $serviceSubCategory = htmlentities($_POST['serviceSubCategory'],ENT_QUOTES,'utf-8', TRUE);
    $serviceName = htmlentities($_POST['serviceName'],ENT_QUOTES,'utf-8', TRUE);
    $serviceCost = htmlentities($_POST['serviceCost'],ENT_QUOTES,'utf-8', TRUE);
    $response = $operationInstance->addService($serviceCategory,$serviceName,$serviceCost,$serviceSubCategory);
    if($response):
        $actual_link = $formUrl."/services-form.php?success=1";
        header("Location: $actual_link");
    else:
        echo "something went wrong.";
        $actual_link = $formUrl."/services-form.php?success=0";
        header("Location: $actual_link");
    endif;
endif;
////////////////////////////// NEW SUB CATEGORY ADD
if(isset($_POST['subCategoryFormSubmit'])):
    $CategoryId = htmlentities($_POST['serviceCategory'],ENT_QUOTES,'utf-8', TRUE);
    $subcategoryName = htmlentities($_POST['subCategoryName'],ENT_QUOTES,'utf-8', TRUE);
    $response = $operationInstance->addSubCategory($subcategoryName,$CategoryId);
    if($response):
        $actual_link = $formUrl."/subCategoryAdd-form.php?success=1";
        header("Location: $actual_link");
    else:
        echo "something went wrong.";
        $actual_link = $formUrl."/subCategoryAdd-form.php?success=0";
        header("Location: $actual_link");
    endif;
endif;

////////////////////////////// NEW BILL ADD
if(isset($_POST['billFormSubmit'])):
    print_r($_REQUEST['serviceCategory']);
endif;

////////////////////////ADD NEW PRODUCT
if(isset($_POST['productFormSubmit'])):
    $productName = htmlentities($_POST['productName'],ENT_QUOTES,'utf-8', TRUE);
    $productCost = htmlentities($_POST['productCost'],ENT_QUOTES,'utf-8', TRUE);
    $qty = htmlentities($_POST['qty'],ENT_QUOTES,'utf-8', TRUE);
    $response = $operationInstance->addNewProduct($productName,$productCost,$qty);
    if($response):
        $actual_link = $formUrl."/product-form.php?success=1";
        header("Location: $actual_link");
    else:
        echo "something went wrong.";
        $actual_link = $formUrl."/product-form.php?success=0";
        header("Location: $actual_link");
    endif;
endif;
////////////////////////ADD MAJOR SERVICE
if(isset($_POST['majorServiceForm'])):
    $serviceName = htmlentities($_POST['serviceName'],ENT_QUOTES,'utf-8', TRUE);
    $response = $operationInstance->addMajorService($serviceName);
    if($response):
        $actual_link = $formUrl."/majorServiceAdd-form.php?success=1";
        header("Location: $actual_link");
    else:
        echo "something went wrong.";
        $actual_link = $formUrl."/majorServiceAdd-form.php?success=0";
        header("Location: $actual_link");
    endif;
endif;

//////////ADD INVENTORY OF PRODUCTS
if(isset($_POST['inventorySubmit'])):
    $productID = htmlentities($_POST['productSelect'],ENT_QUOTES,'utf-8', TRUE);
    $productCost = htmlentities($_POST['prodPrice'],ENT_QUOTES,'utf-8', TRUE);
    $qty = htmlentities($_POST['qty'],ENT_QUOTES,'utf-8', TRUE);
    $response = $operationInstance->addInventory($productID,$productCost,$qty);
    if($response):
        $actual_link = $formUrl."/inventory-form.php?success=1";
        header("Location: $actual_link");
    else:
        echo "something went wrong.";
        $actual_link = $formUrl."/inventory-form.php?success=0";
        header("Location: $actual_link");
    endif;
endif;
////ADD STAFF MEMBERS
if(isset($_POST['staffFormSubmit'])):
    $name = htmlentities($_POST['staffName'],ENT_QUOTES,'utf-8', TRUE);
    $designation = htmlentities($_POST['designation'],ENT_QUOTES,'utf-8', TRUE);
    $phno = htmlentities($_POST['phno'],ENT_QUOTES,'utf-8', TRUE);
    $response = $operationInstance->addStaffMembers($name,$designation,$phno);
    if($response):
        $actual_link = $formUrl."/staff-form.php?success=1";
        header("Location: $actual_link");
    else:
        echo "something went wrong.";
        $actual_link = $formUrl."/staff-form.php?success=0";
        header("Location: $actual_link");
    endif;
endif;
