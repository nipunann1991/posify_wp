<?php
/**
 * Single Product Image
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.14
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $post, $woocommerce, $product;
?>

<div class="images <?php echo get_option( 'woocommerce_enable_lightbox' ) == 'yes' ? ' mcf-gallery' : ''; ?>">

	<div class="product-slider" data-navigation="on" data-autoplay="off" data-touch="on">

	<?php
		if ( has_post_thumbnail() ) {

			$image_title = esc_attr( get_the_title( get_post_thumbnail_id() ) );
			$image_link  = wp_get_attachment_url( get_post_thumbnail_id() );
			$image       = get_the_post_thumbnail( $post->ID, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ), array(
				'title' => $image_title
				) );

			echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<a href="%s" itemprop="image" class="woocommerce-main-image single-product-image" title="%s">%s</a>', esc_url( $image_link ), esc_attr( $image_title ), $image ), $post->ID );

		} else {

			echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<img src="%s" alt="Placeholder" />', esc_url( wc_placeholder_img_src() ) ), $post->ID );

		}
		
		$attachment_ids = $product->get_gallery_attachment_ids();
		if ( $attachment_ids ) {
			foreach ( $attachment_ids as $attachment_id ) {
				
				$classes = array('single-product-image');

				$image_link = wp_get_attachment_url( $attachment_id );

				if ( ! $image_link )
					continue;

				$image       = wp_get_attachment_image( $attachment_id, apply_filters( 'single_product_thumbnails_size', 'shop_single' ) );
				$image_class = esc_attr( implode( ' ', $classes ) );
				$image_title = esc_attr( get_the_title( $attachment_id ) );

				echo apply_filters( 'woocommerce_single_product_images_html', sprintf( '<a href="%s" class="%s" title="%s">%s</a>', esc_url( $image_link ), esc_attr( $image_class ), esc_attr( $image_title ), $image ), $attachment_id, $post->ID, $image_class );
			}
		}
	?>

	</div>

	<?php do_action( 'woocommerce_product_thumbnails' ); ?>

</div>
