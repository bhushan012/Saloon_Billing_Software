<?php include "urlMapping.php"; 
session_destroy();
// if(!empty($_SESSION['username'])){
//     header('Location: '.$formUrl.'/dashboard.php'); 
// }
$error = "3";
if(isset($_GET['success'])){
    $error = $_GET['error'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="<?= $homeUrl; ?>/assets/img/mdb-favicon.ico" />
    <title>Barbery Billing Software</title>
    <link rel="stylesheet" href="<?= $homeUrl; ?>/assets/bootstrap-4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= $homeUrl; ?>/assets/less/login.css">
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> -->
</head>
<body>
<header>
<div class="sidenav">
    <div class="login-main-text">
        <h2>Barbery<br> Login Page</h2>
        <p><span class="brand">The Tranquil Treat</span> Billing Software.</p>
        <sub style="font-size: small;">Version 1.0.0</sub>
    </div>
</div>
</header>
<main>
<div class="main">
    <div class="col-md-6 col-sm-12">
        <div class="login-form">
            <form method="POST" action="<?= $homeUrl; ?>/submitData.php">
                <div class="form-group">
                    <label>User Name</label>
                    <input type="text" name="username" class="form-control" placeholder="User Name" required>
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Password" required>
                </div>
                <button type="submit" name="login_submit" class="btn btn-black">Login</button>
                <?php 
                    $response = "";
                    if($error == '1'){
                        echo '<div class="invalid-feedback">Incorrect Credentials.</div>';
                    }
                ?>
            </form>
        </div>
    </div>
</div>
</main>
<footer>
<script src="<?= $homeUrl; ?>/assets/js/jquery-3.5.1.js" ></script>
<script src="<?= $homeUrl; ?>/assets/bootstrap-4.4.1/js/bootstrap.min.js"></script>
</footer>
</body>
</html>