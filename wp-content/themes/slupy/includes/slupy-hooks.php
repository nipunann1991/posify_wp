<?php
/**
 * Slupy Template Hooks
 *
 * Action/filter hooks used for Slupy functions
 *
 * @since Slupy 1.0
 */

/*---------------------------------------------
  Actions
---------------------------------------------*/

//Theme Support - Menu, Image Sizes, Header, Background, Post Formats etc.
add_action( 'after_setup_theme', 'slupy_theme_support' );

//register scripts & styles - slupy-style.php
add_action( 'wp_enqueue_scripts', 'slupy_head' );

//custom inline styles - slupy-style.php
add_action( 'wp_enqueue_scripts', 'slupy_inline_styles' );

//custom js lines - slupy-style.php
add_action( 'wp_footer', 'slupy_footer' );

//custom header options
add_action('custom_header_options', 'add_slupy_header_type');

//register sidebars
add_action( 'widgets_init', 'slupy_widgets_init' );

//slupy required plugins
add_action( 'tgmpa_register', 'slupy_theme_register_required_plugins' );

//slupy post
add_action( 'slupy_post', 'get_post_meta_position' );

//slupy post footer
add_action( 'slupy_post_footer', 'get_slupy_post_footer_details' );

//post single details
add_action( 'slupy_post_footer_after', 'get_slupy_single_details' );

// WP Version < 4.0 for title
if( !function_exists('_wp_render_title_tag') ) {
  add_action( 'wp_head', 'get_slupy_wp_title' );
}

// Yoast WordPress SEO for disable meta description
if ( !defined('WPSEO_VERSION') ) {
  add_action( 'wp_head', 'get_slupy_wp_description', 1 );
}


/*---------------------------------------------
  Filters
---------------------------------------------*/

//WP Version < 4.0 for title filter
if( !function_exists('_wp_render_title_tag') ) {
  add_filter( 'wp_title', 'slupy_wp_title', 10, 2 );
}

//excerpt length
add_filter( 'excerpt_length', 'slupy_excerpt_length', 999 );

//gallery shortcode slider output
add_filter( 'post_gallery', 'get_slupy_gallery_slider', 10, 2 );

//organize first shortcode for post formats
add_filter( 'the_content', 'organize_slupy_post_formats' );

//highlight search results
add_filter( 'the_excerpt', 'highlight_slupy_search_results' );

//add new fields for user details
add_filter( 'user_contactmethods', 'add_slupy_user_contacts' );

//add a span container for cat count
add_filter( 'get_archives_link', 'slupy_add_span_cat_count' );
add_filter( 'wp_list_categories', 'slupy_add_span_cat_count' );

//extra body classes
add_filter( 'body_class', 'slupy_bodyclass' );

//extra post classes
add_filter( 'post_class', 'get_slupy_extra_post_classes' );

//support shortcode on widget title
add_filter( 'widget_title', 'do_shortcode' );

//add svg support
add_filter( 'upload_mimes', 'slupy_svg_support' );

//change breadcrumb_trail items
add_filter( 'breadcrumb_trail_items', 'change_breadcrumb_trail_items', 10, 2 );