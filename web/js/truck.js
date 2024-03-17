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

    //========== Ajax script for Dynamic adding Truck blocks  ===========
    let counter = 0;
    const searchParams = new URLSearchParams(window.location.search);
    let ticketId = searchParams.getAll('id')
    $(document).on('click', '.add-sub-form-truck', function () {
        $('<div>', {id: 'sub-forms-container_main-truck',}).appendTo('#sub-forms-container-truck');
        counter++;
        $.ajax({
            url: '/truck/truck-add-block?index&counter=' + counter + '&ticketId=' + ticketId, // Adjust URL as needed
            type: 'post',
            data: {index: counter},
            success: function (data) {
                $('.add-sub-form-truck').prop('disabled', true);
                $('#sub-forms-container_main-truck').append(data);
            }
        });
    });

    //======= Create new entity ======
    $(document).on('click', '#save_dynamic-truck', function (e) {
        e.preventDefault();
        $.ajax({
            url: '/truck/create-truck?ticketId=' + ticketId,
            type: 'POST',
            data: $('#ticket-form-dynamic-sub-truck').serialize(),
            success: function (data) {
                $('#sub-forms-container_main-truck').remove();
                $('#misc_container-truck-test').replaceWith(data);
                $('.add-sub-form-truck').prop('disabled', false);
            }
        });
    });
    //========  Update new entity ======


    // Add trigger click for main EDIT button
    $(document).on('click', '#save-dynamic-form-truck', function (e) {
        $('#save-dynamic-form-misc-truck').trigger('click');
    });

    $(document).on('click', '#save-dynamic-form-misc-truck', function (e) {
        e.preventDefault();
        $.ajax({
            url: '/truck/update-truck?ticketId=' + ticketId,
            type: 'POST',
            data: $('#ticket-form-dynamic-truck').serialize(),
            success: function (data) {
                // $('#exampleModal .modal-body').html(data);
                // $('#exampleModal').modal('show');
            }
        });
    })

    //==========  Delete block =======
    $(document).on('click change', '.remove-sub-form-truck', function (e) {
        let blockId = $(this).attr('id')
        e.preventDefault();
        $.ajax({
            url: '/truck/delete-truck?id=' + blockId,
            type: 'POST',
            data: $('#ticket-form-dynamic-truck').serialize(),
            success: function (data) {
                // Some script
            }
        });
    });
    // Dynamic binding for removing a sub-form
    $(document).on('click', '.remove-sub-form-truck', function () {
        $(this).closest('.sub-form-truck').fadeOut('slow', function () {
            $(this).remove();
            $('.add-sub-form-truck').prop('disabled', false);
        });
    });
//==========END:: Ajax script for Dynamic adding Miscellaneous blocks  ===========






});

