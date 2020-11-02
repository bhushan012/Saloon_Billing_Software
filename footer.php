<?php include "urlMapping.php"; ?>

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
                    <button type="button" class="btn btn-info waves-effect waves-light text-white" ><a href="<?= $viewDataUrl; ?>/bills.php"><i class="fa fa-check "></i></a></button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
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
});


</script>
</html>