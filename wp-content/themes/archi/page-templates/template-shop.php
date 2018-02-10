<?php
/**
 * Template Name: Template Shop
 */
get_header(); ?>

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
            <div class="col-md-9">                   
                <?php while (have_posts()) : the_post()?>                                                                
                    <?php the_content(); ?>
                <?php endwhile; ?>                
            </div>
            <div class="col-md-3">
                <?php get_sidebar('shop');?>
            </div>                        
        </div>
    </div>
</div>

<?php get_footer(); ?>