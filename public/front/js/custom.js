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

    $('#category').on('change', function () {
        var category = $(this).val();
        var token = $('meta[name="csrf-token"]').attr('content');

        axios.post("{{ route('sub.category.ajax') }}", {
            id: category,
            '_token': token,
        })
            .then(function (response) {
                var subcategory = response.data;
                $('#subcategory').html('');
                $('#subcategory').append(
                    '<option value="">---Select---</option>');
                for (var i = 0; i < subcategory.length; i++) {
                    $('#subcategory').append(
                        '<option value="' + subcategory[i].id + '">' + subcategory[i]
                            .sub_category_name +
                        '</option>');
                }
            })
            .catch(function (error) {
                console.log(error);
            });
    });

    
});

