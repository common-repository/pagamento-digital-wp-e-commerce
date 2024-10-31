<?php
session_start();

class Payment_Digital_Widget extends WP_Widget {
    
    function Payment_Digital_Widget()
    {
        parent::WP_Widget(false, $name = 'Pagamento Digital Widget');
    }

    function widget($args, $instance) {
        extract( $args );

        if ( !empty($_GET['remove_produto']) ) //remove produto do carrinho de compra
            unset ($_SESSION['cart'][$_GET['remove_produto']]);
        elseif ( !empty($_GET['action']) ) //caso o usuário alterar a quantidade do carrinho de compra, o array do $SESSION['cart'] será substituido pelo valor informado
            if ($_GET['action'] == 'carrinho_compra') :
                $i = 0;
                foreach ($_POST['product_name'] as $key => $value) :
                    $_SESSION['cart'][$value] = array('codigo' => $_POST['product_code'][$i], 'qtde'  => $_POST['qtde_product'][$i], 'price' => $this->verifica_valor($_POST['product_price'][$i]));
                    $i++;
                endforeach;
            endif;
        elseif ( !empty($_GET['pdwp']) ) //É processado quando o usuário clica no botão do post.
            if ( !empty($_POST['product_name']) ) :
                $_SESSION['cart'][$_POST['product_name']] = array('qtde'   => (! empty ($_SESSION['cart'][$_POST['product_name']]['qtde']) ? $_SESSION['cart'][$_POST['product_name']]['qtde'] + 1 : 1),
                                                                  'price'  => $this->verifica_valor($_POST['product_price']),
                                                                  'codigo' => $_POST['product_code']);
            endif;
        if ( !empty($_SESSION['cart']) )
            require_once dirname( __FILE__ ) . '/pagamento-digital-wp-e-commerce-widget-forms.php';
    }

    public function verifica_valor( $vrf_valor )
    {
        $valor   = str_replace(array('.', ','), '', $vrf_valor);
        if ((substr($vrf_valor,-3,-2) == ',') || (substr($vrf_valor,-3,-2) == '.') ) :
            $milhar  = substr($valor,0,-2);
            $decimal = substr($valor,-2);
            $valor_corrigido = $milhar .'.'. $decimal;
        else :
            $valor_corrigido = $valor;
        endif;

        return $valor_corrigido;
    }

}