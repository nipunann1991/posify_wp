<?php
/**
 * The template for displaying posts in the Image, Chat, Quote, Status, aSide and Standard post format
 *
 * @since Slupy 1.0
 */

global $slupy_blog_meta_position;

$slupy_post_thumbnail = apply_filters('slupy_post_thumbnail_size', 'slupy-post-thumbnail');

do_action( 'slupy_post' ); ?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

  <header class="entry-header">

    <?php if ( has_post_thumbnail() ) { ?>

    <div class="entry-media">

      <?php
        $ts_attachment_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full');
        $ts_attachment_image_src = is_single() && !empty( $ts_attachment_image[0] ) ? $ts_attachment_image[0] : get_permalink();

        echo '<a href="'.esc_url( $ts_attachment_image_src ).'" class="format-image-media fa">';
          the_post_thumbnail($slupy_post_thumbnail, array('class' => 'aligncenter'));
        echo '</a>';
      ?>
      
    </div><!-- .entry-media -->

    <?php } ?>

    <?php if( $slupy_blog_meta_position === 'media-after' ){ get_slupy_entry_meta(); } ?>

    <?php
      //title wrap
      $slupy_title_before = '<h2 class="entry-title">'.get_slupy_post_format_icon( get_post_format() ).'<a href="'.esc_url( get_permalink() ).'" rel="bookmark">';
      $slupy_title_after = '</a></h2><!-- .entry-title -->';

      the_title( $slupy_title_before, $slupy_title_after );
    ?>
    
    <?php if( $slupy_blog_meta_position === 'heading-after' ){ get_slupy_entry_meta(); } ?>

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