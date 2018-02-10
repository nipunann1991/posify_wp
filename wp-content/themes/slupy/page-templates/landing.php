<?php
/*
 * Template Name: Landing - Single Page
 * Description: A Single Page Template.
*/
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>

  <head>
    <!-- meta -->
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
      
    <!-- css + javascript -->
    <?php
      get_slupy_favicons();
      wp_head();
      wp_enqueue_script( 'jquery-effects-core' );
      wp_enqueue_script( 'one-page-nav' );
      global $slupy_page_type_full_width;
      $slupy_page_type_full_width = true;
    ?>
  </head>
  
  <body <?php body_class('sticky-menu-active sticky-landing'); ?>>

    <div id="main">

    <?php
      //custom header for slider etc
      $ts_custom_page_header = get_post_meta( get_the_ID(), '_ts_slupy_meta', true );

      if( !empty($ts_custom_page_header['ph_content']) && $ts_custom_page_header['ph_content'] ){
        echo '<div class="landing-slider">'.do_shortcode( $ts_custom_page_header['ph_content'] ).'</div>';
      }
    ?>

    <header id="header">
      <div class="container">
        <div class="row">
          <div class="col-xs-12">
            <div class="header-type header-<?php echo esc_attr( ts_get_option('slupy_header') ); ?> landing-menu">

              <?php
                $ts_landing_menu_name = 'landing';
                echo get_slupy_header( $ts_landing_menu_name );
              ?>

            </div>
          </div>
        </div>
      </div>
    </header><!-- #header -->

    <div id="site-content" class="page-type-full-width slupy-landing-page">
    
      <?php
        while ( have_posts() ){
          the_post();
          the_content();
        }
  
        if ( ( $locations = get_nav_menu_locations() ) && isset( $locations[ $ts_landing_menu_name ] ) ) {
          $menu = wp_get_nav_menu_object( $locations[ $ts_landing_menu_name ] );

          $menu_items = wp_get_nav_menu_items($menu->term_id);

          foreach ( (array) $menu_items as $key => $menu_item ) {

            $p_type = $menu_item->object;
            $section_id = sanitize_title($menu_item->title);
            if( $p_type == 'page' ){
              $the_query = new WP_Query( 'page_id='.intval( $menu_item->object_id ) );
              if ( $the_query->have_posts() ) {
                while ( $the_query->have_posts() ) {
                  $the_query->the_post();
                  echo '<div data-section-menu-id="'.esc_attr( $menu_item->post_name ).'" id="'.esc_attr( $section_id ).'" class="landing-section">';
                    the_content();
                  echo '</div>';
                }
              }
            }
          }
        }

      ?>

    </div><!-- #site-content -->

  </div><!-- #main -->

  <?php
    //Mobile Menu
    echo get_slupy_mobile_nav( $ts_landing_menu_name, false );

    //Back top button
    if ( ts_get_option('slupy_backtopbutton') ) {
      echo '<a href="#" class="back-site-top"></a>';
    }
    
    wp_footer();
  ?>
  </body>
</html>