<?php
    $wpconfig = realpath("../../../../wp-config.php");
    if (!file_exists($wpconfig))  {
        echo "Could not found wp-config.php. Error in path :\n\n".$wpconfig ;
        die;
    }
    require_once($wpconfig);
    //require_once(ABSPATH.'/wp-admin/admin.php');
    global $wpdb;
    global $payament_digital;
?>

<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>Pagamento Digital WP e-Commerce</title>
        <!-- 	<meta http-equiv="Content-Type" content="<?php// bloginfo('html_type'); ?>; charset=<?php //echo get_option('blog_charset'); ?>" /> -->
        <script language="javascript" type="text/javascript" src="<?php echo get_option('siteurl') ?>/wp-includes/js/tinymce/tiny_mce_popup.js"></script>
        <script language="javascript" type="text/javascript" src="<?php echo get_option('siteurl') ?>/wp-includes/js/tinymce/utils/form_utils.js"></script>
        <script language="javascript" type="text/javascript" src="<?php echo get_option('siteurl') ?>/wp-content/plugins/pagamento-digital-wp-e-commerce/assets/js/tinymce.js"></script>
        <script language="javascript" type="text/javascript" src="<?php echo get_option('siteurl') ?>/wp-content/plugins/pagamento-digital-wp-e-commerce/assets/js/jQuery.js"></script>
        <script language="javascript" type="text/javascript" src="<?php echo get_option('siteurl') ?>/wp-content/plugins/pagamento-digital-wp-e-commerce/assets/js/price_format.js"></script>
        <script language="javascript" type="text/javascript" src="<?php echo get_option('siteurl') ?>/wp-content/plugins/pagamento-digital-wp-e-commerce/assets/js/script_admin.js"></script>
        <base target="_self" />
    </head>
    <body id="link" onload="tinyMCEPopup.executeOnLoad('init();');document.body.style.display='';" style="display: none">
        <!-- <form onsubmit="insertAction();return false;" action="#" autocomplete="off">-->
        <form name="pdwp" action="#">
            <table border="0" cellpadding="4" cellspacing="0">
                <tr>
                    <td nowrap="nowrap"><label for="product_code"><?php _e("Product code", 'PDWP'); ?></label></td>
                    <td>
                        <input type="text" id="product_code" name="product_code" style="width: 200px"/>
                    </td>
                </tr>
                <tr>
                    <td nowrap="nowrap"><label for="product_name"><?php _e("Product name", 'PDWP'); ?></label></td>
                    <td>
                        <input type="text" id="product_name" name="product_name" style="width: 200px"/>
                    </td>
                </tr>
                <tr>
                   <td nowrap="nowrap"><label for="product_price"><?php _e("Product price", 'PDWP'); ?></label></td>
                   <td>
                        <input type="text" id="product_price" name="product_price" style="width: 200px"/>
                   </td>
                </tr>
            </table>
            <div class="mceActionPanel">
            <p>
                <div style="float: left">
                    <input type="button" id="cancel" name="cancel" value="<?php _e("Cancel", 'PDWP'); ?>" onclick="tinyMCEPopup.close();" />
                </div>
                <div style="float: right">
                    <input type="submit" id="insert" name="insert" value="<?php _e("Insert", 'PDWP'); ?>" onclick="insertPDWPcode();" />
                </div>
            </p>
            </div>
        </form>
    </body>
</html>