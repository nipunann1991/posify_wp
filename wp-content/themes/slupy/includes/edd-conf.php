<?php

/*---------------------------------------------
  Get first shortcode in edd content
---------------------------------------------*/
if ( !function_exists( 'get_shortcode_in_edd_content' ) ) {

function get_shortcode_in_edd_content() {

  $val = '';

  $a_shortcode = get_first_slupy_shortcode( 'slupy_post_header', get_the_content() );

  if ( $a_shortcode ) {
    $val = do_shortcode( $a_shortcode );
  }

  return $val;

}

}

/*---------------------------------------------
  Remove first shortcode in edd content
---------------------------------------------*/
if ( !function_exists( 'remove_shortcode_in_edd_content' ) ) {

function remove_shortcode_in_edd_content($content) {

  $a_shortcode = get_first_slupy_shortcode( 'slupy_post_header', $content );

  if( $a_shortcode ) {
    $content = str_replace( $a_shortcode, '', $content );
  }

  return $content;

}

}

/*---------------------------------------------
  Download Item Header
---------------------------------------------*/
if( !function_exists('get_slupy_edd_download_header') ) {

function get_slupy_edd_download_header(){

  //$output = '';
  $edd_img_size = is_single() ? ts_get_option('edd_single_img_size') : ts_get_option('edd_img_size');
  $edd_img_size = !$edd_img_size ? 'slupy-post-thumbnail' : $edd_img_size;

  if ( has_post_thumbnail( get_the_ID() ) ) {
    $ts_attachment_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full');
    $ts_attachment_image_src = !empty( $ts_attachment_image[0] ) ? $ts_attachment_image[0] : '';

    echo '<a href="'.esc_url( get_permalink() ).'" data-mfp-src="'.esc_url( $ts_attachment_image_src ).'" class="edd-download-img">
        '.get_the_post_thumbnail(get_the_ID(), $edd_img_size, array('class' => 'aligncenter')).'
      </a>';
  }

  echo get_shortcode_in_edd_content();
  
}

}

/*---------------------------------------------
  Change Button Colors
---------------------------------------------*/
if( !function_exists('change_edd_button_colors') ) {

function change_edd_button_colors( $colors = array() ) {
  return array(
    'default-bg-color'     => array(
      'label' => esc_attr__( 'Default', 'edd' ),
      'hex'   => ''
    )
  );
}

}

/*---------------------------------------------
  Add Wrapper Class Name
---------------------------------------------*/
if( !function_exists('add_edd_downloads_list_wrapper_class') ) {

function add_edd_downloads_list_wrapper_class( $wrapper_class ) {
  return $wrapper_class.' edd-downloads-wrap row';
}

}

/*---------------------------------------------
  Add Download Class Name
---------------------------------------------*/
if( !function_exists('add_edd_download_class') ) {

function add_edd_download_class( $edd_class, $id, $atts, $i ) {
  
  switch( intval( $atts['columns'] ) ) {
    case 0:
      $extra_class = 'col-xs-12 col-sm-12';
    break;
    case 1:
      $extra_class = 'col-xs-12 col-sm-12';
    break;
    case 2:
      $extra_class = 'col-xs-12 col-sm-6';
    break;
    case 3:
    default:
      $extra_class = 'col-xs-12 col-sm-6 col-md-4 col-lg-4';
    break;
    case 4:
      $extra_class = 'col-xs-12 col-sm-6 col-md-3 col-lg-3';
    break;
    case 5:
      $extra_class = 'col-xs-12 col-sm-12 col-edd-5';
    break;
    case 6:
      $extra_class = 'col-xs-12 col-sm-6 col-md-2 col-lg-2';
    break;
  }

  return $edd_class.' edd-download-item '.$extra_class;
}

}

/*---------------------------------------------
  Remove jQuery UI global css
---------------------------------------------*/
if( !function_exists('edd_remove_admin_scripts') ) {

function edd_remove_admin_scripts() {
  wp_dequeue_style( 'jquery-ui-css' );
}

}

/*---------------------------------------------
  Comment Support
---------------------------------------------*/
if( !function_exists('modify_edd_product_supports') ) {

function modify_edd_product_supports($supports) {
  $supports[] = 'comments';
  return $supports; 
}

}

/*---------------------------------------------
  Actions & Filters
---------------------------------------------*/
add_action( 'admin_enqueue_scripts', 'edd_remove_admin_scripts', 100 );
add_action( 'slupy_edd_download_header', 'get_slupy_edd_download_header' );


add_filter( 'edd_download_supports', 'modify_edd_product_supports' );
add_filter( 'edd_button_colors', 'change_edd_button_colors' );
add_filter( 'edd_downloads_list_wrapper_class', 'add_edd_downloads_list_wrapper_class' );
add_filter( 'edd_download_class', 'add_edd_download_class', 10, 4 );