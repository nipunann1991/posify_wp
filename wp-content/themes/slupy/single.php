<?php
/**
 * The Template for displaying all single posts
 *
 * @since Slupy 1.0
 */

get_header();
get_template_part( 'includes/slupy', 'pageheader' );

$ts_single_meta = get_post_meta( get_the_ID(), '_ts_slupy_meta', true );
$ts_sidebar_position = !empty($ts_single_meta['sidebar_position']) ? $ts_single_meta['sidebar_position'] : ts_get_option('single_sidebar');
?>

<div id="site-content">
  <div class="container">
    <div class="row">
      
      <div class="<?php slupy_container_class( $ts_sidebar_position ); ?>">

        <?php

          // Start the Loop.
          while ( have_posts() ) {

            the_post();
            get_template_part( 'post-formats/content', get_post_format() );
            
          }

          //if about the author config enabled on ts framework.
          if( ts_get_option('single_about') ){
            get_slupy_about_author(get_the_author_meta('ID'));
          }
            
          // If comments are open or we have at least one comment, load up the comment template.
          if ( comments_open() || get_comments_number() ) {
            comments_template();
          }

        ?>

      </div>

      <?php
        if( $ts_sidebar_position === 'left' || $ts_sidebar_position === 'right' ) {
          get_sidebar();
        }
      ?>

    </div>
  </div>
</div> <!-- #site-content -->

<?php
get_footer();