<?php
/**
 * The Template for displaying all single portfolio items
 *
 * @since Slupy 1.0
 */

get_header();
get_template_part( 'includes/slupy', 'pageheader' );

$ts_portfolio_meta = get_post_meta( get_the_ID(), '_ts_slupy_meta', true );
$ts_portfolio_template = !empty($ts_portfolio_meta['portfolio_template']) ? $ts_portfolio_meta['portfolio_template'] : '';
$ts_portfolio_fwa = $ts_portfolio_template === 'fullwidth' ? true : false;
$ts_portfolio_class = '';
if( $ts_portfolio_fwa ) {
  global $slupy_page_type_full_width;
  $slupy_page_type_full_width = true;

  $ts_portfolio_class = ' page-type-full-width portfolio-item-full-width';
}
?>

<div id="site-content" class="<?php echo esc_attr( $ts_portfolio_class ); ?>">

  <?php
    if( have_posts() ) {
      if( !$ts_portfolio_fwa ) {
  ?>

  <div class="portfolio-container ts-white-bg">
    <div class="container">
      <div class="row">
        <div class="<?php slupy_container_class( $ts_portfolio_template ); ?>">

      <?php
        }
        // Start the Loop.
        while ( have_posts() ) {
          the_post();
          the_content();
        }

        if( !$ts_portfolio_fwa ){
      ?>

        <div class="portfolio-prev-next nav-prev-next">
          <div class="row">
            <div class="col-sm-6 col-lg-6 space-bottom-10">
              <?php previous_post_link('%link','<span class="title-link nav-prev-post">%title</span>'); ?>
            </div>
            <div class="col-sm-6 col-lg-6 text-right mobile-text-left">
              <?php next_post_link('%link','<span class="title-link nav-next-post">%title</span>'); ?>
            </div>
          </div>
        </div><!-- .portfolio-prev-next -->

        </div>

        <?php
          if( $ts_portfolio_template === 'left' || $ts_portfolio_template === 'right' ) {
            get_sidebar();
          }
        ?>

      </div>
    </div>
  </div><!-- .portfolio-container -->

  <div class="container">
    <div class="row">
      <div class="col-sm-12">

        <?php

          //check latest works
          if( ts_get_option('portfolio_latest_works') ) {
            echo '<h3 class="portfolio-latest-heading">'.__('Latest Works',SLUPY_TRANSLATE).'</h3>';
            $ts_carousel_portfolio_atts = apply_filters( 'slupy_carousel_portfolio_atts', array() );
            echo get_slupy_cportfolio_output($ts_carousel_portfolio_atts);
          }

          // If comments are open or we have at least one comment, load up the comment template.
          if ( comments_open() || get_comments_number() ) {
            comments_template();
          }

        ?>

      </div>
    </div>
  </div><!-- latest works and comments -->

<?php } } ?>

</div><!-- #site-content -->

<?php
get_footer();