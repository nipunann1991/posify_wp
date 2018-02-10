<?php
/**
 * The template for displaying search results
 *
 * @since Slupy 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

  <header class="entry-header">

    <h2 class="entry-title">

      <?php

        $custom_icon = '';
        if (get_post_type($post) == 'page'){
          $custom_icon = 'file-o';
        }
        echo get_slupy_post_format_icon(get_post_format(), $custom_icon);

      ?>

      <a href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark"><?php the_title(); ?></a>
    </h2><!-- .entry-title -->

  </header><!-- .entry-header -->

  <div class="entry-content">

    <?php the_excerpt(); ?>
    
  </div><!-- .entry-content -->

  <footer class="entry-footer">
    <div class="entry-meta">

      <?php
        //Date
        printf('<span class="entry-date"><a href="%3$s"><time datetime="%2$s">%1$s</time></a></span>',
          esc_html( get_the_date() ),
          esc_attr( get_the_date( 'c' ) ),
          esc_url( get_permalink() )
        );
      ?>
    
    </div>    
  </footer><!-- .entry-footer -->

</article><!-- #post-<?php the_ID(); ?> -->