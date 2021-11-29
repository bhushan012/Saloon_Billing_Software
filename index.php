<?php 
include 'urlMapping.php';
session_start();
if(!empty($_SESSION['username'])){
    if($_SESSION['user_type'] == 1){
        header('Location: '.$formUrl.'/dashboard.php'); 
    }else{
        header('Location: '.$formUrl.'/billing-form.php'); 
    }
    
}else{
    header('Location: '.$homeUrl.'/login.php'); 
}

// 
?>
