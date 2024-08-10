$(function () {
    CKEDITOR.replace('ckeditor');
    CKEDITOR.config.height = 300;
    $('.select2').select2()

    $('#gst, #purchase').on('keyup', function () {
        var gstValue = parseFloat($('#gst').val());
        var purchase = $('#purchase').val();
        if (!purchase) {
            $('#netcost').val('');
            return;
        }
        purchase = parseFloat(purchase);
        var netcostValue = purchase + (purchase * gstValue / 100);
        $('#netcost').val(netcostValue.toFixed(2));
    });


    $('#saleprice, #disper').on('keyup', function () {
        var distribute_percentage = parseFloat($('#disper').val());
        var saleprice = $('#saleprice').val();

        if (!distribute_percentage) {
            $('#disamount').text('');
            return;
        }
        if (!saleprice) {
            $('#disamount').text('');
            return;
        }

        saleprice = parseFloat(saleprice);
        var netcostValue = saleprice - (saleprice * distribute_percentage / 100);
        var percentageAmount = (saleprice * distribute_percentage / 100).toFixed(
            2);
        $('#disamount').text(percentageAmount);
    });


});

