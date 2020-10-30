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

</html>