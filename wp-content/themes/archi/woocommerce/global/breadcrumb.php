<?php
/**
 * Shop breadcrumb
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.3.0
 * @see         woocommerce_breadcrumb()
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$wrap_before = '<ul class="crumb">';
$wrap_after = '</ul>';
$delimiter = '<b>/</b>';

if ( $breadcrumb ) {

	echo htmlspecialchars_decode($wrap_before);

	foreach ( $breadcrumb as $key => $crumb ) {

		echo htmlspecialchars_decode($before);

		if ( ! empty( $crumb[1] ) && sizeof( $breadcrumb ) !== $key + 1 ) {
			echo '<li><a href="' . esc_url( $crumb[1] ) . '">' . esc_html( $crumb[0] ) . '</a></li> ';
		} else {
			echo ' <li>'.esc_html( $crumb[0] ).'</li>';
		}

		echo htmlspecialchars_decode($after);

		if ( sizeof( $breadcrumb ) !== $key + 1 ) {
			echo htmlspecialchars_decode($delimiter);
		}

	}
	echo htmlspecialchars_decode($wrap_after);
}