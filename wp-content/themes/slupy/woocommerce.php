<?php
/**
 * The template for displaying WooCommerce products
 *
 * @since Slupy 1.0
 */

get_header();
get_template_part( 'includes/slupy', 'pageheader' );

//Check container type
$ts_product_meta = is_product() ? get_post_meta( get_the_ID(), '_ts_slupy_meta', true ) : '';
$ts_sidebar_position = is_product() ?  ts_get_option('shop_sidebar_single') : ts_get_option('shop_sidebar');
$ts_sidebar_position = !empty($ts_product_meta['product_template']) ? $ts_product_meta['product_template'] : $ts_sidebar_position;
?>

<div id="site-content">
    <div class="container">
      <div class="row">
        <div class="<?php slupy_container_class( $ts_sidebar_position ); ?>">
          <?php
            woocommerce_content();
          ?>
        </div>
        <?php
          if( $ts_sidebar_position === 'left' || $ts_sidebar_position === 'right' ){
            get_sidebar();
          }
        ?>
      </div>
  </div>
</div><!-- #site-content -->

<?php
get_footer();