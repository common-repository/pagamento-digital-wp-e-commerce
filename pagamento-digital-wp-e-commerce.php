<?php
/*
Plugin Name: Pagamento Digital WP e-Commerce
Plugin URI: http://developer.buscape.com/blog/aplicativos/pagamento-digital-wp-e-commerce/
Description: Integrates your WordPress blog to use e-commerce provided by Pagamento Digital
Author: Apiki
Version: 0.2
Author URI: http://apiki.com/
*/
require_once 'includes/pagamento-digital-wp-e-commerce-widget.php';

class Payament_Digital
{

    public function __construct()
    {
        $pdwp_settings = get_option('payment_digital_settings');

        add_action( 'activate_pagamento-digital-wp-e-commerce/pagamento-digital-wp-e-commerce.php', array( &$this ,'install' ) );
        add_action( 'admin_menu', array( &$this, 'menu' ) );
        add_action( 'wp_print_scripts', array( &$this, 'javascript' ) );
        add_action( 'init', array( &$this, 'textdomain' ) );

        if (!empty($pdwp_settings['email'])) :
            add_action('init', array( &$this, 'add_button_payment_digital' ) );
            add_action('widgets_init', create_function('', 'return register_widget("Payment_Digital_Widget");'));
            add_shortcode('pdwpe', array( &$this,'pdwpe_shortcode') );
        endif;

        add_action( 'admin_notices', array( &$this, 'alert_required_settings' ) );

    }

    public function textdomain()
    {
        load_plugin_textdomain( 'PDWP', false , 'pagamento-digital-wp-e-commerce/languages' );
    }

    public function install()
    {
        $role = get_role( 'administrator' );
        if( !$role->has_cap( 'payment_digital' ) )
            $role->add_cap( 'payment_digital' );

        $pwdp_options = array('email' => '', 'title_shopping_cart' => __('Shopping added', 'PDWP'), 'text_button_cart' => __('Add to cart', 'PDWP') );
        add_option('payment_digital_settings',$pwdp_options);
    }

    public function menu()
    {
       if( function_exists( 'add_menu_page' ) )
            add_menu_page( __('Pagamento digital','PDWP'),__('Pagamento digital','PDWP'), 'payment_digital', 'pagamento-digital-wp-e-commerce/includes/pagamento-digital-wp-e-commerce-settings.php','', WP_PLUGIN_URL . '/pagamento-digital-wp-e-commerce/images/bt_comprar.png' );
    }

    function alert_required_settings()
    {
        $settings_page = admin_url( 'admin.php?page=pagamento-digital-wp-e-commerce/includes/pagamento-digital-wp-e-commerce-settings.php' );
        $pdwp_settings = get_option('payment_digital_settings');
        if ( empty($pdwp_settings['email']) and strpos(esc_url($_SERVER['REQUEST_URI']), 'wp-ecommerce-settings') === false )
            printf( '<div class="updated"><p>%s</p></div>', sprintf( __( 'Pagamento digital requires settings. Go to <a href="%s">Settings page</a> to configure it.', 'PDWP' ), $settings_page ) );
    }

    function javascript()
    {
        if ( ! is_admin() ) :
            $version = filemtime( WP_PLUGIN_DIR . '/pagamento-digital-wp-e-commerce/assets/js/script.js' );
            wp_enqueue_script( 'pagamento-digital-wp-e-commerce-script', WP_PLUGIN_URL . '/pagamento-digital-wp-e-commerce/assets/js/script.js', array( 'jquery' ), $version, true );
        endif;
    }

    function update_settings()
    {
        extract($_POST, EXTR_SKIP);

        $pwdp_options = array('email' => $add_email, 'title_shopping_cart' => $add_title_shopping_cart, 'text_button_cart' => $add_text_button_cart);
        update_option('payment_digital_settings', $pwdp_options);

        return true;
    }

    function pdwpe_shortcode($atts)
    {
        extract($atts);

        $pdwp_settings = get_option('payment_digital_settings');
        $name_button   = $pdwp_settings['text_button_cart'];
        $html = '<object>
                    <form method="post"  action="?pdwp=click_button"  style="display:inline">
                        <input type="submit" value="'.$name_button.'" />
                        <input type="hidden" name="product_code"  value="'.$product_code.'" />
                        <input type="hidden" name="product_name"  value="'.$product_name.'" />
                        <input type="hidden" name="product_price" value="'.$product_price.'" />
                    </form>
                </object>';
        return $html;

    }
   
    function add_button_payment_digital()
    {
        add_filter('mce_external_plugins', array( &$this, 'add_payment_digital_tinymce_plugin'), 5);
	add_filter('mce_buttons', array( &$this, 'register_payment_digital_button') , 5);
    }

    function register_payment_digital_button($buttons)
    {
        array_push($buttons, "separator", "payment_digital");
        return $buttons;
    }

    function add_payment_digital_tinymce_plugin($plugin_array)
    {
        $plugin_array['payment_digital'] = get_option('siteurl').'/wp-content/plugins/pagamento-digital-wp-e-commerce/assets/js/editor_plugin.js';
        return $plugin_array;
    }
    
}

$payament_digital = New Payament_Digital();