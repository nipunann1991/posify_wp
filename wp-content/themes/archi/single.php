<?php
 global $archi_option;
 $link_audio = get_post_meta(get_the_ID(),'_cmb_link_audio', true);
 $link_video = get_post_meta(get_the_ID(),'_cmb_link_video', true);
get_header(); ?>

<!-- subheader begin -->
<section id="subheader" data-speed="8" data-type="background" class="padding-top-bottom">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>
                  <?php if($archi_option['the_blog_single'] != '') {  echo esc_html( $archi_option['the_blog_single'] ); }else{ the_title(); } ?>
                </h1>
                <?php archi_breadcrumbs(); ?>
            </div>
        </div>
    </div>
</section>
<!-- subheader close -->
<!-- CONTENT BLOG -->
<?php while (have_posts()) : the_post(); ?>
  <div id="content">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <ul class="blog-list">
                <li class="single">                  
                  <div class="post-content">
                      <div class="post-image">
                        <?php $format = get_post_format(); ?>
                        <?php if($format=='audio'){ ?>

                          <iframe style="width:100%" src="<?php echo esc_url( $link_audio ); ?>"></iframe>
            
                          <?php } elseif($format=='video'){ ?>

                            <iframe height="420" src="<?php echo esc_url( $link_video ); ?>"></iframe>
           
                          <?php } elseif($format=='gallery'){ ?>

                            <div id="owl-demo-<?php the_ID(); ?>" class="owl-carousel">
                              <?php if( function_exists( 'rwmb_meta' ) ) { ?>  
                                  <?php $images = rwmb_meta( '_cmb_images', "type=image" ); ?>
                                  <?php if($images){ ?>
                                    
                                      <?php                                                        
                                        foreach ( $images as $image ) {                              
                                      ?>
                                      <?php $img = $image['full_url']; ?>
                                        <div class="item"><img src="<?php echo esc_url($img); ?>" alt=""></div> 
                                      <?php } ?>                   
                                    
                                  <?php } ?>
                                <?php } ?>
                            </div>
                            <script type="text/javascript">
                              (function($){
                                "use strict";                              
                                $(document).ready(function() {
                                    $("#owl-demo-<?php the_ID(); ?>").owlCarousel({
                                      autoPlay: 3000,
                                      items : 1,
                                      singleItem:true,                                    
                                    });
                                  });                              
                              })(this.jQuery);
                            </script>
              
                          <?php } elseif ($format=='image'){ ?>
                          <?php if( function_exists( 'rwmb_meta' ) ) { ?>  
                            <?php $images = rwmb_meta( '_cmb_image', "type=image" ); ?>
                            <?php if($images){ ?>
                            <?php                                                        
                              foreach ( $images as $image ) {                              
                              ?>
                              <?php $img = $image['full_url']; ?>
                              <img src="<?php echo esc_url($img); ?>" alt="">
                              <?php } ?>
                            <?php } ?>
                          <?php } ?>

                          <?php }else{ $format=='stadard' ?>
                              <?php if(get_the_post_thumbnail()){ ?>              
                                  <img src="<?php echo wp_get_attachment_url(get_post_thumbnail_id()); ?>" alt="">
                              <?php } ?>
                          <?php } ?>

                      </div>
                      <div class="date-box">
                          <div class="day"><?php the_time('d'); ?></div>
                          <div class="month"><?php the_time('M'); ?></div>
                      </div>
                      <div class="post-text page-content">
                        <h3 class="single-title"><?php the_title(); ?></h3>
                         <?php the_content(); ?>
                      </div>
                  </div>
                    
                  <div class="post-info">
                    <span>
                      <i class="fa fa-user"></i><?php _e('By : ','archi') ?><?php the_author_posts_link(); ?>
                    </span> 
                    <?php if(has_tag()) { ?>
                    <span>
                      <i class="fa fa-tag"></i><?php the_tags('', ', ' ); ?>
                    </span> 
                    <?php } ?>
                    <?php if ( comments_open()) : ?>
                      <span>
                        <i class="fa fa-comment"></i><span class="comments_number"><?php comments_number( __('0 comment', 'archi'), __('1 comment', 'archi'), __('% comments', 'archi') ); ?></span>
                      </span> 
                    <?php  endif; ?>               
                  </div>
              </li>
              </ul>
              <?php if ( comments_open()) : ?>
                <div class='comments-box'>
                  <h4><?php comments_number( __('0 comment', 'archi'), __('1 comment', 'archi'), __('% comments', 'archi') ); ?><h4>
                </div>
                <?php comments_template(); ?> 
              <?php  endif; ?>
              <?php 
                // Previous/next post navigation.
                the_post_navigation( array(
                  'next_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'Next', 'archi' ) . '</span> ' .
                    '<span class="screen-reader-text">' . __( 'Next post:', 'archi' ) . '</span> ' .
                    '<span class="post-title">%title</span>',
                  'prev_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'Previous', 'archi' ) . '</span> ' .
                    '<span class="screen-reader-text">' . __( 'Previous post:', 'archi' ) . '</span> ' .
                    '<span class="post-title">%title</span>',
                ) ); 
              ?>
            </div>

            <div class="col-md-4">
                <?php get_sidebar();?>
            </div>
        </div>
    </div>
 </div>

<?php endwhile;?>
  <!-- END CONTENT BLOG -->
<?php get_footer(); ?>	





  