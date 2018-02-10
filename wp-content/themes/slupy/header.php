<?php
/**
 * The Header for Slupy theme
 *
 * @since Slupy 1.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
  <head>
    <!-- meta -->
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">

    <!-- favicons -->
    <?php get_slupy_favicons(); ?>
      
    <!-- css + javascript -->
    <?php wp_head(); ?>
  </head>

  <body <?php body_class(); ?>>
    <div id="main">

    <?php
      //check top bar
      $ts_menu_additional = ts_get_option('slupy_menuadditional');
      if( $ts_menu_additional === 'left' || $ts_menu_additional === 'right' || has_nav_menu('topbar') || ts_get_option('slupy_topbartext') ){
    ?>

    <div id="top-bar">
      <div class="container">
        <div class="row">
          <div class="col-sm-12">

            <?php

              if( $ts_menu_additional == 'left' || $ts_menu_additional == 'right' ){
                echo get_slupy_menu_additional( 'pull-'.$ts_menu_additional );
              }

              //check top bar menu
              if( has_nav_menu('topbar') ){
                echo '<div class="top-bar-menu pull-left">'.wp_nav_menu( array('theme_location' => 'topbar', 'echo' => false) ).'</div>';
              }

              //check top bar text
              if ( ts_get_option('slupy_topbartext') ) {
                $ts_topbartext = ts_get_option('slupy_topbartext');
                $ts_topbartext_content = '';
                
                //check wpml
                if ( is_array( $ts_topbartext ) && defined( 'ICL_LANGUAGE_CODE' ) && !empty( $ts_topbartext[ICL_LANGUAGE_CODE] ) ) {
                  $ts_topbartext_content = $ts_topbartext[ICL_LANGUAGE_CODE];
                }else if( !is_array( $ts_topbartext ) ) {
                  $ts_topbartext_content = $ts_topbartext;
                }

                echo $ts_topbartext_content ? '<div class="top-bar-text pull-left">'.do_shortcode( $ts_topbartext_content ).'</div>' : '';
              }

            ?>

          </div>
        </div>
      </div>
    </div><!-- #top-bar -->

    <?php } ?>

    <header id="header">
      <div class="container">
        <div class="row">
          <div class="col-xs-12">
            <div class="header-type header-<?php echo esc_attr(ts_get_option('slupy_header')); ?>">
              <?php echo get_slupy_header(); ?>
            </div>
          </div>
        </div>
      </div>
    </header><!-- #header -->