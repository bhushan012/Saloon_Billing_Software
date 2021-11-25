<?php 
include 'urlMapping.php';
if(!(empty($_SESSION['username']))){
    header('Location: '.$formUrl.'/dashboard.php'); 
}else{
    header('Location: '.$homeUrl.'/login.php'); 
}

// 
?>
