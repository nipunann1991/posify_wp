<li class= "wow fadeInUp">
    <div class="post-content">
        
        <div class="post-image">
            <?php if(get_the_post_thumbnail()){ ?>              
                <img src="<?php echo wp_get_attachment_url(get_post_thumbnail_id()); ?>" alt="">
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