<?php
/**
 * The template for displaying Easy Digital Downloads
 *
 * @since Slupy 1.0
 */

get_header(); ?>

<div id="page-header" class="<?php echo ts_get_option('ph_align') ? ' center-items' : ''; ?>">
  <div class="container<?php echo ts_get_option('ph_padding') ? ' '.esc_attr( ts_get_option('ph_padding') ) : ''; ?>">
    <div class="row">
      <div class="col-sm-12<?php echo get_slupy_page_cover(); ?>">
        <h1 class="page-header-title"><?php _e('Downloads', 'edd' ); ?></h1>
      </div>
      <?php echo get_slupy_page_cover(true); ?>
    </div>
  </div>
</div><!-- #page-header -->

<div id="site-content">
<div class="container">
  <div class="row">
    <div class="col-sm-12">
      <?php
        if( function_exists('edd_downloads_query') ) {
          $slupy_edd_archive_config = array(
            'excerpt'     => 'no',
            'price'       => 'yes',
            'thumbnails'  => 'true',
            'columns'     => '3',
            'number'      => '9'
          );
          echo edd_downloads_query($slupy_edd_archive_config);
        }
      ?>
    </div>
  </div>
</div>
</div><!-- #site-content -->

<?php
get_footer();