<?php
/**
 * The template for displaying posts in the Link post format
 *
 * @since Slupy 1.0
 */

global $slupy_blog_meta_position;

do_action( 'slupy_post' ); ?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

  <header class="entry-header">

    <h2 class="entry-title">

      <?php echo get_slupy_post_format_icon( get_post_format() ); ?>
      <a href="<?php echo esc_url( get_slupy_link_url() ); ?>" rel="bookmark"><?php the_title(); ?></a>

    </h2><!-- .entry-title -->
    
    <?php if( $slupy_blog_meta_position === 'heading-after' || $slupy_blog_meta_position === 'media-after' ){ get_slupy_entry_meta(); } ?>

  </header><!-- .entry-header -->

  <div class="entry-content"><?php 
    if( !is_single() && ( ts_get_option( 'blog_auto_excerpt' ) || has_excerpt() ) ) {
      the_excerpt();
    } else {
      the_content( __( 'Read More', SLUPY_TRANSLATE ) );
    }

      wp_link_pages(array(
        'before'      => '<div class="page-links-wrap"><span class="page-links-title">' . __( 'Pages:', SLUPY_TRANSLATE ) . '</span><span class="page-links">',
        'after'       => '</span></div>',
        'link_before' => '<span>',
        'link_after'  => '</span>',
      ));
    ?></div><!-- .entry-content -->

  <footer class="entry-footer">

    <?php do_action( 'slupy_post_footer' ); ?>
    
  </footer><!-- .entry-footer -->

  <?php do_action( 'slupy_post_footer_after' ); ?>

</article><!-- #post-<?php the_ID(); ?> -->