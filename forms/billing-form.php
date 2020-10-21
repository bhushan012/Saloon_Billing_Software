<?php
include "../header.php";
include "../operations.php";
$operationInstance = new Operations();
$successResponse = "3";
if (isset($_GET['success'])) {
    $successResponse = $_GET['success'];
}
?>
<div class="row">
    <div class="col-md-8">
        <form id="BillingForm" action="../submitData.php">
            <h1 class="display-5">Billing</h1>

            <div class="form-row mt-3 after-add-more">
                <div class="form-group col-md-4">
                    <label class="h6">Service Category:</label>
                    <select class="form-control" id="serviceCategoryBilling" name="serviceCategoryBilling" required>
                        <option value="">Services Type</option>
                        <?php
                        $result = $operationInstance->getAllSaloonCategory();
                        while ($row = $result->fetch_assoc()) {
                            echo "<option value=" . $row['categoryId'] . ">" . $row['categoryName'] . "</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label class="h6">Service:</label>
                    <select class="form-control" id="serviceCategory" name="serviceCategory" required>
                        <option value="">Service Name</option>
                    </select>
                </div>
                <div class="form-group col-md-4 text-center mb-2" style="place-self: flex-end;">
                    <div class="input-group-btn">
                        <button class="btn btn-success" id="billingAddService" type="button"><i class="fa fa-plus"></i><span class="h6"> Add Service</span></button>
                    </div>
                </div>
            </div>
            <div class="dropdown-divider"></div>
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
                <input type="hidden" id="customerId">
                <div class="col-md-12 d-none" id="customerSearchContact">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="search-box">
                                <input class="form-control p-3" id="searchCustomerC" type="text" autocomplete="on" placeholder="Search customer..." />
                                <div class="result"></div>
                            </div>
                        </div>
                        <div class="col-md-6">Customer Name: <span class="searchedCustomerResult"></span>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 d-none"  id="customerSearchRandom">
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
            <div class="row">
                <div class="col-md-12">
                    <label class="h6">Staff:</label>
                    <select class="form-control" id="staffSelect" name="staffDetail" required>
                        <option value="">Staff Names</option>
                        <?php
                        $result = $operationInstance->fetchStaffMembers();
                        while ($row = $result->fetch_assoc()) {
                            echo "<option value=" . $row['staffID'] . ">" . $row['staffName'] . "</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="dropdown-divider"></div>
            <div class="row">
                <div class="col-md-4 text-center">
                    <div class="form-check mt-2">
                        <input class="form-check-input" type="checkbox" value="1" id="defaultCheck1">
                        <label class="form-check-label" for="defaultCheck1">
                            Discount
                        </label>
                    </div>
                </div>
                <div class="col-md-4 dicountCol" style="display:none;">
                    <div class="input-group flex-nowrap">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="addon-wrapping">%</span>
                        </div>
                        <input type="text" id="discountPercent" class="form-control" placeholder="Percentage" aria-label="Username" aria-describedby="addon-wrapping">
                    </div>
                </div>
                <div class="col-md-4 dicountCol" style="display:none;">
                    <div class="input-group-btn ">
                        <button class="btn btn-success" id="discountBtn" type="button"><i class="fa fa-check-square-o"></i><span class="h6"> Discount</span></button>
                    </div>
                </div>
            </div>
            <?php
            $response = "";
            if ($successResponse == 1) {
                echo '<div class="valid-feedback">Details Stored Successfully!</div>';
            } else if ($successResponse == 0) {
                echo '<div class="invalid-feedback">Something went wrong. Try again.</div>';
            }
            ?>
        </form>
    </div>
    <div class="col-md-4 border-primary border border-right-0 border-top-0 border-bottom-0" style="position: relative;min-height: 92vh;">
        <div class="servicesWithPrice row text-center border-primary border-primary border border-right-0 border-top-0 border-left-0 pb-2">
            <div class="col-md-8">
                <div>Service</div>
            </div>
            <div class="col-md-4">
                <div>Cost</div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8">
                <div id="serviceList"></div>
            </div>
            <div class="col-md-4 text-center">
                <div id="costList"></div>
            </div>
        </div>
        <div style="margin-top: 71%;"></div>
        <div class="totalWithGenerateBill border border-right-0 border-left-0 border-bottom-0 pt-2" style="position: absolute;bottom: 10px;left: 0;right: 0;">
            <div class="row ">
                <div class="col-md-8">
                    <p class="font-weight-bold pl-4 mb-0">Total</p>

                    <p class="font-weight-bold pl-4 mb-0">Discount</p>
                    <!-- <p class="font-weight-bold pl-4 mb-0">Taxes</p> -->
                    <div class="dropdown-divider"></div>
                    <p class="font-weight-bold pl-4 mb-0">Amount Payable</p>
                </div>
                <div class="col-md-4 text-center">
                    <p class="mb-0" id="total">0</p>

                    <p class="mb-0" id="discount">0</p>
                    <!-- <p class="mb-0" id="taxes">1000</p> -->
                    <div class="dropdown-divider"></div>
                    <p class="mb-0" id="subTotal">0</p>
                </div>
            </div>
            <div class="text-center"><button class="mt-2 btn btn-success">PRINT BILL</button></div>
            <div class="text-center" id="saveBill"><button class="mt-2 btn btn-success">SAVE BILL</button></div>
        </div>
    </div>
</div>


<?php include "../footer.php"; ?>