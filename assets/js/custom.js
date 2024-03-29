$(document).ready(function () {
    setTimeout(function() {
       // $("body").css("background: #4492f4")
       $("#bodyLoad").removeClass("blue");  
       $("#one").removeClass("d-none");        
          
        //$("#one").addClass("d-block"); 
        $('#loading').hide(); 
        $("#two").removeClass("d-none");        
        $("body").css("background-color: transparent")  
             
    },3000);
     var siteUrl = "http://weblozee.com/billing";
    //var siteUrl = "http://127.0.0.1:9000";
   
    // END MODEL
    $('#datepicker').datepicker({
        autoclose: true,
        endDate: "today",
    });
    // $("#productUpdateName").click(function(){
    //     var product_id = $("#productIDno").val();
    //     var product_name = $("#productNameUpdate").val();
    //     console.log("Product Name : "+product_name+"\n Product Id: "+product_id);
    //     $.ajax({
    //         url: siteUrl + '/logic/updateProductName.php',
    //         type: 'POST',
    //         data: { 
    //             product_id: product_id, 
    //             product_name: product_name 
    //         },
    //         success: function (data) {
    //             console.log(data);
    //         },
    //         error: function (data) {
    //             console.log('failed ajax with error : ' + data);
    //         }
    //     });
    // });
    $(".deleteProd").click(function(){
        var id = $(this).data("prodid");
        $.ajax({
            url: siteUrl + '/logic/delProduct.php',
            type: 'POST',
            data: { productId: id },
            success: function (data) {
                // console.log(data);
                // if (data == 1) {
                    window.location.reload(); 
                // } else {
                //     console.log(data);
                // }
            },
            error: function (data) {
                console.log('failed ajax with error : ' + data);
            }
        });
    });
    $("#editProduct .editProd").click(function(){
        // e.preventDefault();
        var id = $(this).data("prodid");
        console.log("EDIT PRODUCT ID: ",id);
        var productOldName = $(this).data("oldproductname");
        console.log("EDIT PRODUCT NAME: ",productOldName);
        $("#productIDno").val(id);
        $("#oldProductName").text(productOldName);
        // $($(this).attr("data-target")).modal("exampleModal");    
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
        // console.log(contactNumber);
        $.ajax({
            url: siteUrl + '/logic/verifyPhoneNumber.php',
            type: 'POST',
            data: { contactNumber: contactNumber },
            success: function (data) {
                // console.log(data);
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
    function creditCalc(totalVal,amntPaid){
        return totalVal - amntPaid;
    }

    $("#discountBtn").on('click', function (e) {
        // console.log("in discount");
        var totalAmt = parseInt($('#total').text()) + parseInt($('#gstCalculate').text());
        var discount = parseInt($('#discountPercent').val());
        if(discount>99){
            alert("Incorrect Discount Added");
            $('#discountPercent').val("");

        }else{
            var amtDiscounted = percentage(totalAmt, discount);
            $('#discount').empty().append(amtDiscounted);
            // console.log(totalAmt + "totalAmt Price");
            $('#subTotal').empty().append(totalAmt - amtDiscounted);
            var subtotal = totalAmt - amtDiscounted;
            var amntPaid = $("#amntId").val();
            if(amntPaid > 0){
                var calculateCredit = creditCalc(subtotal,amntPaid);
                // console.log(calculateCredit);
                $("#creditToPay").html('');
                $("#creditToPay").html(calculateCredit);
                $("#amntPaid").html('');
                $("#amntPaid").html(amntPaid);
            }
            
        }
        
    });
    // $("#discountPercent").on("keydown",function(){
    //     console.log("1");
    //     var valueCheck = $(this).val();
    //     if(valueCheck > 90){
    //         alert("hello");
    //     }
    // });
    $(document).on('click',"#creditClear", function (e) {
        var creditAmount = $('#amntId').val();
        var userId = $('#customerId').val();
        // console.log(`Customer Id: ${userId} \n Credit Amount: ${creditAmount}`);
        $.ajax({
            url: siteUrl + '/logic/payCredit.php',
            type: 'POST',
            data: { creditAmount: creditAmount, userId: userId},
            success: function (data) {
                // console.log(data);
                window.location.reload();    
            },
            error: function (data) {
                console.log('failed ajax with error: ' + data);
            }
        });
    });
    $("#defaultCheck1").on('click', function (e) {
        if ($('#defaultCheck1').is(':checked')) {
            $('.dicountCol').css('display', 'block');
        } else {
            $('.dicountCol').css('display', 'none');
        }
    });
    $("#gstEnable").on('click', function (e) {
        if ($('#gstEnable').is(':checked')) {         
            $('#gstCalculate').empty();
            $('#gstCalculate').css('display', 'none');
            $('#gstRow').css('display', 'none');
            var total = $('#total').text();
            var totalAmt = $('#subTotal').text();
            var gstCalc = total * 18 / 100;
            $('#subTotal').empty().append(totalAmt - gstCalc);
        }
        else{
            $('#gstCalculate').css('display', 'block');
            $('#gstRow').css('display', 'block');
            var total = parseInt($('#total').text());
            // var totalAmt = $('#subTotal').text();
            var gstCalc = total * 18 / 100;
            $('#gstCalculate').empty().append(gstCalc);
            $('#subTotal').empty().append(total + gstCalc);
        }
    });
    $("#partialPaymentCheck").on('click', function (e) {
        if ($('#partialPaymentCheck').is(':checked')) {
            $('.partialPatmentCol').css('display', 'block');
            $('.partialPay').css('display', 'block');
        } else {
            $('.partialPatmentCol').css('display', 'none');
            $("#creditToPay").html("0");
            $("#amntPaid").html("0");
            $("#amntId").val(0);
            $('.partialPay').css('display', 'none');
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
    //based on subcategory services list
    $(".subcategoryClass").on('change', function (e) {
        var subCategoryId = $(this).val();
        // console.log("on change subcategoryClass",subCategoryId);
        // console.log(serviceCategoryBilling);
        $.ajax({
            url: siteUrl + '/logic/servicesListByCategory.php',
            type: 'POST',
            data: { subCategoryId: subCategoryId },
            success: function (data) {
                // console.log(data);
                $('#serviceNames').html(data);
            },
            error: function (data) {
                console.log('failed ajax with error: ' + data);
            }
        });
    });
    //GET PRODUCT PRICE AJAX
    $("#productSelect").on('change', function (e) {
        var productSelect = $(this).val();
        // console.log(productSelect);
        $.ajax({
            url: siteUrl + '/logic/productLatestPrice.php',
            type: 'POST',
            data: { productSelect: productSelect },
            success: function (data) {
                // console.log(data);
                $('#priceDisplay').html('');
                $('#priceDisplay').html(data);
                $("#addQty").val("1");
            },
            error: function (data) {
                console.log('failed ajax with error: ' + data);
            }
        });
        $.ajax({
            url: siteUrl + '/logic/checkIfQtyAvailable.php',
            type: 'POST',
            data: {  prodID: productSelect},
            success: function (data) {
                // console.log(data + "available");
                 stockAvailableUnique = data; 
                
               
            },
            error: function (data) {
                console.log('failed ajax with error: ' + data);
            }
        });
    });
    //GET PRODUCT EXPANSE TABLE AJAX
    $("#selectMonth , #prodList , #selectYear").on('change', function (e) {
        var month = $('#selectMonth').val();
        var prodID = $('#prodList').val();
        var year = $('#selectYear').val();
        // console.log("month" + month);
        // console.log("prod" + prodID);
        // console.log("year" + year);
        $.ajax({
            url: siteUrl + '/logic/inventoryTable.php',
            type: 'POST',
            data: { month: month, prodID: prodID, year: year },
            success: function (data) {
                // console.log(data);
                $('#inventoryData').html('');
                $('#inventoryData').html(data);
            },
            error: function (data) {
                console.log('failed ajax with error: ' + data);
            }
        });
    });
    //GET STAFF SERVICE HISTORY
    $("#selectMonth1 , #staffList, #selectYearStaff").on('change', function (e) {
        var month = $('#selectMonth1').val();
        var staffID = $('#staffList').val();
        var year = $('#selectYearStaff').val();
        // console.log("month" + month);
        // console.log("staff" + staffID);
        $.ajax({
            url: siteUrl + '/logic/staffServiceHistory.php',
            type: 'POST',
            data: { month: month, staffID: staffID,year: year },
            success: function (data) {
                // console.log(data);
                $('#inventoryData').html('');
                $('#inventoryData').html(data);
            },
            error: function (data) {
                console.log('failed ajax with error: ' + data);
            }
        });
    });
    //GET CUSTOMER HISTORY
    // $("#customerList").on('change', function (e) {
    //     //var month = $('#selectMonth1').val();
    //     var custID = $('#customerList').val();
    //     console.log("staff" + custID);
    //     $.ajax({
    //         url: siteUrl + '/logic/customerHistory.php',
    //         type: 'POST',
    //         data: { custID: custID },
    //         success: function (data) {
    //             console.log(data);
    //             $('#inventoryData').html('');
    //             $('#inventoryData').html(data);
    //         },
    //         error: function (data) {
    //             console.log('failed ajax with error: ',data);
    //         }
    //     });
    // });

    var serviceIdList = [];
    $("#billingAddService").on("click", function () {
        var serviceId = $("#serviceNames").val();
        // serviceIdList.push(serviceId);
        // console.log(serviceId + "service id");
        var price = $("#" + serviceId).attr("price");
        var serviceName = $("#" + serviceId).text();
        // console.log("Price: " + price + "Service Name:" + serviceName);
        var randomNumber = Math.floor((Math.random() * 100) + 1);
        var serviceIdentifier = serviceId +"-"+ randomNumber+'List-'+price;
        var serviceList = "<div class='mb-3 mt-1 removeServiceRow' id='" + serviceIdentifier +"'><span class='removeService mt-2 mr-1 p-1' style='cursor: pointer;'><i class='fa fa-minus'></i></span><span>" + serviceName + "</span></div>";
        var costList = "<div class='mb-3 mt-1 " + serviceIdentifier + "'>" + price + "</div>";
        serviceIdList.push(serviceIdentifier);
        $('#serviceList').append(serviceList);
        $('#costList').append(costList);
        var total = $('#total').text();
        var calculateTotal = parseInt(price) + parseInt(total);
        var gstCalc = calculateTotal * 18 / 100;
        $('#total').empty().append(calculateTotal);
        $('#gstCalculate').empty().append(gstCalc);
        $('#subTotal').empty().append(calculateTotal + gstCalc);
        //discount
        var totalAmt = parseInt($('#total').text());
        var discount = parseInt($('#discountPercent').val());
        var amtDiscounted = percentage(totalAmt, discount);
        $('#discount').empty().append(amtDiscounted);
        // console.log(totalAmt + "totalAmt Price");
        $('#subTotal').empty().append((totalAmt - amtDiscounted) + gstCalc);
        // console.log(serviceIdList);
        var subtotal = (totalAmt - amtDiscounted) + gstCalc;
        var amntPaid = $("#amntId").val();
        if(amntPaid > 0){
            var calculateCredit = creditCalc(subtotal,amntPaid);
            // console.log(calculateCredit);
            $("#creditToPay").html('');
            $("#creditToPay").html(calculateCredit);
            $("#amntPaid").html('');
            $("#amntPaid").html(amntPaid);
        }
    });

    $("body").on("click", ".removeService", function () {
        var rowId = $(this).parents(".removeServiceRow").attr("id");
        var price = $('.' + rowId).text();
        var total = $('#total').text();
        // var gstCalculate = $('#gstCalculate').text();
        var calculateTotal = parseInt(total) - parseInt(price);
        var gstCalc = calculateTotal * 18 / 100;
        $('#total').empty().append(calculateTotal);
        $('#gstCalculate').empty().append(gstCalc);
        var totalAmt = parseInt($('#total').text()) + parseInt($('#gstCalculate').text());
        var discount = parseInt($('#discountPercent').val());
        var amtDiscounted = percentage(totalAmt, discount);
        $('#discount').empty().append(amtDiscounted);
        // console.log(totalAmt + "totalAmt Price");
        
        $('#subTotal').empty().append(totalAmt - amtDiscounted);
        var cred = parseInt($("#amntPaid").text());
        // console.log(cred+"cred paid");
        var newsub = totalAmt - amtDiscounted;
        // console.log(newsub+"Sub Total");
        var creditAmnt = creditCalc(newsub,cred);
        // console.log(creditAmnt + "Credit");
        $("#creditToPay").html(creditAmnt);
        $(this).parents(".removeServiceRow").remove();
        $('.' + rowId).remove();
          // Find and remove item from an array
          var i = serviceIdList.indexOf(rowId);
          if(i != -1) {
                serviceIdList.splice(i, 1);
          }
        //   console.log(serviceIdList);
          if(calculateTotal == 0){
              $("#amntPaid").html("0");
              $("#creditToPay").html("0");
              $("#amntId").val(0);
          }

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
                // console.log(data);
            });
        } else {
            resultDropdown.empty();
        }
    });
    $('#searchCust').on('keypress', function () {
        /* Get input value on change */
        console.log("keypress");
        var inputVal = $(this).val();
        var resultDropdown = $(this).siblings(".custResult");
        var customerType = $('#customerTypeSelect').val();
        if (inputVal.length) {
            $.get(siteUrl + '/logic/searchCustomersByName.php', { customerName: inputVal, customerType: customerType }).done(function (data) {
                // Display the returned data in browser
                resultDropdown.html(data);
                // console.log(data);
            });
        } else {
            resultDropdown.empty();
        }
    });
    $(document).on("click",".customerDetail", function (e) {
        // var customerName = $(this).text();
        var custID = $(this).attr('id');
        $(this).parents(".search-box").find('input[type="text"]').val($(this).text());
        $(this).parent(".custResult").empty();
        $('.searchedCustomerResult').html('');
        $('.searchedCustomerResult').html($(this).text());
        // var custID = $('#customerList').val();
        // console.log("staff" + custID);
        $.ajax({
            url: siteUrl + '/logic/customerHistory.php',
            type: 'POST',
            data: { custID: custID },
            success: function (data) {
                // console.log(data);
                $('#inventoryData').html('');
                $('#inventoryData').html(data);
            },
            error: function (data) {
                console.log('failed ajax with error: ',data);
            }
        });
        // console.log("Customer Id: ",customerId);
    })
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
    $('#searchCustContact').on('keypress', function () {
        /* Get input value on change */
        console.log("keypress searchCust");
        var inputVal = $(this).val();
        var resultDropdown = $(this).siblings(".custResult");
        var customerType = $('#customerTypeSelect').val();
        // console.log(`customerContact : ${inputVal} customer type: ${customerType}`);
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
    

    //check Availablity
    $("#addQty").on('keypress', function(){
        var qty = $("#addQty").val();
        var id = $("#productSelect").val();
        // console.log(qty+"Quantity");
        stockAvailableUnique = parseInt(stockAvailableUnique);
        // console.log(stockAvailableUnique);
        if(stockAvailableUnique < qty || stockAvailableUnique  == 0){
            alert("You have only "+stockAvailableUnique+" items in stock! Kindly re-enter the quantity.");
            $("#addQty").val(1);
        }
        
    });
    //ADD PRODUCT TO BILL
    var productList = {};
    var finalList = [];
    $("#addProductToBill").on("click", function(){
       var id = $("#productSelect").val();
       var productId = "productId-" + id;
       var i= 0;
       
        finalList.forEach(function(e){
        // console.log("fdfdfdfdfdfdfdfd+++++++++++++++++++++"+i+finalList[i].productIdentifier);
        var productCheck = finalList[i].productIdentifier;
        if(productCheck == productId){
            alert("Product already exists.");
            e.preventDefault();
        }
        i++;
       });
       //check Availablity
       var qty = $("#addQty").val()
       stockAvailableUnique = parseInt(stockAvailableUnique);
        // console.log(stockAvailableUnique);
        if(stockAvailableUnique <= qty){
            alert("You have only "+stockAvailableUnique+" items in stock! Kindly re-enter the quantity.");
            e.preventDefault();
        }
       
    
    //    console.log("NOT FOUND");
            var prodName = $("#product"+id).attr("prodname")
            var qty = $("#addQty").val()
            var price = $("#latestPrice").val()
            var totalCost = $("#total").text();
            var costqty = parseInt(qty)*parseInt(price);
            var totalToShow = costqty + parseInt(totalCost);
            // console.log(qty+ " : qty "+price+ " : price "+ totalToShow+ " : total");
            
           
            $("#total").empty().append(totalToShow);
            $("#productBillList").append("<div class='removeProductRow' id='"+productId+"'><input type='hidden' id='"+productId+"Price' value='"+costqty+"'><p class='priceRow'><span class='removeProduct mt-2 mr-1 p-1' style='cursor: pointer;'><i class='fa fa-minus'></i></span>"+prodName+"  X  "+qty+"  Rs. "+price+"</p></div>");
            // $('#subTotal').empty().append(totalToShow);
            productList = {
                id : id,
                qty : qty,
                productIdentifier : productId,
                price: price
            }
            finalList.push(productList);
            // console.log(finalList);
            //discount
            var totalAmt = parseInt($('#total').text());
            var discount = parseInt($('#discountPercent').val());
            var amtDiscounted = percentage(totalAmt, discount);
            $('#discount').empty().append(amtDiscounted);
            // console.log(totalAmt + "totalAmt Price");
            $('#subTotal').empty().append(totalAmt - amtDiscounted);
            var cred = parseInt($("#amntPaid").text());
            // console.log(cred+"cred paid");
            var newsub = totalAmt - amtDiscounted;
            console.log(newsub+"Sub Total");
            if ($('#partialPaymentCheck').is(':checked')) {
                var creditAmnt = creditCalc(newsub,cred);
                console.log(creditAmnt + "Credit");
                $("#creditToPay").html(creditAmnt);
            }
        });
    function RemoveNode(productIdentifier) {
        return finalList.filter(function(emp) {
            if (emp.productIdentifier == productIdentifier) {
                return false;
            }
            return true;
        });
    }
    $("body").on("click", ".removeProduct", function () {
        var rowId = $(this).parents(".removeProductRow").attr("id");
        var productPrice = $("#"+rowId+"Price").val();
        var total = $('#total').text();
        var calculateTotal = parseInt(total) - parseInt(productPrice);
        $('#total').empty().append(calculateTotal);
        var totalAmt = parseInt($('#total').text());
        var discount = parseInt($('#discountPercent').val());
        var amtDiscounted = percentage(totalAmt, discount);
        $('#discount').empty().append(amtDiscounted);
        console.log(totalAmt + "totalAmt Price");
        $('#subTotal').empty().append(totalAmt - amtDiscounted);
        $(this).parents(".removeProductRow").remove();
        finalList = RemoveNode(rowId);
        var cred = parseInt($("#amntPaid").text());
        console.log(cred+"cred paid");
        var newsub = totalAmt - amtDiscounted;
        console.log(newsub+"Sub Total");
        var creditAmnt = creditCalc(newsub,cred);
        console.log(creditAmnt + "Credit");
        $("#creditToPay").html(creditAmnt);
        if(calculateTotal == 0){
            $("#amntPaid").html("0");
            $("#creditToPay").html("0");
            $("#amntId").val(0);
        }
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
    //add credit
    
    $("#saveBill").on("click", function () {
        console.log(serviceIdList + "services taken");
        var billDiscount = $('#discount').text();
        var gstAmount = $('#gstCalculate').text();
        var billTotal = '';
         billTotal = $('#total').text();
        var billAmountPayable = $('#subTotal').text();
        var customerType = $('#customerTypeSelect').val();
        var customerId = '';
        customerId = $('#customerId').val();
        var randomCustomerName = '';
        randomCustomerName = $('#searchedNameRandom').text();
        var staffId = '';
         staffId = $('#staffSelect').val();
        var amntPaid = $("#amntPaid").text();
        var creditAmnt = $("#creditToPay").text();
        amntPaid = parseFloat(amntPaid);
        creditAmnt = parseFloat(creditAmnt);
        //console.log(randomCustomerName+ "name");
        //console.log(billDiscount+''+billTotal+''+billAmountPayable+''+customerType+''+customerId+''+randomCustomerName+''+staffId);
         if((randomCustomerName != '' || customerId != '') && staffId != ''  && billTotal != '0'){
            $.ajax({
                url: siteUrl + '/logic/insertBillingDetails.php',
                type: 'POST',
                data: { gstAmount: gstAmount,amntpaid: amntPaid,creditAmnt, billDiscount: billDiscount, billTotal: billTotal, billAmountPayable: billAmountPayable, customerType: customerType, customerId: customerId, randomCustomerName: randomCustomerName, staffId: staffId, servicesTaken: serviceIdList, prodList: finalList},
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

         }
         else{
            // alert("enter customer name");
            $("#smallAlert").html("");
             if(randomCustomerName == '' || customerId == ''){
                $("#smallAlert").append("<p>The Customer Name Is Missing</p>");
             }
             if(staffId == ''){
                $("#smallAlert").append("<p>The Staff Name Is Missing</p>");
             }
             if(billTotal == '0'){
                $("#smallAlert").append("<p>Looks Your Total Is Not Calculated! Please add services or products</p>");
             }
             // MODEL OPEN
             $('#alertValidationModal').modal('show');
         }
        
    });

   $(document).on("click",".openServiceModal , .clientServiceHistory", function () {
     var billID = $(this).data('billid');
     var name = $(this).data('name');
     console.log(name + "name");
     console.log(billID + "bill id");
     $("#myModalLabel2").html(name);
     $.ajax({
        url: siteUrl + '/logic/viewCustomerDetailsList.php',
        type: 'POST',
        data: {  billID : billID},
        success: function (data) {
            // console.log(data);
            $("#showServiceData").html("");
            $("#showServiceData").html(data);
        },
        error: function (data) {
            console.log('failed ajax with error: ' + data);
        }
    });
});

    $(document).on("click", "#excel_export", function () {
        $("#billDataExcel").table2excel({
            exclude:"notInExcel",
            filename: "bills.xls"
        });
    });
    $(document).on("click", "#addCredits", function () {

        var total = $('#subTotal').text();
        // console.log(total+ "total amount");
        var amntPaid = $("#amntId").val();
        var subTotal = $('#subTotal').text();
        var calculateCredit = creditCalc(subTotal,amntPaid);
        // console.log(calculateCredit);
        $("#creditToPay").html('');
        $("#creditToPay").html(calculateCredit);
        $("#amntPaid").html('');
        $("#amntPaid").html(amntPaid);

    });
   
    $("#serviceCategory, #serviceCategoryBilling").on('change', function (e) {
        var serviceCategory = $(this).val();
        $("#subCategorySec").removeClass("d-none");  
        $.ajax({
            url: siteUrl + '/logic/getSubCategory.php',
            type: 'POST',
            data: {  categoryId : serviceCategory},
            success: function (data) {
                // console.log(data);
                $("#serviceSubCategory").html("");
                $("#serviceSubCategory").html(data);
            },
            error: function (data) {
                $("#serviceSubCategory").html("");
                console.log('failed ajax with error: ' + data);
            }
        });
        // console.log("Category Id: ",serviceCategory)
    });
});
