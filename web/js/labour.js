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

//     $("#ticket-form").on('keyup mousedown mouseup click change', function (e) {
// // Check UOM value
//         let selectedUom = $('#positions-uom').find(":selected").val();
//         if (selectedUom === 'Fixed') {
//             $('#labour-reg_hours').prop('disabled', true);
//             $('#labour-overtime').prop('disabled', true);
//             let labourPrice = parseFloat($('#positions-regular_rate').val());
//             $('#labour-total').val(labourPrice.toFixed(2));
//             $('#labour_sub-total').val(labourPrice.toFixed(2));
//
//         } else {
//             $('#labour-reg_hours').prop('disabled', false);
//             $('#labour-overtime').prop('disabled', false);
//             // Add total value for row Sub-Total
//             let labourTotal = $('#labour-total').val();
//             $('#labour_sub-total').val(labourTotal);
//             // Add event keyup for rows
//                 $(document).on('input', '#labour-reg_hours, #labour-overtime, #positions-uom', function () {
//                 let labourPrice = parseFloat($('#positions-regular_rate').val());
//                 let labourQuantity = parseFloat($('#labour-reg_hours').val());
//                 let labourOvertime = parseFloat($('#labour-overtime').val());
//                 let labourOvertimeRate = parseFloat($('#positions-overtime_rate').val());
//
//                 // Check if the inputs are numbers
//                 if (!isNaN(labourPrice) && !isNaN(labourQuantity)) {
//                     let overtimeTotal = labourOvertime * labourOvertimeRate
//                     let labourTotal_sum = labourPrice * labourQuantity;
//                     let labourTotalSum = overtimeTotal + labourTotal_sum;
//                     $('#labour-total').val(labourTotalSum.toFixed(2));
//                     $('#labour_sub-total').val(labourTotalSum.toFixed(2));
//                 } else {
//                     $("#labour_sub-total").val("Please enter valid numbers.");
//                 }
//             });
//         }
//     });
//==========END:: Script for Labour Widget  ===========
// Change block position
    $('#ticket-form-dynamic-labour').insertBefore('#labour-widget'); // Moves the '#block-to-move' before '#target-element'

    //========== Ajax script for Dynamic adding Miscellaneous blocks  ===========
    let counter = 0;
    const searchParams = new URLSearchParams(window.location.search);
    let ticketId = searchParams.getAll('id')
    $(document).on('click', '.add-sub-form-labour', function () {
        $('<div>', {id: 'sub-forms-container_main-labour',}).appendTo('#sub-forms-container-labour');
        counter++;
        $.ajax({
            url: '/labour/labour-add-block?index&counter=' + counter + '&ticketId=' + ticketId, // Adjust URL as needed
            type: 'post',
            data: {index: counter},
            success: function (data) {
                $('.add-sub-form-labour').prop('disabled', true);
                $('#sub-forms-container_main-labour').append(data);
            }
        });
    });

    //======= Create new entity ======
    $(document).on('click', '#save_dynamic-labour', function (e) {
        e.preventDefault();
        $.ajax({
            url: '/labour/create-labour?ticketId=' + ticketId,
            type: 'POST',
            data: $('#ticket-form-dynamic-sub-labour').serialize(),
            success: function (data) {
                $('#sub-forms-container_main-labour').remove();
                $('#misc_container-labour').replaceWith(data); // Replace the content
                $('.add-sub-form-labour').prop('disabled', false);
                //updateSubTotal();
            }
        });
    });

    //========  Update new entity ======
    $(document).on('click', '#save-dynamic-form-misc-labour', function (e) {
        e.preventDefault();
        $.ajax({
            url: '/labour/update-labour?ticketId=' + ticketId,
            type: 'POST',
            data: $('#ticket-form-dynamic-labour').serialize(),
            success: function (data) {
                // $('#exampleModal .modal-body').html(data);
                // $('#exampleModal').modal('show');
            }
        });
    });

    // Add trigger click for main EDIT button
    $(document).on('click', '#save-dynamic-form', function (e) {
        $('#save-dynamic-form-misc-labour').trigger('click');
    });

    //==========  Delete block =======
    $(document).on('click change', '.remove-sub-form-labour', function (e) {
        let blockId = $(this).attr('id')
        e.preventDefault();
        $.ajax({
            url: '/labour/delete-labour?id=' + blockId,
            type: 'POST',
            data: $('#ticket-form-labour').serialize(),
            success: function (data) {
                // Some script
            }
        });
    });
    // Dynamic binding for removing a sub-form
    $(document).on('click', '.remove-sub-form-labour', function () {
        $(this).closest('.sub-form-labour').fadeOut('slow', function () {
            $(this).remove();
           // updateSubTotal();
            $('.add-sub-form-labour').prop('disabled', false);
        });
    });
//==========END:: Ajax script for Dynamic adding Miscellaneous blocks  ===========
});
