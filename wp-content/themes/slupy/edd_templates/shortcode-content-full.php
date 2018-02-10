<?php 
  $edd_post_content = remove_shortcode_in_edd_content(get_post_field( 'post_content', get_the_ID() ));
?>
<div itemprop="description" class="edd-download-full-content">
  <?php echo apply_filters( 'edd_downloads_content', $edd_post_content ); ?>
</div>