jQuery( function() {
    jQuery( 'input[name="qtde_product[]"]' ).blur( function() {
        jQuery('#frm-pagamento-digital-wp-ecommerce-cart').submit();
    })
} );