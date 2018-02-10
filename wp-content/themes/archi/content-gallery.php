<li class= "wow fadeInUp">
    <div class="post-content">
        <div class="post-image">
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
        </div>
        <div class="date-box">
            <div class="day"><?php the_time('d'); ?></div>
            <div class="month"><?php the_time('M'); ?></div>
        </div>
        <div class="post-text">
            <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
            <p><?php echo archi_excerpt(); ?></p>
        </div>
        <a href="<?php the_permalink(); ?>" class="btn-more"><?php _e('Read More', 'archi'); ?></a>
    </div>
</li>
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