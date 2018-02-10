<?php
/**
 * My Account page
 *
 * @author    WooThemes
 * @package   WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

wp_enqueue_script('wc-single-product');

global $woocommerce;

wc_print_notices();

do_action( 'woocommerce_before_my_account' ); 

?>

<div class="row">

<div class="woocommerce-tabs vertical-tab">

  <div class="col-sm-4 col-md-3 col-lg-3">

  <ul class="tabs">
    <li><a href="#tab-user"><?php _e( 'Account Details', 'woocommerce' ); ?></a></li>
    <?php if ( $downloads = WC()->customer->get_downloadable_products() ) : ?>
    <li><a href="#tab-downloads"><?php _e( 'Available Downloads', 'woocommerce' ); ?></a></li>
    <?php endif; ?>
    <li><a href="#tab-recentorders"><?php _e( 'Recent Orders', 'woocommerce' ); ?></a></li>
  </ul>

  </div>

  <div class="col-sm-8 col-md-9 col-lg-9">

  <div class="panel tab-container" id="tab-user">
    <h2><?php _e( 'Account Details', 'woocommerce' ); ?></h2>
    <p class="user-details">
    <?php
      echo get_avatar( $current_user->ID );
      printf(
        __( 'Hello <strong>%1$s</strong> (not %1$s? <a href="%2$s">Sign out</a>).', 'woocommerce' ) . ' ',
        $current_user->display_name,
        esc_url( wp_logout_url( get_permalink( wc_get_page_id( 'myaccount' ) ) ) )
      );
    ?>
    </p>
    <p class="myaccount_user">
    <?php
      printf( __( 'From your account dashboard you can view your recent orders, manage your shipping and billing addresses and <a href="%s">edit your password and account details</a>.', 'woocommerce' ),
        esc_url( wc_customer_edit_account_url() )
      );
    ?>
    <?php wc_get_template( 'myaccount/my-address.php' ); ?>
    </p>
  </div>

  <div class="panel tab-container" id="tab-downloads">
    <?php wc_get_template( 'myaccount/my-downloads.php' ); ?>
  </div>

  <div class="panel tab-container" id="tab-recentorders">
    <?php wc_get_template( 'myaccount/my-orders.php', array( 'order_count' => $order_count ) ); ?>
  </div>

  </div>

</div>

</div>

<?php do_action( 'woocommerce_after_my_account' ); ?>
