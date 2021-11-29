<?php 
include "../header.php"; 
include "../operations.php";
$operationInstance = new Operations();
// if($_SESSION['user_type'] == '2'){
    
// }
// echo "Username: ".$_SESSION['username'];
// echo "UserType: ".$_SESSION['user_type'];
// echo "userId: ".$_SESSION['userId'];
?>

<div class="row mt-2">
    <div class="col-md-3">
        <div class="card border-success mb-3" style="max-width: 18rem;">
  <div class="card-header bg-transparent border-success">Total Sales</div>
  <div class="card-body text-success text-center">
    <?
       $result = $operationInstance->getTotalSales();
       if($result != ''){
        while ($row = $result->fetch_assoc()) {
            echo "<h1 class='card-title'>₹" . $row['total'] . "</h1>";
        }
       }
    ?>
    <!-- <h1 class="card-title">₹1.59L</h1> -->
  </div>
</div>
    </div>
    <div class="col-md-3">
        <div class="card border-danger mb-3" style="max-width: 18rem;">
  <div class="card-header bg-transparent border-danger">Total Discounts</div>
  <div class="card-body text-danger text-center">
  <?
       $result = $operationInstance->totalDiscount();
       if($result != ''){
       while ($row = $result->fetch_assoc()) {
           echo "<h1 class='card-title'>₹" . $row['discount'] . "</h1>";
       }}
    ?>
  </div>
</div>
    </div>
    <div class="col-md-3">
        <div class="card border-info mb-3" style="max-width: 18rem;">
  <div class="card-header bg-transparent border-info">Total Customers</div>
  <div class="card-body text-info text-center">
  <?
       $result = $operationInstance->getTotalCustomers();
       if($result != ''){
       while ($row = $result->fetch_assoc()) {
           echo "<h1 class='card-title'>" . $row['customers'] . "</h1>";
       }}
    ?>
  </div>
 
</div>
    </div>
    <div class="col-md-3">
        <div class="card border-warning mb-3" style="max-width: 18rem;">
  <div class="card-header bg-transparent border-warning">Total Services</div>
  <div class="card-body text-warning text-center">
  <?
       $result = $operationInstance->totalServices();
       if($result != ''){
       while ($row = $result->fetch_assoc()) {
           echo "<h1 class='card-title'>" . $row['services'] . "</h1>";
       }}
    ?>
  </div>
</div>
    </div>
</div>
<div class="row mt-5">
    <div class="col-md-6">
         <h3 class="text-center text-danger">Sales Chart</h3>
        <canvas id="myChart"></canvas>
    </div>
    <div class="col-md-6">
        <h3 class="text-center text-danger">Services Chart</h3>
        <canvas id="pieChart"></canvas>
    </div>
    
    
</div>

<?php include "../footer.php"; ?>
