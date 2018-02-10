<?php
/*
    Visual Composer for Slupy Theme
*/

/*---------------------------------------------
    Slupy Shortcodes for VC
---------------------------------------------*/
function slupy_shortcodes_for_vc($options){

  foreach (get_intermediate_image_sizes() as $key => $image_size) {
    $all_image_sizes[$image_size] = $image_size;
  }

  array_push($options, array(
    array(
      'name'              => __('Portfolio',SLUPY_TRANSLATE),
      'base'              => 'slupy_portfolio',
      'description'       => __('Add a Portfolio Page',SLUPY_TRANSLATE),
      'category'          => __('Content',SLUPY_TRANSLATE),
      'icon'              => 'fa-briefcase',
      'class'             => '',
      'params'            => array(
        array(
          'type'          => 'dropdown',
          'heading'       => __('Thumbnail Model',SLUPY_TRANSLATE),
          'admin_label'   => true,
          'param_name'    => 'model',
          'value'         => array(
            __('Model 1', SLUPY_TRANSLATE) => '1',
            __('Model 2', SLUPY_TRANSLATE) => '2',
            __('Model 3', SLUPY_TRANSLATE) => '3'
          ),
          'class'         => ''
        ),
        array(
          'type'          => 'switch_slupy',
          'heading'       => __('List Style',SLUPY_TRANSLATE),
          'param_name'    => 'masonry',
          'value'         => 'on',
          'title_switch'  => __('MASONRY',SLUPY_TRANSLATE).':'.__('GRID',SLUPY_TRANSLATE),
          'dependency'    => array( 'element' => 'model', 'value' => array( '1', '2' ) ),
          'class'         => ''
        ),
        array(
          'type'          => 'switch_slupy',
          'heading'       => __('Fit Grid Height?',SLUPY_TRANSLATE),
          'param_name'    => 'fit_grid',
          'value'         => 'on',
          'dependency'    => array( 'element' => 'masonry', 'value' => array( 'off' ) ),
          'class'         => ''
        ),
        array(
          'type'          => 'switch_slupy',
          'heading'       => __('Loop Items Padding?',SLUPY_TRANSLATE),
          'param_name'    => 'padding',
          'value'         => 'on',
          'class'         => ''
        ),
        array(
          'type'          => 'switch_slupy',
          'heading'       => __('Filterable',SLUPY_TRANSLATE),
          'param_name'    => 'filterable',
          'value'         => 'on',
          'class'         => ''
        ),
        array(
          'type'          => 'dropdown',
          'heading'       => __('Filterable Position',SLUPY_TRANSLATE),
          'param_name'    => 'filterable_pos',
          'value'         => array(
            __('Right' ,SLUPY_TRANSLATE)      => 'right',
            __('Left' ,SLUPY_TRANSLATE)       => 'left',
            __('Center' ,SLUPY_TRANSLATE)     => 'center'
          ),
          'class'         => ''
        ),
        array(
          'type'          => 'dropdown',
          'heading'       => __('Portfolio Max Columns',SLUPY_TRANSLATE),
          'param_name'    => 'max_columns',
          'value'         => array('2' => '2', '3' => '3', '4' => '4', '5' => '5'),
          'class'         => ''
        ),
        array(
          'type'          => 'textfield',
          'heading'       => __('Portfolio Per Page',SLUPY_TRANSLATE),
          'param_name'    => 'posts_per_page',
          'value'         => '10',
          'class'         => ''
        ),
        array(
          'type'          => 'dropdown',
          'heading'       => __('Pagination Style',SLUPY_TRANSLATE),
          'param_name'    => 'pagination',
          'admin_label'   => true,
          'value'         => array(
            __('Load More', SLUPY_TRANSLATE)             => 'loadmore',
            __('Older & Newer Button', SLUPY_TRANSLATE)  => 'oldernewer',
            __('Page Numbers', SLUPY_TRANSLATE)          => 'pagenumbers',
            __('None', SLUPY_TRANSLATE)                  => 'none'
          ),
          'class'         => ''
        ),
        array(
          'type'          => 'dropdown',
          'heading'       => __('Image Size',SLUPY_TRANSLATE),
          'param_name'    => 'image_size',
          'value'         => $all_image_sizes,
          'class'         => ''
        ),
        array(
          'type'          => 'textfield',
          'heading'       => __('Exclude Category / Categories', SLUPY_TRANSLATE),
          'param_name'    => 'exclude',
          'value'         => '',
          'class'         => '',
          'description'   => __('Write a category id or ids. Separate by comma.', SLUPY_TRANSLATE)
        )
      )
    ),
    array(
      'name'              => __('Latest Projects',SLUPY_TRANSLATE),
      'base'              => 'slupy_cportfolio',
      'description'       => __('Show latest projects with carousel slider',SLUPY_TRANSLATE),
      'category'          => __('Slider',SLUPY_TRANSLATE),
      'icon'              => 'dashicons-backup',
      'class'             => '',
      'params'            => array(
        array(
          'type'          => 'dropdown',
          'heading'       => __('Thumbnail Model',SLUPY_TRANSLATE),
          'admin_label'   => true,
          'param_name'    => 'model',
          'value'         => array(
            __('Model 1', SLUPY_TRANSLATE) => '1',
            __('Model 2', SLUPY_TRANSLATE) => '2'
          ),
          'class'         => ''
        ),
        array(
          'type'          => 'textfield',
          'heading'       => __('Limit',SLUPY_TRANSLATE),
          'param_name'    => 'limit',
          'admin_label'   => true,
          'value'         => '8',
          'class'         => ''
        ),
        array(
          'type'          => 'dropdown',
          'heading'       => __('Image Size',SLUPY_TRANSLATE),
          'param_name'    => 'image_size',
          'value'         => $all_image_sizes,
          'class'         => ''
        ),
        array(
          'type'          => 'textfield',
          'heading'       => __( 'Slide Duration Time (second)', SLUPY_TRANSLATE ),
          'param_name'    => 'duration_time',
          'value'         => '5',
          'group'         => __( 'Slider Config', SLUPY_TRANSLATE ),
          'class'         => ''
        ),
        array(
          'type'          => 'switch_slupy',
          'heading'       => __( 'Auto Play', SLUPY_TRANSLATE ),
          'param_name'    => 'autoplay',
          'value'         => 'on',
          'group'         => __( 'Slider Config', SLUPY_TRANSLATE ),
          'class'         => ''
        ),
        array(
          'type'          => 'switch_slupy',
          'heading'       => __( 'Stop on Hover', SLUPY_TRANSLATE ),
          'param_name'    => 'stop_hover',
          'value'         => 'on',
          'group'         => __( 'Slider Config', SLUPY_TRANSLATE ),
          'class'         => ''
        ),
        array(
          'type'          => 'switch_slupy',
          'heading'       => __( 'Pagination', SLUPY_TRANSLATE ),
          'param_name'    => 'pagination',
          'value'         => 'on',
          'group'         => __( 'Slider Config', SLUPY_TRANSLATE ),
          'class'         => ''
        ),
        array(
          'type'          => 'switch_slupy',
          'heading'       => __( 'Touch Drag', SLUPY_TRANSLATE ),
          'param_name'    => 'touch_drag',
          'value'         => 'on',
          'group'         => __( 'Slider Config', SLUPY_TRANSLATE ),
          'class'         => ''
        ),
        array(
          'type'          => 'textfield',
          'heading'       => __('Show Max Items',SLUPY_TRANSLATE),
          'param_name'    => 'show_max_item',
          'group'         => __( 'Layout Config', SLUPY_TRANSLATE ),
          'value'         => '4',
          'class'         => ''
        ),
        array(
          'type'          => 'textfield',
          'heading'       => __('Show Max Items (Desktop)',SLUPY_TRANSLATE),
          'param_name'    => 'show_max_desktop',
          'group'         => __( 'Layout Config', SLUPY_TRANSLATE ),
          'value'         => '3',
          'class'         => ''
        ),
        array(
          'type'          => 'textfield',
          'heading'       => __('Show Max Items (Tablet)',SLUPY_TRANSLATE),
          'param_name'    => 'show_max_tablet',
          'group'         => __( 'Layout Config', SLUPY_TRANSLATE ),
          'value'         => '2',
          'class'         => ''
        ),
        array(
          'type'          => 'textfield',
          'heading'       => __('Show Max Items (Mobile)',SLUPY_TRANSLATE),
          'param_name'    => 'show_max_mobile',
          'group'         => __( 'Layout Config', SLUPY_TRANSLATE ),
          'value'         => '1',
          'class'         => ''
        )
      )
    ),
    array(
      'name'              => __('Blog',SLUPY_TRANSLATE),
      'base'              => 'slupy_blog',
      'description'       => __('Add a Slupy style blog',SLUPY_TRANSLATE),
      'category'          => __('Content',SLUPY_TRANSLATE),
      'icon'              => 'dashicons-wordpress-alt',
      'class'             => '',
      'params'            => array(
        array(
          'type'          => 'switch_slupy',
          'heading'       => __('Masonry Style',SLUPY_TRANSLATE),
          'param_name'    => 'masonry',
          'value'         => 'on',
          'admin_label'   => true,
          'description'   => '',
          'class'         => ''
        ),
        array(
          'type'          => 'dropdown',
          'heading'       => __('Masonry Max Columns',SLUPY_TRANSLATE),
          'param_name'    => 'masonry_columns',
          'value'         => array('2' => '2', '3' => '3', '4' => '4'),
          'class'         => '',
          'dependency'    => array( 'element' => 'masonry', 'value' => array( 'on' ) )
        ),
        array(
          'type'          => 'dropdown',
          'heading'       => __('Masonry Effect',SLUPY_TRANSLATE),
          'param_name'    => 'effect',
          'value'         => array(
            __('fade', SLUPY_TRANSLATE)        => 'fadeIn',
            __('fadeInDown', SLUPY_TRANSLATE)  => 'fadeInDown',
            __('fadeInUp', SLUPY_TRANSLATE)    => 'fadeInUp',
            __('bounceIn', SLUPY_TRANSLATE)    => 'bounceIn',
            __('flipInX', SLUPY_TRANSLATE)     => 'flipInX',
            __('flipInY', SLUPY_TRANSLATE)     => 'flipInY'
          ),
          'class'         => '',
          'dependency'    => array( 'element' => 'masonry', 'value' => array( 'on' ) )
        ),
        array(
          'type'          => 'textfield',
          'heading'       => __('Posts Per Page',SLUPY_TRANSLATE),
          'param_name'    => 'posts_per_page',
          'value'         => '10',
          'class'         => ''
        ),
        array(
          'type'          => 'dropdown',
          'heading'       => __('Pagination Style',SLUPY_TRANSLATE),
          'param_name'    => 'pagination',
          'admin_label'   => true,
          'value'         => array(
            __('Load More', SLUPY_TRANSLATE)             => 'loadmore',
            __('Older & Newer Button', SLUPY_TRANSLATE)  => 'oldernewer',
            __('Page Numbers', SLUPY_TRANSLATE)          => 'pagenumbers',
            __('None', SLUPY_TRANSLATE)                  => 'none'
          ),
          'class'         => ''
        ),
        array(
          'type'          => 'dropdown',
          'heading'       => __('Meta Position',SLUPY_TRANSLATE),
          'param_name'    => 'meta_position',
          'value'         => array(
            __('Content After', SLUPY_TRANSLATE) => 'content-after',
            __('Media After', SLUPY_TRANSLATE)  => 'media-after',
            __('Heading After', SLUPY_TRANSLATE) => 'heading-after',
            __('Together with Read More Button', SLUPY_TRANSLATE) => 'read-more'
          ),
          'class'         => ''
        ),
        array(
          'type'          => 'textfield',
          'heading'       => __('Exclude Category / Categories', SLUPY_TRANSLATE),
          'param_name'    => 'exclude',
          'value'         => '',
          'class'         => '',
          'description'   => __('Write a category id or ids. Separate by comma.', SLUPY_TRANSLATE)
        )
      )
    )
  ));

  return $options;

}

/*---------------------------------------------
    Switch Option Type
---------------------------------------------*/
if ( !function_exists( 'switch_vc_for_slupy' ) ) {
  function switch_vc_for_slupy( $settings, $value ) {
    $dependency = vc_generate_dependencies_attributes( $settings );

    //get themesama framework switch
    $new_field = new TS_FRAMEWORK_CHECKBOX_FIELD;
    $args = array(
      'field_name'    => $settings['param_name'].'_ex',
      'field_value'   => ( empty( $value ) && isset( $settings['value'] ) ) || $value == 'on' ? 'on' : '',
      'mode'          => 'switch',
      'title_switch'  => ( isset( $settings['title_switch'] ) ) ? $settings['title_switch'] : '',
      'title'         => '',
      'desc'          => '',
      'type'          => '',
      'depends'       => '',
      'class'         => 'slupy_switch_for_vc'
    );
    $field_output = $new_field->output( $args );

    return '<div class="slupy_switch">'
      .'<input name="'.esc_attr( $settings['param_name'] )
      .'" class="wpb_vc_param_value wpb-checkboxes '
      .esc_attr( $settings['param_name'] ).' '.esc_attr( $settings['type'] ).'_field" type="hidden" value="'
      .esc_attr( $value ).'" ' . $dependency . '/>'
      .$field_output.'</div>';
  }
}

/*---------------------------------------------
    Upload Option Type
---------------------------------------------*/
if ( !function_exists( 'upload_vc_for_slupy' ) ) {
  function upload_vc_for_slupy( $settings, $value ) {
    //$dependency = vc_generate_dependencies_attributes( $settings );

    //get themesama framework upload
    $new_field = new TS_FRAMEWORK_UPLOAD_FIELD;
    $args = array(
      'field_name'    => $settings['param_name'],
      'field_value'   => $value,
      'filetype'      => isset( $settings['file_type'] ) ? $settings['file_type'] : 'image',
      'title'         => '',
      'desc'          => '',
      'type'          => '',
      'depends'       => '',
      'class'         => 'wpb_vc_param_value wpb-text '.$settings['param_name'].' '.$settings['type'].'_field slupy_upload_for_vc'
    );
    $field_output = $new_field->output( $args );

    return '<div class="slupy_upload">'.$field_output.'</div>';
  }
}

/*---------------------------------------------
    Icon Option Type
---------------------------------------------*/
if ( !function_exists( 'icon_vc_for_slupy' ) ) {
  function icon_vc_for_slupy( $settings, $value ) {
    //$dependency = vc_generate_dependencies_attributes( $settings );

    //get themesama framework icon
    $new_field = new TS_FRAMEWORK_ICON_FIELD;
    $args = array(
      'field_name'    => $settings['param_name'],
      'field_value'   => $value,
      'title'         => '',
      'desc'          => '',
      'type'          => '',
      'depends'       => '',
      'class'         => 'wpb_vc_param_value wpb-text '.$settings['param_name'].' '.$settings['type'].'_field slupy_upload_for_vc'
    );
    $field_output = $new_field->output( $args );

    return '<div class="slupy_icon ts_content_icon">'.$field_output.'</div>';
  }
}

/*---------------------------------------------
    Remove Shortcodes
---------------------------------------------*/
if ( !function_exists( 'vc_remove_elements' ) ) {
  function vc_remove_elements( $e = array() ) {
    if ( !empty( $e ) ) {
      foreach ( $e as $key => $r_this ) {
        vc_remove_element( 'vc_'.$r_this );
      }
    }
  }

  $s_elemets = array( 'tabs', 'tab', 'accordion', 'accordion_tab', 'widget_sidebar', 'toggle', 'images_carousel', 'carousel', 'tour', 'gallery', 'posts_slider', 'posts_grid', 'teaser_grid', 'separator', 'text_separator', 'message', 'facebook', 'tweetmeme', 'googleplus', 'pinterest', 'single_image', 'button', 'button2', 'cta_button', 'cta_button2', 'video', 'gmaps', 'flickr', 'progress_bar', 'raw_html', 'raw_js', 'pie', 'wp_search', 'wp_meta', 'wp_recentcomments', 'wp_calendar', 'wp_pages', 'wp_tagcloud', 'wp_custommenu', 'wp_text', 'wp_posts', 'wp_links', 'wp_categories', 'wp_archives', 'wp_rss' );
  //vc_remove_elements( $s_elemets );
}

/*---------------------------------------------
    Remove VC Teaser Metabox
---------------------------------------------*/
if ( !function_exists('remove_vc_plugin_metaboxes') ) {

function remove_vc_plugin_metaboxes(){
  remove_meta_box( 'vc_teaser', 'page', 'side' );
  remove_meta_box( 'vc_teaser', 'post', 'side' );
}

}

/*---------------------------------------------
    Disable Frontend
---------------------------------------------*/
vc_disable_frontend();

/*---------------------------------------------
  Disable Notifier
---------------------------------------------*/
vc_set_as_theme(true);

/*---------------------------------------------
  Create VC Maps
---------------------------------------------*/
if( !function_exists('vc_maps_for_slupy_theme') ){

function vc_maps_for_slupy_theme(){

  $vc_maps_for_slupy = apply_filters( 'vc_maps_for_slupy', array() );

  if( !empty($vc_maps_for_slupy) ){
    foreach ($vc_maps_for_slupy as $key => $all_maps) {
      foreach ($all_maps as $key2 => $a_map) {
        vc_map($a_map);
      }
    }
  }

}

}

/*---------------------------------------------
  Add Option Types for Visual Composer

  Next Update - Add this here / js_composer/include/params/params.php

  function add_param_slupy_shortcode( $name, $form_field_callback, $script_url = null ) {
    return WpbakeryShortcodeParams::addField( $name, $form_field_callback, $script_url );
  }
---------------------------------------------*/
add_param_slupy_shortcode( 'switch_slupy', 'switch_vc_for_slupy' );
add_param_slupy_shortcode( 'upload_slupy', 'upload_vc_for_slupy' );
add_param_slupy_shortcode( 'icon_slupy', 'icon_vc_for_slupy' );

/*---------------------------------------------
    Filters & Actions
---------------------------------------------*/
add_filter( 'vc_maps_for_slupy', 'slupy_shortcodes_for_vc', 12);

add_action( 'do_meta_boxes', 'remove_vc_plugin_metaboxes' );
add_action( 'admin_init', 'vc_maps_for_slupy_theme');