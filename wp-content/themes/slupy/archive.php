<?php
/**
 * The template for displaying Archive pages
 *
 * @since Slupy 1.0
 */

get_header();

if ( is_day() ) {
  $ts_page_header_title = __( 'Daily Archives:', SLUPY_TRANSLATE ).' '.get_the_date();
}else if ( is_month() ) {
  $ts_page_header_title = __( 'Monthly Archives:', SLUPY_TRANSLATE ).' '.get_the_time( 'F, Y' );
}else if ( is_year() ) {
  $ts_page_header_title = __( 'Yearly Archives:', SLUPY_TRANSLATE ).' '.get_the_time( 'Y' );
}else if( is_tax( 'portfolio_cat' ) ) {
  $queried_object = get_queried_object();
  $term_id = $queried_object->term_id;
  $term_name = $queried_object->name;
  $ts_page_header_title = __('Portfolio', SLUPY_TRANSLATE ).': '.$term_name;
}else if( is_tax( 'download_category' ) ) {
  $queried_object = get_queried_object();
  $term_id = $queried_object->term_id;
  $term_name = $queried_object->name;
  $ts_page_header_title = __('Downloads', SLUPY_TRANSLATE ).': '.$term_name;
}else{
  $ts_page_header_title = get_the_title();
}
?>

<div id="page-header" class="<?php echo ts_get_option('ph_align') ? ' center-items' : ''; ?>">
  <div class="container<?php echo ts_get_option('ph_padding') ? ' '.esc_attr( ts_get_option('ph_padding') ) : ''; ?>">
    <div class="row">
      <div class="col-sm-12<?php echo get_slupy_page_cover(); ?>">
        <h1 class="page-header-title"><?php echo esc_html( $ts_page_header_title ); ?></h1>
      </div>
      <?php echo get_slupy_page_cover(true); ?>
    </div>
  </div>
</div><!-- #page-header -->

<?php if( is_tax( 'portfolio_cat' ) ) { ?>

<div id="site-content">
<div class="container">
  <div class="row">
    <div class="col-sm-12">
      <?php
        $portfolio_config = array(
          'posts_per_page'  => -1,
          'filterable'      => 'off',
          'pagination'      => 'none',
          'ids'             => $term_id
        );

        echo get_slupy_portfolio_output($portfolio_config);
      ?>
    </div>
  </div>
</div>
</div><!-- #site-content -->

<?php }else if( is_tax( 'download_category' ) ) { ?>

<div id="site-content">
<div class="container">
  <div class="row">
    <div class="col-sm-12">
      <?php
        if( function_exists('edd_downloads_query') ) {
          $slupy_edd_archive_config = array(
            'category' => $term_id,
            'excerpt'  => 'no',
            'price'    => 'yes'
          );
          echo edd_downloads_query($slupy_edd_archive_config);
        }
      ?>
    </div>
  </div>
</div>
</div><!-- #site-content -->

<?php
}else {
  get_template_part( 'includes/slupy', 'loop' );
}
get_footer();