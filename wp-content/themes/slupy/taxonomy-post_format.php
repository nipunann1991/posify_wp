<?php
/**
 * The template for displaying Tag pages
 *
 * @since Slupy 1.0
 */
 
get_header(); ?>

<div id="page-header" class="<?php echo ts_get_option('ph_align') ? ' center-items' : ''; ?>">
  <div class="container<?php echo ts_get_option('ph_padding') ? ' '.esc_attr( ts_get_option('ph_padding') ) : ''; ?>">
    <div class="row">
      <div class="col-sm-12<?php echo get_slupy_page_cover(); ?>">
        <h1 class="page-header-title">
          <?php
            if ( is_tax( 'post_format', 'post-format-aside' ) ) {
              _e( 'Asides', SLUPY_TRANSLATE );

            }else if ( is_tax( 'post_format', 'post-format-image' ) ) {
              _e( 'Images', SLUPY_TRANSLATE );

            }else if ( is_tax( 'post_format', 'post-format-video' ) ) {
              _e( 'Videos', SLUPY_TRANSLATE );

            }else if ( is_tax( 'post_format', 'post-format-audio' ) ) {
              _e( 'Audio', SLUPY_TRANSLATE );

            }else if ( is_tax( 'post_format', 'post-format-quote' ) ) {
              _e( 'Quotes', SLUPY_TRANSLATE );

            }else if ( is_tax( 'post_format', 'post-format-link' ) ) {
              _e( 'Links', SLUPY_TRANSLATE );

            }else if ( is_tax( 'post_format', 'post-format-gallery' ) ) {
              _e( 'Galleries', SLUPY_TRANSLATE );

            }else {
              _e( 'Archives', SLUPY_TRANSLATE );

            }
          ?>
        </h1>
      </div>
      <?php echo get_slupy_page_cover(true); ?>
    </div>
  </div>
</div><!-- #page-header -->

<?php
get_template_part( 'includes/slupy', 'loop' );
get_footer();