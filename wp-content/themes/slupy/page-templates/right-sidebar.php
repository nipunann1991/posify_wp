<?php

/*
 * Template Name: Right Sidebar
 * Description: A Page Template with a sidebar design.
*/

	get_header();
	get_template_part( 'includes/slupy', 'pageheader' );
?>

<div id="site-content" class="page-type-right-sidebar">
  <div class="container">
    <div class="row">

      <div class="<?php slupy_container_class('right'); ?>">

      <?php
        while ( have_posts() ) {
          the_post();
          the_content();
        }
      ?>

      </div>

      <?php get_sidebar(); ?>

    </div>
  </div>
</div><!-- #site-content -->

<?php
get_footer();