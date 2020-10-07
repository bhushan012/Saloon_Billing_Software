<?php 
include "../header.php"; ?>
<div class="row mt-2">
    <div class="col-md-3">
        <div class="card border-success mb-3" style="max-width: 18rem;">
  <div class="card-header bg-transparent border-success">Total Sales</div>
  <div class="card-body text-success text-center">
    <h1 class="card-title">₹1.59L</h1>
  </div>
</div>
    </div>
    <div class="col-md-3">
        <div class="card border-danger mb-3" style="max-width: 18rem;">
  <div class="card-header bg-transparent border-danger">Total Discounts</div>
  <div class="card-body text-danger text-center">
    <h1 class="card-title">₹3K</h1>
  </div>
</div>
    </div>
    <div class="col-md-3">
        <div class="card border-info mb-3" style="max-width: 18rem;">
  <div class="card-header bg-transparent border-info">Total Customers</div>
  <div class="card-body text-info text-center">
    <h1 class="card-title">300</h1>
  </div>
 
</div>
    </div>
    <div class="col-md-3">
        <div class="card border-warning mb-3" style="max-width: 18rem;">
  <div class="card-header bg-transparent border-warning">Total Services</div>
  <div class="card-body text-warning text-center">
    <h1 class="card-title">75</h1>
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