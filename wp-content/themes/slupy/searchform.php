<form class="search" method="get" action="<?php echo esc_url( home_url() ); ?>" role="search">
  <input class="search-input" type="search" name="s" placeholder="<?php esc_attr_e( 'What are you looking for?', SLUPY_TRANSLATE ); ?>">
  <?php
    if( defined('ICL_LANGUAGE_CODE') ){
      echo '<input type="hidden" name="lang" value="'.esc_attr( ICL_LANGUAGE_CODE ).'"/>';
    }
  ?>
  <button class="search-submit" type="submit" role="button"><?php _e( 'Search', SLUPY_TRANSLATE ); ?></button>
</form><!-- .search -->