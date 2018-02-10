<?php global $product; ?>
<li>	
	<?php echo htmlspecialchars_decode($product->get_image()); ?>			
	<div class="text">
		<a href="<?php echo esc_url( get_permalink( $product->id ) ); ?>" title="<?php echo esc_attr( $product->get_title() ); ?>">
			<span class="product-title"><?php echo htmlspecialchars_decode($product->get_title()); ?></span>
		</a>	
	    <?php if ( ! empty( $show_rating ) ) echo htmlspecialchars_decode($product->get_rating_html()); ?>
		<div class="price"><?php echo htmlspecialchars_decode($product->get_price_html()); ?></div>
    </div>	
</li>
