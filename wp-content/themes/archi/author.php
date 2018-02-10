<?php get_header(); ?>

<!-- subheader begin -->
<section id="subheader" data-speed="8" data-type="background" class="padding-top-bottom">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>
                  <?php printf( __( 'All posts by: %s', 'archi' ), get_the_author() ); ?>
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
            <div class="col-md-8">
                <ul class="blog-list">
                    <?php 
                      while (have_posts()) : the_post();
                      get_template_part( 'content', get_post_format() ) ;   // End the loop.
                      endwhile;
                    ?>

                </ul>

                <div class="text-center">
                    <ul class="pagination">
                        <?php echo archi_pagination(); ?>
                    </ul>
                </div>
            </div>
            <div id="sidebar" class="col-md-4">
                <?php get_sidebar();?>
            </div>
            
        </div>
    </div>
</div>
<!-- content close -->
<?php get_footer(); ?>
