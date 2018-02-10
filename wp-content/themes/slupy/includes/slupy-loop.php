<div id="site-content">
  <div class="container">
    <div class="row">

      <?php
        /*---------------------------------------------
          Masonry Control
        ---------------------------------------------*/
        $ts_extra_class = '';
        if( ts_get_option('blog_masonry') ){
          $ts_extra_class .= ' masonry-active';
          $ts_extra_class .= ' col-masonry-'.ts_get_option('blog_masonry_max_columns');
        }

      ?>

      <div class="<?php echo slupy_container_class( ts_get_option('blog_sidebar') ); ?>">

      <?php
        if ( have_posts() ) {

          ?>

          <div class="slupy-articles<?php echo esc_attr( $ts_extra_class ); ?>"<?php echo ' data-blogeffect="'.esc_attr( ts_get_option('blog_effect') ).'"'; ?>>

          <?php
            // Start the Loop.
            while ( have_posts() ) {

              the_post();
              get_template_part( 'post-formats/content', get_post_format() );
              
            }
          ?>

          </div>
          
          <?php
          //Post pagination.
          slupy_paging_nav();

        }else{
          // If no content, include the "No posts found" template.
          get_template_part( 'post-formats/content', 'none' );
        }
      ?>

      </div>

      <?php
        if( ts_get_option('blog_sidebar') == 'left' || ts_get_option('blog_sidebar') == 'right' ) {
          get_sidebar();
        }
      ?>

    </div>
  </div>
</div>