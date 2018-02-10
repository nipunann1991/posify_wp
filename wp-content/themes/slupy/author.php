<?php
/**
 * The template for displaying Author archive pages
 *
 * @since Slupy 1.0
 */

get_header(); ?>

<div id="page-header" class="<?php echo ts_get_option('ph_align') ? ' center-items' : ''; ?>">
  <div class="container<?php echo ts_get_option('ph_padding') ? ' '.esc_attr( ts_get_option('ph_padding') ) : ''; ?>">
    <div class="row">
      <div class="col-sm-12<?php echo get_slupy_page_cover(); ?>">
        <h1 class="page-header-title"><?php printf( __( 'All posts by %s', SLUPY_TRANSLATE ), get_the_author() ); ?></h1>
        
        <?php 
          if ( get_the_author_meta( 'description' ) ) {
            echo '<div class="author-description author-bio page-header-desc"><a href="#" class="author-avatar">'.get_avatar( get_the_author_meta('ID'), 120 ).'</a>'.get_the_author_meta( 'description' ).'</div>';
            get_slupy_author_social_links( get_the_author_meta('ID') );
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