$(document).ready(function () {

//========== Ajax script for Ticket Form  ===========
    // Customer change
    $('#customer-dropdown').change(function () {
        var customerId = $(this).val();
        $.ajax({
            url: "/dependent-dropdown/job-dropdown?customer_id=" + customerId,
            type: 'post',
            dataType: 'html',
            data: {customer_id: customerId},
            success: function (data) {
                $('#job-dropdown').prop('disabled', false).empty().append($('<option>').text('Select Job'));
                var parsedData = typeof data === 'object' ? data : JSON.parse(data); // Safety check
                $.each(parsedData, function (index, value) {
                    $('#job-dropdown').append($('<option>').attr('value', index).text(value));
                });
            }
        });
    });

    // Job change
    $('#job-dropdown').change(function () {
        var jobId = $(this).val();
        $.ajax({
            url: '/dependent-dropdown/location-dropdown?job_id=' + jobId,
            data: {job_id: jobId},
            success: function (data) {
                $('#location-dropdown').prop('disabled', false).empty().append($('<option>').text('Select Location/LSD'));
                $.each(data, function (index, value) {
                    $('#location-dropdown').append($('<option>').attr('value', index).text(value));
                });
            }
        });
    });
//==========END:: Ajax script for Ticket Form  ===========
//==========  Script for Miscellaneous Widget  ===========

    // Add total value for row Sub-Total
    let total = $('#miscellaneous-total').val();
    $('#miscellaneous-sub_total').val(total);
    // Add event keyup for rows
    $("#miscellaneous-price, #miscellaneous-quantity").keyup(function () {
        // Retrieve values from inputs and ensure they're floats
        let price = parseFloat($('#miscellaneous-price').val());
        let quantity = parseFloat($('#miscellaneous-quantity').val());

        // Check if the inputs are numbers
        if (!isNaN(price) && !isNaN(quantity)) {
            let total_sum = price * quantity;
            $('#miscellaneous-total').attr('value', total_sum.toFixed(2));
            $('#miscellaneous-sub_total').val(total_sum.toFixed(2));
        } else {
            $("#miscellaneous-sub_total").val("Please enter valid numbers.");
        }
    });

//==========END:: Script for Miscellaneous Widget  ===========
//==========  Script for Labour Widget  ===========


//==========END:: Script for Labour Widget  ===========

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

    // Add total value for row Sub-Total
    let trucksTotal = $('#trucks-total').val();
    $('#trucks-sub_total').val(trucksTotal);

    // Add event keyup for rows
    $("#trucks-rate, #trucks-quantity").keyup(function () {
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
//==========END:: Script for Truck Widget  ===========


});