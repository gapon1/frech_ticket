$(document).ready(function () {
//==========  Calculate Labour Widget  ===========
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

    $("#ticket-form").on('keyup mousedown mouseup click change', function (e) {
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
            $("#labour-reg_hours, #labour-overtime, #positions-uom").on('keyup click change', function () {
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
//==========END:: Script for Labour Widget  ===========
});
