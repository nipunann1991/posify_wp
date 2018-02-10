<?php
/**
 * The template for displaying Category pages
 *
 * @since Slupy 1.0
 */

get_header(); ?>

<div id="page-header" class="<?php echo ts_get_option('ph_align') ? ' center-items' : ''; ?>">
  <div class="container<?php echo ts_get_option('ph_padding') ? ' '.esc_attr( ts_get_option('ph_padding') ) : ''; ?>">
    <div class="row">
      <div class="col-sm-12<?php echo get_slupy_page_cover(); ?>">
        <h1 class="page-header-title"><?php printf( __( 'Category Archives: %s', SLUPY_TRANSLATE ), single_cat_title( '', false ) ); ?></h1>
        
        <?php
          // Show an optional term description.
          $term_description = term_description();
          if ( ! empty( $term_description ) ){
            printf( '<div class="taxonomy-description page-header-desc">%s</div>', $term_description );
          }
        ?>

      </div>
      <?php echo get_slupy_page_cover(true); ?>
    </div>
  </div>
</div><!-- #page-header -->

<?php
get_template_part( 'includes/slupy', 'loop' );
get_footer();