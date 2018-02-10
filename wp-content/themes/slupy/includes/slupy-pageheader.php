<?php

//check woocommerce shop
if ( is_woocommerce_activated() && ( is_shop() || is_product_category() || is_product_tag() ) ) {
  $ts_page_id = wc_get_page_id('shop');
  ob_start();
  woocommerce_page_title();
  $ts_page_title = ob_get_contents();
  ob_end_clean();
}

if( empty($ts_page_title) ){
  $ts_page_id = get_the_ID();
  $ts_page_title = get_the_title();
}

$ts_post_meta = get_post_meta( $ts_page_id, '_ts_slupy_meta', true );

if ( empty( $ts_post_meta['ph_disable'] ) ) {

  $ts_ph_content = !empty( $ts_post_meta['ph_content'] ) ? $ts_post_meta['ph_content'] : '';
  $ts_breadcrumb = empty( $ts_post_meta['ph_nav'] ) ? true : false;

  $ts_container_class = !empty( $ts_post_meta['ph_disable_container'] ) ? 'container-fluid ' : 'container ';
  $ts_container_class .= !empty( $ts_post_meta['ph_padding'] ) ? $ts_post_meta['ph_padding'] : ts_get_option('ph_padding');
  $ts_container_class .= !empty( $ts_post_meta['ph_align'] ) ? ' center-items' : '';

  //Custom Style
  $ts_custom_style = '';
  $ts_custom_style.= !empty( $ts_post_meta['ph_text_color'] ) ? '#page-header{color: '.$ts_post_meta['ph_text_color'].';}' : '';
  $ts_custom_style.= !empty( $ts_post_meta['ph_text_color'] ) ? '#page-header .page-header-title{color: '.$ts_post_meta['ph_text_color'].';}' : '';
  $ts_custom_style.= !empty( $ts_post_meta['ph_link_color'] ) ? '#page-header a{color: '.$ts_post_meta['ph_link_color'].';}' : '';
  $ts_custom_style.= !empty( $ts_post_meta['ph_link_color_hover'] ) ? '#page-header a:hover{color: '.$ts_post_meta['ph_link_color_hover'].';}' : '';

  //image background
  if( empty( $ts_post_meta['ph_bgtype'] ) && ( !empty( $ts_post_meta['ph_bg']['image'] ) || !empty( $ts_post_meta['ph_bg']['color'] ) ) ){
    $ts_custom_style.= '#page-header{';
    $ts_custom_style.= !empty( $ts_post_meta['ph_bg']['image'] ) ? 'background-image: url("'.esc_url( $ts_post_meta['ph_bg']['image'] ).'");' : '';
    $ts_custom_style.= !empty( $ts_post_meta['ph_bg']['image'] ) && !empty( $ts_post_meta['ph_bg']['repeat'] ) ? 'background-repeat: '.$ts_post_meta['ph_bg']['repeat'].';' : '';
    $ts_custom_style.= !empty( $ts_post_meta['ph_bg']['image'] ) && !empty( $ts_post_meta['ph_bg']['attachment'] ) ? 'background-attachment: '.$ts_post_meta['ph_bg']['attachment'].';' : '';
    $ts_custom_style.= !empty( $ts_post_meta['ph_bg']['image'] ) && !empty( $ts_post_meta['ph_bg']['position'] ) ? 'background-position: '.$ts_post_meta['ph_bg']['position'].';' : '';
    $ts_custom_style.= !empty( $ts_post_meta['ph_bg']['color'] ) ? 'background-color: '.$ts_post_meta['ph_bg']['color'].';' : '';
    $ts_custom_style.= '}';

    //parallax
    if ( !empty( $ts_post_meta['ph_parallax'] ) ) {
      $ts_parallax_attr = ' data-parallax="background"';
      $ts_parallax_attr .= ' data-speed="'.( !empty( $ts_post_meta['ph_parallax_speed'] ) ? esc_attr( $ts_post_meta['ph_parallax_speed'] ) : '0.2').'"';
      $ts_parallax_attr .= !empty( $ts_post_meta['ph_parallax_offset'] ) ? ' data-offset="'.esc_attr( $ts_post_meta['ph_parallax_offset'] ).'"' : '';
    }

  }else if( !empty( $ts_post_meta['ph_bgtype'] ) ){
    //video background
    $ts_video_output = '';
    $ts_video_output .= !empty( $ts_post_meta['ph_video_mp4'] ) && strpos( $ts_post_meta['ph_video_mp4'], '.mp4' ) ? '<source type="video/mp4" src="'.esc_url( $ts_post_meta['ph_video_mp4'] ).'" />' : '';
    $ts_video_output .= !empty( $ts_post_meta['ph_video_ogv'] ) && strpos( $ts_post_meta['ph_video_ogv'], '.ogv' ) ? '<source type="video/ogg" src="'.esc_url( $ts_post_meta['ph_video_ogv'] ).'" />' : '';
    $ts_video_output .= !empty( $ts_post_meta['ph_video_webm'] ) && strpos( $ts_post_meta['ph_video_webm'], '.webm' ) ? '<source type="video/webm" src="'.esc_url( $ts_post_meta['ph_video_webm'] ).'" />' : '';

    if ( $ts_video_output ) {
      wp_enqueue_style( 'mediaelement' );
      wp_enqueue_script( 'mediaelement' );

      //video attributes
      $ts_video_attrs = '';
      $ts_video_attrs .= 'width="320" ';
      $ts_video_attrs .= 'height="240" ';
      $ts_video_attrs .= 'autoplay="autoplay" ';
      $ts_video_attrs .= 'class="" ';
      $ts_video_attrs .= !empty( $ts_post_meta['ph_video_poster'] ) ? 'poster="'.esc_url( $ts_post_meta['ph_video_poster'] ).'" ' : '';
      $ts_video_attrs .= empty( $ts_post_meta['ph_video_sound'] ) ? 'muted="muted" ' : '';
      $ts_video_attrs .= !empty( $ts_post_meta['ph_video_loop'] ) ? 'loop="loop" ' : '';

      $ts_video_cover  = '<div class="section-bgvideo">';
      $ts_video_cover .= '<div class="bg-video"><video '.$ts_video_attrs.'>';
      $ts_video_cover .= $ts_video_output;
      $ts_video_cover .= '</video></div>';
      $ts_video_cover .= '</div>';
    }
  }

  //cover
  $ts_ph_cover = false;
  if( !empty( $ts_post_meta['ph_cover_color'] ) && !empty( $ts_post_meta['ph_cover_alpha'] ) && ( !empty( $ts_video_cover ) || !empty( $ts_post_meta['ph_bg']['image'] ) ) ){
    $ts_ph_cover = true;
    $ts_cover_style = 'background-color: '.$ts_post_meta['ph_cover_color'].';';
    $ts_cover_style.= 'opacity: '.$ts_post_meta['ph_cover_alpha'].';';
  }

  $ts_ph_media = $ts_ph_cover || !empty( $ts_video_cover ) ? true : false;

  //title class names
  $ts_title_class = !empty( $ts_post_meta['ph_align'] ) || !$ts_breadcrumb ? 'col-lg-12' : 'col-xs-12 col-sm-6 col-md-7 col-lg-7';
  $ts_title_class.= is_slupy_rtl() && $ts_title_class != 'col-lg-12' ? ' col-sm-push-6 col-md-push-5 col-lg-push-5' : '';
  $ts_title_class.= $ts_ph_media ? ' is-media-container' : '';

  //breadcrumb class names
  $ts_breadcrumb_class = !empty( $ts_post_meta['ph_align'] ) ? 'col-lg-12' : 'col-xs-12 col-sm-6 col-md-5 col-lg-5';
  $ts_breadcrumb_class.= is_slupy_rtl() && $ts_breadcrumb_class != 'col-lg-12' ? ' col-sm-pull-6 col-md-pull-7 col-lg=pull-7' : '';
  $ts_breadcrumb_class.= $ts_ph_media ? ' is-media-container' : '';
  $ts_breadcrumb_class.= !empty( $ts_post_meta['ph_desc'] ) ? ' with-desc' : '';

?>

<div id="page-header" <?php echo !empty( $ts_parallax_attr) ? $ts_parallax_attr : ''; ?>>
  <?php echo !empty( $ts_custom_style ) ? '<style type="text/css" scoped>'.$ts_custom_style.'</style>' : ''; ?>
  <div class="<?php echo esc_attr( $ts_container_class ); ?>">
    <div class="row">
    <?php
      if( $ts_ph_content ) {
        echo '<div class="col-lg-12'.($ts_ph_media ? ' is-media-container' : '').'">'.do_shortcode( $ts_ph_content ).'</div>';
      }else {
    ?>

      <div class="<?php echo esc_attr( $ts_title_class ); ?>">
        <h1 class="page-header-title"><?php echo !empty( $ts_post_meta['ph_title'] ) ? $ts_post_meta['ph_title'] : $ts_page_title; ?></h1>
        <?php echo !empty( $ts_post_meta['ph_desc'] ) ? '<div class="page-header-desc">'.$ts_post_meta['ph_desc'].'</div>' : ''; ?>
      </div>

      <?php if( $ts_breadcrumb ) { ?>
      <div class="<?php echo esc_attr( $ts_breadcrumb_class ); ?>">
        <?php
          if( is_woocommerce_activated() && is_woocommerce() ){
            woocommerce_breadcrumb();
          }else if( function_exists('yoast_breadcrumb') ){
            yoast_breadcrumb('<div class="breadcrumbs">','</div>');
          }else if( function_exists('breadcrumb_trail') ){
            $breadcrumb_trail_args = array(
              'separator'   => '<span class="fa fa-angle-right"></span>',
              'labels'      => array(
                'browse'    => esc_html__( 'You are here:', SLUPY_TRANSLATE ),
                'home'      => esc_html__( 'Home', SLUPY_TRANSLATE )
              )
            );
            breadcrumb_trail( $breadcrumb_trail_args );
          }
        ?>
      </div>
      <?php } } ?>
    </div>
  </div>
  <?php echo !empty( $ts_ph_cover ) ? '<div class="section-cover" style="'.esc_attr( $ts_cover_style ).'"'.'></div>' : ''; ?>
  <?php echo !empty( $ts_video_cover ) ? $ts_video_cover : ''; ?>
</div><!-- #page-header -->

<?php
}