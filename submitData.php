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

////////////////////////////// NEW SERVICE ADD
if(isset($_POST['servicesFormSubmit'])):
    $serviceCategory = htmlentities($_POST['serviceCategory'],ENT_QUOTES,'utf-8', TRUE);
    $serviceName = htmlentities($_POST['serviceName'],ENT_QUOTES,'utf-8', TRUE);
    $serviceCost = htmlentities($_POST['serviceCost'],ENT_QUOTES,'utf-8', TRUE);
    $response = $operationInstance->addService($serviceCategory,$serviceName,$serviceCost);
    if($response):
        $actual_link = $formUrl."/services-form.php?success=1";
        header("Location: $actual_link");
    else:
        echo "something went wrong.";
        $actual_link = $formUrl."/services-form.php?success=0";
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
