$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});


function quickView(element, url) {

    var product_id = $(element).data('product_id');
    // console.log(product_id);
    var _token = $('input[name="_token"]').val();
    $.ajax({
        url: url,
        method: "POST",
        dataType: "JSON",
        data: {product_id:product_id, id_token: _token},

        success:function(data) {
            console.log(data);
            $('#product_quickview_title').html(data.product_name);
            $('#product_quickview_id').html(data.id_product);
            // $('#id_product_addtocart').html(data.product_id);
            $('#product_quickview_description').html(data.product_description);
            $('#product_quickview_content').html(data.product_content);
            $('#product_quickview_price').html(data.product_price);
            $('#product_quickview_file').html(data.product_file);



        }, error(response) {
            const jsonResponse = JSON.parse(response.responseText);
            console.log(jsonResponse.message);
        }
    })

}

// gán giá trị id add-to-cart cho quick view
$('#xemnhanh').on('shown.bs.modal', function () {
    var productQuickviewId = $('#product_quickview_id').text();

    if (productQuickviewId.trim() !== "") {
        $('#id-product-quickview').val(productQuickviewId);
    }
});

