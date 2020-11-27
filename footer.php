<?php 

include "urlMapping.php";
//include "operations.php";
//$operationInstance = new Operations(); 

?>
<?php
        $result = $operationInstance->getProductPrice(1);
        $perServiceCount = array();
        $months = array();
        $data = array();
        for ($i = 1; $i < 13; $i++) {
            $timestamp = mktime(0, 0, 0, $i, 1);
            $months[date('n', $timestamp)] = date('F', $timestamp);
        }

        $z=0;
        foreach ($months as $key => $value) {
            $result = $operationInstance->fetchMonthlySales($key);
            while ($row = $result->fetch_assoc()) {
                $data[$z]=  $row['total'];
            }
            $z++;
        }

        $result = $operationInstance->getAllServices();
        $i= 0 ;
        
        while ($row = $result->fetch_assoc()) {
            $services[$i] = $row['serviceName'];
            $id = $row['serviceId'];
            $result1 = $operationInstance->perServiceSale($id);
            while ($row1 = $result1->fetch_assoc()) {
                $perServiceCount[$i]=  $row1['totalCount'];
            }
            $i++;
        }
        //print_r($services);
?>
</main>
</div>
</div>
</body>
<footer>

    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" style="display: none;" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title" id="staticBackdropLabel">Success</h5>
                </div>
                
                <div class="modal-footer">
                    <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
                    <button type="button" class="btn btn-info waves-effect waves-light text-white" ><a href="<?=$formUrl; ?>/billing-form.php"><i class="fa fa-check "></i></a></button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
<!---Small Modal-->
    <div id="alertValidationModal" class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
  <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="staticBackdropLabel">See Whats Missing!</h5>
                </div>
                <div id="smallAlert" class="p-4">

                </div>
                
            </div>
        </div>
  </div>
</div>
<!---Small Modal-->
    <script src="<?= $homeUrl; ?>/assets/js/jquery-3.5.1.js"></script>
    <script src="<?= $homeUrl; ?>/assets/autoComplete/autocomplete.min.js"></script>
    <script src="<?= $homeUrl; ?>/assets/js/popper.min.js"></script>
    <script src="<?= $homeUrl; ?>/assets/js/mdb.min.js"></script>
    <script src="<?= $homeUrl; ?>/assets/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
    <!-- <script src="<?= $homeUrl; ?>/assets/fontawsome5.13.0/fontawesome.min.js"></script> -->
    <script src="<?= $homeUrl; ?>/assets/bootstrap-4.4.1/js/bootstrap.min.js"></script>
    <script src="<?= $homeUrl; ?>/assets/dataTables/js/addons/datatables.min.js"></script>

    <script src="<?= $homeUrl; ?>/assets/js/custom.js"></script>


</footer>

<script type="text/javascript">
$(document).ready(function(){
    console.log(<?php foreach($data as $key => $value){ echo "'"; echo $value; echo "'";echo ",";} ?>)
    var ctx = document.getElementById("myChart").getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ["Jan", "Feb", "Mar", "April", "May", "June", "Jul", "Aug", "Sept","Oct", "Nov", "Dec"],
            datasets: [{
                label: 'Sales per month',
                data: [<?php foreach($data as $key => $value){ echo "'"; echo $value; echo "'";echo ",";} ?>],
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
    // pie
    var ctxP = document.getElementById("pieChart").getContext('2d');
    var myPieChart = new Chart(ctxP, {
        type: 'pie',
        data: {
            labels: [<?php foreach($services as $key => $value){ echo "'"; echo $value; echo "'";echo ",";} ?>],
            datasets: [{
                data: [<?php foreach($perServiceCount as $key => $value){ echo "'"; echo $value; echo "'";echo ",";} ?>],
                backgroundColor: ["#F7464A", "#46BFBD", "#FDB45C", "#949FB1", "#4D5360"],
                hoverBackgroundColor: ["#FF5A5E", "#5AD3D1", "#FFC870", "#A8B3C5", "#616774"]
            }]
        },
        options: {
            responsive: true
        }
    });
});


</script>
</html>