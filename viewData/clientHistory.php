<?php
include "../header.php";
include "../operations.php";
$operationInstance = new Operations();
?>
<h1 class="display-5 mt-3">Client History </h1>
<div class="mt-3">
    <label>Select Client:</label>
    <select class="form-control" id="customerList" name="productSelect" required>
        <option value="">Customers</option>
        <?php
        $result = $operationInstance->getAllCustomers();
        while ($row = $result->fetch_assoc()) {
            echo "<option value=" . $row['customer_Id'] . ">" . $row['fullName'] . "</option>";
        }
        ?>
    </select>
</div>
<div class="row">
    <div class="col-md-6">
        <label class="h6">Customer:</label>
        <select class="form-control" id="customerTypeSelect" name="serviceCategoryBilling" required>
            <option value="">Customer Type</option>
            <?php
            $result = $operationInstance->getCustomerType();
            while ($row = $result->fetch_assoc()) {
                echo "<option value=" . $row['typeId'] . ">" . $row['typeName'] . "</option>";
            }
            ?>
        </select>
    </div>
    <div class="col-md-6 d-none" id="searchByRow">
        <label class="h6">Search:</label>
        <select class="form-control " id="searchBySelect" name="serviceCategoryBilling" required>
            <option value="">Search By</option>
            <option value="1">Name</option>
            <option value="2">Phone Number</option>
        </select>
    </div>
</div>
<div class="row mt-3">
    <div class="col-md-12 d-none" id="customerSearchName">
        <div class="row">
            <div class="col-md-6">
                <div class="search-box">
                    <input class="form-control p-3" id="searchCustomer" type="text" autocomplete="on" placeholder="Search customer..." />
                    <div class="result"></div>
                </div>
            </div>
            <div class="col-md-6">Customer Name: <span class="searchedCustomerResult"></span></div>
        </div>
    </div>
    <!-- <input type="hidden" id="customerId"> -->
    <div class="col-md-12 d-none" id="customerSearchContact">
        <div class="row">
            <div class="col-md-6">
                <div class="search-box">
                    <input class="form-control p-3" id="searchCust" type="text" autocomplete="on" placeholder="Search customer..." />
                    <div class="custResult"></div>
                </div>
            </div>
            <div class="col-md-6">Customer Name: <span class="searchedCustomerResult"></span>
            </div>
        </div>
    </div>
    <div class="col-md-12 d-none" id="customerSearchRandom">
        <div class="row">
            <div class="col-md-6">
                <div class="search-box">
                    <input class="form-control p-3" id="searchRandom" type="text" autocomplete="on" placeholder="Customer Name" />
                </div>
            </div>
            <div class="col-md-6">Customer Name: <span id="searchedNameRandom"></span>
            </div>
        </div>
    </div>
</div>
<div class="dropdown-divider"></div>
<div id="inventoryData">

</div>


<!-- Modal -->
<div class="modal right fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-header bg-warning text-white">
                <h4 class="modal-title" id="myModalLabel2">Bill ID: </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

            </div>

            <div class="modal-body ">

                <div id="showServiceData">

                </div>
            </div>

        </div><!-- modal-content -->
    </div><!-- modal-dialog -->
</div><!-- modal -->
<?php include "../footer.php"; ?>