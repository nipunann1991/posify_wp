<?php

if( !function_exists('slupy_head') ) {

function slupy_head() {

  /*---------------------------------------------
    Styles
  ---------------------------------------------*/

  //main style
  //wp_enqueue_style( 'columns-layout', SLUPY_CSS . '/columns-layout.css', array(), SLUPY_VERSION, 'all' );
  wp_enqueue_style( 'main', get_stylesheet_uri(), array(), SLUPY_VERSION );
  wp_enqueue_style( 'font-awasome', SLUPY_CSS . '/font-awesome.min.css', array(), '4.2.0' );
  wp_enqueue_style( 'animate', SLUPY_CSS . '/animate.css', array(), '1.0.0', 'all' );

  //google font settings
  $all_fonts = array(
    ts_get_option('headings_font'),
    ts_get_option('mainmenu_font'),
    ts_get_option('submenu_font')
  );

  $all_font_family = '';
  foreach ($all_fonts as $font_key => $a_font) {
    $all_font_family .= $a_font['font-family'].':'.$a_font['variants'].'|';
  }

  $body_font = ts_get_option('body_font');
  if( is_array($body_font) ){
    $all_font_family .= $body_font['font-family'].':'.$body_font['all-variants'];
  }

  $all_font_family .= ts_get_option('google_subsets') ? '&subset='.ts_get_option('google_subsets') : '';
  wp_enqueue_style( 'google-font', (is_ssl() ? 'https://' : 'http://').'fonts.googleapis.com/css?family='.$all_font_family );

  //register media element player style
  if( ts_get_option( 'slupy_playerskin' ) ) {
    wp_deregister_style( 'mediaelement' );
    wp_register_style( 'mediaelement', SLUPY_CSS . '/mediaelement.css', array(), SLUPY_VERSION );
  }

  //register OwlCarousel style
  wp_register_style( 'OwlCarousel', SLUPY_CSS . '/owl.carousel.css', array(), '2.0.0' );
  wp_enqueue_style( 'OwlCarousel' );

  //register magnific popup style
  wp_register_style( 'magnific-popup', SLUPY_CSS . '/magnific.css', array(), '0.9.9' );

  //Responsive
  if ( ts_get_option( 'slupy_responsive' ) ) {
    wp_enqueue_style( 'responsive', SLUPY_CSS . '/responsive.css', array(), SLUPY_VERSION, 'all' );
  }

  //RTL active
  if ( is_slupy_rtl() ) {
    wp_enqueue_style( 'rtl', SLUPY_CSS . '/rtl.css', array(), SLUPY_VERSION, 'all' );
  }

  //Dequeue some styles
  wp_dequeue_style( 'contact-form-7' );

  /*---------------------------------------------
    Scripts
  ---------------------------------------------*/
  if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
    wp_enqueue_script( 'comment-reply' );
  }

  //fitvids
  wp_register_script( 'fitvids', SLUPY_JS . '/jquery.fitvids.js', array( 'jquery' ), '1.0.3', true );

  //landing-page
  wp_register_script( 'one-page-nav', SLUPY_JS . '/jquery.nav.js', array( 'jquery' ), '3.0.0', true );
  
  //register magnific popup script
  wp_register_script( 'magnific-popup', SLUPY_JS .'/jquery.magnific-popup.min.js', array( 'jquery' ), '0.9.9' );

  //register OwlCarousel script
  wp_register_script( 'OwlCarousel', SLUPY_JS .'/owl.carousel.min.js', array( 'jquery' ), '2.0.0' );
  
  wp_deregister_script( 'isotope' );
  wp_register_script( 'isotope', SLUPY_JS.'/isotope.min.js', array(), '2.0.1', true );
  wp_register_script( 'isotope-horizontal', SLUPY_JS.'/masonry-horizontal.js', array(), '2.0.1', true );
  wp_register_script( 'imagesLoaded', SLUPY_JS.'/imagesloaded.min.js', array(), '3.1.8', true );

  wp_localize_script( 'jquery', 'slupyAjax', array( 'ajaxurl' => urlencode( admin_url( 'admin-ajax.php' ) ), 'nonce' => wp_create_nonce( 'slupy_nonce' ) ) );

  //masonry style blog
  wp_enqueue_script( 'isotope' );
  wp_enqueue_script( 'imagesLoaded' );

  wp_enqueue_style( 'magnific-popup' );
  wp_enqueue_script( 'magnific-popup' );

  //prettyPhoto disable for woocommerce
  if( is_woocommerce_activated() && is_product() ) {
    wp_dequeue_script( 'prettyPhoto' );
    wp_dequeue_script( 'prettyPhoto-init' );
    wp_dequeue_style( 'woocommerce_prettyPhoto_css' );

    wp_enqueue_style( 'OwlCarousel' );
    wp_enqueue_script( 'OwlCarousel' );
  }
  
  //modernizr
  wp_enqueue_script( 'modernizr', SLUPY_JS.'/modernizr.min.js', array(), '2.8.3', true );
  
  wp_enqueue_script( 'jquery-slupy', SLUPY_JS.'/scripts.js', array( 'jquery' ), SLUPY_VERSION, true );
}

}

/*---------------------------------------------
  Body Classes
---------------------------------------------*/
if( !function_exists('slupy_bodyclass') ) {

function slupy_bodyclass( $classes ) {

  //get page id and options
  if ( is_woocommerce_activated() && ( is_shop() || is_product_category() || is_product_tag() ) ) {
    $ts_page_id = wc_get_page_id('shop');
  }else {
    $ts_page_id = get_the_ID();
  }

  $ts_post_meta = get_post_meta( $ts_page_id, '_ts_slupy_meta', true );

  //enable boxed layout
  if ( ts_get_option( 'slupy_boxed' ) ) {
    $classes[] = 'container-boxed';
    $classes[] = 'ts-white-bg';
  }

  if( !ts_get_option( 'slupy_responsive' ) ) {
    $classes[] = 'disable-responsive';
  }

  if ( ts_get_option( 'slupy_stickymenu' ) ) {
    $classes[] = 'sticky-menu-active';
  }

  if( is_slupy_rtl() ) {
   $classes[] = 'direction-rtl';
  }

  if ( empty( $ts_post_meta['ph_disable'] ) && !empty( $ts_post_meta['ph_transparent_header'] ) ) {
    $classes[] = 'slupy-transparent-header';
  }

  // return the $classes array
  return $classes;
}

}

/*---------------------------------------------
  Custom Styles
---------------------------------------------*/
if( !function_exists('slupy_inline_styles') ) {

function slupy_inline_styles() {

  //theme styles
  $default_color = ( ts_get_option( 'slupy_skins' ) === 'custom' ) ? ts_get_option( 'slupy_accentcolor' ) : ts_get_option( 'slupy_skins' );
  $second_color = colourBrightness($default_color, -0.85);
  $heading_size = ts_get_option('heading_size');
  $headings_font = ts_get_option('headings_font');
  $mainmenu_font = ts_get_option('mainmenu_font');
  $submenu_font = ts_get_option('submenu_font');
  $body_font = ts_get_option('body_font');
  $retina_logo = ts_get_option( 'slupy_logotype' ) ? ts_get_option( 'slupy_retinalogo' ) : '';
  $custom_slupy_css = '
button,
a.button,
html input[type="button"],
input[type="reset"],
input[type="submit"],
.highlight-text,
ul.products li.product a.added_to_cart,
.attachment .attachment-image .navigation a:hover span,
.owl-theme .owl-controls .owl-nav div:hover,
.slupy-readmore,
.readmore-type-button .more-link,
.entry-header .entry-icon,
#header nav ul.menu > li.active-menu-item > a,
#header nav ul.menu > li:hover > a,
.slupy-transparent-header #header.sticky-header ul.menu > li:hover > a,
.slupy-transparent-header #header.sticky-header .menu-additional-btn.active-menu-content > a,
.slupy-transparent-header #header.sticky-header .menu-additional-btn:hover > a,
#mobile-menu-button:hover,
.back-site-content,
.back-site-top:hover,
.navigation.loadmore .slupy-loadmore-link:hover,
.widget_shopping_cart_content span.quantity span.total-item,
.widget_shopping_cart_content span.quantity span.amount,
.menu-additional-btn:hover > a,
.menu-additional-btn.active-menu-content > a,
.top-bar-menu ul.menu > li > ul li a:hover,
.search-results > ul > li:hover > a,
.lang-content > ul > li:hover > a,
.format-image-media:after,
.portfolio-filter-menu a:hover,
.portfolio-filter-menu a.activated-filter,
.navigation.pagenumbers .page-numbers.current,
.navigation.pagenumbers a.page-numbers:hover,
.navigation.oldernewer a:hover,
#edd_download_pagination a:hover,
#edd_download_pagination span.current,
.edd_checkout a,
.posts-links:hover .current-page,
.widget_price_filter .ui-slider .ui-slider-range,
.widget_layered_nav_filters ul li a,
.widget_layered_nav ul li.chosen a,
.woocommerce-pagination span.current,
.woocommerce-pagination a:hover,
.woocommerce-tabs ul.tabs li.active,
.woocommerce-tabs ul.tabs li:hover,
.default-bg-color,
.added_to_cart.wc-forward,
.portfolio-model-3 .portfolio-url,
.page-links > span,
.page-links > a:hover,
#today{
    background-color: '.$default_color.';
}

button:hover,
a.button:hover,
html input[type="button"]:hover,
input[type="reset"]:hover,
input[type="submit"]:hover,
.edd_checkout a:hover,
ul.products li.product a.added_to_cart:hover,
.readmore-type-button .more-link:hover{
  background-color: '.$second_color.';
}

.ts-white-bg .navigation.loadmore .slupy-loadmore-link:hover,
.top-bar-menu ul.menu > li > ul li a:hover,
.search-results > ul > li:hover > a,
.navigation.pagenumbers a.page-numbers:hover,
.navigation.pagenumbers .page-numbers.current,
#edd_download_pagination a:hover,
#edd_download_pagination span.current,
.menu-additional-btn:hover > a,
.menu-additional-btn.active-menu-content > a,
.menu-additional-btn .menu-content,
#mobile-menu-button:hover,
.top-bar-menu ul.menu > li > ul,
.slupy_shop_cart.menu-content,
.portfolio-filter-menu a:hover,
.portfolio-filter-menu a.activated-filter,
#header nav ul.menu ul.sub-menu,
.default-border-color,
.woocommerce-tabs ul.tabs li.active,
.woocommerce-tabs ul.tabs li:hover,
.page-links > span,
#edd_checkout_cart,
.page-links > a:hover,
#top-bar{
  border-color: '.$default_color.';
}

.widget_shopping_cart_content > ul li .quantity .amount:before{
  border-left-color: '.$default_color.';
}

table.cart,
.active-thumbnail img,
.thumbnails a:hover img,
.my_account_orders,
.woocommerce-pagination span.current,
.woocommerce-pagination a:hover{
  border-color: '.$default_color.' !important;
}

.default-color,
.ts-cart-tooltip-right:before,
.ts-cart-tooltip-bottom-right:before,
a:hover,
.single-product p.price,
.edd-single-price,
.woocommerce-tabs ul.tabs li.active:before,
.wp-playlist-caption:hover,
.entry-header .entry-icon .fa-caret-right,
nav ul.menu > li.current-menu-item > a,
nav ul.menu > li.current-menu-ancestor > a,
#header ul.menu li.menu-item.current-menu-item > a,
#header ul.menu li.menu-item.current-menu-parent > a,
#header ul.menu li.menu-item.current-menu-ancestor > a,
#header nav ul.menu ul.sub-menu > li.menu-item > a:hover,
.slupy-transparent-header #header.sticky-header ul.menu li.menu-item.current-menu-parent > a,
.slupy-transparent-header #header.sticky-header ul.menu li.menu-item.current-menu-ancestor > a,
.widget_shopping_cart_content span.quantity:after{
    color: '.$default_color.';
}

body{
  font-family: "'.$body_font['font-family'].'" , sans-serif;
  '.( !empty($body_font['font-size']) ? 'font-size: '.$body_font['font-size'].';' : '' ).'
  '.( strpos($body_font['variants'], 'italic') === false ? '' : 'font-style: italic;' ).'
  font-weight: '.( intval($body_font['variants']) == 0 ? '400' : intval($body_font['variants']) ).';
  '.( !empty($body_font['color']) ? 'color: '.$body_font['color'].';' : '' ).'
}

h1,
h2,
h3,
h4,
h5,
h6{
  font-family: "'.$headings_font['font-family'].'" , sans-serif;
  '.( strpos($headings_font['variants'], 'italic') === false ? '' : 'font-style: italic;' ).'
  font-weight: '.( intval($headings_font['variants']) == 0 ? '400' : intval($headings_font['variants']) ).';
  '.( !empty($headings_font['color']) ? 'color: '.$headings_font['color'].';' : '' ).'
}

'.( !empty($heading_size['h1']) ? 'h1{font-size: '.$heading_size['h1'].';}' : '' ).'
'.( !empty($heading_size['h2']) ? 'h2{font-size: '.$heading_size['h2'].';}' : '' ).'
'.( !empty($heading_size['h3']) ? 'h3{font-size: '.$heading_size['h3'].';}' : '' ).'
'.( !empty($heading_size['h4']) ? 'h4{font-size: '.$heading_size['h4'].';}' : '' ).'
'.( !empty($heading_size['h5']) ? 'h5{font-size: '.$heading_size['h5'].';}' : '' ).'
'.( !empty($heading_size['h6']) ? 'h6{font-size: '.$heading_size['h6'].';}' : '' ).'

#header ul.menu > li.menu-item > a,
.mobile-menu-content ul.menu > li.menu-item > a{
  font-family: "'.$mainmenu_font['font-family'].'" , sans-serif;
  '.( !empty($mainmenu_font['font-size']) ? 'font-size: '.$mainmenu_font['font-size'].';' : '' ).'
  '.( strpos($mainmenu_font['variants'], 'italic') === false ? '' : 'font-style: italic;' ).'
  font-weight: '.( intval($mainmenu_font['variants']) == 0 ? '400' : intval($mainmenu_font['variants']) ).';
  '.( !empty($mainmenu_font['color']) ? 'color: '.$mainmenu_font['color'].';' : '' ).'
}

'.( ts_get_option('mainmenu_color') ? '
nav ul.menu > li.current-menu-item > a,
nav ul.menu > li.current-menu-ancestor > a,
#header ul.menu li.menu-item.current-menu-item > a,
#header ul.menu li.menu-item.current-menu-parent > a,
#header ul.menu li.menu-item.current-menu-ancestor > a,
#header nav ul.menu ul.sub-menu > li.menu-item > a:hover,
#header nav ul.menu > li.current-menu-item > a,
.slupy-transparent-header #header.sticky-header ul.menu li.menu-item.current-menu-parent > a,
.slupy-transparent-header #header.sticky-header ul.menu li.menu-item.current-menu-ancestor > a,
#header nav ul.menu > li.current-menu-ancestor > a{
  color: '.ts_get_option('mainmenu_color').';
}
.menu-additional-btn:hover > a,
.menu-additional-btn.active-menu-content > a,
.menu-additional-btn .menu-content,
#header nav ul.menu ul.sub-menu{
  border-color: '.ts_get_option('mainmenu_color').';
}
.menu-additional-btn:hover > a,
.menu-additional-btn.active-menu-content > a,
.slupy-transparent-header #header.sticky-header .menu-additional-btn.active-menu-content > a,
.slupy-transparent-header #header.sticky-header ul.menu > li:hover > a,
#header.sticky-header .menu-additional-btn > a:hover,
#header nav ul.menu > li:hover > a{
  background-color: '.ts_get_option('mainmenu_color').';
}' : '' ).'

.mobile-menu-content ul.menu ul.sub-menu > li.menu-item > a,
#header ul.menu ul.sub-menu > li.menu-item > a{
  font-family: "'.$submenu_font['font-family'].'" , sans-serif;
  '.( !empty($submenu_font['font-size']) ? 'font-size: '.$submenu_font['font-size'].';' : '' ).'
  '.( strpos($submenu_font['variants'], 'italic') === false ? '' : 'font-style: italic;' ).'
  font-weight: '.( intval($submenu_font['variants']) == 0 ? '400' : intval($submenu_font['variants']) ).';
  '.( !empty($submenu_font['color']) ? 'color: '.$submenu_font['color'].';' : '' ).'
}

'.( ts_get_option('submenu_color') ? '
#header nav ul.menu ul.sub-menu > li.current-menu-item > a,
#header nav ul.menu ul.sub-menu > li.menu-item > a:hover{
  color: '.ts_get_option('submenu_color').';
}' : '' ).'

'.(ts_get_option('link_color') ? '
  a{
    color: '.ts_get_option('link_color').';
  }
' : '').'

'.(ts_get_option('link_color_hover') ? '
  a:hover{
    color: '.ts_get_option('link_color_hover').';
  }
' : '').'

button,
.edd-single-price,
html input[type="button"],
input[type="reset"],
input[type="submit"],
.woocommerce .button,
.woocommerce-page .button,
.cart-empty,
#respond .form-submit,
table.cart th,
.single_add_to_cart_button,
ul.products li.product a.added_to_cart,
ul.products li.product a.add_to_cart_button,
.woocommerce-tabs ul.tabs a,
.single-product .price,
.portfolio-filter-menu a,
#submit-slupy,
.older-posts,.newer-posts,
.slupy-loadmore-link,
.comment-navigation,
.nav-prev-next a,
.slupy-more-button,
.portfolio-prev-next a,
.back-site-content,
.my_account_orders th,
.out-of-stock,
.shop_table thead th,
p.product.woocommerce .amount,
.readmore-type-button .more-link,
.widget_shopping_cart_content p.total{
    font-family: "'.$headings_font['font-family'].'" , sans-serif;
}
'.( ts_get_option('slupy_logomaxwidth') ? '#logo .site-logo img{max-width:100%; height:auto;} #logo .site-logo{max-width: '.ts_get_option('slupy_logomaxwidth').';}' : '' ).'
'.( $retina_logo ? '
@media all and (-webkit-min-device-pixel-ratio: 1.5) {
#logo .site-logo{
    background: url("'.esc_url( $retina_logo ).'") no-repeat;
    background-size: 100%;
}
#logo .site-logo img{opacity:0;}}' : '' ).'';
  

  //page header
  $c_bg = ts_get_option('ph_bg');

  $custom_slupy_css .= '#page-header{';
  $custom_slupy_css .= ts_get_option('ph_text_color') ? 'color:'.ts_get_option('ph_text_color').';' : '';
  $custom_slupy_css .= !empty($c_bg['image']) ? 'background-image:url("'.esc_url( $c_bg['image'] ).'");' : '';
  $custom_slupy_css .= !empty($c_bg['image']) && !empty($c_bg['repeat']) ? 'background-repeat:'.$c_bg['repeat'].';' : '';
  $custom_slupy_css .= !empty($c_bg['image']) && !empty($c_bg['attachment']) ? 'background-attachment:'.$c_bg['attachment'].';' : '';
  $custom_slupy_css .= !empty($c_bg['image']) && !empty($c_bg['position']) ? 'background-position:'.$c_bg['position'].';' : '';
  $custom_slupy_css .= !empty($c_bg['color']) ? 'background-color:'.$c_bg['color'].';' : '';
  $custom_slupy_css .= '}';

  $custom_slupy_css .= ts_get_option('ph_link_color') ? '#page-header a{color:'.ts_get_option('ph_link_color').';}' : '';
  $custom_slupy_css .= ts_get_option('ph_link_color_hover') ? '#page-header a:hover{color:'.ts_get_option('ph_link_color_hover').';}' : '';
  $custom_slupy_css .= ts_get_option('ph_text_color') ? '#page-header .page-header-title{color:'.ts_get_option('ph_text_color').';}' : '';

  //custom styles
  $custom_slupy_css.= ts_get_option( 'slupy_customcss' );
  $custom_slupy_css = str_replace( "\n", "", $custom_slupy_css );
  wp_add_inline_style( 'main', $custom_slupy_css );
}

}


/*---------------------------------------------
    Footer Scripts
---------------------------------------------*/
if( !function_exists('slupy_footer') ) {

function slupy_footer() {
  $custom_js = ts_get_option('slupy_customjs');
  if( $custom_js ){
    echo '<script type="text/javascript">/* <![CDATA[ */'.$custom_js.'/* ]]> */</script>';
  }
}

}