<?php $link_audio = get_post_meta(get_the_ID(),'_cmb_link_audio', true); ?>	
	
<li class= "wow fadeInUp">
    <div class="post-content">
        <div class="post-image">
            <iframe style="width:100%" src="<?php echo esc_url( $link_audio ); ?>"></iframe>
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