$(document).ready(function () {

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
});