<?php
/**
 * The template for displaying 404 pages (Not Found)
 *
 * @since Slupy 1.0
 */

get_header(); ?>

<div id="site-content">

  <div class="container">
    <div class="row">
      <div class="col-sm-12">
          <h5>W-P-L-O-C-K-E-R-.-C-O-M -<?php _e('It looks like nothing was found at this location. Maybe try a search?', SLUPY_TRANSLATE); ?></h5>
          <div class="widget_search page-404">
          <?php get_search_form(); ?>
          </div>
          <div class="page404"><?php _e( '404', SLUPY_TRANSLATE); ?></div>
      </div>
    </div>
  </div>

</div><!-- #site-content -->

<?php
get_footer();