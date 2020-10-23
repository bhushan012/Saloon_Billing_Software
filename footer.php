<?php include "urlMapping.php"; ?>

</main>
</div>
</div>
</body>
<footer>
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#staticBackdrop">
        Launch static backdrop modal
    </button>

    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Understood</button>
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