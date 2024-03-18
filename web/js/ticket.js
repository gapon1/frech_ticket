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
});