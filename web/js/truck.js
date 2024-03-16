$(document).ready(function () {

//==========  Script for Truck Widget  ===========
    $('#trucks-label').change(function () {
        let truckLabel = $(this).val();
        $.ajax({
            url: "/dependent-dropdown/truck-dropdown?truckLabel=" + truckLabel,
            type: 'post',
            dataType: 'html',
            data: {truckLabel: truckLabel},
            success: function (data) {
                var returnedData = JSON.parse(data);
                // Use the code from above to update the HTML elements
                $('#trucks-uom').val(returnedData.uom);
                $('#trucks-rate').val(returnedData.rate);
                $('#trucks-quantity').val(returnedData.quantity);
                $('#trucks-total').val(returnedData.total);
            }
        });
    });

    $("#ticket-form").on('keyup mousedown mouseup click change', function (e) {
        let selectedTruck = $('#trucks-uom').find(":selected").val();
        if (selectedTruck === 'Fixed') {
            let truckRateVal = parseFloat($('#trucks-rate').val());
            $('#trucks-sub_total').val(truckRateVal.toFixed(2));
            $('#trucks-total').val(truckRateVal.toFixed(2));
        } else {
            // Add total value for row Sub-Total
            let trucksTotal = $('#trucks-total').val();
            $('#trucks-sub_total').val(trucksTotal);
            // Add event keyup for rows
            $("#trucks-rate, #trucks-quantity, #trucks-uom").on('keyup click change', function () {
                // Retrieve values from inputs and ensure they're floats
                let truckPrice = parseFloat($('#trucks-rate').val());
                let truckQuantity = parseFloat($('#trucks-quantity').val());
                // Check if the inputs are numbers
                if (!isNaN(truckPrice) && !isNaN(truckQuantity)) {
                    let truckTotal_sum = truckPrice * truckQuantity;
                    $('#trucks-total').val(truckTotal_sum.toFixed(2));
                    $('#trucks-sub_total').val(truckTotal_sum.toFixed(2));
                } else {
                    $("#trucks-sub_total").val("Please enter valid numbers.");
                }
            });
        }
    });
//==========END:: Script for Truck Widget  ===========
});

