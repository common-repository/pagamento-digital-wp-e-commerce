<?php
    $base_name = plugin_basename('pagamento-digital-wp-e-commerce/includes/pagamento-digital-wp-e-commerce-settings.php');
    $base_page = 'admin.php?page='.$base_name;

    if ( isset( $_POST['action'] ) )
        $update_settings = $payament_digital->update_settings( $_POST );
    else
        $update_settings = '';

    $payment_digital_settings = get_option('payment_digital_settings');
?>

<div class="wrap">
    <h2><?php _e('Pagamento Digital WP e-Commerce - Settings','PDWP') ?></h2>

    <?php if ( $update_settings ) : ?>
        <div class="updated fade" id="message">
            <p> <?php _e('Settings updated successfully!','PDWP') ?> </p>
        </div>
    <?php endif; ?>

    <form action="<?php echo $base_page; ?>" method="post" enctype="multipart/form-data">
        <table class="form-table" >
            <tbody>
                <?php if (! empty($payment_digital_settings) )  ?>
                        <tr valign="top" >
                            <th scope="row">
                                <label for="add_email"><?php _e('Email and Contact Information','PDWP') ?></label>
                            </th>
                            <td>
                                <input type="text"  class="regular-text" id="add_email" name="add_email"  value="<?php echo ( ! empty( $payment_digital_settings['email'] ) ) ? $payment_digital_settings['email'] : '' ?>" />
                            </td>
                        </tr>
                        <tr valign="top" >
                            <th scope="row">
                                <label for="add_title_shopping_cart"><?php _e('Title of the shopping cart','PDWP') ?></label>
                            </th>
                            <td>
                                <input type="text"  class="regular-text" id="add_title_shopping_cart" name="add_title_shopping_cart"  value="<?php echo ( ! empty( $payment_digital_settings['title_shopping_cart'] ) ) ? $payment_digital_settings['title_shopping_cart'] : '' ?>" />
                            </td>
                        </tr>
                        <tr valign="top" >
                            <th scope="row">
                                <label for="add_text_button_cart"><?php _e('Text of the button add to cart','PDWP') ?></label>
                            </th>
                            <td>
                                <input type="text" class="regular-text" id="add_text_button_cart" name="add_text_button_cart" value="<?php echo ( ! empty( $payment_digital_settings['text_button_cart'] ) ) ? $payment_digital_settings['text_button_cart'] : '' ?>" />
                            </td>
                        </tr>
            </tbody>
        </table>
        <p class="submit">
            <input type="submit" value="<?php _e('Save','PDWP') ?> " class="button-primary" name="action" />
        </p>
    </form>
</div>

