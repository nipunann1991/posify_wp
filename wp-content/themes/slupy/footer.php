<?php
/**
 * The template for displaying the footer
 *
 * @since Slupy 1.0
 */
?>
<footer id="footer"<?php echo ts_get_option('footer_dark') ? ' class="footer-dark"' : ''; ?>>

  <?php if( ts_get_option('footer') ){ ?>

  <div class="footer-columns">
    <div class="container">
      <div class="row">

        <?php

          $ts_footer_columns = explode( ',', ts_get_option('footer') );

          if( is_array($ts_footer_columns) ){
            foreach ($ts_footer_columns as $ts_column_id => $ts_footer_column_class) {
              
              $ts_sidebar_name = 'footer'.( $ts_column_id ? '-'.($ts_column_id + 1) : '' );

              echo '<div class="'.esc_attr( $ts_footer_column_class ).'">';
              dynamic_sidebar( $ts_sidebar_name );
              echo '</div>';

              //check special clearfix
              if(( $ts_footer_column_class === 'col-sm-6 col-md-3 col-lg-3' && $ts_column_id == 1 )||( $ts_footer_column_class === 'col-sm-4 col-md-2 col-lg-2' && $ts_column_key == 2 )){
                echo '<div class="clearfix visible-sm"></div>';
              }else if( strpos( $ts_footer_column_class, 'clearfix-after' )  !== false ) {
                echo '<div class="clearfix"></div>';
              }
            }
          }

        ?>

      </div>
    </div>
  </div>

  <?php } ?>

  <?php

    $ts_copyright_text = ts_get_option('slupy_copyright');
    //check wpml
    if( is_array($ts_copyright_text) && defined('ICL_LANGUAGE_CODE') && !empty( $ts_copyright_text[ICL_LANGUAGE_CODE] ) ){
      $ts_copyright_content = $ts_copyright_text[ICL_LANGUAGE_CODE];
    } else if( !is_array($ts_copyright_text) ) {
      $ts_copyright_content = $ts_copyright_text;
    }

    if( $ts_copyright_content ){
  ?>

  <div class="copyright-text">
    <div class="container">
      <div class="row">
        <div class="col-sm-12">
          <?php echo do_shortcode($ts_copyright_content); ?>
        </div>
      </div>
    </div>
  </div><!-- .copyright-text -->

  <?php } ?>

</footer><!-- #footer -->

</div><!-- #main -->

<?php

  //Mobile Menu
  echo get_slupy_mobile_nav();
  
  //Back top button
  if ( ts_get_option('slupy_backtopbutton') ) {
    echo '<a href="#" class="back-site-top"></a>';
  }
  
  wp_footer();
?>

  </body>
</html>