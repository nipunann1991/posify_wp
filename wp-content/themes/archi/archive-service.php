<?php get_header(); ?>

<!-- subheader begin -->
<section id="subheader" data-speed="8" data-type="background" class="padding-top-bottom" >
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>
                  <?php _e('SERVICES','archi'); ?>
                </h1>
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
            <?php 
                $paged = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;
                $args = array(
                    'post_type' => 'service',
                    'posts_per_page' => 8,
                    'paged' => $paged,
                );
                $wp_query = new WP_Query($args);
                while($wp_query->have_posts()) : $wp_query->the_post();
            ?>
                <div class="col-md-3">
                    <h3><?php the_title(); ?></h3>
                    <?php the_excerpt(); ?>
                    <div class="spacer-single-10"></div>
                    <?php $image = bfi_thumb( wp_get_attachment_url(get_post_thumbnail_id())); ?>
                    <img src="<?php echo esc_url($image);?>" class="img-responsive" alt="">                
                    <div class="spacer-single"></div>
                    <a href="<?php the_permalink(); ?>" class="btn-line btn-fullwidth"><?php _e('Read More', 'archi') ?></a>
                </div>
            <?php endwhile; ?> 
            <div class="col-md-12">
                <div class="pagination text-center" style="width:100%;padding-top: 40px;">
                    <?php
                        global $wp_query;
                        $big = 999999999;
                        echo paginate_links( array(
                          'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
                          'format' => '?paged=%#%',
                          'current' => max( 1, get_query_var('paged') ),
                          'total' => $wp_query->max_num_pages,                      
                            'prev_text' => '<i class="fa fa-angle-double-left"></i>',
                            'next_text' => '<i class="fa fa-angle-double-right"></i>',       
                            'type'          => 'list',
                            'end_size'      => 3,
                            'mid_size'      => 3
                        ) );
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- content close -->
<?php get_footer(); ?>
