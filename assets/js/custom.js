$(document).ready(function () {
    $("#loading").fadeOut(20000, function() {
        $("#bodyLoad").fadeIn(500000);        
    });
    var siteUrl = "http://parlourbilling.weblozee.com";
   
        
   
    // END MODEL
    $('#datepicker').datepicker({
        autoclose: true,
        endDate: "today",
    });
    $('#membership').click(function () {
        if ($(this).prop("checked") == true) {
            $("#contactNumber").prop('required', true);
        }
        else if ($(this).prop("checked") == false) {
            $("#contactNumber").prop('required', false);
        }
    });
    $("#contactNumber").on('keypress change paste keyup', function (e) {
        // e.preventDefault();
        var contactNumber = $(this).val();
        console.log(contactNumber);
        $.ajax({
            url: siteUrl + '/logic/verifyPhoneNumber.php',
            type: 'POST',
            data: { contactNumber: contactNumber },
            success: function (data) {
                console.log(data);
                if (data == 1) {
                    console.log("Contact Number not available.");
                    $('#contactNumber').removeClass("is-invalid");
                    $("#customerFormSubmit").prop('disabled', false);
                } else {
                    console.log("Contact number exists.");
                    $('#contactNumber').addClass("is-invalid");
                    $("#customerFormSubmit").prop('disabled', true);
                }
            },
            error: function (data) {
                console.log('failed ajax with error : ' + data);
            }
        });
    });
    $('#customersData').DataTable();
    function percentage(num, per) {
        return (num / 100) * per;
    }

    $("#discountBtn").on('click', function (e) {
        var totalAmt = parseInt($('#total').text());
        var discount = parseInt($('#discountPercent').val());
        var amtDiscounted = percentage(totalAmt, discount);
        $('#discount').empty().append(amtDiscounted);
        console.log(totalAmt + "totalAmt Price");
        $('#subTotal').empty().append(totalAmt - amtDiscounted);
    });
    $("#defaultCheck1").on('click', function (e) {
        if ($('#defaultCheck1').is(':checked')) {
            $('.dicountCol').css('display', 'block');
        } else {
            $('.dicountCol').css('display', 'none');
        }
    });
    $("#customerTypeSelect").on('change', function (e) {
        var customerTypeId = $(this).val();
        if (customerTypeId == "0" || customerTypeId == "1") {
            console.log("registered || member");
            $('#searchByRow').attr("class", "col-md-4 d-block");
            $('#customerSearchRandom').attr("class", "col-md-12 d-none");
        } else{
            console.log("random");
            $('#searchByRow').attr("class", "col-md-4 d-none");
            $('#customerSearchRandom').attr("class", "col-md-12 d-block");
            $('#customerSearchName').attr("class", "col-md-12 d-none");
            $('#customerSearchContact').attr("class", "col-md-12 d-none");
            // $('#customerSearchRandom').removeClass("d-none");
            // $('#customerSearchRandom').addClass("col-md-12 d-block");
        }
    });
    $("#searchBySelect").on('change', function (e) {
        var searchBy = $(this).val();
        if (searchBy == "1") {
            $('#customerSearchName').attr("class", "col-md-12 d-block");
            $('#customerSearchContact').attr("class", "col-md-12 d-none");
        }
        else if(searchBy == "2"){
            $('#customerSearchName').attr("class", "col-md-12 d-none");
            $('#customerSearchContact').attr("class", "col-md-12 d-block");
        }else{
            $('#customerSearchName').attr("class", "col-md-12 d-none");
            $('#customerSearchContact').attr("class", "col-md-12 d-none");
        }
    });
    $("#serviceCategoryBilling").on('change', function (e) {
        var serviceCategoryBilling = $(this).val();
        console.log(serviceCategoryBilling);
        $.ajax({
            url: siteUrl + '/logic/servicesListByCategory.php',
            type: 'POST',
            data: { serviceCategoryBilling: serviceCategoryBilling },
            success: function (data) {
                console.log(data);
                $('#serviceCategory').html(data);
            },
            error: function (data) {
                console.log('failed ajax with error: ' + data);
            }
        });
    });
    //GET PRODUCT PRICE AJAX
    $("#productSelect").on('change', function (e) {
        var productSelect = $(this).val();
        console.log(productSelect);
        $.ajax({
            url: siteUrl + '/logic/productLatestPrice.php',
            type: 'POST',
            data: { productSelect: productSelect },
            success: function (data) {
                console.log(data);
                $('#priceDisplay').html('');
                $('#priceDisplay').html(data);
            },
            error: function (data) {
                console.log('failed ajax with error: ' + data);
            }
        });
    });
    //GET PRODUCT EXPANSE TABLE AJAX
    $("#selectMonth , #prodList").on('change', function (e) {
        var month = $('#selectMonth').val();
        var prodID = $('#prodList').val();
        console.log("month" + month);
        console.log("prod" + prodID);
        $.ajax({
            url: siteUrl + '/logic/inventoryTable.php',
            type: 'POST',
            data: { month: month, prodID: prodID },
            success: function (data) {
                console.log(data);
                $('#inventoryData').html('');
                $('#inventoryData').html(data);
            },
            error: function (data) {
                console.log('failed ajax with error: ' + data);
            }
        });
    });
    //GET STAFF SERVICE HISTORY
    $("#selectMonth1 , #staffList").on('change', function (e) {
        var month = $('#selectMonth1').val();
        var staffID = $('#staffList').val();
        console.log("month" + month);
        console.log("staff" + staffID);
        $.ajax({
            url: siteUrl + '/logic/staffServiceHistory.php',
            type: 'POST',
            data: { month: month, staffID: staffID },
            success: function (data) {
                console.log(data);
                $('#inventoryData').html('');
                $('#inventoryData').html(data);
            },
            error: function (data) {
                console.log('failed ajax with error: ' + data);
            }
        });
    });
    //GET CUSTOMER HISTORY
    $("#customerList").on('change', function (e) {
        //var month = $('#selectMonth1').val();
        var custID = $('#customerList').val();
        //console.log("month" + month);
        console.log("staff" + custID);
        $.ajax({
            url: siteUrl + '/logic/customerHistory.php',
            type: 'POST',
            data: { custID: custID },
            success: function (data) {
                console.log(data);
                $('#inventoryData').html('');
                $('#inventoryData').html(data);
            },
            error: function (data) {
                console.log('failed ajax with error: ' + data);
            }
        });
    });

    var serviceIdList = [];
    $("#billingAddService").on("click", function () {
        var serviceId = $("#serviceCategory").val();
        serviceIdList.push(serviceId);
        console.log(serviceId + "service id");
        var price = $("#" + serviceId).attr("price");
        var serviceName = $("#" + serviceId).text();
        console.log("Price: " + price + "Service Name:" + serviceName);
        var randomNumber = Math.floor((Math.random() * 100) + 1);
        var serviceList = "<div class='mb-3 mt-1 removeServiceRow' id='" + serviceId + randomNumber + "List'><span class='removeService mt-2 mr-1 p-1' style='cursor: pointer;'><i class='fa fa-minus'></i></span><span>" + serviceName + "</span></div>";
        var costList = "<div class='mb-3 mt-1 " + serviceId + randomNumber + "List'>" + price + "</div>";
        $('#serviceList').append(serviceList);
        $('#costList').append(costList);
        var total = $('#total').text();
        var calculateTotal = parseInt(price) + parseInt(total);
        $('#total').empty().append(calculateTotal);
        $('#subTotal').empty().append(calculateTotal);
        //discount
        var totalAmt = parseInt($('#total').text());
        var discount = parseInt($('#discountPercent').val());
        var amtDiscounted = percentage(totalAmt, discount);
        $('#discount').empty().append(amtDiscounted);
        console.log(totalAmt + "totalAmt Price");
        $('#subTotal').empty().append(totalAmt - amtDiscounted);
    });

    $("body").on("click", ".removeService", function () {
        var rowId = $(this).parents(".removeServiceRow").attr("id");
        var price = $('.' + rowId).text();
        var total = $('#total').text();
        var calculateTotal = parseInt(total) - parseInt(price);
        $('#total').empty().append(calculateTotal);
        var totalAmt = parseInt($('#total').text());
        var discount = parseInt($('#discountPercent').val());
        var amtDiscounted = percentage(totalAmt, discount);
        $('#discount').empty().append(amtDiscounted);
        console.log(totalAmt + "totalAmt Price");
        $('#subTotal').empty().append(totalAmt - amtDiscounted);
        $(this).parents(".removeServiceRow").remove();
        $('.' + rowId).remove();
    });

    $('#searchCustomer').on('keypress', function () {
        /* Get input value on change */
        console.log("keypress");
        var inputVal = $(this).val();
        var resultDropdown = $(this).siblings(".result");
        var customerType = $('#customerTypeSelect').val();
        if (inputVal.length) {
            $.get(siteUrl + '/logic/searchCustomersByName.php', { customerName: inputVal, customerType: customerType }).done(function (data) {
                // Display the returned data in browser
                resultDropdown.html(data);
                console.log(data);
            });
        } else {
            resultDropdown.empty();
        }
    });
    $('#searchCustomerC').on('keypress', function () {
        /* Get input value on change */
        console.log("keypress");
        var inputVal = $(this).val();
        var resultDropdown = $(this).siblings(".result");
        var customerType = $('#customerTypeSelect').val();
        if (inputVal.length) {
            $.get(siteUrl + '/logic/searchCustomersByContact.php', { customerContact: inputVal, customerType: customerType }).done(function (data) {
                // Display the returned data in browser
                resultDropdown.html(data);
            });
        } else {
            resultDropdown.empty();
        }
    });
    $('#searchCustomerR').on('keypress', function () {
        /* Get input value on change */
        console.log("keypress");
        var inputVal = $(this).val();
        $('#searchedNameRandom').html('');
        $('#searchedNameRandom').html(inputVal);
    });
    $("#searchRandom").on('keyup', function(){
        var inputVal = $(this).val();
        $('#searchedNameRandom').html('');
        $('#searchedNameRandom').html(inputVal);
    });
    //ADD PRODUCT TO BILL
    var productList = {};
    var finalList = [];
    $("#addProductToBill").on("click", function(){
       var id = $("#productSelect").val();
       var prodName = $("#product"+id).attr("prodname")
       var qty = $("#addQty").val()
       var price = $("#latestPrice").val()
       var totalCost = $("#total").text();

       var costqty = parseInt(qty)*parseInt(price);
       var totalToShow = costqty + parseInt(totalCost);
       console.log(qty+ " : qty "+price+ " : price "+ totalToShow+ " : total");
       $("#total").empty().append(totalToShow);
       $("#productBillList").append("<div><p>"+prodName+"  X  "+qty+"  Rs. "+price+"</p></div>");
      // $('#subTotal').empty().append(totalToShow);
       productList = {
           id : id,
           qty : qty
       }
       finalList.push(productList);
       console.log(finalList);

       //discount
       var totalAmt = parseInt($('#total').text());
       var discount = parseInt($('#discountPercent').val());
       var amtDiscounted = percentage(totalAmt, discount);
       $('#discount').empty().append(amtDiscounted);
       console.log(totalAmt + "totalAmt Price");
       $('#subTotal').empty().append(totalAmt - amtDiscounted);
    });
    // Set search input value on click of result item
    $(document).on("click", ".result p", function () {
        $(this).parents(".search-box").find('input[type="text"]').val($(this).text());
        $(this).parent(".result").empty();
        $('.searchedCustomerResult').html('');
        $('.searchedCustomerResult').html($(this).text());
        var id =  $(this).attr("id");
        $("#customerId").val(id);
        console.log("-------------after val---------");
    });
    $("#saveBill").on("click", function () {
        console.log(serviceIdList + "services taken");
        var billDiscount = $('#discount').text();
        var billTotal = $('#total').text();
        var billAmountPayable = $('#subTotal').text();
        var customerType = $('#customerTypeSelect').val();
        var customerId = $('#customerId').val();
        var randomCustomerName = $('#searchedNameRandom').val();
        var staffId = $('#staffSelect').val();

        console.log("hmm");
        console.log(billDiscount+''+billTotal+''+billAmountPayable+''+customerType+''+customerId+''+randomCustomerName+''+staffId);
        $.ajax({
            url: siteUrl + '/logic/insertBillingDetails.php',
            type: 'POST',
            data: {  billDiscount: billDiscount, billTotal: billTotal, billAmountPayable: billAmountPayable, customerType: customerType, customerId: customerId, randomCustomerName: randomCustomerName, staffId: staffId, servicesTaken: serviceIdList, prodList: finalList},
            success: function (data) {
                console.log(data);
               // $('#successMessage').html('');
                $('#successMessage').attr("class","d-block");
                $('#successMessage valid-feedback').attr("class","d-block");
                // MODEL OPEN
                $('#staticBackdrop').modal('show');
            },
            error: function (data) {
                console.log('failed ajax with error: ' + data);
            }
        });
    });

   $(document).on("click",".openServiceModal , .clientServiceHistory", function () {
     var billID = $(this).data('billid');
     var name = $(this).data('name');
     $("#myModalLabel2").html(name);
     $.ajax({
        url: siteUrl + '/logic/viewCustomerDetailsList.php',
        type: 'POST',
        data: {  billID : billID},
        success: function (data) {
            console.log(data);
            $("#showServiceData").html("");
            $("#showServiceData").html(data);
        },
        error: function (data) {
            console.log('failed ajax with error: ' + data);
        }
    });
});

});
