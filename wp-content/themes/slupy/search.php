<?php
/**
 * The template for displaying Search Results pages
 *
 * @since Slupy 1.0
 */

get_header();

$ts_sidebar_position = ts_get_option('blog_sidebar');
?>

<div id="page-header" class="<?php echo ts_get_option('ph_align') ? ' center-items' : ''; ?>">
  <div class="container<?php echo ts_get_option('ph_padding') ? ' '.esc_attr( ts_get_option('ph_padding') ) : ''; ?>">
    <div class="row">
      <div class="col-sm-12<?php echo get_slupy_page_cover(); ?>">
        <h1 class="page-header-title"><?php printf( __( 'Search Results for: %s', SLUPY_TRANSLATE ), get_search_query() ); ?></h1>
      </div>
      <?php echo get_slupy_page_cover(true); ?>
    </div>
  </div>
</div><!-- #page-header -->

<div id="site-content" class="page-search-results">
  <div class="container">
    <div class="row">
      <div class="<?php slupy_container_class( $ts_sidebar_position ); ?>">

      <?php

        if ( have_posts() ) {
          // Start the Loop.
          while ( have_posts() ) {

            the_post();
            get_template_part( 'post-formats/content', 'search' );
            
          }

          //Post pagination.
          slupy_paging_nav( 1, 'pagenumbers' );

        }else{
          // If no content, include the "No posts found" template.
          get_template_part( 'post-formats/content', 'none' );
        }

      ?>

      </div>

      <?php
        if( $ts_sidebar_position === 'left' || $ts_sidebar_position === 'right' ){
          get_sidebar();
        }
      ?>

    </div>
  </div>
</div><!-- #site-content -->

<?php
get_footer();