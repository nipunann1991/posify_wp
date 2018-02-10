<?php
/**
 * The template for displaying Portfolio works
 *
 * @since Slupy 1.0
 */

get_header(); ?>

<div id="page-header" class="<?php echo ts_get_option('ph_align') ? ' center-items' : ''; ?>">
  <div class="container<?php echo ts_get_option('ph_padding') ? ' '.esc_attr( ts_get_option('ph_padding') ) : ''; ?>">
    <div class="row">
      <div class="col-sm-12<?php echo get_slupy_page_cover(); ?>">
        <h1 class="page-header-title"><?php _e('Portfolio', SLUPY_TRANSLATE ); ?></h1>
      </div>
      <?php echo get_slupy_page_cover(true); ?>
    </div>
  </div>
</div><!-- #page-header -->

<div id="site-content">
<div class="container">
  <div class="row">
    <div class="col-sm-12">
      <?php echo get_slupy_portfolio_output(); ?>
    </div>
  </div>
</div>
</div><!-- #site-content -->

<?php
get_footer();