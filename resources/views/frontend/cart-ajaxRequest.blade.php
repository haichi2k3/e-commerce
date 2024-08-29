<script>
    // add to cart
    $('.add-to-cart').on('click', function() {
        var productId = $(this).data('product-id');

        $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

        $.ajax({
            url: "{{ route('cart.add') }}",
            method: "POST",
            data: {
                "product_id": productId,
            },
            success: function (response) {
                alert (response.message);
                $('#cart-count').text(response.cart_count);
            }
        })
    });

    $('.cart_quantity_up, .cart_quantity_down').on('click', function(e) {
        e.preventDefault();
        var productId = $(this).data('product-id');
        var operation = $(this).data('operation');
        var deleteButton = $(this);

        $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

        $.ajax({
            url: "{{ route('cart.qty') }}",
            method: "POST",
            data: {
                "product_id": productId,
                "operation": operation,
            },
            success: function (response) {
                var qty = parseFloat(response.newQty);

                if (qty == 0) {
                    $(deleteButton).closest('tr').remove();
                }
                $('.cart_quantity_input[data-product-id="' + productId + '"]').val(qty);

                var price = parseFloat(deleteButton.closest('tr').find('.product_price').text().replace('$', ''));
                var total = price * qty
                $('.cart_total_price[data-product-id="' + productId + '"]').text('$' + total);

                var subTotal = parseFloat($('.subTotal').text().replace('$', ''));
                if (operation === 'increase') {
                    subTotal += price;
                } else if (operation === 'decrease') {
                    subTotal -= price;
                }
                $('.subTotal').text('$' + subTotal);
            },
        })
    });

    $('.cart_quantity_delete').on('click', function(e) {
        e.preventDefault();
        var productId = $(this).data('product-id');
        var deleteButton = $(this);

        $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

        $.ajax({
            url: "{{ route('cart.delete') }}",
            method: "POST",
            data: {
                "product_id": productId,
            },
            success: function (response) {
                if (response.delete == true) {
                    var subTotal = parseFloat($('.subTotal').text().replace('$', ''));
                    var total = parseFloat($('.cart_total_price[data-product-id="' + productId + '"]').text().replace('$', ''));

                    subTotal-= total;

                    $('.subTotal').text('$' + subTotal);
                    $(deleteButton).closest('tr').remove();
                }
            }
        })
    })
</script>