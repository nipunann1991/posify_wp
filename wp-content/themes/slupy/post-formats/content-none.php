<?php
/**
 * The template for displaying a "No posts found" message
 *
 * @since Slupy 1.0
 */
?>

<div class="type-post">

  <header class="entry-header">

    <h2 class="entry-title">
      <?php echo ts_get_option('blog_icons') == 'on' ? get_slupy_post_format_icon('','exclamation') : ''; ?>
      <a href="#" rel="bookmark"><?php _e('Nothing found', SLUPY_TRANSLATE); ?></a>
    </h2>

  </header><!-- .entry-header -->

  <div class="entry-content">
    
    <div class="content-search widget_search">
      <?php get_search_form(); ?>
    </div>
  
  </div><!-- .entry-content -->

</div>