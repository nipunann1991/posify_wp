<?php
/*
 * Template Name: Blank Page
 * Description: A Blank Page Template.
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
      global $slupy_page_type_full_width;
      $slupy_page_type_full_width = true;
    ?>
  </head>
  
  <body <?php body_class(); ?>>

    <div id="main">

    <div id="site-content" class="page-type-full-width blank-page-wrap">

      <div class="blank-page-container">
    
      <?php
        while ( have_posts() ){
          the_post();
          the_content();
        }

      ?>

      </div>

    </div><!-- #site-content -->

  </div><!-- #main -->

  <?php wp_footer(); ?>
  </body>
</html>