<?php
/**
 * The template for displaying product category thumbnails within loops.
 *
 * Override this template by copying it to yourtheme/woocommerce/content-product_cat.php
 *
 * @author    WooThemes
 * @package   WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce_loop;

wp_enqueue_script( 'isotope' );
wp_enqueue_script( 'isotope-horizontal' );
wp_enqueue_script( 'imagesLoaded' );

// Store loop count we're currently on
if ( empty( $woocommerce_loop['loop'] ) )
  $woocommerce_loop['loop'] = 0;

// Store column count for displaying the grid
if ( empty( $woocommerce_loop['columns'] ) )
  $woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 4 );

// Extra post classes
switch ($woocommerce_loop['columns']) {
  case 2:
    $product_column = 'col-sm-6 col-lg-6';
  break;
  case 4:
    $product_column = 'col-sm-6 col-md-4 col-lg-3';
  break;
  default:
    $product_column = 'col-sm-6 col-md-4 col-lg-4';
  break;
}

// Increase loop count
$woocommerce_loop['loop']++;
?>
<li class="product-category product<?php
    if ( ( $woocommerce_loop['loop'] - 1 ) % $woocommerce_loop['columns'] == 0 || $woocommerce_loop['columns'] == 1 )
        echo ' first';
  if ( $woocommerce_loop['loop'] % $woocommerce_loop['columns'] == 0 )
    echo ' last';
  ?> <?php echo esc_attr($product_column); ?> ">

  <?php do_action( 'woocommerce_before_subcategory', $category ); ?>

  <a href="<?php echo esc_url( get_term_link( $category->slug, 'product_cat' ) ); ?>">

    <?php
      /**
       * woocommerce_before_subcategory_title hook
       *
       * @hooked woocommerce_subcategory_thumbnail - 10
       */
      do_action( 'woocommerce_before_subcategory_title', $category );
    ?>


    <?php
      /**
       * woocommerce_after_subcategory_title hook
       */
      do_action( 'woocommerce_after_subcategory_title', $category );
    ?>

  </a>
  <h3>
    <?php
      echo esc_html( $category->name );

      if ( $category->count > 0 )
        echo apply_filters( 'woocommerce_subcategory_count_html', ' <mark class="count">(' . $category->count . ')</mark>', $category );
    ?>
  </h3>

  <?php do_action( 'woocommerce_after_subcategory', $category ); ?>

</li>