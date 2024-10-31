<?php
    $pdwp_settings = get_option('payment_digital_settings');
    $name_cart     = $pdwp_settings['title_shopping_cart'];
    $email         = $pdwp_settings['email'];
?>
<!-- Insere form do carrinho de compras ao widget -->
<form method="post" id="frm-pagamento-digital-wp-ecommerce-cart" action="?action=carrinho_compra" style="display:inline">
    <h3><?php echo $name_cart; ?></h3>
    <table>
        <thead>
            <tr>
                <th><?php _e('Product','PDWP');  ?> </th>
                <th><?php _e('Quantity','PDWP'); ?> </th>
                <th><?php _e('Total,$','PDWP');  ?> </th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php $valor_total = 0;
            foreach ((array)$_SESSION['cart'] as $key => $value) : ?>
                <tr>
                    <td><?php echo $key; ?> </td>
                    <td><input type="text" name="qtde_product[]" value="<?php echo $value['qtde']; ?>" size="2" /></td>
                    <td><?php echo number_format(($value['qtde'] * $value['price']), 2, ',','.'); ?></td>
                    <td><a class="btn-delete" title="<?php _e('Remove'); ?> <?php echo $key;?>" href="<?php echo get_bloginfo('url'); ?>?remove_produto=<?php echo $key;?>"><?php _e('Remove'); ?></a></td>
                    <?php $valor_total = $valor_total + ($value['qtde'] * $value['price']);?>
                </tr>
                <input type="hidden" name="product_code[]"  value="<?php echo $value['codigo'] ?>" />
                <input type="hidden" name="product_name[]"  value="<?php echo $key ?>" />
                <input type="hidden" name="product_price[]" value="<?php echo $value['price'] ?>" />
            <?php endforeach; ?>
            <tr>
                <td></td><td><?php _e('Total,$','PDWP') ?> </td><td> <?php echo number_format($valor_total, 2 , ',','.'); ?> </td>
            </tr>
        </tbody>
    </table>
</form>

<!-- Insere form com os dados dos produtos adicionados ao carrinho para o pagamento digital -->
<form name="pagamentodigital" action="https://www.pagamentodigital.com.br/checkout/pay/" method="post">
    <?php
        $i = 1;
        foreach ((array)$_SESSION['cart'] as $key => $value) :
            printf('<input name="email_loja" type="hidden" value="%s">',$email);
            printf('<input name="produto_codigo_%s" type="hidden" value="%s">',$i,$value['codigo']);
            printf('<input name="produto_descricao_%s" type="hidden" value="%s">',$i,$key);
            printf('<input name="produto_qtde_%s" type="hidden" value="%s">',$i,$value['qtde']);
            printf('<input name="produto_valor_%s" type="hidden" value="%s" >',$i,$value['price']);
            $i++;
        endforeach;
    ?>
    <input name="frete" type="hidden" value="0" />
    <input type="image" src="https://www.pagamentodigital.com.br/webroot/img/bt_comprar.gif" value="Comprar" alt="Comprar" border="0" align="absbottom" />
</form>