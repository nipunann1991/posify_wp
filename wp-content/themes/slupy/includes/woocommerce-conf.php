<?php

/*---------------------------------------------
  Change Widget Cart Item Quantity
---------------------------------------------*/
if( !function_exists('change_woocommerce_widget_cart_item_quantity') ) {

function change_woocommerce_widget_cart_item_quantity($product_price){
  $val = str_replace(' &times; ', '', $product_price);
  $val = str_replace('<span class="quantity">', '<span class="quantity"><span class="total-item"><span>', $val);
  $val = str_replace('<span class="amount">', '</span></span><span class="amount">', $val);
  return $val;
}

}

/*---------------------------------------------
  Custom Woocommerce Styles
---------------------------------------------*/
if( !function_exists('change_woocommerce_enqueue_styles') ) {

function change_woocommerce_enqueue_styles($styles){
  return array(
    'woocommerce-general' => array(
      'src'     => SLUPY_CSS.'/woocommerce.css',
      'deps'    => '',
      'version' => WC_VERSION,
      'media'   => 'all'
    )
  );
}

}

/*---------------------------------------------
  Set Product List Column
---------------------------------------------*/
if ( !function_exists('change_woocommerce_loop_columns') ) {

function change_woocommerce_loop_columns() {
  return ts_get_option('product_max_columns') ? ts_get_option('product_max_columns') : '4';
}

}

/*---------------------------------------------
  Change Related Product Limit
---------------------------------------------*/
if( !function_exists('woo_related_products_limit') ) {

function woo_related_products_limit() {
  global $product;

  $posts_per_page = 4;

  $related = $product->get_related($posts_per_page);
  
  $args = array(
    'post_type'             => 'product',
    'no_found_rows'         => 1,
    'posts_per_page'        => $posts_per_page,
    'ignore_sticky_posts'   => 1,
    'orderby'               => 'rand',
    'post__in'              => $related,
    'post__not_in'          => array($product->id)
  );
  return $args;
}

}


/*---------------------------------------------
  Change Breadcrumb Nav Output
---------------------------------------------*/
if( !function_exists('change_woocommerce_breadcrumbs') ) {

function change_woocommerce_breadcrumbs() {
  return array(
    'delimiter'   => '<span class="woo-divider fa fa-angle-right"></span>',
    'wrap_before' => '<nav class="woocommerce-breadcrumb breadcrumbs" itemprop="breadcrumb">'.__('You are here:', SLUPY_TRANSLATE),
    'wrap_after'  => '</nav>',
    'before'      => '',
    'after'       => '',
    'home'        => _x( 'Home', 'breadcrumb', SLUPY_TRANSLATE ),
  );
}

}

/*---------------------------------------------
  Change Product Search Form
---------------------------------------------*/
if( !function_exists('change_product_search_form') ) {

function change_product_search_form( $form ){
  $form = str_replace('<input type="hidden" name="post_type" value="product" />', '<button class="search-submit" type="submit" role="button">Search</button><input type="hidden" name="post_type" value="product" />', $form);
  return $form;
}

}

/*---------------------------------------------
  Display the second thumbnails
---------------------------------------------*/
if( !function_exists('wc_second_product_thumbnail_end') ) {

function wc_second_product_thumbnail_end() {
  global $product, $woocommerce;

  $attachment_ids = $product->get_gallery_attachment_ids();

  if ( $attachment_ids ) {
    $secondary_image_id = $attachment_ids['0'];
    echo wp_get_attachment_image( $secondary_image_id, 'shop_catalog', '', $attr = array( 'class' => 'secondary-product-image attachment-shop-catalog' ) ).'</span>';
  }
}

}

if( !function_exists('wc_second_product_thumbnail') ) {

function wc_second_product_thumbnail() {
  echo '<span class="product-image-loop">';
}

}

/*---------------------------------------------
  Actions & Filters
---------------------------------------------*/
add_filter( 'woocommerce_related_products_args', 'woo_related_products_limit' );
add_filter( 'woocommerce_breadcrumb_defaults', 'change_woocommerce_breadcrumbs' );
add_filter( 'woocommerce_widget_cart_item_quantity','change_woocommerce_widget_cart_item_quantity',0,1 );
add_filter( 'woocommerce_enqueue_styles', 'change_woocommerce_enqueue_styles' );
add_filter( 'woocommerce_show_page_title', '__return_false' );
add_filter( 'loop_shop_columns', 'change_woocommerce_loop_columns' );
add_filter( 'get_product_search_form', 'change_product_search_form' );

add_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 9);
add_action( 'woocommerce_before_shop_loop_item_title', 'wc_second_product_thumbnail', 9 );
add_action( 'woocommerce_before_shop_loop_item_title', 'wc_second_product_thumbnail_end', 11 );

remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10);
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );