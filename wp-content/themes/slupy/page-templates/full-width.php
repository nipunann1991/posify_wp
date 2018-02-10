<?php

/*
 * Template Name: Full Width - Parallax Mode
 * Description: A Page Template with a fluid design.
*/

get_header();
get_template_part( 'includes/slupy', 'pageheader' );

global $slupy_page_type_full_width;
$slupy_page_type_full_width = true;
?>

<div id="site-content" class="page-type-full-width">

<?php
  while ( have_posts() ) {
    the_post();
    the_content();
  }
?>

</div><!-- #site-content -->

<?php
get_footer();