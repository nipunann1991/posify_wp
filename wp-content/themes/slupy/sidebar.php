<?php
/**
 * The Sidebar containing the special or main widget area
 *
 * @since Slupy 1.0
 */
?>
<div class="sidebar col-xs-12 col-sm-4 col-md-3 col-lg-3">
  <?php

    $ts_special_sidebar = 'blog-sidebar';

    if( is_woocommerce_activated() && is_woocommerce() ) {
      $ts_special_sidebar = 'woocommerce-sidebar';
    }

    //Look special sidebar
    if( is_page() || is_single() ) {
      $ts_single_meta = get_post_meta( get_the_ID(), '_ts_slupy_meta', true );
      $ts_special_sidebar = !empty($ts_single_meta['sidebar']) ? $ts_single_meta['sidebar'] : $ts_special_sidebar;
    }

    dynamic_sidebar( $ts_special_sidebar );

  ?>
</div><!-- .sidebar -->