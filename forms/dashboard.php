<?php 
include "../header.php"; 
include "../operations.php";
$operationInstance = new Operations();
?>
<div class="row mt-2">
    <div class="col-md-3">
        <div class="card border-success mb-3" style="max-width: 18rem;">
  <div class="card-header bg-transparent border-success">Total Sales</div>
  <div class="card-body text-success text-center">
    <?
       $result = $operationInstance->getTotalSales();
       while ($row = $result->fetch_assoc()) {
           echo "<h1 class='card-title'>₹" . $row['total'] . "</h1>";
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
       while ($row = $result->fetch_assoc()) {
           echo "<h1 class='card-title'>₹" . $row['discount'] . "</h1>";
       }
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
       while ($row = $result->fetch_assoc()) {
           echo "<h1 class='card-title'>" . $row['customers'] . "</h1>";
       }
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
       while ($row = $result->fetch_assoc()) {
           echo "<h1 class='card-title'>" . $row['services'] . "</h1>";
       }
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
<script type="text/javascript">
    var ctx = document.getElementById("myChart").getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ["Jan", "Feb", "Mar", "April", "May", "June", "Jul", "Aug", "Sept", "Nov", "Dec"],
            datasets: [{
                label: 'Sales per month',
                data: [5000, 10000, 20000, 40000, 5000, 20000, 30000, 50000, 90000, 30000, 50000, 80000],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)',
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255,99,132,1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)',
                    'rgba(255,99,132,1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });


</script>
<?php include "../footer.php"; ?>