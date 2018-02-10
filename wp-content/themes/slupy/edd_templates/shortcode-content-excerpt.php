<?php 
  $excerpt_length = apply_filters( 'excerpt_length', 30 );

  if( has_excerpt() ) {
    $edd_post_content = get_post_field( 'post_excerpt', get_the_ID() );
  }else {
    $edd_post_content = get_post_field( 'post_content', get_the_ID() );
  }

  $edd_post_content = remove_shortcode_in_edd_content($edd_post_content);

?>

<div itemprop="description" class="edd-download-excerpt">
  <?php echo apply_filters( 'edd_downloads_excerpt', wp_trim_words( $edd_post_content, intval( $excerpt_length ) ) ); ?>
</div>