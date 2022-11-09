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
    function wabt_change_button_text ($default_text ){
        $cart_btn_text = get_option('wabt_text_one');

        if(!empty($cart_btn_text)){
            return $cart_btn_text;
        }
        
        return $default_text;
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

/* add new  settings for product general tab*/
function wabt_new_field_settings_product_tab($settings ){
 
 $add_to_cart_btn_text = get_option('wabt_text_one');
 
  $settings = array(
    array(
      'title'=>'Change Button text',
      'id'=>'wabt_change_text',
      'type'=>'title',
    ),
   array(
      'title'=>'Give Button text',
      'id'=>'wabt_text_one',
      'type'=>'text',
      'name'=>'wabt_text_one',
      'value'=> $add_to_cart_btn_text 
    )
  );
 
 return $settings;
}
add_filter('woocommerce_products_general_settings','wabt_new_field_settings_product_tab');
