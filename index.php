<?php 
include 'urlMapping.php';
session_start();
if(!empty($_SESSION['username'])){
    header('Location: '.$formUrl.'/dashboard.php'); 
}else{
    header('Location: '.$homeUrl.'/login.php'); 
}

// 
?>
