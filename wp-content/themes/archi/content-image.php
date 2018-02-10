<li class= "wow fadeInUp">
    <div class="post-content">
        <div class="post-image">
            <?php if( function_exists( 'rwmb_meta' ) ) { ?>
              <?php $images = rwmb_meta( '_cmb_image', "type=image" ); ?>

              <?php if($images){ ?>              

              <?php  foreach ( $images as $image ) {  ?>

                <?php $img = $image['full_url']; ?>

                <img src="<?php echo esc_url($img); ?>" alt="">

                <?php } ?>                

              <?php } ?>
            <?php } ?>
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