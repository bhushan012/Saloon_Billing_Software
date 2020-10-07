$(document).ready(function () {
    var siteUrl = "http://parlourbilling.weblozee.com";
    
    $('#datepicker').datepicker({
        autoclose: true,
        endDate: "today",
    });  
    $('#membership').click(function(){
        if($(this).prop("checked") == true){
            $("#contactNumber").prop('required',true);
        }
        else if($(this).prop("checked") == false){
            $("#contactNumber").prop('required',false);
        }
    }); 
    $("#contactNumber").on('keypress change paste keyup', function (e) {
        // e.preventDefault();
        var contactNumber = $(this).val();
        console.log(contactNumber);
        $.ajax({
            url: siteUrl+'/logic/verifyPhoneNumber.php',
            type: 'POST',
            data: { contactNumber: contactNumber },
            success: function (data) {
                console.log(data);
                if(data == 1){
                    console.log("Contact Number not available.");
                    $('#contactNumber').removeClass("is-invalid");
                    $("#customerFormSubmit").prop('disabled',false);
                }else{
                    console.log("Contact number exists.");
                    $('#contactNumber').addClass("is-invalid");
                    $("#customerFormSubmit").prop('disabled',true);
                }
            },
            error: function (data) {
                console.log('failed ajax with error : '+data);
            }
        });
    });
    $('#customersData').DataTable();
    function percentage(num, per)
{
  return (num/100)*per;
}
          
    $("#discountBtn").on('click', function (e) {
        var totalAmt =  parseInt($('#total').text());
        var discount =  parseInt($('#discountPercent').val());
        var amtDiscounted = percentage(totalAmt, discount);
        $('#discount').empty().append(amtDiscounted);
        console.log(totalAmt + "totalAmt Price");
        $('#subTotal').empty().append(totalAmt - amtDiscounted);
    });
    $("#defaultCheck1").on('click', function (e) {
        if ($('#defaultCheck1').is(':checked')) {
            $('.dicountCol').css('display', 'block');
        }else{
            $('.dicountCol').css('display', 'none');
        }
    });
    $("#customerTypeSelect").on('change', function (e) {
        var customerTypeId = $(this).val();
        if (customerTypeId == "0" || customerTypeId == "1") {
            console.log("registered || member");
            $('#searchByRow').attr("class","col-md-4 d-block");
        } else {
            console.log("random");
            $('#searchByRow').attr("class","col-md-4 d-none");
        }
    });
    $("#searchBySelect").on('change', function (e) {
        var searchBy = $(this).val();
        if (searchBy == "1") {
            $('#customerSearchName').attr("class","col-md-12 d-block");
            $('#customerSearchContact').attr("class","col-md-12 d-none");
           
        }else{
            $('#customerSearchName').attr("class","col-md-12 d-none");
            $('#customerSearchContact').attr("class","col-md-12 d-block");
        }
    });
    $("#serviceCategoryBilling").on('change', function (e) {
        var serviceCategoryBilling = $(this).val();
        console.log(serviceCategoryBilling);
         $.ajax({
            url: siteUrl+'/logic/servicesListByCategory.php',
            type: 'POST',
            data: { serviceCategoryBilling: serviceCategoryBilling },
            success: function (data) {
                console.log(data);
                $('#serviceCategory').html(data);
            },
            error: function (data) {
                console.log('failed ajax with error: '+data);
            }
        });
    });
    $("#billingAddService").click(function(){ 
        var serviceId = $("#serviceCategory").val();
        console.log(serviceId);
        var price = $("#"+serviceId).attr("price");
        var serviceName = $("#"+serviceId).text();
        console.log("Price: " + price + "Service Name:" +serviceName);
        var randomNumber = Math.floor((Math.random() * 100) + 1);
        var serviceList = "<div class='mb-3 mt-1 removeServiceRow' id='"+serviceId+randomNumber+"List'><span class='removeService mt-2 mr-1 p-1' style='cursor: pointer;'><i class='fa fa-minus'></i></span><span>"+serviceName+"</span></div>";
        var costList = "<div class='mb-3 mt-1 "+serviceId+randomNumber+"List'>"+price+"</div>";
        $('#serviceList').append(serviceList);
        $('#costList').append(costList);
        var total = $('#total').text();
        var calculateTotal = parseInt(price)+parseInt(total);
        $('#total').empty().append(calculateTotal);
    });

    $("body").on("click",".removeService",function(){ 
        var rowId = $(this).parents(".removeServiceRow").attr("id");
        var price = $('.'+rowId).text();
        var total = $('#total').text();
        var calculateTotal = parseInt(total)-parseInt(price);
        $('#total').empty().append(calculateTotal);
        $(this).parents(".removeServiceRow").remove();
        $('.'+rowId).remove();
    });
    var countries = [
        { value: 'Andorra', data: 'AD' },
        // ...
        { value: 'Zimbabwe', data: 'ZZ' }
    ];
    $('#search-formName, #search-formContact').autocomplete({
        lookup: countries,
        // hints: words,
        height: 40,
        width:305,
        showButton: false
        // hints: words array for displaying hints
        // placeholder: search input placeholder (default: 'Search')
        // width: input text width
        // height: input text height
        // showButton: display search button (default: true)
        // buttonText: button text (default: 'Search')
        // onSubmit: function handler called on input submit
        // onBlur: function handler called on input losing focus
    });
    $("#search-formName .autocomplete-input").keyup(function () {
        var searchNameValue = $(this).val();
        var customerType = $('#customerTypeSelect').val();
        $.ajax({
            url: siteUrl+'/logic/searchCustomersByName.php',
            type: 'POST',
            data: { customerName: searchNameValue,customerType: customerType },
            success: function (data) {
                console.log(data);
                // words = [];
                // $('#searchedNameByName').html(data['fullName']);
                words =  words.concat(data);
                console.log(words+"hello");

            },
            error: function (data) {
                // $('#owner_name').val("not found in record");
                console.log(data);
            }
        });
    });
    var ctx = document.getElementById("myChart").getContext('2d');
var myChart = new Chart(ctx, {
type: 'bar',
data: {
labels: ["Jan", "Feb", "Mar", "April", "May", "June", "Jul" , "Aug","Sept","Nov","Dec"],
datasets: [{
label: 'Sales per month',
data: [5000,10000,20000,40000,5000,20000,30000,50000,90000,30000,50000,80000],
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
//pie
var ctxP = document.getElementById("pieChart").getContext('2d');
var myPieChart = new Chart(ctxP, {
type: 'pie',
data: {
labels: ["Massage", "Hair Spa", "Treatment", "Skin Lightening", "Waxing"],
datasets: [{
data: [300, 50, 100, 40, 120],
backgroundColor: ["#F7464A", "#46BFBD", "#FDB45C", "#949FB1", "#4D5360"],
hoverBackgroundColor: ["#FF5A5E", "#5AD3D1", "#FFC870", "#A8B3C5", "#616774"]
}]
},
options: {
responsive: true
}
});
});
