<?php include "urlMapping.php"; 
date_default_timezone_set('Asia/Kolkata');

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="<?= $homeUrl; ?>/assets/img/mdb-favicon.ico" />
    <title>Barbery Billing Software</title>
    <link rel="stylesheet" href="<?= $homeUrl; ?>/assets/bootstrap-4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= $homeUrl; ?>/assets/less/style.css?version=<?php echo rand(); ?>">
    <link rel="stylesheet" href="<?= $homeUrl; ?>/assets/css/dashboard.css">
    <link rel="stylesheet" href="<?= $homeUrl; ?>/assets/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?= $homeUrl; ?>/assets/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="<?= $homeUrl; ?>/assets/dataTables/css/addons/datatables.min.css">
    <link rel="stylesheet" href="<?= $homeUrl; ?>/assets/autoComplete/autocomplete.min.css">
    <link rel="stylesheet" href="<?= $homeUrl; ?>/assets/css/mdb.min.css">
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> -->
</head>

<?php 
if (!isset($_SESSION)) { session_start(); print_r($_SESSION);}
session_start();
// echo "USERNAME: ".$_SESSION['username'];
// if(isset($_SESSION['test'])){
    // header('Location: '.$homeUrl.'/login.php'); 
    print_r($_SESSION);
// }
?>
<body id="bodyLoad" class="blue" style="overflow-x: hidden;">
    <div class="loading" id="loading">

        <div class="finger finger-1">
            <div class="finger-item">
                <span></span><i></i>
            </div>
        </div>
        <div class="finger finger-2">
            <div class="finger-item">
                <span></span><i></i>
            </div>
        </div>
        <div class="finger finger-3">
            <div class="finger-item">
                <span></span><i></i>
            </div>
        </div>
        <div class="finger finger-4">
            <div class="finger-item">
                <span></span><i></i>
            </div>
        </div>
        <div class="last-finger">
            <div class="last-finger-item"><i></i></div>
        </div>
        <div class="company">
            <h6>WEBLOZEE <span class="creations">Creation</span></h6>
        </div>
    </div>
    <nav id="one" class="d-none  navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
        <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="<?php echo $homeUrl?>"><img style="height: 50px;" class="img-fluid" src="<?php echo $homeUrl.'/assets/images/tranquil-Logo-icon.png'?>"></a>
        <!-- <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search"> -->
        <ul class="navbar-nav px-3">
        <?php if($_SESSION['user_type'] == '1'){ ?>
            <li class="nav-item text-nowrap">
                <a class="nav-link" href="<?php echo $homeUrl."/backupdb.php";?>"><i style=" width: 16px;height: 16px;" class="fa fa-hdd-o"></i> Backup</a>
            </li>
        <?php } ?>
            <li class="nav-item text-nowrap">
                <a class="nav-link" href="<?php echo $homeUrl."/login.php";?>"><i class="fa fa-sign-out" style=" width: 16px;height: 16px;"></i>Sign out</a>
            </li>
        </ul>
    </nav>
    <div id="two" class="container-fluid d-none">
        <div class="row">
            <nav class="col-md-2 d-none d-md-block bg-light sidebar">
                <div class="sidebar-sticky company_header">
                    <div class="position-absolute opacity">

                    </div>
                    <ul class="nav flex-column">
                    <?php if($_SESSION['user_type'] == '1'){ ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= $formUrl; ?>/dashboard.php">
                                <i class="fa fa-circle-o-notch " style="
    width: 16px;
    height: 16px;
"></i>
                                Dashboard <span class="sr-only">(current)</span>
                            </a>
                        </li>
                        <?php } ?>
                        <!-- <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="fa fa-plus"></i>
                                Fund
                            </a>
                        </li> -->
                        <!-- <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="fa fa-minus"></i>
                                Expense
                            </a>
                        </li> -->
                        <li class="nav-item">
                            <a class="nav-link" style="cursor:pointer;" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                                <!-- <a class="nav-link" href=""> -->
                                <i class="fa fa-users" style="
    width: 16px;
    height: 16px;
"></i>
                                Customers
                            </a>
                            <div class="collapse" id="collapseExample">
                                <ul class="nav flex-column">
                                    <li class="nav-item">
                                        <a class="pl-5 nav-link pt-0" href="<?= $formUrl; ?>/customer-form.php"><i class="fa fa-plus p-1"></i>ADD</a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="pl-5 nav-link pt-0" href="<?= $viewDataUrl; ?>/customer.php"><i class="fa fa-eye p-1"></i>VIEW</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" style="cursor:pointer;" data-toggle="collapse" data-target="#collapseService" aria-expanded="false" aria-controls="collapseService">
                                <i class="fa fa-handshake-o" style="
    width: 16px;
    height: 16px;
"></i>
                                Service
                            </a>
                            <div class="collapse" id="collapseService">
                                <ul class="nav flex-column">
                                    <li class="nav-item">
                                        <a class="pl-5 nav-link pt-0" href="<?= $formUrl; ?>/services-form.php"><i class="fa fa-plus p-1"></i>ADD</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="pl-5 nav-link pt-0" href="<?= $formUrl; ?>/majorServiceAdd-form.php"><i class="fa fa-plus p-1"></i>ADD CATEGORY</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="pl-5 nav-link pt-0" href="<?= $formUrl; ?>/subCategoryAdd-form.php"><i class="fa fa-plus p-1"></i>ADD SUB-CATEGORY</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="pl-5 nav-link pt-0" href="<?= $viewDataUrl; ?>/services.php"><i class="fa fa-eye p-1"></i>VIEW</a>
                                    </li>
                                </ul>
                            </div>

                        </li>
                        <li class="nav-item">
                            <a class="nav-link" style="cursor:pointer;" data-toggle="collapse" data-target="#collapseInventory" aria-expanded="false" aria-controls="collapseService">
                                <i class="fa fa-indent" style=" width: 16px;height: 16px;"></i>
                                Inventory
                            </a>
                            <div class="collapse" id="collapseInventory">
                                <ul class="nav flex-column">
                                    <li class="nav-item">
                                        <a class="pl-5 nav-link pt-0" href="<?= $formUrl; ?>/product-form.php"><i class="fa fa-plus p-1"></i>ADD NEW PRODUCTS</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="pl-5 nav-link pt-0" href="<?= $viewDataUrl; ?>/inventory.php"><i class="fa fa-eye p-1"></i>VIEW</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="pl-5 nav-link pt-0" href="<?= $formUrl; ?>/inventory-form.php"><i class="fa fa-tachometer p-1"></i>MANAGE INVENTORY</a>
                                    </li>
                                </ul>
                            </div>

                        </li>
                        <li class="nav-item">
                            <a class="nav-link" style="cursor:pointer;" data-toggle="collapse" data-target="#collapseStaff" aria-expanded="false" aria-controls="collapseService">
                                <i class="fa fa-indent" style=" width: 16px;height: 16px;"></i>
                                Staff
                            </a>
                            <div class="collapse" id="collapseStaff">
                                <ul class="nav flex-column">
                                    <li class="nav-item">
                                        <a class="pl-5 nav-link pt-0" href="<?= $formUrl; ?>/staff-form.php"><i class="fa fa-plus p-1"></i>ADD STAFF</a>
                                    </li>
                                    <?php if($_SESSION['user_type'] == '1'){ ?>
                                    <li class="nav-item">
                                        <a class="pl-5 nav-link pt-0" href="<?= $viewDataUrl; ?>/staffHistory.php"><i class="fa fa-eye p-1"></i>STAFF</a>
                                    </li>
                                    <?php } ?>
                                    
                                    <!-- <li class="nav-item">
                                        <a class="pl-5 nav-link pt-0" href="<?= $formUrl; ?>/inventory-form.php"><i class="fa fa-tachometer p-1"></i>MANAGE INVENTORY</a>
                                    </li>  -->
                                </ul>
                            </div>

                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= $formUrl; ?>/billing-form.php">
                                <i class="fa fa-usd" style="width: 16px;height: 16px;"></i>
                                Billing
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= $viewDataUrl; ?>/bills.php">
                                <i class="fa fa-eye" style="
    width: 16px;
    height: 16px;
"></i>
                                View Billing
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= $viewDataUrl; ?>/clientHistory.php">
                                <i class="fa fa-eye" style="
    width: 16px;
    height: 16px;
"></i>
                                Client History
                            </a>
                        </li>
                        <!-- <li class="nav-item">
                            <a class="nav-link" href="#">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-layers">
                                    <polygon points="12 2 2 7 12 12 22 7 12 2"></polygon>
                                    <polyline points="2 17 12 22 22 17"></polyline>
                                    <polyline points="2 12 12 17 22 12"></polyline>
                                </svg>
                                Integrations
                            </a>
                        </li> -->
                    </ul>

                    <!-- <h6
                        class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                        <span>Saved reports</span>
                        <a class="d-flex align-items-center text-muted" href="#">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="feather feather-plus-circle">
                                <circle cx="12" cy="12" r="10"></circle>
                                <line x1="12" y1="8" x2="12" y2="16"></line>
                                <line x1="8" y1="12" x2="16" y2="12"></line>
                            </svg>
                        </a>
                    </h6> -->
                    <!-- <ul class="nav flex-column mb-2">
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-file-text">
                                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                    <polyline points="14 2 14 8 20 8"></polyline>
                                    <line x1="16" y1="13" x2="8" y2="13"></line>
                                    <line x1="16" y1="17" x2="8" y2="17"></line>
                                    <polyline points="10 9 9 9 8 9"></polyline>
                                </svg>
                                Current month
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-file-text">
                                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                    <polyline points="14 2 14 8 20 8"></polyline>
                                    <line x1="16" y1="13" x2="8" y2="13"></line>
                                    <line x1="16" y1="17" x2="8" y2="17"></line>
                                    <polyline points="10 9 9 9 8 9"></polyline>
                                </svg>
                                Last quarter
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-file-text">
                                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                    <polyline points="14 2 14 8 20 8"></polyline>
                                    <line x1="16" y1="13" x2="8" y2="13"></line>
                                    <line x1="16" y1="17" x2="8" y2="17"></line>
                                    <polyline points="10 9 9 9 8 9"></polyline>
                                </svg>
                                Social engagement
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-file-text">
                                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                    <polyline points="14 2 14 8 20 8"></polyline>
                                    <line x1="16" y1="13" x2="8" y2="13"></line>
                                    <line x1="16" y1="17" x2="8" y2="17"></line>
                                    <polyline points="10 9 9 9 8 9"></polyline>
                                </svg>
                                Year-end sale
                            </a>
                        </li>
                    </ul> -->
                </div>
            </nav>
            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
                <!-- https://getbootstrap.com/docs/4.1/examples/dashboard/# refer this url -->