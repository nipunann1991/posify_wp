<?php
/**
 * Template Name: Blog Left Sidebar
 */
get_header(); ?>

<!-- subheader begin -->
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
<!-- subheader close -->

<!-- content begin -->

<div id="content">

    <div class="container">

        <div class="row">

            <div class="col-md-4">

                <?php get_sidebar();?>

            </div>

            <div class="col-md-8">

                <ul class="blog-list">

                 <?php if(have_posts()) : ?>  

                    <?php 

                    $args = array(    

                      'paged' => $paged,

                      'post_type' => 'post',

                      );

                    $wp_query = new WP_Query($args);

                    while ($wp_query -> have_posts()): $wp_query -> the_post();                         

                        get_template_part( 'content', get_post_format() ) ; ?> 

                    <?php endwhile;?> 

                

                    <?php else: ?>

                    <h1><?php _e('Nothing Found Here!', 'archi'); ?></h1>

                    <?php endif; ?>        

                </ul>



                <div class="pagination text-center ">

                    <ul class="pagination">

                        <?php echo archi_pagination(); ?>

                    </ul>

                </div>

            </div>            

        </div>

    </div>

</div>

<!-- content close -->

<?php get_footer(); ?>