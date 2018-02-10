<?php
/**
 * My Addresses
 *
 * @author    WooThemes
 * @package   WooCommerce/Templates
 * @version     2.2.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$customer_id = get_current_user_id();

if ( ! wc_ship_to_billing_address_only() && get_option( 'woocommerce_calc_shipping' ) !== 'no' ) {
  $page_title = apply_filters( 'woocommerce_my_account_my_address_title', __( 'My Addresses', 'woocommerce' ) );
  $get_addresses    = apply_filters( 'woocommerce_my_account_get_addresses', array(
    'billing' => __( 'Billing Address', 'woocommerce' ),
    'shipping' => __( 'Shipping Address', 'woocommerce' )
  ), $customer_id );
} else {
  $page_title = apply_filters( 'woocommerce_my_account_my_address_title', __( 'My Address', 'woocommerce' ) );
  $get_addresses    = apply_filters( 'woocommerce_my_account_get_addresses', array(
    'billing' =>  __( 'Billing Address', 'woocommerce' )
  ), $customer_id );
}

$col = 1;
?>

<h2><?php echo esc_html( $page_title ); ?></h2>

<p class="myaccount_address">
  <?php echo apply_filters( 'woocommerce_my_account_my_address_description', __( 'The following addresses will be used on the checkout page by default.', 'woocommerce' ) ); ?>
</p>

<?php if ( ! wc_ship_to_billing_address_only() && get_option( 'woocommerce_calc_shipping' ) !== 'no' ) echo '<div class="">'; ?>

<div class="row">

<?php foreach ( $get_addresses as $name => $title ) : ?>

  <div class="col-sm-6 col-lg-6 address">
    <header class="title">
      <h3><?php echo esc_html( $title ); ?></h3>
      <a href="<?php echo wc_get_endpoint_url( 'edit-address', $name ); ?>" class="edit"><?php _e( 'Edit', 'woocommerce' ); ?></a>
    </header>
    <address>
      <?php
        $address = apply_filters( 'woocommerce_my_account_my_address_formatted_address', array(
          'first_name'  => get_user_meta( $customer_id, $name . '_first_name', true ),
          'last_name'   => get_user_meta( $customer_id, $name . '_last_name', true ),
          'company'     => get_user_meta( $customer_id, $name . '_company', true ),
          'address_1'   => get_user_meta( $customer_id, $name . '_address_1', true ),
          'address_2'   => get_user_meta( $customer_id, $name . '_address_2', true ),
          'city'        => get_user_meta( $customer_id, $name . '_city', true ),
          'state'       => get_user_meta( $customer_id, $name . '_state', true ),
          'postcode'    => get_user_meta( $customer_id, $name . '_postcode', true ),
          'country'     => get_user_meta( $customer_id, $name . '_country', true )
        ), $customer_id, $name );

        echo ( !WC()->countries->get_formatted_address( $address ) ) ? __( 'You have not set up this type of address yet.', 'woocommerce' ) : WC()->countries->get_formatted_address( $address );

      ?>
    </address>
  </div>

<?php endforeach; ?>

</div>

<?php if ( ! wc_ship_to_billing_address_only() && get_option( 'woocommerce_calc_shipping' ) !== 'no' ) echo '</div>'; ?>