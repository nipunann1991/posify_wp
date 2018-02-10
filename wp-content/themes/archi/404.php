<?php
/**
 * The template for displaying 404 pages (Not Found)
 */
global $archi_option; 
get_header(); ?>

<!-- subheader begin -->
<section id="subheader" data-speed="8" data-type="background" class="padding-top-bottom">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>
                  <?php echo esc_html($archi_option['404_title']); ?>
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
            <div class="col-md-12">
               <h1 class="title_404"><?php echo esc_html($archi_option['404_title']); ?></h1>
				<div class="content_404 center">
				<?php echo esc_html($archi_option['404_content']); ?>
				</div>
				<div class="center"><a class="btn btn-primary" href="<?php echo esc_url(home_url('/')); ?>"><i class="fa fa-arrow-circle-left"></i> <?php echo esc_html( $archi_option['back_404'] ); ?></a></div> 
            </div>           
            
        </div>
    </div>
</div>
<!-- content close -->
<?php get_footer(); ?>