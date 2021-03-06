<?php
/**
 * Single Product Thumbnails
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.3
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $post, $product, $woocommerce;

$attachment_ids = $product->get_gallery_attachment_ids();

if ( $attachment_ids ) {
	?>
	<div class="thumbnails"><?php

		$columns = apply_filters( 'woocommerce_product_thumbnails_columns', 3 );

		//featured image - product
		echo '<a href="#" class="first-thumbnail-product-image active-thumbnail">'.get_the_post_thumbnail( $product->id, apply_filters( 'single_product_small_thumbnail_size', 'shop_thumbnail' ) ).'</a>';

		foreach ( $attachment_ids as $attachment_id ) {

			$classes = array();

			$image_link = wp_get_attachment_url( $attachment_id );

			if ( ! $image_link )
				continue;

			$image       = wp_get_attachment_image( $attachment_id, apply_filters( 'single_product_small_thumbnail_size', 'shop_thumbnail' ) );
			$image_class = esc_attr( implode( ' ', $classes ) );
			$image_title = esc_attr( get_the_title( $attachment_id ) );

			echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', sprintf( '<a href="%s" class="%s" title="%s">%s</a>', esc_url( $image_link ), esc_attr( $image_class ), esc_attr( $image_title ), $image ), $attachment_id, $post->ID, $image_class );
		}

	?></div>
	<?php
}