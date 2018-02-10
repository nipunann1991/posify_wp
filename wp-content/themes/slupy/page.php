<?php
/**
 * The template for displaying all pages by default.
 *
 * @since Slupy 1.0
 */

get_header();
get_template_part( 'includes/slupy', 'pageheader' );
?>

<div id="site-content" class="page-type-standart">
  <div class="container">
    <div class="row">
      <div class="col-sm-12">

      <?php
        while ( have_posts() ) {
          the_post();
          the_content();
        }
      ?>

      </div>
    </div>
  </div>
</div><!-- #site-content -->

<?php
get_footer();