<?php
include "../operations.php";
$operationInstance = new Operations();
$creditInstance = new Operations();
$custID = $_POST['custID'];
// $month = $_POST['month'];
$userCredit =  $creditInstance->getCreditByCustomerId($custID);
?>
<div class="mt-3 row">
    <div class="col-md-6 mt-4">
        <h6>Credit Pending: <?php echo $userCredit; ?></h6>
    </div>
    <div class="col-md-6">
        <div class="row">
            <div class="col-md-6">
                <div class="input-group mt-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="addon-wrapping">₹</span>
                    </div>
                    <input type="text" id="amntId" value="0" class="form-control" placeholder="Amount" aria-label="Amount" aria-describedby="addon-wrapping">
                </div>
            </div>
            <div class="col-md-6"><button id="creditClear" type="button" class="mt-2 btn btn-primary is-invalid waves-effect waves-light">Pay Credit</button></div>
        </div>
    </div>
</div>
<table class="table table-striped table-bordered table-sm mt-4" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th class="th-sm">Sr. No.
            </th>
            <th class="th-sm">Bill No.
            </th>
            <th class="th-sm">Staff Attended
            </th>
            <th class="th-sm">Amount
            </th>
            <th class="th-sm">Visit Date</th>
            <th class="th-sm">View Services
            </th>
        </tr>
    </thead>
    <?php
    $result =  $operationInstance->getClientHistory($custID);
    if ($result != '') {


        if ($result->num_rows > 0) {
            $i = 0;

    ?>

            <tbody>
                <?php
                $totalExpense = 0;
                while ($row = $result->fetch_assoc()) {
                    $i++;
                    $totalExpense = $totalExpense + $row['billAmountPayable'];
                    $name = $row['fullName'];
                    $allergy = $row['allergy'];
                    $medication = $row['medicationDetails'];
                    $member = $row['membership'] == 0 ? "YES" : "NO";
                    $contactno = $row['contactNumber'];
                    $address = $row['address'];
                ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $row['billNo']; ?></td>
                        <td><?php echo $row['staffName']; ?></td>
                        <td><?php echo $row['billAmountPayable']; ?></td>
                        <td><?php echo $row['billDate']; ?></td>
                        <td><button type="button" class="btn btn-demo clientServiceHistory" data-name="<?php echo $row['fullName']; ?>" data-billid="<?php echo $row['billNo']; ?>" data-toggle="modal" data-target="#myModal2">
                                View
                            </button></td>
                    </tr>


                <?php

                }
                ?>
            </tbody>

        <?php
        }
    } else { ?>
        <tr>
            <td></td>
            <td></td>
            <td class="text-center">
                <p>NO DATA FOUND</p>
            </td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
    <?php
    }
    ?>
    <tfoot>
        <tr>
            <th>Sr. No.
            </th>
            <th>Bill No.
            </th>
            <th>Staff Attended
            </th>
            <th>Amount
            </th>
            <th>Visit Date</th>
            <th>View Services
            </th>
        </tr>
    </tfoot>
</table>
<input type="hidden" id="customerId" value="<?php echo $custID; ?>" />
<div class="mt-3 row">
    <div class="col-md-12">
        <?php if (isset($name)) : ?> <h4><?= $name; ?>'s Details:</h4><?php endif; ?>

    </div>
    <div class="col-md-6">
        <h6>Name: </h6>
    </div>
    <div class="col-md-6">
        <p><?php echo $name ?? ""; ?></p>
    </div>
    <div class="col-md-6">
        <h6>Address: </h6>
    </div>
    <div class="col-md-6">
        <p><?php echo $address ?? ""; ?></p>
    </div>
    <div class="col-md-6">
        <h6>Contact No.: </h6>
    </div>
    <div class="col-md-6">
        <p><?php echo $contactno ?? ""; ?></p>
    </div>
    <div class="col-md-6">
        <h6>Medications: </h6>
    </div>
    <div class="col-md-6">
        <p><?php echo $medication ?? ""; ?></p>
    </div>
    <div class="col-md-6">
        <h6>Allergy: </h6>
    </div>
    <div class="col-md-6">
        <p><?php echo $allergy ?? ""; ?></p>
    </div>
    <div class="col-md-6">
        <h6>Membership: </h6>
    </div>
    <div class="col-md-6">
        <p><?php echo $member ?? ""; ?></p>
    </div>
    <div class="col-md-6">
        <h6>Total Amount: </h6>
    </div>
    <div class="col-md-6">
        <p>Rs. <?php echo $totalExpense ?? ""; ?></p>
    </div>
</div>