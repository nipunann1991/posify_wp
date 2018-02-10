<?php
/**
 * The template for displaying image attachments
 *
 * @since Slupy 1.0
 */

get_header();
get_template_part( 'includes/slupy', 'pageheader' );

//Check container type
$ts_sidebar_position = ts_get_option('single_sidebar');
?>

<div id="site-content">
  <div class="container">
    <div class="row">

      <div class="<?php slupy_container_class( $ts_sidebar_position ); ?>">

      <?php
        
        if ( have_posts() ) {
        // Start the Loop.
        while ( have_posts() ) {
          the_post();

      ?>

      <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <header class="entry-header">
          
          <div class="entry-media">
            <div class="attachment-image">

            <?php echo wp_get_attachment_image( $post->ID, 'full' ); ?>

            <nav id="image-navigation" class="navigation image-navigation">
              <?php 
                previous_image_link( false, '<span class="previous-image fa fa-angle-left"></span>' ); 
                next_image_link( false, '<span class="next-image fa fa-angle-right"></span>' ); 
              ?>
            </nav><!-- #image-navigation -->

            </div>
          </div><!-- .entry-media -->

          <h1 class="entry-title">
            <?php echo ts_get_option( 'single_icons' ) ? get_slupy_post_format_icon( '', 'link' ) : ''; ?>
            <a href="#" rel="bookmark"><?php the_title(); ?></a>
          </h1>
        </header><!-- .entry-header -->

        <?php if ( has_excerpt() ){ ?>

        <div class="entry-content">
          <?php the_excerpt(); ?>
        </div><!-- .entry-content -->

        <?php } ?>

        <footer class="entry-footer">
          <?php get_slupy_entry_meta( 'single' ); ?>
        </footer><!-- .entry-footer -->

      </article>

      <?php
        }
        // If comments are open or we have at least one comment, load up the comment template.
        if ( comments_open() || get_comments_number() ) {
          comments_template();
        }
      ?>
    
      <?php
        } else {
          // If no content, include the "No posts found" template.
          get_template_part( 'post-formats/content', 'none' );
        }
      ?>

      </div>

      <?php
        if( $ts_sidebar_position === 'left' || $ts_sidebar_position === 'right' ) {
          get_sidebar();
        }
      ?>

    </div>
  </div>
</div><!-- #site-content -->

<?php
get_footer();