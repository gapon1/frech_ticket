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

//========== Ajax script for Dynamic adding Miscellaneous blocks  ===========
    let counter = 0;
    const searchParams = new URLSearchParams(window.location.search);
    let ticketId = searchParams.getAll('id')
    $(document).on('click', '.add-sub-form', function () {
        $('<div>', {id: 'sub-forms-container_main',}).appendTo('#sub-forms-container');
        counter++;
        $.ajax({
            url: '/dependent-dropdown/miscellaneous-add-block?index&counter=' + counter + '&ticketId=' + ticketId, // Adjust URL as needed
            type: 'post',
            data: {index: counter},
            success: function (data) {
                $('.add-sub-form').prop('disabled', true);
                $('#sub-forms-container_main').append(data);
            }
        });
    });


    // Create new entity
    $(document).on('click', '#save_dynamic', function (e) {
        e.preventDefault();
        $.ajax({
            url: '/dependent-dropdown/create-miscellaneous?id=' + ticketId,
            type: 'POST',
            data: $('#ticket-form-dynamic').serialize(),
            success: function (data) {
                $('#sub-forms-container_main').remove();
                $('#misc_container').replaceWith(data); // Replace the content
                $('.add-sub-form').prop('disabled', false);
            }
        });
    });

    //==========  Delete block

    $(document).on('click change', '.remove-sub-form', function (e) {
        let blockId = $(this).attr('id')
        e.preventDefault();
        $.ajax({
            url: '/dependent-dropdown/delete-miscellaneous?id=' + blockId,
            type: 'POST',
            data: $('#ticket-form').serialize(),
            success: function (data) {
                // Some script
            }
        });
    });
    // Dynamic binding for removing a sub-form
    $(document).on('click', '.remove-sub-form', function () {
        $(this).closest('.sub-form').fadeOut('slow', function () {
            $(this).remove();
            $('.add-sub-form').prop('disabled', false);
        });
    });
//==========END:: Ajax script for Dynamic adding Miscellaneous blocks  ===========

});