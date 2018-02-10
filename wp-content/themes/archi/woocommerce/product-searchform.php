<form role="search" method="get" class="woocommerce-product-search widget_search" action="<?php echo esc_url( home_url( '/'  ) ); ?>">
	<input type="search" id="search" class="search-field form-control" placeholder="<?php echo esc_attr_x( 'Search Products&hellip;', 'placeholder', 'woocommerce' ); ?>" value="<?php echo get_search_query(); ?>" name="s" title="<?php echo esc_attr_x( 'Search for:', 'label', 'woocommerce' ); ?>" />
	<button id="btn-search" type="submit"></button>
	<div class="clearfix"></div>
	<input type="hidden" name="post_type" value="product" />
</form>
