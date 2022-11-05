<?php

/**
 * Plugin Name: Add to Cart Button Text changer Addon
 * Plugin URI: #
 * Description: A addons plugin for Add to Cart Button Text change
 * Author: Hannan
 * Author URI: #
 * Version: 1.0
 * Text Domain: wabt
 */


 /* Change Add to cart text changer in shop page */ 
 if( !function_exists('wabt_change_button_text')){
    function wabt_change_button_text (){
        $cart_btn_text = get_option('wabt_text_one');

        if(empty($cart_btn_text)){
            $cart_btn_text = 'Add to Basket';
            return $cart_btn_text;
        }
        
        return $cart_btn_text;
    }
 }

 add_filter('woocommerce_product_add_to_cart_text','wabt_change_button_text',100);
 add_filter( 'woocommerce_product_single_add_to_cart_text','wabt_change_button_text',100);

 /* Add input fied for add to cart button*/
function wabt_add_new_to_add_cart(){

    add_settings_field('wabt_text_one',__('Add to Cart Button Text','wabt'),'wabt_display_add_to_cart_button_text','general');
    register_setting('general','wabt_text_one',array('sanitize_callback'=>'esc_html'));

}

function wabt_display_add_to_cart_button_text(){

    $add_to_cart_btn_text = get_option('wabt_text_one');

    printf("<input type='text' id='%s' name='%s' value='%s' ",'wabt_text_one','wabt_text_one', $add_to_cart_btn_text);
}

 add_action('admin_init','wabt_add_new_to_add_cart');