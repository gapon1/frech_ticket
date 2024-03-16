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
//==========END:: Script for Truck Widget  ===========
//==========  Calculate Labour Widget  ===========
        // Check UOM value
        let selectedUom = $('#positions-uom').find(":selected").val();
        if (selectedUom === 'Fixed') {
            $('#labour-reg_hours').prop('disabled', true);
            $('#labour-overtime').prop('disabled', true);
            let labourPrice = parseFloat($('#positions-regular_rate').val());
            $('#labour-total').val(labourPrice.toFixed(2));
            $('#labour_sub-total').val(labourPrice.toFixed(2));

        } else {
            $('#labour-reg_hours').prop('disabled', false);
            $('#labour-overtime').prop('disabled', false);
            // Add total value for row Sub-Total
            let labourTotal = $('#labour-total').val();
            $('#labour_sub-total').val(labourTotal);
            // Add event keyup for rows
            $("#labour-reg_hours, #labour-overtime, #positions-uom").on('keyup click change',function () {
                // Retrieve values from inputs and ensure they're floats
                let labourPrice = parseFloat($('#positions-regular_rate').val());
                let labourQuantity = parseFloat($('#labour-reg_hours').val());
                let labourOvertime = parseFloat($('#labour-overtime').val());
                let labourOvertimeRate = parseFloat($('#positions-overtime_rate').val());

                // Check if the inputs are numbers
                if (!isNaN(labourPrice) && !isNaN(labourQuantity)) {
                    let overtimeTotal = labourOvertime * labourOvertimeRate
                    let labourTotal_sum = labourPrice * labourQuantity;
                    let labourTotalSum = overtimeTotal + labourTotal_sum;
                    $('#labour-total').val(labourTotalSum.toFixed(2));
                    $('#labour_sub-total').val(labourTotalSum.toFixed(2));
                } else {
                    $("#labour_sub-total").val("Please enter valid numbers.");
                }
            });
        }
    });


//  IF Change Position value
    $('#labour-position_id').change(function () {
        let positionId = $(this).val();
        $.ajax({
            url: "/dependent-dropdown/position-dropdown?positionId=" + positionId,
            type: 'post',
            dataType: 'html',
            data: {positionId: positionId},
            success: function (data) {
                var positionsData = JSON.parse(data);
                // Use the code from above to update the HTML elements
                $('#positions-uom').val(positionsData.uom);
                $('#positions-regular_rate').attr('value', positionsData.regular_rate);
                $('#positions-overtime_rate').attr('value', positionsData.overtime_rate);
            }
        });
    });
//==========END:: Script for Miscellaneous Widget  ===========

});