<?php get_header(); ?>



<section id="subheader" data-speed="8" data-type="background" class="padding-top-bottom"
        <?php if( function_exists( 'rwmb_meta' ) ) { ?>       
        <?php $images = rwmb_meta( '_cmb_subheader_image', "type=image" ); ?>
        <?php if($images){ foreach ( $images as $image ) { ?>
        <?php 
        $img =  $image['full_url']; ?>
          style="background-image: url('<?php echo esc_url($img); ?>');"
        <?php } } ?>
    <?php } ?>
>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1><?php the_title(); ?></h1>                
                <?php archi_breadcrumbs(); ?>
            </div>
        </div>
    </div>
</section>
<div id="content" class="sbar">
    <div class="container">
        <div class="row">
        <?php if (have_posts()){ ?>
            
        	<div class="col-md-9">   
                <div id="post-<?php the_ID(); ?>" <?php post_class('page-content'); ?>>
            		<?php while (have_posts()) : the_post()?>
                        
                        <?php the_post_thumbnail() ?>
            			
                        <?php the_content(); ?>
                        <?php

                         if ( comments_open() || get_comments_number() ) :
                          comments_template();
                         endif; 
                        ?>
                        <?php
                            wp_link_pages( array(
                                'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'archi' ) . '</span>',
                                'after'       => '</div>',
                                'link_before' => '<span>',
                                'link_after'  => '</span>',
                                'pagelink'    => '<span class="screen-reader-text">' . __( 'Page', 'archi' ) . ' </span>%',
                                'separator'   => '<span class="screen-reader-text">, </span>',
                            ) );
                        ?>
            		<?php endwhile; ?>
                </div>    
        	</div>

        	<div class="col-md-3">
                <?php get_sidebar();?>
            </div>
            
        	<?php }else {
        		 _e('Page Canvas For Page Builder', 'archi'); 
        }?>
        </div>
    </div>
</div>

<?php get_footer(); ?>