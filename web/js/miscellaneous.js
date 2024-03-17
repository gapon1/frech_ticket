$(document).ready(function () {

//==========  Script for Miscellaneous Widget  ===========
    $(document).on('input', '.miscellaneous-price, .miscellaneous-quantity', function () {
        // Find the closest row container
        var $row = $(this).closest('.sub-form');
        // Parse the cost and quantity values as floats and default to 0 if NaN
        var cost = parseFloat($row.find('.miscellaneous-price').val()) || 0;
        var quantity = parseFloat($row.find('.miscellaneous-quantity').val()) || 0;
        // Calculate the total for the row
        var total = cost * quantity;
        // Update the total input in the current row
        $row.find('.miscellaneous-total').val(total.toFixed(2)); // Rounds to two decimal places
        $row.find('.miscellaneous-sub_total').val(total.toFixed(2)); // Rounds to two decimal places
    });
//==========END:: Script for Miscellaneous Widget  ===========
});